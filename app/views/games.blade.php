@extends ('master')

@section('title')
My Games
@stop

@section('content')
<h2>My Games</h2>

    @if (is_null($games))

        <p>You have no games! :(</p>
        <p>Why don't you search for some?</p>
        {{ Form::open(array('action' => 'GamesController@search')) }}
        {{ Form::text('query') }}
        {{ Form::checkbox('all_games', 'all_games') }}
        {{ Form::label('all_games', 'Just show me all the games') }}
        {{ Form::submit('GO') }}
        {{ Form::close() }}

        <br> or <a href="{{ action('GamesController@get_create') }}" class="btn btn-primary">Create Game</a>
    @else
        <div class="container" >
            <table class="">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Publisher</th>
                        <th>Platform</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($games as $key => $game)
                <tr>
                    <td>{{ $game->title }}</td>
                    <td>{{ $game->publisher }}</td>
                    <td>{{ $game->platform }}</td>
                    <td>
                        <a href="{{ action('GamesController@get_edit', $game->id) }}" class="btn btn-warning btn-xs">Edit</a>
                        <a href="{{ action('GamesController@remove', $game->id) }}" class="btn btn-danger btn-xs">Remove</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> 
    </div>


        

    @endif

@stop

