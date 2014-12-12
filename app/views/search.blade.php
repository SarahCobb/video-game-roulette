@extends ('master')

@section('title')
<title></title>
@stop

@section('content')
<p>search</p>

	<h1>Search</h1>

{{ Form::open(array('action' => 'GamesController@search')) }}
{{ Form::label('search', 'Search') }}
{{ Form::text('query') }}
{{ Form::token() }}
{{ Form::submit('Search') }}
{{ Form::close() }}

@stop

@section('/body')
@stop