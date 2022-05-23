<?php

namespace App;

trait HasPermissions
{
    public function permissions()
    {
        return $this->morphMany('App\Models\Permission\Permission', 'assigned_to');
    }
}