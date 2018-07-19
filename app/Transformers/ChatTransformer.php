<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\SMS;
use App\User;
/**
 *
 */
class ChatTransformer extends TransformerAbstract
{
  public function transform(SMS $sms)
  {
    return[
      'id'          =>$sms->id,
      'messages'    =>$sms->messages,
      'user_id'     =>
      [
        'id'        =>$sms->user->id,
        'name'      =>$sms->user->name
      ],
    ];
  }
}
