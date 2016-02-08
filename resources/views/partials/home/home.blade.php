<div class="portlet box blue col-md-9" style="margin-top:0;border:0;background: whitesmoke;">
	<div class="portlet-title portlet-title-home" style="float:none;margin:0 auto; display:table;background: whitesmoke;padding: 0;">
		<ul class="nav nav-tabs" style="padding:0;">
			<li class="active home-tab-width-job" >
				<a href="#job" data-toggle="tab" class="job-skill-tab">Jobs</a>
			</li>
			<li class="home-tab-width-skill">
				<a href="#skill" data-toggle="tab" class="job-skill-tab">Skills</a>
			</li>
		</ul>
	</div>
	<div class="portlet-body" style="background-color:whitesmoke;">
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
<!-- END TAB PORTLET-->
<div class="col-md-3">
	@include('partials.home.ad')
</div>	
<!-- END TIMELINE ITEM -->
