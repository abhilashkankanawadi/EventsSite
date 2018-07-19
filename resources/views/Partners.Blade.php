@extends('layouts.app')

@section('content')
<div class="col-sm-2"  style="">
  <ul class="lists" style="border:1px solid black">
    <li class="listsOrder"><a href="{{url('activityfeed',[$id])}}">Activity Feed</a></li>
    <li class="listsOrder"><a href="{{url('agenda',[$id])}}">Agenda</a></li>
    <li class="listsOrder"><a href="{{url('partners',[$id])}}" class="active">Partners</a></li>
    <li class="listsOrder"><a href="{{url('attendee',[$id])}}">Attendees</a></li>
    <li class="listsOrder"><a href="{{url('promotion',[$id])}}">Promotions</a></li>
    <li class="listsOrder"><a href="#">Discussion Channels</a></li>
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
  <div class="container">

    <ul class="nav nav-tabs">
        <li class="active" style="width:35%"><a data-toggle="tab" href="#agends">Partners List</a></li>
        <li style="width:35%"><a data-toggle="tab" href="#myagenda" class="cats">Category</a></li>
      </ul>

      <div class="tab-content">
        <div id="agends" class="tab-pane fade in active">
          <div class="container">
            <div class="panel-group" id="accordion">
              @if(!($partner->isEmpty())) <!--$showById is in array format, isEmpty() to check array empty or not -->
               @foreach($partner as $sponser)

               <div class="panel panel-default wow fadInLef">
                 <div class="panel-heading" style="background:pink">
                   <h4 class="panel-title">
                     <a  href="#{{$sponser->id}}"
                       data-parent="#accordion" data-toggle="collapse" style="width:50%">
                       <u>{{$sponser->company_name}} <i class="fa fa-plus"></i></u></a>

                   </h4>
                 </div>
                 <div id="{{$sponser->id}}" class="panel-collapse collapse">
                   <div class="panel-body" style="background:azure">
                     <b style="color:blue">Details:</b><br>
                     <span>Company:</span><p><b>{{$sponser->company_name}}</b></p><hr>
                     <span>Booth Staff:</span><p><b>{{$sponser->booth_staff}}</b></p><hr>
                     <span>Category:</span><p><b>{{$sponser->partnership->category_type}}</b></p><hr>
                     <span>About:</span><p><b>{{$sponser->description}}</b></p><hr>
                     <span>Contact:</span>
                     <p><b><i class="fa fa-globe" style="font-size:20px;"></i> {{$sponser->website}}</b></p>
                     <p><b><i class="fa fa-envelope-o" style="font-size:20px;"></i> {{$sponser->email}}</b></p>
                     <p><b><i class="fa fa-phone" style="font-size:20px;"></i> {{$sponser->phone}}</b></p><hr>
                     <!-- <p><b><i class="fa fa-phone" style="font-size:20px;"></i> {{$sponser->partnership->category_type}}</b></p><hr> -->
                   </div>
                 </div>
               </div>
               @endforeach
               @else
                <h3>This Event does not Have Partners Right Now</h3>
               @endif
            </div>
          </div>
        </div>
        <!-- fetching data from partnerCategory table comparing event_id -->


<div  id="myagenda" class="tab-pane fade in">
          <div class="container">
            <div class="panel-group" id="accordion">
              @foreach($partnerCategory as $cate)
            <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#{{$cate->id}}">
                  <u>{{$cate->category_type}} <i class="fa fa-plus"></i></u>
                </a>
              </h4>
            </div>
            <div id="{{$cate->id}}" class="panel-collapse collapse in">

              <div class="panel-body">
                @if($cate->id ==$testing[0]->partnership_category_id)
                @foreach($testing as $taking)
                <p>{{$taking->first_name}}</p>
                @endforeach
                @else
                <p>There are no partners for this category</p>
                @endif

              </div>


            </div>
            </div>
            @endforeach
            </div>
            </div>
          </div>

<!-- @foreach($testing as $taking)

                 @if($cate->id == $taking->partnership_category_id)

                <p>{{$taking->first_name}}</p>
                @else
                <p></p>
                @endif

                @endforeach -->



      </div>




  </div>
</div>

@endsection
