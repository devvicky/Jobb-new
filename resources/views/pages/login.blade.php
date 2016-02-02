

@extends('login')

@section('content')

<!-- BEGIN LOGIN -->
<div class="content" style="background-color: transparent !important;padding:0;">
	<!-- <h3 class="form-title" style="text-shadow: 0px 1px 1px blue;color: khaki;font-size: 18px;margin-bottom:0px;">Login As</h3> -->
<div class="portlet box blue col-md-12 login-tag" style="margin-top:0;border:0;background-color: transparent !important;margin: 10px auto;float: none;padding:0;">
	<div class="portlet-title portlet-title-login" style="float:none;margin:0 auto; display:table;background-color: transparent !important;padding: 0;">
		<ul class="nav nav-tabs" style="padding:0;">
			<li class="active home-tab-width-job" >
				<a href="#people" data-toggle="tab" class="job-skill-tab">
				<i class="icon-user" style=""></i> PEOPLE </a>
			</li>
			<li class="home-tab-width-skill">
				<a href="#company" data-toggle="tab" class="job-skill-tab">
				<i class="fa fa-university" style=""></i> COMPANY </a>
			</li>
		</ul>
	</div>
	<div class="portlet-body" style="background-color:transparent !important;margin:10px 0;">
		<div class="tab-content">
			<div class="tab-pane active" id="people">
				<form class="login-form"  action="{{ url('/auth/login') }}" method="post" id="individual-login">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					@if ( Session::has('flash_message') ) 
					  <div class="alert {{ Session::get('flash_type') }}">
					      <ul><li>{{ Session::get('flash_message') }}</li></ul>
					  </div>				  
					@endif

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					

					<div id="ind-msg-box" style="display:none">
						<div id="ind-msg"></div>
					</div>

					<div class="form-group ">
						<div class="input-group margin-top-10 form-group-login-new">
								<span class="input-group-addon input-group-addon-new login-input-bg-color"><i class="icon-envelope"></i></span>
						<div class="input-icon right ">
							<i class="fa"></i>
								
								<input type="text" name="email" class="form-control login-input-bg-color" value="{{ old('email') }}" placeholder="Email Id or Mobile No" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="form-group ">
						<div class="input-group margin-top-15 form-group-login-new">
								<span class="input-group-addon input-group-addon-new login-input-bg-color"><i class="icon-lock-open"></i></span>
						<div class="input-icon right ">
							<i class="fa"></i>
							
								<input type="password" name="password" class="form-control login-input-bg-color" placeholder="Password">
							</div>
						</div>
					</div>	
					<div class="form-actions" style="border-bottom: 0 !important;">
	                    <button id="individual-login-btn" type="submit" class="btn btn-primary btn-block uppercase" style="width:50%;background-color:#C76B6B !important;box-shadow: 0px 1px 4px #2D2C2C;border-radius:2px;">
	                        Login
	                    </button>
	                </div>                                      
	                <div class="form-actions" style="border-bottom: 0px;margin: -53px -30px 15px;">                                                             
	                    <a href="javascript:;" id="forget-password" class="forget-password" style="font-size: 13px;color: #D2D6DA !important;text-decoration: initial;">Forgot Password ?
	                    </a>
	                </div>									
				</form>
				<h2 class="decorated" style="margin: 0px 10px 8px 10px;color: #A0AFB3;">
					<span style="font-size: 12px;">OR</span>
				</h2>
				<!-- <div style="text-align: center; margin-bottom: 5px;">
					<small style="font-size:14px;color: azure;">One click Login using</small>
				</div> -->
				<div class="login-options" style="margin: 20px 0px;">
						<div class="row social">
							<div class="col-md-4 col-xs-4 " style="padding-right:2px;">
								<a class="btn btn-lg btn-facebook btn-block" href="{!!URL::to('facebook')!!}" style="background: #3b5998;color: white;border-radius:2px;">
									<i class="fa fa-facebook "></i><span class="hidden-xs">&nbsp;Facebook</span>
								</a>
							</div>
							
							<div class="col-md-4 col-xs-4 " style="padding-left:2px;padding-right:0px;">
								<a class="btn btn-lg btn-google btn-block" href="{!!URL::to('google')!!}" style="background: #c32f10;color: white;border-radius:2px;">
									<i class="fa fa-google-plus"></i><span class="hidden-xs">&nbsp;Google+</span>
								</a>
							</div>
							<div class="col-md-4 col-xs-4 " style="padding-left:2px;">
								<a class="btn btn-lg btn-linkedin btn-block" href="{!!URL::to('linkedin')!!}" style="background: #00aced;color: white;border-radius:2px;">
									<i class="fa fa fa-linkedin"></i><span class="hidden-xs">&nbsp;Linkedin</span>
								</a>
							</div>
						</div>
					</div>
							
			<div class="create-account" style="margin-top: 20px;background-color: rgb(57, 92, 101);" >
				<p style="color:#D0D0D0;">
					Not A Member?&nbsp;&nbsp;<a href="javascript:;" id="register-btn" class="uppercase" style="color: floralwhite;font-size: 15px;font-weight: 600;"> Register Now&nbsp;!</a> 
				</p>
			</div>
			</div>
			<div class="tab-pane" id="company">
				<form class="login-form-corp"  action="{{ url('/auth/login') }}" method="post" id="corporate-login">
					<div class="form-body">
						
						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						<!-- <div id="corp-msg-box" style="display:none">
							<div id="corp-msg"></div>
						</div> -->
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<div class="input-group margin-top-10 form-group-login-new ">
									<span class="input-group-addon input-group-addon-new login-input-bg-color"><i class="icon-envelope"></i></span>	
							<div class="input-icon right">
								<i class="fa"></i>
								
									<input type="email" name="email" class="form-control login-input-bg-color" value="{{ old('email') }}" placeholder="Email Id" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group margin-top-10 form-group-login-new">
									<span class="input-group-addon input-group-addon-new login-input-bg-color"><i class="icon-lock-open"></i></span>
							<div class="input-icon right">
								<i class="fa"></i>
								
									<input type="password" name="password" class="form-control login-input-bg-color" placeholder="Password">
								</div>
							</div>
						</div> 
						<div class="form-actions" style="border-bottom: 0 !important;">
		                    <button id="corporate-login-btn" type="submit" class="btn btn-primary btn-block uppercase" style="width:50%;background-color:#C76B6B !important;box-shadow: 0px 1px 4px #2D2C2C;border-radius:2px;">
		                        Login
		                    </button>
		                </div>                                      
		                <div class="form-actions" style="border-bottom: 0px;margin: -53px -30px 15px;">                                                             
		                    <a href="javascript:;" id="forget-password-corp" class="forget-password " style="font-size: 13px;color: #D2D6DA !important;text-decoration: initial;">Forgot Password ?
		                    </a>
		                </div>							
						<div class="create-account" style="margin-top: 20px;background-color: rgb(57, 92, 101);">
							<p style="color:#D0D0D0;">
								Not A Member?&nbsp;&nbsp;<a href="javascript:;" id="register-btn-corp" class="uppercase" style="color: floralwhite;font-size: 15px;font-weight: 600;"> Register Now&nbsp;!</a> 
							</p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="portlet box blue col-md-12 corporate-register-tab" style="margin-top:0;border:0;background: transparent !important;margin: 30px auto;float: none;padding:0;">
	<div class="portlet-title portlet-title-login" style="float:none;margin:0 auto; display:table;background: transparent !important;padding: 0;">
		<ul class="nav nav-tabs" style="padding:0;">
			<li class="active home-tab-width-job" >
				<a href="#people-reg" data-toggle="tab" class="job-skill-tab">
				<i class="icon-user" style=""></i> People </a>
			</li>
			<li class="home-tab-width-skill">
				<a href="#company-reg" data-toggle="tab" class="job-skill-tab">
				<i class="fa fa-university" style=""></i> Company </a>
			</li>
		</ul>
	</div>
	<div class="portlet-body" style="background-color:transparent !important;">
		<div class="tab-content">
			<div class="tab-pane active" id="people-reg">
					<div style="text-align: center; margin: 5px;">
						<small style="font-size:14px;color: #D8DCDC;">One click register with</small>
					</div>
					<div class="login-options" >
						<div class="row social">
							<div class="col-md-4 col-xs-4 " style="padding-right:2px;">
								<a class="btn btn-lg btn-facebook btn-block" href="{!!URL::to('facebook')!!}" style="background: #3b5998;color: white;border-radius:2px;">
									<i class="fa fa-facebook "></i><span class="hidden-xs">&nbsp;Facebook</span>
								</a>
							</div>
							
							<div class="col-md-4 col-xs-4 " style="padding-left:2px;padding-right:0px;">
								<a class="btn btn-lg btn-google btn-block" href="{!!URL::to('google')!!}" style="background: #c32f10;color: white;border-radius:2px;">
									<i class="fa fa-google-plus"></i><span class="hidden-xs">&nbsp;Google+</span>
								</a>
							</div>
							<div class="col-md-4 col-xs-4 " style="padding-left:2px;">
								<a class="btn btn-lg btn-linkedin btn-block" href="{!!URL::to('linkedin')!!}" style="background: #00aced;color: white;border-radius:2px;">
									<i class="fa fa fa-linkedin"></i><span class="hidden-xs">&nbsp;Linkedin</span>
								</a>
							</div>
						</div>
					</div>
					<div style="text-align: center; margin-bottom: 5px;">
						<small style="font-size:12px;color: #D8DCDC;">We respect your privacy, we will not post or disclose any information without your permission.</small>
					</div>
					<h2 class="decorated" style="margin: 10px 10px 8px 10px;color: #A0AFB3;">
						<span style="font-size: 12px;">OR</span>
					</h2>
					<form class="register-form"  action="{{ url('/individual/store') }}" method="post" id="individual-register">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<!-- id="individual-register" -->
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<div id="ind-reg-form-errors" style="display:none"></div>
													
					<div class="form-group">
						<div class="input-group form-group-login-new" style="margin-top: 27px !important;">
								<span class="input-group-addon input-group-addon-new login-input-bg-color">
									<i class="glyphicon glyphicon-font"></i>
								</span>	
						<div class="input-icon right">
							<i class="fa"></i>
							
								<input type="text" id="name" name="fullname" class="form-control login-input-bg-color" placeholder="Full Name" value="{{ old('fullname') }}">
								<input type="hidden"  name="fname" id="first_name" class="form-control">
								<input type="hidden"  name="lname" id="last_name" class="form-control">
							</div>
						</div>
					</div>
				
					
					
							
					<div class="form-group">
						<div class="input-group margin-top-10 form-group-login-new">
								<span class="input-group-addon input-group-addon-new login-input-bg-color">
									<i class="icon-envelope"></i>
								</span>	
						<div class="input-icon right">
							<i class="fa"></i>
							
								<input type="email" id="email_address" name="email" class="form-control group login-input-bg-color" placeholder="Email Id" value="{{ old('email') }}" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group margin-top-10 form-group-login-new">
								<span class="input-group-addon input-group-addon-new login-input-bg-color">
									<i class="icon-call-end"></i>
								</span>
						<div class="input-icon right">
							<i class="fa"></i>
							
								<input type="text" id="mobile_no" name="mobile" maxlength="10" class="form-control group login-input-bg-color" placeholder="Mobile No" 
										value="{{ old('mobile') }}"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group margin-top-15 form-group-login-new">
								<span class="input-group-addon input-group-addon-new login-input-bg-color">
									<i class="icon-lock-open"></i>
								</span>
						<div class="input-icon right">
							<i class="fa"></i>
							
								<input type="password" id="register_password" name="password" class="form-control login-input-bg-color" placeholder="Password">
							</div>
						</div>
					</div>			
					<div class="form-group">
						<div class="input-group margin-top-15 form-group-login-new">
								<span class="input-group-addon input-group-addon-new login-input-bg-color">
									<i class="icon-lock-open"></i>
								</span>
						<div class="input-icon right">
							<i class="fa"></i>
							
								<input type="password" name="password_confirmation" class="form-control login-input-bg-color" placeholder="Re-Type Password">
							</div>
						</div>
					</div>														
					<div class="form-group margin-top-20 margin-bottom-20">
						<label style="font-size: 13px;color: #D2C9C9 !important;">
							<input type="checkbox" id="t-n-c" name="tnc"/> I agree to the 
							<a href="/login/termcondition" style="">Terms of Service </a>& 
							<a href="/login/privacyprolicy" style="">Privacy Policy </a>
						</label>
						<div id="register_tnc_error"></div>
					</div>									
					<!-- <div class="form-actions">
						<label id="register-back-btn" style="margin-left: 39px; font-weight:400;color:lightgrey;cursor: pointer;font-size:15px;">Back</label>
						<button type="submit" id="individual-register-btn" class="btn btn-default pull-left submit-login-button register-submit-css">
						Submit
						</button>


					</div> -->
					<div class="form-actions" style="border-bottom: 0 !important;">
						<label id="register-back-btn" style="position: absolute; right: 36px;bottom: 12px; font-weight:400;color:lightgrey;cursor: pointer;font-size:15px;">Back</label>
	                    <button id="individual-register-btn" type="submit" class="btn btn-primary btn-block uppercase" style="width:50%;background-color:#C76B6B !important;box-shadow: 0px 1px 4px #2D2C2C;border-radius:2px;">
	                        Submit
	                    </button>
	                </div> 
				</form>
				<!-- END INDIVIDUAL REGISTRATION FORM -->
			</div>
			<div class="tab-pane" id="company-reg">
				<form class="register-corporate-form" action="{{ url('/corporate/store') }}" method="post" id="corporate-register">
					<!-- id="corporate-register" -->
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<div id="corp-reg-form-errors" style="display:none"></div>
					<div id="corp-msg-reg-box" style="display:none">
						<div id="corp-reg-msg"></div>
					</div>
					<div class="form-group">
						<div class="input-group margin-top-15 form-group-login-new">
								<span class="input-group-addon input-group-addon-new login-input-bg-color">
								<i class="fa fa-university"></i>
								</span>
						<div class="input-icon right">
							<i class="fa"></i>
								<input type="text" name="firm_name" class="form-control login-input-bg-color" placeholder="Company Name" value="{{ old('cname') }}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group margin-top-15 form-group-login-new">
								<span class="input-group-addon input-group-addon-new login-input-bg-color">
								<i class="icon-envelope"></i>
								</span>
						<div class="input-icon right">
							<i class="fa"></i>
							
								<input type="email" name="firm_email_id" class="form-control login-input-bg-color" placeholder="Email Id" value="{{ old('email') }}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group margin-top-15 form-group-login-new">
								<span class="input-group-addon input-group-addon-new login-input-bg-color">
								<i class="icon-lock-open"></i>
								</span>
						<div class="input-icon right">
							<i class="fa"></i>
							
								<input type="password" name="firm_password" id="com_reg_password" class="form-control login-input-bg-color" placeholder="Password">
							</div>
						</div>
					</div>
					<div class="form-group" style="margin-bottom:15px;">
						<div class="input-group margin-top-15 form-group-login-new">
								<span class="input-group-addon input-group-addon-new login-input-bg-color">
								<i class="icon-lock-open"></i>
								</span>
						<div class="input-icon right">
							<i class="fa"></i>
							
								<input type="password" name="firm_password_confirmation" class="form-control login-input-bg-color" placeholder="Re-Type Password">
							</div>
						</div>
					</div>
					<div class="form-group" style="margin-bottom:15px;" >
						<!-- <div class="col-md-4"></div> -->
						<label class="control-label register-firmtype-css">Firm Type</label>
						<div class="col-md-12">
							<div class="md-radio-inline" style="float: none;margin: 0 auto;display: table;">
								<div class="md-radio" >
									<input type="radio" id="radio6" name="firm_type" value="company" class="md-radiobtn">
									<label for="radio6" style="font-weight:500 !important;font-size:13px;color: antiquewhite;">
									<span></span>
									<span class="check" style="background: #F1F1F1;"></span>
									<span class="box" style="border: 2px solid #8DE8BA !important;"></span>
									Company </label>
								</div>
								<div class="md-radio" >
									<input type="radio" id="radio7" name="firm_type" value="consultancy" class="md-radiobtn" >
									<label for="radio7" style="font-weight:500 !important;font-size:13px;color: antiquewhite;">
									<span></span>
									<span class="check" style="background: #F1F1F1;"></span>
									<span class="box" style="border: 2px solid #8DE8BA !important;"></span>
									Consultancy </label>
								</div>
							</div>						<!-- /input-group -->
						</div>
					</div>
					<div class="form-group margin-top-20 margin-bottom-20">
						<label style="font-size: 13px;color: #D2C9C9 !important;">
							<input type="checkbox" name="ctnc"/> I agree to the 
							<a href="/login/termcondition" style="">Terms of Service </a>& 
							<a href="/login/privacyprolicy" style="">Privacy Policy </a>
						</label>
						<div id="register_tnc_error"></div>
					</div>									
					<!-- <div class="form-actions" style="border-bottom:0 !important;">
						<label id="register-back-btn3" style="margin-left: 39px;cursor: pointer;">Back</label>
						<button type="submit" id="corporate-register-btn" class="btn btn-default pull-left submit-login-button register-submit-css">
						Submit
						</button>
					</div> -->
					<div class="form-actions" style="border-bottom: 0 !important;">
						<label id="register-back-btn3" style="position: absolute; right: 36px;bottom: 36px; font-weight:400;color:lightgrey;cursor: pointer;font-size:15px;">Back</label>
	                    <button id="corporate-register-btn" type="submit" class="btn btn-primary btn-block uppercase" style="width:50%;background-color:#C76B6B !important;box-shadow: 0px 1px 4px #2D2C2C;border-radius:2px;">
	                        Submit
	                    </button>
	                </div> 
				</form>
			</div>
		</div>
	</div>
