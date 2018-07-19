<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Transformers\AgencyTransformer;
use App\Agency;
use App\User;
use Validator;

class AgencyController extends Controller
{
  public function index(Manager $fractal, AgencyTransformer $AgencyTransformer)
  {
    $display      = Agency::all();
    $colelction   = new Collection($display,$AgencyTransformer);
    return $data  = $fractal->createData($colelction)->toArray();
  } 

  public function show(Manager $fractal, AgencyTransformer $AgencyTransformer,$id)
  {
    $showById=Agency::where('id',$id)->first();
    if ($showById) {
      $item        = new Item($showById,$AgencyTransformer);
      return $data = $fractal->createData($item)->toArray();
    }
    else {
      return response()->json(['message'=>'record does not exists','status'=>404]);
    }
  }
  public function store(Request $request)
  {
    //return $user=$request->user();
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['agency','admin']) && $user->can('create')) {
      $validator = Validator::make($request->all(),[
        'agency_name'       => 'required',
        'address'           => 'required',
        'country'           => 'required',
        'about'             => 'required',
        'contact'           => 'required|unique:agencies',
        'events_organised'  => 'required|numeric',
        'working_days'      => 'required',
        'website'           => 'required',
        'images'            => 'image|mimes:jpg,png,gif,jpeg|max:2048|dimensions:max_width=800,max_height=800',
      ]);
      if ($validator->fails()) {
              return $validator->errors()->all();
          }

      $add  = new Agency;
      $add->agency_name       = $request->agency_name;
      $add->address           = $request->address;
      $add->country           = $request->country;
      $add->contact           = $request->contact;
      $add->about             = $request->about;
      $add->events_organised  = $request->events_organised;
      $add->services          = $request->services;
      $add->recognitions      = $request->recognitions;
      $add->working_hours     = $request->working_hours;
      $add->working_days      = $request->working_days;
      $add->established       = $request->established;
      $add->founder           = $request->founder;
      $add->main_branch       = $request->main_branch;
      $add->sub_branches_cities= $request->sub_branches_cities;
      $add->website           = $request->website;
      if ($request->hasFile('images')) {
        $image = $request->file('images')->store('public/images');
        $add->images = str_replace('public/images/','',$image);
      }
      $add->user_id           = $request->user()->id;
      // $run = Agency::where($request->user()->id)->users();
      // if ( $run ) {
      //   return response()->json(['message'=>'user exists']);
      // }
      // else {
      //   $add->user_id           = $request->user()->id;
      // }

      $add->save();
      return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>200]);
    } else {
      return response()->json(['message'=>'Permission Denied','status'=>403]);
    }
  }
  public function update(Request $request,$id)
  {
    $validator = Validator::make($request->all(),[
      'agency_name'       => 'required',
      'address'           => 'required',
      'country'           => 'required',
      'about'             => 'required',
      'events_organised'  => 'required|numeric',
      'working_days'      => 'required',
      'website'           => 'required',
    ]);
    if ($validator->fails()) {
            return $validator->errors()->all();
        }
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['agency','admin']) && $user->can('update')) {
      $change =Agency::where('id',$id)->first(); 
      if ($change) {
        $change->agency_name       = $request->agency_name;
        $change->address           = $request->address;
        $change->country           = $request->country;
        $change->contact           = $request->contact;
        $change->about             = $request->about;
        $change->events_organised  = $request->events_organised;
        $change->services          = $request->services;
        $change->recognitions      = $request->recognitions;
        $change->working_hours     = $request->working_hours;
        $change->working_days      = $request->working_days;
        $change->established       = $request->established;
        $change->founder           = $request->founder;
        $change->main_branch       = $request->main_branch;
        $change->sub_branches_cities= $request->sub_branches_cities;
        $change->website           = $request->website;
        if ($request->hasFile('images')) {
          $image  = $request->file('images')->store('public/images');
          $change->images = str_replace('public/images','',$image);
        }
        $change->save();
        return redirect()->action('EventsController@index');
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied','status'=>403]);
    }
  }
  public function delete(Request $request,$id)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['admin','agency']) && $user->can('update')) {
      $remove =Agency::where('id',$id)->first();
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
