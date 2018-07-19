<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\ExhibitorTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Exhibitor;
use App\User;
use Validator;
use Illuminate\Support\MessageBag;

class ExhibitorController extends Controller
{
  public function index(Manager $fractal, ExhibitorTransformer $ExhibitorTransformer)
  {
    $display      = Exhibitor::all();
    $colelction   = new Collection($display,$ExhibitorTransformer);
    return $data  = $fractal->createData($colelction)->toArray();
  }
  public function show(Manager $fractal, ExhibitorTransformer $ExhibitorTransformer,$id)
  {
    $showById=Exhibitor::where('id',$id)->first();
    if ($showById) {
      $item        = new Item($showById,$ExhibitorTransformer);
      return $data = $fractal->createData($item)->toArray();
    }
    else {
      return response()->json(['message'=>'record does not exists','status'=>404]);
    }
  }
  public function store(Request $request)
  {
    //return $user=$request->user();
    $user = User::where('id','=',$request->user()->id)->first();
    if ($user->hasRole(['exhibitor']) && $user->can('create')) {
      $validator = Validator::make($request->all(),[
        'representative'  => 'required',
        'exhibiting_product'=> 'required',
        'company_email'   => 'required|email|unique:exhibitors',
        'contact'         => 'required|unique:exhibitors',
        'products'        => 'required',
        'images'          => 'image|mimes:jpg,png,gif,jpeg|max:2048|dimensions:max_width=800,max_height=800',
      ]);
      if ($validator->fails()) {
              return $validator->errors()->all();
          }
      $add                = new Exhibitor;
      $add->representative        = $request->representative;
      $add->exhibiting_product    = $request->exhibiting_product;
      $add->products              = $request->products;
      $add->company               = $request->company;
      $add->company_email         = $request->company_email;
      $add->about_company         = $request->about_company;
      $add->city                  = $request->city;
      $add->branch_cities         = $request->branch_cities;
      $add->total_employees       = $request->total_employees;
      $add->founder               = $request->founder;
      $add->address               = $request->address;
      $add->contact               = $request->contact;
      $add->website               = $request->website;
      $add->exhibition_attended   = $request->exhibition_attended;
      $add->established           = $request->established;
      $add->event_id              = $request->event_id;
      $add->user_id               = $request->user()->id;
      if ($request->hasFile('images')) {
        $image = $request->file('images')->store('public/images');
             $add->images = str_replace('public/images/','',$image);
      }
      if ($request->hasFile('video')) {
        $vids = $request->file('video')->store('public/videos');
        $add->video  = str_replace('public/videos/','',$vids);
      }
      $add->save();
      return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>'200']);
    }
    else {
      return response()->json(['message'=>'Permission Denied','status'=>403]);
    }
  }
  public function update(Request $request,$id)
  {
    $validator = Validator::make($request->all(),[
      'representative'  => 'required',
      'exhibiting_product'=> 'required',
      'company_email'   => 'required',
      'contact'         => 'required|unique:exhibitors',
      'products'        => 'required',
    ]);
    if ($validator->fails()) {
            return $validator->errors()->all();
        }
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['exhibitor','organiser','admin','agency']) && $user->can('update')) {
      $change =Exhibitor::where('id',$id)->first();
      if ($change) {
        $change->representative        = $request->representative;
        $change->exhibiting_product    = $request->exhibiting_product;
        $change->products              = $request->products;
        $change->company               = $request->company;
        $change->company_email         = $request->company_email;
        $change->about_company         = $request->about_company;
        $change->city                  = $request->city;
        $change->branch_cities         = $request->branch_cities;
        $change->total_employees       = $request->total_employees;
        $change->founder               = $request->founder;
        $change->address               = $request->address;
        $change->contact               = $request->contact;
        $change->website               = $request->website;
        $change->exhibition_attended   = $request->exhibition_attended;
        $change->established           = $request->established;
        $change->event_id              = $request->event_id;
        $change->user_id               = $request->user()->id;
        $change->save();
        return redirect()->action('EventsController@index');
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
    if ($user->hasRole(['exhibitor','organiser','admin','agency']) && $user->can('delete')) {
      $remove =Exhibitor::where('id',$id)->first();
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
