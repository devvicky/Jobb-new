@extends('master')

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
	<li>
		<a href="/home">Home</a><i class="fa fa-circle"></i>
	</li>
	<li class="active">
		My Activity
	</li>
</ul>
<!-- END PAGE BREADCRUMB -->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PROFILE SIDEBAR -->
		<div class="profile-sidebar" style="width: 250px;">
			<!-- PORTLET MAIN -->
			<div class="portlet light profile-sidebar-portlet">
				@if(Auth::user()->identifier == 1)
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<a id="ajax-demo" href="#profile-pic" data-toggle="modal" class="config">
	                    @if($user->induser->profile_pic == null && $user->induser->fname != null)
	                      <div class="hover-image"><i class="fa fa-camera"></i> Add</div>
	                    @endif      
	                    @if($user->induser->profile_pic != null)
	                      <img src="/img/profile/{{ $user->induser->profile_pic }}" class="img-responsive">
	                      <div class="hover-image"><i class="glyphicon glyphicon-edit"></i>Edit</div>
	                    @else
	                      <img src="/img/profile/{{ $user->induser->profile_pic }}" class="demo-new" data-name="{{$user->induser->fname}}">
	                      <div class="hover-image"><i class="glyphicon glyphicon-edit"></i>Edit</div>
	                    @endif
	                </a>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						 {{ $user->induser->fname }} {{ $user->induser->lname }}
					</div>
					<div class="profile-usertitle-job">
						@if($user->induser->role != null) {{$user->induser->role}} @endif 
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				@elseif(Auth::user()->identifier == 2)
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<a id="ajax-demo" href="#profile-pic" data-toggle="modal" class="config">
	                    @if($user->corpuser->logo_status == null && $user->corpuser->firm_name != null)
	                      <div class="hover-image"><i class="fa fa-camera"></i> Add</div>
	                    @endif      
	                    @if($user->corpuser->logo_status != null)
	                      <img src="/img/profile/{{ $user->corpuser->logo_status }}" class="img-responsive">
	                      <div class="hover-image"><i class="glyphicon glyphicon-edit"></i>Edit</div>
	                    @else
	                      <img src="/img/profile/{{ $user->corpuser->logo_status }}" class="demo-new" data-name="">
	                      <div class="hover-image"><i class="glyphicon glyphicon-edit"></i>Edit</div>
	                    @endif
	                </a>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						 {{ $user->corpuser->firm_name }}
					</div>
					<div class="profile-usertitle-job">
						@if($user->corpuser->slogan != null) {{$user->corpuser->slogan}} @endif 
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				@endif
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav" style="padding:0;">
						
						<li class="active">
							<a href="#tab_1_1" data-toggle="tab"><i class=" icon-user"></i> Manage Posts</a>
						</li>
						@if(Auth::user()->identifier == 1)
						<li>
							<a href="#tab_1_2" data-toggle="tab"><i class="icon-settings"></i>Acitivity Log</a>
						</li>
						@endif
					</ul>
					
				</div>
				<!-- END MENU -->
				<!-- PORTLET MAIN -->
			</div>
			<div class="portlet light">
				<div class="row list-separated profile-stat" style="text-align:center;">
					@if(Auth::user()->identifier == 1)
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
					@endif
					<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'notify_view'){{'active'}}@endif" style="padding:0;">
						<a href="/notify/thanks/ind/{{Auth::user()->induser_id}}" data-utype="thank" class="icon-btn icon-btn-new">
							<i class="icon-like"></i>
							<div>
								 Thanks
							</div>
							<span class="badge badge-danger  @if($thanks > 0) show @else hide @endif" style="background-color: #3598dc;">
							{{$thanks}}</span>
						</a>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4 @if($title == 'mypost'){{'active'}}@endif" style="padding:0;">
						<a href="/mypost" class="icon-btn icon-btn-new">
							<i class="icon-note"></i>
							<div>
								 Posts
							</div>
							<span class="badge badge-danger  @if(count($posts) > 0) show @else hide @endif">
							{{count($posts)}} </span>
						</a>
					</div>
				</div>
				
			</div>
			<!-- END PORTLET MAIN -->
		</div>
		<!-- BEGIN PROFILE CONTENT -->
		<div class="profile-content">
		<div class="row">
			<div class="col-md-12">
				<div class="tab-content" style="background-color: transparent;">
					<!-- PERSONAL INFO TAB -->
					<div class="tab-pane active" id="tab_1_1">
						<div class="tabbable-line">
							<ul class="nav nav-tabs ">
								<li class="active">
									<a href="#tab_15_1" data-toggle="tab" style="font-size: 14px;">
									Active Post </a>
								</li>
								<li>
									<a href="#tab_15_2" data-toggle="tab" style="font-size: 14px;">
									Expired Post</a>
								</li>
								
							</ul>
							<div class="tab-content" style="background-color: transparent;">
								<div class="tab-pane active" id="tab_15_1">
									<div class="row">
										@if(count($posts) > 0)
										@foreach($posts as $post)	
										<?php 
															$strNew = $post->post_duration;
					                                        $strAdd = $strNew;
					                                        $strAdd = '+'.$strAdd.' day';
													 		$strOld = $post->created_at;
													 		$fresh = $strOld->modify($strAdd);

													 		$currentDate = \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'));
													 		$expiryDate = new \Carbon\Carbon($fresh, 'Asia/Kolkata');
													 		$difference = $currentDate->diff($expiryDate);
													 		$remainingDays = $difference->format('%d');
													 		$remainingHours = $difference->format('%h');

													 		$dateExpire= $expiryDate->format('d M Y');
													 		$dayExpire = $difference->format('%d');
													 		if($currentDate >= $fresh){
													 			$expired = 1;
													 		}else{
													 			$expired = 0;
													 		}
													  	?>		
										@if($expired == 0)	
										<div class="col-md-9">
										<!-- BEGIN PORTLET -->
											<div class="portlet light " style="background-color:white;">
												
												<div class="portlet-body" style="padding-top: 1px;">
													<a href="/mypost/single/{{$post->unique_id}}" style="text-decoration:none;">
														@if(count($post->groupTagged) > 0)
							                                        @if($post->sharedGroupBy->first()->mode == 'tagged')
							                                        <div class="row">
							                                            <div class="col-md-12">
								                                            <div class="shared-by">
								                                                You have tagged to <b>{{$post->sharedToGroup->first()->group_name}}</b> group<br/>
								                                            </div>
							                                            </div>
							                                        </div>
							                                        @endif
							                                    @endif
						                                     @if($post->tagged->contains('user_id', Auth::user()->induser_id) && 
						                                        $post->sharedBy->first()->mode == 'tagged')
						                                        
						                                    <small> {{$post->sharedBy->first()->mode}} by 
						                                        {{$post->sharedBy->first()->fname}} {{$post->sharedBy->first()->lname}}</small>
						                                        @endif
						                                <div class="row">
						                                	<div class="col-md-9">
						                                		@if($post->post_type == 'job')
																<small class="badge badge-success capitalize" style="font-size: 12px;border-radius: 3px;padding: 2px 5px; color: white;">
																	{{ $post->post_type }}
																</small>
																@else
																<small class="badge badge-primary capitalize" style="font-size: 12px;border-radius: 3px;padding: 2px 5px; color: white;">
																	{{ $post->post_type }}
																</small>
																@endif

																&nbsp;&nbsp;<span class="caption-subject font-blue-madison bold uppercase" style="font-size: 12px;">{{ $post->post_title }}</span>
						                                	</div>
						                                	<div class="col-md-3">
						                                		<small class="font-grey-cascade">
																	<i class="fa fa-calendar font-grey-cascade" style="font-size: 11px;"></i>&nbsp;&nbsp;{{ date('M d, Y', strtotime($post->created_at)) }}
																</small>
						                                	</div>
						                                </div>
													<a href="/mypost/single/{{$post->unique_id}}" style="text-decoration:none;">
												  	<div class="row" style="margin: 8px -15px;border-bottom: 1px solid #eee;padding: 0px 0 10px 0;">
												  		@if($expired == 0)
												  		<div class="col-md-8 col-sm-8 col-xs-8">
												  			<small class="font-grey-cascade" style="font-size:13px;">Post expires in 
													  			<button class="btn post-expire-duration-css font-grey-cascade"> 
													  				{{($post->post_duration + $post->post_extended)}} days
													  			</button>
													  		</small>
												  		</div>
												  		@endif
												  		<div class="col-md-2 col-sm-2 col-xs-2"><a href="/mypost/single/{{$post->unique_id}}" ><i class="fa  fa-ellipsis-v"></i></a></div>
												  	</div>
												  </a>
													<div class="" >
														@if(Auth::user()->identifier == 2)
														<li  class="active inline">    
														<a href="/mypost/single/{{$post->unique_id}}" style="text-decoration:none;">
															Applied </a>

														<?php $i=0; ?>
														@foreach($post->postactivity as $pa)
														@if($pa->apply == 1) <?php $i++; ?> @endif
														@endforeach
														<?php 
														$uid = $post->unique_id;
														if($i>0){
														echo "<a href='/mypost/single/$uid' style='text-decoration:none;'><span class='badge' style='background-color: deepskyblue;'>";

														        echo $i;
														    
														echo "</span></a>";
														} 
														?>
														</li>
														&nbsp;|&nbsp;
														@elseif(Auth::user()->identifier == 1)
														<li class="active inline">
														<a href="/mypost/single/{{$post->unique_id}}" style="text-decoration:none;">
															Contacted </a>
														<?php $i=0; ?>
														@foreach($post->postactivity as $pa)
														@if($pa->contact_view == 1) <?php $i++; ?> @endif
														@endforeach
														<?php 
														$uid = $post->unique_id;
														if($i>0){
														echo "<a href='/mypost/single/$uid' style='text-decoration:none;'><span class='badge' style='background-color: deepskyblue;'>";

														        echo $i;
														    
														echo "</span></a>";
														} 
														?> 
														</li>
														&nbsp;|&nbsp;
														@endif
														<li class="inline">
														<a href="/mypost/single/{{$post->unique_id}}" style="text-decoration:none;">
															Thanked</a>
														<?php $i=0; ?>
														@foreach($post->postactivity as $pa)
														@if($pa->thanks == 1) <?php $i++; ?> @endif
														@endforeach
														<?php 
														$uid = $post->unique_id;
														if($i>0){
														echo "<a href='/mypost/single/$uid' style='text-decoration:none;'><span class='badge' style='background-color: deepskyblue;'>";

														        echo $i;
														    
														echo "</span></a>";
														} 
														?>
														</li>
														&nbsp;|&nbsp;
														<li class="inline">
														<a href="/mypost/single/{{$post->unique_id}}" style="text-decoration:none;">
															Shared</a>

														<?php $i=0; ?>
														@foreach($post->postactivity as $pa)
														@if($pa->share == 1) <?php $i++; ?> @endif
														@endforeach
														<?php 
														$uid = $post->unique_id;
														if($i>0){
														echo "<a href='/mypost/single/$uid' style='text-decoration:none;'><span class='badge' style='background-color: deepskyblue;'>";

														        echo $i;
														    
														echo "</span></a>";
														} 
														?>
														</li>
													</div>	
													</a>
												</div>
											</div>
											<!-- END PORTLET -->
										</div>	  
										@endif	
										@endforeach	
										@else
										<div class="col-md-12">	
											<div class="updates-style" style="background-color:white;" >
												You have not Posted anything on Jobtip!
											</div>
										</div>
										@endif
									</div>
								</div>
								<div class="tab-pane" id="tab_15_2">
									<div class="row">
									@if(count($posts) > 0)
									@foreach($posts as $post)
										<?php 
														$strNew = $post->post_duration;
				                                        $strAdd = $strNew;
				                                        $strAdd = '+'.$strAdd.' day';
												 		$strOld = $post->created_at;
												 		$fresh = $strOld->modify($strAdd);

												 		$currentDate = \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'));
												 		$expiryDate = new \Carbon\Carbon($fresh, 'Asia/Kolkata');
												 		$difference = $currentDate->diff($expiryDate);
												 		$remainingDays = $difference->format('%d');
												 		$remainingHours = $difference->format('%h');

												 		$dateExpire= $expiryDate->format('d M Y');
												 		$dayExpire = $difference->format('%d');
												 		if($currentDate >= $fresh){
												 			$expired = 1;
												 		}else{
												 			$expired = 0;
												 		}
												  	?>		
									@if($expired == 1)
									<div class="col-md-9">
										<!-- BEGIN PORTLET -->
										<div class="portlet light " style="background-color:white;">
											
											<div class="portlet-body" style="padding-top: 1px;">
												<a href="/mypost/single/{{$post->unique_id}}" style="text-decoration:none;">
													@if(count($post->groupTagged) > 0)
						                                        @if($post->sharedGroupBy->first()->mode == 'tagged')
						                                        <div class="row">
						                                            <div class="col-md-12">
							                                            <div class="shared-by">
							                                                You have tagged to <b>{{$post->sharedToGroup->first()->group_name}}</b> group<br/>
							                                            </div>
						                                            </div>
						                                        </div>
						                                        @endif
						                                    @endif
					                                     @if($post->tagged->contains('user_id', Auth::user()->induser_id) && 
					                                        $post->sharedBy->first()->mode == 'tagged')
					                                        
					                                    <small> {{$post->sharedBy->first()->mode}} by 
					                                        {{$post->sharedBy->first()->fname}} {{$post->sharedBy->first()->lname}}</small>
					                                        @endif
					                                <div class="row">
					                                	<div class="col-md-9">
					                                		@if($post->post_type == 'job')
															<small class="badge badge-success capitalize" style="font-size: 12px;border-radius: 3px;padding: 2px 5px; color: white;">
																{{ $post->post_type }}
															</small>
															@else
															<small class="badge badge-primary capitalize" style="font-size: 12px;border-radius: 3px;padding: 2px 5px; color: white;">
																{{ $post->post_type }}
															</small>
															@endif

															&nbsp;&nbsp;<span class="caption-subject font-blue-madison bold uppercase" style="font-size: 12px;">{{ $post->post_title }}</span>
					                                	</div>
					                                	<div class="col-md-3">
					                                		<small class="font-grey-cascade">
																<i class="fa fa-calendar font-grey-cascade" style="font-size: 11px;"></i>&nbsp;&nbsp;{{$dateExpire}}
															</small>
					                                	</div>
					                                </div>
					                                <div class="row" style="margin: 8px -15px;border-bottom: 1px solid #eee;padding: 0px 0 10px 0;">
												  		<div class="col-md-10 col-sm-10 col-xs-10">
												  			<small class="font-grey-cascade">
																 Post Expired
															</small>
												  		</div>
												  		<div class="col-md-2 col-sm-2 col-xs-2"><a href="/mypost/single/{{$post->unique_id}}" ><i class="fa  fa-ellipsis-v"></i></a></div>
												  	
														<div class="col-md-6">
															<a href="/post/delete/{{$post->unique_id}}"><button class="btn btn-danger delete-post-css">Delete Post</button></a>
														</div>
													</div>
													<div class="">	
														  	
														@if(Auth::user()->identifier == 2)
															<li  class="active inline">    
															<a href="/mypost/single/{{$post->unique_id}}" style="text-decoration:none;">
																Applied </a>

															<?php $i=0; ?>
															@foreach($post->postactivity as $pa)
															@if($pa->apply == 1) <?php $i++; ?> @endif
															@endforeach
															<?php 
															$uid = $post->unique_id;
															if($i>0){
															echo "<a href='/mypost/single/$uid' style='text-decoration:none;'><span class='badge' style='background-color: deepskyblue;'>";

															        echo $i;
															    
															echo "</span></a>";
															} 
															?>
															</li>
															&nbsp;|&nbsp;
															@elseif(Auth::user()->identifier == 1)
															<li class="active inline">
															<a href="/mypost/single/{{$post->unique_id}}" style="text-decoration:none;">
																Contacted </a>
															<?php $i=0; ?>
															@foreach($post->postactivity as $pa)
															@if($pa->contact_view == 1) <?php $i++; ?> @endif
															@endforeach
															<?php 
															$uid = $post->unique_id;
															if($i>0){
															echo "<a href='/mypost/single/$uid' style='text-decoration:none;'><span class='badge' style='background-color: deepskyblue;'>";

															        echo $i;
															    
															echo "</span></a>";
															} 
															?> 
															</li>
															&nbsp;|&nbsp;
															@endif
															<li class="inline">
															<a href="/mypost/single/{{$post->unique_id}}" style="text-decoration:none;">
																Thanked</a>
															<?php $i=0; ?>
															@foreach($post->postactivity as $pa)
															@if($pa->thanks == 1) <?php $i++; ?> @endif
															@endforeach
															<?php 
															$uid = $post->unique_id;
															if($i>0){
															echo "<a href='/mypost/single/$uid' style='text-decoration:none;'><span class='badge' style='background-color: deepskyblue;'>";

															        echo $i;
															    
															echo "</span></a>";
															} 
															?>
															</li>
															&nbsp;|&nbsp;
															<li class="inline">
															<a href="/mypost/single/{{$post->unique_id}}" style="text-decoration:none;">
																Shared</a>

															<?php $i=0; ?>
															@foreach($post->postactivity as $pa)
															@if($pa->share == 1) <?php $i++; ?> @endif
															@endforeach
															<?php 
															$uid = $post->unique_id;
															if($i>0){
															echo "<a href='/mypost/single/$uid' style='text-decoration:none;'><span class='badge' style='background-color: deepskyblue;'>";

															        echo $i;
															    
															echo "</span></a>";
															} 
															?>
															</li>
													</div>	
													</a>			
											</div>
										</div>
										<!-- END PORTLET -->
									</div>	
									@else	
									@endif
									@endforeach	
									@else
									<div class="col-md-9">	
										<div class="updates-style" style="background-color:white;" >
											You have not Posted anything on Jobtip!
										</div>
									</div>
									@endif
								</div>
								</div>
							</div>
						</div>
					</div>
					@if(Auth::user()->identifier == 1)
					<div class="tab-pane" id="tab_1_2">
						<div class="row">
							@foreach($myActivities as $myActivity)
							<div class="col-md-9">
								<!-- BEGIN PORTLET -->
								<div class="portlet light " style="background-color:white;">
									<div class="portlet-body">
										<div class="row">
											<div class="col-md-9">
												<div class="caption caption-md">
													<span class="caption-subject font-blue-madison bold uppercase" style="font-size: 12px;">
														{{$myActivity->identifier}} for {{$myActivity->post_title}}
													</span>
												</div>
											</div>
											<div class="col-md-3">
												<small class="font-grey-cascade">
													<i class="fa fa-calendar font-grey-cascade" style="font-size: 11px;"></i>
													&nbsp;&nbsp;{{ date('M d, Y', strtotime($myActivity->time)) }}
												</small>
											</div>
										</div>
											Post ID: {{$myActivity->unique_id}}  
											@if($myActivity->post_type == 'job')
											<a class="taggedpost" href="/job/post/{{$myActivity->unique_id}}" target="_blank">See the full Post </a>
											@elseif($myActivity->post_type == 'skill')
											<a class="taggedpost" href="/skill/post/{{$myActivity->unique_id}}" target="_blank">See the full Post </a>
											@endif
									</div>
								</div>
								<!-- END PORTLET -->
							</div>
							
							@endforeach		
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
	
