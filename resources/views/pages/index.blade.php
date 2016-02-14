@extends('welcome')

@section('content')

  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start header section -->  
  <header id="header">
    
  </header>
  <!-- End header section -->

  <!-- Start menu section -->
  <section id="menu-area">
    <nav class="navbar navbar-default main-navbar" role="navigation">  
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- LOGO -->                                               
           <a class="navbar-brand logo" href="index.html"><img src="/assets/logo.png" alt="logo"></a>                      
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav main-nav menu-scroll">
            <li class="active"><a href="#home">Home</a></li>
            <li><a href="#search">SEARCH</a></li> 
            <li><a href="#about">ABOUT</a></li> 
            <li><a href="#contact">CONTACT</a></li>
            <li><a href="/login">Login</a></li>                    
 
          </ul>                            
        </div><!--/.nav-collapse -->       
      </div>          
    </nav> 
  </section>
  <!-- End menu section -->
   <!-- Start about section -->
  <section id="home">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!-- Start welcome area -->
          <div class="welcome-area">
            <div class="title-area">
              <h2 class="tittle">Welcome to <span>Job tip</span></h2>
              <span class="tittle-line"></span>
              	
            </div>
            <div class="welcome-content">
            </div>
          </div>
          <!-- End welcome area -->
        </div>
      </div>
    </div>
  </section> 
  <!-- End about section -->

  <!-- Start Team action -->
  <section id="search">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="team-area">
            <div class="title-area">
              <h2 class="tittle">Search</h2>
            </div>
            <!-- Start team content -->
            <div class="team-content">
              
            </div>
            <!-- End team content -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Start Team action -->

  <!-- Start about section -->
  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!-- Start welcome area -->
          <div class="welcome-area">
            <div class="title-area">
              <h2 class="tittle">Welcome to <span>Jobtip</span></h2>
              <span class="tittle-line"></span>
              	<p style="text-align:justify;"> Jobtip.in is India's first website allows people to build network and post job requirements within their closed groups, professional/social friends or with public absolutely for free. We have a huge networking of start-up firms, companies, consulting agencies and recruitment agencies of India who post job vacancies and follow people who apply for the jobs matching their skill set.

					This website empowers people to register and promote their skills and get noticed by lacs of job providers, referral candidates seekers to approach you for hiring.

					Jobtip.in respects individuals data privacy and ensures data protection and data security of its user data.
				</p>
            </div>
            <div class="welcome-content">
              
            </div>
          </div>
          <!-- End welcome area -->
        </div>
      </div>
    </div>
  </section> 
  <!-- End about section -->

  

  <!-- Start Contact section -->
  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="contact-left wow fadeInLeft">
            <h2>Contact with us</h2>
            <address class="single-address">
              <h4>Postal address:</h4>
              <p>PO Box 16122 Collins Street West Victoria 8007 Australia</p>
            </address>
             <address class="single-address">
              <h4>Headquarters:</h4>
              <p>121 King Street, Melbourne Victoria 3000 Australia</p>
            </address>
             <address class="single-address">
              <h4>Phone</h4>
              <p>Phone Number: (123) 456 7890</p>
              <p>Fax Number: (123) 456 7890</p>
            </address>
             <address class="single-address">
              <h4>E-Mail</h4>
              <p>Support: Support@example.com</p>
              <p>Sales: sales@example.com</p>
            </address>
          </div>
        </div>
        <div class="col-md-8 col-sm-6 col-xs-12">
          <div class="contact-right wow fadeInRight">
            <h2>Send a message</h2>
            <form action="" class="contact-form">
              <div class="form-group">                
                <input type="text" class="form-control" placeholder="Name">
              </div>
              <div class="form-group">                
                <input type="email" class="form-control" placeholder="Enter Email">
              </div>              
              <div class="form-group">
                <textarea class="form-control"></textarea>
              </div>
              <button type="submit" data-text="SUBMIT" class="button button-default"><span>SUBMIT</span></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact section -->

  <!-- Start Footer -->    
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="footer-top-area">             
                <a class="footer-logo" href="#"><img src="" alt="Logo"></a>              
              <div class="footer-social">
                <a class="facebook" href="#"><span class="fa fa-facebook"></span></a>
                <a class="google-plus" href="#"><span class="fa fa-google-plus"></span></a>
                <a class="linkedin" href="#"><span class="fa fa-linkedin"></span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>Designed by <a href="http://jobtip.in/">Jobtip.in &copy; 2016</a></p>
    </div>
  </footer>
  <!-- End Footer -->

@stop

@section('javascript')

<script type="text/javascript">

$(document).ready(function(){
	
    jQuery('.show-welcome-detail').on('click', function(event) {
	    jQuery('.welcome-detail').show();
	    jQuery('.show-welcome-detail').hide();
	    jQuery('.show-credential').hide();
    });
});

 (function(){

    // List your words here:
    var words = [
        'Searching for right job',
        'Add your skills here',
        'Do you know about any job openings',
        'post Job tip here',
        'Create a group of your friends',
        'share job info among your friends'
        ], i = 0;

    setInterval(function(){
        $('#changerificwordspanid').fadeOut(function(){
            $(this).html(words[i=(i+1)%words.length]).fadeIn();
        });
       // 2 seconds
    }, 3000);

})();

// Myactivity-post

$(document).ready(function(){
  $('.welcome-posts').on('click',function(event){  	    
    	event.preventDefault();
    	var post_id = $(this).parent().data('wpostid');
    	
    	// console.log(post_id);
      $.ajaxSetup({
  		headers: {
  			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		}
  	});

      $.ajax({
        url: "/welcome/postdetails",
        type: "post",
        data: {postid: post_id},
        cache : false,
        success: function(data){
      	$('#welcome-posts-content').html(data);
      	$('#welcome-posts').modal('show');
        }
      }); 
      return false;
  });
});

</script>

@stop