<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Induser;
use App\Corpuser;
use App\Postjob;
use App\Postactivity;
use App\Connections;
use App\Follow;
use App\Skills;
use App\Filter;
use App\User;
use App\Corpsearchprofile;
use Auth;
use DB;
use Input;
use App\Group;
use App\ReportAbuse;
use App\Feedback;
use App\Notification;
use App\PostUserTagging;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PagesController extends Controller {

	public function index(){
		$title = 'Welcome';
		$jobPosts = Postjob::orderBy('id', 'desc')
						   ->with('indUser', 'corpUser');
		$skillPosts = Postjob::orderBy('id', 'desc')
						   ->with('indUser', 'corpUser');
		return view('pages.index', compact('title', 'jobPosts', 'skillPosts'));
	}

	public function about(){
		$name = "JobTip";
		return view('pages.about')->with('name', $name);
	}

	public function termcondition(){
		return view('pages.term&condition');
	}


	public function privacy_policy(){
			return view('pages.privacy_policy');
		}

	public function login(){
		if (Auth::check()) {
			return redirect("/home");
		}else{
			return view('pages.login');
		}
	}

	public function home(){
		if (Auth::check()) {
			$title = 'home';

			if(Auth::user()->identifier == 1){
				$sort_by =" ";
				$sort_by_skill = " ";
				$skills = Skills::lists('name', 'name');
				$jobPosts = Postjob::orderBy('id', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup', 'preferLocations')
								   ->where('post_type', '=', 'job')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->whereRaw('postjobs.id in (select  pm.id from postjobs pm where pm.id in (
													select p.id 
														from postjobs p
														LEFT JOIN post_group_taggings pgt on pgt.post_id = p.id
														left join groups_users gu on gu.group_id = pgt.group_id
														left join indusers ind on ind.id = gu.user_id 
														left join indusers indg on indg.id = pgt.tag_share_by
														where ind.id = '.Auth::user()->induser_id.'
														union
													select  p.id
														from postjobs p
														left join post_user_taggings put on put.post_id = p.id 
														left join indusers ind on ind.id = put.user_id
														left join indusers inds on inds.id = put.tag_share_by
														where ind.id = '.Auth::user()->induser_id.'					
												) union 
												select pm.id from postjobs pm where pm.id not in (
													select distinct pgt.post_id
														from post_group_taggings pgt
												union
													select distinct put.post_id
														from post_user_taggings put
												)) ')
								   ->paginate(5);
								   
				$skillPosts = Postjob::orderBy('id', 'desc')
									 ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup', 'preferLocations')
									 ->where('post_type', '=', 'skill')
									 ->where('individual_id', '!=', Auth::user()->induser_id)
									 ->whereRaw('postjobs.id in (select  pm.id from postjobs pm where pm.id in (
													select p.id 
														from postjobs p
														LEFT JOIN post_group_taggings pgt on pgt.post_id = p.id
														left join groups_users gu on gu.group_id = pgt.group_id
														left join indusers ind on ind.id = gu.user_id 
														left join indusers indg on indg.id = pgt.tag_share_by
														where ind.id = '.Auth::user()->induser_id.'
														union
													select  p.id
														from postjobs p
														left join post_user_taggings put on put.post_id = p.id 
														left join indusers ind on ind.id = put.user_id
														left join indusers inds on inds.id = put.tag_share_by
														where ind.id = '.Auth::user()->induser_id.'
												) union 
												select pm.id from postjobs pm where pm.id not in (
													select distinct pgt.post_id
														from post_group_taggings pgt
												union
													select distinct put.post_id
														from post_user_taggings put
												)) ')
								   ->paginate(5);

				$links = DB::select('select id from indusers
										where indusers.id in (
												select connections.user_id as id from connections
												where connections.connection_user_id=?
												 and connections.status=1
												union 
												select connections.connection_user_id as id from connections
												where connections.user_id=?
												 and connections.status=1
									)', [Auth::user()->induser_id, Auth::user()->induser_id]);
				$links = collect($links);

				$linksApproval = DB::select('select id from indusers
											where indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksApproval = collect($linksApproval);

				$linksPending = DB::select('select id from indusers
											where indusers.id in (
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksPending = collect($linksPending);

				if(Auth::user()->induser_id != null){
					$following = DB::select('select id from corpusers 
											 where corpusers.id in (
												select follows.corporate_id as id from follows
												where follows.individual_id=?
										)', [Auth::user()->induser_id]);
					$following = collect($following);
				}
				if(Auth::user()->corpuser_id != null){
					$following = DB::select('select id from indusers
											 where indusers.id in (
												select follows.individual_id as id from follows
												where follows.corporate_id=?
										)', [Auth::user()->corpuser_id]);
					$following = collect($following);
				}
				if(Auth::user()->identifier == 1){
					$userSkills = Induser::where('id', '=', Auth::user()->induser_id)->first(['linked_skill']);
					$userSkills = array_map('trim', explode(',', $userSkills->linked_skill));
					unset ($userSkills[count($userSkills)-1]); 
				}

				if(Auth::user()->identifier == 1){
					$share_links=Induser::whereRaw('indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=1
													union 
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=1
										)', [Auth::user()->induser_id, Auth::user()->induser_id])
									->get(['id','fname'])
									->lists('fname','id');

					$share_groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
								->where('groups.admin_id', '=', Auth::user()->induser_id)
								->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
								->groupBy('groups.id')
								->get(['groups.id as id', 'groups.group_name as name'])
								->lists('name', 'id');

				}
				return view('pages.home', compact('jobPosts', 'skillPosts', 'title', 'links', 'following', 'userSkills', 'skills', 'linksApproval', 'linksPending', 'share_links', 'share_groups', 'sort_by', 'sort_by_skill'));
				// return $skillPosts;
			} elseif(Auth::user()->identifier == 2){
				$sort_by = " ";
				$sort_by_skill = " ";
				$skills = Skills::lists('name', 'id');
				$jobPosts = Postjob::orderBy('id', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('post_type', '=', 'job')
								   ->where('post_expire', '=', '0')
								   ->paginate(5);
				$skillPosts = Postjob::orderBy('id', 'desc')
									 ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
									 ->where('post_type', '=', 'skill')
									 ->where('post_expire', '=', '0')
									 ->paginate(5);

				if(Auth::user()->corpuser_id != null){
					$following = DB::select('select id from indusers
											 where indusers.id in (
												select follows.individual_id as id from follows
												where follows.corporate_id=?
										)', [Auth::user()->corpuser_id]);
					$following = collect($following);
				}

				return view('pages.home_corporate', compact('jobPosts', 'skillPosts', 'title', 'following', 'skills', 'sort_by', 'sort_by_skill'));

			}elseif(Auth::user()->identifier == 3){
				$reportAbuseCount = ReportAbuse::count();
				$feedbackCount = Feedback::count();
				$expFeedCounts = DB::select(
									DB::raw('
										select 
											(select count(experience) from feedbacks f where f.experience = 5) as five, 
											(select count(experience) from feedbacks f where f.experience = 4) as four,
											(select count(experience) from feedbacks f where f.experience = 3) as three,
											(select count(experience) from feedbacks f where f.experience = 2) as two,
											(select count(experience) from feedbacks f where f.experience = 1) as one
										from dual;
									')
								);
				$useFeedCounts = DB::select(
									DB::raw('
										select 
											(select count(usability) from feedbacks f where f.usability = "Hard") as hard, 
											(select count(usability) from feedbacks f where f.usability = "Okay") as okay,
											(select count(usability) from feedbacks f where f.usability = "Easy") as easy
										from dual;
									')
								);

				return view('pages.dashboard', compact('title', 'reportAbuseCount', 'feedbackCount', 'expFeedCounts', 'useFeedCounts'));
			}
		}
		else{
			return redirect('login');
		}	
	}

	public function myPost(){
		if (Auth::check()) {
			$title = 'mypost';
			if(Auth::user()->identifier == 1){
				$posts = Postjob::with('induser', 'postActivity', 'postactivity.user', 'taggedUser', 'taggedGroup')
								->where('individual_id', '=', Auth::user()->induser_id)
								->orderBy('id', 'desc')->get();
				$myActivities = DB::select('(select pa.id,pa.user_id,pa.post_id,"Thanks" as identifier,pa.thanks as activity, pa.thanks_dtTime as time,pj.unique_id, pj.post_title, pj.post_compname
										from postactivities pa 
										join postjobs pj on pj.id = pa.post_id
										where pa.user_id=? and pa.thanks = 1)
										union
										(select pa.id,pa.user_id,pa.post_id,"Shared" as identifier,pa.share as share, pa.share_dtTime as time,pj.unique_id, pj.post_title, pj.post_compname
										from postactivities pa 
										join postjobs pj on pj.id = pa.post_id
										where pa.user_id=? and pa.share = 1)
										union
										(select pa.id,pa.user_id,pa.post_id,"Applied" as identifier,pa.apply as activity, pa.apply_dtTime as time,pj.unique_id,pj.post_title, pj.post_compname
										from postactivities pa 
										join postjobs pj on pj.id = pa.post_id
										where pa.user_id=? and pa.apply = 1)
										union
										(select pa.id,pa.user_id,pa.post_id,"Contacted" as identifier,pa.contact_view as activity,pa.contact_view_dtTime as time,pj.unique_id, pj.post_title, pj.post_compname
										from postactivities pa 
										join postjobs pj on pj.id = pa.post_id
										where pa.user_id=? and pa.contact_view = 1)
										order by time desc', [Auth::user()->id,Auth::user()->id,Auth::user()->id,Auth::user()->id]);
				$myActivities = collect($myActivities);
				if(Auth::user()->identifier == 1){
					$share_links=Induser::whereRaw('indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=1
													union 
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=1
										)', [Auth::user()->induser_id, Auth::user()->induser_id])
									->get(['id','fname'])
									->lists('fname','id');

					$share_groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
								->where('groups.admin_id', '=', Auth::user()->induser_id)
								->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
								->groupBy('groups.id')
								->get(['groups.id as id', 'groups.group_name as name'])
								->lists('name', 'id');

				}
				// return $myActivities;
			}else if(Auth::user()->identifier == 2){
				$posts = Postjob::with('corpuser')->where('corporate_id', '=', Auth::user()->corpuser_id)->orderBy('id', 'desc')->get();
			}
			return view('pages.mypost', compact('posts', 'title', 'myActivities', 'share_links', 'share_groups'));
		}else{
			return redirect('login');
		}	
		
	}

	public function fillItLater(){
		return redirect('login');
	}

  	public function notification($type, $utype, $id){
        $title = $type;
        if($utype == 'ind'){
	        if($type == 'notification'){
	            $notificationList = Notification::with('fromUser', 'toUser')->where('to_user', '=', Auth::user()->id)
										     ->orderBy('id', 'desc')->paginate(20);
			}elseif($type == 'thanks'){
	            $notificationList = Postactivity::with('user', 'post')
												->join('postjobs', 'postjobs.id', '=', 'postactivities.post_id')
												->where('postjobs.individual_id', '=', $id)
												->where('postactivities.thanks', '=', 1)
												->orderBy('postactivities.id', 'desc')
												->take(25)
												->get(['postactivities.id','postjobs.unique_id', 'postactivities.thanks', 'postactivities.thanks_dtTime', 'postactivities.user_id', 'postactivities.post_id']);
	        }
	    }elseif($utype == 'corp'){
	    	if($type == 'applications'){
	            $notificationList = Postactivity::with('user', 'post')
												->join('postjobs', 'postjobs.id', '=', 'postactivities.post_id')
												->where('postjobs.corporate_id', '=', $id)
												->where('postactivities.apply', '=', 1)
												->orderBy('postactivities.id', 'desc')
												->take(25)
												->get(['postactivities.id','postjobs.unique_id', 'postactivities.apply', 'postactivities.apply_dtTime', 'postactivities.user_id', 'postactivities.post_id']);
			}elseif($type == 'thanks'){
	            $notificationList = Postactivity::with('user', 'post')
												->join('postjobs', 'postjobs.id', '=', 'postactivities.post_id')
												->where('postjobs.corporate_id', '=', $id)
												->where('postactivities.thanks', '=', 1)
												->orderBy('postactivities.id', 'desc')
												->take(25)
												->get(['postactivities.id','postjobs.unique_id', 'postactivities.thanks', 'postactivities.thanks_dtTime', 'postactivities.user_id', 'postactivities.post_id']);
	        }
	    }
        return view('pages.notifications', compact('notificationList', 'title'));
    }

	public function notify(){
		$title = 'notification';
		$user = Induser::where('id', '=', Auth::user()->induser_id)->first();		
		$thanks = Postactivity::with('user', 'post')
						      ->join('postjobs', 'postjobs.id', '=', 'postactivities.post_id')
							  ->where('postjobs.individual_id', '=', Auth::user()->induser_id)
							  ->where('postactivities.thanks', '=', 1)
						      ->orderBy('postactivities.id', 'desc')
						      ->take(25)
						      ->get(['postactivities.id','postjobs.unique_id', 'postactivities.thanks', 'postactivities.thanks_dtTime', 'postactivities.user_id', 'postactivities.post_id']);
		return view('pages.notification_view', compact('user', 'thanks', 'title'));
	}
	
	public function profile($utype,$id)
	{		
		$title = 'profile';
		if($utype == 'ind'){
			$user = Induser::findOrFail($id);
			$users = User::findOrFail($id);
			$thanks = Postactivity::with('user', 'post')
							      ->join('postjobs', 'postjobs.id', '=', 'postactivities.post_id')
								  ->where('postjobs.individual_id', '=', $id)
								  ->where('postactivities.thanks', '=', 1)
							      ->orderBy('postactivities.id', 'desc')
							      ->sum('postactivities.thanks');
			$posts = Postjob::where('individual_id', '=', $id)->count('id');
			$linksCount = Connections::where('user_id', '=', $id)
								->where('status', '=', 1)
								->orWhere('connection_user_id', '=', $id)
								->where('status', '=', 1)
								->count('id');
			$connectionPendingStatus = Connections::where('user_id', '=', Auth::user()->induser_id)
												  ->where('connection_user_id', '=', $id)
												  ->first(['status']);
			$connectionRequestStatus = Connections::where('connection_user_id', '=', Auth::user()->induser_id)
												  ->where('user_id', '=', $id)
												  ->first(['status', 'id']);

			// connection status
			$connectionStatus = 'add';
			$connectionId = 'unknown';
			if($connectionPendingStatus != null && $connectionPendingStatus->status == 0){
				$connectionStatus = 'requestsent';
			}
			elseif($connectionPendingStatus != null && $connectionPendingStatus->status == 1){
				$connectionStatus = 'friend';
			}
			elseif($connectionRequestStatus != null && $connectionRequestStatus->status == 0){
				$connectionStatus = 'pendingrequest';
				$connectionId = $connectionRequestStatus->id;
			}
			elseif($connectionRequestStatus != null && $connectionRequestStatus->status == 1){
				$connectionStatus = 'friend';
			}

			$taggedPosts = $this->usersPost();
			$taggedGroupPosts = $this->usersGroupPost();
			
		}elseif($utype == 'corp'){
			$user = Corpuser::findOrFail($id);
			$thanks = Postactivity::with('user', 'post')
							      ->join('postjobs', 'postjobs.id', '=', 'postactivities.post_id')
								  ->where('postjobs.corporate_id', '=', $id)
								  ->where('postactivities.thanks', '=', 1)
							      ->orderBy('postactivities.id', 'desc')
							      ->sum('postactivities.thanks');
			$posts = Postjob::where('corporate_id', '=', $id)->count('id');
			$linksCount = Follow::where('corporate_id', '=', $id)->count('id');
			$followCount = Follow::where('corporate_id', '=', $id)
								->orWhere('individual_id', '=', $id)
								->count('id');
			$connectionStatus = 'unknown';
			$followStatus = Follow::where('individual_id', '=', Auth::user()->induser_id)->first();
			if($followStatus != null){
                $connectionStatus = 'following';
                $connectionId = $followStatus->id;
            }
		}	
		return view('pages.profile_indview', compact('users' ,'title','thanks','posts','linksCount','user','connectionStatus','utype','connectionId', 'followCount', 'linkSharePost', 'taggedPosts', 'taggedGroupPosts'));
		// return $connectionId;
	}

	public function follow($id){
		$follow = new Follow();
		$follow->corporate_id = $id;
		$follow->individual_id = Auth::user()->induser_id;
		$follow->save();
		return redirect('/home');
	}

	public function unfollow($id){
		$follow = Follow::where('corporate_id', '=', $id)
						->where('individual_id', '=', Auth::user()->induser_id)
						->first();
		$follow->delete();
		return redirect('/home');
	}

	public function followModal(){
		$puid = Input::get('puid');
		$linked = Input::get('linked');
		$utype = Input::get('utype');
		$status = 'unknown';

		if($linked == 'no'){
			$receivedLinkedStatus = Connections::where('user_id', '=', $puid)
											->Where('connection_user_id', '=', Auth::user()->induser_id)
											->first(['status']);

			if($receivedLinkedStatus!=null && $receivedLinkedStatus->status == 0){
				$status = 'received';
			}
			
			$sentLinkedStatus = Connections::where('user_id', '=', Auth::user()->induser_id)
											->Where('connection_user_id', '=', $puid)
											->first(['status']);

			if($sentLinkedStatus!=null && $sentLinkedStatus->status == 0){
				$status = 'sent';
			}
		}

		return view('pages.links_follow', compact('puid', 'linked', 'utype', 'status'));
	}

	public function homeFilter(){
		if (Auth::check()) {
			$title = 'home';
			$sort_by =" ";
			$sort_by_skill = " ";
			$skills = Skills::lists('name', 'id');
			$post_type = Input::get('post_type');
			if(Auth::user()->identifier == 1 && $post_type == 'job'){
				$filter= Filter::where('id', '=', Auth::user()->id)->where('post_type', '=', 'job')->first();
				if($filter != null){
					// $filter->city = Input::get('prefered_location');
					$filter->post_type = Input::get('post_type');
					$filter->from_user = Auth::user()->id;
					$filter->posted_by = Input::get('posted_by');
					$filter->job_title = Input::get('post_title');
					$filter->prof_category = Input::get('prof_category');
					$filter->experience = Input::get('experience');
					// $filter->time_for = Input::get('time_for');
					$filter->unique_id = Input::get('unique_id');
					$filter->role = Input::get('role');
					$filter->save();
				}elseif($filter == null){
					$filter = new Filter();
					$filter->from_user = Auth::user()->id;
					$filter->posted_by = Input::get('posted_by');
					$filter->post_type = Input::get('post_type');
					$filter->job_title = Input::get('post_title');
					// $filter->city = Input::get('city');
					$filter->prof_category = Input::get('prof_category');
					$filter->experience = Input::get('experience');
					// $filter->time_for = Input::get('time_for');
					$filter->unique_id = Input::get('unique_id');
					$filter->role = Input::get('role');
					$filter->save();
				}

			}elseif(Auth::user()->identifier == 2){
				$filter= Filter::where('id', '=', Auth::user()->id)->where('post_type', '=', 'job')->first();
				if($filter != null){
					$filter->city = Input::get('city');
					$filter->post_type = Input::get('post_type');
					$filter->from_user = Auth::user()->id;
					$filter->posted_by = Input::get('posted_by');
					$filter->job_title = Input::get('post_title');
					$filter->city = Input::get('city');
					$filter->prof_category = Input::get('prof_category');
					$filter->experience = Input::get('experience');
					$filter->time_for = Input::get('time_for');
					$filter->unique_id = Input::get('unique_id');
					$filter->role = Input::get('role');
					$filter->save();
				}elseif($filter == null){
					$filter = new Filter();
					$filter->from_user = Auth::user()->id;
					$filter->posted_by = Input::get('posted_by');
					$filter->post_type = Input::get('post_type');
					$filter->job_title = Input::get('post_title');
					$filter->city = Input::get('city');
					$filter->prof_category = Input::get('prof_category');
					$filter->experience = Input::get('experience');
					$filter->time_for = Input::get('time_for');
					$filter->unique_id = Input::get('unique_id');
					$filter->role = Input::get('role');
					$filter->save();
				}
			}
			$post_type = Input::get('post_type');
			$posted_by = Input::get('posted_by');
			$post_title = Input::get('post_title');
			$city = Input::get('prefered_location');

			$prof_category = Input::get('prof_category');
			$experience = Input::get('experience');
			$time_for = Input::get('time_for');
			$unique_id = Input::get('unique_id');
			$role = Input::get('role');
			if($post_type == 'job'){
			$jobPosts = Postjob::orderBy('postjobs.id', 'desc')
							   ->with('indUser', 'corpUser', 'postActivity', 'preferLocations')
							   ->leftjoin('post_preferred_locations', 'post_preferred_locations.post_id', '=', 'postjobs.id')
							   ->where('individual_id', '!=', Auth::user()->induser_id);

			if($role != null){
				$jobPosts->where('role', 'like', '%'.$role.'%');
			}
			if($unique_id != null){
				$jobPosts->where('unique_id', 'like', '%'.$unique_id.'%');
			}
			if($post_title != null){
				$jobPosts->where('post_title', 'like', '%'.$post_title.'%');
			}
			if($city != null){
				$p_locality = [];
	    		$p_city = [];
				foreach ($city as $loc) {
		        	$tempArr = explode('-', $loc);
		        	if(count($tempArr) == 3){     		
		        		array_push($p_locality, $tempArr[0]) ;
		        		array_push($p_city, $tempArr[1]) ;
		        	}
		        	if(count($tempArr) == 2){
		        		array_push($p_city, $tempArr[0]) ;	        	
		        	}
		        }
				$jobPosts->whereIn('post_preferred_locations.city', $p_city);
				$jobPosts->whereIn('post_preferred_locations.locality', $p_locality);
			}

			if($prof_category != null){
				$jobPosts->where('prof_category', 'like', '%'.$prof_category.'%');
			}
			if($experience != null){
				$jobPosts->whereRaw("$experience between min_exp and max_exp");
			}
			if($time_for != null){
				$jobPosts->whereIn('time_for', $time_for);
				// return $time_for;
			}
			
			if($post_type == 'job'){
				$jobPosts->where('post_type', '=', $post_type);
			}
			

			$jobPosts = $jobPosts->paginate(15);
			if(Auth::user()->identifier == 1){
				$userSkills = Induser::where('id', '=', Auth::user()->induser_id)->first(['linked_skill']);
				$userSkills = array_map('trim', explode(',', $userSkills->linked_skill));
				unset ($userSkills[count($userSkills)-1]); 
			}
			$links = DB::select('select id from indusers
									where indusers.id in (
											select connections.user_id as id from connections
											where connections.connection_user_id=?
											 and connections.status=1
											union 
											select connections.connection_user_id as id from connections
											where connections.user_id=?
											 and connections.status=1
								)', [Auth::user()->induser_id, Auth::user()->induser_id]);
			$links = collect($links);
			$linksApproval = DB::select('select id from indusers
											where indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksApproval = collect($linksApproval);

				$linksPending = DB::select('select id from indusers
											where indusers.id in (
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksPending = collect($linksPending);
			$groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
						->where('groups.admin_id', '=', Auth::user()->induser_id)
						->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
						->groupBy('groups.id')
						->get(['groups.id as id'])
						->lists('id');

			if(Auth::user()->induser_id != null){
				$following = DB::select('select id from corpusers 
										 where corpusers.id in (
											select follows.corporate_id as id from follows
											where follows.individual_id=?
									)', [Auth::user()->induser_id]);
				$following = collect($following);
			}
			if(Auth::user()->corpuser_id != null){
				$following = DB::select('select id from indusers
										 where indusers.id in (
											select follows.individual_id as id from follows
											where follows.corporate_id=?
									)', [Auth::user()->corpuser_id]);
				$following = collect($following);
			}

			if(Auth::user()->identifier == 1){
				$share_links=Induser::whereRaw('indusers.id in (
												select connections.user_id as id from connections
												where connections.connection_user_id=?
												 and connections.status=1
												union 
												select connections.connection_user_id as id from connections
												where connections.user_id=?
												 and connections.status=1
									)', [Auth::user()->induser_id, Auth::user()->induser_id])
								->get(['id','fname'])
								->lists('fname','id');

				$share_groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
							->where('groups.admin_id', '=', Auth::user()->induser_id)
							->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
							->groupBy('groups.id')
							->get(['groups.id as id', 'groups.group_name as name'])
							->lists('name', 'id');

			}
			$skillPosts = Postjob::orderBy('id', 'desc')
									 ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
									 ->where('post_type', '=', 'skill')
									 ->where('individual_id', '!=', Auth::user()->induser_id)
									 ->paginate(15);
			}
			// return $time_for;
			return view('pages.home', compact('jobPosts', 'skillPosts', 'linksApproval', 'linksPending', 'title', 'links', 'groups', 'following', 'userSkills', 'skills', 'share_links', 'share_groups', 'sort_by', 'sort_by_skill'));
		}else{
			return redirect('login');
		}	
	}

	
public function homeskillFilter(){
	if (Auth::check()) {
		$title = 'home';
		$sort_by =" ";
		$sort_by_skill = " ";
		$skills = Skills::lists('name', 'id');
		$post_type = Input::get('post_type');
		if(Auth::user()->identifier == 1 && $post_type == 'skill'){
			$filter= Filter::where('id', '=', Auth::user()->id)
							->where('post_type', '=', 'skill')
							->first();
			if($filter != null){
				$filter->city = Input::get('city');
				$filter->post_type = Input::get('post_type');
				$filter->from_user = Auth::user()->id;
				$filter->posted_by = Input::get('posted_by');
				$filter->job_title = Input::get('post_title');
				$filter->city = Input::get('city');
				$filter->prof_category = Input::get('prof_category');
				$filter->experience = Input::get('experience');
				$filter->time_for = Input::get('time_for');
				$filter->unique_id = Input::get('unique_id');
				$filter->role = Input::get('role');
				$filter->save();
			}elseif($filter == null){
				$filter = new Filter();
				$filter->from_user = Auth::user()->id;
				$filter->posted_by = Input::get('posted_by');
				$filter->post_type = Input::get('post_type');
				$filter->job_title = Input::get('post_title');
				$filter->city = Input::get('city');
				$filter->prof_category = Input::get('prof_category');
				$filter->experience = Input::get('experience');
				$filter->time_for = Input::get('time_for');
				$filter->unique_id = Input::get('unique_id');
				$filter->role = Input::get('role');
				$filter->save();
			}
		}elseif(Auth::user()->identifier == 2){
			$filter = Filter::where('id', '=', Auth::user()->corpuser_id)->where('post_type', '=', 'skill')->first();	
			if($filter != null){
				$filter->city = Input::get('city');
				$post_type = Input::get('post_type');
				$filter->from_user = Auth::user()->id;
				$filter->posted_by = Input::get('posted_by');
				$filter->job_title = Input::get('post_title');
				$filter->city = Input::get('city');
				$filter->prof_category = Input::get('prof_category');
				$filter->experience = Input::get('experience');
				$filter->time_for = Input::get('time_for');
				$filter->unique_id = Input::get('unique_id');
				$filter->role = Input::get('role');
				$filter->save();
			}elseif($filter == null){
				$filter = new Filter();
				$filter->from_user = Auth::user()->id;
				$filter->posted_by = Input::get('posted_by');
				$filter->job_title = Input::get('post_title');
				$filter->city = Input::get('city');
				$filter->prof_category = Input::get('prof_category');
				$filter->experience = Input::get('experience');
				$filter->time_for = Input::get('time_for');
				$filter->unique_id = Input::get('unique_id');
				$filter->role = Input::get('role');
				$filter->save();
			}
		}

		$post_type = Input::get('post_type');
		$posted_by = Input::get('posted_by');
		$post_title = Input::get('post_title');
		$city = Input::get('city');
		$prof_category = Input::get('prof_category');
		$experience = Input::get('experience');
		$time_for = Input::get('time_for');
		$unique_id = Input::get('unique_id');
		$role = Input::get('role');

		if($post_type == 'skill'){
			$skillPosts = Postjob::orderBy('id', 'desc')
								 ->with('indUser', 'corpUser', 'postActivity')
								 ->where('individual_id', '!=', Auth::user()->induser_id);

		if($role != null){
			$skillPosts->where('role', 'like', '%'.$role.'%');
		}
		if($unique_id != null){
			$skillPosts->where('unique_id', 'like', '%'.$unique_id.'%');
		}
		if($post_title != null){
			$skillPosts->where('post_title', 'like', '%'.$post_title.'%');
		}
		if($city != null){
			$pattern = '/\s*,\s*/';
			$replace = ',';
			$city = preg_replace($pattern, $replace, $city);
			$cityArray = explode(',', $city);
			$skillPosts->whereIn('city', $cityArray);
		}
		if($prof_category != null){
			$skillPosts->where('prof_category', 'like', '%'.$prof_category.'%');
		}
		if($experience != null){
			$skillPosts->whereRaw("$experience between min_exp and max_exp");
		}
		if($time_for != null){
			$skillPosts->where('time_for', '=', $time_for);
		}
		$skillPosts = $skillPosts->paginate(15);
		if(Auth::user()->identifier == 1){
			$userSkills = Induser::where('id', '=', Auth::user()->induser_id)->first(['linked_skill']);
			$userSkills = array_map('trim', explode(',', $userSkills->linked_skill));
			unset ($userSkills[count($userSkills)-1]); 
		}
		$links = DB::select('select id from indusers
									where indusers.id in (
											select connections.user_id as id from connections
											where connections.connection_user_id=?
											 and connections.status=1
											union 
											select connections.connection_user_id as id from connections
											where connections.user_id=?
											 and connections.status=1
								)', [Auth::user()->induser_id, Auth::user()->induser_id]);
		$links = collect($links);
		$linksApproval = DB::select('select id from indusers
										where indusers.id in (
												select connections.user_id as id from connections
												where connections.connection_user_id=?
												 and connections.status=0
										)', [Auth::user()->induser_id]);
			$linksApproval = collect($linksApproval);

			$linksPending = DB::select('select id from indusers
										where indusers.id in (
												select connections.connection_user_id as id from connections
												where connections.user_id=?
												 and connections.status=0
										)', [Auth::user()->induser_id]);
			$linksPending = collect($linksPending);
		$groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
					->where('groups.admin_id', '=', Auth::user()->induser_id)
					->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
					->groupBy('groups.id')
					->get(['groups.id as id'])
					->lists('id');
		if(Auth::user()->induser_id != null){
				$following = DB::select('select id from corpusers 
										 where corpusers.id in (
											select follows.corporate_id as id from follows
											where follows.individual_id=?
									)', [Auth::user()->induser_id]);
				$following = collect($following);
			}
		if(Auth::user()->corpuser_id != null){
				$following = DB::select('select id from indusers
										 where indusers.id in (
											select follows.individual_id as id from follows
											where follows.corporate_id=?
									)', [Auth::user()->corpuser_id]);
				$following = collect($following);
			}

		if(Auth::user()->identifier == 1){
			$share_links=Induser::whereRaw('indusers.id in (
											select connections.user_id as id from connections
											where connections.connection_user_id=?
											 and connections.status=1
											union 
											select connections.connection_user_id as id from connections
											where connections.user_id=?
											 and connections.status=1
								)', [Auth::user()->induser_id, Auth::user()->induser_id])
							->get(['id','fname'])
							->lists('fname','id');

			$share_groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
						->where('groups.admin_id', '=', Auth::user()->induser_id)
						->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
						->groupBy('groups.id')
						->get(['groups.id as id', 'groups.group_name as name'])
						->lists('name', 'id');

		}
		$jobPosts = Postjob::orderBy('id', 'desc')
									 ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
									 ->where('post_type', '=', 'job')
									 ->where('individual_id', '!=', Auth::user()->induser_id)
									 ->paginate(15);

	}
	
	return view('pages.home', compact('jobPosts', 'skillPosts', 'linksApproval', 'linksPending', 'title', 'links', 'groups', 'following', 'userSkills', 'skills', 'share_links', 'share_groups', 'sort_by_skill', 'sort_by'));
	}else{
		return redirect('login');
	}
}


	public function searchProfile(){
		if (Auth::check()) {
			$title = 'Profile search';
			
			$city = Input::get('city');
			$name = Input::get('fullname');
			$role = Input::get('role');
			$category = Input::get('category');
			$working_at = Input::get('working_at');
			$mobile = Input::get('mobile');
			$min_exp = Input::get('min_exp');
			$max_exp = Input::get('max_exp');
			$prefered_jobtype = Input::get('job_type');
			$resume = Input::get('resume');
			$skills = Input::get('linked_skill_id');

			$type = Input::get('type');

			if($type == 'people'){
				$users = Induser::with('user')->orderBy('id', 'desc');
				$corpsearchprofile = Corpsearchprofile::where('user_id', '=', Auth::user()->id)
													  ->where('save_contact', '=', 1)
													  ->get(['profile_id']);
				if($name != null){
					$users->where('fname', 'like', '%'.$name.'%')->orWhere('lname', 'like', '%'.$name.'%')->orWhere('email', '=', $name);
				}
				if($city != null){
					$pattern = '/\s*,\s*/';
					$replace = ',';
					$city = preg_replace($pattern, $replace, $city);
					$cityArray = explode(',', $city);
					$users->whereIn('city', $cityArray);
				}
				if($role != null){
					$users->where('role', 'like', '%'.$role.'%');
				}
				if($category != null){
					$users->where('prof_category', 'like', '%'.$category.'%');
				}
				if($working_at != null){
					$users->where('working_at', 'like', '%'.$working_at.'%');
				}
				if($mobile != null){
					$users->where('mobile', 'like', '%'.$mobile.'%');
				}
				if($min_exp != null && $max_exp != null){
					$users->where('experience', '=', $min_exp);
				}
				if($prefered_jobtype != null){
					$users->where('prefered_jobtype', '=', $prefered_jobtype);
				}
				if($resume != null){
					$users->whereNotNull('resume');
				}
				if($skills != null){
					$users->where('linked_skill', 'like', '%'.$skills.'%');
				}

				// if($skills != null){
				// 	$pattern = '/\s*,\s*/';
				// 	$replace = ',';
				// 	$skills = preg_replace($pattern, $replace, $skills);
				// 	$skillsArray = explode(',', $skills);
				// 	$users->whereIn('linked_skill', $skillsArray);
				// }

				

				$users = $users->paginate(15);

				$links = DB::select('select id from indusers
									where indusers.id in (
											select connections.user_id as id from connections
											where connections.connection_user_id=?
											 and connections.status=1
											union 
											select connections.connection_user_id as id from connections
											where connections.user_id=?
											 and connections.status=1
								)', [Auth::user()->induser_id, Auth::user()->induser_id]);
				$links = collect($links);
				return view('pages.profileSearch', compact('users', 'title', 'links', 'type', 'corpsearchprofile', 'perPeople', 'perpeopleSkill'));
			}elseif($type == 'company'){
				$users = Corpuser::with('user')->orderBy('id', 'desc');

				if($name != null){
					$users->where('firm_name', 'like', '%'.$name.'%')->orWhere('firm_email_id', '=', $name);
				}
				if($city != null){
					$pattern = '/\s*,\s*/';
					$replace = ',';
					$city = preg_replace($pattern, $replace, $city);
					$cityArray = explode(',', $city);
					$users->whereIn('city', $cityArray);
				}
				if($role != null){
					$users->where('role', 'like', '%'.$role.'%');
				}
				if($category != null){
					$users->where('prof_category', 'like', '%'.$category.'%');
				}
				if($mobile != null){
					$users->where('firm_phone', 'like', '%'.$mobile.'%');
				}
				$users = $users->paginate(15);

				$following = DB::select('select id from corpusers 
										 where corpusers.id in (
											select follows.corporate_id as id from follows
											where follows.individual_id=?
									)', [Auth::user()->induser_id]);
				$following = collect($following);
				$followCount = Follow::where('corporate_id', '=', Auth::user()->induser_id)
								->orWhere('individual_id', '=', Auth::user()->induser_id)
								->count('id');

				return view('pages.profileSearch', compact('users', 'title', 'following', 'type', 'followCount'));
			}
		
		}
	}

	public function viewContact(){		
		$post = Postjob::with('indUser', 'corpUser', 'postActivity')->where('id', '=', Input::get('post_id'))->first();
		return view('pages.viewcontact', compact('title','user'));
	}

	public function postDetail(){
		if (Auth::check()) {		
			$post = Postjob::with('indUser', 'corpUser', 'postActivity')->where('id', '=', Input::get('postid'))->first();
			
			return view('pages.mypost_details', compact('post'));
			// return $post;
		}else{
			return redirect('login');
		}	
	}

	public function post(){
		if (Auth::check()) {
			$post = Postjob::with('indUser', 'corpUser', 'postActivity')->where('id', '=', Input::get('post_id'))->first();

			$links = DB::select('select id from indusers
									where indusers.id in (
											select connections.user_id as id from connections
											where connections.connection_user_id=?
											 and connections.status=1
											union 
											select connections.connection_user_id as id from connections
											where connections.user_id=?
											 and connections.status=1
								)', [Auth::user()->induser_id, Auth::user()->induser_id]);
			$links = collect($links);

			if(Auth::user()->induser_id != null){
				$following = DB::select('select id from corpusers 
										 where corpusers.id in (
											select follows.corporate_id as id from follows
											where follows.individual_id=?
									)', [Auth::user()->induser_id]);
				$following = collect($following);
			}
			if(Auth::user()->corpuser_id != null){
				$following = DB::select('select id from indusers
										 where indusers.id in (
											select follows.individual_id as id from follows
											where follows.corporate_id=?
									)', [Auth::user()->corpuser_id]);
				$following = collect($following);
			}

			return view('pages.singlepost', compact('post', 'links', 'following'));
			// return $post;
		}else{
			return redirect('login');
		}	
	}

	public function matching()
	{
		$posts = Postjob::with('indUser', 'corpUser', 'postActivity')->where('id', '=', Auth::user()->induser_id)->first();
		return view('pages.matching_criteria',compact('posts'));
	}

	public function favourite(){
		if (Auth::check()) {
			$title = 'favourite';
			$skills = Skills::lists('name', 'id');

			
			$jobPosts = Postjob::orderBy('id', 'desc')							
							->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
							->where('post_type', '=', 'job')
							->where('individual_id', '!=', Auth::user()->induser_id)
							->whereRaw('id in (select post_id from postactivities where user_id = '.Auth::user()->id.' and fav_post = 1)')
							->paginate(15);
			
			$skillPosts = Postjob::orderBy('id', 'desc')							
							->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
							->where('post_type', '=', 'skill')
							->where('individual_id', '!=', Auth::user()->induser_id)
							->whereRaw('id in (select post_id from postactivities where user_id = '.Auth::user()->id.' and fav_post = 1)')
							->paginate(15);	
			

			$links = DB::select('select id from indusers
									where indusers.id in (
											select connections.user_id as id from connections
											where connections.connection_user_id=?
											 and connections.status=1
											union 
											select connections.connection_user_id as id from connections
											where connections.user_id=?
											 and connections.status=1
								)', [Auth::user()->induser_id, Auth::user()->induser_id]);
			$links = collect($links);
			$linksPending = DB::select('select id from indusers
											where indusers.id in (
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksPending = collect($linksPending);

			$linksApproval = DB::select('select id from indusers
											where indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksApproval = collect($linksApproval);

			$groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
						->where('groups.admin_id', '=', Auth::user()->induser_id)
						->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
						->groupBy('groups.id')
						->get(['groups.id as id'])
						->lists('id');

			if(Auth::user()->induser_id != null){
				$following = DB::select('select id from corpusers 
										 where corpusers.id in (
											select follows.corporate_id as id from follows
											where follows.individual_id=?
									)', [Auth::user()->induser_id]);
				$following = collect($following);
			}
			if(Auth::user()->corpuser_id != null){
				$following = DB::select('select id from indusers
										 where indusers.id in (
											select follows.individual_id as id from follows
											where follows.corporate_id=?
									)', [Auth::user()->corpuser_id]);
				$following = collect($following);
			}
			if(Auth::user()->identifier == 1){
				$userSkills = Induser::where('id', '=', Auth::user()->induser_id)->first(['linked_skill']);
				$userSkills = array_map('trim', explode(',', $userSkills->linked_skill));
				unset ($userSkills[count($userSkills)-1]); 
			}

			if(Auth::user()->identifier == 1){
				$share_links=Induser::whereRaw('indusers.id in (
												select connections.user_id as id from connections
												where connections.connection_user_id=?
												 and connections.status=1
												union 
												select connections.connection_user_id as id from connections
												where connections.user_id=?
												 and connections.status=1
									)', [Auth::user()->induser_id, Auth::user()->induser_id])
								->get(['id','fname'])
								->lists('fname','id');

				$share_groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
							->where('groups.admin_id', '=', Auth::user()->induser_id)
							->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
							->groupBy('groups.id')
							->get(['groups.id as id', 'groups.group_name as name'])
							->lists('name', 'id');

			}
			
			return view('pages.home', compact('jobPosts', 'skillPosts', 'linksPending', 'linksApproval', 'title', 'links', 'groups', 'following', 'userSkills', 'skills', 'share_links', 'share_groups'));
			// return $posts;
		}else{
			return redirect('login');
		}	
	}

	public function verifyPage(){
		return view('pages.verify');
	}

	public function verifyEmail($id){
		if($id != null){
			$user = User::where('email_vcode', '=', $id)->first(['id']);
		}
		if($user != null){
			// Induser::where('email_vcode', '=', $id)->update(['email_verify' => 1, 'email_vcode' => null]);
			User::where('id', '=', $user->id)
				->update(['email_verify' => 1, 'email_vcode' => null]);
			$msg = 'Email verified successfully. Now you can login with your registered email id.';

			return redirect('/login')
					->with('flash_message', $msg)
					->with('flash_type', 'alert-success');
		}else{
			$msg = 'Invalid attempt';
			return redirect('/login')
					->with('flash_message', $msg)
					->with('flash_type', 'alert-danger');
		}
	}

	public function verifyMobile(){
		if(Input::get('mobileOTP') != null){
			$user = User::where('mobile_otp', '=', Input::get('mobileOTP'))
					    ->orWhere('email_vcode', '=', Input::get('mobileOTP'))
					    ->first(['id']);
		}
		if($user != null && strlen(trim(Input::get('mobileOTP'))) == 4){
			// Induser::where('mobile_otp', '=', Input::get('mobileOTP'))->update(['mobile_verify' => 1, 'mobile_otp' => null]);
			User::where('id', '=', $user->id)
				->update(['mobile_verify' => 1, 'mobile_otp' => null, 'mobile_otp_attempt' => 0, 'mobile_otp_expiry' => null]);
			$msg = 'Mobile no. verified successfully. Now you can login with your mobile no.';

			return redirect('/login')
					->with('flash_message', $msg)
					->with('flash_type', 'alert-success');
		}else if($user != null && strlen(trim(Input::get('mobileOTP'))) == 5){
			// Induser::where('email_vcode', '=', Input::get('mobileOTP'))->update(['email_verify' => 1, 'email_vcode' => null]);
			User::where('id', '=', $user->id)
				->update(['email_verify' => 1, 'email_vcode' => null, 'email_vcode_expiry' => null]);
			$msg = 'Email verified successfully. Now you can login with your email.';

			return redirect('/login')
					->with('flash_message', $msg)
					->with('flash_type', 'alert-success');
		}else{
			if(strlen(trim(Input::get('mobileOTP'))) == 4){
				$msg = 'Invalid OTP';
			}else if(strlen(trim(Input::get('mobileOTP'))) == 5){
				$msg = 'Invalid Verification code';
			}else{
				$msg = 'Invalid OTP/Verification code';
			}			
			return redirect('/verify')
					->with('flash_message', $msg)
					->with('flash_type', 'alert-danger');
		}		
	}

	public function postByUser($utype, $id){
		if (Auth::check()) {
			$title = 'postByUser';
			$groups = array();
			if($utype == 'ind'){
				$postuser = Induser::find($id);
				$jobPosts = Postjob::orderBy('id', 'desc')->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
							->where('post_type', '=', 'job')
							->where('postjobs.individual_id', '=', $id)
							->where('individual_id', '!=', Auth::user()->induser_id)
							->paginate(15);
				$skillPosts = Postjob::orderBy('id', 'desc')->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
							->where('post_type', '=', 'skill')
							->where('postjobs.individual_id', '=', $id)
							->where('individual_id', '!=', Auth::user()->induser_id)
							->paginate(15);
				$links = DB::select('select id from indusers
									where indusers.id in (
											select connections.user_id as id from connections
											where connections.connection_user_id=?
											 and connections.status=1
											union 
											select connections.connection_user_id as id from connections
											where connections.user_id=?
											 and connections.status=1
								)', [Auth::user()->induser_id, Auth::user()->induser_id]);
				$links = collect($links);
				$linksPending = DB::select('select id from indusers
											where indusers.id in (
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksPending = collect($linksPending);

				$linksApproval = DB::select('select id from indusers
											where indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksApproval = collect($linksApproval);
				if(Auth::user()->identifier == 1){
				$share_links=Induser::whereRaw('indusers.id in (
												select connections.user_id as id from connections
												where connections.connection_user_id=?
												 and connections.status=1
												union 
												select connections.connection_user_id as id from connections
												where connections.user_id=?
												 and connections.status=1
									)', [Auth::user()->induser_id, Auth::user()->induser_id])
								->get(['id','fname'])
								->lists('fname','id');

				$share_groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
							->where('groups.admin_id', '=', Auth::user()->induser_id)
							->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
							->groupBy('groups.id')
							->get(['groups.id as id', 'groups.group_name as name'])
							->lists('name', 'id');

				}
				$groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
							->where('groups.admin_id', '=', Auth::user()->induser_id)
							->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
							->groupBy('groups.id')
							->get(['groups.id as id'])
							->lists('id');

			}elseif($utype == 'corp'){
				$postuser = Corpuser::find($id);
				$jobPosts = Postjob::orderBy('id', 'desc')->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
							->where('post_type', '=', 'job')
							->where('postjobs.individual_id', '=', $id)
							->where('individual_id', '!=', Auth::user()->induser_id)
							->paginate(15);
				$skillPosts = Postjob::orderBy('id', 'desc')->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
							->where('post_type', '=', 'skill')
							->where('postjobs.individual_id', '=', $id)
							->where('individual_id', '!=', Auth::user()->induser_id)
							->paginate(15);
			}
			
			$skills = Skills::lists('name', 'id');			

			if(Auth::user()->induser_id != null){
				$following = DB::select('select id from corpusers 
										 where corpusers.id in (
											select follows.corporate_id as id from follows
											where follows.individual_id=?
									)', [Auth::user()->induser_id]);
				$following = collect($following);
			}
			if(Auth::user()->corpuser_id != null){
				$following = DB::select('select id from indusers
										 where indusers.id in (
											select follows.individual_id as id from follows
											where follows.corporate_id=?
									)', [Auth::user()->corpuser_id]);
				$following = collect($following);
			}
			if(Auth::user()->identifier == 1){
				$userSkills = Induser::where('id', '=', Auth::user()->induser_id)->first(['linked_skill']);
				$userSkills = array_map('trim', explode(',', $userSkills->linked_skill));
				unset ($userSkills[count($userSkills)-1]); 
			}
			
			return view('pages.home', compact('jobPosts', 'share_links', 'share_groups', 'skillPosts', 'linksPending', 'linksApproval', 'title', 'links', 'groups', 'following', 'userSkills', 'skills', 'postuser'));
			// return $userSkills;
		}else{
			return redirect('login');
		}	
	}

	

	public function resendOTP(Request $request){
		// check resend atttempt n send new otp
		if($request->ajax()){
			$data = [];
			$mobile = $request->input('otp_mob');
			if($request->input('otp_mob') != null){
				$userForMobile = User::where('mobile', '=', $mobile)->first(['name', 'mobile_verify', 'mobile_otp', 'mobile_otp_expiry', 'mobile_otp_attempt']);
				if($userForMobile != null && $userForMobile->mobile_verify == 0){
	    			$mobile_otp_expiry = new \Carbon\Carbon($userForMobile->mobile_otp_expiry, 'Asia/Kolkata');
					$now = \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'));
					$difference = $now->diffInMinutes($mobile_otp_expiry);

					$data['now'] = $now;
					$data['mobile_otp_expiry'] = $mobile_otp_expiry;
					$data['diff'] = $difference;
					$data['success_status'] = true;
					if($difference < 15 && $userForMobile->mobile_otp_attempt < 3){
						// send old otp n increment the attempt
						$mobile_otp_attemptInc = $userForMobile->mobile_otp_attempt + 1;
						User::where('mobile', '=', $mobile)->update(['mobile_otp_attempt' => $mobile_otp_attemptInc]);

						$data['resend_status'] = 'otpsent';
						$data['mobile_verify'] = 0;
			    		$data['page'] = 'login';
			    		$data['message'] = 'OTP sent to your registered mobile number. '.$userForMobile->mobile_otp;
					}else if($difference >= 15 && $userForMobile->mobile_otp_attempt < 3){
						// regenerate otp, update otp, reset attempt n mobile_otp_expiry
						$otp = rand(1111,9999);
						$new_mobile_otp_expiry = \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'))->addMinutes(15);
						User::where('mobile', '=', $mobile)->update(['mobile_otp' => $otp,'mobile_otp_attempt' => 0, 'mobile_otp_expiry' => $new_mobile_otp_expiry]);
						Induser::where('mobile', '=', $mobile)->update(['mobile_otp' => $otp]);

						$data['resend_status'] = 'otpgeneratednsent';
						$data['mobile_verify'] = 0;
			    		$data['page'] = 'login';
			    		$data['message'] = 'OTP sent to your registered mobile number. '.$otp;
					}else if($userForMobile->mobile_otp_attempt == 3){
						if($difference >= 30){
							User::where('mobile', '=', $mobile)->update(['mobile_otp_attempt' => 0]);
						}
						$data['resend_status'] = 'maxlimit';
						$data['mobile_verify'] = 0;
			    		$data['page'] = 'login';
			    		$data['message'] = 'You have reached to maximum limit. Try after sometime.';
			    		$data['success_status'] = false;
					}
	    		}
			}
			return response()->json(['success'=>$data['success_status'],'data'=>$data]);
		}
	}

	public function search(){
		$title = 'Search';

		if (Session::has('search_query'))
        	$searchQuery = Session::get('search_query');
        
        if(Input::get('query') != null)
			$searchQuery = Input::get('query');

		Session::flash('search_query', $searchQuery);

		$links = DB::select('select id from indusers
										where indusers.id in (
												select connections.user_id as id from connections
												where connections.connection_user_id=?
												 and connections.status=1
												union 
												select connections.connection_user_id as id from connections
												where connections.user_id=?
												 and connections.status=1
									)', [Auth::user()->induser_id, Auth::user()->induser_id]);
				$links = collect($links);

		$linksApproval = DB::select('select id from indusers
									where indusers.id in (
											select connections.user_id as id from connections
											where connections.connection_user_id=?
											 and connections.status=0
									)', [Auth::user()->induser_id]);
		$linksApproval = collect($linksApproval);

		$linksPending = DB::select('select id from indusers
									where indusers.id in (
											select connections.connection_user_id as id from connections
											where connections.user_id=?
											 and connections.status=0
									)', [Auth::user()->induser_id]);
		$linksPending = collect($linksPending);

		if($searchQuery != null){
			$searchResultForInd = Induser::with('user')
										 ->where('fname', 'like', '%'.$searchQuery.'%')
										 ->orWhere('lname', 'like', '%'.$searchQuery.'%')
										 ->orWhere('email', '=', $searchQuery)
										 ->orWhere('mobile', '=', $searchQuery)
										 ->paginate(10);

			$searchResultForCorp = Corpuser::with('user')
										   ->where('firm_name', 'like', '%'.$searchQuery.'%')
										   ->orWhere('firm_email_id', '=', $searchQuery)
										   ->orWhere('firm_phone', '=', $searchQuery)
										   ->paginate(10);

			$searchResultForJob = Postjob::where('post_title', 'like', '%'.$searchQuery.'%')
										 ->where('post_type', '=', 'job')
										 ->orWhere('linked_skill', 'like', '%'.$searchQuery.'%')
									 	 ->paginate(10);

			$searchResultForSkill = Postjob::where('post_title', 'like', '%'.$searchQuery.'%')
									       ->where('post_type', '=', 'skill')
									 	   ->paginate(10);

			return view('pages.search', compact('title', 
												'searchQuery', 
												'searchResultForInd', 
												'searchResultForCorp',
												'searchResultForJob',
												'searchResultForSkill',
												'linksPending',
												'linksApproval',
												'links'
											   ));
		}
		
	}



	public function homeSorting($post_type, $sort_by){
		if (Auth::check()) {
			$title = 'home';

			if(Auth::user()->identifier == 1 || Auth::user()->identifier == 2){

				$skills = Skills::lists('name', 'id');
				$sort_by_skill = " ";
				if($sort_by == 'date' && $post_type == 'job'){
					$jobPosts = Postjob::orderBy('created_at', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('post_type', '=', 'job')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->paginate(15);
				}elseif($sort_by == 'magic-match' && $post_type == 'job'){
					$jobPosts = Postjob::orderBy('created_at', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('post_type', '=', 'job')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->get();								   

					$jobPosts = $jobPosts->sortBy(function($jobPost){ return -$jobPost->magic_match; });

					$perPage = 15;
					$pageStart = \Request::get('page', 1);
				    // Start displaying items from this number;
				    $offSet = ($pageStart * $perPage) - $perPage; 

				    // Get only the items you need using array_slice
				    $itemsForCurrentPage = $jobPosts->slice($offSet, $perPage)->all();
					$jobPosts = new LengthAwarePaginator($itemsForCurrentPage, count($jobPosts), $perPage, LengthAwarePaginator::resolveCurrentPage(), array('path' => LengthAwarePaginator::resolveCurrentPath()));

				}elseif($sort_by == 'individual' && $post_type == 'job'){
					$jobPosts = Postjob::orderByRaw(DB::raw('CASE WHEN postjobs.individual_id IS NULL THEN "corp" ELSE "ind" END DESC'))
								   ->orderBy('id', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('post_type', '=', 'job')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->paginate(15);
				}elseif($sort_by == 'corporate' && $post_type == 'job'){
					$jobPosts = Postjob::orderByRaw(DB::raw('CASE WHEN postjobs.corporate_id IS NULL THEN "ind" ELSE "corp" END ASC'))
								   ->orderBy('id', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('post_type', '=', 'job')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->paginate(15);
				}else{
					$jobPosts = Postjob::orderBy('created_at', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('post_type', '=', 'job')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->paginate(15);
				}
				
				$skillPosts = Postjob::orderBy('id', 'desc')
									 ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
									 ->where('post_type', '=', 'skill')
									 ->where('individual_id', '!=', Auth::user()->induser_id)
									 ->paginate(15);

				$links = DB::select('select id from indusers
										where indusers.id in (
												select connections.user_id as id from connections
												where connections.connection_user_id=?
												 and connections.status=1
												union 
												select connections.connection_user_id as id from connections
												where connections.user_id=?
												 and connections.status=1
									)', [Auth::user()->induser_id, Auth::user()->induser_id]);
				$links = collect($links);

				$linksApproval = DB::select('select id from indusers
											where indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksApproval = collect($linksApproval);

				$linksPending = DB::select('select id from indusers
											where indusers.id in (
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksPending = collect($linksPending);

				$groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
							->where('groups.admin_id', '=', Auth::user()->induser_id)
							->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
							->groupBy('groups.id')
							->get(['groups.id as id'])
							->lists('id');

				if(Auth::user()->induser_id != null){
					$following = DB::select('select id from corpusers 
											 where corpusers.id in (
												select follows.corporate_id as id from follows
												where follows.individual_id=?
										)', [Auth::user()->induser_id]);
					$following = collect($following);
				}
				if(Auth::user()->corpuser_id != null){
					$following = DB::select('select id from indusers
											 where indusers.id in (
												select follows.individual_id as id from follows
												where follows.corporate_id=?
										)', [Auth::user()->corpuser_id]);
					$following = collect($following);
				}
				if(Auth::user()->identifier == 1){
					$userSkills = Induser::where('id', '=', Auth::user()->induser_id)->first(['linked_skill']);
					$userSkills = array_map('trim', explode(',', $userSkills->linked_skill));
					unset ($userSkills[count($userSkills)-1]); 
				}

				if(Auth::user()->identifier == 1){
					$share_links=Induser::whereRaw('indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=1
													union 
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=1
										)', [Auth::user()->induser_id, Auth::user()->induser_id])
									->get(['id','fname'])
									->lists('fname','id');

					$share_groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
								->where('groups.admin_id', '=', Auth::user()->induser_id)
								->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
								->groupBy('groups.id')
								->get(['groups.id as id', 'groups.group_name as name'])
								->lists('name', 'id');

				}
				// return $jobPosts;
				return view('pages.home', compact('jobPosts', 'skillPosts', 'title', 'links', 'groups', 'following', 'userSkills', 'skills', 'linksApproval', 'linksPending', 'share_links', 'share_groups', 'sort_by', 'sort_by_skill'));
			} 
		}
		else{
			return redirect('login');
		}	
	}


	public function homeskillSorting($post_type, $sort_by_skill){
		if (Auth::check()) {
			$title = 'home';

			if(Auth::user()->identifier == 1 || Auth::user()->identifier == 2){

				$skills = Skills::lists('name', 'id');
				$sort_by = " ";
				if($sort_by_skill == 'date' && $post_type == 'skill'){
					$skillPosts = Postjob::orderBy('created_at', 'asc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('post_type', '=', 'skill')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->paginate(15);
				}elseif($sort_by_skill == 'individual' && $post_type == 'skill'){
					$skillPosts = Postjob::orderByRaw(DB::raw('CASE WHEN postjobs.individual_id IS NULL THEN "corp" ELSE "ind" END DESC'))
								   ->orderBy('id', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('post_type', '=', 'skill')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->paginate(15);
				}elseif($sort_by_skill == 'corporate' && $post_type == 'skill'){
					$skillPosts = Postjob::orderByRaw(DB::raw('CASE WHEN postjobs.corporate_id IS NULL THEN "ind" ELSE "corp" END ASC'))
								   ->orderBy('id', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('post_type', '=', 'skill')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->paginate(15);
				}else{
					$skillPosts = Postjob::orderBy('created_at', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('post_type', '=', 'skill')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->paginate(15);
				}
				
				$jobPosts = Postjob::orderBy('id', 'desc')
									 ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
									 ->where('post_type', '=', 'job')
									 ->where('individual_id', '!=', Auth::user()->induser_id)
									 ->paginate(15);

				$links = DB::select('select id from indusers
										where indusers.id in (
												select connections.user_id as id from connections
												where connections.connection_user_id=?
												 and connections.status=1
												union 
												select connections.connection_user_id as id from connections
												where connections.user_id=?
												 and connections.status=1
									)', [Auth::user()->induser_id, Auth::user()->induser_id]);
				$links = collect($links);

				$linksApproval = DB::select('select id from indusers
											where indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksApproval = collect($linksApproval);

				$linksPending = DB::select('select id from indusers
											where indusers.id in (
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksPending = collect($linksPending);

				$groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
							->where('groups.admin_id', '=', Auth::user()->induser_id)
							->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
							->groupBy('groups.id')
							->get(['groups.id as id'])
							->lists('id');

				if(Auth::user()->induser_id != null){
					$following = DB::select('select id from corpusers 
											 where corpusers.id in (
												select follows.corporate_id as id from follows
												where follows.individual_id=?
										)', [Auth::user()->induser_id]);
					$following = collect($following);
				}
				if(Auth::user()->corpuser_id != null){
					$following = DB::select('select id from indusers
											 where indusers.id in (
												select follows.individual_id as id from follows
												where follows.corporate_id=?
										)', [Auth::user()->corpuser_id]);
					$following = collect($following);
				}
				if(Auth::user()->identifier == 1){
					$userSkills = Induser::where('id', '=', Auth::user()->induser_id)->first(['linked_skill']);
					$userSkills = array_map('trim', explode(',', $userSkills->linked_skill));
					unset ($userSkills[count($userSkills)-1]); 
				}

				if(Auth::user()->identifier == 1){
					$share_links=Induser::whereRaw('indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=1
													union 
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=1
										)', [Auth::user()->induser_id, Auth::user()->induser_id])
									->get(['id','fname'])
									->lists('fname','id');

					$share_groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
								->where('groups.admin_id', '=', Auth::user()->induser_id)
								->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
								->groupBy('groups.id')
								->get(['groups.id as id', 'groups.group_name as name'])
								->lists('name', 'id');

				}
				// return $sort_by;
				return view('pages.home', compact('jobPosts', 'skillPosts', 'title', 'links', 'groups', 'following', 'userSkills', 'skills', 'linksApproval', 'linksPending', 'share_links', 'share_groups', 'sort_by', 'sort_by_skill'));
			} 
		}
		else{
			return redirect('login');
		}	
	}

	public function corpsearchProfile(){
		$title = 'search_profile';
		$user = Corpuser::where('id', '=', Auth::user()->corpuser_id)->first();
		$skills = Skills::lists('name', 'name');
		return view('pages.corpsearchProfile', compact('user', 'title', 'skills'));

	}

	public function favProfile(Request $request){
		$profileFav = Corpsearchprofile::where('profile_id', '=', $request['profileid'])
							->where('user_id', '=', Auth::user()->id)
							->first();

		if($profileFav == null){
			$profileFav = new Corpsearchprofile();
			$profileFav->user_id = Auth::user()->id;
			$profileFav->profile_id = $request['profileid'];
			$profileFav->save_contact = 1;
			$profileFav->savecontact_dtTime = new \DateTime();
			$profileFav->save();

			$profileUser = Induser::where('id', '=', $request['profileid'])->first(['id', 'mobile', 'email', 'resume']);
			
			$data = [];
			$data['profile_id'] = $profileUser->id;
			$data['mobile'] = $profileUser->mobile;
			$data['email'] = $profileUser->email;
			$data['resume'] = $profileUser->resume;
			$data['save_contact'] = $profileFav->save_contact;

			if(!empty($data) && $profileFav->id > 0 && $profileUser != null){
				return response()->json(['success'=>'success','data'=>$data]);
				// return $data;
			}else{
				return response()->json(['success'=>'fail','data'=>$data]);
				// return $profileFav;
			}
			
		}else if($profileFav != null && $profileFav->save_contact == null){
			$profileFav->save_contact = 1;
			$profileFav->savecontact_dtTime = new \DateTime();
			$profileFav->save_profile = 0;
			$profileFav->saveprofile_dtTime = new \DateTime();
			$profileFav->save();

			$profileUser = Induser::where('id', '=', $request['profileid'])->first(['id', 'mobile', 'email', 'resume']);
			
			$data = [];
			$data['profile_id'] = $profileUser->id;
			$data['mobile'] = $profileUser->mobile;
			$data['email'] = $profileUser->email;
			$data['resume'] = $profileUser->resume;
			$data['save_contact'] = $profileFav->save_contact;

			if(!empty($data) && $profileFav->id > 0 && $profileUser != null){
				return response()->json(['success'=>'success','data'=>$data]);
				// return $data;
			}else{
				return response()->json(['success'=>'fail','data'=>$data]);
				// return $profileFav;
			}
		}
	}

	public function listFavourite(){
		$title = 'favouriteprofile';
		$users =  Corpsearchprofile::leftjoin('indusers', 'indusers.id', '=', 'corpsearchprofiles.profile_id')
								   ->where('user_id', '=', Auth::user()->id)
								   ->where('save_contact', '=', 1)
								   ->get();
		$profileSave =  Corpsearchprofile::leftjoin('indusers', 'indusers.id', '=', 'corpsearchprofiles.profile_id')
								   ->where('user_id', '=', Auth::user()->id)
								   ->where('save_profile', '=', 1)
								   ->get();
		$profileFav = Corpsearchprofile::where('user_id', '=', Auth::user()->id)
									   ->where('save_contact', '=', 1)
									   ->get();
						
		return view('pages.shortlistprofile', compact('users', 'title', 'profileFav', 'profileSave'));
	}

	public function saveProfile(Request $request){
		$profileSave = Corpsearchprofile::where('profile_id', '=', $request['profileid'])
							->where('user_id', '=', Auth::user()->id)
							->first();
		if($profileSave == null){
			$profileSave = new Corpsearchprofile();
			$profileSave->user_id = Auth::user()->id;
			$profileSave->profile_id = $request['profileid'];
			$profileSave->save_profile = 1;
			$profileSave->saveprofile_dtTime = new \DateTime();
			$profileSave->save();

		}elseif($profileSave != null && $profileSave->save_profile == 0){
			$profileSave->save_profile = 1;
			$profileSave->saveprofile_dtTime = new \DateTime();
			$profileSave->save();

		}elseif($profileSave != null && $profileSave->save_profile == 1){
			$profileSave->save_profile = 0;
			$profileSave->saveprofile_dtTime = new \DateTime();
			$profileSave->save();
		}

		$profileUser = Induser::where('id', '=', $request['profileid'])->first(['id', 'mobile', 'email', 'resume']);
			
		$data = [];
		$data['profile_id'] = $profileUser->id;
		$data['mobile'] = $profileUser->mobile;
		$data['email'] = $profileUser->email;
		$data['resume'] = $profileUser->resume;
		$data['save_profile'] = $profileSave->save_profile;

		if(!empty($data) && $profileSave->id > 0 && $profileUser != null){
			return response()->json(['success'=>'success','data'=>$data]);
			// return $data;
		}else{
			return response()->json(['success'=>'fail','data'=>$data]);
			// return $profileFav;
		}

	}


	public function postInGroup($id){
		if (Auth::check()) {
			$title = 'postInGroup';
			$groups = array();
				$groupUser = Group::find($id);

				$jobPosts = Postjob::orderBy('id', 'desc')							
							->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
							->where('post_type', '=', 'job')
							// ->where('individual_id', '!=', Auth::user()->induser_id)
							->whereRaw('id in (select post_id from post_group_taggings where group_id ='.$id.')')
							->paginate(15);
				$skillPosts = Postjob::orderBy('id', 'desc')							
							->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
							->where('post_type', '=', 'skill')
							// ->where('individual_id', '!=', Auth::user()->induser_id)
							->whereRaw('id in (select post_id from post_group_taggings where group_id ='.$id.')')
							->paginate(15);

				$links = DB::select('select id from indusers
									where indusers.id in (
											select connections.user_id as id from connections
											where connections.connection_user_id=?
											 and connections.status=1
											union 
											select connections.connection_user_id as id from connections
											where connections.user_id=?
											 and connections.status=1
								)', [Auth::user()->induser_id, Auth::user()->induser_id]);
				$links = collect($links);
				$linksPending = DB::select('select id from indusers
											where indusers.id in (
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksPending = collect($linksPending);

				$linksApproval = DB::select('select id from indusers
											where indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksApproval = collect($linksApproval);
				if(Auth::user()->identifier == 1){
				$share_links=Induser::whereRaw('indusers.id in (
												select connections.user_id as id from connections
												where connections.connection_user_id=?
												 and connections.status=1
												union 
												select connections.connection_user_id as id from connections
												where connections.user_id=?
												 and connections.status=1
									)', [Auth::user()->induser_id, Auth::user()->induser_id])
								->get(['id','fname'])
								->lists('fname','id');

				$share_groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
							->where('groups.admin_id', '=', Auth::user()->induser_id)
							->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
							->groupBy('groups.id')
							->get(['groups.id as id', 'groups.group_name as name'])
							->lists('name', 'id');

				}
				$groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
							->where('groups.admin_id', '=', Auth::user()->induser_id)
							->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
							->groupBy('groups.id')
							->get(['groups.id as id'])
							->lists('id');
			
			$skills = Skills::lists('name', 'id');			

			if(Auth::user()->induser_id != null){
				$following = DB::select('select id from corpusers 
										 where corpusers.id in (
											select follows.corporate_id as id from follows
											where follows.individual_id=?
									)', [Auth::user()->induser_id]);
				$following = collect($following);
			}
			if(Auth::user()->identifier == 1){
				$userSkills = Induser::where('id', '=', Auth::user()->induser_id)->first(['linked_skill']);
				$userSkills = array_map('trim', explode(',', $userSkills->linked_skill));
				unset ($userSkills[count($userSkills)-1]); 
			}
			
			return view('pages.home', compact('jobPosts', 'share_links', 'share_groups', 'skillPosts', 'linksPending', 'linksApproval', 'title', 'links', 'groups', 'following', 'userSkills', 'skills', 'groupUser'));
			// return $userSkills;
		}else{
			return redirect('login');
		}	
	}


	public function publicPost($id){
		$post = Postjob::orderBy('id', 'desc')							
					->with('indUser', 'corpUser')
					->where('unique_id', '=', $id)
					->get();
		if($post != null){
			$post = $post->first();
		}
		return view('pages.pagesocialshare', compact('post'));
		// return $posts;	
	}

	public function magicMatch(){
		if (Auth::check()) {		
			$post = Postjob::with('induser', 'corpuser', 'postActivity', 'preferLocations')
						   ->where('id', '=', Input::get('postid'))
						   ->first();
			
			return view('partials.home.magicmatch', compact('post'));
			// return $post;
		}else{
			return redirect('login');
		}	
	}

	public function usersGroupPost(){
		$groupPosts = DB::select('select p.unique_id, p.id, p.post_title, p.linked_skill, p.post_compname, p.post_type, gu.user_id, pgt.group_id as poe, pgt.tag_share_by, indg.fname, pgt.mode, pgt.created_at
								from postjobs p
								LEFT JOIN post_group_taggings pgt on pgt.post_id = p.id
								left join groups_users gu on gu.group_id = pgt.group_id
								left join indusers ind on ind.id = gu.user_id 
								left join indusers indg on indg.id = pgt.tag_share_by
								where ind.id = ?', [Auth::user()->induser_id]);
		return $groupPosts;
	}

	public function usersPost(){
		$posts = DB::select('select p.unique_id, p.post_title, p.linked_skill, p.post_compname, p.post_type, put.post_id, ind.id, put.user_id as poe, put.tag_share_by, inds.fname, put.mode, put.created_at
							from postjobs p
							left join post_user_taggings put on put.post_id = p.id 
							left join indusers ind on ind.id = put.user_id
							left join indusers inds on inds.id = put.tag_share_by
							where ind.id = ?', [Auth::user()->induser_id]);
		return $posts;
	}


	public function myActivitySorting($sort_by){
		if (Auth::check()) {
			$title = 'home';

			if(Auth::user()->identifier == 1 || Auth::user()->identifier == 2){

				if($sort_by == 'date'){
					$posts = Postjob::orderBy('created_at', 'asc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->paginate(15);
				}elseif($sort_by == 'magic-match'){
					$posts = Postjob::orderBy('created_at', 'asc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->get();								   

					$posts = $jobPosts->sortBy(function($jobPost){ return -$jobPost->magic_match; });

					$perPage = 15;
					$pageStart = \Request::get('page', 1);
				    // Start displaying items from this number;
				    $offSet = ($pageStart * $perPage) - $perPage; 

				    // Get only the items you need using array_slice
				    $itemsForCurrentPage = $jobPosts->slice($offSet, $perPage)->all();
					$jobPosts = new LengthAwarePaginator($itemsForCurrentPage, count($jobPosts), $perPage, LengthAwarePaginator::resolveCurrentPage(), array('path' => LengthAwarePaginator::resolveCurrentPath()));

				}elseif($sort_by == 'individual' && $post_type == 'job'){
					$jobPosts = Postjob::orderByRaw(DB::raw('CASE WHEN postjobs.individual_id IS NULL THEN "corp" ELSE "ind" END DESC'))
								   ->orderBy('id', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('post_type', '=', 'job')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->paginate(15);
				}elseif($sort_by == 'corporate' && $post_type == 'job'){
					$jobPosts = Postjob::orderByRaw(DB::raw('CASE WHEN postjobs.corporate_id IS NULL THEN "ind" ELSE "corp" END ASC'))
								   ->orderBy('id', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('post_type', '=', 'job')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->paginate(15);
				}else{
					$jobPosts = Postjob::orderBy('created_at', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('post_type', '=', 'job')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->paginate(15);
				}
				
				$skillPosts = Postjob::orderBy('id', 'desc')
									 ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
									 ->where('post_type', '=', 'skill')
									 ->where('individual_id', '!=', Auth::user()->induser_id)
									 ->paginate(15);

				$links = DB::select('select id from indusers
										where indusers.id in (
												select connections.user_id as id from connections
												where connections.connection_user_id=?
												 and connections.status=1
												union 
												select connections.connection_user_id as id from connections
												where connections.user_id=?
												 and connections.status=1
									)', [Auth::user()->induser_id, Auth::user()->induser_id]);
				$links = collect($links);

				$linksApproval = DB::select('select id from indusers
											where indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksApproval = collect($linksApproval);

				$linksPending = DB::select('select id from indusers
											where indusers.id in (
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksPending = collect($linksPending);

				$groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
							->where('groups.admin_id', '=', Auth::user()->induser_id)
							->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
							->groupBy('groups.id')
							->get(['groups.id as id'])
							->lists('id');

				if(Auth::user()->induser_id != null){
					$following = DB::select('select id from corpusers 
											 where corpusers.id in (
												select follows.corporate_id as id from follows
												where follows.individual_id=?
										)', [Auth::user()->induser_id]);
					$following = collect($following);
				}
				if(Auth::user()->corpuser_id != null){
					$following = DB::select('select id from indusers
											 where indusers.id in (
												select follows.individual_id as id from follows
												where follows.corporate_id=?
										)', [Auth::user()->corpuser_id]);
					$following = collect($following);
				}
				if(Auth::user()->identifier == 1){
					$userSkills = Induser::where('id', '=', Auth::user()->induser_id)->first(['linked_skill']);
					$userSkills = array_map('trim', explode(',', $userSkills->linked_skill));
					unset ($userSkills[count($userSkills)-1]); 
				}

				if(Auth::user()->identifier == 1){
					$share_links=Induser::whereRaw('indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=1
													union 
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=1
										)', [Auth::user()->induser_id, Auth::user()->induser_id])
									->get(['id','fname'])
									->lists('fname','id');

					$share_groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
								->where('groups.admin_id', '=', Auth::user()->induser_id)
								->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
								->groupBy('groups.id')
								->get(['groups.id as id', 'groups.group_name as name'])
								->lists('name', 'id');

				}
				// return $jobPosts;
				return view('pages.home', compact('jobPosts', 'skillPosts', 'title', 'links', 'groups', 'following', 'userSkills', 'skills', 'linksApproval', 'linksPending', 'share_links', 'share_groups', 'sort_by', 'sort_by_skill'));
			} 
		}
		else{
			return redirect('login');
		}	
	}

	public function singleJobPost($id){
		if (Auth::check()) {
			$title = 'home';

			if(Auth::user()->identifier == 1){
				$sort_by =" ";
				$sort_by_skill = " ";
				$skills = Skills::lists('name', 'name');
				$post = Postjob::orderBy('id', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->where('unique_id', '=', $id)
								   ->get();
				if($post != null){
					$post = $post->first();
				}

				$links = DB::select('select id from indusers
										where indusers.id in (
												select connections.user_id as id from connections
												where connections.connection_user_id=?
												 and connections.status=1
												union 
												select connections.connection_user_id as id from connections
												where connections.user_id=?
												 and connections.status=1
									)', [Auth::user()->induser_id, Auth::user()->induser_id]);
				$links = collect($links);

				$linksApproval = DB::select('select id from indusers
											where indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksApproval = collect($linksApproval);

				$linksPending = DB::select('select id from indusers
											where indusers.id in (
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksPending = collect($linksPending);

				$groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
							->where('groups.admin_id', '=', Auth::user()->induser_id)
							->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
							->groupBy('groups.id')
							->get(['groups.id as id'])
							->lists('id');

				if(Auth::user()->induser_id != null){
					$following = DB::select('select id from corpusers 
											 where corpusers.id in (
												select follows.corporate_id as id from follows
												where follows.individual_id=?
										)', [Auth::user()->induser_id]);
					$following = collect($following);
				}
				if(Auth::user()->corpuser_id != null){
					$following = DB::select('select id from indusers
											 where indusers.id in (
												select follows.individual_id as id from follows
												where follows.corporate_id=?
										)', [Auth::user()->corpuser_id]);
					$following = collect($following);
				}
				if(Auth::user()->identifier == 1){
					$userSkills = Induser::where('id', '=', Auth::user()->induser_id)->first(['linked_skill']);
					$userSkills = array_map('trim', explode(',', $userSkills->linked_skill));
					unset ($userSkills[count($userSkills)-1]); 
				}

				if(Auth::user()->identifier == 1){
					$share_links=Induser::whereRaw('indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=1
													union 
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=1
										)', [Auth::user()->induser_id, Auth::user()->induser_id])
									->get(['id','fname'])
									->lists('fname','id');

					$share_groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
								->where('groups.admin_id', '=', Auth::user()->induser_id)
								->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
								->groupBy('groups.id')
								->get(['groups.id as id', 'groups.group_name as name'])
								->lists('name', 'id');

				}
				return view('pages.postDetails', compact('post', 'title', 'links', 'groups', 'following', 'userSkills', 'skills', 'linksApproval', 'linksPending', 'share_links', 'share_groups', 'sort_by', 'sort_by_skill'));
				// return $jobPosts;
			}
		}
		else{
			return redirect('login');
		}	
	}

	public function singleSkillPost($id){
		if (Auth::check()) {
			$title = 'home';

			if(Auth::user()->identifier == 1){
				$sort_by =" ";
				$sort_by_skill = " ";
				$skills = Skills::lists('name', 'name');
				$post = Postjob::orderBy('id', 'desc')
								   ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
								   ->where('individual_id', '!=', Auth::user()->induser_id)
								   ->where('unique_id', '=', $id)
								   ->get();
				if($post != null){
					$post = $post->first();
				}

				$links = DB::select('select id from indusers
										where indusers.id in (
												select connections.user_id as id from connections
												where connections.connection_user_id=?
												 and connections.status=1
												union 
												select connections.connection_user_id as id from connections
												where connections.user_id=?
												 and connections.status=1
									)', [Auth::user()->induser_id, Auth::user()->induser_id]);
				$links = collect($links);

				$linksApproval = DB::select('select id from indusers
											where indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksApproval = collect($linksApproval);

				$linksPending = DB::select('select id from indusers
											where indusers.id in (
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksPending = collect($linksPending);

				$groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
							->where('groups.admin_id', '=', Auth::user()->induser_id)
							->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
							->groupBy('groups.id')
							->get(['groups.id as id'])
							->lists('id');

				if(Auth::user()->induser_id != null){
					$following = DB::select('select id from corpusers 
											 where corpusers.id in (
												select follows.corporate_id as id from follows
												where follows.individual_id=?
										)', [Auth::user()->induser_id]);
					$following = collect($following);
				}
				if(Auth::user()->corpuser_id != null){
					$following = DB::select('select id from indusers
											 where indusers.id in (
												select follows.individual_id as id from follows
												where follows.corporate_id=?
										)', [Auth::user()->corpuser_id]);
					$following = collect($following);
				}
				if(Auth::user()->identifier == 1){
					$userSkills = Induser::where('id', '=', Auth::user()->induser_id)->first(['linked_skill']);
					$userSkills = array_map('trim', explode(',', $userSkills->linked_skill));
					unset ($userSkills[count($userSkills)-1]); 
				}

				if(Auth::user()->identifier == 1){
					$share_links=Induser::whereRaw('indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=1
													union 
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=1
										)', [Auth::user()->induser_id, Auth::user()->induser_id])
									->get(['id','fname'])
									->lists('fname','id');

					$share_groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
								->where('groups.admin_id', '=', Auth::user()->induser_id)
								->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
								->groupBy('groups.id')
								->get(['groups.id as id', 'groups.group_name as name'])
								->lists('name', 'id');

				}
				return view('pages.postDetails', compact('post', 'title', 'links', 'groups', 'following', 'userSkills', 'skills', 'linksApproval', 'linksPending', 'share_links', 'share_groups', 'sort_by', 'sort_by_skill'));
				// return $jobPosts;
			}
		}
		else{
			return redirect('login');
		}	
	}
}


