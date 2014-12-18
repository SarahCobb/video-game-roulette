@extends ('master')

@section('title')
Create an Account
@stop

@section('content')
<h1>Create an Account</h1>

@foreach($errors->all() as $message)
	<div class='error'>{{ $message }}</div>
@endforeach
<br>

<div class="row">
<div class="col-md-12 centered">
<form class="form-inline" role="form" action="{{ action('UserController@post_signup') }}" method="POST">
  {{ Form::token() }}
  <div class="form-group">
    <label class="sr-only" for="first_name">First Name</label>
    <input type="text" class="form-control" id="first_name" placeholder="John" name="first_name">
  </div>
  <div class="form-group">
    <label class="sr-only" for="last_name">Password</label>
    <input type="text" class="form-control" id="last_name" placeholder="Doe" name="last_name">
  </div>
  <div class="form-group">
      <label class="sr-only" for="exampleInputEmail2">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email" name="email">
    </div>
  <div class="form-group">
    <label class="sr-only" for="exampleInputPassword2">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" name="password">
  </div>
  <button style="margin-top:0;" type="submit" class="btn btn-success">Log In</button>
</form>
</div>
</div>


@stop

