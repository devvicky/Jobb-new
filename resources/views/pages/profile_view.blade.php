@extends('master')

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="/home">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		@if(Auth::user()->induser_id != $user->id || Auth::user()->corpuser_id != $user->id)
		<li class="active">
			@if($utype == 'ind')
			 <span style="text-transform: uppercase;">{{ $user->fname }} {{ $user->lname }}</span>
			@elseif($utype == 'corp')
			 <span style="text-transform: uppercase;">{{ $user->firm_name }}</span>
			@endif
		</li>
		@elseif(Auth::user()->induser_id == $user->id || Auth::user()->corpuser_id == $user->id)
		<li class="active">
			Profile View
		</li>
		@endif
	</ul>
</div>
<!-- END PAGE BREADCRUMB -->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PROFILE SIDEBAR -->
		<div class="profile-sidebar" style="width: 250px;">
			<!-- PORTLET MAIN -->
			<div class="portlet light profile-sidebar-portlet">
				<!-- SIDEBAR USERPIC -->
				@if($utype == 'ind')
				<div class="profile-userpic">
					<img  src="@if($user->profile_pic != null){{ '/img/profile/'.$user->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" class="img-responsive">
				</div>
				@elseif($utype == 'corp')
				<div class="profile-userpic-corp">
					<img  src="@if($user->logo_status != null){{ '/img/profile/'.$user->logo_status }}@else{{'/assets/images/corpnew.jpg'}}@endif" class="img-responsive">
				</div>
				@endif
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						 {{ $user->fname }} {{ $user->lname }} {{ $user->firm_name }} 
					</div>
					<div class="profile-usertitle-job">
						@if($user->role != null) {{$user->role}} @endif <small style="font-size: 13px;font-weight: 500;">{{ $user->slogan }}</small>
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-usertitle usertitle-profile" >
					@if(Auth::user()->identifier == 1)
					<!-- Connection status -->
					@if($connectionStatus == 'friend' && Auth::user()->induser_id != $user->id)
						<a href="/links" class="btn btn-success btn-responsive btn-xs btn-small" style="padding:4px 10px;border-radius:15px !important;">
							<i class="fa fa-link (alias) icon-size"></i> Linked</a>
					@elseif($connectionStatus == 'pendingrequest')
						<a href="/links" class="btn btn-warning btn-responsive btn-xs pending-link-request">Pending link request</a>
						<form action="/connections/response/{{$connectionId}}" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" name="action" value="accept" class="btn btn-success btn-xs accept-request">
								<i class="fa fa-check" style="font-size:12px;"></i>&nbsp;Accept
							</button>
							<button type="submit" name="action" value="reject" class="btn btn-danger btn-xs ignore-request">
								<i class="glyphicon glyphicon-trash"></i>&nbsp;Ignore
							</button>
						</form>
					@elseif($connectionStatus == 'requestsent' && Auth::user()->induser_id != $user->id)
						<button class="btn btn-responsive link-request-label">
							<i class="icon-hourglass (alias) icon-size" style="color: chartreuse;"></i> Link requested</button>
						@elseif($connectionStatus == 'add' && Auth::user()->induser_id != $user->id)

						<form action="/connections/inviteFriend/{{$user->id}}" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						  	<button type="submit" name="action" value="accept" class="btn btn-success btn-xs" style="padding:4px 10px;border-radius:15px !important;">
								<i class="fa fa-check" ></i>&nbsp;Add Links
							</button>		
						</form>
					@elseif($connectionStatus == 'following')
						<a href="/links" class="btn btn-success btn-responsive btn-xs" style="background-color: #2e9df7;padding:4px 10px;border-radius:15px !important;">
							<i class="icon-user-following icon-size" style="color: chartreuse;"></i> Following</a>
						<!-- <form action="{{ url('/corporate/unfollow', $connectionId) }}" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" name="action" value="accept" class="btn btn-danger btn-xs">
								<i class="icon-user-follow"></i>&nbsp;Unfollow
							</button>
						</form> -->
					@endif
					<!-- end Connection status -->
					@endif
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav" style="padding:0;">
						<li class="active">
							<a>
							<i class="icon-home"></i>
							Overview </a>
						</li>

						@if(Auth::user()->identifier == 1)
							@if(Auth::user()->induser_id == $user->id)
							<li>
								<a href="/individual/edit">
								<i class="icon-settings"></i>
								Profile Edit </a>
							</li>
							@endif
						@elseif(Auth::user()->identifier == 2)
							@if(Auth::user()->corpuser_id == $user->id)
							<li>
								<a href="/corporate/edit">
								<i class="icon-settings"></i>
								Profile Edit </a>
							</li>
							@endif
						@endif
						@if(Auth::user()->corpuser_id == $user->id)
						<li>
							<a href="/mypost" target="_blank">
							<i class="icon-check"></i>
							Myactivity </a>
						</li>
						@endif
						<!-- <li>
							<a href="extra_profile_help.html">
							<i class="icon-info"></i>
							Help </a>
						</li> -->
					</ul>
				</div>
				<!-- END MENU -->
			</div>
			<!-- END PORTLET MAIN -->
			<!-- PORTLET MAIN -->
			<div class="portlet light">
				<!-- STAT -->
				@if(Auth::user()->induser_id == $user->id || Auth::user()->corpuser_id == $user->id)
				<div class="row list-separated profile-stat" style="text-align:center;">
					@if($utype == 'ind')
					<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'connections'){{'active'}}@endif" style="padding:0;">
						<a href="/connections/create" class="icon-btn icon-btn-new">
							<i class="icon-link"></i>
							<div>
								 Links
							</div>
							<span class="badge badge-danger @if($linksCount > 0) show @else hide @endif" style="background-color: #26a69a;">
							{{$linksCount}} </span>
						</a>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'notify_view'){{'active'}}@endif" style="padding:0;">
						<a href="/notify/thanks/ind/{{Auth::user()->induser_id}}" data-utype="thank" class="icon-btn icon-btn-new">
							<i class="icon-like"></i>
							<div>
								 Thanks
							</div>
							<span class="badge badge-danger  @if(count($thanks) > 0) show @else hide @endif" style="background-color: #3598dc;">
							{{count($thanks)}}</span>
						</a>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'mypost'){{'active'}}@endif" style="padding:0;">
						<a href="/mypost" class="icon-btn icon-btn-new">
							<i class="icon-note"></i>
							<div>
								 Posts
							</div>
							<span class="badge badge-danger  @if($posts > 0) show @else hide @endif">
							{{$posts}} </span>
						</a>
					</div>
					@elseif($utype == 'corp')
					<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'connections'){{'active'}}@endif" style="padding:0;">
						<a href="" class="icon-btn icon-btn-new">
							<i class="icon-user-following"></i>
							<div>
								 Followers
							</div>
							<span class="badge badge-danger @if($followCount > 0) show @else hide @endif" style="background-color: #26a69a;">
							{{$followCount}}</span>
						</a>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'notify_view'){{'active'}}@endif" style="padding:0;">
						<a href="/notify/thanks/corp/{{Auth::user()->induser_id}}" data-utype="thank" class="icon-btn icon-btn-new">
							<i class="icon-like"></i>
							<div>
								 Thanks
							</div>
							<span class="badge badge-danger  @if(count($thanks) > 0) show @else hide @endif" style="background-color: #3598dc;">
							{{count($thanks)}}</span>
						</a>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'mypost'){{'active'}}@endif" style="padding:0;">
						<a href="/postbyuser/corp/{{Auth::user()->id}}" class="icon-btn icon-btn-new">
							<i class="icon-note"></i>
							<div>
								 Posts
							</div>
							<span class="badge badge-danger  @if($posts > 0) show @else hide @endif">
							{{$posts}} </span>
						</a>
					</div>
					@endif
					
				</div>
				@elseif(Auth::user()->induser_id != $user->id || Auth::user()->corpuser_id != $user->id)
				<div class="row list-separated profile-stat" style="text-align:center;">
					@if($utype == 'ind')
					<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'friendLink'){{'active'}}@endif" style="padding:0;">
						<a href="/connections/friendlink/ind/{{$user->id}}" class="icon-btn icon-btn-new">
							<i class="icon-link " ></i>
							<div>
								 Links
							</div>
							<span class="badge badge-danger @if($linksCount > 0) show @else hide @endif" style="background-color: #26a69a;">
							{{$linksCount}} </span>
						</a>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'thanks_view'){{'active'}}@endif" style="padding:0;">
						<a href="/notify/thanks/ind/{{$user->id}}" class="icon-btn icon-btn-new">
							<i class="icon-like"></i>
							<div>
								 Thanks
							</div>
							<span class="badge badge-danger  @if(count($thanks) > 0) show @else hide @endif" style="background-color: #3598dc;">
							{{count($thanks)}}</span>
						</a>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'mypost'){{'active'}}@endif" style="padding:0;">
						<a href="/postbyuser/ind/{{$user->id}}" class="icon-btn icon-btn-new">
							<i class="icon-note"></i>
							<div>
								 Posts
							</div>
							<span class="badge badge-danger  @if($posts > 0) show @else hide @endif">
							{{$posts}} </span>
						</a>
					</div>
					@elseif($utype == 'corp')
					<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'friendLink'){{'active'}}@endif" style="padding:0;">
						<a href="" class="icon-btn icon-btn-new">
							<i class="icon-user-following"></i>
							<div>
								 Followers
							</div>
							<span class="badge badge-danger @if($followCount > 0) show @else hide @endif" style="background-color: #26a69a;">
							{{$followCount}}</span>
						</a>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'thanks_view'){{'active'}}@endif" style="padding:0;">
						<a href="/notify/thanks/corp/{{$user->id}}" class="icon-btn icon-btn-new">
							<i class="fa fa-thumbs-up profile-view-icon"></i>
							<div>
								 Thanks
							</div>
							<span class="badge badge-danger  @if(count($thanks) > 0) show @else hide @endif" style="background-color: #3598dc;">
							{{count($thanks)}}</span>
						</a>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'mypost'){{'active'}}@endif" style="padding:0;">
						<a href="/postbyuser/corp/{{$user->id}}" class="icon-btn icon-btn-new">
							<i class="icon-note"></i>
							<div>
								 Posts
							</div>
							<span class="badge badge-danger  @if($posts > 0) show @else hide @endif">
							{{$posts}} </span>
						</a>
					</div>
					@endif
					
				</div>
				@endif
				<!-- END STAT -->
				
				@if($utype == 'ind')
				<div class="row">
					@if($user->in_page != null)
					<div class="col-md-3 col-sm-3 col-xs-3 margin-top-10 profile-desc-link">
						<a href="{{$user->in_page}}" target="_blank;"><i class="fa fa-linkedin" style="color:#00aced;"></i></a>
					</div>
					@endif
					@if($user->fb_page != null)
					<div class="col-md-3 col-sm-3 col-xs-3 margin-top-10 profile-desc-link">
						<a href="{{$user->fb_page}}" target="_blank;"><i class="fa fa-facebook" style="color:#3b5998;"></i></a>
					</div>
					@endif
				</div>
				
				@endif
			</div>
			<!-- END PORTLET MAIN -->
			@if($utype == 'ind' && count($thanks) > 0)
			<!-- PORTLET MAIN -->

			<div class="portlet light">
				<div class="portlet-title tabbable-line">
					<div class="caption caption-md">
						<i class="icon-like theme-font"></i>
						<span class="caption-subject font-blue-madison bold uppercase">Thanks Received </span> <span class="thank-sidebar-badge">{{count($thanks)}}</span>
					</div>

					<div class="tools">
						<a href="javascript:;" class="collapse collapsed" data-toggle="collapse" aria-expanded="false">
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<div class="scroller" style="height: 200px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
						@foreach($thanks as $not)
							
							<div class="row" style="border-bottom: 1px solid #eee;padding: 5px 0 10px 0;">
								@if($not->post_type == 'job')
								<a href="/job/post/{{$not->unique_id}}">
								@elseif($not->post_type == 'skill')
								<a href="/skill/post/{{$not->unique_id}}">
								@endif
								<div class="col-md-12" style="font-size: 14px; color: #337ab7;">
								{{$not->user->name}}
								</div>
								<div class="col-md-7 col-sm-7 col-xs-7" style="font-size: 11px;color: #999;">
									<i class="icon-note" style="font-size: 11px;color: #999;"></i>	
									{{$not->unique_id}}
								</div>
								<div class="col-md-5 col-sm-5 col-xs-5" style="font-size: 11px;color: #999;">
									{{ date('d M', strtotime($not->thanks_dtTime)) }}
								</div>
								</a>
							</div>
							
						@endforeach
					</div>
				</div>
			</div>
			<!-- END PORTLET MAIN -->
			@endif
		</div>
		<div class="profile-content">
			<div class="row">
				<div class="col-md-6" style="padding: 0 0px 0 15px;">
					<!-- BEGIN PORTLET -->
					<div class="portlet light ">
						<div class="portlet-title">
							@if($utype == 'ind')
					 		@if(Auth::user()->induser_id == $user->id)
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject font-blue-madison bold uppercase">About Me</span>
								<span class="caption-helper hide">weekly stats...</span>
							</div>
							@else
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject font-blue-madison bold uppercase">About {{$user->fname}}</span>
								<span class="caption-helper hide">weekly stats...</span>
							</div>
							@endif
							@elseif($utype == 'corp')
							 @if(Auth::user()->corpuser_id == $user->id)
								<div class="caption caption-md">
									<i class="icon-bar-chart theme-font hide"></i>
									<span class="caption-subject font-blue-madison bold uppercase">About Firm</span>
									<span class="caption-helper capitalize"><span class="label-success" style="color: white;padding: 0 4px;font-size: 12px;border-radius: 3px;">{{ $user->firm_type}}</span></span>
								</div>
							 @else
								<div class="caption caption-md">
									<i class="icon-bar-chart theme-font hide"></i>
									<span class="caption-subject font-blue-madison bold uppercase">About {{$user->firm_name}}</span>
									<span class="caption-helper capitalize"><span class="label-success" style="color: white;padding: 0 4px;font-size: 12px;border-radius: 3px;">{{ $user->firm_type}}</span></span>
								</div>
							 @endif
							@endif
						</div>
						<div class="portlet-body" >
							<p style="margin-bottom: 25px;">
								@if($utype == 'ind')
									@if($user->about_individual != null)
										{{ $user->about_individual}}
									@elseif($user->about_individual == null)
									Tell me about yourself...
									@endif
								@elseif($utype == 'corp')	
									@if($user->about_firm != null)
										{{$user->about_firm}}
									@elseif($user->about_firm == null)
										Tell me about your firm...
									@endif
								@endif
							</p>
							@if($utype == 'ind')
							<ul class="list-inline">
								@if(Auth::user()->induser_id == $user->id && $user->dob != null)
								<li style="margin: 0px 0 10px 0;">
									<i class="fa fa-calendar"></i> {{$user->dob}}
								</li>
								@elseif($connectionStatus == 'friend' && $user->dob != null && Auth::user()->induser_id != $user->id && $user->dob_show == 'Links')
								<li>
									<i class="fa fa-calendar"></i> {{$user->dob}}
								</li>
								@elseif($user->dob_show == 'Everyone' && $user->dob != null)
								<li>
									<i class="fa fa-calendar"></i> {{$user->dob}}
								</li>
								@elseif(Auth::user()->induser_id != $user->id && $user->dob_show == 'None' && $user->dob != null)
								
								@endif
								@if($user->gender == 'Female' && $user->gender != null)
								<li>
									<i class="fa fa-female"></i> {{$user->gender}}
								</li>
								@elseif($user->gender == 'Male' && $user->gender != null)
								<li>
									<i class="fa fa-male"></i> {{$user->gender}}
								</li>
								@endif
								@if($user->education != null)
								<?php $education = explode('-', $user->education); 
										 		   $name = $education[0];
										 		   $branch = $education[1];
										 		   $level = $education[2];  ?>
								<li class="capitalize">
									<i class="fa fa-graduation-cap"></i> {{$name}} in {{$branch}}
								</li>
								@endif
								@if($user->experience != null && $user->experience != 0)
								<li class="capitalize">
									<i class="fa fa-briefcase"></i> {{ $user->experience }} Years
								</li>
								@elseif($user->experience == 0 && $user->experience != null)
								<li class="capitalize">
									<i class="fa fa-briefcase"></i> Fresher
								</li>
								@else
								
								@endif
								@if($user->city != null)
								<li>
									<i class="fa fa-map-marker"></i> {{$user->city}}
								</li>
								@endif
								<!-- <li>
									<i class="fa fa-heart"></i> BASE Jumping
								</li> -->
							</ul>
							@elseif($utype == 'corp')
							<ul class="list-inline">
								@if($user->operating_since != null)
								<li>
									<i class="fa fa-calendar"></i> {{$user->operating_since}}
								</li>
								@endif
								@if($user->emp_count != null)
								<li>
									<i class="fa fa-users"></i> {{$user->emp_count}} Employees
								</li>
								@endif
								@if($user->linked_skill != null)
								<li>
									<i class="fa fa-cogs"></i> {{$user->linked_skill}}
								</li>
								@endif
								@if($user->city != null)
								<li>
									<i class="fa fa-map-marker"></i> {{$user->city}}
								</li>
								@endif
								<!-- <li>
									<i class="fa fa-heart"></i> BASE Jumping
								</li> -->
							</ul>
						@endif
							
						</div>
					</div>
					<!-- END PORTLET -->
				</div>
				@if($utype == 'ind')
				
				<div class="col-md-6" style="padding: 0 15px 0 8px;">
					<!-- BEGIN PORTLET -->
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption caption-md">
								<i class="icon-globe theme-font hide"></i>
								<span class="caption-subject font-blue-madison bold uppercase">Professional Details</span>
							</div>
						</div>
						<div class="portlet-body" >
							<div class="form-body">
								@if(Auth::user()->induser_id == $user->id && $user->role != null || $user->resume != null || $user->linked_skill != null)
								<div class="row">
									@if(Auth::user()->induser_id == $user->id)
									<div class="col-md-12 col-sm-12 col-xs-12" style="">
										<div class="form-group" style="margin-bottom: 0;">
											<label class="control-label " style="font-weight: 600;">Industry</label>							
											<div class=""> 
												<p class="form-control-static view-page">
													@if($user->industry != null)
													{{ $user->industry }}
													@else
													<a href="/individual/edit#professional">Add Industry</a>
													@endif
												</p>
											</div>
										</div>
									</div>
									@elseif($user->industry != null && Auth::user()->induser_id != $user->id)
									<div class="col-md-12 col-sm-12 col-xs-12" style="">
										<div class="form-group" style="margin-bottom: 0;">
											<label class="control-label " style="font-weight: 600;">Industry</label>							
											<div class="">
												<p class="form-control-static view-page">
													@if($user->industry != null)
													{{ $user->industry }}
													@else
													{{$user->fname}} has not added 'Industry'
													@endif
												</p>
											</div>
										</div>
									</div>
									@elseif($user->role == null && Auth::user()->induser_id != $user->id)
									@endif
									<!--/span-->
									@if(Auth::user()->induser_id == $user->id)
									<div class="col-md-12 col-sm-12 col-xs-12" style="">
										<div class="form-group" style="margin-bottom: 0;">
											<label class="control-label " style="font-weight: 600;">Functional Area</label>
											<div class="">
												<p class="form-control-static view-page">
													@if($user->functional_area != null)
													{{$user->functional_area}}
													@else
													<a href="/individual/edit#professional">Add Functional Area</a>
													@endif
												</p>
											</div>
										</div>
									</div>
									@elseif($user->functional_area != null && Auth::user()->induser_id != $user->id)
									<div class="col-md-12 col-sm-12 col-xs-12" style="">
										<div class="form-group" style="margin-bottom: 0;">
											<label class="control-label " style="font-weight: 600;">Functional Area</label>
											<div class="">
												<p class="form-control-static view-page">
													@if($user->functional_area != null)
													{{$user->functional_area}}
													@else
													{{$user->fname}} has not added 'Functional Area'
													@endif
												</p>
											</div>
										</div>
									</div>
									
									@endif
									<!--/span-->	
								</div>
								<!--/row-->
								<div class="row">
									@if(Auth::user()->induser_id == $user->id)
									<div class="col-md-12 col-sm-12 col-xs-12" style="">
										<div class="form-group" style="margin-bottom: 0;">
											<label class="control-label" style="font-weight: 600;">Role</label>
											<div class="">
												<p class="form-control-static view-page">
													@if($user->role != null)
													{{ $user->role }}
													@else
													<a href="/individual/edit#professional">Add Role</a>
													@endif
												</p>
											</div>
										</div>
									</div>
									@elseif($user->role != null && Auth::user()->induser_id != $user->id)
									<div class="col-md-12 col-sm-12 col-xs-12" style="">
										<div class="form-group" style="margin-bottom: 0;">
											<label class="control-label" style="font-weight: 600;">Role</label>
											<div class="">
												<p class="form-control-static view-page">
													@if($user->role != null)
													{{ $user->role }}
													@else
													{{$user->fname}} has not added 'Role'
													 @endif
												</p>
											</div>
										</div>
									</div>
									
									@endif
									<!--/span-->	
									
								</div>
								<!--/row-->
								<div class="row" style="margin-bottom: 20px;">
									@if(Auth::user()->induser_id == $user->id)
									<div class="col-md-12 col-sm-12 col-xs-12" style="">
										<div class="form-group" style="margin-bottom: 0;">
											<label class="control-label" style="font-weight: 600;">Skills</label>
											<div class="">
												<p class="form-control-static view-page">
													
													@if($user->linked_skill != null)
													{{ $user->linked_skill }}
													@elseif($user->linked_skill == null)
													<a href="/individual/edit#tab_2-2">Add Skills</a>
													@endif
												</p>
											</div>
										</div>
									</div>
									@elseif($user->linked_skill != null && Auth::user()->induser_id != $user->id)
									<div class="col-md-12 col-sm-12 col-xs-12" style="">
										<div class="form-group" style="margin-bottom: 0;">
											<label class="control-label" style="font-weight: 600;">Skills</label>
											<div class="">
												<p class="form-control-static view-page">
													
													@if($user->linked_skill != null)
													{{ $user->linked_skill }}
													@elseif($user->linked_skill == null)
													{{$user->fname}} has not added any 'Skills'
													@endif
												</p>
											</div>
										</div>
									</div>
									@endif
									<!--/span-->
								</div>
									<!-- /row -->
								@elseif(Auth::user()->induser_id == $user->id && $user->role == null || $user->resume == null || $user->linked_skill == null)
								<div class="row">
									<div class="col-md-12">
										Please add add Professional Details.
									</div>
								</div>
								@elseif(Auth::user()->induser_id != $user->id && $user->role == null || $user->resume == null || $user->linked_skill == null)
								<div class="row">
									<div class="col-md-12">
										{{$user->fname}} has not added any Professional Details.
									</div>
								</div>
								@endif
							</div>
						<!-- END FORM-->
						</div>
					</div>
					<!-- END PORTLET -->
				</div>
				
				<div class="col-md-6" style="padding: 0 0px 0 15px;">
					<!-- BEGIN PORTLET -->
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption caption-md">
								<i class="icon-globe theme-font hide"></i>
								<span class="caption-subject font-blue-madison bold uppercase">Preferences</span>
							</div>
						</div>
						<div class="portlet-body" >
							<div class="form-body">
								@if($user->prefered_jobtype != null || $user->prefered_location != null)
								<div class="row">
									@if(Auth::user()->induser_id == $user->id)
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="form-group" style="margin-bottom: 0;">
											
											<!-- <div class="col-md-12 col-xs-12"> -->
												<p class="form-control-static view-page">
													@if($user->prefered_jobtype != null)
													Looking for <span class="static-details">{{ $user->prefered_jobtype }}</span> Job in 
														@if($user->prefered_location != null)
															<span class="static-details">{{$user->prefered_location}}</span>.
														@endif
													@else
													 <a href="/individual/edit#professional">Add Job Type</a>
													@endif
												</p>
											<!-- </div> -->
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="form-group" style="margin-bottom: 38px;">
											
											<!-- <div class="col-md-12 col-xs-12"> -->
												<p class="form-control-static view-page">
													@if($user->candidate_availablity != null && $user->candidate_availablity != '0')
													I can join in <span class="static-details">{{ $user->candidate_availablity }} days</span>.
													@elseif($user->candidate_availablity != null && $user->candidate_availablity == '0')
													<!-- I am available Immediately available to work. -->	
													I can join <span class="static-details">Immediately</span>.
													@else
													 <a href="/individual/edit#professional">Add Job Type</a>
													@endif
												</p>
											<!-- </div> -->
										</div>
									</div>
									@elseif($user->prefered_location != null && Auth::user()->induser_id != $user->id)
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="form-group" style="margin-bottom: 0;">
											<p class="form-control-static view-page">
												@if($user->prefered_jobtype != null)
													Looking for <span class="static-details">{{ $user->prefered_jobtype }}</span> Job in 
													@if($user->prefered_location != null)
														<span class="static-details">{{$user->prefered_location}}</span>.
													@endif
												@else
												{{$user->fname}} has not added Preferred Location
												 @endif
											</p>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="form-group" style="margin-bottom: 38px;">
											
											<!-- <div class="col-md-12 col-xs-12"> -->
												<p class="form-control-static view-page">
													@if($user->candidate_availablity != null && $user->candidate_availablity != '0')
													{{$user->fname}} can join in <span class="static-details">{{ $user->candidate_availablity }} days</span>.
													@elseif($user->candidate_availablity != null && $user->candidate_availablity == '0')
													<!-- I am available Immediately available to work. -->	
													{{$user->fname}} can join <span class="static-details">Immediately</span>.
													@else
													 {{$user->fname}} has not added Preferred Location
												 	@endif
												</p>
											<!-- </div> -->
										</div>
									</div>
									@elseif($user->prefered_location == null && $user->prefered_jobtype != null && Auth::user()->induser_id != $user->id)
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="form-group">
											<p class="form-control-static view-page">
												Looking for {{ $user->prefered_jobtype }} Job
											</p>
										</div>
									</div>
									@endif
								</div>
								@elseif(Auth::user()->induser_id != $user->id && $user->prefered_jobtype == null && $user->prefered_location == null)
								<div class="row">
									<div class="col-md-12">
										{{$user->fname}} has not added any Preferences.
									</div>
								</div>
								@elseif(Auth::user()->induser_id == $user->id && $user->prefered_jobtype == null && $user->prefered_location == null)
								<div class="row">
									<div class="col-md-12">
										Please add Preferences.
									</div>
								</div>
								@endif
							</div>
						</div>
					</div>
					<!-- END PORTLET -->
				</div>
				<div class="col-md-6" style="padding: 0 15px 0 8px;">
					<!-- BEGIN PORTLET -->
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption caption-md">
								<i class="icon-globe theme-font hide"></i>
								<span class="caption-subject font-blue-madison bold uppercase">Contact</span>
							</div>
						</div>
						<div class="portlet-body" >
							<!-- BEGIN FORM-->
							<div class="form-body">
								@if(Auth::user()->induser_id == $user->id)
								<div class="row" >
									<!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
										<div class="form-group">
											<label class="control-label col-md-2 col-sm-2 col-xs-2" style="font-size:13px;"><i class="fa fa-envelope-o"></i></label>
											<div class="col-md-10 col-sm-10 col-xs-10">
												<p class="form-control-static view-page">
													@if($user->user->email != null)
													{{ $user->user->email }} 
													@else
													<a href="/individual/edit">Add Email Id</a>
													@endif
													@if($user->user->email_verify == 0 && $user->user->email != null)
													<a>
														<i class="fa fa-exclamation-circle" 
														style="color: #cb5a5e;"></i>
													</a>
													@elseif($user->user->email_verify == 1)
													<button type="button" class="btn btn-default" style="background-color:transparent;border:0;padding: 0;" data-toggle="tooltip" data-placement="top" title="Verified">
														<i class="glyphicon glyphicon-ok-circle" style="color: #1EC71E;"></i>
													</button>
													@endif
												</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-2 col-sm-2 col-xs-2"><i class="icon-call-end"></i> </label>
											<div class="col-md-10 col-sm-10 col-xs-10" >
												<p class="form-control-static view-page">
													@if($user->user->mobile != null)
													{{ $user->user->mobile }} 
													@else
													<a href="/individual/edit">Add Phone No</a>
													@endif
													@if($user->user->mobile_verify == 0 && $user->user->mobile != null)
													<a>
														<i class="fa fa-exclamation-circle" 
														style="color: #cb5a5e;font-size: 16px;"></i>
													</a>
													@elseif($user->user->mobile_verify == 1)
														<i class="glyphicon glyphicon-ok-circle" style="color: #1EC71E;font-size: 16px;"></i>
													@endif
												</p>
											</div>
										</div>
									</div>
									@endif
									@if(Auth::user()->induser_id != $user->id && $user->email_show == 'Links' && $user->mobile_show == 'Links')
										<div class="row show-contact" style="">
									        <div class="col-md-8 col-sm-8 col-xs-12" style="padding:0 !important;margin: 5px 0;">
												<i class="fa fa-envelope"></i> : {{$user->email}}<br>
												<i class="fa fa-phone-square"></i> : {{$user->mobile}}
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12" style="padding:0 !important;margin: 5px 0;">
												<a href="/resume/{{$user->resume}}" target="_blank"><button class="btn blue corp-profile-resume" style="">
												<i class="glyphicon glyphicon-download"></i> Resume
											</button></a>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12" style="margin-bottom: 34px;">
												<a class="btn green contact-view">
													<i class="glyphicon glyphicon-earphone" style="font-size:11px;"></i> Contact
												</a>
											</div>
										</div>
										@if(Auth::user()->induser_id != $user->id && $user->email_show == 'None' && $user->mobile_show == 'None')
											<div class="form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-2" style="font-size:13px;"><i class="fa fa-envelope-o"></i> </label>
												<div class="col-md-10 col-sm-10 col-xs-10" >
													<p class="form-control-static view-page">
														{{$user->fname}} {{$user->lname}} has kept Contact detail private.
													</p>
												</div>
											</div>
										@endif
										
									@elseif(Auth::user()->induser_id != $user->id && $user->mobile_show == 'None' || $user->email_show == 'None')
									{{$user->fname }} has made Contact Details Private
									@endif
									<!--/span-->
									<div class="row" style="">
									@if(Auth::user()->induser_id == $user->id)
									<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
										<div class="form-group">
											<label class="control-label col-md-2 col-sm-2 col-xs-2"><i class="fa fa-file-word-o"></i>  </label>
											<div class="col-md-10 col-xs-10">
												<p class="form-control-static view-page">
													@if($user->resume != null)
													
													<a href="/resume/{{$user->resume}}" target="_blank"><button class="btn btn-info small-btn resume-btn">{{$user->resume}}</button></a> ({{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->resume_dtTime)->format('Y-m-d') }})
													 @else
													 <a href="/individual/edit#professional"><button class="btn btn-info small-btn resume-btn">Upload Resume</button></a>
													 @endif
												</p>
											</div>
										</div>
									</div>
									
									@endif
									<!--/span-->
								</div>
							</div>
						</div>
					</div>
					<!-- END PORTLET -->
				</div>
				<div class="col-md-6" style="padding: 0 0px 0 15px;">
					<!-- BEGIN PORTLET -->
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption caption-md">
								<i class="icon-globe theme-font hide"></i>
								<span class="caption-subject font-blue-madison bold uppercase">Notifications</span>
							</div>
							<!-- <ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab_1_1" data-toggle="tab">
									System </a>
								</li>
							</ul> -->
						</div>
						<div class="portlet-body">
							<!--BEGIN TABS-->
							<!-- <div class="tab-content">
								<div class="tab-pane active" id="tab_1_1"> -->
									<div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
										<ul class="feeds">
											@foreach($notifications as $not)
											@if($not->operation == 'job contact')
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-bell-o"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																@if($not->fromuser != null && $not->touser != null)
										                        <span class="from" style="color: #61B7FF;">
										                          {{$not->fromuser->first()->name}} 
										                        </span>
										                        @else
										                          Jobtip
										                        @endif
										                        {{$not->remark}}
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 {{ \Carbon\Carbon::createFromTimeStamp(strtotime($not->created_at))->diffForHumans() }}
													</div>
												</div>
											</li>
											@elseif($not->operation == 'link request')
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-success">
																<i class="fa fa-check"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																@if($not->fromuser != null && $not->touser != null)
										                        <span class="from" style="color: #61B7FF;">
										                          {{$not->fromuser->first()->name}} 
										                        </span>
										                        @else
										                          Jobtip
										                        @endif
										                        {{$not->remark}}
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														 {{ \Carbon\Carbon::createFromTimeStamp(strtotime($not->created_at))->diffForHumans() }}
													</div>
												</div>
											</li>
											@endif
											@endforeach
										</ul>
									</div>
								<!-- </div>
							</div> -->
							<!--END TABS-->
						</div>
					</div>
					<!-- END PORTLET -->
				</div>
				@if(Auth::user()->induser_id == $user->id && Auth::user()->identifier == 1 && $utype == 'ind')
				<div class="col-md-6 col-sm-6" style="padding: 0 15px 0 8px;">
					<!-- BEGIN PORTLET-->
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption caption-md">
								<i class="icon-globe theme-font hide"></i>
								<span class="caption-subject font-blue-madison bold uppercase">Tagged Post</span>
							</div>
						</div>
						<div class="portlet-body">
							<!--BEGIN TABS-->
							<div class="tab-content">
								<div class="tab-pane active">
									<div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
										@if(count($taggedGroupPosts) > 0)
										@foreach($taggedGroupPosts as $tp)
										<div class="row" style="margin:0;">	
										<div class="col-md-12 col-sm-12 col-xs-12">	
												@if($tp->post_type == 'job') 
												<a href="/taggedjob/group/post/{{$tp->unique_id}}" target="_blank" class="taggedpost">
												@elseif($tp->post_type == 'skill')		
												<a href="/taggedskill/group/post/{{$tp->unique_id}}" target="_blank" class="taggedpost">
												@endif								
												<div class="updates-style" style="background-color:white;cursor:pointer;">
													<?php
													    $taggedpostSkillArr = array_map('trim', explode(',', $tp->linked_skill));
													    $userSkillArr = array_map('trim', explode(',', Auth::user()->induser->linked_skill));
													?>
													<?php 
													    $matchedPost = array_intersect($taggedpostSkillArr, $userSkillArr);
													    $unmatchedPost = array_diff($taggedpostSkillArr, $userSkillArr);
													?>
													<label class="tagged-title" style="cursor: pointer;">@if($tp->post_type == 'job')
														<small class="badge badge-success capitalize tagged-job-postype" style="font-size: 12px;border-radius: 3px;padding: 2px 5px; color: white;    background-color: #45B6AF;">
																job
															</small>
															@elseif($tp->post_type == 'skill')
															<small class="badge badge-primary capitalize tagged-skill-postype" style="font-size: 12px;border-radius: 3px;padding: 2px 5px; color: white;    background-color: #428bca;">
																skill
															</small>
															@endif
															&nbsp;&nbsp;{{$tp->post_title}} ({{$tp->min_exp}} @if($tp->max_exp != null) - {{$tp->max_exp}} @endif yrs)</label>
													<br/><label class="tagged-company">@if($tp->post_compname != null) {{$tp->post_compname}} &nbsp;&nbsp;@endif <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp; {{$tp->city}}</label>
													<br/><label class="label-success job-type-skill-css">{{$tp->time_for}}</label>
													@foreach($matchedPost as $m)
	                                                    <label class="label-success matched-skill-css">{{$m}}</label>
	                                                @endforeach
	                                                @foreach($unmatchedPost as $um)
	                                                  <label class="label-success skill-label">{{$um}}</label>
	                                                @endforeach
												</div>
											</a>
											</div>				
										</div>	
										@endforeach
										@else
										<div class="row" style="margin:0;">												
											<div class="updates-style" style="background-color:white;">
												No Group Tagged Post
											</div>
										</div>
										@endif	
									</div>
								</div>
							</div>
							<!--END TABS-->
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
				@endif
				
				@elseif($utype == 'corp')
				<div class="col-md-6">
					<!-- BEGIN PORTLET -->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-globe theme-font hide"></i>
								<span class="caption-subject font-blue-madison bold uppercase">Professional Details</span>
							</div>
						</div>
						<div class="portlet-body">
							<div class="form-body">
								<div class="row">
									@if($user->industry != null && Auth::user()->corpuser_id == $user->id)
									<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 26px 0;">
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-6">Industry:</label>
											<div class="col-md-6 col-xs-6">
												<p class="form-control-static view-page text-capitalize">
													@if($user->industry != null)
													 {{ $user->industry }}
													@elseif($user->industry != null)
													--
													@endif
												</p>
											</div>
										</div>
									</div>
									@elseif($user->industry != null && Auth::user()->corpuser_id != $user->id)
									<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 26px 0;">
										<div class="form-group">
											<label class="control-label col-md-4 col-xs-6">Industry:</label>
											<div class="col-md-6 col-xs-6">
												<p class="form-control-static view-page text-capitalize">
													@if($user->industry != null)
													 {{ $user->industry }}
													@elseif($user->industry != null)
													--
													@endif
												</p>
											</div>
										</div>
									</div>
									@elseif($user->industry == null && Auth::user()->corpuser_id != $user->id)
									@endif
									<!--/span-->	
								</div>
							</div>
					<!-- END FORM-->
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<!-- BEGIN PORTLET -->
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption caption-md">
								<i class="icon-globe theme-font hide"></i>
								<span class="caption-subject font-blue-madison bold uppercase">Contact</span>
							</div>
						</div>
						<div class="portlet-body">
							<!-- BEGIN FORM-->
							<div class="form-body">
								@if(Auth::user()->corpuser_id == $user->id)
								<div class="row" >
									<!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
										<div class="form-group">
											<label class="control-label col-md-2 col-sm-2 col-xs-2" style="font-size:13px;"><i class="fa fa-envelope-o"></i></label>
											<div class="col-md-10 col-sm-10 col-xs-10">
												<p class="form-control-static view-page">
													{{ $user->user->email }} 
													@if($user->user->email_verify == 0 && $user->user->email != null)
													<a>
														<i class="fa fa-exclamation-circle" 
														style="color: #cb5a5e;"></i>
													</a>
													@elseif($user->user->email_verify == 1)
													<button type="button" class="btn btn-default" style="background-color:transparent;border:0;padding: 0;" data-toggle="tooltip" data-placement="top" title="Verified">
														<i class="glyphicon glyphicon-ok-circle" style="color: #1EC71E;"></i>
													</button>
													@endif
												</p>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-2 col-sm-2 col-xs-2"><i class="icon-call-end"></i> </label>
											<div class="col-md-10 col-sm-10 col-xs-10" >
												<p class="form-control-static view-page">
													{{ $user->user->mobile }} 
													@if($user->user->mobile_verify == 0 && $user->user->mobile != null)
													<a>
														<i class="fa fa-exclamation-circle" 
														style="color: #cb5a5e;font-size: 16px;"></i>
													</a>
													@elseif($user->user->mobile_verify == 1)
														<i class="glyphicon glyphicon-ok-circle" style="color: #1EC71E;font-size: 16px;"></i>
													@endif
												</p>
											</div>
										</div>
									</div>
									@endif
									@if(Auth::user()->corpuser_id != $user->id && $user->email_show == 'Everyone' && $user->mobile_show == 'Everyone')
										<div class="row show-contact" style="">
									        <div class="col-md-8 col-sm-8 col-xs-12" style="padding:0 !important;margin: 5px 0;">
												<i class="fa fa-envelope"></i> : {{$user->email}}<br>
												<i class="fa fa-phone-square"></i> : {{$user->mobile}}
											</div>
										</div>
										<div class="row">
											<a class="btn green contact-view">
												<i class="glyphicon glyphicon-earphone" style="font-size:11px;"></i> Contact
											</a>
										</div>
										@if(Auth::user()->corpuser_id != $user->id && $user->email_show == 'None' && $user->mobile_show == 'None')
											<div class="form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-2" style="font-size:13px;"><i class="fa fa-envelope-o"></i> </label>
												<div class="col-md-10 col-sm-10 col-xs-10" >
													<p class="form-control-static view-page">
														{{$user->fname}} {{$user->lname}} has kept Contact detail private.
													</p>
												</div>
											</div>
										@endif
										
									<!--/span-->
										
									@elseif(Auth::user()->corpuser_id != $user->id && $user->mobile_show == 'None' || $user->email_show == 'None')
									{{$user->fname }} has made Contact Details Private
									@endif
							</div>
						</div>
					</div>
					<!-- END PORTLET -->
				</div>
				@endif
			</div>
		</div>
	</div>
