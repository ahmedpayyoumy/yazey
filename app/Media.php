<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class Media extends Model
{
    //
    use LogsActivity;

    protected static $logOnlyDirty = true;

    protected static $logName = 'media';

    protected static $recordEvents = ['created', 'deleted'];

    protected $fillable = [
        'media_category', 'name', 'file_url', 'user_id'
    ];

    public function tapActivity(Activity $activity, string $eventName)
    {
        if (auth()->user()) {
            $activity->description = "<a href='".route('media-file.show', ['media_file' => $this->id])."'>Media</a> has been {$eventName} by <a href='".route('users.edit', ['user' => auth()->user()->id])."'>" . auth()->user()->name . "</a>";
        } else {
            $activity->description = "<a href='".route('media-file.show', ['media_file' => $this->id])."'>Media</a> has been {$eventName} by System";
        }
        $activity->ip = request()->ip();
        $activity->user_agent = request()->header('User-Agent');
    }

    public function mediaCategory()
    {
        return $this->belongsTo(MediaCategory::class, 'media_category', 'id');
    }

    public function getExtensionAttribute()
    {
        $infoPath = pathinfo(public_path($this->file_url));
        $extension = (isset($infoPath['extension']) ? $infoPath['extension'] : 'unknow');

        return '*.' . $extension;
    }
}
