<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiscussionChannel;
use App\User;
use Carbon\Carbon;
use LRedis;
use App\Chatting;

class DiscussionChannelController extends Controller
{
    public function index($id)
    {

    }
    public function show($id)
    {
      $discuss  = DiscussionChannel::paginate(4);

        return view('DiscussionChannel.DiscussionHome',['id'=>$id,'discuss'=>$discuss]);
    }
    public function store(Request $request,$id)
    {
      $time = Carbon::now();
      $add  = new DiscussionChannel;
      $add->title            = $request->title;
      $add->channel_info     = $request->channel_info;
      //$add->max_participants = $request->max_participants;
      $add->date             = $time;
      if ($request->hasFile('images')) {
        $image = $request->file('images')->store('public/images');
             $add->images = str_replace('public/images','',$image);
      }
      $add->user_id          = $request->user()->id;
      $add->save();
      if ($add) {
        $child  = new Chatting;
        $child->discuss_channel_id  = $add->id;
        $child->save();
      }
      return redirect()->action('DiscussionChannelController@show',['id'=>$id]);
    }
    public function update(Request $request,$id)
    {
      $redis = LRedis::connection();
      $change =DiscussionChannel::where('id',$id)->first();
      if ($change) {
        $change->user_id = $request->user_id;
        $change->save();
        if ($change) {
          $chatChange = Chatting::where('discuss_channel_id',$id)->first();
          $chatChange->user_id  = $change->user_id;
          $chatChange->save();
        }
        $showJoin = Chatting::where('user_id',$change->user_id)->first();
        return view('DiscussionChannel.Chat',['id'=>$id,'change'=>$change]);
      }
    }

}
