@extends('verify')

@section('content')

<div class="content" style="background-color: transparent !important;padding:0;">

	<!-- BEGIN OTP FORM -->
	<form class="forget-form" action="/verify" method="post" id="mobile-otp-form" style="display:block">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
		<h3 style="margin-bottom: 18px;
    color: #8CF0E7;
    font-size: 27px;
    text-shadow: 0px 1px 1px #1E1E29;">Mobile verification</h3>
		<p style="text-align: center;font-size: 15px;">
			 Enter OTP received to verify your mobile.
		</p>
		@if ( Session::has('flash_message') ) 
		  <div class="alert {{ Session::get('flash_type') }}">
		     <ul><li>{{ Session::get('flash_message') }}</li></ul>
		  </div>	  
		@endif
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
		<div class="form-actions" style="margin-top:25px">
			<button type="submit" class="btn uppercase login-signup-button" 
				 		style="padding: 6px 45px;border-radius:2px;">Submit 
				 		<i class="m-icon-swapright" style="color:white;"></i>
	            </button>
		</div>
	</form>
	<form id="resend-otp-form" action="/resendOTP" method="post" style="">
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
	<!-- END OTP FORM -->
	
</div>

@stop



@section('javascript')

<script type="text/javascript">
</script>

</script>
@stop