<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_DaysInfo extends Model
{
    protected $table='event__days_infos';

    public function event()
    {
      return $this->belongsTo('App\Event');
    }
    public function myagend()
    {
      return $this->hasMany('App\MyAgenda','event__days_infos_id');
    }
    public function venue()
    {
      return $this->belongsTo('App\Venue','venue_id');
    }
    public function speaker()
    {
      return $this->belongsTo('App\Speaker');
    }
}
