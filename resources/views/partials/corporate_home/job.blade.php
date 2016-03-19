
<div class="row" style="margin:15px;">
	<div class="col-md-12 col-sm-12">
		
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
					<!-- <div class="input-group">	 -->
								
						<select  class="job-role-ajax form-control new-role" name="role" id="jobrole">
					  		<option value="0" selected="selected"></option>
						</select>													
					<!-- </div> -->
				</div>					
			</div>
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
				<div class="form-group">
					<label style="font-weight: 500;">Enter Skill</label>
					<div style="position:relative;" id="job-skill-wrapper">
						<input type="text" name="name" id="newskill-job" class="form-control" placeholder="Search skill...">
						{!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}		
					</div>
					

				</div>
			</div>

	        
	      </div>
	      <div class="row">
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
	          <div class="form-group">              
		            <label class=" control-label" style="font-weight: 500;">Experience </label>&nbsp;: 
					<input type="text" readonly id="slider-range-exp1-corp" name="min_exp" class="input-exp-width" /> - 
					<input type="text" readonly id="slider-range-exp2-corp" name="max_exp" class="input-exp-width" /> Years
					<div id="slider-range-exp-corp" class="slider bg-gray">
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
					<select  name="job_type"  placeholder="Select" class="form-control">
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
