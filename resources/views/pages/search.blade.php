@extends('master')

@section('css')
<style type="text/css">
.nav-tabs > li > a, .nav-pills > li > a {font-size: 14px;}
.search-classic h4 {margin-bottom: 3px;}
</style>
@stop

@section('content')
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title" style="margin:15px;">

{{$title}} <small>results</small>
</h3>
<!-- END PAGE HEADER-->

<?php $activeTab = '1' ?>
@if(count($searchResultForInd) > 0)
<?php $activeTab = '1' ?>
@elseif(count($searchResultForCorp) > 0 && count($searchResultForCorp) > count($searchResultForInd))
<?php $activeTab = '2' ?>
@elseif(count($searchResultForJob) > 0 && count($searchResultForJob) > count($searchResultForCorp))
<?php $activeTab = '3' ?>
@elseif(count($searchResultForSkill) > 0 && count($searchResultForSkill) > count($searchResultForJob))
<?php $activeTab = '4' ?>
@endif

<div class="row search-form-default" style="margin:15px;">

	<div class="col-md-6">
		<form class="search-form" action="/search/" method="GET">
			<div class="input-group" style="margin: 0 0 15px 0;">
				<div class="input-cont">
					<input type="text" class="form-control" placeholder="Search..." value="{{$searchQuery}}" 
							name="query" pattern=".{3,}" required title="3 characters minimum"
	                 		autocomplete="off">
				</div>
				<span class="input-group-btn">
				<button type="submit" class="btn green-haze">
				Search &nbsp; <i class="m-icon-swapright m-icon-white"></i>
				</button>
				</span>
			</div>
		</form>
	</div>
</div>

