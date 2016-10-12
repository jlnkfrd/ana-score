<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('TeamSeeder');
		$this->call('ClassicSeeder');
		$this->call('TwelveTeamSeeder');
		$this->call('TerritorySeeder');
	}

}
