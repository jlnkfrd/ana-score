<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class TerritoryLocation extends Eloquent {
	
	protected $fillable = ['name'];
	
	public function territories() {
		return $this->hasMany('Territory');
	}
	
}