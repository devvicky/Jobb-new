<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">
		<i class="fa fa-envelope" style="font-size: 16px;color: firebrick;"></i> Change email
	</h4>
</div>
<form action="/send-evc" method="post" id="send-evc-form">				
<input type="hidden" name="_token" value="{{ csrf_token() }}">	
<div class="modal-body">
	<div class="form-group">
			<div class="input-icon right">
				<i class="fa"></i>
				<div class="input-group margin-top-10">
					<span class="input-group-addon">
						<i class="icon-envelope"></i>
					</span>	
					<input type="text" required pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?" name="new_email" class="form-control" placeholder="Enter new Email"  value="{{ old('email') }}" />
				</div>
			</div>
		</div>
</div>
<div class="modal-footer form-actions">		
	<button type="submit" class="btn btn-sm blue" id="send-evc">Send verification code</button>
	<button type="button" class="btn btn-sm default" data-dismiss="modal">Cancel</button>
</div>
</form>	
