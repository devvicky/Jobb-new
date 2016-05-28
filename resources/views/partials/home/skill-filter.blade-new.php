
@if($title == 'home')
<!-- Jobtip Filter Start -->
<div class="row" style="margin: -8px -10px 10px;">
	<div class="col-md-12" style=" lightgray;margin-bottom: 5px;">
	<a class="btn default" style="background-color:whitesmoke !important;color:#8c8c8c;" data-toggle="modal" href="#homeskillfiltermodal">
		<i class="fa fa-filter"></i> Filter
	</a>
		<div class="row sort-by-css hide-label" style="text-align: right;">
			<div class="col-md-12">
				<div class="btn-group">
					<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" style="border: 0;color:#8c8c8c;background:transparent;">
					<i class="glyphicon glyphicon-sort"></i>  @if($sort_by_skill != " ") {{$sort_by_skill}} @else Date @endif <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu dropdown-menu-sort" role="menu" style="min-width: 130px;margin: 4px -25px;">
						<li>
							<a href="/home/skill/date">Date</a>
						</li>
						<li>
							<a href="/home/skill/jobtype">Job Type</a>
						</li>
					</ul>
				</div>
				
			</div>
		</div>		
	</div>
</div>
@if (count($errors) > 0)
	<div class="alert alert-success">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<div id="homeskillfiltermodal" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="filter_form" action="/home/skill" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="post_type" value="skill">
				<div class="modal-header filter-modal-header">
					<div class="tool">
						<button class="btn btn-danger pull-left" title="close">
							<span class="fa fa-long-arrow-left"></span>
						</button>
						<div class="pull-right"> 
							<span class="filter-button fa fa-undo"></span> 
							<span class="filter-button  fa fa-floppy-o"></span> 
							<button type="submit" class="btn green" title="Filter">
								<i class="fa fa-check" aria-hidden="true"></i> Filter
							</button>
						</div>
					</div>
					<h4 class="modal-title filter-header-title">Filter Skill Posts</h4> 
				</div>
				<div class="modal-body">
					<div class="row  filter-form-row">
						<div class="col-sm-12 col-xs-12 col-md-12">
							<div class="input-group" title="Enter keywords to filter jobs.">
								<span class="input-group-addon filter-input-icon">
									<i class="fa fa-search"></i>
								</span>
  								<input type="text" class="form-control" placeholder="Keywords" aria-describedby="basic-addon1">
							</div>
						</div>
					</div>
					<div class="row  filter-form-row">
						<div class="col-sm-12 col-xs-12 col-md-12">
							<div class="row filter-inner-row">
								<div class="col-sm-12 col-xs-12 col-md-6 col-lg-g col-xl-6">
									<div class="input-group">
										<span class="input-group-addon filter-input-icon">
											<i class="fa fa-briefcase"></i>
										</span>
  										<select class="form-control" placeholder="Keywords" aria-describedby="basic-addon1">
  											<option>Min. Experience</option>
  										</select>
									</div>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6 col-lg-g col-xl-6">
									<div class="input-group">
										<span class="input-group-addon filter-input-icon">
											<i class="fa fa-briefcase"></i>
										</span>
  										<select class="form-control" placeholder="Keywords" aria-describedby="basic-addon1">
  											<option>Max. Experience</option>
  										</select>
									</div>
								</div>
							</div> 
						</div>
					</div>
					<div class="row  filter-form-row">
						<div class="col-sm-12 col-xs-12 col-md-12"> 
							<div class="input-group">
								<span class="input-group-addon filter-input-icon"> 
									<i class="fa fa-building-o"></i>
								</span>
								<select class="form-control" placeholder="Keywords" aria-describedby="basic-addon1">
									<option>Industry</option>
								</select>
							</div> 
						</div>
					</div>
					<div class="row  filter-form-row">
						<div class="col-sm-12 col-xs-12 col-md-12"> 
							<div class="input-group">
								<span class="input-group-addon filter-input-icon"> 
									<i class="fa fa-cogs"></i>
								</span>
								<select class="form-control" placeholder="Keywords" aria-describedby="basic-addon1">
									<option>Skills</option>
								</select>
							</div> 
						</div>
					</div>
					<div class="row  filter-form-row">
						<!-- <div class="col-md-12"> -->
							<div class="col-md-3 col-sm-3 col-xs-3 col-xl-3 col-lg-3">
								 <div class="btn-group   job-type-checkbox" data-toggle="buttons">
					                <label class="btn default btn-filter  job-type-label">
					                	<span class="checkicon"><i class="icon-check"></i></span>
					                    <input type="checkbox" name="time_for[]" class="toggle">
					                    <a class="icon-btn icon-filter-btn jobtype-css">
						                    <div class="jtype-name-css">
						                    	Full<br/> Time
						                    </div> 
						                </a>
					                </label>
					            </div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 col-xl-3 col-lg-3">
								<div class="btn-group  job-type-checkbox" data-toggle="buttons">
					                <label class="btn default btn-filter  job-type-label">
					                	<span class="checkicon"><i class="icon-check"></i></span>
					                    <input type="checkbox" name="time_for[]" class="toggle">
					                    <a class="icon-btn icon-filter-btn jobtype-css">
						                    <div class="jtype-name-css">
						                         Part<br/> Time
						                    </div> 
						                </a>
					                </label>
					            </div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 col-xl-3 col-lg-3">
								<div class="btn-group  job-type-checkbox" data-toggle="buttons">
					                <label class="btn default btn-filter job-type-label">
					                	<span class="checkicon"><i class="icon-check"></i></span>
					                    <input type="checkbox" name="time_for[]" class="toggle">
					                    <a class="icon-btn icon-filter-btn jobtype-css">
						                    <div class="jtype-name-css">
						                    	<br/>
						                         Freelancer
						                    </div> 
						                </a>
					                </label>
					            </div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 col-xl-3 col-lg-3">
								<div class="btn-group  job-type-checkbox" data-toggle="buttons">
					                <label class="btn default btn-filter  job-type-label">
					                	<span class="checkicon"><i class="icon-check"></i></span>
					                    <input type="checkbox" name="time_for[]" class="toggle">
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

					<div class="row filter-form-row">
						<div class="col-md-12">
							<a href="javascript:void(0);" class="toggle-advanced-filter-setting show-advanced-filter-setting">
								<i class="fa fa-eye"></i> Show advanced filter.</a>
						</div>
					</div>

				</div>
			</form>
		</div>
	</div>
