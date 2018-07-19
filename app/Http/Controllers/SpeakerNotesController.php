<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\SpeakersNotesTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\SpeakersNotes;
use App\User;
use Validator;

class SpeakerNotesController extends Controller
{
  public function index(Manager $fractal, SpeakersNotesTransformer $SpeakersNotesTransformer)
  {
    $display      = SpeakersNotes::all();
    $colelction   = new Collection($display,$SpeakersNotesTransformer);
    return $data  = $fractal->createData($colelction)->toArray();
  }
  public function show(Manager $fractal, SpeakersNotesTransformer $SpeakersNotesTransformer,$id)
  {
    $showById=SpeakersNotes::where('id',$id)->first();
    if ($showById) {
      $item        = new Item($showById,$SpeakersNotesTransformer);
      return $data = $fractal->createData($item)->toArray();
    }
    else {
      return response()->json(['message'=>'record does not exists','status'=>404]);
    }
  }
  public function store(Request $request)
  {
    // $validator = Validator::make($request->all(),[
    //   'title'   => 'required',
    //   'note'    => 'required',
    // ]);
    // if ($validator->fails()) {
    //         return $validator->errors()->all();
    //     }
      $user = User::where('id',$request->user()->id)->first();
      if ($user->hasRole(['speaker','attendee','organiser']) && $user->can('create')) {
        $add = new SpeakersNotes;
        $add->title       = $request->title;
        $add->note        = $request->note;
        $add->speaker_id  = $request->speaker_id;
        $add->save();
        return view('SpeakerProfile');
      }
      else {
        return response()->json(['message'=>'Permission Denied!!','status'=>403]);
      }
  }
  public function update(Request $request,$id)
  {
    $validator = Validator::make($request->all(),[
      'title'   => 'required',
      'note'    => 'required',
    ]);
    if ($validator->fails()) {
            return $validator->errors()->all();
        }
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['speaker']) && $user->can('create')) {
      $change=SpeakersNotes::where('id',$id)->first();
      if ($change) {
        $change->title       = $request->title;
        $change->note        = $request->note;
        $change->speaker_id  = $request->speaker_id;
        $change->save();
        return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>'200']);
      }
      else {
        return response()->json(['message'=>'record does not exist','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied!!','status'=>403]);
    }
  }
  public function delete(Request $request,$id)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['speaker','organiser','admin','agency']) && $user->can('create')) {
      $remove=SpeakersNotes::where('id',$id)->first();
      if ($remove) {
        $remove->delete();
        return response()->json(['OK'=>'Record Deleted Successfully!!!','status'=>'200']);
      }
      else {
        return response()->json(['message'=>'Record does not exist to delete','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied!!','status'=>403]);
    }
  }
}
