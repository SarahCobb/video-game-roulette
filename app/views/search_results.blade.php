@extends ('master')

@section('title')
<title></title>
@stop

@section('content')

{{ Form::open(array('action' => 'GamesController@search')) }}
{{ Form::text('query') }}
{{ Form::checkbox('all_games', 'all_games') }}
{{ Form::label('all_games', 'Just show me all the games') }}
{{ Form::submit('Search') }}
{{ Form::close() }}

    @if (is_null($all))
        <p> You searched for '{{ $query }}':</p>
    @else
        <p> Here's all the games.</p>
    @endif
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
                        <a href="{{ action('GamesController@get_add', $game->id) }}" class="btn btn-success">Add</a>
                        <a href="{{ action('GamesController@get_edit', $game->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ action('GamesController@remove', $game->id) }}" class="btn btn-danger">Remove</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> 
@stop

