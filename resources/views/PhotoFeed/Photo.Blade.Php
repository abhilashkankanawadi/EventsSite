@extends('layouts.app')

@section('content')
<!-- <div class="col-sm-1">
  <a href="{{URL::previous()}}" class="btn btn-primary" style="float:right">Back</a>
</div> -->
<div class="container">
  <div style="display:inline"> <!-- Previous Route -->
    <a href="{{url('meeting',[$id])}}" class="btn btn-primary" >Back</a>
  </div>
  <div style="display:inline; float:right"> <!-- on click, form opens -->
    <h3 class="vanish btn btn-success" id="sms" style="display:inline;">Upload Photo</h3>
      <form action="{{url('upload',[$id])}}"  method="POST"  id="form1" enctype="multipart/form-data">
        <div class="form-group">
          <input type="file" name="photos" class="form-control">
          <input type="text" name="caption" placeholder="Add caption" class="form-control">
          <input class="btn btn-success" type="submit" value="save" name="send" style="width:100%">
        </div>
      </form>
  </div>
  <div class="col-sm-12" ><!-- Images Display -->
    @if(count($photos) > 0)
    @foreach($photos as $photo)
      <a href="{{url('photoDetail',[$photo->id])}}" class="cont"><img src="{{URL::asset('storage/images/'.$photo->photos)}}" class="box"></a>
    @endforeach
    @else
    <p>This events does not have images</p>
    @endif
  </div>
</div>

<!-- <div class="col-sm-3">
  <h3 class="vanish btn btn-success" id="sms">Upload Photo</h3>
    <form action="{{url('upload',[$id])}}"  method="POST"  id="form1" enctype="multipart/form-data">
      <div class="form-group">
        <input type="file" name="photos" >
        <input type="text" name="caption" placeholder="Add caption" class="form-control">
        <input class="btn btn-success" type="submit" value="save" name="send" style="width:100%">
      </div>
    </form>
</div> -->
<script>
  $(document).ready(function(){
    $("#sms").click(function(){
      $(".vanish").hide('slow');
      $( "#form1" ).toggle( 'slow' );
    });
  });
</script>
@endsection
