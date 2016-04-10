<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	protected $appends = ['profile_status', 'profile_alerted'];

	public function indUser(){
		return $this->hasOne('App\Induser', 'id', 'induser_id');
	}

	public function corpUser(){
		return $this->hasOne('App\Corpuser', 'id', 'corpuser_id');
	}

	public function corpSearchProfile(){
		return $this->hasMany('App\Corpsearchprofile', 'user_id', 'id');
	}

	public function getProfileStatusAttribute(){
		$profilePer = 0;
		if(Auth::user()->identifier == 1){
			if(Auth::user()->induser->fname != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->lname != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->email != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->mobile != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->dob != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->city != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->fb_page != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->in_page != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->gender != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->about_individual != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->education != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->experience != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->working_status != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->working_at != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->role != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->linked_skill != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->resume != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->prefered_location != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->prefered_jobtype != null){
				$profilePer = $profilePer + 1;
			}
			if(Auth::user()->induser->profile_pic != null){
				$profilePer = $profilePer + 1;
			}

			$profilePer = round(($profilePer/20)*100) ;
		}

		if(Auth::user()->identifier == 2){
			if(Auth::user()->corpuser->firm_name != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->username != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->firm_type != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->emp_count != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->working_as != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->slogan != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->firm_email_id != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->logo_status != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->about_firm != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->firm_address != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->operating_since != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->linked_skill != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->website_url != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->firm_phone != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->industry != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->role != null){
					$profilePer = $profilePer + 1;
				}
				if(Auth::user()->corpuser->city != null){
					$profilePer = $profilePer + 1;
				}

				$profilePer = round(($profilePer/17)*100) ;
		}
		
		return $profilePer;
	}

	public function getProfileAlertedAttribute(){
		$result = 0;
		if(Auth::user()->identifier == 1){
			if(!starts_with(Auth::user()->profile_alert_dtTime, '0000')){
				$alerted = Auth::user()->profile_alert;
				$alertedAt = new \Carbon\Carbon(Auth::user()->profile_alert_dtTime, 'Asia/Kolkata');
				$now = \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'));
				$difference = $now->diffInDays($alertedAt);
				if($difference >= 1 && ($alerted == 0 || $alerted == 1) ){
					$result = 0;
				}elseif($difference == 0 && $alerted == 1){
					$result = 1;
				}
			}			
		}
		return $result;
	}

}
