@extends ('master')

@section('title')
<title></title>
@stop

@section('content')

{{ Form::open(array('action' => 'GamesController@search')) }}
{{ Form::text('query') }}
{{ Form::submit('Search') }}
{{ Form::close() }}

    @if (is_null($results)) 
        <p>No games found. Would you like to create one?</p>
        <a href="{{ action('GamesController@get_create') }}" class="btn btn-primary">Create Game</a>
    @else
    <p> You searched for {{ $query }}:</p>
            <table class="">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Publisher</th>
                    <th>Platform</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $key => $game)
                <tr>
                    <td>{{ $game->title }}</td>
                    <td>{{ $game->publisher }}</td>
                    <td>{{ $game->platform }}</td>
                    <td>
                        <a href="{{ action('UserController@get_add', $game->id) }}" class="">Add</a>
                        <a href="{{ action('UserController@remove', $game->id) }}" class="">Remove</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> 
        @endif
@stop

