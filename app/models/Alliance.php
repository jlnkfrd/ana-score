<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Alliance extends Eloquent {
	
	public function versions() {
		return $this->belongsToMany('Version', 'alliance_teams', 'alliance_id', 'version_id')
					->withPivot('team_id');
	}
	
	public function teams() {
		return $this->belongsToMany('Team', 'alliance_teams')
					->withPivot('version_id');
	}
	
}