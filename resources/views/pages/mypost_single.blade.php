@extends('master')

@section('content')
<div class="myactivity-head col-md-9" style="margin: 10px 0 0 0;">
	<i class="icon-trophy"></i> My Activity
</div>
<div class="portlet box blue col-md-9" style="border:0;">
	<div class="portlet-title portlet-title-mypost" style="float:left;">	
		<ul class="nav nav-tabs" style="padding-left: 5px;">
			<li class="active">
				<a href="#portlet_5_1" class="label-new" data-toggle="tab">
				<i class="icon-note"></i> My Posts </a>
			</li>
		</ul>
	</div>
	<div class="portlet-body" style="background-color:whitesmoke;padding:2px">
		<div class="tabbable-custom">
			
			<div class="tab-content" style="background-color:whitesmoke;">
				<div class="tab-pane active" id="portlet_5_1">
					<div class="row">				
				<div class="" style="padding:0;">												
					<div class="timeline" >
						<!-- TIMELINE ITEM -->
						<div class="timeline-item time-item">
							<div class="timeline-body" style="border-radius:15px !important;margin-left: 4px;">
								<div class="timeline-body-head">
									
									<div class="timeline-body-head-caption">
										@if(Auth::user()->identifier == 1)
										@if(count($post->groupTagged) > 0)
	                                        @if($post->sharedGroupBy->first()->mode == 'tagged')
	                                        <div class="row">
	                                            <div class="col-md-12">
	                                                <!-- Post shared by user -->                        
	                                                
		                                            <div class="shared-by">
		                                                You have tagged to <b>{{$post->sharedToGroup->first()->group_name}}</b> group<br/>
		                                            </div>
	                                                
	                                            </div>

	                                        </div>
	                                        @endif
	                                    @endif
                                     @if($post->tagged->contains('user_id', Auth::user()->induser_id) && 
                                        $post->sharedBy->first()->mode == 'tagged')
                                        
                                    <small> {{$post->sharedBy->first()->mode}} by 
                                        {{$post->sharedBy->first()->fname}} {{$post->sharedBy->first()->lname}}</small>
                                        @endif
										@endif
										Post Id:&nbsp;{{ $post->unique_id }}&nbsp;
													<small>
														<i class="fa fa-clock-o" style="font-size: 11px;"></i>  {{ date('M d, Y', strtotime($post->created_at)) }}
													</small>	
									</div>
								</div>
								<div class="timeline-body-content" style="margin-top: 20px;">
									
									<div class="post-job-skill-bar">
										<div class="{{ $post->post_type }}"><a class="post-type-class">{{ $post->post_type }}</a></div>
									</div>
									

										<?php 
										$strNew = $post->post_duration;
                                        $strAdd = $strNew;
                                        $strAdd = '+'.$strAdd.' day';
								 		$strOld = $post->created_at;
								 		$fresh = $strOld->modify($strAdd);

								 		$currentDate = \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'));
								 		$expiryDate = new \Carbon\Carbon($fresh, 'Asia/Kolkata');
								 		$difference = $currentDate->diff($expiryDate);
								 		$remainingDays = $difference->format('%d');
								 		$remainingHours = $difference->format('%h');

								 		$dateExpire= $expiryDate->format('d M Y');
								 		$dayExpire = $difference->format('%d');
								 		if($currentDate >= $fresh){
								 			$expired = 1;
								 		}else{
								 			$expired = 0;
								 		}
								  	?>
								  	<div class="row">
								  		<div class="col-md-12">
								  			<span class="font-grey-cascade">
													 <div class="post-title-new capitalize">{{ $post->post_title }}  </div>					 							
											</span>
								  		</div>
								  		@if($expired == 0)
								  		<div class="col-md-6 col-sm-6 col-xs-7">
								  			<small style="font-size:13px;">Post expires in 
									  			<button class="btn post-expire-duration-css"> 
									  				{{($post->post_duration + $post->post_extended)}} days
									  			</button>
									  		</small>
								  		</div>
								  		<div class="col-md-6 col-sm-6 col-xs-5">
								  			<div class="post-hover-act" data-postid="{{$post->id}}"><a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts"> Details</a></div>
								  		</div>
								  		@elseif($expired == 1 && $post->post_duration_extend == 0 || $post->post_duration_extend != 1)
								  		<div class="col-md-6 col-sm-6 col-xs-7">
								  			<small style="font-size:13px;">{{$dateExpire}}: Post Expired</small>
								  		</div>
								  		<div class="col-md-6 col-sm-6 col-xs-5">
								  			<div class="post-hover-act" data-postid="{{$post->id}}"><a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts"> Details</a></div>
								  		</div>
								  		@endif
								  	</div>
								  	@if($post->post_extended != null)
									<div class="row" style="margin-top:5px;">
										<div class="col-md-12" style="font-size:13px;">
										{{ date('M d, Y', strtotime($post->post_extended_Dt)) }}: Post Extended for {{$post->post_extended}} days
										</div>
									</div>
									@endif
									<!-- $fresh = strold->modify(post_duration + post_extended) -->
								</div>

									<div class="row" style="margin: 10px -15px 0px;">
										@if($expired != 1)
										<div class="col-md-4 col-sm-4 col-xs-4">
											<div class="dropdown ">											
												<button class="btn dropdown-toggle" type="button" 
														data-toggle="dropdown" title="Share" 
														style="padding: 4px 10px 5px 10px;color:white;background-color: darkslategray;">
													<i class="fa fa-share-square-o" 
														style="font-size: 14px;color: white;"></i> Share
													<span class="badge-share" id="share-count-{{ $post->id }}"></span>
												</button>
												<ul class="dropdown-menu dropdown-menu-share pull-left" role="menu" 
													style="min-width:0;box-shadow:0 0 !important">
													<li style="background-color: tan;">
														<a href="#share-post" data-toggle="modal" class="jobtip sojt" id="sojt-{{$post->id}}" data-share-post-id="{{$post->id}}">
															Share on Jobtip
														</a>
													</li>
													<li style="background-color: #3b5998;">
														<a href="/" class="facebook">
															<i class="fa fa-facebook post-social-icon" ></i>
														</a>
													</li>
													<li style="background-color: #c32f10;">
														<a href="/" class="google-plus">
															<i class="fa fa-google-plus post-social-icon"></i>
														</a>
													</li>
													<li style="background-color: #00aced;">
														<a href="/" class="linkedin">
															<i class="fa fa-linkedin post-social-icon" ></i>
														</a>
													</li>
												</ul>													
											</div>
										</div>
											@if($remainingDays >= 2)
											<div class="col-md-4 col-sm-4 col-xs-4">
												
													@if($post->post_duration_extend == 0)
														<a href="#extend-job-expiry-{{ $post->id }}" data-toggle="modal" 
														class="btn btn-sm blue">
														 Extend <i class="glyphicon glyphicon-arrow-right" style="font-size:12px;"></i></a>
												   @else
												   	<a href="" disabled class="btn btn-sm btn-info">Extended</a>
												   @endif
												
											</div>
											@elseif( $remainingDays == 1)
											<div class="col-md-4 col-sm-4 col-xs-4">
												
													@if($post->post_duration_extend == 0)
													<a href="#extend-job-expiry-{{ $post->id }}" data-toggle="modal" 
													   class="btn btn-sm blue">
													    Extend <i class="glyphicon glyphicon-arrow-right" style="font-size:12px;"></i></a>
													@else
												   	<a href="" disabled class="btn btn-sm btn-info">Extended</a>
													   @endif
												
											</div>
											@elseif($remainingDays == 0 && $remainingHours > 10)
											<div class="col-md-4 col-sm-4 col-xs-4">
												
													@if($post->post_duration_extend == 0)
													<a href="#extend-job-expiry-{{ $post->id }}" data-toggle="modal" 
													   class="btn btn-sm blue">
													    Extend <i class="glyphicon glyphicon-arrow-right" style="font-size:12px;"></i></a>
													@else
												   	<a href="" disabled class="btn btn-sm btn-info">Extended</a>   
													   @endif
												
											</div>
											@elseif($remainingHours < 10)
											<div class="col-md-4 col-sm-4 col-xs-4">
												
													@if($post->post_duration_extend == 0)
													<a href="#extend-job-expiry-{{ $post->id }}" data-toggle="modal" 
													   class="btn btn-sm btn-info">
													     Extend <i class="glyphicon glyphicon-arrow-right" style="font-size:12px;"></i></a>
													@else
												   	<a href="" disabled class="btn btn-sm btn-info">Extended</a>
													@endif
												
											</div>										
											@endif

										@endif
										@if($expired != 1)
										<div class="col-md-4 col-sm-4 col-xs-4">
											<a class="btn btn-sm btn-danger" data-toggle="modal" href="#expire">
												<i class="glyphicon glyphicon-ban-circle" style="font-size:12px;"></i> Expire
											</a>
											<div class="modal fade bs-modal-sm" id="expire" tabindex="-1" role="dialog" aria-hidden="true">
												<div class="modal-dialog modal-sm">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
															<h4 class="modal-title"><i class="glyphicon glyphicon-exclamation-sign" style="font-size: 16px;color: firebrick;"></i> Are you sure</h4>
														</div>
														<div class="modal-body">
															 Do you want to expire this post?
														</div>
														<div class="modal-footer">		
															<form action="/job/expire" method="post">				
																<input type="hidden" name="_token" value="{{ csrf_token() }}">
																<input type="hidden" name="post_id" value="{{$post->id}}">					
																<button type="submit" class="btn blue">Yes</button>
																<button type="button" class="btn default" data-dismiss="modal">No</button>
															</form>															
														</div>
													</div>
													<!-- /.modal-content -->
												</div>
												<!-- /.modal-dialog -->
											</div>
											<!-- /.modal -->
										</div>
										
										@elseif($expired == 1)
										<div class="col-md-4 col-sm-4 col-xs-4">
											<a href="" disabled class="btn btn-sm" style="color:white;background-color: darkslategray;">Share</a>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4">
												
											<a href="" disabled class="btn btn-sm btn-info">Extended</a>
												
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4">
											<a class="btn btn-sm btn-danger" disabled data-toggle="modal" href="#expire">
												 Expired
											</a>
										</div>
										@endif
									</div>
								
								<div class="share-mypost">
									
								</div>		
							</div>

							<div class="box">
										   <div class="ribbon"><span class="{{ $post->post_type }}">{{ $post->post_type }}</span></div>
										</div>
							
							<div class="portlet-body">
								<div class="panel-group accordion" id="accordion2_{{$post->id}}" style="margin-bottom: 0;">
									<div class="panel panel-default" style=" position: relative;border-radius: 0 0 4px 4px !important;border-color:white;">
										<div class="panel-heading">
											<h4 class="panel-title">
												
											</h4>
										</div>
										<div id="collapse2_{{$post->id}}_{{$post->id}}" class="panel-collapse">
											<div class="panel-body" style="border-top: 0;padding: 0;">
												
												<div class="portlet box">
													<div class="portlet-body" style="padding: 0px 3px;">
													<div class="tabbable-custom ">
														<ul class="nav nav-tabs" style="padding-left: 0px;">		
															@if(Auth::user()->identifier == 2)
															<li  class="active">	
																<a href="#tab_1_{{ $post->id }}_1" class="label-new" data-toggle="tab" style="border-left: 0;">Applied 
																	
																		<?php $i=0; ?>
																			@foreach($post->postactivity as $pa)
																	  			@if($pa->apply == 1) <?php $i++; ?> @endif
																	  		@endforeach
																	  		<?php 
																		  		if($i>0){
																			echo "<span class='badge' style='background-color: deepskyblue;'>";

																				  			echo $i;
																				  		
																			echo "</span>";
																			} 
																		?> 
																	
																</a>
															</li>
															@elseif(Auth::user()->identifier == 1)
															<li class="active">
																<a href="#tab_1_{{ $post->id }}_2" class="label-new" data-toggle="tab" style="border-left: 0;padding:10px 6px;">
																	Contacted 
																	<?php $i=0; ?>
																			@foreach($post->postactivity as $pa)
																	  			@if($pa->contact_view == 1) <?php $i++; ?> @endif
																	  		@endforeach
																	  		<?php 
																		  		if($i>0){
																	echo "<span class='badge' style='background-color: deepskyblue;'>";

																		  			echo $i;
																		  		
																	echo "</span>";
																	} 
																?> 
																</a>
															
															</li>
															@endif
															<li>
																<a href="#tab_1_{{ $post->id }}_3" class="label-new" data-toggle="tab" style="padding:10px 6px;">
																	Thanked
																	<?php $i=0; ?>
																			@foreach($post->postactivity as $pa)
																	  			@if($pa->thanks == 1) <?php $i++; ?> @endif
																	  		@endforeach
																	  		<?php 
																		  		if($i>0){
																	echo "<span class='badge' style='background-color: deepskyblue;'>";

																		  			echo $i;
																		  		
																	echo "</span>";
																	} 
																?> 
																	
																</a>
															</li>
															<li>
																<a href="#tab_1_{{ $post->id }}_4" class="label-new" data-toggle="tab" style="padding:10px 6px;">
																	Shared
																	
																		<?php $i=0; ?>
																			@foreach($post->postactivity as $pa)
																	  			@if($pa->share == 1) <?php $i++; ?> @endif
																	  		@endforeach
																	  		<?php 
																		  		if($i>0){
																	echo "<span class='badge' style='background-color: deepskyblue;'>";

																		  			echo $i;
																		  		
																	echo "</span>";
																	} 
																?> 
																	
																</a>
															</li>
														</ul>
														
														<div class="tab-content" style="padding: 0px 0px;margin: -7px 0px;">
															@if(Auth::user()->identifier == 2)
															<div class="tab-pane" id="tab_1_{{ $post->id }}_1">
																<div class="portlet light" style="padding:0px; !important">
																	<div class="portlet-title">
																		<div class="pull-left contacted-css">
																			<label>People who have Applied</label>
																		</div>
																		<div class="btn-group" style="float:right;margin:7px 0;">
																			<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" style="border: 0;">
																			<i class="glyphicon glyphicon-sort"></i> Sort by <i class="fa fa-angle-down"></i>
																			</button>
																			<ul class="dropdown-menu dropdown-menu-sort" role="menu" style="min-width: 130px;margin: 4px -25px;">
																				<li>
																					<a href="javascript:;">
																					Date </a>
																				</li>
																				@if($post->post_type == 'job')
																				<li>
																					<a href="javascript:;">
																					Magic Match </a>
																				</li>
																				@elseif($post->post_type == 'skill')
																				<li>
																					<a href="javascript:;">
																					Individual Post </a>
																				</li>
																				<li>
																					<a href="javascript:;">
																					Company Post </a>
																				</li>
																				<li>
																					<a href="javascript:;">
																					Consultancy Post </a>
																				</li>
																				@endif
																			</ul>
																		</div>
																	</div>
																	

																	<div class="portlet-body">										
																		<ul data-handle-color="#637283" style="padding: 0">

														                  @foreach($post->postactivity as $pa)
																		  	@if($pa->apply == 1)
																		  	@if($pa->user->induser != null)
																		  	<div class="row" style="margin-top:3px;">
																		  		<div class="col-md-3 col-sm-4 col-xs-3">
																		  			<img src="@if($pa->user->induser->profile_pic != null){{ '/img/profile/'.$pa->user->induser->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" 
															                    		 width="45" height="45" 
															                    		 class="img-circle">
																		  		</div>
																		  		<div class="col-md-8 col-sm-8 col-xs-9">
																		  			<a href="/profile/ind/{{$pa->user->induser->id}}" data-utype="ind">
																                    		{{$pa->user->induser->fname}} </a> has applied for this post <i class=" icon-clock"></i>
															                    	{{ \Carbon\Carbon::createFromTimeStamp(strtotime($pa->apply_dtTime))->diffForHumans() }}
																		  		</div>
																		  	</div>
																		  		<?php $postSkills = array(); ?>														
																				@foreach($post->skills as $skill)
																					<?php $postSkills[] = $skill->name; ?>
																					
																				@endforeach
															                   <?php
															                    $userSkills = array_map('trim', explode(',', $pa->user->induser->linked_skill));
															                    unset ($userSkills[count($userSkills)-1]); 
															                    ?>
																				<?php 
																					$overlap = array_intersect($postSkills, $userSkills);
																					$counts  = array_count_values($overlap);
																				?>
																		  	<div class="row" style="border-bottom:1px dotted lightgrey;">
																		  		
														                    	<div class="col-md-4 col-sm-4 col-xs-4" style="font-size:12px;">
														                    		
														                    		<a data-toggle="modal" data-uid="{{$pa->id}}" data-mpostid="{{$post->id}}" 
																						class="magic-font mypost_magicmatch btn btn-success magic-match-css" href="#mypost_magicmatch"
																						 style="color: white;line-height: 1.7;text-decoration: none;">
																						<i class="icon-speedometer magic-font" style="font-size:12px;"></i> {{$post->magic_match}} %
																					</a>
														                    	</div>
														                    	
														                    	<!-- <div class="col-md-2 col-sm-4 col-xs-4">
														                    		Profile
														                    	</div> -->
														                    	<div class="col-md-2 col-sm-3 col-xs-3" style="margin: 7px 0px;">
														                    		<div class="btn-group dropup">
																						<button class="btn btn-default btn-sm dropdown-toggle contact-view-css" type="button" data-toggle="dropdown">
																						<i class="fa fa-phone"></i> Contact 
																						</button>
																						<ul class="dropdown-menu dropdown-menu-contact" role="menu" style="background-color:black !important;">
																							<li>
																								<a href="javascript:;" style="color:white;">
																								<i class="fa fa-envelope"></i>: {{$pa->user->induser->email}} </a>
																							</li>
																							<li>
																								<a href="tel:{{$pa->user->induser->mobile}}" style="color:white;">
																								<i class="fa fa-phone-square"></i>: {{$pa->user->induser->mobile}} </a>
																							</li>
																						</ul>
																					</div>	
														                    	</div>
														                    	
														                    	@if($post->post_type == 'job' && $post->resume_required == 1)
														                    	<div class="col-md-2 col-sm-3 col-xs-3" style="margin: 6px 15px;">
														                    	<a class="btn-success resume-button-css" href="/profile/ind/{{$pa->user->id}}">
														                    		<i class="fa fa-file-word-o" style="font-size:12px;"></i> Resume</a>
														                    	</div>
														                    	@endif
														                    	
													                    	</div>
														                 	
														                 		<!-- <div class="mypost-match"><i class="icon-speedometer"></i> 49%</div> -->
															                  

															                    <!-- <div class="row"> -->
																                    <!-- <div class="col-md-1"></div> -->
															                        <!-- <div class="col-md-12"> -->
																                    	
															                		<!-- </div> -->
															               		<!-- </div> -->
															               		<div id="oval"></div>
										<!-- Modal for Matching Percentage -->
										<div class="modal fade" id="post-mod-{{$post->id}}" tabindex="-1" role="basic" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
													   <h4 class="modal-title" style="text-align:center;">
													   		<i class="icon-speedometer" style="font-size:16px;"></i> {{$post->magic_match}} % Match 
													   		
													   	</h4>
													</div>
													<div class="modal-body">

														<!-- BEGIN BORDERED TABLE PORTLET-->
														<div class="portlet box">
															<div class="portlet-body" style=" padding: 0 !important;">
																<div class="table-scrollable">
																	<table class="table table-bordered table-hover">
																					<thead style="border:0 !important;">
																					<tr style="border:0 !important;">
																						
																						<th class="col-md-6 col-sm-6 col-xs-6 matching-criteria-align">
																							 Required Profile
																						</th>
																						<th class="col-md-6 col-sm-6 col-xs-6 matching-criteria-align">
																							{{ $pa->user->induser->fname }} Profile
																						</th>
																					</tr>
																					</thead>

																					<tbody>
																						<tr class="@if(count($counts) > 0) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if(count($counts) > 0)
																								<label class="title-color">
																									<i class="fa fa-check magic-match-icon-color"></i> Skills <i class="badge">{{count($counts)}}</i> 
																								</label>
																								@else
																								<label class="title-color">
																									<i class="fa fa-times"></i> Skills <i class="badge">{{count($counts)}}</i> 
																								</label>
																								@endif
																							</td>
																						</tr>
																						<tr class="@if(count($counts) > 0) success @else danger-new @endif">
																							
																							<td class="matching-criteria-align">

																								@foreach($post->skills as $skill)
																									{{$skill->name}},
																								@endforeach
																							</td>
																							@if($pa->user->induser->linked_skill !=null)
																							<td class="matching-criteria-align">
																								@foreach($userSkills as $myskill)
																									{{$myskill}},
																								@endforeach												
																							</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																						<tr class="@if(strcasecmp($post->role, $pa->user->induser->role) == 0) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if(strcasecmp($post->role, $pa->user->induser->role) == 0)
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Job Role</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Job Role</label>
																								@endif
																							</td>
																						</tr>
																						<tr class="@if(strcasecmp($post->role, $pa->user->induser->role) == 0) success @else danger-new @endif">
																							<!-- <td>
																								<label class="title-color">Job Role</label>
																							</td> -->
																							<td class="matching-criteria-align">{{ $post->role }}</td>
																							@if($pa->user->induser->role !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->role }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																						
																						
																						<tr class="@if($post->min_exp == $pa->user->induser->experience) title-bacground-color @else title-bacground-color @endif">
																							
																							<td colspan="2" class="matching-criteria-align">
																								@if($post->min_exp == $pa->user->induser->experience)
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Experience</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Experience</label>
																								@endif
																							</td>
																						</tr>
																						<tr class="@if($post->min_exp == $pa->user->induser->experience) success @else danger-new @endif">
																							<!-- <td>
																								<label class="title-color">Experience</label>
																							</td> -->
																							<td class="matching-criteria-align">{{ $post->min_exp }}-{{ $post->max_exp }}</td>
																							@if($pa->user->induser->experience !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->experience }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																						<tr class="@if($post->education == $pa->user->induser->education) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if($post->education == $pa->user->induser->education)
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Education</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Education</label>
																								@endif
																								
																							</td>
																						</tr>
																						<tr class="@if($post->education == $pa->user->induser->education) success @else danger-new @endif">
																							<!-- <td>
																								<label class="title-color">Education</label>
																							</td> -->
																							<td class="matching-criteria-align">{{ $post->education }}</td>
																							@if($pa->user->induser->education !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->education }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																						<tr class="@if($post->city == $pa->user->induser->city) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if($post->city == $pa->user->induser->city)
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Location</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Location</label>
																								@endif
																							</td>
																						</tr>
																						<tr class="@if($post->city == $pa->user->induser->city) success @else danger-new @endif">
																																					
																							<td class="matching-criteria-align">{{ $post->city }}</td>
																							@if($pa->user->induser->city !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->city }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																						<tr class="@if($post->time_for == $pa->user->induser->prefered_jobtype || ($post->time_for == 'Part Time' && $pa->user->induser->prefered_jobtype == 'Full Time')) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if($post->time_for == $pa->user->induser->prefered_jobtype || ($post->time_for == 'Part Time' && $pa->user->induser->prefered_jobtype == 'Full Time'))
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Job Type</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Job Type</label>
																								@endif
																								
																							</td>
																						</tr>
																						<tr class="@if($post->time_for == $pa->user->induser->prefered_jobtype || ($post->time_for == 'Part Time' && $pa->user->induser->prefered_jobtype == 'Full Time')) success @else danger-new @endif">
																																					
																							<td class="matching-criteria-align">{{ $post->time_for }}</td>
																							@if($pa->user->induser->prefered_jobtype !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->prefered_jobtype }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																					</tbody>
																					</table>
																	
																</div>
															</div>
														</div>
														<!-- END BORDERED TABLE PORTLET-->
														<!-- </div> -->	
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
											</div>
											<!-- /.modal -->
														                   	@endif
														                   	@endif									                 
														                  @endforeach									                  
														                </ul>											
																	</div>

																</div>
															</div>
															
															@elseif(Auth::user()->identifier == 1)
															<div class="tab-pane active" id="tab_1_{{ $post->id }}_2">
																<div class="portlet light" style="padding:0px !important;">
																	<?php $i=0; ?>
																	
																			@foreach($post->postactivity as $pa)
																	  			@if($pa->contact_view == 1) <?php $i++; ?> @endif
																	  		@endforeach
																	  		<?php 
																		  		if($i>0){
																	echo "<div class='portlet-title'>
																		<div class='pull-left '>
																			<label class='contacted-css'>People who have Contacted</label>
																		</div>
																		<div class='btn-group' style='float:right;margin:7px 0;'>
																			<button class='btn btn-default btn-sm dropdown-toggle' type='button' data-toggle='dropdown' style='border: 0;'>
																			<i class='glyphicon glyphicon-sort'></i> Sort by <i class='fa fa-angle-down'></i>
																			</button>
																			<ul class='dropdown-menu dropdown-menu-sort 'role='menu' style='min-width: 130px;margin: 4px -25px;'>
																				<li>
																					<a href='./mypost/post/date'>
																					Date </a>
																				</li>
																				
																				<li>
																					<a href='javascript:;'>
																					Magic Match </a>
																				</li>
																				
																				<li>
																					<a href='javascript:;'>
																					Individual Post </a>
																				</li>
																				<li>
																					<a href='javascript:;'>
																					Company Post </a>
																				</li>
																				<li>
																					<a href='javascript:;'>
																					Consultancy Post </a>
																				</li>
																				
																			</ul>
																		</div>
																	</div>";
																	} 
																	else{
																		echo "<div class='pull-left '>
																			<label class='contacted-css'>No one has Contacted yet.</label>
																		</div>";
																	}
																?> 
																	<div class="portlet-body">		

																		<!-- <ul class="" data-handle-color="#637283"> 	 -->			                  
																		@foreach($post->postactivity as $pa)
																		  	@if($pa->apply == 1)
																		  	@if($pa->user->induser != null)
																		  	<?php $postSkills = array(); ?>														
																			@foreach($post->skills as $skill)
																				<?php $postSkills[] = $skill->name; ?>
																				
																			@endforeach
																		  	<?php
															                    $userSkills = array_map('trim', explode(',', $pa->user->induser->linked_skill));
															                    unset ($userSkills[count($userSkills)-1]); 
															                    ?>
																				<?php 
																					$overlap = array_intersect($postSkills, $userSkills);
																					$counts  = array_count_values($overlap);
																				?>

																				
																		  		<div class="row" style="font-size:13px;border-bottom:1px dotted lightgrey;">
																		  		<div class="col-md-10">
																					<div class="col-md-2 col-sm-3 col-xs-3">
																						<img src="@if($pa->user->induser->profile_pic != null){{ '/img/profile/'.$pa->user->induser->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" 
																                    		 width="45" height="45" 
																                    		 class="img-circle">
																					</div>
																					<div class="col-md-6 col-sm-9 col-xs-9">
																						<a href="/profile/ind/{{$pa->user->id}}" data-utype="ind">
																	                    		{{$pa->user->induser->fname}}</a> has applied for this post 
																                    	
																					</div>
																					<div class="col-md-3 col-sm-6 col-xs-6">
																						<i class=" icon-clock" style="font-size:12px;"></i> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($pa->apply_dtTime))->diffForHumans() }}
																					</div>
																				</div>
																			</div>
																			<div class="row" style="margin: 10px -15px;">
																				@if($post->post_type == 'job')
														                    	<div class="col-md-2 col-sm-3 col-xs-3" style="font-size:12px;margin: 10px 10px;">
														                    		<a data-toggle="modal" data-mpostid="{{$post->id}}" 
																						class="magic-font mypost_magicmatch btn btn-success magic-match-css" href="#mypost_magicmatch"
																						 style="color: white;line-height: 1.7;text-decoration: none;">
																						<i class="icon-speedometer magic-font" style="font-size:12px;"></i> {{$post->magic_match}} %
																					</a>
														                    	</div>
														                    	@else
														                    	<div class="col-md-2 col-sm-3 col-xs-3" style="font-size:12px;margin: 10px 10px;">
														                    	</div>
														                    	@endif
														                    	<!-- <div class="col-md-2 col-sm-4 col-xs-4">
														                    		Profile
														                    	</div> -->
														                    	<div class="col-md-2 col-sm-3 col-xs-3" style="margin: 7px 0px;">
														                    		<div class="btn-group dropup">
																						<button class="btn btn-default btn-sm dropdown-toggle contact-view-css" type="button" data-toggle="dropdown">
																						<i class="fa fa-phone"></i> Contact 
																						</button>
																						<ul class="dropdown-menu dropdown-menu-contact" role="menu" style="background-color:black !important;">
																							<li>
																								<a href="javascript:;" style="color:white;">
																								<i class="fa fa-envelope"></i>: {{$pa->user->induser->email}} </a>
																							</li>
																							<li>
																								<a href="tel:{{$pa->user->induser->mobile}}" style="color:white;">
																								<i class="fa fa-phone-square"></i>: {{$pa->user->induser->mobile}} </a>
																							</li>
																						</ul>
																					</div>	
														                    	</div>
														                    	@if($post->post_type == 'job' && $post->resume_required == 1)
														                    	<div class="col-md-2 col-sm-4 col-xs-4" style="margin: 9px 15px;">
														                    	<a class="btn resume-button-css" data-toggle="modal" href="/profile/ind/{{$pa->user->id}}">
														                    		<i class="fa fa-file-word-o" style="font-size:12px;"></i> Resume</a>
														                    	</div>
														                    	@endif
														                    	
													                    	</div>


													                    											<!-- Modal for Matching Percentage -->
										<div class="modal fade" id="post-mod-{{$post->id}}" tabindex="-1" role="basic" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
													   <h4 class="modal-title" style="text-align:center;">
													   		<i class="icon-speedometer" style="font-size:16px;"></i>  
													   		
															{{$post->magic_match}} % Match 
													   	</h4>
													</div>
													<div class="modal-body">

														<!-- BEGIN BORDERED TABLE PORTLET-->
														<div class="portlet box">
															<div class="portlet-body" style=" padding: 0 !important;">
																<div class="table-scrollable">
																	<table class="table table-bordered table-hover">
																					<thead style="border:0 !important;">
																					<tr style="border:0 !important;">
																						
																						<th class="col-md-6 col-sm-6 col-xs-6 matching-criteria-align">
																							 Required Profile
																						</th>
																						<th class="col-md-6 col-sm-6 col-xs-6 matching-criteria-align">
																							 {{ $pa->user->induser->fname }} Profile
																						</th>
																					</tr>
																					</thead>

																					<tbody>
																						<tr class="@if(count($counts) > 0) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if(count($counts) > 0)
																								<label class="title-color">
																									<i class="fa fa-check magic-match-icon-color"></i> Skills <i class="badge">{{count($counts)}}</i> 
																								</label>
																								@else
																								<label class="title-color">
																									<i class="fa fa-times"></i> Skills <i class="badge">{{count($counts)}}</i> 
																								</label>
																								@endif
																							</td>
																						</tr>
																						<tr class="@if(count($counts) > 0) success @else danger @endif">
																							
																							<td class="matching-criteria-align">

																								@foreach($post->skills as $skill)
																									{{$skill->name}},
																								@endforeach
																							</td>
																							@if($pa->user->induser->linked_skill !=null)
																							<td class="matching-criteria-align">
																								@foreach($userSkills as $myskill)
																									{{$myskill}},
																								@endforeach												
																							</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																						<tr class="@if(strcasecmp($post->role, $pa->user->induser->role) == 0) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if(strcasecmp($post->role, $pa->user->induser->role) == 0)
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Job Role</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Job Role</label>
																								@endif
																							</td>
																						</tr>
																						<tr class="@if(strcasecmp($post->role, $pa->user->induser->role) == 0) success @else danger @endif">
																							<!-- <td>
																								<label class="title-color">Job Role</label>
																							</td> -->
																							<td class="matching-criteria-align">{{ $post->role }}</td>
																							@if($pa->user->induser->role !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->role }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																						
																						
																						<tr class="@if($post->min_exp == $pa->user->induser->experience) title-bacground-color @else title-bacground-color @endif">
																							
																							<td colspan="2" class="matching-criteria-align">
																								@if($post->min_exp == $pa->user->induser->experience)
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Experience</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Experience</label>
																								@endif
																							</td>
																						</tr>
																						<tr class="@if($post->min_exp == $pa->user->induser->experience) success @else danger @endif">
																							<!-- <td>
																								<label class="title-color">Experience</label>
																							</td> -->
																							<td class="matching-criteria-align">{{ $post->min_exp }}-{{ $post->max_exp }}</td>
																							@if($pa->user->induser->experience !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->experience }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																						<tr class="@if($post->education == $pa->user->induser->education) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if($post->education == $pa->user->induser->education)
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Education</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Education</label>
																								@endif
																								
																							</td>
																						</tr>
																						<tr class="@if($post->education == $pa->user->induser->education) success @else danger @endif">
																							<!-- <td>
																								<label class="title-color">Education</label>
																							</td> -->
																							<td class="matching-criteria-align">{{ $post->education }}</td>
																							@if($pa->user->induser->education !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->education }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---												
																							</td>
																							@endif
																						</tr>
																						<tr class="@if($post->city == $pa->user->induser->city) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if($post->city == $pa->user->induser->city)
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Location</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Location</label>
																								@endif
																							</td>
																						</tr>
																						<tr class="@if($post->city == $pa->user->induser->city) success @else danger @endif">
																																					
																							<td class="matching-criteria-align">{{ $post->city }}</td>
																							@if($pa->user->induser->city !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->city }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																						<tr class="@if($post->time_for == $pa->user->induser->prefered_jobtype || ($post->time_for == 'Part Time' && $pa->user->induser->prefered_jobtype == 'Full Time')) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if($post->time_for == $pa->user->induser->prefered_jobtype || ($post->time_for == 'Part Time' && $pa->user->induser->prefered_jobtype == 'Full Time'))
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Job Type</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Job Type</label>
																								@endif
																								
																							</td>
																						</tr>
																						<tr class="@if($post->time_for == $pa->user->induser->prefered_jobtype || ($post->time_for == 'Part Time' && $pa->user->induser->prefered_jobtype == 'Full Time')) success @else danger @endif">
																																					
																							<td class="matching-criteria-align">{{ $post->time_for }}</td>
																							@if($pa->user->induser->prefered_jobtype !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->prefered_jobtype }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---												
																							</td>
																							@endif
																						</tr>
																					</tbody>
																					</table>
																</div>
															</div>
														</div>
														<!-- END BORDERED TABLE PORTLET-->
														<!-- </div> -->	
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
											</div>
											<!-- /.modal -->

																		  		@endif
														                   	@endif									                 
														                  @endforeach	
														                  @foreach($post->postactivity as $pa)
																		  	@if($pa->contact_view == 1)
																		  	@if($pa->user->induser != null)
																		  	<?php $postSkills = array(); ?>														
																			@foreach($post->skills as $skill)
																				<?php $postSkills[] = $skill->name; ?>
																				
																			@endforeach
																		  	<?php
															                    $userSkills = array_map('trim', explode(',', $pa->user->induser->linked_skill));
															                    unset ($userSkills[count($userSkills)-1]); 
															                    ?>
																				<?php 
																					$overlap = array_intersect($postSkills, $userSkills);
																					$counts  = array_count_values($overlap);
																				?>
																		  	<div class="row" style="font-size:13px;">
																		  		<div class="col-md-10">
																					<div class="col-md-2 col-sm-3 col-xs-3">
																						<img src="@if($pa->user->induser->profile_pic != null){{ '/img/profile/'.$pa->user->induser->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" 
																                    		 width="45" height="45" 
																                    		 class="img-circle">
																					</div>
																					<div class="col-md-6 col-sm-9 col-xs-9">
																						<a href="/profile/ind/{{$pa->user->induser->id}}" data-utype="ind">
																	                    		{{$pa->user->induser->fname}}</a> has contacted for this post 
																                    	
																					</div>
																					<div class="col-md-4 col-sm-6 col-xs-6">
																						<i class=" icon-clock" style="font-size:12px;"></i> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($pa->contact_view_dtTime))->diffForHumans() }}
																					</div>
																				</div>
																			</div>
																			<div class="row" style="margin: 10px -15px;">
																				@if($post->post_type == 'job')
														                    	<div class="col-md-2 col-sm-3 col-xs-3" style="font-size:12px;margin: 10px 10px;">
														                    		<a data-toggle="modal" data-mpostid="{{$post->id}}" 
																						class="magic-font mypost_magicmatch btn btn-success magic-match-css" href="#mypost_magicmatch"
																						 style="color: white;line-height: 1.7;text-decoration: none;">
																						<i class="icon-speedometer magic-font" style="font-size:12px;"></i> {{$post->magic_match}} %
																					</a>
														                    	</div>
														                    	@else
														                    	<div class="col-md-2 col-sm-3 col-xs-3" style="font-size:12px;margin: 10px 10px;">
														                    	</div>
														                    	@endif
														                    	<!-- <div class="col-md-2 col-sm-4 col-xs-4">
														                    		Profile
														                    	</div> -->
														                    	<div class="col-md-2 col-sm-3 col-xs-3" style="margin: 7px 0px;">
														                    		<div class="btn-group dropup">
																						<button class="btn btn-default btn-sm dropdown-toggle contact-view-css" type="button" data-toggle="dropdown">
																						<i class="fa fa-phone"></i> Contact 
																						</button>
																						<ul class="dropdown-menu dropdown-menu-contact" role="menu" style="background-color:black !important;">
																							<li>
																								<a href="javascript:;" style="color:white;">
																								<i class="fa fa-envelope"></i>: {{$pa->user->induser->email}} </a>
																							</li>
																							<li>
																								<a href="tel:{{$pa->user->induser->mobile}}" style="color:white;">
																								<i class="fa fa-phone-square"></i>: {{$pa->user->induser->mobile}} </a>
																							</li>
																						</ul>
																					</div>	
														                    	</div>
														                    	@if($post->post_type == 'job' && $post->resume_required == 1)
														                    	<div class="col-md-2 col-sm-4 col-xs-4" style="margin: 9px 15px;">
														                    	<a class="btn resume-button-css" data-toggle="modal" href="/profile/ind/{{$pa->user->id}}">
														                    		<i class="fa fa-file-word-o" style="font-size:12px;"></i> Resume</a>
														                    	</div>
														                    	@endif
														                    	
													                    	</div>
													                    	

													                    											<!-- Modal for Matching Percentage -->
										<div class="modal fade" id="post-mod-{{$post->id}}" tabindex="-1" role="basic" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
													   <h4 class="modal-title" style="text-align:center;">
													   		<i class="icon-speedometer" style="font-size:16px;"></i>  
													   		<?php
																try{
																	echo round($avgPer).'%';
																} 
																catch(\Exception $e){
																}
															?>
															Match
													   	</h4>
													</div>
													<div class="modal-body">

														<!-- BEGIN BORDERED TABLE PORTLET-->
														<div class="portlet box">
															<div class="portlet-body" style=" padding: 0 !important;">
																<div class="table-scrollable">
																	<table class="table table-bordered table-hover">
																					<thead style="border:0 !important;">
																					<tr style="border:0 !important;">
																						
																						<th class="col-md-6 col-sm-6 col-xs-6 matching-criteria-align">
																							 Required Profile
																						</th>
																						<th class="col-md-6 col-sm-6 col-xs-6 matching-criteria-align">
																							 {{ $pa->user->induser->fname }} Profile
																						</th>
																					</tr>
																					</thead>

																					<tbody>
																						<tr class="@if(count($counts) > 0) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if(count($counts) > 0)
																								<label class="title-color">
																									<i class="fa fa-check magic-match-icon-color"></i> Skills <i class="badge">{{count($counts)}}</i> 
																								</label>
																								@else
																								<label class="title-color">
																									<i class="fa fa-times"></i> Skills <i class="badge">{{count($counts)}}</i> 
																								</label>
																								@endif
																							</td>
																						</tr>
																						<tr class="@if(count($counts) > 0) success @else danger-new @endif">
																							
																							<td class="matching-criteria-align">

																								@foreach($post->skills as $skill)
																									{{$skill->name}},
																								@endforeach
																							</td>
																							@if($pa->user->induser->linked_skill !=null)
																							<td class="matching-criteria-align">
																								@foreach($userSkills as $myskill)
																									{{$myskill}},
																								@endforeach												
																							</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																						<tr class="@if(strcasecmp($post->role, $pa->user->induser->role) == 0) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if(strcasecmp($post->role, $pa->user->induser->role) == 0)
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Job Role</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Job Role</label>
																								@endif
																							</td>
																						</tr>
																						<tr class="@if(strcasecmp($post->role, $pa->user->induser->role) == 0) success @else danger-new @endif">
																							<!-- <td>
																								<label class="title-color">Job Role</label>
																							</td> -->
																							<td class="matching-criteria-align">{{ $post->role }}</td>
																							@if($pa->user->induser->role !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->role }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---												
																							</td>
																							@endif
																						</tr>
																						
																						
																						<tr class="@if($post->min_exp == $pa->user->induser->experience) title-bacground-color @else title-bacground-color @endif">
																							
																							<td colspan="2" class="matching-criteria-align">
																								@if($post->min_exp == $pa->user->induser->experience)
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Experience</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Experience</label>
																								@endif
																							</td>
																						</tr>
																						<tr class="@if($post->min_exp == $pa->user->induser->experience) success @else danger-new @endif">
																							<!-- <td>
																								<label class="title-color">Experience</label>
																							</td> -->
																							<td class="matching-criteria-align">{{ $post->min_exp }}-{{ $post->max_exp }}</td>
																							@if($pa->user->induser->experience !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->experience }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																						<tr class="@if($post->education == $pa->user->induser->education) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if($post->education == $pa->user->induser->education)
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Education</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Education</label>
																								@endif
																								
																							</td>
																						</tr>
																						<tr class="@if($post->education == $pa->user->induser->education) success @else danger-new @endif">
																							<!-- <td>
																								<label class="title-color">Education</label>
																							</td> -->
																							<td class="matching-criteria-align">{{ $post->education }}</td>
																							@if($pa->user->induser->education !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->education }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																						<tr class="@if($post->city == $pa->user->induser->city) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if($post->city == $pa->user->induser->city)
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Location</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Location</label>
																								@endif
																							</td>
																						</tr>
																						<tr class="@if($post->city == $pa->user->induser->city) success @else danger-new @endif">
																																					
																							<td class="matching-criteria-align">{{ $post->city }}</td>
																							@if($pa->user->induser->city !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->city }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																						<tr class="@if($post->time_for == $pa->user->induser->prefered_jobtype || ($post->time_for == 'Part Time' && $pa->user->induser->prefered_jobtype == 'Full Time')) title-bacground-color @else title-bacground-color @endif">
																							<td colspan="2" class="matching-criteria-align">
																								@if($post->time_for == $pa->user->induser->prefered_jobtype || ($post->time_for == 'Part Time' && $pa->user->induser->prefered_jobtype == 'Full Time'))
																								<i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Job Type</label>
																								@else
																								<i class="fa fa-times"></i> <label class="title-color">Job Type</label>
																								@endif
																								
																							</td>
																						</tr>
																						<tr class="@if($post->time_for == $pa->user->induser->prefered_jobtype || ($post->time_for == 'Part Time' && $pa->user->induser->prefered_jobtype == 'Full Time')) success @else danger-new @endif">
																																					
																							<td class="matching-criteria-align">{{ $post->time_for }}</td>
																							@if($pa->user->induser->prefered_jobtype !=null)
																							<td class="matching-criteria-align">{{ $pa->user->induser->prefered_jobtype }}</td>
																							@else
																							<td class="matching-criteria-align">
																								---											
																							</td>
																							@endif
																						</tr>
																					</tbody>
																					</table>
																</div>
															</div>
														</div>
														<!-- END BORDERED TABLE PORTLET-->
														<!-- </div> -->	
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
											</div>
											<!-- /.modal -->
														                 	@endif
														                   	@endif									                 
														                  @endforeach									                  
														                											
																	</div>
																</div>
															</div>
															@endif
															<div class="tab-pane" id="tab_1_{{ $post->id }}_3">
																<div class="portlet light" style="padding:0px !important;">
																	<?php $i=0; ?>
																		@foreach($post->postactivity as $pa)
																  			@if($pa->thanks == 1) <?php $i++; ?> @endif
																  		@endforeach
																  		<?php 
																	  		if($i>0){
																	echo "<div class='portlet-title'>
																			<div class='pull-left '>
																				<label class='contacted-css'>People who have Thanked</label>
																			</div>
																		</div>";
																		}else{
																		echo "<div class='pull-left '>
																			<label class='contacted-css'>No one has Thanked.</label>
																		</div>";
																		}
																	?>
																	<div class="portlet-body">
																		<ul data-handle-color="#637283" style="padding: 0">
																		 @foreach($post->postactivity as $pa)
																		  	@if($pa->thanks == 1)
																			  	@if($pa->user->induser != null)
																			  	<div class="row" style="font-size:13px;border-bottom:1px dotted lightgrey;">
																			  		<div class="col-md-8">
																				  		<div class="col-md-2 col-sm-3 col-xs-3">
																				  			<img src="@if($pa->user->induser->profile_pic != null){{ '/img/profile/'.$pa->user->induser->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" 
																	                    		 width="45" height="45" 
																	                    		 class="img-circle">
																				  		</div>
																				  		<div class="col-md-6 col-sm-9 col-xs-9">
																				  			<a href="/profile/ind/{{$pa->user->induser->id}}" data-utype="ind">
																		                    		{{$pa->user->induser->fname}}</a> has thanked this post
																				  		</div>
																				  		<div class="col-md-4 col-sm-6 col-xs-6">
																				  			<i class=" icon-clock" style="font-size:12px;"></i>					                    	
																	                    	{{ \Carbon\Carbon::createFromTimeStamp(strtotime($pa->thanks_dtTime))->diffForHumans() }}
																				  		</div>
																				  	</div>
																			  	</div>
															                 	
															                   	@elseif($pa->user->corpuser != null)
															                   	<div class="row" style="font-size:13px;border-bottom:1px dotted lightgrey;">
																			  		<div class="col-md-8" >
																				  		<div class="col-md-2 col-sm-3 col-xs-3">
																				  			<img src="@if($pa->user->corpuser->logo_status != null){{ '/img/profile/'.$pa->user->corpuser->logo_status }}@else{{'/assets/images/ab.png'}}@endif" 
																                    		 width="45" height="45" 
																                    		 class="img-circle">
																				  		</div>
																				  		<div class="col-md-6 col-sm-9 col-xs-9">
																				  			<a href="/profile/corp/{{$pa->user->corpuser->id}}" data-utype="ind">
																	                    		 {{$pa->user->corpuser->firm_name}}</a> has thanked this post
																				  		</div>
																				  		<div class="col-md-4 col-sm-6 col-xs-6">
																				  			<i class=" icon-clock" style="font-size:12px;"></i>					                    	
																                    	{{ \Carbon\Carbon::createFromTimeStamp(strtotime($pa->thanks_dtTime))->diffForHumans() }}
																				  		</div>
																				  	</div>
																			  	</div>
															                   	
															                   	@endif
														                   	@endif									                 
														                  @endforeach							                  
														                </ul>
																	</div>
																</div>
															</div>

															<div class="tab-pane" id="tab_1_{{ $post->id }}_4">
																<div class="portlet light" style="padding:0px !important;">
																	<?php $i=0; ?>
																		@foreach($post->postactivity as $pa)
																  			@if($pa->share == 1) <?php $i++; ?> @endif
																  		@endforeach
																  		<?php 
																	  		if($i>0){
																	echo "<div class='portlet-title'>
																			<div class='pull-left '>
																				<label class='contacted-css'>People who have Shared</label>
																			</div>
																		</div>";
																		}else{
																		echo "<div class='pull-left '>
																			<label class='contacted-css'>No one has Shared.</label>
																		</div>";
																		}
																	?>
																	<div class="portlet-body">
																		<ul data-handle-color="#637283" style="padding: 0">
																		 @foreach($post->postactivity as $pa)
																		  	@if($pa->share == 1)
																		  	@if($pa->user->induser != null)
																			  	<div class="row" style="font-size:13px;border-bottom:1px dotted lightgrey;">
																			  		<div class="col-md-8">
																				  		<div class="col-md-2 col-sm-3 col-xs-3">
																				  			<img src="@if($pa->user->induser->profile_pic != null){{ '/img/profile/'.$pa->user->induser->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" 
																	                    		 width="45" height="45" 
																	                    		 class="img-circle">
																				  		</div>
																				  		<div class="col-md-6 col-sm-9 col-xs-9">
																				  			<a href="/profile/ind/{{$pa->user->induser->id}}" data-utype="ind">
																		                    		{{$pa->user->induser->fname}}</a> has shared this post
																				  		</div>
																				  		<div class="col-md-4 col-sm-6 col-xs-6">
																				  			<i class=" icon-clock" style="font-size:12px;"></i>					                    	
																	                    	{{ \Carbon\Carbon::createFromTimeStamp(strtotime($pa->share_dtTime))->diffForHumans() }}
																				  		</div>
																				  	</div>
																			  	</div>
															                 	
															                   	@elseif($pa->user->corpuser != null)
															                   	<div class="row" style="font-size:13px;border-bottom:1px dotted lightgrey;">
																			  		<div class="col-md-8" >
																				  		<div class="col-md-2 col-sm-3 col-xs-3">
																				  			<img src="@if($pa->user->corpuser->logo_status != null){{ '/img/profile/'.$pa->user->corpuser->logo_status }}@else{{'/assets/images/ab.png'}}@endif" 
																                    		 width="45" height="45" 
																                    		 class="img-circle">
																				  		</div>
																				  		<div class="col-md-6 col-sm-9 col-xs-9">
																				  			<a href="/profile/corp/{{$pa->user->corpuser->id}}" data-utype="ind">
																	                    		 {{$pa->user->corpuser->firm_name}}</a> has shared this post
																				  		</div>
																				  		<div class="col-md-4 col-sm-6 col-xs-6">
																				  			<i class=" icon-clock" style="font-size:12px;"></i>					                    	
																                    	{{ \Carbon\Carbon::createFromTimeStamp(strtotime($pa->share_dtTime))->diffForHumans() }}
																				  		</div>
																				  	</div>
																			  	</div>
															                   	
															                   	@endif
																			  	
														                   	@endif									                 
														                  @endforeach							                  
														                </ul>
																	</div>
																</div>
															</div>

														</div>
													</div>
												</div>
											</div>
										</div>
									</div>								
								</div>
							</div>
						</div>
					</div>			
				<!-- </div> -->
				<!-- END TIMELINE ITEM -->	
				</div>
			</div>
			
			<!-- END TIMELINE ITEM -->

