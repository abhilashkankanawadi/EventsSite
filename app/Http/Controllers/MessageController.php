<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
  public function msg()
  {
    $to=[917892718779,918880282865];
    $nexmo = app('Nexmo\Client');
    foreach ($to as $key) {
      $nexmo->message()->send([
        'to' => $key,
        'from' => '918880282865',
        'text' => 'Hi This is Demo message from team DE.'
    ]);
    }
  return response()->json(['OK'=>'Message sent to the users successfully','status'=>200]);
  }
}
