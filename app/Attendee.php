<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $table ='attendees';

    public function notes()
    {
      return $this->hasMany('App\AttendeesNotes','attendee_id');
    }
    public function activity()
    {
      return $this->hasMany('App\Attendee_activity','attendee_id');
    }
    public function event()
    {
      return $this->belongsTo('App\Event');
    }
    public function user()
    {
      return $this->belongsTo('App\User');
    }
    public function attendeefollow()
    {
      return $this->hasMany('App\AttendeeFollow');
    }
}