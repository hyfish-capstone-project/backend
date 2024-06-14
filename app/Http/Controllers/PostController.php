<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Models\Post;
use App\Models\Tag;
use App\Models\PostImage;
use App\Models\Comment;
use App\Models\Reply;
use Exception;
use Illuminate\Support\Facades\Http;

class PostController extends ResponseController
{

    public function storeImage(UploadedFile $file, $folder = null, $filename = null)
    {
        $name = !is_null($filename) ? $filename : date('ymdhis') . '_' . Str::random(6);
        $path = $file->storeAs($folder, $name . "." . $file->extension(), 'gcs');
        $url = Storage::disk('gcs')->url($path);
        return $url;
    }

    public function deleteImage($path = null)
    {
        Storage::disk('gcs')->delete($path);
    }

    public function toxicCheck($sentence){
        $host = env('PREDICTION_HOST', 'localhost');
        $port = env('PREDICTION_PORT', 5000);

        $url = "http://$host:$port/api/toxic";
        $response = Http::post($url, ['sentence' => $sentence]);

        if ($response->successful()) return $response->json();
        else return null;
    }

    public function storePost(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'body' => 'required',
                'tags' => 'sometimes|array',
                'tags.*' => 'string',
                'images' => 'sometimes|array',
                'images.*' => 'mimes:png,jpg,jpeg',
            ],
            [
                'title.required' => 'Title can\'t be empty',
                'body.required' => 'Body can\'t be empty',
                'tags.array' => 'Tags must be an array',
                'tags.*.mimes' => 'Tag must be a string',
                'images.array' => 'Images must be an array',
                'image.*.mimes' => 'Allowed image extensions are PNG, JPG, JPEG'
            ]);
            
            if ($validator->fails()) {
                return $this->sendError($validator->errors(), 422);
            }

            $titleToxicCheck = $this->toxicCheck($request->title);
            $bodyToxicCheck = $this->toxicCheck($request->body);
            if ($titleToxicCheck && $titleToxicCheck['result'] == "Toxic"){
                return $this->sendError('Can\'t send post because the title contains toxic sentences');
            }
            else if ($bodyToxicCheck && $bodyToxicCheck['result'] == "Toxic"){
                return $this->sendError('Can\'t send post because the body contains toxic sentences');
            }

            if ($request->tags) {
                foreach ($request->tags as $tag) {
                    $tagToxicCheck = $this->toxicCheck($tag);
                    if ($tagToxicCheck && $tagToxicCheck['result'] == "Toxic") {
                        return $this->sendError('Can\'t send post because one or more tags contain toxic sentences');
                    }
                }
            }

            $post = Post::create([
                'title' => $request->title,
                'body' => $request->body,
                'user_id' => Auth::id()
            ]);

            $tagids = [];
            $tagResponse = [];
            if ($request->has('tags')) {
                foreach ($request->tags as $tagname) {
                    $tag = Tag::firstOrCreate(['name' =>  $tagname]);
                    $tagids[] = $tag->id;
                    $tagResponse[] = [
                        'id' => $tag->id,
                        'name' => $tag->name
                    ];
                }
                $post->tags()->attach($tagids);
            }

            $postImages = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $image_url = $this->storeImage($image, 'posts');
                    $postImages[] = PostImage::create([
                        'image_url' => $image_url,
                        'post_id' => $post->id
                    ]);
                }
            }

            $response = [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body,
                'tags' => $tagResponse,
                'images' => $postImages
            ];
            
            return $this->sendResponse('Post created successfully', $response);
        }
        catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function getPostByID(Request $request, $post_id)
    {
        try {
            $post = Post::with('user')
            ->with('images')
            ->with('tags')
            ->withCount('liked_posts as likes')
            ->withCount('followed_posts as followers')
            ->with('comments.replies')
            ->findOrFail($post_id);

            $image_urls = [];
            foreach ($post->images as $image) {
                $image_urls[] = $image->image_url;
            }

            $tag_names = [];
            foreach ($post->tags as $tag) {
                $tag_names[] = $tag->name;
            }            

            $comments = [];
            foreach($post->comments as $comment) {
                $replies = [];
                foreach($comment->replies as $reply) {
                    $replies[] = [
                        'id' => $reply->id,
                        'message' => $reply->message,
                        'author' => [
                            'id' => $reply->user->id,
                            'username' => $reply->user->username,
                        ],
                        'created_at' => $reply->created_at
                    ];
                }

                $comments[] = [
                    'id' => $comment->id,
                    'message' => $comment->message,
                    'author' => [
                        'id' => $comment->user->id,
                        'username' => $comment->user->username,
                    ],
                    'created_at' => $comment->created_at,
                    'replies' => $replies
                ];
            }

            $response = [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body,
                'author' => $post->user->username,
                'created_at' => $post->created_at,
                'likes' => $post->likes,
                'followers' => $post->followers,
                'comments' => $comments,
                'tags' => $tag_names,
                'images' => $image_urls
            ];

            return $this->sendResponse('Get post by id successful', $response);
        }
        catch (Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function updatePost(Request $request, $post_id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'body' => 'required',
                'tags' => 'sometimes|array',
                'tags.*' => 'string',
                'images' => 'sometimes|array',
                'images.*' => 'mimes:png,jpg,jpeg',
            ],
            [
                'title.required' => 'Title can\'t be empty',
                'body.required' => 'Body can\'t be empty',
                'tags.array' => 'Tags must be an array',
                'tags.*.mimes' => 'Tag must be a string',
                'images.array' => 'Images must be an array',
                'image.*.mimes' => 'Allowed image extensions are PNG, JPG, JPEG'
            ]);

            $post = Post::with('user')
            ->with('images')
            ->with('tags')
            ->withCount('liked_posts as likes')
            ->withCount('followed_posts as followers')
            ->with('comments.replies')
            ->findOrFail($post_id);

            // TODO: update tags
            // TODO: update images
            $post->update([
                'title' => $request->title,
                'body' => $request->body
            ]);

            $image_urls = [];
            foreach ($post->images as $image) {
                $image_urls[] = $image->image_url;
            }

            $tag_names = [];
            foreach ($post->tags as $tag) {
                $tag_names[] = $tag->name;
            }

            $comments = [];
            foreach($post->comments as $comment) {
                $replies = [];
                foreach($comment->replies as $reply) {
                    $replies[] = [
                        'id' => $reply->id,
                        'message' => $reply->message,
                        'author' => [
                            'id' => $reply->user->id,
                            'username' => $reply->user->username,
                        ],
                        'created_at' => $reply->created_at
                    ];
                }

                $comments[] = [
                    'id' => $comment->id,
                    'message' => $comment->message,
                    'author' => [
                        'id' => $comment->user->id,
                        'username' => $comment->user->username,
                    ],
                    'created_at' => $comment->created_at,
                    'replies' => $replies
                ];
            }

            $response = [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body,
                'author' => $post->user->username,
                'created_at' => $post->created_at,
                'likes' => $post->likes,
                'followers' => $post->followers,
                'comments' => $comments,
                'tags' => $tag_names,
                'images' => $image_urls
            ];

            return $this->sendResponse('Update post successful', $response);
        }
        catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function deletePost(Request $request, $post_id)
    {
        try {
            $post = Post::findOrFail($post_id);
            foreach ($post->images as $image) {
                $this->deleteImage($image->image_url);
            }
            $post->delete();
            return $this->sendResponse('Delete post successful');
        }
        catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function storeComment(Request $request, $post_id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'message' => 'required',
            ],
            [
                'message.required' => 'Message can\'t be empty',
            ]);

            $commentToxicCheck = $this->toxicCheck($request->message);
            if ($commentToxicCheck && $commentToxicCheck['result'] == "Toxic"){
                return $this->sendError('Can\'t send comment because it contains toxic sentences');
            }

            $comment = Post::findOrFail($post_id)->comments()->create([
                'message' => $request->message,
                'user_id' => Auth::id()
            ]);

            $response = [
                'id' => $comment->id,
                'post_id' => $comment->post_id,
                'message' => $comment->message,
                'author' => [
                    'id' => $comment->user->id,
                    'username' => $comment->user->username,
                ],
                'created_at' => $comment->created_at,
                'replies' => $comment->replies
            ];

            return $this->sendResponse('Comment created successfully', $response);
        }
        catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function storeReply(Request $request, $post_id, $comment_id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'message' => 'required',
            ],
            [
                'message.required' => 'Message can\'t be empty',
            ]);

            $replyToxicCheck = $this->toxicCheck($request->message);
            if ($replyToxicCheck && $replyToxicCheck['result'] == "Toxic"){
                return $this->sendError('Can\'t send reply because it contains toxic sentences');
            }

            $reply = Post::findOrFail($post_id)
            ->comments()
            ->findOrFail($comment_id)
            ->replies()
            ->create([
                'message' => $request->message,
                'user_id' => Auth::id()
            ]);

            $response = [
                'id' => $reply->id,
                'comment_id' => $reply->comment_id,
                'message' => $reply->message,
                'author' => [
                    'id' => $reply->user->id,
                    'username' => $reply->user->username,
                ],
                'created_at' => $reply->created_at
            ];

            return $this->sendResponse('Reply created successfully', $response);
        }
        catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function storeLike(Request $request, $post_id)
    {
        try {
            $post = Post::findOrFail($post_id);
            $post->liked_posts()->attach(Auth::id());

            return $this->sendResponse('Like added successfully');
        }
        catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function deleteLike(Request $request, $post_id)
    {
        try {
            $post = Post::findOrFail($post_id);
            $post->liked_posts()->detach(Auth::id());

            return $this->sendResponse('Like deleted successfully');
        }
        catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function storeFollow(Request $request, $post_id)
    {
        try {
            $post = Post::findOrFail($post_id);
            $post->followed_posts()->attach(Auth::id());

            return $this->sendResponse('Follow added successfully');
        }
        catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function deleteFollow(Request $request, $post_id)
    {
        try {
            $post = Post::findOrFail($post_id);
            $post->followed_posts()->detach(Auth::id());

            return $this->sendResponse('Follow deleted successfully');
        }
        catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
