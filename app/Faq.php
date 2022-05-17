<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity;

class Faq extends Model
{
    use LogsActivity;

    protected static $logOnlyDirty = true;

    protected static $logName = 'faq';

    protected static $logAttributes = ['question'];

    protected $fillable = ['question', 'answer'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->description = "FAQ has been {$eventName} by <a href='".route('users.edit', ['user' => auth()->user()->id])."'>" . auth()->user()->name . "</a>";
        $activity->ip = request()->ip();
        $activity->user_agent = request()->header('User-Agent');
    }
}
