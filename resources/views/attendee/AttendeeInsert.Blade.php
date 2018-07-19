<html>
<head>
</head>
<body>
<form action="{{url('attendeeInsert')}}" method="post" enctype="multipart/form-data">
  First Name:<input type="text" name="first_name" placeholder="first name"><br>
  <input type="text" name="last_name" placeholder="Last name"><br>
  <input type="text" name="city" placeholder="city"><br>
  <input type="text" name="state" placeholder="state"><br>
  <input type="text" name="country" placeholder="country"><br>
  <input type="text" name="age" placeholder="age"><br>
  <input type="text" name="about" placeholder="about"><br>
  <input type="text" name="contact" placeholder="contact"><br>
  <input type="text" name="profession" placeholder="profession"><br>
  <input type="text" name="company" placeholder="company"><br>
  <input type="text" name="position" placeholder="position"><br>
  <input type="text" name="expert_in" placeholder="expert_in"><br>
  <input type="text" name="gender" placeholder="gender"><br>
  <input type="text" name="how_you_heardabout_event" placeholder="How you come to know about event"><br>
  <input type="text" name="event_id" placeholder="event_id"><br>
  <input type="file" name="profile_image" placeholder="" accept="image/*"><br>
  <button value="submit">Save</button>
</form>

</body>
</html>
