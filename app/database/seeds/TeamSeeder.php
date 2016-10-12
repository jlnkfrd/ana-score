<?php

class TeamSeeder extends Seeder {

    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		
		DB::table('games')->truncate();
		DB::table('alliance_teams')->truncate();
		DB::table('game_versions')->truncate();
    	DB::table('alliances')->truncate();
		DB::table('teams')->truncate();
		
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
		
		$alliances = [
			['name' => 'Axis'],
			['name' => 'Allies']
		];
		
		foreach ($alliances as $alliance) Alliance::create($alliance);
		
		$teams = [
			['name' => 'Soviet Russia', 'short_name' => 'USSR', 'color' => '764C37', 'logo_location' => 'roundels/ussr.png'],
			['name' => 'Germany', 'short_name' => 'Ger', 'color' => '626262', 'logo_location' => 'roundels/germany.png'],
			['name' => 'United Kingdom', 'short_name' => 'UK', 'color' => 'CCB05A', 'logo_location' => 'roundels/uk.png'],
			['name' => 'Italy', 'short_name' => 'Ita', 'color' => '000000', 'logo_location' => 'roundels/italy.png'],
			['name' => 'Canada', 'short_name' => 'Can', 'color' => '44B4DE', 'logo_location' => 'roundels/canada.png'],
			['name' => 'Romania', 'short_name' => 'Rom', 'color' => 'ACB01B', 'logo_location' => 'roundels/romania.png'],
			['name' => 'Manchuria', 'short_name' => 'Man', 'color' => 'EC1F22', 'logo_location' => 'roundels/manchukuo.png'],
			['name' => 'Australia', 'short_name' => 'Aus', 'color' => 'F59F00', 'logo_location' => 'roundels/australia.png'],
			['name' => 'Hungary', 'short_name' => 'Hun', 'color' => '8E8E8E', 'logo_location' => 'roundels/hungary.png'],
			['name' => 'China', 'short_name' => 'Chi', 'color' => 'ECECEC', 'logo_location' => 'roundels/china.png'],
			['name' => 'Japan', 'short_name' => 'Jap', 'color' => 'FDF600', 'logo_location' => 'roundels/japan.png'],
			['name' => 'United States', 'short_name' => 'USA', 'color' => '858841', 'logo_location' => 'roundels/usa.png']
		];
		
		foreach ($teams as $team) Team::create($team);
    }

}