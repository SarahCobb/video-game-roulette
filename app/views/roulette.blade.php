@extends ('master')

@section('content')

<h1>Video Game Roulette</h1>
{{ Form::open(array('action' => 'GamesController@post_roulette'))}}
{{ Form::checkbox('all', 'all_games') }}
{{ Form::label('Include all my games :)') }}
{{ Form::label('tags', 'Tags') }}
	@foreach ($tags as $key => $tag)
		{{ Form::checkbox($tag->name, $tag->id) }}
		{{ Form::label($tag->name) }}
	@endforeach

{{ Form::submit('Play') }}
{{ Form::close() }}



@stop