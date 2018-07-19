<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event_DaysInfo;
use App\MyAgenda;
use Validator;
use App\User;
use Auth;

class EventDayInfoController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index()
  {
    $show = Event_DaysInfo::all();
    return view('ActivityFeed',['show'=>$show]);
  }
  public function show($id)
  {
    $showAgenda = Event_DaysInfo::where('event_id',$id)->get();
    $myAgenda   = MyAgenda::where('user_id',Auth::user()->id)->get();
    $showdetail = Event_DaysInfo::where('event_id',$id)->first();

    // $showdetail = DB::table('event__days_infos as e1')
    //             ->join('event__days_infos as e2','e2.id', '=', 'e1.id')
    //                 ->select('e1.date','e2.date')
    //                      ->where('e1.event_id','=',$id)
    //             ->get();


    return view('Agenda',['showAgenda'=>$showAgenda,'showdetail'=>$showdetail,'myAgenda'=>$myAgenda,'id'=>$id]);
  }
  public function myagends(Request $request)
  {
    $user   = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['admin','agency','organiser','attendee','speaker']) && $user->can('create')) {
      $validator = Validator::make($request->all(),[
        'user_id'    => 'required|unique:event__days_infos'
      ]);
      // if ($validator->fails()) {
      //         return $validator->errors()->all();
      //     }


      $mynote = new MyAgenda;
      $mynote->event__days_infos_id = $request->task_id;
      $mynote->user_id = $request->user()->id;
      $mynote->save();

      $noteshow = Event_DaysInfo::where('id',$mynote->event__days_infos_id)->first();
      return response()->json($noteshow);
    }
    else {
      return response()->json(['message'=>'permission denied!!']);
    }
    // $mynote = "hi";
    // return response()->JSON($mynote);
  }

  public function store(Request $request)
  {
    $user   = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['admin','agency','organiser','speaker']) && $user->can('create')) {
      //$user = User::where('id','=',$request->user()->id)->first();
      //return $user;
        $validator = Validator::make($request->all(),[
          'start_time'    => 'required',
          'end_time'      => 'required',
          'description'   => 'required',
          'start_date'    => 'required|date|date_format:Y-m-d',
          'end_date'      => 'required|date|date_format:Y-m-d',
        ]);
        if ($validator->fails()) {
                return $validator->errors()->all();
            }
      $add              = new Event_DaysInfo;
      $add->start_date  = $request->start_date;
      $add->end_date    = $request->end_date;
      $add->start_time  = $request->start_time;
      $add->end_time    = $request->end_time;
      $add->description = $request->description;
      $add->highlights  = $request->highlights;
      $add->event_id    = $request->event_id;
      $add->venue_id    = $request->venue_id;
      $add->speaker_id  = $request->speaker_id;
      $add->save();
      return response()->json(['message'=>'Data stored Successfully!!','status'=>200]);
    }
    else {
      return response()->json(['message'=>'permission denied!!']);
    }
  }
  public function update(Request $request,$id)
  {
    $user   = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['admin','agency','organiser']) && $user->can('update')) {
      $validator = Validator::make($request->all(),[
        'start_date'    => 'required|date|date_format:Y-m-d',
        'end_date'      => 'required|date|date_format:Y-m-d',
        'start_time'    => 'required',
        'end_time'      => 'required',
        'description'   => 'required',
      ]);
      if ($validator->fails()) {
              return $validator->errors()->all();
          }
      $change   = Event_DaysInfo::where('id',$id)->first();
      if ($change) {
        $change->start_date  = $request->start_date;
        $change->end_date    = $request->end_date;
        $change->start_time  = $request->start_time;
        $change->end_time    = $request->end_time;
        $change->description = $request->description;
        $change->event_id    = $request->event_id;
        $change->venue_id    = $request->venue_id;
        $change->speaker_id  = $request->user()->id;
        $change->save();
        return response()->json(['OK'=>'Data Updated Successfully!!','status'=>200]);
      }
      else {
        return response()->json(['message'=>'record does not exists to update','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'permission denied!!','status'=>403]);
    }
  }
  public function delete(Request $request,$id)
  {
    $user   = User::where('id',$request->user()->id)->first();
    //return $request->user()->name;
    if ($user->hasRole(['admin','agency','organiser']) && $user->can('delete')) {
      $remove   = Event_DaysInfo::where('id',$id)->first();
      if ($remove) {
        $remove->delete();
        return response()->json(['OK'=>'Record Deleted Successfully!','status'=>200]);
      }
      else {
        return response()->json(['OK'=>'Record Does not exists','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'permission denied!!','status'=>403]);
    }
  }
}
