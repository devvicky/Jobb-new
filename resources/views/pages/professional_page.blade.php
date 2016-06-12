@extends('master')

@section('content')

<!-- BEGIN PAGE BREADCRUMB -->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="/home">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="/profile/ind/{{Auth::user()->id}}">Profile View</a><i class="fa fa-angle-right"></i>
		</li>
		<li class="active">
			Profile Edit
		</li>
	</ul>
</div>
<!-- END PAGE BREADCRUMB -->
<?php $selected = 'selected'; ?> 
<div class="row margin-top-10">
	<div class="col-md-12">
		<!-- BEGIN PROFILE SIDEBAR -->
		<div class="profile-sidebar" style="width: 250px;">
			<!-- PORTLET MAIN -->
			<div class="portlet light profile-sidebar-portlet">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<a id="ajax-demo" href="#profile-pic" data-toggle="modal" class="config">
	                    @if($user->induser->profile_pic == null && $user->induser->fname != null)
	                      <div class="hover-image"><i class="fa fa-camera"></i> Add</div>
	                    @endif      
	                    @if($user->induser->profile_pic != null)
	                      <img src="/img/profile/{{ $user->induser->profile_pic }}" class="img-responsive">
	                      <!-- <div class="hover-image"><i class="glyphicon glyphicon-edit"></i>Edit</div> -->
	                      <span class="edit-image"><i class="glyphicon glyphicon-edit" style="font-size:10px;"></i> Edit</span>
	                    @else
	                      	<div class=" badge-margin post-image-css">
		                        <i class="fa fa-user" style="font-size: 65px;margin: 53px 40px;color: lightgray;"></i> 
		                    </div>
	                      <!-- <div class="hover-image"><i class="glyphicon glyphicon-edit"></i>Edit</div> -->
	                      <span class="edit-image"><i class="glyphicon glyphicon-edit" style="font-size:10px;"></i> Add</span>
	                    @endif

	                </a>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						 {{ $user->induser->fname }} {{ $user->induser->lname }}
					</div>
					<div class="profile-usertitle-job">
						@if($user->induser->role != null) {{$user->induser->role}} @endif 
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
		              @if($profilePer <= 25)
		              <div class="progress" style="margin: 3px;border-radius: 13px !important;height:10px;background-color: #ddd;">
		                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" style="width:{{$profilePer}}%;color:black;">
		                  
		                </div>
		              </div>
		              <label style="font-size:12px;color:#777;"> {{$profilePer}}% Profile Complete</label>
		              @elseif($profilePer > 25 && $profilePer <=50)
		             <div class="progress" style="margin: 3px;border-radius: 13px !important;height:10px;background-color: #ddd;">
		                <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" style="width:{{$profilePer}}%;color:black;">
		                  
		                </div>
		              </div>
		              <label style="font-size:12px;color:#777;"> {{$profilePer}}% Profile Complete</label>
		              @elseif($profilePer > 50 && $profilePer <=75)
		              <div class="progress" style="margin: 3px;border-radius: 13px !important;height:10px;background-color: #ddd;">
		                <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" style="width:{{$profilePer}}%;color:black;">
		                  
		                </div>
		              </div>
		               <label style="font-size:12px;color:#777;"> {{$profilePer}}% Profile Complete</label>
		              @elseif($profilePer > 75)
		              <div class="progress" style="margin: 3px;border-radius: 13px !important;height:10px;background-color: #ddd;">
		                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" style="width:{{$profilePer}}%;color:black;background-color: #27D8CD;">
		                   
		                </div>
		              </div>
		              <label style="font-size:12px;color:#777;"> {{$profilePer}}% Profile Complete</label>
		              @endif
		            </div>
				</div>
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu" style="margin-top: 5px;">
					<ul class="nav" style="padding:0;">
						<li>
							<a href="/profile/ind/{{$user->id}}">
							<i class="icon-home"></i>
							Overview </a>
						</li>
						<li class="active">
							<a href="#tab_1_1" data-toggle="tab"><i class=" icon-user"></i> Personal Info</a>
						</li>
						
						<li>
							<a href="#tab_1_3" data-toggle="tab"><i class="icon-briefcase"></i> Professional Details</a>
						</li>
						<li>
							<a href="#tab_1_4" data-toggle="tab"><i class="icon-settings"></i> Account Settings</a>
						</li>
					</ul>
					
				</div>
				<!-- END MENU -->
				<!-- PORTLET MAIN -->
		</div>
		<div class="portlet light">
			<div class="row list-separated profile-stat" style="text-align:center;">
				<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'connections'){{'active'}}@endif" style="padding:0;">
					<a href="/connections/create" class="icon-btn icon-btn-new">
						<i class="icon-link"></i>
						<div>
							 Links
						</div>
						<span class="badge badge-danger @if($linksCount > 0) show @else hide @endif" style="background-color: #26a69a;">
						{{$linksCount}} </span>
					</a>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'notify_view'){{'active'}}@endif" style="padding:0;">
					<a href="/notify/thanks/ind/{{Auth::user()->induser_id}}" data-utype="thank" class="icon-btn icon-btn-new">
						<i class="icon-like"></i>
						<div>
							 Thanks
						</div>
						<span class="badge badge-danger  @if($thanks > 0) show @else hide @endif" style="background-color: #3598dc;">
						{{$thanks}}</span>
					</a>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'mypost'){{'active'}}@endif" style="padding:0;">
					<a href="/mypost" class="icon-btn icon-btn-new">
						<i class="icon-note"></i>
						<div>
							 Posts
						</div>
						<span class="badge badge-danger  @if($posts > 0) show @else hide @endif">
						{{$posts}} </span>
					</a>
				</div>
			</div>
		</div>
		<!-- END PORTLET MAIN -->
	</div>
	<!-- BEGIN PROFILE CONTENT -->
	<div class="profile-content">
		<div class="row">
			<div class="col-md-12">
				<div class="">
					<div class="">
						<div class="tab-content">
							<!-- PERSONAL INFO TAB -->
							<div class="tab-pane active" id="tab_1_1">
										<div class="row">
											<div class="col-md-12">
												<!-- BEGIN PORTLET -->

											<form action="/personal/info" id="profile-validation-{{$user->induser->id}}" method="post">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<input type="hidden" name="userid" value="{{$user->induser->id}}">
												<div class="portlet light " style="background-color:white;">
													<div class="portlet-title">
														<div class="caption caption-md">
															<i class="icon-bar-chart theme-font hide"></i>
															<span class="caption-subject font-blue-madison bold uppercase">Person Info</span>
														</div>
													</div>
													<div class="portlet-body">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">First Name<span class="required">
																			* </span></label>
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="glyphicon glyphicon-font" style="color:darkcyan;"></i>
																		</span>
																		<input type="text" name="fname" value="{{$user->induser->fname}}" class="form-control" placeholder="First Name">
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Last Name<span class="required">
																			* </span></label>
																	
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="glyphicon glyphicon-font" style="color:darkcyan;"></i>
																		</span>
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
																		<input class="form-control " name="dob" size="16"  type="date" value="{{ $user->induser->dob }}"/>
																	</div>
																	<label style="font-size:11px;opacity:.8;"><span class="required">*</span> You must be above 18 years of age.</label>
																</div>
															</div>
															<!--/span-->
															<div class="col-md-6">
																<div class="form-group">
																	<label>Gender<span class="required">
																			* </span></label>
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="icon-user" style="color:darkcyan;"></i>
																		</span>
																		<select class="form-control" name="gender">
																			<option value="">Select</option>
																			<option @if($user->induser->gender=="Male") {{ $selected }} @endif value="Male">Male</option>
																			<option @if($user->induser->gender=="Female") {{ $selected }} @endif value="Female">Female</option>
																			<option @if($user->induser->gender=="Others") {{ $selected }} @endif value="Others">Others</option>
																		</select>
																	</div>
																</div>
															</div>
															<!--/span-->
														</div>
														<div class="form-actions">
															<button type="button" data-userid="{{$user->induser->id}}" class="btn btn-sm green personalinfo-update">Update</button>
															<a href="/profile/ind/{{Auth::user()->induser_id}}" class="btn btn-sm default">Cancel</a>
														</div>
													</div>
												</div>
											</form>
												<!-- END PORTLET -->
												
											</div>
											<div class="col-md-12">
												<form action="/contact/info" id="contact-validation-{{$user->induser->id}}" method="post">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<input type="hidden" name="userid" value="{{$user->induser->id}}">
												<!-- BEGIN PORTLET -->
												<div class="portlet light " style="background-color:white;">
													<div class="portlet-title">
														<div class="caption caption-md">
															<i class="icon-bar-chart theme-font hide"></i>
															<span class="caption-subject font-blue-madison bold uppercase">Contact Info</span>
														</div>
													</div>
													<div class="portlet-body">
														<div class="row">
															<div class="col-md-6 col-sm-6">
																@if($user->mobile != null)
																<div class="form-group">
																	<label>Mobile No 
																		@if($user->mobile != null && $user->mobile_verify == 1) 
																			<small class="verified-css">Verified</small>
																		@elseif($user->mobile != null && $user->mobile_verify == 0)
																			<small class="not-verified-css">Not Verified</small>
																		@elseif($user->mobile == null)
																		@endif
																	</label>
																	@if($user->email_verify == 1 && $user->mobile_verify == 1)
																			<a href="#delete-me-modal" data-toggle="modal" data-type="mobiledelete" class="delete-me" style="margin: 20px;">
																				<i class="fa fa-trash-o" style="color:#FF050D;font-size:16px;"></i>
																			</a>
																		@endif	
																	<div class="input-group">
																		<!-- <span class="input-group-addon">
																			<i class="icon-call-end"></i>
																		</span> -->
																		<span class="input-group-addon">
																			+91
																		</span>
																		<!-- <label style="position: absolute;z-index: 999999; margin: 7px 2px;">+91 - </label> -->
																		<input type="text" 
																				name="mobile" 
																				class="form-control" 
																				placeholder="Mobile No" 
																				value="{{ $user->mobile }}" 
																				@if($user->mobile_verify == 1)readonly @endif>
																		<span class="input-group-addon email-mobile-edit-btn">
																			<a href="#edit-me-modal" data-toggle="modal" data-type="mobile" class="change-me" style="color:white !important;text-decoration:none;">
																				Edit
																			</a>
																		</span>
																	</div>
																</div>
																@else
																<div style="margin: 25px 0;">
																	<a href="#edit-me-modal" data-toggle="modal" data-type="mobile" class="change-me">
																				<i class="fa fa-plus"></i> Add Mobile No
																			</a>
																		</div>
																@endif
															</div>
															<!--/span-->
															<div class="col-md-6 col-sm-6">
																@if($user->email != null)
																<div class="form-group">
																	<label>Email Id 
																		@if($user->email != null && $user->email_verify == 1) 
																			<small class="verified-css">Verified</small>
																		@elseif($user->email != null && $user->email_verify == 0)
																			<small class="not-verified-css">Not Verified</small>
																		@elseif($user->email == null)
																		@endif
																	</label>
																	@if($user->email_verify == 1 && $user->mobile_verify == 1)
																			<a href=".delete-me-modal" data-toggle="modal" data-type="emaildelete" class="delete-me" style="margin: 20px;">
																				<i class="fa fa-trash-o" style="color:#FF050D;font-size:16px;"></i>
																			</a>
																		@endif								
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="icon-envelope"></i>
																		</span>
																		<input type="text" name="email" 
																				class="form-control" 
																				placeholder="Email Id" 
																				value="{{ $user->email }}"
																				@if($user->email_verify == 1)readonly @endif>
																		
																		<span class="input-group-addon email-mobile-edit-btn">
																			<a href="#edit-email-modal" data-toggle="modal" data-type="email" class="change-email" style="color:white !important;text-decoration:none;">
																				Edit
																			</a>
																		</span>

																	</div>
																</div>

																@else
																<div style="margin: 25px 0;">
																	<a href="#edit-email-modal" data-toggle="modal" data-type="email" class="change-mail">
																				<i class="fa fa-plus"></i> Add Email Id
																			</a>
																		</div>
																@endif
															</div>
															<!--/span-->
														</div>
														<div class="row">
															<div class="col-md-6 col-sm-6">
																<div class="form-group">
																	<label>Linkedin Id</label>									
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-linkedin"></i>
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
																		<i class="fa fa-facebook"></i>
																		</span>
																		<input type="text" name="fb_page" class="form-control" value="{{ $user->induser->fb_page }}" placeholder="Facebook Id">
																	</div>
																</div>
															</div>
															<!--/span-->
														</div>
														<div class="form-actions">
															<button type="button" data-userid="{{$user->induser->id}}" class="btn btn-sm green contactinfo-update">Update</button>
															<a href="/profile/ind/{{Auth::user()->induser_id}}" class="btn btn-sm default">Cancel</a>
														</div>
													</div>
												</div>
												<!-- END PORTLET -->
											</form>
											</div>
											<div class="col-md-12">
												<form action="/address/update" id="address-validation-{{$user->induser->id}}" method="post">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<input type="hidden" name="userid" value="{{$user->induser->id}}">
												<!-- BEGIN PORTLET -->
												<div class="portlet light " style="background-color:white;">
													<div class="portlet-title">
														<div class="caption caption-md">
															<i class="icon-bar-chart theme-font hide"></i>
															<span class="caption-subject font-blue-madison bold uppercase">Address</span>
														</div>
													</div>
													<div class="portlet-body">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Address 1</label>
																	<div class="input-group">
																		<span class="input-group-addon">
																		<i class="glyphicon glyphicon-globe"></i>
																		</span>
																		<input type="text" name="address_1" class="form-control" value="{{ $user->induser->address_1 }}" placeholder="Address">
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>Address 2</label>
																	<div class="input-group">
																		<span class="input-group-addon">
																		<i class="glyphicon glyphicon-globe"></i>
																		</span>
																		<input type="text" name="address_2" class="form-control" value="{{ $user->induser->address_2 }}" placeholder="Address">
																	</div>
																</div>
															</div>
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
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="form-group">
																	<label>Country<span class="required">
																			* </span></label>
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-map-marker"></i>
																		</span>
																		<select name="country" disabled id="select2_sample4" class="form-control select2">
																			<option selected value="IN">India</option>
																		</select>										
																	</div>
																</div>
															</div>
														</div>
														<div class="form-actions">
															<button type="button" data-userid="{{$user->induser->id}}" class="btn btn-sm green addressinfo-update">Update</button>
															<a href="/profile/ind/{{Auth::user()->induser_id}}" class="btn btn-sm default">Cancel</a>
														</div>
													</div>
												</div>
												<!-- END PORTLET -->
											</form>
											</div>
										</div>							<!-- </div> -->
								</div>
							<!-- END PERSONAL INFO TAB -->
							<!-- CHANGE AVATAR TAB -->
							<div class="tab-pane" id="tab_1_3">
								<!-- <div class="portlet light " style="background-color:white;"> -->
									<div class="form-body">
										<div class="row">
											<div class="col-md-12">
												<form action="/professional/update" id="professional-validation-{{$user->induser->id}}" 
													class="horizontal-form prof_detail" method="post" enctype="multipart/form-data">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="userid" value="{{$user->induser->id}}">
												<!-- BEGIN PORTLET -->
												<div class="portlet light " style="background-color:white;">
													<div class="portlet-title">
														<div class="caption caption-md">
															<i class="icon-bar-chart theme-font hide"></i>
															<span class="caption-subject font-blue-madison bold uppercase">Professional Details</span>
														</div>
													</div>
													<div class="portlet-body">
														 <div class="row">
		                                                    <div class="col-md-12">
		                                                        <div class="form-group">
		                                                            <label>About Me</label>
		                                                                <!-- <textarea   onkeyup="countChar(this)" class="form-control" rows="6"> </textarea>
		                                                            <div id="charNum" style="text-align:right;"></div> -->
		                                                            <textarea id="textarea" rows="6" class="form-control " maxlength="500" name="about_individual" placeholder="write about your proffessional summary...">{{ $user->induser->about_individual }}</textarea>
		                                                                    <div id="textarea_feedback" style="float: right;color: grey;"></div>
		                                                        </div>
		                                                    </div>
		                                                </div>  
		                                                <div class="row">
		                                                    <div class="col-md-6 col-sm-6">
		                                                        <div class="form-group">
		                                                            <label>Education <span class="required">
		                                                                    * </span></label>
		                                                            <!-- <div class="input-group"> -->
		                                                                <!-- <span class="input-group-addon">
		                                                                    <i class="icon-graduation"></i>
		                                                                </span> -->
		                                                                @if($user->induser->education == null)
		                                                                <select class="select2me form-control education-list" name="education" style="border:1px solid #c4d5df">
		                                                                    <option selected value="">Select</option>
		                                                                    {{$n=""}}
		                                                                    @foreach($educationList as $edu)
		                                                                    
		                                                                        @if($n != $edu->name && $edu->name != '0')
		                                                                            {{$n=$edu->name}}
		                                                                            <optgroup label="{{$edu->name}}">
		                                                                        @endif
		                                                                            <option value="{{$edu->name}}-{{$edu->branch}}-{{$edu->level}}" @if($user->induser->education=="{{$edu->branch}}-{{$edu->name}}") {{ $selected }} @endif>{{$edu->branch}}</option>
		                                                                        @if($n != $edu->name)
		                                                                            </optgroup>     
		                                                                        @endif

		                                                                    @endforeach
		                                                                </select>
		                                                                @else
		                                                                <select class="select2me form-control education-list" name="education" value="{{$user->induser->education}}"
		                                                                         style="border:1px solid #c4d5df">
		                                                                         <?php $education = explode('-', $user->induser->education); 
		                                                                                $name = $education[0];
		                                                                                $branch = $education[1];
		                                                                                $level = $education[2];  ?>
		                                                                        <option selected value="{{$name}}-{{$branch}}-{{$level}}">{{$name}}-{{$branch}}</option>
		                                                                    {{$n=""}}
		                                                                    @foreach($educationList as $edu)
		                                                                    
		                                                                        @if($n != $edu->name && $edu->name != '0')
		                                                                            {{$n=$edu->name}}
		                                                                            <optgroup label="{{$edu->name}}">
		                                                                        @endif
		                                                                            <option value="{{$edu->name}}-{{$edu->branch}}-{{$edu->level}}">{{$edu->name}}-{{$edu->branch}}</option>
		                                                                        @if($n != $edu->name)
		                                                                            </optgroup>     
		                                                                        @endif

		                                                                    @endforeach
		                                                                </select>
		                                                                @endif                              
		                                                            <!-- </div> -->
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
		                                                            <label>Industry <span class="required">*</span>
		                                                            </label>
		                                                            <select class="select2me form-control" name="industry">
		                                                                <option value="">Select</option>
		                                                                <option @if($user->induser->industry=="Automotive/ Ancillaries") {{ $selected }} @endif value="Automotive/ Ancillaries">Automotive/ Ancillaries</option>
		                                                                <option @if($user->induser->industry=="Banking/ Financial Services") {{ $selected }} @endif value="Banking/ Financial Services">Banking/ Financial Services</option>
		                                                                <option @if($user->induser->industry=="Bio Technology & Life Sciences") {{ $selected }} @endif value="Bio Technology & Life Sciences">Bio Technology & Life Sciences</option>
		                                                                <option @if($user->induser->industry=="Chemicals/Petrochemicals") {{ $selected }} @endif value="Chemicals/Petrochemicals">Chemicals/Petrochemicals</option>
		                                                                <option @if($user->induser->industry=="Construction") {{ $selected }} @endif value="Construction">Construction</option>
		                                                                <option @if($user->induser->industry=="FMCG") {{ $selected }} @endif value="FMCG">FMCG</option>
		                                                                <option @if($user->induser->industry=="Education") {{ $selected }} @endif value="Education">Education</option>
		                                                                <option @if($user->induser->industry=="Entertainment/ Media/ Publishing") {{ $selected }} @endif value="Entertainment/ Media/ Publishing">Entertainment/ Media/ Publishing</option>
		                                                                <option @if($user->induser->industry=="Insurance") {{ $selected }} @endif value="Insurance">Insurance</option>
		                                                                <option @if($user->induser->industry=="ITES/BPO") {{ $selected }} @endif value="ITES/BPO">ITES/BPO</option>
		                                                                <option @if($user->induser->industry=="IT/ Computers - Hardware") {{ $selected }} @endif value="IT/ Computers - Hardware">IT/ Computers - Hardware</option>
		                                                                <option @if($user->induser->industry=="IT/ Computers - Software") {{ $selected }} @endif value="IT/ Computers - Software">IT/ Computers - Software</option>
		                                                                <option @if($user->induser->industry=="KPO/Analytic") {{ $selected }} @endif value="KPO/Analytics">KPO/Analytics</option>
		                                                                <option @if($user->induser->industry=="Machinery/ Equipment Mfg.") {{ $selected }} @endif value="Machinery/ Equipment Mfg.">Machinery/ Equipment Mfg.</option>
		                                                                <option @if($user->induser->industry=="Oil/ Gas/ Petroleum") {{ $selected }} @endif value="Oil/ Gas/ Petroleum">Oil/ Gas/ Petroleum</option>
		                                                                <option @if($user->induser->industry=="Pharmaceuticals") {{ $selected }} @endif value="Pharmaceuticals">Pharmaceuticals</option>
		                                                                <option @if($user->induser->industry=="Power/Energy") {{ $selected }} @endif value="Power/Energy">Power/Energy</option>
		                                                                <option @if($user->induser->industry=="Retailing") {{ $selected }} @endif value="Retailing">Retailing</option>
		                                                                <option @if($user->induser->industry=="Telecom") {{ $selected }} @endif value="Telecom">Telecom</option>
		                                                                <option @if($user->induser->industry=="Advertising/PR/Events") {{ $selected }} @endif value="Advertising/PR/Events">Advertising/PR/Events</option>
		                                                                <option @if($user->induser->industry=="Agriculture/ Dairy Based") {{ $selected }} @endif value="Agriculture/ Dairy Based">Agriculture/ Dairy Based</option>
		                                                                <option @if($user->induser->industry=="Aviation/Aerospace") {{ $selected }} @endif value="Aviation/Aerospace">Aviation/Aerospace</option>
		                                                                <option @if($user->induser->industry=="Beauty/Fitness/PersonalCare/SPA") {{ $selected }} @endif value="Beauty/Fitness/PersonalCare/SPA">Beauty/Fitness/PersonalCare/SPA</option>
		                                                                <option @if($user->induser->industry=="Beverages/ Liquor") {{ $selected }} @endif value="Beverages/ Liquor">Beverages/ Liquor</option>
		                                                                <option @if($user->induser->industry=="Cement") {{ $selected }} @endif value="Cement">Cement</option>
		                                                                <option @if($user->induser->industry=="Ceramics & Sanitary Ware") {{ $selected }} @endif value="Ceramics & Sanitary Ware">Ceramics & Sanitary Ware</option>
		                                                                <option @if($user->induser->industry=="Consultancy") {{ $selected }} @endif value="Consultancy">Consultancy</option>
		                                                                <option @if($user->induser->industry=="Courier/ Freight/ Transportation") {{ $selected }} @endif value="Courier/ Freight/ Transportation">Courier/ Freight/ Transportation</option>
		                                                                <option @if($user->induser->industry=="Law Enforcement/Security Services") {{ $selected }} @endif value="Law Enforcement/Security Services">Law Enforcement/Security Services</option>
		                                                                <option @if($user->induser->industry=="E-Learning") {{ $selected }} @endif value="E-Learning">E-Learning</option>
		                                                                <option @if($user->induser->industry=="Shipping/ Marine Services") {{ $selected }} @endif value="Shipping/ Marine Services">Shipping/ Marine Services</option>
		                                                                <option @if($user->induser->industry=="Engineering, Procurement, Construction") {{ $selected }} @endif value="Engineering, Procurement, Construction">Engineering, Procurement, Construction</option>
		                                                                <option @if($user->induser->industry=="Environmental Service") {{ $selected }} @endif value="Environmental Service">Environmental Service</option>
		                                                                <option @if($user->induser->industry=="Facility management") {{ $selected }} @endif value="Facility management">Facility management</option>
		                                                                <option @if($user->induser->industry=="Fertilizer/ Pesticides") {{ $selected }} @endif value="Fertilizer/ Pesticides">Fertilizer/ Pesticides</option>
		                                                                <option @if($user->induser->industry=="Food & Packaged Food") {{ $selected }} @endif value="Food & Packaged Food">Food & Packaged Food</option>
		                                                                <option @if($user->induser->industry=="Textiles / Yarn / Fabrics / Garments") {{ $selected }} @endif value="Textiles / Yarn / Fabrics / Garments">Textiles / Yarn / Fabrics / Garments</option>
		                                                                <option @if($user->induser->industry=="Gems & Jewellery") {{ $selected }} @endif value="Gems & Jewellery">Gems & Jewellery</option>
		                                                                <option @if($user->induser->industry=="Government/ PSU/ Defence") {{ $selected }} @endif value="Government/ PSU/ Defence">Government/ PSU/ Defence</option>
		                                                                <option @if($user->induser->industry=="Consumer Electronics/Appliances") {{ $selected }} @endif value="Consumer Electronics/Appliances">Consumer Electronics/Appliances</option>
		                                                                <option @if($user->induser->industry=="Hospitals/ Health Care") {{ $selected }} @endif value="Hospitals/ Health Care">Hospitals/ Health Care</option>
		                                                                <option @if($user->induser->industry=="Hotels/ Restaurant") {{ $selected }} @endif value="Hotels/ Restaurant">Hotels/ Restaurant</option>
		                                                                <option @if($user->induser->industry=="Import / Export") {{ $selected }} @endif value="Import / Export">Import / Export</option>
		                                                                <option @if($user->induser->industry=="Market Research") {{ $selected }} @endif value="Market Research">Market Research</option>
		                                                                <option @if($user->induser->industry=="Medical Transcription") {{ $selected }} @endif value="Medical Transcription">Medical Transcription</option>
		                                                                <option @if($user->induser->industry=="Mining") {{ $selected }} @endif value="Mining">Mining</option>
		                                                                <option @if($user->induser->industry=="NGO") {{ $selected }} @endif value="NGO">NGO</option>
		                                                                <option @if($user->induser->industry=="Paper") {{ $selected }} @endif value="Paper">Paper</option>
		                                                                <option @if($user->induser->industry=="Printing / Packaging") {{ $selected }} @endif value="Printing / Packaging">Printing / Packaging</option>
		                                                                <option @if($user->induser->industry=="Public Relations (PR)") {{ $selected }} @endif value="Public Relations (PR)">Public Relations (PR)</option>
		                                                                <option @if($user->induser->industry=="Travel / Tourism") {{ $selected }} @endif value="Travel / Tourism">Travel / Tourism</option>
		                                                                <option @if($user->induser->industry=="Other") {{ $selected }} @endif value="Other">Other</option>
		                                                            </select>
		                                                        </div>
		                                                    </div>
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
		                                                                    <option value="{{$user->induser->functional_area}}-{{$user->induser->role}}">{{$user->induser->functional_area}}-{{$user->induser->role}}</option>
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
		                                                </div>
		                                                
		                                                <div class="row">
		                                                    <div class="col-md-6 col-sm-6">
		                                                        <div class="form-group">
		                                                            <!-- <form action="{{ url('job/newskill') }}" id="newskillfrm" method="post">                   
		                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
		                                                            <label>Search Skills<span class="required"> * </span></label>
		                                                            <div style="position:relative;">
		                                                                <input type="text" name="name" id="newskill" class="form-control" placeholder="Search for skill..." style="border-bottom-left-radius: 0;border-bottom: 0;">
		                                                                    <button id="add-new-skill" class="btn btn-success skill-add-button" type="button"><i class="icon-plus"></i> Add</button>    
		                                                                    {!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="form-actions">
															<button type="button" data-userid="{{$user->induser->id}}" class="btn btn-sm green professional-update">Update</button>
															<a href="/profile/ind/{{Auth::user()->induser_id}}" class="btn btn-sm default">Cancel</a>
														</div>
													</div>
												</div>
											</form>
											</div>
											
											<div class="col-md-12">
												<form action="/preference/update" id="preference-validation-{{$user->induser->id}}" 
													class="horizontal-form prof_detail" method="post" enctype="multipart/form-data">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="userid" value="{{$user->induser->id}}">
													<!-- BEGIN PORTLET -->
													<div class="portlet light " style="background-color:white;">
														<div class="portlet-title">
															<div class="caption caption-md">
																<i class="icon-bar-chart theme-font hide"></i>
																<span class="caption-subject font-blue-madison bold uppercase">Job Preference</span>
															</div>
														</div>
														<div class="portlet-body">
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
																				<option value="">Select</option>
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
																<div class="col-md-6">
			                                                		<label class="contro-label">Job Agreement</label>
			                                                		<div class="form-group">
			                                                			 <div class="input-group">
			                                                                <span class="input-group-addon">
			                                                                    <i class="fa fa-inr"></i>
			                                                                </span>
			                                                                <select class="form-control" name="job_agreement">
			                                                                	<option value="">Select</option>
			                                                                	<option @if($user->induser->job_agreement=="Contract") {{ $selected }} @endif value="Contract">Contract</option>
			                                                                	<option @if($user->induser->job_agreement=="Permanent") {{ $selected }} @endif value="Permanent">Permanent</option>
			                                                                </select>
			                                                            </div>
			                                                		</div>
			                                                	</div>
															</div>
															<div class="row">
			                                                	<div class="col-md-6">
			                                                		<label class="contro-label">Expected Salary</label>
			                                                		<div class="form-group">
			                                                			 <div class="input-group">
			                                                                <span class="input-group-addon">
			                                                                    <i class="fa fa-inr"></i>
			                                                                </span>
			                                                                <input class="form-control" name="expected_salary" value="{{$user->induser->expected_salary}}" placeholder="Expected Salary" style="width:60%;">
			                                                                <select class="form-control" name="salary_type" style="width:40%;border-left: 0;">
			                                                                	<option value="">Select</option>
			                                                                	<option @if($user->induser->salary_type=="Monthly") {{ $selected }} @endif value="Monthly">Monthly</option>
			                                                                	<option @if($user->induser->salary_type=="Weekly") {{ $selected }} @endif value="Weekly">Weekly</option>
			                                                                	<option @if($user->induser->salary_type=="Daily") {{ $selected }} @endif value="Daily">Daily</option>
			                                                                	<option @if($user->induser->salary_type=="Hourly") {{ $selected }} @endif value="Hourly">Hourly</option>
			                                                                	<option @if($user->induser->salary_type=="Per Visit") {{ $selected }} @endif value="Per Visit">Per Visit</option>
			                                                                </select>
			                                                            </div>
			                                                		</div>
			                                                	</div>
			                                                	<div class="col-md-6 col-sm-6 col-xs-12">
				                                            		<div class="form-group">
				                                                        <label class=" control-label">I can start Work</label>
				                                                        <div class="input-group">
				                                                            <span class="input-group-addon">
				                                                                <i class="fa fa-clock-o"></i>
				                                                            </span>
				                                                            <select  name="candidate_availablity" class="form-control" style="">   
				                                                            	<option value="">Select</option>                                 
					                                                            <option @if($user->induser->candidate_availablity=="0") {{ $selected }} @endif value="0">Immediate</option>
					                                                            <option @if($user->induser->candidate_availablity=="7") {{ $selected }} @endif value="7">in 7 Days </option>
					                                                            <option @if($user->induser->candidate_availablity=="15") {{ $selected }} @endif value="15">in 15 Days</option>
					                                                            <option @if($user->induser->candidate_availablity=="30") {{ $selected }} @endif value="30">in 30 Days</option>
					                                                            <option @if($user->induser->candidate_availablity=="45") {{ $selected }} @endif value="45">in 45 Days</option>
					                                                            <option @if($user->induser->candidate_availablity=="60") {{ $selected }} @endif value="60">in Two Months</option> 
					                                                            <option @if($user->induser->candidate_availablity=="90") {{ $selected }} @endif value="90">in Three Months</option> 
					                                                        </select>
				                                                        </div>
				                                                    </div>
				                                            	</div>
			                                                </div>
			                                                <div class="row">
			                                                	<div class="col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>Prefered Location <span class="required">
																				* </span></label>
																		<div class="input-group">
																			<span class="input-group-addon" style="border-bottom-left-radius: 0;border-bottom:0;">
																				<i class="fa fa-map-marker"></i>
																			</span>

																			<input type="text" id="pref_loc" name="pref_loc" 
																			class="form-control" placeholder="Select preferred location" style="border-bottom-left-radius: 0;border-bottom-right-radius:0;border-bottom: 0;">									
																			
																		</div>
										
																		{!! Form::select('prefered_location[]', $location, null, ['id'=>'prefered_location', 
																																	   'aria-hidden'=>'true', 
																																	   'class'=>'form-control', 
																																	   'placeholder'=>'city', 
																																	   'multiple']) !!}	

																	</div>
																</div>
			                                                </div>
			                                                <div class="form-actions">
																<button type="button" data-userid="{{$user->induser->id}}" class="btn btn-sm green preference-update">Update</button>
																<a href="/profile/ind/{{Auth::user()->induser_id}}" class="btn btn-sm default">Cancel</a>
															</div>
														</div>
													</div>
												</div>
											</form>
											<div class="col-md-12">
												<!-- BEGIN PORTLET -->
												<div class="portlet light " style="background-color:white;">
													<div class="portlet-title">
														<div class="caption caption-md">
															<i class="icon-bar-chart theme-font hide"></i>
															<span class="caption-subject font-blue-madison bold uppercase">Upload Resume</span>
														</div>
													</div>
													<div class="portlet-body">
														<form action="/update/resume/{{Auth::user()->induser_id}}" id="preference-validation-{{$user->induser->id}}" 
															class="horizontal-form prof_detail" method="post" enctype="multipart/form-data">
															<input type="hidden" name="_token" value="{{ csrf_token() }}">
															<div class="row">
																<div class="col-md-6 col-sm-6">
			                                                        <div class="form-group" style="">
			                                                            <label class="control-label">Upload Resume <small style="font-weight: 400; font-size: 12px;color: #949494;">(Optional) only pdf or word format</small></label>&nbsp;
			                                                            @if($user->induser->resume != null)
			                                                            <div class="">
			                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
			                                                                    <span class="btn btn-default btn-file" style=" background-color: #44b6ae;  color: white;">
			                                                                        <i class="icon-paper-clip" style="color: white;"></i>
			                                                                        <span class="fileinput-new">Upload New Resume </span> 
			                                                                        <span class="fileinput-exists">Select Other </span>
			                                                                        <input type="file" name="resume" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf">
			                                                                    </span>
			                                                                    <br>
			                                                                    <span class="fileinput-new"></span>
			                                                                    <span class="fileinput-filename"></span>&nbsp; 
			                                                                    <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"></a>
			                                                                </div>
			                                                            </div>
			                                                            <div class="col-md-12" style="padding:0;">
			                                                            <label class="resume-file"> {{$user->induser->resume}}</label>
			                                                            <a href="/remove/resume/{{Auth::user()->induser_id}}" class="" style="margin:3.5px 10px;position: absolute;">
			                                                            	<i class="icon-close" style="color:#FF050D;font-size:16px;"></i>
			                                                            </a>
			                                                           	</div>
			                                                           	<div class="col-md-12" style="padding:0;">
			                                                           	<label style="font-size: 11px;color: #949494;">Updated On: {{ date('d M - Y, h:m A', strtotime($user->induser->resume_dtTime)) }}</label>
			                                                           	</div>
			                                                           @else
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
			                                                            @endif
			                                                        </div>
			                                                    </div>
															</div>
															<div class="form-actions">
																<button type="submit" class="btn btn-sm green">Upload</button>
																<a href="/profile/ind/{{Auth::user()->induser_id}}" class="btn btn-sm default">Cancel</a>
															</div>
														</form>
													</div>
												</div>
												<!-- END PORTLET -->
											</div>
										</div>
									</div>
							<!-- </div> -->
						<!-- END FORM-->
							</div>
							<!-- END CHANGE AVATAR TAB -->
							<!-- CHANGE PASSWORD TAB -->
							<div class="tab-pane" id="tab_1_2">
								
							</div>
							<!-- END CHANGE PASSWORD TAB -->
							<!-- PRIVACY SETTINGS TAB -->
							<div class="tab-pane" id="tab_1_4">
								<div class="row">
									<div class="col-md-12">
										<!-- BEGIN PORTLET -->
										<div class="portlet light " style="background-color:white;">
											<div class="portlet-title">
												<div class="caption caption-md">
													<i class="icon-bar-chart theme-font hide"></i>
													<span class="caption-subject font-blue-madison bold uppercase">Privacy Settings</span>
												</div>
											</div>
											<div class="portlet-body">
												
												<form action="/privacy/update" id="privacy-validation-{{$user->induser->id}}" 
													class="horizontal-form prof_detail" method="post" enctype="multipart/form-data">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="userid" value="{{$user->induser->id}}">
													<table class="table table-light table-hover">
													<tr>
														<td>
															 Who can see my Email Address.
														</td>
														<td>
															<label class="uniform-inline">
															<input type="radio" name="email_show" value="Links"
															@if($user->induser->email_show == 'Links')
																checked
															@endif >
															Links </label>
															<label class="uniform-inline" >
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
															<label class="uniform-inline" >
															<input type="radio" name="mobile_show" value="Links"
															@if($user->induser->mobile_show == 'Links')
																checked
															@endif >
															Links </label>
															<label class="uniform-inline">
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
															<label class="uniform-inline">
															<input type="radio" name="dob_show" value="Links"
															@if($user->induser->dob_show == 'Links')
																checked
															@endif >
															Links </label>
															<label class="uniform-inline">
															<input type="radio" name="dob_show" value="None"
															@if($user->induser->dob_show == 'None')
																checked
															@endif >
															None </label>
														</td>
													</tr>
													</table>
													<!--end profile-settings-->
													<div class="form-actions">
														<button type="button" data-userid="{{$user->induser->id}}" class="btn btn-sm green privacy-update">Save Changes</button>
													</div>
												</form>
											</div>
										</div>
										<!-- END PORTLET -->
									</div>
									<div class="col-md-12">
										<!-- BEGIN PORTLET -->
										<div class="portlet light " style="background-color:white;">
											<div class="portlet-title">
												<div class="caption caption-md">
													<i class="icon-bar-chart theme-font hide"></i>
													<span class="caption-subject font-blue-madison bold uppercase">Change Password</span>
												</div>
											</div>
											<div class="portlet-body">
												<a  href="#change-password" data-toggle="modal" class="btn btn-sm green-haze">
														Change </a>
											</div>
										</div>
										<!-- END PORTLET -->
									</div>
									<div class="col-md-12">
										<!-- BEGIN PORTLET -->
										<div class="portlet light " style="background-color:white;">
											<div class="portlet-title">
												<div class="caption caption-md">
													<i class="icon-bar-chart theme-font hide"></i>
													<span class="caption-subject font-blue-madison bold uppercase">Account Delete</span>
												</div>
											</div>
											<div class="portlet-body">
												<label style="font-size: 12px;color: #C14046;margin: 0px 0 10px 0;">
													<i class="fa fa-warning (alias)"></i> All your posts and applications will be removed, if you remove your account. Do you still want to proceed?</label><br/>
												@if($acc_id == "")
												<a data-toggle="modal" class="btn btn-sm red-haze" style="border-radius:4px !important;" href="#account-setting">
													Delete</a>
												@else
												@endif
												@if($acc_id == "")
												@else
												<div class="row" style="margin: 20px;">
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
														<button class="btn btn-sm btn-danger" type="submit">Delete</button>
													</form>
												</div>
												@endif
											</div>
										</div>
										<!-- END PORTLET -->
									</div>
									<div class="col-md-12">
										<!-- BEGIN PORTLET -->
										<div class="portlet light " style="background-color:white;">
											<div class="portlet-title">
												<div class="caption caption-md">
													<i class="icon-bar-chart theme-font hide"></i>
													<span class="caption-subject font-blue-madison bold uppercase">Notification Settings</span>
												</div>
											</div>
											<div class="portlet-body">
												
											</div>
										</div>
										<!-- END PORTLET -->
									</div>
								</div>
							</div>
							<!-- END PRIVACY SETTINGS TAB -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END PROFILE CONTENT -->
</div>

<!-- Mobile verification -->
<div class="modal fade bs-modal-sm" id="edit-me-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content" id="edit-me-content">
			<div id="edit-me-content-inner">
				@include('pages.mobile_email_modal')
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Email verification -->
<div class="modal fade bs-modal-sm" id="edit-email-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content" id="edit-me-content">
			<div id="edit-me-content-inner">
				@include('pages.email-edit-modal')
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Mobile/Email delete -->
<div class="modal fade bs-modal-sm delete-me-modal" id="delete-me-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content" id="delete-me-content">
			<div id="delete-me-content-inner">
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

// mobile-email-change
		/*$('.change-me').on('click',function(event){  	    
		  	event.preventDefault();
		  	var type = $(this).data('type');
		  	var formData = $('#send-mobile-otp-form').serialize();

		    $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

		    $.ajax({
		      url: "/me-change",
		      type: "post",
		      data: {type: type, formData: formData},
		      cache : false,
		      success: function(data){

		    	$('#edit-me-content-inner').html(data);
		    	$('#edit-me-modal').modal('show');
		    	
		      }
		    }); 
		    return false;
	  });*/



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
	    	// $('#edit-me-content-inner').html(data);
	    	// $('#edit-me-modal').modal('show');
	    	if(data.data.oen != null){
	            $('#msg-text').text(data.data.msg);
	            $('#msg-box').removeClass('alert alert-danger');
				$('#msg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $('#msg-box').show();
	           	});
	           	$('#verify-otp-form').show();
	           	$('#resend-otp-form').show();
            }else if(data.data.oen != null && data.data.oen == 'OTPALREADYSEND'){
	            $('#msg-text').text(data.data.msg);
	            $('#msg-box').removeClass('alert alert-danger');
				$('#msg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $('#msg-box').show();
	           	});
	           	$('#verify-otp-form').show();
            }else if(data.data.oen == null){
            	$('#msg-text').text(data.data.msg);
				$('#msg-box').removeClass('alert alert-success');
				$('#msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $('#msg-box').show();
	           	});
              // $('#msg-text').text('Entered Mobile number is already in use. Please try any other number.');

        	}
	      }
	    }); 
	    return false;
  	});

	$('#resend-otp').live('click',function(event){  	    
	  	event.preventDefault();

	  	var formData = $('#resend-otp-form').serialize(); 
	    var formAction = $('#resend-otp-form').attr('action');

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
	    	// $('#edit-me-content-inner').html(data);
	    	// $('#edit-me-modal').modal('show');
	    	if(data.data.msg != null){
	            $('#resend-msg-text').text(data.data.msg);
	            $('#resend-msg-box').removeClass('alert alert-danger');
				$('#resend-msg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $('#resend-msg-box').show();
	           	});
            }
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
	      	}else if(data == 'OTP-SEND'){
	      		$('#msg-box').removeClass('alert alert-danger');
	            $('#msg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#msg-text').text('Check Your Mobile for OTP');
	      	}
	      }
	    }); 
	    return false;
  	});
