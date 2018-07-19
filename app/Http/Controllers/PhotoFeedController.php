<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PhotoComment;
use App\PhotoFeed;
use App\PhotoLike;
use Auth;

class PhotoFeedController extends Controller
{
    public function index($id)
    {
      $showComments = PhotoComment::where('photo_id',$id)->OrderBy('id','DESC')->get();
      $showCounts = PhotoComment::where('photo_id',$id)->count();
      $detail = PhotoFeed::where('id',$id)->first();
      $likeCounts = PhotoLike::where('photo_id',$id)->count();
      return view('PhotoFeed.PhotoDetails',['detail'=>$detail,'showComments'=>$showComments,'showCounts'=>$showCounts,'likeCounts'=>$likeCounts,'id'=>$id]);
    }
    public function show($id) 
    {
      $photos = PhotoFeed::where('event_id',$id)->get();
      $photoEvent = PhotoFeed::where('event_id',$id)->first();
      if ($photos) {
        return view('PhotoFeed.Photo',['photos'=>$photos,'photoEvent'=>$photoEvent,'id'=>$id]);
      }
      else {
        return "no";
      }
    }
    public function store(Request $request,$id)
    {
      $addPhoto = new PhotoFeed;
      $addPhoto->caption  = $request->caption;
      $addPhoto->user_id  = Auth::user()->id;
      $addPhoto->event_id  = $request->id;
      if ($request->hasFile('photos')) {
        $image = $request->file('photos')->store('public/images');
             $addPhoto->photos = str_replace('public/images','',$image);
      }
      $addPhoto->save();
      return redirect()->action('PhotoFeedController@show',['id'=>$id]);
    }
}
