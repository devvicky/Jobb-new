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
		<li>
			<a href="/links#tab_1_2">Groups</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li class="active">
			{{$group->group_name}}
		</li>
	</ul>
</div>
<!-- END PAGE BREADCRUMB -->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PROFILE SIDEBAR -->
		<div class="profile-sidebar" style="width: 250px;">
			<!-- PORTLET MAIN -->
			<div class="portlet light profile-sidebar-portlet" style="">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<a id="ajax-demo" href="#profile-pic" data-toggle="modal" class="config">     
	                    @if($group->admin->profile_pic != null)
	                      <img src="/img/profile/{{ $group->admin->profile_pic }}" class="img-responsive">
	                    @else
	                      <img src="/img/profile/{{ $group->admin->profile_pic }}" class="demo-new" data-name="{{$group->admin->fname}}">
	                    @endif
	                </a>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">	
					</div>
					<div class="profile-usertitle-job">
						@if($group->admin->id == Auth::user()->induser_id)
						<span class="group-admin-title-left"><i class="icon-shield" style="font-size:11px;"></i> Admin</span> 
						<a href="/profile/ind/{{$group->admin->id}}">
						<span class="group-admin-title-right">You</span>
						</a>
						@else
						<span class="group-admin-title-left"><i class="icon-shield" style="font-size:11px;"></i> Admin</span> 
						<a href="/profile/ind/{{$group->admin->id}}">
						<span class="group-admin-title-right">{{$group->admin->fname}} {{$group->admin->lname}}</span>
						</a>
						@endif
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav" style="padding:0;">
						<li class="active">
							<a href="#tab_1_1" data-toggle="tab">
								<i class="icon-users"></i>Group Members 
								@if(count($users) > 0)
									<span class="badge" style="background-color: deepskyblue;"> 
										{{count($users)}}
									</span>
								 @endif
							</a>
						</li>
						<li>
							<a href="#tab_1_2" data-toggle="tab">
								<i class="icon-user-follow"></i>Add Members
								@if(count($connections) > 0)
									<span class="badge" style="background-color: deepskyblue;"> 
										{{count($connections)}}
									</span>
								 @endif
							</a>
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
							<div class="portlet light " style="background-color:white;">
								
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-8 col-sm-8">
											<span class="caption-subject font-blue-madison bold uppercase">{{$group->group_name}}</span>
											@if($group->admin->id == Auth::user()->induser_id)
												<a id="ajax-demo" href="#edit-group" data-toggle="modal" class="edit-group-btn" title="Edit">
													<i class="fa fa-edit"></i>
												</a>
											@endif
										</div>
										<div class="col-md-4 col-sm-4" style="margin: -8px 0;text-align: right;">
											@if($group->admin->id == Auth::user()->induser_id)
												<a id="ajax-demo4" href="#change-admin" data-toggle="modal" title="Leave" class="leave-group-btn btn btn-icon-only btn-circle default">
													<i class="fa fa-sign-out"></i>
												</a>
											@endif
											@if($group->admin->id == Auth::user()->induser_id)				
												<a id="ajax-demo2" href="#delete-group" data-toggle="modal" title="Delete" class="delete-group-btn btn btn-icon-only btn-circle default">
													<i class="fa fa-trash"></i>
												</a>				
											@else
												<a id="ajax-demo3" href="#leave-group" data-toggle="modal" title="Leave" class="leave-group-btn btn btn-icon-only btn-circle default">
													<i class="fa fa-sign-out"></i>
												</a>
											@endif
										</div>
									</div>
								</div>
							</div>
							<!-- END PORTLET -->
						</div>
					</div>
					<div class="row">
						<div class="col-md-9">
							<!-- BEGIN PORTLET -->
							<div class="portlet light " style="background-color:white;">
								<div class="portlet-title">
									<div class="caption caption-md">
										<i class="icon-bar-chart theme-font hide"></i>
										<span class="caption-subject font-blue-madison bold uppercase">Search Members</span>
									</div>
								</div>
								<div class="portlet-body">
									<!-- <div class="col-md-12" style=""> -->
										<!-- <div class="form-group clearfix" style="margin-bottom:0">	 -->
											<!-- BEGIN FORM-->
											<form action="/searchLinks" class="horizontal-form" method="post">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">				
												<div class="input-icon right">
													<i class="fa fa-search" style="color: darkcyan;"></i>
													<input type="text" name="keywords" id="search-input" 
															onkeydown="down()" 
															onkeyup="up()" class="form-control" 
															placeholder="Search" style="border: 1px solid darkcyan;" />
												</div>	
											</form>
											<!-- END FORM-->
										<!-- </div> -->

										<div class="col-md-12" id="search-results" 
											 style="background:#f2f2f2;max-height:200px;overflow:auto;margin-bottom:10px">
										</div>
									<!-- </div> -->
								</div>
							</div>
							<!-- END PORTLET -->
						</div>
					</div>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1_1">
							<div class="row">
								<div class="col-md-9">
									<div class="portlet light " style="background-color:white;">
										<div class="portlet-title">
											<div class="caption caption-md">
												<i class="icon-bar-chart theme-font hide"></i>
												<span class="caption-subject font-blue-madison bold uppercase">Group Members</span>
												<div class="done-show" style="float:right;    margin: 0px 15px;">
													<form id="" action="/group/deleteuser" method="post">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="delete_id"  value="{{$group->id}}">
														<input id="removegroupusers" type="hidden" name="remove_group_users">
														<button class="btn" style="padding: 0px 5px;background-color: darkslategrey;color: white;font-size:13px;">
															<i class="icon-close" style="font-size:12px;"></i><span class=""> Remove</span>
														</button>
													</form>
												</div>
											</div>
											<a href="/group/{{$group->id}}/#tab_1_2" class="btn btn-icon-only btn-circle default add-group-btn green-meadow" style="float:right;"><i class="fa fa-plus"></i><a>
										</div>
										<div class="portlet-body">
											@if(count($users) > 0)
											@foreach($users as $user)
											<div class="row" style="border-bottom:1px dotted lightgrey;padding: 5px 0;">
										
												<div class="col-md-2 col-sm-2 col-xs-3">
													<a href="#">
												        <img class="img-circle" src="@if($user->profile_pic != null){{ '/img/profile/'.$user->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" alt="..." style="padding: 3px;">
												    </a>
												</div>
												<div class="col-md-7 col-sm-7 col-xs-6">
													<a href="/profile/ind/{{$user->id}}" data-utype="ind">
										      			{{ $user->fname }} {{ $user->lname }}</a>
												     	@if($user->id == $user->admin_id && $user->id != null)
													      	<span class="btn btn-xs btn-primary" style="border-radius:15px !important;margin:0 10px;padding: 0 5px;font-size: 11px;">
													      		Admin
													      	</span>
												      @endif
											      <br>{{ $user->role }}<br/>
													 {{ $user->city }}
												</div>
												<div class="col-md-1 col-sm-1 col-xs-1">
													@if($user->admin_id == Auth::user()->induser_id)
													<label>
														@if($user->admin_id != $user->id)
														<input type="checkbox" id="" class="remove-done" data-checkbox="icheckbox_square-grey" onchange="removeUsers({{$user->groups_users_id}})">
														@endif
													</label>
													@endif
												<!-- </div> -->
												</div>
											</div>
											@endforeach
											@else
											No Group Members
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_1_2">
							<div class="row">
								<div class="col-md-9">
									<div class="portlet light " style="background-color:white;">
										<div class="portlet-title">
											<div class="caption caption-md">
												<i class="icon-bar-chart theme-font hide"></i>
												<span class="caption-subject font-blue-madison bold uppercase">Select your Links and Add</span>
												<div class="add-done-show" style="float:right;margin:0px 15px;">
													<form id="" action="/group/adduser" method="post">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="add_group_id"  value="{{$group->id}}">
														<input id="addgroupusers" type="hidden" name="add_group_users" >
														<button class="btn" style="padding: 0px 5px;background-color: darkslategrey;color: white;">
															<i class="icon-plus"></i> Add
														</button>
													</form>
												</div>
											</div>
										</div>
										<div class="portlet-body">
											@if(count($connections) > 0)
											@foreach($connections as $connection)	
												@if($connection->id != $group->admin_id)
												<div class="row" style="border-bottom:1px dotted lightgrey;padding: 5px 0;">
													
													<div class="col-md-2 col-sm-2 col-xs-3">
														<a href="#">
													        <img class="media-object img-circle" src="@if($connection->profile_pic != null){{ '/img/profile/'.$connection->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" alt="..." style="width:60px;padding: 3px;border: 1px solid #ddd;">
													     </a>
													</div>
													<div class="col-md-7 col-sm-7 col-xs-6">
														<a href="/profile/ind/{{$connection->id}}" data-utype="ind">
														      		{{$connection->fname}} {{$connection->lname}}</a>
													     {{ $connection->working_at }}<br>
														 {{ $connection->city }} {{ $connection->state }}
													</div>
													<div class="col-md-1 col-sm-1 col-xs-1">
													<label>
														<input type="checkbox" id="" class="add-done" data-checkbox="icheckbox_square-grey" onchange="valueChange({{$connection->id}})">
													 </label>
													</div>
												</div>						
												
												  @endif						
											@endforeach
											@else
											No Links to be added.
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_1_4">
							<div class="row">
								<div class="col-md-9">
									<!-- BEGIN PORTLET -->
									<div class="portlet light " style="background-color:white;">
										<div class="portlet-title">
											<div class="caption caption-md">
												<i class="icon-bar-chart theme-font hide"></i>
												<span class="caption-subject font-blue-madison bold uppercase">
													@if($group->admin->id == Auth::user()->induser_id)
													 Delete Group
													 @else
													 Leave Group
													@endif
												</span>
											</div>
										</div>
										<div class="portlet-body">
											@if($group->admin->id == Auth::user()->induser_id)				
												<a id="ajax-demo2" href="#delete-group" data-toggle="modal" title="Delete" 
													class="badge btn btn-xs btn-danger" style="text-decoration: none;">
													<i class="fa fa-trash"></i><span class="hidden-xs font-group"> Delete Group</span>
												</a>				
											@else				
												<a id="ajax-demo3" href="#leave-group" data-toggle="modal" 
													class="badge btn btn-xs" style="text-decoration: none;">						
													<i class="fa fa-sign-out"></i><span class="hidden-xs font-group"> Leave Group</span>
												</a>
											@endif
										</div>
									</div>
									<!-- END PORTLET -->
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_1_5">
							<div class="row">
								<div class="col-md-9">
									<!-- BEGIN PORTLET -->
									<div class="portlet light " style="background-color:white;">
										<div class="portlet-title">
											<div class="caption caption-md">
												<i class="icon-bar-chart theme-font hide"></i>
												<span class="caption-subject font-blue-madison bold uppercase">Leave Group</span>
											</div>
										</div>
										<div class="portlet-body">
											@if($group->admin->id == Auth::user()->induser_id)
												<a id="ajax-demo4" href="#change-admin" data-toggle="modal" class="badge btn btn-sm btn-info" style="" title="Edit">
													<i class="fa fa-sign-out"></i><span class="hidden-xs font-group">Leave Group</span>
												</a>
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
<div class="modal fade" id="change-admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog" style="width: 300px;">
	    <div class="modal-content">
	    	<form action="/group/adminchange/{{$group->id}}" class="horizontal-form" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
		     	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			        <h4 class="modal-title" style="text-align:center;">
			        	<label class="admin-change-css">You are admin of the group<br/> "{{$group->group_name}}"</label>
					</h4>
			     </div>
				<div class="modal-body">
					<label class="admin-change-css">Select another admin.</label>
					<div class="form-group">
						<!-- <div class="input-group"> -->
							<select class="form-control" name="admin_id">
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
								@endforeach
							</select>
						<!-- </div> -->
					</div>	      		
	     		</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Submit</button>
					<button type="button" class="btn default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	    <!-- /.modal-content -->
 	</div>
  	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="edit-group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog" style="width: 300px;">
	    <div class="modal-content">
	    	<form action="/group/update/{{$group->id}}" class="horizontal-form" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
		     	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			        <h4 class="modal-title">{{$group->group_name}}</h4>
			     </div>
				<div class="modal-body">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-users" style="color:darkcyan;"></i>
							</span>
							<input type="text" maxlength="30" name="group_name" class="form-control" placeholder="Enter New Group name">
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
<div class="modal fade" id="delete-group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog" style="width: 300px;">
	    <div class="modal-content">
	    	<form action="/group/destroy/{{$group->id}}" class="horizontal-form" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
		     	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			        <h4 class="modal-title">Are you sure</h4>
			     </div>
				<div class="modal-body">
					  You want to delete this Group   		
	     		</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-warning">Yes</button>
					<button type="button" class="btn default" data-dismiss="modal">No</button>
				</div>
			</form>
		</div>
	    <!-- /.modal-content -->
 	</div>
  	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="leave-group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog" style="width: 300px;">
	    <div class="modal-content">
	    	<form action="/group/leavegroup" class="horizontal-form" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
		     	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			        <h4 class="modal-title">Are you sure</h4>
			     </div>
				<div class="modal-body">
					  You want to leave this Group   		
	     		</div>
				<div class="modal-footer">
					<input type="hidden" name="my_id" value="{{Auth::user()->induser_id}}">
					<input type="hidden" name="my_group_id" value="{{$group->id}}">
					<button type="submit" class="btn btn-warning">Yes</button>
					<button type="button" class="btn default" data-dismiss="modal">No</button>
				</div>
			</form>
		</div>
	    <!-- /.modal-content -->
 	</div>
  	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@stop


