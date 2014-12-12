@extends ('master')

@section('title')
<title></title>
@stop

@section('content')
<h1>Create a Game</h1>

{{ Form::open(array('action' => 'GamesController@post_create')) }}
{{ Form::label('title', 'Title') }}
{{ Form::text('title') }}
<br>
{{ Form::label('publisher', 'Publisher') }}
{{ Form::text('publisher') }}
<br>
{{ Form::label('platform', 'Platform') }}
{{ Form::text('platform') }}
<br><p>Make sure your entries are correct! You cannot come back to this step.</p>
{{ Form::submit('Next') }}
{{ Form::close() }}

@stop

