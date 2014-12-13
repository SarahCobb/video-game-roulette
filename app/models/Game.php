<?php

class Game extends Eloquent
{
	public function tags()
	{
		return $this->belongsToMany('Tag', 'user_game_tag', 'game_id', 'tag_id')
			->withPivot('user_id');
	}

	public function users()
	{
		return $this->belongsToMany('User', 'user_game_tag', 'game_id', 'user_id')
			->withPivot('tag_id');
	}

    public static function search($query) {
    # If there is a query, search the library with that query
    if($query) {
        # Eager load tags and author
        $books = Book::with('tags','author')
        ->whereHas('author', function($q) use($query) {
            $q->where('name', 'LIKE', "%$query%");
        })
        ->orWhereHas('tags', function($q) use($query) {
            $q->where('name', 'LIKE', "%$query%");
        })
        ->orWhere('title', 'LIKE', "%$query%")
        ->orWhere('published', 'LIKE', "%$query%")
        ->get();
        # Note on what `use` means above:
        # Closures may inherit variables from the parent scope.
        # Any such variables must be passed to the `use` language construct.
    }
    # Otherwise, just fetch all books
    else {
        # Eager load tags and author
        $books = Book::with('tags','author')->get();
    }
    return $books;
    }

}

