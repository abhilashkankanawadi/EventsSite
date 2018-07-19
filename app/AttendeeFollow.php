<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendeeFollow extends Model
{
    public function event()
    {
    	return $this->belongsTo('App\Event','event_id');
    }
    public function user()
    {
    	return $this->belongsTo('App\User','user_id');
    }
    public function attendee()
    {  
    	return $this->belongsTo('App\Attendee','attendee_id');
    }
}
