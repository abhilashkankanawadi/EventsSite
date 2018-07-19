<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Venue;

/**
 *
 */
class VenueTransformer extends TransformerAbstract
{
  public function transform(Venue $events)
  {
    return[
      'id'                        =>  $events->id,
      'venue_name'                =>  $events->venue_name,
      'branch_cities'             =>  $events->branch_cities,
      'address'                   =>  $events->address,
      'services'                  =>  $events->services,
      'contact'                   =>  $events->contact,
      'about'                     =>  $events->about,
      'manager'                   =>  $events->manager,
      'country'                   =>  $events->country,
      'total_eventsHosted'        =>  $events->total_eventsHosted,
      'website'                   =>  $events->website,
      'capacity_of_accomodation'  =>  $events->capacity_of_accomodation,
      'work_hours'                =>  $events->work_hours,
      'images'                    =>  $events->images,
      // 'account_name'              =>  $events->venuefinancial->account_name,
      // 'account_number'            =>  $events->venuefinancial->account_number,
      // 'bank_name'                 =>  $events->venuefinancial->bank_name,
      // 'bank_branch'               =>  $events->venuefinancial->bank_branch,
      // 'ifsc'                      =>  $events->venuefinancial->ifsc,
      'event_id'                  =>  $events->event_id,
      'user_id'                   =>  $events->user_id
    ];
  }
}
