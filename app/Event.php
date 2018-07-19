<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table='events';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function organiser()
    {
      return $this->belongsTo('App\Organiser','user_id');
    } 
    public function exhibition() 
    {
      return $this->hasMany('App\Exhibition','event_id');
    }
    public function eventday()
    {
      return $this->hasMany('App\Event_DaysInfo','event_id');
    }
    public function attendee()
    {
      return $this->hasMany('App\Attendee','event_id');
    }
    public function post()
    {
      return $this->hasMany('App\Post','event_id');
    }
    public function partner()
    {
      return $this->hasMany('App\Partners');
    }
    public function speaker()
    {
      return $this->hasMany('App\Speaker');
    }
    public function attendeeFollow()
    {
      return $this->hasMany('App\AttendeeFollow');
    }
    public function meetingrequest()
    {
      return $this->hasMany('App\meetingrequest');
    }
    public function users()
    {
      return $this->belongsToMany('App\User');
    }
}
