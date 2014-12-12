<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoGameRoulette extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		# Create games table
		Schema::create('games', function($table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('platform');
			$table->text('description');
			$table->string('publisher');
			$table->binary('image');
			$table->timestamps();
		});

		# Create users table
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email')->unique();
			$table->string('remember_token', 100);
			$table->string('password');
			$table->timestamps();
		});

		# Create tags table
		Schema::create('tags', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});

		# Create triple pivot table
		Schema::create('user_game_tag', function($table)
		{
			$table->integer('game_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('tag_id')->unsigned();
			$table->foreign('game_id')->references('id')->on('games');
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('tag_id')->references('id')->on('tags');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop all the tables
		Schema::drop('games');
		Schema::drop('users');
		Schema::drop('tags');
		Schema::drop('user_game_tag');
	}

}
