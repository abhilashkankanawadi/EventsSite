<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\InviteeTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Invitee;

class InviteeController extends Controller
{
  public function index(Manager $fractal, InviteeTransformer $InviteeTransformer)
  {
    $display      = Invitee::all();
    $colelction   = new Collection($display,$InviteeTransformer);
    return $data  = $fractal->createData($colelction)->toArray();
  }
  public function show(Manager $fractal, InviteeTransformer $InviteeTransformer,$id)
  {
    $showById=Invitee::where('id',$id)->first();
    if ($showById) {
      $item        = new Item($showById,$InviteeTransformer);
      return $data = $fractal->createData($item)->toArray();
    }
    else {
      return response()->json(['message'=>'record does not exists','status'=>404]);
    }
  }
  public function store(Request $request)
  {
    $this->validate($request,[
      'name'   =>'required',
      'phone'  =>'required',
      'email'  =>'required|email|unique:invities',
    ]);

    $add                = new Invitee;
    $add->name          = $request->name;
    $add->email         = $request->email;
    $add->phone         = $request->phone;
    $add->profession    = $request->profession;
    $add->place         = $request->place;
    $add->description   = $request->description;
    $add->save();
    return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>'200']);
  }

  public function update(Request $request,$id)
  {
    $change =Invitee::where('id',$id)->first();
    if ($change) {
      $change->name          = $request->name;
      $change->email         = $request->email;
      $change->phone         = $request->phone;
      $change->profession    = $request->profession;
      $change->place         = $request->place;
      $change->description   = $request->description;
      $change->save();
      return response()->json(['OK'=>'Values are Updated Successfully!!!','status'=>'200']);
    }
    else {
      return response()->json(['message'=>'record does not exists to update','status'=>404]);
    }
  }
  public function delete($id)
  {
    $remove =Invitee::where('id',$id)->first();
    if ($remove) {
      $remove->delete();
      return response()->json(['Ok'=>'record is deleted','status'=>200]);
    }
    else {
      return response()->json(['message'=>'record does not exists to delete','status'=>404]);
    }
  }
}
