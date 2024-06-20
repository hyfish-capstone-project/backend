<?php

namespace App\Http\Controllers;

use App\Models\Fish;
use App\Models\FishImage;
use Exception;
use Illuminate\Http\Request;

class FishController extends ResponseController
{
    public function getAllFishes(Request $request)
    {
        try {
            $fishes = Fish::with('images')->get();
            $formattedFishes = $fishes->map(function ($fish) {
                $image_urls = [];
                foreach ($fish->images as $image) {
                    $image_urls[] = $image->image_url;
                }

                return [
                    'id' => $fish->id,
                    'name' => $fish->name,
                    'description' => $fish->description,
                    'created_at' => $fish->created_at,
                    'images' => $image_urls
                ];
            });
            return $this->sendResponse('Get fishes successful', $formattedFishes);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function getFishByID(Request $request, $fish_id)
    {
        try {
            $fish = Fish::with(['recipes' => function ($query) {
                $query->with('ingredients');
                $query->with('steps');
            }])->with('images')->findOrFail($fish_id);

            $image_urls = [];
            foreach ($fish->images as $image) {
                $image_urls[] = $image->image_url;
            }

            $recipes = [];
            foreach ($fish->recipes as $recipe) {
                $ingredients = [];
                foreach ($recipe->ingredients as $ingredient) {
                    $ingredients[] = [
                        'id' => $ingredient->id,
                        'name' => $ingredient->name,
                        'amount' => $ingredient->pivot->amount,
                        'measurement' => $ingredient->pivot->measurement
                    ];
                }

                $steps = [];
                foreach ($recipe->steps as $step) {
                    $steps[] = [
                        'id' => $step->id,
                        'description' => $step->description,
                        'order' => $step->order,
                    ];
                }

                $recipes[] = [
                    'id' => $recipe->id,
                    'name' => $recipe->name,
                    'ingredients' => $ingredients,
                    'steps' => $steps
                ];
            }

            $formattedFish = [
                'id' => $fish->id,
                'name' => $fish->name,
                'description' => $fish->description,
                'created_at' => $fish->created_at,
                'nutrition_image' => $fish->nutrition_image_url,
                'recipes' => $recipes,
                'images' => $image_urls
            ];

            return $this->sendResponse('Get fish by ID successful', $formattedFish);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
