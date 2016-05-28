@if($type == 'mobiledelete')
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">
		<i class="fa fa-phone" style="font-size: 16px;color: firebrick;"></i> Delete Mobile 
	</h4>
</div>
<form action="/delete-mobile" method="post" id="verify-otp-form">				
<input type="hidden" name="_token" value="{{ csrf_token() }}">	
<div class="modal-body">
	Sure you want to delete your mobile number.
	<div id="msg-box" style="display:none">
		<div id="msg-text"></div>
	</div>
</div>
<div class="modal-footer">		
	<button type="submit" class="btn btn-sm red" id="delete-mobile">Delete</button>
	<button type="button" class="btn btn-sm default" data-dismiss="modal">Cancel</button>								
</div>
</form>	
@elseif($type == 'emaildelete')
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">
		<i class="fa fa-envelope" style="font-size: 16px;color: firebrick;"></i> Delete Email
	</h4>
</div>
<form action="/delete-email" method="post" id="verify-evc-form">				
<input type="hidden" name="_token" value="{{ csrf_token() }}">	
<div class="modal-body">
	Sure you want to delete your Email Id. <b></b>
	
	<div id="msg-box" style="display:none">
		<div id="msg-text"></div>
	</div>
</div>
<div class="modal-footer">		
	<button type="submit" class="btn btn-sm red" id="delete-email">Delete</button>
	<button type="button" class="btn btn-sm default" data-dismiss="modal">Cancel</button>						
</div>
</form>	
@endif