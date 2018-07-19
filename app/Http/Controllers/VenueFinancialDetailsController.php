<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\VenueFinancialDetailsTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\VenueFinancialDetails;
use App\User;

class VenueFinancialDetailsController extends Controller
{
  public function index(Manager $fractal, VenueFinancialDetailsTransformer $VenueFinancialDetailsTransformer,Request $request)
  {
    $user = User::where('id',$request->user()->id)->first();
    //return $request->user()->id;
    if ($user->hasRole(['venue','admin']) && $user->can('read')) {
      $display      = VenueFinancialDetails::all();
      $colelction   = new Collection($display,$VenueFinancialDetailsTransformer);
      return $data  = $fractal->createData($colelction)->toArray();
    }
    else {
      return response()->json(['message'=>'Permission Denied!!!','status'=>403]);
    }
  }
  public function show(Manager $fractal, VenueFinancialDetailsTransformer $VenueFinancialDetailsTransformer,$id,Request $request)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['venue','admin']) && $user->can('read')) {
      $showById=VenueFinancialDetails::where('id',$id)->first();
      if ($showById) {
        $item        = new Item($showById,$VenueFinancialDetailsTransformer);
        return $data = $fractal->createData($item)->toArray();
      }
      else {
        return response()->json(['message'=>'record does not exists','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied!!!','status'=>403]);
    }
  }
  public function store(Request $request)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['venue']) && $user->can('create')) {
      $add = new VenueFinancialDetails;
      $add->account_name    = $request->account_name;
      $add->account_number  = $request->account_number;
      $add->bank_name       =$request->bank_name;
      $add->bank_branch     =$request->bank_branch;
      $add->ifsc            =$request->ifsc;
      $add->venue_id        =$request->venue_id;
      $add->save();
      return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>'200']);
    }
    else {
      return response()->json(['message'=>'Permission Denied!!!','status'=>403]);
    }
  }
  public function update(Request $request,$id)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['venue']) && $user->can('update')) {
      $change=VenueFinancialDetails::where('id',$id)->first();
      if ($change) {
        $change->account_name    =  $request->account_name;
        $change->account_number  =  $request->account_number;
        $change->bank_name       =  $request->bank_name;
        $change->bank_branch     =  $request->bank_branch;
        $change->ifsc            =  $request->ifsc;
        $change->venue_id        =  $request->venue_id;
        $change->save();
        return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>200]);
      }
      else {
        return response()->json(['message'=>'record does not exist','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied!!!','status'=>403]);
    }
  }
  public function delete(Request $request,$id)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['venue']) && $user->can('delete')) {
      $remove=VenueFinancialDetails::where('id',$id)->first();
      if ($remove) {
        $remove->delete();
        return response()->json(['OK'=>'Record Deleted Successfully!!!','status'=>'200']);
      }
      else {
        return response()->json(['message'=>'Record does not exist to delete','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied!!!','status'=>403]);
    }
  }
}
