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
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa  fa-ellipsis-v"></i> Abusive Post Report
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
			<a href="#portlet-config" data-toggle="modal" class="config">
			</a>
			<a href="javascript:;" class="reload">
			</a>
			<a href="javascript:;" class="remove">
			</a>
		</div>
	</div>
	<div class="portlet-body form" style="height:300px;">
		<!-- Begin: life time stats -->
		<div class="portlet" style="overflow-x:scroll;height:300px;">
			
			<div class="portlet-body">
				<div class="table-container">
					
			<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
				<thead>
				<tr>
					<th class="table-checkbox">
						<input type="checkbox" class="group-checkable"/>
					</th>
					<th>
						 Post Id
					</th>
					<th>
						 Reported by
					</th>
					<th>
						 Warning Email
					</th>
					<th>
						 Warning SMS
					</th>
					<th>
						 Hide Post
					</th>
					<th>
						 Block User
					</th>
				</tr>
				</thead>
				@foreach($reportedAbusivePosts as $rp)
				<tbody>
				<tr class="odd gradeX">
					<td>
						<input type="checkbox" class="checkboxes" value="1"/>
					</td>
					<td style="text-align:center;">
						<div class="btn-group">
							<a class="btn green-haze btn-circle btn-sm" 
								href="javascript:;" data-toggle="dropdown" 
								 data-close-others="true" 
								aria-expanded="false" 
								style="background-color: transparent !important;color: dimgray !important;">
								{{$rp->post->unique_id}} <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-report" style="background-color: dimgray !important;">
								<li style="border-bottom:1px dotted lightgrey;color:white !important;">
									<i class="fa fa-flag"></i> : {{ $rp->post->post_title }}<br/>
									<i class="icon-envelope"></i> : {{ $rp->post->email_id }}<br/>
									<i class="icon-user"></i> : {{ $rp->post->contact_person }}<br/>
									<i class="fa fa-info"></i> : {{ $rp->post->reference_id }}<br/>
									@if($rp->post->website_redirect_url != null)
									<i class="fa fa-info"></i> : {{ $rp->post->website_redirect_url }}<br/>
									@endif
									Skills : {{ $rp->linked_skill }}<br/>
									Post Detail : {{ $rp->post->job_detail }}
								</li>
								
							</ul>
						</div>
					</td>
					<td style="text-align:center;">
						<div class="btn-group">
							<a class="btn green-haze btn-circle btn-sm" 
								href="javascript:;" data-toggle="dropdown" 
								 data-close-others="true" 
								aria-expanded="false">
								{{$rp->total}} users <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-report" style="background-color: dimgray !important;">
								@foreach($reportAbuses as $ra)
									<li style="border-bottom:1px dotted lightgrey;">
										<span style="color: white !important;margin: 0 6px;">
											<a href="/profile/ind/{{$ra->user->id}}" style="color: white !important;">{{$ra->user->fname}}
											</a>
										</span>
										<span style="font-size:10px;color: #BEC2C5;">
											{{ \Carbon\Carbon::createFromTimeStamp(strtotime($ra->created_at))->diffForHumans() }}
										</span>
									</li>
								@endforeach
							</ul>
						</div>
					</td>
					<td style="text-align:center;">
						 @if($rp->action == '[]')
							<a href="/report-abuse/action/warningemail/{{$rp->post->id}}">
								<button class="btn btn-success" style="padding: 2px 10px; font-size:12px;">
									<i class="icon-envelope"></i>
								</button>
							</a>
						@elseif($rp->action != '[]')
							@if($rp->action->first()->warning_email_sent == 0)
								<a href="/report-abuse/action/warningemail/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="icon-envelope"></i> 
									</button>
								</a>
							@endif							
							@if($rp->action->first()->warning_email_sent == 1)
								<button class="btn btn-success send-icon" style="padding: 2px 10px;">
									<i class="icon-check"></i> 
								</button>
								<label class="date-css">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($rp->action->first()->email_dtTime))->diffForHumans() }}</label>
							@endif	
						@endif
					</td>
					<td style="text-align:center;">
						@if($rp->action == '[]')
							<button class="btn btn-success" style="padding: 2px 10px;">
								<i class="fa fa-edit (alias)"></i> 
							</button>
						@elseif($rp->action != '[]')
							<button class="btn btn-success" style="padding: 2px 10px;">
								<i class="fa fa-edit (alias)"></i> 
							</button>
						@endif
					</td>
					<td style="text-align:center;">
						@if($rp->action == '[]')
							<a href="/report-abuse/action/hidepost/{{$rp->post->id}}">
								<button class="btn btn-success" style="padding: 2px 10px;">
								<i class="glyphicon glyphicon-eye-close"></i>
								</button>
							</a>
						@elseif($rp->action != '[]')
							@if($rp->action->first()->post_inactive == 0)
								<a href="/report-abuse/action/hidepost/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="glyphicon glyphicon-eye-close"></i>
									</button>
								</a>
							@endif
							@if($rp->action->first()->post_inactive == 1)
								<button class="btn btn-success send-icon" style="padding: 2px 10px;">
									<i class="icon-check"></i>
								</button>
								<label class="date-css">
									{{ \Carbon\Carbon::createFromTimeStamp(strtotime($rp->action->first()->post_inactivity_dtTime))->diffForHumans() }}
								</label>
							@endif
						@endif
					</td>
					<td style="text-align:center;">
						@if($rp->action == '[]')
							<a href="/report-abuse/action/blockuser/{{$rp->post->id}}">
								<button class="btn btn-success" style="padding: 2px 10px;">
									<i class="glyphicon glyphicon-ban-circle"></i>
								</button>
							</a>
						@elseif($rp->action != '[]')
							@if($rp->action->first()->post_user_blocked == 0)
								<a href="/report-abuse/action/blockuser/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="glyphicon glyphicon-ban-circle"></i>
									</button>
								</a>
							@endif
							@if($rp->action->first()->post_user_blocked == 1)
								<button class="btn btn-success send-icon" style="padding: 2px 0px;">
									<i class="glyphicon glyphicon-ban-circle"></i>
								</button>
								<label class="date-css">
									{{ \Carbon\Carbon::createFromTimeStamp(strtotime($rp->action->first()->user_blocked_dtTime))->diffForHumans() }}
								</label>
								<a href="/report-abuse/action/unblockuser/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="fa fa-unlock"></i> Unblock User
									</button>
								</a>
							@endif
						@endif
					</td>
				</tr>
				</tbody>
				@endforeach
				</table>
				</div>
			</div>
		</div>
		<!-- End: life time stats -->
	</div>
