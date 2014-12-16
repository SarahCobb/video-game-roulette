<?php

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
		$tags = Tag::all();
		return View::make('create')
			->with('tags', $tags);
	}
	
	public function post_create()
	{
		# create game 
		$game = new Game();
	    $game->title = Input::get('title');
	    $game->platform = Input::get('platform');
	    $game->publisher = Input::get('publisher');
	    $game->description = Input::get('description');
	    $game->save();

	    # attach tags
		$tags = Input::except('_token', 'title', 'platform', 'publisher', 'description');
		foreach ($tags as $tag => $id) {
			$tag = Tag::find($id);
			$game->tags()->attach($tag);
		}

	    # automatically add to user collection
	    Auth::user()->games()->attach($game);

	    # redirect to user collection view
		return Redirect::action('UserController@get_my_games')
			->with('flash_message', 'Game created and added to your collection.');
	}

	public function get_edit($id)
	{
		# eager load game instance with tags
		$game = Game::find($id);
		$all_tags = Tag::all();
		$tags = Tag::with('games')
			->whereHas('games', function($q) use ($id) {
		    	$q->where('game_id', '=', $id);
			})->lists('id');

		# pass games with tags to view
		return View::make('edit')
			->with('game', $game)
			->with('all_tags', $all_tags)
			->with('tags', $tags);
	}

	public function post_edit($id)
	{
		# look up game istance and save new details
		$game = Game::find(Input::get('id'));
	    $game->title = Input::get('title');
	    $game->platform = Input::get('platform');
	    $game->publisher = Input::get('publisher');
	    $game->description = Input::get('description');
	    $game->save();

	    # associate new tags with game
	    $tags = Input::except('_token', 'title', 'platform', 'publisher', 'description');
		foreach ($tags as $tag => $id) {
			$tag = Tag::find($id);
			$game->tags()->attach($tag);
		}

	    # redirect to user game collection
    	return Redirect::action('UserController@get_my_games')
    		->with('flash_message', 'Game saved.'); 
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
			return View::make('search_results')
				->with('results', $results)
				->with('query', $query);
		}

	}

	public function results()
	{
		return View::make('search_results');
	}
}