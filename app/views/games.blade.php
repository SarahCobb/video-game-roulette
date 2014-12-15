@extends ('master')

@section('title')
My Games
@stop

@section('content')
<p>my games</p>

    @if (is_null($games))

        <p>You have no games! :(</p>
        <p>Why don't you search for some?</p>
        {{ Form::open(array('action' => 'GamesController@search')) }}
        {{ Form::text('query') }}
        {{ Form::submit('Search') }}
        {{ Form::close() }}

        <br> or <a href="{{ action('GamesController@get_create') }}" class="btn btn-primary">Create Game</a>

    @else

        <div class="" >
            @foreach($games as $key => $game)
                <h3>{{ $game->title }}</h3>
                <p>Created by {{ $game->publisher }}</p>
                <p>Available on {{ $game->platform }}</p>
                <p>Description: {{ $game->description }}</p>
            <a href="{{ action('GamesController@get_edit', $game->id) }}" class="">Edit</a>
            <a href="{{ action('UserController@remove', $game->id) }}" class="">Remove</a>
            @endforeach
        </div>

        

    @endif

@stop

