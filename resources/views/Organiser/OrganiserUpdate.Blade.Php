@extends('layouts.app')

@section('content')
@role('organiser')
  <a href="{{URL::previous()}}"><button class="btn btn-primary" >Back</button></a>
  <form action="{{url('organiserChange',[$organiser->id])}}" class="form-horizontal" method="post" name="spea" enctype="multipart/form-data"  >

    <div class="container" style="width:800px; margin:0 auto;">

      <div class="form-group">
        <label class="control-label col-sm-2" for="first_name">First Name:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->first_name}}" id="first_name" name="first_name" placeholder="Enter first name">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="last_name">last Name:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->last_name}}" id="last_name" name="last_name" placeholder="Enter last name">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="city">City:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->city}}" id="city" name="city" placeholder="Enter city name">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="state">State:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->state}}" id="state" name="state" placeholder="Enter state name">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="country">Country Name:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->country}}" id="country" name="country" placeholder="Enter country name">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="contact">contact Number:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->contact}}" id="contact" name="contact" placeholder="Enter contact number">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="address">address:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->address}}" id="address" name="address" placeholder="address">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="gender">gender:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->gender}}" id="gender" name="gender" placeholder="Enter gender">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="age">age:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->age}}" id="age" name="age" placeholder="Enter age">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="about">about:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->about}}" id="about" name="about" placeholder="Tell us about yourself">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="experience">experience:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->experience}}" id="experience" name="experience" placeholder="Enter your work experience">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="events_organized">Events Organized:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->events_organized}}" id="events_organized" name="events_organized" placeholder="events_organized">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="achievements">Achievements:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->achievements}}" id="achievements" name="achievements" placeholder="Enter achievements">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="company_name">company name:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->company_name}}" id="company_name" name="company_name" placeholder="Enter your company name">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="event_brands">event brands:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$organiser->event_brands}}" id="event_brands" name="event_brands" placeholder="Enter names of companies you hosted">
        </div>
      </div>

      <!-- <div class="form-group">
        <label class="control-label col-sm-2" for="first_name">last Name:</label>
        <div class="col-sm-6">
          <input type="email" class="form-control" value="{{$organiser->first_name}}" id="first_name" name="first_name" placeholder="Enter first name">
        </div>
      </div> -->

      <div class="form-group">
        <label class="control-label col-sm-2" for="profile_image">Image:</label>
        <div class="col-sm-6">
          <input type="file" class="form-control"  id="profile_image" name="profile_image">
        </div>
      </div>



      <button type="submit" class="btn btn-primary">Submit</button>
    </div>

  </form>
  @endrole
@endsection