</div>


<!-- BEGIN FORGOT PASSWORD FORM -->
<form class="forget-form" action="/forget" method="post" id="forgot-password">
	<h3 style="    margin-bottom: 10px;color:khaki;font-size: 20px;text-shadow: 0px 1px 1px blue;">Forgot Password ?</h3>
	<p style="text-align: center;font-size: 17px;color: yellow;margin-bottom: 20px;">No Worries&nbsp;<i class="icon-emoticon-smile"></i></p>
	<p style="text-align: center;font-size: 13px;    color: #F3D5D5;">
		 Enter your E-mail iD or Mobile No. We will send you a link to reset password.
	</p>
	@if ( Session::has('flash_message') ) 
	  <div class="alert {{ Session::get('flash_type') }}">
	     <ul><li>{{ Session::get('flash_message') }}</li></ul>
	  </div>	  
	@endif
	<div id="forget-box" style="display:none">
		<div id="forget-box-msg"></div>
	</div>
	<div class="form-group ">
		<div class="input-group margin-top-15 form-group-login-new">
				<span class="input-group-addon input-group-addon-new login-input-bg-color"><i class="icon-envelope"></i></span>
		<div class="input-icon right ">
			<i class="fa"></i>	
				<input type="text" name="forget_email" class="form-control login-input-bg-color" placeholder="Email Id or Mobile No">
			</div>
		</div>
	</div>
	<div class="form-actions" style="border-bottom: 0 !important;">
		<label id="back-btn" style="position: absolute; right: 36px;bottom: 22px; font-weight:400;color:lightgrey;cursor: pointer;font-size:15px;">Back</label>
        <button id="forget-password-btn" type="submit" class="btn btn-primary btn-block uppercase" style="width:50%;background-color:#C76B6B !important;box-shadow: 0px 1px 4px #2D2C2C;border-radius:2px;">
            Submit
        </button>
    </div> 
