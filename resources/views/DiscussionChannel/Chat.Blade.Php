@extends('layouts.app')

@section('content')
<div class="col-sm-1">
  <h3 style="display:inline-block"><a href="{{ url()->previous() }}">Back</a></h3>
</div>
<div class="col-sm-7" style="border:1px solid black;height:-webkit-fill-available;padding:0px" >
<p id="power"></p>
<div style="position:fixed;bottom:0;" class="form-group">
<input type="hidden" name="_token" value="{{ csrf_token() }}" >
<input type="hidden" name="user" id="user_name" value="{{ Auth::user()->name }}" >
@if(count($showJoin) > 0)
<div>
  <input type="text" name="contents" id="contents" onkeyup="storeMsg()" placeholder="type here" style="width: 670px;height: 37px;">
  <input type="button" value="Send" onclick="storeData()" class="btn btn-success send-msg">
</div>
@else
<div class="Joining">
  <span>your watching previous chats. Click on Join to get updates and to join group</span>
  <button value="{{ Auth::user()->id }}" type="submit" class="btn btn-success" id="joinDiscuss">Join</button>
</div>
@endif

<div style="display:none" class="textMsg">
  <input type="text" name="contents" id="contents" onkeyup="storeMsg()" placeholder="type here" style="width: 670px;height: 37px;">
  <input type="button" value="Send" onclick="storeData()" class="btn btn-success send-msg">
</div>

</div>
</div>

<div class="col-sm-4">
  <div style="border:1px solid salmon">
    <h3>Channel Info</h3>
      @if(!(empty($chats)))
      <b>{{$chats->discussion->channel_info}}</b>
      @else
      <b></b>
      @endif
  </div>
  <div style="border:1px solid salmon">
    <h3>Participation List</h3>
    @foreach($joined as $alreadyJoined)
    <b>{{$alreadyJoined->user->name}}</b>
    @endforeach
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<script>
    var socket = io('http://localhost:8888');
    socket.on('message1', function (content) {
        data = jQuery.parseJSON(content);
        console.log(data);
        $( "#power" ).append( "<strong>"+data.name+":</strong><p>"+data.messages+"</p>" );
      });
    function storeData()
    {
      var contents = document.getElementById('contents').value;
      $.ajax({
        url:'/send/{{$id}}',
        type:'POST',
        data:{contents:contents,"_token": "{{ csrf_token() }}"},
        dataType:'JSON',
        success:function(data)
          {
            console.log(data.messages);
             //$('#power').append("<li>"+data.messages+"</li>");
            document.getElementById('contents').value = null;
          }
      });
    }
</script>

<script>// This script is executed when user presses enter
    var socket = io('http://localhost:8890');
    socket.on('message1', function (content) {
        data = jQuery.parseJSON(content);
        $( "#power" ).append( "<strong>"+data.name+":</strong><p>"+data.messages+"</p>" );
      });
    function storeMsg()
    {
      var contents = document.getElementById('contents').value;
      document.onkeydown=function(evt){
        var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
        if(keyCode == 13)
        {
          $.ajax({
            url:'/send',
            type:'POST',
            data:{contents:contents,"_token": "{{ csrf_token() }}"},
            dataType:'JSON',
            success:function(data)
              {
                document.getElementById('contents').value=null;
              }
          });
        }
    }
  }
</script>
<script>
var socket = io('http://localhost:8890');
socket.on('chatJoin', function (joined) {
    data = jQuery.parseJSON(joined);
    console.log(data);
    $( ".textMsg" ).show();
  });

  $(document).ready(function(){
    $('#joinDiscuss').click(function(){
      var take=$(this).val();
      $(".Joining").hide();
      $(".textMsg").show();

  $.ajax({
    url:'/join/{{$id}}',
    type:'POST',
    data:{user_id:take,"_token": "{{ csrf_token() }}"},
    dataType:'JSON',
    success:function(data)
      {
        console.log(data.user_id);
         $('.textMsg').show();
        //document.getElementById('contents').value=null;
      }
  });
});
});

</script>

@endsection