<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="extend-job-expiry-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form action="/job/extended" class="horizontal-form" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="post_id" value="{{ $post->id }}">
			<input type="hidden" name="post_duration" value="{{ $post->post_duration }}">
		     <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		        <h4 class="modal-title">Extend Post Validity</h4>
		      </div>
		      <div class="modal-body">
		      		@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<div class="form-group">
						<label>Post Duration</label>
						<div class="input-group">
							<span class="input-group-addon">
							<i class="icon-clock" style=" color: darkcyan;"></i>
							</span>
							<select name="post_duration_extend" class="form-control" >						
								<option value="3">3 Days</option>
								<option value="7">7 Days</option>
								<option value="15">15 Days</option>
								<option value="30">30 Days</option>
							</select>
						</div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="submit" class="btn btn-success">Update</button>
		        <button type="button" class="btn default" data-dismiss="modal">Close</button>
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
	
<div class="modal fade" id="myactivity-post" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog-new">
		<div class="modal-content">
			<div id="myactivity-post-content">
				My Activity Post 
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="viewcontact-view" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog-new">
		<div class="modal-content">
			<div id="viewcontact-view-content">
				My Activity Post 
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- SHARE MODAL FORM-->
<div class="modal fade" id="share-post" tabindex="-1" role="dialog" aria-labelledby="share-post" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Share post</h4>
      </div>
      <form class="form-horizontal" id="modal-post-share-form" role="form" method="POST" action="/post/share">
      <div class="modal-body">
                  
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="share_post_id" id="modal_share_post_id" value="">
		@if(Auth::user()->induser)

		<div id="post-share-msg-box" style="display:none">
			<div id="post-share-msg"></div>
		</div>
		<div id="post-share-form-errors" style="display:none"></div>

		<div class="row"> 
            <div class="col-md-6">                      
              <h4>Who can see this Post</h4>
            </div>
            <div class="col-md-6">
              <!-- <label for="tag-group-all" style="padding: 5.5px 12px;">
                <input type="checkbox" id="tag-group-all" name="tag-group" value="all" class="md-radiobtn">
                Public 
              </label> -->
              <label for="tag-group-links" style="padding: 5.5px 12px;">
                <input type="checkbox" id="tag-group-links" name="tag-group" value="links" class="md-radiobtn" >
                Links 
              </label>
              <label for="tag-group-groups" style="padding: 5.5px 12px;">
                <input type="checkbox" id="tag-group-groups" name="tag-group" value="groups" class="md-radiobtn" >                  
                Groups 
              </label>
            </div>
		</div>          

      	<div class="row"> 
            <div class="col-md-12" id="connections-list">
            
            <label>Links</label>
            {!! Form::select('share_links[]', $share_links, null, ['id'=>'connections', 'class'=>'form-control', 'multiple']) !!}               
            </div>    
		</div>
		<div class="row"> 
			<div class="col-md-12" id="groups-list">
	            <label>Groups</label>
	            {!! Form::select('share_groups[]', $share_groups, null, ['id'=>'groups', 'class'=>'form-control', 'multiple']) !!}  
	        </div>             
		</div>
		@endif            
     
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-success" id="modal-post-share-btn">Share</button>
        <button type="button" class="btn btn-sm default" data-dismiss="modal">Close</button>
      </div>      
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END SHARE MODAL FORM -->
<div class="modal fade" id="myactivity-posts" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="myactivity-posts-content">
				My Activity Post 
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Magic Match MODAL FORM-->
<div class="modal fade" id="mypost_magicmatch" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="mypost-magicmatch-posts-content">
        <div style="text-align:center;">
          <img src="/assets/global/img/loading.gif"><span> Please wait...</span>
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
	// myactivity-post
