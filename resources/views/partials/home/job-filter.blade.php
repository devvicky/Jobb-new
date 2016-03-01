@if($title == 'home')
<!-- Jobtip Filter Start -->
<div class="row" style="margin: -8px -10px 10px;">
	<div class="col-md-12" style=" lightgray;margin-bottom: 5px;">
	<a class="btn default" style="background-color:whitesmoke !important;color:#8c8c8c;" data-toggle="modal" href="#homefiltermodal">
		<i class="fa fa-filter"></i> Filter
	</a>
		<div class="row sort-by-css hide-label" style="text-align: right;">
			<div class="col-md-12">
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
		<div class="row sort-by-css show-filter" style="margin-right:8px;">
			<div class="col-md-8 col-sm-8 col-xs-7" style="margin:5px 0;">
				<a class="show-more" style="font-size:12px;font-weight:400;">Show more</a>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-5">
				<!-- <a class="show-more" style="font-size:12px;font-weight:400;">Show more</a> -->
				<button type="submit" class="btn btn-info" value="Search" title="Search" 
						style="background-color:transparent !important; border-color: transparent;">
						<i class="glyphicon glyphicon-floppy-disk" style="color:dodgerblue;font-size:16px;"></i>
					</button>
			</div>
		</div>		
	</div>
</div>
<div id="homefiltermodal" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="padding: 7px 24px;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-hidden="true" style="margin-top: 6px !important;"></button>
				<h4 class="modal-title">Filter Job Posts</h4>
			</div>
			<form id="home-filter" name="filter_form" action="/home" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="modal-body">
				<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
					<input type="hidden" name="post_type" value="job">
					<div class="row" style="margin:0 0px 0 -10px;">
						<div class="col-md-12 col-sm-12 col-xs-12" style="margin:0px 0;padding:0 10px;">
							<!-- <label style="font-size:13px;font-weight:500;">Title or Role</label> -->
							<div class="form-group">
								<!-- <input type="text" id="title" name="post_title" class="form-control filter-input " placeholder="Job Title, Role" style="border: 1px solid darkcyan !important;margin: 7px 0px;"> -->
								<input type="text" id="title" name="pref_loc" 
									class="form-control select2" placeholder="Enter Keywords">
							</div>
						</div>
					</div>
					<div class="row" style="margin:0 0px 0 -7px;">
						<div class="col-md-12" style="margin:-5px 0;padding:0 10px;">
							<div class="form-group">							
								<label class=" control-label">Salary </label>&nbsp;: 
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
							<!-- <label style="font-size:13px;font-weight:500;">Experience</label> : <span id="slider-range-max-amount"> </span> Years
							<div class="">
								<div id="slider-range-max" class="slider bg-purple">
								</div>
								<div class="slider-value">
									  
								</div>
							</div> -->
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
					<div class="row" style="margin:0;">
						<!-- <div class="col-md-12"> -->
							<div class="col-md-3 col-sm-3 col-xs-3" style="padding:0;">
								 <div class="btn-group" data-toggle="buttons">
					                <label class="btn default btn-filter active " style="padding:0;">
					                	<span class="checkicon"><i class="fa  fa-check-square" style="font-size:20px"></i></span>
					                    <input type="checkbox" class="toggle">
					                    <a class="icon-btn icon-filter-btn ">
						                    <div>
						                         Full<br/> Time
						                    </div> 
						                </a>
					                </label>
					            </div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3" style="padding:0;">
								<div class="btn-group" data-toggle="buttons">
					                <label class="btn default btn-filter active" style="padding:0;">
					                	<span class="checkicon"><i class="fa  fa-check-square" style="font-size:20px"></i></span>
					                    <input type="checkbox" class="toggle">
					                    <a class="icon-btn icon-filter-btn">
						                    <div>
						                         Part<br/> Time
						                    </div> 
						                </a>
					                </label>
					            </div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3" style="padding:0;">
								<div class="btn-group" data-toggle="buttons">
					                <label class="btn default btn-filter active" style="padding:0;">
					                	<span class="checkicon"><i class="fa  fa-check-square" style="font-size:20px"></i></span>
					                    <input type="checkbox" class="toggle">
					                    <a class="icon-btn icon-filter-btn">
						                    <div>
						                    	<br/>
						                         Freelancer
						                    </div> 
						                </a>
					                </label>
					            </div>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3" style="padding:0;">
								<div class="btn-group" data-toggle="buttons">
					                <label class="btn default btn-filter active" style="padding:0;">
					                	<span class="checkicon"><i class="fa  fa-check-square" style="font-size:20px"></i></span>
					                    <input type="checkbox" class="toggle">
					                    <a class="icon-btn icon-filter-btn">
						                    <div>
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
						<div class="col-md-6 col-sm-6 col-xs-12" style="padding:0 10px;margin: -40px 0 0 0;">
							<label style="font-size:13px;font-weight:500;">Posted by</label>
							<div class="form-group">
								<select multiple="multiple" name="posted_by" placeholder="Select" class="SlectBox">
									<option selected value="individual">Individual</option>
									<option selected value="company">Company</option>
									<option selected value="consultancy">Consultancy</option>
							    </select>		
							</div>
				        </div>
				        <div class="col-md-6 col-sm-6 col-xs-12" style="margin: -13px 0px; padding: 0 10px;">
				         	<div class="form-group">
					         	 <label style="font-size:13px;">
									<input type="checkbox" name="expired" checked class="icheck" data-checkbox="icheckbox_square-grey"> Show Expired Post
								</label>
							</div>
						</div>
				    </div>
				</div>
			</div>
			<div class="modal-footer right" style="padding: 5px 0;">
				<label style="font-size:13px;float:left;margin: 5px 16px;">
					<input type="checkbox" name="save filter" checked class="icheck" data-checkbox="icheckbox_square-grey"> Save Filter
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