</div>
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa  fa-ellipsis-v"></i> Abusive Profile
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
			<a href="#portlet-config" data-toggle="modal" class="config">
			</a>
			<a href="javascript:;" class="reload">
			</a>
			<a href="javascript:;" class="remove">
			</a>
		</div>
	</div>
	<div class="portlet-body form" style="height:300px;">
			<!-- Begin: life time stats -->
		<div class="portlet" style="overflow-x:scroll;height:300px;">
			<div class="portlet-body">
				<div class="table-container">
					<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
				<thead>
				<tr>
					<th class="table-checkbox">
						<input type="checkbox" class="group-checkable"/>
					</th>
					<th>
						 Profile
					</th>
					<th>
						 Reported by
					</th>
					<th>
						 Warning Email
					</th>
					<th>
						 Warning SMS
					</th>
					<th>
						 Hide Post
					</th>
					<th>
						 Block User
					</th>
				</tr>
				</thead>
				@foreach($reportedProfile as $rp)
				<tbody>
				<tr class="odd gradeX">
					<td>
						<input type="checkbox" class="checkboxes" value="1"/>
					</td>
					<td style="text-align:center;">
						<div class="btn-group">
							<a class="btn green-haze btn-circle btn-sm" 
								href="javascript:;" data-toggle="dropdown" 
								 data-close-others="true" 
								aria-expanded="false"
								style="background-color: transparent !important;color: dimgray !important;">
								{{$profileDetail->user->fname}} {{$profileDetail->user->lname}} <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-report" style="background-color: dimgray !important;">
								<li style="border-bottom:1px dotted lightgrey;color:white !important;margin:5px;">
									 @if($rp->post->induser != null)
								<img title="{{$rp->post->induser->fname}}" 
									 src="../../img/profile/{{$rp->post->induser->profile_pic}}" 
									 class="img-responsive" style="width:45px;height:45px;float:left;margin: 15px 5px;">
							@elseif($rp->post->corpuser != null)
								<img title="{{$rp->post->corpuser->firm_name}}"
									 src="../../img/profile/{{$rp->post->corpuser->logo_status}}" 
									 class="img-responsive" style="width:45px;height:45px;float:left;margin: 15px 5px;">
							@endif<br/>
							 @if($rp->post->induser != null)
							 		About {{$profileDetail->user->fname}} : {{$profileDetail->user->about_individual}}<br/>
									<i class="icon-envelope"></i> : {{$profileDetail->user->email}}<br/>
									<i class="fa fa-university"></i> : {{$profileDetail->user->working_at}}<br/>
									Skills : {{$profileDetail->user->linked_skill}}<br/>
									
							@elseif($rp->post->corpuser != null)
							About {{$rp->post->corpuser->firm_name}} : {{$rp->post->corpuser->about_firm}}<br/>
									<i class="icon-user"></i> : {{$rp->post->corpuser->firm_name}}<br/>
									<i class="fa fa-university"></i> : {{$rp->post->corpuser->slogan}}<br/>
									<i class="icon-envelope"></i> : {{$rp->post->corpuser->firm_email_id}}<br/>
									
									<i class="icon-envelope"></i> : {{$rp->post->corpuser->website_url}}<br/>
							@endif
								</li>

							</ul>
						</div>
					</td>
					<td style="text-align:center;">
						<div class="btn-group">
						<a class="btn green-haze btn-circle btn-sm" 
							href="javascript:;" data-toggle="dropdown" 
							 data-close-others="true" 
							aria-expanded="false">
							{{$rp->total}} users <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-report" style="background-color: dimgray !important;">
							@foreach($reportProfileAbuses as $ra)
								<li style="border-bottom:1px dotted lightgrey;">
									<span style="color: white !important;margin: 0 6px;">
										<a href="/profile/ind/{{$ra->user->id}}" style="color: white !important;">{{$ra->user->fname}}
										</a>
									</span>
									<span style="font-size:10px;color: #BEC2C5;">
										{{ \Carbon\Carbon::createFromTimeStamp(strtotime($ra->created_at))->diffForHumans() }}
									</span>
								</li>
							@endforeach
						</ul>
					</div>
					</td>
					<td style="text-align:center;">
						 @if($rp->action == '[]')
							<a href="/report-abuse/action/warningemail/{{$rp->post->id}}">
								<button class="btn btn-success" style="padding: 2px 10px; font-size:12px;">
									<i class="icon-envelope"></i>
								</button>
							</a>
						@elseif($rp->action != '[]')
							@if($rp->action->first()->warning_email_sent == 0)
								<a href="/report-abuse/action/warningemail/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="icon-envelope"></i> 
									</button>
								</a>
							@endif							
							@if($rp->action->first()->warning_email_sent == 1)
								<button class="btn btn-success send-icon" style="padding: 2px 10px;">
									<i class="icon-check"></i> 
								</button>
								<label class="date-css">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($rp->action->first()->email_dtTime))->diffForHumans() }}</label>
							@endif	
						@endif
					</td>
					<td style="text-align:center;">
						@if($rp->action == '[]')
							<button class="btn btn-success" style="padding: 2px 10px;">
								<i class="fa fa-edit (alias)"></i> 
							</button>
						@elseif($rp->action != '[]')
							<button class="btn btn-success" style="padding: 2px 10px;">
								<i class="fa fa-edit (alias)"></i> 
							</button>
						@endif
					</td>
					<td style="text-align:center;">
						@if($rp->action == '[]')
							<a href="/report-abuse/action/hidepost/{{$rp->post->id}}">
								<button class="btn btn-success" style="padding: 2px 10px;">
								<i class="glyphicon glyphicon-eye-close"></i>
								</button>
							</a>
						@elseif($rp->action != '[]')
							@if($rp->action->first()->post_inactive == 0)
								<a href="/report-abuse/action/hidepost/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="glyphicon glyphicon-eye-close"></i>
									</button>
								</a>
							@endif
							@if($rp->action->first()->post_inactive == 1)
								<button class="btn btn-success send-icon" style="padding: 2px 10px;">
									<i class="icon-check"></i>
								</button>
								<label class="date-css">
									{{ \Carbon\Carbon::createFromTimeStamp(strtotime($rp->action->first()->post_inactivity_dtTime))->diffForHumans() }}
								</label>
							@endif
						@endif
					</td>
					<td style="text-align:center;">
						@if($rp->action == '[]')
							<a href="/report-abuse/action/blockuser/{{$rp->post->id}}">
								<button class="btn btn-success" style="padding: 2px 10px;">
									<i class="glyphicon glyphicon-ban-circle"></i>
								</button>
							</a>
						@elseif($rp->action != '[]')
							@if($rp->action->first()->post_user_blocked == 0)
								<a href="/report-abuse/action/blockuser/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="glyphicon glyphicon-ban-circle"></i>
									</button>
								</a>
							@endif
							@if($rp->action->first()->post_user_blocked == 1)
								<button class="btn btn-success send-icon" style="padding: 2px 0px;">
									<i class="glyphicon glyphicon-ban-circle"></i>
								</button>
								<label class="date-css">
									{{ \Carbon\Carbon::createFromTimeStamp(strtotime($rp->action->first()->user_blocked_dtTime))->diffForHumans() }}
								</label>
								<a href="/report-abuse/action/unblockuser/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="fa fa-unlock"></i> Unblock User
									</button>
								</a>
							@endif
						@endif
					</td>
				</tr>
				</tbody>
				@endforeach
				</table>
				</div>
			</div>
		</div>
		<!-- End: life time stats -->
	</div>
