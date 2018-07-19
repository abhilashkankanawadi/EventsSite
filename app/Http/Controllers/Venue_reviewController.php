<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Transformers\Venue_reviewTransformer;
use App\Venue_Review;
use App\Attendee;
use Validator;
use App\User;

class Venue_reviewController extends Controller
{
  public function index(Manager $fractal, Venue_reviewTransformer $Venue_reviewTransformer)
  {
    $display      = Venue_Review::all();
    $colelction   = new Collection($display,$Venue_reviewTransformer);
    return $data  = $fractal->createData($colelction)->toArray();
  }
  public function show(Manager $fractal, Venue_reviewTransformer $Venue_reviewTransformer,$id)
  {
    $showById=Venue_Review::where('id',$id)->first();
    if ($showById) {
      $item        = new Item($showById,$Venue_reviewTransformer);
      return $data = $fractal->createData($item)->toArray();
    }
    else {
      return response()->json(['message'=>'record does not exists','status'=>404]);
    }
  }
  public function store(Request $request)
  {
    // $validator = Validator::make($request->all(),[
    //   'venue_name'          => 'title',
    //   'address'             => 'review',
    // ]);
    // if ($validator->fails()) {
    //         return $validator->errors()->all();
    //     }
    $user = User::where('id',$request->user()->id)->first();
    //return $request->user()->name;
    if ($user->hasRole(['attendee']) && $user->can('create')) {
      $add  =new Venue_Review;
      $add->title         = $request->title;
      $add->review        = $request->review;
      $add->food          = $request->food;
      $add->beverage      = $request->beverage;
      $add->ambience      = $request->ambience;
      $add->service       = $request->service;
      $add->crowd         = $request->crowd;
      $add->attendee_id   = $request->attendee_id;
      $add->event_id      = $request->event_id;
      $add->venue_id      = $request->venue_id;
      $add->save();
      return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>200]);
    }
    else {
      return response()->json(['message'=>'Permission Denied!!!','status'=>403]);
    }
  }
  public function update(Request $request,$id)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['attendee']) && $user->can('update')) {
      $change   = Venue_Review::where('id',$id)->first();
      if ($change) {
        $change->title         = $request->title;
        $change->review        = $request->review;
        $change->food          = $request->food;
        $change->beverage      = $request->beverage;
        $change->ambience      = $request->ambience;
        $change->service       = $request->service;
        $change->crowd         = $request->crowd;
        $change->attendee_id   = $request->attendee_id;
        $change->venue_id      = $request->venue_id;
        $change->event_id      = $request->event_id;
        $change->save();
        return response()->json(['OK'=>'Values are Updated Successfully!!!','status'=>'200']);
      }
      else {
          return response()->json(['message'=>'record does not exists to update','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied!!!','status'=>403]);
    }
  }
  public function delete(Request $request,$id)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['organiser','admin','agency','attendee']) && $user->can('delete')) {
      $remove = Venue_Review::where('id',$id)->first();
      if ($remove) {
        $remove->delete();
        return response()->json(['Ok'=>'record is deleted','status'=>200]);
      }
      else {
        return response()->json(['Message'=>'record does not exists to delete','status'=>404]);
      }
    }
    else {
      return response()->json(['Message'=>'Permission Denied','status'=>403]);
    }
  }
}
