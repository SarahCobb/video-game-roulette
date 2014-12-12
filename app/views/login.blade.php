@extends ('master')

@section('title')
<title></title>
@stop

@section('content')
<p>login</p>

{{ Form::open(array('action' => 'UserController@login')) }}
{{ Form::label('Email') }}
{{ Form::email('email') }}
{{ Form::label('password', 'Password') }}
{{ Form::password('password') }}
{{ Form::submit('Login') }}
{{ Form::close() }}

@stop