$('.myactivity-posts').on('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('postid');
  	var u_id = $(this).parent().data('uid');
  	console.log(post_id);
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $.ajax({
      url: "/postdetail/detail",
      type: "post",
      data: {postid: post_id, uid: u_id},
      cache : false,
      success: function(data){
    	$('#myactivity-posts-content').html(data);
    	$('#myactivity-posts').modal('show');
      }
    }); 
    return false;
});
});
  </script>
<script type="text/javascript">
	jQuery('#show-social').hide();
	jQuery(document).ready(function(){ 
	    jQuery('#hide-social').on('click', function(event) {
	    jQuery('#show-social').toggle('show');
	    });
	});

	// Magicmatch-post

	$(document).ready(function() {
	    $('.mypost_magicmatch').live('click', function(event) {
	        event.preventDefault();
	        var post_id = $(this).data('mpostid');

	        // console.log(post_id);
	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });

	        $.ajax({
	            url: "/mypostmagicmatch/detail",
	            type: "post",
	            data: {
	                postid: post_id
	            },
	            cache: false,
	            success: function(data) {
	                $('#mypost-magicmatch-posts-content').html(data);
	                $('#mypost_magicmatch').modal('show');
	            }
	        });
	        return false;
	    });
	});




	$(document).ready(function(){ 
		
	    $('.show-contact').on('click', function(event) {
	    var post_id = $(this).parent().data('id');
	    $('#hide-contact-'+post_id).show();
	    });
	});

