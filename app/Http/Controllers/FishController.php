<?php

namespace App\Http\Controllers;

use App\Models\Fish;
use Exception;
use Illuminate\Http\Request;

class FishController extends ResponseController
{
    public function getAllFishes(Request $request)
    {
        try {
            $fishes = Fish::with(['recipes' => function($query) {
                $query->with('ingredients');
                $query->with('steps');
            }])->get();
            return $this->sendResponse('Get fishes successful', $fishes);
        }
        catch (Exception $e){
            return $this->sendError($e->getMessage());
        }
    }

    public function getFishByID(Request $request, $fish_id)
    {
        try {
            $fishes = Fish::with(['recipes' => function($query) {
                $query->with('ingredients');
                $query->with('steps');
            }])->findOrFail($fish_id);
            return $this->sendResponse('Get fish by ID successful', $fishes);
        }
        catch (Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
