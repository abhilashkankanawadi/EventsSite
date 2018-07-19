<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organiser extends Model
{
	protected $fillable = ['first_name','last_name','city','state','country','contact','address','gender','age','about','experience','events_organized','achievements','company_name','event_brands','profile_image','agency_id','user_id','created_at','updated_at'];
	
    protected $table = 'organisers';

    public function agency()
    {
      return $this->belongsTo('App\Agency','agency_id'); 
    }
    public function events()
    {
      return $this->hasMany('App\Event'); 
    }
    public function meetingPlan()
    {
      return $this->hasMany('App\MeetingRequest');
    }
}
