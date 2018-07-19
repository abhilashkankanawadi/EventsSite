<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\EventManagerTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\EventManager;

class EventManagerController extends Controller
{
  public function index(Manager $fractal, EventManagerTransformer $EventManagerTransformer)
  {
    $display      = EventManager::all();
    $colelction   = new Collection($display,$EventManagerTransformer);
    return $data  = $fractal->createData($colelction)->toArray();
  }
  public function show(Manager $fractal, EventManagerTransformer $EventManagerTransformer,$id)
  {
    $showById=EventManager::where('id',$id)->first();
    if ($showById) {
      $item        = new Item($showById,$EventManagerTransformer);
      return $data = $fractal->createData($item)->toArray();
    }
    else {
      return response()->json(['message'=>'record does not exists','status'=>404]);
    }
  }
  public function store(Request $request)
  {
    $this->validate($request,[
      'name'    => 'required',
      'email'   => 'required|email|unique:event_managers',
      'phone'   => 'required'
    ]);

    $add                = new EventManager;
    $add->name          = $request->name;
    $add->email         = $request->email;
    $add->phone         = $request->phone;
    $add->address       = $request->address;
    $add->gender        = $request->gender;
    $add->save();
    return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>'200']);
  }

  public function update(Request $request,$id)
  {
    $change =EventManager::where('id',$id)->first();
    if ($change) {
      $change->name          = $request->name;
      $change->email         = $request->email;
      $change->phone         = $request->phone;
      $change->address       = $request->address;
      $change->gender        = $request->gender;
      $change->save();
      return response()->json(['OK'=>'Values are Updated Successfully!!!','status'=>'200']);
    }
    else {
      return response()->json(['message'=>'record does not exists to update','status'=>404]);
    }
  }
  public function delete($id)
  {
    $remove =EventManager::where('id',$id)->first();
    if ($remove) {
      $remove->delete();
      return response()->json(['Ok'=>'record is deleted','status'=>200]);
    }
    else {
      return response()->json(['message'=>'record does not exists to delete','status'=>404]);
    }
  }
}
