<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AttendeeFollow;
use Auth;

class AttendeeFollowController extends Controller 
{
    public function store(Request $request,$id) 
    {
    	$add				= 	new AttendeeFollow;
    	$add->follow_status	=	$request->follow_status;
    	$add->event_id		=	$request->id;
    	$add->user_id		=	Auth::user()->id;
    	$add->save(); 

    	return response()->json($add);
    }
    public function destroy($id)
    {
    	$remove	= AttendeeFollow::where('user_id',Auth::user()->id)->delete();
    }
}