<div class="modal fade" id="myactivity-post" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog-new">
		<div class="modal-content">
			<div id="myactivity-post-content">
				My Activity Post 
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- SHARE MODAL FORM-->
<div class="modal fade" id="share-post" tabindex="-1" role="dialog" aria-labelledby="share-post" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Share post</h4>
      </div>
      <form class="form-horizontal" id="modal-post-share-form" role="form" method="POST" action="/post/share">
      <div class="modal-body">
                  
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="share_post_id" id="modal_share_post_id" value="">
		@if(Auth::user()->induser)

		<div id="post-share-msg-box" style="display:none">
			<div id="post-share-msg"></div>
		</div>
		<div id="post-share-form-errors" style="display:none"></div>

		<div class="row"> 
            <div class="col-md-6">                      
              <h4>Who can see this Post</h4>
            </div>
            <div class="col-md-6">
              <!-- <label for="tag-group-all" style="padding: 5.5px 12px;">
                <input type="checkbox" id="tag-group-all" name="tag-group" value="all" class="md-radiobtn">
                Public 
              </label> -->
              <label for="tag-group-links" style="padding: 5.5px 12px;">
                <input type="checkbox" id="tag-group-links" name="tag-group" value="links" class="md-radiobtn" >
                Links 
              </label>
              <label for="tag-group-groups" style="padding: 5.5px 12px;">
                <input type="checkbox" id="tag-group-groups" name="tag-group" value="groups" class="md-radiobtn" >                  
                Groups 
              </label>
            </div>
		</div>          

      	<div class="row"> 
            <div class="col-md-12" id="connections-list">
            
            <label>Links</label>
            {!! Form::select('share_links[]', $share_links, null, ['id'=>'connections', 'class'=>'form-control', 'multiple']) !!}               
            </div>    
		</div>
		<div class="row"> 
			<div class="col-md-12" id="groups-list">
	            <label>Groups</label>
	            {!! Form::select('share_groups[]', $share_groups, null, ['id'=>'groups', 'class'=>'form-control', 'multiple']) !!}  
	        </div>             
		</div>
		@endif            
     
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-success" id="modal-post-share-btn">Share</button>
        <button type="button" class="btn btn-sm default" data-dismiss="modal">Close</button>
      </div>      
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END SHARE MODAL FORM -->
<div class="modal fade" id="myactivity-posts" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="myactivity-posts-content">
				My Activity Post 
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
@stop

