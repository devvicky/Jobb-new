@if($title == 'home')
<!-- Jobtip Filter Start -->
<div class="row" style="margin: -8px -10px 10px;">
	<div class="col-md-12" style=" lightgray;margin-bottom: 5px;">
	<a class="btn default" style="background-color:whitesmoke !important;color:#8c8c8c;" data-toggle="modal" href="#homefiltermodal">
		<i class="fa fa-filter"></i> Filter
	</a>
		<div class="row sort-by-css hide-label">
			<div class="col-md-12">
				<div class="btn-group">
					<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" style="border: 0;color:#8c8c8c;background:transparent;">
					<i class="glyphicon glyphicon-sort"></i> Sort by {{$sort_by}}<i class="fa fa-angle-down"></i>
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
<div class="modal fade" id="homefiltermodal" tabindex="-1" role="dialog" aria-labelledby="share-post" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Filter Job Posts</h4>
      </div>
     	<form id="home-filter" name="filter_form" action="/home" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="modal-body">
				<div class=" scroller-filter" data-always-visible="1" data-rail-visible1="1">
					<input type="hidden" name="post_type" value="job">
					<div class="row" style="margin:0;">
						<div class="col-md-12 col-sm-12 col-xs-12" style="margin:-5px 0;padding:0 10px;">
							<label style="font-size:13px;font-weight:500;">Title or Role</label>
							<div class="form-group">
								<!-- <input type="text" id="title" name="post_title" class="form-control filter-input " placeholder="Job Title, Role" style="border: 1px solid darkcyan !important;margin: 7px 0px;"> -->
								<input type="text" id="title" name="pref_loc" 
									class="form-control select2" placeholder="Enter Title or Role">
							</div>
						</div>
					</div>
					<div class="row" style="margin:0;">
						<div class="col-md-6 col-sm-6 col-xs-12" style="margin:-5px 0;padding:0 10px;">
							<label style="font-size:13px;font-weight:500;">Job Type</label>
							<div class="form-group">
								<select multiple="multiple" name="time_for"  placeholder="Select" class="SlectBox">
							       <option selected value="Full Time">Full Time</option>
									<option selected value="Part Time">Part Time</option>
									<option selected value="Freelancer">Freelancer</option>
									<option selected value="Work from Home">Work from Home</option>
							    </select>		
							</div>
				         </div>
						<div class="col-md-6 col-sm-6 col-xs-12" style="margin:-5px 0;padding:0 10px;">
							<label style="font-size:13px;font-weight:500;">Experience</label>
							<div class="form-group">	
								<select name="experience" placeholder="Select" class="SlectBox">
				                	
				                	<option value="0">Fresher</option>
									<option value="1">1 Year</option>
									<option value="2">2 Years</option>
									<option value="3">3 Years</option>
									<option value="4">4 Years</option>
									<option value="5">5 Years</option>
									<option value="6">6 Years</option>
									<option value="7">7 Years</option>
									<option value="8">8 Years</option>
									<option value="9">9 Years</option>
									<option value="10">10 Years</option>
									<option value="11">11 Years</option>
									<option value="12">12 Years</option>
									<option value="13">13 Years</option>
									<option value="14">14 Years</option>
									<option value="15">15 Years</option>
				                </select>		
								<!-- <input type="text" id="exp" name="experience" class="form-control filter-input" placeholder="Exp" style="height: 25px;margin: 7px 0px;">				 -->
							</div>	
						</div>
					</div>
					<div class="row" style="margin:0;">
						<div class="col-md-6 col-sm-12" style="margin:-5px 0;padding:0 10px;">
							<div class="form-group">
								<label style="font-size:13px;font-weight:500;">Prefered Location <span class="required">
										* </span></label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-map-marker"></i>
									</span>

									<input type="text" id="pref_loc" name="pref_loc" 
										class="form-control" placeholder="Select preferred location"
										onblur="pref_loc_locality()">									
									
								</div>
								{!! Form::select('prefered_location[]', [], null, ['id'=>'prefered_location', 'onchange'=>'pref_loc_locality()', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'city', 'multiple']) !!}		
							</div>
						</div>
						<div class="col-md-6 col-sm-12" style="margin:-5px 0;padding:0 10px;">
							<div class="form-group">
								<label style="font-size:13px;font-weight:500;">Area </label>
								<div class="input-group">
									<span class="input-group-addon">
									<i class="fa fa-map-marker"></i>
									</span>
									<input type="text" id="pref_locality"
							onblur="pref_loc_locality()" 
							name="p_localiy" class="form-control" placeholder="Select Local Area" disabled>
									
								</div>
								{!! Form::select('preferred_locality[]', [], null, ['id'=>'preferred_locality', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Area', 'multiple']) !!}		
							</div>
						</div>
					</div>
					<div class="row" style="margin:0;">
						<div class="col-md-12 col-sm-12 col-xs-12" style="margin:-5px 0;padding:0 10px;">
							<div class="form-group">
								<label style="font-size:13px;font-weight:500;">Skills</label>
								<div>
									<div style="position:relative;">
										<input type="text" name="name" id="newskill" class="form-control" placeholder="Search for skill...">
										<button id="add-new-skill" style="position:absolute;right:0;top:0;" class="btn btn-success" type="button"><i class="icon-plus"></i> Add</button>		
									</div>
									{!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="margin:0;">
						<div class="col-md-6 col-sm-6 col-xs-12" style="margin:-5px 0;padding:0 10px;">
							<label style="font-size:13px;font-weight:500;">Post Id</label>
							<div class="form-group">				
								<input type="text" name="unique_id" class="form-control " placeholder="Post Id" style="border: 1px solid darkcyan !important;"> 				
							</div>	
						</div> 
						<div class="col-md-6 col-sm-6 col-xs-12" style="padding:0 10px;">
							<label style="font-size:13px;font-weight:500;">Posted by</label>
							<div class="form-group">
								<select multiple="multiple" name="posted_by" placeholder="Select" class="SlectBox">
									<option selected value="individual">Individual</option>
									<option selected value="company">Company</option>
									<option selected value="consultancy">Consultancy</option>
							    </select>		
							</div>
				        </div>
				    </div>
					<div class="row" style="margin:0;">
						<div class="col-md-6 col-sm-6 col-xs-12" style="margin:-5px 0;padding:0 10px;">
				         	<div class="form-group">
					         	 <label style="font-size:13px;">
									<input type="checkbox" name="expired" checked class="icheck" data-checkbox="icheckbox_square-grey"> Do not include Expired Post
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer right">
				<label style="font-size:13px;float:left;margin: 5px 0;">
					<input type="checkbox" name="save filter" checked class="icheck" data-checkbox="icheckbox_square-grey"> Save Filter
				</label>
				<button type="submit" class="btn green">Filter</button>
			</div>
		</form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Jobtip Filter End-->
@elseif($title == 'favourite')
<!-- <div class="portlet light bordered col-md-9">
	<div class="portlet-title"> -->
		<div class="links-title" style="text-align: center; margin: 10px 0;">
			<i class="fa fa-star"></i>
			<span class="caption-subject font-blue-hoki bold capitalize">My Favourite Posts</span>
		</div>
	<!-- </div>
</div> -->
@elseif($title == 'postByUser')
<!-- <div class="portlet light bordered col-md-9">
	<div class="portlet-title"> -->
		<div class="links-title" style="text-align: center; margin: 10px 0;">
			<i class=""></i>
			<span class="caption-subject font-blue-hoki bold capitalize">Posts by "<span style="color: dimgrey;"> {{$postuser->firm_name}}{{$postuser->fname}} {{$postuser->lname}} </span>"</span>
		</div>
	<!-- </div>
</div> -->
@elseif($title == 'postInGroup')
<!-- <div class="portlet light bordered col-md-9">
	<div class="portlet-title"> -->
		<div class="links-title" style="text-align: center; margin: 10px 0;">
			<i class=""></i>
			<span class="caption-subject font-blue-hoki bold capitalize">Posts in Group "<span style="color: dimgrey;"> {{$groupUser->group_name}} </span>"</span>
		</div>
	<!-- </div>
</div> -->
@elseif($title == 'postId')
<!-- <div class="portlet light bordered col-md-9">
	<div class="portlet-title"> -->
		<div class="links-title" style="text-align: center; margin: 10px 0;">
			<i class=""></i>
			<span class="caption-subject font-blue-hoki bold capitalize">Posts Id "<span style="color: dimgrey;"> </span>"</span>
		</div>
	<!-- </div>
</div> -->
@endif