</form>
<!-- END FORGOT PASSWORD FORM -->
</div>

<!-- BEGIN OTP VERIFICATIO FORM -->
	<form class="otp-verify-form" action="/verify" method="post" id="mobile-otp-form" style="display:none" id="verify-otp">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-2 col-sm-2"></div>
			<div class="col-md-6 col-sm-6">
			<h3 style="margin-bottom: 18px;color:khaki;font-size: 27px;text-shadow: 0px 1px 1px blue;">Email or Mobile Verification</h3>
			<p style="text-align: center;font-size: 15px;">
				 Enter OTP received to verify your mobile.
			</p>
			@if ( Session::has('flash_message') ) 
			  <div class="alert {{ Session::get('flash_type') }}">
			     <ul><li>{{ Session::get('flash_message') }}</li></ul>
			  </div>	  
			@endif
			<div id="ind-msg-reg-box" style="display:none">
				<div id="ind-reg-msg"></div>
			</div>
			<div class="form-group ">
				<div class="input-group margin-top-10 form-group-login-new">
						<span class="input-group-addon input-group-addon-new login-input-bg-color"><i class="icon-envelope"></i></span>
				<div class="input-icon right ">
					<i class="fa"></i>
						<input type="password" name="mobileOTP" class="form-control login-input-bg-color" maxlength="5" placeholder="Enter OTP here"  required>
						
					</div>
				</div>
			</div>
			<div class="form-actions" style="margin-top:25px;border-bottom: none;">			
				 <button type="submit" class="btn btn-primary btn-block uppercase" style="width:50%;background-color:#C76B6B !important;box-shadow: 0px 1px 4px #2D2C2C;border-radius:2px;">
                    Submit <i class="m-icon-swapright"></i>
                </button>
			</div>
		</div>
		</div>
	</form>
	<form id="resend-otp-form" action="/resendOTP" method="post" style="display:none">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="otp_mob" id="otpformob">
		<button type="submit" id="resend-otp-btn" class="btn btn-default pull-right" style="margin-left: 39px;cursor: pointer;color:#C76B6B">Resend OTP</button>
	</form>
	<!-- END OTP VERIFICATIO FORM -->

