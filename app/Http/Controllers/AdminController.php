<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Postjob;
use App\Http\Requests\CreatePostskillRequest;
use Auth;
use App\Induser;
use App\Skills;
use DB;
use Input;
use App\Corpuser;
use App\Postactivity;
use App\Role;
use App\Industry;
use App\FunctionalAreas;
use App\User;
use App\Industry_functional_area_mappings;
use App\Industry_functional_area_role_mapping;
use App\Admin_control;
use App\Functional_area_role_mapping;
use App\Education;
use Mail;

class AdminController extends Controller {

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

		if(Auth::user()->identifier == 3){
			$title = 'dataUpdate';
			$roles = Role::lists('name', 'id');
			$rolesShow = Role::all();
			$functionalAreas = FunctionalAreas::lists('name', 'id');
			$faShow = FunctionalAreas::all();
			$industry = Industry::lists('name','id');
			$industryShow = Industry::all();
			$skills = Skills::lists('name', 'id');
			$indfunctionalMapping = Industry_functional_area_mappings::leftJoin('industries', 'industry_functional_area_mappings.industry', '=', 'industries.id')
																	 ->leftJoin('functional_areas', 'industry_functional_area_mappings.functional_area', '=', 'functional_areas.id')
																	 ->get([DB::raw('concat(industries.name, " - ", functional_areas.name) as name'), 'industry_functional_area_mappings.id as id'])
																	 ->lists('name', 'id');
			$industryfareaShow = Industry_functional_area_mappings::leftJoin('industries', 'industry_functional_area_mappings.industry', '=', 'industries.id')
																  ->leftJoin('functional_areas', 'industry_functional_area_mappings.functional_area', '=', 'functional_areas.id')
																  ->get(['industries.name as name', 'functional_areas.name as fareaname', 'industry_functional_area_mappings.id']);
			
			// $indfunctional = Industry_functional_area_mappings::leftJoin('industries', 'industry_functional_area_mappings.industry', '=', 'industries.id')
			// 														 ->leftJoin('functional_areas', 'industry_functional_area_mappings.functional_area', '=', 'functional_areas.id')
			// 														 ->get([DB::raw('concat(industries.name, " - ", functional_areas.name) as name'), 'industry_functional_area_mappings.id as id']);

			// $industryfarearoleShow = Industry_functional_area_role_mapping::leftJoin('roles', 'industry_functional_area_role_mapping.role', '=', 'roles.id')
			// 															  ->get(['roles.name as name', $indfunctional]);
			
			return view('pages.adminUpdate', compact('title', 'skills', 'roles', 'functionalAreas', 'industry', 'indfunctionalMapping', 'rolesShow', 'faShow', 'industryShow', 'industryfareaShow', 'industryfarearoleShow'));
			// return $indfunctionalMapping;
		}else{
			return redirect('/home');
		}
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

	public function updateRole(Request $request)
	{
		$rUser = new Role();
		$rUser->name = $request['name'];
		$rUser->save();
		return redirect("/dataUpdate");
	}

	public function updatefunctionalArea(Request $request)
	{
		$rUser = new FunctionalAreas();
		$rUser->name = $request['name'];
		$rUser->save();
		return redirect("/dataUpdate");
	}

	public function updateIndustry(Request $request)
	{
		$rUser = new Industry();
		$rUser->name = $request['name'];
		$rUser->save();
		return redirect("/dataUpdate");
	}

	public function updateIndustryfunctional(Request $request)
	{
		$fiUser = new Industry_functional_area_mappings();
		$fiUser->industry = $request['Industry'];
		$fiUser->functional_area = $request['FunctionalAreas'];
		$fiUser->save();
		return redirect("/dataUpdate");
	}

	public function updateIndfunctionalRole(Request $request){

		$fiUser = Industry_functional_area_mappings::findOrFail($request['Industry_functional_area_mappings']);
		$fiUser->ifrmapping()->attach($request['role']);
		// $fiUser->save();
		return redirect("/dataUpdate");
		// return $request['Industry_functional_area_mappings'];
	}

	public function addNewRoles(Request $request){
		if($request->ajax()){
			$role = Role::create(['name' => $request['name']]);
			return $role->id;
		}
	}

	public function roleSearch(){
		$term = Input::get('term');
		
		$results = array();
		
		$queries = DB::table('roles')
					 ->where('name', 'LIKE', '%'.$term.'%')
					 ->where('rowStatus', '=', 0)
					 ->take(5)->get();
		
		foreach ($queries as $query){
		    $results[] = [ 'id' => $query->id, 'value' => $query->name ];
		}
		return Response::json($results);
	}


	public function deleteRole(Request $request){
		$delete_role = Role::findOrFail($request['role']);
		if($delete_role != null){
			$delete_role->delete();
		}
		return redirect('/dataUpdate');
	}

	public function deletefunctionalArea(Request $request){
		$delete_fa = FunctionalAreas::findOrFail($request['f_area']);
		if($delete_fa != null){
			$delete_fa->delete();
		}
		return redirect('/dataUpdate');
	}

	public function deleteIndustry(Request $request){
		$delete_industry = Industry::findOrFail($request['industry']);
		if($delete_industry != null){
			$delete_industry->delete();
		}
		return redirect('/dataUpdate');
	}

	public function deleteindustryfareaMapping(Request $request){
		$delete_ifmapping = Industry_functional_area_mappings::findOrFail($request['ifareamapping']);
		if($delete_ifmapping != null){
			$delete_ifmapping->delete();
		}
		return redirect('/dataUpdate');
	}




