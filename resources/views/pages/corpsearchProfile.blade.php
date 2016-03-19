@extends('master')

@section('content')
@if($title == 'search_profile')
<div class="row" style="margin:15px;">
	<div class="col-md-8 col-sm-8">
		<div class="myactivity-head" style="margin: 10px 0 0 0;">
			<i class="fa fa-search"></i> Search Profile
		</div>
		<form id="corpsearch-profile" action="/search/ind/profile" method="post">
	      <input type="hidden" name="_token" value="{{ csrf_token() }}">
	      <div class="row " style="display: table;">
				<input type="hidden" name="type" value="people" >
	      </div>
	      <div class="row">
				
	        </div>
	      <div class="row" style="margin:15px -15px 0;">
	      	<div class="col-md-6 col-sm-6 col-xs-12 advance-len">
				<div class="form-group">
					<label style="font-weight: 500;">
						Job Role
					</label>
					<div class="input-group">	
						<span class="input-group-addon">
							<i class="fa fa-cube" style="color:darkcyan;"></i>
						</span>			
						<select  class="job-role-ajax form-control new-role" name="role" id="jobrole">
					  		<option value="0" selected="selected"></option>
						</select>													
					</div>
				</div>					
			</div>
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
				<div class="form-group">
					<label style="font-weight: 500;">Enter Skill</label>
					<div style="position:relative;">
						<input type="text" name="name" id="newskill" class="form-control" placeholder="Search for skill">
							<!-- <button id="add-new-skill" style="position:absolute;right:0;top:0;" class="btn btn-success" type="button"><i class="icon-plus"></i> Add</button>	 -->
							{!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
					</div>
				</div>
			</div>

	        
	      </div>
	      <div class="row">
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          <div class="form-group">              
		            <label class=" control-label" style="font-weight: 500;">Experience </label>&nbsp;: 
					<input type="text" readonly id="slider-range-exp1" name="min_exp" class="input-exp-width" /> - 
					<input type="text" readonly id="slider-range-exp2" name="max_exp" class="input-exp-width" /> Years
					<div id="slider-range-exp" class="slider bg-gray">
					</div>		
	          </div>  
	        </div>
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">   
	          	 <div class="form-group">
	          	 	<label></label>
	            <input type="checkbox" name="resume" class="icheck filter-input"> Profiles with Resume only
  				</div>
	        </div>
	        
	      </div>
	      <div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          	<div class="form-group">
	          		<label class=" control-label" style="font-weight: 500;">Job Type</label>
					<select  name="job_type"  placeholder="Select" class="SlectBox">
						<option value="">--Select--</option>
				        <option value="Full Time">Full Time</option>
						<option value="Part Time">Part Time</option>
						<option value="Freelancer">Freelancer</option>
						<option value="Work from home">Work from Home</option>
				    </select>		
				</div>  
	        </div>
			<div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          <div class="form-group">              
	          	<label class=" control-label" style="font-weight: 500;">Location </label>
	              <input type="text" id="city" name="city" class="form-control" placeholder="City: Pune, Hyderabad">
	          </div>  
	        </div>
		</div>
	      <div class="row" style="margin-bottom: 10px;">
	        <div class="col-md-12 col-sm-12 col-xs-12">
	              <div class="footer links-title center-css">              
	              <button type="submit" class="btn blue "><i class="glyphicon glyphicon-search"></i> Search</button>
	          		
	          </div> 
	        </div>
	        
	      </div>
	    </form>
	</div>
</div>
@endif
@if($title == 'Profilesearch')
<div class="row" style="margin:15px;text-align:center;">
	<div class="col-md-8 col-sm-8">
		@if($city != null){{$city}} | @endif{{$min_exp}}-{{$max_exp}} Years @if($resume != '')| With Resume @endif @if($role > 0)|{{$role}} @endif @if ($prefered_jobtype != '') | {{$prefered_jobtype}} @endif
	</div>
</div>
<div class="row" style="margin:15px;text-align:center;">
	<div class="col-md-8 col-sm-8">
		<a class="btn small-btn blue modifysearch">Modify</a>
	</div>
</div>
<div class="row searchedprofile" style="margin:15px;">
	<div class="col-md-8 col-sm-8">
		<h4 style="text-align: center;background-color: #908D8D; color: white; padding: 3px 0px;">
			Search Profile 
		</h4>
		<form id="corpsearch-profile" action="/search/ind/profile" method="post">
	      <input type="hidden" name="_token" value="{{ csrf_token() }}">
	      <div class="row " style="display: table;">
				<input type="hidden" name="type" value="people" >
	      </div>
	      <div class="row">
				
	        </div>
	      <div class="row" style="margin:15px -15px 0;">
	      	<div class="col-md-6 col-sm-6 col-xs-12 advance-len">
				<div class="form-group">
					<label style="font-weight: 500;">
						Job Role
					</label>
					<div class="input-group">	
						<span class="input-group-addon">
							<i class="fa fa-cube" style="color:darkcyan;"></i>
						</span>			
						<select  class="job-role-ajax form-control new-role" name="role" id="jobrole">
					  		<option value="0" selected="selected"></option>
						</select>													
					</div>
				</div>					
			</div>
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
				<div class="form-group">
					<label style="font-weight: 500;">Enter Skill</label>
					<div style="position:relative;">
						<input type="text" name="name" id="newskill" class="form-control" placeholder="Search for skill">
							<!-- <button id="add-new-skill" style="position:absolute;right:0;top:0;" class="btn btn-success" type="button"><i class="icon-plus"></i> Add</button>	 -->
							{!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
					</div>
				</div>
			</div>

	        
	      </div>
	      <div class="row">
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          <div class="form-group">              
		            <label class=" control-label" style="font-weight: 500;">Experience </label>&nbsp;: 
					<input type="text" readonly id="slider-range-exp1" name="min_exp" class="input-exp-width" /> - 
					<input type="text" readonly id="slider-range-exp2" name="max_exp" class="input-exp-width" /> Years
					<div id="slider-range-exp" class="slider bg-gray">
					</div>		
	          </div>  
	        </div>
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">   
	          	 <div class="form-group">
	          	 	<label></label>
	            <input type="checkbox" name="resume" class="icheck filter-input"> Profiles with Resume only
  				</div>
	        </div>
	        
	      </div>
	      <div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          	<div class="form-group">
	          		<label class=" control-label" style="font-weight: 500;">Job Type</label>
					<select  name="job_type"  placeholder="Select" class="SlectBox">
						<option value="">--Select--</option>
				        <option value="Full Time">Full Time</option>
						<option value="Part Time">Part Time</option>
						<option value="Freelancer">Freelancer</option>
						<option value="Work from home">Work from Home</option>
				    </select>		
				</div>  
	        </div>
			<div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          <div class="form-group">              
	          	<label class=" control-label" style="font-weight: 500;">Location </label>
	              <input type="text" id="city" name="city" class="form-control" placeholder="City: Pune, Hyderabad">
	          </div>  
	        </div>
		</div>
	      <div class="row" style="margin-bottom: 10px;">
	        <div class="col-md-12 col-sm-12 col-xs-12">
	              <div class="footer links-title center-css">              
	              <button type="submit" class="btn blue "><i class="glyphicon glyphicon-search"></i> Search</button>
	          		
	          </div> 
	        </div>
	        
	      </div>
	    </form>
	</div>
</div>

<div class="row" style="margin:30px 0;">
	<div class="col-md-8" style="">
		
@if(count($users) > 0)
	<h4 style="text-align: center;background-color: #908D8D; color: white; padding: 3px 0px;">
		Searched Profile <span class="badge" style="background-color: deepskyblue;">{{count($users)}} </span>
	</h4>
@foreach($users as $user)

@if(Auth::user()->identifier == 2 && $user->user->email_verify == 1 || $user->user->mobile_verify == 1)	
		<div style="margin: 10px 0;border-bottom: 1px solid #eee;">
	  	<div class="row show-profile">   
	    	<div class="col-md-8 col-sm-8 col-xs-8" style="">
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
	  			
	  			
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4" style="padding:0 !important;">
			      	<a data-toggle="modal" class="btn resume-button-css magic-profile-match" href="#static" style="padding: 2px 8px;">
		    			<i class="icon-speedometer" style="font-size:12px;"></i> {{$perProfile}}%
		    		</a>
		    </div>	
  		</div>
  		
  		<div class="row" style="margin: 10px 0;">
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

  		
  		<div class="row" style="margin: 10px 0;">
  			<div class="col-md-8 col-sm-8 col-xs-8" style="padding:0;">
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
			<div class="col-md-4 col-sm-4 col-xs-4 " style="padding:0;">
				@if(!$corpsearchprofile->contains('profile_id', $user->id))
				<form action="/profile/save" method="post" id="profile-save-{{$user->id}}" data-saveid="{{$user->id}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="profileid" value="{{ $user->id }}">
					<button id="profilesave-btn-{{$user->id}}" class="btn blue corp-profile-contact fav-btn profile-save-btn" type="button" style="">			
						<i class="fa fa-save (alias)" style="font-size: 14px;color:white;"></i> Save Profile
					</button>
				</form>
				@elseif($corpsearchprofile->contains('profile_id', $user->id)->where('user_id', Auth::user()->corpuser_id)->first()->save_profile == 1)
				<button>Saved</button>
				@else
				<form action="/profile/save" method="post" id="profile-save-{{$user->id}}" data-saveid="{{$user->id}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="profileid" value="{{ $user->id }}">
					<button id="profilesave-btn-{{$user->id}}" class="btn blue corp-profile-contact fav-btn profile-save-btn" type="button" style="">			
						<i class="fa fa-save (alias)" style="font-size: 14px;color:white;"></i> Save Profile
					</button>
				</form>
				@endif
			</div>
  		</div>
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
              	{{$min_exp}}-{{$max_exp}}
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
@endif
@stop
@section('javascript')

<script>
jQuery(document).ready(function() {       
    ComponentsjQueryUISliders.init(); 
});
</script>
<script src="/assets/admin/pages/scripts/components-dropdowns.js"></script>
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
        $(document).ready(function () {
            window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 3 });
            window.test = $('.testsel').SumoSelect({okCancelInMulti:true });
            window.testSelAll = $('.testSelAll').SumoSelect({okCancelInMulti:true, selectAll:true });
            window.testSelAll2 = $('.testSelAll2').SumoSelect({selectAll:true });
        });

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

		
		$(".job-role-ajax").select2({
		placeholder: 'Enter a role',
		ajax: {
		    url: "/post/jobroles/",
		    dataType: 'json',
		    delay: 250,
		    data: function (params) {
		      return {
		        q: params.term, // search term
		        page: params.page
		      };
		    },
		    processResults: function (data, params) {
		      console.log(data);
		      return {
		        results: data
		      };
		    },
		    cache: true
	  	},
		escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		minimumInputLength: 2,
		templateResult: formatRepo, // omitted for brevity, see the source of this page
		templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
	});

	function formatRepo (repo) {
		if (repo.loading) return repo.text;

		var markup = "<div class='select2-result-repository clearfix'>" +
		"<div class='select2-result-repository__meta'>" +
		  "<div class='select2-result-repository__title'><b>Role</b>: " + repo.role + "</div>";

		markup += "<div class='select2-result-repository__statistics'>" +
		"<div class='select2-result-repository__forks'><b>Functional area: </b> " + repo.functional_area + "</div>" +
		"<div class='select2-result-repository__stargazers'><b>Industry</b>: " + repo.industry + "</div>" +
		"</div>" +
		"</div></div>";

		return markup;
    }

    function formatRepoSelection (repo) {
    	if(repo.role != undefined){
    		// console.log(repo);
    		return  "<b>Role:</b> "+repo.role+"<br/><b>Functional Area:</b> "+repo.functional_area+"<br/><b>Industry:</b> "+repo.industry;
    	}      
    }
		});
</script>

<script type="text/javascript">
     $(document).ready(function () {
     	$('.profile-show').hide();
        $('.view-profile').click(function () {
           $('.profile-show').show();
           $('.view-profile').hide();
    });
   });

     $(document).ready(function () {
        $('.modifysearch').click(function () {
           $('.searchedprofile').show();
           $('.modifysearch').hide();
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
 			$("#profilesave-btn-"+post_id).hide();
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
			$('#profilesave-btn-'+post_id).text('Profile Saved');	
        }else if(data.data.save_profile == 0){
        	$('#profilesave-btn-'+post_id).css({'color':'white'});
        	$('#profilesave-btn-'+post_id).text('Save Profile');
        }
      }
    }); 
    return false;
  }); 
</script>
@stop