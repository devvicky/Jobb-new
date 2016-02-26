<!-- BEGIN INDIVIDUAL REGISTER FORM -->
<div style="text-align: center; margin: 5px;">
	<small style="font-size:14px;color: #D8DCDC;">One click register with</small>
</div>

<div class="login-options" >
	<div class="row social">
		<div class="col-md-4 col-xs-4 " style="padding-right:2px;">
			<a class="btn btn-lg btn-facebook btn-block" href="{!!URL::to('facebook')!!}" 
			   style="background: #3b5998;color: white;border-radius:2px;">
				<i class="fa fa-facebook "></i>
				<span class="hidden-xs">&nbsp;Facebook</span>
			</a>
		</div>
		
		<div class="col-md-4 col-xs-4 " style="padding-left:2px;padding-right:0px;">
			<a class="btn btn-lg btn-google btn-block" href="{!!URL::to('google')!!}" 
			style="background: #c32f10;color: white;border-radius:2px;">
				<i class="fa fa-google-plus"></i>
				<span class="hidden-xs">&nbsp;Google+</span>
			</a>
		</div>
		<div class="col-md-4 col-xs-4 " style="padding-left:2px;">
			<a class="btn btn-lg btn-linkedin btn-block" href="{!!URL::to('linkedin')!!}" 
				style="background: #00aced;color: white;border-radius:2px;">
				<i class="fa fa fa-linkedin"></i>
				<span class="hidden-xs">&nbsp;Linkedin</span>
			</a>
		</div>
	</div>
</div>

<div style="text-align: center; margin-bottom: 5px;">
	<small style="font-size:12px;color: #D8DCDC;">
		We respect your privacy, we will not post or disclose any information without your permission.
	</small>
</div>

<h2 class="decorated" style="margin: 10px 10px 8px 10px;color: #A0AFB3;">
	<span style="font-size: 12px;">OR</span>
</h2>

<form class="register-form"  action="{{ url('/individual/store') }}" method="post" id="individual-register">
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

	<div id="ind-reg-form-errors" style="display:none"></div>
									
	<div class="form-group">
		<div class="input-group form-group-login-new" style="margin-top: 27px !important;">
			<span class="input-group-addon input-group-addon-new login-input-bg-color">
				<i class="glyphicon glyphicon-font"></i>
			</span>	
			<div class="input-icon right">
				<i class="fa"></i>			
				<input type="text" id="name" name="fullname" class="form-control login-input-bg-color" 
					   placeholder="Full Name" value="{{ old('fullname') }}">
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
			
				<input type="email" id="email_address" name="email" class="send form-control group login-input-bg-color" 
						placeholder="Email Id" value="{{ old('email') }}" />
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
			<input type="text" id="mobile_no" name="mobile" maxlength="10" 
					class="form-control group login-input-bg-color send" placeholder="Mobile No" 
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
				<input type="password" id="register_password" name="password" 
					   class="form-control login-input-bg-color" placeholder="Password">
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
				<input type="password" name="password_confirmation" class="form-control login-input-bg-color" 
				   placeholder="Re-Type Password">
			</div>
		</div>
	</div>														
	<div class="form-group margin-top-20 margin-bottom-20">
		<label style="font-size: 13px;color: #D2C9C9 !important;">
			<input type="checkbox" id="t-n-c" name="tnc"/> I agree to the 
			<a href="/login/termcondition" target="_blank" style="">Terms of Service </a>& 
			<a href="/login/privacyprolicy" target="_blank" style="">Privacy Policy </a>
		</label>
		<div id="register_tnc_error"></div>
	</div>									
	<div class="form-actions" style="border-bottom: 0 !important;">
		<label id="register-back-btn" 
			   style="position: absolute; right: 36px;bottom: 12px; font-weight:400;color:lightgrey;cursor: pointer;font-size:15px;">
			Back
		</label>
	    <button id="individual-register-btn" type="submit" class="btn btn-primary btn-block uppercase" 
	    		style="width:50%;background-color:#C76B6B !important;box-shadow: 0px 1px 4px #2D2C2C;border-radius:2px;">
	        Submit
	    </button>
	</div> 
</form>
<!-- END INDIVIDUAL REGISTER FORM -->