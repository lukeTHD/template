<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function image(UploadImage $request)
    {
        if($upload = upload($request->image)) {
            return response()->json([
               'status' => true,
               'code' => 0,
               'message' => 'success',
               'data' => $upload
            ]);
        }
        return response()->json([
            'status' => false,
            'code' => 0,
            'message' => 'failed',
            'data' => []
        ]);
    }
}
