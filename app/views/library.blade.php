@extends ('master')

@section('title')
<title></title>
@stop

@section('content')
<p>game library</p>

{{ Form::open(array('action' => 'GamesController@search')) }}
{{ Form::label('search', 'Search') }}
{{ Form::text('query') }}
{{ Form::token() }}
{{ Form::submit('Search') }}
{{ Form::close() }}

                <a href="{{ action('GamesController@create') }}" class="btn btn-primary">Create Game</a>

    @if (isset($games))
            <table class="">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Creator</th>
                </tr>
            </thead>
            <tbody>
                @foreach($games as $game)
                <tr>
                    <td>{{ $game->title }}</td>
                    <td>{{ $game->creator }}</td>
                    <td>
                        <a href="{{ action('UserController@add', $game->id) }}" class="">Add</a>
                        <a href="{{ action('UserController@remove', $game->id) }}" class="">Remove</a>
                        <a href="{{ action('GamesController@edit', $game->id) }}" class="">Edit</a>
                        <a href="{{ action('GamesController@delete', $game->id) }}" class="">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> 
    @else
        <p>There are no games! </p>
    @endif
@stop

