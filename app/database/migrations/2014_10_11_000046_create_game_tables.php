<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the game versions table
		Schema::create('game_versions', function($table) {
			$table->increments('id');
			$table->char('name', 50);
			$table->timestamps();
		});
		
		// Create the games table
		Schema::create('games', function($table) {
		    $table->increments('id');
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
			$table->integer('version_id')->unsigned();
		    $table->timestamps();
		    $table->softDeletes();

			$table->foreign('version_id')->references('id')->on('game_versions');
		});
		
		// Create the alliances table
		Schema::create('alliances', function($table) {
			$table->increments('id');
			$table->char('name', 50);
			$table->char('logo_location', 50)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		
		// Create the teams table
		Schema::create('teams', function($table) {
			$table->increments('id');
			$table->char('name', 50);
			$table->char('short_name', 8);
			$table->char('color', 6);
			$table->char('logo_location', 50)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		
		// Create the alliance_teams table
		Schema::create('alliance_teams', function($table) {
			$table->increments('id');
			$table->integer('version_id')->unsigned();
			$table->integer('alliance_id')->unsigned();
			$table->integer('team_id')->unsigned();
			$table->integer('order')->unsigned();
			
			$table->foreign('version_id')->references('id')->on('game_versions');
			$table->foreign('alliance_id')->references('id')->on('alliances');
			$table->foreign('team_id')->references('id')->on('teams');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop tables
		Schema::drop('alliance_teams');
		Schema::drop('teams');
		Schema::drop('alliances');
		Schema::drop('games');
		Schema::drop('game_versions');
	}

}
