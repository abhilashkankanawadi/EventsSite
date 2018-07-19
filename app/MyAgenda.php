<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyAgenda extends Model
{
  protected $table='my_agendas';

    public function eventAgenda()
    {
      return $this->belongsTo('App\Event_DaysInfo');
    }
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
