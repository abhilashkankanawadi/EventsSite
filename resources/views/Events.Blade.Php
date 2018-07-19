@extends('layouts.app')

@section('content')
<div class="col-sm-1">
  <a href="{{url('home')}}" class="btn btn-primary">Back</a>
</div>
<div class="col-sm-11">

  <table class="table table-striped">
    <tr style="text-align:center;color:tomato;background:lightblue;width:100%">
      <th>Sl.No</th>
      <th>Event Name</th>
      <th>Venue</th>
      <th>Action</th>
    </tr><?php $i=0?>
    @if(  Request::is('upcoming') ) <!--here using route name to display upcoming events-->
    @foreach($coming as $soon)
    <?php $i++?>
    <tr>
      <td>{{$i}}</td>
      <td>{{$soon->event_name}}</td>
      <td>{{$soon->venue}}</td>
      <td><a href="{{url('home',[$soon->id])}}" class="btn btn-success" style="width:100%">Edit</a></td>
      <td><a href="{{url('remove',[$soon->id])}}" class="btn btn-danger">Delete</a></td>
    </tr>
    @endforeach

    <!-- below displaying past events -->
    @elseif(Request::is('pastevents')) <!--here using route name to display past events-->
    @foreach($past as $pasts)
    <?php $i++?>
    <tr>
      <td>{{$i}}</td>
      <td>{{$pasts->event_name}}</td>
      <td>{{$pasts->venue}}</td>
      <td><a href="{{url('home',[$pasts->id])}}" class="btn btn-success" style="width:100%">Edit</a></td>
      <td><a href="" class="btn btn-danger">Delete</a></td>
    </tr>
    @endforeach
    @endif
  </table>
</div>
@endsection
