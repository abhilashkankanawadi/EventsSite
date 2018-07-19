<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends Model
{
    protected $table='permissions';

    public function roles()
    {
      return $this->belongsToMany('App\Role');
    }
}
