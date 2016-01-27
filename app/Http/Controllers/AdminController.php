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
			
			return view('pages.adminUpdate', compact('title', 'roles', 'functionalAreas', 'industry', 'indfunctionalMapping', 'rolesShow', 'faShow', 'industryShow', 'industryfareaShow', 'industryfarearoleShow'));
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

	public function updateIndfunctionalRole(Request $request)
	{
		$fiUser = new Industry_functional_area_role_mapping();
		$fiUser->industry_functional_area = $request['Industry_functional_area_mappings'];
		$fiUser->role = $request['role'];
		$fiUser->save();
		return redirect("/dataUpdate");
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

	public function editIndustry($id)
	{
		$data = Industry::where('id', '=', $id)->first();
		if($data != null){
			$data->name = Input::get('industryname');
			$data->save();
			return redirect('/dataUpdate');
		}else{
			return 'some error occured.';
		}
	}

}
