<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\EventManager;

/**
 *
 */
class EventManagerTransformer extends TransformerAbstract
{
  public function transform(EventManager $manager)
  {
    return[
      'id'           =>$manager->id,
      'email'        =>$manager->email,
      'name'         =>$manager->name,
      'phone'        =>$manager->phone,
      'address'      =>$manager->address,
      'gender'       =>$manager->gender
    ];
  }
}
