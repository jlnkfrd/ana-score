<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class TerritoryGameAssignment extends Eloquent {
	
	protected $fillable = ['game_id', 'territory_id', 'current_owner_id'];

	public function game() {
		return $this->belongsTo('Game');
	}
	
	public function territory() {
		return $this->belongsTo('Territory');
	}
	
	public function owner() {
		return $this->belongsTo('Team', 'current_owner_id');
	}

}