<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use App\Induser;
use App\Corpuser;
use App\Follow;
use App\Postactivity;
use App\Notification;
use App\Connections;
use App\Groups_users;
use App\Postjob;

class UserServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		view()->composer('includes-update.header', function($view){
			
			$thanksCount = 0;
			$followCount = 0;
			if(Auth::user()->identifier == 1 || Auth::user()->identifier == 3){
				$user = Induser::where('id', '=', Auth::user()->induser_id)->first();
				$favourites = Postactivity::with('user')
									      ->where('fav_post', '=', 1)
									      ->where('user_id', '=', Auth::user()->id)
									      ->orderBy('id', 'desc')
								          ->get(['id', 'fav_post', 'fav_post_dtTime', 'user_id', 'post_id']);
				$thanksCount = Postactivity::with('user', 'post')
								      ->join('postjobs', 'postjobs.id', '=', 'postactivities.post_id')
									  ->where('postjobs.individual_id', '=', Auth::user()->induser_id)
									  ->where('postactivities.thanks', '=', 1)
								      ->orderBy('postactivities.id', 'desc')
								      ->sum('postactivities.thanks');
				$linksCount = Connections::where('user_id', '=', Auth::user()->induser_id)
								 ->where('status', '=', 1)
								 ->orWhere('connection_user_id', '=', Auth::user()->induser_id)
								 ->where('status', '=', 1)
								 ->count('id');
				$linkrequestCount = Connections::where('connection_user_id', '=', Auth::user()->induser_id)
									   ->where('status', '=', 0)
									   ->count('id');

				$groupCount = Groups_users::where('user_id', '=', Auth::user()->induser_id)
										  ->count('id');

				$postCount = Postjob::where('individual_id', '=', Auth::user()->induser_id)
									 ->count('id');

				$profilePer = 0;
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

			}else if(Auth::user()->identifier == 2 || Auth::user()->identifier == 3){
				$user = Corpuser::where('id', '=', Auth::user()->corpuser_id)->first();
				$followCount = Follow::where('corporate_id', '=', 1)
								->orWhere('individual_id', '=', 1)
								->count('id');
				$linksCount = "";
				$linkrequestCount = "";
				$groupCount ="";
				$postCount = Postjob::where('corporate_id', '=', Auth::user()->corpuser_id)
									 ->count('id');
				$favourites = Postactivity::with('user')
									      ->where('fav_post', '=', 1)
									      ->where('user_id', '=', Auth::user()->id)
									      ->orderBy('id', 'desc')
								          ->get(['id', 'fav_post', 'fav_post_dtTime', 'user_id', 'post_id']);
				$profilePer = 0;
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

			
			$view->with('session_user', $user)->with('favourites', $favourites)
											  ->with('thanksCount', $thanksCount)
											  ->with('followCount', $followCount)
											  ->with('profilePer', $profilePer)
											  ->with('linkrequest', $linkrequestCount)
											  ->with('linkCount', $linksCount)
											  ->with('groupCount', $groupCount)
											  ->with('postCount', $postCount);
		});

		view()->composer('includes-update.header', function($view){
			if(Auth::user()->identifier == 1 || Auth::user()->identifier == 2 || Auth::user()->identifier == 3){
				$applications = Postactivity::with('user', 'post')
											->join('postjobs', 'postjobs.id', '=', 'postactivities.post_id')
											->where('postjobs.individual_id', '=', Auth::user()->induser_id)
											->where('postactivities.apply', '=', 1)
											->orderBy('postactivities.id', 'desc')
											->take(5)
											->get(['postactivities.id', 'postjobs.unique_id', 'postactivities.apply', 'postactivities.apply_dtTime', 'postactivities.user_id', 'postactivities.post_id']);
				$thanks = Postactivity::with('user', 'post')
								      ->join('postjobs', 'postjobs.id', '=', 'postactivities.post_id')
									  ->where('postjobs.individual_id', '=', Auth::user()->induser_id)
									  ->where('postactivities.thanks', '=', 1)
								      ->orderBy('postactivities.id', 'desc')
								      ->take(5)
								      ->get();
				$favourites = Postactivity::with('user')
									      ->where('fav_post', '=', 1)
									      ->where('user_id', '=', Auth::user()->id)
									      ->orderBy('id', 'desc')
								          ->get(['id', 'fav_post', 'fav_post_dtTime', 'user_id', 'post_id']);
				$thanksCount = Postactivity::with('user', 'post')
								      ->join('postjobs', 'postjobs.id', '=', 'postactivities.post_id')
									  ->where('postjobs.individual_id', '=', Auth::user()->induser_id)
									  ->where('postactivities.thanks', '=', 1)
								      ->orderBy('postactivities.id', 'desc')
								      ->sum('postactivities.thanks');
				$applicationsCount = Postactivity::with('user', 'post')
											->join('postjobs', 'postjobs.id', '=', 'postactivities.post_id')
											->where('postjobs.individual_id', '=', Auth::user()->induser_id)
											->where('postactivities.apply', '=', 1)
											->orderBy('postactivities.id', 'desc')
											->sum('postactivities.apply');

				$notifications = Notification::with('fromUser', 'toUser')->where('to_user', '=', Auth::user()->id)
										     ->orderBy('id', 'desc')->take(5)->get();
				$notificationsCount = Notification::where('to_user', '=', Auth::user()->id)->where('view_status', '=', 0)->count();
			}
			$view->with('applications', $applications)
			  	 ->with('thanks', $thanks)
			  	 ->with('favourites', $favourites)
			  	 ->with('thanksCount', $thanksCount)
			  	 ->with('applicationsCount', $applicationsCount)
			  	 ->with('notifications', $notifications)
			  	 ->with('notificationsCount', $notificationsCount);	
		});
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
