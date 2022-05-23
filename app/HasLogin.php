<?php

namespace App;


trait HasLogin
{
    
    public function login()
    {
        return $this->morphOne('App\User', 'userable');
    }

}