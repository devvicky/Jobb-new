@extends('welcome')

@section('content')

<div class="row ">
	<div class="tile-position welcome-post-content" style="height:56px;">
	<span id="changerificwordspanid" class="uppercase" style="font-size:18px;font-weight:200;">Do you know about any job openings</span>
	</div>
	<div class="tile-position-new">
		<div class="tile bg-red-intense">
			<div class="tile-body box-welcome" style="text-align:center;">
				<a href="/login">
					<img class="" src="/assets/admin/pages/media/bg/skill.png" style="width:90%;">
				</a>
				<!-- <i class="fa fa-gavel"></i> -->
			</div>
			<div class="tile-object" >
				<div class="name">
					 <a href="/login"></a>
				</div>
				<div class="number">
					 
				</div>
			</div>
		</div>
		<div class="tile bg-red-intense">
			<div class="tile-body" style="text-align:center;">
				<a href="/login">
					<img class="" src="/assets/admin/pages/media/bg/job.png" style="width:90%;">
				</a>
			</div>
			<div class="tile-object" >
				<div class="name">
					 <a href="/login"></a>
				</div>
				<div class="number">
					 
				</div>
			</div>
		</div>
	</div>
</div>
@if($title == 'Welcome')
<div class="row" style="margin: 0 -10px 0 5px !important;">
	<div class="col-md-2 col-sm-1"></div>
		<div class="col-md-8 col-sm-10">
		<form id="welcome-search" name="welcome_form" action="/welcome/post" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="col-md-5 col-sm-5" style="padding-left:0 !important;">
				<div class=" form-group">
					<div class="input-group">
						<span class="input-group-addon welcome-icon">
							<i class="fa fa-cogs"></i>
						</span>
						<input type="text" required name="role" id="search-input" class="form-control welcome-inputbox" placeholder="Enter Job role">
					</div>
				</div>		
			</div>
			
			<div id="welcome-city" class="col-md-4 col-sm-4 col-xs-12" style="padding-left:0 !important;">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon welcome-icon">
							<i class="fa fa-map-marker"></i>
						</span>
						<input type="text" name="location" class="form-control welcome-inputbox" placeholder="Enter Location">										
					</div>	
				</div>		
			</div>
			<div class="col-md-2 col-sm-3 col-xs-12" style="padding-left:0 !important;">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon welcome-icon">
							<i class="icon-briefcase"></i>
						</span>
						<select class="form-control welcome-inputbox" name="experience" placeholder="Experience">
							<option value=""> Experience </option>
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
					</div>
				</div>	
			</div>
			<div class="col-md-1 col-sm-12 col-xs-12" style="padding-left:0 !important;text-align:center;">
				<button type="submit" class="btn btn-small-welcome btn-search-welcome search-button-size" style="margin: -1px;">
					<i class="fa fa-search"></i> Search
				</button>
			</div>
		</form>
	</div> 
</div>
@endif
@if($title == 'welcome')
<div class="row show-credential" style="margin: 10px auto;display:table;">
	@if($role != null)
	<div class="col-md-12 col-sm-12 col-xs-12 capitalize " style="height:28px;padding:0;">
		<div class="welcome-search-type">
			<i class="fa fa-cogs"></i> : {{$role}}
		</div>
	</div>
	@endif
	@if($experience != null)
	<div class="col-md-12 col-sm-12 col-xs-12 capitalize " style="padding:0;">
		<div class="welcome-search-type">
			<i class="icon-briefcase"></i> : {{$experience}} Years
		</div>
	</div>
	@endif
	@if($city != null)
	<div class="col-md-12 col-sm-12 col-xs-12 capitalize " style="padding:0;">
		<div class="welcome-search-type">
			<i class="fa fa-map-marker"></i> : {{$city}} 
		</div>
	</div>
	@endif
</div>
<div class="row " style="margin: 10px auto;display:table;">
	<div class="col-md-12 col-sm-12 col-xs-12 show-welcome-detail" style="padding:0;">
		<button class="btn btn-sm blue" style="padding: 8px 28px;">Modify Search</button>
	</div>
