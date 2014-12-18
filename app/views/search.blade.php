@extends ('master')

@section('title')
Search
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


@stop

