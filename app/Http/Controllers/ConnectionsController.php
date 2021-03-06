<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\CreateConnectionsRequest;
use Illuminate\Support\Facades\Input;
use App\Induser;
use App\Corpuser;
use App\Connections;
use App\Follow;
use Auth;
use DB;
use App\User;
use App\Notification;
use App\Group;

class ConnectionsController extends Controller {

	public function __construct()
	{
	    $this->beforeFilter(function() {
	    	if(!Auth::check()){
	        	return redirect('login');
	        }
	    });
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$title = 'links';
		$user = Induser::with('user')->where('id', '=', Auth::user()->induser_id)->first();
		$linksCount = Connections::where('user_id', '=', Auth::user()->induser_id)
								 ->where('status', '=', 1)
								 ->orWhere('connection_user_id', '=', Auth::user()->induser_id)
								 ->where('status', '=', 1)
								 ->count('id');
		$linkrequestCount = Connections::where('connection_user_id', '=', Auth::user()->induser_id)
									   ->where('status', '=', 0)
									   ->count('id');	

		$followCount = Follow::Where('individual_id', '=', Auth::user()->induser_id)
								->count('id');

		$linkFollow = Corpuser::with('posts')
							  ->leftjoin('follows', 'corpusers.id', '=', 'follows.corporate_id')
							  ->where('follows.individual_id', '=', Auth::user()->induser_id)
							  ->get(['corpusers.id',
									  'corpusers.firm_name',
									   'corpusers.firm_type',
									   'corpusers.emp_count',
									   'corpusers.logo_status',
									   'corpusers.operating_since',
									   'corpusers.city', 
									   'follows.corporate_id',
									   'follows.individual_id']);
		$groups = Group::with('postsCount')->leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')
						->where('groups.rowStatus', '=', 0)					
						->where('groups.admin_id', '=', Auth::user()->induser_id)
						->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
						->where('groups.rowStatus', '=', 0)
						->groupBy('groups.id')
						->get(['groups.id', 'groups.group_name', 'groups.admin_id', 'groups.created_at']);
		return view('pages.connections', compact('title', 'user', 'linkFollow', 'linksCount', 'linkrequestCount', 'followCount', 'groups'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$connections = Connections::findOrFail($id);
		$connections->delete();
		return redirect('/links');
	}

	public function inviteFriend($id){
		$newLink = Connections::where('user_id', '=', Auth::user()->induser_id)
								  ->where('connection_user_id', '=', $id)
								  ->first();
			if($newLink == null){
				$connections = new Connections();
				$connections->user_id = Auth::user()->induser_id;
				$connections->connection_user_id = $id;
				$connections->save();

				// notification
				$to_user = User::where('induser_id', '=', $id)->pluck('id');
				if($to_user != null){
					$notification = new Notification();
					$notification->from_user = Auth::user()->id;
					$notification->to_user = $to_user;
					$notification->remark = 'has sent link request.';
					$notification->operation = 'link request';
					$notification->save();
				}
			}
		return redirect('/links');
	}

	public function searchConnections()
	{
		$keywords = Input::get('keywords');
		$users = Induser::with('user')
						->where('email', '=', $keywords)
						->where('id', '<>', Auth::user()->induser_id)
						->orWhere('fname', 'like', '%'.$keywords.'%')
						->where('id', '<>', Auth::user()->induser_id)
						->orWhere('lname', 'like', '%'.$keywords.'%')
						->where('id', '<>', Auth::user()->induser_id)
						->orWhere('working_at', 'like', '%'.$keywords.'%')
						->where('id', '<>', Auth::user()->induser_id)
					    ->get();

		$corps = DB::select('select cu.*,(select count(id) 
										from follows 
										where follows.corporate_id=cu.id) as followers from corpusers cu 
									where cu.firm_email_id = ? or 
										  cu.firm_name like ? or 
										  cu.firm_type like ? or 
										  cu.city like ?
										  ', [$keywords, '%'.$keywords.'%', '%'.$keywords.'%', '%'.$keywords.'%']);
		
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

		$follows = DB::select('select follows.corporate_id as id 
								from follows 
								where follows.individual_id=?', [Auth::user()->induser_id]);
		$follows = collect($follows);

		return view('pages.searchUsers', compact('users', 'links', 'corps', 'follows', 'linksApproval', 'linksPending'));
	}

	public function response($id)
	{
		if(Input::get('action') == 'accept'){
			Connections::where('id', '=', $id)->update(['status' => 1]);

			// notification
			$cuid = Connections::where('id', '=', $id)->pluck('user_id');
			$to_user = User::where('induser_id', '=', $cuid)->pluck('id');
			if($to_user != null){
				$notification = new Notification();
				$notification->from_user = Auth::user()->id;
				$notification->to_user = $to_user;
				$notification->remark = 'has accepted your link request.';
				$notification->operation = 'link response';
				$notification->save();
			}

		return redirect('/profile/ind/'.$cuid);

		}elseif(Input::get('action') == 'reject'){
			$cuid = Connections::where('id', '=', $id);
			$cuid->delete();

			return redirect('/links');
		}
		
	}

	public function responseLink($id)
	{
		if(Input::get('action') == 'accept'){
			Connections::where('id', '=', $id)->update(['status' => 1]);

			// notification
			$cuid = Connections::where('id', '=', $id)->pluck('user_id');
			$to_user = User::where('induser_id', '=', $cuid)->pluck('id');
			if($to_user != null){
				$notification = new Notification();
				$notification->from_user = Auth::user()->id;
				$notification->to_user = $to_user;
				$notification->remark = 'has accepted your link request.';
				$notification->operation = 'link response';
				$notification->save();
			}

		return redirect('/links')->withErrors([
				'errors' => 'Accepted',
			]);;

		}elseif(Input::get('action') == 'reject'){
			$connectionDelete = Connections::where('id', '=', $id);
			$connectionDelete->delete();

			return redirect('/links')->withErrors([
				'errors' => 'Rejected',
			]);;
		}
	}

	public function newLink($id)
	{
		try{
			$newLink = Connections::where('user_id', '=', Auth::user()->induser_id)
								  ->where('connection_user_id', '=', $id)
								  ->first();
			if($newLink == null){
				$connections = new Connections();
				$connections->user_id=Auth::user()->induser_id;
				$connections->connection_user_id=$id;
				$connections->save();

				// notification
				$to_user = User::where('induser_id', '=', $id)->pluck('id');
				if($to_user != null){
					$notification = new Notification();
					$notification->from_user = Auth::user()->id;
					$notification->to_user = $to_user;
					$notification->remark = 'has sent link request.';
					$notification->operation = 'link request';
					$notification->save();
				}
			}
			
			
		}catch (\Illuminate\Database\QueryException $e){
		    $errorCode = $e->errorInfo[1];
		    if($errorCode == 1062){
		        return redirect('/home');
		    }
		}
		return 'success';
	}

	public function removeLink($id){
		$connections = Connections::where('user_id', '=', $id)
							      ->where('connection_user_id', '=', Auth::user()->induser_id)
							      ->orWhere('user_id', '=', Auth::user()->induser_id)
							      ->where('connection_user_id', '=', $id)
							      ->first();
		$connections->delete();
		return 'success';
	}

	public function friendLink($utype, $id)
	{
		$title = 'friendLink';
		if($utype == 'ind'){
			$linkName = Induser::findOrFail($id);
			$linkFollow = Corpuser::leftjoin('follows', 'corpusers.id', '=', 'follows.corporate_id')
								->where('follows.individual_id', '=', $id)
								->get(['corpusers.id',
									   'corpusers.firm_name',
									   'corpusers.logo_status',
									   'corpusers.operating_since',
									   'corpusers.city', 
									   'follows.corporate_id',
									   'follows.individual_id']);
			$followCount = Follow::Where('individual_id', '=', $id)
									->count('id');						
			$connections = DB::select('select id,fname,lname,working_at,city,state,profile_pic from indusers
										where indusers.id in (
										select connections.user_id as id from connections
										where connections.connection_user_id=?
										 and connections.status=1 
										union 
										select connections.connection_user_id as id from connections
										where connections.user_id=?
										 and connections.status=1
									)', [$id, $id]);
			$linksCount = Connections::where('user_id', '=', $id)
									 ->where('status', '=', 1)
									 ->orWhere('connection_user_id', '=', $id)
									 ->where('status', '=', 1)
									 ->count('id');

			return view('pages.friendlink', compact('linkName', 'title', 'linkFollow', 'connections', 'linksCount', 'followCount', 'utype'));
		}elseif($utype == 'corp'){
			$followers = Corpuser::find($id)->followers;
			return view('pages.friendlink', compact('title', 'followers', 'utype'));	
		}
	}

	public function linkPageFollow($id){
		$linkfollow = Follow::where('corporate_id', '=', $id)
							->where('individual_id', '=', Auth::user()->induser_id)
							->first();
		if($linkfollow == null){
			$follow = new Follow();
			$follow->corporate_id = $id;
			$follow->individual_id = Auth::user()->induser_id;
			$follow->save();
		}
		return redirect('/links');
	}

	public function linkPageUnfollow($id){
		$follow = Follow::where('corporate_id', '=', $id)
						->where('individual_id', '=', Auth::user()->induser_id)
						->first();
		$follow->delete();
		return redirect('/links');
	}

	public function followers(){
		$title = 'followers';
		$followers = Corpuser::find(Auth::user()->corpuser_id)->followers;
		return view('pages.connections', compact('title', 'followers'));	
	}

}