<div id="loader" style="display:none;z-index:9999;background:white" class="page-loading">
<img src="assets/loader.gif"><span> Please wait...</span>
</div>

@stop



@section('javascript')

<script type="text/javascript">
$(document).ready(function() {
  
  $('#name').blur(function(){
  
    var nameVal = $('#name').val()
    var nameLength = nameVal.length;
    var nameSplit = nameVal.split(" ");
    var lastLength = nameLength - nameSplit[0].length;
    var lastNameLength = nameSplit[0].length + 1;
    var lastName = nameVal.slice(lastNameLength);
    
    $('#first_name').val(nameSplit[0]);
    $('#last_name').val(lastName);
    
    return false;
  });
	
});
</script>

<script type="text/javascript">
function loader(arg){
    if(arg == 'show'){
        $('#loader').show();
    }else{
        $('#loader').hide();
    }
}
function redirect(url){
    window.location = url;
}
$(document).ready(function(){
  $('#individual-login-btn').on('click',function(event){        
    event.preventDefault();

    $("#individual-login").validate();
    if($("#individual-login").valid()){
	    loader('show');

	    var formData = $('#individual-login').serialize(); // form data as string
	    var formAction = $('#individual-login').attr('action'); // form handler url

	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      cache : false,
	      success: function(data){
	        loader('hide');
	        // console.log(data);
	        if(data.data.page == 'login' && data.data.user == 'invalid'){            
	            $('#ind-msg-box').removeClass('alert alert-success');
	            $('#ind-msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#ind-msg').text(data.data.message);
	        }
	        else if(data.data.page == 'login' && data.data.email_verify == 0){
	        	$('#ind-msg-box').removeClass('alert alert-success');
	            $('#ind-msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#ind-msg').text(data.data.message);

	            $('.login-tag').hide();
	            $('#mobile-otp-form').show();
	            $('#ind-reg-msg').html(data.data.message);

	            $('#ind-msg-reg-box').removeClass('alert alert-success');
	            $('#ind-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	        }
	        else if(data.data.page == 'login' && data.data.mobile_verify == 0){
	        	$('#ind-msg-box').removeClass('alert alert-success');
	            $('#ind-msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#ind-msg').text(data.data.message);

	            $('.login-tag').hide();
	            $('#mobile-otp-form').show();

	            $('#resend-otp-form').show();
	        	$('#otpformob').val(data.data.mobile); 

	            $('#ind-reg-msg').html(data.data.message);  
	            $('#ind-msg-reg-box').show();

	            $('#ind-msg-reg-box').removeClass('alert alert-success');
	            $('#ind-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	        }
	        else{          
	            redirect(data.data.page);
	        }
	      },
	      error: function(data) {
	        loader('hide');
	        $('#ind-msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	        });
	        $('#ind-msg').text('Please Check your Email id or Password');
	        // $('#ind-msg-box').hide().fadeOut(7000);
	      }
	    }); 
	}
    return false;
  }); 

$('#corporate-login-btn').on('click',function(event){       
    event.preventDefault();


    $("#corporate-login").validate();
    if($("#corporate-login").valid()){
	    loader('show');

	    var formData = $('#corporate-login').serialize(); // form data as string
	    var formAction = $('#corporate-login').attr('action'); // form handler url

	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      cache : false,
	      success: function(data){
	        loader('hide');
	        if(data == 'login'){
	            $('#corp-msg-box').removeClass('alert alert-success');
	            $('#corp-msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#corp-msg').text('Invalid user');
	        }else{
	            $('#corp-msg-box').removeClass('alert alert-danger');
	            $('#corp-msg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $(this).show();
	            });
	            // $('#corp-msg').text('Login success');
	            redirect(data);
	        }
	      },
	      error: function(data) {
	        loader('hide');
	        $('#corp-msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	        });
	        $('#corp-msg').text('Some error occured !');
	      }
	    }); 
	}
    return false;
  }); 
    
$('#individual-register-btn').on('click',function(event){       
    event.preventDefault();

    $("#individual-register").validate();
    if($("#individual-register").valid()){
	    loader('show');

	    var formData = $('#individual-register').serialize(); // form data as string
	    var formAction = $('#individual-register').attr('action'); // form handler url

	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      cache : false,
	      success: function(data){
	        loader('hide');
	        if(data.data.page == 'login'){
	            $('#ind-msg-reg-box').removeClass('alert alert-danger');
	            $('#ind-msg-reg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#individual-register')[0].reset();
	            $('#t-n-c').attr('checked', false); // Unchecks it

	            if(data.data.otp != null && data.data.vcode != null ){
		            $('.corporate-register-tab').hide();
		            $('#mobile-otp-form').show();
		            $('#ind-reg-msg').html('Registration successful ! <br/>Check your mobile/email for further instruction. <br/>Your otp: <b>'+data.data.otp+'</b> to verify mobile.');  
		            // console.log('both');

		            $('#ind-msg-reg-box').removeClass('alert alert-danger');
		            $('#ind-msg-reg-box').addClass('alert alert-success').fadeIn(1000, function(){
		                $(this).show();
		            });

		        }else if(data.data.vcode != null && data.data.otp == null){
		        	$('.corporate-register-tab').hide();
		            $('#mobile-otp-form').show();
		        	$('#ind-reg-msg').html('Registration successful ! <br/>Check your email for further instruction.');  
		        	// console.log('email');

		        	$('#ind-msg-reg-box').removeClass('alert alert-danger');
		            $('#ind-msg-reg-box').addClass('alert alert-success').fadeIn(1000, function(){
		                $(this).show();
		            });
		        }else if(data.data.otp != null && data.data.vcode == null){
		        	$('.corporate-register-tab').hide();
		            $('#mobile-otp-form').show();
		        	$('#ind-reg-msg').html('Registration successful ! <br/>Check your mobile for further instruction. <br/>	        		Your otp: <b>'+data.data.otp+'</b> to verify mobile.');  
		        	// console.log('mobile');

		        	$('#ind-msg-reg-box').removeClass('alert alert-danger');
		            $('#ind-msg-reg-box').addClass('alert alert-success').fadeIn(1000, function(){
		                $(this).show();
		            });
		        }
	        }else{
	            $('#ind-msg-reg-box').removeClass('alert alert-success');
	            $('#ind-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#ind-reg-msg').text('Some errors occured during Registration!');
	        }
	      },
	      error: function(data) {
	        loader('hide');
		    var errors = data.responseJSON;
		    // console.log(errors);
		    $errorsHtml = '<div class="alert alert-danger"><ul>';
		    $.each(errors, function(index, value) {
				 $errorsHtml += '<li>' + value[0] + '</li>';
		    });
	 		$errorsHtml += '</ul></div>';	            
	        $( '#ind-reg-form-errors' ).html( $errorsHtml );
	        $( '#ind-reg-form-errors' ).show();

	        // $('#ind-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	        //         $(this).show();
	        // });
	        // $('#ind-reg-msg').text('Some error occured !');
	      }
	    }); 
	}
    return false;
  });

$('#corporate-register-btn').on('click',function(event){       
    event.preventDefault();

    $("#corporate-register").validate();
    if($("#corporate-register").valid()){
	    loader('show');

	    var formData = $('#corporate-register').serialize(); // form data as string
	    var formAction = $('#corporate-register').attr('action'); // form handler url

	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      cache : false,
	      success: function(data){
	        loader('hide');
	        if(data.data.page == 'login'){
	            $('#corp-msg-reg-box').removeClass('alert alert-danger');
	            $('#corp-reg-form-errors').hide();
	            $('#corp-msg-reg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#corporate-register')[0].reset();
	            $('#t-n-c').attr('checked', false); // Unchecks it
	            // $('#corporate-register').hide();
	            // $('#corporate-login').show();
	            $('#corp-reg-msg').html('Registration successful ! <br/>Check your Email for further instruction.');  
	        }else{
	            $('#corp-msg-reg-box').removeClass('alert alert-success');
	            $('#corp-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#corp-reg-msg').text('Some errors occured during Registration!');
	        }
	      },
	      error: function(data) {
	        loader('hide');
		    var errors = data.responseJSON;
		    // console.log(errors);
		    $errorsHtml = '<div class="alert alert-danger"><ul>';
		    $.each(errors, function(index, value) {
				 $errorsHtml += '<li>' + value[0] + '</li>';
		    });
	 		$errorsHtml += '</ul></div>';	            
	        $( '#corp-reg-form-errors' ).html( $errorsHtml );
	        $( '#corp-reg-form-errors' ).show();

	        // $('#ind-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	        //         $(this).show();
	        // });
	        // $('#ind-reg-msg').text('Some error occured !');
	      }
	    }); 
	}
    return false;
  });

