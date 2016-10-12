<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class TerritoryType extends Eloquent {
	
	protected $fillable = ['name'];
	
	public function territories() {
		return $this->hasMany('Territory');
	}
}