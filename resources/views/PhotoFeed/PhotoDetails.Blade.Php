@extends('layouts.app')

@section('content')
<div class="container" >
  <div style="display:inline"> <!-- Previous Route -->
    <a href="{{url('photos',[$detail->event_id])}}" class="btn btn-primary" >Back</a>
  </div>
  <div style="position:relative">

    <div id="myCarousel" class="carousel slide" data-interval="500">
    <!-- Indicators -->
    <!-- <ol class="carousel-indicators">
      <li data-target="#myCarousel"  ></li>

    </ol> -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="{{URL::asset('storage/images/'.$detail->photos)}}" width="460" height="345">
      </div>

    </div>

    <!-- Left and right controls -->
    <!-- <a class="left carousel-control" href="#myCarousel" role="button">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a> -->
  </div>

  </div>
  <div class="col-sm-7" style="border-right:2px solid grey;margin-top:10px">
    <b></b>

      <div class="form-group">
        <form action="{{url('commentlike',[$detail->id])}}" method="post">
          <textarea style="width:100%" name="comments" placeholder="comments.."></textarea>
          <button class="btn btn-success" id="post" style="float:right">Post</button>
        </form>
      </div>

    <div><!--comments section-->
      <b style="color:tomato;display:block">{{ $showCounts }} Comments</b><hr>
      <table>
        @foreach($showComments as $msgs)
        <tr>
          <th>
            <img src="{{URL::asset('storage/images/'.$detail->photos)}}" width="75px" height="70px" class="img-circle" style="padding-top:5px">
          </th>
          <th>
            <b id="usr" style="color:tomato;padding-left:10px">{{$msgs->user->name}}</b>
            <p style="display:inline">{{ \Carbon\Carbon::parse($msgs->date)->diffForHumans()}}</p>
            <p id="show" style="padding-left:15px">{{$msgs->comments}}</p>
          </th>
        </tr>
        @endforeach
      </table>


        <!-- <div class="col-sm-2">
          @foreach($showComments as $msgs)
        <img src="{{URL::asset('storage/images/'.$detail->photos)}}" width="75px" height="70px" class="img-circle" style="padding-top:5px">
        @endforeach
      </div>
        <div class="col-sm-10">
          @foreach($showComments as $msgs)
          <div>
          <b>{{$msgs->user->name}} 4 days ago</b>
          <p id="show" >{{$msgs->comments}}</p>
        </div>
          @endforeach
        </div> -->
    </div><hr>
  </div>

  <div class="col-sm-5" style="margin-top:10px">
    <div class="col-sm-3 liking" style="text-align:center">
    <h2 id="take" value="1"><i class="fa fa-thumbs-up" data-toggle="tooltip" title="Like"></i></h2>

    </div>
    <div class="col-sm-3" style="text-align:center">
      <p>Uploaded By</p><b>{{$detail->user->name}}</b>
    </div>
    <div class="col-sm-3" style="text-align:center">

      <p>{{ $showCounts }} </p><h4>Comments</h4>

    </div>
    <div class="col-sm-3" style="text-align:center">

      <p id="counting">{{$likeCounts}}</p><h4>Likes</h4>
    </div>


  </div>
</div>


<script>
$(document).ready(function(){
    // Activate Carousel
    $("#myCarousel").carousel("pause");

    // Enable Carousel Controls
    $(".left").click(function(){
        $("#myCarousel").carousel("prev");
    });
    $(".right").click(function(){
        $("#myCarousel").carousel("next");
    });
});
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<script>

  $(document).ready(function(){
    $('#take').click(function(){
      var like_status = $(".liking > h2").attr("value");
      $.ajax({
        type:"post",
        url:'/like/{{$id}}',
        data:{like_status:like_status,"_token": "{{ csrf_token() }}"},
        dataType:"json",
        success:function(data){
          console.log(data);
          $( "#counting" ).append( "<strong>"+data.like_status+":</strong></br>");
          // var test  = jQuery.parseJSON(data);
          // $( "#show" ).append( "<strong>"+test.comments+":</strong></br>");
        },
      });
    });
  });
</script>

@endsection
