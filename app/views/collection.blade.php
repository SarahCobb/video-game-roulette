@extends ('master')

@section('title')
<title>My Games | Video Game Roulette</title>
@stop

@section('content')
<p>my games</p>

    @if (isset($games))
        <p>You have no games! :(</p>
    @else
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
                    <td>{{ $game->publisher }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@stop