</script>
<script type="text/javascript">
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
	@if(Auth::user()->induser->linked_skill != null)
	<?php $array = explode(', ', $user->induser->linked_skill); ?> 
	@if(count($array) > 0)
	@foreach($array as $gt => $gta)
		skillArray.push('<?php echo $gta; ?>');
	@endforeach
	@endif
	@endif
	var skillselect = $("#linked_skill_id").select2({ dataType: 'json', data: skillArray });
    
    skillselect.val(skillArray).trigger("change");
    

    // preferred loc
	var prefLocationArray = [];
	@if(Auth::user()->induser->prefered_location != null)
	<?php $arr = explode(', ', $user->induser->prefered_location); ?>
	@if(count($arr) > 0) 
	@foreach($arr as $ga => $gt)
		prefLocationArray.push('<?php echo $gt; ?>');
	@endforeach
	@endif
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
						var result = $.grep(data, function(e){ return e.value == request.term; });
						if (result.length == 0) {
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

// mobile-email-delete
		$('.delete-me').on('click',function(event){  	    
		  	event.preventDefault();
		  	var type = $(this).data('type');

		    $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

		    $.ajax({
		      url: "/delete",
		      type: "post",
		      data: {type: type},
		      cache : false,
		      success: function(data){
		    	$('#delete-me-content-inner').html(data);
		    	$('#delete-me-modal').modal('show');
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


</script>
<script type="text/javascript">
	$('.personalinfo-update').on('click',function(event){  	    
	  	event.preventDefault();
	  	var userid = $(this).data('userid');

	  	var formData = $('#profile-validation-'+userid).serialize(); 
	    var formAction = $('#profile-validation-'+userid).attr('action');
	    
	    $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      cache : false,

	      success: function(data){
	     		// console.log(data);
	      	if(data.success == 'success'){
				displayToast("Personal Info Updated");
	        }else if(data.success == 'fail'){
	        	// console.log(data);
	        	var name = '<div class="profile-usertitle-name">'+data.data.fullname+'</div>';
	        	$('#name-show').html(name);
	        	displayToast("Something Wrong! Not updated...");
	        }
	      }
	    }); 
	    return false;
	  });

	$('.contactinfo-update').on('click',function(event){  	    
	  	event.preventDefault();
	  	var userid = $(this).data('userid');

	  	var formData = $('#contact-validation-'+userid).serialize(); 
	    var formAction = $('#contact-validation-'+userid).attr('action');
	    
	    $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      cache : false,

	      success: function(data){
	     		// console.log(data);
	      	if(data.success == 'success'){
				displayToast("Contact Info Updated");
	        }else if(data.success == 'fail'){
	        	// console.log(data);
	        	displayToast("Something Wrong! Not updated...");
	        }
	      },
	      error: function (request, status, error) {
		        displayToast("Something Wrong! Not updated...");
		    }
	    }); 
	    return false;
	  });

	$('.addressinfo-update').on('click',function(event){  	    
	  	event.preventDefault();
	  	var userid = $(this).data('userid');

	  	var formData = $('#address-validation-'+userid).serialize(); 
	    var formAction = $('#address-validation-'+userid).attr('action');
	    
	    $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      cache : false,

	      success: function(data){
	     		// console.log(data);
	      	if(data.success == 'success'){
				displayToast("Address Updated");
	        }else if(data.success == 'fail'){
	        	// console.log(data);
	        	displayToast("Something Wrong! Not updated...");
	        }
	      }
	    }); 
	    return false;
	  });

	$('.professional-update').on('click',function(event){  	    
	  	event.preventDefault();
	  	var userid = $(this).data('userid');

	  	var formData = $('#professional-validation-'+userid).serialize(); 
	    var formAction = $('#professional-validation-'+userid).attr('action');
	    
	    $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      cache : false,

	      success: function(data){
	     		// console.log(data);
	      	if(data.success == 'success'){
				displayToast("Professional Details Updated");
	        }else if(data.success == 'fail'){
	        	// console.log(data);
	        	displayToast("Something Wrong! Not updated...");
	        }
	      }
	    }); 
	    return false;
	  });

	$('.preference-update').on('click',function(event){  	    
	  	event.preventDefault();
	  	var userid = $(this).data('userid');

	  	var formData = $('#preference-validation-'+userid).serialize(); 
	    var formAction = $('#preference-validation-'+userid).attr('action');
	    
	    $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      cache : false,

	      success: function(data){
	     		// console.log(data);
	      	if(data.success == 'success'){
				displayToast("Job Preference Details Updated");
	        }else if(data.success == 'fail'){
	        	// console.log(data);
	        	displayToast("Something Wrong! Job Preference not updated...");
	        }
	      }
	    }); 
	    return false;
	  });

	$('.privacy-update').on('click',function(event){  	    
	  	event.preventDefault();
	  	var userid = $(this).data('userid');

	  	var formData = $('#privacy-validation-'+userid).serialize(); 
	    var formAction = $('#privacy-validation-'+userid).attr('action');
	    
	    $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      cache : false,

	      success: function(data){
	     		// console.log(data);
	      	if(data.success == 'success'){
				displayToast("Privacy Setting Updated");
	        }else if(data.success == 'fail'){
	        	// console.log(data);
	        	displayToast("Something Wrong! Privacy Setting not updated...");
	        }
	      }
	    }); 
	    return false;
	  });
	</script>
<script>
// displayToast

function displayToast($msg) {
    $.bootstrapGrowl($msg, {
        ele: 'body', // which element to append to
        type: 'info', // (null, 'info', 'danger', 'success', 'warning')
        offset: {
            from: 'bottom',
            amount: 10
        }, // 'top', or 'bottom'
        align: 'center', // ('left', 'right', or 'center')
        width: 'auto', // (integer, or 'auto')
        height: 'auto',
        // delay: 3000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
        allow_dismiss: false, // If true then will display a cross to close the popup.
        stackup_spacing: 10 // spacing between consecutively stacked growls.
    });
}
</script>
@stop