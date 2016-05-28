<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Jobtip - Login</title>

<!-- not cachable -->
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">

<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta name="keywords" content="job, jobs,skill, skills, opening, job opening, vacancy, requirement, naukri, monster, job search, searching job, post job for free, free job posting, work, refer job, job reference, promote skill, jobs in..., hire, fresher, experience, job info, hiring, recruitment, walk in jobs" />  
<meta name="Description" CONTENT="Jobtip -where jobs follow you">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="cache-control" content="private, max-age=0, no-cache">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0">
<!-- csrf_token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="/assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="/assets/custom_admin.css" rel="stylesheet"/>


<link href="/assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<!-- <link href="/assets/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/> -->
<!-- <link href="/assets/global/plugins/icheck/skins/all.css" rel="stylesheet"/> -->
<link href="/assets/css/custom.css" rel="stylesheet"/>
<link href="/assets/css/custom_new.css" rel="stylesheet"/>
<link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">


<!-- new css -->

<!-- BEGIN THEME STYLES -->
<link href="/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="/assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css"/>
<!-- <link id="style_color" href="/assets/admin/layout3/css/themes/grey.css" rel="stylesheet" type="text/css"/> -->
<link href="/assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/custom.css" rel="stylesheet"/>
<link href="/assets/css/custom_new.css" rel="stylesheet"/>
<link href="/assets/css/normalize-content.css" rel="stylesheet"/>
<script src="/assets/global/plugins/autosize/autosize.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL STYLES -->
<link href="/assets/global/plugins/icheck/skins/all.css" rel="stylesheet"/>

<link href="/assets/global/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"/>

<link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="/assets/component-btn.css"/>

<!-- end new css -->














<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<style type="text/css" rel="stylesheet">
body{
  background-color: whitesmoke;

 /* background-attachment: fixed;
  background-image: url('/assets/admin/pages/media/bg/2.jpg');
  background-repeat: no-repeat;*/
}
.decorated{
     overflow: hidden;
     text-align: center;
   
 }
.decorated > span{
    position: relative;
    display: inline-block;
}
.decorated > span:before, .decorated > span:after{
    content: '';
    position: absolute;
    top: 50%;
    border-bottom: 1px solid;
    width: 592px; /* half of limiter */
    margin: 0 20px;
}
.decorated > span:before{
    right: 100%;
}
.decorated > span:after{
    left: 100%;
}

.login-signup-button{
  background-color: #CA4E4E;
  border: 1px solid #C76B6B;
  color: white !important;
}

.login-signup-button:hover, .login-signup-button.hover{
  border: 1px solid #902B2B;
  background-color: #B53030;
  color: white ;
}

.login-signup-button:active, .login-signup-button.active{
    color: #EFECEC !important;
    background-color: #E28B8B;
}

.forget-password-header{
    margin: 50px 0 20px 0;
    color: #949387;
    font-size: 20px;
    text-shadow: 0px 1px 0px #626292;
}

*::-webkit-input-placeholder {
color:dimgrey !important;
font-family: !important;
font-size:14px !important;
}
*:-moz-placeholder {
color:dimgrey !important;
font-size:14px !important;
}
*::-moz-placeholder {
color:dimgrey !important;
font-size:14px !important;
}
*:-ms-input-placeholder !important{
color:dimgrey !important;
font-size:14px !important;
}
input:focus::-webkit-input-placeholder { color:dimgrey !important; }
input:focus:-moz-placeholder { color:dimgrey !important; } /* FF 4-18 */
input:focus::-moz-placeholder { color:dimgrey !important; } /* FF 19+ */
input:focus:-ms-input-placeholder { color:dimgrey !important; } /* IE 10+ */

.login-input-bg-color{
        background-color: #eee !important;
}

.login-tabopen{
    display: none ;
}
@media (min-width: 490px) {
  .signup-button{
      position: absolute;
      top: 0px !important;
      right: 0;  

  }
}

