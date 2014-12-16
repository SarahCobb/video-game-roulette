@extends ('master')

@section('title')
<title></title>
@stop

game
all_tags
tags

@section('content')
<h1>Edit {{ $game['title'] }}</h1>

{{ Form::open(array('action' => 'GamesController@post_edit')) }}
{{ Form::hidden('id', $game->id) }}
{{ Form::label('title', 'Title') }}
{{ Form::text('title', $game['title']) }}
<br>
{{ Form::label('publisher', 'Publisher') }}
{{ Form::text('publisher', $game['publisher']) }}
<br>
{{ Form::label('platform', 'Platform') }}
{{ Form::text('platform', $game['platform']) }}
<br>
{{ Form::label('description', 'Description') }}
{{ Form::text('description', $game['description']) }}
<br>
{{ Form::label('tags', 'Tags') }}
	@foreach ($all_tags as $key => $tag)
		@for ($j = 0; $j < count($tags); $j++)
			@if ($tag->id == $tags[$j])
				{{ Form::checkbox($tag->name, $tag->id, true) }}
				{{ Form::label($tag->name) }}
				<?php continue 2; ?>
			@endif
		@endfor
		{{ Form::checkbox($tag->name, $tag->id) }}
		{{ Form::label($tag->name) }}
	@endforeach
{{ Form::submit('Save') }}
{{ Form::close() }}

@stop