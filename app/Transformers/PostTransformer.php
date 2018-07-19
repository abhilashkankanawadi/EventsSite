<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Post;

/**
 *
 */
class PostTransformer extends TransformerAbstract
{
  public function transform(Post $post)
  {
    return[
      'id'          =>  $post->id,
      'status'      =>  $post->status,
      'tags'        =>  $post->tags,
      'images'      =>  $post->images,
      'video'       =>  $post->video,
      'location'    =>  $post->location,
      'user_id'     =>  $post->user_id
    ];
  }
}
