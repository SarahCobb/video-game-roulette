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
}
