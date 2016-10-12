<?php

class ClassicSeeder extends Seeder {

    public function run()
    {
		$classic_version = GameVersion::create(['name' => 'Classic']);
		
		$classic_version->teams()->attach(1, ['alliance_id' => 1, 'order' => 1]);
		$classic_version->teams()->attach(2, ['alliance_id' => 2, 'order' => 2]);
		$classic_version->teams()->attach(3, ['alliance_id' => 1, 'order' => 3]);
		$classic_version->teams()->attach(11, ['alliance_id' => 2, 'order' => 4]);
		$classic_version->teams()->attach(12, ['alliance_id' => 1, 'order' => 5]);
    }

}