@extends('login')

@section('content')
<!-- BEGIN PAGE BREADCRUMB -->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="/">Welcome</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li class="active">
			Feedback
		</li>
	</ul>
</div>
<!-- END PAGE BREADCRUMB -->

<div class="row">
	<div class="col-md-10">
		<!-- BEGIN PORTLET -->
		<div class="portlet light " style="background-color:white;">
			
			<div class="portlet-body">
				<h3 class="page-title">
					<label class="feedback-title">We value your Feedback/Suggestion</label> <br/><small style="font-size: 14px;">[ help us making <a href="http://jobtip.in" class="feedback-caption">jobtip.in</a> better ]</small>
				</h3>
				@if (count($errors) > 0)
					<div class="alert alert-success save-filter">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			</div>
		</div>
		<!-- END PORTLET -->
	</div>
</div>
<div class="row">
	<form action="/feedback/welcome/store" id="feedback_welcome" class="horizontal-form" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="col-md-10" id="feedback-tab-1">
			<!-- BEGIN PORTLET -->
			<div class="portlet light " style="background-color:white;">
				<div class="portlet-title">
					<div class="caption caption-md">
						<i class="icon-bar-chart theme-font hide"></i>
						<span class="caption-subject feedback-content-title">How did you first learn of our web site ?</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="feedback-radiobutton-css"></label>
								<div class="input-group">
									<div class="icheck-inline">
										<label>
											<input type="radio" name="promotion" value="Advertisement" class="icheck" data-radio="iradio_square-red">
											Advertisement
										</label><br/>
										<label>
											<input type="radio" name="promotion" value="Billboard" class="icheck" data-radio="iradio_square-red">
											 Billboard 
										</label><br/>
										<label>
											<input type="radio" name="promotion" value=" Email or Newsletter" class="icheck" data-radio="iradio_square-red">
											  Email or Newsletter
										</label><br/>
										<label>
											<input type="radio" name="promotion" value="Search Engine" class="icheck" data-radio="iradio_square-red"> 
											Search Engine
										</label><br/>
										<label>
											<input type="radio" name="promotion" value="Word of Mouth" class="icheck" data-radio="iradio_square-red"> 
											Word of Mouth
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END PORTLET -->
			<!-- BEGIN PORTLET -->
			<div class="portlet light " style="background-color:white;">
				<div class="portlet-title">
					<div class="caption caption-md">
						<i class="icon-bar-chart theme-font hide"></i>
						<span class="caption-subject feedback-content-title">What device you use to access Jobtip.in ?</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="feedback-radiobutton-css"></label>
								<div class="input-group">
									<div class="icheck-inline">
										<label>
											<input type="radio" name="device_info" value="Mobile" class="icheck" data-radio="iradio_square-red">
											Mobile
										</label><br/>
										<label>
											<input type="radio" name="device_info" value="Tab" class="icheck" data-radio="iradio_square-red">
											 Tab
										</label><br/>
										<label>
											<input type="radio" name="device_info" value="Desktop/Laptop" class="icheck" data-radio="iradio_square-red">
											 Desktop/Laptop
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END PORTLET -->
			<!-- BEGIN PORTLET -->
			<div class="portlet light " style="background-color:white;">
				<div class="portlet-title">
					<div class="caption caption-md">
						<i class="icon-bar-chart theme-font hide"></i>
						<span class="caption-subject feedback-content-title">What concerns do you have while using Joptip.in ?</span><span style="font-size: 11px;"> [ You can select multiple option ]</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="feedback-radiobutton-css"></label> 
								<div class="input-group">
									<div class="icheck-inline">
										<label>
											<input type="checkbox" name="concerns[]" value="Most of the information/contents are either fake/incorrect." class="icheck" data-checkbox="icheckbox_square-red"> 
											Most of the information/contents are either fake/incorrect. 
										</label><br/>
										<label>
										<label>
											<input type="checkbox" name="concerns[]" value="Most of the contents are Inappropriate and irrelevant." class="icheck" data-checkbox="icheckbox_square-red">
											Most of the contents are Inappropriate and irrelevant.
										</label><br/>
										<label>
											<input type="checkbox" name="concerns[]" value="I feel my personal data is not secured." class="icheck" data-checkbox="icheckbox_square-red"> 
											I feel my personal data is not secured.
										</label><br/>
										<label>
											<input type="checkbox" name="concerns[]" value="The website is slow and buggy." class="icheck" data-checkbox="icheckbox_square-red"> 
											The website is slow and buggy.
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END PORTLET -->
			<!-- BEGIN PORTLET -->
			<div class="portlet light " style="background-color:white;">
				<div class="portlet-title">
					<div class="caption caption-md">
						<i class="icon-bar-chart theme-font hide"></i>
						<span class="caption-subject feedback-content-title">How likely are you to recommend our site to a friend, family member or colleague ?</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="feedback-radiobutton-css"></label>
								<div class="input-group">
									<div class="icheck-inline">
										<label >
											<input type="radio" name="refer" value="Sure, I am doing it right away." class="icheck" data-radio="iradio_square-red">
											Sure, I am doing it right away.
										</label><br/>
										<label>
											<input type="radio" name="refer" value="I am thinking about it." class="icheck" data-radio="iradio_square-red">
											I am thinking about it.
										</label><br/>
										<label>
											<input type="radio" name="refer" value="I will explore and decide." class="icheck" data-radio="iradio_square-red"> 
											I will explore and decide.
										</label><br/>
										<label>
											<input type="radio" name="refer" value="Not now, it needs improvement." class="icheck" data-radio="iradio_square-red"> 
											Not now, it needs improvement.
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END PORTLET -->
			<div class="form-actions" style="text-align: center;">
				<button id="feedback-btn-next" type="button" class="btn btn-sm blue">Next</button>
			</div>
		</div>
		<div class="col-md-10" id="feedback-tab-2">
			<!-- BEGIN PORTLET -->
			<div class="portlet light " style="background-color:white;">
				<div class="portlet-title">
					<div class="caption caption-md">
						<i class="icon-bar-chart theme-font hide"></i>
						<span class="caption-subject feedback-content-title">Using Jobtip is...</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="btn-toolbar margin-bottom-10">
						<div data-toggle="buttons">
						  <label class="btn btn-primary btn-circle-hard" style="line-height:3.3;">
						    <input type="radio" name="usability" value="Hard" class="toggle"> Hard
						  </label>
						  <label class="btn btn-primary btn-circle-okay" style="line-height:3.3;">
						    <input type="radio" name="usability" value="Okay" class="toggle btn btn-circlenew1 btn-default"> Okay
						  </label>
						  <label class="btn btn-primary btn-circle-easy" style="line-height:3.3;">
						    <input type="radio" name="usability" value="Easy" class="toggle btn btn-circlenew2 btn-default"> Easy
						  </label>
						</div>
					</div>
				</div>
			</div>
			<!-- END PORTLET -->
			<!-- BEGIN PORTLET -->
			<div class="portlet light " style="background-color:white;">
				<div class="portlet-title">
					<div class="caption caption-md">
						<i class="icon-bar-chart theme-font hide"></i>
						<span class="caption-subject feedback-content-title">Tell us about your experience with us</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="stars">
					    <input class="star star-5 " id="star-5" type="radio" checked value="5" name="experience"/>
					    <label class="star star-5 er5" for="star-5"></label>
					    <input class="star star-4 " id="star-4" type="radio" value="4" name="experience"/>
					    <label class="star star-4 er4" for="star-4"></label>
					    <input class="star star-3 " id="star-3" type="radio" value="3" name="experience"/>
					    <label class="star star-3 er3" for="star-3"></label>
					    <input class="star star-2 " id="star-2" type="radio" value="2" name="experience"/>
					    <label class="star star-2 er2" for="star-2"></label>
					    <input class="star star-1 " id="star-1" type="radio" value="1" name="experience"/>
					    <label class="star star-1 er1" for="star-1"></label>
						<label id="e1">Very Bad</label>
						<label id="e2">Bad</label>
						<label id="e3">Okay</label>
						<label id="e4">Good</label>
						<label id="e5">Excellent</label>
					</div>
					
				</div>
			</div>
			<!-- END PORTLET -->
			<!-- BEGIN PORTLET -->
			<div class="portlet light " style="background-color:white;">
				<div class="portlet-title">
					<div class="caption caption-md">
						<i class="icon-bar-chart theme-font hide"></i>
						<span class="caption-subject feedback-content-title">Anything else, you wanted to share with us</span>
					</div>
				</div>
				<div class="portlet-body">
					<textarea class="form-control" name="comments" rows="3" placeholder="Comments..."></textarea>
				</div>
			</div>
			<!-- END PORTLET -->
			<!-- BEGIN PORTLET -->
			<div class="portlet light " style="background-color:white;">
				<div class="portlet-title">
					<div class="caption caption-md">
						<i class="icon-bar-chart theme-font hide"></i>
						<span class="caption-subject feedback-content-title">Contact</span>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row" style="margin:0 0px">
						<div class="col-md-6 col-sm-6 col-xs-12">
	                    	<label class=" control-label">Feedback User</label>
	                    	<div class="form-group">
					            <div class="input-group">
					                <div class="md-radio-inline">
					                    <div class="md-radio">
					                        <input type="radio"  id="radio8" data-title="People" name="feedback_user" value="People" class="md-radiobtn">
					                        <label for="radio8" style="">
					                        <span></span>
					                        <span class="check"></span>
					                        <span class="box"></span>
					                        People </label>
					                    </div>
					                    <div class="md-radio">
					                        <input type="radio" checked id="radio9" data-title="Company" name="feedback_user" value="Company" class="md-radiobtn">
					                        <label for="radio9" style="">
					                        <span></span>
					                        <span class="check"></span>
					                        <span class="box"></span>
					                       Company</label>
					                    </div>
					                </div>  
					                <div id="radio_error"></div>                    <!-- /input-group -->
					            </div>
					        </div>
	                    </div>
					</div>
					<div class="row" style="margin:0 0px">
		                <div class="col-md-6 col-sm-6">
		                    <div class="form-group">
		                        <label>Email Id</label>
		                        <div class="input-group">
		                        <span class="input-group-addon" style="background-color: transparent;">
		                        <i class="icon-envelope" style="color:#45b6af;"></i>
		                        
		                        </span>
		                        <input type="text" name="email_id" class="form-control group" placeholder="Email Id" style="color: white;">
		                        </div>
		                    </div>
		                </div>
		                <!--/span-->
		                <!-- <div class="col-md-2"></div> -->
		                <div class="col-md-6 col-sm-6">
		                    <div class="form-group">
		                        <label>Phone No</label>
		                        <div class="input-group">
		                        <span class="input-group-addon">
		                        <i class="icon-call-end" style="color:#45b6af;"></i>
		                        </span>
		                        <input type="text" name="phone" minlength="10" maxlength="10"  class="form-control group" placeholder="Phone No" style="color: white;">
		                        
		                        </div>
		                    </div>
		                </div>
		                <!--/span-->
		            </div>
				</div>
			</div>
			<!-- END PORTLET -->
			<div class="form-actions" style="text-align: center;">
				<button id="feedback-btn-back" type="button" class="btn btn-sm grey">Back</button>
				<button type="submit" class="btn btn-sm green"><i class="fa fa-check"></i> Submit</button>
			</div>
		</div>
	</form>
