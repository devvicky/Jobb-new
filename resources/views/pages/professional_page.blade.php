@extends('master')

<!--  -->
@section('content')
<?php $selected = 'selected'; ?> 

<div class="row profile-account" style="margin:15px;">
	<div class="col-md-3">
		<ul class="ver-inline-menu tabbable margin-bottom-10">
			<li class="active">
				<a data-toggle="tab" href="#personal">
				<i class="icon-user"></i> Personal info </a>
			</li>
			<li>
				<a data-toggle="tab" href="#professional">
				<i class="icon-briefcase"></i> Professional Details </a>
			</li>
			<li>
				<a data-toggle="tab" href="#privacy">
				<i class="fa fa-eye"></i> Privacy Settings </a>
			</li>
		</ul>
	</div>
	<div class="col-md-8" style="padding:0;">
		<div class="tab-content">
			<div id="personal" class="tab-pane active">
				<form action="/individual/basicupdate" id="profile_validation" class="horizontal-form" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">First Name<span class="required">
											* </span></label>
									<!-- <div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-font"></i>
										</span> -->
										<div class="input-icon right">
													<i class="fa"></i>
										<input type="text" name="fname" value="{{$user->induser->fname}}" class="form-control" placeholder="First Name">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Last Name<span class="required">
											* </span></label>
									<!-- <div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-font"></i>
										</span> -->
										<div class="input-icon right">
													<i class="fa"></i>
										<input type="text" name="lname" value="{{$user->induser->lname}}" class="form-control" placeholder="Last Name" >
									</div>
								</div>
							</div>
						</div>					<!-- new column added as dob and gender	 -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Date of Birth <span class="required">
											* </span></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="icon-calendar" style="color:darkcyan;"></i>
										</span>
										<input class="form-control date-picker" name="dob" size="16" type="text" value="{{ $user->induser->dob }}"/>
									</div>
									<!-- <label>Check the privacy setting for showing Date of Birth</label> -->
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group">
									<label>Gender<span class="required">
											* </span></label>
									<div class="input-group">
											<div class="md-radio-inline">
												<div class="md-radio">
													<input type="radio" checked id="radio6" name="gender" value="Male" class="md-radiobtn" 
														@if($user->induser->gender == 'Male')
															checked
														@endif
													>
													<label for="radio6" style="">
													<span></span>
													<span class="check"></span>
													<span class="box"></span>
													Male </label>
												</div>
												<div class="md-radio">
													<input type="radio" id="radio7" name="gender" value="Female" class="md-radiobtn" 
													@if($user->induser->gender == 'Female')
														checked
													@endif
													>
													<label for="radio7" style="">
													<span></span>
													<span class="check"></span>
													<span class="box"></span>
													Female </label>
												</div>
												<div class="md-radio">
													<input type="radio" id="radio8" name="gender" value="Others" class="md-radiobtn" 
													@if($user->induser->gender == 'Others')
														checked
													@endif
													>
													<label for="radio8" style="">
													<span></span>
													<span class="check"></span>
													<span class="box"></span>
													Others </label>
												</div>
											</div>	
											<div id="radio_error"></div>					<!-- /input-group -->
										</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>City <span class="required">
											* </span></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-map-marker"></i>
										</span>
										<input type="text" id="city" name="city" class="form-control" value="{{ $user->induser->city }}" placeholder="City">										
									</div>
								</div>
							</div>
						</div>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Mobile No 
									@if($user->mobile != null && $user->mobile_verify == 1) 
										<small class="verified-css">Verified</small>
									@elseif($user->mobile != null && $user->mobile_verify == 0)
										<small class="not-verified-css">Not Verified</small>
									@elseif($user->mobile == null)
									@endif
								</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="icon-call-end"></i>
									</span>
									<input type="text" 
											name="mobile" 
											class="form-control" 
											placeholder="Mobile No" 
											value="{{ $user->mobile }}"
											@if($user->mobile_verify == 1)readonly @endif
											>
									<span class="input-group-addon">
										@if($user->mobile_verify == 0)
										<a>
											<i class="fa fa-exclamation-circle" 
											style="color: #cb5a5e;font-size: 16px;"></i>
										</a>
										@elseif($user->mobile_verify == 1)
											<i class="glyphicon glyphicon-ok-circle" style="color: #18B9B9;font-size: 16px;"></i>
										@endif
									</span>
									<span class="input-group-addon">
										<a href="#edit-me-modal" data-toggle="modal" data-type="mobile" class="change-me">
											<i class="fa fa-pencil"></i>
										</a>
									</span>
								</div>
							</div>
						</div>
						<!--/span-->
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Email Id 
									@if($user->email_verify == 1) 
										<small class="verified-css">Verified</small>
									@endif
								</label>								
								<div class="input-group">
									<span class="input-group-addon">
										<i class="icon-envelope"></i>
									</span>
									<input type="text" name="email" 
											class="form-control" 
											placeholder="Email Id" 
											value="{{ $user->email }}"
											@if($user->email_verify == 1)readonly @endif>
									<span class="input-group-addon">
										@if($user->email_verify == 0)
										<a>
											<i class="fa fa-exclamation-circle" 
											style="color: #cb5a5e;font-size: 16px;"></i>
										</a>
										@elseif($user->email_verify == 1)
											<i class="glyphicon glyphicon-ok-circle" style="color: #18B9B9;font-size: 16px;"></i>
										@endif
									</span>
									<span class="input-group-addon">
										<a href="#edit-me-modal" data-toggle="modal" data-type="email" class="change-me">
											<i class="fa fa-pencil"></i>
										</a>
									</span>
								</div>
							</div>
						</div>
						<!--/span-->
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Linkedin Id</label>									
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-map-marker"></i>
									</span>
									<input type="text" name="in_page" class="form-control" value="{{ $user->induser->in_page }}" placeholder="Linkedin Id">
								</div>
							</div>
						</div>
						<!--/span-->
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label>Facebook Id</label>
								<div class="input-group">
									<span class="input-group-addon">
									<i class="fa fa-map-marker"></i>
									</span>
									<input type="text" name="fb_page" class="form-control" value="{{ $user->induser->fb_page }}" placeholder="Facebook Id">
								</div>
							</div>
						</div>
						<!--/span-->
					</div>
					<div class="margiv-top-10">
						<button type="submit" class="btn green"><i class="fa fa-check"></i> Update</button>
						<a href="/profile/ind/{{Auth::user()->induser_id}}" class="btn default">Cancel</a>
					</div>
				</form>
			</div>
			<div id="professional" class="tab-pane">
						<!-- BEGIN FORM-->
		<form action="/individual/update/{{Auth::user()->induser_id}}" id="ind_validation" 
				class="horizontal-form prof_detail" method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-body">
				<div class="row">
					<div class="" style=""></div>
					<div class="col-md-12" style="">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>About Me</label>
										<!-- <textarea   onkeyup="countChar(this)" class="form-control" rows="6"> </textarea>
									<div id="charNum" style="text-align:right;"></div> -->
									<textarea id="textarea" rows="6" class="form-control " maxlength="500" name="about_individual" placeholder="write about your proffessional summary...">{{ $user->induser->about_individual }}</textarea>
											<div id="textarea_feedback"></div>
								</div>
								
							</div>
						</div>	
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>Education <span class="required">
											* </span></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="icon-graduation"></i>
										</span>
										@if($user->induser->education == null)
										<select class="form-control education-list" name="education" style="border:1px solid #c4d5df">
											<option selected value="">Select</option>
											{{$n=""}}
											@foreach($educationList as $edu)
											
												@if($n != $edu->name && $edu->name != '0')
													{{$n=$edu->name}}
													<optgroup label="{{$edu->name}}">
												@endif
													<option value="{{$edu->branch}}-{{$edu->name}}-{{$edu->level}}" @if($user->induser->education=="{{$edu->branch}}-{{$edu->name}}") {{ $selected }} @endif>{{$edu->name}}-{{$edu->branch}}</option>
												@if($n != $edu->name)
													</optgroup>		
												@endif

											@endforeach
										</select>
										@else
										<select class="form-control education-list" name="education" value="{{$user->induser->education}}"
												 style="border:1px solid #c4d5df">
												<option selected value="{{$user->induser->education}}">{{$user->induser->education}}</option>
											{{$n=""}}
											@foreach($educationList as $edu)
											
												@if($n != $edu->name && $edu->name != '0')
													{{$n=$edu->name}}
													<optgroup label="{{$edu->name}}">
												@endif
													<option value="{{$edu->branch}}-{{$edu->name}}-{{$edu->level}}" @if($user->induser->education=="{{$edu->branch}}-{{$edu->name}}") {{ $selected }} @endif>{{$edu->name}}-{{$edu->branch}}</option>
												@if($n != $edu->name)
													</optgroup>		
												@endif

											@endforeach
										</select>
										@endif								
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>Experience </label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class=" icon-briefcase"></i>
										</span>
										<select class="form-control" name="experience" >
											<option value=""> Select </option>
											<option @if($user->induser->experience=="0") {{ $selected }} @endif value="0">Fresher</option>
											<option @if($user->induser->experience=="1") {{ $selected }} @endif value="1">1 Year</option>
											<option @if($user->induser->experience=="2") {{ $selected }} @endif value="2">2 Years</option>
											<option @if($user->induser->experience=="3") {{ $selected }} @endif value="3">3 Years</option>
											<option @if($user->induser->experience=="4") {{ $selected }} @endif value="4">4 Years</option>
											<option @if($user->induser->experience=="5") {{ $selected }} @endif value="5">5 Years</option>
											<option @if($user->induser->experience=="6") {{ $selected }} @endif value="6">6 Years</option>
											<option @if($user->induser->experience=="7") {{ $selected }} @endif value="7">7 Years</option>
											<option @if($user->induser->experience=="8") {{ $selected }} @endif value="8">8 Years</option>
											<option @if($user->induser->experience=="9") {{ $selected }} @endif value="9">9 Years</option>
											<option @if($user->induser->experience=="10") {{ $selected }} @endif value="10">10 Years</option>
											<option @if($user->induser->experience=="11") {{ $selected }} @endif value="11">11 Years</option>
											<option @if($user->induser->experience=="12") {{ $selected }} @endif value="12">12 Years</option>
											<option @if($user->induser->experience=="13") {{ $selected }} @endif value="13">13 Years</option>
											<option @if($user->induser->experience=="14") {{ $selected }} @endif value="14">14 Years</option>
											<option @if($user->induser->experience=="15") {{ $selected }} @endif value="15">15 Years</option>
										</select>
									</div>
								</div>
							</div>
							<!--/span-->
						</div>						
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Working Status</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class=" icon-briefcase"></i>
										</span>
										<select class="form-control" id="working_status" name="working_status">
											<option value="">Select</option>
											<option @if($user->induser->working_status=="Student") {{ $selected }} @endif value="Student">Student</option>
											<option @if($user->induser->working_status=="Searching Job") {{ $selected }} @endif value="Searching Job">Searching Job</option>
											<option @if($user->induser->working_status=="Working") {{ $selected }} @endif value="Working">Working</option>
											<option @if($user->induser->working_status=="Freelancing") {{ $selected }} @endif value="Freelancing">Freelancing</option>
										</select>
									</div>
								</div>
							</div>	
							<div class="col-md-6 col-sm-6 col-xs-12" >
								<div class="form-group">
									<label>Working at</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-university"></i>
										</span>
										
										<input type="text" id="workingat" class="form-control" value="{{ $user->induser->working_at }}" name="working_at">
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>
										Job Role <span class="required">*</span>
									</label>
									@if($user->induser->role == null)
										<select class="select2me form-control" name="role">
											<option selected value="">Select</option>
											{{$n=""}}
											@foreach($farearoleList as $farearole)
											@if($n != $farearole->functional_area)
												{{$n=$farearole->functional_area}}
												<optgroup label="{{$farearole->functional_area}}">
											@endif
											<option value="{{$farearole->functional_area}}-{{$farearole->role}}">{{$farearole->role}}</option>
											@if($n != $farearole->functional_area)
													</optgroup>		
												@endif
											@endforeach
										</select>
									@elseif($user->induser->role != null)
										<select class="select2me form-control" name="role">
											<option value="{{$user->induser->functional_area}}-{{$user->induser->role}}">{{$user->induser->role}}</option>
											{{$n=""}}
											@foreach($farearoleList as $farearole)
											@if($n != $farearole->functional_area)
												{{$n=$farearole->functional_area}}
												<optgroup label="{{$farearole->functional_area}}">
											@endif
											<option value="{{$farearole->functional_area}}-{{$farearole->role}}">{{$farearole->role}}</option>
											@if($n != $farearole->functional_area)
													</optgroup>		
												@endif
											@endforeach
										</select>
									@endif								
									<!-- </div> -->
								</div>
								
							</div>
							<div class="col-md-12">
								
							</div>
							
						</div>
						
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<!-- <form action="{{ url('job/newskill') }}" id="newskillfrm" method="post">					
									<input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
									<label>Search Skills<span class="required"> * </span></label>
									<div style="position:relative;">
										<input type="text" name="name" id="newskill" class="form-control" placeholder="Search for skill...">
											<button id="add-new-skill" style="position:absolute;right:0;top:0;" class="btn btn-success" type="button"><i class="icon-plus"></i> Add</button>	
											{!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group" style="">
									<label class="control-label">Upload Resume <small style="font-weight: 400; font-size: 13px;">(Optional) only pdf or word format</small></label>&nbsp;
									
									<div class="">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<span class="btn btn-default btn-file" style=" background-color: #44b6ae;  color: white;">
												<i class="icon-paper-clip" style="color: white;"></i>
												<span class="fileinput-new">Select File </span> 
												<span class="fileinput-exists">Upload New Resume </span>
												<input type="file" name="resume" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf">
											</span>
											<br>
											<span class="fileinput-new"></span>
											<span class="fileinput-filename"></span>&nbsp; 
											<a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"></a>
										</div>
									</div>
									@if($user->induser->resume != null)
									<label style="font-size: 12px;font-weight: 500">{{$user->induser->resume_dtTime}} - {{$user->induser->resume}}
									@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 preferences-css">
								<span>Job Preference</span>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>Prefered Job Type <span class="required">
											* </span></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class=" icon-briefcase"></i>
										</span>
										<select class="form-control" value="{{ $user->prefered_jobtype }}" name="prefered_jobtype">
											<option value="">&nbsp;</option>
											<option @if($user->induser->prefered_jobtype=="Full Time") {{ $selected }} @endif value="Full Time">Full Time</option>
											<option @if($user->induser->prefered_jobtype=="Part Time") {{ $selected }} @endif value="Part Time">Part Time</option>
											<option @if($user->induser->prefered_jobtype=="Freelancer") {{ $selected }} @endif value="Freelancer">Freelancer</option>
											<option @if($user->induser->prefered_jobtype=="Work from home") {{ $selected }} @endif value="Work from home">Work from home</option>
										</select>
									</div>
								</div>
							</div>
						<!-- </div>
						<div class="row"> -->
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Prefered Location <span class="required">
											* </span></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-map-marker"></i>
										</span>

										<input type="text" id="pref_loc" name="pref_loc" 
										class="form-control" placeholder="Select preferred location">									
										
									</div>
	
									{!! Form::select('prefered_location[]', $location, null, ['id'=>'prefered_location', 
																								   'aria-hidden'=>'true', 
																								   'class'=>'form-control', 
																								   'placeholder'=>'city', 
																								   'multiple']) !!}	

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions ">
					<button type="submit" name="individual" value="Save" class="btn blue">
						<i class="fa fa-check"></i> Update
					</button>
					<a href="/profile/ind/{{Auth::user()->induser_id}}" class="btn default">Cancel</a>
				</div>
			</div>
		</form>
		<!-- END FORM-->
			</div>
			<!-- <div id="preference" class="tab-pane">
				
			</div> -->
			<div id="privacy" class="tab-pane">
				<form action="/individual/privacyUpdate/{{Auth::user()->induser_id}}" id="privacy_validation" 
				class="horizontal-form prof_detail" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<table class="table table-bordered table-striped">
					<tr>
						<td>
							 Who can see my Email Address.
						</td>
						<td>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="email_show" value="Links"
							@if($user->induser->email_show == 'Links')
								checked
							@endif >
							Links </label>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="email_show" value="None"
							@if($user->induser->email_show == 'None')
								checked
							@endif >
							None </label>
						</td>
					</tr>
					<tr>
						<td>
							 Who can see my Mobile No.
						</td>
						<td>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="mobile_show" value="Links"
							@if($user->induser->mobile_show == 'Links')
								checked
							@endif >
							Links </label>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="mobile_show" value="None"
							@if($user->induser->mobile_show == 'None')
								checked
							@endif >
							None </label>
						</td>
					</tr>
					<tr>
						<td>
							 Who can see my Date of Birth.
						</td>
						<td>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="dob_show" value="Links"
							@if($user->induser->dob_show == 'Links')
								checked
							@endif >
							Links </label>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="dob_show" value="None"
							@if($user->induser->dob_show == 'None')
								checked
							@endif >
							None </label>
						</td>
					</tr>
					</table>
					<!--end profile-settings-->
					<div class="margin-top-10">
						<button type="submit" name="individual" value="Save" class="btn green">
						<i class="fa fa-check"></i> Save Changes
						</button>
						<a href="/profile/ind/{{Auth::user()->induser_id}}" class="btn default">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--end col-md-9-->
</div>
<!-- Mobile/Email verification -->
<div class="modal fade bs-modal-sm" id="edit-me-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content" id="edit-me-content">
			<div id="edit-me-content-inner">
				Edit
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@stop



@section('javascript')
<script src="/assets/admin/pages/scripts/components-dropdowns.js"></script>
<script type="text/javascript">
	$.ajax({ // make the request for the selected data object
	  type: 'GET',
	  url: '/profileedit/{{ $user->induser->role }}',
	  dataType: 'json'
	}).then(function (data) {
		console.log(data);
	});


	function initialize() {
		var options = {	types: ['(cities)'], componentRestrictions: {country: "in"}	};
		var input = document.getElementById('city');
		var autocomplete = new google.maps.places.Autocomplete(input, options);
		autocomplete.addListener('place_changed', onPlaceChanged); 
		function onPlaceChanged() {
		  var place = autocomplete.getPlace();
		  if (place.address_components) { city = place.address_components[0];
		  	document.getElementById('city').value = city.long_name;
		  } else { document.getElementById('autocomplete').placeholder = 'Enter a city'; }
		}
	}
   google.maps.event.addDomListener(window, 'load', initialize);   
</script>
<script type="text/javascript">
	// Skill Details
	var skillArray = [];
	<?php $array = explode(', ', $user->induser->linked_skill); ?> 
	@if(count($array) > 0)
	@foreach($array as $gt => $gta)
		skillArray.push('<?php echo $gta; ?>');
	@endforeach
	@endif
	if(skillArray.length == 0){
		var skillselect = $("#linked_skill_id").select2({ dataType: 'json', data: [] });
	}else{
		var skillselect = $("#linked_skill_id").select2({ dataType: 'json', data: skillArray });
	}
    
    skillselect.val(skillArray).trigger("change");
    

    // preferred loc
	var prefLocationArray = [];
	<?php $arr = explode(', ', $user->induser->prefered_location); ?>
	@if(count($arr) > 0) 
	@foreach($arr as $ga => $gt)
		prefLocationArray.push('<?php echo $gt; ?>');
	@endforeach
	@endif
    var plselect = $("#prefered_location").select2({ dataType: 'json', data: prefLocationArray });
    plselect.val(prefLocationArray).trigger("change");

  	var $eventSelect = $("#prefered_location"); 
	$eventSelect.on("select2:unselect", function (e) {
		// console.log("Removing: "+e.params.data.id);
		// remove corresponding value from array
		prefLocationArray = $.grep(prefLocationArray, function(value) {
		  return value != e.params.data.id;
		});

		// remove select option for pref loc
		$("#prefered_location option[value='"+e.params.data.id+"']").remove();		
		if(prefLocationArray.length == 0){
			plselect = $("#prefered_location").select2({ dataType: 'json', data: [] });
		}else{
			plselect = $("#prefered_location").select2({ dataType: 'json', data: prefLocationArray });
		}
		plselect.val(prefLocationArray).trigger("change"); 
		// updated array
	});

    var prefLoc = $("#pref_loc");
	function initPrefLoc() {
		var options = {	types: ['(regions)'], componentRestrictions: {country: "in"}};
		var input = document.getElementById('pref_loc');
		var autocomplete = new google.maps.places.Autocomplete(input, options);
		autocomplete.addListener('place_changed', onPlaceChanged);

		function onPlaceChanged() {
		  var place = autocomplete.getPlace();
		  if (place.address_components) { 
		  	// console.log(place.address_components);

		  	var obj = place.address_components;		  	
		  	var locality = '';
	  		var city = '';
	  		var state = '';
		  	$.each( obj, function( key, value ) {
		  		if($.inArray("sublocality", value.types)  > -1 ){
		  			locality = value.long_name;
		  		}
		  		if($.inArray("locality", value.types)  > -1 ){
		  			city = value.long_name;
		  		}
		  		if($.inArray("administrative_area_level_1", value.types)  > -1 ){
		  			state = value.long_name;
		  		}
			});
			// console.log("Locality: "+locality+" city: "+city+" state: "+state);

			if(locality != '' && city != '' && state != '' ){
				prefLocationArray.push(locality +"-"+ city +"-"+ state);	
			}
			if(locality == '' && city != '' && state != '' ){
				prefLocationArray.push(city +"-" + state);	
			}

		  	setTimeout(function(){ prefLoc.val(''); prefLoc.focus();},0);	// clear field
		  	
		  	$("#prefered_location").select2({ dataType: 'json', data: prefLocationArray });
        	plselect.val(prefLocationArray).trigger("change");

		  } else { 
		  	document.getElementById('autocomplete').placeholder = 'Your preferred location'; 
		  }
		}

	}
   google.maps.event.addDomListener(window, 'load', initPrefLoc);

</script>
<script type="text/javascript">
    // preferred loc
	var currLocationArray = [];

    // preferred loc    
    var clselect = $("#current_location").select2();
    clselect.val(currLocationArray).trigger("change");

  	var $eventSelect = $("#current_location"); 
	$eventSelect.on("select2:unselect", function (e) {
		// console.log("Removing: "+e.params.data.id);
		// remove corresponding value from array
		currLocationArray = $.grep(prefLocationArray, function(value) {
		  return value != e.params.data.id;
		});

		// remove select option for pref loc
		$("#current_location option[value='"+e.params.data.id+"']").remove();		
		if(currLocationArray.length == 0){
			clselect = $("#current_location").select2({ dataType: 'json', data: [] });
		}else{
			clselect = $("#current_location").select2({ dataType: 'json', data: currLocationArray });
		}
		clselect.val(currLocationArray).trigger("change"); 
		// updated array
	});

    var currLoc = $("#curr_loc");
	function initCurrLoc() {
		var options = {	types: ['(regions)'], componentRestrictions: {country: "in"}};
		var input = document.getElementById('curr_loc');
		var autocomplete = new google.maps.places.Autocomplete(input, options);
		autocomplete.addListener('place_changed', onPlaceChanged);

		function onPlaceChanged() {
		  var place = autocomplete.getPlace();
		  if (place.address_components) { 
		  	// console.log(place.address_components);

		  	var obj = place.address_components;		  	
		  	var locality = '';
	  		var city = '';
	  		var state = '';
		  	$.each( obj, function( key, value ) {
		  		if($.inArray("sublocality", value.types)  > -1 ){
		  			locality = value.long_name;
		  		}
		  		if($.inArray("locality", value.types)  > -1 ){
		  			city = value.long_name;
		  		}
		  		if($.inArray("administrative_area_level_1", value.types)  > -1 ){
		  			state = value.long_name;
		  		}
			});
			// console.log("Locality: "+locality+" city: "+city+" state: "+state);

			if(locality != '' && city != '' && state != '' ){
				currLocationArray.push(locality +"-"+ city +"-"+ state);	
			}
			if(locality == '' && city != '' && state != '' ){
				currLocationArray.push(city +"-" + state);	
			}

		  	setTimeout(function(){ currLoc.val(''); currLoc.focus();},0);	// clear field
		  	
		  	$("#current_location").select2({ dataType: 'json', data: currLocationArray });
        	clselect.val(currLocationArray).trigger("change");

		  } else { 
		  	document.getElementById('autocomplete').placeholder = 'Your current location'; 
		  }
		}

	}
   google.maps.event.addDomListener(window, 'load', initCurrLoc);

</script>
<script type="text/javascript">
$(document).ready(function() {
  
  $('#name').blur(function(){
  
    var nameVal = $('#name').val()
    var nameLength = nameVal.length;
    var nameSplit = nameVal.split(" ");
    var lastLength = nameLength - nameSplit[0].length;
    var lastNameLength = nameSplit[0].length + 1;
    var lastName = nameVal.slice(lastNameLength);
    
    $('#first_name').val(nameSplit[0]);
    $('#last_name').val(lastName);
    
    return false;
  });

 
});
</script>
	<script>
        $("#job-category").multipleSelect({
            filter: true,
            multiple: true
        });
    </script>


<script src="/assets/ind_validation.js"></script>
<script>
	jQuery(document).ready(function() { 
	    ComponentsIonSliders.init();
	    // ComponentsDropdowns.init();
	    ComponentsEditors.init();
	});   
</script>
<script>
$(document).ready(function() {
var text_max = 500;
	$('#textarea_feedback').html(text_max + ' characters remaining');

	$('#textarea').keyup(function() {
	    var text_length = $('#textarea').val().length;
	    var text_remaining = text_max - text_length;

	    $('#textarea_feedback').html(text_remaining + ' characters remaining');
	});
});
</script>
<script type="text/javascript">
	
// $selectedSkills = $("#prefered_location").select2();
 $selectedSkills = $("#linked_skill_id").select2();

// console.log($selectedSkills.val());


	// function checkOption(obj) {
	//     var input = document.getElementById("workingAs");
	//     input.disabled = obj.value == "Searching Job";
	// }
	$(document).ready(function () {
toggleFields();
$('#working_status').change(function () {
toggleFields();
});
});
function toggleFields() {
if ($('#working_status').val() == 'Student' || $('#working_status').val() == 'Searching Job')
$("#workingat").attr('disabled','disabled').val('');
else
$("#workingat").removeAttr('disabled');
}

$gotit = [];
	$(function(){

	 	function split( val ) {
	      return val.split( /,\s*/ );
	    }
	    function extractLast( term ) {
	      return split( term ).pop();
	    }

		$( "#newskill" )
		.bind( "keydown", function( event ) {
			if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
			  event.preventDefault();
			}
		})
		.autocomplete({
			source: function( request, response ) {
				// $.getJSON( "/job/skillSearch", {
				// 	term: extractLast( request.term )
				// }, response );

				$.ajax({
					url: '/job/skillSearch',
					dataType: "json",
					data: { term: extractLast( request.term ) },
					success: function(data) {
					if (data.length === 0) {
						$('#add-new-skill').removeClass('hide');
						$('#add-new-skill').addClass('show');
					}else{
						$('#add-new-skill').removeClass('show');
						$('#add-new-skill').addClass('hide');
					}
					response(data);
					}
				});

			},
			search: function() {
				var term = extractLast( this.value );
				if ( term.length < 2 ) {
					return false;
				}
			},
			focus: function() {
				return false;
			},
			select: function(event, ui) {
				var termsId = [];

				if($selectedSkills.val() != null){
					termsId = $selectedSkills.val();
				}

				if(termsId.length != null){

				}
				termsId.push( ui.item.value );
				$gotit.push( ui.item.value );

				termsId.push( "" );
				$selectedSkills.val(termsId).trigger("change"); 
				$(this).val("");
				return false;
			}
		});
	});


	$(document).ready(function(){
		$('#add-new-skill').on('click',function(event){  	    
		  	event.preventDefault();
		  	if (!$('#newskill').val()) {
		  		alert('Please enter some skill to add.');
		  		return false;
		  	}else{
			  	var name = $('#newskill').val(); 
			    $.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
			    $.ajax({
			      url: "/job/newskill",
			      type: "POST",
			      data: { name: name },
			      cache : false,
			      success: function(data){
			        if(data > 0){
			        	$newSkillList = new Array();

			        	<?php $newSkillList = array(); ?>
			        	@if(count($skills) > 0)
						@foreach($skills as $skill)
							$newSkillList.push('<?php echo $skill; ?>');
						@endforeach
						@endif
			        	$newSkillList.push($('#newskill').val());
			        	// console.log($newSkillList);
			        	$("#linked_skill_id").select2({
			        		dataType: 'json',
			        		data: $newSkillList
			        	});

			        	var selectedSkillId = [];
			        	$newSkill = $('#newskill').val();
			        	$newSkillId = data;
			        	// $selectedSkill = $('#linked_skill').val();
			        	// console.log($gotit);
			        	if($gotit != null){
							selectedSkillId = $gotit;
						}
						
			        	selectedSkillId.push($newSkill);
			        	// console.log(selectedSkillId);
			        	// $('#linked_skill').val($selectedSkill+""+$newSkill+", ");
			        	$selectedSkills.val(selectedSkillId).trigger("change"); 
			        	$('#newskill').val("");
			        }
			      },
			      error: function(data) {
			      	alert('some error occured...');
			      }
			    }); 
			    return false;
			}
		});

		// mobile-email-change
		$('.change-me').on('click',function(event){  	    
		  	event.preventDefault();
		  	var type = $(this).data('type');

		    $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

		    $.ajax({
		      url: "/me-change",
		      type: "post",
		      data: {type: type},
		      cache : false,
		      success: function(data){
		    	$('#edit-me-content-inner').html(data);
		    	$('#edit-me-modal').modal('show');
		      }
		    }); 
		    return false;
	  });

	// mobile-email-change
	$('#send-otp').live('click',function(event){  	    
	  	event.preventDefault();

	  	var formData = $('#send-mobile-otp-form').serialize(); 
	    var formAction = $('#send-mobile-otp-form').attr('action');

	    $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      success: function(data){
	    	$('#edit-me-content-inner').html(data);
	    	$('#edit-me-modal').modal('show');
	      }
	    }); 
	    return false;
  	});

  	// verify-otp
	$('#verify-otp').live('click',function(event){  	    
	  	event.preventDefault();

	  	var formData = $('#verify-otp-form').serialize(); 
	    var formAction = $('#verify-otp-form').attr('action');

	    $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      success: function(data){
	      	if(data == 'verification-failure'){
	      		$('#msg-box').removeClass('alert alert-success');
	            $('#msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#msg-text').text('Invalid OTP');
	      	}else if(data == 'verification-success'){
	      		$('#msg-box').removeClass('alert alert-danger');
	            $('#msg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#msg-text').text('Verification successful');
	      		window.location = "/individual/edit";
	      	}
	      }
	    }); 
	    return false;
  	});

	// mobile-email-change
	$('#send-evc').live('click',function(event){  	    
	  	event.preventDefault();

	  	var formData = $('#send-evc-form').serialize(); 
	    var formAction = $('#send-evc-form').attr('action');

	    $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      success: function(data){
	    	$('#edit-me-content-inner').html(data);
	    	$('#edit-me-modal').modal('show');
	      }
	    }); 
	    return false;
  	});

  	// verify-otp
	$('#verify-ver-code').live('click',function(event){  	    
	  	event.preventDefault();

	  	var formData = $('#verify-evc-form').serialize(); 
	    var formAction = $('#verify-evc-form').attr('action');

	    $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      success: function(data){
	      	if(data == 'verification-failure'){
	      		$('#msg-box').removeClass('alert alert-success');
	            $('#msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#msg-text').text('Invalid verification code');
	      	}else if(data == 'verification-success'){
	      		$('#msg-box').removeClass('alert alert-danger');
	            $('#msg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#msg-text').text('Verification successful');
	      		window.location = "/individual/edit";
	      	}else{
	      		$('#msg-text').text('some error occured');
	      	}
	      }
	    }); 
	    return false;
  	});

	$(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });
		

	});
