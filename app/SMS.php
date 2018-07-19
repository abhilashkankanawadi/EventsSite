<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    protected $table = "s_m_s";

    public function user()
    {
      return $this->belongsTo('App\User','user_id');
    }
}
