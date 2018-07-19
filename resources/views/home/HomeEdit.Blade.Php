@extends('layouts.app')

@section('content')
<form action="{{url('up',[$edit->id])}}" class="form-horizontal" name="spea" method="post" enctype="multipart/form-data">
  <div class="container" style="width:800px; margin:0 auto;">

    <div class="form-group">
      <label class="control-label col-sm-2" for="event_name">Event Name:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->event_name}}" id="event_name" name="event_name" placeholder="Enter Event name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="start_date">Start Date:</label>
      <div class="col-sm-6">
        <input type="date" class="form-control" value="{{$edit->start_date}}" id="start_date" name="start_date">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="end_date">End Date:</label>
      <div class="col-sm-6">
        <input type="date" class="form-control" value="{{$edit->end_date}}" id="end_date" name="end_date">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="category">category:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->category}}" id="category" name="category" placeholder="Enter Category">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="start_time">Start Time:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->start_time}}" id="start_time" name="start_time" placeholder="Enter start time">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="end_time">End Time:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->end_time}}" id="end_time" name="end_time" placeholder="Enter End Time">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="cost_per_person">Cost:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->cost_per_person}}" id="cost_per_person" name="cost_per_person" placeholder="Enter Amount">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="langauge">Language:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->langauge}}" id="langauge" name="langauge" placeholder="Enter Language of Event">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="description">Event description:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->description}}" id="description" name="description" placeholder="Enter description">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="country">Country:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->country}}" id="country" name="country" name="country" placeholder="Country name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="city">City:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->city}}" id="city" name="city" placeholder="Enter city name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="state">State:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->state}}" id="state" name="state" placeholder="State">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="venue">Venue:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->venue}}" id="venue" name="venue" placeholder="Enter venue Address">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="contact_mail">Contact E-mail:</label>
      <div class="col-sm-6">
        <input type="email" class="form-control" value="{{$edit->contact_mail}}" id="contact_mail" name="contact_mail" placeholder="Enter your Email">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="contact_number">Contact Number:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->contact_number}}" id="contact_number" name="contact_number" placeholder="Enter your contact number">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="speaker">Speaker:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->speaker}}" id="speaker" name="speaker" placeholder="Enter Speaker name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="guest">Guest:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->guest}}" id="guest" name="guest" placeholder="Enter guest name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="guest">Guest:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" value="{{$edit->guest}}" id="guest" name="guest" placeholder="Enter guest name">
      </div>
    </div>

    <input type="hidden" name="user_id" value="{{$edit->user_id}}"><br>
    <input type="hidden" name="speaker_id" value="{{$edit->speaker_id}}"><br>
    <input type="hidden" name="venue_id" value="{{$edit->venue_id}}"><br>

    <button type="submit" name="name" class="btn btn-primary">Update</button>



</form>
@endsection
