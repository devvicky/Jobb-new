<!-- BEGIN REGISTER -->
<div class="portlet box blue col-md-12 corporate-register-tab" 
	 style="margin-top:0;border:0;background: transparent !important;margin: 30px auto;float: none;padding:0;">
	<div class="portlet-title portlet-title-login" 
		 style="float:none;margin:0 auto; display:table;background: transparent !important;padding: 0;">
		<ul class="nav nav-tabs" style="padding:0;">
			<li class="active home-tab-width-job" >
				<a href="#people-reg" data-toggle="tab" class="job-skill-tab">
				<i class="icon-user" style=""></i> People </a>
			</li>
			<li class="home-tab-width-skill">
				<a href="#company-reg" data-toggle="tab" class="job-skill-tab">
				<i class="fa fa-university" style=""></i> Company </a>
			</li>
		</ul>
	</div>

	<div class="portlet-body" style="background-color:transparent !important;">
		<div class="tab-content">
			<!-- Individual registration tab -->
			<div class="tab-pane active" id="people-reg">
				@include('partials.register.individual')				
			</div>
			
			<!-- corporate registration tab -->
			<div class="tab-pane" id="company-reg">
				@include('partials.register.corporate')				
			</div>
		</div>
	</div>
</div>
<!-- BEGIN REGISTER -->