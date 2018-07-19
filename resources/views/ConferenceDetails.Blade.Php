@extends('layouts.app')

@section('content')
<div class="col-sm-2"  style="">
  <ul class="lists" style="border:1px solid black">
    <li class="listsOrder"><a href="{{url('activityfeed',[$id])}}" >Activity Feed</a></li>
    <li class="listsOrder"><a href="{{url('agenda',[$id])}}">Agenda</a></li>
    <li class="listsOrder"><a href="{{url('partners',[$id])}}">Partners</a></li>
    <li class="listsOrder"><a href="{{url('attendee',[$id])}}">Attendees</a></li>
    <li class="listsOrder"><a href="{{url('promotion',[$id])}}">Promotions</a></li>
    <li class="listsOrder"><a href="{{url('discussion',[$id])}}">Discussion Channels</a></li>
    <li class="listsOrder"><a href="{{url('speaker',[$id])}}">Speakers</a></li>
    <!-- <li class="listsOrder"><a href="{{url('attendee',[$id])}}">Bookmark</a></li> -->
    <li class="listsOrder"><a class="active" href="{{url('details',[$id])}}">Conference Details</a></li>
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
<div class="col-sm-10">
  <table class="table table-bordered table-hover">
  <thead>
    <tr style="background:#ff9933;color:white">
      <th>#</th>
      <th>Conference Name</th>
      <th>Date</th>
      <th>Time</th>
      <th>Location</th>
    </tr><?php $i=0?>
  </thead>
  @foreach($disp as $detail)
  <tbody><?php $i++;?>
    <tr>
      <th scope="row" >{{$i}}</th>
      <td>{{$detail->event_name}}</td>
      <td>{{$detail->start_date}}</td>
      <td>{{$detail->start_time}}-{{$detail->end_time}}</td>
      <td>{{$detail->venue}}</td>
    </tr>
  </tbody>
  @endforeach
</table>
</div>
@endsection
