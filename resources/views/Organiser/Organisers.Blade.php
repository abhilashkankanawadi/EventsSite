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
      @foreach($Notifications as $Notification)
      <tbody><?php $i++;?>
        <tr>
          <th scope="row" >{{$i}}</th>
          <td>{{$Notification->event->event_name}}</td>
          <td>{{$Notification->meeting_purpose}}</td>
          <td>{{$Notification->userRequestedBy->name}}</td>
          <td>{{$Notification->userRequestedto->name}}</td>
          <td>{{$Notification->requested_date}}</td>
          <td>
            @if($Notification->organiser_review == 1)
            <span class="glyphicon glyphicon-ok" style="color:green;font-size:25px"></span><b>Request forwarded</b>
            @else
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$Notification->id}}">Send to Deligate</button>
            @endif
            <form action="{{url('deleteReq',[$Notification->id])}}" method="delete" style="display:inline">
              <button class="btn btn-danger" >Delete</button></td>
            </form>
        </tr>
      </tbody>
      @endforeach
      </table>
    </div>

  <!-- Modal -->
  @if(session()->has('success'))
{{session()->get('success')}}
@endif
  @foreach($Notifications as $Notification)
  <div class="modal fade" id="myModal{{$Notification->id}}" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h3>Send meeting request to <b style="color:tomato">{{$Notification->userRequestedto->name}}</b>?</h3>
          <form action="{{url('sendReqToDeligate',[$Notification->id])}}" method="post" style="display:inline">
          <button class="btn btn-primary" >send</button>
          </form>
          <a href="{{url('organiser',[$id])}}"><button class="btn btn-danger">Cancel</button></a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  @endforeach
  </div>
@endsection
