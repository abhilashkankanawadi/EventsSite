<?php

namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Partners;

/**
 *
 */
class PartnerTransformer extends TransformerAbstract
{
  public function transform(Partners $partner)
  {
    return[
      'id'            =>  $partner->id,
      'first_name'    =>  $partner->first_name,
      'last_name'     =>  $partner->last_name,
      'company_name'  =>  $partner->company_name,
      'about_company' =>  $partner->about_company,
      'phone'         =>  $partner->phone,
      'address'       =>  $partner->address,
      'country'       =>  $partner->country,
      'website'       =>  $partner->website,
      'amount'        =>  $partner->amount,
      'partnership_category'      =>  $partner->category,
      'user_id'       =>  $partner->user_id,
      'event_id'      =>  $partner->event_id,
    ];
  }
}
