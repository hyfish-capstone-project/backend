<?php

namespace App\Http\Controllers;

use App\Models\Capture;
use App\Models\Fish;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CaptureController extends ResponseController
{
    public function getCaptures(Request $request)
    {
        try {
            $captures = Capture::where('user_id', Auth::user()->id)->get();
            return $this->sendResponse('Get captures successful', $captures);
        }
        catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function getRecentCaptures(Request $request, $count)
    {
        try {
            $captures = Capture::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->take($count)->get();
            return $this->sendResponse('Get recent captures successful', $captures);
        }
        catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
    
    public function getCapturebyCaptureID(Request $request, $capture_id)
    {
        try {
            $captures = Capture::findOrFail($capture_id);
            return $this->sendResponse('Get capture by ID successful', $captures);
        }
        catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function storeImage(UploadedFile $file, $folder = null, $filename = null)
    {
        $name = !is_null($filename) ? $filename : date('ymdhis') . '_' . Str::random(6);
        $path = $file->storeAs($folder, $name . "." . $file->extension(), 'gcs');
        return $path;
    }

    public function storeCapture(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'image' => 'required|mimes:png,jpg,jpeg',
                'type' => 'required|in:freshness,classification'
            ],
            [
                'image.required' => 'Image can\'t be empty',
                'image.mimes' => 'Allowed image extensions are PNG, JPG, JPEG',
                'type.required' => 'Type can\'t be empty',
                'type.in' => 'Type must be either freshness or classification'
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors(), 422);
            }
            
            $host = env('PREDICTION_HOST', 'localhost');
            $port = env('PREDICTION_PORT', 5000);

            if ($request->type == 'freshness'){            // freshness prediction
                $path = $request->hasFile('image') ? $this->storeImage($request->file('image'), 'captures') : null;
                $url = "http://$host:$port/api/freshness";
                $response = Http::post($url, ['path' => $path]);
                
                if ($response->successful() && isset($response['result']) &&  isset($response['score'])){
                    $capture = Capture::create([
                        'type' => 'freshness',
                        'image_url' => Storage::disk('gcs')->url($path),
                        'freshness' => $response['result'],
                        'score' => $response['score'],
                        'user_id' => Auth::user()->id,
                        'fish_id' => null
                    ]);
                }
                else {
                    return $this->sendError('Failed to get freshness prediction response');
                }

                return $this->sendResponse('Store capture successful', $capture);
            }
            else if ($request->type == 'classification'){            // fish classification
                $path = $request->hasFile('image') ? $this->storeImage($request->file('image'), 'captures') : null;
                $url = "http://$host:$port/api/predict"; 
                $response = Http::post($url, ['path' => $path]);

                if ($response->successful() && isset($response['result']) &&  isset($response['score'])){
                    $fish = Fish::firstWhere('name', $response['result']);
                    if (is_null($fish)) {
                        return $this->sendError('Fish not found');
                    }
                }
                else {
                    return $this->sendError('Failed to get classification response');
                }

                $capture = Capture::create([
                    'type' => 'classification',
                    'image_url' => Storage::disk('gcs')->url($path),
                    'freshness' => null,
                    'score' => $response['score'],
                    'user_id' => Auth::user()->id,
                    'fish_id' => $fish->id,
                ]);

                return $this->sendResponse('Store capture successful', $capture, 201);
            }

            return $this->sendError('Invalid type of feature', 400);
        }
        catch (Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
