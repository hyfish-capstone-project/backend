<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Google\Cloud\Storage\Connection\Rest;
use Illuminate\Http\Request;

class ArticleController extends ResponseController
{
    public function getArticles(Request $request)
    {
        try {
            $articles = Post::whereHas('user', function ($query) {
                $query->where('role', 'admin');
            })
            ->withCount('liked_posts as likes')
            ->withCount('followed_posts as followers')
            ->with('comments.replies')
            ->get();

            return $this->sendResponse('Get articles successful', $articles);
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
            ->withCount('liked_posts as likes')
            ->withCount('followed_posts as followers')
            ->with('comments.replies')
            ->get();

            return $this->sendResponse('Get articles by name successful', $articles);
        }
        catch (Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
