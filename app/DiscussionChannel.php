<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionChannel extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }
    public function chatting()
    {
      return $this->hasMany('App\Chatting');
    }
    public function joinChat()
    {
      return $this->hasMany('App\JoinChannel','discuss_channel_id');
    }
}
