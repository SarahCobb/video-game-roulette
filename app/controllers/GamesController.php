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
		
		# validate user input
		$rules = array(
			'title' => 'required|unique:games,title',
			'publisher' => 'required',
			'platform' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);
		if($validator->fails()) {
			return Redirect::action('GamesController@get_create')
				->with('flash_message', 'Game creation failed :( Please fix the errors below.')
				->withInput()
				->withErrors($validator);
		}

		# create game 
		$game = new Game();
	    $game->title = Input::get('title');
	    $game->platform = Input::get('platform');
	    $game->publisher = Input::get('publisher');
	    $game->save();

	    # attach tags
		$tags = Input::except('_token', 'title', 'platform', 'publisher', 'save');
		foreach ($tags as $tag => $id) {
			$tag = Tag::find($id);
			$game->tags()->attach($tag);
		}

	    # automatically add to user collection
	    Auth::user()->games()->attach($game);

	    # redirect to user collection view
		return Redirect::action('GamesController@get_my_games')
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
		# validate user input
		$rules = array(
			'title' => 'required',
			'publisher' => 'required',
			'platform' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);
		if($validator->fails()) {
			return Redirect::action('GamesController@get_create')
				->with('flash_message', 'Save failed :( Please fix the errors below.')
				->withInput()
				->withErrors($validator);
		}

		# look up game istance and save new details
		$game = Game::find(Input::get('id'));
	    $game->title = Input::get('title');
	    $game->platform = Input::get('platform');
	    $game->publisher = Input::get('publisher');
	    $game->save();

	    # associate new tags with game
	    $tags = Input::except('_token', 'title', 'platform', 'publisher', 'save');
		foreach ($tags as $tag => $id) {
			$tag = Tag::find($id);
			$game->tags()->attach($tag);
		}

	    # redirect to user game collection
    	return Redirect::action('GamesController@get_my_games')
    		->with('flash_message', 'Game saved.'); 
	}

	public function get_search() {

		return View::make('search');
	}

	public function search()
	{
		# Query database for games
		$query = Input::get('query');

		if (Input::has('search')) {
			$rules = array(
			'query' => 'required'
			);

			$validator = Validator::make(Input::all(), $rules);
			if($validator->fails()) {
				return Redirect::action('GamesController@search')
					->with('flash_message', 'Please enter a search term or choose all games!');
			}
		}

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

		public function get_add($id)
	{
		# add game to user collection
		$game = Game::find($id);
		Auth::user()->games()->attach($game);

		# return to user collection
		return Redirect::action('GamesController@get_my_games')
			->with('flash_message', 'Game added to your collection!');
	}

	public function remove($id)
	{
		# remove game from user collection
		$game = Game::find($id);
		Auth::user()->games()->detach($game);
		# Return home
		return Redirect::action('GamesController@get_my_games')
			->with('flash_message', 'Game removed from your collection!');
	}

	public function get_all_games() {
		$games = Game::all();
		return View::make('all_games')
			->with('games', $games);
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
			return Redirect::action('GamesController@search')
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

		# validate user input
		if (Input::has('roulette_tags') AND count(Input::all()) == 2) {
				return Redirect::action('GamesController@get_roulette')
					->with('flash_message', 'Please select some categories or choose all games!');
			}

		# get user and tags
		$id = Auth::id();
		if (Input::has('roulette_all')) {
			$tags = Tag::all()->lists('id');
		} else {
			$tags = Input::except('_token', 'roulette_tags');
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
        	return Redirect::action('GamesController@get_roulette')
        		->with('flash_message', 'No games meet your criteria. Try a different selection, or play with all games.');
        }

        # choose a random game from collection
        $rand = rand(0, (count($games) - 1));
        $games->toArray();
        $roulette = $games[$rand];

        # pass chosen game to results view
        return View::make('roulette_results')
        	->with('roulette', $roulette)
        	->with('games', $games);
	 }
}