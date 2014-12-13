@extends ('master')

@section('title')
<title>Add Tags</title>
@stop

@section('content')

	{{ Form::open(array('action' => 'UserController@post_add')) }}
	@foreach ($tags as $key => $tag)
		{{ Form::checkbox($tag->name, $tag->id) }}
		{{ Form::label($tag->name) }}
	@endforeach
	{{ Form::submit('Save') }}
	{{ Form::close() }}

@stop