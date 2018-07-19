<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\ReviewTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Review;
use validator;
class ReviewController extends Controller
{
  public function index(Manager $fractal, ReviewTransformer $ReviewTransformer)
  {
    $display      = Review::all();
    $colelction   = new Collection($display,$ReviewTransformer);
    return $data  = $fractal->createData($colelction)->toArray();
  }
  public function show(Manager $fractal, ReviewTransformer $ReviewTransformer,$id)
  {
    $showById=Review::where('id',$id)->first();
    if ($showById) {
      $item        = new Item($showById,$ReviewTransformer);
      return $data = $fractal->createData($item)->toArray();
    }
    else {
      return response()->json(['message'=>'record does not exists','status'=>404]);
    }
  }
  public function store(Request $request)
  {
    // $this->validate($request,[
    //   'event' =>'required',
    //   'event_name'  =>'required',
    //   'email'       =>'required|email|unique:public_reviews',
    //   'rating'      =>'required'
    // ]);
    // return $validator->errors()->all();

    $add                 = new Review;
    $add->event          = $request->venue;
    $add->venue          = $request->venue;
    $add->organiser      = $request->organiser;
    $add->speaker        = $request->speaker;
    $add->attendee_id    = $request->attendee_id;
    $add->save();
    return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>'200']);
  }
  public function update(Request $request,$id)
  {
    $change =Review::where('id',$id)->first();
    if ($change) {
      $change->public_name   = $request->public_name;
      $change->event_name    = $request->event_name;
      $change->email         = $request->email;
      $change->rating        = $request->rating;
      $change->save();
      return response()->json(['OK'=>'Values are Updated Successfully!!!','status'=>'200']);
    }
    else {
      return response()->json(['message'=>'record does not exists to update','status'=>404]);
    }
  }
  public function delete($id)
  {
    $remove =Review::where('id',$id)->first();
    if ($remove) {
      $remove->delete();
      return response()->json(['Ok'=>'record is deleted','status'=>200]);
    }
    else {
      return response()->json(['message'=>'record does not exists to delete','status'=>404]);
    }
  }
}
