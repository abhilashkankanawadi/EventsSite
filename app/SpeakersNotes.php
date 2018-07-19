<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpeakersNotes extends Model
{
    protected $table= 'speakers_notes';

    public function notes()
    {
      return $this->belongsTo('App\Speaker');
    }
}
