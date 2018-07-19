<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Content;

/**
 *
 */
class ContentTransformer extends TransformerAbstract
{
  public function transform(Content $content)
  {
    return[
      'id'           =>$content->id,
      'feeds'        =>$content->feeds,
      'posts'        =>$content->posts,
      'images'       =>$content->images,
      'event_id'     =>$content->event_id,
      'user_id'      =>$content->user_id
    ];
  }
}
