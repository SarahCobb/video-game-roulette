@extends ('master')

@section('title')
<title></title>
@stop

@section('content')
<h1>Edit</h1>

{{ Form::open(array('action' => 'GamesController@edit')) }}
<input type="hidden" name="id" value="{{ $game->id }}">
{{ Form::label('title', 'Title') }}
{{ Form::text('title', $game['title']) }}
{{ Form::label('creator', 'Creator') }}
{{ Form::text('creator', $game['creator']) }}
{{ Form::label('genre', 'Genre')}}
{{ Form::text('genre', $genre['genre']) }}

<select multiple="multiple" name="genres[]" id="genres">

</select>
{{ Form::submit('Save') }}
<a href="{{ action('HomeController@index') }}" class="btn btn-link">Cancel</a>
{{ Form::close() }}

@stop