<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Review;

/**
 *
 */
class ReviewTransformer extends TransformerAbstract
{
  public function transform(Review $events)
  {
    return[
      'id'           =>  $events->id,
      'event'        =>  $events->event,
      'organiser'    =>  $events->organiser,
      'speaker'      =>  $events->speaker,
      'venue'        =>  $events->venue,
      'attendee_id'  =>  $events->attendee_id
    ];
  }
}
