@extends('welcome')

@section('content')

<div class="row ">
	<div class="tile-position welcome-post-content" style="height:56px;">
	<span id="changerificwordspanid" class="uppercase" style="font-size:18px;font-weight:200;">Do you know about any job openings</span>
	</div>
	<div class="tile-position-new">
		<div class="tile bg-red-intense">
			<div class="tile-body box-welcome" style="text-align:center;">
				<img class="" src="/assets/admin/pages/media/bg/skill.png" style="width:90%;">
				<!-- <i class="fa fa-gavel"></i> -->
			</div>
			<div class="tile-object" >
				<div class="name">
					 <a href="/login">Add Skills</a>
				</div>
				<div class="number">
					 
				</div>
			</div>
		</div>
		<div class="tile bg-red-intense">
			<div class="tile-body" style="text-align:center;">
				<img class="" src="/assets/admin/pages/media/bg/job.png" style="width:90%;">
			</div>
			<div class="tile-object" >
				<div class="name">
					 <a href="/login"> Post Job tip</a>
				</div>
				<div class="number">
					 
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row" style="margin: 0 -10px 0 5px !important;">
	<div class="col-md-2 col-sm-1"></div>
		<div class="col-md-8 col-sm-10">
		<form id="welcome-search" name="welcome_form" action="/welcome/post" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="col-md-5 col-sm-5" style="padding-left:0 !important;">
				<div class=" form-group">
					<div class="input-group">
						<span class="input-group-addon" style="color:#83ADAD !important;border: 1px solid #83ADAD;border-right:0;background-color:rgba(149, 152, 152, 0.22);">
							<i class="fa fa-cogs"></i>
						</span>
						<input type="text" name="role" id="search-input" class="form-control" placeholder="Enter Job role" style="border-left:0;color:#83ADAD !important;border-color:#83ADAD;background-color:rgba(149, 152, 152, 0.22);">
					</div>
				</div>		
			</div>
			
			<div id="welcome-city" class="col-md-4 col-sm-4" style="padding-left:0 !important;">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon" style="color:#83ADAD !important;border: 1px solid #83ADAD;border-right:0;background-color:rgba(149, 152, 152, 0.22);">
							<i class="fa fa-map-marker"></i>
						</span>
						<input type="text" name="location" class="form-control" placeholder="Enter Location" style="border-left:0;color:#83ADAD !important;border-color: #83ADAD;background-color:rgba(149, 152, 152, 0.22);">										
					</div>	
				</div>		
			</div>
			<div class="col-md-2 col-sm-3 col-xs-6" style="padding-left:0 !important;">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon" style="color:#83ADAD !important;border: 1px solid #83ADAD;border-right:0;background-color:rgba(149, 152, 152, 0.22);">
							<i class="icon-briefcase"></i>
						</span>
						<select class="form-control" name="experience" placeholder="Exp" style="color:#83ADAD !important;border: 1px solid #83ADAD;border-left:0;background-color:rgba(149, 152, 152, 0.22);">
							<option value=""> Exp </option>
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
			<div class="col-md-1 col-sm-12 col-xs-6" style="padding-left:0 !important;text-align:center;">
				<button type="submit" class="btn btn-small-welcome btn-search-welcome">
					<i class="fa fa-search"></i> Search
				</button>
			</div>
		</form>
	</div> 
</div>
@if($title == 'welcome')
<div class="tabbable-line" style="margin:7px;">

	<ul class="nav nav-tabs " style="padding:0;display:table;margin:0 auto;">
		<li class="active">
			<a href="#tab_job" data-toggle="tab">Job 
				
			</a>
		</li>
		<li>
			<a href="#tab_skill" data-toggle="tab">Skill
				
			</a>
		</li>
	</ul>
	<div class="tab-content" style="background-color:transparent;">
		<div class="tab-pane active" id="tab_job">
			<div class="search-classic">
				@foreach($jobPosts as $post)
				<div class="row" style="margin:10px 0;">
					<div class="col-md-2 col-sm-1"></div>
					<div class="col-md-8 col-sm-10" style="border-bottom:1px solid lightgrey;">
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
			<div style="margin: 15px 25px;text-align:center;"><a href="/login">Show more Jobs</a></div>
			@else

			@endif
		</div>
		<div class="tab-pane" id="tab_skill">
			<div class="search-classic">
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
                        <div class="col-md-4 col-sm-4 col-xs-4 hide-details" style="float: right;right: -40px;bottom: 16px;">
                           Details
                        </div>
                       
                    </div>
                    </div>

                </div>
            </a>
				@endforeach
			</div>
			<div style="margin: 15px 25px;text-align:center;"><a href="/login">Show more Skills</a></div>
		</div>
	</div>
</div>
@endif
@stop

@section('javascript')

<script type="text/javascript">
 $(document).ready(function () {
    $('.show-city').click(function(event) {
    	 event.stopPropagation();
       $('#welcome-city').show();
       $('.show-city').hide();
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

</script>

@stop