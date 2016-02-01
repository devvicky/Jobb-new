<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model {

	public function ifmapping(){
		return $this->belongsToMany('App\Industry', 'functional_areas', 'functional_area', 'industry')->withTimestamps();
	}

}