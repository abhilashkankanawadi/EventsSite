<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\FeedsTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Feed;
use App\User;
use Validator;

class FeedsController extends Controller
{
  public function index(Manager $fractal, FeedsTransformer $FeedsTransformer)
  {
    $display      = Feed::all();
    $colelction   = new Collection($display,$FeedsTransformer);
    return $data  = $fractal->createData($colelction)->toArray();
  }
  public function show(Manager $fractal, FeedsTransformer $FeedsTransformer,$id)
  {
    $showById=Feed::where('id',$id)->first();
    if ($showById) {
      $item        = new Item($showById,$FeedsTransformer);
      return $data = $fractal->createData($item)->toArray();
    }
    else {
      return response()->json(['message'=>'record does not exists','status'=>404]);
    }
  }
  public function store(Request $request)
  {
    $user = User::where('id','=',$request->user()->id)->first();
  if ($user->hasRole(['organiser','admin','speaker','attendee']) && $user->can('create')) {
    $validator = Validator::make($request->all(),[
      'title'      => 'required',
      'date'       => 'required|date|date_format:Y-m-d',
      'images'     => 'image|mimes:jpg,png,gif,jpeg|max:2048|dimensions:max_width=800,max_height=800',
      'video'      => 'required|mimes:mp4,avi,wmv,ogx,oga,ogv,ogg,webm,3gp,flv|max:4096',
    ]);
    if ($validator->fails()) {
            return $validator->errors()->all();
        }
    $add =  new Feed;
    $add->title       =$request->title;
    $add->description =$request->description;
    $add->url         = $request->url;
    $add->date        = $request->date;
    $add->location    = $request->location;
    $add->tags        = $request->tags;
    $add->user_id     = $request->user()->id;
    if ($request->hasFile('images')) {
      $image = $request->file('images')->store('public/images');
           $add->images = str_replace('public/images/','',$image);
    }
    if ($request->hasFile('video')) {
      $vids = $request->file('video')->store('public/videos');
      $add->video = str_replace('public/videos/','',$vids);
    }
    $add->save();
    return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>200]);
  }
  else {
    return response()->json(['Message'=>'Permission Denied','status'=>403]);
  }
}
  public function update(Request $request,$id)
  {
    $user = User::where('id','=',$request->user()->id)->first();
    if ($user->hasRole(['organiser','admin','speaker','attendee']) && $user->can('create')) {
      $change = Feed::where('id',$id)->first();
      if ($change) {
        $change->title       = $request->title;
        $change->description = $request->description;
        $change->url         = $request->url;
        $change->date        = $request->date;
        $change->location    = $request->location;
        $change->tags        = $request->tags;
        $change->user_id     = $request->user()->id;
        $change->save();
        // if ($request->hasFile('images')) {
        //   $image = $request->file('images')->store('public/images');
        //        $change->images = str_replace('public/images/','',$image);
        // }
        // if ($request->hasFile('video')) {
        //   $vids = $request->file('video')->store('public/videos');
        //        $change->video = str_replace('public/videos/','',$vids);
        // }
        return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>200]);
      }
      else {
        return response()->json(['Message'=>'ID does not exist','status'=>404]);
      }
    }
    else {
      return response()->json(['Message'=>'Permission Denied','status'=>403]);
    }
  }
  public function delete(Request $request,$id)
  {
    $user = User::where('id','=',$request->user()->id)->first();
    if ($user->hasRole(['organiser','admin','speaker','attendee']) && $user->can('delete')) {
      $remove =Feed::where('id',$id)->first();
      if ($remove) {
        $remove->delete();
        return response()->json(['Ok'=>'record is deleted','status'=>200]);
      }
      else {
        return response()->json(['message'=>'record does not exists to delete','status'=>404]);
      }
    }
    else {
      return response()->json(['Message'=>'Permission Denied','status'=>403]);
    }
  }
}
