@extends('master')

@section('css')

@stop
@section('content')

<div class="row" style="margin:15px;">
	<div class="col-md-3 col-sm-4" style="background-color:whitesmoke;">
		<ul class="list-unstyled profile-nav" style="margin: 15px 0;">
			<li>
				@if($utype == 'ind')
				<div class="profile-userpic-view">
					<img  src="@if($user->profile_pic != null){{ '/img/profile/'.$user->profile_pic }}@else{{'/assets/images/ab.png'}}@endif">
				</div>
				@elseif($utype == 'corp')
				<div class="profile-userpic-corp-view">
					<img  src="@if($user->logo_status != null){{ '/img/profile/'.$user->logo_status }}@else{{'/assets/images/corpnew.jpg'}}@endif">
				</div>
				@endif
				<!-- <a href="javascript:;" class="profile-edits">
				edit </a> -->
			</li>
		</ul>
		<div class="profile-usertitle usertitle-profile" >
			<div class="profile-usertitle-name text-capitalize" style="font-size: 18px;font-weight: 600;color:#5a7391;">
				 {{ $user->fname }} {{ $user->lname }} {{ $user->firm_name }} <br> <small style="font-size: 13px;font-weight: 500;">{{ $user->slogan }}</small>
			</div>

			<!-- Connection status -->
			@if($connectionStatus == 'friend' && Auth::user()->induser_id != $user->id)
				<a href="/links" class="btn btn-success btn-responsive btn-xs btn-small" style="padding:4px 10px;border-radius:15px !important;">
					<i class="fa fa-link (alias) icon-size"></i> Linked</a>
			@elseif($connectionStatus == 'pendingrequest')
				<a href="/links" class="btn btn-warning btn-responsive btn-xs" style="margin:5px 0;padding:4px 10px;border-radius:15px !important;">Pending link request</a>
				<form action="{{ url('/connections/response', $connectionId) }}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" name="action" value="accept" class="btn btn-success btn-xs" style="padding:4px 10px;border-radius:15px !important;background-color:#34bf49;">
						<i class="fa fa-check" ></i>&nbsp;Accept
					</button>
					<button type="submit" name="action" value="reject" class="btn btn-danger btn-xs" style="padding:4px 10px;border-radius:15px !important;background-color:#4d4f53;border-color: #4d4f53;">
						<i class="glyphicon glyphicon-trash"></i>&nbsp;Ignore
					</button>
				</form>
			@elseif($connectionStatus == 'requestsent' && Auth::user()->induser_id != $user->id)
				<button class="btn btn-responsive link-request-label">
					<i class="icon-hourglass (alias) icon-size" style="color: chartreuse;"></i> Link requested</button>
				@elseif($connectionStatus == 'add' && Auth::user()->induser_id != $user->id)
				<form action="{{ url('/connections/inviteFriend', $user->id) }}" method="post" style="padding:4px 10px;border-radius:15px !important;">
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

		</div>
		@if(Auth::user()->induser_id == $user->id || Auth::user()->corpuser_id == $user->id)
		<div class="row list-separated profile-stat" style="text-align:center;">
			@if($utype == 'ind')
			<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'connections'){{'active'}}@endif" style="padding:0;">
				<a href="/connections/create" class="icon-btn icon-btn-new">
					<i class="fa fa-link (alias) profile-view-icon"></i>
					<div>
						 Links
					</div>
					<span class="badge badge-danger @if($linksCount > 0) show @else hide @endif" style="background-color: #26a69a;">
					{{$linksCount}} </span>
				</a>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'notify_view'){{'active'}}@endif" style="padding:0;">
				<a href="/notify/thanks/ind/{{Auth::user()->induser_id}}" data-utype="thank" class="icon-btn icon-btn-new">
					<i class="fa fa-thumbs-up profile-view-icon"></i>
					<div>
						 Thanks
					</div>
					<span class="badge badge-danger  @if($thanks > 0) show @else hide @endif" style="background-color: #3598dc;">
					{{$thanks}}</span>
				</a>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'mypost'){{'active'}}@endif" style="padding:0;">
				<a href="/postbyuser/ind/{{Auth::user()->induser_id}}" class="icon-btn icon-btn-new">
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
					<i class="fa fa-thumbs-up profile-view-icon"></i>
					<div>
						 Thanks
					</div>
					<span class="badge badge-danger  @if($thanks > 0) show @else hide @endif" style="background-color: #3598dc;">
					{{$thanks}}</span>
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
					<i class="fa fa-link (alias) profile-view-icon" ></i>
					<div>
						 Links
					</div>
					<span class="badge badge-danger @if($linksCount > 0) show @else hide @endif" style="background-color: #26a69a;">
					{{$linksCount}} </span>
				</a>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'thanks_view'){{'active'}}@endif" style="padding:0;">
				<a href="/notify/thanks/ind/{{$user->id}}" class="icon-btn icon-btn-new">
					<i class="fa fa-thumbs-up profile-view-icon"></i>
					<div>
						 Thanks
					</div>
					<span class="badge badge-danger  @if($thanks > 0) show @else hide @endif" style="background-color: #3598dc;">
					{{$thanks}}</span>
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
					<span class="badge badge-danger  @if($thanks > 0) show @else hide @endif" style="background-color: #3598dc;">
					{{$thanks}}</span>
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
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="row">
			<div class="col-md-8 profile-info"style="margin: 0 0px;" >
				<div class="portlet-title portlet-title-new">
					@if($utype == 'ind')
					 @if(Auth::user()->induser_id == $user->id)
						<!-- <h3 class="h3-new">Profile Summary</h3> -->
						<div class="caption">
							<i class="icon-badge font-green-haze"></i>
							<span class="caption-subject font-green-haze bold uppercase" style="font-size:14px;">About Me</span>
						</div>
						@if($user->working_status == "Student")
						<div class="profile-usertitle-job capitalize individual-detail">
							 {{ $user->education }} in {{ $user->branch }}
						</div>
						@elseif($user->working_status == "Searching Job")
						<div class="profile-usertitle-job capitalize individual-detail" >
							 {{ $user->working_status }}
						</div>
						@elseif($user->working_status == "Freelanching")
						<div class="profile-usertitle-job capitalize individual-detail" >
							 {{ $user->role }} {{ $user->working_status }}
						</div>
						@elseif($user->role != null && $user->working_at !=null && $user->working_status == "Working")
						<div class="profile-usertitle-job capitalize individual-detail" >
							 {{ $user->role }}, {{ $user->working_at }} 
						</div>
						@elseif($user->role != null && $user->working_at ==null && $user->working_status == "Working")
						<div class="profile-usertitle-job capitalize individual-detail">
							 {{ $user->role }}
						</div>
						@elseif($user->role == null && $user->working_at !=null && $user->working_status == "Working")
						<div class="profile-usertitle-job capitalize individual-detail" >
							 {{ $user->woring_at }}
						</div>
						@elseif($user->role == null && $user->working_at ==null && $user->working_status == "Working")
			            <div class="profile-usertitle-job capitalize individual-detail" >
			               {{ $user->prof_category }}
			            </div>
						@endif
					 @else
					 <div class="caption">
						<i class="icon-badge font-green-haze"></i>
						<span class="caption-subject font-green-haze bold uppercase" style="font-size:14px;">About {{$user->fname}}</span>
					</div>
					@if($user->working_status == "Student")
						<div class="profile-usertitle-job capitalize individual-detail">
							 {{ $user->education }} in {{ $user->branch }}
						</div>
						@elseif($user->working_status == "Searching Job")
						<div class="profile-usertitle-job capitalize individual-detail" >
							 {{ $user->working_status }}
						</div>
						@elseif($user->working_status == "Freelanching")
						<div class="profile-usertitle-job capitalize individual-detail" >
							 {{ $user->role }} {{ $user->working_status }}
						</div>
						@elseif($user->role != null && $user->working_at !=null && $user->working_status == "Working")
						<div class="profile-usertitle-job capitalize individual-detail" >
							 {{ $user->role }}, {{ $user->working_at }} 
						</div>
						@elseif($user->role != null && $user->working_at ==null && $user->working_status == "Working")
						<div class="profile-usertitle-job capitalize individual-detail">
							 {{ $user->role }}
						</div>
						@elseif($user->role == null && $user->working_at !=null && $user->working_status == "Working")
						<div class="profile-usertitle-job capitalize individual-detail" >
							 {{ $user->woring_at }}
						</div>
						@elseif($user->role == null && $user->working_at ==null && $user->working_status == "Working")
			            <div class="profile-usertitle-job capitalize individual-detail" >
			               {{ $user->prof_category }}
			            </div>
						@endif
					 @endif
					@endif
					@if($utype == 'corp')
					 @if(Auth::user()->corpuser_id == $user->id)
						<div class="caption">
							<i class="icon-badge font-green-haze"></i>
							<span class="caption-subject font-green-haze bold uppercase" style="font-size:14px;">About Firm</span>
						</div>
						<div class="capitalize"><span class="label-success" style="color:white;">{{ $user->firm_type}}</span></div>
					 @else
					 <div class="caption">
							<i class="icon-badge font-green-haze"></i>
							<span class="caption-subject font-green-haze bold uppercase" style="font-size:14px;">About {{$user->firm_name}}</span>
						</div><div class="capitalize">{{ $user->firm_type }}</div>
					 @endif
					@endif
					@if(Auth::user()->induser_id == $user->id)
					<div class="tools tool-new  @if($title == 'indprofile_edit'){{'active'}}@endif">
						<a href="/individual/edit" class="btn btn-xs blue" style="height: 20px;">
						<i class="fa fa-edit"></i> Edit 
						</a>
					</div>
					@endif
					@if(Auth::user()->corpuser_id == $user->id)
					<div class="tools tool-new @if($title == 'corpprofile_edit'){{'active'}}@endif">
						<a href="/corporate/edit" class="btn btn-xs blue" style="height: 20px;">
						<i class="fa fa-edit"></i> Edit 
						</a>
					</div>
					@endif
				</div>
				<p>
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
				
				<ul class="list-inline">
					@if($user->website_url != null)
					<li>
						<i class="fa fa-globe"></i><a href="{{$user->website_url}}">
							{{$user->website_url}} </a>
					</li>
					@endif
					@if($utype == 'ind')
					<li>
						<i class="fa fa-linkedin"></i>
						<a href="">@keenthemes</a>
					</li>
					<li>
						<i class="fa fa-facebook"></i>
						<a href="">keenthemes</a>
					</li>
					@endif
				</ul>
				@if($utype == 'ind')
				<ul class="list-inline">
					@if(Auth::user()->induser_id == $user->id)
					<li>
						<i class="fa fa-calendar"></i> {{$user->dob}}
					</li>
					@elseif($connectionStatus == 'friend' && Auth::user()->induser_id != $user->id && $user->dob_show == 'Everyone' || $user->dob_show == 'Links')
					<li>
						<i class="fa fa-calendar"></i> {{$user->dob}}
					</li>
					@elseif($user->dob_show == 'Everyone')
					<li>
						<i class="fa fa-calendar"></i> {{$user->dob}}
					</li>
					@elseif(Auth::user()->induser_id != $user->id && $user->dob_show == 'None')
					
					@endif
					@if($user->gender == 'Female')
					<li>
						<i class="fa fa-female"></i> {{$user->gender}}
					</li>
					@else($user->gender == 'Male')
					<li>
						<i class="fa fa-male"></i> {{$user->gender}}
					</li>
					@endif
					@if($user->education != null)
					<li class="capitalize">
						<i class="fa fa-graduation-cap"></i> {{$user->education}} in {{$user->branch}}
					</li>
					@endif
					@if($user->experience != null && $user->experience != 0)
					<li class="capitalize">
						<i class="fa fa-briefcase"></i> {{ $user->experience }} Years
					</li>
					@elseif($user->experience == 0 )
					<li class="capitalize">
						<i class="fa fa-briefcase"></i> Fresher
					</li>
					@else
					
					@endif
					<li>
						<i class="fa fa-map-marker"></i> {{$user->city}}
					</li>
					
					<!-- <li>
						<i class="fa fa-heart"></i> BASE Jumping
					</li> -->
				</ul>
				@elseif($utype == 'corp')
				<ul class="list-inline">
					<li>
						<i class="fa fa-calendar"></i> {{$user->operating_since}}
					</li>
					<li>
						<i class="fa fa-users"></i> {{$user->emp_count}}
					</li>
					
					<li>
						<i class="fa fa-male"></i> {{$user->linked_skill}}
					</li>
					<li>
						<i class="fa fa-map-marker"></i> {{$user->city}}
					</li>
					
					<!-- <li>
						<i class="fa fa-heart"></i> BASE Jumping
					</li> -->
				</ul>
				@endif
			</div>
		</div>
		<!--end row-->
	</div>
