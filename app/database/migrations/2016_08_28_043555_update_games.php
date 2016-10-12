<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGames extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('games', function(Blueprint $table)
		{
			$table->integer('round_number')->unsigned()->default(1)->after('version_id');
			$table->integer('current_team_id')->unsigned()->nullable()->after('round_number');
			
			$table->foreign('current_team_id')->references('id')->on('teams');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('games', function(Blueprint $table)
		{
			$table->dropForeign('games_current_team_id_foreign');
			$table->dropColumn('current_team_id');
			$table->dropColumn('round_number');
		});
	}

}
