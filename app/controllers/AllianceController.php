<?php

class AllianceController extends BaseController {

	public function gameData($game_id) {
		$game = Game::with('version')->find($game_id);
		$version = $game->version;
		$alliances = $version->alliances()
							  ->distinct()
							  ->with(['teams' => function($q) use($version) {
								  $q->wherePivot('version_id', $version->id);
							  }])
							  ->get();
		return Response::json($alliances);
	}
	
	public function teamData($game_id = 1) {
		$game = Game::with('version')->find($game_id);
		$teams = $game->version->teams;
		return Response::json($teams);
	}
	
	
	public function initGame($version_id) {
		$game = Game::create(['version_id' => $version_id]);
		$game->init();
	}
	
	public function territories($game_id) {
		$game = Game::find($game_id);
		$territories = TerritoryGameAssignment::where('game_id', $game_id)
											  ->with(['territory.territoryDefaultAssignments' => function($q) use ($game) {
												  $q->where('territory_default_assignments.version_id', $game->version_id);
											  }])
											  ->get();
		// $territories = Territory::with(['territoryGameAssignments' => function($q) use ($game_id) {
		// 	$q->where('game_id', $game_id);
		// }])->get();
		return Response::json($territories);
	}

}
