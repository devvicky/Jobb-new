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
			<a href="/profile/corp/{{Auth::user()->id}}">Profile View</a><i class="fa fa-angle-right"></i>
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
	                    @if($user->corpuser->logo_status == null && $user->corpuser->firm_name != null)
	                      <div class="hover-image"><i class="fa fa-camera"></i> Add</div>
	                    @endif      
	                    @if($user->corpuser->logo_status != null)
	                      <img src="/img/profile/{{ $user->corpuser->logo_status }}" class="img-responsive">
	                      <div class="hover-image"><i class="glyphicon glyphicon-edit"></i>Edit</div>
	                    @else
	                      <img src="/img/profile/{{ $user->corpuser->logo_status }}" class="demo-new" data-name="{{$user->corpuser->firm_name}}">
	                      <div class="hover-image"><i class="glyphicon glyphicon-edit"></i>Edit</div>
	                    @endif
	                </a>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						 {{ $user->corpuser->firm_name }}
					</div>
					<div class="profile-usertitle-job">
						@if($user->corpuser->slogan != null) {{$user->corpuser->slogan}} @endif 
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav" style="padding:0;">
						<li>
							<a href="/profile/corp/{{$user->id}}">
							<i class="icon-home"></i>
							Overview </a>
						</li>
						<li class="active">
							<a href="#tab_1_1" data-toggle="tab"><i class=" icon-user"></i>Firm Info</a>
						</li>
						<li>
							<a href="#tab_1_2" data-toggle="tab"><i class="icon-briefcase"></i> Account Handler</a>
						</li>
						<li>
							<a href="#tab_1_3" data-toggle="tab"><i class="icon-settings"></i> Account Settings</a>
						</li>
					</ul>
					
				</div>
				<!-- END MENU -->
				<!-- PORTLET MAIN -->
			</div>
		</div>
		<!-- BEGIN PROFILE CONTENT -->
		<div class="profile-content">
			<div class="row">
				<div class="col-md-12">
					<div class="tab-content">
						<!-- FIRM INFO TAB -->
						<div class="tab-pane active" id="tab_1_1">
							<!-- BEGIN PORTLET -->
							<div class="portlet light " style="background-color:white;">
								<div class="portlet-title">
									<div class="caption caption-md">
										<i class="icon-bar-chart theme-font hide"></i>
										<span class="caption-subject font-blue-madison bold uppercase">Firm Details</span>
									</div>
								</div>
								<div class="portlet-body">
									<form action="/firm/update" id="firm-validation-{{$user->corpuser->id}}" 
													class="horizontal-form prof_detail" method="post" enctype="multipart/form-data">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="userid" value="{{$user->corpuser->id}}">
									<div class="row">
										@if (count($errors) > 0)
										<div class="alert alert-danger">
											<ul>
												@foreach ($errors->all() as $error)
													<li>{{ $error }}</li>
												@endforeach
											</ul>
										</div>
										@endif
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Firm Name</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="glyphicon glyphicon-font" style="color:darkcyan;"></i>
													</span>
													<input type="text" name="firm_name" class="form-control" placeholder="Firm Name" value="{{ $user->corpuser->firm_name }}">
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">								
												<label>Slogan</label>										
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-comment-o" style="color:darkcyan;"></i>
													</span>
													<input type="text" name="slogan" class="form-control" value="{{ $user->corpuser->slogan }}" placeholder="Enter Company Slogan">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">								
												<label>About Firm</label>										
												<!-- <div class="input-group"> -->
													<textarea id="textarea" rows="6" class="form-control " maxlength="500" name="about_firm" placeholder="write about your proffessional summary...">{{ $user->corpuser->about_firm }}</textarea>
													<div id="textarea_feedback"></div>
												<!-- </div> -->
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Firm Type</label>
												<div class="input-group">
														<div class="md-radio-inline">
															<div class="md-radio">
																<input type="radio" id="radio6" name="firm_type" value="company" class="md-radiobtn" 
																	@if($user->corpuser->firm_type == 'company')
																		checked
																	@endif
																>
																<label for="radio6" style="">
																<span></span>
																<span class="check"></span>
																<span class="box"></span>
																Company </label>
															</div>
															<div class="md-radio">
																<input type="radio" id="radio7" name="firm_type" value="consultancy" class="md-radiobtn" 
																@if($user->corpuser->firm_type == 'consultancy')
																	checked
																@endif
																>
																<label for="radio7" style="">
																<span></span>
																<span class="check"></span>
																<span class="box"></span>
																Consultancy </label>
															</div>
														</div>	
														<div id="radio_error"></div>					<!-- /input-group -->
													</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Operating since</label>
												<div class="input-group">
													<span class="input-group-addon">
													<i class="fa fa-cube"style="color:darkcyan;"></i>
													</span>
													<select name="operating_since" class="form-control" value="{{ $user->corpuser->operating_since }}">
														<option value="">-- Select --</option>
														<option @if($user->corpuser->operating_since == "Startup") {{ $selected }} @endif value="Startup">Startup</option>
														<option @if($user->corpuser->operating_since == "1 - 2 Years") {{ $selected }} @endif value="1 - 2 Years">1 - 2 Years</option>
														<option @if($user->corpuser->operating_since == "2 - 4 Years") {{ $selected }} @endif value="2 - 4 Years">2 - 4 Years</option>
														<option @if($user->corpuser->operating_since == "4 - 7 Years") {{ $selected }} @endif value="4 - 7 Years">4 - 7 Years</option>
														<option @if($user->corpuser->operating_since == "7 - 10 Years") {{ $selected }} @endif value="7 - 10 Years">7 - 10 Years</option>
														<option @if($user->corpuser->operating_since == "10 + Years") {{ $selected }} @endif value="10 + Years">10 + Years</option>
													</select>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="form-actions">
										<button type="button" data-userid="{{$user->corpuser->id}}" class="btn btn-sm green firm-update">Update</button>
									</div>
								</div>
							</div>
							<!-- END PORTLET -->
							<!-- BEGIN PORTLET -->
							<div class="portlet light " style="background-color:white;">
								<div class="portlet-title">
									<div class="caption caption-md">
										<i class="icon-bar-chart theme-font hide"></i>
										<span class="caption-subject font-blue-madison bold uppercase">Other Details</span>
									</div>
								</div>
								<div class="portlet-body">
									<form action="/otherdetails/update" id="otherdetails-validation-{{$user->corpuser->id}}" 
													class="horizontal-form prof_detail" method="post" enctype="multipart/form-data">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="userid" value="{{$user->corpuser->id}}">
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Industry <span class="required">*</span>
												</label>
												<select class="select2me form-control" name="industry">
													<option value="">Select</option>
													<option @if($user->corpuser->industry=="Automotive/ Ancillaries") {{ $selected }} @endif value="Automotive/ Ancillaries">Automotive/ Ancillaries</option>
													<option @if($user->corpuser->industry=="Banking/ Financial Services") {{ $selected }} @endif value="Banking/ Financial Services">Banking/ Financial Services</option>
													<option @if($user->corpuser->industry=="Bio Technology & Life Sciences") {{ $selected }} @endif value="Bio Technology & Life Sciences">Bio Technology & Life Sciences</option>
													<option @if($user->corpuser->industry=="Chemicals/Petrochemicals") {{ $selected }} @endif value="Chemicals/Petrochemicals">Chemicals/Petrochemicals</option>
													<option @if($user->corpuser->industry=="Construction") {{ $selected }} @endif value="Construction">Construction</option>
													<option @if($user->corpuser->industry=="FMCG") {{ $selected }} @endif value="FMCG">FMCG</option>
													<option @if($user->corpuser->industry=="Education") {{ $selected }} @endif value="Education">Education</option>
													<option @if($user->corpuser->industry=="Entertainment/ Media/ Publishing") {{ $selected }} @endif value="Entertainment/ Media/ Publishing">Entertainment/ Media/ Publishing</option>
													<option @if($user->corpuser->industry=="Insurance") {{ $selected }} @endif value="Insurance">Insurance</option>
													<option @if($user->corpuser->industry=="ITES/BPO") {{ $selected }} @endif value="ITES/BPO">ITES/BPO</option>
													<option @if($user->corpuser->industry=="IT/ Computers - Hardware") {{ $selected }} @endif value="IT/ Computers - Hardware">IT/ Computers - Hardware</option>
													<option @if($user->corpuser->industry=="IT/ Computers - Software") {{ $selected }} @endif value="IT/ Computers - Software">IT/ Computers - Software</option>
													<option @if($user->corpuser->industry=="KPO/Analytic") {{ $selected }} @endif value="KPO/Analytics">KPO/Analytics</option>
													<option @if($user->corpuser->industry=="Machinery/ Equipment Mfg.") {{ $selected }} @endif value="Machinery/ Equipment Mfg.">Machinery/ Equipment Mfg.</option>
													<option @if($user->corpuser->industry=="Oil/ Gas/ Petroleum") {{ $selected }} @endif value="Oil/ Gas/ Petroleum">Oil/ Gas/ Petroleum</option>
													<option @if($user->corpuser->industry=="Pharmaceuticals") {{ $selected }} @endif value="Pharmaceuticals">Pharmaceuticals</option>
													<option @if($user->corpuser->industry=="Power/Energy") {{ $selected }} @endif value="Power/Energy">Power/Energy</option>
													<option @if($user->corpuser->industry=="Retailing") {{ $selected }} @endif value="Retailing">Retailing</option>
													<option @if($user->corpuser->industry=="Telecom") {{ $selected }} @endif value="Telecom">Telecom</option>
													<option @if($user->corpuser->industry=="Advertising/PR/Events") {{ $selected }} @endif value="Advertising/PR/Events">Advertising/PR/Events</option>
													<option @if($user->corpuser->industry=="Agriculture/ Dairy Based") {{ $selected }} @endif value="Agriculture/ Dairy Based">Agriculture/ Dairy Based</option>
													<option @if($user->corpuser->industry=="Aviation/Aerospace") {{ $selected }} @endif value="Aviation/Aerospace">Aviation/Aerospace</option>
													<option @if($user->corpuser->industry=="Beauty/Fitness/PersonalCare/SPA") {{ $selected }} @endif value="Beauty/Fitness/PersonalCare/SPA">Beauty/Fitness/PersonalCare/SPA</option>
													<option @if($user->corpuser->industry=="Beverages/ Liquor") {{ $selected }} @endif value="Beverages/ Liquor">Beverages/ Liquor</option>
													<option @if($user->corpuser->industry=="Cement") {{ $selected }} @endif value="Cement">Cement</option>
													<option @if($user->corpuser->industry=="Ceramics & Sanitary Ware") {{ $selected }} @endif value="Ceramics & Sanitary Ware">Ceramics & Sanitary Ware</option>
													<option @if($user->corpuser->industry=="Consultancy") {{ $selected }} @endif value="Consultancy">Consultancy</option>
													<option @if($user->corpuser->industry=="Courier/ Freight/ Transportation") {{ $selected }} @endif value="Courier/ Freight/ Transportation">Courier/ Freight/ Transportation</option>
													<option @if($user->corpuser->industry=="Law Enforcement/Security Services") {{ $selected }} @endif value="Law Enforcement/Security Services">Law Enforcement/Security Services</option>
													<option @if($user->corpuser->industry=="E-Learning") {{ $selected }} @endif value="E-Learning">E-Learning</option>
													<option @if($user->corpuser->industry=="Shipping/ Marine Services") {{ $selected }} @endif value="Shipping/ Marine Services">Shipping/ Marine Services</option>
													<option @if($user->corpuser->industry=="Engineering, Procurement, Construction") {{ $selected }} @endif value="Engineering, Procurement, Construction">Engineering, Procurement, Construction</option>
													<option @if($user->corpuser->industry=="Environmental Service") {{ $selected }} @endif value="Environmental Service">Environmental Service</option>
													<option @if($user->corpuser->industry=="Facility management") {{ $selected }} @endif value="Facility management">Facility management</option>
													<option @if($user->corpuser->industry=="Fertilizer/ Pesticides") {{ $selected }} @endif value="Fertilizer/ Pesticides">Fertilizer/ Pesticides</option>
													<option @if($user->corpuser->industry=="Food & Packaged Food") {{ $selected }} @endif value="Food & Packaged Food">Food & Packaged Food</option>
													<option @if($user->corpuser->industry=="Textiles / Yarn / Fabrics / Garments") {{ $selected }} @endif value="Textiles / Yarn / Fabrics / Garments">Textiles / Yarn / Fabrics / Garments</option>
													<option @if($user->corpuser->industry=="Gems & Jewellery") {{ $selected }} @endif value="Gems & Jewellery">Gems & Jewellery</option>
													<option @if($user->corpuser->industry=="Government/ PSU/ Defence") {{ $selected }} @endif value="Government/ PSU/ Defence">Government/ PSU/ Defence</option>
													<option @if($user->corpuser->industry=="Consumer Electronics/Appliances") {{ $selected }} @endif value="Consumer Electronics/Appliances">Consumer Electronics/Appliances</option>
													<option @if($user->corpuser->industry=="Hospitals/ Health Care") {{ $selected }} @endif value="Hospitals/ Health Care">Hospitals/ Health Care</option>
													<option @if($user->corpuser->industry=="Hotels/ Restaurant") {{ $selected }} @endif value="Hotels/ Restaurant">Hotels/ Restaurant</option>
													<option @if($user->corpuser->industry=="Import / Export") {{ $selected }} @endif value="Import / Export">Import / Export</option>
													<option @if($user->corpuser->industry=="Market Research") {{ $selected }} @endif value="Market Research">Market Research</option>
													<option @if($user->corpuser->industry=="Medical Transcription") {{ $selected }} @endif value="Medical Transcription">Medical Transcription</option>
													<option @if($user->corpuser->industry=="Mining") {{ $selected }} @endif value="Mining">Mining</option>
													<option @if($user->corpuser->industry=="NGO") {{ $selected }} @endif value="NGO">NGO</option>
													<option @if($user->corpuser->industry=="Paper") {{ $selected }} @endif value="Paper">Paper</option>
													<option @if($user->corpuser->industry=="Printing / Packaging") {{ $selected }} @endif value="Printing / Packaging">Printing / Packaging</option>
													<option @if($user->corpuser->industry=="Public Relations (PR)") {{ $selected }} @endif value="Public Relations (PR)">Public Relations (PR)</option>
													<option @if($user->corpuser->industry=="Travel / Tourism") {{ $selected }} @endif value="Travel / Tourism">Travel / Tourism</option>
													<option @if($user->corpuser->industry=="Other") {{ $selected }} @endif value="Other">Other</option>
												</select>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="form-group">
												<label>No of Employee</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-users" style="color:darkcyan;"></i>
													</span>
													<select name="emp_count" class="form-control" value="{{ $user->corpuser->emp_count }}">
														<option value="">-- Select --</option>
														<option @if($user->corpuser->emp_count == "0 - 100") {{ $selected }} @endif value="0 - 100">0 - 100</option>
														<option @if($user->corpuser->emp_count == "100 - 500") {{ $selected }} @endif value="100 - 500">100 - 500</option>
														<option @if($user->corpuser->emp_count == "500 - 1000") {{ $selected }} @endif value="500 - 1000">500 - 1000</option>
														<option @if($user->corpuser->emp_count == "1000-2000") {{ $selected }} @endif value="1000-2000">1000-2000</option>
														<option @if($user->corpuser->emp_count == "2000-5000") {{ $selected }} @endif value="2000-5000">2000-5000</option>
														<option @if($user->corpuser->emp_count == "5000-10000") {{ $selected }} @endif value="5000-10000">5000-10000</option>
														<option @if($user->corpuser->emp_count == "10000 +") {{ $selected }} @endif value="10000 +">10000 +</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">								
												<label>Work Area</label>										
												<div style="position:relative;">
													<input type="text" name="name" id="newskill" class="form-control" placeholder="Search for skill...">
														<button id="add-new-skill" style="position:absolute;right:0;top:0;" class="btn btn-success" type="button"><i class="icon-plus"></i> Add</button>	
														{!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Website</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="icon-info"style="color:darkcyan;"></i>
													</span>
													<input type="text" name="website_url" class="form-control" value="{{ $user->corpuser->website_url }}" placeholder="http://www.website.com">
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="form-actions">
										<button type="button" data-userid="{{$user->corpuser->id}}" class="btn btn-sm green otherdetails-update">Update</button>
									</div>
								</form>
								</div>
							</div>
							<!-- END PORTLET -->
							<!-- BEGIN PORTLET -->
							<div class="portlet light " style="background-color:white;">
								<div class="portlet-title">
									<div class="caption caption-md">
										<i class="icon-bar-chart theme-font hide"></i>
										<span class="caption-subject font-blue-madison bold uppercase">Address Details</span>
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
													<input type="text" name="address_1" class="form-control" value="{{ $user->corpuser->address_1 }}" placeholder="Address">
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
													<input type="text" name="address_2" class="form-control" value="{{ $user->corpuser->address_2 }}" placeholder="Address">
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
													<input type="text" id="city" name="city" class="form-control" value="{{ $user->corpuser->city }}" placeholder="City">										
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
										<button type="button" data-userid="{{$user->corpuser->id}}" class="btn btn-sm green corp-addressinfo-update">Update</button>
										<a href="/profile/ind/{{Auth::user()->id}}" class="btn btn-sm default">Cancel</a>
									</div>
								</div>
							</div>
							<!-- END PORTLET -->
						</div>
						<!-- Account Handler TAB -->
						<div class="tab-pane" id="tab_1_2">
							<!-- BEGIN PORTLET -->
										<div class="portlet light " style="background-color:white;">
											<div class="portlet-title">
												<div class="caption caption-md">
													<i class="icon-bar-chart theme-font hide"></i>
													<span class="caption-subject font-blue-madison bold uppercase">Account Handler</span>
												</div>
											</div>
											<div class="portlet-body">
												<form action="/corporate/update/{{Auth::user()->corpuser_id}}" id="corp_contact_validation" class="horizontal-form" method="post">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<!-- <div class="form-body"> -->
														<div class="row">
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="form-group">
																	<label>Profile Handler Name</label>
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-user" style="color:darkcyan;"></i>
																		</span>
																		<input type="text" name="username" class="form-control" value="{{ $user->corpuser->username }}" placeholder="Handler Name">
																	</div>
																</div>
															</div>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="form-group">
																	<label>Working As</label>
																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-user" style="color:darkcyan;"></i>
																		</span>
																		<select name="working_as" class="form-control" value="{{ $user->corpuser->working_as }}">
																			<option value="">-- Select --</option>
																			<option @if($user->corpuser->working_as == "HR Recruiter") {{ $selected }} @endif value="HR Recruiter">HR Recruiter</option>
																			<option @if($user->corpuser->working_as == "Administrator") {{ $selected }} @endif value="Administrator">Administrator</option>
																			<option @if($user->corpuser->working_as == "Employee") {{ $selected }} @endif value="Employee">Employee</option>
																			<option @if($user->corpuser->working_as == "Other") {{ $selected }} @endif value="Other">Other</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															 <div class="col-md-6 col-sm-6 col-xs-12">
										                        <div class="form-group">
											                        <label>Phone 
																		@if($user->mobile != null && $user->mobile_verify == 1) 
																			<small class="verified-css">Verified</small>
																		@elseif($user->mobile != null && $user->mobile_verify == 0)
																			<small class="not-verified-css">Not Verified</small>
																		@elseif($user->mobile == null)
																		@endif
																	</label>
										                            <div class="input-group">
										                                <span class="input-group-addon">
										                                    <i class="icon-call-end" style="color:darkcyan;"></i>
										                                </span>
										                                <input type="text" name="firm_phone" class="form-control" placeholder="Phone" value="{{ $user->mobile }}" @if($user->mobile_verify == 1)readonly @endif>
										                            	<span class="input-group-addon">
																			@if($user->mobile != null && $user->mobile_verify == 0)
																				<i class="fa fa-exclamation-circle" 
																				style="color: #cb5a5e;font-size: 16px;"></i>
																			@elseif($user->mobile == null && $user->mobile_verify == 0)
																				<i class="fa fa-meh-o" style="color:dimgrey;font-size: 16px;"></i>
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
										                    <div class="col-md-6 col-sm-6 col-xs-12">
										                        <div class="form-group">
										                            <label>Email 
																		@if($user->email != null && $user->email_verify == 1) 
																			<small class="verified-css">Verified</small>
																		@elseif($user->email != null && $user->email_verify == 0)
																			<small class="not-verified-css">Not Verified</small>
																		@elseif($user->email == null)
																		@endif
																	</label>                               
										                            <div class="input-group">
										                                <span class="input-group-addon">
										                                    <i class="icon-envelope" style="color:darkcyan;"></i>
										                                </span>
										                                <input type="text" name="firm_email_id" class="form-control" placeholder="Email" value="{{ $user->email }}" @if($user->email_verify == 1)readonly @endif>
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
														<div class="form-actions ">
															<button type="submit" class="btn blue"><i class="fa fa-check"></i> Update</button>
															<button type="button" class="btn default">Cancel</button>
														</div>
													<!-- </div> -->
												</form>
											</div>
										</div>
										<!-- END PORTLET -->
						</div>
						<!-- Account Setting TAB -->
						<div class="tab-pane" id="tab_1_3">
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
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>

<div class="row profile-account" style="margin:15px;">
	<div class="col-md-3">
		<ul class="ver-inline-menu tabbable margin-bottom-10">
			<li class="active">
				<a data-toggle="tab" href="#firm_details">
				<i class="fa fa-cog"></i> Firm Details </a>
				<span class="after">
				</span>
			</li>
			<li>
				<a data-toggle="tab" href="#account_handler">
				<i class="fa fa-lock"></i> Account Handler </a>
			</li>
			<li>
				<a data-toggle="tab" href="#privacy_setting">
				<i class="fa fa-eye"></i> Privacity Settings </a>
			</li>
		</ul>
	</div>
	<div class="col-md-8">
		<div class="tab-content">
			<div id="firm_details" class="tab-pane active">
				<!-- BEGIN FORM-->
				<form action="/corporate/basicupdate" id="corp_firm_validation" class="horizontal-form" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-body">
						<div class="row">
							
							<div class="col-md-12" style="">
								<div class="row">
									@if (count($errors) > 0)
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
									@endif
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>Firm Name</label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-font" style="color:darkcyan;"></i>
												</span>
												<input type="text" name="firm_name" class="form-control" placeholder="Firm Name" value="{{ $user->corpuser->firm_name }}">
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">								
											<label>Slogan</label>										
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-comment-o" style="color:darkcyan;"></i>
												</span>
												<input type="text" name="slogan" class="form-control" value="{{ $user->corpuser->slogan }}" placeholder="Enter Company Slogan">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="form-group">								
											<label>About Firm</label>										
											<!-- <div class="input-group"> -->
												<textarea id="textarea" rows="6" class="form-control " maxlength="500" name="about_firm" placeholder="write about your proffessional summary...">{{ $user->corpuser->about_firm }}</textarea>
												<div id="textarea_feedback"></div>
											<!-- </div> -->
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>Firm Type</label>
											<div class="input-group">
													<div class="md-radio-inline">
														<div class="md-radio">
															<input type="radio" id="radio6" name="firm_type" value="company" class="md-radiobtn" 
																@if($user->corpuser->firm_type == 'company')
																	checked
																@endif
															>
															<label for="radio6" style="">
															<span></span>
															<span class="check"></span>
															<span class="box"></span>
															Company </label>
														</div>
														<div class="md-radio">
															<input type="radio" id="radio7" name="firm_type" value="consultancy" class="md-radiobtn" 
															@if($user->corpuser->firm_type == 'consultancy')
																checked
															@endif
															>
															<label for="radio7" style="">
															<span></span>
															<span class="check"></span>
															<span class="box"></span>
															Consultancy </label>
														</div>
													</div>	
													<div id="radio_error"></div>					<!-- /input-group -->
												</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>Operating since</label>
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-cube"style="color:darkcyan;"></i>
												</span>
												<select name="operating_since" class="form-control" value="{{ $user->corpuser->operating_since }}">
													<option value="">-- Select --</option>
													<option @if($user->corpuser->operating_since == "Startup") {{ $selected }} @endif value="Startup">Startup</option>
													<option @if($user->corpuser->operating_since == "1 - 2 Years") {{ $selected }} @endif value="1 - 2 Years">1 - 2 Years</option>
													<option @if($user->corpuser->operating_since == "2 - 4 Years") {{ $selected }} @endif value="2 - 4 Years">2 - 4 Years</option>
													<option @if($user->corpuser->operating_since == "4 - 7 Years") {{ $selected }} @endif value="4 - 7 Years">4 - 7 Years</option>
													<option @if($user->corpuser->operating_since == "7 - 10 Years") {{ $selected }} @endif value="7 - 10 Years">7 - 10 Years</option>
													<option @if($user->corpuser->operating_since == "10 + Years") {{ $selected }} @endif value="10 + Years">10 + Years</option>
												</select>
											</div>
										</div>
									</div>
									<!--/span-->
								</div>
								
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">								
											<label>Address</label>										
												<textarea id="textarea_address" rows="3" class="form-control " minlength="20" maxlength="200" name="firm_address" placeholder="Enter your Address">{{ $user->corpuser->firm_address }}</textarea>
												<div id="textarea_feedback_address"></div>
										</div>
									</div>
								</div>
								<div>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>City <span class="required">
													* </span></label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-map-marker"></i>
												</span>
												<input type="text" id="city" name="city" class="form-control" value="{{ $user->corpuser->city }}" placeholder="City">										
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
						<div class="form-actions ">
							<button type="submit" class="btn blue"><i class="fa fa-check"></i> Update</button>
							<button type="button" class="btn default">Cancel</button>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
			<div id="account_handler" class="tab-pane">
				<form action="/corporate/update/{{Auth::user()->corpuser_id}}" id="corp_contact_validation" class="horizontal-form" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-body">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Profile Handler Name</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-user" style="color:darkcyan;"></i>
										</span>
										<input type="text" name="username" class="form-control" value="{{ $user->corpuser->username }}" placeholder="Handler Name">
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Working As</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-user" style="color:darkcyan;"></i>
										</span>
										<select name="working_as" class="form-control" value="{{ $user->corpuser->working_as }}">
											<option value="">-- Select --</option>
											<option @if($user->corpuser->working_as == "HR Recruiter") {{ $selected }} @endif value="HR Recruiter">HR Recruiter</option>
											<option @if($user->corpuser->working_as == "Administrator") {{ $selected }} @endif value="Administrator">Administrator</option>
											<option @if($user->corpuser->working_as == "Employee") {{ $selected }} @endif value="Employee">Employee</option>
											<option @if($user->corpuser->working_as == "Other") {{ $selected }} @endif value="Other">Other</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							 <div class="col-md-6 col-sm-6 col-xs-12">
		                        <div class="form-group">
			                        <label>Phone 
										@if($user->mobile != null && $user->mobile_verify == 1) 
											<small class="verified-css">Verified</small>
										@elseif($user->mobile != null && $user->mobile_verify == 0)
											<small class="not-verified-css">Not Verified</small>
										@elseif($user->mobile == null)
										@endif
									</label>
		                            <div class="input-group">
		                                <span class="input-group-addon">
		                                    <i class="icon-call-end" style="color:darkcyan;"></i>
		                                </span>
		                                <input type="text" name="firm_phone" class="form-control" placeholder="Phone" value="{{ $user->mobile }}" @if($user->mobile_verify == 1)readonly @endif>
		                            	<span class="input-group-addon">
											@if($user->mobile != null && $user->mobile_verify == 0)
												<i class="fa fa-exclamation-circle" 
												style="color: #cb5a5e;font-size: 16px;"></i>
											@elseif($user->mobile == null && $user->mobile_verify == 0)
												<i class="fa fa-meh-o" style="color:dimgrey;font-size: 16px;"></i>
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
		                    <div class="col-md-6 col-sm-6 col-xs-12">
		                        <div class="form-group">
		                            <label>Email 
										@if($user->email != null && $user->email_verify == 1) 
											<small class="verified-css">Verified</small>
										@elseif($user->email != null && $user->email_verify == 0)
											<small class="not-verified-css">Not Verified</small>
										@elseif($user->email == null)
										@endif
									</label>                               
		                            <div class="input-group">
		                                <span class="input-group-addon">
		                                    <i class="icon-envelope" style="color:darkcyan;"></i>
		                                </span>
		                                <input type="text" name="firm_email_id" class="form-control" placeholder="Email" value="{{ $user->email }}" @if($user->email_verify == 1)readonly @endif>
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
						<div class="form-actions ">
							<button type="submit" class="btn blue"><i class="fa fa-check"></i> Update</button>
							<button type="button" class="btn default">Cancel</button>
						</div>
					</div>
				</form>
			</div>
			<div id="privacy_setting" class="tab-pane">
				<form action="/corporate/privacyUpdate/{{Auth::user()->corpuser_id}}" id="privacy_validation" 
				class="horizontal-form prof_detail" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<table class="table table-bordered table-striped">
					<tr>
						<td>
							 Who can see account handler Email Address.
						</td>
						<td>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="email_show" value="Everyone"
							@if($user->corpuser->email_show == 'Everyone')
								checked
							@endif >
							Everyone </label>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="email_show" value="Follower"
							@if($user->corpuser->email_show == 'Follower')
								checked
							@endif >
							Follower </label>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="email_show" value="None"
							@if($user->corpuser->email_show == 'None')
								checked
							@endif >
							None </label>
						</td>
					</tr>
					<tr>
						<td>
							 Who can see account handler Mobile No.
						</td>
						<td>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="mobile_show" value="Everyone"
							@if($user->corpuser->phone_show == 'Everyone')
								checked
							@endif >
							Everyone </label>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="mobile_show" value="Follower"
							@if($user->corpuser->email_show == 'Follower')
								checked
							@endif >
							Follower </label>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="mobile_show" value="None"
							@if($user->corpuser->phone_show == 'None')
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
						<a href="/profile/ind/{{Auth::user()->corpuser_id}}" class="btn default">Cancel</a>
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
<script src="/assets/corp_validation.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
	var text_max = 500;
		$('#textarea_feedback').html(text_max + ' characters remaining');

		$('#textarea').keyup(function() {
		    var text_length = $('#textarea').val().length;
		    var text_remaining = text_max - text_length;

		    $('#textarea_feedback').html(text_remaining + ' characters remaining');
		});
	});

  	$(document).ready(function() {
	var text_maximum = 200;
		$('#textarea_feedback_address').html(text_maximum + ' characters remaining');

		$('#textarea_address').keyup(function() {
		    var text_length = $('#textarea_address').val().length;
		    var text_remaining = text_maximum - text_length;

		    $('#textarea_feedback_address').html(text_remaining + ' characters remaining');
		});
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
	@if($user->corpuser->linked_skill != null)
	<?php $array = explode(', ', $user->corpuser->linked_skill); ?> 
	@if(count($array) > 0)
	@foreach($array as $gt => $gta)
		skillArray.push('<?php echo $gta; ?>');
	@endforeach
	@endif
	@endif
    var skillselect = $("#linked_skill_id").select2({ dataType: 'json', data: skillArray });
    skillselect.val(skillArray).trigger("change");
    
$selectedSkills = $("#linked_skill_id").select2();
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
});
</script>

