<?php

namespace App\Http\Controllers;

use App\MediaCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediaCategoryController extends Controller
{
    protected function validateCreateCategory($credentials)
    {
        return Validator::make($credentials, [
            'name' => ['required'],
        ], [
            'name.required' => 'Tên là trường bắt buộc!',
            'name.regex' => 'Tên không hợp lệ!',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mediaCategorys = MediaCategory::all();
        return view('pages.media-category.index', [
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
        return view('pages.media-category.create');
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
        $validated = $this->validateCreateCategory($request->all());
        if ($validated->fails()) {
            toastr()->error($validated->messages()->first());
            return redirect('/media-category')->withErrors($validated);
        }
        $category = new MediaCategory([
            'name' => $request->name,
            'is_active' => isset($request->is_active) ? $request->is_active : 0
        ]);
        $category->save();
        toastr()->success('Category saved!');
        return redirect('/media-category')->with('success', 'Category saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MediaCategory  $mediaCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $mediaCategory = MediaCategory::findOrFail($id);
        return view('pages.media-category.edit', [
            'mediaCategory' => $mediaCategory
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MediaCategory  $mediaCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $mediaCategory = MediaCategory::findOrFail($id);
        return view('pages.media-category.edit', [
            'mediaCategory' => $mediaCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MediaCategory  $mediaCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MediaCategory $mediaCategory)
    {
        //
        $validated = $this->validateCreateCategory($request->all());
        if ($validated->fails()) {
            toastr()->error($validated->messages()->first());
            return redirect('/media-category')->withErrors($validated);
        }

        if (isset($request->is_active)) {
            $mediaCategory->is_active = 1;
        } else {
            $mediaCategory->is_active = 0;
        }

        $mediaCategory->update($request->all());

        toastr()->success('Category updated successfully!');
        return redirect()->route('media-category.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MediaCategory  $mediaCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MediaCategory $mediaCategory)
    {
        //
        $mediaCategory->delete();
        toastr()->success('Category deleted successfully!');
        return redirect()->route('media-category.index')
            ->with('success', 'Category deleted successfully');
    }
}
