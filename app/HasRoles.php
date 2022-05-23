<?php

namespace App;

trait HasRoles
{
    public function roles()
    {
        return $this->morphMany('App\Models\Role\Role', 'assigned_to');
    }
}