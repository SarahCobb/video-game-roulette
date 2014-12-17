@extends ('master')

@section('title')
Search
@stop

@section('content')

	<h1>Search</h1>

{{ Form::open(array('action' => 'GamesController@search')) }}
{{ Form::label('search', 'Search') }}
{{ Form::text('query') }}
{{ Form::token() }}
{{ Form::submit('Search') }}
{{ Form::close() }}

{{ Form::open(array('action' => 'GamesController@search')) }}
{{ Form::text('query') }}
{{ Form::checkbox('all_games', 'all_games') }}
{{ Form::label('all_games', 'Just show me all the games') }}
{{ Form::submit('Search') }}
{{ Form::close() }}

@stop

@section('/body')
@stop