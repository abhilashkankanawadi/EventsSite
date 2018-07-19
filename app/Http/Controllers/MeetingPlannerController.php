<?php

namespace App\Http\Controllers;
use DB;
use App\Event;
use App\Partners;
use App\Attendee;
use App\Speaker;
use App\MeetingRequest;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Event_User;
use Response;

class MeetingPlannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        
    }
	public function show($id)
	{
      $AllUsers = Event::find($id);//using many-to-many relationship
      $requestChecks    = MeetingRequest::where('requested_by',Auth::user()->id)->get();
      $oneuser  = Event::where('id',$id)->first();
      return view('MeetingPlanner.Meeting',['AllUsers'=>$AllUsers,'requestChecks'=>$requestChecks,'oneuser'=>$oneuser,'id'=>$id]);
	}
    public function store(Request $request,$id)
    {
          $event  = Event::where('id',$id)->first();
          $date       = Carbon::today();
        $addRequest = new MeetingRequest;
        $addRequest->meeting_purpose    =   $request->meeting_purpose;
        $addRequest->meeting_date       =   $request->meeting_date;
        $addRequest->location           =   $request->location;
        $addRequest->time               =   $request->time;
        $addRequest->event_id           =   $request->id;
        $addRequest->request_to         =   $request->request_to;
        $addRequest->request_status     =   1;
        $addRequest->requested_by       =   Auth::user()->id;
        $addRequest->requested_date     =   $date->toDateString(); //save date without time
        $addRequest->save();

        return redirect()->back();
    }

    public function OrgSendToDeligate(Request $request,$id)
    {
        $sendReq    =   MeetingRequest::where('id',$id)->first();
        $sendReq->organiser_review    = 1;
        $sendReq->save();
        return redirect()->back();
    }

    // public function attendeeDetails($id)
    // {
    //     $AttDetails    = Attendee::where('id',$id)->first();
    //     $PartDetails   = Partners::where('id',$id)->first();
    //     return view('MeetingPlanner.Deligate',['AttDetails'=>$AttDetails,'PartDetails'=>$PartDetails,'id'=>$id]);
    // }
    // public function speakerDetails($id)
    // {
    //     $SpeakDetails  = Speaker::where('id',$id)->get();
    //     return view('MeetingPlanner.Deligate',['SpeakDetails'=>$SpeakDetails]);
    // }
    public function delMeetReq($id)
    {
    	$remove    =   MeetingRequest::where('id',$id)->first();
        $remove->delete();
        return redirect()->back()->with('success','Record Deleted');
        //return response()->json(['OK'=>'deleted']);
    }
}
