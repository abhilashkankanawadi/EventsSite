<?php

namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Exhibition;

/**
 *
 */
class ExhibitionsTransformer extends TransformerAbstract
{
  public function transform(Exhibition $exhibition)
  {
    return[
      'id'              => $exhibition->id,
      'title'           => $exhibition->title,
      'description'     => $exhibition->description,
      'city'            => $exhibition->city,
      'state'           => $exhibition->state,
      'country'         => $exhibition->country,
      'start_date'      => $exhibition->start_date,
      'end_date'        => $exhibition->end_date,
      'contact_mail'    => $exhibition->contact_mail,
      'contact_number'  => $exhibition->contact_number,
      'start_time'      => $exhibition->start_time,
      'end_time'        => $exhibition->end_time,
      'cost_person'     => $exhibition->cost_person,
      'highlights'      => $exhibition->highlights,
      'guests'          => $exhibition->guests,
      'partner'         => $exhibition->partner,
      'venue_id'        => $exhibition->venue_id,
      'user_id'         => $exhibition->user_id,
    ];
  }
}
