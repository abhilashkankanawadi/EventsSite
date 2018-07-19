<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
  protected $table='exhibitions';

  public function event()
  {
    return $this->belongsTo('App\Event');
  }
}
