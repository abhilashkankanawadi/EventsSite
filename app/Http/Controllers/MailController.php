<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function mailing()
    {
      $user = User::all();
      foreach ($user as $key => $value) {
        $data=['name'=>'Hi. This is a test Mail','clickHere'=>'know more about design esthetics'];
        Mail::send('BulkMail',['user'=>$value->name],function($message) use($value)
        {
          $message->to($value->email);
          $message->subject('Test Mail..');
        });
      }
      return response()->json(['OK'=>'E-Mail sent successfully','status'=>200]);
    }
}
