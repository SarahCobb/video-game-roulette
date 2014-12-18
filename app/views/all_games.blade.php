@extends ('master')

@section('title')
Search Results
@stop

@section('content')
<div class="container">
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($games as $key => $game)
                        <tr>
                            <td>{{ $game->title }}</td>
                            <td>{{ $game->publisher }}</td>
                            <td>{{ $game->platform }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>
@stop