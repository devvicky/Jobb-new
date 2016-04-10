@if($title == 'home')
<!-- Jobtip Filter Start -->
<div class="row" style="margin: -8px -10px 10px;">
	<div class="col-md-12" style=" lightgray;margin-bottom: 5px;">
		<div class="row">
		@if($filter != null)
			<div class="col-md-2 col-sm-2 col-xs-2">
				<a class="btn default" style="background-color:whitesmoke !important;color:#45B6AF;" data-toggle="modal" href="#homefiltermodal">
					<i class="fa fa-filter"></i> Filter <i class="fa fa-check-square-o"></i>
				</a>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-3 filter-clear" style="padding: 3px 0;">
				<a href="/home">
					<button type="submit" name="clear" value="clear" class="btn" style="background-color:transparent;border:0;font-size:12px;">
						<i class="fa fa-times" style="color:red;font-size:12px;"></i> Clear
					</button>
				</a>
			</div>
		@else
		<div class="col-md-5 col-sm-5 col-xs-5">
			<a class="btn default" style="background-color:whitesmoke !important;color:#8c8c8c;" data-toggle="modal" href="#homefiltermodal">
				<i class="fa fa-filter"></i> Filter
			</a>
		</div>
		@endif
			<div class="col-md-7 col-sm-7 col-xs-7 filter-clear-123" style="text-align:right;">
				<div class="btn-group">
					<button class="btn btn-default btn-sm dropdown-toggle capitalize" type="button" data-toggle="dropdown" style="border: 0;color:#8c8c8c;background:transparent;">
					<i class="glyphicon glyphicon-sort"></i> @if($sort_by != " ") {{$sort_by}} @else Date @endif<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu dropdown-menu-sort" role="menu" style="min-width: 130px;margin: 4px -25px;">
						<li>
							<a href="/home/job/date">Date</a>
						</li>
						<li>
							<a href="/home/job/magic-match">Magic Match</a>
						</li>
						<li>
							<a href="/home/job/individual">Individual Post</a>
						</li>
						<li>
							<a href="/home/job/corporate">corporate Post</a>
						</li>
					</ul>
				</div>		
			</div>
		</div>
		<div class="row sort-by-css hide-label" style="text-align: right;">
			<div class="col-md-12">
				
			</div>
		</div>		
	</div>
</div>
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
			<div class="modal-header" style="padding: 7px 24px;background-color: #DDE0E0;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-hidden="true" style="margin-top: 6px !important;"></button>
				<h4 class="modal-title">Filter Job Posts </h4>
				<div class="row" style="margin-top: 5px;">
					<div class="col-md-10 col-sm-10 col-xs-10">
						@if($filter != null)
							[ Last Saved Filter : {{ date('M d, Y', strtotime($filter->updated_at)) }} @ {{ date('H:i A', strtotime($filter->updated_at))}} ]
						@endif
					</div>
					<div class="col-md-2 col-sm-2 col-xs-2" style="margin: -7px -30px;">
						@if($filter != null)
							<form action="/job-filter/remove/{{Auth::user()->id}}" method="post">
								<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
								<button type="submit" class="btn" style="background-color:transparent;border:0;font-size:12px;"><i class="glyphicon glyphicon-trash" style="color:red;font-size:12px;"></i> Remove</button>
							</form>
						@endif
					</div>
				</div>
			</div>
			<form id="job-filter" name="filter_form" action="/home" method="post">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<div class="modal-body">
				<div class="" data-always-visible="1" data-rail-visible1="1">
					<input type="hidden" name="post_type" value="job">
					<div class="row" style="margin:0 0px 0 -10px;">
						<div class="col-md-12 col-sm-12 col-xs-12" style="margin:0px 0;padding:0 10px;">
							<!-- <label style="font-size:13px;font-weight:500;">Title or Role</label> -->
							<div class="form-group">
								<input type="text" id="title" name="job_title" 
									class="form-control select2" value="@if($filter != null){{$filter->job_title}}@endif" placeholder="Enter Keywords">
							</div>
						</div>
					</div>
					<div class="row" style="margin:0 0px 0 -7px;">
						<div class="col-md-12" style="margin:-5px 0;padding:0 10px;">
							<label style="font-size:13px;font-weight:500;">Experience</label> : <input readonly id="slider-range-experience" name="experience" class="filter-range-experience" /> Years
							<div class="">
								<div id="slider-range-max-skill" class="slider bg-purple">
								</div>
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
								 <div class="btn-group" data-toggle="buttons">
					                <label class="btn default btn-filter @if(Auth::user()->induser->prefered_jobtype != null) @if($filter != null) {{$ft}} @else active @endif @else active @endif" style="padding:0;">
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
								<div class="btn-group" data-toggle="buttons">
					                <label class="btn default btn-filter @if(Auth::user()->induser->prefered_jobtype != null) @if($filter != null) {{$pt}} @else active @endif @else active @endif" style="padding:0;">
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
								<div class="btn-group" data-toggle="buttons">
					                <label class="btn default btn-filter @if(Auth::user()->induser->prefered_jobtype != null) @if($filter != null) {{$fr}} @else active @endif @else active @endif" style="padding:0;">
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
								<div class="btn-group" data-toggle="buttons">
					                <label class="btn default btn-filter @if(Auth::user()->induser->prefered_jobtype != null) @if($filter != null) {{$wf}} @else active @endif @else active @endif" style="padding:0;">
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
					<div class="row" style="margin:15px 0 0 -10px;">	
						<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0 10px;margin: -40px 0 0 0;">
							<label style="font-size:13px;font-weight:500;">Posted by</label>
							<div class="form-group">
								<select multiple="multiple" name="posted_by" class="form-control bs-select" placeholder="Select">
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
				    
				</div>
			</div>
			<div class="modal-footer" style="background-color: #DDE0E0;">
				<div class="row" style="margin: 0 0px 0 -20px;">
					<div class="col-md-3 col-sm-3 col-xs-3" style="padding:0;">
						<label>
							<input type="checkbox" class="icheck" 
									name="save_filter"
									data-checkbox="icheckbox_line-grey" 
									data-label="Save"
									value="savefilter" @if($filter != null)@if($filter->save_filter == 'savefilter') checked @endif @endif>
						</label>
						
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6" style="text-align:center;">
						<button type="submit" class="btn green" style="padding: 6px 50px;">
							Filter
						</button>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-3">
						<button type="button" id="btn" class="btn btn-warning">Reset</button>
					</div>
				</div>
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