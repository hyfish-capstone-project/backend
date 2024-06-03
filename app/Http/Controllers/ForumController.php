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
            ->withCount('liked_posts as likes')
            ->withCount('followed_posts as followers')
            ->with('comments.replies')
            ->get();

            return $this->sendResponse('Get forums successful', $forums);
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
            ->withCount('liked_posts as likes')
            ->withCount('followed_posts as followers')
            ->with('comments.replies')
            ->get();
            
            return $this->sendResponse('Get forums by name successful', $forums);
        }
        catch (Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
