@extends ('master')

@section('title')
<title></title>
@stop

@section('content')
<h1>Log In</h1>

@foreach($errors->all() as $message)
	<div class='error'>{{ $message }}</div>
@endforeach
<br>

<form class="form-inline" role="form" action="{{ action('UserController@post_login') }}" method="POST">
  {{ Form::token() }}
  <div class="form-group">
    <div class="input-group">
      <label class="sr-only" for="exampleInputEmail2">Email address</label>
      <div class="input-group-addon">@</div>
      <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email" name="email">
    </div>
  </div>
  <div class="form-group">
    <label class="sr-only" for="exampleInputPassword2">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" name="password">
  </div>
  <button type="submit" class="btn btn-success">Log In</button>
</form>

@stop

