	
<div class="row post-item" >

	<div class="col-md-12 home-post">

		<div class="timeline" >
			<!-- TIMELINE ITEM -->
			<div class="timeline-item time-item-ex" itemscope itemtype="http://schema.org/Article">
				<div class="timeline-badge badge-margin">
					@if(!empty($userImgPath))
					<img class="timeline-badge-userpic userpic-box" src="/img/profile/{{ $userImgPath }}" alt="logo" title="{{ $userName }}">
					@else
					<img class="timeline-badge-userpic userpic-box" src="/assets/images/ab.png" alt="logo" title="{{ $userName }}">
					@endif
				</div>
				@include('partials.home.image-linked')
				@if($postType == 'skill')
					@include('partials.home.favourite')
				@endif
				<div class="post-hover-act" data-postid="{{$post->id}}">
					<!-- <a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts"> -->
					@if($postType == 'job')
	                	<a href="/job/post/{{$postId}}" target="_blank">
	                @elseif($postType == 'skill')
	                   <a href="/skill/post/{{$postId}}" target="_blank">
	                @endif	
					<div class="row post-postision" style="cursor:pointer;">
	                    <div class="col-md-12">
	                        <div class="post-title-new capitalize" itemprop="name">{{ $postTitle }}</div>
	                    </div>
	                    @if($company != null)
	                    <div class="col-md-12">
	                        <div>
	                        	<small class="capitalize" style="font-size:13px;color:dimgrey !important;">
	                        		Required at {{ $company }}
	                        	</small>
	                        </div>
	                    </div>
	                    @endif
	                    <div class="col-md-12">
	                        <div class=" capitalize" itemprop="name" style="font-size:13px;color:dimgrey !important;">
	                        	Skills : {{$skill}}
	                        </div>
	                    </div>
	               	</div>
	               	
	               	<div class="row post-postision" style="">
	                    @if($expMin != null)
	                    <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">
	                    	<small style="font-size:13px;color:dimgrey !important;"> 
	                    		<i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $expMin }} - {{ $expMax }} Yr
	                    	</small>
	                    </div>
	                    @endif
	                    <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code elipsis-city-code" style="padding:0 12px;">
	                    	<small style="font-size:13px;color:dimgrey !important;"> 
	                    		<i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{ $city or 'Unspecified' }}
	                    	</small>
	                    </div>    
	                    <div class="col-md-4 col-sm-4 col-xs-4 hide-details" style="float: right;right: -40px;bottom: 16px;">
	                       Details
	                    </div>
	                </div>
	                </a>
	            </div>
				<div class="row" style="margin: 5px 0px; border-top: 1px solid whitesmoke;">
					<div class="col-md-12" style="margin: 3px -13px;">
						<div class="row" style="">
							@if($postType == 'job')	
							<div class="col-md-3 col-sm-3 col-xs-3">
								
							</div>
							@elseif($postType == 'skill')
							<div class="col-md-3 col-sm-3 col-xs-4" style="margin: 4px 0px;">
								@if($post->time_for == 'Work from Home')
								<small class="label-success label-xs elipsis-code job-type-skill-css" style="">Work From Home</small>
								@else
								<div><small class="label-success label-xs job-type-skill-css">{{$post->time_for}}</small></div>
								@endif
							</div>
							@endif
							<div class="col-md-3 col-sm-3 col-xs-5">
								<i class="glyphicon glyphicon-ban-circle" style="font-size:12px;color:dimgrey;"></i> Post Expired
							</div>
							@if($userId != Auth::user()->induser_id && Auth::user()->identifier == 1)												
								@if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
								<div class="col-md-3 col-sm-3 col-xs-2">
								</div>
								@elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->apply == 1)
								<div class="col-md-3 col-sm-3 col-xs-2"  style="">													
									<i class="fa fa-check-square-o" style="font-size:13px;"></i><span style="font-size:12px;" class="applied-css hidden-sm hidden-xs"> Applied</span> 
								</div>
								@elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1)
								<div class="col-md-3 col-sm-3 col-xs-2"  style="">													
									<i class="fa fa-check-square-o" style="font-size:13px;"></i><span style="font-size:12px;" class="hidden-sm hidden-xs"> Contacted</span> 
								</div>
								@else
								<div class="col-md-3 col-sm-3 col-xs-2">
								</div>
								@endif
							@endif
								
							</div>
						</div>																							
					</div>											
				</div>
			</div>

		</div>
	</div>
		<!-- END TIMELINE ITEM -->
