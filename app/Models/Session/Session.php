<?php

namespace App\Models\Session;
use App\Models\Term\Term;



use Illuminate\Database\Eloquent\Model;
use App\Models\Clazz\ClassRegistration;


class Session extends Model
{

  protected $table = 'school_sessions';

  protected $fillable = ['name', 'start_date', 'end_date'];

  public function terms()
  {
    return $this->hasMany(Term::class, 'session_id');
  }

  public function registrations()
  {
    return $this->hasMany(ClassRegistration::class, 'session_id');
  }


}
