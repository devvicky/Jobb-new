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
use App\Accountdetail;
use App\Postjob;
use App\Postactivity;
use App\Connections;
use App\FunctionalAreas;
use App\Education;
use App\Functional_area_role_mapping;
use App\Security_check;

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
use App\Traits\CaptchaTrait;
use ReCaptcha\ReCaptcha;

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
	public function store(CreateUserRequest $request)
	{

		if($this->captchaCheck() == false)
        {
            return redirect()->back()
                ->withErrors(['Wrong Captcha'])
                ->withInput();
        }
		        
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
				$data['otp'] = $otp;

				// $smsMsg = "Thank you for registering Jobtip.in Your One Time Password (OTP) is ".$otp.". TnC applied. Visit www.jobtip.in";
			 //    $data['delvStatus'] = SMS::send($request['mobile'], $smsMsg);
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
	public function updateResume($id)
	{
		$data = Induser::where('id', '=', $id)->first();
		if($data != null){
			if(Input::file('resume') != null){
				if(Input::file('resume')->isValid()) {
					$destinationPath = 'resume/';
					// $extension = Input::file('resume')->getClientOriginalExtension();
					$date = new \DateTime();
					// $date = new DateTime('2000-01-01');
					$result = $date->format('Y-m-d');
					$name = $result.'_'.Input::file('resume')->getClientOriginalName();
					$fileName = $name;
					$path = $destinationPath.$fileName;
					Input::file('resume')->move($destinationPath, $fileName);

				}			
				$data->resume = $fileName;
				$data->resume_dtTime  = \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'));
			}
		}
		$data->save();
		return redirect('individual/edit');
	}

	public function removeResume($id)
	{
		$remove = Induser::where('id', '=', $id)->first();
		if($remove != null){
			$remove->resume = null;
			$remove->resume_dtTime = '0000-00-00 00:00:00';
		}
		$remove->save();
		return redirect('/individual/edit')->withErrors([
						'errors' => 'Resume successfully removed.',
					]);
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

	public function personalInfo(Request $request){
		$personinfo = Induser::where('id', '=', $request['userid'])->first();
		$personuser = User::where('induser_id', '=', $request['userid'])->first();

		if($personinfo != null  && $personuser != null){
			$personinfo->fname = $request['fname'];
			$personinfo->lname = $request['lname'];
			$personinfo->dob = $request['dob'];
			$personinfo->gender = $request['gender'];
			$personinfo->save();
			$personuser->name = $request['fname'] .' '. $request['lname'];
			$personuser->save();

			$data = [];
			$data['fullname'] = $personinfo->fname.' '.$personinfo->lname;
			return response()->json(['success'=>'success', 'data'=>$data]);
		}else{
			return response()->json(['success'=>'fail']);
		}
	}

	public function contactInfo(Request $request){
		$contactinfo = Induser::where('id', '=', $request['userid'])->first();

		if($contactinfo != null){
			$contactinfo->fb_page = $request['fb_page'];
			$contactinfo->in_page = $request['in_page'];
			$contactinfo->save();

			return response()->json(['success'=>'success']);
		}else{
			return response()->json(['success'=>'fail']);
		}
	}

	public function addressUpdate(Request $request){
		$addressupdate = Induser::where('id', '=', $request['userid'])->first();

		if($addressupdate != null){
			$addressupdate->address_1 = $request['address_1'];
			$addressupdate->address_2 = $request['address_2'];
			$addressupdate->city = $request['city'];
			$addressupdate->save();

			return response()->json(['success'=>'success']);
		}else{
			return response()->json(['success'=>'fail']);
		}
	}

	public function professionalUpdate(Request $request){
		$professionalupdate = Induser::where('id', '=', $request['userid'])->first();

		if($professionalupdate != null){
			
			$professionalupdate->education = $request['education'];
			$professionalupdate->branch = $request['branch'];
			$professionalupdate->prof_category = $request['prof_category'];
			$professionalupdate->experience = $request['experience'];
			$professionalupdate->industry = $request['industry'];
			if($request['role'] != null){
				$farea_role = $request['role'];
				$temp = explode('-', $farea_role);
				$professionalupdate->functional_area = $temp[0];
				$professionalupdate->role = $temp[1];
			}
			
			$professionalupdate->working_at = $request['working_at'];
			$professionalupdate->working_status = $request['working_status'];
			if($request['linked_skill_id'] != null){
				$professionalupdate->linked_skill = implode(', ', $request['linked_skill_id']);
			}
			$professionalupdate->about_individual = $request['about_individual'];

			
			$professionalupdate->save();
			return response()->json(['success'=>'success']);
		}else{
			return response()->json(['success'=>'fail']);
		}
	}

	public function preferenceUpdate(Request $request){
		$preferenceupdate = Induser::where('id', '=', $request['userid'])->first();

		if($preferenceupdate != null){
			$preferenceupdate->prefered_jobtype = $request['prefered_jobtype'];
			$preferenceupdate->job_agreement = $request['job_agreement'];
			$preferenceupdate->expected_salary = $request['expected_salary'];
			$preferenceupdate->salary_type = $request['salary_type'];
			$preferenceupdate->candidate_availablity = $request['candidate_availablity'];
			if($request['prefered_location'] != null){
				$preferenceupdate->prefered_location = implode(',', $request['prefered_location']);
			}
			$preferenceupdate->save();

			return response()->json(['success'=>'success']);
		}else{
			return response()->json(['success'=>'fail']);
		}
	}

	public function privacyUpdate(Request $request){
		$privacyUpdate = Induser::where('id', '=', $request['userid'])->first();

		if($privacyUpdate != null){
			$privacyUpdate->email_show = $request['email_show'];
			$privacyUpdate->mobile_show = $request['mobile_show'];
			$privacyUpdate->dob_show = $request['dob_show'];
			$privacyUpdate->save();

			return response()->json(['success'=>'success']);
		}else{
			return response()->json(['success'=>'fail']);
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
				return redirect('/individual/edit');
			// }
			
	    // }
	}

	public function edit_me(){
		$type = Input::get('type');
		$otp = " ";
		$otpEnc = " ";
		return view('pages.mobile_email_modal', compact('type', 'otp', 'otpEnc'));
	}

	public function delete_me(){
		$type = Input::get('type');
		return view('pages.delete_email_mobile', compact('type'));
	}

	public function delete_mobile_me(){
		$user = User::where('induser_id', '=', Auth::user()->induser_id)->first();
		$induser = Induser::where('id', '=', Auth::user()->induser_id)->first();
		$user->mobile = "";
		$induser->mobile = "";
		$user->mobile_verify = 0;
		$user->save();
		$induser->save();
		return redirect('/profile/ind/'.$user->induser_id);
	}

	public function delete_email_me(){
		$user = User::where('induser_id', '=', Auth::user()->induser_id)->first();
		$induser = Induser::where('id', '=', Auth::user()->induser_id)->first();
		$user->email = "";
		$induser->email = "";
		$user->email_verify = 0;
		$user->save();
		$induser->save();
		return redirect('/profile/ind/'.$user->induser_id);
	}

	public function sendOTP(){
		$type = 'mobile-otp';
		$mobile = Input::get('mobile_no');

		$user = User::where('mobile', '=', $mobile)->pluck('id');
		$data = [];
		if($user == null){

		$otp = rand(1111,9999);

		$check_no = Security_check::where('user_id', '=', Auth::user()->id)
								  ->where('mobile', '=', $mobile)
								  ->where('status', '=', 'Not Verified')
								  ->first();
		if($check_no != null){
			$data['oen'] = 'OTPALREADYSEND';
			$data['msg'] = 'OTP already send. Please Check your Message box.';
			return response()->json(['success'=>true, 'data'=>$data]);
			}else{
				$s_check = new Security_check();
				$s_check->user_id = Auth::user()->id;
				$s_check->verify_for = "Mobile";
				$s_check->mobile = $mobile;
				$s_check->otp = $otp;
				$s_check->status = "Not Verified";
				$s_check->save();
				$otpEnc = md5($otp);

				// $user_new = User::where('id', '=', Auth::user()->id)->first();
				// $user_new->mobile_otp = $otpEnc;
				// $user_new->save();
				$smsMsg = "Thank you for registering Jobtip.in Your One Time Password (OTP) is ".$otp.". TnC applied. Visit www.jobtip.in";
				$data['delvStatus'] = SMS::send($mobile, $smsMsg);
				$data['oen'] = $otpEnc;
				$data['msg'] = 'Check your Mobile for OTP';
				$data['type'] = 'mobile-otp';
				return response()->json(['success'=>true,'data'=>$data]);
				// return view('pages.verify_email_mobile', compact('mobile', 'otpEnc', 'type', 'otp'));
			}	
		}else{
			$data['oen'] = null;
			$data['msg'] = 'Entered Mobile number is already in use. Please try any other number.';
			return response()->json(['success'=>true, 'data'=>$data]);
			// return 'Entered Mobile number is already in use. Please try any other number.';
		}				 
		
	}

	public function verifyOTP(){
		$otp =Input::get('mobile_otp');
		$check_otp = Security_check::where('user_id', '=', Auth::user()->id)
								   ->where('verify_for', '=', 'Mobile')
								   ->where('status', '=', 'Not Verified')
								   ->first();

		if($otp == $check_otp->otp){
		$mobile = $check_otp->mobile;
		$check_otp->status = "Verified";
		$check_otp->save();
		Induser::where('id', '=', Auth::user()->induser_id)->update(['mobile' => $mobile]);
		Induser::where('id', '=', Auth::user()->induser_id)->update(['mobile_verify' => 1]);
		User::where('induser_id', '=', Auth::user()->induser_id)->update(['mobile' => $mobile]);
		User::where('induser_id', '=', Auth::user()->induser_id)->update(['mobile_verify' => 1]);
		return 'verification-success';
		}else{
			return 'verification-failure';
		}
	}

	public function OTPresend(){
		$otp = rand(1111,9999);
        $resend_otp = Security_check::where('user_id', '=', Auth::user()->id)
                     ->where('verify_for', '=', 'Mobile')
                     ->where('status', '=', 'Not Verified')
                     ->first();
        $data = [];
        if($resend_otp != null && $resend_otp->resend_attemp <= 3){
          $mobile = $resend_otp->mobile;
          $resend_otp->otp = $otp;
          $resend_otp->resend_attemp = $resend_otp->resend_attemp + 1;
          $resend_otp->save();

          
	        $smsMsg = "Thank you for registering Jobtip.in Your One Time Password (OTP) is ".$otp.". TnC applied. Visit www.jobtip.in";
	        $data['delvStatus'] = SMS::send($mobile, $smsMsg);
	        $data['msg'] = 'Check your Mobile for OTP';
	        $data['types'] = 'mobile-otp';
	        return response()->json(['success'=>true,'data'=>$data]);
        }else if($resend_otp != null && $resend_otp->resend_attemp > 3){
        	$data['msg'] = 'You attemped 3 times.';
	        return response()->json(['success'=>true,'data'=>$data]);
        }          
        
      }

	public function sendEVC(){
		$type = 'email-verification-code-send';
		$email = Input::get('new_email');
		$mobileReg = User::where('email', '=', $email)->first(['id']);

		if($mobileReg == []){
			$code = 'A'.Auth::user()->induser_id.rand(1111,9999);
			$codeEnc = md5($code);
			$user = User::where('induser_id','=',Auth::user()->induser_id)->first();
			$fname = $user->name;
			Mail::send('emails.auth.email_change', array('fname'=>$fname, 'code'=>$code), function($message) use ($email,$fname){
		        $message->to($email, $fname)->subject('Jobtip - Email Change!')->from('admin@jobtip.in', 'JobTip');
		    });
			return view('pages.verify_email_mobile', compact('email', 'codeEnc', 'type', 'code'));
		}else{
			$data = [];
			return 'Entered Email ID is already in use. Please try any other email id.';
		}	
		
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
			$user = User::where('reset_code', '=', $token)->first();
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

	public function accountSetting(){
		$title = "AccountSetting";
		$acc_id = "";
		$user = User::with('induser')->where('id', '=', Auth::user()->id)->first();
		return view('pages.account_delete', compact('title', 'user', 'acc_id'));
	}
		
	public function accountDelete(){

		if(Auth::user()->identifier == 1){
			$title = "AccountSetting";
			$acc_id = Input::get('account_id');
			$password = bcrypt(Input::get('password'));
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
			$farearoleList = Functional_area_role_mapping::orderBy('id')->get();
			$userDetail = User::where('induser_id','=',Auth::user()->induser_id)->first();
			$token = 'AD'.rand(11111,99999).rand(11111,99999);
			if( Hash::check(Input::get('password'), $userDetail->password) ){
				$user = User::with('induser')->where('id', '=', Auth::user()->id)->first();
				return view('pages.professional_page', compact('title', 'user', 'acc_id', 'skills', 'educationList', 'location', 'farearoleList', 'thanks', 'linksCount', 'posts'));
			}else{
				return redirect('/mypost');
			}
		}elseif(Auth::user()->identifier == 2){
			$title = "AccountSetting";
			$acc_id = Input::get('account_id');
			$password = bcrypt(Input::get('password'));
			$skills = Skills::lists('name', 'name');
			$userDetail = User::where('corpuser_id','=',Auth::user()->corpuser_id)->first();
			$token = 'AD'.rand(11111,99999).rand(11111,99999);
			if( Hash::check(Input::get('password'), $userDetail->password) ){
				$user = User::with('corpuser')->where('id', '=', Auth::user()->id)->first();
				return view('pages.firm_details', compact('title', 'user', 'acc_id', 'skills'));
			}else{
				return redirect('/mypost');
			}
		}
	}

	public function deleteProfileAccount(){

		if(Auth::user()->identifier == 1){
			$user = User::where('induser_id','=',Auth::user()->induser_id)->first();
			$induser = Induser::where('id','=',Auth::user()->induser_id)->first();
			$accountDetail = new Accountdetail();

			$accountDetail->name = $user->name;
			$accountDetail->emailid = $user->email;
			$accountDetail->mobile = $user->mobile;
			$accountDetail->profile_created_date = $user->created_at;
			$accountDetail->reason = Input::get('reason');
			$accountDetail->comments = Input::get('comments');
			$accountDetail->save();
			if($accountDetail != null){
				$user->delete();
				$induser->delete();
			}
		}elseif(Auth::user()->identifier == 2){
			$user = User::where('corpuser_id','=',Auth::user()->corpuser_id)->first();
			$corpuser = Corpuser::where('id','=',Auth::user()->corpuser_id)->first();
			$accountDetail = new Accountdetail();

			$accountDetail->name = $user->name;
			$accountDetail->emailid = $user->email;
			$accountDetail->mobile = $user->mobile;
			$accountDetail->profile_created_date = $user->created_at;
			$accountDetail->reason = Input::get('reason');
			$accountDetail->comments = Input::get('comments');
			$accountDetail->save();
			if($accountDetail != null){
				$user->delete();
				$corpuser->delete();
			}
		}
		
		return redirect('/auth/logout');
	}
}
