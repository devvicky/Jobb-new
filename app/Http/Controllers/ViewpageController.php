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
			$roles = DB::select(DB::raw('select id, name from roles'));
			$functionalAreas = FunctionalAreas::lists('name', 'id');
			$industry = Industry::lists('name','id');

			$educationList = Education::orderBy('level')->orderBy('name')->where('name', '!=', '0')->get();

			return view('pages.professional_page', compact('user', 'title', 'skills', 'roles', 'functionalAreas', 'industry', 'educationList'));
		}else if(Auth::user()->identifier == 2){
			$title = 'corpprofile_edit';
			$user = User::where('id', '=', Auth::user()->id)->with('corpuser')->first();
			$skills = Skills::lists('name', 'name');
			$roles = DB::select(DB::raw('select id, name from roles'));
			$functionalAreas = FunctionalAreas::lists('name', 'id');
			return view('pages.firm_details', compact('user', 'title', 'skills', 'roles', 'functionalAreas', 'industry'));
		}
	}

}
