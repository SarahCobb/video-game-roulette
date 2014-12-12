@extends ('master')

@section('title')
<title></title>
@stop

@section('content')
<p>signup</p>

@foreach($errors->all() as $message)
	<div class='error'>{{ $message }}</div>
@endforeach

{{ Form::open(array('action' => 'UserController@post_signup')) }}
{{ Form::label('First Name') }}
{{ Form::text('first_name') }}
{{ Form::label('Last Name') }}
{{ Form::text('last_name') }}
{{ Form::label('Email') }}
{{ Form::email('email') }}
{{ Form::label('Password') }}
{{ Form::password('password') }}
{{ Form::submit('Signup') }}
{{ Form::close() }}

@stop

