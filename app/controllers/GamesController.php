<?php

class GameController extends BaseController {
	
	public function index() {
		$games = Game::with('currentTeam')->orderBy('start_date', 'desc')->limit(6)->get();
		return Response::json($games, 200);
	}
	
	public function store() {
		$version_id = Input::get('version_id');
		$game = Game::create(['version_id' => $version_id]);
		$game->init();
		$game->load('currentTeam.pivot');
		// return Response::json($game, 200);
	}
	
	public function versions() {
		return Response::json(GameVersion::get());
	}
	
	public function setTurn($game_id) {
		$game = Game::find($game_id);
		$game->round_number = Input::get('round_number');
		$game->current_team_id = Input::get('current_team_id');
		$game->save();
		return Response::json(null, 200);
	}
	
}