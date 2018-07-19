<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoComment extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }
    public function Photofeed()
    {
      return $this->belongsTo('App\PhotoFeed');
    }
}
