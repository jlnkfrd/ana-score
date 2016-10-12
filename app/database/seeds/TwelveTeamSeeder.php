<?php

class TwelveTeamSeeder extends Seeder {

    public function run()
    {
		$twelve_team = GameVersion::create(['name' => '12-Team']);
		
		$twelve_team->teams()->attach(1, ['alliance_id' => 1, 'order' => 1]);
		$twelve_team->teams()->attach(2, ['alliance_id' => 2, 'order' => 2]);
		$twelve_team->teams()->attach(3, ['alliance_id' => 1, 'order' => 3]);
		$twelve_team->teams()->attach(4, ['alliance_id' => 2, 'order' => 4]);
		$twelve_team->teams()->attach(5, ['alliance_id' => 1, 'order' => 5]);
		$twelve_team->teams()->attach(6, ['alliance_id' => 2, 'order' => 6]);
		$twelve_team->teams()->attach(7, ['alliance_id' => 2, 'order' => 7]);
		$twelve_team->teams()->attach(8, ['alliance_id' => 1, 'order' => 8]);
		$twelve_team->teams()->attach(9, ['alliance_id' => 2, 'order' => 9]);
		$twelve_team->teams()->attach(10, ['alliance_id' => 1, 'order' => 10]);
		$twelve_team->teams()->attach(11, ['alliance_id' => 2, 'order' => 11]);
		$twelve_team->teams()->attach(12, ['alliance_id' => 1, 'order' => 12]);
    }

}