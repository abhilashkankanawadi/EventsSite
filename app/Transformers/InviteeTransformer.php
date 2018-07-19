<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Invitee;

/**
 *
 */
class InviteeTransformer extends TransformerAbstract
{
  public function transform(Invitee $invitee)
  {
    return[
      'id'           =>$invitee->id,
      'name'         =>$invitee->name,
      'email'        =>$invitee->email,
      'phone'        =>$invitee->phone,
      'profession'   =>$invitee->profession,
      'place'        =>$invitee->place,
      'description'  =>$invitee->description
    ];
  }
}
