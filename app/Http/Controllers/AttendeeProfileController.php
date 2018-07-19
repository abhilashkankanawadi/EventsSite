<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendee;
use App\User;

class AttendeeProfileController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index($id)
  {
    $attendeeProfile  = Attendee::where('user_id',$id)->first();
    if ($attendeeProfile) {
      return view('AttendeeProfile',['attendeeProfile'=>$attendeeProfile,'id'=>$id]);
    }
  }
  public function store(Request $request,$id)
  {

  }
}
