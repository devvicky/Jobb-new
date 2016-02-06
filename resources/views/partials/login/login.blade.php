<!-- BEGIN LOGIN -->
<div class="portlet box blue col-md-12 login-tag" 
	 style="margin-top:0;border:0;background-color: transparent !important;margin: 10px auto;float: none;padding:0;">
		
	<div class="portlet-title portlet-title-login" 
		 style="float:none;margin:0 auto; display:table;background-color: transparent !important;padding: 0;">

		<ul class="nav nav-tabs" style="padding:0;">
			<li class="active home-tab-width-job" >
				<a href="#people" data-toggle="tab" class="job-skill-tab">
				<i class="icon-user" style=""></i> PEOPLE </a>
			</li>
			<li class="home-tab-width-skill">
				<a href="#company" data-toggle="tab" class="job-skill-tab">
				<i class="fa fa-university" style=""></i> COMPANY </a>
			</li>
		</ul>

	</div>

	<div class="portlet-body" style="background-color:transparent !important;margin:10px 0;">
		<div class="tab-content">
			<!-- Individual login tab -->
			<div class="tab-pane active" id="people">
				@include('partials.login.individual')
			</div>
			
			<!-- Corporate login tab -->
			<div class="tab-pane" id="company">
				@include('partials.login.corporate')
			</div>
		</div>
	</div>
</div>
<!-- END LOGIN -->