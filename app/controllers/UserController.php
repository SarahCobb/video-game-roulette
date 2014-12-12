<?php

use XmlIterator\XmlIterator;

class UserController extends BaseController 
{
	public function get_add()
	{
		# Show add game form
		$tags = file('tags.txt');
		return View::make('add')
			->with('tags', $tags);
	}
	
	public function post_add($id)
	{
		# Handle adding game with tags to user collection
		$user = Auth::user();
		Game::find($id)->users()->save($user);
		# Return to home
		return Redirect::action('GamesController@index')
			->with('flash_message', 'Game added to your collection!');
	}

	public function remove($id)
	{
		# Remove game from user collection
		$user = Auth::user();
		$game = Game::find($id);
		$game->users()->detach($user->id);
		# Return home
		return Redirect::action('GamesController@index')
			->with('flash_message', 'Game removed from your collection!');
	}

	public function get_my_games()
	{
		# Query database for all games belonging to authenticated user
		# Pass collection to view
		# Return view

		/* Show user's game collection
		$userID = Auth::id();
		// Get all games
		// $games = Game::all=();
		// foreach($games as $game){
		if($game_id == $user_id){
			echo $game->name;
		}
	}
		// conditional on game_id = user_id, echo game
		$userGames = User::find($userID);
		$games = $userGames->games;
		// $games = $user->games;
		return View::make('collection')
			->with('games', $games); */
	}

	public function get_roulette()
	{
		# Show roulette form
		return View::make('roulette');
	}

	public function post_roulette()
	{
		# Handle roulette form and results
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