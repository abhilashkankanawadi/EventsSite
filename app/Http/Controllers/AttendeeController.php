<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item; 
use App\Transformers\AttendeeTransformer;
use App\Attendee;
use App\Event;
use App\User;
use App\Speaker;
use App\AttendeeFollow;
use Auth;
use App\AttendeesNotes;
use Validator;
use App\Event_User;
use App\MeetingRequest;
use Illuminate\Support\Facades\Input;

class AttendeeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index($id)
  {
    $Attendees      = Attendee::simplePaginate(7);
    return view('Attendee',['Attendees'=>$Attendees,'id'=>$id]);
  }

  public function show($id)
  {
    // $user = User::where('id',Auth::user()->id)->first();
    // if ($user->hasRole(['attendee','speaker'])) {
      $followCount  = AttendeeFollow::where('user_id',Auth::user()->id)->first();
      $Attendees  = Attendee::where('event_id',$id)->where('user_id','!=',Auth::user()->id)->OrderBy('first_name','ASC')->simplePaginate(3);
      return view('Attendee',['Attendees'=>$Attendees,'followCount'=>$followCount,'id'=>$id]);
    // }
    // else {
    //   return "Permission Denied";
    // }
  }

  public function store(Request $request)
  {
    $user = User::where('id','=',$request->user()->id)->first();
    //return $user;
    if ($user->hasRole(['attendee','organiser']) && $user->can('create')) {
      $validator = Validator::make($request->all(),[
        'first_name' => 'required',
        'city'       => 'required',
        'state'      => 'required',
        'country'    => 'required',
        'company'    => 'required',
        'contact'    => 'required|unique:attendees',
        'position'   => 'required',
        'gender'     => 'required',
        'how_you_heardabout_event'=>'required',
        'profile_image'=>'image|mimes:jpg,png,gif,jpeg|max:2048|dimensions:max_width=1000,max_height=1000',
      ]);
      if ($validator->fails()) {
              return $validator->errors()->all();
          }
      $add  = new Attendee;
      $add->first_name               = $request->first_name;
      $add->last_name                = $request->last_name;
      $add->city                     = $request->city;
      $add->state                    = $request->state;
      $add->age                      = $request->age;
      $add->about                    = $request->about;
      $add->contact                  = $request->contact;
      $add->profession               = $request->profession;
      $add->country                  = $request->country;
      $add->gender                   = $request->gender;
      $add->company                  = $request->company;
      $add->position                 = $request->position;
      $add->expert_in                = $request->expert_in;
      if ($request->hasFile('profile_image')) {
        $image  = $request->file('profile_image')->store('public/images');
        $add->profile_image = str_replace('public/images','',$image);
      }
      $add->how_you_heardabout_event = $request->how_you_heardabout_event;
      $add->event_id                 = 1;
      $add->user_id                  = $request->user()->id;
      $add->save();
      return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>'200']);
    }
    else {
      return response()->json(['OK'=>'Permission Denied!!!','status'=>403]); 
    }
  }
  public function edit($id)
  {
    $user = User::where('id',$id)->first();
    if($user->hasRole(['attendee'])) {
      $modify = Attendee::where('user_id',$id)->first();
      return view('attendee.AttendeeUpdate',['modify'=>$modify,'id'=>$id]);
  }
}

  public function update(Request $request,$id)
  {
    $user=User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['attendee','organiser','agency','admin']) && $user->can('update')) {
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
        if($change)//adding event_is&user_id in event_users pivot table
        {
          $pivot  = new Event_User;
          $pivot->event_id  = $request->event_id;
          $pivot->user_id   = $request->user()->id;
          $pivot->save();
        }
         return redirect()->action('AttendeeController@index',['id'=>$id]);
      }
      else {
        return response()->json(['message'=>'record does not exists to update','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied','status'=>403]);
    }
  }

  public function notification($id)
  {
    $notifications  = MeetingRequest::where('request_to',$id)->get();
    return view('attendee.AttendeeNotification',['notifications'=>$notifications,'id'=>$id]);
  }

  public function notificationStatus(Request $request,$id)
  {
     $test = MeetingRequest::where('id',$id)->first();
   if ($test) {
     $test->deligateAccept_status = 1;
    $test->save();
    
   }
    return redirect()->back();
  }

  public function deleteNotification(Request $request,$id)
  {
     $findId  = MeetingRequest::where('request_to',$id)->first();
    if ($findId) {
     $findId->deligateAccept_status =2;
     $findId->save();
     $findId->delete(); //using soft delete. Data will be there in database
     return redirect()->back();
   }
  }

  public function delete(Request $request,$id)
  {
    $user=User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['admin','agency','organiser','attendee']) && $user->can('delete')) {
      $remove =Attendee::where('id',$id)->first();
      if ($remove) {
        $remove->delete();
        return response()->json(['Ok'=>'record is deleted','status'=>200]);
      }
      else {
        return response()->json(['message'=>'record does not exists to delete','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied','status'=>403]);
    }
  }
}
