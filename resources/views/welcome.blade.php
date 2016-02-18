<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <title>Jobtip - where jobs follow you</title>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <!-- <meta name="keywords" content="job, jobs,skill, skills, opening, job opening, vacancy, requirement, naukri, monster, job search, searching job, post job for free, free job posting, work, refer job, job reference, promote skill, jobs in..., hire, fresher, experience, job info, hiring, recruitment, walk in jobs" />
  <meta name="Description" CONTENT="India's first website allows people to build network and post job requirements within their closed groups and friends. It empowers people to promote their skills.">
 -->  

  <meta name="Description" content="Jobtip.in is India's first website allows people to build network and post job requirements within their closed groups, professional/social friends or with public absolutely for free. We have a huge networking of start-up firms, companies, consulting agencies and recruitment agencies of India who post job vacancies and follow people who apply for the jobs matching their skill set. This website empowers people to register and promote their skills and get noticed by lacs of job providers, referral candidates seekers to approach you for hiring. Jobtip.in respects individuals data privacy and ensures data protection and data security of its user data.">
  <meta name="Keywords" content="job, jobs,skill, skills, opening, job opening, vacancy, requirement, naukri, monster, job search, searching job, post job for free, free job posting, work, refer job, job reference, promote skill, jobs in..., hire, fresher, experience, job info, hiring, recruitment, walk in jobs">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- csrf_token -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />	
<link href="http://fonts.googleapis.com/css?family=Muli" rel="stylesheet" type="text/css" />
  <!-- Bootstrap  -->
<link href="/assets/startup/css/bootstrap.min.css" rel="stylesheet">

  <!-- icon fonts font Awesome -->
<link rel="stylesheet" media="screen" href="/assets/startup/fonts/font-awesome/font-awesome.min.css">
    
  <!-- Custom Styles -->
<link href="{{ asset('/assets/startup/css/style.css') }}" rel="stylesheet">

  <!-- Responsive Styles -->
<link href="/assets/startup/css/responsive.css" rel="stylesheet">
  
  <!-- Normalize Styles -->
<link href="/assets/startup/css/normalize.css" rel="stylesheet">
<link href="/assets/custom.css" rel="stylesheet">
<link href="{{ asset('/assets/custom_new.css') }}" rel="stylesheet"/>
  <!-- Extras -->
<link rel="stylesheet" type="text/css" href="/assets/startup/extras/animate.css">
<link rel="stylesheet" type="text/css" href="/assets/startup/extras/lightbox.css">
<link rel="stylesheet" type="text/css" href="/assets/startup/extras/owl/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="/assets/startup/extras/owl/owl.theme.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/startup/extras/owl/owl.transitions.css') }}">
<style type="text/css">

input:focus::-webkit-input-placeholder { color:white !important; }
input:focus:-moz-placeholder { color:white !important; } /* FF 4-18 */
input:focus::-moz-placeholder { color:white !important; } /* FF 19+ */
input:focus:-ms-input-placeholder { color:white !important; } /* IE 10+ */
</style>
</head>
<body>

  @include('includes.analyticstracking')
  <!-- <div class="container display-content"> -->
    <!-- <img class="welcome-bg" src="/assets/admin/pages/media/bg/bg.jpg"> -->

  @yield('content')
  <!-- </div> -->

<!-- Include jquery.min.js plugin -->

@yield('javascript')
</body>
</html>
