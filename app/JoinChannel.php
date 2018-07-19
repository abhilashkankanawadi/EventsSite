<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinChannel extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User','user_id');
    }
    public function discussChan()
    {
      return $this->belongsTo('App\DiscussionChannel');
    }
}
