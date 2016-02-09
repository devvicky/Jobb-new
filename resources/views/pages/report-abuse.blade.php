@extends('admin')

@section('content')

	<!-- BEGIN PAGE HEADER-->
	<h3 class="page-title">
	Report Abuse <small>reports & statistics</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="/home">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="/report-abuse">Report Abuse</a>
			</li>
		</ul>
		
	</div>
	<!-- END PAGE HEADER-->
	<div class="clearfix"></div>

	<div class="row">
		<div class="col-md-6 col-sm-6">
			<!-- BEGIN PORTLET-->
			<div class="portlet light" style="background-color: whitesmoke;margin-top:0">
				<div class="portlet-title tabbable-line">
					<div class="caption">
						<i class="icon-globe font-green-sharp"></i>
						<span class="caption-subject font-green-sharp bold uppercase">
							Abusive Post Report</span>
					</div>
				</div>
				<div class="portlet-body">
					@foreach($reportedPosts as $rp)
						<div class="row">
							<div class="col-md-12 user-info">
							@if($rp->post->induser != null)
								<img title="{{$rp->post->induser->fname}}" 
									 src="../../img/profile/{{$rp->post->induser->profile_pic}}" 
									 class="img-responsive" style="width:45px;height:45px">
							@elseif($rp->post->corpuser != null)
								<img title="{{$rp->post->corpuser->firm_name}}"
									 src="../../img/profile/{{$rp->post->corpuser->logo_status}}" 
									 class="img-responsive" style="width:45px;height:45px">
							@endif

								<div class="details">
									<div>
										<a href="javascript:;">{{$rp->post->post_title}}</a>
									</div>
									<div>
									{{ \Carbon\Carbon::createFromTimeStamp(strtotime($rp->post->created_at))->diffForHumans() }}
									</div>
								</div>
							</div>
							<div class="col-md-12 user-info">
								<a href="/report-abuse/action/warningemail/{{$rp->post->id}}">
									<button class="btn btn-success">Warning Email</button>
								</a>
								<button class="btn btn-success">Warning SMS</button>
								<a href="/report-abuse/action/hidepost/{{$rp->post->id}}">
									<button class="btn btn-success">Hide Post</button>
								</a>
								<a href="/report-abuse/action/blockuser/{{$rp->post->id}}">
									<button class="btn btn-success">Block User</button>
								</a>
								<div class="actions">
									
								<div class="btn-group">
									<label style="margin-right:5px" 
									class="btn btn-transparent grey-salsa btn-circle btn-sm active" title="Reported by">
										{{$rp->total}} users
									</label>

									<a class="btn green-haze btn-circle btn-sm" 
										href="javascript:;" data-toggle="dropdown" 
										data-hover="dropdown" data-close-others="true" 
										aria-expanded="false">
										Action <i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu pull-right">
									@if($rp->action == '[]')
										<li>
											<a href="/report-abuse/action/warningemail/{{$rp->post->id}}">
												Send warning email
											</a>
										</li>
										<li>
											<a href="/report-abuse/action/hidepost/{{$rp->post->id}}">
												Hide Post
											</a>
										</li>
										<li>
											<a href="/report-abuse/action/blockuser/{{$rp->post->id}}">
												Block user
											</a>
										</li>
									@elseif($rp->action != '[]')

										@if($rp->action->first()->warning_email_sent == 0)
											<li>
												<a href="/report-abuse/action/warningemail/{{$rp->post->id}}">
													Send warning email
												</a>
											</li>
										@endif							
										@if($rp->action->first()->warning_email_sent == 1)
											<li>
												<a href="#" style="background: whitesmoke;cursor: default;">
													warning email sent
												</a>
											</li>
										@endif
										@if($rp->action->first()->post_inactive == 0)
											<li>
												<a href="/report-abuse/action/hidepost/{{$rp->post->id}}">
													Hide Post
												</a>
											</li>
										@endif
										@if($rp->action->first()->post_inactive == 1)
											<li>
												<a href="#" style="background: whitesmoke;cursor: default;">
													Post hidden
												</a>
											</li>
											<li>
												<a href="/report-abuse/action/showpost/{{$rp->post->id}}">
													Show post
												</a>
											</li>
										@endif
										@if($rp->action->first()->post_user_blocked == 0)
											<li>
												<a href="/report-abuse/action/blockuser/{{$rp->post->id}}">
													Block user
												</a>
											</li>
										@endif
										@if($rp->action->first()->post_user_blocked == 1)
											<li>
												<a href="#" style="background: whitesmoke;cursor: default;">
													User blocked
												</a>
											</li>
											<li>
												<a href="/report-abuse/action/unblockuser/{{$rp->post->id}}">
													Unblock user
												</a>
											</li>
										@endif

									@endif
									</ul>
								</div>
							</div>
							</div>
						</div>
					@endforeach							
				</div>
			</div>					
		</div>
		
		<div class="col-md-6 col-sm-6">
		<!-- BEGIN PORTLET-->
			<div class="portlet light" style="background-color: whitesmoke;margin-top:0">
				<div class="portlet-title tabbable-line">
					<div class="caption">
						<i class="icon-globe font-green-sharp"></i>
						<span class="caption-subject font-green-sharp bold uppercase">
							Recent reports</span>
					</div>
				</div>
				<div class="portlet-body">
			<ul class="feeds">
				@foreach($reportAbuses as $ra)
				<li>
					<div class="col1">
						<div class="cont">
							<div class="cont-col1">
								<div class="label label-sm label-danger">
									<i class="fa fa-user"></i>
								</div>
							</div>
							<div class="cont-col2">
								<div class="desc">
									<b>{{$ra->user->fname}}</b> has reported 
									<b>{{$ra->reported_for}}</b> on post id 
									<b>{{$ra->post_id}}</b> 
									posted by <b>
									@if($ra->post->induser != null)
										{{$ra->post->induser->fname}}
									@elseif($ra->post->corpuser != null)
										{{$ra->post->corpuser->firm_name}}
									@endif
									</b>
								</div>
							</div>
						</div>
					</div>
					<div class="col2">
						<div class="date">
						{{ \Carbon\Carbon::createFromTimeStamp(strtotime($ra->created_at))->diffForHumans() }}
						</div>
					</div>
				</li>
				@endforeach
			</ul>
			</div>	
		</div>
	</div>
	</div>
		
	<div class="clearfix">
	</div>
	
@stop

@section('javascript')
@stop