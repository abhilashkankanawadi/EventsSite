<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\OrganiserTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item; 
use App\Organiser;
use App\MeetingRequest;
use Validator;
use App\User;
use App\Attendee;

class OrganiserController extends Controller
{
  public function index(Manager $fractal, OrganiserTransformer $OrganiserTransformer)
  {
    $display      = Organiser::all();
    $colelction   = new Collection($display,$OrganiserTransformer);
    return $data  = $fractal->createData($colelction)->toArray();
  }
  public function show($id)
  {
     $Notifications  = MeetingRequest::orderBy('created_at','DESC')->get();
     return view('Organiser.Organisers',['Notifications'=>$Notifications,'id'=>$id]);
  }
  public function store(Request $request) 
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['organiser']) && $user->can('create')) {
      $validator = Validator::make($request->all(),[
        'first_name'    => 'required',
        'last_name'     => 'required',
        'contact'       => 'required|unique:organisers',
        'city'          => 'required',
        'state'         => 'required',
        'address'       => 'required',
        'gender'        => 'required',
        'age'           => 'required',
        'country'       => 'required',
        'about'         => 'required',
        'experience'    => 'required',
        'events_organized'=> 'required',
        'profile_image' =>'image|mimes:jpg,png,gif,jpeg|max:2048|dimensions:max_width=800,max_height=800',
        'company_name'  => 'required',
        'event_brands'  => 'required',
      ]);
      if ($validator->fails()) {
              return $validator->errors()->all();
          }

      $add                    = new Organiser;
      $add->first_name        = $request->first_name;
      $add->last_name         = $request->last_name;
      $add->city              = $request->city;
      $add->state             = $request->state;
      $add->contact           = $request->contact;
      $add->address           = $request->address;
      $add->gender            = $request->gender;
      $add->age               = $request->age;
      $add->country           = $request->country;
      $add->about             = $request->about;
      $add->experience        = $request->experience;
      $add->events_organized  = $request->events_organized;
      $add->achievements	    = $request->achievements	;
      $add->company_name      = $request->company_name;
      $add->event_brands      = $request->event_brands;
      if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image')->store('public/images');
             $add->profile_image = str_replace('public/images/','',$image);
      }
      $add->agency_id         = $request->agency_id;
      $add->user_id           = $request->user()->id;
      $add->save();
      return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>'200']);
    }
    else {
      return response()->json(['message'=>'Permission Denied','status'=>403]);
    }
  }
  public function update(Request $request,$id)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['organiser','agency','admin']) && $user->can('update')) {
      $validator = Validator::make($request->all(),[
        'first_name'    => 'required',
        'last_name'     => 'required',
        'contact'       => 'required|unique:organisers',
        'city'          => 'required',
        'state'         => 'required',
        'address'       => 'required',
        'gender'        => 'required',
        'age'           => 'required',
        'country'       => 'required',
        'about'         => 'required',
        'experience'    => 'required',
        'events_organized'=> 'required',
        'company_name'  => 'required',
        'event_brands'  => 'required',
      ]);
      if ($validator->fails()) {
              return $validator->errors()->all();
          }
      $change =Organiser::where('id',$id)->first();
      if ($change) {
        $change->first_name        = $request->first_name;
        $change->last_name         = $request->last_name;
        $change->city              = $request->city;
        $change->state             = $request->state;
        $change->contact           = $request->contact;
        $change->address           = $request->address;
        $change->gender            = $request->gender;
        $change->age               = $request->age;
        $change->country           = $request->country;
        $change->about             = $request->about;
        $change->experience        = $request->experience;
        $change->events_organized  = $request->events_organized;
        $change->achievements	     = $request->achievements	;
        $change->company_name      = $request->company_name;
        $change->event_brands      = $request->event_brands;
        if ($request->hasFile('profile_image')) {
          $image = $request->file('profile_image')->store('public/images');
               $add->images = str_replace('public/images/','',$image);
        }
        $change->agency_id         = $request->agency_id;
        $change->user_id           = $request->user()->id;
        $change->save();
        return response()->json(['OK'=>'Values are Updated Successfully!!!','status'=>'200']);
      }
      else {
        return response()->json(['message'=>'record does not exists to update','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied','status'=>403]);
    }
  }
  public function delete(Request $request,$id)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['agency','organiser','admin']) && $user->can('update')) {
      $remove = Organiser::where('id',$id)->first();
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
