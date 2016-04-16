@extends('master')

@section('content')
<div class="col-md-7 col-sm-10">
<a class="advance-search btn advance-searched-profile">Modify</a>
</div>
<div class="row clearfix" style="margin-bottom:10px">	
	<!-- BEGIN ADVANCED SEARCH -->
	<div class="col-md-7 col-sm-10">
		<div class="show-adsearch">
			<form id="profilesearch" action="/search/profile" method="post">
		      	<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<!-- <div class="row-md-2"></div> -->
				<div class="row" style="margin-bottom: 20px;margin-top: 10px;">
					<div class="col-md-12 col-sm-12 col-xs-12 advance-len" style="margin:10px 0;">
					  <div class="input-group" style="margin:0 auto;">
					    <div class="icheck-inline">
					      <label>
					      	<input id="id_radio1" type="radio" checked name="type" value="people" class="">
					      	People
					      </label>
					      <label>
					      	<input id="id_radio2" type="radio" value="company" name="type" class="">
					      	Company
					      </label>
					    </div>
					  </div>
					</div> 
				</div>
				<div class="row show-firm-type" style="margin: 0px auto; float: none; display: table;">
					<div class="form-group">
						<div class="input-group">
							<div class="icheck-inline">
								<label>
								<input type="checkbox" name="firm_type[]" class="icheck" value="company" data-checkbox="icheckbox_line-grey" data-label="Company">
								</label>
								<label>
								<input type="checkbox" name="firm_type[]" checked class="icheck" value="consultancy" data-checkbox="icheckbox_line-grey" data-label="Consultancy">
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row" style="margin:0;">
					<div class="col-md-6 col-sm-6 col-xs-12">
					  <div class="form-group">              
					      <input type="text" id="name" name="name" class="form-control filter-input group" 
					      			placeholder="Enter Name or Email Id"/>
					  </div>  
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<input type="text" id="city" name="city" class="form-control" placeholder="Enter City">
						</div>
					</div>
				</div>
		       <div class="row" style="margin:0;">
					<div class="col-md-12 col-sm-12 col-xs-12 hide-role">
						<div class="form-group">
							<input type="text" class="form-control" name="role" placeholder="Enter Keywords">
						</div>					
					</div>
		        </div>
				<div class="row show-comp" style="margin:0;">
					<div class="col-md-6 col-sm-6 col-xs-12">
					  	<div class="form-group">              
					      <input type="text" name="working_at" class="form-control filter-input" placeholder="Working at">
					  	</div>  
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
					  	<div class="form-group">              
					      <input type="text" id="mobile" maxlength="10" name="mobile" class="form-control filter-input group" placeholder="Mobile No">
					  	</div>  
					</div>
				</div>
		      	<div class="row" style="margin-bottom: 10px;">
			        <div class="col-md-12 col-sm-12 col-xs-12">
						<div class="footer links-title center-css">              
						  <button type="submit" class="btn blue "><i class="glyphicon glyphicon-search"></i> Search</button>	
						</div> 
						<div class="advance-search group-back-position">
							<button type="button" class="btn" style="background-color:transparent;">
							<i class="glyphicon glyphicon-chevron-left"></i> Back</button>
						</div>
			        </div>		        
		      	</div>
		    </form>
		</div>
	</div>
