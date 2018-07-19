<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Exhibitor;
/**
 *
 */
class ExhibitorTransformer extends TransformerAbstract
{
  public function transform(Exhibitor $exhibitor)
  {
    return[
      'id'                    => $exhibitor->id,
      'representative'        => $exhibitor->representative,
      'representative_email'  => $exhibitor->representative_email,
      'products'              => $exhibitor->products,
      'exhibiting_product'    => $exhibitor->exhibiting_product,
      'product_details'       => $exhibitor->product_details,
      'company'               => $exhibitor->company,
      'company_email'         => $exhibitor->company_email,
      'about_company'         => $exhibitor->about_company,
      'city'                  => $exhibitor->city,
      'total_employees'       => $exhibitor->total_employees,
      'branch_cities'         => $exhibitor->branch_cities,
      'founder'               => $exhibitor->founder,
      'address'               => $exhibitor->address,
      'employees'             => $exhibitor->employees,
      'contact'               => $exhibitor->contact,
      'website'               => $exhibitor->website,
      'exhibition_attended'   => $exhibitor->exhibition_attended,
      'event_id'              => $exhibitor->event_id,
      'established'           => $exhibitor->established,
      'images'                => $exhibitor->images,
      'video'                 => $exhibitor->video,
      'user_id'               => $exhibitor->user_id
    ];
  }
}
