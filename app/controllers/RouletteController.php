<?php

class RouletteController extends BaseController
{
	public function index()
	{
		// Show homepage
		$games = Game::all();
		return View::make('home', compact('games'));
	}
	
	public function get_roulette()
	{
		// Show roulette form
		return View::make('roulette');
	}

	public function post_roulette()
	{
		// Handle roulette form and results
	}
}