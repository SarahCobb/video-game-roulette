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
use XmlIterator\XmlIterator;
use Paste\Pre;

// Route::get('/seed', function() {
// 	$tagList = array('Fighting','Maze','Arcade','Shooter','Adventure','Stealth','Horror','Graphic Adventure','Role-Playing','Japanese Role-Playing', 'Turn-Based','Simulation','Strategy','Sports','Racing','Music','Party','Puzzle','Trivia','Multiplayer','Nintendo Entertainment System','Atari 7800','Sega Master System','Super Casette Vision','Sega Genesis','Super Nintendo Entertainment System','Playstation','Playstation 2','Playstation 3','Playstation 4','Atari Jaguar','Nintendo64','Nintendo GameCube', 'Xbox', 'Xbox 360','Xbox One','Wii', 'Wii U','Game Boy','Game Boy Color','Game Boy Advance','Nintendo DS','Nintendo 3DS','Playstation Portable','Gizmondo','Sony Xperia PLAY');
// 	for ($i = 0; $i < count($tagList); $i++) {
// 		$newTag = new Tag;
// 		$newTag->name = $tagList[$i];
// 		$newTag->save();
// 	}
// });

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

# bind route parameters
Route::model('game', 'Game');

# load Pages
Route::get('/', 'GamesController@index'); # welcome screen with search box
Route::get('/results', array( 'before' => 'auth', 'uses' => 'GamesController@get_search_results')); # show search results
Route::get('/create', array( 'before' => 'auth', 'uses' => 'GamesController@get_create')); # show game creation form
Route::get('/my-games', array( 'before' => 'auth', 'uses' => 'GamesController@get_my_games')); # show user's game collection
Route::get('/edit/{id}', array( 'before' => 'auth', 'uses' => 'GamesController@get_edit')); # edit game 
Route::get('/roulette', array( 'before' => 'auth', 'uses' => 'GamesController@get_roulette')); # show game roulette form
Route::get('/signup', array( 'before' => 'guest', 'uses' => 'UserController@get_signup')); # show sign up form
Route::get('/login', array( 'before' => 'guest', 'uses' => 'UserController@get_login')); # show log in form

# handle processes 
Route::get('/add/{id}', 'GamesController@get_add'); # add a game to collection
Route::post('/edit/{id}', 'GamesController@post_edit'); # edit game 
Route::get('/remove/{id}', 'GamesController@remove'); # remove a game from collection
Route::get('/logout', 'UserController@logout'); # log out user
Route::post('/create', 'GamesController@post_create'); # game creation
Route::post('/search', 'GamesController@search'); # game search
Route::post('/roulette', 'GamesController@post_roulette'); # game roulette with tags form
Route::post('/signup', 'UserController@post_signup'); # user creation
Route::post('/login', 'UserController@post_login'); # user authentication


