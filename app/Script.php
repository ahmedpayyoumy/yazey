<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class Script extends Model
{
    use LogsActivity;

    protected static $logOnlyDirty = true;

    protected static $logName = 'script';

    protected $fillable = ['title', 'script_header', 'script_footer', 'option_compare', 'option_value'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        if (auth()->user()) {
            $activity->description = "<a href='".route('scripts.detail', ['id' => $this->id])."'>Script</a> has been {$eventName} by <a href='".route('users.edit', ['user' => auth()->user()->id])."'>" . auth()->user()->name . "</a>";
        } else {
            $activity->description = "<a href='".route('scripts.detail', ['id' => $this->id])."'>Script</a> has been {$eventName} by System</a>";
        }
        $activity->ip = request()->ip();
        $activity->user_agent = request()->header('User-Agent');
    }
}
