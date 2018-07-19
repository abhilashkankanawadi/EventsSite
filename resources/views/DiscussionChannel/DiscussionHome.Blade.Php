@extends('layouts.app')

@section('content')
<div class="col-sm-2"  style="">
  <ul class="lists" style="border:1px solid black">
    <li class="listsOrder"><a href="{{url('activityfeed',[$id])}}" >Activity Feed</a></li>
    <li class="listsOrder"><a href="{{url('agenda',[$id])}}">Agenda</a></li>
    <li class="listsOrder"><a href="{{url('partners',[$id])}}">Partners</a></li>
    <li class="listsOrder"><a href="{{url('attendee',[$id])}}">Attendees</a></li>
    <li class="listsOrder"><a href="{{url('promotion',[$id])}}">Promotions</a></li>
    <li class="listsOrder"><a class="active" href="{{url('discussion',[$id])}}">Discussion Channels</a></li>
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
<div class="col-sm-10">
  <div class="col-sm-9">
    <table class="table table-bordered table-hover">
    <thead>
      <tr style="background:#ff9933;color:white">
        <th>#</th>
        <th>Title</th>
        <th>Images</th>
        <th>Channel Info</th>
      </tr><?php $i=0?>
    </thead>
    <tbody><?php $i++;?>
      @foreach($discuss as $channels)
      <tr>
        <td>{{$i++}}</td>
        <td>{{$channels->title}}</td>
        <td><img class="img-rounded" style="border:1px solid black;" width="130px" height="130px" src="{{ URL::asset('storage/images/'.$channels->images) }}"></td>
        <td><a href="{{url('chat',[$channels->id])}}"><button class="btn btn-primary">Channel Info</button></a></td>
      </tr>
      <!-- {{ Carbon\Carbon::parse($channels->date)->diffForHumans() }} -->
      @endforeach
      {{ $discuss->links() }}
    </tbody>
  </table>

  <!-- <div class="container">
    <img src="img_avatar.png" alt="Avatar" class="image" style="width:100%">
    <div class="middle">
      <div class="text">John Doe</div>
    </div>
  </div> -->

  </div>
  <div class="col-sm-3">
    <!-- <a href="{{url('newdiscussion')}}"><button class="btn btn-success" style="width:100%">New Channel</button></a> -->

    <h3 class="vanish btn btn-success" id="sms">New Channel</h3>
      <form action="{{url('addnew',[$id])}}"  method="POST"  id="form1" enctype="multipart/form-data">
        <div class="form-group">
          <input type="text" name="title" placeholder="title" class="form-control">
          <input type="text" name="channel_info" placeholder="enter info" class="form-control">
          <!-- <input type="text" name="max_participants" placeholder="participant(number)" class="form-control"> -->
          <input type="file" name="images" class="form-control">
          <input class="btn btn-success" type="submit" value="Send" name="send" style="width:100%">
        </div>
      </form>
  </div>

  <script>
    $(document).ready(function(){
      $("#sms").click(function(){
        $(".vanish").hide('slow');
        $( "#form1" ).toggle( 'slow' );
      });
    });
  </script>
</div>
@endsection
