<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class Post extends Model
{
    use LogsActivity;

    protected static $logOnlyDirty = true;

    protected static $logName = 'post';

    protected static $logAttributes = ['title'];

    protected $fillable = ['title', 'content', 'slug', 'created_by', 'feature_image', 'type', 'status', 'scheduled_time'];

    protected $appends = [
        'excerpt'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public const MAX_EXCERPT_LENGTH = 100;
    public const STATUS_PUBLISHED = 'published';
    public const STATUS_SCHEDULED = 'scheduled';
    public const STATUS_DRAFT = 'draft';

    public function getExcerptAttribute()
    {
        $strippedTagContent = strip_tags($this->content);
        return (mb_strlen($strippedTagContent) > Post::MAX_EXCERPT_LENGTH) ?
                mb_substr($strippedTagContent, 0, Post::MAX_EXCERPT_LENGTH) . '...' :
                $strippedTagContent;
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        if ($this->type === "post") {
            if (auth()->user()) {
                $activity->description = "<a href='".route('blog.posts.detail', ['id' => $this->id])."'>Post</a> has been {$eventName} by <a href='".route('users.edit', ['user' => auth()->user()->id])."'>" . auth()->user()->name . "</a>";
            } else {
                $activity->description = "<a href='".route('blog.posts.detail', ['id' => $this->id])."'>Post</a> has been {$eventName} by System</a>";
            }
        } elseif ($this->type === "page") {
            if (auth()->user()) {
                $activity->description = "<a href='".route('blog.pages.detail', ['id' => $this->id])."'>Page</a> has been {$eventName} by <a href='".route('users.edit', ['user' => auth()->user()->id])."'>" . auth()->user()->name . "</a>";
            } else {
                $activity->description = "<a href='".route('blog.pages.detail', ['id' => $this->id])."'>Page</a> has been {$eventName} by System</a>";
            }
        }
        $activity->ip = request()->ip();
        $activity->user_agent = request()->header('User-Agent');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id')->withTimestamps();
    }

    public function metas()
    {
        return $this->hasMany(PostMeta::class);
    }
}