@section('javascript')

<script type="text/javascript">
 $addToGroupMember = [];
 $removeFromGroupMember = [];
function removeUsers($groupid){
    if($('.remove-done').is(":checked")){
    	$(".done-show").show();
    	$(".add-done-show").hide();
    	$(".add-group-btn").hide();
    	if($.inArray( ""+$groupid, $removeFromGroupMember ) < 0){
	    	$removeFromGroupMember.push(""+$groupid);
	    }else{
	    	$removeFromGroupMember = $.grep($removeFromGroupMember, function(value) {
			  return value != ""+$groupid;
			});
	    }
    }else{
    	$(".done-show").hide();
    	$(".add-group-btn").show();
    	if($.inArray( ""+$groupid, $removeFromGroupMember ) < 0){
	    	$removeFromGroupMember.push(""+$groupid);
	    }else{
	    	$removeFromGroupMember = $.grep($removeFromGroupMember, function(value) {
			  return value != ""+$groupid;
			});
	    }
    }
    $('#removegroupusers').val($removeFromGroupMember);
    // $('#groupid').val($groupuserid);
        
}

function valueChange($userid){

    if($('.add-done').is(":checked")){
    	$(".add-done-show").show();
    	$(".done-show").hide();

    	if($.inArray( ""+$userid, $addToGroupMember ) < 0){
	    	$addToGroupMember.push(""+$userid);
	    }else{
	    	$addToGroupMember = $.grep($addToGroupMember, function(value) {
			  return value != ""+$userid;
			});
	    }
    }else{
    	$(".add-done-show").hide();
    	if($.inArray( ""+$userid, $addToGroupMember ) < 0){
	    	$addToGroupMember.push(""+$userid);
	    }else{
	    	$addToGroupMember = $.grep($addToGroupMember, function(value) {
			  return value != ""+$userid;
			});
	    }
    }
    	$('#addgroupusers').val($addToGroupMember);
    	// console.log($addToGroupMember);        
}

	jQuery(document).ready(function() { 
	    ComponentsIonSliders.init();
	    ComponentsDropdowns.init();
	    ComponentsEditors.init();
	    FormiCheck.init();
	});   
</script>
<script type="text/javascript">
    $('#connections').select2();
// $(document).ready(function(){
//   $('input').iCheck({
//     checkboxClass: 'icheckbox_flat-blue',
//     radioClass: 'iradio_square',
//     increaseArea: '20%' // optional
//   });
// });

   
</script>
<script type="text/javascript">
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
});

var timer;
function up(){
	timer=setTimeout(function(){
			var keywords = $('#search-input').val();
			var group_id = {{$group->id}};
			if(keywords.length>2){
				$.post('/searchLinks', {keywords: keywords, groupid: group_id}, function(markup){
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
</script>
@stop
