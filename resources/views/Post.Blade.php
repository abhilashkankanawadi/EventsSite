@extends('layouts.app')

@section('content')

<div class="col-sm-2"  style="">
  <!-- <ul class="lists" style="border:1px solid black">

  </ul> -->
</div>
<div class="col-sm-10" style="margin:20px 0px 0px 225px">
  <form method="POST" action="{{url('postcont',[$id])}}" enctype="multipart/form-data">
    <table>
      <tr>
        <th>What's on your mind?</th><th><textarea rows="2" cols="25" name="status" placeholder="write your text..">
        </textarea><th><th><span>{{ $errors->first('status') }}</span></th>
      </tr>
      <!-- <tr>
        <th>Tag your friends</th><th><input type="text" name="tags" placeholder="tag"><th>
      </tr>
      <tr>
        <th>Venue</th><th><input type="text" name="location" placeholder="tag"><th>
      </tr> -->

      <tr>
        <th>Images</th><th><input type="file" name="images" placeholder="tag" accept="image/*"><th>
      </tr>
    </table>
    <button type="submit">submit</button>
  </form>
</div>
@endsection
