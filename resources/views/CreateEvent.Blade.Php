@extends('layouts.app')

@section('content')
<form action="{{url('store')}}" class="form-horizontal" name="spea" method="post" enctype="multipart/form-data">

  <div class="container" style="width:800px; margin:0 auto;">

    <div class="form-group">
      <label class="control-label col-sm-2" for="event_name">Event Name:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="event_name" placeholder="Enter Event name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="start_date">Start Date:</label>
      <div class="col-sm-6">
        <input type="date" class="form-control" name="start_date">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="end_date">End Date:</label>
      <div class="col-sm-6">
        <input type="date" class="form-control" name="end_date">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="category">category:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="category" placeholder="Enter Category">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="start_time">Start Time:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="start_time" placeholder="Enter start time">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="end_time">End Time:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="end_time" placeholder="Enter End Time">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="cost_per_person">Cost:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="cost_per_person" placeholder="Enter Amount">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="langauge">Language:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="langauge" placeholder="Enter Language of Event">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="age">Event description:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="description" placeholder="Enter description">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="about">Country:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="country" placeholder="Country name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="city">City:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="city" placeholder="Enter city name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="state">State:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="state" placeholder="State">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="venue">Venue:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="venue" placeholder="Enter venue Address">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="contact_mail">Contact E-mail:</label>
      <div class="col-sm-6">
        <input type="email" class="form-control" name="contact_mail" placeholder="Enter your Email">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="contact_number">Contact Number:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="contact_number" placeholder="Enter your contact number">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="speaker">Speaker:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="speaker" placeholder="Enter Speaker name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="guest">Guest:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="guest" placeholder="Enter guest name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="guest">Organiser:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="organiser" placeholder="Enter Organiser">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="images">Image:</label>
      <div class="col-sm-6">
        <input type="file" class="form-control"  id="images" name="images">
      </div>
    </div>



    <button type="submit" class="btn btn-primary">Submit</button>
  </div>









</form>
@endsection
