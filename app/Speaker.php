<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $table='speakers';

    protected $fillable = ['first_name','last_name','profession','age','city','state','gender','address','expert_in','awards','country','contact','about','company_name','position','language','recognitions','ventures','exp_in_industry','events_attended','profile_image','user_id'];

    public function speakersessions()
    {
      return $this->hasMany('App\SpeakerSession');
    }
    public function speakersnotes()
    {
      return $this->hasMany('App\SpeakersNotes','speaker_id');
    }
    public function eventday()
    {
      return $this->hasMany('App\Event_DaysInfo');
    }
    public function event()
    {
      return $this->belongsTo('App\Event');
    }
    public function user()
    {
      return $this->belongsTo('App\User');
    }

}
