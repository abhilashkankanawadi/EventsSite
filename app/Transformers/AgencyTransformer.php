<?php

namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Agency;

/**
 *
 */
class AgencyTransformer extends TransformerAbstract
{
  public function transform(Agency $agency)
  {
    return[
      'id'                    => $agency->id,
      'agency_name'           => $agency->agency_name,
      'address'               => $agency->address,
      'country'               => $agency->country,
      'contact'               => $agency->contact,
      'about'                 => $agency->about,
      'events_organised'      => $agency->events_organised,
      'services'              => $agency->services,
      'recognitions'          => $agency->recognitions,
      'working_hours'         => $agency->working_hours,
      'working_days'          => $agency->working_days,
      'established'           => $agency->established,
      'main_branch'           => $agency->main_branch,
      'founder'               => $agency->founder,
      'sub_branches_cities'   => $agency->sub_branches_cities,
      'website'               => $agency->website,
      'total_organisers'      => $agency->total_organisers,
      'clients'               => $agency->clients,
      'sub_branches_cities'   => $agency->sub_branches_cities,
      'user_id'               => $agency->user_id,
    ];
  }
}
