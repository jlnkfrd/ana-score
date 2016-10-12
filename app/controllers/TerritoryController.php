<?php

class TerritoryController extends BaseController {

	public function updateScore($territory_id) {
		$game_id = Input::get('game_id');
		$new_owner_id = Input::get('new_owner_id');
		
		$game = Game::with('territoryAssignments.territory')->find($game_id);
		// dd($game->territoryAssignments[0]);
		$territoryAssignment = $game->territoryAssignments->first(function($key, $assignment) use($territory_id) {
			return $assignment->territory_id == $territory_id;
		});
		
		TerritoryBattle::create([
			'game_id' => $game->id,
			'round_number' => $game->round_number,
			'territory_id' => $territory_id,
			'attacking_team_id' => $new_owner_id,
			'current_owner_id' => $territoryAssignment->current_owner_id,
			'successful' => true,
		]);
		
		$territoryAssignment->current_owner_id = $new_owner_id;
		$territoryAssignment->save();

		return Response::json(null, 200);
	}
	
	public function invasions($game_id) {
		$game = Game::with('invasions.territory', 'invasions.attackingTeam')->find($game_id);
		return Response::json($game->invasions, 200);
	}

}