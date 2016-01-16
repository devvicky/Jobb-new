@extends('master')

@section('content')

<div class="portlet light bordered" style="border: none !important;background:transparent">	
	<div class="portlet-title">
		<div class="caption links-title">
			<i class=""></i>
			<span class="caption-subject font-blue-hoki bold uppercase">Profile search</span>
		</div>
	</div>									
	<div class="portlet-body form">
			<div class="form-body">
				@if(count($users) > 0)
							@foreach($users as $user)
							<!-- BEGIN FORM-->
							@if($type == 'people' && Auth::user()->identifier == 1)	
				<div class="row">
					<div class="col-md-7">
						
								  <div class="row" style="padding: 0 0 15px 0; margin: 0 0 15px 0;border-bottom: 1px solid #eee;">
									    <div class="col-md-2 col-sm-3 col-xs-3">
										      <a href="#">
										        <img class="media-object img-circle" 
										        src="@if($user->profile_pic != null){{ '/img/profile/'.$user->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" 
										      	alt="DP" style="width:100%">
										     </a>
									    </div>
								    	<div class="col-md-7 col-sm-6 col-xs-6">
										      <h4 class="user-name" style="text-transform:capitalize">{{ $user->fname }} {{ $user->lname }}</h4>
											 	@if($user->working_status == "Student")
				                                     {{ $user->education }} in {{ $user->branch }}, {{ $user->city }}
				                                
				                                @elseif($user->working_status == "Searching Job")
				                                
				                                     {{ $user->working_status }} in {{ $user->prof_category }}, {{ $user->city }}
				                                
				                                @elseif($user->working_status == "Freelanching")
				                                
				                                     {{ $user->role }} {{ $user->working_status }}, {{ $user->city }}
				                                
				                                @elseif($user->role != null && $user->working_at !=null && $user->working_status == "Working")
				                                
				                                     {{ $user->role }} @ {{ $user->working_at }} 
				                            
				                                @elseif($user->role != null && $user->working_at ==null && $user->working_status == "Working")
				                                
				                                     {{ $user->role }}, {{ $user->city }}
				                                
				                                @elseif($user->role == null && $user->working_at !=null && $user->working_status == "Working")
				                                
				                                     {{ $user->woring_at }}, {{ $user->city }}
				                                
				                                @elseif($user->role == null && $user->working_at ==null && $user->working_status == "Working")
				                                
				                                   {{ $user->prof_category }}, {{ $user->city }}
				                               
				                                @endif
											</div>
											@if($user->id != Auth::user()->induser_id)
										 	<div class="col-md-3 col-sm-3 col-xs-3">
									 		@if($links->contains('id', $user->id))
									 			<!-- <div class="btn btn-success btn-sm">Linked</div> -->
									 			<form action="{{ url('/connections/removeLink', $user->id) }}" method="post" 
									 					>				
													<input type="hidden" name="_token" value="{{ csrf_token() }}">	
													<button type="submit" class="btn btn-success btn-sm" style="padding:2px 5px;">Linked</button>
												</form>			
									 		@else
									 		
									 			<form action="{{ url('/connections/inviteFriend', $user->id) }}" method="post">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<button type="submit" class="btn btn-success apply-ignore-font" style="padding:2px 5px;">
														Add Link
													</button>													
												</form>
											
											@endif
									 	</div>
									 	@endif
								  </div>
							@elseif($type == 'company')
							
								
								  <div class="row" style="padding: 0 0 15px 0; margin: 0 0 15px 0;border-bottom: 1px solid #eee;">
								    <div class="col-md-2 col-sm-3 col-xs-3">
								      <a href="#">
								        <img class="media-object img-circle" src="@if($user->logo_status != null){{ '/img/profile/'.$user->logo_status }}@else{{'/assets/images/ab.png'}}@endif" alt="DP" style="width:100%">
								      </a>
								    </div>
								    <div class="col-md-7 col-sm-6 col-xs-6">
								    	
									      <h4 class="user-name" style="text-transform:capitalize">{{ $user->firm_name }}</h4>  	
										 	 	{{ $user->firm_type }}<br>
										     	@if($user->emp_count != null)
												Employees ({{ $user->emp_count }}) @endif 
												Followers ({{$followCount}})
																						
									</div>	
								 	<div class="col-md-3 col-sm-3 col-xs-3">

								 		@if($following->contains('id', $user->id))
								 			<!-- <div class="btn btn-success btn-sm">Following</div> -->
								 			<form action="{{ url('/userorate/unfollow', $user->id) }}" method="post">				
												<input type="hidden" name="_token" value="{{ csrf_token() }}">	
												<button type="submit" class="btn btn-sm btn-success" style="padding:2px 5px;">Following</button>
											</form>
								 		@else
								 		
								 			<form action="{{ url('/userorate/follow', $user->id) }}" method="post">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<button type="submit" class="btn btn-success apply-ignore-font" style="padding:2px 5px;">
													<i class="glyphicon glyphicon-plus-sign" style="font-size: 12px;"></i> 
													Follow</button>													
											</form>
										
												
										@endif
								 	</div>
								    </div>
								  
							
					</div>
					@endif
					@endforeach
					</div>
					<?php echo $users->render(); ?>
					@else
						<div class="btn btn-warning btn-lg">No profile matches</div>
					@endif
				</div>

				<div class="modal fade bs-modal-sm" id="links-follow" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-sm">
						<div class="modal-content" id="links-follow">
							<div id="links-follow-content">
								Links Follow
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->


			</div>
	</div>


	
					<div class="row" style="margin:0;">
						<div class="col-md-8" style="">
							@if(count($users) > 0)
					@foreach($users as $user)
					<!-- BEGIN FORM-->
					@if($type == 'people' && Auth::user()->identifier == 2)	
						  	<div class="row" style="margin:0;border-bottom: 1px solid #eee;">
							    <div class="col-md-1 col-sm-2 col-xs-2" style="padding:0 !important;">
								      <a data-toggle="modal" class="btn resume-button-css magic-profile-match" href="#post-mod-{{$user->id}}" style="padding: 2px 8px;">
	                    			<i class="icon-speedometer" style="font-size:12px;"></i> 
	                    		</a>
							    </div>
						    	<div class="col-md-7 col-sm-6 col-xs-8" style="">
							      <a href="/profile/ind/{{$user->id}}">
							      	<h4 class="user-name" style="text-transform:capitalize">
							      		{{ $user->fname }} {{ $user->lname }}</h4></a>
								 	@if($user->working_status == "Student")
	                                     {{ $user->education }} in {{ $user->branch }}, {{ $user->city }}
	                                
	                                @elseif($user->working_status == "Searching Job")
	                                
	                                     {{ $user->working_status }} in {{ $user->prof_category }}, {{ $user->city }}
	                                
	                                @elseif($user->working_status == "Freelanching")
	                                
	                                     {{ $user->role }} {{ $user->working_status }}, {{ $user->city }}
	                                
	                                @elseif($user->role != null && $user->working_at !=null && $user->working_status == "Working")
	                                
	                                     {{ $user->role }} @ {{ $user->working_at }} 
	                            
	                                @elseif($user->role != null && $user->working_at ==null && $user->working_status == "Working")
	                                
	                                     {{ $user->role }}, {{ $user->city }}
	                                
	                                @elseif($user->role == null && $user->working_at !=null && $user->working_status == "Working")
	                                
	                                     {{ $user->woring_at }}, {{ $user->city }}
	                                
	                                @elseif($user->role == null && $user->working_at ==null && $user->working_status == "Working")
	                                
	                                   {{ $user->prof_category }}, {{ $user->city }}
	                               
	                                @endif
	                                <br>
	                                @if(!$corpsearchprofile->contains('profile_id', $user->id))
	                                @else
	                                <div class="col-md-8 col-sm-8 col-xs-12" style="padding:0 !important;margin: 5px 0;">
						  				<i class="fa fa-envelope"></i> : {{$user->email}}<br>
						  				<i class="fa fa-phone-square"></i> : {{$user->mobile}}
						  			</div>
						  			<div class="col-md-4 col-sm-4 col-xs-12" style="padding:0 !important;margin: 5px 0;">
						  				<button class="btn blue corp-profile-resume" style="">
											<i class="glyphicon glyphicon-download"></i> Resume
										</button>
						  			</div>
						  			@endif

						  			<div id="profile-contacts-{{$user->id}}"></div>
						  			
								</div>
								<div class="col-md-3 col-sm-4 col-xs-12 contact-small" style="padding:0;">
									@if(!$corpsearchprofile->contains('profile_id', $user->id))
									<form action="/profile/fav" method="post" id="profile-fav-{{$user->id}}" data-id="{{$user->id}}">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="profileid" value="{{ $user->id }}">
										<!-- <div class="view-profile"> -->
											<button id="profilefav-btn-{{$user->id}}" class="btn green corp-profile-contact profile-fav-btn" type="button" style="">
												<i class="glyphicon glyphicon-earphone" style="font-size:11px;"></i> Contact
											</button>
										<!-- </div> -->
									</form>
									@else
									<!-- <button disabled class="btn grey corp-profile-contact" type="button" style="">
										<i class="glyphicon glyphicon-earphone" style="font-size:11px;"></i> Contacted
									</button> -->
									@endif
								</div>
								<button class="btn fav-btn" type="button" style="background-color: transparent;padding:0 10px;border:0;">			
									<i class="fa fa-save (alias)" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
								</button>
					  		</div>
					  		
								
						  		<!-- <div class="fav-new"> -->
										
								<!-- </div> -->
							
							<div class="modal fade" id="post-mod-{{$user->id}}" tabindex="-1" role="basic" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
									   <h4 class="modal-title" style="text-align:center;">
									   		<i class="icon-speedometer" style="font-size:16px;"></i>  
									   		
											Match
									   	</h4>
									</div>
									<div class="modal-body">

										<!-- BEGIN BORDERED TABLE PORTLET-->
										<div class="portlet box">
											<div class="portlet-body" style=" padding: 0 !important;">
												<div class="table-scrollable">
													<table class="table table-bordered table-hover">
																	<thead style="border:0 !important;">
																	<tr style="border:0 !important;">
																		
																		<th class="col-md-6 col-sm-6 col-xs-6 matching-criteria-align">
																			 Required Profile
																		</th>
																		<th class="col-md-6 col-sm-6 col-xs-6 matching-criteria-align">
																			  Profile
																		</th>
																	</tr>
																	</thead>

																	<tbody>
																		<tr class="">
																			<td colspan="2" class="matching-criteria-align">
																				
																				<label class="title-color">
																					<i class="fa fa-check magic-match-icon-color"></i> Skills <i class="badge"></i> 
																				</label>
																				
																				<label class="title-color">
																					<i class="fa fa-times"></i> Skills <i class="badge"></i> 
																				</label>
																				
																			</td>
																		</tr>
																		<tr class="">
																			
																			<td class="matching-criteria-align">

																				
																			</td>
																			
																			<td class="matching-criteria-align">
																													
																			</td>
																		</tr>	
																	</tbody>
																	</table>
												</div>
											</div>
										</div>
										<!-- END BORDERED TABLE PORTLET-->
										<!-- </div> -->	
									</div>
								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
							</div>
							<!-- /.modal -->
					@endif
					
					@endforeach
					<?php echo $users->render(); ?>
					</div>
					@else
						<div class="btn btn-warning btn-lg">No profile matches</div>
					@endif
					</div>
					
@stop

@section('javascript')

<script type="text/javascript">
     $(document).ready(function () {
     	// event.preventDefault();
     	// var profileid = $(this).parent().data('profileid');
     	$('.profile-show').hide();
        $('.view-profile').click(function () {
           $('.profile-show').show();
           $('.view-profile').hide();
    });
   });


    $('.profile-fav-btn').live('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('id');

  	var formData = $('#profile-fav-'+post_id).serialize(); 
    var formAction = $('#profile-fav-'+post_id).attr('action');
    $count = $.trim($('#profilefavcount').text());
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
 			out += '<a class="btn blue corp-profile-resume" href="'+data.data.resume+'">'
 			out += '<i class="glyphicon glyphicon-download"></i> Resume</a></div>';

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