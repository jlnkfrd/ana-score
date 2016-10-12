<?php

use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class TerritorySeeder extends Seeder {

    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		
		DB::table('territory_game_assignments')->truncate();
		DB::table('territory_default_assignments')->truncate();
		DB::table('territories')->truncate();
		DB::table('territory_locations')->truncate();
		DB::table('territory_types')->truncate();
		
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
		
		$territory_types = [
			['name' => 'land'],
			['name' => 'island'],
			['name' => 'island group']
		];
		
		foreach ($territory_types as $type) {
			TerritoryType::create($type);
		}
		
		$territory_locations = [
			['name' => 'North America'], 			//1
			['name' => 'Carribean Sea'],
			['name' => 'South America'],
			['name' => 'North Atlantic Ocean'],
			['name' => 'South Atlantic Ocean'],		//5
			['name' => 'Europe'],
			['name' => 'Mediteranean Sea'],
			['name' => 'North Africa'],
			['name' => 'South Africa'],
			['name' => 'Western Russia'],			//10
			['name' => 'Middle East'],
			['name' => 'Indian Ocean'],
			['name' => 'Central Russia'],
			['name' => 'Eastern Russia'],
			['name' => 'South East Asia'],			//15
			['name' => 'South West Pacific'],
			['name' => 'Australia'],
			['name' => 'Bering Sea/Strait'],
			['name' => 'North Pacific Ocean'],
			['name' => 'South Pacific Ocean'],		//20
			['name' => 'Western Pacific Ocean'],
			['name' => 'Arctic Ocean']
		];

		foreach ($territory_locations as $loc) {
			TerritoryLocation::create($loc);
		}

		$lexer = new Lexer(new LexerConfig());
		$interpreter = new Interpreter();
		$interpreter->addObserver(function(array $row) {
			$data = [
				'name' => $row[2],
				'type_id' => $row[3],
				'location_id' => $row[4]
			];
			$territory = Territory::create($data);
			
			$assignment_props = [
				'version_id' => 2,
				'territory_id' => $territory->id,
				'initial_owner_id' => $row[6],
				'value' => $row[7]
			];
			TerritoryDefaultAssignment::create($assignment_props);
		});
		$lexer->parse('app/database/seeds/territories-twelve-team.csv', $interpreter);

		$territories = [
			[
				'name' => 'Moscow', 'type_id' => 1, 'location_id' => 10,
				'versions' => [
					1 => ['capitol' => true, 'value' => 10, 'initial_owner_id' => 1],
					2 => ['capitol' => true, 'value' => 18, 'initial_owner_id' => 1]
				]
			],
			[
				'name' => 'Berlin', 'type_id' => 1, 'location_id' => 6,
				'versions' => [
					1 => ['capitol' => true, 'value' => 16, 'initial_owner_id' => 2],
					2 => ['capitol' => true, 'value' => 32, 'initial_owner_id' => 2]
				]
			],
			[
				'name' => 'United Kingdom', 'short_name' => 'UK', 'type_id' => 2, 'location_id' => 4,
				'versions' => [
					1 => ['capitol' => true, 'value' => 16, 'initial_owner_id' => 3],
					2 => ['capitol' => true, 'value' => 20, 'initial_owner_id' => 3]
				]
			],
			[
				'name' => 'Italy', 'type_id' => 1, 'location_id' => 6,
				'versions' => [
					1 => ['capitol' => false, 'value' => 2, 'initial_owner_id' => 2],
					2 => ['capitol' => true, 'value' => 24, 'initial_owner_id' => 4]
				]
			],
			[
				'name' => 'Sicily', 'type_id' => 2, 'location_id' => 7,
				'versions' => [
					2 => ['capitol' => false, 'value' => 2, 'initial_owner_id' => 4]
				]
			],
			[
				'name' => 'Algeria', 'type_id' => 1, 'location_id' => 8,
				'versions' => [
					1 => ['capitol' => false, 'value' => 1, 'initial_owner_id' => 2],
					2 => ['capitol' => false, 'value' => 2, 'initial_owner_id' => 4]
				]
			],
			[
				'name' => 'Tunisia', 'type_id' => 1, 'location_id' => 8,
				'versions' => [
					2 => ['capitol' => false, 'value' => 2, 'initial_owner_id' => 4]
				]
			],
			[
				'name' => 'Libya', 'type_id' => 1, 'location_id' => 8,
				'versions' => [
					1 => ['capitol' => false, 'value' => 1, 'initial_owner_id' => 2],
					2 => ['capitol' => false, 'value' => 4, 'initial_owner_id' => 4]
				]
			],
			[
				'name' => 'Eastern Canada', 'type_id' => 1, 'location_id' => 1,
				'versions' => [
					1 => ['capitol' => false, 'value' => 2, 'initial_owner_id' => 3],
					2 => ['capitol' => true, 'value' => 12, 'initial_owner_id' => 5]
				]
			],
			[
				'name' => 'Romania', 'type_id' => 1, 'location_id' => 6,
				'versions' => [
					1 => ['capitol' => false, 'value' => 2, 'initial_owner_id' => 2],
					2 => ['capitol' => true, 'value' => 23, 'initial_owner_id' => 6]
				]
			],
			[
				'name' => 'Greece', 'type_id' => 1, 'location_id' => 6,
				'versions' => [
					2 => ['capitol' => false, 'value' => 3, 'initial_owner_id' => 6]
				]
			],
			[
				'name' => 'Crete', 'type_id' => 2, 'location_id' => 7,
				'versions' => [
					2 => ['capitol' => false, 'value' => 2, 'initial_owner_id' => 6]
				]
			],
			[
				'name' => 'Korea', 'type_id' => 1, 'location_id' => 15,
				'versions' => [
					2 => ['capitol' => true, 'value' => 32, 'initial_owner_id' => 7]
				]
			],
			[
				'name' => 'Eastern Australia', 'type_id' => 1, 'location_id' => 17,
				'versions' => [
					2 => ['capitol' => true, 'value' => 10, 'initial_owner_id' => 8]
				]
			],
			[
				'name' => 'Hungary', 'type_id' => 1, 'location_id' => 6,
				'versions' => [
					2 => ['capitol' => true, 'value' => 16, 'initial_owner_id' => 9]
				]
			],
			[
				'name' => 'Croatia', 'type_id' => 1, 'location_id' => 6,
				'versions' => [
					2 => ['capitol' => false, 'value' => 4, 'initial_owner_id' => 9]
				]
			],
			[
				'name' => 'Cyprus', 'type_id' => 2, 'location_id' => 7,
				'versions' => [
					2 => ['capitol' => false, 'value' => 2, 'initial_owner_id' => 9]
				]
			],
			[
				'name' => 'Kashi', 'type_id' => 1, 'location_id' => 15,
				'versions' => [
					2 => ['capitol' => true, 'value' => 16, 'initial_owner_id' => 10]
				]
			],
			[
				'name' => 'Lanzhou', 'type_id' => 1, 'location_id' => 15,
				'versions' => [
					2 => ['capitol' => false, 'value' => 2, 'initial_owner_id' => 10]
				]
			],
			[
				'name' => "Xi'an", 'type_id' => 1, 'location_id' => 15,
				'versions' => [
					2 => ['capitol' => false, 'value' => 3, 'initial_owner_id' => 10]
				]
			],
			[
				'name' => "Tibet", 'type_id' => 1, 'location_id' => 15,
				'versions' => [
					2 => ['capitol' => false, 'value' => 2, 'initial_owner_id' => 10]
				]
			],
			[
				'name' => "Chongqing", 'type_id' => 1, 'location_id' => 15,
				'versions' => [
					2 => ['capitol' => false, 'value' => 3, 'initial_owner_id' => 10]
				]
			],
			[
				'name' => "Qamodo", 'type_id' => 1, 'location_id' => 15,
				'versions' => [
					2 => ['capitol' => false, 'value' => 2, 'initial_owner_id' => 10]
				]
			],
			[
				'name' => 'Tokyo', 'type_id' => 2, 'location_id' => 15,
				'versions' => [
					1 => ['capitol' => true, 'value' => 12, 'initial_owner_id' => 11],
					2 => ['capitol' => true, 'value' => 25, 'initial_owner_id' => 11]
				]
			],
			[
				'name' => 'Eastern US', 'type_id' => 1, 'location_id' => 1,
				'versions' => [
					1 => ['capitol' => true, 'value' => 15, 'initial_owner_id' => 12],
					2 => ['capitol' => true, 'value' => 27, 'initial_owner_id' => 12]
				]
			]
		];
		
		

		// foreach ($territories as $ter) {
		// 	$versions = $ter['versions'];
		// 	unset($ter['versions']);
		//
		// 	$territory = Territory::create($ter);
		//
		// 	foreach ($versions as $version_id => $props) {
		// 		$props['version_id'] = $version_id;
		// 		$props['territory_id'] = $territory->id;
		// 		$assignment = TerritoryDefaultAssignment::create($props);
		// 	}
		// }
    }

}