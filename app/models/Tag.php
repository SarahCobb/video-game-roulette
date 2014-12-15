<?php

class Tag extends Eloquent
{
	public function users()
	{
		return $this->belongsToMany('User');
	}

	public function games()
	{
		return $this->belongsToMany('Game');
	}
}