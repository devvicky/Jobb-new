@extends('welcome')

@section('content')

<div class="tabbable-line" style="margin:7px;">

	<ul class="nav nav-tabs " style="padding:0">
		<li class="active">
			<a href="#tab_job" data-toggle="tab">Job 
				@if(count($jobPosts) > 0)
				<span class="badge" style="background-color: deepskyblue;">{{count($jobPosts)}}</span>
				@endif
			</a>
		</li>
		<li>
			<a href="#tab_skill" data-toggle="tab">Skill
				@if(count($skillPosts) > 0)
				<span class="badge" style="background-color: deepskyblue;">{{count($skillPosts)}}</span>
				@endif
			</a>
		</li>
	</ul>
	<div class="tab-content" style="background-color:transparent;">
		<div class="tab-pane active" id="tab_job">
			<div class="search-classic">
				@foreach($jobPosts as $post)
				<div class="row" style="margin:10px 0;">
					<div class="col-md-7" style="border-bottom:1px solid lightgrey;">
						<div class="col-md-3 col-sm-3 col-xs-3">
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
						<div class="col-md-9 col-sm-9 col-xs-9">
							@if($post->individual_id != null)
							<div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a href="/profile/ind/{{$post->individual_id}}" class="job-name-css">
                                        {{ $post->induser->fname}} {{ $post->induser->lname}}
                                    </a>
                                </div> 
                                <div class="col-md-4 col-sm-4 col-xs-6 elipsis-code">
                                    <i class="fa fa-clock-o job-icon-color" style="font-size: 11px;"></i> 
                                    <small class="job-time-css">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</small>
                                </div>
                            </div>
                            @elseif($post->corporate_id != null)
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a href="/profile/corp/{{$post->corporate_id}}" class="job-name-css">
                                        {{ $post->corpuser->firm_name}}
                                    </a>
                                </div>
                                <div class="col-md-4 col-md-4 col-xs-12">
                                	<span class="firm-type-left" style="margin: 2px 0;">{{ $post->corpuser->firm_type}}</span> 
									  
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                                    <i class="fa fa-clock-o job-icon-color" style="font-size: 11px;"></i> 
                                    <small class="job-time-css">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</small>
                                </div>
                            </div>
                            @endif
						</div>
						<div class="row post-postision" style="cursor:pointer;">
                        <div class="col-md-12">
                            <div class="post-title-new capitalize">{{ $post->post_title }} </div>
                        </div>
                        @if($post->post_compname != null && $post->post_type == 'job')
                        <div class="col-md-12">
                            <div><small class="capitalize" style="font-size:13px;color:#BDBCBC !important">Required at {{ $post->post_compname }}</small></div>
                        </div>
                            
                        @endif
                   	</div>
                   	<div class="row post-postision" style="">
                                                        
                       <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">                                 
                        @if($post->min_exp != null)
                        <small style="font-size:13px;color:#BDBCBC !important"> <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $post->min_exp}}-{{ $post->max_exp}} Yr</small>
                        @endif
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code elipsis-city-code" style="padding:0 12px;">
                        <small style="font-size:13px;color:#BDBCBC !important"> <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{ $post->city }}</small>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 hide-details" style="float: right;right: -40px;bottom: 16px;">
                           Details
                        </div>
                       
                    </div>
					</div>

				</div>
				
				@endforeach

			</div>
			@if(count($jobPosts) > 0)
			<div style="margin: 15px 25px;"><a href="/login">Show more Jobs</a></div>
			@else

			@endif
		</div>
		<div class="tab-pane" id="tab_skill">
			<div class="search-classic">
				@foreach($skillPosts as $skill)
				<a href="/login">
				<div class="row" style="margin:10px 0;">
                    <div class="col-md-7" style="border-bottom:1px solid lightgrey;">
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
                        <div class="col-md-4 col-sm-4 col-xs-4 hide-details" style="float: right;right: -40px;bottom: 16px;">
                           Details
                        </div>
                       
                    </div>
                    </div>

                </div>
            </a>
				@endforeach
			</div>
			<div style="margin: 15px 25px;"><a href="/login">Show more Skills</a></div>
		</div>
	</div>
</div>

@stop