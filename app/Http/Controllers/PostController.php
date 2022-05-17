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
use Validator;

class PostController extends Controller
{
    const META_TAGS = ['meta_title', 'meta_description', 'meta_image'];

    private function validateRequest($data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string'],
            'slug' => ['required', 'string']
        ]);
    }

    public function list()
    {
        return view('posts.list');
    }

    public function data(Request $request)
    {
        $posts = Post::with(['user'])->where('type', 'post')->where('status', $request->status ?? Post::STATUS_PUBLISHED);
        if (!$request->status || $request->status === Post::STATUS_PUBLISHED) {
            $posts = $posts->orderBy('published_at', 'desc');
        } elseif ($request->status === Post::STATUS_SCHEDULED) {
            $posts = $posts->orderBy('scheduled_time', 'asc');
        } else {
            $posts = $posts->orderBy('created_at', 'desc');
        }
        $data = DataTables::of($posts)
            ->editColumn('scheduled_time', function ($dt) {
                if ($dt->scheduled_time) {
                    return Carbon::parse($dt->scheduled_time)->format('d/m/Y H:i:s');
                }
                return $dt->status;
            })
            ->editColumn('created_at', function ($dt) {
                return $dt->created_at->format('d/m/Y H:i:s');
            })
            ->editColumn('created_by', function ($dt) {
                return $dt->user->name;
            })
            ->editColumn('published_at', function ($dt) {
                return $dt->published_at->format('d/m/Y H:i:s');
            })
            ->editColumn('actions', function ($dt) {
                return '<a href="' . route('blog.posts.detail', $dt->id) . '" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a>
                        <a href="' . route('blog.posts.delete', $dt->id) . '" class="btn btn-sm btn-clean btn-icon btn-delete" title="Delete"><i class="la la-trash"></i></a>';
            })
            ->rawColumns(['excerpt', 'actions']);
        return $data->make(true);
    }

    public function detail($id)
    {
        $categories = Category::all();
        $tags = Tag::all();
        if ($id === 'add') {
            return view('posts.detail', [
                'categories' => $categories,
                'tags' => $tags
            ]);
        }
        $post = Post::with(['categories', 'tags', 'metas'])->find($id);
        if (empty($post)) {
            toastr()->error('Post does not exist!');
            return redirect()->back();
        }
        $post->metas = $post->metas->mapWithKeys(function ($item) {
            return [$item['meta_name'] => $item['meta_value']];
        });
        return view('posts.detail', [
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
            toastr()->error('Post\'s slug has already existed!');
            return redirect()->back()->withInput();
        }

        // Handle upload feature image
        $featureImagePath = null;
        if ($file = $request->file('feature_image')) {
            $featureImagePath = UploadFileToS3::upload($file, 'posts');
        }

        $post = Post::create([
            'type' => 'post',
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'content' => $request->get('content') ?? '',
            'feature_image' => $featureImagePath,
            'created_by' => auth()->id(),
            'scheduled_time' => $request->get('scheduled_time'),
            'status' => $request->get('scheduled_time') ?
                        Post::STATUS_SCHEDULED :
                        ($request->get('status') ?? Post::STATUS_PUBLISHED),
        ]);
        $post->categories()->attach($request->get('categories'));
        $tags = $request->get('tags');
        if ($tags && is_array($tags)) {
            foreach ($tags as $key => $tag) {
                $newTag = Tag::find($tag);
                if (!$newTag) {
                    $newTag = Tag::firstOrCreate([
                        'title' => $tag,
                        'slug' => Str::slug($tag),
                        'created_by' => auth()->id()
                    ]);
                    $tags[$key] = $newTag->id;
                }
            }
        }
        $post->tags()->attach($tags);

        foreach (self::META_TAGS as $meta) {
            PostMeta::create([
                'post_id' => $post->id,
                'meta_name' => $meta,
                'meta_value' => $request->get($meta) ?? null
            ]);
        }

        if ($post->status === Post::STATUS_SCHEDULED) {
            $post->published_at = $post->scheduled_time;
            $post->save();
        } else {
            $post->published_at = $post->created_at;
            $post->save();
        }

        toastr()->success('Successfully added new post!');
        if (session('previous_url')) {
            return redirect(session('previous_url'));
        }
        return redirect()->route('blog.posts.list');
    }

    public function update($id, Request $request)
    {
        session(['previous_url' => url()->previous()]);
        $post = Post::find($id);
        if (empty($post)) {
            toastr()->error('Post does not exist!');
            return redirect()->back();
        }

        // Check slug existed
        $slugExisted = Post::where('slug', $request->get('slug'))
            ->where('id', '!=', $id)->first();
        if ($slugExisted) {
            toastr()->error('Post\'s slug has already existed!');
            return redirect()->back()->withInput();
        }

        $post->update([
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'content' => $request->get('content') ?? '',
            'scheduled_time' => $request->get('scheduled_time'),
            'status' => $request->get('scheduled_time') ?
                Post::STATUS_SCHEDULED :
                ($request->get('status') ?? Post::STATUS_PUBLISHED)
        ]);

        // Handle upload feature image
        if ($file = $request->file('feature_image')) {
            Storage::delete($post->feature_image);
            $featureImagePath = UploadFileToS3::upload($file, 'posts');
            $post->update(['feature_image' => $featureImagePath]);
        }

        $post->categories()->sync($request->get('categories'));
        $tags = $request->get('tags');
        if ($tags && is_array($tags)) {
            foreach ($tags as $key => $tag) {
                $newTag = Tag::find($tag);
                if (!$newTag) {
                    $newTag = Tag::firstOrCreate([
                        'title' => $tag,
                        'slug' => Str::slug($tag),
                        'created_by' => auth()->id()
                    ]);
                    $tags[$key] = $newTag->id;
                }
            }
        }
        $post->tags()->sync($tags);
        foreach (self::META_TAGS as $meta) {
            PostMeta::updateOrCreate([
                'post_id' => $post->id,
                'meta_name' => $meta
            ], [
                'meta_value' => $request->get($meta)
            ]);
        }

        if ($post->status === Post::STATUS_SCHEDULED) {
            $post->published_at = $post->scheduled_time;
            $post->save();
        } else {
            $post->published_at = $post->created_at;
            $post->save();
        }

        toastr()->success('Successfully updated the post!');
        if (session('previous_url')) {
            return redirect(session('previous_url'));
        }
        return redirect()->route('blog.posts.list');
    }

    public function delete($id)
    {
        $post = Post::find($id);
        if (empty($post)) {
            toastr()->error('Post does not exist!');
            return redirect()->back();
        }
        if (!empty($post->feature_image)) {
            Storage::delete($post->feature_image);
        }
        $post->delete();
        $post->categories()->detach();
        $post->tags()->detach();
        $post->metas()->delete();
        toastr()->success('Successfully deleted the post!');
        return redirect()->route('blog.posts.list');
    }

    public function autosave(Request $request)
    {
        $validator = $this->validateRequest($request->all());
        if ($validator->fails()) {
            $draftName = 'draft-'.microtime();
            $request->merge([
                'title' => $draftName,
                'slug' => Str::slug($draftName)
            ]);
        }
        $postId = $request->post_id;
        if (!$postId) {
            // Check slug existed
            $slugExisted = Post::where('slug', $request->get('slug'))->first();
            if ($slugExisted) {
                return response()->json([
                    'error' => 'Post\'s slug has already existed!'
                ]);
            }
            // Handle upload feature image
            $featureImagePath = null;
            if ($file = $request->file('feature_image')) {
                $featureImagePath = UploadFileToS3::upload($file, 'posts');
            }
            $post = Post::create([
                'type' => 'post',
                'is_favorite' => $request->get('is_favorite') ? 1 : 0,
                'title' => $request->get('title'),
                'short_description' => $request->get('short_description'),
                'slug' => $request->get('slug'),
                'content' => $request->get('content') ?? '',
                'feature_image' => $featureImagePath,
                'created_by' => auth()->id(),
                'scheduled_time' => $request->get('scheduled_time'),
                'status' => $request->get('scheduled_time') ?
                            Post::STATUS_SCHEDULED :
                            Post::STATUS_DRAFT
            ]);
        } else {
            // Check slug existed
            $slugExisted = Post::where([
                'slug' => $request->get('slug'),
                ['id', '<>', $postId]
            ])->first();
            if ($slugExisted) {
                return response()->json([
                    'error' => 'Post\'s slug has already existed!'
                ]);
            }
            $post = Post::find($postId);
            if (!$post) {
                return response()->json([
                    'error' => 'Post does not exist!'
                ]);
            }
            $post->update([
                'title' => $request->get('title'),
                'short_description' => $request->get('short_description'),
                'is_favorite' => $request->get('is_favorite') ? 1 : 0,
                'slug' => $request->get('slug'),
                'content' => $request->get('content') ?? '',
                'scheduled_time' => $request->get('scheduled_time'),
                'status' => $request->get('scheduled_time') ?
                    Post::STATUS_SCHEDULED :
                    ($request->get('status') ?? Post::STATUS_PUBLISHED)
            ]);
        }
        $post->categories()->sync($request->get('categories'));
        $tags = $request->get('tags');
        if ($tags && is_array($tags)) {
            foreach ($tags as $key => $tag) {
                $newTag = Tag::find($tag);
                if (!$newTag) {
                    $newTag = Tag::firstOrCreate([
                        'title' => $tag,
                        'slug' => Str::slug($tag),
                        'created_by' => auth()->id()
                    ]);
                    $tags[$key] = $newTag->id;
                }
            }
        }

        $post->tags()->sync($tags);
        foreach (self::META_TAGS as $meta) {
            PostMeta::updateOrCreate([
                'post_id' => $post->id,
                'meta_name' => $meta
            ], [
                'meta_value' => $request->get($meta)
            ]);
        }
        
        if ($post->status === Post::STATUS_SCHEDULED) {
            $post->published_at = $post->scheduled_time;
            $post->save();
        } else {
            $post->published_at = $post->created_at;
            $post->save();
        }

        return response()->json([
            'message' => $post
        ]);
    }
}