<script>
	jQuery(document).ready(function() {
	    ComponentsDropdowns.init();
	});  
	$(document).ready(function () {   
    var form = $('#corp_contact_validation');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);
    form.validate({
        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            firm_email_id: {
                required: true,
                email: true
            },
            username: {
                required: true
            },
            working_as: {
                required: true
            },
            firm_phone: {
                required: false,
                number: true
            }
        },
        messages: {
            firm_email_id: {
                required: "Enter Email Id",
                email: "Enter Valid Email id"
            },
            username: {
                required: "Enter Handler Name"
            },
            working_as: {
                required: "Select Working As"
            },
            firm_phone: {
                number: "Enter only digits"
            } 
        },
            invalidHandler: function (event, validator) { //display error alert on form submit   
            success.hide();
            error.show();
            Metronic.scrollTo(error, -200);
        },

             highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
            unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
         },
    });
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
</script>
<script type="text/javascript">
$('.firm-update').on('click',function(event){  	    
	  	event.preventDefault();
	  	var userid = $(this).data('userid');

	  	var formData = $('#firm-validation-'+userid).serialize(); 
	    var formAction = $('#firm-validation-'+userid).attr('action');
	    
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
				displayToast("Firm Detail Updated");
	        }else if(data.success == 'fail'){
	        	// console.log(data);
	        	displayToast("Something Wrong! Firm Details not updated...");
	        }
	      }
	    }); 
	    return false;
	  });

$('.otherdetails-update').on('click',function(event){  	    
	  	event.preventDefault();
	  	var userid = $(this).data('userid');

	  	var formData = $('#otherdetails-validation-'+userid).serialize(); 
	    var formAction = $('#otherdetails-validation-'+userid).attr('action');
	    
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
				displayToast("other Details Updated");
	        }else if(data.success == 'fail'){
	        	// console.log(data);
	        	displayToast("Something Wrong! otherdetails not updated...");
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