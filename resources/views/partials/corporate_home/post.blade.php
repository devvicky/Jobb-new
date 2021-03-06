
<div class="row post-item ">
	<div class="col-md-12 home-post">
		<div class="timeline" >
			<!-- TIMELINE ITEM -->
			<div class="timeline-item time-item" itemscope itemtype="http://schema.org/Article">
				@if($userImgPath != null && $post->individual_id != null)
				<div class="timeline-badge badge-margin">
					<img class="timeline-badge-userpic userpic-box"  src="/img/profile/{{ $userImgPath }}" alt="logo" title="{{ $userName }}">		
				</div>
				@elseif($userImgPath != null && $post->corporate_id != null)
				<div class="timeline-badge badge-margin">
					<img class="timeline-badge-userpic-corp userpic-box"  src="/img/profile/{{ $userImgPath }}" alt="logo" title="{{ $userName }}">
				</div>
				@elseif($userImgPath == null && $post->individual_id != null)
				<div class="timeline-badge badge-margin" style="border: 1px solid lightgray;border-radius: 23px;">
					<i class="fa fa-user" style="font-size:25px;margin: 14px 11.5px;color: lightgray;"></i>	
				</div>
				@elseif($userImgPath == null && $post->corporate_id != null)
				<div class="timeline-badge badge-margin" style="border: 1px solid lightgray;border-radius: 2px;">
					<i class="fa fa-university" style="font-size:25px;margin: 13px 8px;color: lightgray;"></i>	
				</div>
				@endif
				@include('partials.corporate_home.image-linked')
				<div class="post-hover-act" data-postid="{{$post->id}}">
					<!-- <a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts"> -->
					@if($postType == 'job')
	                	<a href="/job/post/{{$postId}}" target="_blank">
	                @elseif($postType == 'skill')
	                   <a href="/skill/post/{{$postId}}" target="_blank">
	                @endif
					<div class="row post-postision" style="cursor:pointer;">
	                    <div class="col-md-12">
	                        <div class="post-title-new capitalize" itemprop="name">
	                        	@if($userId != Auth::user()->induser_id && Auth::user()->identifier == 1)												
									@if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
									<!-- <div class="col-md-3 col-sm-3 col-xs-2">
									</div> -->
									@elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->apply == 1)
									<!-- <div class="col-md-3 col-sm-3 col-xs-2"  style="line-height: 1.9;">													 -->
										<i class="fa fa-check-square-o" style="font-size: 15px;color: #1C55C1;"></i>&nbsp;&nbsp;
									<!-- </div> -->
									@elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1)
									<!-- <div class="col-md-3 col-sm-3 col-xs-2"  style="line-height: 1.9;">													 -->
										<i class="fa fa-check-square-o" style="font-size: 15px;color: #1C55C1;"></i> &nbsp;&nbsp;
									<!-- </div> -->
									@endif
							    @endif 
	                        	{{ $postTitle }}</div>
	                    </div>
	                    @if($company != null)
	                    <div class="col-md-12" style="margin-bottom: 5px;">
	                        <div>
	                        	<small class="" style="font-size:13px;color:dimgrey !important;">
	                        		Required at {{ $company }}
	                        	</small>
	                        </div>
	                    </div>
	                    @endif

	                    <div class="col-md-12 col-sm-12 col-xs-12">
	                    	
	                        <div class=" capitalize" itemprop="name" style="font-size:13px;color:dimgrey !important;">
	                     @if($postType == 'job')  <label class="label-success job-type-skill-css">{{$jobType}}</label> @endif                                                                                                                             
                                                    <?php $postskill = explode(',', $post->linked_skill) ; ?>
                                                    @foreach($postskill as $skill)
                                                      <label class="label-success skill-label">{{$skill}}</label>
                                                    @endforeach
	                        </div>
	                    </div>
	               	</div>
	               	<div class="row post-postision" style="">
	               		
	                    @if($expMin != null && $postType == 'job')
	                    <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">
	                    	<small style="font-size:13px;color:dimgrey !important;"> 
	                    		<i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $expMin }} - {{ $expMax }} Yr
	                    	</small>
	                    </div>
	                    @elseif($expMin != null && $postType == 'skill')
	                    <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">
	                    	@if($expMin == 0)
	                    	<small style="font-size:13px;color:dimgrey !important;"> 
	                    		<i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: Fresher
	                    	</small>
	                    	@else
	                    	<small style="font-size:13px;color:dimgrey !important;"> 
	                    		<i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $expMin }} Yr
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
							@if($postType == 'skill')
							<div class="col-md-5 col-sm-5 col-xs-5" style="margin: 8px 1px;">
								@if($post->time_for == 'Work from Home')
								<small class="label-success label-xs elipsis-code job-type-skill-css" style="padding:2px 5px !important;">Work From Home</small>
								@else
								<div><small class="label-success job-type-skill-css" style="padding:2px 5px !important;">{{$jobType}}</small></div>
								@endif
							</div>
							@endif
							<div class="col-md-5 col-sm-5 col-xs-5" style="line-height: 1.9;">
								@if($postType == 'job')
				                	<a href="/job/post/{{$postId}}" target="_blank">
				                @elseif($postType == 'skill')
				                   <a href="/skill/post/{{$postId}}" target="_blank">
				                @endif
								<button class="btn btn-sm btn-primary view-detail-btn" style="border-radius: 25px !important;">View Detail</button>
								</a>
							</div>
							<div class="col-md-2 col-sm-2 col-xs-2" style="margin: 5px -12px;">
								@if(Auth::user()->induser_id != $post->individual_id )
								<form action="/job/fav" method="post" id="post-fav-{{$post->id}}" data-id="{{$post->id}}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="fav_post" value="{{ $post->id }}">

									<button class="btn fav-btn " type="button" 
											style="background-color: transparent;padding:0 10px;border:0">
										@if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
										<i class="fa fa-star" id="fav-btn-{{$post->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
										@elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->fav_post == 1) 
										<i class="fa fa-star" id="fav-btn-{{$post->id}}" style="font-size: 20px;color:#FFC823;"></i>
										@else
										<i class="fa fa-star" id="fav-btn-{{$post->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
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
