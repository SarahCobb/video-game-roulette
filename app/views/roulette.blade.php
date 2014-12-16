@extends ('master')

@section('content')

<h1>Video Game Roulette</h1>
{{ Form::open(array('action' => 'UserController@post_roulette'))}}
{{ Form::label('tags', 'Tags') }}
	@foreach ($tags as $key => $tag)
		{{ Form::checkbox($tag->name, $tag->id) }}
		{{ Form::label($tag->name) }}
	@endforeach
{{ Form::checkbox('all', 'all_games') }}
{{ Form::label('Eh, just include all my games :)') }}
{{ Form::submit('Play') }}
{{ Form::close() }}



@stop