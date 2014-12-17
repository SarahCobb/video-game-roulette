@extends('master')

@section('title')
Request Password Reset
@stop

@section('title')

{{ Form::open(array('action' => 'RemindersController@postRemind')) }}
{{ Form::email('email') }}
{{ Form::submit('send_reminder', 'Send Reminder') }}

@stop