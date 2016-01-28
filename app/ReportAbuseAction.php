<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportAbuseAction extends Model {

	public function abuse(){
		return $this->belongsTo('App\ReportAbuse', 'id', 'action_taken');
	}

}
