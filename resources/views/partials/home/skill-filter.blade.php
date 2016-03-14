
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
							<a href="/home/skill/jobtype#skill">Job Type</a>
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
			<div class="modal-header" style="padding: 7px 24px;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-hidden="true" style="margin-top: 6px !important;"></button>
				<h4 class="modal-title">Filter Skill Posts</h4>
			</div>
			<form name="filter_form" action="/home/skill" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="modal-body">
				<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
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
										
										<input type="text" readonly id="slider-range-exp1" name="min_exp" class="filter-range-experience" /> - 
										<input type="text" readonly id="slider-range-exp2" name="max_exp" class="filter-range-experience" /> Years
								<div id="experience" class="">
									<div id="slider-range-exp" class="slider bg-gray"></div>
								</div>
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
								 <div class="btn-group" data-toggle="buttons">
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
								<div class="btn-group" data-toggle="buttons">
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
								<div class="btn-group" data-toggle="buttons">
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
								<div class="btn-group" data-toggle="buttons">
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
			<div class="modal-footer right" style="padding: 5px 0;">
				<label style="font-size:13px;float:left;margin: 5px 16px;">
					<input type="checkbox" name="save_filter" value="savefilter" class="icheck" data-checkbox="icheckbox_square-grey" @if($skillfilter != null)@if($skillfilter->save_filter == 'savefilter') checked @endif @endif> Save Filter
				</label>
				<button type="submit" class="btn green" style="margin: 0 30px;padding: 6px 20px;">
					Filter
				</button>
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