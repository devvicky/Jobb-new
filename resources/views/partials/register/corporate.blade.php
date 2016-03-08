<!-- BEGIN CORPORATE REGISTER FORM -->
<form class="register-corporate-form" action="/corporate/store" method="post" id="corporate-register">
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
			<input type="text" name="firm_name" class="form-control login-input-bg-color" 
					placeholder="Company Name" value="{{ old('cname') }}">
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
				<input type="email" name="firm_email_id" class="form-control login-input-bg-color" 
						placeholder="Email Id" value="{{ old('email') }}">
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
				<input type="password" name="firm_password" id="com_reg_password" 
						class="form-control login-input-bg-color" placeholder="Password">
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
				<input type="password" name="firm_password_confirmation" 
						class="form-control login-input-bg-color" 
						placeholder="Re-Type Password">
			</div>
		</div>
	</div>

	<div class="form-group" style="margin-bottom:45px;" >
		<label class="control-label register-firmtype-css">Firm Type</label>
		<div class="col-md-12">
			<div class="md-radio-inline" style="float: none;margin: 0 auto;display: table;">
				<div class="md-radio" >
					<input type="radio" id="radio6" name="firm_type" value="company" 
							class="md-radiobtn">
					<label for="radio6" 
							style="font-weight:500 !important;font-size:13px;color: #31708f;">
						<span></span>
						<span class="check" style="background: #565656;"></span>
						<span class="box" style="border: 2px solid #8DE8BA !important;"></span>
						Company 
					</label>
				</div>
				
				<div class="md-radio" >
					<input type="radio" id="radio7" name="firm_type" value="consultancy" class="md-radiobtn" >
					<label for="radio7" style="font-weight:500 !important;font-size:13px;color: #31708f;">
						<span></span>
						<span class="check" style="background: #565656;"></span>
						<span class="box" style="border: 2px solid #8DE8BA !important;"></span>
						Consultancy 
					</label>
				</div>
				<div id="radio_error"></div>
			</div>
		</div>

	</div>

	<div class="form-group">
		<label style="font-size: 13px;color: #827E7E !important;">
			<input type="checkbox" checked name="ctnc"/> I agree to the 
			<a href="/termcondition" target="_blank" style="">Terms of Service </a>& 
			<a href="/privacyprolicy" target="_blank" style="">Privacy Policy </a>
		</label>
		<div id="register_ctnc_error"></div>
	</div>	

	<!-- 
	<div class="form-actions" style="border-bottom:0 !important;">
		<label id="register-back-btn3" style="margin-left: 39px;cursor: pointer;">Back</label>
		<button type="submit" id="corporate-register-btn" class="btn btn-default pull-left submit-login-button register-submit-css">
		Submit
		</button>
	</div> 
	-->

	<div class="form-actions" style="border-bottom: 0 !important;">
		<label id="register-back-btn3" 
				style="position: absolute; right: 36px;bottom: 36px; font-weight:400;color:#7B7B7B;cursor: pointer;font-size:15px;">
			Back
		</label>

        <button id="corporate-register-btn" type="submit" 
        		class="btn btn-primary btn-block uppercase login-signup-button" 
        		style="width:50%;background-color:#C76B6B !important;border-radius:2px;">
            Submit
        </button>
    </div> 

</form>
<!-- END CORPORATE REGISTER FORM -->