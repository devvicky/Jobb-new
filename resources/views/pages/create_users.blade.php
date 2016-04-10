@extends('admin')

@section('content')

<div class="row">
	<div class="col-md-7">
		@if (count($errors) > 0)
			<div class="alert alert-success save-filter">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
	<h4 style="text-align:center;background-color:#DDE0E0;color:#333131;padding:2px;font-weight: 500;">Create Profile</h4>
	<form id="create_user" action="/createuserrequest" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label class="control-label">First Name<span class="required">
							* </span></label>
					<!-- <div class="input-group">
						<span class="input-group-addon">
							<i class="glyphicon glyphicon-font"></i>
						</span> -->
						<div class="input-icon right">
									<i class="fa"></i>
						<input type="text" name="fname" class="form-control" placeholder="First Name">
						
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label class="control-label">Last Name<span class="required">
							* </span></label>
					<!-- <div class="input-group">
						<span class="input-group-addon">
							<i class="glyphicon glyphicon-font"></i>
						</span> -->
						<div class="input-icon right">
									<i class="fa"></i>
						<input type="text" name="lname" class="form-control" placeholder="Last Name">
						
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Date of Birth <span class="required">
							* </span></label>
					<div class="input-icon right">
									<i class="fa"></i>
						<input class="form-control date-picker" name="dob" size="16" type="text"/>
					</div>
					<!-- <label>Check the privacy setting for showing Date of Birth</label> -->
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Gender<span class="required">
							* </span></label>
					<div class="input-group">
						<div class="md-radio-inline">
							<div class="md-radio">
								<input type="radio" checked id="radio6" name="gender" value="Male" class="md-radiobtn">
								<label for="radio6" style="">
								<span></span>
								<span class="check"></span>
								<span class="box"></span>
								Male </label>
							</div>
							<div class="md-radio">
								<input type="radio" id="radio7" name="gender" value="Female" class="md-radiobtn">
								<label for="radio7" style="">
								<span></span>
								<span class="check"></span>
								<span class="box"></span>
								Female </label>
							</div>
							<div class="md-radio">
								<input type="radio" id="radio8" name="gender" value="Others" class="md-radiobtn">
								<label for="radio8" style="">
								<span></span>
								<span class="check"></span>
								<span class="box"></span>
								Others </label>
							</div>
						</div>	
						<div id="radio_error"></div>					<!-- /input-group -->
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="form-group">
					<label>City <span class="required">
							* </span></label>
					<div class="input-icon right">
									<i class="fa"></i>
						<input type="text" id="city" name="city" class="form-control" placeholder="City">										
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label>Mobile No </label>
					<div class="input-icon right">
									<i class="fa"></i>
						<input type="text" 
								name="mobile" 
								class="form-control" 
								placeholder="Mobile No" maxlength="10">
					</div>
				</div>
			</div>
			<!--/span-->
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label>Email Id </label>								
					<div class="input-icon right">
									<i class="fa"></i>
						<input type="text" name="email" 
								class="form-control" 
								placeholder="Email Id">
					</div>
				</div>
			</div>
			<!--/span-->
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>About Me</label>
						<!-- <textarea   onkeyup="countChar(this)" class="form-control" rows="6"> </textarea>
					<div id="charNum" style="text-align:right;"></div> -->
					<textarea id="textarea" rows="6" class="form-control " maxlength="500" name="about_individual" placeholder="write about proffessional summary..."></textarea>
							<div id="textarea_feedback"></div>
				</div>
			</div>
		</div>	
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label>Education <span class="required">
							* </span></label>
						<select class="select2me form-control education-list" name="education" style="border:1px solid #c4d5df">
							<option selected value="">Select</option>
							{{$n=""}}
							@foreach($educationList as $edu)
							
								@if($n != $edu->name && $edu->name != '0')
									{{$n=$edu->name}}
									<optgroup label="{{$edu->name}}">
								@endif
									<option value="{{$edu->name}}-{{$edu->branch}}-{{$edu->level}}">{{$edu->name}}-{{$edu->branch}}</option>
								@if($n != $edu->name)
									</optgroup>		
								@endif

							@endforeach
						</select>				
					</div>
				</div>
			<!-- </div> -->
			<!--/span-->
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label>Experience </label>
					<div class="input-group">
						<span class="input-group-addon">
							<i class=" icon-briefcase"></i>
						</span>
						<select class="form-control" name="experience">
							<option value=""> Select </option>
							<option value="0">Fresher</option>
							<option value="1">1 Year</option>
							<option value="2">2 Years</option>
							<option value="3">3 Years</option>
							<option value="4">4 Years</option>
							<option value="5">5 Years</option>
							<option value="6">6 Years</option>
							<option value="7">7 Years</option>
							<option value="8">8 Years</option>
							<option value="9">9 Years</option>
							<option value="10">10 Years</option>
							<option value="11">11 Years</option>
							<option value="12">12 Years</option>
							<option value="13">13 Years</option>
							<option value="14">14 Years</option>
							<option value="15">15 Years</option>
						</select>
					</div>
				</div>
			</div>
			<!--/span-->
		</div>						
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Working Status</label>
					<div class="input-group">
						<span class="input-group-addon">
							<i class=" icon-briefcase"></i>
						</span>
						<select class="form-control" id="working_status" name="working_status">
							<option value="">Select</option>
							<option value="Student">Student</option>
							<option value="Searching Job">Searching Job</option>
							<option value="Working">Working</option>
							<option value="Freelancing">Freelancing</option>
						</select>
					</div>
				</div>
			</div>	
			<div class="col-md-6 col-sm-6 col-xs-12" >
				<div class="form-group">
					<label>Working at</label>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-university"></i>
						</span>
						
						<input type="text" id="workingat" class="form-control" name="working_at">
					</div>
				</div>
			</div>
			<!--/span-->
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Industry <span class="required">*</span>
					</label>
					 <select class="select2me form-control" name="industry">
					 	<option value="">Select</option>
                        <option value="Automotive/ Ancillaries">Automotive/ Ancillaries</option>
                        <option value="Banking/ Financial Services">Banking/ Financial Services</option>
                        <option value="Bio Technology & Life Sciences">Bio Technology & Life Sciences</option>
                        <option value="Chemicals/Petrochemicals">Chemicals/Petrochemicals</option>
                        <option value="Construction">Construction</option>
                        <option value="FMCG">FMCG</option>
                        <option value="Education">Education</option>
                        <option value="Entertainment/ Media/ Publishing">Entertainment/ Media/ Publishing</option>
                        <option value="Insurance">Insurance</option>
                        <option value="ITES/BPO">ITES/BPO</option>
                        <option value="IT/ Computers - Hardware">IT/ Computers - Hardware</option>
                        <option value="IT/ Computers - Software">IT/ Computers - Software</option>
                        <option value="KPO/Analytics">KPO/Analytics</option>
                        <option value="Machinery/ Equipment Mfg.">Machinery/ Equipment Mfg.</option>
                        <option value="Oil/ Gas/ Petroleum">Oil/ Gas/ Petroleum</option>
                        <option value="Pharmaceuticals">Pharmaceuticals</option>
                        <option value="Power/Energy">Power/Energy</option>
                        <option value="Real Estate">Real Estate</option>
                        <option value="Retailing">Retailing</option>
                        <option value="Telecom">Telecom</option>
                        <option value="Advertising/PR/Events">Advertising/PR/Events</option>
                        <option value="Agriculture/ Dairy Based">Agriculture/ Dairy Based</option>
                        <option value="Aviation/Aerospace">Aviation/Aerospace</option>
                        <option value="Beauty/Fitness/PersonalCare/SPA">Beauty/Fitness/PersonalCare/SPA</option>
                        <option value="Beverages/ Liquor">Beverages/ Liquor</option>
                        <option value="Cement">Cement</option>
                        <option value="Ceramics & Sanitary Ware">Ceramics & Sanitary Ware</option>
                        <option value="Consultancy">Consultancy</option>
                        <option value="Courier/ Freight/ Transportation">Courier/ Freight/ Transportation</option>
                        <option value="Law Enforcement/Security Services">Law Enforcement/Security Services</option>
                        <option value="E-Learning">E-Learning</option>
                        <option value="Shipping/ Marine Services">Shipping/ Marine Services</option>
                        <option value="Engineering, Procurement, Construction">Engineering, Procurement, Construction</option>
                        <option value="Environmental Service">Environmental Service</option>
                        <option value="Facility management">Facility management</option>
                        <option value="Fertilizer/ Pesticides">Fertilizer/ Pesticides</option>
                        <option value="Food & Packaged Food">Food & Packaged Food</option>
                        <option value="Textiles / Yarn / Fabrics / Garments">Textiles / Yarn / Fabrics / Garments</option>
                        <option value="Gems & Jewellery">Gems & Jewellery</option>
                        <option value="Government/ PSU/ Defence">Government/ PSU/ Defence</option>
                        <option value="Consumer Electronics/Appliances">Consumer Electronics/Appliances</option>
                        <option value="Hospitals/ Health Care">Hospitals/ Health Care</option>
                        <option value="Hotels/ Restaurant">Hotels/ Restaurant</option>
                        <option value="Import / Export">Import / Export</option>
                        <option value="Market Research">Market Research</option>
                        <option value="Medical Transcription">Medical Transcription</option>
                        <option value="Mining">Mining</option>
                        <option value="NGO">NGO</option>
                        <option value="Paper">Paper</option>
                        <option value="Printing / Packaging">Printing / Packaging</option>
                        <option value="Public Relations (PR)">Public Relations (PR)</option>
                        <option value="Travel / Tourism">Travel / Tourism</option>
                        <option value="Other">Other</option>
                    </select>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>
						Job Role <span class="required">*</span>
					</label>
					<select class="select2me form-control" name="role">
						<option selected value="">Select</option>
						{{$n=""}}
						@foreach($farearoleList as $farearole)
						@if($n != $farearole->functional_area)
							{{$n=$farearole->functional_area}}
							<optgroup label="{{$farearole->functional_area}}">
						@endif
						<option value="{{$farearole->functional_area}}-{{$farearole->role}}">{{$farearole->role}}</option>
						@if($n != $farearole->functional_area)
								</optgroup>		
							@endif
						@endforeach
					</select>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<!-- <form action="{{ url('job/newskill') }}" id="newskillfrm" method="post">					
					<input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
					<label>Search Skills<span class="required"> * </span></label>
					<div style="position:relative;">
						<input type="text" name="name" id="newskill" class="form-control" placeholder="Search for skill...">
						<button id="add-new-skill" style="position:absolute;right:0;top:0;" class="btn btn-success" type="button"><i class="icon-plus"></i> Add</button>		
					{!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="form-group" style="">
					<label class="control-label">Upload Resume</label>&nbsp;
					
					<div class="">
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<span class="btn btn-default btn-file" style=" background-color: #44b6ae;  color: white;">
								<i class="icon-paper-clip" style="color: white;"></i>
								<span class="fileinput-new">Select File </span> 
								<span class="fileinput-exists">Upload New Resume </span>
								<input type="file" name="resume" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf">
							</span>
							<br>
							<span class="fileinput-new"></span>
							<span class="fileinput-filename"></span> 
							<a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 preferences-css">
				<span>Job Preference</span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label>Prefered Job Type <span class="required">
							* </span></label>
					<div class="input-group">
						<span class="input-group-addon">
							<i class=" icon-briefcase"></i>
						</span>
						<select class="form-control" name="prefered_jobtype">
							<option value="">&nbsp;</option>
							<option value="Full Time">Full Time</option>
							<option value="Part Time">Part Time</option>
							<option value="Freelancer">Freelancer</option>
							<option value="Work from home">Work from home</option>
						</select>
					</div>
				</div>
			</div>
		<!-- </div>
		<div class="row"> -->
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Prefered Location <span class="required">
							* </span></label>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-map-marker"></i>
						</span>

						<input type="text" id="pref_loc" name="pref_loc" 
						class="form-control" placeholder="Select preferred location">									
						
					</div>

					{!! Form::select('prefered_location[]', [], null, ['id'=>'prefered_location', 
																				   'aria-hidden'=>'true', 
																				   'class'=>'form-control', 
																				   'placeholder'=>'city', 
																				   'multiple']) !!}	
				</div>
			</div>
		</div>
		<div class="margin-top-10" style="text-align: center; border-top: 1px solid lightgrey;padding: 10px 0;background-color: #DDE0E0;">
			<button type="submit" class="btn green"><i class="fa fa-check"></i> Create</button>
			<a class="btn btn-warning">Reset</a>
		</div>
	</form>
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
$(document).ready(function() {
  
  $('#name').blur(function(){
  
    var nameVal = $('#name').val()
    var nameLength = nameVal.length;
    var nameSplit = nameVal.split(" ");
    var lastLength = nameLength - nameSplit[0].length;
    var lastNameLength = nameSplit[0].length + 1;
    var lastName = nameVal.slice(lastNameLength);
    
    $('#first_name').val(nameSplit[0]);
    $('#last_name').val(lastName);
    
    return false;
  });
	
});
</script>
<script type="text/javascript">
	$(".education-list").select2({
	  placeholder: "Select education"
	});

    // preferred loc
	var prefLocationArray = [];

    // preferred loc    
    var plselect = $("#prefered_location").select2();
    plselect.val(prefLocationArray).trigger("change");

  	var $eventSelect = $("#prefered_location"); 
	$eventSelect.on("select2:unselect", function (e) {
		// console.log("Removing: "+e.params.data.id);
		// remove corresponding value from array
		prefLocationArray = $.grep(prefLocationArray, function(value) {
		  return value != e.params.data.id;
		});

		// remove select option for pref loc
		$("#prefered_location option[value='"+e.params.data.id+"']").remove();		
		if(prefLocationArray.length == 0){
			plselect = $("#prefered_location").select2({ dataType: 'json', data: [] });
		}else{
			plselect = $("#prefered_location").select2({ dataType: 'json', data: prefLocationArray });
		}
		plselect.val(prefLocationArray).trigger("change"); 
		// updated array
	});

    var prefLoc = $("#pref_loc");
	function initPrefLoc() {
		var options = {	types: ['(regions)'], componentRestrictions: {country: "in"}};
		var input = document.getElementById('pref_loc');
		var autocomplete = new google.maps.places.Autocomplete(input, options);
		autocomplete.addListener('place_changed', onPlaceChanged);

		function onPlaceChanged() {
		  var place = autocomplete.getPlace();
		  if (place.address_components) { 
		  	// console.log(place.address_components);

		  	var obj = place.address_components;		  	
		  	var locality = '';
	  		var city = '';
	  		var state = '';
		  	$.each( obj, function( key, value ) {
		  		if($.inArray("sublocality", value.types)  > -1 ){
		  			locality = value.long_name;
		  		}
		  		if($.inArray("locality", value.types)  > -1 ){
		  			city = value.long_name;
		  		}
		  		if($.inArray("administrative_area_level_1", value.types)  > -1 ){
		  			state = value.long_name;
		  		}
			});
			// console.log("Locality: "+locality+" city: "+city+" state: "+state);

			if(locality != '' && city != '' && state != '' ){
				prefLocationArray.push(locality +"-"+ city +"-"+ state);	
			}
			if(locality == '' && city != '' && state != '' ){
				prefLocationArray.push(city +"-" + state);	
			}

		  	setTimeout(function(){ prefLoc.val(''); prefLoc.focus();},0);	// clear field
		  	
		  	$("#prefered_location").select2({ dataType: 'json', data: prefLocationArray });
        	plselect.val(prefLocationArray).trigger("change");

		  } else { 
		  	document.getElementById('autocomplete').placeholder = 'Your preferred location'; 
		  }
		}

	}
   google.maps.event.addDomListener(window, 'load', initPrefLoc);

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
			      url: "/job/newskill",
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
$(document).ready(function () {            
//validation rules
    var form = $('#create_user');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);
    form.validate({
        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
           fname: {
              required: true,
              minlength: 5
            },
            lname: {
              required: true
            },
            dob: {
                required: true
            },
            gender: {
                required: true
            },
            city: {
                required: true
            },
            mobile: {
                required:true,
                number: true,
                maxlength:10,
                minlength:10
            },
            email: {
                required:true,
                email:true,
                minlength:10
            },
            about_individual: {
                required:false,
                maxlength:500,
                minlength:50
            },
            education: {
                required: true
            },
            experience: {
                required: true
            },
            industry:{
				required: true
            },
            role: {
            	required: true
            },
            'linked_skill_id[]': {
                required: true
            },
            prefered_jobtype: {
                required: true
            },
            'prefered_location': {
                required: true
            }

        },
        messages: {
            fname: {
                required: 'Enter First Name'
            },
            lname: {
                required: 'Enter Last Name'
            },
            dob: {
                required: 'Enter Date of Birth'
            },
            gender: {
                required: 'Choose Gender'
            },
            City: {
                required: 'Enter Current City'
            },
            mobile: {
                required: 'Enter Mobile No',
                number: 'Enter only digits',
                maxlength: 'Maximum 10 digits',
                minlength: 'Minimum 10 digits'
            },
            email: {
                required: 'Enter Email Id',
                email: 'Email format is wrong',
            },
            about_individual: {
                minlength: 'Minimum 50 character',
                maxlength: 'Maximum 500 character'
            },
            education: {
                required: 'Select Education'
            },
            experience: {
                required: 'Select Experience'
            },
            industry:{
				required: 'Select Industry'
            },
            role: {
            	required: 'Select Role'
            },
            'linked_skill_id[]': {
                required: 'Select atleast 1 Skill'
            },
            prefered_jobtype: {
                required: 'Select Job type'
            },
            'prefered_location': {
                required: 'Select Prefered Location'
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
            errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");  
                    icon.attr("data-original-title", error.text()).tooltip({'placement': 'left'});
                   
                },
            success: function (label, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");
                },
    });
});
</script>
@stop