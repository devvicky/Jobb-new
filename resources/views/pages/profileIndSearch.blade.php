@extends('master')

@section('content')


<div class="row" style="margin:30px 0;">
	<div class="col-md-8" style="">
		<h4 style="text-align: center;
    background-color: #908D8D;
    color: white;
    padding: 3px 0px;">Profile Search</h4>
@if(count($users) > 0)
@foreach($users as $user)

@if(Auth::user()->identifier == 2 && $user->user->email_verify == 1 || $user->user->mobile_verify == 1)	
	  	<div class="row" style="margin: 10px 0;border-bottom: 1px solid #eee;">
		    <div class="col-md-1 col-sm-2 col-xs-2" style="padding:0 !important;">
			      <a data-toggle="modal" class="btn resume-button-css magic-profile-match" href="#static" style="padding: 2px 8px;">
    			<i class="icon-speedometer" style="font-size:12px;"></i>{{$perProfile}}%
    			
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
                
                @elseif($user->job_role != '[]' && $user->working_status == "Freelanching")
                
                     {{ $user->job_role->first()->role }} {{ $user->working_status }}, {{ $user->city }}
                
                @elseif($user->job_role != '[]' && $user->working_at !=null && $user->working_status == "Working")
                
                     {{ $user->job_role->first()->role }} @ {{ $user->working_at }} 
            
                @elseif($user->job_role != '[]' && $user->working_at ==null && $user->working_status == "Working")
                
                     {{ $user->job_role->first()->role }}, {{ $user->city }}
                
                @elseif($user->role == null && $user->working_at !=null && $user->working_status == "Working")
                
                     {{ $user->woring_at }}, {{ $user->city }}
                
                @elseif($user->role == null && $user->working_at ==null && $user->working_status == "Working")
                
                   {{ $user->prof_category }}, {{ $user->city }}
               
                @endif
                <br>
                @if(!$corpsearchprofile->contains('profile_id', $user->id))
                @else
                <div class="col-md-8 col-sm-8 col-xs-12" style="padding:0 !important;margin: 5px 0;">
                	@if($user->email != null)
	  				<i class="fa fa-envelope"></i> : {{$user->email}}
	  				@else<i class="fa fa-envelope"></i> : Not Available
	  				@endif<br>
	  				@if($user->mobile != null)
	  				<i class="fa fa-phone-square"></i> : {{$user->mobile}}
	  				@else
	  				<i class="fa fa-phone-square"></i> : Not Available
	  				@endif
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

@endif
<div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Profile Match</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover">
          <thead style="border:0 !important;">
          <tr style="border:0 !important;">     
              <th class="col-md-6 col-sm-6 col-xs-6 matching-criteria-align">
                   My Search
              </th>
              <th class="col-md-6 col-sm-6 col-xs-6 matching-criteria-align">
                   Searched Profile
              </th>
          </tr>
          </thead>
          <tbody>
            <tr class=" title-bacground-color ">
                <td colspan="2" class="matching-criteria-align">
                    <i class="fa fa-times"></i> <label class="title-color">Skills</label>
                </td>
            </tr>
            <tr>
              <td  class="matching-criteria-align">

              </td>
              <td  class="matching-criteria-align">
                {{$user->linked_skill}}
              </td>
            </tr>
            <tr>
              <td colspan="2" class="matching-criteria-align">
                Role
              </td>
            </tr>
            <tr>
              <td class="matching-criteria-align">

              </td>
              <td class="matching-criteria-align">
                @if($user->job_role != '[]')
                {{ $user->job_role->first()->role }}
                @endif
              </td>
            </tr>
            <tr>
              <td colspan="2" class="matching-criteria-align">
                Experience
              </td>
            </tr>
            <tr>
              <td class="matching-criteria-align">

              </td>
              <td class="matching-criteria-align">
                {{$user->experience}}
              </td>
            </tr>
            <tr>
              <td colspan="2" class="matching-criteria-align">
                Profile with Resume only
              </td>
            </tr>
            <tr>
              <td class="matching-criteria-align">

              </td>
              <td class="matching-criteria-align">
                @if($user->resume != null)
                  <a class="btn small-btn ">View</a>
                @endif
              </td>
            </tr>
            <tr>
              <td colspan="2" class="matching-criteria-align">
                Job Type
              </td>
            </tr>
            <tr>
              <td class="matching-criteria-align">

              </td>
              <td class="matching-criteria-align">
                {{$user->prefered_jobtype}}
              </td>
            </tr>
            <tr>
              <td colspan="2" class="matching-criteria-align">
                City
              </td>
            </tr>
            <tr>
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
</div>
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
      	if(data.data.save_profile == 1 && data.success == 'success'){
			$('#profilesave-btn-'+post_id).css({'color':'#FFC823'});	
        }else if(data.data.save_profile == 0){
        	$('#profilesave-btn-'+post_id).css({'color':'transparent'});
        }
      }
    }); 
    return false;
  }); 
</script>

@stop