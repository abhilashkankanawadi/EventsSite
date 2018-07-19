<?php

namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\VenueFinancialDetails;
/**
 *
 */
class VenueFinancialDetailsTransformer extends TransformerAbstract
{
  public function transform(VenueFinancialDetails $details)
  {
    return[
      'id'            =>$details->id,
      'venue_id'  =>
      [
        'id'                        =>  $details->venue->id,
        'venue_name'                =>  $details->venue->venue_name,
        'branch_cities'             =>  $details->venue->branch_cities,
        'address'                   =>  $details->venue->address,
        'services'                  =>  $details->venue->services,
        'contact'                   =>  $details->venue->contact,
        'about'                     =>  $details->venue->about,
        'manager'                   =>  $details->venue->manager,
        'country'                   =>  $details->venue->country,
        'total_eventsHosted'        =>  $details->venue->total_eventsHosted,
        'website'                   =>  $details->venue->website,
        'capacity_of_accomodation'  =>  $details->venue->capacity_of_accomodation,
        'work_hours'                =>  $details->venue->work_hours,
        //'images'                    =>  $details->venues->images,
        'event_id'                  =>  $details->venue->event_id,
        'user_id'                   =>  $details->venue->user_id
      ],
      'account_name'  =>$details->account_name,
      'account_number'=>$details->account_number,
      'bank_name	'   =>$details->bank_name	,
      'bank_branch'   =>$details->bank_branch,
      'ifsc'          =>$details->ifsc
    ];
  }
}
