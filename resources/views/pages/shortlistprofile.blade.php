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
					@if($type == 'people' && Auth::user()->identifier == 2)	
					<div class="row">
						<div class="col-md-8" style="border-bottom: 1px solid #eee;margin: 10px 0;">
						  	<div class="row" style="padding: 0 0 15px 0; margin: 0 0 15px 0;">
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
								<div class="col-md-3 col-sm-3 col-xs-3">
									<div data-profileid="" class="view-profile"><button class="btn btn-success" style="padding:2px 8px;">View Contact</button></div>
								</div>
					  		</div>
					  		<div class="row profile-show">
					  			<div class="col-md-4 col-sm-4 col-xs-12">
					  				<i class="fa fa-envelope"></i> : {{$user->email}}
					  			</div>
					  			<div class="col-md-4 col-sm-4 col-xs-12">
					  				<i class="fa fa-phone-square"></i> : {{$user->mobile}}
					  			</div>
					  			@if($user->resume != null)
					  			<div class="col-md-4 col-sm-4 col-xs-12">
					  				<button class="btn btn-success" style="padding:2px 8px;">Download Resume</button>
					  			</div>
					  			@endif
					  		</div>
					  		<div class="magic-profile" style="position: absolute; top: 85px;left: 35px;">
					  			<a data-toggle="modal" class="btn resume-button-css" href="#post-mod-{{$user->id}}" style="padding: 2px 8px;">
	                    			<i class="icon-speedometer" style="font-size:12px;"></i> 
	                    		</a>
					  		</div>
					  		<div class="fav-dir">
								<form action="/job/fav" method="post">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button class="btn fav-btn" type="button" style="background-color: transparent;padding:0 10px;border:0">			
										<i class="fa fa-star" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
									</button>	
								</form>
							</div>
						</div>
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
					</div>
					<?php echo $users->render(); ?>
					@else
						<div class="btn btn-warning btn-lg">No profile matches</div>
					@endif
					<div class="col-md-3">
						<div class="portlet box red-sunglo">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-gift"></i>Advertisement
								</div>
								<div class="tools">
									<a href="javascript:;" class="collapse">
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<ul>
									<li>Ads</li>															
								</ul>
							</div>
						</div>
					</div>	

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
@stop

@section('javascript')

<script type="text/javascript">
     $(document).ready(function () {
     	// event.preventDefault();
     	// var profileid = $(this).parent().data('profileid');
     	$('.profile-show').hide();
        $('.view-profile').click(function () {
           $('.profile-show').show();
    });
   });
</script>

@stop