	
<div class="row post-item" >

	<div class="col-md-12 home-post">

		<div class="timeline" >
			<!-- TIMELINE ITEM -->
			<div class="timeline-item time-item-ex" itemscope itemtype="http://schema.org/Article">
				<div class="timeline-badge badge-margin">
					<img class="timeline-badge-userpic userpic-box demo" data-name="{{$userName}}" src="/img/profile/{{ $userImgPath }}" alt="logo" title="{{ $userName }}">
					
				</div>
				@include('partials.home.image-linked')
				@include('partials.home.favourite')
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
	                    <?php $postSkills = []; 
                            $postSkillArr = array_map('trim', explode(',', $post->linked_skill));
                            $userSkillArr = array_map('trim', explode(',', Auth::user()->induser->linked_skill));
                        ?>
                        <?php 
                            $matchedPost = array_intersect($postSkillArr, $userSkillArr);
                            $unmatchedPost = array_diff($postSkillArr, $userSkillArr);
                        ?>
	                    <div class="col-md-12">
	                        <div class=" capitalize" itemprop="name" style="font-size:13px;color:dimgrey !important;">
	                        @if($postType == 'job') <label class="label-success job-type-skill-css">{{$jobType}}</label>@endif <?php $skills = explode(',', $post->linked_skill) ?>                                                                                                                              
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
								<div class="match" style="float: left; margin: 0px 3px;">
									<a data-toggle="modal" data-mpostid="{{$post->id}}" 
										class="magic-font magicmatch-posts" href="#magicmatch-posts"
										 style="color: white;line-height: 1.7;text-decoration: none;"> 
										<button class="btn btn-success magic-match-css">
											<i class="icon-speedometer magic-font" style="font-size:12px;"></i> {{$magicMatch}} %
										</button>
									</a>
								</div>
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
