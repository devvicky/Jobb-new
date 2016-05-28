@if($title == 'home')
<!-- Jobtip Filter Start -->

@if (count($errors) > 0)
	<div class="alert alert-success save-filter">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
<div id="homefiltermodal" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="job-filter" name="filter_form" action="/home" method="post">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<div class="modal-header" style="padding: 0px 13px;background-color: #DDE0E0;height: 35px;">
				
				<!-- 
						<label style="float:right;">
							<input type="checkbox" class="icheck" 
									name="save_filter"
									data-checkbox="icheckbox_line-grey" 
									data-label="Save"
									value="savefilter" @if($filter != null)@if($filter->save_filter == 'savefilter') checked @endif @endif>
						</label> -->
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4" style="margin:1px -3px 0 2px;padding: 0;font-size: 15px;">
						<button type="button" data-dismiss="modal" 
				aria-hidden="true" style="margin: -1px 0 !important;
			    background-color: transparent;
			    border: 0;
			    padding: 7px 8px;"><i class="icon-arrow-left" style="color:#333;"></i></button>
						Filter Jobs
					</div>
					<div class="col-md-8 col-sm-8 col-xs-8" style="padding:0;text-align:end;">
						<button type="button" id="btn" class="btn" style="margin: 1px -10px;background-color:transparent;">
							<i class="icon-reload" style="color:#333;"></i>
						</button>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-default">
							<input type="checkbox" value="savefilter" checke name="save_filter" class="toggle"><i class="fa fa-floppy-o"></i>  </label>
						</div>
						<button type="submit" name="submit-filter" value="submit-filter" class="btn green" style="padding: 6px 40px;">
							Apply
						</button>

						<!-- <label class="btn default active">
							<input type="checkbox" class="toggle"> 
						</label> -->
						<!-- <button type="button" id="save" name="save_filter" class="btn" style="float:right;background-color:transparent;">
							
						</button> -->
						
						
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="" data-always-visible="1" data-rail-visible1="1">
					<input type="hidden" name="post_type" value="job">

					<div class="row" style="margin:0 0px 0 -10px;">
						<div class="col-md-12 col-sm-12 col-xs-12" style="margin:0px 0;padding:0 10px;">
							<!-- <label style="font-size:13px;font-weight:500;">Title or Role</label> -->
							<div class="form-group">
								<input type="text" id="title" ng-model="job_title" name="job_title" 
									class="form-control select2" value="@if($filter != null){{$filter->job_title}}@endif" placeholder="Enter Keywords">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="form-group">							
								<label class=" control-label">Experience (in yrs)</label>
								<!-- <div class="input-group"> -->
									<select class="form-control" name="experience">
										<option value="">Select</option>
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
								<!-- </div> -->
							</div>
						</div>
						<div class="col-md-8 col-sm-8 col-xs-12">
							<div class="form-group">
								<label>Industry</label>
								<select class=" form-control" name="industry">
									<option value="">Select</option>
                                    <option value="Automotive/ Ancillaries">Automotive/ Ancillaries</option>
                                    <option value="Banking/ Financial Services">Banking/ Financial Services</option>
                                    <option value="Bio Technology & Life Sciences">Bio Technology & Life Sciences</option>
                                    <option value="Chemicals/Petrochemicals">Chemicals/Petrochemicals</option>
                                    <option value="Construction">Construction</option>
                                    <option value="FMCG">FMCG</option>
                                    <option value="Education">Education</option>
                                    <option value="Entertainment/ Media/ Publishing">Entertainment/ Media/ Publishing</option>
                                    <option value="Insurance">Insurance</option>
                                    <option value="ITES/BPO">ITES/BPO</option>
                                    <option value="IT/ Computers - Hardware">IT/ Computers - Hardware</option>
                                    <option value="IT/ Computers - Software">IT/ Computers - Software</option>
                                    <option value="KPO/Analytics">KPO/Analytics</option>
                                    <option value="Machinery/ Equipment Mfg.">Machinery/ Equipment Mfg.</option>
                                    <option value="Oil/ Gas/ Petroleum">Oil/ Gas/ Petroleum</option>
                                    <option value="Pharmaceuticals">Pharmaceuticals</option>
                                    <option value="Power/Energy">Power/Energy</option>
                                    <option value="Real Estate">Real Estate</option>
                                    <option value="Retailing">Retailing</option>
                                    <option value="Telecom">Telecom</option>
                                    <option value="Advertising/PR/Events">Advertising/PR/Events</option>
                                    <option value="Agriculture/ Dairy Based">Agriculture/ Dairy Based</option>
                                    <option value="Aviation/Aerospace">Aviation/Aerospace</option>
                                    <option value="Beauty/Fitness/PersonalCare/SPA">Beauty/Fitness/PersonalCare/SPA</option>
                                    <option value="Beverages/ Liquor">Beverages/ Liquor</option>
                                    <option value="Cement">Cement</option>
                                    <option value="Ceramics & Sanitary Ware">Ceramics & Sanitary Ware</option>
                                    <option value="Consultancy">Consultancy</option>
                                    <option value="Courier/ Freight/ Transportation">Courier/ Freight/ Transportation</option>
                                    <option value="Law Enforcement/Security Services">Law Enforcement/Security Services</option>
                                    <option value="E-Learning">E-Learning</option>
                                    <option value="Shipping/ Marine Services">Shipping/ Marine Services</option>
                                    <option value="Engineering, Procurement, Construction">Engineering, Procurement, Construction</option>
                                    <option value="Environmental Service">Environmental Service</option>
                                    <option value="Facility management">Facility management</option>
                                    <option value="Fertilizer/ Pesticides">Fertilizer/ Pesticides</option>
                                    <option value="Food & Packaged Food">Food & Packaged Food</option>
                                    <option value="Textiles / Yarn / Fabrics / Garments">Textiles / Yarn / Fabrics / Garments</option>
                                    <option value="Gems & Jewellery">Gems & Jewellery</option>
                                    <option value="Government/ PSU/ Defence">Government/ PSU/ Defence</option>
                                    <option value="Consumer Electronics/Appliances">Consumer Electronics/Appliances</option>
                                    <option value="Hospitals/ Health Care">Hospitals/ Health Care</option>
                                    <option value="Hotels/ Restaurant">Hotels/ Restaurant</option>
                                    <option value="Import / Export">Import / Export</option>
                                    <option value="Market Research">Market Research</option>
                                    <option value="Medical Transcription">Medical Transcription</option>
                                    <option value="Mining">Mining</option>
                                    <option value="NGO">NGO</option>
                                    <option value="Paper">Paper</option>
                                    <option value="Printing / Packaging">Printing / Packaging</option>
                                    <option value="Public Relations (PR)">Public Relations (PR)</option>
                                    <option value="Travel / Tourism">Travel / Tourism</option>
                                    <option value="Other">Other</option>
                                </select>
							</div>
						</div>
					</div>
					<div class="row" style="margin: 25px 0px 0 -10px;">
						<div class="col-md-12 col-sm-12 col-xs-12" style="margin:-5px 0;padding:0 10px;">
							<div class="form-group">
								<!-- <label style="font-size:13px;font-weight:500;">Skills</label> -->
								<div>
									<div style="position:relative;" id="job-skill-wrapper">
										<input type="text" name="name" id="newskill-job" class="form-control" placeholder="Search skill...">		
									</div>
									{!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
								</div>
							</div>
						</div>
					</div>
					<?php if($filter != null){
						$temp = explode(', ', $filter->time_for);
						$ft = "";
						$pt = "";
						$fr = "";
						$wf = "";

						if(in_array("Full Time", $temp)){
							$ft = "active";

						}
						if(in_array("Part Time", $temp)){
							$pt = "active";

						}
						if(in_array("Freelancer", $temp)){
							$fr = "active";

						}
						if(in_array("Work from Home", $temp)){
							$wf = "active";

						}

					} ?>
					<div class="row" style="margin:0;">
						<!-- <div class="col-md-12"> -->
							<div class="col-md-3 col-sm-3 col-xs-3" style="padding:0;">
								 <div class="btn-group job-type-checkbox" data-toggle="buttons">
					                <label class="btn default btn-filter @if(Auth::user()->induser->prefered_jobtype != null) @if($filter != null) {{$ft}} @else active @endif active @else active @endif" style="padding:0;">
					                	<span class="checkicon"><i class="icon-check" style="font-size:15px"></i></span>
					                    <input type="checkbox" name="time_for[]" value="Full Time" class="toggle"
					                    @if(Auth::user()->induser->prefered_jobtype != null) @if($filter != null) @if($ft != "") checked @endif @endif @else checked @endif>
					                    <a class="icon-btn icon-filter-btn jobtype-css">
						                    <div class="jtype-name-css">
						                    	Full<br/> Time
						                    </div> 
						                </a>
					                </label>
					            </div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3" style="padding:0;">
								<div class="btn-group job-type-checkbox" data-toggle="buttons">
					                <label class="btn default btn-filter @if(Auth::user()->induser->prefered_jobtype != null) @if($filter != null) {{$pt}} @else active @endif active @else active @endif" style="padding:0;">
					                	<span class="checkicon"><i class="icon-check" style="font-size:15px"></i></span>
					                    <input type="checkbox" name="time_for[]" value="Part Time" class="toggle" 
					                    @if(Auth::user()->induser->prefered_jobtype != null) @if($filter != null) @if($pt != "") checked @endif @endif @else checked @endif>
					                    <a class="icon-btn icon-filter-btn jobtype-css">
						                    <div class="jtype-name-css">
						                         Part<br/> Time
						                    </div> 
						                </a>
					                </label>
					            </div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3" style="padding:0;">
								<div class="btn-group job-type-checkbox" data-toggle="buttons">
					                <label class="btn default btn-filter @if(Auth::user()->induser->prefered_jobtype != null) @if($filter != null) {{$fr}} @else active @endif active @else active @endif" style="padding:0;">
					                	<span class="checkicon"><i class="icon-check" style="font-size:15px"></i></span>
					                    <input type="checkbox" name="time_for[]" value="Freelancer" class="toggle" 
					                    @if(Auth::user()->induser->prefered_jobtype != null) @if($filter != null) @if($fr != "") checked @endif @endif @else checked @endif>
					                    <a class="icon-btn icon-filter-btn jobtype-css">
						                    <div class="jtype-name-css">
						                    	<br/>
						                         Freelancer
						                    </div> 
						                </a>
					                </label>
					            </div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3" style="padding:0;">
								<div class="btn-group job-type-checkbox" data-toggle="buttons">
					                <label class="btn default btn-filter @if(Auth::user()->induser->prefered_jobtype != null) @if($filter != null) {{$wf}} @else active @endif active @else active @endif" style="padding:0;">
					                	<span class="checkicon"><i class="icon-check" style="font-size:15px"></i></span>
					                    <input type="checkbox" name="time_for[]" value="Work from Home" class="toggle" 
					                    @if(Auth::user()->induser->prefered_jobtype != null) @if($filter != null) @if($wf != "") checked @endif @endif @else checked @endif>
					                    <a class="icon-btn icon-filter-btn jobtype-css">
						                    <div class="jtype-name-css">
						                         Work<br/>From Home
						                    </div> 
						                </a>
					                </label>
					            </div>
							</div>
							
						<!-- </div> -->
					</div>
					<div class="row" style="margin: 15px 0 0 -10px;">
						<div class="col-md-12 col-sm-12" style="margin:-5px 0;padding:0 10px;">
							<div class="form-group">
								<label style="font-size:13px;font-weight:500;">Location <span class="required">
										* </span></label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-map-marker"></i>
									</span>

									<input type="text" id="pref_loc" name="pref_loc" 
										class="form-control" placeholder="Select location">									
									
								</div>
								{!! Form::select('prefered_location[]', [], null, ['id'=>'prefered_location', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'city', 'multiple']) !!}		
							</div>
						</div>
					</div>
					<div class="showmore" style="cursor:pointer;">Show More Option <i class="fa fa-angle-double-down"></i></div>
					<div class="row filtershow" style="margin:15px 0 0 -10px;">	
						<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0 10px;margin: -40px 0 0 0;">
							<label style="font-size:13px;font-weight:500;">Posted by</label>
							<div class="form-group">
								<select name="posted_by[]" id="postedby" class="form-control" placeholder="Select" multiple>
									<option selected value="individual">Individual</option>
									<option selected value="company">Company</option>
									<option selected value="consultancy">Consultancy</option>
							    </select>		
							</div>
				        </div>
				        <div class="col-md-12 col-sm-12 col-xs-12" style="margin: -13px 0px; padding: 0 10px;">
				         	<div class="form-group">
					         	 <label style="font-size:13px;">
									<input type="checkbox" checked name="expired" value="1"  class="icheck" data-checkbox="icheckbox_square-grey"
									@if($filter != null)@if($filter->expired == '1') Checked @endif @endif > Show Expired Post
								</label>
							</div>
						</div>
				    </div>
				    <div class="showless" style="cursor:pointer;">Show Less Option <i class="fa fa-angle-double-up"></i></div>
				</div>
			</div>
			<!-- <div class="modal-footer" style="background-color: #DDE0E0;">
				<div class="row" style="margin: 0 0px 0 -20px;">
					<div class="col-md-3 col-sm-3 col-xs-3" style="padding:0;">
						
						
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6" style="text-align:center;">
						<button type="submit" name="submit-filter" value="submit-filter" class="btn green" style="padding: 6px 50px;">
							Filter
						</button>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-3">
						
					</div>
				</div>
			</div> -->
		</form>
		
		</div>
	</div>
</div>

<!-- /.modal -->

<!-- Jobtip Filter End-->
@elseif($title == 'favourite')
<!-- <div class="portlet light bordered col-md-9">
	<div class="portlet-title"> -->
		<div class="links-title" style="text-align: center; margin: 10px 0 30px 0;">
			<i class="fa fa-star"></i>
			<span class="caption-subject font-blue-hoki bold capitalize">My Favourite Posts</span>
		</div>
	<!-- </div>
</div> -->
@elseif($title == 'postByUser')
<!-- <div class="portlet light bordered col-md-9">
	<div class="portlet-title"> -->
		<div class="links-title" style="text-align: center; margin: 10px 0 30px 0;">
			<i class=""></i>
			<span class="caption-subject font-blue-hoki bold capitalize">Posts by "<span style="color: dimgrey;"> {{$postuser->firm_name}}{{$postuser->fname}} {{$postuser->lname}} </span>"</span>
		</div>
	<!-- </div>
</div> -->
@elseif($title == 'postInGroup')
<!-- <div class="portlet light bordered col-md-9">
	<div class="portlet-title"> -->
		<div class="links-title" style="text-align: center; margin: 10px 0 30px 0;">
			<i class=""></i>
			<span class="caption-subject font-blue-hoki bold capitalize">Posts in Group "<span style="color: dimgrey;"> {{$groupUser->group_name}} </span>"</span>
		</div>
	<!-- </div>
</div> -->
@elseif($title == 'postByCorporate')
<!-- <div class="portlet light bordered col-md-9">
	<div class="portlet-title"> -->
		<div class="links-title" style="text-align: center; margin: 10px 0 30px 0;">
			<i class=""></i>
			<span class="caption-subject font-blue-hoki bold capitalize">Posted by "<span style="color: dimgrey;"> {{$postCorp->firm_name}} </span>"</span>
		</div>
	<!-- </div>
</div> -->
@elseif($title == 'postId')
<!-- <div class="portlet light bordered col-md-9">
	<div class="portlet-title"> -->
		<div class="links-title" style="text-align: center; margin: 10px 0 30px 0;">
			<i class=""></i>
			<span class="caption-subject font-blue-hoki bold capitalize">Posts Id "<span style="color: dimgrey;"> </span>"</span>
		</div>
	<!-- </div>
</div> -->
@endif

<script type="text/javascript">
$(document).ready(function () {
    $('#save').click(function (){
        $('.filtersave').css({'color':'#1f897f'});
        // $('.filtersave').value('savefilter');
    });
    jQuery('.showless').hide();
    jQuery('.showmore').on('click', function(event){
    	jQuery('.filtershow').show();
    	jQuery('.showmore').hide();
    	jQuery('.showless').show();
    });

    jQuery('.showless').on('click', function(event){
    	jQuery('.filtershow').hide();
    	jQuery('.showmore').show();
    	jQuery('.showless').hide();
    });

    $("#postedby").select2({
	  placeholder: "Select Posted By"
	});
});
</script>