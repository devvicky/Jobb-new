@extends('master')

@section('content')
<form action="/job/update/{{$postjob->unique_id}}" method="post" id="submit_form" 
					  data-toggle="validator" role="form" class="form-horizontal">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">																
<div class="row" style="margin:-5px;">
		<div class="col-md-11" style="padding: 0;">
		<div class="portlet box" id="form_wizard_1">			
			<div class="portlet-body form"  style="background-color: transparent;">
				
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">							
								<li>
									<a href="#tab1" data-toggle="tab" class="step">
										<span class="desc">Job Details</span>
									</a>									
								</li>
								<li>
									<a href="#tab3" data-toggle="tab" class="step active">							
										<span class="desc">Other Details</span>
									</a>									
								</li>
								<li>
									<a href="#tab4" data-toggle="tab" class="step">									
										<span class="desc">Confirm Post</span>
									</a>									
								</li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar" style="margin-bottom: -7px;">
								<div class="progress-bar progress-bar-success"></div>
							</div>
							<div class="tab-content">
								@if (count($errors) > 0)
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif
								<!-- <div class="alert alert-danger display-none">
									<button class="close" data-dismiss="alert"></button>
									You have some form errors. Please check below.
								</div>
								<div class="alert alert-success display-none">
									<button class="close" data-dismiss="alert"></button>
									Your form validation is successful!
								</div> -->
								<div class="tab-pane active" id="tab1">
									<div class="row">
		                                <div class="col-md-8">
		                                    <!-- BEGIN PORTLET -->
		                                    <div class="portlet light " style="background-color:white;">
		                                        <div class="portlet-title">
		                                            <div class="caption caption-md">
		                                                <i class="icon-bar-chart theme-font hide"></i>
		                                                <span class="caption-subject font-blue-madison bold uppercase">Job Details</span>
		                                            </div>
		                                        </div>
		                                        <div class="portlet-body">
		                                            <div class="row">
		                                              <div class="col-md-12">
		                                                <div class="form-group">
		                                                  <div class="input-icon right">
		                                                    <i class="fa"></i>
		                                                    <label>Job Title <span class="required">*</span></label>
		                                                    <div class="input-group">
		                                                      <span class="input-group-addon">
		                                                        <i class="fa fa-flag" style="color:darkcyan;"></i>
		                                                      </span>
		                                                      <input type="text" name="post_title" value="{{$postjob->post_title}}" class="form-control" placeholder="Job Title">
		                                                    </div>
		                                                  </div>
		                                                </div>
		                                              </div>
		                                            </div>
		                                            <div class="row">
		                                                <div class="col-md-6 col-sm-6 col-xs-12">
		                                                  <div class="form-group">
															<label>Industry <span class="required">*</span>
															</label>
															<select class="select2me form-control" name="industry">
																<option @if($postjob->industry=="Automotive/ Ancillaries") {{ $selected }} @endif value="Automotive/ Ancillaries">Automotive/ Ancillaries</option>
																<option @if($postjob->industry=="Banking/ Financial Services") {{ $selected }} @endif value="Banking/ Financial Services">Banking/ Financial Services</option>
																<option @if($postjob->industry=="Bio Technology & Life Sciences") {{ $selected }} @endif value="Bio Technology & Life Sciences">Bio Technology & Life Sciences</option>
																<option @if($postjob->industry=="Chemicals/Petrochemicals") {{ $selected }} @endif value="Chemicals/Petrochemicals">Chemicals/Petrochemicals</option>
																<option @if($postjob->industry=="Construction") {{ $selected }} @endif value="Construction">Construction</option>
																<option @if($postjob->industry=="FMCG") {{ $selected }} @endif value="FMCG">FMCG</option>
																<option @if($postjob->industry=="Education") {{ $selected }} @endif value="Education">Education</option>
																<option @if($postjob->industry=="Entertainment/ Media/ Publishing") {{ $selected }} @endif value="Entertainment/ Media/ Publishing">Entertainment/ Media/ Publishing</option>
																<option @if($postjob->industry=="Insurance") {{ $selected }} @endif value="Insurance">Insurance</option>
																<option @if($postjob->industry=="ITES/BPO") {{ $selected }} @endif value="ITES/BPO">ITES/BPO</option>
																<option @if($postjob->industry=="IT/ Computers - Hardware") {{ $selected }} @endif value="IT/ Computers - Hardware">IT/ Computers - Hardware</option>
																<option @if($postjob->industry=="IT/ Computers - Software") {{ $selected }} @endif value="IT/ Computers - Software">IT/ Computers - Software</option>
																<option @if($postjob->industry=="KPO/Analytic") {{ $selected }} @endif value="KPO/Analytics">KPO/Analytics</option>
																<option @if($postjob->industry=="Machinery/ Equipment Mfg.") {{ $selected }} @endif value="Machinery/ Equipment Mfg.">Machinery/ Equipment Mfg.</option>
																<option @if($postjob->industry=="Oil/ Gas/ Petroleum") {{ $selected }} @endif value="Oil/ Gas/ Petroleum">Oil/ Gas/ Petroleum</option>
																<option @if($postjob->industry=="Pharmaceuticals") {{ $selected }} @endif value="Pharmaceuticals">Pharmaceuticals</option>
																<option @if($postjob->industry=="Power/Energy") {{ $selected }} @endif value="Power/Energy">Power/Energy</option>
																<option @if($postjob->industry=="Retailing") {{ $selected }} @endif value="Retailing">Retailing</option>
																<option @if($postjob->industry=="Telecom") {{ $selected }} @endif value="Telecom">Telecom</option>
																<option @if($postjob->industry=="Advertising/PR/Events") {{ $selected }} @endif value="Advertising/PR/Events">Advertising/PR/Events</option>
																<option @if($postjob->industry=="Agriculture/ Dairy Based") {{ $selected }} @endif value="Agriculture/ Dairy Based">Agriculture/ Dairy Based</option>
																<option @if($postjob->industry=="Aviation/Aerospace") {{ $selected }} @endif value="Aviation/Aerospace">Aviation/Aerospace</option>
																<option @if($postjob->industry=="Beauty/Fitness/PersonalCare/SPA") {{ $selected }} @endif value="Beauty/Fitness/PersonalCare/SPA">Beauty/Fitness/PersonalCare/SPA</option>
																<option @if($postjob->industry=="Beverages/ Liquor") {{ $selected }} @endif value="Beverages/ Liquor">Beverages/ Liquor</option>
																<option @if($postjob->industry=="Cement") {{ $selected }} @endif value="Cement">Cement</option>
																<option @if($postjob->industry=="Ceramics & Sanitary Ware") {{ $selected }} @endif value="Ceramics & Sanitary Ware">Ceramics & Sanitary Ware</option>
																<option @if($postjob->industry=="Consultancy") {{ $selected }} @endif value="Consultancy">Consultancy</option>
																<option @if($postjob->industry=="Courier/ Freight/ Transportation") {{ $selected }} @endif value="Courier/ Freight/ Transportation">Courier/ Freight/ Transportation</option>
																<option @if($postjob->industry=="Law Enforcement/Security Services") {{ $selected }} @endif value="Law Enforcement/Security Services">Law Enforcement/Security Services</option>
																<option @if($postjob->industry=="E-Learning") {{ $selected }} @endif value="E-Learning">E-Learning</option>
																<option @if($postjob->industry=="Shipping/ Marine Services") {{ $selected }} @endif value="Shipping/ Marine Services">Shipping/ Marine Services</option>
																<option @if($postjob->industry=="Engineering, Procurement, Construction") {{ $selected }} @endif value="Engineering, Procurement, Construction">Engineering, Procurement, Construction</option>
																<option @if($postjob->industry=="Environmental Service") {{ $selected }} @endif value="Environmental Service">Environmental Service</option>
																<option @if($postjob->industry=="Facility management") {{ $selected }} @endif value="Facility management">Facility management</option>
																<option @if($postjob->industry=="Fertilizer/ Pesticides") {{ $selected }} @endif value="Fertilizer/ Pesticides">Fertilizer/ Pesticides</option>
																<option @if($postjob->industry=="Food & Packaged Food") {{ $selected }} @endif value="Food & Packaged Food">Food & Packaged Food</option>
																<option @if($postjob->industry=="Textiles / Yarn / Fabrics / Garments") {{ $selected }} @endif value="Textiles / Yarn / Fabrics / Garments">Textiles / Yarn / Fabrics / Garments</option>
																<option @if($postjob->industry=="Gems & Jewellery") {{ $selected }} @endif value="Gems & Jewellery">Gems & Jewellery</option>
																<option @if($postjob->industry=="Government/ PSU/ Defence") {{ $selected }} @endif value="Government/ PSU/ Defence">Government/ PSU/ Defence</option>
																<option @if($postjob->industry=="Consumer Electronics/Appliances") {{ $selected }} @endif value="Consumer Electronics/Appliances">Consumer Electronics/Appliances</option>
																<option @if($postjob->industry=="Hospitals/ Health Care") {{ $selected }} @endif value="Hospitals/ Health Care">Hospitals/ Health Care</option>
																<option @if($postjob->industry=="Hotels/ Restaurant") {{ $selected }} @endif value="Hotels/ Restaurant">Hotels/ Restaurant</option>
																<option @if($postjob->industry=="Import / Export") {{ $selected }} @endif value="Import / Export">Import / Export</option>
																<option @if($postjob->industry=="Market Research") {{ $selected }} @endif value="Market Research">Market Research</option>
																<option @if($postjob->industry=="Medical Transcription") {{ $selected }} @endif value="Medical Transcription">Medical Transcription</option>
																<option @if($postjob->industry=="Mining") {{ $selected }} @endif value="Mining">Mining</option>
																<option @if($postjob->industry=="NGO") {{ $selected }} @endif value="NGO">NGO</option>
																<option @if($postjob->industry=="Paper") {{ $selected }} @endif value="Paper">Paper</option>
																<option @if($postjob->industry=="Printing / Packaging") {{ $selected }} @endif value="Printing / Packaging">Printing / Packaging</option>
																<option @if($postjob->industry=="Public Relations (PR)") {{ $selected }} @endif value="Public Relations (PR)">Public Relations (PR)</option>
																<option @if($postjob->industry=="Travel / Tourism") {{ $selected }} @endif value="Travel / Tourism">Travel / Tourism</option>
																<option @if($postjob->industry=="Other") {{ $selected }} @endif value="Other">Other</option>
						                                    </select>
														</div>
		                                                </div>
		                                                <div class="col-md-6 col-sm-6 col-xs-12">
		                                                  <div class="form-group">
															<label>
																Job Role <span class="required">*</span>
															</label>
															@if($postjob->role == null)
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
															@elseif($postjob->role != null)
																<select class="select2me form-control" name="role">
																	<option value="{{$postjob->functional_area}}-{{$postjob->role}}">{{$postjob->functional_area}}-{{$postjob->role}}</option>
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
														</div>
		                                                </div>
		                                              </div>
		                                          <div class="row">
		                                            <div class="col-md-6 col-sm-6 col-xs-12">
		                                              <div class="form-group">
		                                                <label>Search Skills</label>
		                                                <div style="position:relative;">
		                                                  <input type="text" name="name" id="newskill" class="form-control skill-border-css" placeholder="Search for skill...">
		                                                  <button id="add-new-skill" class="btn btn-success skill-add-button-css" type="button"><i class="icon-plus"></i> Add</button>    
		                                                </div>
		                                                {!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
		                                              </div>
		                                            </div>
		                                            <input type="text" id="confirm-skill" name="skill" style="display:none;">
		                                            <div class="col-md-3 col-sm-3 col-xs-6">
		                                              <div class="form-group">              
		                                                <label class=" control-label">Experience (Min)</label>
		                                                <div class="input-group">
		                                                  <select class="form-control" id="exp_min" name="min_exp">
		                                                    <!-- <option>Select</option> -->
		                                                    <option value="0">0</option>
		                                                    <option value="1">1</option>
		                                                    <option value="2">2</option>
		                                                    <option value="3">3</option>
		                                                    <option value="4">4</option>
		                                                    <option value="5">5</option>
		                                                    <option value="6">6</option>
		                                                    <option value="7">7</option>
		                                                    <option value="8">8</option>
		                                                    <option value="9">9</option>
		                                                    <option value="10">10</option>
		                                                    <option value="11">11</option>
		                                                    <option value="12">12</option>
		                                                    <option value="13">13</option>
		                                                    <option value="14">14</option>
		                                                    <option value="15">15</option>
		                                                  </select>
		                                                  <span class="input-group-addon">
		                                                    Years
		                                                  </span>
		                                                </div>
		                                              </div>
		                                            </div>
		                                            <div class="col-md-3 col-sm-3 col-xs-6">
		                                              <div class="form-group">              
		                                                <label class=" control-label">Experience (Max)</label>
		                                                <div class="input-group">
		                                                  <select class="form-control maxexp" id="exp_max" name="max_exp">
		                                                    <!-- <option>Select</option> -->
		                                                    <option value="0">0</option>
		                                                    <option value="1">1</option>
		                                                    <option value="2">2</option>
		                                                    <option value="3">3</option>
		                                                    <option value="4">4</option>
		                                                    <option value="5">5</option>
		                                                    <option value="6">6</option>
		                                                    <option value="7">7</option>
		                                                    <option value="8">8</option>
		                                                    <option value="9">9</option>
		                                                    <option value="10">10</option>
		                                                    <option value="11">11</option>
		                                                    <option value="12">12</option>
		                                                    <option value="13">13</option>
		                                                    <option value="14">14</option>
		                                                    <option value="15">15</option>
		                                                  </select>
		                                                  <span class="input-group-addon">
		                                                    Years
		                                                  </span>
		                                                </div>
		                                              </div>
		                                            </div>
		                                          </div>
		                                        </div>
		                                    </div>
		                                    
		                                    <!-- END PORTLET -->
		                                    <!-- BEGIN PORTLET -->
		                                    <div class="portlet light " style="background-color:white;">
		                                        <div class="portlet-title">
		                                            <div class="caption caption-md">
		                                                <i class="icon-bar-chart theme-font hide"></i>
		                                                <span class="caption-subject font-blue-madison bold uppercase">Job Description</span>
		                                            </div>
		                                        </div>
		                                        <div class="portlet-body">
		                                            <div class="row">
		                                                <div class="col-md-12">
		                                                    <div class="form-group">
		                                                        <label>Roles & Responsibilities <span class="required">*</span></label>  
		                                                        <textarea id="textarea" rows="6" class="form-control autosizeme" name="job_detail" maxlength="1000" >{{$postjob->job_detail}}</textarea>
		                                                        <div id="textarea_feedback"></div>
		                                                    </div>
		                                                </div>
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
		                                            <div class="row">
		                                                <div class="col-md-6 col-sm-12 col-xs-12">
		                                                    <div class="form-group">
																<label>  Education <span class="required">
																		* </span></label> <!-- Select Multiple <input type="checkbox" id="education-check" name="multiple_education" value="1" class="form-control"> -->
																<!-- <div class="input-group single-education" > -->
																<?php $educa = collect(explode(',', $postjob->education));
																 ?>
																	@if($postjob->education != null)
																	<select class="form-control education-list bs-select" name="education[]" id="education_show" multiple style="border:1px solid #c4d5df">
																		@foreach($educa as $edu)
																			<?php $edu = explode('-', $edu);
																				  	$name = $edu[0];
																				  	$branch = $edu[1];
																				  	$level = $edu[2];

																			 ?>
																		<option value="{{$name}}-{{$branch}}-{{$level}}" selected>{{$name}}-{{$branch}}</option>
																		@endforeach
																		@foreach ($education as $educ)
																			@if($educ->branch == "-")
																			<option value="{{$educ->name}}- -{{$educ->level}}" style="font-weight:600 !important;">{{$educ->name}}</option>
																			@endif
																		@endforeach
																		@foreach($education as $edu)
																			@if($n != $edu->name && $edu->name != '0' && $edu->branch != "-")
																				{{$n=$edu->name}}
																				<optgroup label="{{$edu->name}}">
																			@endif
																			@if($edu->branch != "-")
																				<option value="{{$edu->name}}-{{$edu->branch}}-{{$edu->level}}">{{$edu->name}}-{{$edu->branch}}</option>
																			@endif
																			@if($n != $edu->name && $edu->branch != "-")
																				</optgroup>		
																			@endif
																		@endforeach
																	</select>
																	@endif
																<!-- </div> -->
															</div>
		                                                </div>
		                                                <div class="col-md-6 col-sm-6 col-xs-12">
		                                                    <div class="form-group new-margin-formgroup">
		                                                        <label>Post Duration <span class="required">
		                                                            * </span></label>
		                                                        <div class="input-group">
		                                                            <span class="input-group-addon">
		                                                            <i class="icon-clock" style=" color: darkcyan;"></i>
		                                                            </span>
		                                                            <select name="post_duration" class="form-control" >
		                                                                <option value="">--select--</option>                    
		                                                                <option value="3">3 Days</option>
		                                                                <option value="7">7 Days</option>
		                                                                <option value="15">15 Days</option>
		                                                                <option value="30">30 Days</option>
		                                                            </select>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="row">
		                                                <div class="col-md-6 col-sm-6 col-xs-12">
		                                                    <div class="form-group">
		                                                        <label>Select Prefered Location <span class="required">
		                                                                * </span></label>
		                                                        <div class="input-group">
		                                                            <span class="input-group-addon" style="border-bottom: 0;border-bottom-left-radius: 0;">
		                                                                <i class="fa fa-map-marker"></i>
		                                                            </span>

		                                                            <input type="text" id="pref_loc" name="pref_loc" 
		                                                            class="form-control" placeholder="Select preferred location" style="border-bottom: 0;border-bottom-left-radius: 0;border-bottom-right-radius:0;">                                   
		                                                            
		                                                        </div>
		                                                        {!! Form::select('prefered_location[]', [], null, ['id'=>'prefered_location', 
		                                                                                                           'aria-hidden'=>'true', 
		                                                                                                           'class'=>'form-control', 
		                                                                                                           'placeholder'=>'city', 
		                                                                                                           'multiple']) !!}     
		                                                    </div>
		                                                </div>
		                                                <input type="text" id="show_location" name="show-location" style="display:none;">
		                                                <div class="col-md-6 col-sm-6 col-xs-12">
		                                            		<div class="form-group">
		                                                        <label class=" control-label">Candidate Availability</label>
		                                                        <div class="input-group">
		                                                            <span class="input-group-addon">
		                                                                <i class="fa fa-clock-o"></i>
		                                                            </span>
		                                                            <select  name="candidate_availablity" class=" form-control" style="">                                    
			                                                            <option selected="selected" value="0">Immediate</option>
			                                                            <option value="7">in 7 Days </option>
			                                                            <option value="15">in 15 Days</option>
			                                                            <option value="30">in 30 Days</option>
			                                                            <option value="45">in 45 Days</option>
			                                                            <option value="60">in Two Months</option> 
			                                                            <option value="90">in Three Months</option> 
			                                                        </select>
		                                                        </div>
		                                                    </div>
		                                            	</div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <!-- END PORTLET -->
		                                </div>
		                                <div class="col-md-4" style="    margin: 7px 0 0px 0;">
										    <div class="company-card">
										        <div class="company-card-image">
										            <span>Posted By</span>
										            @if(Auth::user()->identifier == 1)
										            @if(Auth::user()->induser->profile_pic != null)
										            <a href="">
										                <img src="/img/profile/{{ Auth::user()->induser->profile_pic }}" alt="">
										            </a>
										            @elseif(Auth::user()->induser->profile_pic == null)
										            <div class=" badge-margin post-image-css">
										                <i class="fa fa-user" style="font-size: 80px;margin: 50px 30px;color: #555;"></i> 
										            </div>
										            @endif

										            <div class="profile-usertitle-name" style="margin-top: 10px;">
										                {{Auth::user()->induser->fname}}
										            </div>
										            <div class="profile-usertitle-job">
										                @if(Auth::user()->induser->role != null) {{Auth::user()->induser->role}} @endif 
										            </div>
										            @elseif(Auth::user()->identifier == 2)
										            @if(Auth::user()->corpuser->logo_status != null)
										            <a href="">
										                <img src="/img/profile/{{ Auth::user()->corpuser->logo_status }}" alt="">
										            </a>
										            @elseif(Auth::user()->corpuser->logo_status == null)
										            <div class=" badge-margin post-image-css">
										                <i class="fa fa-user" style="font-size: 80px;margin: 50px 30px;color: #555;"></i> 
										            </div>
										            @endif

										            <div class="profile-usertitle-name" style="margin-top: 10px;">
										                {{Auth::user()->corpuser->firm_name}}
										            </div>
										            <div class="profile-usertitle-job">
										                @if(Auth::user()->corpuser->slogan != null) {{Auth::user()->corpuser->slogan}} @endif 
										            </div>
										            @endif
										        </div><!-- /.company-card-image -->
										        
										        <div class="company-card-data">
		                                            <div class="row" style="margin: 0 5px;">
		                                                <div class="col-md-12">
		                                                    <div class="form-group" style="margin-bottom: 0;">
		                                                        <label><input id="hide-apply" name="apply-check" type="checkbox"></label><label style="color: #eee;">&nbsp;Apply On Company Website</label>
		                                                        <div  class="input-group show-apply">
		                                                            <input type="text" name="website_redirect_url" class="form-control" value="" placeholder="http://">
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <h2 class="decorated show-apply-email" style="margin: 0px 10px 8px 10px;color: rgb(202, 225, 236);">
														<span style="font-size: 12px;">OR</span>
													</h2>
										        	<div class="row show-apply-email" style="margin:0 10px">
												        <div class="col-md-12 ">
													        <div class="form-group">
													            <label style="color: #eee;">Show Contact<span class="required">
													                    * </span></label>
													            <div class="input-group">
													                <div class="md-radio-inline">
													                    <div class="md-radio">
													                        <input type="radio" checked id="radio6" data-title="Public" name="show_contact" value="Public" class="md-radiobtn">
													                        <label for="radio6" style="color:#eee;">
													                        <span></span>
													                        <span class="check"></span>
													                        <span class="box" style="border: 2px solid white;"></span>
													                        Public </label>
													                    </div>
													                    <div class="md-radio">
													                        <input type="radio" id="radio7" data-title="Private" name="show_contact" value="Private" class="md-radiobtn">
													                        <label for="radio7" style="color:#eee;">
													                        <span></span>
													                        <span class="check"></span>
													                        <span class="box" style="border: 2px solid white;"></span>
													                        Private</label>
													                    </div>
													                </div>  
													                <div id="radio_error"></div>                    <!-- /input-group -->
													            </div>
													            <div class="public" style="color: rgb(255, 208, 173);font-size: 11px;">Your Contact details will be shown on the post and people may directly contact you.</div>
													            <div class="private display-none" style="color: rgb(255, 208, 173);font-size: 11px;">Your Contact details will not be shown on the post. You may have to contact people who have applied on this post.</div>
													        </div>
													    </div>
													</div>
													<div class="row show-apply-email" style="margin:0 10px">
										                <div class="col-md-12 col-sm-12">
										                    <div class="form-group">
										                        <label style="color:#eee;">Email Id</label>
										                        <div class="input-group">
										                        <span class="input-group-addon" style="background-color: transparent;">
										                        <i class="icon-envelope" style="color:#29DCDC;"></i>
										                        
										                        </span>
										                        <input type="text" name="email_id" value="{{ Auth::user()->email }}" class="form-control group" placeholder="Email Id" style="color: white;">
										                        </div>
										                    </div>
										                </div>
										                <!--/span-->
										                <!-- <div class="col-md-2"></div> -->
										                <div class="col-md-12 col-sm-12">
										                    <div class="form-group">
										                        <label style="color:#eee;">Phone No</label>
										                        <div class="input-group">
										                        <span class="input-group-addon">
										                        <i class="icon-call-end" style="color:#29DCDC;"></i>
										                        </span>
										                        <input type="text" name="phone" minlength="10" maxlength="10" value="{{ Auth::user()->mobile }}"  class="form-control group" placeholder="Phone No" style="color: white;">
										                        
										                        </div>
										                    </div>
										                </div>
										                <!--/span-->
										            </div>
										        </div><!-- /.company-card-data -->
										    </div>
										</div>
		                            </div>	
								</div>
								
								<div class="tab-pane" id="tab3">
									<div class="row">
		                                <div class="col-md-8">
		                                    <!-- BEGIN PORTLET -->
		                                    <div class="portlet light " style="background-color:white;">
		                                        <div class="portlet-title">
		                                            <div class="caption caption-md">
		                                                <i class="icon-bar-chart theme-font hide"></i>
		                                                <span class="caption-subject font-blue-madison bold uppercase">Other Requirements</span>
		                                            </div>
		                                        </div>
		                                        <div class="portlet-body">
		                                            <div class="row">
		                                                <div class="col-md-6 col-sm-6 col-xs-12">
		                                                    <div class="form-group">
		                                                        <label>Job Type <span class="required">
		                                                        * </span></label>
		                                                        <div class="input-group">
		                                                            <span class="input-group-addon">
		                                                                <i class="icon-hourglass" style="color:darkcyan;"></i>
		                                                            </span>
		                                                            <select name="time_for" class="form-control" style="z-index:0;">
																		<option value="">-- select --</option>
																		<option @if($postjob->time_for=="Full Time") {{ $selected }} @endif value="Full Time">Full Time</option>
																		<option @if($postjob->time_for=="Part Time") {{ $selected }} @endif value="Part Time">Part Time</option>
																		<option @if($postjob->time_for=="Freelancer") {{ $selected }} @endif value="Freelancer">Freelancer</option>
																		<option @if($postjob->time_for=="Work from home") {{ $selected }} @endif value="Work from home">Work from home</option>
																	</select>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-md-6">
		                                                    <label class="contro-label">Job Agreement</label>
		                                                    <div class="form-group">
		                                                         <div class="input-group">
		                                                            <span class="input-group-addon">
		                                                                <i class="fa fa-inr"></i>
		                                                            </span>
		                                                            <select class="form-control" name="job_agreement">
		                                                                <option value="">Select</option>
		                                                                <option value="Contract">Contract</option>
		                                                                <option value="Permanent">Permanent</option>
		                                                                <option value="One Time Project">One Time Project</option>
		                                                            </select>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="row">
		                                            	<div class="col-md-6 col-sm-6 col-xs-12">
		                                                    <div class="form-group">
		                                                        
		                                                        <label class=" control-label"> Salary</label>
		                                                        <div class="input-group">
		                                                            <span class="input-group-addon">
		                                                                <i class="fa fa-rupee (alias)"></i>
		                                                            </span>
		                                                            <input class="form-control" name="min_sal" id="minsal" style="width:60%;">
		                                                            <select id="salary-type"  name="salary_type" class="input-sal-exp-label form-control" style="border-left:0;width:40%">                                    
			                                                            <option selected="selected" value="Monthly">Month</option>
			                                                            <option value="Week">Weekly</option>
			                                                            <option value="Day">Daily</option>
			                                                            <option value="Hour">Hourly</option>
			                                                            <option value="Onvisit">Per Visit</option> 
			                                                        </select>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                
		                                                <div class="col-md-6 col-sm-6 col-xs-12 show-apply-email">
		                                                	<label class=" control-label">Resume Required</label>
		                                                	<div class="form-group">
													            <div class="input-group">
													                <div class="md-radio-inline">
													                    <div class="md-radio">
													                        <input type="radio"  id="radio8" data-title="Yes" name="resume_required" value="1" class="md-radiobtn">
													                        <label for="radio8" style="">
													                        <span></span>
													                        <span class="check"></span>
													                        <span class="box"></span>
													                        Yes </label>
													                    </div>
													                    <div class="md-radio">
													                        <input type="radio" checked id="radio9" data-title="No" name="resume_required" value="0" class="md-radiobtn">
													                        <label for="radio9" style="">
													                        <span></span>
													                        <span class="check"></span>
													                        <span class="box"></span>
													                        No</label>
													                    </div>
													                </div>  
													                <div id="radio_error"></div>                    <!-- /input-group -->
													            </div>
													        </div>
		                                                </div>
		                                            </div>
		                                            <div class="row">
		                                            	
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <!-- END PORTLET -->
		                                    <!-- BEGIN PORTLET -->
		                                    <div class="portlet light " style="background-color:white;">
		                                      <div class="portlet-title">
		                                        <div class="caption caption-md">
		                                          <i class="icon-bar-chart theme-font hide"></i>
		                                          <span class="caption-subject font-blue-madison bold uppercase">Company Details</span>
		                                        </div>
		                                      </div>
		                                        <div class="portlet-body">
		                                            <div class="row">
		                                                <div class="col-md-6 col-sm-6 col-xs-12">
		                                                    <div class="form-group">
		                                                        <div class="input-icon right">
		                                                                <i class="fa"></i>
		                                                            <label>Company Name</label>
		                                                            <div class="input-group">
		                                                                <span class="input-group-addon">
		                                                                    <i class="fa fa-building" style="color:darkcyan;"></i>
		                                                                </span>
		                                                                <input type="text" id="comp_name_1" style="z-index:0;" name="post_compname" class="form-control" placeholder="Company Name">
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <!-- <div class="col-md-2 col-sm-2 col-xs-2"></div> -->
		                                                <div class="col-md-6 col-sm-6 col-xs-12">
		                                                    <div class="form-group">
		                                                        <label>Reference Id</label>
		                                                        <div class="input-group">
		                                                            <span class="input-group-addon">
		                                                                <i class="fa fa-info" style="color:darkcyan;"></i>
		                                                            </span>
		                                                            <input type="text" id="ref_id_1" style="z-index:0;" name="reference_id" class="form-control" placeholder="Reference Id">
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="row">
		                                                <div class="col-md-12">
		                                                    <div class="form-group">
		                                                        <label>About Company</label>
		                                                        <textarea id="textareas" rows="6" class="form-control autosizeme" name="about_company" maxlength="1000" >
		                                                        	@if(Auth::user()->identifier == 2 && Auth::user()->corpuser->about_firm != null)
		                                                        		{{Auth::user()->corpuser->about_firm}}
		                                                        	@endif
		                                                        </textarea>
		                                                        <div id="textarea_feedback"></div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <!-- END PORTLET -->
		                                </div>
		                                <div class="col-md-4" style="    margin: 7px 0 0px 0;">
										    <div class="company-card">
										        <div class="company-card-image">
										            <span>Posted By</span>
										            @if(Auth::user()->identifier == 1)
										            @if(Auth::user()->induser->profile_pic != null)
										            <a href="">
										                <img src="/img/profile/{{ Auth::user()->induser->profile_pic }}" alt="">
										            </a>
										            @elseif(Auth::user()->induser->profile_pic == null)
										            <div class=" badge-margin post-image-css">
										                <i class="fa fa-user" style="font-size: 65px;margin: 40px 29px;color: lightgray;"></i> 
										            </div>
										            @endif

										            <div class="profile-usertitle-name" style="margin-top: 10px;">
										                {{Auth::user()->induser->fname}}
										            </div>
										            <div class="profile-usertitle-job">
										                @if(Auth::user()->induser->role != null) {{Auth::user()->induser->role}} @endif 
										            </div>
										            @elseif(Auth::user()->identifier == 2)
										            @if(Auth::user()->corpuser->logo_status != null)
										            <a href="">
										                <img src="/img/profile/{{ Auth::user()->corpuser->logo_status }}" alt="">
										            </a>
										            @elseif(Auth::user()->corpuser->logo_status == null)
										            <div class=" badge-margin post-image-css">
										                <i class="fa fa-user" style="font-size: 65px;margin: 40px 29px;color: lightgray;"></i> 
										            </div>
										            @endif

										            <div class="profile-usertitle-name" style="margin-top: 10px;">
										                {{Auth::user()->corpuser->firm_name}}
										            </div>
										            <div class="profile-usertitle-job">
										                @if(Auth::user()->corpuser->slogan != null) {{Auth::user()->corpuser->slogan}} @endif 
										            </div>
										            @endif
										        </div><!-- /.company-card-image -->
										        <div class="company-card-data">
												        	<div class="row apply-here" style="margin:0 10px">
												        		<div class="col-md-12">
												        			<div class="form-group">
												        				<label style="color: #eee;">Apply here:</label>
												        				<p class="form-control-static-msg" data-display="website_redirect_url"></p>
												        			</div>
												        		</div>
												        	</div>
												        	<div class="row show-apply-email" style="margin:0 10px">
														        <div class="col-md-12 ">
															        <div class="form-group">
															            <label style="color: #eee;">Show Contact: <span class="required">
															                    * </span></label>
															            <p class="form-control-static-msg" data-display-msg="show_contact"></p>
															            
															        </div>
															    </div>
															</div>
															<div class="row show-apply-email" style="margin:0 10px">
												                <div class="col-md-12 col-sm-12">
												                    <div class="form-group">
												                        <label style="color: #eee;">Email Id: </label>
												                         <p class="form-control-static-msg" data-display-msg="email_id"></p>
												                    </div>
												                </div>
												                <!--/span-->
												                <!-- <div class="col-md-2"></div> -->
												                <div class="col-md-12 col-sm-12">
												                    <div class="form-group">
												                        <label style="color: #eee;">Phone No: </label>
												                         <p class="form-control-static-msg" data-display-msg="phone"></p>
												                    </div>
												                </div>
												                <!--/span-->
												            </div>
												        </div><!-- /.company-card-data -->
										        <div class="company-card-data">
										        	<div class="row apply-here" style="margin:0 10px">
										        		<div class="col-md-12">
										        			<div class="form-group">
										        				<label style="color: #eee;">Apply here:</label>
										        				<p class="form-control-static-msg" data-display-msg="website_redirect_url"></p>
										        			</div>
										        		</div>
										        	</div>
										        	<div class="row show-apply-email" style="margin:0 10px">
												        <div class="col-md-12 ">
													        <div class="form-group">
													            <label style="color: #eee;">Show Contact:</label>
													            <p class="form-control-static-msg" data-display-msg="show_contact"></p>
													        </div>
													    </div>
													</div>
													<div class="row show-apply-email" style="margin:0 10px">
										                <div class="col-md-12 col-sm-12">
										                    <div class="form-group">
										                        <label style="color: #eee;"><i class="fa fa-envelope"></i> </label>&nbsp;&nbsp; <p class="form-control-static-msg" data-display-msg="email_id"></p>
										                    </div>
										                </div>
										                <!--/span-->
										                <!-- <div class="col-md-2"></div> -->
										                <div class="col-md-12 col-sm-12">
										                    <div class="form-group">
										                        <label style="color: #eee;"><i class="fa fa-phone-square"></i> </label>&nbsp;&nbsp; <p class="form-control-static-msg" data-display-msg="phone"></p>
										                    </div>
										                </div>
										                <!--/span-->
										            </div>
										        </div><!-- /.company-card-data -->
										    </div>
										</div>
		                            </div>
								</div>
								<div class="tab-pane" id="tab4">
									
									<input type="hidden" name="post_type">
										<div class="form-body">
											<div class="row">																				
												<div class="col-md-8" style="padding:0;">												
													@if(Auth::user()->induser)
													<!-- BEGIN PORTLET -->
													<div class="portlet light " style="background-color:white;">
														<div class="portlet-title">
															<div class="caption caption-md">
																<i class="icon-bar-chart theme-font hide"></i>
																<span class="caption-subject font-blue-madison bold uppercase">Share this Post with</span>
															</div>
														</div>
														<div class="portlet-body">
															<div class="row">	
																<div class="col-md-12">
																	<div class="row">
																		<div class="col-md-12 col-sm-12">
																			<label class="add-everyone" for="tag-group-all" style="padding: 5.5px 12px;">
																				<input type="checkbox" id="tag-group-all" name="tag-group" value="all" class="md-radiobtn">
																				<i class="fa fa-globe"></i> Everyone 
																			</label>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 col-sm-3">
																			<label class="add-group" for="tag-group-groups" style="padding: 5.5px 12px;">
																				<input type="checkbox" id="tag-group-groups" name="tag-group" value="groups" class="md-radiobtn" >														
																				<i class="icon-users"></i> Groups 
																			</label>
																		</div>
																		<div class="col-md-9 col-sm-9">
																			<div class="form-group hide-group" style="border-bottom: 1px solid lightgrey;">
																				{!! Form::select('groups[]', $groups, null, ['id'=>'groups', 'placeholder' => 'Add Groups', 'class'=>'form-control', 'multiple']) !!}	
																			</div>	
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 col-sm-3">
																			<label class="add-link" for="tag-group-links" style="padding: 5.5px 12px;">
																				<input type="checkbox" id="tag-group-links" name="tag-group" value="links" class="md-radiobtn" >
																				<i class="icon-link"></i> Links 
																			</label>
																		</div>
																		<div class="col-md-9 col-sm-9">
																			<div class="form-group hide-link" style="border-bottom: 1px solid lightgrey;">	
																											
																				 {!! Form::select('connections[]', $connections, null, ['placeholder' => 'Add Links', 'id' => 'connections', 'class' => 'form-control', 'multiple']) !!}
																			</div>	
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													@endif
													<!-- END PORTLET -->
													<!-- BEGIN PORTLET -->
													<!-- <div class="portlet light " style="background-color:white;">
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
													</div> -->
													<!-- END PORTLET -->
													<!-- BEGIN PORTLET -->
										            <div class="portlet light " style="">
										                <!-- <div class="portlet-title">
										                    <div class="caption caption-md">
										                        <i class="icon-bar-chart theme-font hide"></i>
										                        <span class="caption-subject font-blue-madison bold uppercase">Portlet</span>
										                    </div>
										                </div> -->
										                <div class="portlet-body">
										                    <div class="table-scrollable" style="border: 0;margin: -8px 0 0px 0 !important;">
										                        <table class="table table-bordered table-bordered-detail table-hover">
										                            <tbody>
										                                <tr class="table-row-bg" style="border-top:0;">
										                                    <td style="border-top:0;">
										                                         Industry
										                                    </td>
										                                    <td style="border-top:0;">
										                                         <p class="form-control-static" data-display="industry" style="margin: -5px 0;"></p>
										                                    </td>
										                                    
										                                </tr>
										                                <tr class="table-row-bg">
										                                    <td>
										                                         Functional Area & Role
										                                    </td>
										                                    <td>
										                                         <p class="form-control-static" data-display="role" style="margin: -5px 0;"></p>
										                                    </td>
										                                   
										                                </tr>
										                                <tr class="table-row-bg">
										                                    <td>
										                                         Education
										                                    </td>
										                                    <td>
										                                         <p class="form-control-static" data-display="education[]" style="margin: -5px 0;"></p>
										                                    </td>
										                                    
										                                </tr>
										                                <tr class="table-row-bg">
										                                    <td>
										                                         Skill
										                                    </td>
										                                    <td>
										                                         <p class="form-control-static" data-display="skill" style="margin: -5px 0;"></p>
										                                    </td>
										                                </tr>
										                                <tr class="table-row-bg">
										                                    <td>
										                                         Job Type
										                                    </td>
										                                    <td>
										                                         <p class="form-control-static" data-display="time_for"></p>
										                                    </td>
										                                </tr>
										                                <tr class="table-row-bg">
										                                    <td>
										                                         Salary
										                                    </td>
										                                    <td>
										                                        <i class="fa fa-inr" style="font-size:12px;"></i> <p class="form-control-static" data-display="min_sal"></p> / <p class="form-control-static" data-display="salary_type"></p>
										                                    </td>
										                                </tr>
										                                <tr class="table-row-bg">
										                                    <td>
										                                        Joining Period
										                                    </td>
										                                    <td>
										                                        <p class="form-control-static" data-display="candidate_availablity"></p>
										                                    </td>
										                                </tr>
										                                <tr class="table-row-bg">
										                                    <td>
										                                         Job Agreement
										                                    </td>
										                                    <td>
										                                        <p class="form-control-static" data-display="job_agreement"></p>
										                                    </td>
										                                </tr>
										                            </tbody>
										                        </table>
										                    </div>
										                </div>
										            </div>
										            <!-- END PORTLET -->
		                                            <!-- BEGIN PORTLET -->
										            <div class="portlet light " style="background-color:white;">
										                <div class="portlet-title">
										                    <div class="caption caption-md">
										                        <i class="icon-bar-chart theme-font hide"></i>
										                        <span class="caption-subject font-blue-madison bold uppercase">Description</span>
										                    </div>
										                </div>
										                <div class="portlet-body">
										                    <p class="form-control-static" data-display="job_detail"></p>
										                </div>
										            </div>
										            <!-- END PORTLET -->
										            <!-- BEGIN PORTLET -->
										            <div class="portlet light " style="background-color:white;">
										                <div class="portlet-title">
										                    <div class="caption caption-md">
										                        <i class="icon-bar-chart theme-font hide"></i>
										                        <span class="caption-subject font-blue-madison bold uppercase">About Compnay</span>
										                    </div>
										                </div>
										                <div class="portlet-body">
										                	<p class="form-control-static" data-display="post_compname" style="font-size:16px;"></p><br/>
										                	Reference Id - <p class="form-control-static" data-display="reference_id"></p><br/>
										                    Details - <p class="form-control-static" data-display="about_company"></p>
										                </div>
										            </div>
										            <!-- END PORTLET -->
															
													
												</div>
												<div class="col-md-4" style="    margin: 7px 0 0px 0;">
												    <div class="company-card">
												        <div class="company-card-image">
												            <span>Posted By</span>
												            @if(Auth::user()->identifier == 1)
												            @if(Auth::user()->induser->profile_pic != null)
												            <a href="">
												                <img src="/img/profile/{{ Auth::user()->induser->profile_pic }}" alt="">
												            </a>
												            @elseif(Auth::user()->induser->profile_pic == null)
												            <div class=" badge-margin post-image-css">
												                <i class="fa fa-user" style="font-size: 80px;margin: 50px 30px;color: #555;"></i> 
												            </div>
												            @endif

												            <div class="profile-usertitle-name" style="margin-top: 10px;">
												                {{Auth::user()->induser->fname}}
												            </div>
												            <div class="profile-usertitle-job">
												                @if(Auth::user()->induser->role != null) {{Auth::user()->induser->role}} @endif 
												            </div>
												            @elseif(Auth::user()->identifier == 2)
												            @if(Auth::user()->corpuser->logo_status != null)
												            <a href="">
												                <img src="/img/profile/{{ Auth::user()->corpuser->logo_status }}" alt="">
												            </a>
												            @elseif(Auth::user()->corpuser->logo_status == null)
												            <div class=" badge-margin post-image-css">
												                <i class="fa fa-user" style="font-size: 65px;margin: 40px 29px;color: lightgray;"></i> 
												            </div>
												            @endif

												            <div class="profile-usertitle-name" style="margin-top: 10px;">
												                {{Auth::user()->corpuser->firm_name}}
												            </div>
												            <div class="profile-usertitle-job">
												                @if(Auth::user()->corpuser->slogan != null) {{Auth::user()->corpuser->slogan}} @endif 
												            </div>
												            @endif
												        </div><!-- /.company-card-image -->
												        
												        <div class="company-card-data">
												        	<div class="row apply-here" style="margin:0 10px">
												        		<div class="col-md-12">
												        			<div class="form-group">
												        				<label style="color: #eee;">Apply here:</label>
												        				<p class="form-control-static" data-display="website_redirect_url"></p>
												        			</div>
												        		</div>
												        	</div>
												        	<div class="row show-apply-email" style="margin:0 10px">
														        <div class="col-md-12 ">
															        <div class="form-group">
															            <label style="color: #eee;">Show Contact: <span class="required">
															                    * </span></label>
															            <p class="form-control-static" data-display="show_contact"></p>
															            
															        </div>
															    </div>
															</div>
															<div class="row show-apply-email" style="margin:0 10px">
												                <div class="col-md-12 col-sm-12">
												                    <div class="form-group">
												                        <label style="color: #eee;">Email Id: </label>
												                         <p class="form-control-static" data-display="email_id"></p>
												                    </div>
												                </div>
												                <!--/span-->
												                <!-- <div class="col-md-2"></div> -->
												                <div class="col-md-12 col-sm-12">
												                    <div class="form-group">
												                        <label style="color: #eee;">Phone No: </label>
												                         <p class="form-control-static" data-display="phone"></p>
												                    </div>
												                </div>
												                <!--/span-->
												            </div>
												        </div><!-- /.company-card-data -->
												    </div>
												</div>
											</div>
										</div>
										<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" style="float: none;margin: 7px auto;display: table;"></div>	
									</div>
								</div>
							<div class="form-actions">

								<div style="margin: auto;display: table;">
									<a href="javascript:;" class="btn default button-previous">
										<i class="m-icon-swapleft"></i> Back 
									</a>
									<a href="javascript:;" class="btn blue button-next">
										Continue <i class="m-icon-swapright m-icon-white"></i>
									</a>
									<!-- <a href="javascript:;" class="btn green ">
									Submit <i class="m-icon-swapright m-icon-white"></i>
									</a> -->
									<button type="submit" class=" btn blue button-submit">Submit</button>
								</div>
							</div>
						</div>
					</div>
		</div>
	</div>
</div>

</div>
</form>
<div id="loader" style="display:none;z-index:9999;background:white" class="page-loading">
	<img src="/assets/loader.gif"><span> Please wait...</span>
</div>

@stop


@section('javascript')
<script src="/assets/admin/pages/scripts/components-dropdowns.js"></script>
<script src="/assets/js/jminmaxselect-0.5.2.min.js"></script>
<script type="text/javascript">
	$('#exp_min').jMinMaxSelect({
	    maxSelect: '#exp_max'
	});
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<script type="text/javascript">
	$(".education-list").select2({
	  placeholder: "Select education"
	});

	$("#linked_skill_id").select2({
	  placeholder: "No Added Skill"
	});

    // preferred loc
	var prefLocationArray = [];

    // preferred loc    
    var plselect = $("#prefered_location").select2();
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

			var selectedLoc = document.getElementById('show_location').value;
		  	if(selectedLoc == '' && locality != '' && city != '' && state != ''){
		  		selectedLoc = locality +"-"+ city +"-"+ state;
		  	}else if(selectedLoc == '' && locality == '' && city != '' && state != ''){
		  		selectedLoc = city +"-"+ state;
		  	}else if(selectedLoc != '' && locality != '' && city != '' && state != ''){
		  		selectedLoc = selectedLoc + ', ' +locality +"-"+ city +"-"+ state;
		  	}else if(selectedLoc != '' && locality == '' && city != '' && state != ''){
		  		selectedLoc = selectedLoc + ', ' + city +"-"+ state;
		  	}
		  	
		  	document.getElementById('show_location').value = selectedLoc;

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

	$('#education_show').on('change', function(){
	var education = document.getElementById('education_show').value;
	console.log(education);
		if(education == ''){
			education = ', ';
		}else{
			education = education + ', ';
		}
		
	document.getElementById('confirm-education').value = education;

});
</script>
<script>
jQuery(document).ready(function() {       
	ComponentsIonSliders.init();  
	 
	ComponentsDropdowns.init();
	ComponentsEditors.init();
    FormWizard.init();
    ComponentsjQueryUISliders.init(); 
});
</script>

<script type="text/javascript">
 
</script>
<script>
    $(document).ready(function () {
        $('#nav li').hover(
        function () {
            //show submenu
            $('ul', this).slideDown("fast");
        }, function () {
            //hide submenu
            $('ul', this).slideUp("fast");
        });
    });
</script>
<script type="text/javascript">
function loader(arg){
    if(arg == 'show'){
        $('#loader').show();
    }else{
        $('#loader').hide();
    }
}

$(document).ready(function() {
var text_max = 1000;
$('#textarea_feedback').html(text_max + ' characters remaining');

$('#textarea').keyup(function() {
    var text_length = $('#textarea').val().length;
    var text_remaining = text_max - text_length;

    $('#textarea_feedback').html(text_remaining + ' characters remaining');
});

});


	function countChar(val) {
		var len = val.value.length;
		if (len >= 500) {
			val.value = val.value.substring(0, 500);
		} else {
			$('#charNum').text(500 - len);
		}
	};
   
    $("#education").multipleSelect({
        filter: true,
        multiple: true
    });

    var job_categories = new Array();
	function addRole(val){
		job_categories.push(val);		
		// console.log(job_categories); 
	}

	function removeRole(val){
		job_categories.splice( job_categories.indexOf(val), 1 );
		// console.log(job_categories); 
	}
    
	$("#job_categories").multipleSelect({
		onClick: function(view) {
			view.checked ? addRole(view.value) : removeRole(view.value);
		},
		onClose: function() {	
			if(job_categories.length > 0){
				loader('show');
				$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });
				$.ajax({
					url: '/jobcategory/roles',
					type: "post",
					data: {category: job_categories},
					cache : false,
					success:function(data){
						var $select = $('#job_roles');
						$select.html(' ');
						$.each(data.role, function(key, val){
						  $select.append('<option id="' + val.job_role + '">' + val.job_role + '</option>');
						});
						loader('hide');
					},
					error:function(data){
						console.log(data);
						loader('hide');
					}
				});
			}else{
				var $select = $('#job_roles');
				$select.html(' ');
				$select.append('<option id="">Please select job category</option>');
			}
		}	
	});
    </script>
