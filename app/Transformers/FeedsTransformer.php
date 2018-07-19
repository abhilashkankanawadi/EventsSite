<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Feed;

/**
 *
 */
class FeedsTransformer extends TransformerAbstract
{
  public function transform(Feed $feed)
  {
    return[
      'id'          =>  $feed->id,
      'title'       =>  $feed->title,
      'description' =>  $feed->description,
      'url'         =>  $feed->url,
      'date'        =>  $feed->date,
      'images'      =>  $feed->images,
      'video'       =>  $feed->video,
      'location'    =>  $feed->location,
      'user_id'     =>  $feed->user_id
    ];
  }
}
