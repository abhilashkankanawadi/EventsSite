<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\PostTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Post;
use App\User;
use App\Event;
use Validator;

class PostController extends Controller
{
  public function index(Manager $fractal, PostTransformer $PostTransformer)
  {
    $display      = Post::all();
    $colelction   = new Collection($display,$PostTransformer);
    return $data  = $fractal->createData($colelction)->toArray();
  }
  public function show($id)
  {
    $showById=  Post::where('event_id','=',$id)->get();
    return view('Post',['showById'=>$showById, 'id' => $id]);
  }
  public function store(Request $request,$id)
  {
    $user = User::where('id','=',$request->user()->id)->first();
    if ($user->hasRole(['organiser','admin','speaker','attendee']) && $user->can('create')) {
      $validator = Validator::make($request->all(),[
        'status'      => 'required',

        ]);
      if ($validator->fails()) {
              return $validator->errors()->all();
          }
      $add =  new Post;
      $add->status      = $request->status;
      $add->tags	      = $request->tags;
      $add->location    = $request->location;
      $add->event_id    = $request->id;
      $add->user_id     = $request->user()->id;
      if ($request->hasFile('images')) {
        $image = $request->file('images')->store('public/images');
             $add->images = str_replace('public/images/','',$image);
      }
      if ($request->hasFile('videos')) {
        $vids = $request->file('videos')->store('public/videos');
             $add->video = str_replace('public/videos/','',$vids);
      }
      $add->save();
      return redirect()->action('EventsController@show',['id'=>$id]);
    }
    else {
      return response()->json(['Message'=>'Permission Denied','status'=>403]);
    }
  }

  public function update(Request $request,$id)
  {
    $user = User::where('id','=',$request->user()->id)->first();
    if ($user->hasRole(['organiser','admin','speaker','attendee']) && $user->can('create')) {
      $change = Post::where('id',$id)->first();
      if ($change) {
        $change->status      =$request->status;
        $change->tags	      = $request->tags;
        $change->location    = $request->location;
        $change->user_id     = $request->user()->id;
        if ($request->hasFile('images')) {
          $image = $request->file('images')->store('public/images');
               $change->images = str_replace('public/images/','',$image);
        }
        if ($request->hasFile('videos')) {
          $vids = $request->file('videos')->store('public/videos');
               $change->video = str_replace('public/videos/','',$vids);
        }
        $change->save();
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
      $remove = Post::where('id',$id)->first();
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
