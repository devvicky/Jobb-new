<!-- BEGIN FORGOT PASSWORD FORM -->
<form class="forget-form" action="/forget" method="post" id="forgot-password">
	<h3 style="margin-bottom: 10px;color:khaki;font-size: 20px;text-shadow: 0px 1px 1px blue;">
		Forgot Password ?
	</h3>
	
	<p style="text-align: center;font-size: 17px;color: yellow;margin-bottom: 20px;">
		No Worries&nbsp;
		<i class="icon-emoticon-smile"></i>
	</p>

	<p style="text-align: center;font-size: 13px;color: #F3D5D5;">
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
		<label id="back-btn" 
				style="position: absolute; right: 36px;bottom: 22px; font-weight:400;color:lightgrey;cursor: pointer;font-size:15px;">
			Back
		</label>

        <button id="forget-password-btn" type="submit" class="btn btn-primary btn-block uppercase" 
        		style="width:50%;background-color:#C76B6B !important;box-shadow: 0px 1px 4px #2D2C2C;border-radius:2px;">
            Submit
        </button>
    </div>

</form>
<!-- END FORGOT PASSWORD FORM -->