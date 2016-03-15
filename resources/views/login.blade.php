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
  color: white;
}

.login-signup-button:hover, .login-signup-button.hover{
  border: 1px solid #902B2B;
  background-color: #B53030;
  color: white;
}

.login-signup-button:active, .login-signup-button.active{
  color: #D2C8C8 !important; 
  background-color: #B53030;
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
@media (min-width: 570px) {
  .signup-button{
        

  }
}

@media (max-width: 570px) {
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
<div class="page-header navbar navbar-fixed-top" style="background-color: transparent !important;">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
      <a href="/home">
      <img src="/assets/logo.png" alt="logo" class="logo-default" style="width: 150px;margin: 5px 0;" />
      </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
   
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="top-menu">
      <ul class="nav navbar-nav pull-right">        
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li>
          <div class="signup-tabopen">
            <a id="signup-tabopen" style="padding-bottom: 11px;padding-top: 11px;background-color: transparent;">
            <button class="btn welcome-signup-css signup-button" style="">
              Sign Up
            </button>
            </a>
          </div>
        </li>
        <li >
          <div class="login-tabopen">
            <a id="login-tabopen" style="padding-bottom: 11px;padding-top: 11px;background-color: transparent;">
            <button class="btn welcome-signup-css signup-button" style="">
              Login Now
            </button>
            </a>
          </div>
        </li>
        <li >
          <div class="login-otp-tabopen">
            <a id="login-otp-tabopen" style="padding-bottom: 11px;padding-top: 11px;background-color: transparent;">
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
  <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN LOGO -->
<div class="container display-content">
   
  @yield('content')
</div>

<div class="copyright">
   2015 © Jobtip.in
</div>

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
<script src="/assets/global/plugins/jquery-validation/js/additional-methods.js" type="text/javascript"></script>
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
<!-- END PAGE LEVEL SCRIPTS -->

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