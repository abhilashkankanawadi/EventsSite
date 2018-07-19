<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\SpeakersNotes;

/**
 *
 */
class SpeakersNotesTransformer extends TransformerAbstract
{
  public function transform(SpeakersNotes $events)
  {
    return[
      'id'            =>  $events->id,
      'title'         =>  $events->title,
      'note'   =>  $events->note
    ];
  }
}
