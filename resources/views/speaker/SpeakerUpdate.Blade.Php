@extends('layouts.app')

@section('content')
@role('speaker')
<form action="{{url('speakerUpdate',[$editSpeaker->id])}}" method="post" name="spea" enctype="multipart/form-data">
  <input type="text" name="first_name" value="{{$editSpeaker->user->name}}" placeholder="first name"><br>
  <input type="text" name="last_name" value="{{$editSpeaker->last_name}}" placeholder="last name"><br>
  <input type="text" name="profession" value="{{$editSpeaker->profession}}" placeholder="profession"><br>
  <input type="text" name="age" value="{{$editSpeaker->age}}" placeholder="age"><br>
  <input type="text" name="city" value="{{$editSpeaker->city}}" placeholder="city"><br>
  <input type="text" name="state" value="{{$editSpeaker->state}}" placeholder="state"><br>
  <input type="text" name="gender" value="{{$editSpeaker->gender}}" placeholder="gender"><br>
  <input type="text" name="address" value="{{$editSpeaker->address}}" placeholder="address"><br>
  <input type="text" name="expert_in" value="{{$editSpeaker->expert_in}}" placeholder="expert_in"><br>
  <input type="text" name="country" value="{{$editSpeaker->country}}" placeholder="country"><br>
  <input type="text" name="contact" value="{{$editSpeaker->contact}}" placeholder="contact"><br>
  <input type="text" name="about" value="{{$editSpeaker->about}}" placeholder="about"><br>
  <input type="text" name="company_name" value="{{$editSpeaker->company_name}}" placeholder="company_name"><br>
  <input type="text" name="position" value="{{$editSpeaker->position}}" placeholder="position"><br>
  <input type="text" name="recognitions" value="{{$editSpeaker->recognitions}}" placeholder="recognitions"><br>
  <input type="text" name="language" value="{{$editSpeaker->language}}" placeholder="language"><br>
  <input type="text" name="awards" value="{{$editSpeaker->awards}}" placeholder="awards"><br>
  <input type="text" name="ventures" value="{{$editSpeaker->ventures}}" placeholder="ventures"><br>
  <input type="text" name="exp_in_industry" value="{{$editSpeaker->exp_in_industry}}" placeholder="exp_in_industry"><br>
  <input type="text" name="events_attended" value="{{$editSpeaker->events_attended}}" placeholder="events_attended"><br>
  <input type="text" name="event_id" value="{{$editSpeaker->event_id}}" placeholder="event_id"><br>
  <input type="file" name="profile_image" accept="image/*"><br>
  <button value="submit">Save</button>
</form>
@endrole
@endsection
