@extends ('master')

@section('title')
<title></title>
@stop

@section('content')
<h1>Delete {{ $game->title }} <small>Are you sure?</small></h1>

{{ Form::open(array('action' => 'GamesController@delete')) }}
<input type="hidden" name="game" value="{{ $game->id }}" />
{{ Form::submit('Yes') }}
<a href="{{ action('GamesController@showGames') }}" class="btn btn-default">No way!</a>
{{ Form::close() }}

@stop

