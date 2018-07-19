<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Event;

/**
 *
 */
class EventTransformer extends TransformerAbstract
{
  public function transform(Event $events)
  {
    return[
      'id'              =>  $events->id,
      'event_name'      =>  $events->event_name,
      'start_date'      =>  $events->start_date,
      'end_date'        =>  $events->end_date,
      'venue'           =>  $events->venue,
      'country'         =>  $events->country,
      'city'            =>  $events->city,
      'state'           =>  $events->state,
      'speaker'         =>  $events->speaker,
      'guest'           =>  $events->guest,
      'category'        =>  $events->category,
      'start_time'      =>  $events->start_time,
      'end_time'        =>  $events->end_time,
      'cost_per_person' =>  $events->cost_per_person,
      'highlights'      =>  $events->highlights,
      'partner'         =>  $events->partner,
      'participants'    =>  $events->participants,
      'organiser'       =>  $events->organiser,
      'langauge'        =>  $events->langauge,
      'description'     =>  $events->description,
      'contact_mail'    =>  $events->contact_mail,
      'contact_number'  =>  $events->contact_number,
      'images'          =>  $events->images,
      'video'           =>  $events->video,
      'sponsor'         =>  $events->sponsor
    ];
  }
}
