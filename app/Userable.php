<?php

namespace App;

trait Userable
{
    /**
     * get the actual User model
     */
    public function userable()
    {
        return $this->morphTo();
    }
}