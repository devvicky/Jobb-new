<form id="corpsearch-profile" action="/search/ind/profile" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="type" value="people" >
<div class="col-md-12">
	<!-- BEGIN PORTLET -->
	<div class="portlet light " style="background-color:white;">
		<!-- <div class="portlet-title">
			<div class="caption caption-md">
				<i class="icon-bar-chart theme-font hide"></i>
				<span class="caption-subject font-blue-madison bold uppercase">Change Password</span>
			</div>
		</div> -->
		<div class="portlet-body">
			<div class="row" style="margin:15px -15px 0;">
	      	<div class="col-md-6 col-sm-6 col-xs-12 advance-len">
				<div class="form-group">
					<input type="text" class="form-control" name="role" placeholder="Enter Keyword">
				</div>					
			</div>
	        <div class="col-md-6 col-sm-6 col-xs-12 advance-len">
				<div class="form-group">
					<div style="position:relative;" id="job-skill-wrapper">
						<input type="text" name="name" id="newskill-job" class="form-control" placeholder="Search skill...">
						{!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}		
					</div>
					

				</div>
			</div>
	      </div>
		</div>
	</div>
	<!-- END PORTLET -->
</div>
<div class="col-md-12">
	<!-- BEGIN PORTLET -->
	<div class="portlet light " style="background-color:white;">
		<!-- <div class="portlet-title">
			<div class="caption caption-md">
				<i class="icon-bar-chart theme-font hide"></i>
				<span class="caption-subject font-blue-madison bold uppercase">Change Password</span>
			</div>
		</div> -->
		<div class="portlet-body">
			<div class="row">
	            <div class="col-md-3 col-sm-3 col-xs-6">
	              <div class="form-group">              
	                <label class=" control-label">Experience (Min)</label>
	                <div class="input-group">
	                  <select class="form-control" id="exp_min" name="min_exp">
	                    <!-- <option>Select</option> -->
	                    <option value="0">0</option>
	                    <option value="1">1</option>
	                    <option value="2">2</option>
	                    <option value="3">3</option>
	                    <option value="4">4</option>
	                    <option value="5">5</option>
	                    <option value="6">6</option>
	                    <option value="7">7</option>
	                    <option value="8">8</option>
	                    <option value="9">9</option>
	                    <option value="10">10</option>
	                    <option value="11">11</option>
	                    <option value="12">12</option>
	                    <option value="13">13</option>
	                    <option value="14">14</option>
	                    <option value="15">15</option>
	                  </select>
	                  <span class="input-group-addon">
	                    Years
	                  </span>
	                </div>
	              </div>
	            </div>
	            <div class="col-md-3 col-sm-3 col-xs-6">
	              <div class="form-group">              
	                <label class=" control-label">(Max)</label>
	                <div class="input-group">
	                  <select class="form-control maxexp" id="exp_max" name="max_exp">
	                    <!-- <option>Select</option> -->
	                    <option value="0">0</option>
	                    <option value="1">1</option>
	                    <option value="2">2</option>
	                    <option value="3">3</option>
	                    <option value="4">4</option>
	                    <option value="5">5</option>
	                    <option value="6">6</option>
	                    <option value="7">7</option>
	                    <option value="8">8</option>
	                    <option value="9">9</option>
	                    <option value="10">10</option>
	                    <option value="11">11</option>
	                    <option value="12">12</option>
	                    <option value="13">13</option>
	                    <option value="14">14</option>
	                    <option value="15">15</option>
	                  </select>
	                  <span class="input-group-addon">
	                    Years
	                  </span>
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
			
		</div>
	</div>
	<!-- END PORTLET -->
</div>
<div class="col-md-12">
	<!-- BEGIN PORTLET -->
	<div class="portlet light " style="background-color:white;">
		<!-- <div class="portlet-title">
			<div class="caption caption-md">
				<i class="icon-bar-chart theme-font hide"></i>
				<span class="caption-subject font-blue-madison bold uppercase">Change Password</span>
			</div>
		</div> -->
		<div class="portlet-body">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 advance-len">
		          	<div class="form-group">
						<select  name="job_type[]" multiple placeholder="Select" class="form-control education-list">
							<option value="">--Select Job Type--</option>
					        <option value="Full Time">Full Time</option>
							<option value="Part Time">Part Time</option>
							<option value="Freelancer">Freelancer</option>
							<option value="Work from home">Work from Home</option>
					    </select>		
					</div>  
		        </div>
				<div class="col-md-6 col-sm-6 col-xs-12 advance-len">
		          <div class="form-group">              
		              <input type="text" id="city" name="city" class="form-control" placeholder="Enter City: ex- Pune, Hyderabad">
		          </div>  
		        </div>
			</div>
		</div>
	</div>
	<!-- END PORTLET -->
</div>
 
<div class="row" style="margin-bottom: 10px;">
    <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="footer links-title center-css">              
          <button type="submit" class="btn blue "><i class="glyphicon glyphicon-search"></i> Search</button>
      </div> 
    </div>
  </div>
  </form>