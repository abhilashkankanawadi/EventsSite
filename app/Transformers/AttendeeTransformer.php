<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Attendee;

/**
 *
 */
class AttendeeTransformer extends TransformerAbstract
{
  public function transform(Attendee $attendee)
  {
    return[
      'id'                        =>$attendee->id,
      'first_name'                =>$attendee->first_name,
      'last_name'                 =>$attendee->last_name,
      'email'                     =>$attendee->email,
      'age'                       =>$attendee->age,
      'about'                     =>$attendee->about,
      'contact'                   =>$attendee->contact,
      'profession'               =>$attendee->profession,
      'country'                   =>$attendee->country,
      'gender'                    =>$attendee->gender,
      'company'                   =>$attendee->company,
      'position'                  =>$attendee->position,
      'expert_in'                 =>$attendee->expert_in,
      'gender'                    =>$attendee->gender,
      'how_you_heardabout_event'  =>$attendee->how_you_heardabout_event,
    ];
  }
}
