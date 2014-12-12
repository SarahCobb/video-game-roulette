<?php

class Tag extends Eloquent
{
	public function users()
	{
		return $this->belongsToMany('User', 'user_game_tag', 'tag_id', 'user_id')
			->withPivot('game_id');
	}

	public function games()
	{
		return $this->belongsToMany('Game', 'user_game_tag', 'tag_id', 'game_id')
			->withPivot('user_id');
	}
}