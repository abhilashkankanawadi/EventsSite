<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\AttendeeActivityTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Attendee_activity;
use App\User;
use Auth;
use Validator;

class AttendeeActivityController extends Controller
{
  public function index(Manager $fractal, AttendeeActivityTransformer $AttendeeActivityTransformer)
  {
    $dispAll = Attendee_activity::all();
    $collection = new Collection($dispAll,$AttendeeActivityTransformer);
    return $data= $fractal->createData($collection)->toArray();
  }
  public function show(Manager $fractal, AttendeeActivityTransformer $AttendeeActivityTransformer,$id)
  {
    $showById   = Attendee_activity::where('id',$id)->first();
    if ($showById) {
      $item       = new Item($showById,$AttendeeActivityTransformer);
      return $data= $fractal->createData($item)->toArray();
    }
    else {
      return response()->json(['message'=>'Id Does not exist','status'=>404]);
    }
  }
  public function store(Request $request)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['attendee']) && $user->can('create')) {
      $validator  = Validator::make($request->all(),[
        'activity_name' =>  'required',
        'hosted_by'     =>  'required',
        'category'      =>  'required',
        'place'         =>  'required',
        'state'         =>  'required',
        'start_date'    =>  'required',
        'end_date'      =>  'required',
        'participants'  =>  'required|numeric',
        'description'   =>  'required',
        'venue_id'      =>  'required',
        'attendee_id'   =>  'required',
        'images'        => 'image|mimes:jpg,png,gif,jpeg|max:2048|dimensions:max_width=800,max_height=800',
        'videos'        => 'required|mimes:mp4,avi,wmv,ogx,oga,ogv,ogg,webm,3gp,flv|max:4096',
      ]);
      if ($validator->fails()) {
        return $validator->errors()->all();
      }
      $add = new Attendee_activity;
      $add->activity_name = $request->activity_name;
      $add->hosted_by     = $request->hosted_by;
      $add->description   = $request->description;
      $add->category      = $request->category;
      $add->place         = $request->place;
      $add->state         = $request->state;
      $add->country       = $request->country;
      $add->start_date    = $request->start_date;
      $add->end_date      = $request->end_date;
      $add->participants  = $request->participants;
      if ($request->hasFile('images')) {
        $image = $request->file('images')->store('public/images');
             $add->images = str_replace('public/images/','',$image);
      }
      if ($request->hasFile('videos')) {
        $vids = $request->file('videos')->store('public/videos');
             $add->videos = str_replace('public/videos/','',$vids);
      }
      $add->venue_id      = $request->venue_id;
      $add->attendee_id   = $request->attendee_id;
      $add->save();
      return response()->json(['OK'=>'data Stored Successfully','status'=>200]);
    }
    else {
      return response()->json(['message'=>'Permission Dinied','status'=>403]);
    }
  }

  public function update(Request $request,$id)
  {

    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['attendee']) && $user->can('create')) {
      $validator  = Validator::make($request->all(),[
        'activity_name' =>  'required',
        'hosted_by'     =>  'required',
        'category'      =>  'required',
        'place'         =>  'required',
        'state'         =>  'required',
        'start_date'    =>  'required',
        'end_date'      =>  'required',
        'participants'  =>  'required',
        'description'   =>  'required',
        'venue_id'      =>  'required',
        'attendee_id'   =>  'required',
      ]);
      if ($validator->fails()) {
        return $validator->errors()->all();
      }
      $edit   = Attendee_activity::where('id',$id)->first();
      if ($edit) {
        $edit->activity_name = $request->activity_name;
        $edit->hosted_by     = $request->hosted_by;
        $edit->description   = $request->description;
        $edit->category      = $request->category;
        $edit->place         = $request->place;
        $edit->state         = $request->state;
        $edit->country       = $request->country;
        $edit->start_date    = $request->start_date;
        $edit->end_date      = $request->end_date;
        $edit->participants  = $request->participants;
        $edit->venue_id      = $request->venue_id;
        $edit->attendee_id   = $request->attendee_id;
        $edit->save();
        return response()->json(['OK'=>'data updated Successfully','status'=>200]);
      }
      else {
        return response()->json(['message'=>'data does not exist','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Dinied','status'=>403]);
    }
  }
  public function delete(Request $request,$id)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['attendee','admin','organiser']) && $user->can('create')) {
      $remove   = Attendee_activity::where('id',$id)->first();
      if ($remove) {
        $remove->delete();
        return response()->json(['OK'=>'data deleted Successfully','status'=>200]);
      }
      else {
        return response()->json(['message'=>'data data does not exist','status'=>200]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Dinied','status'=>403]);
    }
  }
}
