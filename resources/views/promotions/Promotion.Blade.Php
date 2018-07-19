@extends('layouts.app')

@section('content')
<div class="col-sm-2"  style="padding:0px">
  <ul class="lists" style="border:1px solid black">
    <li class="listsOrder"><a href="{{url('activityfeed',[$id])}}" >Activity Feed</a></li>
    <li class="listsOrder"><a href="{{url('agenda',[$id])}}">Agenda</a></li>
    <li class="listsOrder"><a href="{{url('partners',[$id])}}">Partners</a></li>
    <li class="listsOrder"><a href="{{url('attendee',[$id])}}">Attendees</a></li>
    <li class="listsOrder"><a class="active"  href="{{url('promotion',[$id])}}">Promotions</a></li>
    <li class="listsOrder"><a href="{{url('discussion',[$id])}}">Discussion Channels</a></li>
    <li class="listsOrder"><a href="{{url('speaker',[$id])}}">Speakers</a></li>
    <!-- <li class="listsOrder"><a href="{{url('attendee',[$id])}}">Bookmark</a></li> -->
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

<div class="col-sm-10" style="margin:20px 0px 0px 225px">
  <div class="col-sm-8" style="height:600px;overflow-y:scroll">
    @if($promo)
    @foreach($promo as $promotions)
    <div style="width:100%;border:1px solid red; height:auto; margin-top:5px">
      <div style="border-bottom: 1px solid lightgrey;">
        <i class="fa fa-user" aria-hidden="true" style="font-size:50px"></i>
        <h4 style="display:inline;"><b style="color:tomato">{{$promotions->user->name}}</b></h4>&nbsp;
        <span>posted on</span>
        <span style="color:tomato">{{$promotions->start_date}}</span>
      </div>
      <h5 style="text-align:justify"><b>"<a href="{{url('activityfeed',[$id])}}">
        {{$promotions->url }}</a> {{$promotions->description}}"</b></h5>
    </div>
    @endforeach
    @else
    <h3>No promotional messages</h3>
    @endif
  </div>

  <div class="col-sm-4">
      <!-- <a href="{{url('addpost',[$id])}}"><span style="color: white;">Add Content</span></a>
      <form action=""  method="POST"  id="form1">
        <textarea name="name" rows="8" cols="35" placeholder="Type.." style="width:100%"></textarea>
        <input class="btn btn-success" type="submit" value="Send" name="send" style="width:100%">
      </form>
      <div> -->
      <h2 style="text-align:center;color:#FF00FF;">Do you want to Promote your product/Event??</h2>
      <h3 class="vanish btn btn-success" id="sms" style="margin:0px">Click Here</h3>
        <form action="{{url('postPromotion',[$id])}}"  method="POST"  id="form1" enctype="multipart/form-data">
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Event/Product Name">
            <textarea name="description" rows="4" cols="35" placeholder="What's on your mind?" style="width:100%">
            </textarea>
            <input type="text" name="url" placeholder="url" class="form-control">
            <input type="date" name="start_date" class="form-control">
            <input class="btn btn-danger" id="cancel" value="cancel" style="width:49%">
            <input class="btn btn-success" type="submit" value="Send" name="send" style="width:49%">
          </div>
        </form>
      </div>
  </div>
<script>
$(document).ready(function(){
  $('#sms').click(function(){
    $('#form1').show('slow');
    $('#sms').hide('slow');
  });
});
$(document).ready(function(){
  $('#cancel').click(function(){
    $('#form1').hide('slow');
    $('#sms').show('slow');
  });
});
</script>
@endsection
