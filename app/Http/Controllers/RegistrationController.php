<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use App\Role;
use App\Permission;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
      // return $request->role;
      $role   = Role::where('id', $request->role)->first();
      if ($role) {
        $auth   = new User;
        $auth->name     = $request->name;
        $auth->email    = $request->email;
        $auth->password = Hash::make($request->password);
        $auth->save();
        $auth->roles()->attach($role->id);
        return response(['ok'=>'User Registered Successfully']);
      } 
      else {
        return response(['ok'=>'User Registered fail']);
      }
    }

}
