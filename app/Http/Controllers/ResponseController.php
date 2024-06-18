<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function sendResponse($message, $data = [], $code = 200)
    {
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $code);
    }

    public function sendError($error, $code = 404)
    {
        $response = [
            'status' => false,
            'message' => $error
        ];

        return response()->json($response, $code);
    }
}
