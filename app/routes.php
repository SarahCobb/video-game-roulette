<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    var_dump($results);

});

# Bind route parameters
Route::model('game', 'Game');

# Load Pages
Route::get('/', 'RouletteController@index'); # welcome screen
Route::get('/library', 'GamesController@get_games'); # show peer game database and search box
# Route::get('/create', 'GamesController@get_create'); # create a game
Route::get('/search', 'GamesController@get_search_results'); # show search results and add form
Route::get('/my-games', 'UserController@get_collection'); # show collection
route::get('/game-detail/{id}', 'GamesController@get_game_detail'); # show game details
Route::get('/add/{id}', 'UserController@get_add'); # add a game to collection
Route::get('/edit/{id}', 'GamesController@get_edit'); # edit game tags in collection
Route::get('/roulette', 'RouletteController@get_roulette'); # show game roulette form
Route::get('/signup', 'UserController@get_signup'); # show sign up form
Route::get('/login', 'UserController@get_login'); # show log in form
Route::get('/reset', 'UserController@get_reset'); # show password reset form

# Handle back-end tasks
Route::get('/remove/{id}', 'UserController@remove'); # remove a game from collection
Route::get('/logout', 'UserController@logout'); # log out user

# Process forms
Route::post('/create', 'GamesController@post_create'); # handle game creation
# Route::post('/edit/{id}', 'GamesController@edit');
Route::post('/search', 'GamesController@search'); # handle game search
Route::post('/roulette', 'RouletteController@roulette'); # handle game roulette form
Route::post('/signup', 'UserController@signup'); # handle user creation
Route::post('/login', 'UserController@login'); # handle user authentication
Route::post('/reset', 'UserController@reset'); # handle password reset