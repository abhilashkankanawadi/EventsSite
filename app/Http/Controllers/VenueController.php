<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\VenueTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Venue;
use App\VenueFinancialDetails;
use App\User;
use Validator;

class VenueController extends Controller
{
  public function index(Manager $fractal, VenueTransformer $VenueTransformer)
  {
    $display      = Venue::all();
    $colelction   = new Collection($display,$VenueTransformer);
    return $data  = $fractal->createData($colelction)->toArray();
  }
  public function show(Manager $fractal, VenueTransformer $VenueTransformer,$id)
  {
    $showById=Venue::where('id',$id)->first();
    if ($showById) {
      $item        = new Item($showById,$VenueTransformer);
      return $data = $fractal->createData($item)->toArray();
    }
    else {
      return response()->json(['message'=>'record does not exists','status'=>404]);
    }
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(),[
      'venue_name'          => 'required',
      'address'             => 'required',
      'services'            => 'required',
      'about'               => 'required',
      'contact'             => 'required|unique:venues',
      'total_eventsHosted'  => 'required|numeric',
      'work_hours'          => 'required',
      'images'              => 'image|mimes:jpg,png,gif,jpeg|max:2048|dimensions:max_width=800,max_height=800',
    ]);
    if ($validator->fails()) {
            return $validator->errors()->all();
        }
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['venue']) && $user->can('create')) {
      $add  = new Venue;
      $add->venue_name                  = $request->venue_name;
      $add->branch_cities               = $request->branch_cities;
      $add->address                     = $request->address;
      $add->services                    = $request->services;
      $add->facilities                  = $request->facilities;
      $add->contact                     = $request->contact;
      $add->about                       = $request->about;
      $add->manager                     = $request->manager;
      $add->country                     = $request->country;
      $add->total_eventsHosted          = $request->total_eventsHosted;
      $add->work_hours                  = $request->work_hours;
      $add->capacity_of_accomodation    = $request->capacity_of_accomodation;
      $add->website                     = $request->website;
      $add->mode_of_payment             = $request->mode_of_payment;
      $add->near_by_places              = $request->near_by_places;
      if ($request->hasFile('images')) {
        $image  =$request->file('images')->store('public/images');
        $add->images = str_replace('public/images','',$image);
      }
      if ($request->hasFile('video')) {
        $vids  =$request->file('video')->store('public/videos');
        $add->video = str_replace('public/videos','',$vids);
      }
      $add->user_id                     = $request->user()->id;
      $add->save();
      if ($add) {
        $create =  new VenueFinancialDetails;
        $create->account_name   = $request->account_name;
        $create->account_number = $request->account_number;
        $create->bank_name      = $request->bank_name;
        $create->bank_branch    = $request->bank_branch;
        $create->ifsc           = $request->ifsc;
        $create->venue_id       = $add->id;
        $create->save();
      }
      return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>'200']);
    }
    else {
      return response()->json(['message'=>'Permission Denied!!!','status'=>403]);
    }
  }
  public function update(Request $request,$id)
  {
    $validator = Validator::make($request->all(),[
      'venue_name'          => 'required',
      'address'             => 'required',
      'services'            => 'required',
      'about'               => 'required',
      'contact'             => 'required|unique:venues',
      'total_eventsHosted'  => 'required|numeric',
      'work_hours'          => 'required',
    ]);
    if ($validator->fails()) {
            return $validator->errors()->all();
        }
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['venue','admin','organiser','agency']) && $user->can('update')) {
      $change =Venue::where('id',$id)->first();
      if ($change) {
        $change->venue_name                  = $request->venue_name;
        $change->branch_cities               = $request->branch_cities;
        $change->address                     = $request->address;
        $change->services                    = $request->services;
        $change->facilities                  = $request->facilities;
        $change->contact                     = $request->contact;
        $change->about                       = $request->about;
        $change->manager                     = $request->manager;
        $change->country                     = $request->country;
        $change->total_eventsHosted          = $request->total_eventsHosted;
        $change->work_hours                  = $request->work_hours;
        $change->capacity_of_accomodation    = $request->capacity_of_accomodation;
        $change->website                     = $request->website;
        $change->mode_of_payment             = $request->mode_of_payment;
        $change->near_by_places              = $request->near_by_places;
        $change->images                      = $request->images;
        $change->video                       = $request->video;
        $change->user_id                     = $request->user()->id;
        $change->save();
        if ($change) {
          $modify =  VenueFinancialDetails::where('venue_id',$change->id)->first();
          $modify->account_name   = $request->account_name;
          $modify->account_number = $request->account_number;
          $modify->bank_name      = $request->bank_name;
          $modify->bank_branch    = $request->bank_branch;
          $modify->ifsc           = $request->ifsc;
          $modify->save();
        }
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
    if ($user->hasRole(['organiser','admin','agency','venue']) && $user->can('create')) {
      $remove =Venue::where('id',$id)->first();
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
