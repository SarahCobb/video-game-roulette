<?php

class UserController extends BaseController 
{
	public function get_add()
	{
		// Show add game form
		return View::make('add');
	}
	
	public function post_add($id)
	{
		// Handle adding game to user collection
		$user = Auth::user();
		Game::find($id)->users()->save($user);

		return Redirect::action('GamesController@showGames')->with('flash_message', 'Game added to your collection!');

	}

	public function remove($id)
	{
		// Handle removing game from user collection
		$user = Auth::user();
		$game = Game::find($id);
		$game->users()->detach($user->id);

		return Redirect::action('GamesController@showGames')->with('flash_message', 'Game removed from your collection!');
	}

	public function get_collection()
	{
		// Show user's game collection
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
			->with('games', $games);
	}

	public function get_signup()
	{
		// Show signup form
		return View::make('signup');
	}

	public function post_signup()
	{
		// Handle user creation
		$rules = array(
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:6'
		);

		$validator = Validator::make(Input::all(), $rules);
		if($validator->fails()) {
			return Redirect::to('/signup')
				->with('flash_message', 'Sign up failed :( Please fix the errors below.')
				->withInput()
				->withErrors($validator);
		}
		$user = new User;
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		try {
			$user->save();
		}
		catch (Exception $e) {
			return Redirect::to('/signup')
				->with('flash_message', 'Sign up failed :( Please try again.')
				->withInput();
		}
		Auth::login($user);
		// $user->sendWelcomeEmail();
		return Redirect::action('HomeController@index')->with('flash_message', 'Welcome to Video Game Roulette!');
		

		
	}

	public function get_login()
	{
		// Show login form
		return View::make('login');
	}

	public function post_login()
	{
		// Handle user login
		$credentials = Input::only('email', 'password');
		# Note we don't have to hash the password before attempting to auth - Auth::attempt will take care of that for us
		if (Auth::attempt($credentials)) {
			return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
		}
		else {
			return Redirect::action('UserController@login')
				->with('flash_message', 'Log in failed :( Please try again.')
				->withInput();
		}
	}

	public function get_reset()
	{
		// Show password reset form
		return View::make('reset');
	}

	public function post_reset()
	{
		// Handle password reset
	}

	public function logout()
	{
		// Handle user log out
				# Log out
		Auth::logout();
		# Send them to the homepage
		return Redirect::action('HomeController@index');

	}
}