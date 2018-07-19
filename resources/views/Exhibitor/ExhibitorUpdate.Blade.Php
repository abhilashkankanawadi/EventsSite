@extends('layouts.app')
@section('content')

@role('exhibitor')
  <a href="{{URL::previous()}}"><button class="btn btn-primary" >Back</button></a>
  <form action="{{url('exhibitorUpdate',[$exhibitor->id])}}" class="form-horizontal" method="post" name="spea" enctype="multipart/form-data"  >

    <div class="container" style="width:800px; margin:0 auto;">

      <div class="form-group">
        <label class="control-label col-sm-2" for="representative">Company Representative:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$exhibitor->representative}}" id="representative" name="representative" placeholder="Enter representative name">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="exhibiting_product">Which Product do you want to Exhibit:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$exhibitor->exhibiting_product}}" id="exhibiting_product" name="exhibiting_product" placeholder="Enter product name">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="products">Your Company products:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$exhibitor->products}}" id="products" name="products" placeholder="products of your company">
        </div>
      </div>


      <div class="form-group">
        <label class="control-label col-sm-2" for="contact">contact Number:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$exhibitor->contact}}" id="contact" name="contact" placeholder="Enter contact number">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="company_email">Company Email-Id:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$exhibitor->company_email}}" id="company_email" name="company_email" placeholder="Enter company_email">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="company">Company Name:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$exhibitor->company}}" id="company" name="company" placeholder="Enter your company name">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="address">address:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$exhibitor->address}}" id="address" name="address" placeholder="address">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="about_company">Tell us about your company:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$exhibitor->about_company}}" id="about_company" name="about_company" placeholder="About your company">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="city">City:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$exhibitor->city}}" id="city" name="city" placeholder="Enter city name">
        </div>
      </div>


      <div class="form-group">
        <label class="control-label col-sm-2" for="branch_cities">branch cities:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$exhibitor->branch_cities}}" id="branch_cities" name="branch_cities" placeholder="">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="founder">Founder:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$exhibitor->founder}}" id="founder" name="founder" placeholder="Company founder name">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="website">website:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$exhibitor->website}}" id="website" name="website" placeholder="Enter company website">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="exhibition_attended"> exhibition_attended:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$exhibitor->exhibition_attended}}" id="exhibition_attended" name="exhibition_attended" placeholder="how many exhibitions have you attended">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="established">Company Established:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="{{$exhibitor->established}}" id="established" name="established" placeholder="established year">
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