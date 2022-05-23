<?php

namespace App\Models\Term;
use App\Models\Session\Session;


use Illuminate\Database\Eloquent\Model;

class Term extends Model
{

  protected $table = 'term_or_semester';

  public function session()
  {
    return $this->belongsTo(Session::class);
  }


}
