<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry_functional_area_mappings extends Model {

	public function ifrmapping(){
		return $this->belongsToMany('App\Industry_functional_area_mappings', 'industry_functional_area_role_mappings', 'industry_functional_area', 'role')->withTimestamps();
	}

}