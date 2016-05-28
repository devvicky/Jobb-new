<?php namespace App\Http\Controllers;
use Input;
use App\Postjob;
use App\Contact_us;
use App\feedback_welcome;
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
		$jobPosts = Postjob::orderBy('id', 'desc')
						   ->with('indUser', 'corpUser')
						   ->where('post_type', '=', 'job');
		$skillPosts = Postjob::orderBy('id', 'desc')
						   ->with('indUser', 'corpUser')
						   ->where('post_type', '=', 'skill');
		if($role != null){
			$jobPosts->where('post_title', 'like', '%'.$role.'%')
						 ->whereRaw("(job_detail like '%".$role."%' or role like '%".$role."%' or linked_skill like '%".$role."%')");
			$skillPosts->where('post_title', 'like', '%'.$role.'%')
						 ->whereRaw("(job_detail like '%".$role."%' or role like '%".$role."%' or linked_skill like '%".$role."%')");
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
			$jobPosts->whereRaw("$experience between min_exp and max_exp");
			$skillPosts->whereRaw("$experience between min_exp and max_exp");
		}

		$jobPosts = $jobPosts->paginate(15);
		$skillPosts = $skillPosts->paginate(15);

		return view('pages.welcome_postshow', compact('title', 'jobPosts', 'skillPosts', 'role', 'experience', 'city'));
		// return $jobPosts;
	}

	public function postDetails(){	
		$title = 'Post_details';	
			$post = Postjob::with('indUser', 'corpUser', 'postActivity')->where('id', '=', Input::get('postid'))->first();
			
			return view('pages.welcome_postdetails', compact('post', 'title'));
			// return $post;
	}

	public function contactsUs(Request $request){
		$contact = new Contact_us();
		$contact->name = $request['name'];
		$contact->email = $request['email'];
		$contact->phone = $request['phone'];
		$contact->message = $request['message'];
		$contact->save();
		return redirect('/');
	}

	public function contactUs(Request $request){
		$contact = new Contact_us();
		$contact->name = $request['name'];
		$contact->email = $request['email'];
		$contact->phone = $request['phone'];
		$contact->message = $request['message'];
		$contact->save();

		return response()->json(['success'=>'success']);
	}

	public function welcomeJobPost($id){
		$title = 'Post_details';
		$post = Postjob::orderBy('id', 'desc')
						   ->with('indUser', 'corpUser')
						   ->where('unique_id', '=', $id)
						   ->get();
		if($post != null){
			$post = $post->first();
		}

		return view('pages.welcome_postdetails', compact('post', 'title'));
	}

	public function welcomeSkillPost($id){
		$title = 'Post_details';
		$post = Postjob::orderBy('id', 'desc')
						   ->with('indUser', 'corpUser')
						   ->where('unique_id', '=', $id)
						   ->get();
		if($post != null){
			$post = $post->first();
		}

		return view('pages.welcome_postdetails', compact('post', 'title'));
	}

	public function feedbackWelcome()
	{
		$title = 'Feedback';
		return view('pages.feedback_welcome', compact('title'));
	}

	public function feedbackWelcomeStore(){
		$feedback = new Feedback_welcome();
		$feedback->email_id = Input::get('experience');
		$feedback->experience = Input::get('experience');
		$feedback->usability = Input::get('usability');
		$feedback->comments = Input::get('comments');
		$feedback->promotion = Input::get('promotion');
		$feedback->device_info = Input::get('device_info');
		if(Input::get('concerns') != null){
			$feedback->concerns = implode(', ', Input::get('concerns'));
		}
		$feedback->refer = Input::get('refer');
		$feedback->save();


		return redirect('/feedback/welcome')->withErrors([
						'errors' => 'Thank You for your valuable Feedback.',
					]);
	}

	public function subscribeEmail(){
		$subscribe = new Induser();
		$name = explode('@', Input::get('email'));
		$subscribe->email = Input::get('email');
		$subscribe->fname = $name[0];
		if(Input::get('email') != null){
			$vcode = 'A'.rand(1111,9999);
			$subscribe->email_vcode = $vcode;
		}
		$subscribe->save();

		$subscribeUser = new User();
		$subscribeUser->email = Input::get('email');
		if(Input::get('email') != null){
			$vcode = 'A'.rand(1111,9999);
			$subscribeUser->email_vcode = $vcode;
		}
		
		$subscribe->save();
		if(Input::get('email')!= null){
				$email = Input::get('email');
				$fname = $name[0];
				$vcode = Induser::where('email', '=', Input::get('email'))->pluck('email_vcode');
				Mail::send('emails.welcome', array('fname'=>$fname, 'vcode'=>$vcode), function($message) use ($email,$fname){
			        $message->to($email, $fname)->subject('Welcome to Jobtip!')->from('admin@jobtip.in', 'JobTip');
			    });
			}
	}
	
}
