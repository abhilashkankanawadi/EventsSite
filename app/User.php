<?php

namespace App;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use EntrustUserTrait,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
      return $this->belongsToMany('App\Role');
    }
    public function contents()
    {
      return $this->hasMany('App\Content');
    }
    public function sms()
    {
      return $this->hasMany('App\SMS');
    }
    public function post()
    {
      return $this->hasMany('App\Post');
    }
    public function attendee()
    {
      return $this->hasOne('App\Attendee','user_id');
    }
    public function speak()
    {
      return $this->hasMany('App\Speaker','user_id');
    }
    public function promotion()
    {
      return $this->hasMany('App\Promotion');
    }
    public function discussionChannel()
    {
      return $this->hasMany('App\DiscussionChannel');
    }
    public function chatting()
    {
      return $this->hasMany('App\Chatting','user_id');
    }
    public function joining()
    {
      return $this->hasMany('App\JoinChannel');
    }
    public function photofeed()
    {
      return $this->hasMany('App\PhotoFeed');
    }
    public function photolike()
    {
      return $this->hasMany('App\PhotoLike');
    }
    public function attendeeFollow()
    {
      return $this->hasMany('App\AttendeeFollow');
    }
    public function meetingRequest()
    {
      return $this->hasMany('App\MeetingRequest');
    }
    public function events()
    {
      return $this->belongsToMany('App\Event');
    }
    // public function isAdmin()
    // {
    //   foreach ($this->roles()->get() as $role)
    //     {
    //         if ($role->name == 'admin')
    //         {
    //             return true;
    //         }
    //     }
    //     return false;
    // }
}
