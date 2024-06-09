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
            ],
            [
                'image.required' => 'Image can\'t be empty',
                'image.mimes' => 'Allowed image extensions are PNG, JPG, JPEG'
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors(), 422);
            }

            // send request to flask
            $path = $request->hasFile('image') ? $this->storeImage($request->file('image'), 'captures') : null;
            $host = env('PREDICTION_HOST', 'localhost');
            $port = env('PREDICTION_PORT', 5000);
            $url = "http://$host:$port/api/predict"; 
            $response = Http::post($url, ['path' => $path]);

            if ($response->successful() && isset($response['result'])){
                $fish = Fish::firstWhere('name', $response['result']);
                if (is_null($fish)) {
                    return $this->sendError('Fish not found');
                }
            }
            else {
                return $this->sendError('Failed to get prediction response');
            }
            
            // TODO: update result dan rate
            $capture = Capture::create([
                'image_url' => Storage::disk('gcs')->url($path),
                'result' => "Sangat segar",
                'rate' => "96",
                'user_id' => Auth::user()->id,
                'fish_id' => $fish->id,
            ]);

            return $this->sendResponse('Store capture successful', $capture);
        }
        catch (Exception $e){
            return $this->sendError($e->getMessage());
        }
    }
}
