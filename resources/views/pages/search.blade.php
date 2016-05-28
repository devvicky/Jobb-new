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
			<a href="#tab_ind" data-toggle="tab">People
				@if(count($searchResultForInd) > 0)
					<span class="badge" style="background-color: deepskyblue;">{{count($searchResultForInd)}}</span>
				@endif 
			</a>
		</li>
		<li>
			<a href="#tab_corp" data-toggle="tab">Company
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
	<div class="tab-content" style="background-color:transparent;">

		<div class="tab-pane active" id="tab_ind">
			<div class="search-classic">

				<p>About {{count($searchResultForInd)}} results for "{{$searchQuery}}"</p>		
				@foreach($searchResultForInd as $ind)
				
					
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
				
				@endforeach

				<?php echo $searchResultForInd->fragment('tab_tab_ind')->render(); ?>
				
			</div>
			<div style="margin: 15px 25px;"><a href="/links">Go to advance Search</a> </div>
		</div>
		<div class="tab-pane" id="tab_corp">
			<div class="search-classic">
				<p>About {{count($searchResultForCorp)}} results for "{{$searchQuery}}"</p>

				@foreach($searchResultForCorp as $corp)
				
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
				@endforeach

				<?php echo $searchResultForCorp->fragment('tab_tab_corp')->render(); ?>
			</div>
			<div id="show" style="margin: 15px 25px;"><a href="/links">Go to advance Search</a></div>
		</div>
		<div class="tab-pane" id="tab_job">
			<div class="search-classic">
				

				@foreach($searchResultForJob as $job)
				
