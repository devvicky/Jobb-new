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
								@if($rp->action == '[]')
								<a href="/report-abuse/action/warningemail/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="icon-envelope"></i> Warning Email
									</button>
								</a>
								<button class="btn btn-success" style="padding: 2px 10px;">
									<i class="icon-call-end"></i> Warning SMS
								</button>
								<a href="/report-abuse/action/hidepost/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										Hide Post
									</button>
								</a>
								<a href="/report-abuse/action/blockuser/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="glyphicon glyphicon-ban-circle"></i> Block User
									</button>
								</a>
								@elseif($rp->action != '[]')
									@if($rp->action->first()->warning_email_sent == 0)
										<a href="/report-abuse/action/warningemail/{{$rp->post->id}}">
											<button class="btn btn-success" style="padding: 2px 10px;">
												<i class="icon-envelope"></i> Warning Email
											</button>
										</a>
									@endif							
									@if($rp->action->first()->warning_email_sent == 1)
										<button class="btn btn-success" style="padding: 2px 10px;">
											<i class="icon-check"></i> Warning Email Sent
										</button>
										<label>{{$rp->action->first()->email_dtTime}}</label>
									@endif
									@if($rp->action->first()->post_inactive == 0)
										<a href="/report-abuse/action/hidepost/{{$rp->post->id}}">
											<button class="btn btn-success" style="padding: 2px 10px;">
												Hide Post
											</button>
										</a>
									@endif
									@if($rp->action->first()->post_inactive == 1)
										<button class="btn btn-success" style="padding: 2px 10px;">
											Post Hidden
										</button>
										<label>{{$rp->action->first()->post_inactivity_dtTime}}</label>
										<a href="/report-abuse/action/showpost/{{$rp->post->id}}">
											<button class="btn btn-success" style="padding: 2px 10px;">
												Show Post
											</button>
										</a>
									@endif
									@if($rp->action->first()->post_user_blocked == 0)
										<a href="/report-abuse/action/blockuser/{{$rp->post->id}}">
											<button class="btn btn-success" style="padding: 2px 10px;">
												<i class="glyphicon glyphicon-ban-circle"></i> Block User
											</button>
										</a>
									@endif
									@if($rp->action->first()->post_user_blocked == 1)
										<button class="btn btn-success" style="padding: 2px 10px;">
											<i class="glyphicon glyphicon-ban-circle"></i> User Blocked
										</button>
										<a href="/report-abuse/action/unblockuser/{{$rp->post->id}}">
											<button class="btn btn-success" style="padding: 2px 10px;">
												<i class="glyphicon glyphicon-ban-circle"></i> Unblock User
											</button>
										</a>
									@endif
								@endif
								<div class="actions">
									
								<div class="btn-group">
									<a class="btn green-haze btn-circle btn-sm" 
										href="javascript:;" data-toggle="dropdown" 
										data-hover="dropdown" data-close-others="true" 
										aria-expanded="false">
										{{$rp->total}} users <i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										@foreach($reportAbuses as $ra)
											<li style="border-bottom:1px dotted lightgrey;">
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
												{{ \Carbon\Carbon::createFromTimeStamp(strtotime($ra->created_at))->diffForHumans() }}
											</li>
										@endforeach
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
							Abusive Profile</span>
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
								@if($rp->action == '[]')
								<a href="/report-abuse/action/warningemail/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="icon-envelope"></i> Warning Email
									</button>
								</a>
								<button class="btn btn-success" style="padding: 2px 10px;">
									<i class="icon-call-end"></i> Warning SMS
								</button>
								<a href="/report-abuse/action/hidepost/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										Hide Post
									</button>
								</a>
								<a href="/report-abuse/action/blockuser/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="glyphicon glyphicon-ban-circle"></i> Block User
									</button>
								</a>
								@elseif($rp->action != '[]')
									@if($rp->action->first()->warning_email_sent == 0)
										<a href="/report-abuse/action/warningemail/{{$rp->post->id}}">
											<button class="btn btn-success" style="padding: 2px 10px;">
												<i class="icon-envelope"></i> Warning Email
											</button>
										</a>
									@endif							
									@if($rp->action->first()->warning_email_sent == 1)
										<button class="btn btn-success" style="padding: 2px 10px;">
											<i class="icon-check"></i> Warning Email Sent
										</button>
										<label>{{$rp->action->first()->email_dtTime}}</label>
									@endif
									@if($rp->action->first()->post_inactive == 0)
										<a href="/report-abuse/action/hidepost/{{$rp->post->id}}">
											<button class="btn btn-success" style="padding: 2px 10px;">
												Hide Post
											</button>
										</a>
									@endif
									@if($rp->action->first()->post_inactive == 1)
										<button class="btn btn-success" style="padding: 2px 10px;">
											Post Hidden
										</button>
										<label>{{$rp->action->first()->post_inactivity_dtTime}}</label>
										<a href="/report-abuse/action/showpost/{{$rp->post->id}}">
											<button class="btn btn-success" style="padding: 2px 10px;">
												Show Post
											</button>
										</a>
									@endif
									@if($rp->action->first()->post_user_blocked == 0)
										<a href="/report-abuse/action/blockuser/{{$rp->post->id}}">
											<button class="btn btn-success" style="padding: 2px 10px;">
												<i class="glyphicon glyphicon-ban-circle"></i> Block User
											</button>
										</a>
									@endif
									@if($rp->action->first()->post_user_blocked == 1)
										<button class="btn btn-success" style="padding: 2px 10px;">
											<i class="glyphicon glyphicon-ban-circle"></i> User Blocked
										</button>
										<a href="/report-abuse/action/unblockuser/{{$rp->post->id}}">
											<button class="btn btn-success" style="padding: 2px 10px;">
												<i class="glyphicon glyphicon-ban-circle"></i> Unblock User
											</button>
										</a>
									@endif
								@endif
								<div class="actions">
									
								<div class="btn-group">
									<a class="btn green-haze btn-circle btn-sm" 
										href="javascript:;" data-toggle="dropdown" 
										data-hover="dropdown" data-close-others="true" 
										aria-expanded="false">
										{{$rp->total}} users <i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										@foreach($reportAbuses as $ra)
											<li style="border-bottom:1px dotted lightgrey;">
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
												{{ \Carbon\Carbon::createFromTimeStamp(strtotime($ra->created_at))->diffForHumans() }}
											</li>
										@endforeach
									</ul>
								</div>
							</div>
							</div>
						</div>
					@endforeach							
				</div>
		</div>
	</div>
	</div>
		
	<div class="clearfix">
	</div>
	
@stop

@section('javascript')
@stop