@media (max-width: 520px) {
  .signup-button{
      position: absolute;
      top: -48px;
      right: 0;

  }
}
</style>
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login" style="overflow-y:scroll">

@include('includes.analyticstracking')
<!-- BEGIN HEADER -->
<div class="page-header">
  <!-- BEGIN HEADER TOP -->
  <div class="page-header-top">
    <div class="container" >
      <!-- BEGIN LOGO -->
      <div class="page-logo">
       <a class="" href="/login"><img src="/assets/logo.png" class="big-logo" />
          <img src="/assets/small-logo.png" class="small-logo" />  </a>
      </div>
      <!-- END LOGO -->
      <!-- BEGIN RESPONSIVE MENU TOGGLER -->
      <a href="javascript:;" class="menu-toggler"></a>
      <!-- END RESPONSIVE MENU TOGGLER -->
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="top-menu-login">
        <ul class="nav navbar-nav pull-right">        
        <!-- BEGIN USER LOGIN DROPDOWN -->
          <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
          <li class="@if($title == 'Post_details') show @else hide @endif">
            <div class="signup-tabopen">
              <a href="/login" id="signup-tabopen" style="padding-bottom: 11px;padding-top: 11px;background-color: transparent;">
              <button class="btn welcome-signup-css" style="">
                Login
              </button>
              </a>
            </div>
          </li>
          <li>
            <div class="signup-tabopen">
              <a class="@if($title == 'login') show @else hide @endif" id="signup-tabopen" style="padding-bottom: 11px;padding-top: 11px;background-color: transparent;">
              <button class="btn welcome-signup-css signup-button" style="">
                Sign Up
              </button>
              </a>
            </div>
          </li>
          <li >
            <div class="login-tabopen">
              <a class="@if($title == 'login') show @else hide @endif" id="login-tabopen" style="padding-bottom: 11px;padding-top: 11px;background-color: transparent;">
              <button class="btn welcome-signup-css signup-button" style="">
                Login Now
              </button>
              </a>
            </div>
          </li>
          <li >
            <div class="login-otp-tabopen">
              <a class="@if($title == 'login') show @else hide @endif" id="login-otp-tabopen" style="padding-bottom: 11px;padding-top: 11px;background-color: transparent;">
              <button class="btn welcome-signup-css signup-button" style="">
                Login Now
              </button>
              </a>
            </div>
          </li>
        </ul>
      </div>
      <!-- END TOP NAVIGATION MENU -->
    </div>
  </div>
  <!-- END HEADER TOP -->
  <!-- BEGIN HEADER MENU -->
  <div class="page-header-menu">
    <div class="container" >
     
      <!-- BEGIN MEGA MENU -->
      <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
      <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
      <div class="hor-menu ">
        <ul class="nav navbar-nav" style="padding:0;">
          <li>
            <a href="/"><i class="icon-cup"></i> Welcome</a>
          </li>
          <li>
            <a href="/"> <i class="icon-basket"></i> Post Job</a>
          </li>
          <li>
            <a href="/"><i class="icon-basket"></i> Promote Skill</a>
          </li>
          <li class="@if($title == 'Feedback') active @endif ">
            <a href="/feedback/welcome"><i class="icon-diamond"></i> Feedback</a>
          </li>
          <li>
            <a href="/"><i class="icon-speech"></i> About</a>
          </li>
          <li>
            <a href="/"><i class="icon-info"></i> Contact</a>
          </li>
          <li class="@if($title == 'login') active @endif">
            <a href="/login"><i class="icon-login"></i> Login</a>
          </li>
        </ul>
      </div>
      <!-- END MEGA MENU -->
    </div>
  </div>
  <!-- END HEADER MENU -->
</div>
<!-- END HEADER -->

<div class="clearfix"></div>

