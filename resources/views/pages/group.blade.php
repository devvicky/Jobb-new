@extends('master')

@section('content')
<div class="row margin-top-10">
	<div class="col-md-12">
		<!-- BEGIN PROFILE SIDEBAR -->
		<div class="profile-sidebar" style="width: 250px;">
			<!-- PORTLET MAIN -->
			<div class="portlet light profile-sidebar-portlet">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<a id="ajax-demo" href="#profile-pic" data-toggle="modal" class="config">
	                    @if(Auth::user()->induser->profile_pic == null && $user->induser->fname != null)
	                      <div class="hover-image"><i class="fa fa-camera"></i> Add</div>
	                    @endif      
	                    @if(Auth::user()->induser->profile_pic != null)
	                      <img src="/img/profile/{{ Auth::user()->induser->profile_pic }}" class="img-responsive">
	                      <div class="hover-image"><i class="glyphicon glyphicon-edit"></i>Edit</div>
	                    @else
	                      <img src="/img/profile/{{ Auth::user()->induser->profile_pic }}" class="demo-new" data-name="{{Auth::user()->induser->fname}}">
	                      <div class="hover-image"><i class="glyphicon glyphicon-edit"></i>Edit</div>
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
							<a href="#tab_1_1" data-toggle="tab"><i class=" icon-user"></i>Groups</a>
						</li>
						
						<li>
							<a href="#tab_1_2" data-toggle="tab"><i class="icon-briefcase"></i>Create Group</a>
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
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1_1">
							<div class="row">
								<div class="col-md-9">
									@if(count($groups)>0)
									@foreach($groups as $group)
									<!-- BEGIN PORTLET -->
									<div class="portlet light " style="background-color:white;">
										<div class="portlet-title">
											<div class="caption caption-md">
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
												<label style="font-size: 11px;opacity:0.8;">Created Date: {{ date('d M Y', strtotime($group->created_at)) }}</label>
											</div>
											<div>
												
											</div>
										</div>
										<div class="portlet-body" style="padding-top:0;">
											<div class="table-scrollable table-scrollable-borderless" style="margin:0 !important;">
												<table class="table table-hover table-light">
													<thead>
														<tr class="uppercase">
															<th width="30%" style="font-size: 11px;text-align:center;">
																 Created By
															</th>
															<th width="30%" style="font-size: 11px;text-align:center;">
																 No of Users
															</th>
															<th width="30%" style="font-size: 11px;text-align:center;">
																 Modify
															</th>
														</tr>
													</thead>
													<tr>
														<td style="text-align:center;">
															@if($group->admin->id == Auth::user()->induser_id)
															You
															@else
															<a href="/profile/ind/{{$group->admin()->first()->id}}">{{$group->admin()->first()->fname}}</a>
															@endif
														</td>
														<td style="text-align:center;">{{count($group->users)}}</td>
														<td style="text-align:center;">
															@if($group->admin->id == Auth::user()->induser_id)
																<a href="/group/{{ $group->id }}" style="color: dodgerblue;font-weight: 600;">
																	<i class="fa fa-edit (alias)"></i> Edit
																</a>
															@else
																<a href="/group/{{ $group->id }}" style="color: dodgerblue;font-weight: 600;">
																	<i class="fa fa-plus-circle"></i> Add
																</a>
															@endif
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<!-- END PORTLET -->
									@endforeach
									@endif
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_1_2">
							<div class="row">
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


<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
@stop

@section('javascript')

<script>
	$('#connections').select2();
</script>

<script type="text/javascript">
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
});

var timer;
function up()
{
	timer=setTimeout(function()
		{
			var keywords = $('#search-input').val();
			if(keywords.length>2)
			{
				$.post('/searchConnections', {keywords: keywords}, function(markup)
				{
					$('#search-results').html(markup);
				});
			}
			else
			{
				$('#search-results').empty();
			}
		}, 500);
}

function down()
{
	clearTimeout(timer);
}
</script>
@stop