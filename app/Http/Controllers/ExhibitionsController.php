<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\ExhibitionsTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Exhibition;
use Validator;
use App\User;

class ExhibitionsController extends Controller
{
  public function store(Request $request)
  {
    $user = User::where('id','=',$request->user()->id)->first();
    if ($user->hasRole(['admin','organiser','agency']) && $user->can('create')) {
      $validator = Validator::make($request->all(),[
        'title'           => 'required',
        'description'     => 'required',
        'images'          => 'image|mimes:jpg,png,gif,jpeg|max:2048|dimensions:max_width=800,max_height=800',
      ]);
      if ($validator->fails()) {
              return $validator->errors()->all();
          }
      $add  = new Exhibition;
      $add->title            = $request->title;
      $add->description      = $request->description;
      $add->highlights       = $request->highlights;
      $add->booth_rent       = $request->booth_rent;
      $add->images           = $request->images;
      if ($request->hasFile('images')) {
        $image = $request->file('images')->store('public/images');
             $add->images = str_replace('public/images/','',$image);
      }
      $add->event_id         = $request->event_id;
      $add->save();
      return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>'200']);
    }
    else {
      return response()->json(['OK'=>'Permission Denied!!!','status'=>403]);
    }
  }
  public function update(Request $request,$id)
  {
    $user = User::where('id','=',$request->user()->id)->first();
    if ($user->hasRole(['admin','organiser','agency']) && $user->can('update')) {
      $validator = Validator::make($request->all(),[
        'title'           => 'required',
        'description'     => 'required',
        'images'          => 'image|mimes:jpg,png,gif,jpeg|max:2048|dimensions:max_width=800,max_height=800',
      ]);
      if ($validator->fails()) {
              return $validator->errors()->all();
          }
        $change = Exhibition::where('id',$id)->first();
        if ($change) {
          $change->title            = $request->title;
          $change->description      = $request->description;
          $change->highlights       = $request->highlights;
          $change->booth_rent       = $request->booth_rent;
          $change->images           = $request->images;
          if ($request->hasFile('images')) {
            $image = $request->file('images')->store('public/images');
                 $change->images = str_replace('public/images/','',$image);
          }
          $change->event_id         = $request->event_id;
          $change->save();
          return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>200]);
        }
        else {
          return response()->json(['message'=>'Record Does not exists','status'=>404]);
        }
    }
    else {
      return response()->json(['OK'=>'Permission Denied!!!','status'=>403]);
    }
  }
  public function delete(Request $request,$id)
  {
    $user=User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['admin','agency','organiser','attendee']) && $user->can('delete')) {
      $remove =Exhibition::where('id',$id)->first();
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
