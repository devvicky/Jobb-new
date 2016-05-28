@extends('master')
@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="/home">home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li class="active">
			My Links
		</li>
	</ul>
</div>
<!-- END PAGE BREADCRUMB -->
<div class="row margin-top-10">
	<div class="col-md-12">
		<!-- BEGIN PROFILE SIDEBAR -->
		<div class="profile-sidebar" style="width: 250px;">
			<!-- PORTLET MAIN -->
			<div class="portlet light profile-sidebar-portlet">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<a id="ajax-demo" href="#profile-pic" data-toggle="modal" class="config">
	                    @if(Auth::user()->induser->profile_pic != null)
	                      <img src="/img/profile/{{ Auth::user()->induser->profile_pic }}" class="img-responsive">
	                      <div class="hover-image"><i class="glyphicon glyphicon-edit"></i>Edit</div>
	                    @elseif(Auth::user()->induser->profile_pic == null)
	                      	<div class=" badge-margin post-image-css">
		                        <i class="fa fa-user" style="font-size: 90px;margin: 52px 29px;color: #777;"></i> 
		                    </div>
	                    @endif
	                </a>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						 {{ Auth::user()->induser->fname }} {{ Auth::user()->induser->lname }}
					</div>
					<div class="profile-usertitle-job">
						@if(Auth::user()->induser->role != null) {{Auth::user()->induser->role}} @endif 
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav" style="padding:0;">
						<li class="active">
							<a href="#tab_1_1" data-toggle="tab" class="links"><i class=" icon-user"></i>Links </a>
						</li>
						<li>
							<a href="#tab_1_2" data-toggle="tab" class="groups"><i class="icon-briefcase"></i>Groups</a>
						</li>
						<li>
							<a href="#tab_1_3" data-toggle="tab" class="links"><i class="icon-briefcase"></i>Following @if($followCount > 0)
						<span class="badge" style="background-color: deepskyblue;">{{$followCount}} </span>
					@endif</a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
				<!-- PORTLET MAIN -->
			</div>
			<div class="portlet light">
				<!-- <div class="row list-separated profile-stat">
					<label>Note :</label>
				</div>
				<div class="row list-separated profile-stat">
					<label><span class="required">*</span> Click on Group Name to see the details</label>
				</div> -->
			</div>
			<!-- END PORTLET MAIN -->
		</div>
		<div class="profile-content">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-9">
							<!-- BEGIN PORTLET -->
							<div class="portlet light normal_search" style="background-color:white;">
								<div class="portlet-title ">
									<div class="caption caption-md">
										<i class="icon-bar-chart theme-font hide"></i>
										<span class="caption-subject font-blue-madison bold uppercase">Search</span>
									</div>
								</div>
								<div class="portlet-body">
									<div class=" input-icon right normal_search">
										<i class="fa fa-search" style="color: darkcyan;right:80px;bottom:6px;"></i>
										<input type="text" name="keywords" id="search-input" onkeydown="down()" onkeyup="up()" class="form-control" placeholder="Search Users" style="">
										<a class="advance-search btn search-advance-tool">Advance</a>
									</div>	
									<div class="col-md-12 links-title" id="search-results" style="background:#F9F9F9;max-height:200px;overflow:auto;">
									</div>
								</div>
							</div>
							<!-- END PORTLET -->
						</div>
					</div>
					<div class="row clearfix" style="margin-bottom:10px">	
						<!-- BEGIN ADVANCED SEARCH -->
						<div class="col-md-9 col-sm-8">
							<!-- BEGIN PORTLET -->
							<div class="portlet light show-adsearch" style="background-color:white;">
								<div class="portlet-title ">
									<div class="caption caption-md">
										<i class="icon-bar-chart theme-font hide"></i>
										<span class="caption-subject font-blue-madison bold uppercase">Advance Search</span>
									</div>
								</div>
								<div class="portlet-body">
									<!-- END PORTLET -->
									<div class="show-adsearch">
										<form id="search-profiles" action="/search/profile" method="post">
									      	<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<!-- <div class="row-md-2"></div> -->
											<div class="row" style="margin-bottom: 20px;margin-top: 10px;">
												<div class="col-md-12 col-sm-12 col-xs-12 advance-len" style="margin:10px 0;">
												  <div class="input-group" style="margin:0 auto;">
												    <div class="icheck-inline">
												      <label>
												      	<input id="id_radio1" type="radio" checked name="type" value="people" class="">
												      	People
												      </label>
												      <label>
												      	<input id="id_radio2" type="radio" value="company" name="type" class="">
												      	Company
												      </label>
												    </div>
												  </div>
												</div> 
											</div>
											<div class="row show-firm-type" style="margin: 0px auto; float: none; display: table;">
												<div class="btn-group col-md-12 col-sm-12 col-xs-12" style="margin:10px;" data-toggle="buttons">
													<label>
														<input type="checkbox" class="icheck" 
																name="firm_type[]" value="Company"
																data-checkbox="icheckbox_line-grey" 
																data-label="Company" checked>
													</label>												
													<label>
														<input type="checkbox" class="icheck" 
																name="firm_type[]" value="Consultancy"
																data-checkbox="icheckbox_line-grey" 
																data-label="Consultancy" checked>
													</label>
												</div>
											</div>
											<div class="row" style="margin:0;">
												<div class="col-md-6 col-sm-6 col-xs-12">
												  <div class="form-group">              
												      <input type="text" name="name" class="form-control filter-input group" 
												      			placeholder="Enter Name or Email Id" />
												  </div>  
												</div>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="text" id="city" name="city" class="form-control" placeholder="Enter City">
												</div>
											</div>
									       <div class="row" style="margin:0;">
												<div class="col-md-12 col-sm-12 col-xs-12 hide-role">
													<div class="form-group">
														<input type="text" class="form-control" name="role" placeholder="Enter Keywords">
													</div>					
												</div>
									        </div>
											<div class="row show-comp" style="margin:0;">
												<div class="col-md-6 col-sm-6 col-xs-12">
												  	<div class="form-group">              
												      <input type="text" name="working_at" class="form-control filter-input" placeholder="Working at">
												  	</div>  
												</div>
												<div class="col-md-6 col-sm-6 col-xs-12">
												  	<div class="form-group">              
												      <input type="text" id="mobile" name="mobile" class="form-control filter-input group" placeholder="Mobile No">
												  	</div>  
												</div>
											</div>
									      	<div class="row" style="margin-bottom: 10px;">
										        <div class="col-md-12 col-sm-12 col-xs-12">
													<div class="footer links-title center-css">              
													  <button type="submit" class="btn blue "><i class="glyphicon glyphicon-search"></i> Search</button>	
													</div> 
													<div class="advance-search group-back-position">
														<button type="button" class="btn" style="background-color:transparent;">
														<i class="glyphicon glyphicon-chevron-left"></i> Back</button>
													</div>
										        </div>		        
									      	</div>
									    </form>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1_1">
							<div class="row">
								<div class="col-md-9">
									<!-- BEGIN PORTLET -->
									<div class="portlet light " style="background-color:white;">
										<!-- <div class="portlet-title">
											<div class="caption caption-md">
												<i class="icon-bar-chart theme-font hide"></i>
												<span class="caption-subject font-blue-madison bold uppercase">Linked </span>

											</div>
										</div> -->
										<div class="portlet-body">
											<div class="tabbable-line">
												<ul class="nav nav-tabs" style="padding-left:0;">
													<li class="active">
														<a href="#tab_15_1" data-toggle="tab">
														Linked @if($linksCount > 0)
															<span class="badge" style="background-color: deepskyblue;">{{$linksCount}} </span>
														@endif</a>
													</li>
													<li>
														<a href="#tab_15_2" data-toggle="tab">
														Link Request @if($linkrequestCount > 0)
															<span class="badge" style="background-color: deepskyblue;">{{$linkrequestCount}} </span>
														@endif</a>
													</li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane active" id="tab_15_1">
														@if(count(Auth::user()->induser->friends) != null)
														@foreach(Auth::user()->induser->friends as $connection)
															 @if($connection->pivot->status == 1)

														<div class="row search-user-tool" style="margin:0;">					
																<div class="col-md-2 col-sm-3 col-xs-3">
																	<a href="#">
																        <img class="media-object img-circle" 
																        src="@if($connection->profile_pic != null){{ '/img/profile/'.$connection->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" 
																      	alt="DP" style="width: 50px;">
																     </a>
																</div>
																<div class="col-md-6 col-sm-6 col-xs-6">
																	 <a href="/profile/ind/{{$connection->id}}" data-utype="ind" style="font-size:15px;">
																     {{ $connection->fname }} </a><br>
																    <small>
									                                
															        @if($connection->working_status == "Student")
									                                
									                                     {{ $connection->education }} in {{ $connection->branch }}, {{ $connection->city }}
									                                
									                                @elseif($connection->working_status == "Searching Job")
									                                
									                                      {{ $connection->city }}
									                                
									                                @elseif($connection->role != null && $connection->working_status == "Freelanching")
									                                
									                                     {{ $connection->role }} <br/> {{ $connection->city }}
									                                
									                                @elseif($connection->role != null && $connection->working_at !=null && $connection->working_status == "Working")
									                                
									                                     {{ $connection->role }} <br/> {{ $connection->city }}
									                            
									                                @elseif($connection->role != null && $connection->working_at ==null && $connection->working_status == "Working")
									                                
									                                     {{ $connection->role }}<br/> {{ $connection->city }}
									                                
									                                @elseif($connection->role == null && $connection->working_at ==null && $connection->working_status == "Working")
									                                
									                                   {{ $connection->city }}
									                               
									                                @endif
																      </small>
																</div>
																<div class="col-md-3 col-sm-3 col-xs-2" style="margin:7px 0">	
																	<div class="btn-group">
																		<button class="btn blue dropdown-toggle link-icon-css" type="button" data-toggle="dropdown">
																		<i class="fa  fa-ellipsis-v"></i> 
																		</button>
																		<ul class="dropdown-menu dropdown-menu-link" role="menu" style="text-align:center;border: 1px solid #ECECEC;">
																			<li style="border-bottom:1px solid lightgrey;">
																				<a href="/profile/ind/{{$connection->id}}" style="padding:5px 14px !important;">
																				<button class="btn btn-success connection-css">View Profile </button></a>
																			</li>
																			
																			<li style="margin:5px 0;">
																				<form action="/connections/destroy/{{$connection->pivot->id}}" method="post">
																				<input type="hidden" name="_token" value="{{ csrf_token() }}">
																				<button type="submit" name="action" class="btn btn-success connection-css">Remove Link</button>		
																				</form>
																			</li>
																			
																		</ul>
																	</div>
																</div>
															 				    
														</div>
														@endif	
														@endforeach
														@else
															<div class="row" style="margin: 0px -35px 0px -9px;">
																<div class="col-md-12">
																	<i class="fa fa-frown-o" style="font-size: 16px !important;"></i> You have no Link
																</div>
															</div>
														@endif	
													</div>
													<div class="tab-pane" id="tab_15_2">
														@if($linkrequestCount > 0)
														@foreach(Auth::user()->induser->friendOf as $conreq)
														@if($conreq->pivot->status == 0)
														<div class="row search-user-tool" style="margin: 0px -10px;">	
															<div class="col-md-2 col-sm-3 col-xs-3">
																<a href="#">
															        <img class="media-object img-circle " 
															        src="@if($conreq->profile_pic != null){{ '/img/profile/'.$conreq->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" 
															      	alt="DP" style="width:50px;">
															     </a>

															</div>
															<div class="col-md-6 col-sm-6 col-xs-6" style="padding: 0px 7px 7px 2px;">
																 <a href="/profile/ind/{{$conreq->id}}" data-utype="ind" style="font-size:15px;">
															    		 	 	{{ $conreq->fname }} {{ $conreq->lname }}</a><br>
															    <small>
									                            
														          @if($conreq->working_status == "Student")
									                            
									                                 {{ $conreq->education }} in {{ $conreq->branch }}, {{ $conreq->city }}
									                            
									                            @elseif($conreq->working_status == "Searching Job")
									                            
									                                 {{ $conreq->working_status }} in {{ $conreq->prof_category }}, {{ $conreq->city }}
									                            
									                            @elseif($conreq->working_status == "Freelanching")
									                            
									                                 {{ $conreq->role }} {{ $conreq->working_status }}, {{ $conreq->city }}
									                            
									                            @elseif($conreq->role != null && $conreq->working_at !=null && $conreq->working_status == "Working")
									                            
									                                 {{ $conreq->role }} @ {{ $conreq->working_at }} 
									                        
									                            @elseif($conreq->role != null && $conreq->working_at ==null && $conreq->working_status == "Working")
									                            
									                                 {{ $conreq->role }}, {{ $conreq->city }}
									                            
									                            @elseif($conreq->role == null && $conreq->working_at !=null && $conreq->working_status == "Working")
									                            
									                                 {{ $conreq->woring_at }}, {{ $conreq->city }}
									                            
									                            @elseif($conreq->role == null && $conreq->working_at ==null && $conreq->working_status == "Working")
									                            
									                                {{ $conreq->city }}
									                           
									                            @endif
															      </small>
															</div>
															<div class="col-md-3 col-sm-3 col-xs-3" style="margin: 0px -10px;padding:0;">
																<form action="/connections/responselink/{{$conreq->pivot->id}}" id="accept-reject" method="post">
																	<input type="hidden" name="_token" value="{{ csrf_token() }}">
																	<button type="submit" name="action" value="accept" class="btn apply-ignore-font" style="padding: 0px 3px; background-color: white;">
																		<i class="icon-check icon-check-css-new"></i>
																	</button>
																	<button type="submit" name="action" value="reject" class="btn apply-ignore-font" style="padding: 0px 3px; background-color: white;">
																		<i class="icon-close icon-close-css"></i>
																	</button>
																</form>
															</div>
														</div>
														@endif
														@endforeach
														@else
															<div class="row" style="margin: 0px -35px 0px -9px;">
																<div class="col-md-12">
																	<i class="fa fa-frown-o" style="font-size: 16px !important;"></i> You have no Link Request
																</div>
															</div>
														@endif
													</div>
												</div>
											</div>
											
										</div>
									</div>
									<!-- END PORTLET -->
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_1_2">
							<div class="row" style="margin-top: -10px;">
								<div class="col-md-9">
									<!-- BEGIN PORTLET -->
									<div class="portlet light " style="background-color:white;">
										<div class="portlet-title">
											<div class="caption caption-md">
												<i class="icon-bar-chart theme-font hide"></i>
												<span class="caption-subject font-blue-madison bold uppercase">Create Group</span>
											</div>
										</div>
										<div class="portlet-body">
											<a id="ajax-demo" href="#create-group" data-toggle="modal" class="btn btn-sm btn-success" style="text-decoration: none;">
												Create				
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
										
										<!-- <div class="portlet-body"> -->
											@if(count($groups)>0)
											@foreach($groups as $group)
											<!-- BEGIN PORTLET -->
											<div class="portlet light " style="background-color:white;">
												<div class="portlet-title">
													<div class="caption caption-md" style="width:100%;">
														<a href="/group/{{ $group->id }}">
															<span class="caption-subject font-blue-madison bold uppercase" style="font-size: 14px;">
																{{ $group->group_name }}
															</span>
														</a>
														@if($group->posts_count == 1)
														<button class="btn btn-success" style="padding: 0 5px;border-radius: 3px !important; background-color: deepskyblue;border-color: deepskyblue;">
															<a href="/postingroup/{{$group->id}}" style="color:white;font-size: 12px;">
																{{$group->posts_count}} Post
															</a>
														</button><br/>
														@elseif($group->posts_count > 1)
														<button class="btn btn-success" style="padding: 0 5px;border-radius: 3px !important; background-color: deepskyblue;border-color: deepskyblue;">
															<a href="/postingroup/{{$group->id}}" style="color:white;font-size: 12px;">
																{{$group->posts_count}} Posts
															</a>
														</button><br/>
														@else
														<button class="btn btn-success" style="padding: 0 5px;border-radius: 3px !important;font-size: 12px; background-color: darkgray;border-color: darkgray !important;">
															No Post
														</button><br/>
														@endif

													</div>
													<div>
														<label style="font-size: 13px;opacity:0.8;">
															@if($group->admin->id == Auth::user()->induser_id)
															<i class="icon-shield" style="font-size:12px;"></i> You
															@else
															<a href="/profile/ind/{{$group->admin()->first()->id}}" style="color:#6D5D5D;"><i class="icon-shield" style="font-size:12px;"></i> {{$group->admin()->first()->fname}}</a>
															@endif
														</label>
														<label style="font-size: 11px;opacity:0.8;float:right;">
															<i class="fa fa-calendar" style="font-size: 12px;"></i> {{ date('d M Y', strtotime($group->created_at)) }}
														</label>
													</div>
												</div>
												<div class="portlet-body" style="padding-top:0;">
													<div class="row">
														<div class="col-md-6 col-sm-6 col-xs-6">
															<i class="fa fa-users"></i> {{count($group->users)}}
														</div>
														<div class="col-md-6 col-sm-6 col-xs-6">
															@if($group->admin->id == Auth::user()->induser_id)
																<a href="/group/{{ $group->id }}" style="color: dodgerblue;font-weight: 600;">
																	<i class="fa fa-edit (alias)"></i> Edit
																</a>
															@else
																<a href="/group/{{ $group->id }}" style="color: dodgerblue;font-weight: 600;">
																	<i class="fa fa-plus-circle"></i> Add
																</a>
															@endif
														</div>
													</div>
													
												</div>
											</div>
											<!-- END PORTLET -->
											@endforeach
											@endif
										<!-- </div> -->
									<!-- </div> -->
									<!-- END PORTLET -->
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_1_3">
							<div class="row">
								<div class="col-md-9">
									<!-- BEGIN PORTLET -->
									<div class="portlet light " style="background-color:white;">
										<div class="portlet-title">
											<div class="caption caption-md">
												<i class="icon-bar-chart theme-font hide"></i>
												<span class="caption-subject font-blue-madison bold uppercase">Following</span>
											</div>
										</div>
										<div class="portlet-body">
											@if(count($linkFollow) > 0)
											@foreach($linkFollow as $follow)
											<div class="row search-user-tool" style="margin:0;">
														
													<div class="col-md-2 col-sm-2 col-xs-3">
														<a href="#">
													        <img class="media-object" style="width:100%" src="@if($follow->logo_status != null){{ '/img/profile/'.$follow->logo_status }}@else{{'/assets/images/corpnew.jpg'}}@endif" alt="DP" style="width:60px">
													    </a>
													</div>
													<div class="col-md-5 col-sm-6 col-xs-6">
														<a href="/profile/corp/{{$follow->id}}" class="link-label" data-utype="corp">
													    		 		{{ $follow->firm_name }}
													    		 	</a>
													    		 	 <small>{{ $follow->firm_type }} </small><br>
													    @if(count($follow->posts) > 1)
													   <small> {{count($follow->posts)}} Job Posts</small>
													    @elseif(count($follow->posts) == 1)
													   <small> {{count($follow->posts)}} Job Post</small>
													    @elseif(count($follow->posts) < 1)
													   <small> No Post</small>
													    @endif
													</div>
													<div class="col-md-3 col-sm-3 col-xs-3" style="margin:7px -7px;">
														
														<div class="btn-group">
															<button class="btn blue dropdown-toggle link-icon-css" type="button" data-toggle="dropdown">
															<i class="fa  fa-ellipsis-v"></i> 
															</button>
															<ul class="dropdown-menu dropdown-menu-link" role="menu" style="text-align:center;">
																<li style="border-bottom:1px solid lightgrey;">
																	<a href="/profile/corp/{{$follow->id}}" style="padding:5px 14px !important;">
																	<button class="btn btn-success connection-css">View Profile </button></a>
																</li>
																<li style="border-bottom:1px solid lightgrey;">
																	<a href="/postedby/corporate/{{$follow->id}}" style="padding:5px 14px !important;">
																	<button class="btn btn-success connection-css">View Jobs </button></a>
																</li>
																<li style="margin:5px 0;">
																	<form action="/links/corporate/unfollow/{{$follow->id}}" method="post">
																	<input type="hidden" name="_token" value="{{ csrf_token() }}">
																		<button type="submit" name="action" class="btn btn-success connection-css">
																			Un-Follow
																		</button>
																	</form>
																</li>
																
															</ul>
														</div>
													</div>
											    
											</div>
											@endforeach
											@else
											<div class="row">
												<div class="col-md-12">
													<i class="fa fa-frown-o" style="font-size: 16px !important;"></i> You have not Follow anyone!
												</div>
											</div>
											@endif				
										</div>
									</div>
									<!-- END PORTLET -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="portlet light bordered col-md-7 col-xs-12 col-sm-8" style="display:none;">
	<div class="portlet-title" style="min-height:0 !important;">
		<div class="caption links-title" style="float:none !important;margin:0 auto; display:table;line-height:0 !important;">
			<span class="caption-subject font-blue-hoki bold uppercase">Manage your Links</span>
		</div>
	</div>
	<div class="portlet-body form">		
		<div class="form-body" style="padding:0;">
			<div class="normal_search hide-socialmedia">
				<label style="font-size: 16px;text-align: center;width: 100%;">Invite Your Friends on JobTip & Share Job Information</label>
			</div>
			<div class="row hide-socialmedia">
				<div class="col-md-12 normal_search" style="margin-bottom:15px;">
					<div class="portlet light col-md-12 clearfix" style="background-color: transparent;">
						<div class="row social" style="margin: 5px auto;display: table;">
							@if($user->reg_via == 'facebook')
							<div class="col-md-4 col-xs-4 ">
								<a  class="btn btn-lg btn-facebook btn-block share-media-icon" disabled href="" style="background: #3b5998;color: white;border-radius: 25px !important;">
								<i class="fa fa-facebook "></i><span class="hidden-xs" style="font-size:14px"> &nbsp;Facebook</span></a>	
							</div>
							@else
							<div class="col-md-4 col-xs-4 ">
								<a  class="btn btn-lg btn-facebook btn-block share-media-icon" href="" style="background: #3b5998;color: white;border-radius: 25px !important;">
								<i class="fa fa-facebook "></i><span class="hidden-xs" style="font-size:14px"> &nbsp;Facebook</span></a>	
							</div>
							@endif
							@if($user->reg_via == 'google')
							<div class="col-md-4 col-xs-4 ">
								<a  class="btn btn-lg btn-google btn-block share-media-icon" disabled href="" style="background: #c32f10;color: white;border-radius: 25px !important;">
								<i class="fa fa-google-plus"></i><span class="hidden-xs"style="font-size:14px"> &nbsp;Google+</span></a>
							</div>
							@else
							<div class="col-md-4 col-xs-4 ">
								<a  class="btn btn-lg btn-google btn-block share-media-icon" href="" style="background: #c32f10;color: white;border-radius: 25px !important;">
								<i class="fa fa-google-plus"></i><span class="hidden-xs"style="font-size:14px"> &nbsp;Google+</span></a>
							</div>
							@endif
							@if($user->reg_via == 'linkedin')
							<div class="col-md-4 col-xs-4 ">
								<a class="btn btn-lg btn-linkedin btn-block share-media-icon" disabled style="background: #00aced;color: white;border-radius: 25px !important;">
								<i class="fa fa fa-linkedin"></i><span class="hidden-xs"style="font-size:14px"> &nbsp;Linkedin</span></a>
							</div>
							@else
							<div class="col-md-4 col-xs-4 ">
								<a class="btn btn-lg btn-linkedin btn-block share-media-icon" style="background: #00aced;color: white;border-radius: 25px !important;">
								<i class="fa fa fa-linkedin"></i><span class="hidden-xs"style="font-size:14px"> &nbsp;Linkedin</span></a>
							</div>
							@endif
						</div>
					</div>
				</div>			
			</div>	
		</div>
	</div>
