@extends ('master')

@section('title')
<title></title>
@stop

@section('content')


<h1>Edit {{ $game['title'] }}</h1>

@foreach($errors->all() as $message)
	<div class='error'>{{ $message }}</div>
@endforeach
<br>
<form class="form-horizontal" role="form" action="{{ action('GamesController@post_edit') }}" method="POST">
	{{ Form::token() }}
	<input type="hidden" value="{{ $game->id }}" name="id">
	<div class="form-group">
		<label for="title" class="col-sm-2 control-label">Title</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="title" name="title" value="{{ $game['title'] }}">
		</div>
	</div>
	<div class="form-group">
		<label for="publisher" class="col-sm-2 control-label">Publisher</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="publisher" name="publisher" value="{{ $game['publisher'] }}">
		</div>
	</div>
	<div class="form-group">
		<label for="platform" class="col-sm-2 control-label">Platform</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="platform" name="platform" value="{{ $game['platform'] }}">
		</div>
	</div>
	<br>
	<div class="form-group">
		<label for="tags" class="col-sm-12 control-label">What categories should this game belong to for roulette?</label><br>
	</div>
	<br>
	<div class="form-group col-sm-12">
		@foreach ($all_tags as $key => $tag)
			@for ($j = 0; $j < count($tags); $j++)
				@if ($tag->id == $tags[$j])
					<div id="ck-button">
						<label>
							<input type="checkbox" name="{{ $tag->name }}" value="{{ $tag->id }}" checked="checked"><span>{{ $tag->name }}</span>
						</label>
					</div>
					<?php continue 2; ?>
				@endif
			@endfor
			<div id="ck-button">
				<label>
					<input type="checkbox" name="{{ $tag->name }}" value="{{ $tag->id }}"><span>{{ $tag->name }}</span>
				</label>
			</div>
		@endforeach
	</div>
	<div class="form-group col-sm-12 center-block">
		<br>
		<input class="btn btn-success btn-lg" type="submit" name="save" value="Save">
	</div>
</form>

@stop