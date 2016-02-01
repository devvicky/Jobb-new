<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Induser;
use App\Industry_functional_area_role_mapping;


class Postjob extends Model {

	protected $fillable =  ['post_title', 
							'post_type',
							'post_compname',  
							'role', 
							'city', 
							'state', 
							'min_exp',
							'max_exp', 
							'min_sal', 
							'max_sal', 
							'salary_type',
							'job_detail', 
							'linked_skill', 
							'post_duration',
							'time_for', 
							'education', 
							'website_redirect_url', 
							'email_id',
							'alt_emailid',
							'phone',
							'alt_phone',
							'individual_id',
							'reference_id',
							'contact_person',
							'corporate_id',
							'unique_id',
							'resume_required'
						   ];

	protected $appends = ['magic_match', 'job_role'];

	public function indUser(){
		return $this->hasOne('App\Induser', 'id', 'individual_id');
	}

	public function corpUser(){
		return $this->hasOne('App\Corpuser', 'id', 'corporate_id');
	}

	public function skills(){
		return $this->belongsToMany('App\Skills')->withTimestamps();
	}

	public function getSkillListAttribute(){
		return $this-skills()->lists('id');
	}

	public function postActivity(){
		return $this->hasMany('App\Postactivity', 'post_id', 'id');
	}

	public function taggedUser(){
		return $this->belongsToMany('App\Postjob', 'post_user_taggings', 'post_id', 'user_id')->withTimestamps();
	}

	public function tagged(){
		return $this->hasMany('App\PostUserTagging', 'post_id', 'id');
	}

	public function sharedBy(){
		return $this->belongsToMany('App\Induser', 'post_user_taggings', 'post_id', 'tag_share_by')->select('user_id', 'mode', 'tag_share_by', 'fname', 'lname');
	}

	public function taggedGroup(){
		return $this->belongsToMany('App\Postjob', 'post_group_taggings', 'post_id', 'group_id')->withTimestamps();
	}

	public function groupTagged(){
		return $this->hasMany('App\PostGroupTagging', 'post_id', 'id')->select('group_id', 'mode', 'tag_share_by');
	}

	public function sharedGroupBy(){
		return $this->belongsToMany('App\Induser', 'post_group_taggings', 'post_id', 'tag_share_by')->select('group_id', 'mode', 'tag_share_by', 'fname', 'lname');
	}

	public function sharedToGroup(){
		return $this->belongsToMany('App\Group', 'post_group_taggings', 'post_id', 'group_id')->select('group_id', 'mode', 'tag_share_by', 'group_name');
	}

	public function user(){
		return $this->belongsTo('App\Induser');
	}


	public function getMagicMatchAttribute(){
		if(Auth::user()->identifier == 1){
			$userSkills = Induser::where('id', '=', Auth::user()->induser_id)->first(['linked_skill']);
			$userSkills = array_map('trim', explode(',', $userSkills->linked_skill));
			unset ($userSkills[count($userSkills)-1]);

			$postSkills = $this->attributes['linked_skill'];
			$postSkills = array_map('trim', explode(',', $this->attributes['linked_skill']));
			unset ($postSkills[count($postSkills)-1]);

			$overlap = array_intersect($userSkills, $postSkills);
			$counts  = array_count_values($overlap);
			if(count($counts) > 0){
				$percentage = round( ( count($counts) / count($postSkills) ) * 100 );
			}else{
				$percentage = 0;
			}

			return $percentage;
		}else{		
        	return null;
		}
    }

    public function getJobRoleAttribute(){
    	$role = $this->attributes['role'];
    	if($role != null){
    		$roleDetail = Industry_functional_area_role_mapping
							::where('industry_functional_area_role_mappings.id', '=', $role)
							->leftjoin('roles', 'industry_functional_area_role_mappings.role', '=', 'roles.id')
							->leftjoin('industry_functional_area_mappings', 'industry_functional_area_role_mappings.industry_functional_area', '=', 'industry_functional_area_mappings.id')
							->leftJoin('industries', 'industry_functional_area_mappings.industry', '=', 'industries.id')
							->leftJoin('functional_areas', 'industry_functional_area_mappings.functional_area', '=', 'functional_areas.id')
							->get(['industries.name as industry', 'functional_areas.name as functional_area', 'roles.name as role']);

			return $roleDetail;
    	}else{
    		return null;
    	}
    	
    }

}
