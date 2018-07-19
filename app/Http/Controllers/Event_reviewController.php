<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Transformers\Event_ReviewTransformer;
use App\Event_Review;
use App\Attendee;
use Validator;
use App\User;

class Event_reviewController extends Controller
{
  public function index(Manager $fractal, Event_ReviewTransformer $Event_ReviewTransformer)
  {
    $display      = Event_Review::all();
    $colelction   = new Collection($display,$Event_ReviewTransformer);
    return $data  = $fractal->createData($colelction)->toArray();
  }
  public function show(Manager $fractal, Event_ReviewTransformer $Event_ReviewTransformer,$id)
  {
    $showById=Event_Review::where('id',$id)->first();
    if ($showById) {
      $item        = new Item($showById,$Event_ReviewTransformer);
      return $data = $fractal->createData($item)->toArray();
    }
    else {
      return response()->json(['message'=>'record does not exists','status'=>404]);
    }
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(),[
      'title'   => 'required',
      'review'       => 'required',
      'speaker'       => 'required',
      'crowd'         => 'required',
    ]);
    if ($validator->fails()) {
            return $validator->errors()->all();
        }
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['attendee']) && $user->can('create')) {
      $add  = new Event_Review;
      $add->title       =$request->title;
      $add->review      =$request->review;
      $add->speaker     =$request->speaker;
      $add->crowd       =$request->crowd;
      $add->event_id    =$request->event_id;
      $add->attendee_id =$request->attendee_id;
      $add->save();
      return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>200]);
    }
    else {
      return response()->json(['message'=>'Permission Denied','status'=>403]);
    }
  }
  public function update(Request $request,$id)
  {
    $validator = Validator::make($request->all(),[
      'title'       => 'required',
      'review'      => 'required',
      'speaker'     => 'required',
      'crowd'       => 'required',
    ]);
    if ($validator->fails()) {
            return $validator->errors()->all();
        }
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['attendee']) && $user->can('update')) {
      $change = Event_Review::where('id',$id)->first();
      if ($change) {
        $change->title       =  $request->title;
        $change->review      =  $request->review;
        $change->speaker     =  $request->speaker;
        $change->crowd       =  $request->crowd;
        $change->event_id    =  $request->event_id;
        $change->attendee_id =  $request->attendee_id;
        $change->save();
        return response()->json(['OK'=>'Values are Updated Successfully!!!','status'=>200]);
      }
      else {
        return response()->json(['Message'=>'Id does not exists','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied','status'=>403]);
    }
  }

  public function delete(Request $request,$id)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['attendee']) && $user->can('delete')) {
      $remove = Event_Review::where('id',$id)->first();
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
