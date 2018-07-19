<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendee;
use App\User;
use App\Organiser;
use App\Speaker;
use App\Venue;
use App\Agency;
use App\Exhibitor;
use validator;

class UserProfileController extends Controller
{
    public function edit($id)
  { 
    $user = User::where('id',$id)->first();
    if ($user->hasRole(['speaker'])) {
      $editSpeaker  = Speaker::where('user_id',$id)->first();
      return view('speaker.SpeakerUpdate',['editSpeaker'=>$editSpeaker,'id'=>$id]);
    }
    elseif($user->hasRole(['attendee'])) {
      $modify = Attendee::where('user_id',$id)->first();
      return view('attendee.AttendeeUpdate',['modify'=>$modify,'id'=>$id]);
    }
    elseif ($user->hasRole(['organiser'])) {
      $organiser = Organiser::where('user_id',$id)->first();
      return view('Organiser.OrganiserUpdate',['organiser'=>$organiser,'id'=>$id]);
    }
    elseif ($user->hasRole(['agency'])) {
      $agency = Agency::where('user_id',$id)->first();
      return view('Agency.AgencyUpdate',['agency'=>$agency,'id'=>$id]);
    }
    elseif ($user->hasRole(['exhibitor'])) {
      $exhibitor = Exhibitor::where('user_id',$id)->first();
      return view('Exhibitor.ExhibitorUpdate',['exhibitor'=>$exhibitor,'id'=>$id]);
    }
}

  public function update(Request $request,$id)
  {
    $user=User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['attendee']) && $user->can('update')) {
      $validator = Validator::make($request->all(),[
        'first_name' => 'required',
        'company'    => 'required',
        'position'   => 'required',
        'gender'     => 'required',
      ]);
      if ($validator->fails()) {
              return $validator->errors()->all();
          }
      $change = Attendee::where('id',$id)->first();
      if ($change) {
        $change->first_name               = $request->first_name;
        $change->last_name                = $request->last_name;
        $change->city                     = $request->city;
        $change->state                    = $request->state;
        $change->age                      = $request->age;
        $change->about                    = $request->about;
        $change->contact                  = $request->contact;
        $change->profession               = $request->profession;
        $change->country                  = $request->country;
        $change->gender                   = $request->gender;
        $change->company                  = $request->company;
        $change->position                 = $request->position;
        $change->expert_in                = $request->expert_in;
        $change->gender                   = $request->gender;
        $change->how_you_heardabout_event = $request->how_you_heardabout_event;
        $change->event_id                 = $request->event_id;
        $change->user_id                  = $request->user()->id;
        if ($request->hasFile('profile_image')) {
          $image  = $request->file('profile_image')->store('public/images');
          $change->profile_image = str_replace('public/images','',$image);
        }
        $change->save();
        if ($change) {    //to update the user name both from attendee and user tables
         $userChange = User::where('id',$change->user->id)->first();
          $userChange->name = $change->first_name;
          $userChange->save();
        }
         return redirect()->action('AttendeeController@index',['id'=>$id]);
      }
      else {
        return response()->json(['message'=>'record does not exists to update','status'=>404]);
      }
    }
    elseif ($user->hasRole('organiser') && $user->can('update')) {
      $organiserUpdate  = Organiser::findOrFail($id);
      if ($organiserUpdate) {
        $organise  = $request->all();
        $organiserUpdate->fill($organise)->save();
        $organiserUpdate->save();
        return redirect()->action('AttendeeController@index',['id'=>$id]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied','status'=>403]);
    }
  }
}