<div class="tabbable-line" style="margin:7px;">

	<ul class="nav nav-tabs " style="padding:0">
		<li>
			<a href="#tab_ind" data-toggle="tab">Individual
				@if(count($searchResultForInd) > 0)
					<span class="badge" style="background-color: deepskyblue;">{{count($searchResultForInd)}}</span>
				@endif 
			</a>
		</li>
		<li>
			<a href="#tab_corp" data-toggle="tab">Corporate
				@if(count($searchResultForCorp) > 0)
					<span class="badge" style="background-color: deepskyblue;">{{count($searchResultForCorp)}}</span>
				@endif 
			</a>
		</li>
		<li>
			<a href="#tab_job" data-toggle="tab">Job 
				@if(count($searchResultForJob) > 0)
					<span class="badge" style="background-color: deepskyblue;">{{count($searchResultForJob)}}</span>
				@endif
			</a>
		</li>
		<li>
			<a href="#tab_skill" data-toggle="tab">Skill
				 @if(count($searchResultForSkill) > 0)
					<span class="badge" style="background-color: deepskyblue;">{{count($searchResultForSkill)}}</span>
				@endif
			</a>
		</li>
	</ul>
	<div class="tab-content">

		<div class="tab-pane active" id="tab_ind">
			<div class="search-classic">
				<p>About {{count($searchResultForInd)}} results for "{{$searchQuery}}"</p>		
				@foreach($searchResultForInd as $ind)
				@if($ind->user->email_verify == 1 || $ind->user->mobile_verify == 1)
				<div class="row search-user-tool" style="margin:0;">
				<div class="col-md-7">					
						<div class="col-md-2 col-sm-3 col-xs-3">
							<a href="#">
						        <img class="media-object img-circle" 
						        src="@if($ind->profile_pic != null){{ '/img/profile/'.$ind->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" 
						      	alt="DP" style="width:70%">
						     </a>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							 <a href="/profile/ind/{{$ind->id}}" data-utype="ind" style="font-size:15px;">
						     {{ $ind->fname }} {{ $ind->lname }}</a><br>
						    <small>
                            
					        @if($ind->working_status == "Student")
                            
                                 {{ $ind->education }} in {{ $ind->branch }}, {{ $ind->city }}
                            
                            @elseif($ind->working_status == "Searching Job")
                            
                                 {{ $ind->working_status }} in {{ $ind->prof_category }}, {{ $ind->city }}
                            
                            @elseif($ind->working_status == "Freelanching")
                            
                                 {{ $ind->role }} {{ $ind->working_status }}, {{ $ind->city }}
                            
                            @elseif($ind->role != null && $ind->working_at !=null && $ind->working_status == "Working")
                            
                                 {{ $ind->role }} @ {{ $ind->working_at }} 
                        
                            @elseif($ind->role != null && $ind->working_at ==null && $ind->working_status == "Working")
                            
                                 {{ $ind->role }}, {{ $ind->city }}
                            
                            @elseif($ind->role == null && $ind->working_at !=null && $ind->working_status == "Working")
                            
                                 {{ $ind->woring_at }}, {{ $ind->city }}
                            
                            @elseif($ind->role == null && $ind->working_at ==null && $ind->working_status == "Working")
                            
                               {{ $ind->prof_category }}, {{ $ind->city }}
                           
                            @endif
						      </small>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3" style="margin:7px 0">
								@if($links->contains('id', $ind->individual_id) )
								<a href="#links-follow" data-toggle="modal" class="user-link" data-linked="yes" data-utype="ind">
									<button class="btn btn-xs link-follow-icon-css"><i class="fa fa-link (alias) icon-size" style="color:white;"></i> Linked</button>
								</a>
								@elseif($linksPending->contains('id', $ind->individual_id) )
								<a href="#links-follow" data-toggle="modal" class="user-link" data-linked="no" data-utype="ind">
									<button class="btn btn-xs linkrequest-follow-icon-css"><i class="icon-hourglass (alias) " style="color:dimgrey;font-size:10px;"></i> Link Requested</button>
								</a>
								@elseif($linksApproval->contains('id', $ind->individual_id) )
								<a href="#links-follow " data-toggle="modal" class="user-link" data-linked="no" data-utype="ind">
									<button class="btn btn-xs linkrequest-follow-icon-css"><i class=" icon-hourglass (alias) " style="color:dimgrey;font-size:10px;"></i> Link Requested</button>
								</a>
								
								@else
								<a href="#links-follow" data-toggle="modal" class="user-link3" data-linked="no" data-utype="ind">
									<button class="btn btn-xs unlink-follow-icon-css"><i class="fa fa-unlink (alias) icon-size" style="color:dimgrey;"></i> Add Link</button>
								</a>
								@endif
							</div>	    
					</div>
				</div>
				@endif
				@endforeach

				<?php echo $searchResultForInd->fragment('tab_tab_ind')->render(); ?>
				
			</div>
			<div style="margin: 15px 25px;"><a href="/links">Go to advance Search</a> </div>
		</div>
		<div class="tab-pane" id="tab_corp">
			<div class="search-classic">
				<p>About {{count($searchResultForCorp)}} results for "{{$searchQuery}}"</p>

				@foreach($searchResultForCorp as $corp)
				@if($corp->user->email_verify == 1 || $corp->user->mobile_verify == 1)
				<div class="row search-user-tool" style="margin:0;">
						<div class="col-md-7">		
							<div class="col-md-2 col-sm-2 col-xs-3">
								<a href="#">
							        <img class="media-object" style="width:100%" src="@if($corp->logo_status != null){{ '/img/profile/'.$corp->logo_status }}@else{{'/assets/images/corpnew.jpg'}}@endif" alt="DP" style="width:60px">
							    </a>
							</div>
							<div class="col-md-5 col-sm-6 col-xs-6">
								<a href="/profile/corp/{{$corp->id}}" class="link-label" data-utype="corp">
							    		 		{{ $corp->firm_name }}
							    		 	</a>
							    		 	 <small>{{ $corp->firm_type }}</small><br>

								
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3" style="margin:7px 0">
						 		
							</div>
					   </div> 
					</div>
					@endif
				@endforeach

				<?php echo $searchResultForCorp->fragment('tab_tab_corp')->render(); ?>
			</div>
			<div id="show" style="margin: 15px 25px;"><a href="/links">Go to advance Search</a></div>
		</div>
		<div class="tab-pane" id="tab_job">
			<div class="search-classic">
				

				@foreach($searchResultForJob as $job)
				<div class="row" style="margin:0;">
					<div class="col-md-7" style="border-bottom:1px solid lightgrey;">
						<div class="col-md-3 col-sm-3 col-xs-3">
							@if($job->induser != null && !empty($job->induser->profile_pic))
							<img class="timeline-badge-userpic userpic-box" src="/img/profile/{{ $job->induser->profile_pic }}" title="{{ $job->induser->fname }}">
							
							@elseif($job->corpuser != null && !empty($job->corpuser->logo_status))
							<img class="" src="/img/profile/{{ $job->corpuser->logo_status }}" title="{{ $job->corpuser->firm_name }}">
							
							@elseif(empty($job->corpuser->logo_status) && $job->corpuser != null )
							<img class="" src="/assets/images/corpnew.jpg">
							
							@elseif(empty($job->induser->profile_pic) && $job->induser != null)
							<img class="timeline-badge-userpic userpic-box" src="/assets/images/ab.png">
							@endif
						</div>
						<div class="col-md-9 col-sm-9 col-xs-9">
							@if($job->individual_id != null)
							<div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a href="/profile/ind/{{$job->individual_id}}" class="job-name-css">
                                        {{ $job->induser->fname}} {{ $job->induser->lname}}
                                    </a>
                                </div>
                                
                                	@if($job->individual_id != null && Auth::user()->induser_id != $job->individual_id && Auth::user()->identifier == 1)
										<div class="col-md-4 col-md-4 col-xs-6">
										<div class="" data-puid="{{$job->individual_id}}" style="margin:4px 0;">
											@if($links->contains('id', $job->individual_id) )
											<a href="#links-follow" data-toggle="modal" class="user-link" data-linked="yes" data-utype="ind">
												<button class="btn btn-xs link-follow-icon-css"><i class="fa fa-link (alias) icon-size" style="color:white;"></i> Linked</button>
											</a>
											@elseif($linksPending->contains('id', $job->individual_id) )
											<a href="#links-follow" data-toggle="modal" class="user-link" data-linked="no" data-utype="ind">
												<button class="btn btn-xs linkrequest-follow-icon-css"><i class="icon-hourglass (alias) " style="color:dimgrey;font-size:10px;"></i> Link Requested</button>
											</a>
											@elseif($linksApproval->contains('id', $job->individual_id) )
											<a href="#links-follow " data-toggle="modal" class="user-link" data-linked="no" data-utype="ind">
												<button class="btn btn-xs linkrequest-follow-icon-css"><i class=" icon-hourglass (alias) " style="color:dimgrey;font-size:10px;"></i> Link Requested</button>
											</a>
											@elseif($following->contains('id', $job->individual_id))
											<a href="#links-follow" class="user-link2" data-toggle="modal" data-linked="yes" data-utype="ind">
												<button class="btn btn-xs link-follow-icon-css"><i class="fa fa-link (alias) icon-size" style="color:white;"></i></button>
											</a>
											@else
											<a href="#links-follow" data-toggle="modal" class="user-link3" data-linked="no" data-utype="ind">
												<button class="btn btn-xs unlink-follow-icon-css"><i class="fa fa-unlink (alias) icon-size" style="color:dimgrey;"></i> Add Link</button>
											</a>
											@endif
										</div>
                                	</div>
                                @endif
                                <div class="col-md-4 col-sm-4 col-xs-6 elipsis-code">
                                    <i class="fa fa-clock-o job-icon-color" style="font-size: 11px;"></i> 
                                    <small class="job-time-css">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($job->created_at))->diffForHumans() }}</small>
                                </div>
                            </div>
                            @elseif($job->corporate_id != null)
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a href="/profile/corp/{{$job->corporate_id}}" class="job-name-css">
                                        {{ $job->corpuser->firm_name}}
                                    </a>
                                </div>
                                <div class="col-md-4 col-md-4 col-xs-12">
                                	<span class="firm-type-left" style="margin: 2px 0;">{{ $job->corpuser->firm_type}}</span> 
									<span class="follow-icon-right" data-puid="{{$job->corporate_id}}">
											@if($following->contains('id', $job->corporate_id))
											<a href="#links-follow" data-toggle="modal" class="user-link" data-linked="yes" data-utype="corp">
												<button class="btn btn-xs link-follow-icon-css"><i class="icon-check icon-size" style="color:white;"></i> Following</button>
											</a>
										@else
											<a href="#links-follow" data-toggle="modal" class="user-link3" data-linked="no" data-utype="corp">
												<button class="btn btn-xs unlink-follow-icon-css"><i class="icon-plus icon-size" style="color:dimgrey;"></i> Follow</button>
											</a>
										@endif
									</span>    
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                                    <i class="fa fa-clock-o job-icon-color" style="font-size: 11px;"></i> 
                                    <small class="job-time-css">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($job->created_at))->diffForHumans() }}</small>
                                </div>
                            </div>
                            @endif
						</div>
						<div class="row post-postision" style="cursor:pointer;">
                        <div class="col-md-12">
                            <div class="post-title-new capitalize">{{ $job->post_title }} </div>
                        </div>
                        @if($job->post_compname != null && $job->post_type == 'job')
                        <div class="col-md-12">
                            <div><small class="capitalize" style="font-size:13px;color:dimgrey !important;">Required at {{ $job->post_compname }}</small></div>
                        </div>
                            
                        @endif
                        <div class="col-md-12">
                            <div class=" capitalize">Skill: {{ $job->linked_skill }} </div>
                        </div>
                   	</div>
                   	<a href="/job/post/{{$job->unique_id}}">
	                   	<div class="row post-postision" style="">
	                                                        
	                        @if($job->min_exp != null)
	                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">
	                        <small style="font-size:13px;color:dimgrey !important;"> <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $job->min_exp}}-{{ $job->max_exp}} Yr</small>
	                        </div>
	                        @endif
	                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code elipsis-city-code" style="padding:0 12px;">
	                        <small style="font-size:13px;color:dimgrey !important;"> <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{ $job->city }}</small>
	                        </div>
	                        <a href="/job/post/{{$job->unique_id}}" target="_blank" class="" >
		                        <div class="col-md-6 col-sm-6 col-xs-4" style="#676565 !important;">
		                           Details
		                        </div>
		                    </a>
	                       
	                    </div>
	                </a>
				</div>

			</div>
				
				@endforeach

				<?php echo $searchResultForJob->fragment('tab_tab_job')->render(); ?>
			</div>
			<div style="margin: 15px 25px;"><a href="/home">Show more Jobs</a></div>
		</div>
		<div class="tab-pane" id="tab_skill">
			<div class="search-classic">
				@foreach($searchResultForSkill as $skill)
				<div class="row" style="margin:0;">
                    <div class="col-md-7" style="border-bottom:1px solid lightgrey;">
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            @if($skill->induser != null && !empty($skill->induser->profile_pic))
                            <img class="timeline-badge-userpic userpic-box" src="/img/profile/{{ $skill->induser->profile_pic }}" title="{{ $skill->induser->fname }}">
                            
                            @elseif($skill->corpuser != null && !empty($skill->corpuser->logo_status))
                            <img class="" src="/img/profile/{{ $skill->corpuser->logo_status }}" title="{{ $skill->corpuser->firm_name }}">
                            
                            @elseif(empty($skill->corpuser->logo_status) && $skill->corpuser != null )
                            <img class="" src="/assets/images/corpnew.jpg">
                            
                            @elseif(empty($skill->induser->profile_pic) && $skill->induser != null)
                            <img class="timeline-badge-userpic userpic-box" src="/assets/images/ab.png">
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
                                
                                    @if($skill->individual_id != null && Auth::user()->induser_id != $skill->individual_id && Auth::user()->identifier == 1)
                                        <div class="col-md-4 col-md-4 col-xs-6">
                                        <div class="" data-puid="{{$skill->individual_id}}" style="margin:4px 0;">
                                            @if($links->contains('id', $skill->individual_id) )
                                            <a href="#links-follow" data-toggle="modal" class="user-link" data-linked="yes" data-utype="ind">
                                                <button class="btn btn-xs link-follow-icon-css"><i class="fa fa-link (alias) icon-size" style="color:white;"></i> Linked</button>
                                            </a>
                                            @elseif($linksPending->contains('id', $skill->individual_id) )
                                            <a href="#links-follow" data-toggle="modal" class="user-link" data-linked="no" data-utype="ind">
                                                <button class="btn btn-xs linkrequest-follow-icon-css"><i class="icon-hourglass (alias) " style="color:dimgrey;font-size:10px;"></i> Link Requested</button>
                                            </a>
                                            @elseif($linksApproval->contains('id', $skill->individual_id) )
                                            <a href="#links-follow " data-toggle="modal" class="user-link" data-linked="no" data-utype="ind">
                                                <button class="btn btn-xs linkrequest-follow-icon-css"><i class=" icon-hourglass (alias) " style="color:dimgrey;font-size:10px;"></i> Link Requested</button>
                                            </a>
                                            @elseif($following->contains('id', $skill->individual_id))
                                            <a href="#links-follow" class="user-link2" data-toggle="modal" data-linked="yes" data-utype="ind">
                                                <button class="btn btn-xs link-follow-icon-css"><i class="fa fa-link (alias) icon-size" style="color:white;"></i></button>
                                            </a>
                                            @else
                                            <a href="#links-follow" data-toggle="modal" class="user-link3" data-linked="no" data-utype="ind">
                                                <button class="btn btn-xs unlink-follow-icon-css"><i class="fa fa-unlink (alias) icon-size" style="color:dimgrey;"></i> Add Link</button>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
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
                                    <span class="follow-icon-right" data-puid="{{$skill->corporate_id}}">
                                            @if($following->contains('id', $skill->corporate_id))
                                            <a href="#links-follow" data-toggle="modal" class="user-link" data-linked="yes" data-utype="corp">
                                                <button class="btn btn-xs link-follow-icon-css"><i class="icon-check icon-size" style="color:white;"></i> Following</button>
                                            </a>
                                        @else
                                            <a href="#links-follow" data-toggle="modal" class="user-link3" data-linked="no" data-utype="corp">
                                                <button class="btn btn-xs unlink-follow-icon-css"><i class="icon-plus icon-size" style="color:dimgrey;"></i> Follow</button>
                                            </a>
                                        @endif
                                    </span>    
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
                            <div><small class="capitalize" style="font-size:13px;color:dimgrey !important;">Required at {{ $skill->post_compname }}</small></div>
                        </div>
                            
                        @endif
                    </div>
                    <a href="/skill/post/{{$skill->unique_id}}">
	                    <div class="row post-postision" style="">
	                                                        
	                        @if($skill->min_exp != null)
	                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">
	                        <small style="font-size:13px;color:dimgrey !important;"> <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $skill->min_exp}}-{{ $skill->max_exp}} Yr</small>
	                        </div>
	                        @endif
	                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code elipsis-city-code" style="padding:0 12px;">
	                        <small style="font-size:13px;color:dimgrey !important;"> <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{ $skill->city }}</small>
	                        </div>
	                        <a href="/skill/post/{{$skill->unique_id}}" target="_blank">
		                        <div class="col-md-6 col-sm-6 col-xs-4" style="#676565 !important;">
		                           Details
		                        </div>
		                    </a>
	                       
	                    </div>
	                </a>
                    </div>

                </div>
                
				@endforeach

				<?php echo $searchResultForSkill->fragment('tab_tab_skill')->render(); ?>
			</div>
			<div style="margin: 15px 25px;"><a href="/home#skill">Show more Skills</a></div>
		</div>
	</div>
</div>

@stop

@section('javascript')
<script type="text/javascript">
	if (location.hash !== '') {
    	$('.nav-tabs a[href="' + location.hash.replace('tab_','') + '"]').tab('show');
	} else {
	    $('.nav-tabs li:nth-child({{$activeTab}}) a').tab('show');
	}

	$('.nav-tabs a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
	      window.location.hash = 'tab_'+  e.target.hash.substr(1) ; 
	      return false;
	});


	   
</script>

@stop

