<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Speaker;
use App\Organiser;
use App\Attendee;
use App\Exhibitor;
use App\Agency;
use App\Venue;
use App\Partners;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
         $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->save();


        $role =Role::where('id',$data['rol'])->first(); //checking and adding role
        if ($role) {
          $newUser =  $user->roles()->attach($data['rol']);
        }
        if($data['rol'] == 1){
            $att = new Admin;
            $att->user_id = $user->id;
            $att->save();
        }
        elseif ($data['rol'] == 2) {
          $organiser  = new Organiser;
          $organiser->user_id = $user->id;
          $organiser->save();
        }
        elseif($data['rol'] == 3){
            $att = new Attendee;
            $att->user_id = $user->id;
            $att->save();
        }
        elseif ($data['rol'] == 4) {
          $agency  = new Agency;
          $agency   ->user_id = $user->id;
          $agency   ->save();
        }
        elseif ($data['rol'] == 5) {
          $speaker  = new Speaker;
          $speaker->user_id = $user->id;
          $speaker->save();
        }
        elseif ($data['rol'] == 6) {
          $exhibitor  = new Exhibitor;
          $exhibitor->user_id = $user->id;
          $exhibitor->save();
        }
        elseif ($data['rol'] == 7) {
          $venue  = new Venue;
          $venue    ->user_id = $user->id;
          $venue    ->save();
        }
        elseif ($data['rol'] == 8) {
          $partners  = new Partners;
          $partners    ->user_id = $user->id;
          $partners    ->save();
        }

        return $user;
    }
}
