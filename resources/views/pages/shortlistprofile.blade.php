@extends('master')

@section('content')

<div class="row" style="margin:20px 10px;">
	<div class="col-md-8" style="">
		<div style="text-align:center;border-bottom:1px solid lightgrey;"><label>Shortlisted Profile</label></div>
		@if(count($users) > 0)
		@foreach($users as $user)
	  	<div class="row" style="margin:5px 0;border-bottom: 1px solid #eee;">
		    <div class="col-md-1 col-sm-2 col-xs-2" style="padding:0 !important;">
			      <a data-toggle="modal" class="btn resume-button-css magic-profile-match" href="#post-mod-{{$user->id}}" style="padding: 2px 8px;">
    			<i class="icon-speedometer" style="font-size:12px;"></i> 
    		</a>
		    </div>
	    	<div class="col-md-7 col-sm-6 col-xs-10" style="padding:0;">
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
                @if(!$profileFav->contains('profile_id', $user->id))
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
				@if(!$profileFav->contains('profile_id', $user->id))
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

@endforeach
</div>
@else
	<div class="btn btn-warning btn-lg">No profile matches</div>
@endif
</div>


<div class="portlet box green col-md-8" style="margin:0 10px">
	<div class="portlet-title">
		<ul class="nav nav-tabs" style="padding-left: 0;float:left;">
			<li class="active">
				<a href="#tab_5_1" class="label-new" data-toggle="tab" style="border-left:0;">
					<span >Contacted</span> 
						@if(count($profileFav) > 0)
						<span class="badge" style="background-color: deepskyblue;"> 
							{{count($profileFav)}}
						</span>
						@endif
					 
				</a>
			</li>
			<li>
				<a href="#tab_5_2" class="label-new" data-toggle="tab">
					<span >Saved</span> 
					@if(count($profileSave) > 0)
						<span class="badge" style="background-color: deepskyblue;"> 
						{{count($profileSave)}}	
						</span>
					 @endif
				</a>
			</li>
		</ul>
	</div>
	<div class="portlet-body">
		<div class="tabbable-custom ">
			
			<div class="tab-content">
				<div class="tab-pane active" id="tab_5_1">
					@if(count($users) > 0)
					@foreach($users as $user)
					<div class="row" style="border-bottom:1px dotted lightgrey;padding: 5px 0;margin:0;">
						
						<div class="col-md-2 col-sm-2 col-xs-3" style="padding:0 !important;">
						      <a data-toggle="modal" class="btn resume-button-css magic-profile-match" href="#post-mod-{{$user->id}}" style="padding: 2px 8px;">
			    			<i class="icon-speedometer" style="font-size:12px;"></i> 
			    		</a>
					    </div>
						<div class="col-md-10 col-sm-10 col-xs-9">
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
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="col-md-8 col-sm-8 col-xs-12" style="padding:0 !important;margin: 5px 0;">
				  				<i class="fa fa-envelope"></i> : {{$user->email}}<br>
				  				<i class="fa fa-phone-square"></i> : {{$user->mobile}}
				  			</div>
				  			<div class="col-md-4 col-sm-4 col-xs-12" style="padding:0 !important;margin: 5px 0;">
				  				<button class="btn blue corp-profile-resume" style="">
									<i class="glyphicon glyphicon-download"></i> Resume
								</button>
				  			</div>
						</div>
					</div>
					@endforeach
					@else
					No Favourite Profile
					@endif

				</div>
				<div class="tab-pane" id="tab_5_2">
					@if(count($profileSave) > 0)
					@foreach($profileSave as $user)
					<div class="row saved-profile-{{$user->id}}" style="border-bottom:1px dotted lightgrey;padding: 5px 0;margin:0">
						
						<div class="col-md-2 col-sm-2 col-xs-3" style="padding:0 !important;">
						      <a data-toggle="modal" class="btn resume-button-css magic-profile-match" href="#post-mod-{{$user->id}}" style="padding: 2px 8px;">
			    			<i class="icon-speedometer" style="font-size:12px;"></i> 
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
						<div class="col-md-3 col-sm-3 col-xs-3" style="padding: 0;margin: 0 -3px;">
							@if(!$profileFav->contains('profile_id', $user->id))
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
						<form action="/profile/save" method="post" id="profile-save-{{$user->id}}" data-saveid="{{$user->id}}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="profileid" value="{{ $user->id }}">
							<button id="profilesave-btn-{{$user->id}}" class="btn fav-btn profile-save-btn" type="button" style="background-color: transparent;padding:0 10px;border:0;">			
								<i class="fa fa-save (alias)" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
							</button>
						</form>
					</div>
					@endforeach
					@else
					No saved profile
					@endif

				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('javascript')
<script>
	$('.profile-save-btn').live('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('saveid');

  	var formData = $('#profile-save-'+post_id).serialize(); 
    var formAction = $('#profile-save-'+post_id).attr('action');
    
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
      	if(data.data.save_profile == 1){
      		$('.profile-save-'+post_id).hide();
			$('#profilesave-btn-'+post_id).css({'color':'#FFC823'});	
        }else if(data.data.save_profile == 0){
        	$('#profilesave-btn-'+post_id).css({'color':'transparent'});
        }
      }
    }); 
    return false;
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