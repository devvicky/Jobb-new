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
				<span class="after">
				</span>
			</li>
			<li>
				<a data-toggle="tab" href="#professional">
				<i class="icon-briefcase"></i> Professional Details </a>
			</li>
			<li>
				<a data-toggle="tab" href="#preference">
				<i class=" icon-pointer"></i> Preferences </a>
			</li>
			<li>
				<a data-toggle="tab" href="#privacy">
				<i class="fa fa-eye"></i> Privacity Settings </a>
			</li>
		</ul>
	</div>
	<div class="col-md-8" style="padding:0;">
		<div class="tab-content">
			<div id="personal" class="tab-pane active">
				<form action="{{ url('/individual/basicupdate') }}" id="profile_validation" class="horizontal-form" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">First Name</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-font"></i>
										</span>
										<input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ $user->fname }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Last Name</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="glyphicon glyphicon-font"></i>
										</span>
										<input type="text" name="last_name" class="form-control" placeholder="Last Name" value=" {{ $user->lname }}">
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
										<input class="form-control date-picker" name="dob" size="16" type="text" value="{{ $user->dob }}"/>
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6">
								<div class="form-group">
									<label>Gender</label>
									<div class="input-group">
											<div class="md-radio-inline">
												<div class="md-radio">
													<input type="radio" checked id="radio6" name="gender" value="Male" class="md-radiobtn" 
														@if($user->gender == 'Male')
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
													@if($user->gender == 'Female')
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
													@if($user->gender == 'Others')
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
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>City <span class="required">
											* </span></label>									
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-map-marker"></i>
										</span>
										<input type="text" id=" Select City" name="city" class="form-control" value="{{ $user->city }}" placeholder="City">
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>Area </label>
									<div class="input-group">
										<span class="input-group-addon">
										<i class="fa fa-map-marker"></i>
										</span>
										<input type="text" name="c_locality" class="form-control" value="{{ $user->c_locality }}" placeholder="Select Local Area">
										
									</div>
								</div>
							</div>
							<!--/span-->
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
											<i class="glyphicon glyphicon-ok-circle" style="color: #1EC71E;font-size: 16px;"></i>
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
											<i class="glyphicon glyphicon-ok-circle" style="color: #1EC71E;font-size: 16px;"></i>
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
					<div class="margiv-top-10">
						<button type="submit" class="btn green"><i class="fa fa-check"></i> Update</button>
						<a href="/profile/ind/{{Auth::user()->induser_id}}" class="btn default">Cancel</a>
					</div>
				</form>
			</div>
			<div id="professional" class="tab-pane">
						<!-- BEGIN FORM-->
		<form action="{{ url('/individual/update', Auth::user()->induser_id) }}" id="ind_validation" 
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
									<!-- <div class="input-group"> -->
										
										<textarea name="about_individual" class="form-control" rows="6">{{ $user->about_individual }} </textarea>
										
									<!-- </div> -->
									<div id="charNum" style="text-align:right;"></div>
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
										<select class="form-control" name="education" id="parent_selection" >
											<option value="">--Please Select--</option>
											<option @if($user->education=="BA") {{ $selected }} @endif value="BA">B.A</option>
											<option @if($user->education=="BArch") {{ $selected }} @endif value="BArch">B.Arch</option>
											<option @if($user->education=="BCA") {{ $selected }} @endif value="BCA">BCA</option>
											<option @if($user->education=="BBA") {{ $selected }} @endif value="BBA">BBA</option>
											<option @if($user->education=="BCom") {{ $selected }} @endif value="BCom">BCom</option>
											<option @if($user->education=="B.Ed") {{ $selected }} @endif value="B.Ed">B.Ed</option>
											<option @if($user->education=="MTech") {{ $selected }} @endif value="MTech" value="MTech">MTech</option>
											<option @if($user->education=="MSc") {{ $selected }} @endif value="MSc" value="MSc">MSc</option>
											<option @if($user->education=="MArch") {{ $selected }} @endif value="MArch" value="MArch">MArch</option>

											<option @if($user->education=="MCA") {{ $selected }} @endif value="MCA" value="MCA">MCA</option>
											<option @if($user->education=="MS") {{ $selected }} @endif value="MS" value="MS">MS</option>
											<option @if($user->education=="PGDiploma") {{ $selected }} @endif value="PGDiploma" value="PGDiploma">PGDiploma</option>

											<option @if($user->education=="MVSC") {{ $selected }} @endif value="MVSC" value="MVSC">MVSC</option>
											<option @if($user->education=="MCM") {{ $selected }} @endif value="MCM" value="MCM">MCM</option>
											<option @if($user->education=="BBA") {{ $selected }} @endif value="BBA" value="BBA">BBA</option>
											<option @if($user->education=="btech") {{ $selected }} @endif value="btech">B.Tech/B.E.</option>
											<option @if($user->education=="MCom") {{ $selected }} @endif value="MCom" value="MCom">MCom</option>
											<option @if($user->education=="MEd") {{ $selected }} @endif value="MEd" value="MEd">MEd</option>
											<option @if($user->education=="MPharma") {{ $selected }} @endif value="MPharma" value="MPharma">MPharma</option>
											<option @if($user->education=="MA") {{ $selected }} @endif value="MA" value="MA">MA</option>
											<option @if($user->education=="twelth") {{ $selected }} @endif value="twelth" value="twelth">12th</option>
											<!-- <option value="10">10</option> -->
										</select>
										
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>Branch <span class="required"> * </span></label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="icon-graduation"></i>
										</span>
										<select class="form-control" name="branch" id="child_selection" value="{{ $user->branch }}">
											<option value="{{ $user->branch }}">{{ $user->branch }}</option>
										</select>
									</div>
								</div>
							</div>
							<!--/span-->
						</div>						
						<div class="row">
							<div class="col-md-3 col-sm-3 col-xs-6">
								<div class="form-group">
									<label>Working Status</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class=" icon-briefcase"></i>
										</span>
										<select class="form-control" id="working_status" name="working_status">
											<option value="">Select</option>
											<option @if($user->working_status=="Student") {{ $selected }} @endif value="Student">Student</option>
											<option @if($user->working_status=="Searching Job") {{ $selected }} @endif value="Searching Job">Searching Job</option>
											<option @if($user->working_status=="Working") {{ $selected }} @endif value="Working">Working</option>
											<option @if($user->working_status=="Freelancing") {{ $selected }} @endif value="Freelancing">Freelancing</option>
										</select>
									</div>
								</div>
							</div>	
							<div class="col-md-3 col-sm-3 col-xs-6">
								<div class="form-group">
									<label>Experience</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class=" icon-briefcase"></i>
										</span>
										<select class="form-control" name="experience" >
											<option value=""> Select </option>
											<option @if($user->experience=="0") {{ $selected }} @endif value="0">0</option>
											<option @if($user->experience=="1") {{ $selected }} @endif value="1">1</option>
											<option @if($user->experience=="2") {{ $selected }} @endif value="2">2</option>
											<option @if($user->experience=="3") {{ $selected }} @endif value="3">3</option>
											<option @if($user->experience=="4") {{ $selected }} @endif value="4">4</option>
											<option @if($user->experience=="5") {{ $selected }} @endif value="5">5</option>
											<option @if($user->experience=="6") {{ $selected }} @endif value="6">6</option>
											<option @if($user->experience=="7") {{ $selected }} @endif value="7">7</option>
											<option @if($user->experience=="8") {{ $selected }} @endif value="8">8</option>
											<option @if($user->experience=="9") {{ $selected }} @endif value="9">9</option>
											<option @if($user->experience=="10") {{ $selected }} @endif value="10">10</option>
											<option @if($user->experience=="11") {{ $selected }} @endif value="11">11</option>
											<option @if($user->experience=="12") {{ $selected }} @endif value="12">12</option>
											<option @if($user->experience=="13") {{ $selected }} @endif value="13">13</option>
											<option @if($user->experience=="14") {{ $selected }} @endif value="14">14</option>
											<option @if($user->experience=="15") {{ $selected }} @endif value="15">15</option>
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
										
										<input type="text" id="workingat" class="form-control" value="{{ $user->working_at }}" name="working_at">
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>Job Category</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-cubes"></i>
										</span>
										<select class="form-control" name="prof_category" value="{{ $user->prof_category }}" >
											<optgroup label="Accounting">
												<option @if($user->experience=="Accounts/Finance/Tax") {{ $selected }} @endif value="Accounts/Finance/Tax">Accounts/Finance/Tax</option>
												<option @if($user->experience=="Agent") {{ $selected }} @endif value="Agent">Agent</option>
												<option @if($user->experience=="Analytics & Business Intelligence") {{ $selected }} @endif value="Analytics & Business Intelligence">
													Analytics & Business Intelligence
												</option>
											</optgroup>
											<optgroup label="IT Field">
												<option @if($user->experience=="HR/Administration/IR") {{ $selected }} @endif value="HR/Administration/IR">HR/Administration/IR</option>
												<option @if($user->experience=="IT Software - Client Server") {{ $selected }} @endif value="IT Software - Client Server">IT Software - Client Server</option>
												<option @if($user->experience=="IT Software - Mainframe") {{ $selected }} @endif value="IT Software - Mainframe">IT Software - Mainframe</option>
												<option @if($user->experience=="IT Software - Middleware") {{ $selected }} @endif value="IT Software - Middleware">IT Software - Middleware</option>
												<option @if($user->experience=="IT Software - Mobile") {{ $selected }} @endif value="IT Software - Mobile">IT Software - Mobile</option>
												<option @if($user->experience=="IT Software - Other") {{ $selected }} @endif value="IT Software - Other">IT Software - Other</option>
												<option @if($user->experience=="IT Software - System Programming") {{ $selected }} @endif value="IT Software - System Programming">IT Software - System Programming</option>
												<option @if($user->experience=="IT Software - Telecom Software") {{ $selected }} @endif value="IT Software - Telecom Software">IT Software - Telecom Software</option>
												<option @if($user->experience=="IT Software - Application Programming") {{ $selected }} @endif value="IT Software - Application Programming">IT Software - Application Programming</option>
												<option @if($user->experience=="IT Software - DBA/Datawarehousing") {{ $selected }} @endif value="IT Software - DBA/Datawarehousing">IT Software - DBA/Datawarehousing</option>
												<option @if($user->experience=="IT Software - E-Commerce") {{ $selected }} @endif value="IT Software - E-Commerce">IT Software - E-Commerce</option>
												<option @if($user->experience=="IT Software - ERP/CRM") {{ $selected }} @endif value="IT Software - ERP/CRM">IT Software - ERP/CRM</option>
											</optgroup>
										</select>
									</div>
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>Role</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-cube"></i>
										</span>
										<input type="text" class="form-control" value="{{ $user->role }}" name="role">
									</div>
								</div>
							</div>
							<!--/span-->
						</div>
						
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<!-- <form action="{{ url('job/newskill') }}" id="newskillfrm" method="post">					
									<input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
									<label>Search Skills</label>
									<div style="position:relative;">
										<input type="text" name="name" id="newskill" class="form-control" placeholder="Search for skill...">
											<button id="add-new-skill" style="position:absolute;right:0;top:0;" class="btn btn-success" type="button"><i class="icon-plus"></i> Add</button>	
											{!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
									</div>
								</div>
							</div>
							<!-- <div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>Added Skills <span class="required">
													* </span></label>
								    <input type="hidden" id="linked_skill" value="css, php" name="linked_skill" 
								     		class="form-control select2 uppercase"
								     		placeholder="List of skills to be added">
								    		
								    <input type="text" id="linked_skill" name="linked_skill" 
								     		class="form-control select2">
								</div>
							</div> -->
						</div>

						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group" style="">
									<label class="control-label">Upload Resume <small style="font-weight: 400; font-size: 13px;">(Optional) only pdf or word format</small></label>&nbsp;
									
									<div class="">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<span class="btn btn-default btn-file" style=" background-color: #44b6ae;  color: white;">
												<i class="icon-paper-clip" style="color: white;"></i>
												<span class="fileinput-new">Select File </span> 
												<span class="fileinput-exists">Upload New Resume </span>
												<input type="file" name="resume" accept='application/pdf,application/msword'>
											</span>
											<br>
											<span class="fileinput-new"></span>
											<span class="fileinput-filename"></span>&nbsp; 
											<a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"></a>
										</div>
									</div>
								</div>
							</div>
							<!--/span-->
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
			<div id="preference" class="tab-pane">
				<form action="{{ url('/individual/preferenceUpdate', Auth::user()->induser_id) }}" id="preference_validation" 
				class="horizontal-form prof_detail" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">						
						
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>Prefered Location </label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-map-marker"></i>
										</span>

										<input type="text" id="pref_loc" name="pref_loc" 
										class="form-control" placeholder="Select City"
										onblur="pref_loc_locality()">									
										
									</div>
									<!-- <input type="text" aria-hidden="true" id="prefered_location" value="" onblur="pref_loc_locality()"
											name="prefered_location[]" class="form-control select2"
											placeholder="Selected City" style="border: 0;"> -->
									{!! Form::select('prefered_location[]', [], null, ['id'=>'prefered_location', 'onchange'=>'pref_loc_locality()', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'city', 'multiple']) !!}		

											
								</div>
							</div>
							<!--/span-->
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>Area</label>
									<div class="input-group">
										<span class="input-group-addon">
										<i class="fa fa-map-marker"></i>
										</span>
										<input type="text" id="pref_locality"
										onblur="pref_loc_locality()" 
										name="p_localit" class="form-control" placeholder="Select Area">
										
									</div>
									<!-- <input type="text" id="preferred_locality" value="{{ $user->p_locality }}" placeholder="Selected Area" style="border:0" 
										name="p_locality" class="form-control select2" disabled > -->
								{!! Form::select('preferred_locality[]', [], null, ['id'=>'preferred_locality', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Area', 'multiple']) !!}		

								</div>
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
											<option @if($user->prefered_jobtype=="Full Time") {{ $selected }} @endif value="Full Time">Full Time</option>
											<option @if($user->prefered_jobtype=="Part Time") {{ $selected }} @endif value="Part Time">Part Time</option>
											<option @if($user->prefered_jobtype=="Freelancer") {{ $selected }} @endif value="Freelancer">Freelancer</option>
											<option @if($user->prefered_jobtype=="Work from home") {{ $selected }} @endif value="Work from home">Work from home</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					<!--end profile-settings-->
					<div class="margin-top-10">
						<button type="submit" name="individual" value="Save" class="btn green">
						<i class="fa fa-check"></i> Save Changes
						</button>
						<a href="/profile/ind/{{Auth::user()->induser_id}}" class="btn default">Cancel</a>
					</div>
				</form>
			</div>
			<div id="privacy" class="tab-pane">
				<form action="{{ url('/individual/privacyUpdate', Auth::user()->induser_id) }}" id="privacy_validation" 
				class="horizontal-form prof_detail" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<table class="table table-bordered table-striped">
					<tr>
						<td>
							 Who can see my Email Address.
						</td>
						<td>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="email_show" value="Everyone"
							@if($user->email_show == 'Everyone')
								checked
							@endif >
							Everyone </label>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="email_show" value="Links"
							@if($user->email_show == 'Links')
								checked
							@endif >
							Links </label>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="email_show" value="None"
							@if($user->email_show == 'None')
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
							<input type="radio" name="mobile_show" value="Everyone"
							@if($user->mobile_show == 'Everyone')
								checked
							@endif >
							Everyone </label>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="mobile_show" value="Links"
							@if($user->mobile_show == 'Links')
								checked
							@endif >
							Links </label>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="mobile_show" value="None"
							@if($user->mobile_show == 'None')
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
							<input type="radio" name="dob_show" value="Everyone"
							@if($user->dob_show == 'Everyone')
								checked
							@endif >
							Everyone </label>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="dob_show" value="Links"
							@if($user->dob_show == 'Links')
								checked
							@endif >
							Links </label>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="dob_show" value="None"
							@if($user->dob_show == 'None')
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
<script src="http://maps.googleapis.com/maps/api/js?libraries=places&region=IN" type="text/javascript"></script>
<script type="text/javascript">
	// var inputId_div = $("#city");
	
	function initializeCity() {
		var options = {	types: ['(cities)'], componentRestrictions: {country: "in"}};
		// var input = document.getElementById('city');

		var form = document.getElementById('profile_validation');
		var input = form[8];

		var autocomplete = new google.maps.places.Autocomplete(input, options);
		autocomplete.addListener('place_changed', onPlaceChanged);
		function onPlaceChanged() {
		  var place = autocomplete.getPlace();
		  if (place.address_components) { 
		  	city = place.address_components[0];
		  	document.getElementById('city').value = city.long_name;
		  } else { document.getElementById('autocomplete').placeholder = 'Enter a city'; }
		}
	}
   google.maps.event.addDomListener(window, 'load', initializeCity);   

	var prefLocationArray = [];
	<?php $arr = explode(', ', $user->prefered_location); ?> 
	@foreach($arr as $gt)
		prefLocationArray.push('<?php echo $gt; ?>');
	@endforeach

    // preferred loc    
    var plselect = $("#prefered_location").select2({ dataType: 'json', data: prefLocationArray });
    plselect.val(prefLocationArray).trigger("change"); 

    /*if(document.getElementById('prefered_location').value != ''){
  		prefLocationArray.push(document.getElementById('prefered_location').value);
  	}*/

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
		var options = {	types: ['(cities)'], componentRestrictions: {country: "in"}};
		var input = document.getElementById('pref_loc');
		var autocomplete = new google.maps.places.Autocomplete(input, options);
		autocomplete.addListener('place_changed', onPlaceChanged);

		function onPlaceChanged() {
		  var place = autocomplete.getPlace();
		  if (place.address_components) { 
		  	// console.log(place.address_components);
		  	pref_loc_city = place.address_components[0].long_name;
		  	if(place.address_components.length == 3){		  		
		  		pref_loc_state = '('+place.address_components[1].long_name+')';
		  	}else if(place.address_components.length == 4){
		  		pref_loc_state = '('+place.address_components[2].long_name+')';
		  	}else if(place.address_components.length == 5){
		  		pref_loc_state = '('+place.address_components[2].long_name+')';
		  	}else{
		  		pref_loc_state = '';
		  	}
		  	setTimeout(function(){ prefLoc.val(''); prefLoc.focus();},0);
		  	var selectedLoc = document.getElementById('prefered_location').value;
		  	if(selectedLoc == ''){	
		  		selectedLoc = selectedLoc + pref_loc_city+pref_loc_state;
		  		prefLocationArray.push(pref_loc_city+pref_loc_state);
		  	}else{
		  		selectedLoc = selectedLoc + ', '+pref_loc_city+pref_loc_state;
		  		prefLocationArray.push(pref_loc_city+pref_loc_state);
		  	}

		  	document.getElementById('prefered_location').value = selectedLoc;				
		  	
		  	$("#prefered_location").select2({ dataType: 'json', data: prefLocationArray });
        	plselect.val(prefLocationArray).trigger("change"); 

		  	// console.log(place);
		  } else { 
		  	document.getElementById('autocomplete').placeholder = 'Your preferred location'; 
		  }
		}

	}
   google.maps.event.addDomListener(window, 'load', initPrefLoc);

   	var prefLocalityArray = [];
   	<?php $arrPLocality = explode(', ', $user->p_locality); ?> 


	@foreach($arrPLocality as $pl)
		@if($pl != '')
			prefLocalityArray.push('<?php echo $pl; ?>');			
		@endif
	@endforeach

	var plocalselect = $("#preferred_locality").select2({ dataType: 'json', data: prefLocalityArray });
    plocalselect.val(prefLocalityArray).trigger("change"); 
    

	function pref_loc_locality(){
		var selected_pref_locations = (document.getElementById('prefered_location').value).split(',');
		var selected_pref_locality = (document.getElementById('preferred_locality').value).split(',');
		if(prefLocationArray.length == 1){
			document.getElementById("prefered_location").disabled = false;
			document.getElementById("pref_locality").disabled = false;
			document.getElementById("pref_locality").value = '';
		}else if(prefLocationArray.length > 1){
			document.getElementById("prefered_location").disabled = false;
			document.getElementById("pref_locality").disabled = true;
			document.getElementById("preferred_locality").disabled = true;
			prefLocalityArray = [];
			plocalselect.val(prefLocalityArray).trigger("change");
			document.getElementById("pref_locality").value = 'Can\'t select locality for multiple location';
		}else if(document.getElementById('prefered_location').value == ''){
			document.getElementById("pref_locality").disabled = true;
			prefLocalityArray = [];
			plocalselect.val(prefLocalityArray).trigger("change"); 
			document.getElementById("pref_locality").value = 'Select one preferred location.';
			document.getElementById("preferred_locality").disabled = true;
		}

		if(document.getElementById('preferred_locality').value == ''){
			document.getElementById("preferred_locality").disabled = true;
		}else if(prefLocalityArray.length >= 1 && prefLocationArray.length == 1){
			document.getElementById("preferred_locality").disabled = false;
		}else{
			document.getElementById("preferred_locality").disabled = true;
		}
	}
	
	var prefLoc2 = $("#pref_locality");
	function initializePrefLocality() {
		var options = {	types: ['(regions)'], componentRestrictions: {country: "in"} };
		var input = document.getElementById('pref_locality');
		var autocomplete = new google.maps.places.Autocomplete(input, options);
		autocomplete.addListener('place_changed', onPlaceChanged);
		function onPlaceChanged() {
		  var place2 = autocomplete.getPlace();
		  if (place2.address_components) { 
		  	var pref_locality = place2.address_components[0].long_name;

		  	setTimeout(function(){ prefLoc2.val(''); prefLoc2.focus();},0);
		  	var selectedLocality = document.getElementById('preferred_locality').value;
		  	if(selectedLocality == ''){
		  		selectedLocality = selectedLocality + pref_locality;
		  		prefLocalityArray.push(selectedLocality);
		  	}else{
		  		selectedLocality = selectedLocality + ', '+pref_locality;
		  		prefLocalityArray.push(selectedLocality);
		  	}	

		  	document.getElementById('preferred_locality').value = selectedLocality;
		  	pref_loc_locality();
		  	$("#preferred_locality").select2({ dataType: 'json', data: prefLocalityArray });
        	plocalselect.val(prefLocalityArray).trigger("change"); 
		  	// console.log(place2);
		  } else { document.getElementById('pref_locality').placeholder = 'select some locality'; }
		}
	}
   google.maps.event.addDomListener(window, 'load', initializePrefLocality); 

   var $eventSelect = $("#preferred_locality"); 
	$eventSelect.on("select2:unselect", function (e) {
		// console.log("Removing: "+e.params.data.id);
		// remove corresponding value from array
		prefLocalityArray = $.grep(prefLocalityArray, function(value) {
		  return value != e.params.data.id;
		});
		// remove select option for pref loc
		$("#preferred_locality option[value='"+e.params.data.id+"']").remove();		
		if(prefLocalityArray.length == 0){
			plocalselect = $("#preferred_locality").select2({ dataType: 'json', data: [] });
		}else{
			plocalselect = $("#preferred_locality").select2({ dataType: 'json', data: prefLocalityArray });
		}
		plocalselect.val(prefLocalityArray).trigger("change"); 
		// updated array
		
	});


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


<script src="{{ asset('/assets/ind_validation.js') }}"></script>
<script>
	jQuery(document).ready(function() { 
	    ComponentsIonSliders.init();
	    // ComponentsDropdowns.init();
	    ComponentsEditors.init();
	});   
</script>
<script type="text/javascript">
      function countChar(val) {
        var len = val.value.length;
        if (len >= 1000) {
          val.value = val.value.substring(0, 1000);
        } else {
          $('#charNum').text(1000 - len);
        }
      };
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

// rules: {
// working_at: {
// required: function(element) {
// return $("#working_status").val() == 'Working'
// }
// }
// }
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
			      url: "{{ url('job/newskill') }}",
			      type: "POST",
			      data: { name: name },
			      cache : false,
			      success: function(data){
			        if(data > 0){
			        	$newSkillList = new Array();

			        	<?php $newSkillList = array(); ?>
						@foreach($skills as $skill)
							$newSkillList.push('<?php echo $skill; ?>');
						@endforeach

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
@stop