</div>
<?php $selected = 'selected'; ?>
<div class="row welcome-detail" style="margin: 0 -10px 0 5px !important;">
	<div class="col-md-2 col-sm-1"></div>
		<div class="col-md-8 col-sm-10" style="padding:0;">
		<form id="welcome-searchs" name="welcome_form" action="/welcome/post" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="col-md-5 col-sm-5" style="padding-left:0 !important;">
				<div class=" form-group">
					<div class="input-group">
						<span class="input-group-addon welcome-icon">
							<i class="fa fa-cogs"></i>
						</span>
						<input type="text" required name="role" value="{{$role}}" id="search-input" class="form-control welcome-inputbox" placeholder="Enter Job role">
					</div>
				</div>		
			</div>
			
			<div id="welcome-city" class="col-md-4 col-sm-4" style="padding-left:0 !important;">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon welcome-icon">
							<i class="fa fa-map-marker"></i>
						</span>
						<input type="text" name="location" class="form-control welcome-inputbox" value="{{$city}}" placeholder="Enter Location">
					</div>	
				</div>		
			</div>
			<div class="col-md-2 col-sm-3 col-xs-12" style="padding-left:0 !important;">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon welcome-icon">
							<i class="icon-briefcase"></i>
						</span>
						<select class="form-control welcome-inputbox" name="experience" placeholder="Exp" value="{{$experience}}">
							<option value="">Experience</option>
							<option @if($experience=="0") {{ $selected }} @endif value="0">0</option>
							<option @if($experience=="1") {{ $selected }} @endif value="1">1</option>
							<option @if($experience=="2") {{ $selected }} @endif value="2">2</option>
							<option @if($experience=="3") {{ $selected }} @endif value="3">3</option>
							<option @if($experience=="4") {{ $selected }} @endif value="4">4</option>
							<option @if($experience=="5") {{ $selected }} @endif value="5">5</option>
							<option @if($experience=="6") {{ $selected }} @endif value="6">6</option>
							<option @if($experience=="7") {{ $selected }} @endif value="7">7</option>
							<option @if($experience=="8") {{ $selected }} @endif value="8">8</option>
							<option @if($experience=="9") {{ $selected }} @endif value="9">9</option>
							<option @if($experience=="10") {{ $selected }} @endif value="10">10</option>
							<option @if($experience=="11") {{ $selected }} @endif value="11">11</option>
							<option @if($experience=="12") {{ $selected }} @endif value="12">12</option>
							<option @if($experience=="13") {{ $selected }} @endif value="13">13</option>
							<option @if($experience=="14") {{ $selected }} @endif value="14">14</option>
							<option @if($experience=="15") {{ $selected }} @endif value="15">15</option>
						</select>
					</div>
				</div>	
			</div>
			<div class="col-md-1 col-sm-12 col-xs-12" style="padding-left:0 !important;text-align:center;">
				<button type="submit" class="btn btn-small-welcome btn-search-welcome search-button-size" style="margin: -1px;">
					<i class="fa fa-search"></i> Search
				</button>
			</div>
		</form>
	</div> 
</div>


