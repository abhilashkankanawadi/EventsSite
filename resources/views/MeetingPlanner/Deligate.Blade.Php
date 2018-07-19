@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      @if(Request::is('attendeeRequest/{{$AttDetails->id}}'))
      <div class="col-sm-1">
        <h3 style="display:inline-block"><a href="{{url('meeting',[$AttDetails->event_id])}}">Back</a></h3>
      </div>
      <div class="col-sm-3">
        <img class="img-rounded" style="border:1px solid black" width="100%" src="{{ URL::asset('storage/images/'.$AttDetails->profile_image) }}">
        <h3 style="text-align:center;margin: 10px 0px 0px 0px;">{{$AttDetails->first_name}} {{$AttDetails->last_name}}</h3>
        <p style="text-align:center; margin:0px">{{$AttDetails->position}}</p>
        <p style="text-align:center; margin:0px; border-bottom:1px solid black">{{$AttDetails->company}}</p>
        <div>
        <h3 class="vanish btn btn-success" id="sms">Send Message</h3>
          <form action="{{url('attendeeprofile',[$AttDetails->id])}}"  method="Post"  id="form1" style="margin-top: 14px;">
            <textarea name="message" rows="8" cols="35" placeholder="Type.." style="width:100%"></textarea>
            <input class="btn btn-danger" id="cancel" value="Cancel" name="send" style="width:48%">
            <input class="btn btn-success" type="submit" value="Send" name="send" style="width:50%">
          </form>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="panel-heading" style="background:pink">
          <h4 class="panel-title">
                About
             </h4>
        </div>
        <div style="background:azure">
          @if($AttDetails->event_id)
               <p style="text-align:justify;padding: 10px;"><b>{{$AttDetails->about}}</b></p>
               @elseif(empty($AttDetails->event_id))
               <p style="text-align:justify;padding: 10px;">{{$AttDetails->user->name}}
                <b> has not shared anything about him</b></p>
             @endif
        </div>
      </div>
      
    
    @elseif( Request::is('partnerRequest/$partDetails'))
      <div class="col-sm-1">
        <h3 style="display:inline-block"><a href="{{url('attendee',[$PartDetails->event_id])}}">Back</a></h3>
      </div>
      <div class="col-sm-3">
        <img class="img-rounded" style="border:1px solid black" width="100%" src="{{ URL::asset('storage/images/'.$PartDetails->profile_image) }}">
        <h3 style="text-align:center;margin: 10px 0px 0px 0px;">{{$PartDetails->first_name}} {{$PartDetails->last_name}}</h3>
        <p style="text-align:center; margin:0px">{{$PartDetails->position}}</p>
        <p style="text-align:center; margin:0px; border-bottom:1px solid black">{{$PartDetails->company}}</p>
        <div>
        <h3 class="vanish btn btn-success" id="sms">Send Message</h3>
          <form action="{{url('attendeeprofile',[$PartDetails->id])}}"  method="Post"  id="form1" style="margin-top: 14px;">
            <textarea name="message" rows="8" cols="35" placeholder="Type.." style="width:100%"></textarea>
            <input class="btn btn-danger" id="cancel" value="Cancel" name="send" style="width:48%">
            <input class="btn btn-success" type="submit" value="Send" name="send" style="width:50%">
          </form>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="panel-heading" style="background:pink">
          <h4 class="panel-title">
                About
             </h4>
        </div>
        <div style="background:azure">
          @if($PartDetails->event_id)
               <p style="text-align:justify;padding: 10px;"><b>{{$PartDetails->about}}</b></p>
               @elseif(empty($PartDetails->event_id))
               <p style="text-align:justify;padding: 10px;">{{$PartDetails->user->name}}
                <b> has not shared anything about him</b></p>
             @endif
        </div>
      </div>
    @endif
    
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
