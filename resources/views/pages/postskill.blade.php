@extends('master')

@section('content')
																
<div class="row" style="margin:5px;">
	<div class="col-md-9">
		<label class="post-job-heading">
			Do you know about any job openings<br>
			Share Job Tip here for FREE !!
		</label>	
		<div class="portlet box" id="form_wizard_1">			
			<div class="portlet-body form">
				<form action="/job/store" method="post" id="submit_form" 
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
									<i class="fa fa-check"></i>Skills </span>
									</a>
								</li>
								<li>
									<a href="#tab2" data-toggle="tab" class="step">
									<!-- <span class="number">
									2 </span> -->
									<span class="desc">
									<i class="fa fa-check"></i>Education </span>
									</a>
								</li>
								<li>
									<a href="#tab3" data-toggle="tab" class="step active">
									<!-- <span class="number">
									3 </span> -->
									<span class="desc">
									<i class="fa fa-check"></i>Location </span>
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
								<!-- <div class="alert alert-danger display-none">
									<button class="close" data-dismiss="alert"></button>
									You have some form errors. Please check below.
								</div>
								<div class="alert alert-success display-none">
									<button class="close" data-dismiss="alert"></button>
									Your form validation is successful!
								</div> -->
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
														<input type="text" name="post_title" class="form-control" 
															   placeholder="Job Title" required>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Skill Details <span class="required">*</span></label>								
											<textarea name="job_detail" onkeyup="countChar(this)" class="form-control autosizeme" rows="6"></textarea>
											<div id="charNum" style="text-align:right;"></div>
										</div>
									</div>
									</div>


									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12 hide-role">
											<div class="form-group">
												<label>
													Job Role <span class="required">*</span>
												</label>

												<div class="input-group">	
													<span class="input-group-addon">
														<i class="fa fa-cube" style="color:darkcyan;"></i>
													</span>			
													<select class="job-role-ajax form-control new-role" name="role" id="jobrole">
												  		<option value="0" selected="selected"></option>
													</select>													
												</div>
												example: manager, admin, secretory <a class="hide-far">see all</a>

												<div id="charNum" style="text-align:right;"></div>
											</div>
											<!-- <label for="jobrole">E-mail</label> -->
										</div>
										
										
									</div>
									<input type="hidden" name="">

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
														<option value="Full Time">Full Time</option>
														<option value="Part Time">Part Time</option>
														<option value="Freelancer">Freelancer</option>
														<option value="Work from Home">Work from Home</option>
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
									<input type="hidden" name="prof_category" value="prof_category">	
								</div>
								<div class="tab-pane" id="tab2">
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>  Education <span class="required">
														* </span></label> <!-- Select Multiple <input type="checkbox" id="education-check" name="multiple_education" value="1" class="form-control"> -->
												<div class="input-group single-education" >
													<span class="input-group-addon">
														<i class="icon-graduation"></i>
													</span>
													<select class="form-control " name="education" id="parent_selection">
														<option value="">--Please Select--</option>
														<option value="Any Graduate">Any Graduate</option>
														<option value="Any Post Graduate">Any Post Graduate</option>
														<option value="12th & above">12th & above</option>
														<option value="10th & above">10th & above</option>
														<option value="twelth">12th</option>
														<option value="10th">10th</option>
														<option value="BA">B.A</option>
														<option value="BArch">B.Arch</option>
														<option value="BCA">BCA</option>
														<option value="BBA">BBA</option>
														<option value="BCom">BCom</option>
														<option value="B.Ed">B.Ed</option>
														<option value="MTech" value="MTech">MTech</option>
														<option value="MSc" value="MSc">MSc</option>
														<option value="MArch" value="MArch">MArch</option>

														<option value="MCA">MCA</option>
														<option value="MS" value="MS">MS</option>
														<option value="PGDiploma">PGDiploma</option>

														<option value="MVSC">MVSC</option>
														<option value="MCM">MCM</option>
														<option value="BBA">BBA</option>
														<option value="btech">B.Tech/B.E.</option>
														<option value="MCom">MCom</option>
														<option value="MEd">MEd</option>
														<option value="MPharma">MPharma</option>
														<option value="MA">MA</option>
														<option value="twelth">12th</option>
														<!-- <option value="10">10</option> -->
													</select>
												</div>
												<!-- <div class="input-group  multiple-education" >
													<span class="input-group-addon">
														<i class="icon-graduation"></i>
													<select class="bs-select form-control " name="education" multiple>
														<option value="">--Please Select--</option>
														<option value="Any Graduate">Any Graduate</option>
														<option value="Any Post Graduate">Any Post Graduate</option>
														<option value="twelth&above">12th & above</option>
														<option value="tenth&above">10th & above</option>
														<option value="twelth">12th</option>
														<option value="tenth">10th</option>
														<option value="BA">B.A</option>
														<option value="BArch">B.Arch</option>
														<option value="BCA">BCA</option>
														<option value="BBA">BBA</option>
														<option value="BCom">BCom</option>
														<option value="B.Ed">B.Ed</option>
														<option value="MTech" value="MTech">MTech</option>
														<option value="MSc" value="MSc">MSc</option>
														<option value="MArch" value="MArch">MArch</option>

														<option value="MCA">MCA</option>
														<option value="MS" value="MS">MS</option>
														<option value="PGDiploma">PGDiploma</option>

														<option value="MVSC">MVSC</option>
														<option value="MCM">MCM</option>
														<option value="BBA">BBA</option>
														<option value="btech">B.Tech/B.E.</option>
														<option value="MCom">MCom</option>
														<option value="MEd">MEd</option>
														<option value="MPharma">MPharma</option>
														<option value="MA">MA</option>
														<option value="twelth">12th</option>
														
													</select>
												</div> -->
											</div>

										</div>
										<!--/span-->
										<!-- <div class="col-md-2 col-sm-2 col-xs-2"></div> -->

										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Branch <span class="required"> * </span></label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="icon-graduation"></i>
													</span>
													<select class="form-control" name="branch" id="child_selection" value="">
														<option value=""></option>
													</select>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">							
													<label style="font-size:13px;font-weight:500;">Experience</label> : <input readonly id="slider-range-experience" name="min_exp" class="filter-range-experience" /> Years
													<div id="slider-range-max-skill" class="slider bg-purple">
													</div>
												</div>
											</div>
											<!-- <div class="col-md-2 col-sm-2 col-xs-2"></div> -->
											
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">							
													<label class=" control-label"><input type="checkbox" id="hide-check"> Salary </label>&nbsp;: 
															<label class="hide-sal input-sal-exp-label"><i class="fa fa-rupee (alias)" style="font-size:12px;"></i></label>
															<input type="text" readonly id="slider-range-amount1" name="min_sal" class="input-sal-width hide-sal one" />
															<!-- <input type="text" readonly id="slider-range-amount3" name="min_sal" class="input-sal-width hide-sal-new three" /> -->
															<label class="hide-sal input-sal-exp-label">- <i class="fa fa-rupee (alias)" style="font-size:12px;"></i></label>
															<input type="text" readonly id="slider-range-amount2" name="max_sal" class="input-sal-width hide-sal two" />
															<!-- <input type="text" readonly id="slider-range-amount4" name="max_sal" class="input-sal-width hide-sal four" /> -->
													<select id="salary-type"  name="salary_type" class="hide-sal-new input-sal-exp-label" style="border-top: 0px;border-left: 0;border-right: 0;width:75px">									
														<option selected="selected" value="Monthly">Monthly</option>
														<option value="Weekly">Weekly</option>
														<option value="Daily">Daily</option>
														<option value="Hourly">Hourly</option>
														<option value="Pervisit">Per Visit</option>	
													</select>
													<div id="salary-old" class="hide-sal">
														<div id="slider-range" class="slider bg-gray"></div>
														
													</div>
													<!-- <div id="salary-new">
														<div id="slider-range-new" class="slider bg-gray"></div>
													</div> -->
												</div>
											</div>
										</div>
									<!--/span-->
									<div class="form-group">
										
									</div>
								</div>
								<div class="tab-pane" id="tab3">
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
														</div>
													</div>
													<div class="col-md-6 col-sm-6 col-xs-12">
														<div class="form-group">
															<label> Selected Prefered Location <span class="required">
																	* </span></label>
															<div class="input-group">
														{!! Form::select('prefered_location[]', [], null, ['id'=>'prefered_location', 
																											   'aria-hidden'=>'true', 
																											   'class'=>'form-control', 
																											   'placeholder'=>'city', 
																											   'multiple']) !!}
															</div>
														</div>
													</div>
												</div>
												<div class="row">
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
																	<option value="90">3 Months</option>
																	<option value="180">6 Months</option>
																	<option value="270">9 Months</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-6 col-sm-6 col-xs-12">
														<div class="form-group">
															<label>Contact Person</label>
															<div class="input-group">
															<span class="input-group-addon">
															<i class="glyphicon glyphicon-user" style="color:darkcyan;"></i>
															</span>
															<input type="text" name="contact_person" value="{{ Auth::user()->name }}" class="form-control" placeholder="Contact Person">
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
															<span class="input-group-addon">
															<i class="icon-envelope" style="color:darkcyan;"></i>
															</span>
															<input type="text" name="email_id" value="{{ Auth::user()->email }}" class="form-control group" placeholder="">
															
															</div>
														</div>
													</div>
													<!--/span-->
													<!-- <div class="col-md-2 col-sm-2 col-xs-2"></div> -->
													<div class="col-md-6 col-sm-6 col-xs-12">
														<div class="form-group">
															<label>Phone No (Registered)</label>
															<div class="input-group">
															<span class="input-group-addon">
															<i class="icon-call-end" style="color:darkcyan;"></i>
															</span>
															<input type="text" name="phone" value="{{ Auth::user()->mobile }}"  class="form-control group" placeholder="">
															
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
																<div class="timeline-body-content col-md-7" style="margin: 0 15px;">
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
					                                                            <!-- <div class="col-md-6 col-sm-6 col-xs-6"> 
					                                                                    <label class="detail-label">Job Role :</label>
					                                                            </div>
					                                                            <div class="col-md-6 col-sm-6 col-xs-6">
					                                                                   <p class="form-control-static" data-display="role" style="margin: -5px 0;"></p>
					                                                            </div>
					                                                            </div> -->
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
						                                                                <p class="form-control-static" data-display="education" style="margin: -5px 0;"></p>
						                                                            </div>
						                                                        </div>
						                                                        <div class="row">
						                                                            <div class="col-md-6 col-sm-6 col-xs-6">
						                                                                <label class="detail-label">Branch :</label>     
						                                                            </div>
						                                                            <div class="col-md-6 col-sm-6 col-xs-6">
						                                                                <p class="form-control-static" data-display="branch" style="margin: -5px 0;"></p>
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
					                                                                         <p class="form-control-static" data-display="prefered_location[]" style="margin: -5px 0;"></p>
					                                                                </div>
					                                                            </div>
					                                                            
					                                                            <div class="skill-display">Description : </div>
					                                                            	<p class="form-control-static" data-display="job_detail"></p>

					                                                            <!-- <div class="">Reference Id&nbsp;:<p class="form-control-static" data-display="reference_id"></p> </div>  -->

																			
																			<div >Post Duration: <p class="form-control-static" data-display="post_duration"></p></div>
																			<div class="skill-display">Contact Details:<br> </div>
																			<label class="show-apply">Apply on Company Website:<p class="form-control-static" data-display="website_redirect_url"></p></label><br>
																			<div id="con" class="show-apply-email" style="margin: -25px 0;">
																			<i class="icon-user" style="color:darkslategrey;font-size: 16px;"></i> : <p class="form-control-static" data-display="contact_person"></p><br>
																					
																				<i class="glyphicon glyphicon-envelope" style="color: #13B8D4;font-size: 16px;"></i>&nbsp;:<p class="form-control-static" data-display="email_id"></p>
																				 
																			<br>
																				<i class="glyphicon glyphicon-earphone" style="color: green;font-size: 16px;"></i>&nbsp;:<p class="form-control-static" data-display="phone"></p>
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