</div>

<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa  fa-ellipsis-v"></i> Spam Report
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
			<a href="#portlet-config" data-toggle="modal" class="config">
			</a>
			<a href="javascript:;" class="reload">
			</a>
			<a href="javascript:;" class="remove">
			</a>
		</div>
	</div>
	<div class="portlet-body form" style="height:300px;">
		<!-- Begin: life time stats -->
		<div class="portlet" style="overflow-x:scroll;height:300px;">
			<div class="portlet-body">
				<div class="table-container">
					
					<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
				<thead>
				<tr>
					<th class="table-checkbox">
						<input type="checkbox" class="group-checkable"/>
					</th>
					<th>
						 Post Id
					</th>
					<th>
						 Reported by
					</th>
					<th>
						 Warning Email
					</th>
					<th>
						 Warning SMS
					</th>
					<th>
						 Hide Post
					</th>
					<th>
						 Block User
					</th>
				</tr>
				</thead>
				@foreach($reportedSpam as $rp)
				<tbody>
				<tr class="odd gradeX">
					<td>
						<input type="checkbox" class="checkboxes" value="1"/>
					</td>
					<td style="text-align:center;">
						<div class="btn-group">
							<a class="btn green-haze btn-circle btn-sm" 
								href="javascript:;" data-toggle="dropdown" 
								 data-close-others="true" 
								aria-expanded="false"
								style="background-color: transparent !important;color: dimgray !important;">
								{{$rp->post->unique_id}} <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-report" style="background-color: dimgray !important;">
								<li style="border-bottom:1px dotted lightgrey;color:white !important;">
									<i class="fa fa-flag"></i> : {{ $rp->post->post_title }}<br/>
									<i class="icon-envelope"></i> : {{ $rp->post->email_id }}<br/>
									<i class="icon-user"></i> : {{ $rp->post->contact_person }}<br/>
									<i class="fa fa-info"></i> : {{ $rp->post->reference_id }}<br/>
									@if($rp->post->website_redirect_url != null)
									<i class="fa fa-info"></i> : {{ $rp->post->website_redirect_url }}<br/>
									@endif
									Skills : {{ $rp->linked_skill }}<br/>
									Post Detail : {{ $rp->post->job_detail }}
								</li>
								
							</ul>
						</div>
					</td>
					<td style="text-align:center;">
						<div class="btn-group">
						<a class="btn green-haze btn-circle btn-sm" 
							href="javascript:;" data-toggle="dropdown" 
							 data-close-others="true" 
							aria-expanded="false">
							{{$rp->total}} users <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-report" style="background-color: dimgray !important;">
							@foreach($reportSpamAbuses as $ra)
								<li style="border-bottom:1px dotted lightgrey;">
									<span style="color: white !important;margin: 0 6px;">
										<a href="/profile/ind/{{$ra->user->id}}" style="color: white !important;">{{$ra->user->fname}}
										</a>
									</span>
									<span style="font-size:10px;color: #BEC2C5;">
										{{ \Carbon\Carbon::createFromTimeStamp(strtotime($ra->created_at))->diffForHumans() }}
									</span>
								</li>
							@endforeach
						</ul>
					</div>
					</td>
					<td style="text-align:center;">
						 @if($rp->action == '[]')
							<a href="/report-abuse/action/warningemail/{{$rp->post->id}}">
								<button class="btn btn-success" style="padding: 2px 10px; font-size:12px;">
									<i class="icon-envelope"></i>
								</button>
							</a>
						@elseif($rp->action != '[]')
							@if($rp->action->first()->warning_email_sent == 0)
								<a href="/report-abuse/action/warningemail/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="icon-envelope"></i> 
									</button>
								</a>
							@endif							
							@if($rp->action->first()->warning_email_sent == 1)
								<button class="btn btn-success send-icon" style="padding: 2px 10px;">
									<i class="icon-check"></i> 
								</button>
								<label class="date-css">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($rp->action->first()->email_dtTime))->diffForHumans() }}</label>
							@endif	
						@endif
					</td>
					<td style="text-align:center;">
						@if($rp->action == '[]')
							<button class="btn btn-success" style="padding: 2px 10px;">
								<i class="fa fa-edit (alias)"></i> 
							</button>
						@elseif($rp->action != '[]')
							<button class="btn btn-success" style="padding: 2px 10px;">
								<i class="fa fa-edit (alias)"></i> 
							</button>
						@endif
					</td>
					<td style="text-align:center;">
						@if($rp->action == '[]')
							<a href="/report-abuse/action/hidepost/{{$rp->post->id}}">
								<button class="btn btn-success" style="padding: 2px 10px;">
								<i class="glyphicon glyphicon-eye-close"></i>
								</button>
							</a>
						@elseif($rp->action != '[]')
							@if($rp->action->first()->post_inactive == 0)
								<a href="/report-abuse/action/hidepost/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="glyphicon glyphicon-eye-close"></i>
									</button>
								</a>
							@endif
							@if($rp->action->first()->post_inactive == 1)
								<button class="btn btn-success send-icon" style="padding: 2px 10px;">
									<i class="icon-check"></i>
								</button>
								<label class="date-css">
									{{ \Carbon\Carbon::createFromTimeStamp(strtotime($rp->action->first()->post_inactivity_dtTime))->diffForHumans() }}
								</label>
							@endif
						@endif
					</td>
					<td style="text-align:center;">
						@if($rp->action == '[]')
							<a href="/report-abuse/action/blockuser/{{$rp->post->id}}">
								<button class="btn btn-success" style="padding: 2px 10px;">
									<i class="glyphicon glyphicon-ban-circle"></i>
								</button>
							</a>
						@elseif($rp->action != '[]')
							@if($rp->action->first()->post_user_blocked == 0)
								<a href="/report-abuse/action/blockuser/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="glyphicon glyphicon-ban-circle"></i>
									</button>
								</a>
							@endif
							@if($rp->action->first()->post_user_blocked == 1)
								<button class="btn btn-success send-icon" style="padding: 2px 0px;">
									<i class="glyphicon glyphicon-ban-circle"></i>
								</button>
								<label class="date-css">
									{{ \Carbon\Carbon::createFromTimeStamp(strtotime($rp->action->first()->user_blocked_dtTime))->diffForHumans() }}
								</label>
								<a href="/report-abuse/action/unblockuser/{{$rp->post->id}}">
									<button class="btn btn-success" style="padding: 2px 10px;">
										<i class="fa fa-unlock"></i> Unblock User
									</button>
								</a>
							@endif
						@endif
					</td>
				</tr>
				</tbody>
				@endforeach
				</table>
				</div>
			</div>
		</div>
		<!-- End: life time stats -->
	</div>
</div>

<!-- END PAGE CONTENT-->
	<div class="clearfix">
	</div>
	
@stop

@section('javascript')
@stop