// $('#corporate-register-btn').on('click',function(event){        
//     event.preventDefault();

//     loader('show');

//     var formData = $('#corporate-register').serialize(); // form data as string
//     var formAction = $('#corporate-register').attr('action'); // form handler url

//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     $.ajax({
//       url: formAction,
//       type: "post",
//       data: formData,
//       cache : false,
//       success: function(data){
//         loader('hide');
//         if(data == 'login'){
//             $('#corp-msg-reg-box').removeClass('alert alert-success');
//             $('#corp-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
//                 $(this).show();
//             });
//             $('#corp-reg-msg').text('Invalid user');
//         }else{
//             $('#corp-msg-reg-box').removeClass('alert alert-danger');
//             $('#corp-msg-reg-box').addClass('alert alert-success').fadeIn(1000, function(){
//                 $(this).show();
//             });
//             $('#corp-reg-msg').text('Registration success');
//             redirect(data);
//         }
//       },
//       error: function(data) {
//         loader('hide');
//         $('#corp-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
//                 $(this).show();
//         });
//         $('#corp-reg-msg').text('Some error occured !');
//       }
//     }); 
//     return false;
//   });
});

$('#forget-password-btn').on('click',function(event){        
    event.preventDefault();

    
    $("#forgot-password").validate();
    if($("#forgot-password").valid()){
    	loader('show');
    var formData = $('#forgot-password').serialize(); // form data as string
    var formAction = $('#forgot-password').attr('action'); // form handler url

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      url: formAction,
      type: "post",
      data: formData,
      cache : false,
      success: function(data){
        loader('hide');
        console.log(data);
        if(data.data.page == 'login' && data.data.error == null){
            $('#forget-box').removeClass('alert alert-danger');
            $('#forget-box').addClass('alert alert-success').fadeIn(1000, function(){
                $(this).show();
            });
            $('#forgot-password')[0].reset();

            if(data.data.medium == 'mobile'){
            	$('#forget-box-msg').html("Click here to reset your password:  <a href='/reset/password/"+data.data.reset_code+"'>click here</a>");
            }else if(data.data.medium == 'email'){
            	$('#forget-box-msg').html(data.data.msg);
            }  
        }else if(data.data.page == 'login' && data.data.error != null){
            $('#forget-box').removeClass('alert alert-success');
            $('#forget-box').addClass('alert alert-danger').fadeIn(1000, function(){
                $(this).show();
            });
            $('#forget-box-msg').text(data.data.error);
        }
      },
      error: function(data) {
        loader('hide');
        $('#forget-box').addClass('alert alert-danger').fadeIn(1000, function(){
                $(this).show();
        });
        $('#forget-box-msg').text('Some error occured !');
      }
    }); 
}
    return false;
  }); 

