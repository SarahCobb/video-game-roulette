@extends ('master')

@section('title')
Roulette
@stop

@section('content')

<h1>Video Game Roulette</h1>

@foreach($errors->all() as $message)
	<div class='error'>{{ $message }}</div>
@endforeach

<form class="form-horizontal" role="form" action="{{ action('GamesController@post_roulette') }}" method="POST">
	{{ Form::token() }}
	<br>
	<div class="form-group col-sm-12">
		@foreach ($tags as $key => $tag)
		<div id="ck-button">
			<label>
				<input type="checkbox" name="{{ $tag->name }}" value="{{ $tag->id }}"><span>{{ $tag->name }}</span>
			</label>
		</div>
		@endforeach
	</div>
	<div class="form-group col-sm-12 center-block">
		<input class="btn btn-info btn-lg" type="submit" name="roulette_all" value="Play with All Games">
		<input class="btn btn-success btn-lg" type="submit" name="roulette_tags" value="Play with My Tags">
	</div>
</form>


@stop