</div>							
@stop

@section('javascript')
<script src="/assets/ind_validation.js"></script>
<script type="text/javascript">
	function initialize() {
		var options = {	types: ['(cities)'], componentRestrictions: {country: "in"}	};
		var input = document.getElementById('city');
		var autocomplete = new google.maps.places.Autocomplete(input, options);
		autocomplete.addListener('place_changed', onPlaceChanged); 
		function onPlaceChanged() {
		  var place = autocomplete.getPlace();
		  if (place.address_components) { city = place.address_components[0];
		  	document.getElementById('city').value = city.long_name;
		  } else { document.getElementById('autocomplete').placeholder = 'Enter a city'; }
		}
	}
    google.maps.event.addDomListener(window, 'load', initialize); 

	$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });

	var timer;
	function up(){
		timer=setTimeout(function(){
				var keywords = $('#search-input').val();
				if(keywords.length>2){
					$.post('/searchConnections', {keywords: keywords}, function(markup){
						$('#search-results').html(markup);
					});
				}else{
					$('#search-results').empty();
				}
			}, 500);
	}

	function down(){
		clearTimeout(timer);
	}
     	
    $('.show-firm-type').hide();

    jQuery('.advance-search').on('click', function(event) {
	    jQuery('.show-adsearch').toggle('show');
	    jQuery('.normal_search').toggle('hide');
    });



    $('.groups').click(function(){
    	$('.normal_search').hide();
    });

    $('.links').click(function(){
    	$('.normal_search').show();
    });

    jQuery('#id_radio1').on('click', function(event) {
	    jQuery('.show-comp').toggle('show');
	    jQuery('.show-firm-type').toggle('hide');
	    jQuery('#mobile').addClass('group');
	    $(this).closest('form').find("input[type=text], textarea").val("");
    });

    jQuery('#id_radio2').on('click', function(event) {
	    jQuery('.show-comp').toggle('hide');
	    jQuery('.show-firm-type').toggle('show');
	    jQuery('#mobile').removeClass('group');
	    $(this).closest('form').find("input[type=text], textarea").val("");

    });
	
</script>
<script type="text/javascript">
$(document).ready(function () {            
    //validation rules
    var form = $('#search-profiles');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);


    form.validate({
        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: [],
        groups: {
                    name: "name mobile"
                },
        rules: {
            name: {
                require_from_group: [1, '.group']
            },
            mobile: {
                number: true,
                minlength: 10,
                require_from_group: [1, '.group']
            },
            city : {
                required : false
            },
            "firm_type[]": {
            	required: true
            }
        },
        messages: {
            mobile: {
	            require_from_group: "Enter atleast Name or Mobile no"
	        },
	        phone: {
	            maxlength: "Enter minimum 10 integer"
	        }
        },
            invalidHandler: function (event, validator) { //display error alert on form submit   
            success.hide();
            error.show();
            Metronic.scrollTo(error, -200);
        },

             highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
            unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
         },
    });
});
</script>
@stop