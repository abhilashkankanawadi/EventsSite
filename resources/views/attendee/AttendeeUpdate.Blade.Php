<html>
<head>
</head>
<body>
  
  @role('attendee')
<form action="{{url('attendeeChange',[$modify->id])}}" method="post" enctype="multipart/form-data">
  First Name:<input type="text" name="first_name" value="{{$modify->user->name}}" placeholder="first name"><br>
  <input type="text" name="last_name" value="{{$modify->last_name}}" placeholder="Last name"><br>
  <input type="text" name="city" value="{{$modify->city}}" placeholder="city"><br>
  <input type="text" name="state" value="{{$modify->state}}" placeholder="state"><br>
  <input type="text" name="country" value="{{$modify->country}}" placeholder="country"><br>
  <input type="text" name="age" value="{{$modify->age}}" placeholder="age"><br>
  <input type="text" name="about" value="{{$modify->about}}" placeholder="about"><br>
  <input type="text" name="contact" value="{{$modify->contact}}" placeholder="contact"><br>
  <input type="text" name="profession" value="{{$modify->profession}}" placeholder="profession"><br>
  <input type="text" name="company" value="{{$modify->company}}" placeholder="company"><br>
  <input type="text" name="position" value="{{$modify->position}}" placeholder="position"><br>
  <input type="text" name="expert_in" value="{{$modify->expert_in}}" placeholder="expert_in"><br>
  <input type="text" name="gender" value="{{$modify->gender}}" placeholder="gender"><br>
  <input type="text" name="how_you_heardabout_event" value="{{$modify->how_you_heardabout_event}}" placeholder="How you come to know about event"><br>
  <input type="text" name="event_id" value="{{$modify->event_id}}" placeholder="event_id"><br>
  <input type="file" name="profile_image" placeholder="" accept="image/*"><br>
  <button value="submit">Save</button>
</form>
@endrole

</body>
</html>
