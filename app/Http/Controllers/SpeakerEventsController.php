<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\SpeakerEventsTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\SpeakerEvents;
use App\Speaker;
use App\User;
use Validator;

class SpeakerEventsController extends Controller
{
  public function index(Manager $fractal, SpeakerEventsTransformer $SpeakerEventsTransformer,Request $request)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->ability(array('speaker'),array('read'))) {
      $display      = SpeakerEvents::all();
      $colelction   = new Collection($display,$SpeakerEventsTransformer);
      return $data  = $fractal->createData($colelction)->toArray();
    }
    else {
      return response()->json(['message'=>'Permission Denied!!!','status'=>403]);
    }
  }
  public function show(Manager $fractal, SpeakerEventsTransformer $SpeakerEventsTransformer,$id,Request $request)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->ability(array('speaker'),array('read'))) {
      $showById      = SpeakerEvents::where('id',$id)->first();
      $item   = new Item($showById,$SpeakerEventsTransformer);
      return $data  = $fractal->createData($item)->toArray();
    }
    else {
      return response()->json(['message'=>'Permission Denied!!!','status'=>403]);
    }
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(),[
      'event_name'      => 'required',
      'date'            => 'required',
      'venue_name'      => 'required',
      'participants'    => 'required',
    ]);
    if ($validator->fails()) {
            return $validator->errors()->all();
        }
    //return $user = $request->user();
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['speaker']) && $user->can('create')) {
      $add  = new SpeakerEvents;
      $add->event_name  = $request->event_name;
      $add->date        = $request->date;
      $add->venue_name  = $request->venue_name;
      $add->duration    = $request->duration;
      $add->category    = $request->category;
      $add->description = $request->description;
      $add->awards      = $request->awards;
      $add->oraganiser  = $request->oraganiser;
      $add->participants = $request->participants;
      $add->images      = $request->images;
      $add->speaker_id  = $request->speaker_id;
      $add->save();
      return response()->json(['OK'=>'data stored Successfully','status'=>200]);
    }
    else {
      return response()->json(['OK'=>'Permission Denied!!!','status'=>403]);
    }
  }

  public function update(Request $request,$id)
  {
    $validator = Validator::make($request->all(),[
      'event_name'      => 'required',
      'date'            => 'required',
      'venue_name'      => 'required',
      'participants'    => 'required',
    ]);
    if ($validator->fails()) {
            return $validator->errors()->all();
        }
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['speaker']) && $user->can('update')) {
      $change =SpeakerEvents::where('id',$id)->first();
      if ($change) {
        $change->event_name  = $request->event_name;
        $change->date        = $request->date;
        $change->venue_name  = $request->venue_name;
        $change->duration    = $request->duration;
        $change->category    = $request->category;
        $change->description = $request->description;
        $change->awards      = $request->awards;
        $change->oraganiser  = $request->oraganiser;
        $change->participants= $request->participants;
        $change->images      = $request->images;
        $change->speaker_id  = $request->speaker_id;
        $change->save();
        // if ($change) {
        //   $modify = SpeakerSession::where('speaker_id',$change->id)->first();
        //   $modify->session_name  = $request->session_name;
        //   $modify->date          = $request->date;
        //   $modify->session_place	= $request->session_place	;
        //   $modify->description   = $request->description;
        //   $modify->save();
        // }
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
    if ($user->hasRole(['speaker','organiser','admin','agency']) && $user->can('create')) {
      $remove =SpeakerEvents::where('id',$id)->first();
      if ($remove) {
        $remove->delete();
        return response()->json(['Ok'=>'record is deleted','status'=>200]);
      }
      else {
        return response()->json(['message'=>'record does not exists to delete','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied!!!','status'=>403]);
    }
  }
}
