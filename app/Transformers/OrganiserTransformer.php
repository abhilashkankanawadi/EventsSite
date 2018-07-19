<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Organiser;

/**
 *
 */
class OrganiserTransformer extends TransformerAbstract
{
  public function transform(Organiser $organiser)
  {
    return[
      'id'                 =>  $organiser->id,
      'first_name'         =>  $organiser->first_name,
      'last_name'          =>  $organiser->last_name,
      'contact'            =>  $organiser->contact,
      'address'            =>  $organiser->address,
      'gender'             =>  $organiser->gender,
      'age'                =>  $organiser->age,
      'country'            =>  $organiser->country,
      'about'              =>  $organiser->about,
      'experience'         =>  $organiser->experience,
      'profile_image'      =>  $organiser->profile_image,
      'achievements'       =>  $organiser->achievements,
      'company_name'       =>  $organiser->company_name,
      'event_brands'       =>  $organiser->event_brands
    ];
  }
}
