<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Welcome</title>
<link rel="shortcut icon" type="image/icon" href="assets/images/favicon.ico"/>
    <!-- Font Awesome -->
    <link href="assets/welcome-code/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="assets/welcome-code/css/bootstrap.css" rel="stylesheet">
    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="assets/welcome-code/css/slick.css"/> 
    <!-- Fancybox slider -->
    <link rel="stylesheet" href="assets/welcome-code/css/jquery.fancybox.css" type="text/css" media="screen" /> 
    <!-- Animate css -->
    <link rel="stylesheet" type="text/css" href="assets/welcome-code/css/animate.css"/>  
     <!-- Theme color -->
    <link id="switcher" href="assets/welcome-code/css/theme-color/default.css" rel="stylesheet">

    <!-- Main Style -->
    <link href="assets/welcome-code/style.css" rel="stylesheet">

    <!-- Fonts -->
    <!-- Open Sans for body font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- Raleway for Title -->
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <!-- Pacifico for 404 page   -->
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
<style type="text/css" rel="stylesheet">
  body{
  background-attachment: fixed;
  background-image: url('/assets/admin/pages/media/bg/bg.jpg');
  background-repeat: no-repeat;
}
</style>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

@include('includes.analyticstracking')

	<div class="display-content">
    
	@yield('content')
	</div>

	<!-- Scripts -->
	<!-- <<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<script src="{{ asset('/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/global/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <!-- Bootstrap -->
<script src="assets/welcome-code/js/bootstrap.js"></script>
  <!-- Slick Slider -->
<script type="text/javascript" src="assets/welcome-code/js/slick.js"></script>
  <!-- Counter -->
<script type="text/javascript" src="assets/welcome-code/js/waypoints.js"></script>
<script type="text/javascript" src="assets/welcome-code/js/jquery.counterup.js"></script>
  <!-- mixit slider -->
<script type="text/javascript" src="assets/welcome-code/js/jquery.mixitup.js"></script>
  <!-- Add fancyBox -->        
<script type="text/javascript" src="assets/welcome-code/js/jquery.fancybox.pack.js"></script>
  <!-- Wow animation -->
<script type="text/javascript" src="assets/welcome-code/js/wow.js"></script> 

  <!-- Custom js -->
<script type="text/javascript" src="assets/welcome-code/js/custom.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

@yield('javascript')
</body>
</html>
