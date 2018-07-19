<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Event_Review;

/**
 *
 */
class Event_ReviewTransformer extends TransformerAbstract
{
  public function transform(Event_Review $attendee)
  {
    return[
      'id'                     =>$attendee->id,
      'representative'                  =>$attendee->title,
      'representative_email'                 =>$attendee->review,
      'exhibiting_product'                =>$attendee->speaker,
      'product_details'                  =>$attendee->crowd,
      'company'               =>$attendee->event_id,
      'company_email'            =>$attendee->attendee_id,
      'company_email'            =>$attendee->attendee_id,
      'company_email'            =>$attendee->attendee_id,
      'company_email'            =>$attendee->attendee_id,
      'company_email'            =>$attendee->attendee_id
    ];
  }
}
