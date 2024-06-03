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
            $articles = Post
        }
        catch (Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function getArticleByID(Request $request)
    {

    }

    public function getArticlesByName(Request $request)
    {

    }
}
