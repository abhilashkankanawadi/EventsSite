<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\SpeakerEvents;

/**
 *
 */
class SpeakerEventsTransformer extends TransformerAbstract
{
  public function transform(SpeakerEvents $events)
  {
    return[
      'id'  => $events->id,
      'event_name'  => $events->event_name,
      'date'  => $events->date,
      'venue_name'  => $events->venue_name,
      'duration'  => $events->duration,
      'description'  => $events->description,
      'awards'  => $events->awards,
      'oraganiser'  => $events->oraganiser,
      'participants'  => $events->participants,
      'images'  => $events->images,
      'speaker_id'  => $events->speaker_id
    ];
  }
}
