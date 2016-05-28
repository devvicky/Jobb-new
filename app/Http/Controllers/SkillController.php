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
use App\Functional_area_role_mapping;
use App\Education;
use ReCaptcha\ReCaptcha;
use Input;

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
		$farearoleList = Functional_area_role_mapping::orderBy('id')->get();
		$education = Education::orderBy('level')->orderBy('name')->get();
		return view('pages.postskill', compact('title', 'skills', 'farearoleList', 'education'));
	}


	public function captchaCheck()
    {

        $response = Input::get('g-recaptcha-response');
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $secret   = env('RE_CAP_SECRET');

        $recaptcha = new ReCaptcha($secret);
        $resp = $recaptcha->verify($response, $remoteip);
        if ($resp->isSuccess()) {
            return true;
        } else {
            return false;
        }

    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreatePostskillRequest $request)
	{

		if($this->captchaCheck() == false)
        {
            return redirect()->back()
                ->withErrors(['Wrong Captcha'])
                ->withInput();
        }
		        
		if(Auth::user()->identifier == 1)
			$request['individual_id'] = Auth::user()->induser_id;
		else
			$request['corporate_id'] = Auth::user()->corpuser_id;
		$request['post_type'] = 'skill';
		
		// $skillIds = explode(',', $request['linked_skill_id']);
		$request['linked_skill'] = implode(',', $request['linked_skill_id']);
        $request['city'] = implode(',', $request['prefered_location']);
        $pref_locations = $request['prefered_location'];
        $request['unique_id'] = "S".rand(111,999).rand(111,999);
        $temp = explode(', ', $request['role']);
		$request['functional_area'] = $temp[0];
		$request['role'] = $temp[1];
		$request['education'] = implode('-', $request['education']);
		$post = Postjob::create($request->all());

		// $post->skills()->attach($skillIds);
		foreach ($pref_locations as $loc) {
        	$tempArr = explode('-', $loc);
        	if(count($tempArr) == 3){
        		$post->preferredLocation()->attach( $loc, array('locality' => $tempArr[0], 'city' => $tempArr[1], 'state' => $tempArr[2]) );
        	}
        	if(count($tempArr) == 2){
        		$post->preferredLocation()->attach( $loc, array('locality' => 'none', 'city' => $tempArr[0], 'state' => $tempArr[1]) );
        	}
        }

		return redirect("/mypost");
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
		$title = 'skill';
		$skills = Skills::lists('name', 'name');
		$farearoleList = Functional_area_role_mapping::orderBy('id')->get();
		$education = Education::orderBy('level')->orderBy('name')->get();
		$postskill = Postjob::where('unique_id', '=', $id)
						      ->where('individual_id', '=', Auth::user()->induser_id)
						      ->first();
		return view('pages.postskill_edit', compact('title', 'skills', 'farearoleList', 'education', 'postskill'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$updatePost = Postjob::where('unique_id', '=', $id)
							 ->where('individual_id', '=', Auth::user()->induser_id)
							 ->first();
		if($updatePost != null){
			$updatePost->post_title = Input::get('post_title');
			$updatePost->job_detail = Input::get('job_detail');
			$updatePost->industry = Input::get('industry');
			$temp = explode('-', Input::get('role'));
			$updatePost->functional_area = $temp[0];
			$updatePost->role = $temp[1];
			$updatePost->time_for = Input::get('time_for');
			$updatePost->education = implode(',', Input::get('education'));
			$updatePost->linked_skill = implode(',', Input::get('linked_skill_id'));
			$updatePost->min_exp = Input::get('min_exp');
			$updatePost->min_sal = Input::get('min_sal');
			$updatePost->max_sal = Input::get('max_sal');
			$updatePost->city = implode(',', Input::get('prefered_location'));
			$pref_locations = Input::get('prefered_location');
			$updatePost->website_redirect_url = Input::get('website_redirect_url');
			$updatePost->resume_required = Input::get('resume_required');
			$updatePost->show_contact = Input::get('show_contact');
			$updatePost->save();

			$preferedLocation = PostPreferredLocation::where('post_id', '=', $updatePost->id)->get();
			foreach ($preferedLocation as $pl ) {
				$pl->delete();
			}
			
			foreach ($pref_locations as $loc) {
	        	$tempArr = explode('-', $loc);
	        	if(count($tempArr) == 3){
	        		$updatePost->preferredLocation()->attach( $loc, array('locality' => $tempArr[0], 'city' => $tempArr[1], 'state' => $tempArr[2]) );
	        	}
	        	if(count($tempArr) == 2){
	        		$updatePost->preferredLocation()->attach( $loc, array('locality' => 'none', 'city' => $tempArr[0], 'state' => $tempArr[1]) );
	        	}
	        }
			return redirect('/mypost/single/'.$id);
		}else{
			return redirect('/mypost');
		}
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
