<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnershipCategory extends Model
{

  public function part()
  {
    return $this->hasMany('App\Partners','id');
  } 

}
