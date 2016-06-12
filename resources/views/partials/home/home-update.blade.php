<div id="demo" class="row margin-top-10 jplist">
	<div class="col-md-12">
		<!-- BEGIN PROFILE SIDEBAR -->
		<div class="profile-sidebar jplist-panel" style="width: 240px;">
			<!-- PORTLET MAIN -->
			<div class="portlet light profile-sidebar-portlet" style="padding: 0 !important;background-color: transparent;">
				<div class="profile-usertitle" style="margin-top: 10px;">
					<div class="profile-usertitle-name" style="height:40px;">
						  <div class="btn-group" style="">
					            <a class="btn post-button" data-toggle="modal" href="#job-skill-post">
					              <i class="fa fa-edit (alias)"></i> Post Free Ad
					            </a>
					        </div>
					</div>
				</div>
			</div>
			<div class="row" style="margin:0;">
				<div class="col-md-6 col-sm-6 col-xs-6" style="padding:0;">
					<a class="btn default " id="filter-code" style="background-color:white !important;color:#8c8c8c;">
						<i class="fa fa-filter"></i> Filter
					</a>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6" style="padding:0;text-align:right;">
					<div class="btn-group">
						<button class="btn btn-default btn-sm dropdown-toggle capitalize" type="button" data-toggle="dropdown" style="border: 0;color:#8c8c8c;background:transparent;">
						<i class="glyphicon glyphicon-sort"></i> <i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu dropdown-menu-sort" role="menu" style="min-width: 130px;margin: 4px -25px;">
							<li>
								<a href="/home/job/date">Date</a>
							</li>
							<li>
								<a href="/home/job/magic-match">Magic Match</a>
							</li>
							<li>
								<a href="/home/job/individual">Individual Post</a>
							</li>
							<li>
								<a href="/home/job/corporate">corporate Post</a>
							</li>
						</ul>
					</div>	
				</div>
			</div>
			<div class="portlet light profile-sidebar-portlet filter-show" style="padding: 0 !important;">
				<div class="profile-usertitle" style="    border-bottom: 1px solid lightgrey; margin-bottom: 10px;margin-top: -7px;">
					<div class="profile-usertitle-name">
						 Filter
					</div>
				</div>
				<div class="input-group">
					<div class="icheck-inline">
						<label>
							<input type="checkbox" data-toggle="portfilter" checked data-target="all" >
							All
						</label>
						<label>
							<input type="checkbox" data-toggle="portfilter" data-target="Full Time" >
							 Full Time
						</label>
						<label>
							<input type="checkbox" data-toggle="portfilter" data-target="Part Time" >
							Part Time 
						</label>
						<label>
							<input type="checkbox" data-toggle="portfilter" data-target="Work from Home" > 
							Work From Home
						</label>
						<label>
							<input type="checkbox" data-toggle="portfilter" data-target="Freelancer" > 
							Freelancer
						</label>
					</div>
				</div>
			</div>
			<div class="portlet light filter-show">
				<input 
							  data-path=".post-title-new" 
							  type="text" 
							  value="" 
							  placeholder="Filter by Title" 
							  data-control-type="textbox" 
							  data-control-name="title-filter" 
							  data-control-action="filter"
							  class="form-control"
						   />
			</div>
			<div class="portlet light filter-show">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						
						<div class="form-group">							
							<label class=" control-label">Experience (in yrs)</label>
							
								<select class="form-control" name="experience">
									<option value="">Select</option>
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
						</div>
					</div>
				</div>
			</div>
			<div class="portlet light filter-show">
				<div class="row" style="margin: 25px 0px 0 -10px;">
					<div class="col-md-12 col-sm-12 col-xs-12" style="margin:-5px 0;padding:0 10px;">
						<div class="form-group">
							<!-- <label style="font-size:13px;font-weight:500;">Skills</label> -->
							<div>
								<div style="position:relative;" id="job-skill-wrapper">
									<input type="text" name="name" id="newskill-job" class="form-control" placeholder="Search skill...">		
								</div>
								{!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="portlet light filter-show">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>Industry</label>
							<select class=" form-control" name="industry">
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
				</div>
			</div>
		</div>
		<div class="profile-content">
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue col-md-9" style="margin-top:0;border:0;background: transparent;">
						<div class="portlet-title portlet-title-home" style="float:none;margin:0 auto; display:table;background: transparent;padding: 0;">
							<ul class="nav nav-tabs" style="padding:0;margin: 0px 0 5px 0;">
								<li class="active home-tab-width-job" >
									<a href="#job" data-toggle="tab" class="job-skill-tab">Offering Jobs</a>
								</li>
								<li class="home-tab-width-skill">
									<a href="#skill" data-toggle="tab" class="job-skill-tab">Promoting Skills</a>
								</li>
							</ul>
						</div>
						<div class="portlet-body" style="background-color:transparent;">
							<div class="tab-content">
								<div class="tab-pane active" id="job">
									@include('partials.home.job')
								</div>
								<div class="tab-pane " id="skill">
									@include('partials.home.skill')
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


	
<!-- END TIMELINE ITEM -->
