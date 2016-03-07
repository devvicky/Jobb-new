<!-- BEGIN OTP VERIFICATIO FORM -->
<form class="otp-verify-form" action="/verify" method="post" id="mobile-otp-form" 
		style="display:none" id="verify-otp">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="row">
		<div class="col-md-2 col-sm-2"></div>
		<div class="col-md-12 col-sm-6">
			<h3 style="margin-bottom: 18px;color:khaki;font-size: 27px;text-shadow: 0px 1px 1px blue;">
				Email or Mobile Verification
			</h3>

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
					<span class="input-group-addon input-group-addon-new login-input-bg-color">
						<i class="icon-envelope"></i>
					</span>
					<div class="input-icon right ">
						<i class="fa"></i>
						<input type="password" name="mobileOTP" 
								class="form-control login-input-bg-color" 
								maxlength="5" placeholder="Enter OTP here" required>
					</div>
				</div>
			</div>

			<div class="form-actions" style="margin-top:25px;border-bottom: none;">			
				 <button type="submit" class="btn btn-primary btn-block uppercase login-signup-button" 
				 		style="width:50%;background-color:#C76B6B !important;border-radius:2px;">Submit 
				 		<i class="m-icon-swapright"></i>
	            </button>
	            <!-- <a href="/login" class="btn btn-info login">login</a> -->
			</div>

		</div>
	</div>
</form>

<form id="resend-otp-form" action="/resendOTP" method="post" style="display:none">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="otp_mob" id="otpformob">
	<button type="submit" id="resend-otp-btn" class="btn btn-default pull-right" 
			style="margin-left: 39px;cursor: pointer;color: #03C1B1;
				    position: absolute;
				    bottom: 24px;
				    right: 0;">
			Resend OTP
	</button>
</form>
<!-- END OTP VERIFICATIO FORM -->