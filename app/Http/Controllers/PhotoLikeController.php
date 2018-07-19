<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PhotoLike;
use Auth;

class PhotoLikeController extends Controller
{
    public function store(Request $request,$id)
    {
      $addLike  = new PhotoLike;
      $addLike->like_status = $request->like_status;
      $addLike->photo_id    = $request->id; 
      $addLike->user_id     = Auth::user()->id;
      $addLike->save();
      
      return response()->json($addLike);
    }
}