<div class="container" style="padding: 0 !important;">

  <!-- BEGIN CONTAINER -->
  <div class="page-container">
    
    

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
      <div class="page-content clearfix">

        <!-- customizer -->

        <div class="page-content-body" style="margin:0px;">
        @yield('content')
        </div>

      </div>
      <!-- BEGIN CONTENT -->
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
    <!--Cooming Soon...-->
    <!-- END QUICK SIDEBAR -->
  </div>
  <!-- END CONTAINER -->

  
</div>

<!-- BEGIN LOGO -->
<!-- <div class="container display-content">
   
</div> -->

@include('includes.footer')

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- <script src="/assets/global/plugins/jquery-validation/js/additional-methods.js" type="text/javascript"></script> -->
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<!-- <script src="/assets/admin/pages/scripts/form-validation.js"></script> -->
<script src="/assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/assets/admin/pages/scripts/login.js" type="text/javascript"></script>
<script src="/assets/admin/pages/scripts/form-icheck.js"></script>
<script src="/assets/admin/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="/assets/admin/layout2/scripts/demo.js" type="text/javascript"></script>
<script src="/assets/global/plugins/icheck/icheck.min.js"></script>
<script src="/assets/admin/pages/scripts/ui-extended-modals.js"></script>
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56afb9b6a3affa13" async="async"></script>
<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script type="text/javascript">
      var verifyCallback = function(response) {
        alert(response);
      };
      var widgetId1;
      var widgetId2;
      var onloadCallback = function() {
        // Renders the HTML element with id 'example1' as a reCAPTCHA widget.
        // The id of the reCAPTCHA widget is assigned to 'widgetId1'.
        widgetId1 = grecaptcha.render('example1', {
          'sitekey' : '6Ld6UB0TAAAAAJEd1MycAu-5sg-WYCwUgIeIQ0h_',
          'theme' : 'light'
        });
        widgetId2 = grecaptcha.render(document.getElementById('example2'), {
          'sitekey' : '6Ld6UB0TAAAAAJEd1MycAu-5sg-WYCwUgIeIQ0h_',
          'theme' : 'dark'
        });
      };
    </script>

<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
        var RecaptchaOptions = {
           theme : 'custom',
           custom_theme_widget: 'recaptcha_widget'
        };
    </script>
@yield('javascript')

<script>
jQuery(document).ready(function() {
  Metronic.init(); // init metronic core components
  Layout.init(); // init current layout
  Login.init();
  Demo.init(); // init demo features
  UIExtendedModals.init();
  // FormValidation.init();
});


$(document).ready(function() {

    jQuery('#signup-tabopen').on('click', function(event) {
        jQuery('.corporate-register-tab').toggle('show');
        jQuery('.login-tag').toggle('hide');
        jQuery('.signup-tabopen').hide();
        jQuery('.login-tabopen').show();
        jQuery('.login-otp-tabopen').hide();
    });
    jQuery('#login-tabopen').on('click', function(event) {
        jQuery('.corporate-register-tab').toggle('hide');
        jQuery('.login-tag').toggle('show');
        jQuery('.signup-tabopen').show();
        jQuery('.login-tabopen').hide();
        jQuery('.login-otp-tabopen').hide();
    });
    jQuery('#login-otp-tabopen').on('click', function(event) {
        // jQuery('.corporate-register-tab').toggle('hide');
        jQuery('.login-tag').toggle('show');
        jQuery('.signup-tabopen').show();
        jQuery('.login-tabopen').hide();
        jQuery('.login-otp-tabopen').hide();
        jQuery('#mobile-otp-form').hide();
    });
  });
</script>
<script>
$(document).ready(function () {            
//validation rules
    var form = $('#forget-password-val');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);
    form.validate({
        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            password: {
              required: true,
              minlength: 6
            },
            password_confirmation: {
              required: true,
              equalTo: "#new_password"
            }
        },
        messages: {
            password: {
              required: 'Enter new Password'
            },
            password_confirmation:{
              required: 'Enter same password'
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
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>