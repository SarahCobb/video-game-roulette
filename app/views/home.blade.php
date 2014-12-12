@extends ('master')

@section('content')

<p>Search for Games!</p>

{{ Form::open() }}
{{ Form::label('search', 'Search') }}
{{ Form::text('search') }}
{{ Form::submit('Search') }}
{{ Form::close() }}

@stop

