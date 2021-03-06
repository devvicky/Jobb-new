<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\User;
use App\Induser;
use Mail;
use Sms;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	protected $redirectTo = 'home';
	protected $loginPath  = 'login';

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	public function postLogin(Request $request)
	{
		$type = $request->input('type');
		$field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
    	$request->merge([$field => $request->input('email')]);

    	$credentials = $request->only($field, 'password');
    	$data = [];
		if($field == 'email'){
    		$data['email_verify'] = 0;
	    	$email_verify = User::where('email', '=', $request->input('email'))
	    						->where('identifier', '=', $type)
	    						->where('inactive', '=', 0)
	    						->orWhere('email', '=', $request->input('email'))
	    						->where('identifier', '=', 3)
	    						->pluck('email_verify');
	    	if($email_verify == '1'){
	    		$credentials = array_add($credentials, 'email_verify', '1');
	    		$data['page'] = 'home';
	    		$data['valid'] = 1;
	    		$data['email_verify'] = 1;
	    	}else{
	    		$data['page'] = 'login';
	    		$emailObj = User::where('email', '=', $request->input('email'))->first(['name', 'email_verify', 'email_vcode', 'email_vcode_expiry']);
	    		if($emailObj != null && $emailObj->email_verify == 0){
	    			$email_vcode_expiry = new \Carbon\Carbon($emailObj->email_vcode_expiry, 'Asia/Kolkata');
					$now = \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'));
					$difference = $now->diffInHours($email_vcode_expiry);

					/*$data['now'] = $now;
					$data['email_vcode_expiry'] = $email_vcode_expiry;
					$data['diff'] = $difference;*/
			    	
					if($difference < 1){
						/*$vcode = $emailObj->email_vcode;
						$fname = $emailObj->name;

						Mail::send('emails.welcome', array('fname'=>$fname, 'vcode'=>$vcode), function($message) use ($email,$fname){
					        $message->to($email, $fname)->subject('Welcome to Jobtip!')->from('admin@jobtip.in', 'JobTip');
					    });*/
						
						$data['email_verify'] = 0;
						$data['valid'] = 1;
			    		$data['message'] = 'Your email is not verified. Please check your email for verification code.';
					}else if($difference >= 1){
						$vcode = "";
						if($request->input('email') != null){
							$vcode = 'A'.rand(1111,9999);
							$nowPlusOne = \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'))->addHours(1);
							// Induser::where('email', '=', $request->input('email'))->update(['email_vcode' => $vcode]);
							User::where('email', '=', $request->input('email'))->update(['email_vcode' => $vcode, 'email_vcode_expiry'=> $nowPlusOne]);
						}

						$email = $request->input('email');
						$fname = $emailObj->name;

						Mail::send('emails.welcome', array('fname'=>$fname, 'vcode'=>$vcode), function($message) use ($email,$fname){
					        $message->to($email, $fname)->subject('Welcome to Jobtip!')->from('admin@jobtip.in', 'JobTip');
					    });

					    $data['email_verify'] = 0;
					    $data['valid'] = 1;
			    		$data['message'] = 'We have sent you an email for verification.';
					}

	    		}else{
	    			$data['valid'] = 0;
	    		}
	    		//error - email not verified
	    		/*$data['email_verify'] = 0;
	    		$data['page'] = 'login';
	    		$data['message'] = 'email not verified';*/
	    	}
	    }
	    if($field == 'mobile'){
    		$data['mobile_verify'] = 0;
	    	$mobile_verify = User::where('mobile', '=', $request->input('email'))
	    						 ->where('identifier', '=', $type)
	    						 ->where('inactive', '=', 0)
	    						 ->orWhere('mobile', '=', $request->input('email'))
	    						 ->where('identifier', '=', 3)
	    						 ->pluck('mobile_verify');
	    	if($mobile_verify == '1'){
	    		$credentials = array_add($credentials, 'mobile_verify', '1');
	    		$data['page'] = 'home';
	    		$data['valid'] = 1;
	    		$data['mobile_verify'] = 1;
	    	}else{	    		
				$data['page'] = 'login';
	    		$userForMobile = User::where('mobile', '=', $request->input('email'))->first(['name', 'mobile_verify', 'mobile_otp', 'mobile_otp_expiry', 'mobile_otp_attempt']);
	    		if($userForMobile != null && $userForMobile->mobile_verify == 0){
	    			$mobile_otp_expiry = new \Carbon\Carbon($userForMobile->mobile_otp_expiry, 'Asia/Kolkata');
					$now = \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'));
					$difference = $now->diffInMinutes($mobile_otp_expiry);

					$data['now'] = $now;
					$data['mobile_otp_expiry'] = $mobile_otp_expiry;
					$data['diff'] = $difference;
					$data['mobile'] = $request->input('email');

					$mobileNumber = $request->input('email');
					if($difference < 15 && $userForMobile->mobile_otp_attempt < 3){
						// send old otp n increment the attempt
						$mobile_otp_attemptInc = $userForMobile->mobile_otp_attempt + 1;
						User::where('mobile', '=', $request->input('email'))->update(['mobile_otp_attempt' => $mobile_otp_attemptInc]);

						$data['mobile_verify'] = 0;
						$data['valid'] = 1;
			    		$data['message'] = 'Mobile number not yet verified. Please check your mobile for OTP.';

			    		$smsMsg = "Thank you for registering Jobtip.in Your One Time Password (OTP) is ".$userForMobile->mobile_otp.". TnC applied. Visit www.jobtip.in";
			    		$data['delvStatus'] = SMS::send($mobileNumber, $smsMsg);

					}else if($difference >= 15 && $userForMobile->mobile_otp_attempt < 3){
						// regenerate otp, update otp, reset attempt n mobile_otp_expiry
						$otp = rand(1111,9999);
						$new_mobile_otp_expiry = \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'))->addMinutes(15);
						User::where('mobile', '=', $request->input('email'))->update(['mobile_otp' => $otp,'mobile_otp_attempt' => 0, 'mobile_otp_expiry' => $new_mobile_otp_expiry]);
						// Induser::where('mobile', '=', $request->input('email'))->update(['mobile_otp' => $otp]);

						$data['mobile_verify'] = 0;
						$data['valid'] = 1;
			    		$data['message'] = 'OTP sent to your registered mobile number.';

			    		$smsMsg = "Thank you for registering Jobtip.in Your One Time Password (OTP) is ".$otp.". TnC applied. Visit www.jobtip.in";
			    		$data['delvStatus'] = SMS::send($mobileNumber, $smsMsg);

					}else if($userForMobile->mobile_otp_attempt == 3){
						if($difference >= 30){
							User::where('mobile', '=', $request->input('email'))->update(['mobile_otp_attempt' => 0]);
						}
						$data['mobile_verify'] = 0;
						$data['valid'] = 1;
			    		$data['message'] = 'You have reached to maximum limit. Try after sometime.';
					}
	    		}else{
	    			$data['valid'] = 0;
	    		}
	    	}
	    }

    	/*if($field == 'email'){
    		 $credentials = array_add($credentials, 'email_verify', '1');
    	}elseif($field == 'mobile'){
    		 $credentials = array_add($credentials, 'mobile_verify', '1');
    	}*/
		if($request->ajax()){
			$everify = 0;
			$mverify = 0;
			if( array_key_exists ( 'email_verify' , $data) ){
				$everify = $data['email_verify'];
			}
			if( array_key_exists ( 'mobile_verify' , $data) ){
				$mverify = $data['mobile_verify'];
			}
			if(($data['page'] == 'home') && ($everify == 1 || $mverify == 1) && $data['valid'] == 1){
				if ($this->auth->attempt($credentials)){
			        $data['message'] = 'login success';
			        return response()->json(['success'=>true,'data'=>$data]);
			    }
			    else{
			    	$data['page'] = 'login';
			    	$data['user'] = 'valid';
	    			$data['message'] = 'Email or Password is incorrect';
			    }
			}else if($data['valid'] == 0){
		    	$data['page'] = 'login';
		    	$data['user'] = 'invalid';
    			$data['message'] = 'invalid login info';
		    }else{
		    	$data['page'] = 'login';
		    }

		    return response()->json(['success'=>false,'data'=>$data]);
		}
		/*else{
			if ($this->auth->attempt($credentials)){
		        return redirect()->intended($this->redirectPath());
		    }
		    return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
		}*/

    	$this->validate($request, [
			'email' => 'required', 'password' => 'required',
		]);

	}


}