$(document).ready(function(){
  $('.like-btn').on('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('id');

  	var formData = $('#post-'+post_id).serialize(); 
    var formAction = $('#post-'+post_id).attr('action');

	$count = $('#like-count-'+post_id).text();
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $.ajax({
      url: formAction,
      type: "post",
      data: formData,
      cache : false,
      success: function(data){
        if(data > $count){
 			$('#like-count-'+post_id).text(data);
 			$('#like-btn-'+post_id).css({'background-color':'lightgreen'});
        }else if(data < $count){
 			$('#like-count-'+post_id).text(data);
 			$('#like-btn-'+post_id).css({'background-color':'burlywood'});
        }
      }
    }); 
    return false;
  }); 
});

</script>
<script>
// $('.content').slideUp(400);//reset panels

// $('.panel').click(function() {//open
//    var takeID = $(this).attr('id');//takes id from clicked ele
//    $('#'+takeID+'C').slideDown(400);
//                              //show's clicked ele's id macthed div = 1second
// });
// $('span').click(function() {//close
//    var takeID = $(this).attr('id').replace('Close','');
//    //strip close from id = 1second
//     $('#'+takeID+'C').slideUp(400);//hide clicked close button's panel
// });​

$(document).ready(function(){
	// myactivity-post
$('.myactivity-post').on('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('postid');

    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $.ajax({
      url: "/myactivity/postdetail",
      type: "post",
      data: {post_id: post_id},
      cache : false,
      success: function(data){
    	$('#myactivity-post-content').html(data);
    	$('#myactivity-post').modal('show');
      }
    }); 
    return false;
});

$('.viewcontact-view').on('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('postid');

    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $.ajax({
      url: "/viewcontact/view",
      type: "post",
      data: {post_id: post_id},
      cache : false,
      success: function(data){
    	$('#viewcontact-view-content').html(data);
    	$('#viewcontact-view').modal('show');
      }
    }); 
    return false;
});

