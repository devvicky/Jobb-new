@include('partials.home.skill-filter')

@if (count($skillPosts) > 0)
	<?php $var = 1; ?>
	<div class="portlet light bordered" style="border: none !important;background:transparent;padding:0 !important;margin: -20px 0px;">								
		<div class="portlet-body form" id="post-skills">
				<div class="form-body" id="post-skill-items" style="padding:0;">
	@foreach($skillPosts as $post)					
			<div class="row post-skill-item">

						<?php $groupsTagged = array(); ?>
						@foreach($post->groupTagged as $gt)
							<?php $groupsTagged[] = $gt->group_id; ?>
						@endforeach
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
						<?php
							$crossCheck = array_intersect($groupsTagged, $groups);
							$elements = array_count_values($crossCheck); ?>

						@if($post->tagged->contains('user_id', Auth::user()->induser_id) || 
							$post->individual_id == Auth::user()->induser_id || 
							count($elements) > 0 || 
							(count($groupsTagged) == 0 && count($post->tagged) == 0))
						<div class="col-md-12 home-post">

							<div class="timeline" >
								<!-- TIMELINE ITEM -->
								@if($expired == 1)
								<div class="timeline-item time-item-ex">
								@else
								<div class="timeline-item time-item">
									@endif

									@include('partials.home.image-linked')
									@include('partials.home.favourite')

									@if($expired == 1)
									<div class="post-hover-exp" data-postid="{{$post->id}}"><a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts">
										@else
									<div class="post-hover-act" data-postid="{{$post->id}}"><a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts">
										@endif
										<div class="row  post-postision" style="cursor:pointer;">
                                            <div class="col-md-12">
                                                <div class="post-title-new">{{ $post->post_title }} </div>
                                            </div>
                                            @if($post->post_compname != null && $post->post_type == 'skill')
                                             <div class="col-md-12">
                                                <div><small style="font-size:13px;">Working at {{ $post->post_compname }}</small></div>
                                            </div>   
                                            @endif
                                       	</div>
                                   	<div class="row post-postision" style="">
                                        
                                        @if($post->min_exp != null)
                                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">
                                        <small style="font-size:13px;"> <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $post->min_exp}}-{{ $post->max_exp}} Yr</small>
                                        </div>
                                        @endif
                                        @if($post->city != null)
                                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code elipsis-city-code" style="padding:0 12px;">
                                        <small style="font-size:13px;"> <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{ $post->city }}</small>
                                        </div>
                                        @endif
                                        <div id="{{ $post->id }}-{{$var}}-{{$var}}" class="col-md-4 col-sm-4 col-xs-4 hide-details" style="float: right;right: -40px;bottom: 16px;">
                                            <a><i class="fa fa-angle-double-down post-icon-color" style="font-size:20px;"></i></a>
                                        </div>
                                        <div id="{{ $post->id }}-{{$var}}" class="col-md-4 col-sm-4 col-xs-4 show-details" style="float: right;right: -40px;bottom: 16px;">
                                            <a><i class="fa fa-angle-double-up post-icon-color" style="font-size:20px;"></i></a>
                                        </div>
                                    </div>
                                </a></div>
									<div class="row" style="margin: 5px 0px; border-top: 1px solid whitesmoke;">
										<div class="col-md-12" style="margin: 3px 0px;">

											@if($expired != 1)
										
											<div class="row" style="">	
												<div class="col-md-3 col-sm-3 col-xs-4" style="margin: 4px -10px;">
													@if($post->time_for == 'Work from Home')
													<small class="label-success label-xs elipsis-code job-type-skill-css" style="">Work From Home</small>
													@else
													<div><small class="label-success label-xs job-type-skill-css">{{$post->time_for}}</small></div>
													@endif
												</div>
												<div class="col-md-3 col-sm-3 col-xs-2" style="padding:0 35px;">
													<form action="/job/like" method="post" id="post-like-{{$post->id}}" data-id="{{$post->id}}">						
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="like" value="{{ $post->id }}">
												<button class="btn like-btn"  type="button" style="background-color: transparent;padding:3px;" title="Thanks">
													@if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())					
														 <i class="fa fa-thumbs-up thanks-icon" id="like-{{$post->id}}"></i>
													@elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->thanks == 1) 

														 <i class="fa fa-thumbs-up thanks-icon" id="like-{{$post->id}}" style="color:darkseagreen;"></i>

													@else
														 <i class="fa fa-thumbs-up thanks-icon" id="like-{{$post->id}}"></i>		
													@endif
												</button>
												<!-- <label  style="color:burlywood">Thanks </label>	 -->
														<span class="badge-like-skill" id="like-count-{{ $post->id }}">
														@if($post->postactivity->sum('thanks') > 0)
														{{ $post->postactivity->sum('thanks') }}
														@endif
														</span>
													</form>	
												</div>
												
												@if(Auth::user()->induser_id != $post->individual_id && Auth::user()->identifier == 1)										
													
													@if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
													<div class="col-md-3 col-sm-3 col-xs-3">
													</div>
													
													@elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1)
													<div class="col-md-3 col-sm-3 col-xs-3"  style="">													
														<i class="fa fa-check-square-o" style="font-size:13px;"></i><span style="font-size:12px;" class="hidden-sm hidden-xs"> Contacted</span> 
													</div>
													@else
													<div class="col-md-3 col-sm-3 col-xs-3">
													</div>
													@endif
												@endif
												
												<div  class="col-md-3 col-sm-3 col-xs-3" style="">
												    <div class="dropup ">											
														<button class="btn dropdown-toggle" type="button" 
																data-toggle="dropdown" title="Share" 
																style="background-color: transparent;border: 0;margin: 0px;">
															<i class="fa fa-share-square-o" 
																style="font-size: 19px;color: darkslateblue;"></i>
															<span class="badge-share" id="share-count-{{ $post->id }}">@if($post->postactivity->sum('share') > 0){{ $post->postactivity->sum('share') }}@endif</span>
														</button>
														<ul class="dropdown-menu pull-right" role="menu" 
															style="min-width:0;box-shadow:0 0 !important">
															<li style="background-color: tan;">
																<a href="#share-post" data-toggle="modal" class="jobtip sojt" id="sojt-{{$post->id}}" data-share-post-id="{{$post->id}}">
																	Share on Jobtip
																</a>
															</li>
															<li style="padding: 8px 0 0px;margin: auto;display: table;">		
															<!-- Go to www.addthis.com/dashboard to customize your tools -->
															<div class="addthis_sharing_toolbox" 
															data-url="http://jobtip.in/post/{{$post->unique_id}}/social" 
															data-title="{{$post->post_title}}"
															data-description="{{ $post->job_detail }}"></div>
															</li>
															
														</ul>													
													</div>
													<div class="report-css">
											 @if($expired != 1 && Auth::user()->induser_id != $post->individual_id )
													<a data-toggle="modal" href="#basic-{{ $post->id }}">
														<button class="report-button-css">
															<i class="fa  fa-ellipsis-v" style="color:black;"></i>
														</button>
													</a>

												@endif
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
																<form action="/report-abuse" method="post" id="report-abuse-form-{{ $post->id }}">
																<input type="hidden" name="_token" value="{{ csrf_token() }}">
																<input type="hidden" name="report_post_id" value="{{ $post->id }}">
																<div class="modal-body">
																	<div class="icheck-list">
																		<label>
																			<input type="checkbox" class="icheck" 
																					name="report-abuse-check[]"
																					data-checkbox="icheckbox_line-grey" 
																					data-label="Abusive post"
																					value="Abusive post" checked>
																		</label>												
																		<label>
																			<input type="checkbox" class="icheck" 
																					name="report-abuse-check[]"
																					data-checkbox="icheckbox_line-grey" 
																					data-label="Abusive profile"
																					value="Abusive profile">
																		</label>
																		<label>
																			<input type="checkbox" class="icheck"
																					name="report-abuse-check[]" 
																					data-checkbox="icheckbox_line-grey" 
																					data-label="Spam post"
																					value="Spam post">
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
										
											@else
											<div class="row" style="">
												
												<div class="col-md-3 col-sm-3 col-xs-6" style="font-size:12px;text-align:center">
												<!-- <div class="expired-css">													 -->
													<i class="glyphicon glyphicon-ban-circle" style="font-size:12px;color:dimgrey;"></i> Post Expired
												<!-- </div> -->
												</div>
												@if(Auth::user()->induser_id != $post->individual_id && Auth::user()->identifier == 1)											
													@if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
													
													@elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1)
													<div class="col-md-3 col-sm-3 col-xs-3">													
														<i class="fa fa-check-square-o" style="font-size:13px;color:dimgrey;"></i><span style="font-size:12px;" class="hidden-sm hidden-xs"> Contacted</span> 
													</div>
													@endif
												@endif
												
												
											</div>											
											@endif
										</div>
									</div>
								</div>
							</div>
							<!-- END TIMELINE ITEM -->
						</div>
						@endif
					
				</div>							
	<?php $var++; ?>
 @endforeach
 		</div>
	</div>
</div>
@elseif(count($skillPosts) == 0)
<div>No skills Posted Yet!!!
@endif

<div class="row">
	<div class="col-md-12">
		<?php echo $skillPosts->render(); ?>
	</div>
</div>
