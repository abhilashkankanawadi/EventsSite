<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendeesNotes extends Model
{
    protected $table ='attendees_notes';

    public function attendee()
    {
      return $this->belongsTo('App\Attendee');
    }
}
