<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use App\Transformers\EventTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Event;
use App\Post;
use App\User;
use App\Organiser;
use App\Exhibition;
use App\MeetingRequest;
use Agency;
use Validator;
use Carbon\Carbon;

class EventsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth',['except'=>['index']]);
  }
  public function index()
  {
    //return Carbon::now();
    $daa=Carbon::now();
    //$fetches      = Event::all();
    $fetches      = Event::take(8)->get();
    return view('home',['fetches'=>$fetches]);
  }
  public function eventUpcoming()
  {
    $today= Carbon::today();
    $coming = Event::where('start_date','>',$today)->get();
    $past   = Event::where('start_date','<',$today)->get();
    // $coming = Event::all();
    return view('Events',['coming'=>$coming,'past'=>$past])->with([$i=0]);
  }
  public function create()
  {
    return view('createEvent');
  }
  public function show($id)
  {
    $showById = Post::where('event_id',$id)->OrderBy('created_at','DESC')->get();
    $test = MeetingRequest::where('event_id',$id)->count();
    //return $test;
   //return $showById;
    return view('ActivityFeed',compact('showById','id','test'));
  }

  public function store(Request $request)
  {
      $user = User::where('id','=',$request->user()->id)->first();
    if ($user->hasRole(['admin','organiser']) && $user->can('create')) {
      $validator = Validator::make($request->all(),[
        'event_name'      => 'required',
        'start_date'      => 'required|date|date_format:Y-m-d',
        'end_date'        => 'required|date|date_format:Y-m-d',
        'contact_number'  => 'required|unique:events',
        'category'        => 'required',
        'cost_per_person' => 'required',
        'langauge'        => 'required',
        'description'     => 'required',
        'country'         => 'required',
        'city'            => 'required',
        'state'           => 'required',
        'venue'           => 'required',
        'contact_mail'    => 'required|email|unique:events',
        'speaker'         => 'required',
        'images'          => 'image|mimes:jpg,png,gif,jpeg|max:2048|dimensions:max_width=5000,max_height=5000',
      ]);
      if ($validator->fails()) {
              return $validator->errors()->all();
          }
      //$organise = Organiser::find('id');
      $add  = new Event;
      $add->event_name      = $request->event_name;
      $add->start_date      = $request->start_date;
      $add->end_date        = $request->end_date;
      $add->venue           = $request->venue;
      $add->country         = $request->country;
      $add->city            = $request->city;
      $add->state           = $request->state;
      $add->guest           = $request->guest;
      $add->speaker         = $request->speaker;
      $add->category        = $request->category;
      $add->start_time      = $request->start_time;
      $add->end_time        = $request->end_time;
      $add->cost_per_person = $request->cost_per_person;
      $add->participants    = $request->participants;
      $add->host            = $request->host;
      $add->langauge        = $request->langauge;
      $add->highlights      = $request->highlights;
      $add->partner         = $request->partner;
      $add->description     = $request->description;
      $add->contact_mail    = $request->contact_mail;
      $add->contact_number  = $request->contact_number;
      $add->organiser_id    = $request->organiser;
      $add->sponsor         = $request->sponsor;
      $add->venue_id        = 1;
      if ($request->hasFile('images')) {
        $image = $request->file('images')->store('public/images');
             $add->images = str_replace('public/images','',$image);
      }
      if ($request->hasFile('video')) {
        $vids = $request->file('video')->store('public/videos');
             $add->video = str_replace('public/videos/','',$vids);
      }
      $add->user_id         = $request->user()->id;
      $add->save();
      // if ($add) {
      //   $exhibit              = new Exhibition;
      //   $exhibit->title       = $request->title;
      //   $exhibit->description	= $request->description;
      //   $exhibit->booth_rent  = $request->booth_rent;
      //   $exhibit->highlights  = $request->highlights;
      //   if ($request->hasFile('images')) {
      //     $image = $request->file('images')->store('public/images');
      //          $exhibit->images = str_replace('public/images/','',$image);
      //   }
      //   $exhibit->event_id    = $add->id;
      //   $exhibit->save();
      // }
      return redirect()->action('EventsController@index');
    }
    else {
      return response()->json(['Message'=>'Permission Denied','status'=>403]);
    }
  }

  public function edit($id)
  {
    $edit =Event::where('id',$id)->first();
    return view('home.HomeEdit',['edit'=>$edit]);
  }

  public function update(Request $request,$id)
  {
    $user = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['admin','organiser']) && $user->can('update')) {
      $validator = Validator::make($request->all(),[
        'event_name'      => 'required',
        'start_date'      => 'required|date|date_format:Y-m-d',
        'end_date'        => 'required|date|date_format:Y-m-d',
        'contact_number'  => 'required',
        'category'        => 'required',
        'cost_per_person' => 'required',
        'langauge'        => 'required',
        'description'     => 'required',
        'country'         => 'required',
        'city'            => 'required',
        'state'           => 'required',
        'venue'           => 'required',
        'contact_mail'    => 'required',
        'speaker'         => 'required'
      ]);
      if ($validator->fails()) {
              return $validator->errors()->all();
          }
      $change =Event::where('id',$id)->first();
      if ($change) {
        $change->event_name      = $request->event_name;
        $change->start_date      = $request->start_date;
        $change->end_date        = $request->end_date;
        $change->venue           = $request->venue;
        $change->country         = $request->country;
        $change->city            = $request->city;
        $change->state           = $request->state;
        $change->guest           = $request->guest;
        $change->speaker         = $request->speaker;
        $change->category        = $request->category;
        $change->start_time      = $request->start_time;
        $change->end_time        = $request->end_time;
        $change->cost_per_person = $request->cost_per_person;
        $change->participants    = $request->participants;
        $change->host            = $request->host;
        $change->langauge        = $request->langauge;
        $change->highlights      = $request->highlights;
        $change->partner         = $request->partner;
        $change->description     = $request->description;
        $change->contact_mail    = $request->contact_mail;
        $change->contact_number  = $request->contact_number;
        $change->sponsor         = $request->sponsor;
        $change->venue_id        = $request->venue_id;
        if ($request->hasFile('images')) {
          $image = $request->file('images')->store('public/images');
               $change->images = str_replace('public/images/','',$image);
        }
        if ($request->hasFile('video')) {
          $vids = $request->file('video')->store('public/videos');
               $change->video = str_replace('public/videos/','',$vids);
        }
        $change->user_id         = $request->user()->id;
        $change->save();
        return redirect('home');
      //   if ($change) {
      //     $modify              = Exhibition::where('event_id',$change->id)->first();
      //     $modify->title       = $request->title;
      //     $modify->description = $request->description;
      //     $modify->booth_rent  = $request->booth_rent;
      //     $modify->highlights  = $request->highlights;
      //     $modify->images      = $request->images;
      //     $modify->event_id    = $change->id;
      //     $modify->save();
      //     return response()->json(['OK'=>'Values are Updated Successfully!!!','status'=>'200']);
      // }
    }
    else {
      return response()->json(['message'=>'record does not exists to update','status'=>404]);
    }
  }
    else {
      return response()->json(['Message'=>'Permission Denied','status'=>403]);
    }
  }

  public function delete(Request $request,$id)
  {
    $user = User::where('id','=',$request->user()->id)->first();
    if ($user->hasRole(['admin','organiser','agency']) && $user->can('delete')) {
      $remove =Event::where('id',$id)->first();
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
