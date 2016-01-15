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
use App\Corpuser;
use App\Postactivity;
use App\Role;
use App\Industry;
use App\FunctionalAreas;
use App\User;
use App\Industry_functional_area_mappings;
use App\Industry_functional_area_role_mapping;

class AdminController extends Controller {

	// public function __construct()
	// {
	//     $this->beforeFilter(function() {
	//     	if(Auth::check()){
	//         	return redirect('/home');
	//         } else{
	//         	return redirect('login');
	//         }
	//     });
	// }

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
			$functionalAreas = FunctionalAreas::lists('name', 'id');
			$industry = Industry::lists('name','id');
			$indfunctionalMapping = Industry_functional_area_mappings::leftJoin('industries', 'industry_functional_area_mappings.industry', '=', 'industries.id')
																	 ->leftJoin('functional_areas', 'industry_functional_area_mappings.functional_area', '=', 'functional_areas.id')
																	 ->get([DB::raw('concat(industries.name, " - ", functional_areas.name) as name'), 'industry_functional_area_mappings.id as id'])
																	 ->lists('name', 'id');
			return view('pages.adminUpdate', compact('title', 'roles', 'functionalAreas', 'industry', 'indfunctionalMapping'));
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

}