@section('javascript')
<script type="text/javascript">
  $(document).ready(function(){
	// myactivity-post
$('.myactivity-posts').on('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('postid');
  	var u_id = $(this).parent().data('uid');
  	console.log(post_id);
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $.ajax({
      url: "/postdetail/detail",
      type: "post",
      data: {postid: post_id, uid: u_id},
      cache : false,
      success: function(data){
    	$('#myactivity-posts-content').html(data);
    	$('#myactivity-posts').modal('show');
      }
    }); 
    return false;
});
});
  </script>
<script type="text/javascript">
	jQuery('#show-social').hide();
	jQuery(document).ready(function(){ 
	    jQuery('#hide-social').on('click', function(event) {
	    jQuery('#show-social').toggle('show');
	    });
	});

	// Magicmatch-post

	$(document).ready(function() {
	    $('.mypost_magicmatch').live('click', function(event) {
	        event.preventDefault();
	        var post_id = $(this).data('mpostid');

	        // console.log(post_id);
	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });

	        $.ajax({
	            url: "/mypostmagicmatch/detail",
	            type: "post",
	            data: {
	                postid: post_id
	            },
	            cache: false,
	            success: function(data) {
	                $('#mypost-magicmatch-posts-content').html(data);
	                $('#mypost_magicmatch').modal('show');
	            }
	        });
	        return false;
	    });
	});




	$(document).ready(function(){ 
		
	    $('.show-contact').on('click', function(event) {
	    var post_id = $(this).parent().data('id');
	    $('#hide-contact-'+post_id).show();
	    });
	});

