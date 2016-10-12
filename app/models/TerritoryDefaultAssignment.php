<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class TerritoryDefaultAssignment extends Eloquent {

	protected $fillable = ['version_id', 'territory_id', 'initial_owner_id', 'capitol', 'value'];
	
	public function version() {
		return $this->belongsTo('Version');
	}
	
	public function territory() {
		return $this->belongsTo('Territory');
	}
	
	public function defaultOwner() {
		return $this->belongsTo('Team', 'initial_owner_id');
	}
	
	public static function new_game($game) {
		$assignments = static::where('version_id', $game->version_id)->get();
		foreach ($assignments as $assignment) {
			TerritoryGameAssignment::create([
				'game_id' => $game->id,
				'territory_id' => $assignment->territory_id,
				'current_owner_id' => $assignment->initial_owner_id
			]);
		}
	}
}