<!-- BEGIN ROLE MODAL-->
<div class="modal fade" id="all-roles" tabindex="-1" role="dialog" aria-labelledby="Roles" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Roles</h4>
      </div>
      <div class="modal-body">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="form-group new-margin-formgroup">
				<label>Functional Area</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="icon-clock" style=" color: darkcyan;"></i>
					</span>
					<select name="functional_area" class="form-control" >
						@foreach($functionalAreas as $farea)
			      		<option>
			      			<li><a href="#" data-jrole="{{$farea}}">{{$farea}}</a></li>
			      		</option>
			      		@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="form-group new-margin-formgroup">
				<label>Role</label>
				<div class="input-group">
					<span class="input-group-addon">
					<i class="icon-clock" style=" color: darkcyan;"></i>
					</span>
					<select name="" class="form-control" >
						@foreach($roles as $role)
			      		<option>
			      			<li><a href="#" data-jrole="{{$role->name}}">{{$role->name}}</a></li>
			      		</option>
			      		@endforeach
					</select>
				</div>
			</div>
		</div>
	      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END ROLE MODAL -->


<div id="loader" style="display:none;z-index:9999;background:white" class="page-loading">
	<img src="/assets/loader.gif"><span> Please wait...</span>
</div>

@stop


@section('javascript')
<script src="/assets/admin/pages/scripts/components-dropdowns.js"></script>
<script type="text/javascript">
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

// $(document).ready(function () {
// $('#salary-new').hide();
// $('.three').hide();
// $('.four').hide();
// toggleFields();
// $('#salary-type').change(function () {
// toggleFields();
// });
// });
// function toggleFields() {
// if ($('#salary-type').val() == 'Daily' || $('#salary-type').val() == 'Hourly' || $('#salary-type').val() == 'Pervisit'){
// $('#salary-new').show();
// $('#salary-old').hide();
// $('.one').hide();
// $('.two').hide();
// $('.three').show();
// $('.four').show();
// }else{
// $('#salary-new').hide();
// $('#salary-old').show();
// $('.one').show();
// $('.two').show();
// $('.three').hide();
// $('.four').hide();
// }
// }



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
        $("#hide-check").click(function () {
            if ($(this).is(":checked")) {
                $(".hide-sal").show();
                $(".show-salary").show();
                $(".hide-sal-new").show();
            } else {
                $(".hide-sal").hide();
                $(".show-salary").hide();
                $(".hide-sal-new").hide();
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
<script type="text/javascript">

$(".job-role-ajax").select2({
	placeholder: 'Enter a role',
  ajax: {
    url: "/post/jobroles",
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
