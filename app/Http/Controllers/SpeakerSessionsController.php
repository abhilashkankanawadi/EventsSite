<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\SpeakerSessionsTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\SpeakerSession;
use Validator;
use App\User;

class SpeakerSessionsController extends Controller
{
  public function index(Manager $fractal,SpeakerSessionsTransformer $SpeakerSessionsTransformer)
  {
    $show = SpeakerSession::all();
    $collection = new Collection($show,$SpeakerSessionsTransformer);
    return $data = $fractal->createData($collection)->toArray();
  }
  public function show(Manager $fractal,SpeakerSessionsTransformer $SpeakerSessionsTransformer, $id)
  {
    $showById =SpeakerSession::where('id',$id);
    if ($showById) {
      $item   = new Item($showById,$SpeakerSessionsTransformer);
      return $data  = $fractal->createData($item)->toArray();
    }
    else {
      return response()->json(['message'=>'record does not exists','status'=>404]);
    }
  }
  public function store(Request $request)
  {
    $user   = User::where('id',$request->user()->id)->first();
    if ($user->hasRole('speaker') && $user->can('create')) {
      //return $request->user()->name;
      $validator = Validator::make($request->all(),[
        'event_name'  => 'required',
        'description' => 'required',
        'country'     => 'required',
        'city'        => 'required',
        'venue'       => 'required',
      ]);
      if ($validator->fails()) {
              return $validator->errors()->all();
          }
      $add    = new SpeakerSession;
      $add->event_name  = $request->event_name;
      $add->category    = $request->category;
      $add->start_time  = $request->start_time;
      $add->end_time    = $request->end_time;
      $add->start_date  = $request->start_date;
      $add->end_date    = $request->end_date;
      $add->highlights  = $request->highlights;
      $add->description = $request->description;
      $add->country     = $request->country;
      $add->city        = $request->city;
      $add->venue       = $request->venue;
      $add->venue_id    = $request->venue_id;
      $add->speaker_id  = $request->speaker_id;
      $add->save();
      return response()->json(['OK'=>'data saved Successfully','status'=>200]);
    }
    else {
      return response()->json(['message'=>'permission denied!!','status'=>401]);
    }
  }
  public function update(Request $request,$id)
  {
    $user   = User::where('id',$request->user()->id)->first();
    if ($user->hasRole('speaker','admin','agency','organiser') && $user->can('update')) {
      $validator = Validator::make($request->all(),[
        'event_name'  => 'required',
        'description' => 'required',
        'country'     => 'required',
        'city'        => 'required',
        'venue'       => 'required',
      ]);
      if ($validator->fails()) {
              return $validator->errors()->all();
          }
      $change = SpeakerSession::where('id',$id)->first();
      if ($change) {
        $change->event_name    =    $request->event_name;
        $change->category      =    $request->category;
        $change->start_time    =    $request->start_time;
        $change->end_time      =    $request->end_time;
        $change->start_date    =    $request->start_date;
        $change->end_date      =    $request->end_date;
        $change->highlights    =    $request->highlights;
        $change->description   =    $request->description;
        $change->country       =    $request->country;
        $change->city          =    $request->city;
        $change->venue         =    $request->venue;
        $change->venue_id      =    $request->venue_id;
        $change->speaker_id    =    $request->speaker_id;
        $change->save();
        return response()->json(['OK'=>'Values are Updated Successfully!!!','status'=>200]);
      }
      else {
        return response()->json(['message'=>'record does not exists to update','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'permission denied!!']);
    }
  }
  public function delete(Request $request,$id)
  {
    $user   = User::where('id',$request->user()->id)->first();
    if ($user->hasRole('speaker','admin','agency','organiser') && $user->can('create')) {
      $remove   = SpeakerSession::where('id',$id)->first();
      if ($remove) {
        $remove->delete();
        return response()->json(['OK'=>'Record Deleted Successfully!','status'=>200]);
      }
      else {
        return response()->json(['OK'=>'Record Does not exists','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'permission denied!!']);
    }
  }
}
