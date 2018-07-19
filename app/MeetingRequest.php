<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeetingRequest extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    public function organise()
    {
    	return $this->belongsTo('App\Organiser','organiser_id'); 
    }
    public function event()
    {
    	return $this->belongsTo('App\Event','event_id');
    }
    public function userRequestedBy()
    {
        return $this->belongsTo('App\User','requested_by');
    }
    public function userRequestedto()
    {
        return $this->belongsTo('App\User','request_to');
    }
}