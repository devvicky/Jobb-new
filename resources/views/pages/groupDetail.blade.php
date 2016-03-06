@extends('master')

@section('content')

<div class="portlet light bordered col-md-7">
	<div class="portlet-title">
		<div class="caption links-title">
			<i class=""></i>
			<span class="caption-subject capitalize" style="margin:0 30px;line-height: 1.5;">				
				{{$group->group_name}}   				
			</span>
			<a href="/group" class="group-title-info btn btn-xs btn-warning" 
				style="text-decoration:none;border-radius: 4px !important;float:left;margin:0 -15px;">
				Back
			</a>			

			<div class="group-admin-title pull-right">
				@if($group->admin->id == Auth::user()->induser_id)
					<a id="ajax-demo" href="#edit-group" data-toggle="modal" class="badge btn btn-xs btn-info" style="" title="Edit">
						<i class="fa fa-edit"></i><span class="hidden-xs font-group"> Edit</span>
					</a>
				@endif
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
				@if($group->admin->id == Auth::user()->induser_id)
					<a id="ajax-demo4" href="#change-admin" data-toggle="modal" class="badge btn btn-xs btn-info" style="" title="Edit">
						<i class="fa fa-sign-out"></i><span class="hidden-xs font-group">Leave Group</span>
					</a>
				@endif
			</div>
		</div>		
	</div>
	

	<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
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
	<div class="portlet-body form">
		<div class="form-body" style="padding:20px 0;">	
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10" style="">
					<div class="form-group clearfix" style="margin-bottom:0">	
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
					</div>

					<div class="col-md-12" id="search-results" 
						 style="background:#f2f2f2;max-height:200px;overflow:auto;margin-bottom:10px">
					</div>
				</div>			
			</div>
		</div>
	</div>
	<div class="portlet-body form">
		<div class="form-body" style="padding:0px 0;">	
			<div class="row">
				<div class="col-md-10" style="margin:0 -10px;">
					@if($group->admin->id == Auth::user()->induser_id)
						<span class="group-admin-title-left"><i class="icon-shield"></i> Admin</span> 
						<a href="/profile/ind/{{$group->admin->id}}">
						<span class="group-admin-title-right">You</span>
						</a>
						@else
						<span class="group-admin-title-left"><i class="icon-shield"></i> Admin</span> 
						<a href="/profile/ind/{{$group->admin->id}}">
						<span class="group-admin-title-right">{{$group->admin->fname}} {{$group->admin->lname}}</span>
						</a>
						@endif
				</div>			
			</div>
		</div>
	</div>
</div>
<div class="portlet box green col-md-7">
	<div class="portlet-title">
		<ul class="nav nav-tabs" style="padding-left: 0;float:left;">
			<li class="active">
				<a href="#tab_5_1" class="label-new" data-toggle="tab" style="border-left:0;">
					<span class="hidden-xs hidden-sm">Group</span> Members 
					@if(count($users) > 0)
						<span class="badge" style="background-color: deepskyblue;"> 
							{{count($users)}}
						</span>
					 @endif
				</a>
			</li>
			<li>
				<a href="#tab_5_2" class="label-new" data-toggle="tab">
					Add <span class="hidden-xs hidden-sm">Members</span> 
					@if(count($connections) > 0)
						<span class="badge" style="background-color: deepskyblue;"> 
							{{count($connections)}}
						</span>
					 @endif
				</a>
			</li>
		</ul>
		<div class="done-show" style="float:right;margin:8px 0;">
			<form id="" action="/group/deleteuser" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="delete_id"  value="{{$group->id}}">
				<input id="removegroupusers" type="hidden" name="remove_group_users">
				<button class="btn" style="padding: 0px 5px;background-color: darkslategrey;color: white;">
					<i class="icon-close"></i> Remove
				</button>
			</form>
		</div>
		<div class="add-done-show" style="float:right;margin:8px 0;">
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
	<div class="portlet-body">
		<div class="tabbable-custom ">
			
			<div class="tab-content">
				<div class="tab-pane active" id="tab_5_1">
					@if(count($users) > 0)
					@foreach($users as $user)
					<div class="row" style="border-bottom:1px dotted lightgrey;padding: 5px 0;">
						
						<div class="col-md-2 col-sm-2 col-xs-3">
							<a href="#">
						        <img class="media-object img-circle" src="@if($user->profile_pic != null){{ '/img/profile/'.$user->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" alt="..." style="padding: 3px;border: 1px solid #ddd;">
						    </a>
						</div>
						<div class="col-md-7 col-sm-7 col-xs-6">
							<a href="/profile/ind/{{$user->id}}" data-utype="ind">
				      			{{ $user->fname }} {{ $user->lname }}</a>
						     	 @if($user->id == $user->admin_id && $user->id != null)
						      	<span class="btn btn-xs btn-warning" style="border-radius:25px !important;margin:0 10px">
						      		Admin
						      	</span>
					      @endif
					      <br>{{ $user->working_at }}
							 {{ $user->city }}
						</div>
						<div class="col-md-1 col-sm-1 col-xs-1">
							@if($user->admin_id == Auth::user()->induser_id)
							<label>
								<input type="checkbox" id="" class="remove-done" data-checkbox="icheckbox_square-grey" onchange="removeUsers({{$user->groups_users_id}})">
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
				<div class="tab-pane" id="tab_5_2">
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
@stop


@section('javascript')

<script type="text/javascript">
 $addToGroupMember = [];
 $removeFromGroupMember = [];
function removeUsers($groupid){
    if($('.remove-done').is(":checked")){
    	$(".done-show").show();
    	$(".add-done-show").hide();

    	if($.inArray( ""+$groupid, $removeFromGroupMember ) < 0){
	    	$removeFromGroupMember.push(""+$groupid);
	    }else{
	    	$removeFromGroupMember = $.grep($removeFromGroupMember, function(value) {
			  return value != ""+$groupid;
			});
	    }
    }else{
    	$(".done-show").hide();
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
