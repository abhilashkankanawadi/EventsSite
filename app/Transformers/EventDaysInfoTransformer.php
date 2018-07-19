<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Event_DaysInfo;

/**
 *
 */
class EventDaysInfoTransformer extends TransformerAbstract
{
  public function transform(Event_DaysInfo $EventDaysInfo)
  {
    return [
      'id'          =>  $EventDaysInfo->id,
      'start_date'  =>  $EventDaysInfo->start_date,
      'end_date'    =>  $EventDaysInfo->end_date,
      'start_time'  =>  $EventDaysInfo->start_time,
      'end_time'    =>  $EventDaysInfo->end_time,
      'description' =>  $EventDaysInfo->description,
      'speaker'     =>  $EventDaysInfo->speaker,
      'venue'       =>  $EventDaysInfo->venue,
      'speaker_id'  =>  $EventDaysInfo->speaker_id,
      'venue_id'    =>  $EventDaysInfo->venue_id,
      'event_id'    =>  $EventDaysInfo->event_id,
    ];
  }
}
