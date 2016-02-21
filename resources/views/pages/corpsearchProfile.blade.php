@extends('master')

@section('content')

<div class="row" style="margin:15px;">
	<div class="col-md-7 col-sm-9">
		<div style="border-bottom: 1px solid lightgrey;">
			<label style="float:none; margin:0 auto; display:table;">Profile Search</label>
		</div>
		<form id="corpsearch-profile" action="/search/profile" method="post">
	      <input type="hidden" name="_token" value="{{ csrf_token() }}">
	      <div class="row " style="margin: 0px auto; float: none; display: table;">
				<input type="hidden" name="type" value="people" >
	      </div>
	      <div class="row" style="margin:15px -15px 0;">
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          <div class="form-group">              
	              <input type="text" name="fullname" class="form-control filter-input" placeholder="Enter Name or Email Id">
	          </div>  
	        </div>
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          <div class="form-group">              
	              <input type="text" name="city" class="form-control filter-input" placeholder="Location: Pune, Hyderabad">
	          </div>  
	        </div>
	      </div>
	      <div class="row">
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          <div class="form-group">              
	              <input type="text" name="role" class="form-control filter-input" placeholder="Job Role">
	          </div>  
	        </div>
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          <div class="form-group">              
	              <input type="text" name="category" class="form-control filter-input" placeholder="Functional Area">
	          </div>  
	        </div>
	      </div>
	      <div class="row">
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          <div class="form-group">              
	              <input type="text" name="working_at" class="form-control filter-input" placeholder="Working at">
	          </div>  
	        </div>
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          <div class="form-group">              
	              <input type="text" name="mobile" class="form-control filter-input" placeholder="Mobile No">
	          </div>  
	        </div>
	      </div>
	      <div class="row">
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          <div class="form-group">              
		            <label class=" control-label">Experience </label>&nbsp;: 
					<input type="text" readonly id="slider-range-exp1" name="min_exp" class="input-exp-width" /> - 
					<input type="text" readonly id="slider-range-exp2" name="max_exp" class="input-exp-width" /> Years
					<div id="slider-range-exp" class="slider bg-gray">
					</div>		
	          </div>  
	        </div>
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          <div class="form-group">
				<select multiple="multiple" name="job_type"  placeholder="Select" class="SlectBox">
			       <option selected value="Full Time">Full Time</option>
					<option value="Part Time">Part Time</option>
					<option value="Freelancer">Freelancer</option>
					<option value="Work from Home">Work from Home</option>
			    </select>		
			</div>  
	        </div>
	      </div>
	      
	      <div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Enter Skill</label>
					<div style="position:relative;">
						<input type="text" name="linked_skill_id" id="" class="form-control" placeholder="Search for skill...">
						<!-- <button id="add-new-skill" style="position:absolute;right:0;top:0;" class="btn btn-success" type="button"><i class="icon-plus"></i> Add</button>		 -->
					</div>
				</div>
			</div>
			
		</div>
		<div class="row">
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">   
	          	
	            <input type="checkbox" name="resume" class="form-control filter-input"> With Resume
  
	        </div>
<!-- 	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          <div class="form-group">              
	              <input type="text" name="job_type" class="form-control filter-input group" placeholder="Job Type">
	          </div>  
	        </div> -->
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

@stop
@section('javascript')

<script>
jQuery(document).ready(function() {       
    ComponentsjQueryUISliders.init(); 
});
</script>
<script src="/assets/admin/pages/scripts/components-dropdowns.js"></script>
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
			      url: "{{ url('job/newskill') }}",
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
@stop