<div class="row post-item ">
    <div class="col-md-7 home-post">
        <div class="timeline" >
            <!-- TIMELINE ITEM -->
            <div class="timeline-item time-item" itemscope itemtype="http://schema.org/Article">
                @if($job->induser->profile_pic != null && $job->individual_id != null)
                <div class="timeline-badge badge-margin">
                    <img class="timeline-badge-userpic userpic-box"  src="/img/profile/{{ $job->induser->profile_pic }}" alt="logo">      
                </div>
                @elseif($job->induser->profile_pic == null && $job->individual_id != null)
                <div class="timeline-badge badge-margin" style="border: 1px solid lightgray;border-radius: 23px;">
                    <i class="fa fa-user" style="font-size:25px;margin: 14px 11.5px;color: lightgray;"></i> 
                </div>
                @endif
                <div class="post-hover-act" data-postid="{{$job->id}}">
                    <!-- <a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts"> -->
                    @if($job->post_type == 'job')
                        <a href="/job/post/{{$job->unique_id}}" target="_blank">
                    @elseif($job->post_type == 'skill')
                       <a href="/skill/post/{{$job->unique_id}}" target="_blank">
                    @endif
                    <div class="row post-postision" style="cursor:pointer;">
                        <div class="col-md-12">
                            <div class="post-title-new capitalize" itemprop="name">
                                @if($job->individual_id != Auth::user()->induser_id && Auth::user()->identifier == 1)                                               
                                    @if($job->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-2">
                                    </div> -->
                                    @elseif($job->postactivity->where('user_id', Auth::user()->id)->first()->apply == 1)
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-2"  style="line-height: 1.9;">                                                     -->
                                        <i class="fa fa-check-square-o" style="font-size: 15px;color: #1C55C1;"></i>&nbsp;&nbsp;
                                    <!-- </div> -->
                                    @elseif($job->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1)
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-2"  style="line-height: 1.9;">                                                     -->
                                        <i class="fa fa-check-square-o" style="font-size: 15px;color: #1C55C1;"></i> &nbsp;&nbsp;
                                    <!-- </div> -->
                                    @endif
                                @endif 
                                {{ $job->post_title }}</div>
                        </div>
                        @if($job->post_compname != null)
                        <div class="col-md-12" style="margin-bottom: 5px;">
                            <div>
                                <small class="" style="font-size:13px;color:dimgrey !important;">
                                    Required at {{ $job->post_compname }}
                                </small>
                            </div>
                        </div>
                        @endif
                        <?php $jobSkills = []; 
			                            $jobSkillArr = array_map('trim', explode(',', $job->linked_skill));
			                            $userSkillArr = array_map('trim', explode(',', Auth::user()->induser->linked_skill));
			                        ?>
			                        <?php 
			                            $matchedPost = array_intersect($jobSkillArr, $userSkillArr);
			                            $unmatchedPost = array_diff($jobSkillArr, $userSkillArr);
			                        ?>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            
                            <div class=" capitalize" itemprop="name" style="font-size:13px;color:dimgrey !important;">
                         @if($job->post_type == 'job')  <label class="label-success job-type-skill-css">{{$job->post_type}}</label> @endif                                                                                                                             
                                                    @foreach($matchedPost as $m)
                                                        <label class="label-success matched-skill-css">{{$m}}</label>
                                                    @endforeach
                                                    @foreach($unmatchedPost as $um)
                                                      <label class="label-success skill-label">{{$um}}</label>
                                                    @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row post-postision" style="">
                        
                        @if($job->min_exp != null && $job->post_type == 'job')
                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">
                            <small style="font-size:13px;color:dimgrey !important;"> 
                                <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $job->min_exp }} Yr
                            </small>
                        </div>
                        @elseif($job->min_exp != null && $job->post_type == 'skill')
                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">
                            @if($job->min_exp == 0)
                            <small style="font-size:13px;color:dimgrey !important;"> 
                                <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: Fresher
                            </small>
                            @else
                            <small style="font-size:13px;color:dimgrey !important;"> 
                                <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $job->min_exp }} Yr
                            </small>
                            @endif
                        </div>
                        @endif
                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code elipsis-city-code" style="padding:0 12px;">
                            <small style="font-size:13px;color:dimgrey !important;"> 
                                <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{ $city or 'unspecified'}}
                            </small>
                        </div>    
                       
                    </div>
                    </a>
                </div>
                <?php 
                        $tempMatch = 0;
                        if($job->min_exp <= Auth::user()->induser->experience && $job->max_exp >= Auth::user()->induser->experience){
                            $tempMatch = $tempMatch + 1;
                        }

                        if(strcasecmp($job->role, Auth::user()->induser->role) == 0){
                            $tempMatch = $tempMatch + 1;
                        }

                        if($job->time_for == Auth::user()->induser->prefered_jobtype){
                            $tempMatch = $tempMatch + 1;
                        }

                        if($job->magic_match >= 65 && $tempMatch == 3){
                            $match = "ExcellentMatch";
                        }elseif($job->magic_match >= 65 && $tempMatch != 3){
                            $match = "GoodMatch";
                        }elseif($job->magic_match < 65 && $job->magic_match >= 35 && $tempMatch == 3){
                            $match = "GoodMatch";
                        }elseif($job->magic_match < 65 && $job->magic_match >= 35 && $tempMatch != 3){
                            $match = "QuickCheck";
                        }elseif($job->magic_match < 35){
                            $match = "QuickCheck";
                        }

                     ?>
                <div class="row" style="margin: 5px 0px;">
                    <div class="col-md-12" style="margin: 3px -13px;">
                        <div class="row" style="">
                            @if($job->post_type == 'job') 
                            @if($match == 'GoodMatch')
								<div class="col-md-5 col-sm-5 col-xs-5">
									<a data-toggle="modal" data-mpostid="{{$job->id}}" 
										class="magic-font magicmatch-posts" href="#magicmatch-posts"
										 style="color: white;line-height: 1.7;text-decoration: none;"> 
										 <div class="ribbon ribbon-shadow ribbon-color-good uppercase">
									<i class="icon-speedometer magic-font" style="font-size:10px;"></i> &nbsp;Good Match</div>
									</a>
								</div>
								@elseif($match == 'ExcellentMatch')
								<div class="col-md-5 col-sm-5 col-xs-5">
									<a data-toggle="modal" data-mpostid="{{$job->id}}" 
										class="magic-font magicmatch-posts" href="#magicmatch-posts"
										 style="color: white;line-height: 1.7;text-decoration: none;"> 
										 <div class="ribbon ribbon-shadow ribbon-color-excellent uppercase">
									<i class="icon-speedometer magic-font" style="font-size:10px;"></i> &nbsp;Excellent Match</div>
									</a>
								</div>
								@elseif($match == 'QuickCheck')
								<div class="col-md-5 col-sm-5 col-xs-5">
									<a data-toggle="modal" data-mpostid="{{$job->id}}" 
										class="magic-font magicmatch-posts" href="#magicmatch-posts"
										 style="color: white;line-height: 1.7;text-decoration: none;"> 
										 <div class="ribbon ribbon-shadow ribbon-color-quick uppercase">
									<i class="icon-speedometer magic-font" style="font-size:10px;"></i> &nbsp;Quick Look</div>
									</a>
								</div>
								@endif
                            @elseif($job->post_type == 'skill')
                            <div class="col-md-5 col-sm-5 col-xs-5" style="margin: 8px 1px;">
                                @if($job->time_for == 'Work from Home')
                                <small class="label-success label-xs elipsis-code job-type-skill-css" style="padding:2px 5px !important;">Work From Home</small>
                                @else
                                <div><small class="label-success job-type-skill-css" style="padding:2px 5px !important;">{{$jobType}}</small></div>
                                @endif
                            </div>
                            @endif
                            <div class="col-md-5 col-sm-5 col-xs-5" style="line-height: 1.9;">
                                @if($job->post_type == 'job')
                                    <a href="/job/post/{{$job->unique_id}}" target="_blank">
                                @elseif($job->post_type == 'skill')
                                   <a href="/skill/post/{{$job->unique_id}}" target="_blank">
                                @endif
                                <button class="btn btn-sm btn-primary view-detail-btn" style="border-radius: 25px !important;">View Detail</button>
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2" style="margin: 5px -12px;">
                                @if(Auth::user()->induser_id != $job->individual_id )
                                <form action="/job/fav" method="post" id="post-fav-{{$job->id}}" data-id="{{$job->id}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="fav_post" value="{{ $job->id }}">

                                    <button class="btn fav-btn " type="button" 
                                            style="background-color: transparent;padding:0 10px;border:0">
                                        @if($job->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                        <i class="fa fa-star" id="fav-btn-{{$job->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
                                        @elseif($job->postactivity->where('user_id', Auth::user()->id)->first()->fav_post == 1) 
                                        <i class="fa fa-star" id="fav-btn-{{$job->id}}" style="font-size: 20px;color:#FFC823;"></i>
                                        @else
                                        <i class="fa fa-star" id="fav-btn-{{$job->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
                                        @endif  
                                    </button>   
                                </form>
                                @endif
                            </div>  
                        </div>
                    </div>                                                                                          
                </div>                                          
            </div>
        </div>
    </div>
</div>
        <!-- END TIMELINE ITEM -->
				@endforeach

				<?php echo $searchResultForJob->fragment('tab_tab_job')->render(); ?>
			</div>
			<div style="margin: 15px 25px;"><a href="/home">Show more Jobs</a></div>
		</div>
		<div class="tab-pane" id="tab_skill">
			<div class="search-classic">
				@foreach($searchResultForSkill as $skill)
				<div class="row post-item ">
    <div class="col-md-7 home-post">
        <div class="timeline" >
            <!-- TIMELINE ITEM -->
            <div class="timeline-item time-item" itemscope itemtype="http://schema.org/Article">
                @if($skill->induser->profile_pic != null && $skill->individual_id != null)
                <div class="timeline-badge badge-margin">
                    <img class="timeline-badge-userpic userpic-box"  src="/img/profile/{{ $skill->induser->profile_pic }}" alt="logo">      
                </div>
                @elseif($skill->induser->profile_pic == null && $skill->individual_id != null)
                <div class="timeline-badge badge-margin" style="border: 1px solid lightgray;border-radius: 23px;">
                    <i class="fa fa-user" style="font-size:25px;margin: 14px 11.5px;color: lightgray;"></i> 
                </div>
                @endif
                <div class="post-hover-act" data-postid="{{$skill->id}}">
                    <!-- <a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts"> -->
                    @if($skill->post_type == 'job')
                        <a href="/job/post/{{$skill->unique_id}}" target="_blank">
                    @elseif($skill->post_type == 'skill')
                       <a href="/skill/post/{{$skill->unique_id}}" target="_blank">
                    @endif
                    <div class="row post-postision" style="cursor:pointer;">
                        <div class="col-md-12">
                            <div class="post-title-new capitalize" itemprop="name">
                                @if($skill->individual_id != Auth::user()->induser_id && Auth::user()->identifier == 1)                                               
                                    @if($skill->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-2">
                                    </div> -->
                                    @elseif($skill->postactivity->where('user_id', Auth::user()->id)->first()->apply == 1)
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-2"  style="line-height: 1.9;">                                                     -->
                                        <i class="fa fa-check-square-o" style="font-size: 15px;color: #1C55C1;"></i>&nbsp;&nbsp;
                                    <!-- </div> -->
                                    @elseif($skill->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1)
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-2"  style="line-height: 1.9;">                                                     -->
                                        <i class="fa fa-check-square-o" style="font-size: 15px;color: #1C55C1;"></i> &nbsp;&nbsp;
                                    <!-- </div> -->
                                    @endif
                                @endif 
                                {{ $skill->post_title }}</div>
                        </div>
                        @if($skill->post_compname != null)
                        <div class="col-md-12" style="margin-bottom: 5px;">
                            <div>
                                <small class="" style="font-size:13px;color:dimgrey !important;">
                                    Required at {{ $skill->post_compname }}
                                </small>
                            </div>
                        </div>
                        @endif
                        <?php $skillSkills = []; 
                                        $skillSkillArr = array_map('trim', explode(',', $skill->linked_skill));
                                        $userSkillArr = array_map('trim', explode(',', Auth::user()->induser->linked_skill));
                                    ?>
                                    <?php 
                                        $matchedPost = array_intersect($skillSkillArr, $userSkillArr);
                                        $unmatchedPost = array_diff($skillSkillArr, $userSkillArr);
                                    ?>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            
                            <div class=" capitalize" itemprop="name" style="font-size:13px;color:dimgrey !important;">
                         @if($skill->post_type == 'job')  <label class="label-success job-type-skill-css">{{$skill->post_type}}</label> @endif                                                                                                                             
                                                    @foreach($matchedPost as $m)
                                                        <label class="label-success matched-skill-css">{{$m}}</label>
                                                    @endforeach
                                                    @foreach($unmatchedPost as $um)
                                                      <label class="label-success skill-label">{{$um}}</label>
                                                    @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row post-postision" style="">
                        
                        @if($skill->min_exp != null && $skill->post_type == 'job')
                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">
                            <small style="font-size:13px;color:dimgrey !important;"> 
                                <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $skill->min_exp }} Yr
                            </small>
                        </div>
                        @elseif($skill->min_exp != null && $skill->post_type == 'skill')
                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">
                            @if($skill->min_exp == 0)
                            <small style="font-size:13px;color:dimgrey !important;"> 
                                <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: Fresher
                            </small>
                            @else
                            <small style="font-size:13px;color:dimgrey !important;"> 
                                <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $skill->min_exp }} Yr
                            </small>
                            @endif
                        </div>
                        @endif
                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code elipsis-city-code" style="padding:0 12px;">
                            <small style="font-size:13px;color:dimgrey !important;"> 
                                <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{ $city or 'unspecified'}}
                            </small>
                        </div>    
                       
                    </div>
                    </a>
                </div>
                <div class="row" style="margin: 5px 0px;">
                    <div class="col-md-12" style="margin: 3px -13px;">
                        <div class="row" style="">
                            @if($skill->post_type == 'job') 
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                
                            </div>
                            @elseif($skill->post_type == 'skill')
                            <div class="col-md-5 col-sm-5 col-xs-5" style="margin: 8px 1px;">
                                @if($skill->time_for == 'Work from Home')
                                <small class="label-success label-xs elipsis-code job-type-skill-css" style="padding:2px 5px !important;">Work From Home</small>
                                @else
                                <div><small class="label-success job-type-skill-css" style="padding:2px 5px !important;">{{$skill->time_for}}</small></div>
                                @endif
                            </div>
                            @endif
                            <div class="col-md-5 col-sm-5 col-xs-5" style="line-height: 1.9;">
                                @if($skill->post_type == 'job')
                                    <a href="/job/post/{{$skill->unique_id}}" target="_blank">
                                @elseif($skill->post_type == 'skill')
                                   <a href="/skill/post/{{$skill->unique_id}}" target="_blank">
                                @endif
                                <button class="btn btn-sm btn-primary view-detail-btn" style="border-radius: 25px !important;">View Detail</button>
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2" style="margin: 5px -12px;">
                                @if(Auth::user()->induser_id != $skill->individual_id )
                                <form action="/job/fav" method="post" id="post-fav-{{$skill->id}}" data-id="{{$skill->id}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="fav_post" value="{{ $skill->id }}">

                                    <button class="btn fav-btn " type="button" 
                                            style="background-color: transparent;padding:0 10px;border:0">
                                        @if($skill->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                        <i class="fa fa-star" id="fav-btn-{{$skill->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
                                        @elseif($skill->postactivity->where('user_id', Auth::user()->id)->first()->fav_post == 1) 
                                        <i class="fa fa-star" id="fav-btn-{{$skill->id}}" style="font-size: 20px;color:#FFC823;"></i>
                                        @else
                                        <i class="fa fa-star" id="fav-btn-{{$skill->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
                                        @endif  
                                    </button>   
                                </form>
                                @endif
                            </div>  
                        </div>
                    </div>                                                                                          
                </div>                                          
            </div>
        </div>
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
<script src="/assets/js/home-js.js"></script>
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

