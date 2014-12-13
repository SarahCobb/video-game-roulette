<?php

use XmlIterator\XmlIterator;

class GamesController extends BaseController
{
	public function index()
	{
		# Return home view
		return View::make('home');
	}
	public function get_create()
	{
		# show game creation form
		return View::make('create');
	}
	
	public function post_create()
	{
		# create game and redirect to add form
		$game = new Game();
	    $game->title = Input::get('title');
	    $game->platform = Input::get('platform');
	    $game->publisher = Input::get('publisher');
	    $game->save();
		return Redirect::action('UserController@get_add')
			->with('game', $game);
	}

	public function get_edit($id)
	{
		/* show edit game tags form
		try {
			$game = Game::findOrFail($id);
			$genre = Genre::findOrFail($id);
		}
		catch(exception $e) {
			return Redirect::action('GamesController@showGames')->with('flash_message', 'Game not found.');
		}
		return View::make('edit')
			->with('game', $game)
			->with('genre', $genre); */
	}

	public function post_edit()
	{
		/* # save game tags to user collection
		$game = Game::findOrFail(Input::get('id'));
	    $game->title = Input::get('title');
	    $game->creator = Input::get('creator');
	    $game->save();

    	return Redirect::action('GamesController@index')
    		->with('flash_message', 'Game saved.'); */
	}

	public function search()
	{
		# Query database for games
		$query = Input::get('query');
		$results = Game::where('title', 'LIKE' , '%' . $query . '%')
						->orWhere('publisher', 'LIKE', '%' . $query . '%')
						->orWhere('platform', 'LIKE', '%' . $query . '%')
						->get();
		# If games found, redirect to results page
		if ($results->isEmpty()) {
			return Redirect::action('GamesController@get_create')
				->with('flash_message', 'No games found. Would you like to create one?');
		} else {
			return View::make('results')
				->with('results', $results)
				->with('query', $query);
		}

	}

	public function results()
	{
		return View::make('results');
	}
}