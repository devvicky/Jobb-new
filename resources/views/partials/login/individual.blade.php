<!-- BEGIN INDIVIDUAL LOGIN FORM -->
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
			<span class="input-group-addon input-group-addon-new login-input-bg-color">
				<i class="icon-envelope"></i>
			</span>
			<div class="input-icon right ">
				<i class="fa"></i>				
				<input type="text" name="email" class="form-control login-input-bg-color" 
					   value="{{ old('email') }}" placeholder="Email Id or Mobile No" 
					   autocomplete="off">
			</div>
		</div>
	</div>
	<div class="form-group ">
		<div class="input-group margin-top-15 form-group-login-new">
			<span class="input-group-addon input-group-addon-new login-input-bg-color">
				<i class="icon-lock-open"></i>
			</span>
			<div class="input-icon right ">
				<i class="fa"></i>			
				<input type="password" name="password" class="form-control login-input-bg-color" 
						placeholder="Password">
			</div>
		</div>
	</div>	
	<div class="form-actions" style="border-bottom: 0 !important;">
	    <button id="individual-login-btn" type="submit" class="btn btn-primary btn-block uppercase" 
	    		style="width:50%;background-color:#C76B6B !important;box-shadow: 0px 1px 4px #2D2C2C;border-radius:2px;">
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

<!-- 
<div style="text-align: center; margin-bottom: 5px;">
	<small style="font-size:14px;color: azure;">One click Login using</small>
</div> 
-->

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
				
<div class="create-account" style="margin: 20px 0 0;background-color: rgb(57, 92, 101);padding: 6px 0px 3px;">
	<p style="color:#D0D0D0;">
		Not A Member?&nbsp;&nbsp;
		<a href="javascript:;" id="register-btn" class="uppercase" 
			style="color: floralwhite;font-size: 15px;font-weight: 600;"> 
			Register Now&nbsp;!
		</a> 
	</p>
</div>
<!-- END INDIVIDUAL LOGIN FORM -->