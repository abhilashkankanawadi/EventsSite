<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Speaker;
use App\User;
use App\SpeakerSession;
use App\SpeakersNotes;
use Validator;
use App\Event_User;
use Auth;

class SpeakerController extends Controller
{
  public function index(Manager $fractal, SpeakerTransformer $SpeakerTransformer,Request $request)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->ability(array('organiser','speaker'),array('create'))) {
      $display      = Speaker::all();
      $colelction   = new Collection($display,$SpeakerTransformer);
      return $data  = $fractal->createData($colelction)->toArray();
    }
    else {
      return response()->json(['OK'=>'Permission Denied!!!','status'=>'350']);
    }
  }
  public function show($id)
  {
    $user = User::where('id',Auth::user()->id)->first();
    if ($user->hasRole(['speaker','attendee','admin','organiser'])) {
      $showSpeaker  = Speaker::where('event_id',$id)->paginate(5);
      return view('speaker.Speakers',['showSpeaker'=>$showSpeaker,'id'=>$id]);
    }
    elseif (!($user->hasRole(['speaker']))) {
      return response()->json(['OK'=>'Permission Denied!!!','status'=>'350']);
    }
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(),[
      'first_name'      => 'required',
      'last_name'       => 'required',
      'city'            => 'required',
      'state'           => 'required',
      'about'           => 'required',
      'gender'          => 'required',
      'company_name'    => 'required',
      'position'        => 'required',
      'profession'      => 'required',
      'contact'         => 'required|unique:speakers',
      'country'         => 'required',
      'exp_in_industry' => 'required',
      'events_attended' => 'required|numeric',
      'images'          => 'image|mimes:jpg,png,gif,jpeg|max:2048|dimensions:max_width=800,max_height=800',
    ]);
    if ($validator->fails()) {
            return $validator->errors()->all();
        }
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['speaker']) && $user->can('create')) {
      $add                      = new Speaker;
      $add->first_name          = $request->first_name;
      $add->last_name           = $request->last_name;
      $add->profession          = $request->profession;
      $add->age                 = $request->age;
      $add->city                = $request->city;
      $add->state               = $request->state;
      $add->gender              = $request->gender;
      $add->address             = $request->address;
      $add->expert_in           = $request->expert_in;
      $add->country             = $request->country;
      $add->contact             = $request->contact;
      $add->about               = $request->about;
      $add->company_name        = $request->company_name;
      $add->position            = $request->position;
      $add->language            = $request->language;
      $add->ventures            = $request->ventures;
      $add->awards              = $request->awards;
      $add->events_attended     = $request->events_attended;
      $add->recognitions        = $request->recognitions;
      $add->exp_in_industry     = $request->exp_in_industry;
      if ($request->hasFile('profile_image')) {
        $image  = $request->file('profile_image')->store('public\images');
        $add->profile_image = str_replace('public\images','',$image);
      }
      $add->user_id             = $request->user()->id;
      $add->save();
      // if ($add) {
      //   $session = new SpeakerSession;
      //   $session->session_name  = $request->session_name;
      //   $session->date          = $request->date;
      //   $session->session_place	= $request->session_place	;
      //   $session->description   = $request->description;
      //   $session->speaker_id    = $add->id;
      //   $session->save();
      // }
      // if ($add) {
      //   $note= new SpeakersNotes;
      //   $note->title        =$request->title;
      //   $note->note  =$request->note;
      //   $note->speaker_id   =$add->id;
      //   $note->save();
      // }
      return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>200]);
    }
    else {
      return response()->json(['OK'=>'Permission Denied!!!','status'=>403]);
    }
  }
  public function update(Request $request,$id)
  {
   $user = User::where('id',Auth::user()->id)->first();
    if ($user->hasRole(['speaker']) && $user->can('update')) {
      $speakUpdate  = Speaker::findOrFail($id);
      if ($speakUpdate) {
        $speak  = $request->all();
         $speakUpdate->fill($speak)->save();
         if ($request->hasFile('profile_image')) {
           $image  = $request->file('profile_image')->store('public/images');
           $speakUpdate->profile_image = str_replace('public/images','',$image);
           $speakUpdate->save();

         }
         if ($speakUpdate) {
           $pivot = new Event_User;
           $pivot->event_id = $speakUpdate->event_id;
           $pivot->user_id  = Auth::user()->id;
           $pivot->save();
         }
         return redirect()->action('EventsController@index');
      }
    }
    else {
      return "permission denied";
    }
  }
  public function delete(Request $request,$id)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['speaker','admin','agency','organiser']) && $user->can('delete')) {
      $remove =Speaker::where('id',$id)->first();
      if ($remove) {
        $remove->delete();
        return response()->json(['Ok'=>'record is deleted','status'=>200]);
      }
      else {
        return response()->json(['message'=>'record does not exists to delete','status'=>404]);
      }
    }
    else {
      return response()->json(['OK'=>'Permission Denied!!!','status'=>403]);
    }
  }
}
