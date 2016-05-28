@extends('master')

@section('content')
		<?php $selected = 'selected'; ?> 											
<div class="row" style="margin:5px;">
	<div class="col-md-9">
		<label class="post-job-heading">
			Post Edit (Post id: {{$postskill->unique_id}})
		</label>	
		<div class="portlet box" id="form_wizard_1">			
			<div class="portlet-body form">
				<form action="/skill/update/{{$postskill->unique_id}}" method="post" id="submit_form" 
					  data-toggle="validator" role="form" class="form-horizontal">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li>
									<a href="#tab1" data-toggle="tab" class="step">
									<!-- <span class="number">
									1 </span> -->
									<span class="desc">
									<i class="fa fa-check"></i>Skill Detail </span>
									</a>
								</li>
								<li>
									<a href="#tab2" data-toggle="tab" class="step active">
									<!-- <span class="number">
									3 </span> -->
									<span class="desc">
									<i class="fa fa-check"></i>Contact Detail</span>
									</a>
								</li>
								<li>
									<a href="#tab4" data-toggle="tab" class="step">
									<!-- <span class="number">
									4 </span> -->
									<span class="desc">
									<i class="fa fa-check"></i>Confirm </span>
									</a>
								</li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
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
								<div class="tab-pane active" id="tab1">
									<input type="hidden" name="post_id" value"rand(11111,99999)">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<div class="input-icon right">
													<i class="fa"></i>
													<label>Skill Title <span class="required">*</span></label>
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-flag" style="color:darkcyan;"></i>
														</span>
														<input type="text" name="post_title" value="{{$postskill->post_title}}" class="form-control" placeholder="Job Title">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Skill Details <span class="required">*</span></label>								
											<textarea id="textarea" rows="6" class="form-control autosizeme" name="job_detail" maxlength="1000" >{{$postskill->job_detail}}</textarea>
												<div id="textarea_feedback"></div>
										</div>
									</div>
									</div>


									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Industry <span class="required">*</span>
												</label>
												<select class="select2me form-control" name="industry">
													<option @if($postskill->industry=="Automotive/ Ancillaries") {{ $selected }} @endif value="Automotive/ Ancillaries">Automotive/ Ancillaries</option>
													<option @if($postskill->industry=="Banking/ Financial Services") {{ $selected }} @endif value="Banking/ Financial Services">Banking/ Financial Services</option>
													<option @if($postskill->industry=="Bio Technology & Life Sciences") {{ $selected }} @endif value="Bio Technology & Life Sciences">Bio Technology & Life Sciences</option>
													<option @if($postskill->industry=="Chemicals/Petrochemicals") {{ $selected }} @endif value="Chemicals/Petrochemicals">Chemicals/Petrochemicals</option>
													<option @if($postskill->industry=="Construction") {{ $selected }} @endif value="Construction">Construction</option>
													<option @if($postskill->industry=="FMCG") {{ $selected }} @endif value="FMCG">FMCG</option>
													<option @if($postskill->industry=="Education") {{ $selected }} @endif value="Education">Education</option>
													<option @if($postskill->industry=="Entertainment/ Media/ Publishing") {{ $selected }} @endif value="Entertainment/ Media/ Publishing">Entertainment/ Media/ Publishing</option>
													<option @if($postskill->industry=="Insurance") {{ $selected }} @endif value="Insurance">Insurance</option>
													<option @if($postskill->industry=="ITES/BPO") {{ $selected }} @endif value="ITES/BPO">ITES/BPO</option>
													<option @if($postskill->industry=="IT/ Computers - Hardware") {{ $selected }} @endif value="IT/ Computers - Hardware">IT/ Computers - Hardware</option>
													<option @if($postskill->industry=="IT/ Computers - Software") {{ $selected }} @endif value="IT/ Computers - Software">IT/ Computers - Software</option>
													<option @if($postskill->industry=="KPO/Analytic") {{ $selected }} @endif value="KPO/Analytics">KPO/Analytics</option>
													<option @if($postskill->industry=="Machinery/ Equipment Mfg.") {{ $selected }} @endif value="Machinery/ Equipment Mfg.">Machinery/ Equipment Mfg.</option>
													<option @if($postskill->industry=="Oil/ Gas/ Petroleum") {{ $selected }} @endif value="Oil/ Gas/ Petroleum">Oil/ Gas/ Petroleum</option>
													<option @if($postskill->industry=="Pharmaceuticals") {{ $selected }} @endif value="Pharmaceuticals">Pharmaceuticals</option>
													<option @if($postskill->industry=="Power/Energy") {{ $selected }} @endif value="Power/Energy">Power/Energy</option>
													<option @if($postskill->industry=="Retailing") {{ $selected }} @endif value="Retailing">Retailing</option>
													<option @if($postskill->industry=="Telecom") {{ $selected }} @endif value="Telecom">Telecom</option>
													<option @if($postskill->industry=="Advertising/PR/Events") {{ $selected }} @endif value="Advertising/PR/Events">Advertising/PR/Events</option>
													<option @if($postskill->industry=="Agriculture/ Dairy Based") {{ $selected }} @endif value="Agriculture/ Dairy Based">Agriculture/ Dairy Based</option>
													<option @if($postskill->industry=="Aviation/Aerospace") {{ $selected }} @endif value="Aviation/Aerospace">Aviation/Aerospace</option>
													<option @if($postskill->industry=="Beauty/Fitness/PersonalCare/SPA") {{ $selected }} @endif value="Beauty/Fitness/PersonalCare/SPA">Beauty/Fitness/PersonalCare/SPA</option>
													<option @if($postskill->industry=="Beverages/ Liquor") {{ $selected }} @endif value="Beverages/ Liquor">Beverages/ Liquor</option>
													<option @if($postskill->industry=="Cement") {{ $selected }} @endif value="Cement">Cement</option>
													<option @if($postskill->industry=="Ceramics & Sanitary Ware") {{ $selected }} @endif value="Ceramics & Sanitary Ware">Ceramics & Sanitary Ware</option>
													<option @if($postskill->industry=="Consultancy") {{ $selected }} @endif value="Consultancy">Consultancy</option>
													<option @if($postskill->industry=="Courier/ Freight/ Transportation") {{ $selected }} @endif value="Courier/ Freight/ Transportation">Courier/ Freight/ Transportation</option>
													<option @if($postskill->industry=="Law Enforcement/Security Services") {{ $selected }} @endif value="Law Enforcement/Security Services">Law Enforcement/Security Services</option>
													<option @if($postskill->industry=="E-Learning") {{ $selected }} @endif value="E-Learning">E-Learning</option>
													<option @if($postskill->industry=="Shipping/ Marine Services") {{ $selected }} @endif value="Shipping/ Marine Services">Shipping/ Marine Services</option>
													<option @if($postskill->industry=="Engineering, Procurement, Construction") {{ $selected }} @endif value="Engineering, Procurement, Construction">Engineering, Procurement, Construction</option>
													<option @if($postskill->industry=="Environmental Service") {{ $selected }} @endif value="Environmental Service">Environmental Service</option>
													<option @if($postskill->industry=="Facility management") {{ $selected }} @endif value="Facility management">Facility management</option>
													<option @if($postskill->industry=="Fertilizer/ Pesticides") {{ $selected }} @endif value="Fertilizer/ Pesticides">Fertilizer/ Pesticides</option>
													<option @if($postskill->industry=="Food & Packaged Food") {{ $selected }} @endif value="Food & Packaged Food">Food & Packaged Food</option>
													<option @if($postskill->industry=="Textiles / Yarn / Fabrics / Garments") {{ $selected }} @endif value="Textiles / Yarn / Fabrics / Garments">Textiles / Yarn / Fabrics / Garments</option>
													<option @if($postskill->industry=="Gems & Jewellery") {{ $selected }} @endif value="Gems & Jewellery">Gems & Jewellery</option>
													<option @if($postskill->industry=="Government/ PSU/ Defence") {{ $selected }} @endif value="Government/ PSU/ Defence">Government/ PSU/ Defence</option>
													<option @if($postskill->industry=="Consumer Electronics/Appliances") {{ $selected }} @endif value="Consumer Electronics/Appliances">Consumer Electronics/Appliances</option>
													<option @if($postskill->industry=="Hospitals/ Health Care") {{ $selected }} @endif value="Hospitals/ Health Care">Hospitals/ Health Care</option>
													<option @if($postskill->industry=="Hotels/ Restaurant") {{ $selected }} @endif value="Hotels/ Restaurant">Hotels/ Restaurant</option>
													<option @if($postskill->industry=="Import / Export") {{ $selected }} @endif value="Import / Export">Import / Export</option>
													<option @if($postskill->industry=="Market Research") {{ $selected }} @endif value="Market Research">Market Research</option>
													<option @if($postskill->industry=="Medical Transcription") {{ $selected }} @endif value="Medical Transcription">Medical Transcription</option>
													<option @if($postskill->industry=="Mining") {{ $selected }} @endif value="Mining">Mining</option>
													<option @if($postskill->industry=="NGO") {{ $selected }} @endif value="NGO">NGO</option>
													<option @if($postskill->industry=="Paper") {{ $selected }} @endif value="Paper">Paper</option>
													<option @if($postskill->industry=="Printing / Packaging") {{ $selected }} @endif value="Printing / Packaging">Printing / Packaging</option>
													<option @if($postskill->industry=="Public Relations (PR)") {{ $selected }} @endif value="Public Relations (PR)">Public Relations (PR)</option>
													<option @if($postskill->industry=="Travel / Tourism") {{ $selected }} @endif value="Travel / Tourism">Travel / Tourism</option>
													<option @if($postskill->industry=="Other") {{ $selected }} @endif value="Other">Other</option>
			                                    </select>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>
													Job Role <span class="required">*</span>
												</label>
												@if($postskill->role == null)
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
												@elseif($postskill->role != null)
													<select class="select2me form-control" name="role">
														<option value="{{$postskill->functional_area}}-{{$postskill->role}}">{{$postskill->functional_area}}-{{$postskill->role}}</option>
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

									<!-- </select> -->
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
														<option @if($postskill->time_for=="Full Time") {{ $selected }} @endif value="Full Time">Full Time</option>
														<option @if($postskill->time_for=="Part Time") {{ $selected }} @endif value="Part Time">Part Time</option>
														<option @if($postskill->time_for=="Freelancer") {{ $selected }} @endif value="Freelancer">Freelancer</option>
														<option @if($postskill->time_for=="Work from home") {{ $selected }} @endif value="Work from home">Work from home</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Search Skills</label>
												<div style="position:relative;">
													<input type="text" name="name" id="newskill" class="form-control" placeholder="Search for skill...">
													<button id="add-new-skill" style="position:absolute;right:0;top:0;" class="btn btn-success" type="button"><i class="icon-plus"></i> Add</button>		
												</div>
												{!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
											</div>
										</div>
									</div>
									<input type="text" id="confirm-skill" name="skill" value="{{$postskill->linked_skill}}" style="display:none;">
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												
												<label>  Education <span class="required">
														* </span></label>
												<div class="input-group single-education" >
													
													<select class="form-control education-list" name="education[]" id="education_show" multiple style="border:1px solid #c4d5df">
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
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="form-group">							
												<label class=" control-label">Experience (Min)</label>
												<div class="input-group">
													<select class="form-control" name="min_exp">
														<option>Select</option>
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
												<select id="salary-type"  name="salary_type" class="input-sal-exp-label" style="border: 0px;width:75px">									
													<option selected="selected" value="Monthly">Monthly</option>
													<option value="Weekly">Weekly</option>
													<option value="Daily">Daily</option>
													<option value="Hourly">Hourly</option>
													<option value="Pervisit">Per Visit</option>	
												</select>
												<label class=" control-label"> Salary (Min)</label>
												<div class="input-group">
													<span class="input-group-addon">
														Rs
													</span>
													<input class="form-control" name="min_sal" id="minsal">
												</div>
											</div>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-6">
											<div class="form-group">							
												<label class=" control-label"> Salary (Max)</label>
												<div class="input-group">
													<span class="input-group-addon">
														Rs
													</span>
													<input class="form-control" name="min_sal" id="maxsal">
												</div>
											</div>
										</div>
									</div>	
								</div>
								<div class="tab-pane" id="tab2">
									
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Select Prefered Location <span class="required">
														* </span></label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-map-marker"></i>
													</span>

													<input type="text" id="pref_loc" name="pref_loc" 
													class="form-control" placeholder="Select preferred location">									
													
												</div>	
												{!! Form::select('prefered_location[]', [], null, ['id'=>'prefered_location', 
																								   'aria-hidden'=>'true', 
																								   'class'=>'form-control', 
																								   'placeholder'=>'city', 
																								   'multiple']) !!}	
											</div>
										</div>
										
										<input type="text" id="show_location" name="show-location" value="{{$postskill->city}}" style="display:none;">
										<div class="col-md-6 show-apply-email">
											<div class="form-group">
												<label>Show Contact<span class="required">
														* </span></label>
												<div class="input-group">
													<div class="md-radio-inline">
														<div class="md-radio">
															<input type="radio" checked id="radio6" name="show_contact" value="Public" class="md-radiobtn">
															<label for="radio6" style="">
															<span></span>
															<span class="check"></span>
															<span class="box"></span>
															Public </label>
														</div>
														<div class="md-radio">
															<input type="radio" id="radio7" name="show_contact" value="Private" class="md-radiobtn">
															<label for="radio7" style="">
															<span></span>
															<span class="check"></span>
															<span class="box"></span>
															Private</label>
														</div>
													</div>	
													<div id="radio_error"></div>					<!-- /input-group -->
												</div>
												<div class="public" style="color: firebrick;font-size: 11px;">Your Contact details will be seen on the post and people may directly contact you.</div>
												<div class="private display-none" style="color: firebrick;font-size: 11px;">Your Contact details will not be seen on the post. You may have to contact people who have applied on this post.</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group new-margin-formgroup">
												<label>Post Duration <span class="required">
													* </span></label>
												<div class="input-group">
												{{$postskill->post_duration}} Days
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Contact Person</label>
												<div class="input-group">
												{{ Auth::user()->name }}
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
									<!-- <div class="show-apply"> -->
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Email Id (Registered)</label>
												<div class="input-group">
												{{ Auth::user()->email }}
												</div>
											</div>
										</div>
										<!--/span-->
										<!-- <div class="col-md-2 col-sm-2 col-xs-2"></div> -->
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Phone No (Registered)</label>
												<div class="input-group">
													{{ Auth::user()->mobile }}
												</div>
											</div>
										</div>
										<!--/span-->	
									<!-- </div> -->
								</div>
									<div class="form-group">
									
									</div>
								</div>
								<div class="tab-pane" id="tab4">
									
									<input type="hidden" name="post_type">
										<div class="form-body">
											

											<div class="row">	
											  	<div class="col-md-12"><hr style="margin:0 0 15px 0"></div>
											</div>
											
											<div class="row">																				
												<div class="col-md-12" style="padding:0;">												
														<div class="timeline" style="padding:0;">
														<!-- TIMELINE ITEM -->
														<div class="timeline-item time-item" style="box-shadow:0 0 !important;">
															<div class="timeline-body" style="margin: 0;">
																<div class="timeline-body-content col-md-7" style="margin: 0px 15px 20px;">
																	<div style="font-weight: 600;color: black;font-size: 16px;">
																		<p class="form-control-static" data-display="post_title"></p>
																	</div>
																	<div>
																	 	<div> 
																	 		<h4 style="font-weight: 400; margin: -5px 0;"> 
																	 			<p class="form-control-static" data-display="post_compname"></p> 
																	 		</h4>
																	 	</div>  
																	</div>     
			                                                         <div class="row">
			                                                            <div class="row">
			                                                            
				                                                            <div class="col-md-6 col-sm-6 col-xs-6">
				                                                                    <label class="detail-label"> Experience : </label>     
				                                                            </div>
				                                                            <div class="col-md-6 col-sm-6 col-xs-6">
																						<p class="form-control-static" data-display="min_exp" style="margin: -5px 0;"></p> Years  
				                                                            </div>
				                                                        </div>
				                                                        <div class="row">
				                                                            <div class="col-md-6 col-sm-6 col-xs-6">
				                                                                <label class="detail-label">Education :</label>     
				                                                            </div>
				                                                            <div class="col-md-6 col-sm-6 col-xs-6">
				                                                                <p class="form-control-static" data-display="education[]" style="margin: -5px 0;"></p>
				                                                            </div>
				                                                        </div>
			                                                            <div class="row"> 
			                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                           
			                                                                        <label class="detail-label">Skills :</label>                                                                  
			                                                                </div>
			                                                               <!--  -->
			                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                 
			                                                                        <p class="form-control-static" data-display="linked_skill_id[]" style="margin: -5px 0;"></p>
			                                                                </div>
			                                                            </div>
			                                                            <div class="row"> 
			                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                           
			                                                                        <label class="detail-label">Industry :</label>                                                                  
			                                                                </div>
			                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
			                                                                        <p class="form-control-static" data-display="industry" style="margin: -5px 0;"></p>
			                                                                </div>
			                                                            </div>
			                                                            <div class="row"> 
			                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                           
			                                                                        <label class="detail-label">Job Role :</label>                                                                  
			                                                                </div>
			                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
			                                                                        <p class="form-control-static" data-display="role" style="margin: -5px 0;"></p>
			                                                                </div>
			                                                            </div>
			                                                            <div class="row"> 
			                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                           
			                                                                        <label class="detail-label">Job Type :</label>                                                                  
			                                                                </div>
			                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
			                                                                        <p class="form-control-static" data-display="time_for" style="margin: -5px 0;"></p>
			                                                                </div>
			                                                            </div>
			                                                             <div class="row show-salary">
			                                                                <div class="col-md-6 col-sm-6 col-xs-6">
			                                                                        <label class="detail-label">Salary (<i class="fa fa-rupee (alias)"></i>):</label>
			                                                                </div>
			                                                                <div class="col-md-6 col-sm-6 col-xs-6">
			                                                                        <p class="form-control-static" data-display="min_sal"></p>-<p class="form-control-static" data-display="max_sal"></p> <p class="form-control-static" data-display="salary_type"></p>
			                                                                </div>
			                                                            </div>
			                                                            <div class="row"> 
			                                                                
			                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                           
			                                                                        <label class="detail-label">Prefered Location :</label>                                                                  
			                                                                </div>
			                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
			                                                                         <p class="form-control-static" data-display="show-location" style="margin: -5px 0;"></p>
			                                                                </div>
			                                                            </div>
			                                                            
			                                                            <div class="skill-display">Description : </div>
			                                                            	<p class="form-control-static" data-display="job_detail"></p>

			                                                            <!-- <div class="">Reference Id&nbsp;:<p class="form-control-static" data-display="reference_id"></p> </div>  -->

																	
																	<div >Post Duration: {{$postskill->post_duration}} Days</div>
																	<div class="skill-display">Contact Details:<br> </div>
																	<label class="show-apply">Apply on Company Website:<p class="form-control-static" data-display="website_redirect_url"></p></label><br>
																	<div id="con" class="show-apply-email" style="margin: -12px 0;">
																	<i class="icon-user" style="color:darkslategrey;font-size: 16px;"></i> : {{Auth::user()->name}}<br>
																			
																		<i class="glyphicon glyphicon-envelope" style="color: #13B8D4;font-size: 16px;"></i>&nbsp;: {{Auth::user()->email}}
																		 
																	<br/>
																		<i class="glyphicon glyphicon-earphone" style="color: green;font-size: 16px;"></i>&nbsp;:{{Auth::user()->mobile}}
																		</div> 
																	<!-- <div class="skill-display" style="margin: 25px 0;">Post Id&nbsp;: Null (Auto generated after submit.) </div>  -->
																</div>		
																
															</div>
															
														</div>

														<!-- END TIMELINE ITEM -->
													</div>
												</div>	
												
												<!-- END TIMELINE ITEM -->
											
											</div>
														
													
													<!-- END FORM-->
													
										
									</div>
								</div>
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
				</form>
			</div>
		</div>
	</div>
</div>


<div id="loader" style="display:none;z-index:9999;background:white" class="page-loading">
	<img src="/assets/loader.gif"><span> Please wait...</span>
</div>

@stop


@section('javascript')
<script src="/assets/admin/pages/scripts/components-dropdowns.js"></script>
<script type="text/javascript">
$(".education-list").select2({
	  placeholder: "Select education"
	});
    var eduArray = [];
    @if($postskill != null)
        @if($postskill->education != null)
        <?php $array = explode(',', $postskill->education); ?> 
        @if(count($array) > 0)
            @foreach($array as $gt => $gta)
                eduArray.push('<?php echo $gta; ?>');
            @endforeach
        @endif
        @endif
    @endif
    var selectedEducation = $("#education_show").select2({ dataType: 'json', data: eduArray });
    selectedEducation.val(eduArray).trigger("change");
var prefLocationArray = [];

    // preferred loc    
   @if($postskill != null)
        @if($postskill->city != null)
        <?php $array = explode(',', $postskill->city); ?> 
        @if(count($array) > 0)
            @foreach($array as $gt => $gta)
                prefLocationArray.push('<?php echo $gta; ?>');
            @endforeach
        @endif
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
 $(document).ready(function() {
var text_max = 1000;
$('#textarea_feedback').html(text_max + ' characters remaining');

$('#textarea').keyup(function() {
    var text_length = $('#textarea').val().length;
    var text_remaining = text_max - text_length;

    $('#textarea_feedback').html(text_remaining + ' characters remaining');
});

});
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

// Experience slider
    
    $("#slider-range-max-skill").slider({
        isRTL: Metronic.isRTL(),
        range: "max",
        min: 0,
        max: 15,
        step: 1,
        slide: function (event, ui) {
             $("#slider-range-experience").val(ui.value);   
        }
    });
    $("#slider-range-experience").val($("#slider-range-max-skill").slider("value"));

$(document).ready(function (){

	$('#minsal').blur(function (){
		togglesalFields();
	});

	$('#maxsal').blur(function (){
		togglesalmaxFields();
	});
});

function togglesalFields() {
	if($('#minsal').val() > $('#maxsal').val()){
		$('#maxsal').css({'border-color':'#962626'});
		$("#maxsal").val('');
	}else{
		$('#maxsal').css({'border-color':'#c4d5df'});
	}
}

function togglesalmaxFields() {
	if($('#maxsal').val() < $('#minsal').val()){
		$("#maxsal").val('');
	}else{
		$('.maxsal').css({'border-color':'#c4d5df'});
	}
}



	function countChar(val) {
		var len = val.value.length;
		if (len >= 1000) {
			val.value = val.value.substring(0, 1000);
		} else {
			$('#charNum').text(1000 - len);
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
                $(".show-apply-email").hide();
                 
            } else {
                $(".show-apply-email").show();
                $(".show-apply").hide();
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

    $('#connections').select2({
    placeholder: "Enter Name"
});
    $('#groups').select2({
    placeholder: "Enter Group Name"
});
</script>
<script>
var skillArray = [];
    @if($postskill != null)
        @if($postskill->linked_skill != null)
        <?php $array = explode(',', $postskill->linked_skill); ?> 
        @if(count($array) > 0)
            @foreach($array as $gt => $gta)
                skillArray.push('<?php echo $gta; ?>');
            @endforeach
        @endif
        @endif
    @endif
    var selectedSkills = $("#linked_skill_id").select2({ dataType: 'json', data: skillArray });
    selectedSkills.val(skillArray).trigger("change");
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
