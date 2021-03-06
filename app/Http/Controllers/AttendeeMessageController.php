<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AttendeeMessage;
use Carbon\Carbon;

class AttendeeMessageController extends Controller
{
  public function store(Request $request)
  {
    $day  = Carbon::now('Asia/Kolkata');
    $date = $day->toFormattedDateString(); //coverting date and time into only date(ex:6 Nov 2017)
    $time = $day->toTimeString();
    $msg = new AttendeeMessage;
    $msg->message = $request->message;
    $msg->date    = $date;
    $msg->time    = $time;
    $msg->user_id = $request->user()->id;
    $msg->save();
    return redirect()->back();
  }
}
