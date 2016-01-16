<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Corpsearchprofile extends Model{
	
	public function indUser(){
		return $this->hasOne('App\Induser', 'id', 'individual_id');
	}
	public function favProfile(){
		return $this->hasMany('App\Corpsearchprofile', 'profile_id', 'id');
	}

}