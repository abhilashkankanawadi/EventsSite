<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Venue_Review;

/**
 *
 */
class Venue_reviewTransformer extends TransformerAbstract
{
  public function transform(Venue_Review $attendee)
  {
    return[
      'id'                  =>$attendee->id,
      'title'               =>$attendee->title,
      'review'              =>$attendee->review,
      'food'                =>$attendee->food,
      'beverage'            =>$attendee->beverage,
      'ambience'            =>$attendee->ambience,
      'service'             =>$attendee->service,
      'crowd'               =>$attendee->crowd,
      'attendee_id'         =>$attendee->attendee_id,
      'venue_id'            =>$attendee->venue_id
    ];
  }
}
