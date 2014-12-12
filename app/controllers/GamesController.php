<?php

class GamesController extends BaseController
{
	
	public function get_games()
	{
		// Show all games
		$games = Game::all();
		return View::make('library', compact('games'));
	}

	public function get_create()
	{
		// genre list
		$genreList = array('action','fighting','maze','arcade','shooter','adventure','stealth','horror','graphic adventure','role-playing','japanese role-playing', 'turn-based','simulation','strategy','sports','racing','music','party','puzzle','trivia','multiplayer');
		return View::make('create')
			->with('genreList', $genreList);
	}

	public function post_create()
	{
		// Handle create game form submission

		$game = new Game();
	    $game->title = Input::get('title');
	    $game->creator = Input::get('creator');
	    $game->save();

	    $input = Input::all();
	    var_dump($input);
	    //$genres = array();
	    //	$newGenre = Input::get($genre);
	    //	$game->genres()->attach($genre);

	    //return Redirect::action('GamesController@showGames')->with('flash_message', 'Game created.');
	}

	public function get_edit($id)
	{
		// Show edit game form
		try {
			$game = Game::findOrFail($id);
			$genre = Genre::findOrFail($id);
		}
		catch(exception $e) {
			return Redirect::action('GamesController@showGames')->with('flash_message', 'Game not found.');
		}
		return View::make('edit')
			->with('game', $game)
			->with('genre', $genre);
	}

	public function post_edit()
	{
		// Handle edit game form
		$game = Game::findOrFail(Input::get('id'));
	    $game->title = Input::get('title');
	    $game->creator = Input::get('creator');
	    $game->save();

    	return Redirect::action('GamesController@showGames')->with('flash_message', 'Game saved.');
	}

	public function get_search()
	{
		// Show game search form
		return View::make('search');
	}

	public function post_search()
	{
		// Handle game search form

	}

}