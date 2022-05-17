<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UploadFileToS3;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $url = UploadFileToS3::upload($request->file('file'), 'blog');
        return response()->json([
            'location' => $url
        ]);
    }
}
