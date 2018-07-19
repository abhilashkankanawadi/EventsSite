@extends('layouts.app')

@section('content')
<table>
  <tbody>
    @if(!($agendadetails->isEmpty())) <!--$showById is in array format, isEmpty() to check array empty or not -->
     @foreach($agendadetails as $details)
    <tr>
      <td>Time:</td><td><b>{{$details->start_time}}</b> to <b>{{$details->end_time}} </b></td>
    </tr><br>
    <tr>
      <td>Date:</td><td><b>{{$details->start_date}}</b> to <b>{{$details->end_date}} </b></td>
    </tr>
    <tr>
      <td>Venue:</td><td><b>{{$details->venue->venue_name}}</b></td>
    </tr>
    <tr>
      <td>Speaker:</td><td><b> {{$details->speaker->first_name}}</b></td>
    </tr>
    @endforeach
    @else
     <h3>This Event does not Have Any Agenda Right Now</h3>
    @endif
  </tbody>
</table>
@endsection
