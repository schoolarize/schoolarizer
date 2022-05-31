<?php

namespace App\Models\Student;



use Illuminate\Database\Eloquent\Model;

use App\Models\Clazz\ClassRegistration;


class Student extends Model
{
    protected $with = ['registrations'];

    public function registrations()
    {
        return $this->hasMany(ClassRegistration::class, 'student_id');
    }


}
