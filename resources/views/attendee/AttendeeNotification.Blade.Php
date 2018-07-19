@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row">
        	<table class="table table-bordered table-hover">
        <thead>
        <tr style="background:#ff9933;color:white">
          <th>#</th>
          <th>Event</th>
          <th>Meeting purpose</th>
          <th>Requested by</th>
          <th>Requested to</th>
          <th>date</th>
          <th>Action</th>
        </tr><?php $i=0?>
      </thead>
      @foreach($notifications as $Notification)
      <tbody><?php $i++;?>
        <tr>
          <th scope="row" >{{$i}}</th>
          <td>{{$Notification->event->event_name}}</td>
          <td>{{$Notification->meeting_purpose}}</td>
          <td>{{$Notification->userRequestedBy->name}}</td>
          <td>{{$Notification->userRequestedto->name}}</td>
          <td>{{$Notification->requested_date}}</td>
          <td>
            @if($Notification->deligateAccept_status == 0)<!--request not yet accepted by deligate-->
            <form action="{{url('addNotification',[$Notification->id])}}" method="post" style="display:inline">
              <button class="btn btn-primary">Accept Request</button>
           </form>
            @elseif($Notification->deligateAccept_status == 1)<!--request Accepted-->
           <b><span class="glyphicon glyphicon-ok" style="color:green;font-size:25px"></span>Request Accepted</b>
            @elseif($Notification->deligateAccept_status == 2)<!--request deleted by deligate-->
            	<button class="btn btn-success">Deleted</button>
            @endif
            <form action="{{url('deleteNotify',[$Notification->request_to])}}" method="post" style="display:inline">
              <button class="btn btn-danger">Delete</button>
            </form>
            </td>
        </tr>
      </tbody>
      @endforeach
      </table>
    </div>

  <!-- Modal -->
  @if(session()->has('success'))
{{session()->get('success')}}
@endif
  
  </div>
@endsection
