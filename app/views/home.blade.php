@extends ('master')

@section('content')

<h1>Search for Games!</h1>

{{ Form::open(array('action' => 'GamesController@search')) }}
{{ Form::text('query') }}
{{ Form::checkbox('all_games', 'all_games') }}
{{ Form::label('all_games', 'Just show me all the games') }}
{{ Form::submit('GO') }}
{{ Form::close() }}

@stop