</div>
<div id="homeskillfiltermodal1" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="padding: 7px 24px;">
				<div class="row">
					<div class="col-md-12"> 
						<div class="filter-header-action">
							<div class="pull-left">
								<i class="fa fa-arrow-circle-left filter-button" title="close" data-dismiss="modal" aria-hidden="true"></i>
							</div>
							
							<div class="pull-right"> 
								<span class="filter-button fa fa-undo"></span> 
								<span class="filter-button  fa fa-floppy-o"></span> 
								<button type="submit" class="btn btn-xs green" title="Filter">
									<i class="fa fa-check" aria-hidden="true"></i> Filter
								</button>
							</div>
						</div>
						<h4 class="modal-title filter-header-title">Filter Skill Posts</h4> 
					</div>
				</div>  
			</div>
			<form name="filter_form" action="/home/skill" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="modal-body">
				<div data-always-visible="1" data-rail-visible1="1">
					<input type="hidden" name="post_type" value="skill">
					<div class="row" style="margin:0;">
						<div class="col-md-12 col-sm-12 col-xs-12" style="margin:0px 0;padding:0 10px;">
							<!-- <label style="font-size:13px;font-weight:500;">Title or Role</label> -->
							<div class="form-group">
								<!-- <input type="text" id="title" name="post_title" class="form-control filter-input " placeholder="Job Title, Role" style="border: 1px solid darkcyan !important;margin: 7px 0px;"> -->
								<input type="text" id="title" name="skill_title" value="@if($skillfilter != null){{$skillfilter->job_title}}@endif"
									class="form-control select2" placeholder="Enter Keywords">
							</div>
						</div>
					</div>
					<div class="row" style="margin:0;">
						<div class="col-md-12" style="margin:-5px 0;padding:0 10px;">
							<div class="form-group">							
								<label class=" control-label">Experience </label>&nbsp;: 
										
										<input type="text" readonly id="slider-range-exp1" name="min_exp" class="filter-range-experience" value="1"/> - 
										<input type="text" readonly id="slider-range-exp2" name="max_exp" class="filter-range-experience" /> Years
								<div id="experience" class="">
									<div id="slider-range-exp" class="slider bg-gray"></div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-xl-12 col-xs-12 col-lg-12">
							<div class="form-group">
								<label>Industry</label>
								<select id="skill-industry" aria-hidden="true" class="form-control" placeholder="Skills" name="industry" aria-hidden='true'> 
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
									<option value="KPO/Analytics">KPO/nalytics</option>
									<option value="Machinery/ Equipment Mfg.">Machinery/ Equipment Mfg.</option>
									<option value="Oil/ Gas/ Petroleum">Oil/ Gas/ Petroleum</option>
									<option value="Pharmaceuticals">Pharmaceuticals</option>
									<option value="Power/Energy">Power/Energy</option>
									<option value="Retailing">Retailing</option>
									<option value="Telecom">Telecom</option>
									<option value="Advertising/PR/vents">Advertising/PR/Events</option>
									<option value="Agriculture/ Dairy Based">Agriculture/ Dairy Based</option>
									<option value="Aviation/Aerospace">Aviation/Aerospace</option>
									<option value="Beauty/Fitness/PersonalCare/SPA">Beauty/Fitness/PersonalCare/SPA</option>
									<option value="Beverages/ Liquor">everages/ Liquor</option>
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
									<option value="Gems & Jewellery">ms & Jewellery</option>
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
					<div class="row" style="margin: 15px 0 0 0;">
						<div class="col-md-12 col-sm-12 col-xs-12" style="margin:-5px 0;padding:0 10px;">
							<div class="form-group">
								<!-- <label style="font-size:13px;font-weight:500;">Skills</label> -->
								<div>
									<div style="position:relative;" id="skill-wrapper">
										<input type="text" name="name" id="newskill" class="form-control" placeholder="Search skill...">		
									</div>
									{!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skillid', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="margin:0;">
						<!-- <div class="col-md-12"> -->
							<div class="col-md-3 col-sm-3 col-xs-3" style="padding:0;">
								 <div class="btn-group   job-type-checkbox" data-toggle="buttons">
					                <label class="btn default btn-filter " style="padding:0;">
					                	<span class="checkicon"><i class="icon-check" style="font-size:15px"></i></span>
					                    <input type="checkbox" name="time_for[]" class="toggle">
					                    <a class="icon-btn icon-filter-btn jobtype-css">
						                    <div class="jtype-name-css">
						                    	Full<br/> Time
						                    </div> 
						                </a>
					                </label>
					            </div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3" style="padding:0;">
								<div class="btn-group  job-type-checkbox" data-toggle="buttons">
					                <label class="btn default btn-filter" style="padding:0;">
					                	<span class="checkicon"><i class="icon-check" style="font-size:15px"></i></span>
					                    <input type="checkbox" name="time_for[]" class="toggle">
					                    <a class="icon-btn icon-filter-btn jobtype-css">
						                    <div class="jtype-name-css">
						                         Part<br/> Time
						                    </div> 
						                </a>
					                </label>
					            </div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3" style="padding:0;">
								<div class="btn-group  job-type-checkbox" data-toggle="buttons">
					                <label class="btn default btn-filter" style="padding:0;">
					                	<span class="checkicon"><i class="icon-check" style="font-size:15px"></i></span>
					                    <input type="checkbox" name="time_for[]" class="toggle">
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
								<div class="btn-group  job-type-checkbox" data-toggle="buttons">
					                <label class="btn default btn-filter" style="padding:0;">
					                	<span class="checkicon"><i class="icon-check" style="font-size:15px"></i></span>
					                    <input type="checkbox" name="time_for[]" class="toggle">
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
					<div class="row advanced-filter-setting">
						<div class="col-md-12">
							<div class="row" style="margin: 15px 0 0 0;">
								<div class="col-md-12 col-sm-12" style="margin:-5px 0;padding:0 10px;">
									<div class="form-group">
										<label style="font-size:13px;font-weight:500;">Location <span class="required">
												* </span></label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-map-marker"></i>
											</span>

											<input type="text" id="curr_loc" name="curr_loc" 
												class="form-control" placeholder="Select preferred location">									
											
										</div>
										{!! Form::select('current_location[]', [], null, ['id'=>'current_location', 
																							   'aria-hidden'=>'true', 
																							   'class'=>'form-control', 
																							   'placeholder'=>'city', 
																							   'multiple']) !!}
									</div>
								</div>
							</div>
							<div class="row" style="margin:15px 0 0 -10px;">	
								
						        <div class="col-md-6 col-sm-6 col-xs-12" style="margin: -13px 0px; padding: 0 10px;">
						         	<div class="form-group">
							         	 <label style="font-size:13px;">
											<input type="checkbox" name="expired" value="1"  class="icheck" data-checkbox="icheckbox_square-grey"
											@if($skillfilter != null)@if($skillfilter->expired == '1') Checked @endif @endif > Show Expired Post
										</label>
									</div>
								</div>
						    </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<a href="javascript:void(0);" class="toggle-advanced-filter-setting show-advanced-filter-setting">Show advanced filter.</a>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer right" style="padding: 5px 0;">
				<label style="font-size:13px;float:left;margin: 5px 16px;">
					<input type="checkbox" name="save_filter" value="savefilter" class="icheck" data-checkbox="icheckbox_square-grey" @if($skillfilter != null)@if($skillfilter->save_filter == 'savefilter') checked @endif @endif> Save Filter
				</label>
			</div>
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