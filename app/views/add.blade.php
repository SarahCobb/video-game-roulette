@extends ('master')

@section('title')
<title></title>
@stop

@section('content')
<h1>Add {{$game['title'] to Your Collection</h1>

{{ Form::open('action' => 'UserController@post_add') }}
@foreach ($tags as $key => $tag)
@endforeach

@stop