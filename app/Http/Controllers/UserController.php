<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use DB;
use Auth;
use Image;
use App\Induser;
use App\Corpuser;
use App\Skills;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\CreateImgUploadRequest;
use Illuminate\Http\Response;
use Mail;
use Hash;
use Redirect;
use Socialize;
use Sms;


class UserController extends Controller {

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
		// $title = 'profile';
		// $user = Induser::where('id', '=', Auth::user()->induser_id)->first();
		// $skills = Skills::lists('name', 'id');
		// return view('pages.professional_page', compact('user', 'title', 'skills'));
		// return $skills;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateUserRequest $request)
	{
		if($request->ajax()){
			DB::beginTransaction();
			$vcode = "";
			$otp = "";
			try{
				$indUser = new Induser();
				$indUser->fname = $request['fname'];
				$indUser->lname = $request['lname'];
				$indUser->email = $request['email'];
				$indUser->mobile = $request['mobile'];

				if($request['email'] != null){
					$vcode = 'A'.rand(1111,9999);
					$indUser->email_vcode = $vcode;
				}
				if($request['mobile'] != null){
					$otp = rand(1111,9999);
					$indUser->mobile_otp = $otp;
				}

				$indUser->save();

				$user = new User();
				$user->name = $request['fname'].' '.$request['lname'];
				$user->email = $request['email'];
				$user->mobile = $request['mobile'];
				$user->password = bcrypt($request['password']);
				$user->identifier = 1;

				if($request['email'] != null){
					// $vcode = 'A'.rand(1111,9999);
					$user->email_vcode = $vcode;
				}
				if($request['mobile'] != null){
					// $otp = rand(1111,9999);
					$user->mobile_otp = $otp;
				}

				$indUser->user()->save($user);
			}catch(\Exception $e){
			   DB::rollback();
			   throw $e;
			}
			
			DB::commit();
			$data = array();
			if($request['email'] != null){
				$email = $request['email'];
				$fname = $request['fname'];
				$vcode = Induser::where('email', '=', $request['email'])->pluck('email_vcode');
				Mail::send('emails.welcome', array('fname'=>$fname, 'vcode'=>$vcode), function($message) use ($email,$fname){
			        $message->to($email, $fname)->subject('Welcome to Jobtip!')->from('admin@jobtip.in', 'JobTip');
			    });
			    $data['vcode'] = 1;
			}

			if($request['mobile'] != null){
				$data['otp'] = 1;

				// $smsMsg = "Hi ".$request['fname'].", Welcome to Jobtip. ".$otp." is your OTP for mobile verification.";
				$smsMsg = "Thank you for registering Jobtip.in Your One Time Password (OTP) is ".$otp.". TnC applied. Visit www.jobtip.in";
			    $data['delvStatus'] = SMS::send($request['mobile'], $smsMsg);
			}

			$data['page'] = 'login';
			return response()->json(['success'=>true,'data'=>$data]);

			// return 'login';
		}else{
			DB::beginTransaction();
			try{
				$indUser = new Induser();
				$indUser->fname = $request['fname'];
				$indUser->lname = $request['lname'];
				$indUser->email = $request['email'];
				$indUser->mobile = $request['mobile'];

				if($request['email'] != null){
					$vcode = 'A'.rand(1111,9999);
					$indUser->email_vcode = $vcode;
				}
				if($request['mobile'] != null){
					$otp = rand(1111,9999);
					$indUser->mobile_otp = $otp;
				}

				$indUser->save();

				$user = new User();
				$user->name = $request['fname'].' '.$request['lname'];
				$user->email = $request['email'];
				$user->mobile = $request['mobile'];
				$user->password = bcrypt($request['password']);
				$user->identifier = 1;

				$indUser->user()->save($user);
			}catch(\Exception $e){
			   DB::rollback();
			   throw $e;
			}
			
			DB::commit();
			if($request['email'] != null){
				$email = $request['email'];
				$fname = $request['fname'];
				$vcode = Induser::where('email', '=', $request['email'])->pluck('email_vcode');
				Mail::send('emails.welcome', array('fname'=>$fname, 'vcode'=>$vcode), function($message) use ($email,$fname){
			        $message->to($email, $fname)->subject('Welcome to Jobtip!')->from('admin@jobtip.in', 'JobTip');
			    });
			}
			
			return redirect('/login');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view('pages.professional_page');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$title = 'profile';
		$user = Induser::where('id', '=', Auth::user()->induser_id)->first();
		$skills = Skills::lists('name', 'id');
		// return view('pages.professional_page', compact('user', 'title', 'skills'));
		return $skills;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Induser::where('id', '=', $id)->first();
		if($data != null){
			if(Input::file('resume') != null){
				if(Input::file('resume')->isValid()) {
					$destinationPath = 'resume/';
					$extension = Input::file('resume')->getClientOriginalExtension();
					$fileName = rand(11111,99999).'.'.$extension;
					$path = $destinationPath.$fileName;
					Input::file('resume')->move($destinationPath, $fileName);

				}			
				$data->resume = $fileName;
				$data->resume_dtTime  = \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'));
			}
			$data->education = Input::get('education');
			$data->branch = Input::get('branch');
			$data->prof_category = Input::get('prof_category');
			$data->experience = Input::get('experience');
			$data->industry = Input::get('industry');
			if(Input::get('role') != null){
				$farea_role = Input::get('role');
				$temp = explode('-', $farea_role);
				$data->functional_area = $temp[0];
				$data->role = $temp[1];
			}
			
			$data->working_at = Input::get('working_at');
			$data->working_status = Input::get('working_status');
			if(Input::get('linked_skill_id') != null){
				$data->linked_skill = implode(', ', Input::get('linked_skill_id'));
			}
			if(Input::get('prefered_location') != null){
				$data->prefered_location = implode(', ', Input::get('prefered_location'));
			}
			$data->about_individual = Input::get('about_individual');
			$data->prefered_jobtype = Input::get('prefered_jobtype');
			// $pref_locations = Input::get('prefered_location');
			$data->save();
			// if (!empty($pref_locations)) {
			// 	foreach ($pref_locations as $loc) {
		 //        	$tempArr = explode('-', $loc);
		 //        	if(count($tempArr) == 3){
		 //        		$data->preferredLocation()->attach( $loc, array('locality' => $tempArr[0], 'city' => $tempArr[1], 'state' => $tempArr[2]) );
		 //        	}
		 //        	if(count($tempArr) == 2){
		 //        		$data->preferredLocation()->attach( $loc, array('locality' => 'none', 'city' => $tempArr[0], 'state' => $tempArr[1]) );
		 //        	}
		 //        }
		 //    }
			return redirect('/profile/ind/'.$id);
		}else{
			return 'some error occured.';
		}
	}

	public function privacyUpdate($id)
	{
		$data = Induser::where('id', '=', $id)->first();
		if($data != null){
			$data->email_show = Input::get('email_show');
			$data->dob_show = Input::get('dob_show');
			$data->mobile_show = Input::get('mobile_show');
			$data->save();
			return redirect('/profile/ind/'.$id);
		}else{
			return 'some error occured.';
		}
	}

	public function preferenceUpdate($id){
		$data = Induser::where('id', '=', $id)->first();
		if($data != null){
			
			$data->prefered_location = implode(', ', Input::get('prefered_location'));
			$data->prefered_jobtype = Input::get('prefered_jobtype');
			$pref_locations = Input::get('prefered_location');
			$data->save();
			
			if (!empty($pref_locations)) {
				foreach ($pref_locations as $loc) {
		        	$tempArr = explode('-', $loc);
		        	if(count($tempArr) == 3){
		        		$data->preferredLocation()->attach( $loc, array('locality' => $tempArr[0], 'city' => $tempArr[1], 'state' => $tempArr[2]) );
		        	}
		        	if(count($tempArr) == 2){
		        		$data->preferredLocation()->attach( $loc, array('locality' => 'none', 'city' => $tempArr[0], 'state' => $tempArr[1]) );
		        	}
		        }
		    }
			return redirect('/individual/edit#privacy');
		}else{
			return 'some error occured.';
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

	public function basicUpdate(){
		$data = Induser::where('id', '=', Auth::user()->induser_id)->first();
		if($data != null){
			$data->fname = Input::get('fname');
			$data->lname = Input::get('lname');
			$data->dob = Input::get('dob');
			$data->gender = Input::get('gender');
			$data->city = Input::get('city');
			$data->email = Input::get('email');
			$data->mobile = Input::get('mobile');
			$data->in_page = Input::get('in_page');
			$data->fb_page = Input::get('fb_page');
			// if (!empty($curr_locations)) {
			// 	foreach ($curr_locations as $loc) {
		 //        	$tempArr = explode('-', $loc);
		 //        	if(count($tempArr) == 3){
		 //        		$data->c_locality = $tempArr[0];
		 //        		$data->city = $tempArr[1];
		 //        		$data->state = $tempArr[2];
		 //        	}
		 //        	if(count($tempArr) == 2){
			//         	$data->c_locality = 'none';
		 //        		$data->city = $tempArr[0];
		 //        		$data->state = $tempArr[1];
			//         }
		 //        }
		 //    }
			$data->save();
			// $message = 'Personal Tab successfully Updated'
			return redirect('/individual/edit#professional');
		}
	}

	public function imgUpload(Request $request){

		// if($request->hasFile('profile_pic')) {
			
			/*if($request->ajax()){
				$data = [];
				$destinationPath = 'img/profile/temp/';
				$extension = \Illuminate\Support\Facades\Request::file('profile_pic')->getClientOriginalExtension();
				$fileName = rand(11111,99999).'.'.$extension;
				$path = $destinationPath.$fileName;
				\Illuminate\Support\Facades\Request::file('profile_pic')->move($destinationPath, $fileName);
				Image::make($path)->resize(442, null, function ($constraint) {$constraint->aspectRatio();})->save($path);

				$data['pfimg'] = '<img src="img/profile/temp/'.$fileName.'" id="img-crop" style="margin:auto;display:table;"/>';
				$data['uplBtn'] = 'hide';
				$data['filename'] = $fileName;
				return response()->json(['success'=>true,'data'=>$data]);
			}else{*/

				$tempDestinationPath = 'img/profile/temp/';
				$extension = \Illuminate\Support\Facades\Request::file('profile_pic')->getClientOriginalExtension();
				$fileName = rand(11111,99999).'.'.$extension;
				$tempPath = $tempDestinationPath.$fileName;
				\Illuminate\Support\Facades\Request::file('profile_pic')->move($tempDestinationPath, $fileName);
				Image::make($tempPath)->resize(400, null, function ($constraint) {$constraint->aspectRatio();})->save($tempPath);

				$oldProfilePic = Induser::where('id', '=', Auth::user()->induser_id)->pluck('profile_pic');
				$destinationPath = 'img/profile/';
				// $extension = Input::file('profile_pic')->getClientOriginalExtension();
				// $fileName = rand(11111,99999).'.'.$extension;
				// $path = $destinationPath.$fileName;
				// Input::file('profile_pic')->move($destinationPath, $fileName);

				// $fileName = $request['filename'];
				$path = $destinationPath.$fileName;
				$img = 'img/profile/temp/'.$fileName;

				Image::make($img)->crop(intval($request['w']), intval($request['h']), intval($request['x']), intval($request['y']))->save($path);
				Induser::where('id', '=', Auth::user()->induser_id)->update(['profile_pic' => $fileName]);

				if($oldProfilePic != null){
					\File::delete($destinationPath.$oldProfilePic);
					\File::delete($img);
				}
				return redirect('/home');
			// }
			
	    // }
	}

	public function edit_me(){
		$type = Input::get('type');
		return view('pages.mobile_email_modal', compact('type'));
	}

	public function sendOTP(){
		$type = 'mobile-otp';
		$mobile = Input::get('mobile_no');
		$otp = rand(1111,9999);
		$otpEnc = md5($otp);
		return view('pages.verify_email_mobile', compact('mobile', 'otpEnc', 'type', 'otp'));
	}

	public function verifyOTP(){
		$mobile = Input::get('mobile');
		$otp = md5(Input::get('mobile_otp'));
		$otpEnc = Input::get('motpenc');
		if($otp == $otpEnc){
			Induser::where('id', '=', Auth::user()->induser_id)->update(['mobile' => $mobile]);
			Induser::where('id', '=', Auth::user()->induser_id)->update(['mobile_verify' => 1]);
			User::where('induser_id', '=', Auth::user()->induser_id)->update(['mobile' => $mobile]);
			User::where('induser_id', '=', Auth::user()->induser_id)->update(['mobile_verify' => 1]);
			return 'verification-success';
		}else{
			return 'verification-failure';
		}
	}

	public function sendEVC(){
		$type = 'email-verification-code-send';
		$email = Input::get('new_email');
		$code = 'A'.Auth::user()->induser_id.rand(1111,9999);
		$codeEnc = md5($code);
		$user = User::where('induser_id','=',Auth::user()->induser_id)->first();
		$fname = $user->name;
		Mail::send('emails.auth.email_change', array('fname'=>$fname, 'code'=>$code), function($message) use ($email,$fname){
	        $message->to($email, $fname)->subject('Jobtip - Email Change!')->from('admin@jobtip.in', 'JobTip');
	    });
		return view('pages.verify_email_mobile', compact('email', 'codeEnc', 'type', 'code'));
	}

	public function verifyEVC(){
		$email = Input::get('email');
		$code = md5(Input::get('email_vcode'));
		$codeEnc = Input::get('ecodeenc');
		if($code == $codeEnc){
			Induser::where('id', '=', Auth::user()->induser_id)->update(['email' => $email]);
			Induser::where('id', '=', Auth::user()->induser_id)->update(['email_verify' => 1]);
			User::where('induser_id', '=', Auth::user()->induser_id)->update(['email' => $email]);
			User::where('induser_id', '=', Auth::user()->induser_id)->update(['email_verify' => 1]);
			return 'verification-success';
		}else{
			return 'verification-failure';
		}
	}

	public function forgetPassword(){
		$emailOrMobile = Input::get('forget_email');
		$field = filter_var($emailOrMobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
		if($field == 'email'){
			$user = User::where('email','=',$emailOrMobile)->first();
		}elseif($field == 'mobile'){
			$user = User::where('mobile','=',$emailOrMobile)->first();
		}
		$data = [];
		if($user != null){
			$resetCode = md5(rand(11111,99999));
			$user->reset_code = $resetCode;
			$user->save();
			

			if($field == 'email'){
				$email = $user->email;
				$fname = $user->induser->fname;
				Mail::send('emails.auth.reminder', array('fname'=>$fname, 'token'=>$resetCode), function($message) use ($email,$fname){
			        $message->to($email, $fname)->subject('Jobtip - Password Reset!')->from('admin@jobtip.in', 'JobTip');
			    });
			    $data['msg'] = 'Check your email for password reset link.';
			    $data['medium'] = 'email';
			}elseif($field == 'mobile'){
				$mobile = $user->mobile;
				$fname = $user->induser->fname;
				$data['reset_code'] = $resetCode;
				$data['msg'] = 'Check your mobile for password reset link.';
				$data['medium'] = 'mobile';		
			}

			$data['page'] = 'login';
			return response()->json(['success'=>true,'data'=>$data]);

		}else{
			if($field == 'email'){
				$data['error'] = 'Invalid Email Id';
			}elseif($field == 'mobile'){
				$data['error'] = 'Invalid Mobile';
			}
			$data['page'] = 'login';
			return response()->json(['success'=>true,'data'=>$data]);
		}
	}

	public function resetPassword($token){
		if($token != null){
			$user = User::where('reset_code','=',$token)->first();
			if($user!=null){
				return view('pages.resetpassword', compact('token'));
			}else{
				return redirect('/login');
			}
		}else{
			return redirect('/login');
		}
	}

	public function postResetPassword(){
		$validator = Validator::make(
					    ['password' => Input::get('password'), 
					     'password_confirmation' => Input::get('password_confirmation'),
					     'token' => Input::get('token')
					    ],
					    ['password' => 'required|min:6|confirmed', 
					     'password_confirmation' => 'required|min:6',
					     'token' => 'required'
					    ]
					);
		if ($validator->fails()) {
	        return redirect()->back()->withErrors($validator->errors());
	    }else{
			$user = User::where('reset_code','=',Input::get('token'))->first();
			if($user != null){
				$user->password = bcrypt(Input::get('password'));
				$user->reset_code = null;
				$user->save();
				if($user->email != null){
					$email = $user->email;
					$fname = $user->name;
					Mail::send('emails.auth.changepasswordconfirmation', array('fname'=>$fname), function($message) use ($email,$fname){
				        $message->to($email, $fname)->subject('Jobtip - Password changed!')->from('admin@jobtip.in', 'JobTip');
				    });
				}
				return redirect('/login');
			}
		}
	}

	public function resetPasswordProfile($token){
		if($token != null){
			$user = User::where('reset_code','=',$token)->first();
			if($user!=null){
				return view('pages.resetpasswordprofile', compact('token'));
			}else{
				return redirect('/login');
			}
		}else{
			return redirect('/login');
		}
	}

	public function adminProfileResetPassword(){
		$validator = Validator::make(
					    ['password' => Input::get('password'), 
					     'password_confirmation' => Input::get('password_confirmation'),
					     'token' => Input::get('token')
					    ],
					    ['password' => 'required|min:6|confirmed', 
					     'password_confirmation' => 'required|min:6',
					     'token' => 'required'
					    ]
					);
		if ($validator->fails()) {
	        return redirect()->back()->withErrors($validator->errors());
	    }else{
			$user = User::where('reset_code','=',Input::get('token'))->first();
			if($user != null){
				$user->password = bcrypt(Input::get('password'));
				$user->reset_code = null;
				$user->email_verify = 1;
				$user->save();
				if($user->email != null){
					$email = $user->email;
					$fname = $user->name;
					Mail::send('emails.auth.changepasswordconfirmation', array('fname'=>$fname), function($message) use ($email,$fname){
				        $message->to($email, $fname)->subject('Jobtip - Password Changed!')->from('admin@jobtip.in', 'JobTip');
				    });
				}
				return redirect('/login');
			}
		}
	}

	public function postChangePassword(){
		$validator = Validator::make(
					    ['password' => Input::get('password'), 
					     'password_confirmation' => Input::get('password_confirmation'),
					     'old_password' => Input::get('old_password')
					    ],
					    ['password' => 'required|min:6|confirmed', 
					     'password_confirmation' => 'required|min:6',
					     'old_password' => 'required|min:6'
					    ]
					);
		if ($validator->fails()) {
	        return redirect("/home#change-password")->withErrors($validator->errors());
	    }else{
	    	$user = User::where('induser_id','=',Auth::user()->induser_id)->first();
			if( Hash::check(Input::get('old_password'), $user->password) ){
				$user->password = bcrypt(Input::get('password'));
				$user->save();
				if($user->email != null){
					$email = $user->email;
					$fname = $user->name;
					Mail::send('emails.auth.changepasswordconfirmation', array('fname'=>$fname), function($message) use ($email,$fname){
				        $message->to($email, $fname)->subject('Jobtip - Password Changed!')->from('admin@jobtip.in', 'JobTip');
				    });
				}
				
				return redirect('/home')->withErrors(['Password changed successfully']);
			}else{
				return redirect("/home#change-password")->withErrors(['Old password doesnt match']);
			}
	    }
	}

	
	// fb login
	public function redirectToFacebook() {
	  return Socialize::with('facebook')->scopes(['email','basic_info'])->redirect();
	}

	public function handleFacebookCallback() {
	  $fb_user = Socialize::with('facebook')->user();

	  $jtIndUser = Induser::where('email', '=', $fb_user->getEmail())->first();
	  $jtCorpUser = Corpuser::where('firm_email_id', '=', $fb_user->getEmail())->first();

	  $authUser = User::where('email', '=', $fb_user->getEmail())->first();
	  if(!empty($jtIndUser) && $fb_user->token != null){
	  	// user exist
	  	Auth::login($authUser);
	  	return Redirect::to('/home')->with('message', 'Logged in with Facebook');
	  }else if(!empty($jtIndUser) && $fb_user->token == null){
	  	// user exist but social login failed
	  	return Redirect::to('/login')->with('message', 'Login failed using Facebook');
	  }else if(!empty($jtCorpUser)){
	  	// corp user exist but social login not allowed
	  	return Redirect::to('/login')->with('message', 'Social Login not allwoed for Corporate users');
	  }else{
	  	// user doesn't exist
	  	DB::beginTransaction();
		try{
			$indUser = new Induser();
			$indUser->fname = $fb_user->user['first_name'];
			$indUser->lname = $fb_user->user['last_name'];
			$indUser->gender = $fb_user->user['gender'];
			$indUser->email = $fb_user->getEmail();
			$indUser->social_id = $fb_user->getId();
			$indUser->access_token = $fb_user->token;
			$indUser->avatar = $fb_user->avatar;
			$indUser->reg_via = 'facebook';
			$indUser->email_verify = '1';
			$indUser->save();

			$user = new User();
			$user->name = $fb_user->user['first_name'].' '.$fb_user->user['last_name'];
			$user->email = $fb_user->getEmail();
			$user->email_verify = '1';
			$user->identifier = 1;

			$indUser->user()->save($user);
		}catch(\Exception $e){
		   DB::rollback();
		   throw $e;
		}
		
		DB::commit();

		Auth::login($user);
		return Redirect::to('/home')->with('message', 'Logged in with Google');
	  }
	  
	  // print_r($fb_user);die;
	}

	// gp login
	public function redirectToGoogle() {
	  return Socialize::with('google')->scopes(['email', 'profile'])->redirect();
	}

	public function handleGoogleCallback() {
	  $gp_user = Socialize::with('google')->user();

	  $jtIndUser = Induser::where('email', '=', $gp_user->getEmail())->first();
	  $jtCorpUser = Corpuser::where('firm_email_id', '=', $gp_user->getEmail())->first();

	  $authUser = User::where('email', '=', $gp_user->getEmail())->first();
	  if(!empty($jtIndUser) && $gp_user->token != null){
	  	// user exist
	  	Auth::login($authUser);
	  	return Redirect::to('/home')->with('message', 'Logged in with Google');
	  }else if(!empty($jtIndUser) && $gp_user->token == null){
	  	// user exist but social login failed
	  	return Redirect::to('/login')->with('message', 'Login failed using Google');
	  }else if(!empty($jtCorpUser)){
	  	// corp user exist but social login not allowed
	  	return Redirect::to('/login')->with('message', 'Social Login not allwoed for Corporate users');
	  }else{
	  	// user doesn't exist
	  	DB::beginTransaction();
		try{
			$indUser = new Induser();
			$indUser->fname = $gp_user->user['name']['givenName'];
			$indUser->lname = $gp_user->user['name']['familyName'];
			$indUser->gender = $gp_user->user['gender'];
			$indUser->email = $gp_user->getEmail();
			$indUser->social_id = $gp_user->getId();
			$indUser->access_token = $gp_user->token;
			$indUser->avatar = $gp_user->avatar;
			$indUser->reg_via = 'google';
			$indUser->email_verify = '1';
			$indUser->save();

			$user = new User();
			$user->name = $gp_user->user['name']['givenName'].' '.$gp_user->user['name']['familyName'];
			$user->email = $gp_user->getEmail();
			$user->email_verify = '1';
			$user->identifier = 1;

			$indUser->user()->save($user);
		}catch(\Exception $e){
		   DB::rollback();
		   throw $e;
		}
		
		DB::commit();

		Auth::login($user);
		return Redirect::to('/home')->with('message', 'Logged in with Google');
	  }
	  
	  // print_r($gp_user);die;
	}

	// Linkedin login
	public function redirectToLinkedin() {
	  return Socialize::with('linkedin')->scopes(['r_emailaddress', 'r_basicprofile'])->redirect();
	}

	public function handleLinkedinCallback() {
	  $li_user = Socialize::with('linkedin')->user();

	  $jtIndUser = Induser::where('email', '=', $li_user->getEmail())->first();
	  $jtCorpUser = Corpuser::where('firm_email_id', '=', $li_user->getEmail())->first();

	  $authUser = User::where('email', '=', $li_user->getEmail())->first();
	  if(!empty($jtIndUser) && $li_user->token != null){
	  	// user exist
	  	Auth::login($authUser);
	  	return Redirect::to('/home')->with('message', 'Logged in with Linkedin');
	  }else if(!empty($jtIndUser) && $li_user->token == null){
	  	// user exist but social login failed
	  	return Redirect::to('/login')->with('message', 'Login failed using Linkedin');
	  }else if(!empty($jtCorpUser)){
	  	// corp user exist but social login not allowed
	  	return Redirect::to('/login')->with('message', 'Social Login not allwoed for Corporate users');
	  }else{
	  	// user doesn't exist
	  	DB::beginTransaction();
		try{
			$indUser = new Induser();
			$indUser->fname = $li_user->user['firstName'];
			$indUser->lname = $li_user->user['lastName'];
			// $indUser->gender = $li_user->user['gender'];
			$indUser->email = $li_user->getEmail();
			$indUser->social_id = $li_user->getId();
			$indUser->access_token = $li_user->token;
			$indUser->avatar = $li_user->avatar;
			$indUser->reg_via = 'linkedin';
			$indUser->email_verify = '1';
			$indUser->save();

			$user = new User();
			$user->name = $li_user->user['firstName'].' '.$li_user->user['lastName'];
			$user->email = $li_user->getEmail();
			$user->email_verify = '1';
			$user->identifier = 1;

			$indUser->user()->save($user);
		}catch(\Exception $e){
		   DB::rollback();
		   throw $e;
		}
		
		DB::commit();

		Auth::login($user);
		return Redirect::to('/home')->with('message', 'Logged in with Linkedin');
	  }
	  
	  // print_r($li_user);die;
	}


	public function role_detail($role_id){
		$role = DB::select(DB::raw('select ifar.id as id, r.name as role, fa.name as "functional_area", i.name as industry 
							from industry_functional_area_role_mappings ifar
							join industry_functional_area_mappings ifa
							on ifar.industry_functional_area = ifa.id
							join roles r
							on ifar.role=r.id
							join functional_areas fa
							on ifa.functional_area=fa.id
							join industries i
							on ifa.industry=i.id
							where ifar.id = ?
							order by id'), [$role_id]);
		return $role;
	}

	// update profile %ge alert
	public function profileAlertUpdate(){
		$now = \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'));
		$alerted = User::where('id', '=', Auth::user()->id)->update(['profile_alert' => 1,'profile_alert_dtTime' => $now]);
		return $alerted;
	}

		
}