</script>

<script type="text/javascript">
 $(document).ready(function () {
     	$('.show-far').hide();
	    jQuery('.hide-far').on('click', function(event) {
		    jQuery('.show-far').show();
		    jQuery('.hide-role').hide();
	    });

	    jQuery('.back-role').on('click', function(event) {
		    jQuery('.show-far').hide();
		    jQuery('.hide-role').show();
	    });
	});
 
$(".job-role-ajax").select2({
	placeholder: 'Enter a role',
  ajax: {
    url: "/post/jobroles/",
    dataType: 'json',
    delay: 250,
    data: function (params) {
      return {
        q: params.term, // search term
        page: params.page
      };
    },
    processResults: function (data, params) {
      console.log(data);
      return {
        results: data
      };
    },
    cache: true
  },
  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
  minimumInputLength: 2,
  templateResult: formatRepo, // omitted for brevity, see the source of this page
  templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
});

function formatRepo (repo) {
      if (repo.loading) return repo.text;

      var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
          "<div class='select2-result-repository__title'><b>Role</b>: " + repo.role + "</div>";

      markup += "<div class='select2-result-repository__statistics'>" +
        "<div class='select2-result-repository__forks'><b>Functional area: </b> " + repo.functional_area + "</div>" +
        "<div class='select2-result-repository__stargazers'><b>Industry</b>: " + repo.industry + "</div>" +
      "</div>" +
      "</div></div>";

      return markup;
    }

    function formatRepoSelection (repo) {
    	if(repo.role != undefined){
    		// console.log(repo);
    		return  "<b>Role:</b> "+repo.role+"<br/><b>Functional Area:</b> "+repo.functional_area+"<br/><b>Industry:</b> "+repo.industry;
    	}      
    }

$(document).on('click', 'a', function(event, ui) {
    var jrole = $(this).data('jrole');

    $.ajaxSetup({
        headjroleers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    if(jrole != null){
      event.preventDefault();
      $('#all-roles').modal('hide');
      $('#jobrole').select2('open');
      $('.select2-search__field').val(jrole);
      $('.select2-search__field').trigger('keyup');
       // $('.select2-dropdown').hide();
    }
});


</script>
@stop