	public function editRole($id)
	{
		$data = Role::where('id', '=', $id)->first();
		if($data != null){
			$data->name = Input::get('rolename');
			$data->save();
			return redirect('/dataUpdate');
		}else{
			return 'some error occured.';
		}
	}

	public function editFarea($id)
	{
		$data = FunctionalAreas::where('id', '=', $id)->first();
		if($data != null){
			$data->name = Input::get('fareaname');
			$data->save();
			return redirect('/dataUpdate');
		}else{
			return 'some error occured.';
		}
	}

	public function editIndustry($id){
		$data = Industry::where('id', '=', $id)->first();
		if($data != null){
			$data->name = Input::get('industryname');
			$data->save();
			return redirect('/dataUpdate');
		}else{
			return 'some error occured.';
		}
	}

	public function controlUser(){
		$title = 'controluser';
		$controlCorp = Corpuser::with('user')
							   ->get(['id', 'firm_name', 'firm_type', 'firm_email_id']);
		$controlInd = Induser::with('user')
							   ->get(['id', 'fname', 'lname', 'email']);
		return view('pages.control_users', compact('title', 'controlCorp', 'controlInd'));
		// return $controlInd;
	}

	public function adminControlUpdate(){
		$controlCorp = Corpuser::with('user')
							   ->get(['id', 'firm_name', 'firm_type', 'firm_email_id']);
		$controlInd = Induser::with('user')
							   ->get(['id', 'fname', 'lname', 'email']);
		$controlUpdate= Admin_control::where('user_id', '=', Auth::user()->id)->first();
		if($controlUpdate != null){
			$controlUpdate->profile_id = Input::get('profile_id');
			$controlUpdate->subscribe = Input::get('subscribe');
			$controlUpdate->contact_view = Input::get('contact_view');
			$controlUpdate->resume_view = Input::get('view_resume');
			$controlUpdate->post_job = Input::get('post_job');
			$controlUpdate->save();
		}elseif($controlUpdate == null){
			$controlUpdate= new Admin_control();
			$controlUpdate->profile_id = Input::get('profile_id');
			$controlUpdate->subscribe = Input::get('subscribe');
			$controlUpdate->contact_view = Input::get('contact_view');
			$controlUpdate->resume_view = Input::get('view_resume');
			$controlUpdate->post_job = Input::get('post_job');
			$controlUpdate->save();
		}

		return view('pages.control_users', compact('controlUpdate', 'controlCorp', 'controlInd'));
	}

	public function createUser(){
		$skills = Skills::lists('name', 'name');
		$educationList = Education::orderBy('level')->orderBy('name')->where('name', '!=', '0')->get();
		$farearoleList = Functional_area_role_mapping::orderBy('id')->get();
		return view('pages.create_users', compact('skills', 'educationList', 'farearoleList'));
	}

	public function createUserRequest(Request $request){

		$skills = Skills::lists('name', 'name');
		$educationList = Education::orderBy('level')->orderBy('name')->where('name', '!=', '0')->get();
		$farearoleList = Functional_area_role_mapping::orderBy('id')->get();

		$indUser = new Induser();
		$indUser->fname = $request['fname'];
		$indUser->lname = $request['lname'];
		$indUser->gender = $request['gender'];
		$indUser->city = $request['city'];
		$indUser->about_individual = $request['about_individual'];
		$indUser->education = $request['education'];
		$indUser->experience = $request['experience'];
		$indUser->working_status = $request['working_status'];
		$indUser->working_at = $request['working_at'];
		$indUser->industry = $request['industry'];
		if($request['role'] != null){
				$farea_role = $request['role'];
				$temp = explode('-', $farea_role);
				$indUser->functional_area = $temp[0];
				$indUser->role = $temp[1];
			}
		if($request['linked_skill_id'] != null){
				$indUser->linked_skill = implode(', ', $request['linked_skill_id']);
			}
			if($request['prefered_location'] != null){
				$indUser->prefered_location = implode(', ', $request['prefered_location']);
			}
		$indUser->email = $request['email'];
		$indUser->mobile = $request['mobile'];
		$indUser->prefered_jobtype = $request['prefered_jobtype'];
		$indUser->save();

		$user = new User();
		$user->name = $request['fname'].' '.$request['lname'];
		$user->email = $request['email'];
		$user->mobile = $request['mobile'];
		$user->password = md5(rand(111111,999999));
		$user->identifier = 1;

		if($request['email'] != null){
			$vcode = 'A'.rand(1111,9999);
			$user->email_vcode = $vcode;
		}
		if($request['mobile'] != null){
			$otp = rand(1111,9999);
			$user->mobile_otp = $otp;
		}

		$resetCode = md5(rand(11111,99999));
		$user->reset_code = $resetCode;
		$indUser->user()->save($user);
		$email = $request['email'];
		if($request['email'] != null){
			$email = $request['email'];
			$fname = $request['fname'];
			Mail::send('emails.auth.resetpassword', array('fname'=>$fname, 'token'=>$resetCode), function($message) use ($email,$fname){
			        $message->to($email, $fname)->subject('Jobtip - Profile Created!')->from('admin@jobtip.in', 'JobTip');
			    });
		}
		
		return view('pages.create_users', compact('skills', 'educationList', 'farearoleList'))->withErrors([
						'errors' => 'Profile Created Successfully.',
					]);
	}

}
