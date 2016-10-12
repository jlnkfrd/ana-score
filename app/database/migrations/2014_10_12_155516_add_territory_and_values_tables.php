<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTerritoryAndValuesTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the territory types table
		Schema::create('territory_types', function($table) {
			$table->increments('id');
			$table->text('name', 50);
			$table->timestamps();
		});
		
		// Create the territory locations table
		Schema::create('territory_locations', function($table) {
			$table->increments('id');
			$table->text('name', 50);
			$table->timestamps();
		});
		
		// Create the territories table
		Schema::create('territories', function($table) {
		    $table->increments('id');
			$table->text('name', 50);
			$table->text('short_name', 10)->nullable();
			$table->integer('location_id')->unsigned();
			$table->integer('type_id')->unsigned();
		    $table->timestamps();
		    $table->softDeletes();

			$table->foreign('location_id')->references('id')->on('territory_locations');
			$table->foreign('type_id')->references('id')->on('territory_types');
		});
		
		// Create the territory assignments table
		Schema::create('territory_default_assignments', function($table) {
			$table->increments('id');
			$table->integer('version_id')->unsigned();
			$table->integer('territory_id')->unsigned();
			$table->integer('initial_owner_id')->unsigned();
			$table->boolean('capitol');
			$table->integer('value');
			$table->timestamps();

			$table->foreign('version_id')->references('id')->on('game_versions');
			$table->foreign('territory_id')->references('id')->on('territories');
			$table->foreign('initial_owner_id')->references('id')->on('teams');
		});
		
		Schema::create('territory_game_assignments', function($table) {
			$table->increments('id');
			$table->integer('game_id')->unsigned();
			$table->integer('territory_id')->unsigned();
			$table->integer('current_owner_id')->unsigned();
			$table->timestamps();

			$table->foreign('game_id')->references('id')->on('games');
			$table->foreign('territory_id')->references('id')->on('territories');
			$table->foreign('current_owner_id')->references('id')->on('teams');
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
		Schema::drop('territory_game_assignments');
		Schema::drop('territory_default_assignments');
		Schema::drop('territories');
		Schema::drop('territory_locations');
		Schema::drop('territory_types');
	}

}
