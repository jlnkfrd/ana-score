<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Game extends Eloquent {
	
	protected $fillable = ['version_id', 'start_date'];
	
	public function version() {
		return $this->belongsTo('GameVersion', 'version_id');
	}
	
	public function territoryAssignments() {
		return $this->hasMany('TerritoryGameAssignment');
	}
	
	public function currentTeam() {
		return $this->belongsTo('Team', 'current_team_id');
	}
	
	public function invasions() {
		return $this->hasMany('TerritoryBattle');
	}
	
	public function init() {
		$this->start_date = date('Y-m-d');
		$this->round_number = 1;
		$this->setTurn();
		$this->save();
		TerritoryDefaultAssignment::new_game($this);
	}
	
	public function setTurn($team_id = 0) {
		if ($team_id > 0) {
			$this->current_team_id = $team_id;
		} else {
			$this->current_team_id = $this->version->teams[0]->id;
		}
	}
	
	
	public function end() {
		$this->end_date = date('Y-m-d');
		$this->save();
	}
}