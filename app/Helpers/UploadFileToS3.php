<?php
namespace App\Helpers;

use App\Jobs\EncryptFile;
use App\Jobs\MoveFileToS3;
use Storage;
use Log;

class UploadFileToS3
{
    public static function upload($file, $folder = "")
    {
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
        $fileName = substr(md5($file->getClientOriginalName() . date("Y-m-d h:i:sa")), 15) . '.' . $file->getClientOriginalExtension();
        if (!$folder) {
            Storage::disk('s3')->put($fileName, file_get_contents($file));
            return $url . $fileName;
        } else {
            Storage::disk('s3')->put($folder . '/' .$fileName, file_get_contents($file));
            return $url . $folder . '/' . $fileName;
        }
    }
    public static function uploadCrop($file)
    {
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
        $fileName = $file;
        Storage::disk('s3')->put($fileName, file_get_contents($file));
        return $url . $fileName;
    }

    public static function largeFileUpload($file)
    {
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
        $fileName = substr(md5($file->getClientOriginalName() . date("Y-m-d h:i:sa")), 15) . '.' . $file->getClientOriginalExtension();
        Storage::disk('s3')->put($fileName, fopen($file, 'r+'));
        return $url . $fileName;
    }

    public static function localLargeFileUpload($path)
    {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $name =pathinfo($path, PATHINFO_FILENAME);
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
        $fileName = substr(md5($name . date("Y-m-d h:i:sa")), 15) . '.' . $ext;
        Storage::disk('s3')->put($fileName, fopen($path, 'r+'));
        unlink($path);
        return $url . $fileName;
    }

    public static function uploadLocalFile($path)
    {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $name =pathinfo($path, PATHINFO_FILENAME);
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
        Log::info($url);
        $fileName = substr(md5($name . date("Y-m-d h:i:sa")), 15) . '.' . $ext;
        Storage::disk('s3')->put("video/".$fileName, fopen($path, 'r+'));
        // @unlink($path);
        return $url ."video/". $fileName;
        // $ext = pathinfo($path, PATHINFO_EXTENSION);
        // $name =pathinfo($path, PATHINFO_FILENAME);
        // $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
        // $fileName = substr(md5($name . date("Y-m-d h:i:sa")), 15) . '.' . $ext;

        // EncryptFile::withChain([
        //     new MoveFileToS3($path,$fileName),
        // ])->dispatch($path);
        // unlink($path);
        // return $url ."video/". $fileName;
        // $ext = pathinfo($path, PATHINFO_EXTENSION);
        // $name =pathinfo($path, PATHINFO_FILENAME);
        // $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
        // $fileName = substr(md5($name . date("Y-m-d h:i:sa")), 15) . '.' . $ext;

        // EncryptFile::withChain([
        //     new MoveFileToS3($path,$fileName),
        // ])->dispatch($path);
        // unlink($path);
        // return $url ."video/". $fileName;
    }

    public static function delete($imageName)
    {
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
        $imageName = str_replace($url, '', $imageName);
        Storage::disk('s3')->delete($imageName);
    }

    public static function getAllFile()
    {
        $files =  Storage::disk('s3')->files();
        return $files;
    }

    public static function getUploadFileName($fullFileName)
    {
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
        return str_replace($url, '', $fullFileName);
    }
}
