@extends('layouts.app')

@section('content')
<div class="col-sm-2"  style="padding:0px">
  <ul class="lists" style="border:1px solid black">
    <li class="listsOrder"><a href="{{url('activityfeed',[$id])}}" >Activity Feed</a></li>
    <li class="listsOrder"><a href="{{url('agenda',[$id])}}">Agenda</a></li>
    <li class="listsOrder"><a href="{{url('partners',[$id])}}">Partners</a></li>
    <li class="listsOrder"><a class="active" href="{{url('attendee',[$id])}}">Attendees</a></li>
    <li class="listsOrder"><a href="{{url('promotion',[$id])}}">Promotions</a></li>
    <li class="listsOrder"><a href="{{url('discussion',[$id])}}">Discussion Channels</a></li>
    <li class="listsOrder"><a href="{{url('speaker',[$id])}}">Speakers</a></li>
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
  @if(!($Attendees->isEmpty()))
  @foreach($Attendees as $deligate)
  <div class="row">
      <div class="col-sm-1" style="paddingleft:10px">
        <img width="100%" class="img-circle" src="{{ URL::asset('storage/images'.$deligate->profile_image) }}">
      </div>
      <div class="col-sm-10" style="padding:0px">
        <h2 class="name" style=""><a href="{{url('attendeeprofile',[$deligate->user_id])}}">
          <span>{{$deligate->user->name}}</span>
          </a>
        </h2>
          <span style="display:block;">{{$deligate->company}}</span>
      </div>
      <span id="event" style="display: none;">{{$deligate->event->id}}</span>
      <div class="col-sm-1 follows" style="padding:0px">
        <!-- check whether auth user following the attendee -->
        @if($followCount == null)
        
        <h2 data-id="{{ $deligate->id }}"><i class="fa fa-user-plus" data-toggle="tooltip" title="follow" ></i>
        </h2>
        @else
        <h2 id="unfollow" value="1"><i class="fa fa-thumbs-up" data-toggle="tooltip" title="unfollow" style="color: #ff9933" id="test"></i>
        </h2>
        @endif
        <!-- below h2 tags are used for onlick events -->
        <h2 id="request" value="1" style="display:none"><i class="fa fa-user-plus" data-toggle="tooltip" title="follow" ></i>
        </h2>
        <h2 id="remove" value="1" style="display:none"><i class="fa fa-thumbs-up" data-toggle="tooltip" title="unfollow" style="color: #ff9933" id="test"></i>
        </h2>

      </div>

</div>
  @endforeach
  @else
    <h3>There are no attendees for the Event</h3>
  @endif

  <div style="text-align:center">
    {!! $Attendees->links() !!} 
  </div>
</div>
  <script>
  $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
  });
  </script>

<script type="text/javascript">
$(document).on('click', '.follows > h2', function (e) {
    var follow_status = $(this).attr('data-id');
    console.log(follow_status);
    // Do whatever else you need to do.
    $.ajax({
          type: "post",
          url: '/folls/{{$id}}',
          data:{follow_status:follow_status,"_token": "{{ csrf_token() }}"},
          dataType:"json",
          success: function (data) {
              console.log(data);
              //$( "#disp" ).append( "<strong>"+data.description+":</strong></br>");
              //document.getElementById('disp').innerHTML=data.description;
          },
          error: function (data) {
              console.log('Error:', data);
          }
      });
});

</script>

  <script>
    $(document).ready(function(){
      $("#sms").click(function(){
        $(".vanish").hide('slow');
        $( "#form1" ).toggle( 'slow' );
      });
    });
  </script>
  <script>
    $(document).ready(function(){
      $("#cancel").click(function(){
        $("#form1").hide();
        $("#sms").show();
      });
    });
  </script>

@endsection
