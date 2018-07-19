@extends('layouts.app')
@section('content')
<div class="container" >
  <div class="row">
    <div class="col-sm-3">
      <div class="thumbnail">
        <div class="caption">
      <h3>Number of Events </h3>
      <h3>{{$Totalevents}}</h3><!--total events count-->
      </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="thumbnail">
        <div class="caption">
      <h3>Number of conferences</h3>
      <h3>0</h3>
    </div>
    </div>
  </div>
    <div class="col-sm-3">
      <div class="thumbnail">
        <div class="caption">
      <h3>Number of exhibitions</h3>        
      <h3>0</h3>
    </div>
  </div>
    </div>
    <div class="col-sm-3">
      <div class="thumbnail">
        <div class="caption">
      <h3>Total users</h3>      
      <h3>{{$AllUsers}}</h3>
    </div>
  </div>
    </div>

  </div>

  <div class="row">
    <div class="col-sm-3">
      <div class="thumbnail">
        <div class="caption">
      <h3>Number of attendees </h3>
      <h3>{{$AllAttendees}}</h3>
      </div>
    </div>
    </div>
    <div class="col-sm-3">
      <div class="thumbnail">
        <div class="caption">
      <h3>Number of patrners</h3>
      <h3>{{$AllPartners}}</h3>
    </div>
  </div>
    </div>
    <div class="col-sm-3">
      <div class="thumbnail">
        <div class="caption">
      <h3>Number of speakers</h3>        
      <h3>{{$AllSpeakers}}</h3>
    </div>
  </div>
    </div>
  </div>

  <div class="row">
  <div class="col-sm-3">
    <div class="thumbnail">
      <div class="caption">
        <h3>Upcoming Events</h3>
        <h3>0</h3>
        <button class="btn btn-primary btn-xs">Manage</button>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="thumbnail">
      <div class="caption">
        <h3>Ongoing Events</h3>
        <h3>0</h3>
        
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="thumbnail">
      <div class="caption">
        <h3>Past Events</h3>
        <h3>0</h3>
        
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="thumbnail">
      <div class="caption">
        <h3>Canceled Events</h3>
        <h3>0</h3>
        
      </div>
    </div>
  </div>
</div>
</div>
@endsection