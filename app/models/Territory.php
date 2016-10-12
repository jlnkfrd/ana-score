<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Territory extends Eloquent {
	
	protected $fillable = ['name', 'short_name', 'location_id', 'type_id'];

	public function type() {
		return $this->belongsTo('TerritoryType');
	}
	
	public function location() {
		return $this->belongsTo('TerritoryLocation');
	}

	public function territoryDefaultAssignments() {
		return $this->hasMany('TerritoryDefaultAssignment');
	}
	
	public function territoryGameAssignments() {
		return $this->hasMany('TerritoryGameAssignment');
	}
	
	public function invasions() {
		return $this->hasMany('TerritoryBattle');
	}

}