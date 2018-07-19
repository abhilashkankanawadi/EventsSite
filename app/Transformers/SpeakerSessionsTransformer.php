<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\SpeakerSession;

/**
 *
 */
class SpeakerSessionsTransformer extends TransformerAbstract
{
  public function transform(SpeakerSession $sess)
  {
    return [
      'id'            =>  $sess->id,
      'event_name'    =>  $sess->event_name,
      'category'      =>  $sess->category,
      'start_time'    =>  $sess->start_time,
      'end_time'      =>  $sess->end_time,
      'start_date'    =>  $sess->start_date,
      'end_date'      =>  $sess->end_date,
      'highlights'    =>  $sess->highlights,
      'description'   =>  $sess->description,
      'country'       =>  $sess->country,
      'city'          =>  $sess->city,
      'venue'         =>  $sess->venue,
      'venue_id'      =>  $sess->venue_id,
      'speaker_id'    =>  $sess->speaker_id,
    ];
  }
}