$(document).ready(function(){
  $('.like-btn').on('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('id');

  	var formData = $('#post-'+post_id).serialize(); 
    var formAction = $('#post-'+post_id).attr('action');

	$count = $('#like-count-'+post_id).text();
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
        if(data > $count){
 			$('#like-count-'+post_id).text(data);
 			$('#like-btn-'+post_id).css({'background-color':'lightgreen'});
        }else if(data < $count){
 			$('#like-count-'+post_id).text(data);
 			$('#like-btn-'+post_id).css({'background-color':'burlywood'});
        }
      }
    }); 
    return false;
  }); 
});

</script>
<script>
// $('.content').slideUp(400);//reset panels

// $('.panel').click(function() {//open
//    var takeID = $(this).attr('id');//takes id from clicked ele
//    $('#'+takeID+'C').slideDown(400);
//                              //show's clicked ele's id macthed div = 1second
// });
// $('span').click(function() {//close
//    var takeID = $(this).attr('id').replace('Close','');
//    //strip close from id = 1second
//     $('#'+takeID+'C').slideUp(400);//hide clicked close button's panel
// });​

$(document).ready(function(){
	// myactivity-post
$('.myactivity-post').on('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('postid');

    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $.ajax({
      url: "/myactivity/postdetail",
      type: "post",
      data: {post_id: post_id},
      cache : false,
      success: function(data){
    	$('#myactivity-post-content').html(data);
    	$('#myactivity-post').modal('show');
      }
    }); 
    return false;
});

$('.viewcontact-view').on('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('postid');

    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $.ajax({
      url: "/viewcontact/view",
      type: "post",
      data: {post_id: post_id},
      cache : false,
      success: function(data){
    	$('#viewcontact-view-content').html(data);
    	$('#viewcontact-view').modal('show');
      }
    }); 
    return false;
});

