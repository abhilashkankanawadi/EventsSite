
@role('organiser')
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
    <!--in meeting_request table organiser_review count grater than 0, notification bell color changes-->
      @if($nots == 0)
      <span class="glyphicon glyphicon-bell" style="font-size:20px"></span>
      @elseif($nots > 0)
      <span class="glyphicon glyphicon-bell" style="font-size:20px;color:DodgerBlue"><span class="badge" style="background-color:tomato;margin-left:-6px;margin-bottom:11px">
        {{$nots}}</span></span>
      @endif
    </a>
    <ul class="dropdown-menu" style="height:250px;overflow:auto">
    	@foreach($latest as $late)
    <li><a href="{{url('organiser',[$late->event_id])}}">
        @if($late->organiser_review == 0)
        <div  style="color:red">
            <h4>
                {{$late->userRequestedBy->name}}
                requests {{$late->userRequestedto->name}}</h4>
        </div>
           
        @else
        <div style="color:gray">
            <h4>{{$late->userRequestedBy->name}} requests {{$late->userRequestedto->name}}</h4>
        </div>
         @endif
    </a></li>
    @endforeach
</ul>
</li>
@endrole

@role(['attendee','speaker'])
@if($deligateNotifications)
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
          @if($countDeligates)
          <span class="glyphicon glyphicon-bell" style="font-size:20px;color:DodgerBlue"><span class="badge" style="background-color:tomato;margin-left:-6px;margin-bottom:11px">{{$countDeligates}}</span>
      
      @else
      <span class="glyphicon glyphicon-bell" style="font-size:20px"></span>
      @endif
    </a>
    <ul class="dropdown-menu" style="height:250px;overflow:auto">
        @foreach($deligateNotifications as $attendeeNotification)
        @if($attendeeNotification->organiser_review == 1) <!--checking whether organiser reviewed-->
    <li><a href="{{url('attendNotification',[$attendeeNotification->request_to])}}">
        <!--when deligate reacts to request, notification color changes-->
    @if($attendeeNotification->deligateAccept_status == 1) 
        <div style="color:gray">
            <h4>you have meeting request from {{$attendeeNotification->userRequestedBy->name}}</h4> 
        </div>
        @else
        <div style="color:red">
            <h4>you have meeting request from {{$attendeeNotification->userRequestedBy->name}}</h4>
        </div>
    @endif
    </a></li>
        @endif
    @endforeach
    </ul>
</li>
@else
<p>hi</p>
@endif
@endrole

