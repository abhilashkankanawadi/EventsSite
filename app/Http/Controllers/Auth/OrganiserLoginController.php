<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Auth;

class OrganiserLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'organiser/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('organiser')->except('logout');
    }
    public function doLogin(Request $request)
    {
        // $users  = User::where('email',$request->email)->first();
        // if ($users) {
        //     return "yes";
        // }
        // else{
        //     return "no";
        // }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            return redirect('organiser/dashboard');
        }

    }
    public function index()
    {
        // $AllRequests    =   MeetingRequest::all(); 
        // return view('layouts.app',['AllRequests'=>$AllRequests]);
        return view('auth.organiserLogin');
    }
}
