<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function tags()
	{
		return $this->hasMany('Tag', 'user_game_tag', 'user_id', 'tag_id', 'game_id')
			->withPivot('game_id');
	}

	public function games()
	{
		return $this->hasMany('Game', 'user_game_tag', 'user_id', 'game_id')
			->withPivot('tag_id');
	}
}