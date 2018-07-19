<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Chat;
use App\Chatting;
use App\User;
use App\Http\Controllers\Controller;
use LRedis;
use Illuminate\Support\Facades\DB;
use Auth;
use App\JoinChannel;

class ChatController extends Controller
{
  public function index($id)
  {
    return view('DiscussionChannel.DiscussionHome',['id'=>$id]);
  }
  public function show($id)
  {
    $chats = Chatting::where('discuss_channel_id',$id)->first();
    $showJoin = JoinChannel::where('discuss_channel_id',$id)->where('user_id', 5)->get();//
    $joined = JoinChannel::where('discuss_channel_id',$id)->get();
    //if ($chats) {
      return view('DiscussionChannel.Chat',['chats'=>$chats,'id'=>$id,'showJoin'=>$showJoin,'joined'=>$joined]);
    // }
    // else {
    //   return view('DiscussionChannel.Chat',['id'=>$id]);
    // }
  }
  public function store(Request $request,$id)
  {
    $redis = LRedis::connection();
      $add = new Chatting;
      $add->messages =  $request->get('contents');
      $add->user_id = Auth::user()->id;
      $add->discuss_channel_id = $request->id;
      $add->save();

          $content = DB::table('users')
            ->join('chattings', function ($join) {
                $join->on('users.id', '=', 'chattings.user_id')
                ->select('users.name','chattings.messages')
                     ->where('chattings.user_id', '=', Auth::user()->id);
            })
            ->orderBy('chattings.id', 'desc')
            ->first();
            
      $redis->publish('message1',json_encode($content));
      return response()->JSON($content);
  }
  public function delete($id)
  {
    $remove = Chatting::where('id',$id)->first();
    if ($remove) {
      $remove->delete();
      return response()->json(['OK'=>'record is deleted','status'=>200]);
    }
    else {
      return response()->json(['message'=>'record does not exit','status'=>404]);
    }
  }
}
