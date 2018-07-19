<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Speaker;
use App\SpeakerSession;
/**
 *
 */
class SpeakerTransformer extends TransformerAbstract
{
  public function transform(Speaker $events)
  {
    return[
      'id'                =>  $events->id,
      'first_name'        =>  $events->first_name,
      'last_name'         =>  $events->last_name,
      'email'             =>  $events->email,
      'profession'        =>  $events->profession,
      'age'               =>  $events->age,
      'city'              =>  $events->city,
      'state'             =>  $events->state,
      'gender'            =>  $events->gender,
      'address'           =>  $events->address,
      'expert_in'         =>  $events->expert_in,
      'country'           =>  $events->country,
      'ventures'          =>  $events->ventures,
      'contact'           =>  $events->contact,
      'about'             =>  $events->about,
      'company_name'      =>  $events->company_name,
      'position'          =>  $events->position,
      'language'          =>  $events->language,
      'awards'            =>  $events->awards,
      'events_attended'   =>  $events->events_attended

    ];
  }
}
