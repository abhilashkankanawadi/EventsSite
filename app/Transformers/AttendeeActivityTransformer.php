<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Attendee_activity;

/**
 *
 */
class AttendeeActivityTransformer extends TransformerAbstract
{
  public function transform(Attendee_activity $activity)
  {
    return[
      'id'             =>  $activity->id,
      'activity_name'  =>  $activity->activity_name,
      'hosted_by'      =>  $activity->hosted_by,
      'description'    =>  $activity->description,
      'category'       =>  $activity->category,
      'place'          =>  $activity->place,
      'state'          =>  $activity->state,
      'country'        =>  $activity->country,
      'start_date'     =>  $activity->start_date,
      'end_date'       =>  $activity->end_date,
      'participants'   =>  $activity->participants,
      'images'         =>  $activity->images,
      'videos'         =>  $activity->videos,
      'attendee_id'    =>  $activity->attendee_id
    ];
  }
}