</div>
<div class="portlet light bordered" style="border: none !important;background:transparent">	
	<div class="portlet-title">
		<div class="caption links-title">
			<i class=""></i>
			<span class="caption-subject font-blue-hoki bold uppercase">Profile search</span>
		</div>
	</div>									
	<div class="portlet-body form">
		<div class="form-body">
			<div class="row">
				<div class="col-md-7 col-sm-10">
					<!-- BEGIN FORM-->
						@if($type == 'people')	
						  	

						  	@if(count($users) > 0)
								@foreach($users as $user)
									@if($user->user->email_verify == 1 || $user->user->mobile_verify == 1)
								  	<div class="row" style="padding: 0 0 15px 0; margin: 0 0 15px 0;border-bottom: 1px solid #eee;">
									    <div class="col-md-2 col-sm-3 col-xs-3">
											<a href="#">
												<img class="media-object img-circle" src="@if($user->profile_pic != null){{ '/img/profile/'.$user->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" 
														alt="DP" style="width:100%">
											</a>
									    </div>
								    	<div class="col-md-7 col-sm-6 col-xs-6">
										    <h4 class="user-name" style="text-transform:capitalize">
										    	{{ $user->fname }} {{ $user->lname }}
										    </h4>
										 	@if($user->working_status == "Student")
			                                     Student, {{ $user->city }}	                                
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
			                                      {{ $user->city }}
			                                @endif
										</div>
										@if($user->id != Auth::user()->induser_id)
										<div class="col-md-3 col-sm-3 col-xs-3">
									 		@if($links->contains('id', $user->id))
									 			<!-- <div class="btn btn-success btn-sm">Linked</div> -->
									 			<form action="/connections/removeLink/{{$user->id}}" method="post" >				
													<input type="hidden" name="_token" value="{{ csrf_token() }}">	
													<button type="submit" class="btn btn-success btn-sm" style="padding:2px 5px;">Linked</button>
												</form>			
									 		@else
									 		
									 			<form action="/connections/inviteFriend/{{$user->id}}" method="post">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<button type="submit" class="btn btn-success apply-ignore-font" style="padding:2px 5px;">
														Add Link
													</button>													
												</form>
											
											@endif
									 	</div>
									 	@endif
								    </div>
								    @endif
								@endforeach
								<?php echo $users->render(); ?>
							@else
								<div class="btn btn-warning btn-lg">No profile matches</div>
							@endif

						@elseif($type == 'company')

							@if(count($users) > 0)
								@foreach($users as $user)
									@if($user->user->email_verify == 1 || $user->user->mobile_verify == 1)
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
									 			<form action="/corporate/unfollow/{{$user->id}}" method="post">				
													<input type="hidden" name="_token" value="{{ csrf_token() }}">	
													<button type="submit" class="btn btn-sm btn-success" style="padding:2px 5px;">Following</button>
												</form>
									 		@else
									 		
									 			<form action="/corporate/follow/{{$user->id}}" method="post">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<button type="submit" class="btn btn-success apply-ignore-font" style="padding:2px 5px;">
														<i class="glyphicon glyphicon-plus-sign" style="font-size: 12px;"></i> 
														Follow</button>													
												</form>								
													
											@endif
									 	</div>
									</div>  
									@endif
								@endforeach
								<?php echo $users->render(); ?>
							@else
								<div class="btn btn-warning btn-lg">No profile matches</div>
							@endif
					
						@endif
					
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
function initialize() {
		var options = {	types: ['(cities)'], componentRestrictions: {country: "in"}	};
		var input = document.getElementById('city');
		var autocomplete = new google.maps.places.Autocomplete(input, options);
		autocomplete.addListener('place_changed', onPlaceChanged); 
		function onPlaceChanged() {
		  var place = autocomplete.getPlace();
		  if (place.address_components) { city = place.address_components[0];
		  	document.getElementById('city').value = city.long_name;
		  } else { document.getElementById('autocomplete').placeholder = 'Enter a city'; }
		}
	}
    google.maps.event.addDomListener(window, 'load', initialize); 
</script>

<script type="text/javascript">
$('.show-firm-type').hide();

    jQuery('.advance-search').on('click', function(event) {
	    jQuery('.show-adsearch').toggle('show');
	    jQuery('.normal_search').toggle('hide');
    });

    jQuery('#id_radio1').on('click', function(event) {
	    jQuery('.show-comp').toggle('show');
	    jQuery('.show-firm-type').toggle('hide');
	    jQuery('#mobile').addClass('group');
	    $(this).closest('form').find("input[type=text], textarea").val("");
    });

    jQuery('#id_radio2').on('click', function(event) {
	    jQuery('.show-comp').toggle('hide');
	    jQuery('.show-firm-type').toggle('show');
	    jQuery('#mobile').removeClass('group');
	    $(this).closest('form').find("input[type=text], textarea").val("");

    });
</script>
<script type="text/javascript">
$(document).ready(function () {            
    //validation rules
    var form = $('#profilesearch');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);


    form.validate({
        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: [],
        groups: {
                    name: "name mobile"
                },
        rules: {
            name: {
                require_from_group: [1, '.group']
            },
            mobile: {
                number: true,
                minlength: 10,
                require_from_group: [1, '.group']
            },
            city : {
                required : false
            },
            "firm_type[]": {
            	required: true
            }
        },
        messages: {
            mobile: {
	            require_from_group: "Enter atleast Name or Mobile no"
	        },
	        phone: {
	            maxlength: "Enter minimum 10 integer"
	        }
        },
            invalidHandler: function (event, validator) { //display error alert on form submit   
            success.hide();
            error.show();
            Metronic.scrollTo(error, -200);
        },

             highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
            unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
         },
    });
});
</script>
@stop