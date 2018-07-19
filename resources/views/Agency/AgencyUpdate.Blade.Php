@extends('layouts.app')
@section('content')


@role('agency')
  <a href="{{URL::previous()}}"><button class="btn btn-primary" >Back</button></a>
  <form action="{{url('agencyUpdate',[$agency->id])}}" class="form-horizontal" method="post" name="spea" enctype="multipart/form-data"  >

    <div class="container" style="width:800px; margin:0 auto;">

      <div class="form-group">
        <label class="control-label col-sm-2" for="agency_name">Agency Name:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$agency->agency_name}}" id="agency_name" name="agency_name" placeholder="Enter agency name">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="country">Country:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$agency->country}}" id="country" name="country" placeholder="Enter Country">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="contact">contact:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$agency->contact}}" id="contact" name="contact" placeholder="Enter Contact">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="about">About:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$agency->about}}" id="about" name="about" placeholder="Describe about your company">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="events_organised">How many events you have organised?</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$agency->events_organised}}" id="events_organised" name="events_organised" placeholder="events organised">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="services">Tell us about your services:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$agency->services}}" id="services" name="services" placeholder="Enter your services here">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="recognitions">Recognitions:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$agency->recognitions}}" id="recognitions" name="recognitions" placeholder="recognitions">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="working_hours">Working hours:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$agency->working_hours}}" id="working_hours" name="working_hours" placeholder="Your Organisation working hours">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="working_days">Working days:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$agency->working_days}}" id="working_days" name="working_days" placeholder="working_days">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="established">Your Organisation established year:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$agency->established}}" id="established" name="established" placeholder="established year">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="main_branch">Where is your main branch:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$agency->main_branch}}" id="main_branch" name="main_branch" placeholder="main_branch">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="address">Address:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$agency->address}}" id="address" name="address" placeholder="address">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="website">Your organisation website:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$agency->website}}" id="website" name="website" placeholder="Enter company website">
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
  @endrole

@endsection