<div class="tabbable-line" style="margin:7px;background-color: rgba(255,255,255,.15);">

	<ul class="nav nav-tabs nav-tabs-welcome" style="padding:0;display:table;margin:0 auto;">
		<li class="active">
			<a href="#tab_job" data-toggle="tab" style="font-size: 17px;">
				JOB
			</a>
		</li>
		<li>
			<a href="#tab_skill" data-toggle="tab" style="font-size: 17px;">
				SKILL	
			</a>
		</li>
	</ul>
	<div class="tab-content" style="background-color:transparent;">
		<div class="tab-pane active" id="tab_job">
			<div class="search-classic" style="">
				@foreach($jobPosts as $post)
				<div class="row" style="margin:10px 0;">
					<div class="col-md-2 col-sm-1"></div>
					<div class="col-md-7 col-sm-10" style="border-bottom:1px solid lightgrey;background: rgba(229, 229, 229, 0.51);">
						<div class="col-md-2 col-sm-3 col-xs-3">
							@if($post->induser != null && !empty($post->induser->profile_pic))
							<img class="timeline-badge-userpic welcome-userpic-box" src="/img/profile/{{ $post->induser->profile_pic }}" title="{{ $post->induser->fname }}">
							
							@elseif($post->corpuser != null && !empty($post->corpuser->logo_status))
							<img class="welcome-userpic-box" src="/img/profile/{{ $post->corpuser->logo_status }}" title="{{ $post->corpuser->firm_name }}">
							
							@elseif(empty($post->corpuser->logo_status) && $post->corpuser != null )
							<img class="welcome-userpic-box" src="/assets/images/corpnew.jpg">
							
							@elseif(empty($post->induser->profile_pic) && $post->induser != null)
							<img class="timeline-badge-userpic welcome-userpic-box" src="/assets/images/ab.png">
							@endif
						</div>
						<div class="col-md-6 col-sm-6 col-xs-9">
							@if($post->individual_id != null)
							<div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a href="/profile/ind/{{$post->individual_id}}" class="job-name-css" style="color: whitesmoke;">
                                        {{ $post->induser->fname}} {{ $post->induser->lname}}
                                    </a>
                                </div> 
                                <div class="col-md-6 col-sm-6 col-xs-8">
                                    <i class="fa fa-clock-o job-icon-color" style="font-size: 11px;"></i> 
                                    <small class="job-time-css" style="color:#676565 !important;">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</small>
                                </div>
                               <!--  <a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts">
			                        <div class="col-md-6 col-sm-6 col-xs-4" style="#676565 !important;">
			                           
			                        </div>
			                    </a> -->
			                     <div class="post-hover-act col-md-6" data-wpostid="{{$post->id}}"><a class="welcome-posts" data-toggle="modal" href="#welcome-posts">
			                     		Details
	                    		</div>
                            </div>
                            @elseif($post->corporate_id != null)
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a href="/profile/corp/{{$post->corporate_id}}" class="job-name-css">
                                        {{ $post->corpuser->firm_name}}
                                    </a>
                                </div>
                                <div class="col-md-6 col-md-6 col-xs-12">
                                	<span class="firm-type-left" style="margin: 2px 0;">{{ $post->corpuser->firm_type}}</span> 
									  
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-8">
                                    <i class="fa fa-clock-o job-icon-color" style="font-size: 11px;"></i> 
                                    <small class="job-time-css" style="color:#676565 !important;">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</small>
                                </div>
                                 
                            </div>
                            @endif
						</div>
						<div class="row post-postision" style="cursor:pointer;">
                        <div class="col-md-12">
                            <div class="post-title-new capitalize" style="color: whitesmoke;">{{ $post->post_title }} </div>
                        </div>
                        @if($post->post_compname != null && $post->post_type == 'job')
                        <div class="col-md-12">
                            <div><small class="capitalize" style="font-size:13px;color:#676565 !important">Required at {{ $post->post_compname }}</small></div>
                        </div>
                            
                        @endif
                   	</div>
                   	<div class="row post-postision" style="">
                                                        
                       <div class="col-md-6 col-sm-6 col-xs-6" style="">                                 
                        @if($post->min_exp != null)
                        <small style="font-size:13px;color:#676565 !important"> <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $post->min_exp}}-{{ $post->max_exp}} Yr</small>
                        @endif
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 elipsis-code elipsis-city-code" style="padding:0 12px;">
                        @if($post->city != null)
                        <small style="font-size:13px;color:#676565 !important;"> <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: 
                        	{{ $post->city }}
                        </small>
                        @endif
                        </div>
                    </div>
				</div>

			</div>
				
				@endforeach

			</div>
			@if(count($jobPosts) > 0)
			<div style="margin: 15px 25px;text-align:center;"><a href="/login">Show more Jobs</a></div>
			@else
			<div style="margin: 15px 25px;text-align:center;"><a href="/login">Search with other credential</a></div>
			@endif
		</div>
		<div class="tab-pane" id="tab_skill">
			<div class="search-classic" style="background: rgba(229, 229, 229, 0.51);">
				@foreach($skillPosts as $skill)
				<a href="/login">
				<div class="row" style="margin:10px 0;">
					<div class="col-md-2 col-sm-1"></div>
                    <div class="col-md-8 col-sm-10" style="border-bottom:1px solid lightgrey;">
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            @if($skill->induser != null && !empty($skill->induser->profile_pic))
                            <img class="timeline-badge-userpic welcome-userpic-box" src="/img/profile/{{ $skill->induser->profile_pic }}" title="{{ $skill->induser->fname }}">
                            
                            @elseif($skill->corpuser != null && !empty($skill->corpuser->logo_status))
                            <img class="welcome-userpic-box" src="/img/profile/{{ $skill->corpuser->logo_status }}" title="{{ $skill->corpuser->firm_name }}">
                            
                            @elseif(empty($skill->corpuser->logo_status) && $skill->corpuser != null )
                            <img class="welcome-userpic-box" src="/assets/images/corpnew.jpg">
                            
                            @elseif(empty($skill->induser->profile_pic) && $skill->induser != null)
                            <img class="timeline-badge-userpic welcome-userpic-box" src="/assets/images/ab.png">
                            @endif
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            @if($skill->individual_id != null)
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a href="/profile/ind/{{$skill->individual_id}}" class="job-name-css">
                                        {{ $skill->induser->fname}} {{ $skill->induser->lname}}
                                    </a>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 elipsis-code">
                                    <i class="fa fa-clock-o job-icon-color" style="font-size: 11px;"></i> 
                                    <small class="job-time-css">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($skill->created_at))->diffForHumans() }}</small>
                                </div>
                            </div>
                            @elseif($skill->corporate_id != null)
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a href="/profile/corp/{{$skill->corporate_id}}" class="job-name-css">
                                        {{ $skill->corpuser->firm_name}}
                                    </a>
                                </div>
                                <div class="col-md-4 col-md-4 col-xs-12">
                                    <span class="firm-type-left" style="margin: 2px 0;">{{ $skill->corpuser->firm_type}}</span> 
                                      
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                                    <i class="fa fa-clock-o job-icon-color" style="font-size: 11px;"></i> 
                                    <small class="job-time-css">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($skill->created_at))->diffForHumans() }}</small>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row post-postision" style="cursor:pointer;">
                        <div class="col-md-12">
                            <div class="post-title-new capitalize">{{ $skill->post_title }} </div>
                        </div>
                        @if($skill->post_compname != null && $skill->post_type == 'job')
                        <div class="col-md-12">
                            <div><small class="capitalize" style="font-size:13px;color:#BDBCBC !important">Required at {{ $skill->post_compname }}</small></div>
                        </div>
                            
                        @endif
                    </div>
                    
	                    <div class="row post-postision" style="">
	                       <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">                                 
	                        @if($skill->min_exp != null)
	                        <small style="font-size:13px;color:#BDBCBC !important"> <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $skill->min_exp}}-{{ $skill->max_exp}} Yr</small>
	                        @endif
	                        </div>
	                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code elipsis-city-code" style="padding:0 12px;">
	                        <small style="font-size:13px;color:#BDBCBC !important"> <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{ $skill->city }}</small>
	                        </div>
	                       
	                </div>
                    </div>

                </div>
                <div class="modal fade" id="" tabindex="-1" role="basic" aria-hidden="true">
					<div class="modal-dialog ">
						<div class="modal-content">
							<div id="myactivity-posts-content" >
								<div >
									<div class="row" style="margin: 6px 0px;">
						                <div class="col-md-12" style="text-align: center;background: lightblue;">
						                    @if($post->post_type == 'job')
						                    <label style="margin:2px 0;"> Job Details </label>
						                    @else($post->post_type == 'skill')
						                    <label style="margin:2px 0;"> Skill Details </label>
						                    @endif
						                </div>
						            </div>
							            <div class="row"> 
							                    <div class="timeline" >
							                        <!-- TIMELINE ITEM -->
							                        <div class="timeline-item">
							                           
							                             <div class="timeline-body" style=" margin-top:-9px;margin-left:13px;">
							                                <div class="timeline-body-head">
							                                    @if(  $post->individual_id != null)
							                                        <div class="timeline-body-head-caption" data-puid="{{  $post->individual_id}}">
							                                            
							                                                
							                                                
							                                                <a href="/profile/ind/{{  $post->individual_id}}" style="font-size: 15px;text-decoration:none;font-weight:600;">
							                                                    {{   $post->induser->fname}} {{   $post->induser->lname}}
							                                                </a>
							                                            
							                                               
							                                               
							                                            <span class="timeline-body-time font-grey-cascade">Posted at 
							                                                {{ date('M d, Y', strtotime(  $post->created_at)) }}
							                                            </span>
							                                        </div>
							                                    @elseif(  $post->corporate_id != null)
							                                        <div class="timeline-body-head-caption" data-puid="{{  $post->corporate_id}}">
							                                            
							                                                                                                   
							                                                <a href="/profile/corp/{{  $post->corporate_id}}" style="font-size: 15px;text-decoration:none;font-weight:600;">
							                                                    {{   $post->corpuser->firm_name}}
							                                                </a>
							                                            
							                                            <span class="timeline-body-time font-grey-cascade">Posted at 
							                                                {{ date('M d, Y', strtotime(  $post->created_at)) }}
							                                            </span>
							                                        </div>
							                                    @endif
							                                </div>
							                                
							                            </div>
							                                    <div class="portlet-body" style="margin: 0 -5px;">
							                                        <div class="panel-group accordion" id="accordion1" style="margin-bottom: 0;">
							                                            <div class="panel panel-default" style=" position: relative;border:0 !important;">
							                                                <div class="panel-heading" style="background-color: white;margin: 5px 0px;">
							                                                   <!--  <h4 class="panel-title">
							                                                    <a class="" 
							                                                    data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_1"  style="font-size: 15px;font-weight: 600;padding:0 16px;" >
							                                                    Details: </a>   
							                                                    </h4> -->
							                                                </div>
							                                                <div id="collapse_1_1" class="panel-collapse">
							                                                    <div class="panel-body" style="border-top: 0;padding: 4px 15px;">
							                                                        
							                                                        <div class="row">
							                                                             @if($post->post_type == 'job')
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">
							                                                                    <label class="detail-label">Job Title :</label>     
							                                                            </div>
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">
							                                                                     {{ $post->post_title }}     
							                                                            </div>
							                                                            @elseif($post->post_type == 'skill')
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">
							                                                                    <label class="detail-label">Skill Title :</label>     
							                                                            </div>
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">
							                                                                     {{ $post->post_title }}     
							                                                            </div>
							                                                            @endif
							                                                        </div>
							                                                        <div class="row">
							                                                            
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">
							                                                                    <label class="detail-label">Education :</label>     
							                                                            </div>
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">
							                                                                    {{ $post->education }}     
							                                                            </div>
							                                                        </div>
							                                                        
							                                                        <div class="row"> 
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                           
							                                                                    <label class="detail-label">Skills :</label>                                                                  
							                                                            </div>
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
							                                                                    @foreach($post->skills as $skill)
							                                                                        {{$skill->name}}
							                                                                    @endforeach
							                                                                 
							                                                            </div>
							                                                        </div>
							                                                        <div class="row"> 
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                           
							                                                                    <label class="detail-label">Job Type :</label>                                                                  
							                                                            </div>
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
							                                                                    {{ $post->time_for }}
							                                                            </div>
							                                                        </div>
							                                                        <div class="row"> 
							                                                            @if($post->locality != null && $post->city !=null)
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                           
							                                                                    <label class="detail-label">Locality :</label>                                                                  
							                                                            </div>
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
							                                                                    {{ $post->locality }},{{ $post->city }} 
							                                                            </div>
							                                                            @elseif($post->locality == null && $post->city !=null)
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                           
							                                                                    <label class="detail-label">Locality :</label>                                                                  
							                                                            </div>
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
							                                                                    {{ $post->city }} 
							                                                            </div>
							                                                            @endif
							                                                        </div>
							                                                        
							                                                         <div class="row">
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">
							                                                                    <label class="detail-label">Salary (<i class="fa fa-rupee (alias)"></i>):</label>
							                                                            </div>
							                                                            <div class="col-md-6 col-sm-6 col-xs-6">
							                                                                    {{ $post->min_sal }}-{{ $post->max_sal }} {{ $post->salary_type }}
							                                                            </div>
							                                                        </div>
							                                                        <?php 
							                                                            $strNew = '+'.$post->post_duration.' day';
							                                                            $strOld = $post->created_at;
							                                                            $fresh = $strOld->modify($strNew);

							                                                            $currentDate = new \DateTime();
							                                                            $expiryDate = new \DateTime($fresh);
							                                                            // $difference = $expiryDate->diff($currentDate);
							                                                            // $remainingDays = $difference->format('%d');
							                                                            if($currentDate >= $fresh){
							                                                                $expired = 1;
							                                                            }else{
							                                                                $expired = 0;
							                                                            }
							                                                        ?>
							                                                        <div class="skill-display">Description : </div>
							                                                        {{ $post->job_detail }}
							                                                        
							                                                        @if($post->post_type == 'job')
							                                                        <div class="skill-display">Reference Id&nbsp;: {{ $post->reference_id }} </div> 
							                                                        @endif

							                                                        <div style="margin:27px 0 0;">
							                                                            <!-- if corporate_id not null -->
						                                                            <!-- <form action="/job/apply" method="post" id="post-apply-{{$post->id}}" data-id="{{$post->id}}">   -->
						                                                                
						                                                                    <a class="btn apply-btn blue btn-sm apply-contact-btn show-contact" target="_blank" 
						                                                                        href="/login" type="button"><i class="icon-globe"></i> Apply
						                                                                    </a>    
						                                                            <!-- </form>  -->

							                                                        </div>
							                                                       @if($expired != 1 && $post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
							                                                        @elseif($expired != 1 && $post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1)
							                                                        <div  class="skill-display ">Contact Details : </div> 
							                                                        <div id="show-hide-contacts" class="row">
							                                                            @if($post->post_type == 'job' && $post->website_redirect_url != null)
							                                                            <div class="col-md-12 col-sm-12 col-xs-12">
							                                                                Click on Apply, it will redirect you to Company Website.
							                                                            </div>
							                                                            @endif
							                                                            @if($post->post_type == 'job' && $post->website_redirect_url != null && $post->corpuser != null)
							                                                            <div class="col-md-12 col-sm-12 col-xs-12">                                             
							                                                                <label class="detail-label"><i class="glyphicon glyphicon-globe" style="color: deepskyblue;"></i> :</label>
							                                                                {{ $post->website_url }}                                                            
							                                                            </div>
							                                                            @endif
							                                                            @if($post->website_redirect_url == null && $post->contact_person != null)
							                                                            <div class="col-md-12 col-sm-12 col-xs-12">                                             
							                                                                <label class="detail-label"><i class="glyphicon glyphicon-user"></i> :</label>
							                                                                {{ $post->contact_person }}                                                         
							                                                            </div>
							                                                            @endif

							                                                            @if($post->email_id != null && $post->alt_emailid != null && $post->website_redirect_url == null)
							                                                            <div class="col-md-12 col-sm-12 col-xs-12">
							                                                                
							                                                                    <label class="detail-label"><i class="glyphicon glyphicon-envelope"></i> :</label>                                                              
							                                                                    {{ $post->email_id }} - {{ $post->alt_emailid }}                            
							                                                            </div>  
							                                                            
							                                                            @elseif($post->email_id != null && $post->alt_emailid == null && $post->website_redirect_url == null)
							                                                            <div class="col-md-12 col-sm-12 col-xs-12">
							                                                                
							                                                                    <label class="detail-label"><i class="glyphicon glyphicon-envelope"></i> :</label>
							                                                                    {{ $post->email_id }}
							                                                                
							                                                            </div>
							                                                            @elseif($post->email_id == null && $post->alt_emailid != null && $post->website_redirect_url == null)
							                                                            <div class="col-md-12 col-sm-12 col-xs-12">
							                                                                
							                                                                    <label class="detail-label"><i class="glyphicon glyphicon-envelope"></i> :</label>
							                                                                        {{ $post->alt_emailid }}
							                                                                 
							                                                            </div>  
							                                                            @endif  
							                                                            @if($post->phone != null && $post->alt_phone != null && $post->website_redirect_url == null)
							                                                            <div class="col-md-12 col-sm-12 col-xs-12">
							                                                                
							                                                                    <label class="detail-label"><i class="glyphicon glyphicon-earphone"></i> :</label>
							                                                                
							                                                                    
							                                                                    {{ $post->phone }} - {{ $post->alt_phone }}
							                                                                 
							                                                            </div>  
							                                                            @elseif($post->phone != null && $post->alt_phone == null && $post->website_redirect_url == null)
							                                                            <div class="col-md-12 col-sm-12 col-xs-12">
							                                                                
							                                                                    <label class="detail-label"><i class="glyphicon glyphicon-earphone"></i> :</label>
							                                                                
							                                                                    
							                                                                    {{ $post->phone }}
							                                                                
							                                                            </div>
							                                                            @elseif($post->phone == null && $post->alt_phone != null && $post->website_redirect_url == null)
							                                                            <div class="col-md-12 col-sm-12 col-xs-12">
							                                                                
							                                                                    <label class="detail-label"><i class="glyphicon glyphicon-earphone"></i> :</label>
							                                                                
							                                                                        {{ $post->alt_phone }}
							                                                                
							                                                            </div>  
							                                                            @endif                                      
							                                                        </div>
							                                                        @endif
							                                                        <div class="skill-display">Post Id&nbsp;: {{ $post->unique_id }} </div>

							                                                        @if($expired != 1)
							                                                             <div class="skill-display">Post expires on:                                         
							                                                             <span class="btn-success" style="padding: 2px 8px;font-size: 12px;border-radius: 20px !important;">{{$fresh->format("d M Y")}}</span>
							                                                             </div>
							                                                         @else
							                                                             <div class="skill-display">Post expired on:                                         
							                                                             <span class="btn-danger" style="padding: 2px 8px;font-size: 12px;border-radius: 20px !important;">{{$fresh->format("d M Y")}}</span>
							                                                             </div>
							                                                        @endif
							                                                    </div>
							                                                </div>
							                                               
							                                                
							                                                               
							                                                
							                                            </div>
							                                        </div>
							                                    </div>
							                        </div>
							                    </div>
							                    
							             </div>
									</div>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
            </a>
				@endforeach
			</div>
			<div style="margin: 15px 25px;text-align:center;"><a href="/login">Show more Skills</a></div>
		</div>
	</div>
</div>

@endif

<div class="modal fade" id="welcome-posts" tabindex="-1" aria-hidden="true" style="padding-right:0;width:auto;margin-left:-300px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="welcome-posts-content" >
				<div style="text-align:center;">
					loading...
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@stop

@section('javascript')

<script type="text/javascript">

$(document).ready(function(){
	
    jQuery('.show-welcome-detail').on('click', function(event) {
	    jQuery('.welcome-detail').show();
	    jQuery('.show-welcome-detail').hide();
	    jQuery('.show-credential').hide();
    });
});

 (function(){

    // List your words here:
    var words = [
        'Searching for right job',
        'Add your skills here',
        'Do you know about any job openings',
        'post Job tip here',
        'Create a group of your friends',
        'share job info among your friends'
        ], i = 0;

    setInterval(function(){
        $('#changerificwordspanid').fadeOut(function(){
            $(this).html(words[i=(i+1)%words.length]).fadeIn();
        });
       // 2 seconds
    }, 3000);

})();

// Myactivity-post

$(document).ready(function(){
  $('.welcome-posts').on('click',function(event){  	    
    	event.preventDefault();
    	var post_id = $(this).parent().data('wpostid');
    	
    	// console.log(post_id);
      $.ajaxSetup({
  		headers: {
  			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		}
  	});

      $.ajax({
        url: "/welcome/postdetails",
        type: "post",
        data: {postid: post_id},
        cache : false,
        success: function(data){
      	$('#welcome-posts-content').html(data);
      	$('#welcome-posts').modal('show');
        }
      }); 
      return false;
  });
});

</script>

@stop