<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee_activity extends Model
{
    protected $table  = 'attendee_activities';

    public function attendee()
    {
      return $this->belongsTo('App\Attendee');
    }
}
