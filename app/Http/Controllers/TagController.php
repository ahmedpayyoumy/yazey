<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class TagController extends Controller
{
    public function list()
    {
        return view('tags.list');
    }

    public function data()
    {
        $tags = Tag::with(['user'])->get();
        $data = DataTables::of($tags)
            ->editColumn('created_by', function ($dt) {
                return $dt->user->name;
            })
            ->editColumn('actions', function ($dt) {
                return '<a href="' . route('blog.tags.detail', $dt->id) . '" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a>
                        <a href="' . route('blog.tags.delete', $dt->id) . '" class="btn btn-sm btn-clean btn-icon btn-delete" title="Delete"><i class="la la-trash"></i></a>';
            })
            ->rawColumns(['actions']);
        return $data->make(true);
    }

    public function detail($id)
    {
        if ($id === 'add') {
            return view('tags.detail');
        }
        $tag = Tag::find($id);
        if (empty($tag)) {
            toastr()->error('Không tìm thấy tag!');
            return redirect()->back();
        }
        return view('tags.detail', [
            'tag' => $tag
        ]);
    }

    public function create(Request $request)
    {
        $title = $request->get('title');
        Tag::create([
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $request->get('description'),
            'created_by' => auth()->id(),
        ]);
        toastr()->success('Thêm tag thành công!');
        return redirect()->route('blog.tags.list');
    }

    public function update($id, Request $request)
    {
        $tag = Tag::find($id);
        if (empty($tag)) {
            toastr()->error('Không tìm thấy tag!');
            return redirect()->back();
        }

        $title = $request->get('title');
        $tag->update([
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $request->get('description'),
        ]);
        toastr()->success('Cập nhật tag thành công!');
        return redirect()->route('blog.tags.list');
    }

    public function delete($id)
    {
        $tag = Tag::find($id);
        if (empty($tag)) {
            toastr()->error('Không tìm thấy tag!');
            return redirect()->back();
        }
        $tag->posts()->detach($id);
        $tag->delete();
        toastr()->success('Cập nhật tag thành công!');
        return redirect()->route('blog.tags.list');
    }
}
