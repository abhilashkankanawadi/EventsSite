@extends('layouts.app')

@section('content')
<div>
  <img src="images/banner.jpg" width="100%" style="position:relative;background-repeat: no-repeat;">
  <a href="#upcoming" class="right-link event" ><p style="color:white;font-size: 23px;">Upcoming Events</p></a>
  <a href="#past" class="left-link event"><p style="color:white;font-size: 23px;">Past Events</p></a>
</div>
<!-- Upcoming Events section -->
<div style="background-image: url(images/pastBan.jpg);box-shadow: 10px 10px 5px grey;" id="upcoming" >
  <h2 style="text-align:center;margin:0px;color: seashell;font-family: -webkit-pictograph;">
    @role(['admin','organiser']) <!--Only Admin, organiser can create new event-->
    <a href="{{url('createEvent')}}" style="float:left">Create Event</a>
    @endrole
    UpComing Events
    <a href="{{url('upcoming')}}" style="float:right"><b>See All Upcoming Events..</b></a>
  </h2>
  @foreach ($fetches as $num)
  @if(  Carbon\Carbon::parse('now') < ($num->start_date) )

    <div style="display: inline-block;width: 305px;height: 360px;margin: 3px;border: 3px solid tomato;background-color:aliceblue;box-shadow: 10px 10px 5px grey;" class="shad">
    <div style="height:65%;border:1px solid tomato;">
      <img width="100%" height="100%" src="{{ URL::asset('storage/images/'.$num->images) }}">
    </div>
    <div style="font-family: -webkit-pictograph;color:tomato">
      <a href="{{url('activityfeed',[$num->id])}}" style="color:tomato" >
      <h3 style="margin:2px;">{{$num->event_name}}</h3>
      <b>venue:</b><h4 style="margin:0px;display:inline">{{$num->venue}}</h4><br>
      <b>Time:</b><b>{{ \Carbon\Carbon::parse($num->start_date)->diffForHumans()}}</b><br>
      </a>
    </div>
    @role(['admin','organiser']) <!--Only Admin, organiser can update the event-->
    <a href="{{url('home',[$num->id])}}">update</a>
    @endrole
  </div>
  @endif
  @endforeach
</div>

<!-- Past Events section -->
<div style="background-image: url(images/back.jpg);box-shadow: 10px 10px 5px grey;" id="past">
  <h2 style="text-align:center;margin:0px;color: blue;font-family: -webkit-pictograph;">Past Events
  <a href="{{url('pastevents')}}" style="float:right"><b>See All Past Events..</b></a>
  </h2>
  @foreach ($fetches as $num)
  @if( Carbon\Carbon::parse($num->start_date)->isPast() )
  <a href="{{url('activityfeed',[$num->id])}}" >
    <div style="display: inline-block;width: 308px;height: 360px;margin: 2px;border: 3px solid tomato;background-color:aliceblue;box-shadow: 10px 10px 5px grey;" >
    <div style="height:65%;border:1px solid tomato;">
      <img width="100%" height="100%" src="{{ URL::asset('storage/images/'.$num->images) }}">
    </div>
    <div style="font-family: -webkit-pictograph;color:tomato">
      <h3 style="margin:2px;">{{$num->event_name}}</h3>
      <b>venue:</b><h4 style="margin:0px;text-align:justify;display:inline">{{$num->venue}}</h4><br>
      <b>posted:</b><b>{{ \Carbon\Carbon::parse($num->start_date)->diffForHumans()}}</b>
    </div>
    @role(['admin','organiser']) <!--Only Admin, organiser can update the event-->
    <a href="{{url('home',[$num->id])}}">update</a>
    @endrole
    </div>
  </a>
  @endif
  @endforeach
</div>

@endsection
