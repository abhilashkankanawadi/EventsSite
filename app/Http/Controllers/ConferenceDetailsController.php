<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Event_DaysInfo;
use DB;

class ConferenceDetailsController extends Controller
{
    public function show($id)
    {
      $disp = Event::where('id',$id)->get();
      return view('ConferenceDetails',['disp'=>$disp,'id'=>$id]);
    }
 //    public function show($id)
 //     {
 //    $disp = DB::table('events')
 //    ->join('attendees','events.id','attendees.event_id')
 //    ->join('partners','events.id','partners.event_id')
 //    ->join('speakers','events.id','speakers.event_id')
 //    ->select('attendees.first_name as atts','partners.first_name as partName','speakers.first_name as speakName')->get();
 //    return view('ConferenceDetails',['disp'=>$disp,'id'=>$id]);
	// } 
}
