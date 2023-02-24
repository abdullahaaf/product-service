<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function apiResponse($message, $statusCode, $data = [])
    {
        $content = [
            'message' => $message,
            'data'  => $data
        ];
        return response()->json($content, $statusCode);
    }

    public function apiResponseError($message, $statusCode)
    {
        $content = [
            'message' => $message
        ];

        return response()->json($content, $statusCode);
    }

    public function apiResponseErrorValidation($error)
    {
        $content = [
            'message' => 'Something went wrong',
            'validation error' => $error
        ];
        return response()->json($content, 400);
    }
}
