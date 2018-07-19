<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Partners;
/**
 *
 */
class PartnersTransformer extends TransformerAbstract
{
  public function transform(Partners $partenrs)
  {
    return[
      'id'           =>$partenrs->id,
      'name'         =>$partenrs->name,
      'email'        =>$partenrs->email,
      'phone'        =>$partenrs->phone,
      'address'      =>$partenrs->address,
      'country'      =>$partenrs->gender,
      'company_name' =>$partenrs->company_name,
      'description'  =>$partenrs->description,
    ];
  }
}
