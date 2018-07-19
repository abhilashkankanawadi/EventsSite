<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $table ='venues';

    public function venuefinancial()
    {
      return $this->hasMany('App\VenueFinancialDetails');
    }
    public function eventday()
    {
      return $this->hasMany('App\Event_DaysInfo');
    }
}
