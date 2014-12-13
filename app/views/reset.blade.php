@extends ('master')

@section('title')
<title>Reset Password</title>
@stop

@section('content')
<p>reset</p>

{{ Form::open(array('action' => 'UserController@login')) }}
{{ Form::label('email', 'Email') }}
{{ Form::email('email', 'Email') }}
{{ Form::label('password', 'Password') }}
{{ Form::text('password', 'Password') }}
{{ Form::label('remember_token', 'Remember me?') }}
{{ Form::checkbox('remember_token', '1', true) }}
{{ Form::submit('Login') }}
{{ Form::close() }}

@stop

