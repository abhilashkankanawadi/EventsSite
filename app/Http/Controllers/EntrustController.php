<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Permission;
use App\Permisson_Role;

class EntrustController extends Controller
{
  public function store()
  {
    $owner = new Role;
    $owner->name         = 'speaker';
    $owner->display_name = 'event speaker'; // optional
    $owner->description  = 'This user is the speaker'; // optional
    $owner->save();

    $user = User::where('name','=','Abhilash')->first();
    $user->roles()->attach($owner->id);
    if ($owner) {
      $createPost = new Permission;
      $createPost->name         = 'Create';
      $createPost->display_name = 'Create Posts';
      $createPost->description  = 'create new blog posts'; // optional
      $createPost->save();
    }
    if ($owner && $createPost) {
      $common = new Permisson_Role;
      $common->permission_id  = $createPost->id;
      $common->role_id        = $owner->id;
      $common->save();
    }
  }
}
