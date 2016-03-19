@extends('privacy-policy-term-condition')

@section('content')

@if($title == 'welcome')
<div class="row show-credential" style="text-align:center;margin: 70px 0 0px 0;">
	@if($role != null)
	<div class="col-md-12 col-sm-12 col-xs-12 capitalize " style="padding:0;">
		<div class="welcome-search-type">
			 {{$role}} | {{$experience}} Years | {{$city}} 
		</div>
	</div>
	@endif
</div>
<div class="row " style="margin: 10px auto;display:table;">
	<div class="col-md-12 col-sm-12 col-xs-12 show-welcome-detail" style="padding:0;">
		<button class="btn btn-sm blue" style="padding: 5px 10px;
    background-color: #00DA89;
    font-size: 15px;
    color: white;">
			Modify Search
		</button>
	</div>
</div>
<?php $selected = 'selected'; ?>
<div class="row welcome-detail" style="margin: 70px -10px 0 5px !important;">
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
			
			<div id="welcome-city" class="col-md-4 col-sm-4 col-xs-6" style="padding-left:0 !important;">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon welcome-icon">
							<i class="fa fa-map-marker"></i>
						</span>
						<input type="text" name="location" class="form-control welcome-inputbox" value="{{$city}}" placeholder="City">
					</div>	
				</div>		
			</div>
			<div class="col-md-2 col-sm-3 col-xs-6" style="padding-left:0 !important;">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon welcome-icon">
							<i class="icon-briefcase"></i>
						</span>
						<select class="form-control welcome-inputbox" name="experience" placeholder="Exp" value="{{$experience}}">
							<option value="">Exp (in Years)</option>
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
					<div class="col-md-7 col-sm-10" style="border-bottom:1px solid lightgrey;background: rgba(229, 229, 229, 0.51);padding:0;">
						<div class="col-md-2 col-sm-3 col-xs-3" style="margin: 10px 0 0 0;">
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
						<div class="col-md-6 col-sm-6 col-xs-9" style="margin: 10px 0 0 0;">
							@if($post->individual_id != null)
							<div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a href="/profile/ind/{{$post->individual_id}}" class="job-name-css" style="color: ;">
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
                            <div class="post-title-new capitalize" style="color:;">{{ $post->post_title }} </div>
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
                    <div class="row" style="border-top: 1px solid lightgrey;margin: 10px 0px 0px 0;">
                    	<a href="/login"><div class="col-md-3 col-sm-3 col-xs-3" style="text-align:center;line-height: 2;">
                    		<i class="fa fa-thumbs-up" style="color:darkseagreen;font-size: 20px; margin: 9px 0;"></i>
                    	</div></a>
                    	<a href="/login"><div class="col-md-6 col-sm-6 col-xs-6" style="text-align:center;margin: 5px 0;">
                    		<button class="btn blue" style="padding: 2px 20px;">Apply</button>
                    	</div></a>
						<a href="/login"><div class="col-md-3 col-sm-3 col-xs-3" style="text-align:center;line-height: 2;">
                    		<i class="fa fa-share-square-o" style="color:darkslateblue;font-size: 20px; margin: 9px 0;"></i>
                    	</div></a>
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
		<div class="tab-pane active" id="tab_skill">
			<div class="search-classic" style="">
				@foreach($skillPosts as $post)
				<div class="row" style="margin:10px 0;">
					<div class="col-md-2 col-sm-1"></div>
					<div class="col-md-7 col-sm-10" style="border-bottom:1px solid lightgrey;background: rgba(229, 229, 229, 0.51);padding:0;">
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
                                    <a href="/profile/ind/{{$post->individual_id}}" class="job-name-css" style="color: ;">
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
                            <div class="post-title-new capitalize" style="color:;">{{ $post->post_title }} </div>
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
                    <div class="row" style="border-top: 1px solid lightgrey;margin: 10px 0px 0px 0;">
                    	<a href="/login"><div class="col-md-3 col-sm-3 col-xs-3" style="text-align:center;line-height: 2;">
                    		<i class="fa fa-thumbs-up" style="color:darkseagreen;font-size: 20px; margin: 9px 0;"></i>
                    	</div></a>
                    	<a href="/login"><div class="col-md-6 col-sm-6 col-xs-6" style="text-align:center;margin: 5px 0;">
                    		<button class="btn green" style="padding: 2px 20px;">Contact</button>
                    	</div></a>
						<a href="/login"><div class="col-md-3 col-sm-3 col-xs-3" style="text-align:center;line-height: 2;">
                    		<i class="fa fa-share-square-o" style="color:darkslateblue;font-size: 20px; margin: 9px 0;"></i>
                    	</div></a>
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
      	// $('#welcome-posts').modal('show');
        }
      }); 
      return false;
  });
});

</script>

@stop