<script type="text/javascript">
    $(function () {
    	$(".hide-sal").hide();
    	$(".show-salary").hide();
    	$(".hide-sal-new").hide();
    	$(".one").prop('disabled',true);
    	$(".two").prop('disabled',true);
        $("#hide-check").click(function () {
            if ($(this).is(":checked")) {
                $(".hide-sal").show();
                $(".show-salary").show();
                $(".hide-sal-new").show();
                $(".one").prop('disabled',false);
    			$(".two").prop('disabled',false);
            } else {
                $(".hide-sal").hide();
                $(".show-salary").hide();
                $(".hide-sal-new").hide();
                $(".one").prop('disabled',true);
    			$(".two").prop('disabled',true);
            }
        });
    });

        $(function () {
        $("#resume-check").click(function () {
            if ($(this).is(":checked")) {
                $(".resume-required").show();
                $(".not-required").hide();
            } else {
            	$(".not-required").show();
                $(".resume-required").hide();
                
            }
        });
    });

        $(function () {
	 	$(".show-apply").hide();
        $("#hide-apply").click(function () {
            if ($(this).is(":checked")) {
                $(".show-apply").show();
                $(".apply-here").show();
                $(".show-apply-email").hide();
                 
            } else {
                $(".show-apply-email").show();
                $(".show-apply").hide();
                $(".apply-here").hide();
            }
        });
    });

    $(function () {
	 	$(".multiple-education").hide();
        $("#education-check").click(function () {
            if ($(this).is(":checked")) {
                $(".multiple-education").show();
                $(".single-education").hide();
                 
            } else {
               
                $(".single-education").show();
                 $(".multiple-education").hide();
            }
        });
    });

    $(function () {
        $("#radio7").click(function () {
            if ($(this).is(":checked")) {
                $(".private").show();
                $(".public").hide();
                 
            }
        });
        $("#radio6").click(function () {
            if ($(this).is(":checked")) {
                $(".private").hide();
                $(".public").show();
                 
            }
        });
    });
	  

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

    $('#connections').select2({
    placeholder: "Enter Name"
});
    $('#groups').select2({
    placeholder: "Enter Group Name"
});
</script>
<script>
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

				$showSkill = split( $('#confirm-skill').val() );
				$showSkill.pop();
				$showSkill.push( ui.item.value );
				$showSkill.push( "" );
				$('#confirm-skill').val($showSkill.join( ", " ));

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


						$sk = $('#confirm-skill').val();
			        	$('#confirm-skill').val($sk+""+$newSkill+", ");
						
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
<script type="text/javascript">
	 
	
	// user post tagging
	/*$("#connections-list").hide();
    $("#groups-list").hide();*/
   /* $("#connections").prop('required',false);
    $("#groups").prop('required',false);*/
    $("#connections").prop('disabled',true);
    $("#groups").prop('disabled',true);
    $("#tag-group-all").prop('checked', true);
    $('.add-everyone').addClass('tag-css');
    $(".hide-link").hide();
    $(".hide-group").hide();
	$("input[name$='tag-group']").click(function() {
        var selected = $(this).val();
        if(selected == 'all' && $(this).prop('checked')){
        	/*$("#connections-list").hide();
        	$("#groups-list").hide();
        	$("#connections").hide();
        	$("#groups").hide();*/
        	$("#connections").prop('required',false);
        	$("#groups").prop('required',false);
        	$("#connections").prop('disabled',true);
        	$("#groups").prop('disabled',true);
        	$(".hide-link").hide();
        	$(".hide-group").hide();
        	$('.add-everyone').addClass('tag-css');
        	$('.add-link').removeClass('tag-css');
        	$('.add-group').removeClass('tag-css');
        	$("#tag-group-links").prop('checked', false);
        	$("#tag-group-groups").prop('checked', false);
        }else if(selected == 'links' && $(this).prop('checked')){
        	/*$("#connections-list").show();
        	$("#groups-list").show();
        	$("#connections").show();
        	$("#groups").show();*/
        	$("#connections").prop('required',true);
        	$("#connections").prop('disabled',false);
        	$('.add-link').addClass('tag-css');
        	// $('.add-group').removeClass('tag-css');
        	$('.add-everyone').removeClass('tag-css');
        	$(".hide-link").show();
        	if ($("#groups").prop('disabled') === false) {
	        	$("#groups").prop('disabled',false);
	        	$('.add-group').addClass('tag-css');
	        	$(".hide-group").show();
	        }else{
	        	$("#groups").prop('disabled',true);
	        	
	        }
	        if ($("#groups").prop('required') === false) {
	        	$("#groups").prop('required',false);
	        	$(".hide-group").show();
	        	
	        }else{
	        	$("#groups").prop('required',true);
	        	$('.add-group').addClass('tag-css');
	        }
        	$("#tag-group-all").prop('checked', false);
        }else if(selected == 'groups' && $(this).prop('checked')){
        	/*$("#connections-list").show();
        	$("#groups-list").show();
        	$("#connections").show();
        	$("#groups").show();*/
        	$("#groups").prop('required',true);
        	$("#groups").prop('disabled',false);
        	$('.add-group').addClass('tag-css');
        	$('.add-link').removeClass('tag-css');
        	$('.add-everyone').removeClass('tag-css');
        	$(".hide-group").show();
        	if ($("#connections").prop('disabled') === false) {	        	
        		$("#connections").prop('disabled',false);
        		$('.add-link').addClass('tag-css');
        		$(".hide-link").show();
	        }else{
	        	$("#connections").prop('disabled',true);
	        	
	        }
	        if ($("#connections").prop('required') === false) {	        	
        		$("#connections").prop('required',false);
        		
	        }else{
	        	$("#connections").prop('required',true);
	        	$('.add-link').addClass('tag-css');
	        	$(".hide-link").show();
	        }
        	$("#tag-group-all").prop('checked', false);
        }else if(selected == 'links' && $(this).prop('checked') === false){
        	$("#connections").prop('disabled',true);
        	$(".hide-link").hide();
        	$('.add-link').removeClass('tag-css');
        	if($("#tag-group-groups").prop('checked') === false){
	        	$("#tag-group-all").prop('checked', true);
	        	$('.add-link').removeClass('tag-css');
	        	$('.add-group').removeClass('tag-css');
	        	$(".hide-link").hide();
        		$(".hide-group").hide();
	        }
        }else if(selected == 'groups' && $(this).prop('checked') === false){
        	$("#groups").prop('disabled',true);
        	$(".hide-group").hide();
        	$('.add-group').removeClass('tag-css');
        	if($("#tag-group-links").prop('checked') === false){
	        	$("#tag-group-all").prop('checked', true);
	        	$('.add-link').removeClass('tag-css');
	        	$('.add-group').removeClass('tag-css');
	        	$(".hide-link").hide();
        		$(".hide-group").hide();
	        }
        }
    }); 
</script>
@stop
