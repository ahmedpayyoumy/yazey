<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class MediaCategory extends Model
{
    use LogsActivity;

    protected static $logOnlyDirty = true;

    protected static $logName = 'media-category';

    protected static $logAttributes = ['name'];

    protected $fillable = [
        'name', 'is_active'
    ];

    public function tapActivity(Activity $activity, string $eventName)
    {
        if (auth()->user()) {
            $activity->description = "<a href='".route('media-category.show', ['media_category' => $this->id])."'>Media category</a> has been {$eventName} by <a href='".route('users.edit', ['user' => auth()->user()->id])."'>" . auth()->user()->name . "</a>";
        } else {
            $activity->description = "<a href='".route('media-category.show', ['media_category' => $this->id])."'>Media category</a> has been {$eventName} by System";
        }
        $activity->ip = request()->ip();
        $activity->user_agent = request()->header('User-Agent');
    }
}
