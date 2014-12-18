@extends ('master')

@section('title')
Home
@stop

@section('content')

<div class="row text-center">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<h1>Video Game Roulette</h1>
<h3>Keep track of all your video games, and never again have an indecisive moment!</h3>
<p>Once you create an account, you'll be able to build a game collection and get a random game suggestion based on what you're in the mood for :)</p>
<br>
@if(Auth::check())
<a href="{{ action( 'GamesController@search') }}" class="btn btn-info btn-lg">Search Games</a>
@else
<a href="{{ action( 'GamesController@get_all_games') }}" class="btn btn-info btn-lg">See All Games</a>
@endif
</div><div class="col-md-2"></div></div>

@stop

