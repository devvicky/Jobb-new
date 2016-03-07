<!-- BEGIN CORPORATE LOGIN FORM -->
<form class="login-form-corp"  action="/auth/login" method="post" id="corporate-login">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="type" value="2">
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

		 
		<div id="corp-msg-box" style="display:none">
			<div id="corp-msg"></div>
		</div> 
			

		<div class="form-group">
			<div class="input-group margin-top-10 form-group-login-new ">
				<span class="input-group-addon input-group-addon-new login-input-bg-color">
					<i class="icon-envelope"></i>
				</span>	
				<div class="input-icon right">
					<i class="fa"></i>				
					<input type="text" name="email" class="form-control login-input-bg-color" 
						   value="{{ old('email') }}" placeholder="Email Id" autocomplete="off">
				</div>
			</div>
		</div>

		<div class="form-group" style="margin: -10px 0 30px 0;">
			<div class="input-group form-group-login-new">
				<span class="input-group-addon input-group-addon-new login-input-bg-color">
					<i class="icon-lock-open"></i>
				</span>
				<div class="input-icon right">
					<i class="fa"></i>				
					<input type="password" name="password" class="form-control login-input-bg-color" placeholder="Password">
				</div>
			</div>
		</div>

		<div class="form-actions" style="border-bottom: 0 !important;">
            <button id="corporate-login-btn" type="submit" class="btn btn-primary uppercase login-signup-button" 
            		style="background-color:#C76B6B !important;padding: 6px 45px;">
                Login
            </button>
        </div>

        <div class="form-actions" style="border-bottom: 0px;margin: -53px -30px 15px;">                                       
            <a href="javascript:;" id="forget-password-corp" class="forget-password " 
               style="font-size: 13px;color: #818284 !important;text-decoration: initial;">
            	Forgot Password ?
            </a>
        </div>

		<div class="create-account" style="margin: 20px 0 0;background-color: rgb(57, 92, 101);padding: 6px 0px 3px;">
			<p style="color:#D0D0D0;">
				Not A Member?&nbsp;&nbsp;<a href="javascript:;" id="register-btn-corp" class="uppercase" style="color: floralwhite;font-size: 15px;font-weight: 600;"> Register Now&nbsp;!</a> 
			</p>
		</div>

	</div>
</form>
<!-- END CORPORATE LOGIN FORM -->