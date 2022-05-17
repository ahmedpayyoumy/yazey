<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class Setting extends Model
{
    use LogsActivity;

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected static $logName = 'setting';

    protected $fillable = ['name', 'value'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        if (auth()->user()) {
            $activity->description = "Settings ({$this->name}) has been {$eventName} by <a href='".route('users.edit', ['user' => auth()->user()->id])."'>" . auth()->user()->name . "</a>";
        } else {
            $activity->description = "Settings ({$this->name}) has been {$eventName} by System</a>";
        }
        $activity->ip = request()->ip();
        $activity->user_agent = request()->header('User-Agent');
    }
}