// get post id for post share
	$('.sojt').on('click',function(event){
	  	var share_post_id = $(this).data('share-post-id');
	  	$('#modal_share_post_id').val(share_post_id);
	});
	
	$('#connections').select2({
            placeholder: "Select links to share"
        });
    $('#groups').select2({
            placeholder: "Select groups to share"
        });

    // share post 
    $('#modal-post-share-btn').on('click',function(event){       
	    event.preventDefault();
		loader('show');

		var share_post_id = $("#modal_share_post_id").val();
	    var formData = $('#modal-post-share-form').serialize(); // form data as string
	    var formAction = $('#modal-post-share-form').attr('action'); // form handler url
	    // console.log(share_post_id);
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      cache : false,
	      success: function(data){
	      	loader('hide');
	        if(data.data.page == 'home'){
	            $('#post-share-msg-box').removeClass('alert alert-danger');
	            $('#post-share-form-errors').hide();
	            $('#post-share-msg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#share-count-'+share_post_id).text(data.data.sharecount);
	            // console.log(data.data.sharecount+" - "+share_post_id);
	            $('#modal-post-share-form')[0].reset();
	            $("#connections").select2("val", "");
	            $("#groups").select2("val", "");
	            $("#connections").prop('disabled',true);
               	$("#groups").prop('disabled',true);
	            $('#post-share-msg').html('Post shared successfully ! <br/>');  
	            $("#share-post").fadeTo(2000, 500).slideUp(500, function(){	            	
               		 $('#share-post').modal('hide');
               		 $('#post-share-msg-box').hide();
               		 $('#post-share-msg-box').removeClass('alert alert-success');
               		 $('#post-share-msg-box').removeClass('alert alert-danger');               		 
                });   
	           
	        }
	      },
	      error: function(data) {
	        loader('hide');
		    var errors = data.responseJSON;
		    // console.log(errors);
		    $errorsHtml = '<div class="alert alert-danger"><ul>';
		    $.each(errors.errors, function(index, value) {
		    	console.log(value);
				 $errorsHtml += '<li>' + value[0] + '</li>';
		    });
	 		$errorsHtml += '</ul></div>';	            
	        $( '#post-share-form-errors' ).html( $errorsHtml );
	        $( '#post-share-form-errors' ).show();
	      }
	    }); 
	    return false;
  });
});
</script>
@stop