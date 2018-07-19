<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VenueFinancialDetails extends Model
{
    protected $table ='venue__financial__details';

    public function venue()
    {
      return $this->belongsTo('App\Venue');
    }
}