</div>

@stop

@javascript
<script src="/assets/admin/pages/scripts/profile.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
					// $('.collapse').collapse({
					//   toggle: true
					// });
						// $(".collapse").collapse('hide');
					</script>
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features\
});



$('.profile-btn').live('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('id');

  	var formData = $('#profile-'+post_id).serialize(); 
    var formAction = $('#profile-'+post_id).attr('action');
    $count = $.trim($('#profilecount').text());
    if($count.length == 0 || $count == ""){
		$count = 0;
	}
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
     		// console.log(data);
      	if(data.data.save_contact == 1 && data.success == 'success'){

 			var out = '<div class="col-md-8 col-sm-8 col-xs-12" style="padding:0 !important;margin: 5px 0;">';
 			out += '<i class="fa fa-envelope"></i> : '+data.data.email+'<br>';
 			out += '<i class="fa fa-phone-square"></i> : '+data.data.mobile+'</div>';
 			out += '<div class="col-md-4 col-sm-4 col-xs-12" style="padding:0 !important;margin: 5px 0;">';

 			$("#profile-contacts-"+post_id).html(out);
 			$("#profilefav-btn-"+post_id).hide();
 			$('#profilefav-btn-'+post_id).prop('disabled', true);
			
        }else {
        	// console.log(data);
        }
      }
    }); 
    return false;
  }); 
</script>
@stop