<?php

namespace App\Models\Role;


use Illuminate\Database\Eloquent\Model;
use App\HasPermissions;

class Role extends Model
{
  use HasPermissions;


  protected $table = 'auth_roles';

  protected $guarded = [];

  public function assigned_to()
  {
      return $this->morphTo();
  }

  public function scopeWithPermissions($query)
  {
    return $this->query->with['permissions'];
  }


}
