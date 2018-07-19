<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Attendee;
use Auth;
use DB;

class OrganiserDashboardController extends Controller
{
    public function show()
    {
    	$Totalevents	= Event::where('user_id',Auth::user()->id)->count();//total events
    	//$AllUsers	= Event::where('user_id',Auth::user()->id)->count();//total events
    	$AllUsers	= User::count();//all users
    	$AllAttendees	= DB::table('events')
    	->join('attendees','events.id', '=', 'attendees.event_id')
    	->where('events.user_id', '=' ,Auth::user()->id)
    	->count('events.user_id');

    	$AllPartners	= DB::table('events')
    	->join('partners','events.id', '=', 'partners.event_id')
    	->where('events.user_id', '=' ,Auth::user()->id)
    	->count('events.user_id');

    	$AllSpeakers	= DB::table('events')
    	->join('speakers','events.id', '=', 'speakers.event_id')
    	->where('events.user_id', '=' ,Auth::user()->id)
    	->count('events.user_id');
        return view('organiser.Dashboard',['Totalevents'=>$Totalevents,'AllUsers'=>$AllUsers,
        	'AllAttendees'=>$AllAttendees,'AllPartners'=>$AllPartners,'AllSpeakers'=>$AllSpeakers]);
    }
}
