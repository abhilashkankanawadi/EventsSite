@extends('layouts.app')

@section('content')
<div class="col-sm-2"  style="">
  <ul class="lists" style="border:1px solid black">
    <li class="listsOrder"><a href="{{url('activityfeed',[$id])}}">Activity Feed</a></li>
    <li class="listsOrder"><a href="{{url('agenda',[$id])}}">Agenda</a></li>
    <li class="listsOrder"><a href="{{url('partners',[$id])}}">Partners</a></li>
    <li class="listsOrder"><a href="{{url('attendee',[$id])}}">Attendees</a></li>
    <li class="listsOrder"><a href="{{url('promotion',[$id])}}">Promotions</a></li>
    <li class="listsOrder"><a href="{{url('discussion',[$id])}}">Discussion Channels</a></li>
    <li class="listsOrder"><a href="{{url('speaker',[$id])}}" class="active">Speakers</a></li>
    <!-- <li class="listsOrder"><a href="#about">Bookmark</a></li> -->
    <li class="listsOrder"><a href="{{url('details',[$id])}}">Conference Details</a></li>
    <li class="listsOrder"><a href="{{url('meeting',[$id])}}">Meeting Planner</a></li>
    <li class="listsOrder"><a href="{{url('photos',[$id])}}">Photo Feed</a></li>
    <li class="listsOrder"><a href="#about">Videos</a></li>
    <li class="listsOrder"><a href="#about">Presentations</a></li>
    <li class="listsOrder"><a href="#about">Local Attractions</a></li>
    <li class="listsOrder"><a href="#about">Contact EventsApp</a></li>
    <li class="listsOrder"><a href="#about">surveys</a></li>
    <li class="listsOrder"><a href="#about">Polls</a></li>
    <li class="listsOrder"><a href="#about">Maps</a></li>
    <li class="listsOrder"><a href="#about">Conference Details</a></li>
  </ul>
</div>


<div class="col-sm-10" >
  @if(!($showSpeaker->isEmpty()))
  @foreach($showSpeaker as $deligate)
      <div class="col-sm-1" style="padding:0px">
        <img width="100%" class="img-circle" src="{{ URL::asset('storage/images'.$deligate->profile_image) }}">
      </div>
      <div class="col-sm-10" style="padding:0px">
        <h2 class="name" style=""><a href="{{url('speakerprofile',[$deligate->id])}}"><span>{{$deligate->user->name}}</span>
          </a></h2>
          <span style="display:block;">{{$deligate->company}}</span>
      </div>

  @endforeach
  @else
    <h3>There are no attendees for the Event</h3>
  @endif
  <div style="text-align:center">
    {!! $showSpeaker->links() !!}
  </div>
</div>

@endsection
