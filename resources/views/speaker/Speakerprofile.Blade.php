@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-1">
        <h3 style="display:inline-block"><a href="{{url('speaker',[$profile->event->id])}}">Back</a></h3>
      </div>
      <div class="col-sm-3">
        <img class="img-rounded" style="border:1px solid black" width="100%"
        src="{{ URL::asset('storage/images/'.$profile->profile_image) }}">
        <h3 style="text-align:center;margin: 10px 0px 0px 0px;">
          {{$profile->first_name}} {{$profile->last_name}}</h3>
        <p style="text-align:center; margin:0px">{{$profile->position}}</p>
        <p style="text-align:center; margin:0px; border-bottom:1px solid black">{{$profile->company_name}}</p>
        <div>
        <h3 class="vanish btn btn-success" id="sms">Send Message</h3>
          <form action="{{url('speakermsg',[$profile->user_id])}}"  method="POST"  id="form1" style="margin-top: 14px;">
            <textarea name="message" rows="8" cols="35" placeholder="Type.." style="width:100%"></textarea>
            <input type="hidden" name="date">
            <input class="btn btn-danger" id="cancel" value="Cancel" name="send" style="width:48%">
            <input class="btn btn-success" type="submit" value="Send" name="send" style="width:50%">
          </form>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="panel-group" id="accordion">
          <div class="panel panel-default wow fadInLef">
            <div class="panel-heading" style="background:pink">
              <h4 class="panel-title">
                <a  href="#{{$profile->id}}"
                  data-parent="#accordion" data-toggle="collapse" style="width:50%;">
                  <u>About</u></a>
              </h4>
            </div>
            <div id="{{$profile->id}}" class="panel-collapse collapse">
              <div class="pan el-body" style="background:azure">
                @if($profile->event_id)
                <p style="text-align:justify;padding: 10px;"><b>{{$profile->about}}</b></p>
                @elseif(empty($profile->event_id))
                <p style="text-align:justify;padding: 10px;">{{$profile->user->name}}
                  <b> has not shared anything about him</b></p>
                @endif
              </div>
            </div>
          </div>

          <div class="panel panel-default wow fadInLef">
            <div class="panel-heading" style="background:pink">
              <h4 class="panel-title">
                <a  href="#column2"
                  data-parent="#accordion" data-toggle="collapse" style="width:50%;">
                  <u>Sessions</u></a>
              </h4>
            </div>
            <div id="column2" class="panel-collapse collapse">
              <div class="panel-body" style="background:azure">
                <!-- <div class="col-sm-2"  style="padding: 0px;">
                </div> -->

                @foreach($info as $dec)
                <div style="border:1px solid grey">
                  <lable style="color:DodgerBlue">Session name:</lable>
                  <h4 style="text-align:justify;margin:0px;display:inline;color:tomato">{{$dec->description}}</h4><br>
                  <lable style="color:DodgerBlue">Event name:</lable>
                  <b style="text-align:justify">{{$dec->event->event_name}}</b>
                </div>
                @endforeach

              </div>
            </div>
          </div>

          <div class="panel panel-default wow fadInLef">
            <div class="panel-heading" style="background:pink">
              <h4 class="panel-title">
                <a  href="#column3"
                  data-parent="#accordion" data-toggle="collapse" style="width:50%;">
                  <u>Connect</u></a>
              </h4>
            </div>
            <div id="column3" class="panel-collapse collapse">
              <div class="panel-body" style="background:azure">
                @if(empty($profile->event_id))
                <b>There are no Networks of {{$profile->user->name}}</b>
                @elseif($profile->event_id)
                <p><b style="text-align:justify">{{$profile->first_name}}</b></p>
                @endif
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
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
