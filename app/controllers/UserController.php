<?php

class UserController extends BaseController 
{
	public function get_add($id)
	{
		# add game to user collection
		$game = Game::find($id);
		Auth::user()->games()->attach($game);

		# return to user collection
		return Redirect::action('UserController@get_my_games')
			->with('flash_message', 'Game added to your collection!');
	}

	public function remove($id)
	{
		# remove game from user collection
		$game = Game::find($id);
		Auth::user()->games()->detach($game);
		# Return home
		return Redirect::action('UserController@get_my_games')
			->with('flash_message', 'Game removed from your collection!');
	}

	public function get_my_games()
	{
		# get all games belonging to authenticated user
		$id = Auth::id();
		$games = Game::whereHas('users', function($q) use ($id)
		{
		    $q->where('user_id', '=', $id);
		
		})->get();
		# Pass collection to view
		if ($games->isEmpty()) {
			return Redirect::action('GamesController@index')
				->with('flash_message', 'You have no games :( Why not search for some?');
		} else {
			return View::make('games')
				->with('games', $games);			
		}
	}

	public function get_roulette()
	{
		# show roulette form
		$tags = Tag::all();
		return View::make('roulette')
			->with('tags', $tags);
	}

	public function post_roulette()
	{
		# get user and tags
		$id = Auth::id();

		if (Input::get('all')) {
			$tags = Tag::all()->lists('id');
			//var_dump($tags);
		} else {
			$tags = Input::except('_token');
			//var_dump($tags);
		}
		
		# get games with desired tags
	    $games = Game::with('tags','users')
            ->whereHas('users', function($q) use ($id) {
                $q->where('user_id', '=', $id);
            })
            ->whereHas('tags', function($q) use ($tags) {
               	$q->whereIn('tag_id', $tags);
           	})
           	->get();

        # let the user know if there were no (or 1) games, else show results
        if ($games->isEmpty()) {
        	return Redirect::action('UserController@get_roulette')
        		->with('flash_message', 'No games meet your criteria. Try a different selection, or play with all games.');
        }

        # choose a random game from collection
        $rand = rand(0, (count($games) - 1));
        $games->toArray();
        var_dump($rand);
        $roulette = $games[$rand];
        
        # pass chosen game to results view
        return View::make('roulette_results')
        	->with('roulette', $roulette);
        
	}

	public function get_signup()
	{
		# show signup form
		return View::make('signup');
	}

	public function post_signup()
	{
		# validate user input
		$rules = array(
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:6'
		);

		$validator = Validator::make(Input::all(), $rules);
		if($validator->fails()) {
			return Redirect::action('UserController@get_signup')
				->with('flash_message', 'Sign up failed :( Please fix the errors below.')
				->withInput()
				->withErrors($validator);
		}
		# create new user
		$user = new User;
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		
		# save new user and catch exceptions
		try {
			$user->save();
		}
		catch (Exception $e) {
			return Redirect::action('UserController@get_signup')
				->with('flash_message', 'Sign up failed :( Please try again.')
				->withInput();
		}
		
		# log in user 
		Auth::login($user);
		return Redirect::action('GamesController@index')
			->with('flash_message', 'Welcome to Video Game Roulette!');
	}

	public function get_login()
	{
		# show login form
		return View::make('login');
	}

	public function post_login()
	{
		# handle user login
		$credentials = Input::only('email', 'password');
		if (Auth::attempt($credentials)) {
			return Redirect::intended('/')
				->with('flash_message', 'Welcome Back!');
		}
		else {
			return Redirect::action('UserController@get_login')
				->with('flash_message', 'Log in failed :( Please try again.')
				->withInput();
		}
	}

	public function get_reset()
	{
		# show password reset form
		return View::make('reset');
	}

	public function post_reset()
	{
		# handle password reset
	}

	public function logout()
	{
		# handle user log out
		Auth::logout();
		# send them to the homepage
		return Redirect::action('GamesController@index');

	}
}