// get post id for post share
	$('.sojt').on('click',function(event){
	  	var share_post_id = $(this).data('share-post-id');
	  	$('#modal_share_post_id').val(share_post_id);
	});
	
	$('#connections').select2({
            placeholder: "Select links to share"
        });
    $('#groups').select2({
            placeholder: "Select groups to share"
        });

    // share post 
    $('#modal-post-share-btn').on('click',function(event){       
	    event.preventDefault();
		loader('show');

		var share_post_id = $("#modal_share_post_id").val();
	    var formData = $('#modal-post-share-form').serialize(); // form data as string
	    var formAction = $('#modal-post-share-form').attr('action'); // form handler url
	    // console.log(share_post_id);
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
	      	loader('hide');
	        if(data.data.page == 'home'){
	            $('#post-share-msg-box').removeClass('alert alert-danger');
	            $('#post-share-form-errors').hide();
	            $('#post-share-msg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#share-count-'+share_post_id).text(data.data.sharecount);
	            // console.log(data.data.sharecount+" - "+share_post_id);
	            $('#modal-post-share-form')[0].reset();
	            $("#connections").select2("val", "");
	            $("#groups").select2("val", "");
	            $("#connections").prop('disabled',true);
               	$("#groups").prop('disabled',true);
	            $('#post-share-msg').html('Post shared successfully ! <br/>');  
	            $("#share-post").fadeTo(2000, 500).slideUp(500, function(){	            	
               		 $('#share-post').modal('hide');
               		 $('#post-share-msg-box').hide();
               		 $('#post-share-msg-box').removeClass('alert alert-success');
               		 $('#post-share-msg-box').removeClass('alert alert-danger');               		 
                });   
	           
	        }
	      },
	      error: function(data) {
	        loader('hide');
		    var errors = data.responseJSON;
		    // console.log(errors);
		    $errorsHtml = '<div class="alert alert-danger"><ul>';
		    $.each(errors.errors, function(index, value) {
		    	console.log(value);
				 $errorsHtml += '<li>' + value[0] + '</li>';
		    });
	 		$errorsHtml += '</ul></div>';	            
	        $( '#post-share-form-errors' ).html( $errorsHtml );
	        $( '#post-share-form-errors' ).show();
	      }
	    }); 
	    return false;
  });
});
</script>
@stop