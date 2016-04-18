<div class="row post-item" >
	<div class="col-md-12 home-post">
		<div class="timeline" >
			<!-- TIMELINE ITEM -->
			<div class="timeline-item time-item" itemscope itemtype="http://schema.org/Article">
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
	                        	<small class="" style="font-size:13px;color:dimgrey !important;">
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
	                    <!-- <div class="col-md-3 col-sm-3 col-xs-12">
	                    	<div><small class="label-success label-xs job-type-skill-css">{{$jobType}}</small></div>
	                    </div> -->
	                    <div class="col-md-12 col-sm-12 col-xs-12">
	                        <div class=" capitalize" itemprop="name" style="font-size:13px;color:dimgrey !important;">
	                     @if($postType == 'job')  <label class="label-success job-type-skill-css">{{$jobType}}</label> @endif                                                                                                                             
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
	                    		<i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{ $city or 'unspecified'}}
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
							<div class="col-md-3 col-sm-3 col-xs-3" style="margin: 5px 0;">
								<div class="match" style="float: left; margin: 0px 3px;">
									<a data-toggle="modal" data-mpostid="{{$post->id}}" 
										class="magic-font magicmatch-posts btn btn-success magic-match-css" href="#magicmatch-posts"
										 style="color: white;line-height: 1.7;text-decoration: none;">
										<i class="icon-speedometer magic-font" style="font-size:12px;"></i> {{$magicMatch}} %
									</a>
								</div>
							</div>
							@elseif($postType == 'skill')
							<div class="col-md-3 col-sm-3 col-xs-4" style="margin: 4px 13px;">
								@if($post->time_for == 'Work from Home')
								<small class="label-success label-xs elipsis-code job-type-skill-css" style="padding:2px 5px !important;">Work From Home</small>
								@else
								<div><small class="label-success job-type-skill-css" style="padding:2px 5px !important;">{{$jobType}}</small></div>
								@endif
							</div>
							@endif
							@if($postType == 'job')
							<div class="col-md-2 col-sm-2 col-xs-3" style="padding:2px 20px;">
								<form action="/job/like" method="post" id="post-like-{{$post->id}}" data-id="{{$post->id}}">						
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="like" value="{{ $post->id }}">
							<button class="btn like-btn like-btn-css"  type="button" style="" title="Thanks">
								@if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())					
									 <i class="fa fa-thumbs-up thanks-icon" id="like-{{$post->id}}"></i>
								@elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->thanks == 1) 

									 <i class="fa fa-thumbs-up thanks-icon" id="like-{{$post->id}}" style="color:#337ab7;"></i>

								@else
									 <i class="fa fa-thumbs-up thanks-icon" id="like-{{$post->id}}"></i>		
								@endif
							</button>
							@elseif($postType == 'skill')
							<div class="col-md-2 col-sm-2 col-xs-2" style="padding:2px 20px;margin: 0 15px 0 -15px;">
								<form action="/job/like" method="post" id="post-like-{{$post->id}}" data-id="{{$post->id}}">						
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="like" value="{{ $post->id }}">
							<button class="btn like-btn like-btn-css"  type="button" style="" title="Thanks">
								@if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())					
									 <i class="fa fa-thumbs-up thanks-icon" id="like-{{$post->id}}"></i>
								@elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->thanks == 1) 

									 <i class="fa fa-thumbs-up thanks-icon" id="like-{{$post->id}}" style="color:#337ab7;"></i>

								@else
									 <i class="fa fa-thumbs-up thanks-icon" id="like-{{$post->id}}"></i>		
								@endif
							</button>
							@endif
							<!-- <label  style="color:burlywood">Thanks </label>	 -->
									<span class="badge-like" id="like-count-{{ $post->id }}">
									@if($post->postactivity->sum('thanks') > 0)
									{{ $post->postactivity->sum('thanks') }}
									@endif
									</span>
								</form>	
							</div>
							@if($userId != Auth::user()->induser_id && Auth::user()->identifier == 1)
							 @if($post->corporate_id != null && Auth::user()->id != $post->individual_id &&  Auth::user()->identifier == 1)     
                                        @if($post->postactivity->where('user_id', Auth::user()->induser_id)->isEmpty())
                                        <div class="col-md-3 col-sm-5 col-xs-5" style="margin:3px 0;">
                                            <form action="/job/apply" method="post" id="post-apply-{{$post->id}}" data-id="{{$post->id}}">  
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="apply" value="{{ $post->id }}">
                                                @if($post->website_redirect_url != null)
                                                    <button class="btn apply-btn blue btn-sm apply-contact-btn" 
                                                        onclick="window.location='{{ $post->website_redirect_url }}';"   type="button">Apply
                                                    </button>   
                                                @else
                                                    <button class="btn apply-btn blue btn-sm apply-contact-btn" 
                                                            id="apply-btn-{{$post->id}}" type="button">Apply
                                                    </button>
                                                    @endif
                                            </form> 
                                        </div>
                                        @elseif($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->apply == 1 && Auth::user()->identifier == 1) 
                                            <div class="col-md-3 col-sm-5 col-xs-5" style="margin:3px 0;">
                                                <button type="button" class="btn btn-sm bg-grey-steel apply-contact-btn">
                                                    <i class="fa fa-check-square-o" style="font-size:13px;"></i><span style="font-size:12px;" class="applied-css hidden-xs"> Applied</span> 
                                                </button>
                                            </div>
                                        @else
                                        <div class="col-md-3 col-sm-5 col-xs-5" style="margin:3px 0;">
	                                        <form action="/job/apply" method="post" id="post-apply-{{$post->id}}" data-id="{{$post->id}}">  
	                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                                            <input type="hidden" name="apply" value="{{ $post->id }}">
	                                            <button class="btn apply-btn blue btn-sm apply-contact-btn" 
	                                                    id="apply-btn-{{$post->id}}" type="button">Apply
	                                            </button>
	                                        </form>  
                                        </div>                       
                                        @endif
                                    
                                    @endif  
                                    @if($post->individual_id != null && Auth::user()->id != $post->individual_id)       
                                        @if($post->postactivity->where('user_id', Auth::user()->induser_id)->isEmpty())
                                            <div class="col-md-3 col-sm-5 col-xs-5" style="margin:3px 0;">
	                                            <form action="/job/contact" method="post" id="post-contact-{{$post->id}}" data-id="{{$post->id}}">  
	                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                                                <input type="hidden" name="contact" value="{{ $post->id }}">
	                                                <button class="btn contact-btn green btn-sm apply-contact-btn" 
	                                                        id="contact-btn-{{$post->id}}" type="button">Contact
	                                                </button>
	                                            </form> 
	                                        </div>
                                        @elseif($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->contact_view == 1) 
                                             <div class="col-md-3 col-sm-5 col-xs-5" style="margin:3px 0;">
                                                <button type="button" class="btn btn-sm bg-grey-steel apply-contact-btn">
                                                    <i class="fa fa-check-square-o" style="font-size:13px;"></i><span style="font-size:12px;" class=" hidden-xs"> Contacted</span> 
                                                </button>
                                            </div>
                                            
                                            @else
                                            <div class="col-md-3 col-sm-5 col-xs-5" style="margin:3px 0;">
	                                            <form action="/job/contact" method="post" id="post-contact-{{$post->id}}" data-id="{{$post->id}}">  
	                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                                                <input type="hidden" name="contact" value="{{ $post->id }}">
	                                                <button class="btn contact-btn green btn-sm apply-contact-btn" 
	                                                        id="contact-btn-{{$post->id}}" type="button">Contact
	                                                </button>
	                                            </form> 
	                                        </div>
                                                                    
                                        @endif  
                                        <!-- <div id="post-date-"></div> -->
                                    @endif
																			
								
							@endif
							
							<div  class="col-md-1 col-sm-1 col-xs-1" style="padding:0;float:right;">
							    
								<div class="report-css-home">
						
								<a data-toggle="modal" href="#basic-{{ $post->id }}">
									<button class="report-button-css">
										<i class="fa  fa-ellipsis-v" style="color:black;"></i>
									</button>
								</a>
								<div class="modal fade" id="basic-{{ $post->id }}" tabindex="-1" role="basic" 
									 aria-hidden="true">
										<div class="modal-dialog" style="width: 300px;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" 
															data-dismiss="modal" aria-hidden="true">
													</button>
													<h4 class="modal-title">Report this Post</h4>				
												</div>
												<form action="/report-abuse" method="post" id="report-abuse-form-{{ $post->id }}" class="report-validation">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="report_post_id" value="{{ $post->id }}">
												<div class="modal-body">
													<div class="icheck-list">
														<label>
															<input type="checkbox" class="icheck" 
																	name="report-abuse-check[]"
																	data-checkbox="icheckbox_line-grey" 
																	data-label="Abusive post"
																	value="1" checked>
														</label>												
														<label>
															<input type="checkbox" class="icheck" 
																	name="report-abuse-check[]"
																	data-checkbox="icheckbox_line-grey" 
																	data-label="Abusive profile"
																	value="2">
														</label>
														<label>
															<input type="checkbox" class="icheck"
																	name="report-abuse-check[]" 
																	data-checkbox="icheckbox_line-grey" 
																	data-label="Spam post"
																	value="3">
														</label>
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-warning btn-xs">Submit</button>
													<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Cancel</button>
												</div>
												</form>
											</div>
											<!-- /.modal-content -->
										</div>
										<!-- /.modal-dialog -->
									</div>
									<!-- /.modal -->	
								</div>
							</div>	
						</div>
					</div>																							
				</div>											
			</div>
		</div>
	</div>
</div>
		<!-- END TIMELINE ITEM -->