</div>
<!-- <div class="row" style="margin: 0;"> -->
@if($utype == 'ind')
<div class="portlet light bordered col-md-5" style="border-radius: 5px !important; ">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-badge font-green-haze"></i>
			<span class="caption-subject font-green-haze bold uppercase">Professional Details</span>
		</div>
		
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
			<div class="form-body">
				<div class="row">

					@if(Auth::user()->id == $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
						<div class="form-group">
							<label class="control-label col-md-4 col-xs-6">Industry</label>							
							<div class="col-md-6 col-xs-6"> 
								<p class="form-control-static view-page">
									@if($user->industry != null)
									{{ $user->industry }}
									@elseif($user->industry == null)
									<a href="/individual/edit#tab_2-2">Add Industry</a>
									@endif
								</p>
							</div>
						</div>
					</div>
					@elseif($user->industry != null && Auth::user()->induser_id != $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
						<div class="form-group">
							<label class="control-label col-md-4 col-xs-6">Industry</label>							
							<div class="col-md-6 col-xs-6">
								<p class="form-control-static view-page">
									@if($user->industry != null)
									{{ $user->industry }}
									@elseif($user->industry == null)
									--
									@endif
								</p>
							</div>
						</div>
					</div>
					@elseif($user->industry == null && Auth::user()->induser_id != $user->id)
					@endif
					<!--/span-->
					@if(Auth::user()->induser_id == $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
						<div class="form-group">
							<label class="control-label col-md-4 col-xs-6">Functional Area</label>
							<div class="col-md-6 col-xs-6">
								<p class="form-control-static view-page">
									@if($user->functional_area != null)
									{{ $user->functional_area }}
									@else
									 <a href="/individual/edit#tab_2-2">Add Functional Area</a>
									@endif
								</p>
							</div>
						</div>
					</div>
					@elseif($user->functional_area != null && Auth::user()->induser_id != $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
						<div class="form-group">
							<label class="control-label col-md-4 col-xs-6">Functional Area</label>
							<div class="col-md-6 col-xs-6">
								<p class="form-control-static view-page">
									@if($user->functional_area != null)
									{{ $user->functional_area }}
									@else
									 --
									 @endif
								</p>
							</div>
						</div>
					</div>
					@elseif($user->functional_area == null && Auth::user()->induser_id != $user->id)
					@endif
					<!--/span-->	
				</div>
				<!--/row-->
				<div class="row">
					@if(Auth::user()->induser_id == $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
						<div class="form-group">
							<label class="control-label col-md-4 col-xs-6">Role</label>
							<div class="col-md-6 col-xs-6">
								<p class="form-control-static view-page">
									@if($user->role != null)
									{{ $user->role }}
									@else
									 <a href="/individual/edit#tab_2-2">Add Role</a>
									@endif
								</p>
							</div>
						</div>
					</div>
					@elseif($user->role != null && Auth::user()->induser_id != $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
						<div class="form-group">
							<label class="control-label col-md-4 col-xs-6">Role</label>
							<div class="col-md-6 col-xs-6">
								<p class="form-control-static view-page">
									@if($user->role != null)
									{{ $user->role }}
									@else
									 --
									 @endif
								</p>
							</div>
						</div>
					</div>
					@elseif($user->role == null && Auth::user()->induser_id != $user->id)
					@endif
					<!--/span-->	
					@if(Auth::user()->induser_id == $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
						<div class="form-group">
							<label class="control-label col-md-4 col-xs-6">Resume</label>
							<div class="col-md-6 col-xs-6">
								<p class="form-control-static view-page">
									@if($user->resume != null)
									 <a href="javascript:;" class="btn btn-xs blue" style="height: 20px;"><i class="icon-eye"></i>&nbsp;View </a>
									 @else
									 <a href="/individual/edit#tab_2-2">Upload Resume</a>
									 @endif
								</p>
							</div>
						</div>
					</div>
					@elseif($user->resume != null && Auth::user()->induser_id != $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
						<div class="form-group">
							<label class="control-label col-md-4 col-xs-6">Resume</label>
							<div class="col-md-6 col-xs-6">
								<p class="form-control-static view-page">
									@if($user->resume != null)
									 <a href="javascript:;" class="btn btn-xs blue" style="height: 20px;"><i class="icon-eye"></i>&nbsp;View </a>
									 @else
									 --
									 @endif
								</p>
							</div>
						</div>
					</div>
					@elseif($user->resume == null && Auth::user()->induser_id != $user->id)
					@endif
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					@if(Auth::user()->induser_id == $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
						<div class="form-group">
							<label class="control-label col-md-4 col-xs-6">Skills</label>
							<div class="col-md-8 col-xs-6">
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
					<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
						<div class="form-group">
							<label class="control-label col-md-4 col-xs-6">Skills</label>
							<div class="col-md-8 col-xs-6">
								<p class="form-control-static view-page">
									
									@if($user->linked_skill != null)
									{{ $user->linked_skill }}
									@elseif($user->linked_skill == null)
									--
									@endif
								</p>
							</div>
						</div>
					</div>
					@elseif($user->linked_skill == null && Auth::user()->induser_id != $user->id)
					@endif
					<!--/span-->
				</div>
					<!-- /row -->
			</div>
		<!-- END FORM-->
	</div>
</div>
@elseif($utype == 'corp')
<div class="portlet light bordered col-md-5">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-badge font-green-haze"></i>
			<span class="caption-subject font-green-haze bold uppercase">Firm Details</span>
		</div>
		
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
			<div class="form-body">
				
				<div class="row">
					
				<div class="row">
					@if($user->industry != null && Auth::user()->corpuser_id == $user->id)
					<div class="col-md-6 col-sm-6 col-xs-12">
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
					<div class="col-md-6 col-sm-6 col-xs-12">
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
@endif
@if($utype == 'ind')
<div class="portlet light bordered col-md-4" style="border-radius: 5px !important; ">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-notebook font-green-haze"></i>
			<span class="caption-subject font-green-haze bold uppercase">Preferences</span>
			<span class="caption-helper"></span>
		</div>
		
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="individual/create" class="horizontal-form" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-body">
				<div class="row">
					@if(Auth::user()->induser_id == $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							
							<!-- <div class="col-md-12 col-xs-12"> -->
								<p class="form-control-static view-page">
									@if($user->prefered_jobtype != null)
									Looking for {{ $user->prefered_jobtype }} Job in 
										@if($user->p_locality != null)
											{{$user->p_locality}},
										@endif
										@if($user->prefered_location != null)
											{{$user->prefered_location}}
										@endif
									@else
									 <a href="/individual/edit#tab_3-3">Add Job Type</a>
									@endif
								</p>
							<!-- </div> -->
						</div>
					</div>
					@elseif($user->prefered_jobtype != null && Auth::user()->induser_id != $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							
							<!-- <div class="col-md-12 col-xs-12"> -->
								<p class="form-control-static view-page">
									@if($user->prefered_jobtype != null)
									Looking for {{ $user->prefered_jobtype }} Job in 
										@if($user->p_locality != null)
											{{$user->p_locality}},
										@endif
										@if($user->prefered_location != null)
											{{$user->prefered_location}}
										@endif
									@else
									 --
									 @endif
								</p>
							<!-- </div> -->
						</div>
					</div>
					@elseif($user->prefered_jobtype == null && Auth::user()->induser_id != $user->id)
					@endif
				</div>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>
@endif
<!-- </div> -->
@if($utype == 'ind')
<!-- <div class="row" style="margin: 0;"> -->
<div class="portlet light bordered col-md-4" style="border-radius: 5px !important; ">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-notebook font-green-haze"></i>
			<span class="caption-subject font-green-haze bold uppercase">Contact Details</span>
			<span class="caption-helper"></span>
		</div>
		
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="individual/create" class="horizontal-form" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-body">
				@if(Auth::user()->induser_id == $user->id)
				<div class="row" >
					
					<!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-2" style="font-size:13px;"><i class="fa fa-envelope-o"></i></label>
							<div class="col-md-10 col-sm-10 col-xs-10">
								<p class="form-control-static view-page">
									{{ $user->email }} 
									@if($user->email_verify == 0)
									<a>
										<i class="fa fa-exclamation-circle" 
										style="color: #cb5a5e;"></i>
									</a>
									@elseif($user->email_verify == 1)
										<i class="glyphicon glyphicon-ok-circle" style="color: #1EC71E;"></i>
									@endif
								</p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-2"><i class="icon-call-end"></i> </label>
							<div class="col-md-10 col-sm-10 col-xs-10" >
								<p class="form-control-static view-page">
									{{ $user->mobile }} 
									@if($user->mobile_verify == 0)
									<a>
										<i class="fa fa-exclamation-circle" 
										style="color: #cb5a5e;font-size: 16px;"></i>
									</a>
									@elseif($user->mobile_verify == 1)
										<i class="glyphicon glyphicon-ok-circle" style="color: #1EC71E;font-size: 16px;"></i>
									@endif
								</p>
							</div>
						</div>
					</div>
					@endif
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
					@if($connectionStatus == 'friend' && Auth::user()->induser_id != $user->id && $user->email_show == 'Everyone' || $user->dob_show == 'Links')
					<!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-2" style="font-size:13px;"><i class="fa fa-envelope-o"></i> </label>
							<div class="col-md-10 col-sm-10 col-xs-10" >
								<p class="form-control-static view-page">
									{{ $user->email }} 
									@if($user->email_verify == 0)
									<a>
										<i class="fa fa-exclamation-circle" 
										style="color: #cb5a5e;"></i>
									</a>
									@elseif($user->email_verify == 1)
										<i class="glyphicon glyphicon-ok-circle" style="color: #1EC71E;"></i>
									@endif
								</p>
							</div>
						</div>
					<!-- </div> -->
					@elseif(Auth::user()->induser_id != $user->id && $user->email_show == 'Everyone')
					<!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-2" style="font-size:13px;"><i class="fa fa-envelope-o"></i> </label>
							<div class="col-md-10 col-sm-10 col-xs-10" >
								<p class="form-control-static view-page">
									{{ $user->email }} 
									@if($user->email_verify == 0)
									<a>
										<i class="fa fa-exclamation-circle" 
										style="color: #cb5a5e;"></i>
									</a>
									@elseif($user->email_verify == 1)
										<i class="glyphicon glyphicon-ok-circle" style="color: #1EC71E;"></i>
									@endif
								</p>
							</div>
						</div>
					<!-- </div> -->
					@elseif(Auth::user()->induser_id != $user->id && $user->email_show == 'None')
					@endif
					<!--/span-->
					@if($connectionStatus == 'friend' && Auth::user()->induser_id != $user->id && $user->mobile_show == 'Everyone' || $user->dob_show == 'Links')
					<!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-2"><i class="icon-call-end"></i> </label>
							<div class="col-md-10 col-sm-10 col-xs-10">
								<p class="form-control-static view-page">
									{{ $user->mobile }} 
									@if($user->mobile_verify == 0)
									<a>
										<i class="fa fa-exclamation-circle" 
										style="color: #cb5a5e;font-size: 16px;"></i>
									</a>
									@elseif($user->mobile_verify == 1)
										<i class="glyphicon glyphicon-ok-circle" style="color: #1EC71E;font-size: 16px;"></i>
									@endif
								</p>
							</div>
						</div>
					<!-- </div> -->
					@elseif(Auth::user()->induser_id != $user->id && $user->mobile_show == 'Everyone')
					<!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-2 col-xs-2"><i class="icon-call-end"></i> </label>
							<div class="col-md-10 col-sm-10 col-xs-10" >
								<p class="form-control-static view-page">
									{{ $user->mobile }} 
									@if($user->mobile_verify == 0)
									<a>
										<i class="fa fa-exclamation-circle" 
										style="color: #cb5a5e;font-size: 16px;"></i>
									</a>
									@elseif($user->mobile_verify == 1)
										<i class="glyphicon glyphicon-ok-circle" style="color: #1EC71E;font-size: 16px;"></i>
									@endif
								</p>
							</div>
						</div>
					<!-- </div> -->
					@elseif(Auth::user()->induser_id != $user->id && $user->mobile_show == 'None')
	
					@endif
					<!--/span-->
				</div>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>
<!-- </div> -->
@elseif($utype == 'corp')
<div class="portlet light bordered col-md-5" style="">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-notebook font-green-haze"></i>
			<span class="caption-subject font-green-haze bold uppercase">Contact Details</span>
			<span class="caption-helper"></span>
		</div>
		
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<form action="individual/create" class="horizontal-form" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-body">
				<div class="row">
					@if($user->firm_address != null && Auth::user()->corpuser_id == $user->id)
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label col-md-4 col-xs-6">Address:</label>
							<div class="col-md-8 col-xs-6">
								<p class="form-control-static view-page">
									@if($user->firm_address != null)
									 {{ $user->firm_address }}
									 @elseif($user->firm_address == null)
									 --
									 @endif
								</p>
							</div>
						</div>
					</div>
					@elseif($user->firm_address != null && Auth::user()->corpuser_id != $user->id)
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label col-md-4 col-xs-6">Address:</label>
							<div class="col-md-8 col-xs-6">
								<p class="form-control-static view-page">
									@if($user->firm_address != null)
									 {{ $user->firm_address }}
									 @elseif($user->firm_address == null)
									 --
									 @endif
								</p>
							</div>
						</div>
					</div>
					@elseif($user->firm_address == null && Auth::user()->corpuser_id != $user->id)
					@endif
					<!--/span-->
					<div class="col-md-6 col-sm-6 col-xs-12">	
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				
				<div class="row">
					@if($user->username != null && Auth::user()->corpuser_id == $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label col-md-6 col-sm-6 col-xs-12">Profile Handler Name:</label>
							<div class="col-md-6 col-sm-6 col-xs-12" style="padding:0;">
								<p class="form-control-static view-page">	
									 {{ $user->username }}
								</p>
							</div>
						</div>
					</div>
					@elseif($user->username != null && Auth::user()->corpuser_id != $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label col-md-6 col-sm-6 col-xs-12">Profile Handler Name:</label>
							<div class="col-md-6 col-sm-6 col-xs-12" style="padding:0;">
								<p class="form-control-static view-page">	
									{{ $user->username }}
								</p>
							</div>
						</div>
					</div>
					@elseif($user->username == null && Auth::user()->corpuser_id != $user->id)
					@endif
					<div class="col-md-6 col-sm-6 col-xs-12">
					</div>
				</div>
				<div class="row">
					@if($user->working_as != null && Auth::user()->corpuser_id == $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label col-md-6 col-sm-6 col-xs-12">Working As:</label>
							<div class="col-md-6 col-sm-6 col-xs-12" style="padding:0;">
								<p class="form-control-static view-page">	
									 {{ $user->working_as }}
								</p>
							</div>
						</div>
					</div>
					@elseif( $user->working_as != null && Auth::user()->corpuser_id != $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label col-md-6 col-sm-6 col-xs-12">Working As:</label>
							<div class="col-md-6 col-sm-6 col-xs-12" style="padding:0;">
								<p class="form-control-static view-page">	
									{{ $user->working_as }}
								</p>
							</div>
						</div>
					</div>
					@elseif($user->working_as == null && Auth::user()->corpuser_id != $user->id)
					@endif
					<div class="col-md-6 col-sm-6 col-xs-12">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label col-md-6 col-sm-6 col-xs-12">Email Id:</label>
							<div class="col-md-6 col-sm-6 col-xs-12" style="padding:0;">
								<p class="form-control-static view-page">
									{{ $user->firm_email_id }} <i class="glyphicon glyphicon-ok-circle" style="color: #1EC71E;font-size: 16px;"></i>
								</p>
							</div>
						</div>
					</div>
					<!--/span-->
					@if($user->firm_phone != null && Auth::user()->corpuser_id == $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label col-md-6 col-sm-6 col-xs-12">Mobile:</label>
							<div class="col-md-6 col-sm-6 col-xs-12" style="padding:0;">
								<p class="form-control-static view-page">
									 {{ $user->firm_phone }} <i class="fa fa-exclamation-circle" style="color: #cb5a5e;font-size: 16px;"></i>
								</p>
							</div>
						</div>
					</div>
					@elseif($user->firm_phone != null && Auth::user()->corpuser_id != $user->id)
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label col-md-6 col-sm-6 col-xs-12">Mobile:</label>
							<div class="col-md-6 col-sm-6 col-xs-12" style="padding:0;">
								<p class="form-control-static view-page">
									 {{ $user->firm_phone }} <i class="fa fa-exclamation-circle" style="color: #cb5a5e;font-size: 16px;"></i>
								</p>
							</div>
						</div>
					</div>
					@elseif($user->firm_phone == null && Auth::user()->corpuser_id != $user->id)
					@endif
					<!--/span-->
				</div>

			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>
@endif
@stop

@javascript
<script src="/assets/admin/pages/scripts/profile.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features\
});
</script>
@stop