<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class TerritoryBattle extends Eloquent {
	
	protected $fillable = ['game_id', 'round_number', 'territory_id', 'current_owner_id', 'attacking_team_id', 'successful'];
	
	public function territory() {
		return $this->belongsTo('Territory');
	}
	
	public function attackingTeam() {
		return $this->belongsTo('Team','attacking_team_id');
	}
	
	public function owner() {
		return $this->belongsTo('Team', 'current_owner_id');
	}
}