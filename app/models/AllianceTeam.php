<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class AllianceTeam extends Eloquent {
	
	public function alliance() {
		return $this->belongsTo('Alliance');
	}
	
	public function team() {
		return $this->belongsTo('Team');
	}
	
	public function version() {
		return $this->belongsTo('GameVersion', 'version_id');
	}
	
}