@extends ('master')

@section('title')
My Games
@stop

@section('content')
<h2>My Games</h2>
<div class="row">
    <div class="col-md-12">
<form role="form" method="POST" action="{{ action('GamesController@search') }}">
{{ Form::token() }}
<div class="col-sm-12">
<input type="text"  placeholder="Search for games..." name="query"><br><br>
</div>
<div class="form-group col-sm-12 center-block">
<input class="btn btn-info btn-lg" type="submit" name="all_games" value="Show All The Games">
<input class="btn btn-success btn-lg" type="submit" name="search" value="Search">
</div>
</form></div></div>

<div class="row">
    <div class="col-md-12">

            <br>
            <div class="table-responsive">
                <table class="table table-striped">
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
                                <a style="margin:0;" href="{{ action('GamesController@get_edit', $game->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a style="margin:0;" href="{{ action('GamesController@remove', $game->id) }}" class="btn btn-danger btn-sm">Remove</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
</div>
@stop