$('#resend-otp-btn').on('click',function(event){        
    event.preventDefault();

    loader('show');

    var formData = $('#resend-otp-form').serialize(); // form data as string
    var formAction = $('#resend-otp-form').attr('action'); // form handler url

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      url: formAction,
      type: "post",
      data: formData,
      cache : false,
      success: function(data){
        loader('hide');
        // console.log(data);
        if(data.data.page == 'login' && data.data.mobile_verify == 0 && data.data.success_status){        	
            disableOTP();
        	$('#ind-msg-reg-box').removeClass('alert alert-danger');
            $('#ind-reg-msg').html(data.data.message);  
            $('#ind-msg-reg-box').addClass('alert alert-success').fadeIn(1000, function(){
                $(this).show();
            });
        }
        else if(data.data.page == 'login' && data.data.mobile_verify == 0 && !data.data.success_status){
        	$('#ind-msg-reg-box').removeClass('alert alert-success');           
            $('#ind-reg-msg').html(data.data.message);   
            $('#ind-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
                $(this).show();
            });
        }
      },
      error: function(data) {
        loader('hide');
        $('#ind-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
                $(this).show();
        });
        $('#ind-reg-msg').text('Some error occured !');
      }
    }); 
    return false;
}); 

$('#individual-login').bind('keydown', function(e){         
    if (e.which == 13){
       $('#individual-login-btn').trigger('click'); 
       return false;  
   }     
});

$('#corporate-login').bind('keydown', function(e){         
    if (e.which == 13){
       $('#corporate-login-btn').trigger('click'); 
       return false;  
   }
});

$('#forgot-password').bind('keydown', function(e){         
    if (e.which == 13){
       $('#forgot-password-btn').trigger('click'); 
       return false;  
   }     
});

</script>
<script type="text/javascript">
    setTimeout (function(){
    document.getElementById('resend-otp-btn').disabled = null;
    },60000);

    var countdownNum = 60;
    
    function disableOTP(){
    	document.getElementById('resend-otp-btn').disabled = true;
    	incTimer();
    	countdownNum = 60;
    }

    function incTimer(){    	    	
	    setTimeout (function(){
	        if(countdownNum != 0){
		        countdownNum--;
		        document.getElementById('resend-otp-btn').innerHTML = 'Wait for ' + countdownNum + ' seconds';
		        incTimer();
	        } else {
	        	document.getElementById('resend-otp-btn').innerHTML = 'Resend OTP';
	        	document.getElementById('resend-otp-btn').disabled = false;
	        }
	    },1000);
    }
</script>
@stop


