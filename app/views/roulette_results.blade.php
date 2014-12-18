@extends ('master')

@section('title')
Roulette
@stop

@section('content')

<div class="row text-center">
	<div class="col-md-12">
			<h1 id="winner" class="text-center">{{ $roulette->title }}</h1><br>
			<p id="winner" class="text-center">Created by {{ $roulette->publisher }}</p><br>
			<p id="winner" class="text-center">Available on {{ $roulette->platform }}</p>
	</div>
</div>

<div class="row text-center">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<h2 class="suggestions">In case you're not in the mood for {{ $roulette->title }}, here are some other games that met your criteria...</h3>
	</div>
	<div class="col-md-2"></div>
</div>

<div class="row text-center">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		@if (isset($games[0]))
			@if ($games[0]->title != $roulette->title)
				<p class="title">{{ $games[0]->title }}</p>
				<p>Created by {{ $games[0]->publisher }}</p>
				<p>Available on {{ $games[0]->platform }}</p>
				<br>
			@endif
		@endif
		@if (isset($games[1]))
			@if ($games[1]->title != $roulette->title)
				<p class="title">{{ $games[1]->title }}</p>
				<p>Created by {{ $games[1]->publisher }}</p>
				<p>Available on {{ $games[1]->platform }}</p>
				<br>
			@endif
		@endif
		@if (isset($games[2]))
			@if ($games[2]->title != $roulette->title)
				<p class="title">{{ $games[2]->title }}</p>
				<p>Created by {{ $games[2]->publisher }}</p>
				<p>Available on {{ $games[2]->platform }}</p>
				<br>
			@endif
		@endif
		<br><br>
		<a style="margin:0;" href="{{ action('GamesController@get_roulette') }}" class="btn btn-warning btn-lg">Play Again</a>
</div>
<div class="col-md-4"></div>
</div>

@stop