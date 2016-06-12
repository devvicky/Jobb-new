<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Postjob;
use App\Http\Requests\CreatePostskillRequest;
use Auth;
use App\Induser;
use App\Skills;
use App\Corpuser;
use App\Postactivity;
use App\Connections;
use App\User;
use DB;
use App\FunctionalAreas;
use App\Industry;
use App\Education;
use App\Functional_area_role_mapping;

class ViewpageController extends Controller {
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
		$title = 'indview';
		$user = Induser::where('id', '=', Auth::user()->induser_id)->first();
		$users = User::findOrFail();
		$thanks = Postactivity::with('user', 'post')
						      ->join('postjobs', 'postjobs.id', '=', 'postactivities.post_id')
							  ->where('postjobs.individual_id', '=', Auth::user()->induser_id)
							  ->where('postactivities.thanks', '=', 1)
						      ->orderBy('postactivities.id', 'desc')
						      ->sum('postactivities.thanks');
		$posts = Postjob::where('individual_id', '=', Auth::user()->induser_id)->count('id');
		$linksCount = Connections::where('user_id', '=', Auth::user()->induser_id)
								->where('status', '=', 1)
								->orWhere('connection_user_id', '=', Auth::user()->induser_id)
								->where('status', '=', 1)
								->count('id');
		return view('pages.profile_indview', compact('user', 'thanks', 'posts', 'linksCount', 'title', 'users'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreatePostskillRequest $request)
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
		//
	}

	// Bellow for redirecting to another page from profile_indview page

	public function edit_view()
	{
		if(Auth::user()->identifier == 1){
			$title = 'indprofile_edit';
			$user = User::where('id', '=', Auth::user()->id)->with('induser')->first();
			$skills = Skills::lists('name', 'name');
			$thanks = Postactivity::with('user', 'post')
							      ->join('postjobs', 'postjobs.id', '=', 'postactivities.post_id')
								  ->where('postjobs.individual_id', '=', Auth::user()->induser_id)
								  ->where('postjobs.inactive', '=', 0)
								  ->where('postactivities.thanks', '=', 1)
							      ->orderBy('postactivities.id', 'desc')
							      ->sum('postactivities.thanks');
			$posts = Postjob::where('individual_id', '=', Auth::user()->induser_id)->count('id');
			$linksCount = Connections::where('user_id', '=', Auth::user()->induser_id)
								->where('status', '=', 1)
								->orWhere('connection_user_id', '=', Auth::user()->induser_id)
								->where('status', '=', 1)
								->count('id');
			$educationList = Education::orderBy('level')->orderBy('name')->where('name', '!=', '0')->get();
			$location = Induser::where('id', '=', Auth::user()->induser_id)->first(['prefered_location']);

			// $loc = explode(',', $location);
			$farearoleList = Functional_area_role_mapping::orderBy('id')->get();

			$acc_id = "";
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

			return view('pages.professional_page', compact('user', 'acc_id', 'title', 'skills', 'educationList', 'location', 'farearoleList', 'thanks', 'linksCount', 'posts', 'profilePer'));
		}else if(Auth::user()->identifier == 2){
			$title = 'corpprofile_edit';
			$user = User::where('id', '=', Auth::user()->id)->with('corpuser')->first();
			$skills = Skills::lists('name', 'name');
			$acc_id = "";
			return view('pages.firm_details', compact('user', 'title', 'skills', 'acc_id'));
		}
	}

}
