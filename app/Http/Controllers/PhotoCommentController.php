<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PhotoComment;
use Auth;
use Carbon\Carbon;
use DB;

class PhotoCommentController extends Controller
{
  public function show($id)
  {
    $showComment  = PhotoComment::where('photo_id',$id)->get();
    return view('PhotoFeed.PhotoDetails',['showComment'=>$showComment,'id'=>$id]);
  }
  public function store(Request $request,$id)
  {
    $date = Carbon::now();
    $addComment = new PhotoComment;
    $addComment->comments = $request->comments;
    $addComment->photo_id = $request->id;
    $addComment->date     = $date;
    $addComment->user_id  = Auth::user()->id;
    $addComment->save();
    return redirect()->action('PhotoFeedController@index',['id'=>$id]);
  }
}
