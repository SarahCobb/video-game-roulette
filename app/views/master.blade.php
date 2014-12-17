<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title') | Video Game Roulette</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Slackey' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/style.css">
</head>
<body>

    	<div class="container">
            <nav role="navigation" class="navbar navbar-default navbar-fixed-top ">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                        </button>
                        <a href="#" class="navbar-brand">Video Game Roulette</a>
                    </div>
                    <!-- Collection of nav links and other content for toggling -->
                    <div id="navbarCollapse" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                        @if(Auth::check())
                            <li><a href="{{ action('GamesController@index') }}">Search</a></li>
                            <li><a href="{{ action('GamesController@get_my_games') }}">My Games</a></li>
                            <li><a href="{{ action('GamesController@get_roulette') }}">Roulette</a></li>
                            <li><a href="{{ action('UserController@logout') }}">Log Out</a></li>
                        @else
                            <li><a href="{{ action('UserController@get_signup') }}">Sign Up</a></li>
                            <li><a href="{{ action('UserController@get_login') }}">Log In</a></li>
                        @endif
                        </ul>
                    </div>
                </div>
            </nav>
            <div style="margin-top: 100px;">    
                @if(Session::get('flash_message'))
                    <div class='flash-message'>{{ Session::get('flash_message') }}</div>
                @endif
            </div>
    		@yield('content')
    	</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@yield('/body')
</body>
</html>
