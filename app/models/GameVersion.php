<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class GameVersion extends Eloquent {
	
	public function games() {
		return $this->hasMany('Game', 'version_id');
	}
	
	public function alliances() {
		return $this->belongsToMany('Alliance', 'alliance_teams', 'version_id', 'alliance_id');
	}
	
	public function teams() {
		return $this->belongsToMany('Team', 'alliance_teams', 'version_id', 'team_id')
					->withPivot('alliance_id', 'order')
					->orderBy('pivot_order');
	}
	
	public function territoryDefaultAssignments() {
		return $this->hasMany('TerritoryDefaultAssignment');
	}
	
}