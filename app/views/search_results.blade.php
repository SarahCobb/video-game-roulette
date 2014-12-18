@extends ('master')

@section('title')
Search Results
@stop

@section('content')
<form role="form" method="POST" action="{{ action('GamesController@search') }}">
{{ Form::token() }}
<div class="col-sm-12">
<input type="text"  placeholder="Search for games..." name="query"><br><br>
</div>
<div class="form-group col-sm-12 center-block">
<input class="btn btn-info btn-lg" type="submit" name="all_games" value="Show All The Games">
<input class="btn btn-success btn-lg" type="submit" name="search" value="Search">
</div>
</form>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
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
                        @foreach($results as $key => $game)
                        <tr>
                            <td>{{ $game->title }}</td>
                            <td>{{ $game->publisher }}</td>
                            <td>{{ $game->platform }}</td>
                            <td>
                                <a style="margin:0;" href="{{ action('GamesController@get_add', $game->id) }}" class="btn btn-success">Add</a>
                                <a style="margin:0;" href="{{ action('GamesController@get_edit', $game->id) }}" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>
@stop

