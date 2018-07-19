<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Speaker;
use App\User;
use App\SpeakerSession;
use App\SpeakersNotes;
use App\Event_DaysInfo;
use Validator;
use Auth;

class SpeakerProfileController extends Controller
{
    public function show($id)
    {
      $user = User::where('id',Auth::user()->id)->first();
      if ($user->hasRole(['speaker','attendee','admin','organiser'])) {
        $profile  = Speaker::where('id',$id)->first();
        $info = Event_DaysInfo::where('speaker_id',$id)->get();
        return view('speaker.Speakerprofile',['profile'=>$profile,'info'=>$info,'id'=>$id]);
      }
      else {
        return "Permission Denied";
      }
    }
}
