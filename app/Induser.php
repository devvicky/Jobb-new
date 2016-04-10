<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Induser extends Model {

	protected $fillable = ['fname', 'lname', 'email', 'mobile', 'mobile_otp', 'email_vcode'];
	protected $appends = ['friends', 'job_role', 'preferred_locations'];

	public function user(){
		return $this->hasOne('app\user', 'induser_id', 'id');
	}

	public function profileUser(){
		return $this->hasOne('App\Induser', 'id', 'individual_id');
	}

	public function friendsOfMine(){
	  return $this->belongsToMany('App\Induser', 'connections', 'user_id', 'connection_user_id')
			      ->withPivot('id')
			      ->withPivot('status');
	}

	public function friendOf(){
	  return $this->belongsToMany('App\Induser', 'connections', 'connection_user_id', 'user_id')
	 			 ->withPivot('id')
			     ->withPivot('status');
	}

	public function getFriendsAttribute(){
	    if ( ! array_key_exists('connections', $this->relations)) 
	    	$this->loadFriends();

	    return $this->getRelation('connections');
	}

	protected function loadFriends(){
	    if ( ! array_key_exists('connections', $this->relations))
	    {
	        $connections = $this->mergeFriends();

	        $this->setRelation('connections', $connections);
	    }
	}

	protected function mergeFriends(){
	    return $this->friendsOfMine->merge($this->friendOf);
	}

	public function groups(){
        return $this->belongsToMany('App\Group', 'groups_users', 'user_id', 'group_id')->withPivot('id');
    }


    public function posts(){
        return $this->hasMany('App\Postjob', 'individual_id', 'id');
    }

    public function preferredLocation(){
		return $this->belongsToMany('App\User', 'user_preferred_locations', 'user_id', 'id')->withTimestamps();
	}

	public function preferLocations(){
		return $this->hasMany('App\UserPreferredLocation', 'user_id', 'id')->select('user_id', 'locality', 'city', 'state');
	}

	public function getJobRoleAttribute(){
    	$role = $this->attributes['role'];
    	if($role != "0"){
    		try {
    			$roleDetail = Industry_functional_area_role_mapping
							::where('industry_functional_area_role_mappings.id', '=', $role)
							->leftjoin('roles', 'industry_functional_area_role_mappings.role', '=', 'roles.id')
							->leftjoin('industry_functional_area_mappings', 'industry_functional_area_role_mappings.industry_functional_area', '=', 'industry_functional_area_mappings.id')
							->leftJoin('industries', 'industry_functional_area_mappings.industry', '=', 'industries.id')
							->leftJoin('functional_areas', 'industry_functional_area_mappings.functional_area', '=', 'functional_areas.id')
							->get(['industries.name as industry', 'functional_areas.name as functional_area', 'roles.name as role']);

				return $roleDetail;
    		} catch (Exception $e) {
    			return null;
    			}
    		
    	}else{
    		return null;
    	}
    	
    }

    public function getPreferredLocationsAttribute(){
    	$loc = $this->attributes['prefered_location'];
    	if($loc != null){
    		
    		$arr = explode(',', $loc);
    		return $arr;
    	}else{
    		return null;
    	}
    }

}
