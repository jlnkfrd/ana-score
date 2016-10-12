<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Team extends Eloquent {
	
	public function versions() {
		return $this->belongsToMany('Version', 'alliance_teams', 'team_id', 'version_id')
					->withPivot('alliance_id', 'order');
	}
	
	public function alliances() {
		return $this->belongsToMany('Alliance', 'alliance_teams')
					->with('version_id');
	}
	
	public function invasions() {
		return $this->hasMany('TerritoryBattle', 'attacking_team_id');
	}
	
	public function invaded() {
		return $this->hasMany('TerritoryBattle', 'current_owner_id');
	}
	
}