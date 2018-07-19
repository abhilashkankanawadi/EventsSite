<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JoinChannel;

class JoinChannelController extends Controller
{
  public function show()
  {

  }
  public function store(Request $request,$id)
  {
    $join = new JoinChannel;
    $join->user_id              = $request->user_id;
    $join->discuss_channel_id   = $request->id;
    $join->save();

  }

}
