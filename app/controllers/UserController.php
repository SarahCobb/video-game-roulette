<?php

class UserController extends BaseController 
{

	public function get_signup()
	{
		# show signup form
		return View::make('signup');
	}

	public function post_signup()
	{
		# validate user input
		$rules = array(
			'first_name' => 'required|alpha_num',
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

	public function logout()
	{
		# handle user log out
		Auth::logout();
		# send them to the homepage
		return Redirect::action('GamesController@index');

	}
}