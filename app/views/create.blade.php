@extends ('master')

@section('title')
<title></title>
@stop

@section('content')
<p>create game</p>

{{ Form::open(array('action' => 'GamesController@create')) }}
{{ Form::label('title', 'Title') }}
{{ Form::text('title') }}
<br>
{{ Form::label('creator', 'Creator') }}
{{ Form::text('creator') }}
<br>
{{ Form::label('Game Genres')}}
<br>
	@foreach($genreList as $key => $genre)
	{{ Form::checkbox($genre, $genre) }}
	{{ Form::label($genre) }}
	<br>
	@endforeach
{{ Form::submit('Save') }}
{{ Form::close() }}

@stop

