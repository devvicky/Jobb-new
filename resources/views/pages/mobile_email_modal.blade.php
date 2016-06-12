			
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">
		<i class="icon-call-end" style="font-size: 16px;color: firebrick;"></i> Change Mobile No
	</h4>
</div>	

<div class="modal-body">
	<div id="msg-box" style="display:none">
		<div id="msg-text"></div>
	</div>
	
	<form action="/send-otp" class="change-val-mob" method="post" id="send-mobile-otp-form">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<div class="input-icon right">
			<i class="fa"></i>
			<div class="input-group margin-top-10">
				<span class="input-group-addon">
					<i class="icon-call-end"></i>
				</span>
				<input type="text" name="mobile_no" pattern="[789][0-9]{9}" maxlength="10" class="form-control" placeholder="Enter New Mobile No" 
						value="{{ old('mobile') }}"/>
				
			</div>
			
		</div>
		
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-sm blue" id="send-otp">Send OTP</button>
	</div>
	</form>
	<div id="resend-msg-box" style="display:none">
		<div id="resend-msg-text"></div>
	</div>
	<!-- <input type="number" maxlength="10" class="form-control" name="mobile_no" placeholder="Enter new mobile number" required> -->
	<form action="/verify-otp" method="post" id="verify-otp-form" style="display:none;">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="modal-body">
			<input type="text" class="form-control" name="mobile_otp" placeholder="Enter OTP">
			<div id="msg-box" style="display:none">
				<div id="msg-text"></div>
			</div>
		</div>
		<div class="modal-footer">    
      <button type="button" class="btn btn-sm blue" id="verify-otp">Verify</button>            
    </div>
	</form>

	<form action="/resend-otp" method="post" id="resend-otp-form" style="display:none;">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div style="position: absolute;left: 30px; bottom: 30px;" 
	      <button type="button" class="btn btn-sm red" id="resend-otp">Resend OTP</button>               
	    </div>
	</form>
</div>	

