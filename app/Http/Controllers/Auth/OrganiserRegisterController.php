<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Organiser;


class OrganiserRegisterController extends Controller
{
    public function index()
    {
    	return view('auth.organiserRegister');
    }
    
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

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
    public function create(Request $request)
    {
    	$user 	= new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	 $user->save();

    	 $role =Role::where('id',2)->first(); //checking and adding role
        if ($role) {
          $newUser =  $user->roles()->attach(2);
        }
        if($user){
            $org = new Organiser;
            $org->user_id = $user->id;
            $org->save();
        }
        return redirect('organiser/login');
    }
    // protected function create(Request $request,array $data)
    // {
    //      $user = User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => bcrypt($data['password']),
    //     ]);
    //     $user->save();

    //     $role =Role::where('id',2)->first(); //checking and adding role
    //     if ($role) {
    //       $newUser =  $user->roles()->attach($data[1]);
    //     }
    // }
}
