<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatting extends Model
{
    public function discussion()
    {
      return $this->belongsTo('App\DiscussionChannel','discuss_channel_id');
    }
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
