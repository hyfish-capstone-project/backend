<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

class ForumController extends ResponseController
{
    public function getForums(Request $request)
    {
        try {
            $forums = Post::whereHas('user', function ($query) {
                $query->where('role', 'user');
            })
            ->with('user')
            ->with('images')
            ->with('tags')
            ->withCount('liked_posts as likes')
            ->withCount('followed_posts as followers')
            ->with('comments.replies')
            ->get();
            
            $formattedForums = $forums->map(function($post) {
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
                    'images' => $image_urls
                ];
            });

            return $this->sendResponse('Get forums successful', $formattedForums);
        }
        catch (Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function getForumsByTitle(Request $request, $keywords)
    {
        try {
            $forums = Post::whereHas('user', function ($query) {
                $query->where('role', 'user');
            })
            ->where('title', 'like', '%' . $keywords . '%')
            ->with('user')
            ->with('images')
            ->with('tags')
            ->withCount('liked_posts as likes')
            ->withCount('followed_posts as followers')
            ->with('comments.replies')
            ->get();
            
            $formattedForums = $forums->map(function($post) {
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
                    'images' => $image_urls
                ];
            });
            
            return $this->sendResponse('Get forums by name successful', $formattedForums);
        }
        catch (Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
