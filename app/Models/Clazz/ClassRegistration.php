<?php

namespace App\Models\Clazz;
use App\Models\Term\Term;



use Illuminate\Database\Eloquent\Model;
use App\Models\Session\Session;

class ClassRegistration extends Model
{

  protected $table = 'student_class_registration';
  protected $with = ['session'];


  public function session()
  {
    return $this->belongsTo(Session::class, 'session_id');
  }

}
