<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Postjob;
use App\Http\Requests\CreatePostskillRequest;
use Auth;
use App\Skills;
use DB;
use App\FunctionalAreas;
use App\Industry;

class SkillController extends Controller {

	public function __construct()
	{
	    $this->beforeFilter(function() {
	    	// if(Auth::check()){
	     //    	if(Auth::user()->identifier != 1) return redirect('/home');
	     //    } else{
	     //    	return redirect('login');
	     //    }
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
		$title = 'skill';
		$skills = Skills::lists('name', 'name');
		$roles = DB::select(DB::raw('select id, name from roles'));
		$functionalAreas = FunctionalAreas::lists('name', 'id');
		$industry = Industry::lists('name','id');
		return view('pages.postskill', compact('title', 'skills', 'roles', 'functionalAreas', 'industry'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreatePostskillRequest $request)
	{
		if(Auth::user()->identifier == 1)
			$request['individual_id'] = Auth::user()->induser_id;
		else
			$request['corporate_id'] = Auth::user()->corpuser_id;
		$request['post_type'] = 'skill';
		
		// $skillIds = explode(',', $request['linked_skill_id']);
		$request['linked_skill'] = implode(',', $request['linked_skill_id']);
        $request['city'] = implode(',', $request['prefered_location']);
        $request['locality'] = implode(',', $request['preferred_locality']);
        $request['unique_id'] = "S".rand(111,999).rand(111,999);


		$post = Postjob::create($request->all());

		// $post->skills()->attach($skillIds);

		return redirect("/home");
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

}
