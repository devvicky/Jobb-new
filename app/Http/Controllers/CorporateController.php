<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use Image;
use App\Corpuser;
use App\User;
use App\Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateCorpRequest;
use App\Http\Requests\CreateImgUploadRequest;
use Mail;
use ReCaptcha\ReCaptcha;

class CorporateController extends Controller {

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
		$title = 'profile';
		$user = Corpuser::where('id', '=', Auth::user()->corpuser_id)->first();
		$skills = Skills::lists('name', 'name');
		return view('pages.firm_details', compact('user', 'title', 'skills'));
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
	public function store(CreateCorpRequest $request)
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
			try{
				$corpUser = new Corpuser();
				$corpUser->firm_name = $request['firm_name'];
				$corpUser->firm_email_id = $request['firm_email_id'];
				$corpUser->firm_type = $request['firm_type'];
				if($request['firm_email_id'] != null){
					$vcode = 'C'.rand(1111,9999);
					$corpUser->email_vcode = $vcode;
				}
				$corpUser->save();

				$user = new User();
				$user->name = $request['firm_name'];
				$user->email = $request['firm_email_id'];
				$user->password = bcrypt($request['firm_password']);
				$user->identifier = 2;
				if($request['firm_email_id'] != null){
					// $vcode = 'C'.rand(1111,9999);
					$user->email_vcode = $vcode;
				}

				$corpUser->user()->save($user);
			}catch(\Exception $e)
			{
			   DB::rollback();
			   throw $e;
			}

			DB::commit();
			$data = array();
			if($request['firm_email_id'] != null){
				$firm_email_id = $request['firm_email_id'];
				$fname = $request['firm_name'];
				$vcode = Corpuser::where('firm_email_id', '=', $request['firm_email_id'])->pluck('email_vcode');
				Mail::send('emails.welcome', array('fname'=>$fname, 'vcode'=>$vcode), function($message) use ($firm_email_id,$fname){
			        $message->to($firm_email_id, $fname)->subject('Welcome to Jobtip!')->from('admin@jobtip.in', 'JobTip');
			    });
			    $data['vcode'] = $vcode;
			}
			$data['page'] = 'login';
			return response()->json(['success'=>true,'data'=>$data]);

		}else{
			DB::beginTransaction();
			try{
				$corpUser = new Corpuser();
				$corpUser->firm_name = $request['firm_name'];
				$corpUser->firm_email_id = $request['firm_email_id'];
				$corpUser->firm_type = $request['firm_type'];
				if($request['firm_email_id'] != null){
						$vcode = 'C'.rand(1111,9999);
						$corpUser->email_vcode = $vcode;
					}
				$corpUser->save();

				$user = new User();
				$user->name = $request['firm_name'];
				$user->email = $request['firm_email_id'];
				$user->password = bcrypt($request['firm_password']);
				$user->identifier = 2;

				$corpUser->user()->save($user);
			}catch(\Exception $e)
			{
			   DB::rollback();
			   throw $e;
			}

			DB::commit();
			if($request['firm_email_id'] != null){
					$email = $request['firm_email_id'];
					$firm_name = $request['firm_name'];
					$vcode = Corpuser::where('firm_email_id', '=', $request['firm_email_id'])->pluck('email_vcode');
					Mail::send('emails.welcome', array('firm_name'=>$firm_name, 'vcode'=>$vcode), function($message) use ($email,$firm_name){
				        $message->to($email, $firm_name)->subject('Welcome to Jobtip!')->from('admin@jobtip.in', 'JobTip');
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
		$data = Corpuser::where('id', '=', $id)->first();
		if($data != null){
		$data->username = Input::get('username');
		$data->working_as = Input::get('working_as');
		$data->save();
		return redirect('/corporate/edit');
		}else{
			return 'some error occured.'+Input::get('email');
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
		$data = Corpuser::where('id', '=', Auth::user()->corpuser_id)->first();
		if($data != null){
			$data->about_firm = Input::get('about_firm');
			$data->industry = Input::get('industry');
			$data->operating_since = Input::get('operating_since');
			$data->firm_name = Input::get('firm_name');
			$data->firm_type = Input::get('firm_type');
			$data->website_url = Input::get('website_url');
			if(Input::get('linked_skill_id') != null){
				$data->linked_skill = implode(', ', Input::get('linked_skill_id'));
			}
			$data->emp_count = Input::get('emp_count');
			$data->slogan = Input::get('slogan');
			$data->firm_address = Input::get('firm_address');
			$data->city = Input::get('city');
			$data->save();
			return redirect('/corporate/edit');
		}
	}

	public function imgUpload(){
		if(Input::file('profile_pic')->isValid()) {
			$oldProfilePic = Corpuser::where('id', '=', Auth::user()->corpuser_id)->pluck('logo_status');
			$destinationPath = 'img/profile/';
			$extension = Input::file('profile_pic')->getClientOriginalExtension();
			$fileName = rand(11111,99999).'.'.$extension;
			$path = $destinationPath.$fileName;
			Input::file('profile_pic')->move($destinationPath, $fileName);
			Image::make($path)->resize(200, 200)->save($path);
			Corpuser::where('id', '=', Auth::user()->corpuser_id)->update(['logo_status' => $fileName]);

			if($oldProfilePic != null){
				\File::delete($destinationPath.$oldProfilePic);
			}

			return redirect('/home');
	    }
	}

	public function privacyUpdate($id)
	{
		$data = Corpuser::where('id', '=', $id)->first();
		if($data != null){
			$data->email_show = Input::get('email_show');
			$data->phone_show = Input::get('phone_show');
			$data->save();
			return redirect('/profile/corp/'.$id);
		}else{
			return 'some error occured.';
		}
	}

	public function firmUpdate(Request $request){
		$firmupdate = Corpuser::where('id', '=', $request['userid'])->first();

		if($firmupdate != null){
			$firmupdate->firm_name = $request['firm_name'];
			$firmupdate->slogan = $request['slogan'];
			$firmupdate->about_firm = $request['about_firm'];
			$firmupdate->firm_type = $request['firm_type'];
			$firmupdate->operating_since = $request['operating_since'];
			$firmupdate->save();

			return response()->json(['success'=>'success']);
		}else{
			return response()->json(['success'=>'fail']);
		}
	}

	public function otherUpdate(Request $request){
		$otherupdate = Corpuser::where('id', '=', $request['userid'])->first();

		if($otherupdate != null){
			$otherupdate->industry = $request['industry'];
			$otherupdate->emp_count = $request['emp_count'];
			if($request['linked_skill'] != null){
				$otherupdate->linked_skill = implode(', ', $request['linked_skill']);
			}
			$otherupdate->website_url = $request['website_url'];
			$otherupdate->save();

			return response()->json(['success'=>'success']);
		}else{
			return response()->json(['success'=>'fail']);
		}
	}

	public function addresscorporateUpdate(Request $request){
		$addressupdate = Corpuser::where('id', '=', $request['userid'])->first();

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
}
