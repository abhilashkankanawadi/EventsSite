<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Speaker;
use App\AttendeesNotes;
/**
 *
 */
class AttendeesNotesTransformer extends TransformerAbstract
{
  public function transform(AttendeesNotes $notes)
  {
    return[
      'id'           =>  $notes->id,
      'title'        =>  $notes->title,
      'description'  =>  $notes->description
    ];
  }
}
