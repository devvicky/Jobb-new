@extends('master')

@section('content')
@if($title == "AccountSetting")
<div class="row" style="margin: 20px;">
	<div class="col-md-8" style="border:1px solid lightgrey;border-radius: 10px !important;">
		<div class="col-md-12" style="border-bottom:1px solid lightgrey;margin: 10px 0;">
			<label>Change Login Password</label>
		</div>
		<div class="col-md-12" style="margin:0px 0;">
			<a href="#change-password" data-toggle="modal">
			 <button class="btn btn-success change-password-css">Change</button>
			</a>
		</div>
	</div>
</div>

<div class="row" style="margin: 20px;">
	<div class="col-md-8" style="border:1px solid lightgrey;border-radius: 10px !important;">
		<div class="col-md-12" style="border-bottom:1px solid lightgrey;margin: 10px 0;">
			<label>Account Delete</label>
		</div>
		<div class="col-md-12" style="margin: 10px 0;">
			<label style="font-size: 12px;color: #C14046;">
				<i class="fa fa-warning (alias)"></i> All your posts and applications will be removed, if you remove your account. Do you still want to proceed?</label><br/>
			@if($acc_id == "")
			<a data-toggle="modal" class="" href="#account-setting">
				<button class="btn btn-danger delete-account-css">Delete</button></a>
			@else
			@endif
		</div>
	</div>
</div>
@if($acc_id == "")
@else
<div class="row" style="margin: 20px;">
	<div class="col-md-8" style="border:1px solid lightgrey;border-radius: 10px !important;">
		<div class="col-md-12" style="border-bottom:1px solid lightgrey;margin: 10px 0;">
			<label>Select Reason</label>
		</div>
		<form class="form-horizontal" id="pass-change" role="form" method="POST" action="/account/setting">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group">
				<div class="col-md-12">
					<div class="input-group">
						<div class="icheck-inline">
							<label>
								<input type="radio" name="reason" value="I have got my desired job and my job search is over." checked class="icheck" data-radio="iradio_square-red">
								I have got my desired job and my job search is over. 
							</label><br/>
							<label>
								<input type="radio" name="reason" value="I receive too many email notification." class="icheck" data-radio="iradio_square-red">
								 I receive too many email notification. 
							</label><br/>
							<label>
								<input type="radio" name="reason" value="Inappropriate contents." class="icheck" data-radio="iradio_square-red">
								 Inappropriate contents. 
							</label><br/>
							<label>
								<input type="radio" name="reason" value="Most of the information/contents are either fake/incorrect." class="icheck" data-radio="iradio_square-red"> 
								Most of the information/contents are either fake/incorrect. 
							</label><br/>
							<label>
								<input type="radio" name="reason" value="I don't find jobtip.in useful." class="icheck" data-radio="iradio_square-red"> 
								I don't find jobtip.in useful.
							</label><br/>
							<label>
								<input type="radio" name="reason" value="Others" class="icheck" data-radio="iradio_square-red">
								 Others 
							</label>
						</div>
					</div>
				</div>
			</div>
			<textarea class="form-control autosizeme" name="comments" rows="3" placeholder="Comments..."></textarea>
			<button class="btn btn-danger delete-account-css" type="submit" >Delete</button>
		</form>
	</div>
</div>
@endif
@endif
@stop