</div>
@stop

@section('javascript')

<script>
	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#feedback-btn-next").click(function(){
			$("#feedback-tab-2").show();
			$("#feedback-tab-1").hide();
			$('html, body').animate({
				scrollTop: 0
			}, 700);
			return false;
		});

		$("#feedback-btn-back").click(function(){
			$("#feedback-tab-1").show();
			$("#feedback-tab-2").hide();
			$('html, body').animate({
				scrollTop: 0
			}, 700);
			return false;
		});
	});
</script>
<script type="text/javascript">
	$(function() {
      $(".feedback-notification").delay(5000).fadeOut();
    });
</script>
<script type="text/javascript">
	$('.er1').hover(function(){
		$('#e1').css({'display':'block'});
		}, function(){
        $('#e1').css({'display':'none'});
	});
	$('.er2').hover(function(){
		$('#e2').css({'display':'block'});
		}, function(){
        $('#e2').css({'display':'none'});
	});
	$('.er3').hover(function(){
		$('#e3').css({'display':'block'});
		}, function(){
        $('#e3').css({'display':'none'});
	});
	$('.er4').hover(function(){
		$('#e4').css({'display':'block'});
		}, function(){
        $('#e4').css({'display':'none'});
	});
	$('.er5').hover(function(){
		$('#e5').css({'display':'block'});
		}, function(){
        $('#e5').css({'display':'none'});
	});

	$('.star-1').click(function(){
		$('#e1').css({'display':'block'});
		
	});
	$('.star-2').click(function(){
		$('#e2').css({'display':'block'});
		
	});
	$('.star-3').click(function(){
		$('#e3').css({'display':'block'});
		
	});
	$('.star-4').click(function(){
		$('#e4').css({'display':'block'});
		
	});
	$('.star-5').click(function(){
		$('#e5').css({'display':'block'});
		
	});

