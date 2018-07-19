<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoLike extends Model
{
  public function user()
  {
    return $this->belongsTo('App\User','user_id');
  }
  public function Photofeed()
  {
    return $this->belongsTo('App\PhotoFeed','photo_id');
  }
}
