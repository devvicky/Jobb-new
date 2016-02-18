<?php namespace App\Http\Controllers;
use Input;
use App\Postjob;
use App\Contact_us;
use App\Http\Requests;
use Illuminate\Http\Request;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$title = 'Welcome';
		return view('welcome', compact('title'));
	}

	public function welcomeSearch(){
		$title = 'welcome';

		$role = Input::get('role');
		$experience = Input::get('experience');
		$city = Input::get('location');
		$jobPosts = Postjob::orderBy('postjobs.id', 'desc')
						   ->with('indUser', 'corpUser');
		$skillPosts = Postjob::orderBy('postjobs.id', 'desc')
						   ->with('indUser', 'corpUser');
		if($role != null){
			$jobPosts->leftJoin('industry_functional_area_role_mappings', 'industry_functional_area_role_mappings.id', '=', 'postjobs.role')
					 ->leftJoin('roles', 'roles.id', '=', 'industry_functional_area_role_mappings.role')
					 ->where('roles.name', 'like', '%'.$role.'%')
					 ->where('postjobs.post_type', '=', 'job')
					 ->orWhere('postjobs.post_title', 'like', '%'.$role.'%');
			$skillPosts->leftJoin('industry_functional_area_role_mappings', 'industry_functional_area_role_mappings.id', '=', 'postjobs.role')
					   ->leftJoin('roles', 'roles.id', '=', 'industry_functional_area_role_mappings.role')
					   ->where('roles.name', 'like', '%'.$role.'%')
					   ->where('postjobs.post_type', '=', 'skill')
					   ->orWhere('postjobs.post_title', 'like', '%'.$role.'%');;
		}
		if($city != null){
			$pattern = '/\s*,\s*/';
			$replace = ',';
			$city = preg_replace($pattern, $replace, $city);
			$cityArray = explode(',', $city);
			$jobPosts->whereIn('city', $cityArray);
			$skillPosts->whereIn('city', $cityArray);
		}
		if($experience != null){
			$jobPosts->where('max_exp', '=', $experience)
					 ->orWhere('min_exp', '=', $experience);
			$skillPosts->where('max_exp', '=', $experience)
			         ->orWhere('min_exp', '=', $experience);
		}

		$jobPosts = $jobPosts->paginate(15);
		$skillPosts = $skillPosts->paginate(15);

		return view('pages.welcome_postshow', compact('title', 'jobPosts', 'skillPosts', 'role', 'experience', 'city'));
		// return $jobPosts;
	}

	public function postDetails(){		
			$post = Postjob::with('indUser', 'corpUser', 'postActivity')->where('id', '=', Input::get('postid'))->first();
			
			return view('pages.welcome_postdetails', compact('post'));
			// return $post;
	}

	public function contactUs(Request $request){
		$contact = new Contact_us();
		$contact->name = $request['name'];
		$contact->email = $request['email'];
		$contact->phone = $request['phone'];
		$contact->message = $request['message'];
		$contact->save();
		return redirect('/');
	}
}
