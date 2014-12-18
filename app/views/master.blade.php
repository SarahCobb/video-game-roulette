<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title') | Video Game Roulette</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link href="/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="/dist/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Slackey' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Armata' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="/style.css">
    </head>
    
    <body>
        <div class="container">
            


            <nav role="navigation" class="navbar navbar-default navbar-fixed-top ">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle collapsed">
                                <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="{{ action('GamesController@index') }}" class="navbar-brand">Video Game Roulette</a>
                    </div>
                    <!-- Collection of nav links and other content for toggling -->
                    <div id="navbarCollapse" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            @if(Auth::check())
                            <li><a href="{{ action('GamesController@search') }}">Search</a></li>
                            <li><a href="{{ action('GamesController@get_create') }}">Create</a></li>
                            <li><a href="{{ action('GamesController@get_my_games') }}">My Games</a></li>
                            <li><a href="{{ action('GamesController@get_roulette') }}">Roulette</a></li>
                            <li><a href="{{ action('UserController@logout') }}">Log Out</a></li>
                            @else
                            <li><a href="{{ action('GamesController@get_all_games') }}">Games</a></li>
                            <li><a href="{{ action('UserController@get_signup') }}">Sign Up</a></li>
                            <li><a href="{{ action('UserController@get_login') }}">Log In</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="flash_message">    
                        @if(Session::get('flash_message'))
                        <div class="alert alert-info">
                            <div style="text-align:center;">{{ Session::get('flash_message') }}
                            </div>
                        </div>   
                        @endif
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
            @yield('content')
        </div>
        
        @yield('/body')
    </body>
</html>
