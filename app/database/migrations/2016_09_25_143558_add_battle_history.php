<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBattleHistory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('territory_battles', function($table) {
			$table->increments('id');
			$table->integer('game_id')->unsigned();
			$table->integer('round_number')->unsigned();
			$table->integer('territory_id')->unsigned();
			$table->integer('current_owner_id')->unsigned();
			$table->integer('attacking_team_id')->unsigned();
			$table->boolean('successful');
			$table->timestamps();

			$table->foreign('game_id')->references('id')->on('games');
			$table->foreign('territory_id')->references('id')->on('territories');
			$table->foreign('current_owner_id')->references('id')->on('teams');
			$table->foreign('attacking_team_id')->references('id')->on('teams');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('territory_battles');
		
	}

}
