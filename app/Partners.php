<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
  protected $table  = 'partners';

  public function partnership()
  {
    return $this->belongsTo('App\PartnershipCategory','partnership_category_id','id');
  }
    public function event()
    {
      return $this->belongsTo('App\Event','event_id');
    }
}
