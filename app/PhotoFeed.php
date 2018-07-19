<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoFeed extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User','user_id');
    }
    public function event()
    {
      return $this->belongsTo('App\Event','event_id');
    }
    public function photolike()
    {
      return $this->hasMany('App\PhotoLike');
    }
}
