@extends('layouts.app')

@section('content')
<div class="col-sm-2"  style="">
  <ul class="lists" style="border:1px solid black">
    <li class="listsOrder"><a href="{{url('activityfeed',[$id])}}" >Activity Feed</a></li>
    <li class="listsOrder"><a class="active" href="{{url('agenda',[$id])}}">Agenda</a></li>
    <li class="listsOrder"><a href="{{url('partners',[$id])}}">Partners</a></li>
    <li class="listsOrder"><a href="{{url('attendee',[$id])}}">Attendees</a></li>
    <li class="listsOrder"><a href="{{url('promotion',[$id])}}">Promotions</a></li>
    <li class="listsOrder"><a href="{{url('discussion',[$id])}}">Discussion Channels</a></li>
    <li class="listsOrder"><a href="{{url('speakers',[$id])}}">Speakers</a></li>
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
<div class="col-sm-10" style="margin:0px 0px 0px 225px">
  <div class="container">
    <ul class="nav nav-tabs">
        <li class="active" style="width:35%"><a data-toggle="tab" href="#agends">Adenda</a></li>
        @role('speaker')
        <li style="width:35%"><a data-toggle="tab" href="#myagenda">My Agenda</a></li>
        @endrole
      </ul>

      <div class="tab-content">
        <div id="agends" class="tab-pane fade in active">
          <div class="container">
            <div class="panel-group" id="accordion">
              <?php $firstItem = true; ?>
              @if(!($showAgenda->isEmpty())) <!--$showById is in array format, isEmpty() to check array empty or not -->
               @foreach($showAgenda as $agendas)

               <div class="panel panel-default wow fadInLef">
                 <div class="panel-heading" style="background:pink">
                   <h4 class="panel-title" >
                     <a aria-expanded="<?php echo ($firstItem ? 'true' : 'false');?>" href="#{{$agendas->id}}"
                       data-parent="#accordion" data-toggle="collapse" style="width:50%" value="{{$agendas->description}}" id="agend">
                       <u >{{$agendas->description}}</u></a>
                       @role('speaker')
                       <button value="{{$agendas->id}}" class="agendaId btn btn-success">Add to MyAgenda</button>
                       @endrole
                       <span class="require">{{ $errors->first('user_id') }}</span>
                   </h4>
                 </div>
                 <div id="{{$agendas->id}}" class="panel-collapse collapse<?php echo ($firstItem ? ' in' : '');?>">
                   <div class="panel-body" style="background:azure">
                     <b style="color:blue">Details:</b><br>
                     <b>Timings:</b><b>{{$agendas->start_time}}</b> to <b>{{$agendas->end_time}}</b><br>
                     <b>Date:</b><b>{{$agendas->date}}</b><br>
                     <b>venue:</b><b>{{$agendas->venue->venue_name}}</b><br>
                     <b>description:</b><b>{{$agendas->description}}</b><br>
                     <b>Speaker:</b><b>{{$agendas->speaker->first_name}}</b><br>
                   </div>
                 </div>
               </div>
               <?php $firstItem = false; ?>
               @endforeach
               @else
                <h3>This Event does not Have Any Agenda Right Now</h3>
               @endif
            </div>
          </div>
        </div>
        <div id="myagenda" class="tab-pane fade">
            <p id="disp"></p>
            @foreach($myAgenda as $key)
            @foreach($showAgenda as $val)
            @if($key->event__days_infos_id == $val->id)
            <p>{{$val->description}}</p>
            @endif
            @endforeach
            @endforeach
        </div>
      </div>
  </div>

</div>
<script>
$(document).ready(function(){
  $('.agendaId').click(function(){
       var task_id = $(this).val();
       var agendaa = $("#agend").val();
       console.log(agendaa);
      $.ajax({
          type: "post",
          url: '/agenda',
          data:{task_id:task_id,agendaa:agendaa,"_token": "{{ csrf_token() }}"},
          dataType:"json",
          success: function (data) {
              console.log(data);
              $( "#disp" ).append( "<strong>"+data.description+":</strong></br>");
              //document.getElementById('disp').innerHTML=data.description;
          },
          error: function (data) {
              console.log('Error:', data);
          }
      });
  });
});
  </script>

@endsection
