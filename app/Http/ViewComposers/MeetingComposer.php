<?php 
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
//use Illuminate\MeetingRequest;
//use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\MeetingRequest;
use Auth;


class MeetingComposer {
    public function organisers(View $view)
    {   $view->with('nots',MeetingRequest::where('organiser_review',0)->count());
        $view->with('latest',MeetingRequest::orderBy('created_at','DESC')->get());
    }
    public function deligates(View $view)
    {
        //counting number of notifications
        $view->with('countDeligates',MeetingRequest::where('deligateAccept_status',0)->where('request_to',Auth::user()->id)->count());
        //fetch data for deligates
        $view->with('deligateNotifications',MeetingRequest::where('request_to',Auth::user()->id)->get());
    }
    public function speakers(View $view)
    {
        $view->with('deligateNotifications',MeetingRequest::where('request_to',Auth::user()->id)->get());
    }
}