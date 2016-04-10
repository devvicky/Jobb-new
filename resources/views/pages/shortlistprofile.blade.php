@extends('master')

@section('content')
<div class="row" style="margin:20px 0;">
	<div class="col-md-8">
		<div style="text-align:center;border-bottom:1px solid lightgrey;"><label>Shortlisted Profile</label></div>
	</div>	
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
					<div class="row" style="padding: 5px 0;margin:0;">
						
						<div class="col-md-8 col-sm-8 col-xs-8">
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
						<div class="col-md-4 col-sm-4 col-xs-4">
							<form action="/remove/sortlisted/{{$user->id}}" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button class="btn btn-warning corp-remove-btn">Remove</button>
							</form>
						</div>
					</div>
					<div class="row" style="border-bottom:1px dotted lightgrey;padding: 5px 0;margin:0;">
						<div class="col-md-8 col-sm-8 col-xs-12">
			  				@if($user->email != null)
			  				<i class="fa fa-envelope"></i> : {{$user->email}}
			  				@else
			  				<i class="fa fa-envelope"></i> : Not Available
			  				@endif<br>
			  				@if($user->mobile != null)
			  				<i class="fa fa-phone-square"></i> : {{$user->mobile}}
			  				@else
			  				<i class="fa fa-phone-square"></i> : Not Available
			  				@endif
			  			</div>
			  			@if($user->resume != null)
			  			<div class="col-md-4 col-sm-4 col-xs-12">
			  				<a href="/resume/{{$user->resume}}" target="_blank">
			  					<button class="btn corp-profile-resume" style="color: dimgray !important;background-color:transparent;border: 1px solid dimgrey;">
									<i class="glyphicon glyphicon-download"></i> Resume
								</button>
							</a>
			  			</div>
			  			@endif
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

				  			<div id="profile-contacts-{{$user->id}}"></div>
							 
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<form action="/remove/saved/{{$user->id}}" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button class="btn btn-warning corp-remove-btn">Remove</button>
							</form>
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
							@endif
						</div>
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