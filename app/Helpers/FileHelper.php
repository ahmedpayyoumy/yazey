<?php

namespace App\Helpers;

use File;
use Carbon\Carbon;

class FileHelper
{
    public static function upload($file)
    {
        $fileName = substr(md5($file->getClientOriginalName() . date("Y-m-d h:i:sa")), 15) . '.' . $file->getClientOriginalExtension();
        $url = $file->move('upload', $fileName);
        return '/upload/' . $fileName;
    }

    public static function delete($url)
    {
        File::delete(public_path() . $url);
    }

    public static function upload1($file, $folder)
    {
        $fileName = Carbon::now()->format('Y-m-d-H-i-s') . $file->getClientOriginalName();
        $url = $file->move('upload/' . $folder, $fileName);
        return '/upload/' . $folder . '/' . $fileName;
    }
}
