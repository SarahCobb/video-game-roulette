@extends ('master')

@section('title')

@stop

@section('content')

{{ $roulette->title }}
{{ $roulette->publisher }}
{{ $roulette->platform }}
{{ $roulette->description }}

@stop