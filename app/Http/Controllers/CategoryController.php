<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function list()
    {
        return view('categories.list');
    }

    public function data()
    {
        $categories = Category::with(['user'])->get();
        $data = DataTables::of($categories)
            ->editColumn('created_by', function ($dt) {
                return $dt->user->name;
            })
            ->editColumn('actions', function ($dt) {
                return '<a href="' . route('blog.categories.detail', $dt->id) . '" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a>
                        <a href="' . route('blog.categories.delete', $dt->id) . '" class="btn btn-sm btn-clean btn-icon btn-delete" title="Delete"><i class="la la-trash"></i></a>';
            })
            ->rawColumns(['actions']);
        return $data->make(true);
    }

    public function detail($id)
    {
        if ($id === 'add') {
            return view('categories.detail');
        }
        $category = Category::find($id);
        if (empty($category)) {
            toastr()->error('Không tìm thấy chuyên mục!');
            return redirect()->back();
        }
        return view('categories.detail', [
            'category' => $category
        ]);
    }

    public function create(Request $request)
    {
        $title = $request->get('title');
        Category::create([
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $request->get('description'),
            'created_by' => auth()->id(),
        ]);
        toastr()->success('Thêm chuyên mục thành công!');
        return redirect()->route('blog.categories.list');
    }

    public function update($id, Request $request)
    {
        $category = Category::find($id);
        if (empty($category)) {
            toastr()->error('Không tìm thấy chuyên mục!');
            return redirect()->back();
        }

        $title = $request->get('title');
        $category->update([
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $request->get('description'),
        ]);
        toastr()->success('Cập nhật chuyên mục thành công!');
        return redirect()->route('blog.categories.list');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            toastr()->error('Không tìm thấy chuyên mục!');
            return redirect()->back();
        }
        $category->posts()->detach($id);
        $category->delete();
        toastr()->success('Cập nhật chuyên mục thành công!');
        return redirect()->route('blog.categories.list');
    }
}
