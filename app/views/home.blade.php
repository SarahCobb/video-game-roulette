@extends ('master')

@section('content')

<h1>Search for Games!</h1>

{{ Form::open(array('action' => 'GamesController@search')) }}
{{ Form::text('query') }}
{{ Form::submit('Search') }}
{{ Form::close() }}

<br> or <a href="{{ action('GamesController@get_create') }}" class="btn btn-primary">Create Game</a>
@stop

