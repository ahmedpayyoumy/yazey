<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\PostMeta;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PageController extends Controller
{
    const META_TAGS = ['meta_title', 'meta_description', 'meta_image'];
 
    public function list()
    {
        return view('blog_pages.list');
    }

    public function data()
    {
        $posts = Post::with(['user'])->where('type', 'page')->get();
        $data = DataTables::of($posts)
            ->editColumn('content', function ($dt) {
                return Str::limit(strip_tags($dt->content), 30, '...');
            })
            ->editColumn('created_by', function ($dt) {
                return $dt->user->name;
            })
            ->editColumn('actions', function ($dt) {
                return '<a href="' . route('blog.pages.detail', $dt->id) . '" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a>
                        <a href="' . route('blog.pages.delete', $dt->id) . '" class="btn btn-sm btn-clean btn-icon btn-delete" title="Delete"><i class="la la-trash"></i></a>';
            })
            ->rawColumns(['actions']);
        return $data->make(true);
    }

    public function detail($id)
    {
        $categories = Category::all();
        $tags = Tag::all();
        if ($id === 'add') {
            return view('blog_pages.detail', [
                'categories' => $categories,
                'tags' => $tags
            ]);
        }
        $post = Post::with(['categories', 'tags', 'metas'])->find($id);
        if (empty($post)) {
            toastr()->error('Không tìm thấy bài viết!');
            return redirect()->back();
        }
        $post->metas = $post->metas->mapWithKeys(function ($item) {
            return [$item['meta_name'] => $item['meta_value']];
        });
        return view('blog_pages.detail', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function create(Request $request)
    {
        // Check slug existed
        $slugExisted = Post::where('slug', $request->get('slug'))->first();
        if ($slugExisted) {
            toastr()->error('Slug đã tồn tại!');
            return redirect()->back()->withInput();
        }
        
        // Handle upload feature image
        $featureImagePath = null;
        if ($file = $request->file('feature_image')) {
            $featureImagePath = $file->store('posts');
        }

        $post = Post::create([
            'type' => 'page',
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'content' => $request->get('content') ?? '',
            'feature_image' => $featureImagePath,
            'created_by' => auth()->id(),
        ]);
        $post->categories()->attach($request->get('categories'));
        $post->tags()->attach($request->get('tags'));
        
        foreach (self::META_TAGS as $meta) {
            PostMeta::create([
                'post_id' => $post->id,
                'meta_name' => $meta,
                'meta_value' => $request->get($meta) ?? null
            ]);
        }

        toastr()->success('Thêm trang thành công!');
        return redirect()->route('blog.pages.list');
    }

    public function update($id, Request $request)
    {
        $post = Post::find($id);
        if (empty($post)) {
            toastr()->error('Không tìm thấy trang!');
            return redirect()->back();
        }

        // Check slug existed
        $slugExisted = Post::where('slug', $request->get('slug'))
            ->where('id', '!=', $id)->first();
        if ($slugExisted) {
            toastr()->error('Slug đã tồn tại!');
            return redirect()->back()->withInput();
        }

        $post->update([
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'content' => $request->get('content') ?? '',
        ]);

        // Handle upload feature image
        if ($file = $request->file('feature_image')) {
            Storage::delete($post->feature_image);
            $featureImagePath = $file->store('posts');
            $post->update(['feature_image' => $featureImagePath]);
        }

        foreach (self::META_TAGS as $meta) {
            PostMeta::updateOrCreate([
                'post_id' => $post->id,
                'meta_name' => $meta
            ], [
                'meta_value' => $request->get($meta)
            ]);
        }

        $post->categories()->sync($request->get('categories'));
        $post->tags()->sync($request->get('tags'));
        toastr()->success('Cập nhật trang thành công!');
        return redirect()->route('blog.pages.list');
    }

    public function delete($id)
    {
        $post = Post::find($id);
        if (empty($post)) {
            toastr()->error('Không tìm thấy trang!');
            return redirect()->back();
        }
        if (!empty($post->feature_image)) {
            Storage::delete($post->feature_image);
        }
        $post->delete();
        $post->categories()->detach();
        $post->tags()->detach();
        $post->metas()->delete();
        toastr()->success('Cập nhật trang thành công!');
        return redirect()->route('blog.pages.list');
    }
}
