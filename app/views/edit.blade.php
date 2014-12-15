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
<br>
{{ Form::label('description', 'Description') }}
{{ Form::text('description') }}
<br>
{{ Form::label('tags', 'Tags') }}
	@foreach ($tags as $key => $tag)
		{{ Form::checkbox($tag->name, $tag->id) }}
		{{ Form::label($tag->name) }}
	@endforeach
{{ Form::submit('Save') }}
{{ Form::close() }}

@stop