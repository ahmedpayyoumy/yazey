<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class PostMeta extends Model
{
    use LogsActivity;

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected static $logName = 'post-meta';

    protected static $logAttributes = ['meta_value'];

    protected static $recordEvents = ['updated'];

    protected $fillable = ['post_id', 'meta_name', 'meta_value'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $post = $this->post;
        if ($post->type === "post") {
            if (auth()->user()) {
                $activity->description = "<a href='Meta of ".route('blog.posts.detail', ['id' => $this->id])."'>post</a> has been {$eventName} by <a href='".route('users.edit', ['user' => auth()->user()->id])."'>" . auth()->user()->name . "</a>";
            } else {
                $activity->description = "<a href='Meta of ".route('blog.posts.detail', ['id' => $this->id])."'>post</a> has been {$eventName} by System</a>";
            }
        } elseif ($post->type === "page") {
            if (auth()->user()) {
                $activity->description = "<a href='Meta of ".route('blog.pages.detail', ['id' => $this->id])."'>page</a> has been {$eventName} by <a href='".route('users.edit', ['user' => auth()->user()->id])."'>" . auth()->user()->name . "</a>";
            } else {
                $activity->description = "<a href='Meta of ".route('blog.posts.detail', ['id' => $this->id])."'>page</a> has been {$eventName} by System</a>";
            }
        }
        $activity->ip = request()->ip();
        $activity->user_agent = request()->header('User-Agent');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
