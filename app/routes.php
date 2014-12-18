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
# /app/routes.php
// Route::get('/debug', function() {

//     echo '<pre>';

//     echo '<h1>environment.php</h1>';
//     $path   = base_path().'/environment.php';

//     try {
//         $contents = 'Contents: '.File::getRequire($path);
//         $exists = 'Yes';
//     }
//     catch (Exception $e) {
//         $exists = 'No. Defaulting to `production`';
//         $contents = '';
//     }

//     echo "Checking for: ".$path.'<br>';
//     echo 'Exists: '.$exists.'<br>';
//     echo $contents;
//     echo '<br>';

//     echo '<h1>Environment</h1>';
//     echo App::environment().'</h1>';

//     echo '<h1>Debugging?</h1>';
//     if(Config::get('app.debug')) echo "Yes"; else echo "No";

//     echo '<h1>Database Config</h1>';
//     print_r(Config::get('database.connections.mysql'));

//     echo '<h1>Test Database Connection</h1>';
//     try {
//         $results = DB::select('SHOW DATABASES;');
//         echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
//         echo "<br><br>Your Databases:<br><br>";
//         print_r($results);
//     } 
//     catch (Exception $e) {
//         echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
//     }

//     echo '</pre>';

// });

// Route::get('/seed', function() {
// 	$tagList = array('Fighting','Maze','Arcade','Shooter','Adventure','Stealth','Horror','Graphic Adventure','Role-Playing','Japanese Role-Playing', 'Turn-Based','Simulation','Strategy','Sports','Racing','Music','Party','Puzzle','Trivia','Multiplayer','NES','SNES','Playstation','Playstation 2','Playstation 3','Playstation 4','Nintendo64','Nintendo GameCube', 'Xbox', 'Xbox 360','Xbox One','Wii', 'Wii U','Game Boy','Game Boy Color','Game Boy Advance','Nintendo DS','Nintendo 3DS', 'PC');
// 	for ($i = 0; $i < count($tagList); $i++) {
// 		$newTag = new Tag;
// 		$newTag->name = $tagList[$i];
// 		$newTag->save();
// 	}
// });

// Route::get('/', function()
// {
// 	return View::make('hello');
// });

// Route::get('mysql-test', function() {

//     # Print environment
//     echo 'Environment: '.App::environment().'<br>';

//     # Use the DB component to select all the databases
//     $results = DB::select('SHOW DATABASES;');

//     # If the "Pre" package is not installed, you should output using print_r instead
//     var_dump($results);

// });

# bind route parameters
Route::model('game', 'Game');

# load Pages
Route::get('/', 'GamesController@index'); # welcome screen with search box
Route::get('/results', array( 'before' => 'auth', 'uses' => 'GamesController@get_search_results')); # show search results
Route::get('/create', array( 'before' => 'auth', 'uses' => 'GamesController@get_create')); # show game creation form
Route::get('/games', 'GamesController@get_all_games'); # show all games to guests and search to users
Route::get('/my-games', array( 'before' => 'auth', 'uses' => 'GamesController@get_my_games')); # show user's game collection
Route::get('/edit/{id}', array( 'before' => 'auth', 'uses' => 'GamesController@get_edit')); # edit game 
Route::get('/roulette', array( 'before' => 'auth', 'uses' => 'GamesController@get_roulette')); # show game roulette form
Route::get('/signup', array( 'before' => 'guest', 'uses' => 'UserController@get_signup')); # show sign up form
Route::get('/login', array( 'before' => 'guest', 'uses' => 'UserController@get_login')); # show log in form
Route::get('/search', array( 'before' => 'auth', 'uses' => 'GamesController@get_search')); #show search form

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


