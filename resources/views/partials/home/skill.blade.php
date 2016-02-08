@include('partials.home.skill-filter')
@if (count($skillPosts) > 0)
	<?php $var = 1; ?>
	<div class="portlet light bordered" style="border: none !important;background:transparent;padding:0 !important;margin: -20px 0px;">								
		<div class="portlet-body form" id="post-skills">
				<div class="form-body" id="post-skill-items" style="padding:0;">
	@foreach($skillPosts as $post)
		@if($post->post_type == 'skill')					
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
									<div class="timeline-badge badge-margin">
										@if($post->induser != null && !empty($post->induser->profile_pic))
										<img class="timeline-badge-userpic userpic-box" src="/img/profile/{{ $post->induser->profile_pic }}" title="{{ $post->induser->fname }}">
										
										@elseif($post->corpuser != null && !empty($post->corpuser->logo_status))
										<img class="" src="/img/profile/{{ $post->corpuser->logo_status }}" title="{{ $post->corpuser->firm_name }}">
										
										@elseif(empty($post->corpuser->logo_status) && $post->corpuser != null )
										<img class="" src="/assets/images/corpnew.jpg">
										
										@elseif(empty($post->induser->profile_pic) && $post->induser != null)
										<img class="timeline-badge-userpic userpic-box" src="/assets/images/ab.png">
										
										@endif
										
									</div>
									@if($expired == 1)
									<div class="timeline-body new-timeline-body">
										@else
									<div class="timeline-body ">
										@endif
										<div class="timeline-body-head">
											<div class="timeline-body-head-caption" style="width:100%;margin:5px;">
												@if(Auth::user()->induser_id == $post->individual_id && $post->individual_id != null)
                                                @if(count($post->groupTagged) > 0)
                                                @if($post->sharedGroupBy->first()->mode == 'shared')
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <!-- Post shared by user -->                        
                                                        
                                                            <div class="shared-by">
                                                                {{$post->sharedGroupBy->first()->mode}} by 
                                                                <b>{{$post->sharedGroupBy->first()->fname}} 
                                                                {{$post->sharedGroupBy->first()->lname}}</b>
                                                                to <b>{{$post->sharedToGroup->first()->group_name}}</b> group<br/>
                                                            </div>
                                                        
                                                    </div>
                                                </div>
                                                @endif
                                            @endif
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <a href="/profile/ind/{{$post->individual_id}}" class="link-label " data-utype="ind">
                                                        <small>You</small>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                                                    <i class="fa fa-clock-o" style="font-size: 11px;"></i> 
                                                    <small>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                            @elseif(Auth::user()->corpuser_id == $post->corporate_id && $post->corporate_id != null)
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <a href="/profile/ind/{{$post->individual_id}}" class="link-label" data-utype="ind">
                                                        <small>You</small>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                                                    <i class="fa fa-clock-o" style="font-size: 11px;"></i> 
                                                    <small>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                            @elseif($post->individual_id != null)
                                                @if(count($post->groupTagged) > 0)
                                                @if($post->sharedGroupBy->first()->mode == 'shared')
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <!-- Post shared by user -->                        
                                                        
                                                            <div class="shared-by">
                                                                <small>{{$post->sharedGroupBy->first()->mode}} by {{$post->sharedGroupBy->first()->fname}} {{$post->sharedGroupBy->first()->lname}}</small> to <small>{{$post->sharedToGroup->first()->group_name}}</small> group<br/>
                                                            </div>
                                                        
                                                    </div>
                                                </div>
                                                @endif
                                            @endif
                                            @if($post->tagged->contains('user_id', Auth::user()->induser_id) && 
                                                $post->sharedBy->first()->mode == 'shared')
                                                
                                            <small> {{$post->sharedBy->first()->mode}} by 
                                                {{$post->sharedBy->first()->fname}} {{$post->sharedBy->first()->lname}}</small><br/>

                                            @endif
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <a href="/profile/ind/{{$post->individual_id}}" class="post-name-css">
                                                        {{ $post->induser->fname}} {{ $post->induser->lname}}
                                                    </a>
                                                </div>
                                                <div class="col-md-4 col-md-4 col-xs-12">
                                                	@if($post->individual_id != null && Auth::user()->induser_id != $post->individual_id && Auth::user()->identifier == 1)
														<div class="" data-puid="{{$post->individual_id}}" style="margin:4px 0;">
															@if($links->contains('id', $post->individual_id) )
															<a href="#links-follow" data-toggle="modal" class="user-link" data-linked="yes" data-utype="ind">
																<button class="btn btn-xs link-follow-icon-css"><i class="fa fa-link (alias) icon-size" style="color:white;"></i> Linked</button>
															</a>
															@elseif($linksPending->contains('id', $post->individual_id) )
															<a href="#links-follow" data-toggle="modal" class="user-link" data-linked="no" data-utype="ind">
																<button class="btn btn-xs linkrequest-follow-icon-css"><i class="icon-hourglass (alias) " style="color:dimgrey;font-size:10px;"></i> Link Requested</button>
															</a>
															@elseif($linksApproval->contains('id', $post->individual_id) )
															<a href="#links-follow " data-toggle="modal" class="user-link" data-linked="no" data-utype="ind">
																<button class="btn btn-xs linkrequest-follow-icon-css"><i class=" icon-hourglass (alias) " style="color:dimgrey;font-size:10px;"></i> Link Requested</button>
															</a>
															
															@else
															<a href="#links-follow" data-toggle="modal" class="user-link3" data-linked="no" data-utype="ind">
																<button class="btn btn-xs unlink-follow-icon-css"><i class="fa fa-unlink (alias) icon-size" style="color:dimgrey;"></i> Add Link</button>
															</a>
															@endif
														</div>
													@endif
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                                                    <i class="fa fa-clock-o post-icon-color" style="font-size: 11px;"></i> 
                                                    <small class="post-time-css">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                            @elseif($post->corporate_id != null)
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <a href="/profile/corp/{{$post->corporate_id}}" class="post-name-css">
                                                        {{ $post->corpuser->firm_name}}
                                                    </a>
                                                </div>
                                                <div class="col-md-4 col-md-4 col-xs-12">
                                                	<span class="firm-type-left" style="margin: 2px 0;">{{ $post->corpuser->firm_type}}</span> 
													<span class="follow-icon-right" data-puid="{{$post->corporate_id}}">
															@if($following->contains('id', $post->corporate_id))
															<a href="#links-follow" data-toggle="modal" class="user-link" data-linked="yes" data-utype="corp">
																<button class="btn btn-xs link-follow-icon-css"><i class="icon-check icon-size" style="color:white;"></i> Following</button>
															</a>
														@else
															<a href="#links-follow" data-toggle="modal" class="user-link3" data-linked="no" data-utype="corp">
																<button class="btn btn-xs unlink-follow-icon-css"><i class="icon-plus icon-size" style="color:dimgrey;"></i> Follow</button>
															</a>
														@endif
													</span>    
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                                                    <i class="fa fa-clock-o post-icon-color" style="font-size: 11px;"></i> 
                                                    <small class="post-time-css">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                            @endif
											</div>														
										</div>
										<!--  -->
										<div class="timeline-body-content">
											
                                        </div>													
										
										<div class="fav-dir">
											@if(Auth::user()->induser_id != $post->individual_id )
											<form action="/job/fav" method="post" id="post-fav-{{$post->id}}" data-id="{{$post->id}}">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="fav_post" value="{{ $post->id }}">

												<button class="btn fav-btn" type="button" style="background-color: transparent;padding:0 10px;border:0">
													@if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
													<i class="fa fa-star" id="fav-btn-{{$post->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
													@elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->fav_post == 1) 

													<i class="fa fa-star" id="fav-btn-{{$post->id}}" style="font-size: 20px;color:#FFC823"></i>
													@else
													<i class="fa  fa-star" id="fav-btn-{{$post->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
													@endif	
												</button>	
											</form>
											@endif
										</div>
									</div>

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
									<div class="portlet-body show-details">
										<div class="panel-group accordion" id="accordion{{$var}}" style="margin-bottom: 0;">
											<div class="panel panel-default" style=" position: relative;">
												<div class="panel-heading">
													<h4 class="panel-title">
													<a class="accordion-toggle " 
													data-toggle="collapse" data-parent="#accordion{{$var}}" href=""  style="font-size: 15px;font-weight: 600;" >
													Details: </a>	
													</h4>
												</div>
												<div id="collapse_{{$var}}_{{$var}}" class="panel-collapse">
													<div class="panel-body" style="border-top: 0;padding: 4px 15px;">
														
														<div class="row">
															@if($post->post_type == 'job')
															<div class="col-md-12 col-sm-12 col-xs-12">												
																	<label class="detail-label">Job Title :</label>					
																	{{ $post->post_title }}														 
															</div>
															@elseif($post->post_type == 'skill')
															<div class="col-md-12 col-sm-12 col-xs-12">												
																	<label class="detail-label">Skill Title :</label>					
																	{{ $post->post_title }}													 
															</div>
															@endif
															@if($post->post_type == 'job')
															<div class="col-md-12 col-sm-12 col-xs-12">												
																	<label class="detail-label">Education Required :</label>					
																	{{ $post->education }}														 
															</div>
															@else
															<div class="col-md-12 col-sm-12 col-xs-12">												
																	<label class="detail-label">Qualification :</label>								
																	{{ $post->education }}													 
															</div>
															@endif
															<div class="col-md-12 col-sm-12 col-xs-12">												
																	<label class="detail-label">Role :</label>										
																	{{ $post->role }}															
															</div>
															<div class="col-md-12 col-sm-12 col-xs-12">												
																	<label class="detail-label">Job Category :</label>								
																	{{ $post->prof_category }}													 
															</div>
															@if( $post->min_exp != null && $post->max_exp != null)
															<div class="col-md-12 col-sm-12 col-xs-12">												
																	<label class="detail-label">Experience :</label>										
																	{{ $post->min_exp}}-{{ $post->max_exp}} Years															
															</div>
															@else
															<div class="col-md-12 col-sm-12 col-xs-12">												
																	<label class="detail-label"><i class="icon-briefcase"></i> :</label>										
																	Not Provided															
															</div>
															@endif
															<div class="col-md-12 col-sm-12 col-xs-12">											
																	<label class="detail-label">Skills :</label>									
																	@foreach($post->skills as $skill)
																		{{$skill->name}},
																	@endforeach																 
															</div>
															@if($post->post_type == 'job' && $post->min_sal != null && $post->max_sal != null)
															<div class="col-md-12 col-sm-12 col-xs-12">												
																<label class="detail-label">Salary (<i class="fa fa-rupee (alias)"></i>):</label>
																{{ $post->min_sal }}-{{ $post->max_sal }} {{ $post->salary_type }} 
															</div>
															@elseif($post->post_type == 'skill' && $post->min_sal != null && $post->max_sal != null)
															<div class="col-md-12 col-sm-12 col-xs-12">												
																<label class="detail-label">Expected Salary (<i class="fa fa-rupee (alias)"></i>):</label>
																{{ $post->min_sal }}-{{ $post->max_sal }} {{ $post->salary_type }} 
															</div>
															@endif
															
															<div class="col-md-12 col-sm-12 col-xs-12">
																<label class="detail-label">Job Type :</label>
																{{ $post->time_for }}
															</div>
															@if($post->locality != null && $post->city !=null)
															<div class="col-md-12 col-sm-12 col-xs-12">
																<label class="detail-label">Locality :</label>
																{{ $post->locality }},{{ $post->city }} 
															</div>
															@elseif($post->locality == null && $post->city !=null)
															<div class="col-md-12 col-sm-12 col-xs-12">
																<label class="detail-label">City :</label>
																{{ $post->city }} 
															</div>
															@endif
														</div>
														
														<div class="skill-display">Description : </div>
														{{ $post->job_detail }}
														
														@if($post->post_type == 'job' && $post->reference_id != null)
														<div class="skill-display">Reference Id&nbsp;: {{ $post->reference_id }} </div>	
														@endif

														@if($expired != 1 && $post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
														@elseif($expired != 1 && $post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1)
														<div  class="skill-display ">Contact Details : </div> 
														<div id="show-hide-contacts" class="row">
															@if($post->post_type == 'job' && $post->website_redirect_url != null)
															<div class="col-md-12 col-sm-12 col-xs-12">
																Click on Apply, it will redirect you to Company Website.
															</div>
															@endif
															@if($post->post_type == 'job' && $post->website_redirect_url != null && $post->corpuser != null)
															<div class="col-md-12 col-sm-12 col-xs-12">												
																<label class="detail-label"><i class="glyphicon glyphicon-globe" style="color: deepskyblue;"></i> :</label>
																{{ $post->website_url }}															
															</div>
															@endif
															@if($post->website_redirect_url == null && $post->contact_person != null)
															<div class="col-md-12 col-sm-12 col-xs-12">												
																<label class="detail-label"><i class="glyphicon glyphicon-user"></i> :</label>
																{{ $post->contact_person }}															
															</div>
															@endif

															@if($post->email_id != null && $post->alt_emailid != null && $post->website_redirect_url == null)
															<div class="col-md-12 col-sm-12 col-xs-12">
																
																	<label class="detail-label"><i class="glyphicon glyphicon-envelope"></i> :</label>																
																	{{ $post->email_id }} - {{ $post->alt_emailid }}							
															</div>	
															
															@elseif($post->email_id != null && $post->alt_emailid == null && $post->website_redirect_url == null)
															<div class="col-md-12 col-sm-12 col-xs-12">
																
																	<label class="detail-label"><i class="glyphicon glyphicon-envelope"></i> :</label>
																	{{ $post->email_id }}
																
															</div>
															@elseif($post->email_id == null && $post->alt_emailid != null && $post->website_redirect_url == null)
															<div class="col-md-12 col-sm-12 col-xs-12">
																
																	<label class="detail-label"><i class="glyphicon glyphicon-envelope"></i> :</label>
																		{{ $post->alt_emailid }}
																 
															</div>	
															@endif	
															@if($post->phone != null && $post->alt_phone != null && $post->website_redirect_url == null)
															<div class="col-md-12 col-sm-12 col-xs-12">
																
																	<label class="detail-label"><i class="glyphicon glyphicon-earphone"></i> :</label>
																
																	
																	{{ $post->phone }} - {{ $post->alt_phone }}
																 
															</div>	
															@elseif($post->phone != null && $post->alt_phone == null && $post->website_redirect_url == null)
															<div class="col-md-12 col-sm-12 col-xs-12">
																
																	<label class="detail-label"><i class="glyphicon glyphicon-earphone"></i> :</label>
																
																	
																	{{ $post->phone }}
																
															</div>
															@elseif($post->phone == null && $post->alt_phone != null && $post->website_redirect_url == null)
															<div class="col-md-12 col-sm-12 col-xs-12">
																
																	<label class="detail-label"><i class="glyphicon glyphicon-earphone"></i> :</label>
																
																		{{ $post->alt_phone }}
																
															</div>	
															@endif										
														</div>
														@endif

														<div class="skill-display">Post Id&nbsp;: {{ $post->unique_id }} </div>


														@if($expired != 1)
															 <div class="skill-display">Post expires on: 										 
															 <span class="btn-success" style="padding: 2px 8px;font-size: 12px;border-radius: 20px !important;">{{$fresh->format("d M Y")}}</span>
															 </div>
														 @else
															 <div class="skill-display">Post expired on: 										 
															 <span class="btn-danger" style="padding: 2px 8px;font-size: 12px;border-radius: 20px !important;">{{$fresh->format("d M Y")}}</span>
															 </div>
														@endif
													</div>
												</div>

												@if($expired != 1 )
												<div style="margin:27px 0 0;">
													@if($post->post_type == 'skill' && Auth::user()->induser_id != $post->individual_id)       
												    @if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
												        <form action="/job/contact" method="post" id="post-contact-{{$post->id}}" data-id="{{$post->id}}">  
												            <input type="hidden" name="_token" value="{{ csrf_token() }}">
												            <input type="hidden" name="contact" value="{{ $post->id }}">
												            <button class="btn contact-btn green btn-sm apply-contact-btn show-contact" 
												                    id="contact-btn-{{$post->id}}" type="button">Contact
												            </button>
												        </form> 
												    @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1) 
												        <button type="button" class="btn btn-sm bg-grey-steel apply-contact-btn" disabled="true">
												            <i class="glyphicon glyphicon-ok"></i> Contacted
												        </button>
												        <div class="center-css">
												        	{{ date('M d, Y', strtotime($post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view_dtTime)) }}
												        </div>
												        @else
												    <form action="/job/contact" method="post" id="post-contact-{{$post->id}}" data-id="{{$post->id}}">  
												        <input type="hidden" name="_token" value="{{ csrf_token() }}">
												        <input type="hidden" name="contact" value="{{ $post->id }}">
												        <button class="btn contact-btn green btn-sm apply-contact-btn" 
												                id="contact-btn-{{$post->id}}" type="button">Contact
												        </button>
												    </form>                         
												    @endif  
												@endif
												</div>
												@elseif($expired == 1)
												<div class="row" style="text-align:center;">
												    @if(Auth::user()->induser_id != $post->individual_id && Auth::user()->identifier == 1) 
												        @if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty()) 
												            <div class="col-md-4 col-sm-4 col-xs-4">
												            </div>
												        @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->apply == 1) 
												            <div class="col-md-4 col-sm-4 col-xs-4">
												                <i class="fa fa-check-square-o"></i><span class="hidden-sm hidden-xs"> Applied</span> 
												            </div>
												        @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1) 
												            <div class="col-md-4 col-sm-4 col-xs-4">
												                <i class="fa fa-check-square-o"></i><span class="hidden-sm hidden-xs"> Contacted</span> 
												            </div>
												        @endif
												    <div class="col-md-4 col-sm-4 col-xs-4">
												        <i class="glyphicon glyphicon-ban-circle"></i> Expired
												    </div>
												    @endif
												</div>                                      
												@endif

											</div>
										</div>
										<div style="float: right; right: 15px; position: absolute; bottom: 3px;"><a class="hide-detail">Hide Details</a></div>
									</div>

								</div>
							</div>
							<!-- END TIMELINE ITEM -->
						</div>
						@endif
					
				</div>							
	@endif
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
