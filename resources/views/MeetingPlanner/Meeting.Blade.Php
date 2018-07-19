@extends('layouts.app')

@section('content')
<div class="col-sm-2"  style="padding:0px">
  <ul class="lists" style="border:1px solid black">
    <li class="listsOrder"><a href="{{url('activityfeed',[$id])}}" >Activity Feed</a></li>
    <li class="listsOrder"><a href="{{url('agenda',[$id])}}">Agenda</a></li>
    <li class="listsOrder"><a href="{{url('partners',[$id])}}">Partners</a></li>
    <li class="listsOrder"><a href="{{url('attendee',[$id])}}">Attendees</a></li>
    <li class="listsOrder"><a href="{{url('promotion',[$id])}}">Promotions</a></li>
    <li class="listsOrder"><a href="{{url('discussion',[$id])}}">Discussion Channels</a></li>
    <li class="listsOrder"><a href="{{url('speaker',[$id])}}">Speakers</a></li>
    <!-- <li class="listsOrder"><a href="#about">Bookmark</a></li> -->
    <li class="listsOrder"><a href="{{url('details',[$id])}}">Conference Details</a></li>
    <li class="listsOrder"><a class="active" href="{{url('meeting',[$id])}}">Meeting Planner</a></li>
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
  @foreach($AllUsers->users as $AllUser)
   <!--fetching data using many-many relation-->
  <div class="row">
      <div class="col-sm-9" style="padding:0px">
        <h2 class="name" style=""><a href="{{url('deligate',[$AllUser->id])}}">
          @if($AllUser->id != Auth::user()->id) <!--ignore auth user in the list-->
          <span>{{$AllUser->name}}</span></a>
          @endif
        </h2>
          <span style="display:block;">{{$AllUser->company}}</span>
          <button class="btn btn-warning" style="display: none;" id="events" value="{{$AllUser->event_id}}"></button>
      </div>

      <div class="col-sm-2 follows" style="padding:0px;">
         @if(($AllUser->id) != (Auth::user()->id)) <!--ignore auth user in the list-->
        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$AllUser->id}}">Request Meeting</button>
        @endif
      </div>

    </div>
@endforeach
  

  @foreach($AllUsers->users as $AllUser) <!--using foreach to get "request_to value"-->
  <!--Model below-->
  <div class="modal fade" id="myModal{{$AllUser->id}}" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal header</h4>
        </div>
        <div class="modal-body">
          <form action="{{url('requestmeet',[$id])}}" method="post" onsubmit="buttonChange()">
            <div class="form-group row">
              <div class="col-xs-6">
                <label for="ex1">Meeting Purpose</label>
                <textarea class="form-control" id="ex1" cols="25" rows="1" name="meeting_purpose" placeholder="Meeting purpose">
            </textarea>
              </div>
              
              <div class="col-xs-6">
                <label for="ex3">Select time</label>
                <select  class="form-control" id="ex3" name="time">
                  <option>select time</option>
                  <option value="9AM-12PM">9AM-12PM</option>
                  <option value="12PM-03PM">12PM-03PM</option>
                  <option value="03PM-06PM">03PM-06PM</option>
                </select>
              </div>
              <div class="col-xs-6">
                <label for="ex3">select Location</label>
                <select  class="form-control" id="ex3" name="location">
                  <option >select Place</option>
                  <option value="Bengaluru">Bengaluru</option>
                  <option value="Mysore">Mysore</option>
                  <option value="Chennai">Chennai</option>
                </select>
              </div>
              <div class="col-xs-6">
                  <label for="sl2"></label>
                    <select  class="form-control" id="sel2" name="meeting_date">
                      <option >Select Date</option>
                      <option value="01-02-2018">01-02-2018</option>
                      <option value="02-02-2018">02-02-2018</option>
                      <option value="03-02-2018">03-02-2018</option>
                    </select>
              </div>
                <input type="hidden" name="request_to" value="{{$AllUser->id}}"><!--getting request_to-->
            
          <button class="btn btn-primary">submit</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
@endforeach
<script type="text/javascript">
$(document).ready(function(){
  $("form").submit(function(){
    $("req").hide();
    $("done").show();
  });
});
</script>

@endsection
