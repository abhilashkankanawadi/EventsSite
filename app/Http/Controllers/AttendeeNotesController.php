<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\AttendeesNotesTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\AttendeesNotes;
use App\User;
use Validator;

class AttendeeNotesController extends Controller
{
  public function index(Manager $fractal, AttendeesNotesTransformer $AttendeesNotesTransformer)
  {
    $display      = AttendeesNotes::all();
    $colelction   = new Collection($display,$AttendeesNotesTransformer);
    return $data  = $fractal->createData($colelction)->toArray();
  }
  public function show(Manager $fractal, AttendeesNotesTransformer $AttendeesNotesTransformer,$id)
  {
    $showById=AttendeesNotes::where('id',$id)->first();
    if ($showById) {
      $item        = new Item($showById,$AttendeesNotesTransformer);
      return $data = $fractal->createData($item)->toArray();
    }
    else {
      return response()->json(['message'=>'record does not exists','status'=>404]);
    }
  }
  public function store(Request $request)
  {
    $validator  = Validator::make($request->all(),[
      'title'         =>  'required',
      'description'   =>  'required',
    ]);
    if ($validator->fails()) {
      return $validator->errors()->all();
    }
    //$user = $request->user();
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['attendee']) && $user->can('create')) {
      $add = new AttendeesNotes;
      $add->title           = $request->title;
      $add->description     = $request->description;
      $add->attendee_id     = $request->attendee_id;
      $add->save();
      return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>'200']);
    }
    else {
      return response()->json(['OK'=>'Permission Denied!!!','status'=>403]);
    }
  }
  public function update(Request $request,$id)
  {
    $validator  = Validator::make($request->all(),[
      'title'         =>  'required',
      'description'   =>  'required',
    ]);
    if ($validator->fails()) {
      return $validator->errors()->all();
    }
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['attendee']) && $user->can('update')) {
      $change=AttendeesNotes::where('id',$id)->first();
      if ($change) {
        $change->title        = $request->title;
        $change->description  = $request->description;
        $change->attendee_id  = $request->attendee_id;
        $change->save();
        return response()->json(['OK'=>'Values are Updated Successfully!!!','status'=>'200']);
      }
      else {
        return response()->json(['message'=>'record does not exist','status'=>404]);
      }
    }
    else {
      return response()->json(['OK'=>'Permission Denied!!!','status'=>403]);
    }
  }
  public function delete(Request $request,$id)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['attendee','admin','organiser','agency']) && $user->can('delete')) {
      $remove=AttendeesNotes::where('id',$id)->first();
      if ($remove) {
        $remove->delete();
        return response()->json(['OK'=>'Record Deleted Successfully!!!','status'=>'200']);
      }
      else {
        return response()->json(['message'=>'Record does not exist to delete','status'=>404]);
      }
    }
    else {
      return response()->json(['OK'=>'Permission Denied!!!','status'=>403]);
    }
  }
}
