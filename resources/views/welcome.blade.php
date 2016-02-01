<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome</title>

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ asset('/assets/admin/pages/css/login.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/custom_admin.css') }}" rel="stylesheet"/>

<link href="../../assets/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/css/components-rounded.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
<!-- <link href="{{ asset('/assets/admin/layout2/css/layout.css') }}" rel="stylesheet" type="text/css"/> -->
<!-- <link href="{{ asset('/assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet"/> -->
<link href="{{ asset('/assets/custom.css') }}" rel="stylesheet"/>
<link href="{{ asset('/assets/custom_new.css') }}" rel="stylesheet"/>
<link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
<style type="text/css" rel="stylesheet">
body{
       background-color: #466368;
    /* background-image: url(images/radial_bg.png); */
    background-position: center center;
    background-repeat: no-repeat;
    background: -webkit-gradient(radial, center center, 0, center center, 460, from(#648880), to(#293f50));
    background: -webkit-radial-gradient(circle, #1E4E43, #293f50);
    background: -moz-radial-gradient(circle, #648880, #293f50);
    background: -ms-radial-gradient(circle, #648880, #293f50);
}

/*background: #466368;
  background: linear-gradient(to right bottom, #648880, #293f50);
  border-radius: 6px;
  height: 120px;*/
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

*::-webkit-input-placeholder {
color:#A7D6D6 !important;
font-family: !important;
font-size:14px !important;
}
*:-moz-placeholder {
color:#A7D6D6 !important;
font-size:14px !important;
}
*::-moz-placeholder {
color:#A7D6D6 !important;
font-size:14px !important;
}
*:-ms-input-placeholder !important{
color:#A7D6D6 !important;
font-size:14px !important;
}

.nav>li>a:focus, .nav>li>a:hover {
    text-decoration: none;
     background-color: transparent; 
}


@media (max-width: 570px) {
  .big-logo {
    display: block;
    width: 125px;
    padding: 0px;
    margin: 3px;
}

  .btn-small-welcome{
    padding: 7px 28px;
  }

  .top-menu-welcome{
    margin: -47px 25px !important;
    background-color: transparent !important;
    float: right !important;
  }


.login-button-welcome{
  position: absolute;
    right: -22px;
    top: 0px;
}
  .display-content{
    margin:0px 0;
    width:auto;
  }
}

@media (min-width: 570px) {
  .big-logo {
    display: block;
    width: 125px;
    margin-top: 3px;
    margin-right: 0;
    float: left;
}

.login-button-welcome{
  position: absolute;
    right: 0px;
    top: -11px;
}

  .display-content{
    margin:80px 0;
    width:auto;
  }
}

input:focus::-webkit-input-placeholder { color:transparent !important; }
input:focus:-moz-placeholder { color:transparent !important; } /* FF 4-18 */
input:focus::-moz-placeholder { color:transparent !important; } /* FF 19+ */
input:focus:-ms-input-placeholder { color:transparent !important; } /* IE 10+ */
</style>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="page-header navbar navbar-fixed-top" style="background-color: transparent !important;">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
      <a class="" href="/home"><img src="{{ asset('/assets/new_big_logo.png') }}" class="big-logo" />
     <!--  <div class="menu-toggler sidebar-toggler hide"> -->
        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
      <!-- </div> -->
    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
   <!--  <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
    </a> -->
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="top-menu top-menu-welcome">
     	 <ul class="nav navbar-nav">
	
				<li>
					<a href="{{ url('/login') }}" style="padding-bottom: 11px;padding-top: 11px;">
					<button class="btn welcome-login-css login-button-welcome" style="">
						Login
					</button>
					</a>
				</li>
				<!-- <li><a href="{{ url('/login') }}">Register</a></li> -->

		</ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->

	<div class="container display-content">
    <img class="welcome-bg" src="/assets/admin/pages/media/bg/3.jpg">
	@yield('content')
	</div>

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

@yield('javascript')
</body>
</html>
