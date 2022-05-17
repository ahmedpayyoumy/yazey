<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class Tag extends Model
{
    use LogsActivity;

    protected static $logOnlyDirty = true;

    protected static $logName = 'tag';

    protected static $logAttributes = ['title'];

    protected $fillable = ['title', 'description', 'slug', 'created_by'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        if (auth()->user()) {
            $activity->description = "<a href='".route('blog.tags.detail', ['id' => $this->id])."'>Tag</a> has been {$eventName} by <a href='".route('users.edit', ['user' => auth()->user()->id])."'>" . auth()->user()->name . "</a>";
        } else {
            $activity->description = "<a href='".route('blog.tags.detail', ['id' => $this->id])."'>Tag</a> has been {$eventName} by System</a>";
        }
        $activity->ip = request()->ip();
        $activity->user_agent = request()->header('User-Agent');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id');
    }
}
