@extends('master')

@section('content')
<?php $selected = 'selected'; ?> 

<div class="row profile-account" style="margin:15px;">
	<div class="col-md-3">
		<ul class="ver-inline-menu tabbable margin-bottom-10">
			<li class="active">
				<a data-toggle="tab" href="#tab_1-1">
				<i class="fa fa-cog"></i> Firm info </a>
				<span class="after">
				</span>
			</li>
			<li>
				<a data-toggle="tab" href="#tab_2-2">
				<i class="fa fa-picture-o"></i> Firm Details </a>
			</li>
			<li>
				<a data-toggle="tab" href="#tab_3-3">
				<i class="fa fa-lock"></i> Preferences </a>
			</li>
			<li>
				<a data-toggle="tab" href="#tab_4-4">
				<i class="fa fa-eye"></i> Privacity Settings </a>
			</li>
		</ul>
	</div>
	<div class="col-md-8">
		<div class="tab-content">
			<div id="tab_1-1" class="tab-pane active">
				<!-- BEGIN FORM-->
				<form action="/corporate/basicupdate" id="corp_firm_validation" class="horizontal-form" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-body">
						<div class="row">
							
							<div class="col-md-12" style="">
								<div class="row">
									@if (count($errors) > 0)
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
									@endif
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>Firm Name</label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-font" style="color:darkcyan;"></i>
												</span>
												<input type="text" name="firm_name" class="form-control" placeholder="Firm Name" value="{{ $user->firm_name }}">
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">								
											<label>Slogan</label>										
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-comment-o" style="color:darkcyan;"></i>
												</span>
												<input type="text" name="slogan" class="form-control" value="{{ $user->slogan }}" placeholder="Enter Company Slogan">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="form-group">								
											<label>About Firm</label>										
											<!-- <div class="input-group"> -->
												
												<textarea name="about_firm" onkeyup="countChar(this)" class="form-control autosizeme" rows="3">{{ $user->about_firm }}</textarea>
												<div id="charNum" style="text-align:right;"></div>
											<!-- </div> -->
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>Firm Type</label>
											<div class="input-group">
													<div class="md-radio-inline">
														<div class="md-radio">
															<input type="radio" id="radio6" name="firm_type" value="company" class="md-radiobtn" 
																@if($user->firm_type == 'company')
																	checked
																@endif
															>
															<label for="radio6" style="">
															<span></span>
															<span class="check"></span>
															<span class="box"></span>
															Company </label>
														</div>
														<div class="md-radio">
															<input type="radio" id="radio7" name="firm_type" value="consultancy" class="md-radiobtn" 
															@if($user->firm_type == 'consultancy')
																checked
															@endif
															>
															<label for="radio7" style="">
															<span></span>
															<span class="check"></span>
															<span class="box"></span>
															Consultancy </label>
														</div>
													</div>	
													<div id="radio_error"></div>					<!-- /input-group -->
												</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>Operating since</label>
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-cube"style="color:darkcyan;"></i>
												</span>
												<select name="operating_since" class="form-control" value="{{ $user->operating_since }}">
													<option value="">-- Select --</option>
													<option @if($user->operating_since == "Startup") {{ $selected }} @endif value="Startup">Startup</option>
													<option @if($user->operating_since == "1 - 2 Years") {{ $selected }} @endif value="1 - 2 Years">1 - 2 Years</option>
													<option @if($user->operating_since == "2 - 4 Years") {{ $selected }} @endif value="2 - 4 Years">2 - 4 Years</option>
													<option @if($user->operating_since == "4 - 7 Years") {{ $selected }} @endif value="4 - 7 Years">4 - 7 Years</option>
													<option @if($user->operating_since == "7 - 10 Years") {{ $selected }} @endif value="7 - 10 Years">7 - 10 Years</option>
													<option @if($user->operating_since == "10 + Years") {{ $selected }} @endif value="10 + Years">10 + Years</option>
												</select>
											</div>
										</div>
									</div>
									<!--/span-->
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
											<label>Industry</label>
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-cubes"style="color:darkcyan;"></i>
												</span>
												<select name="industry" class="form-control" value="{{ $user->industry }}">
													<option value="">-- Select --</option>
													<option @if($user->industry == "IT") {{ $selected }} @endif value="IT">IT</option>
													<option @if($user->industry == "Fashion") {{ $selected }} @endif value="Fashion">Fashion</option>
												</select>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-group">
											<label>No of Employee</label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-users" style="color:darkcyan;"></i>
												</span>
												<select name="emp_count" class="form-control" value="{{ $user->emp_count }}">
													<option value="">-- Select --</option>
													<option @if($user->emp_count == "0 - 100") {{ $selected }} @endif value="0 - 100">0 - 100</option>
													<option @if($user->emp_count == "100 - 500") {{ $selected }} @endif value="100 - 500">100 - 500</option>
													<option @if($user->emp_count == "500 - 1000") {{ $selected }} @endif value="500 - 1000">500 - 1000</option>
													<option @if($user->emp_count == "1000-2000") {{ $selected }} @endif value="1000-2000">1000-2000</option>
													<option @if($user->emp_count == "2000-5000") {{ $selected }} @endif value="2000-5000">2000-5000</option>
													<option @if($user->emp_count == "5000-10000") {{ $selected }} @endif value="5000-10000">5000-10000</option>
													<option @if($user->emp_count == "10000 +") {{ $selected }} @endif value="10000 +">10000 +</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">								
											<label>Work Area</label>										
											<div style="position:relative;">
												<input type="text" name="name" id="newskill" class="form-control" placeholder="Search for skill...">
													<button id="add-new-skill" style="position:absolute;right:0;top:0;" class="btn btn-success" type="button"><i class="icon-plus"></i> Add</button>	
													{!! Form::select('linked_skill_id[]', explode(', ', $user->linked_skill_id), null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>Website</label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="icon-info"style="color:darkcyan;"></i>
												</span>
												<input type="text" name="website_url" class="form-control" value="{{ $user->website_url }}" placeholder="http://www.website.com">
											</div>
										</div>
									</div>
									<!--/span-->
								</div>
							</div>
						</div>
						<div class="form-actions ">
							<button type="submit" class="btn blue"><i class="fa fa-check"></i> Update</button>
							<button type="button" class="btn default">Cancel</button>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
			<div id="tab_2-2" class="tab-pane">
						<!-- BEGIN FORM-->
				<form action="/corporate/update/{{Auth::user()->corpuser_id}}" id="corp_contact_validation" class="horizontal-form" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">								
											<label>Address</label>										
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-globe" style="color:darkcyan;"></i>
												</span>
												<textarea name="firm_address" class="form-control" rows="3" >{{ $user->firm_address }}</textarea>
											</div>
										</div>
									</div>
								</div>		
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>City</label>									
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-map-marker" style="color:darkcyan;"></i>
												</span>
												<input type="text" name="city" class="form-control" value="{{ $user->city }}" placeholder="City">
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>State</label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-map-marker" style="color:darkcyan;"></i>
												</span>
												<input type="text" name="state" class="form-control" value="{{ $user->state }}" placeholder="State">
											</div>
										</div>
									</div>
									<!--/span-->
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>Profile Handler Name</label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-user" style="color:darkcyan;"></i>
												</span>
												<input type="text" name="username" class="form-control" value="{{ $user->username }}" placeholder="Holder Name">
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<label>Working As</label>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-user" style="color:darkcyan;"></i>
												</span>
												<select name="working_as" class="form-control" value="{{ $user->working_as }}">
													<option value="">-- Select --</option>
													<option @if($user->working_as == "HR Recruiter") {{ $selected }} @endif value="HR Recruiter">HR Recruiter</option>
													<option @if($user->working_as == "Administrator") {{ $selected }} @endif value="Administrator">Administrator</option>
													<option @if($user->working_as == "Employee") {{ $selected }} @endif value="Employee">Employee</option>
													<option @if($user->working_as == "Other") {{ $selected }} @endif value="Other">Other</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									 <div class="col-md-6 col-sm-6 col-xs-12">
		                                <div class="form-group">
		                                    <label>Phone</label>
		                                    <div class="input-group">
		                                        <span class="input-group-addon">
		                                            <i class="icon-call-end" style="color:darkcyan;"></i>
		                                        </span>
		                                        <input type="text" name="firm_phone" class="form-control" placeholder="Phone" value="{{ $user->firm_phone }}">
		                                    	<span class="input-group-addon">
													<i class="fa fa-exclamation-circle" style="color: #cb5a5e;font-size: 16px;"></i>
												</span>
												<span class="input-group-addon">
													<i class="fa fa-pencil"></i>
												</span>
		                                    </div>
		                                </div>
		                            </div>
		                            <!--/span-->
		                            <div class="col-md-6 col-sm-6 col-xs-12">
		                                <div class="form-group">
		                                    <label>Email</label>                                
		                                    <div class="input-group">
		                                        <span class="input-group-addon">
		                                            <i class="icon-envelope" style="color:darkcyan;"></i>
		                                        </span>
		                                        <input type="text" name="firm_email_id" class="form-control" placeholder="Email" value="{{ $user->firm_email_id }}">
		                                    	<span class="input-group-addon">
													<i class="glyphicon glyphicon-ok-circle" style="color: #1EC71E;font-size: 16px;"></i>
												</span>
												<span class="input-group-addon">
													<i class="fa fa-pencil"></i>
												</span>
		                                    </div>
		                                </div>
		                            </div>
		                            <!--/span-->
								</div>	
							</div>
						</div>
						<div class="form-actions ">
							<button type="submit" class="btn blue"><i class="fa fa-check"></i> Update</button>
							<button type="button" class="btn default">Cancel</button>
						</div>
					</div>
				</form>
				<!-- END FORM-->
			</div>
			<div id="tab_3-3" class="tab-pane">
				
			</div>
			<div id="tab_4-4" class="tab-pane">
				<form action="/corporate/privacyUpdate/{{Auth::user()->corpuser_id}}" id="privacy_validation" 
				class="horizontal-form prof_detail" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<table class="table table-bordered table-striped">
					<tr>
						<td>
							 Who can see my Email Address.
						</td>
						<td>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="email_show" value="Everyone"
							@if($user->email_show == 'Everyone')
								checked
							@endif >
							Everyone </label>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="email_show" value="None"
							@if($user->email_show == 'None')
								checked
							@endif >
							None </label>
						</td>
					</tr>
					<tr>
						<td>
							 Who can see my Mobile No.
						</td>
						<td>
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="mobile_show" value="Everyone"
							@if($user->phone_show == 'Everyone')
								checked
							@endif >
							Everyone </label>
							
							<label class="uniform-inline" style="width:100%;font-weight:500;">
							<input type="radio" name="mobile_show" value="None"
							@if($user->phone_show == 'None')
								checked
							@endif >
							None </label>
						</td>
					</tr>
					</table>
					<!--end profile-settings-->
					<div class="margin-top-10">
						<button type="submit" name="individual" value="Save" class="btn green">
						<i class="fa fa-check"></i> Save Changes
						</button>
						<a href="/profile/ind/{{Auth::user()->corpuser_id}}" class="btn default">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--end col-md-9-->
</div>

@stop

@section('javascript')
<script src="/assets/corp_validation.js"></script>
<script type="text/javascript">
      function countChar(val) {
        var len = val.value.length;
        if (len >= 1000) {
          val.value = val.value.substring(0, 1000);
        } else {
          $('#charNum').text(1000 - len);
        }
      };
    </script>
    <script>
$selectedSkills = $("#linked_skill_id").select2();
$gotit = [];
	$(function(){

	 	function split( val ) {
	      return val.split( /,\s*/ );
	    }
	    function extractLast( term ) {
	      return split( term ).pop();
	    }

		$( "#newskill" )
		.bind( "keydown", function( event ) {
			if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
			  event.preventDefault();
			}
		})
		.autocomplete({
			source: function( request, response ) {
				// $.getJSON( "/job/skillSearch", {
				// 	term: extractLast( request.term )
				// }, response );

				$.ajax({
					url: '/job/skillSearch',
					dataType: "json",
					data: { term: extractLast( request.term ) },
					success: function(data) {
					if (data.length === 0) {
						$('#add-new-skill').removeClass('hide');
						$('#add-new-skill').addClass('show');
					}else{
						$('#add-new-skill').removeClass('show');
						$('#add-new-skill').addClass('hide');
					}
					response(data);
					}
				});

			},
			search: function() {
				var term = extractLast( this.value );
				if ( term.length < 2 ) {
					return false;
				}
			},
			focus: function() {
				return false;
			},
			select: function(event, ui) {
				var termsId = [];

				if($selectedSkills.val() != null){
					termsId = $selectedSkills.val();
				}

				if(termsId.length != null){

				}
				termsId.push( ui.item.value );
				$gotit.push( ui.item.value );

				termsId.push( "" );
				$selectedSkills.val(termsId).trigger("change"); 
				$(this).val("");
				return false;
			}
		});
	});


	$(document).ready(function(){
		$('#add-new-skill').on('click',function(event){  	    
		  	event.preventDefault();
		  	if (!$('#newskill').val()) {
		  		alert('Please enter some skill to add.');
		  		return false;
		  	}else{
			  	var name = $('#newskill').val(); 
			    $.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
			    $.ajax({
			      url: "job/newskill",
			      type: "POST",
			      data: { name: name },
			      cache : false,
			      success: function(data){
			        if(data > 0){
			        	$newSkillList = new Array();

			        	<?php $newSkillList = array(); ?>
						@foreach($skills as $skill)
							$newSkillList.push('<?php echo $skill; ?>');
						@endforeach

			        	$newSkillList.push($('#newskill').val());
			        	// console.log($newSkillList);
			        	$("#linked_skill_id").select2({
			        		dataType: 'json',
			        		data: $newSkillList
			        	});

			        	var selectedSkillId = [];
			        	$newSkill = $('#newskill').val();
			        	$newSkillId = data;
			        	// $selectedSkill = $('#linked_skill').val();
			        	// console.log($gotit);
			        	if($gotit != null){
							selectedSkillId = $gotit;
						}
						
			        	selectedSkillId.push($newSkill);
			        	// console.log(selectedSkillId);
			        	// $('#linked_skill').val($selectedSkill+""+$newSkill+", ");
			        	$selectedSkills.val(selectedSkillId).trigger("change"); 
			        	$('#newskill').val("");
			        }
			      },
			      error: function(data) {
			      	alert('some error occured...');
			      }
			    }); 
			    return false;
			}
		});
		});
</script>
<script>
	jQuery(document).ready(function() {
	    ComponentsDropdowns.init();
	});  
	$(document).ready(function () {   
    var form = $('#cop_contact_validation');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);
    form.validate({
        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            firm_email_id : {
                required : true
            },
            city : {
                required : true
            },
            state : {
                required : true
            },
            firm_address: {
                required: true
            }
        },
        messages: {
            firm_email_id: {
                required: "Enter Email Id"
            },
            city: {
                required: "Enter City"
            },
            state: {
                required: "Select State"
            },
            firm_address: {
                required: "Enter Company/Consultancy Address",
                minlength: 10
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