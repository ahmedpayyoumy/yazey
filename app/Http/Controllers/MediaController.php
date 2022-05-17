<?php

namespace App\Http\Controllers;

use App\Media;
use App\MediaCategory;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if (isset($request->cat)) {
            $media = Media::with('mediaCategory')->where('media_category', intval($request->cat))->get();
        } else {
            $media = Media::with('mediaCategory')->get();
        }
        $mediaCategorys = MediaCategory::all();
        return view('pages.media.index', [
            'media' => $media,
            'mediaCategorys' => $mediaCategorys
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $mediaCategorys = MediaCategory::all();
        return view('pages.media.create', [
            'mediaCategorys' => $mediaCategorys
        ]);
    }

    public function upload(FileReceiver $receiver)
    {
        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        // receive the file
        $save = $receiver->receive();

        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need
            return $this->saveFile($save->getFile());
        }

        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();
        return response()->json([
            "done" => $handler->getPercentageDone()
        ]);
    }

    protected function saveFile(UploadedFile $file)
    {
        $fileName = $this->createFilename($file);
        // Group files by mime type
        $mime = str_replace('/', '-', $file->getMimeType());
        // Group files by the date (week
        $dateFolder = date("Y-m-W");

        // Build the file path
        $filePath = "upload/{$mime}/{$dateFolder}/";
        $finalPath = public_path($filePath);

        // move the file name
        $file->move($finalPath, $fileName);

        return response()->json([
            'path' => $filePath,
            'name' => $fileName,
            'mime_type' => $mime
        ]);
    }

    /**
     * Create unique filename for uploaded file
     * @param UploadedFile $file
     * @return string
     */
    protected function createFilename(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace("." . $extension, "", $file->getClientOriginalName()); // Filename without extension

        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time()) . "." . $extension;

        return $filename;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $this->validateCreate($request->all());
        if ($validated->fails()) {
            toastr()->error($validated->messages()->first());
            return redirect('/media-file')->withErrors($validated);
        }
        $media = new Media([
            'media_category' => $request->media_category,
            'name' => $request->name,
            'file_url' => $request->file_url,
            'is_active' => isset($request->is_active) ? $request->is_active : 0,
            'user_id' => Auth::user()->id
        ]);
        $media->save();
        toastr()->success('Media saved!');
        return redirect('/media-file')->with('success', 'Media saved!');
    }

    protected function validateCreate($credentials)
    {
        return Validator::make($credentials, [
            'name' => ['required'],
            'file_url' => ['required'],
            'media_category' => ['required'],
        ], [
            'name.required' => 'Vui lòng chọn file upload!',
            'file_url.required' => 'Vui lòng chọn file upload!',
            'media_category.required' => 'Danh mục là trường bắt buộc!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Media::find($id);
        $media->delete();
        toastr()->success('Media deleted successfully!');
        return redirect()->route('media-file.index')
            ->with('success', 'Media deleted successfully');
    }
}