</script>
<script type="text/javascript">
	$(document).ready(function () {            
//validation rules
    var form = $('#feedback_welcome');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);
    form.validate({
        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        groups: {
            name: "email_id phone"
        },
        rules: {
           promotion: {
              required: true
            },
            device_info: {
            	required: true
            },
            "concerns[]": {
            	required: true
            },
            refer: {
            	required: true
            },
            usability: {
            	required: true
            },
            experience: {
            	required: true
            },
            comments: {
            	required: false,
            	minlength: 20,
                maxlength: 200
            },
            feedback_user: {
            	required: true
            },
            email_id: {
                email: true,
                require_from_group: [1, '.group']
            },
            phone: {
                number: true,
                maxlength: 10,
                require_from_group: [1, '.group']
            }
        },

        messages: {
                promotion: {
                    required: "Select any one"
                },

                device_info: {
                    required: "Select you use mostly to access the jobtip.in"
                },
                "concerns[]": {
                    required: "Select any one"
                },
                refer: {
                    required: "Select any one"
                },
                usability: {
                    required: "Select any one "
                },
                comments: {
                    minlength: "Enter minimum 20 character",
                    maxlength: "Enter maximum 200 character"
                },
                feedback_user: {
                    required: "Select any one"
                }
          },
             invalidHandler: function (event, validator) { //display error alert on form submit   
            success.hide();
            error.show();
            Metronic.scrollTo(error, -200);
        },
        errorPlacement: function (error, element) { // render error placement for each input type
            var icon = $(element).parent('.input-icon').children('i');
            icon.removeClass('fa-check').addClass("fa-warning");  
            icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
        },

        success: function (label, element) {
            var icon = $(element).parent('.input-icon').children('i');
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
            icon.removeClass("fa-warning").addClass("fa-check");
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