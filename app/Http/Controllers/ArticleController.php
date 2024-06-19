<?php

namespace App\Http\Controllers;

use App\Models\FollowedPost;
use App\Models\LikedPost;
use App\Models\Post;
use Exception;
use Google\Cloud\Storage\Connection\Rest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends ResponseController
{
    public function getArticles(Request $request)
    {
        try {
            $articles = Post::whereHas('user', function ($query) {
                $query->where('role', 'admin');
            })
            ->with('user')
            ->with('images')
            ->with('tags')
            ->withCount('liked_posts as likes')
            ->withCount('followed_posts as followers')
            ->with('comments.replies')
            ->get();
            
            $formattedArticles = $articles->map(function($post) {
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

                $isLiked = LikedPost::where('user_id', Auth::id())->where('post_id', $post->id)->exists();
                $isFollowed = FollowedPost::where('user_id', Auth::id())->where('post_id', $post->id)->exists();
            
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'body' => $post->body,
                    'author' => $post->user->username,
                    'created_at' => $post->created_at,
                    'likes' => $post->likes,
                    'followers' => $post->followers,
                    'comments' => $comments,
                    'tags' => $tag_names,
                    'images' => $image_urls,
                    'isLiked' => $isLiked,
                    'isFollowed' => $isFollowed
                ];
            });

            return $this->sendResponse('Get articles successful', $formattedArticles);
        }
        catch (Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function getArticlesByTitle(Request $request, $keywords)
    {
        try {
            $articles = Post::whereHas('user', function ($query) {
                $query->where('role', 'admin');
            })
            ->where('title', 'like', '%' . $keywords . '%')
            ->with('user')
            ->with('images')
            ->with('tags')
            ->withCount('liked_posts as likes')
            ->withCount('followed_posts as followers')
            ->with('comments.replies')
            ->get();
            
            $formattedArticles = $articles->map(function($post) {
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

                $isLiked = LikedPost::where('user_id', Auth::id())->where('post_id', $post->id)->exists();
                $isFollowed = FollowedPost::where('user_id', Auth::id())->where('post_id', $post->id)->exists();
            
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'body' => $post->body,
                    'author' => $post->user->username,
                    'created_at' => $post->created_at,
                    'likes' => $post->likes,
                    'followers' => $post->followers,
                    'comments' => $comments,
                    'tags' => $tag_names,
                    'images' => $image_urls,
                    'isLiked' => $isLiked,
                    'isFollowed' => $isFollowed
                ];
            });

            return $this->sendResponse('Get articles by name successful', $formattedArticles);
        }
        catch (Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
