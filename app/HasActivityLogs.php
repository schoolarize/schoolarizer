<?php

namespace App;

trait HasActivityLogs
{
    public function activityLogs()
    {
        return $this->morphMany('App\Models\ActivityLog\ActivityLog', 'loggable');
    }

}