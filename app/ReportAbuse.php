<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportAbuse extends Model {

	public function user(){
		return $this->belongsTo('App\Induser', 'reported_by', 'id')
				    ->select('id', 'fname', 'lname', 'email', 'profile_pic', 'working_at', 'linked_skill', 'about_individual');
	}

	public function post(){
		return $this->belongsTo('App\Postjob', 'post_id', 'id')
		->select('id', 'post_title', 'individual_id', 'corporate_id', 'email_id', 'contact_person', 'reference_id', 'website_redirect_url', 'job_detail', 'linked_skill', 'role');
	}

	public function getActionAttribute(){
		$action = ReportAbuseAction::where('post', '=', $this->attributes['post_id'])->get();
		return $action;
	}

}
