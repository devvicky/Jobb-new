@extends('welcome')

@section('content')

<!-- Start Header Section -->
    <header id="header">
      <nav class="main-navigation navbar-fixed-top" role="navigation" data-spy="affix" data-offset-top="200">
        <div class="container" style="padding: 0 0px 0 10px;margin: 0 0px 0 0px;">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <i class="fa fa-bars fa-lg" style="color: #9A9A9A;"></i>
            </button>
            <!-- logo here -->
            <a href="/" class="navbar-brand"><img src="/assets/startup/img/2logo.png" alt="logo" style="width:80%;"></a>
          </div>
          
          <!-- Start Navigation Menu -->
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right" id="main_navigation_menu">
              <li class="active"><a href="#header">Home</a></li>
              <li><a href="#services">Services</a></li>
              <li><a href="#about">About</a></li>                   
              <li><a href="#search">Search</a></li>
              <!-- <li><a href="#why-chose">why</a></li>             
              <li><a href="#pricing">Pricing</a></li>
              <li><a href="#blog">Blog</a></li>
              <li><a href="#team">Team</a></li> -->
              <li><a href="#contact">Contact</a></li>
              <li><a href="/login">Login</a></li>
            </ul>
          </div>
          <!-- End Navigation Menu -->
        </div>
      </nav>
    </header>
    <!-- End Header Section -->
    
    <!-- Start Intro Section -->
    <section id="intro" class="section-intro">
      <div class="overlay">
        <div class="container">
          <div class="row">
            <div class="main-text">
              <h1 class="wow" style="">Welcome To <span>Jobtip</span></h1>

                <div id="slide" class="owl-carousel" style="margin: 0px 0 30px 0;">
                  <div class="item">
                    <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:600;">
                        Know about any job openings ?</span>
                    </div>
                    <div class="row side-right">
                      <div class="tile-position-new">
                        <div class="tile bg-red-intense">
                          
                          <div class="tile-body box-welcome" style="text-align:center;">
                            <a href="/login">
                                <img class="img job-skill-width" src="/assets/admin/pages/media/bg/job.png">
                            </a>
                          </div>
                          <div class="tile-object">
                            <div class="con side-right" style="">
                              <span id="" class="uppercase new-css" style="font-weight:600;">Post Job tip</span>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:600;">help your friends to get a job</span>
                    </div>
                  </div>
                  <div class="item">
                    <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:600;">
                        looking for job change ?</span>
                    </div>
                    <div class="row side-right">
                      <div class="tile-position-new">
                        <div class="tile bg-red-intense">
                          
                          <div class="tile-body box-welcome" style="text-align:center;">
                            <a href="/login">
                                <img class="img job-skill-width" src="/assets/admin/pages/media/bg/skill.png">
                            </a>
                          </div>
                          <div class="tile-object">
                            <div class='con'>
                              <span id="" class="uppercase new-css" style="font-weight:600;">promote skills</span>
                            </div>
                             
                          </div>
                          <div class="tile-object">
                           
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:600;">choose where you want to work</span>
                    </div>
                  </div>
                  <div class="item">
                    <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:600;">
                        looking skilled people for startup ?</span>
                    </div>
                    <div class="row side-right">
                      <div class="tile-position-new">
                        <div class="tile bg-red-intense">
                          
                          <div class="tile-body box-welcome" style="text-align:center;">
                            <a href="/login">
                                <img class="img job-skill-width" src="/assets/admin/pages/media/bg/job.png">
                            </a>
                          </div>
                          <div class="tile-object">
                            <div class='con'>
                              <span id="" class="uppercase new-css" style="font-weight:600;">Post Job tip</span>
                            </div>
                            
                          </div>
                          <div class="tile-object">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:600;">hire right talent to grow business</span>
                    </div>
                  </div>

                  <div class="item">
                    <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:600;">
                       ready to work ?</span>
                    </div>
                    <div class="row side-right">
                      <div class="tile-position-new">
                        <div class="tile bg-red-intense">
                          
                          <div class="tile-body box-welcome" style="text-align:center;">
                            <a href="/login">
                                <img class="img job-skill-width" src="/assets/admin/pages/media/bg/skill.png">
                            </a>
                          </div>
                          <div class="tile-object">
                            <div class='con' >
                              <span id="" class="uppercase new-css" style="font-weight:600;">promote skills</span>
                            </div>
                           
                          </div>
                          <div class="tile-object">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                     <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:600;">get right pay for your talent</span>
                    </div>
                  </div>
                </div>
                <!-- <div class="row" style="margin:0 auto;display:table;">
                  <div class='con'>
                    <span id="changerificwordspanbelowid" class="uppercase new-css" style="font-weight:600;">help your friends to get a job</span>
                  </div>
                </div> -->
              <!-- <div class="wow fadeInUp" data-wow-delay="1.5s"><a onclick="smoothScr.anim('services')" class="btn btn-border btn-lg"><i class="fa fa-spinner fa-spin"></i> Explore</a></div> -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Intro Section -->

    <!-- Start Services Section -->
    <section id="services">
      <div class="container">
        <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>Why</span> Jobtip</h1>
        <div class="row">
          <div class="col-sm-6 col-md-3 wow fadeInUp">
            <div class="service-box">
              <div class="content" style="height: 288px;">
                <div class="icon-wrapper">
                <i class="fa fa-users"></i>
                </div>
                <h2>Tag Job Tip</h2>
                <p>Why opportunities should be always announced publicly?<br/><br/>
                  Create professional links and closed groups and share job vacancies among them.
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 wow fadeInUp">
            <div class="service-box">
              <div class="content" style="height: 288px;">
                <div class="icon-wrapper">
                <i class="fa fa-cogs"></i>
                </div>
                <h2>Promote skills</h2>
                <p>Fed up of not getting job opportunities for your matching skills?<br/><br/>
                  Post your skills here for free and get direct call from thousands of startups, companies and recruitment agencies.
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 wow fadeInUp" data-wow-delay=".2s" data-wow-offset="10">
            <div class="service-box">
              <div class="content" style="height: 288px;">
                <div class="icon-wrapper">
                <i class="fa fa-search"></i>
                </div>
                <h2>Search Talents</h2>
                <p>Planning to start a business/startup and stuck due to resource unavailability?<br/><br/>
                  Lacs of highly talented people looking for Free Lancers, Work From Home, Full/Part Time jobs here.
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 wow fadeInUp" data-wow-delay=".4s" data-wow-offset="10">
            <div class="service-box">
              <div class="content" style="height: 288px;">
                <div class="icon-wrapper">
                <i class="fa fa-edit"></i>
                </div>
                <h2>Post Job Tips</h2>
                <p>Dependent on companies/Job consulting firms to post job openings?<br/><br/>
                  If you know about any Job openings/referral, Post Job Tip here for free and help your friends, colleagues to find a suitable job.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Services Section-->
    
    <!-- Start About Us Section -->
    <section id="about" class="about-section" style="height:650px;">
      <div class="container">
      <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>About</span> Us</h1>
        <div class="row">
         <!--  <div id="slider" class="owl-carousel">
            <div class="item"> -->
              <div class="col-sm-12 col-md-12 wow fadeInRight" data-wow-offset="10">
                <div class="side-right">
                  <p>
                  Jobtip.in is India's first website allows people to build network and post job requirements within their closed groups, professional/social friends or with public absolutely for free. We have a huge networking of start-up firms, companies, consulting agencies and recruitment agencies of India who post job vacancies and follow people who apply for the jobs matching their skill set.

         <br/> This website empowers people to register and promote their skills and get noticed by lacs of job providers, referral candidates seekers to approach you for hiring.

          Jobtip.in respects individuals data privacy and ensures data protection and data security of its user data.</p>
                  <!-- <a href="#" class="btn btn-border"><i class="fa fa-shopping-cart"></i> Hire Me</a>
                  <a href="#" class="btn btn-border"><i class="fa fa-download"></i> Download Resume</a> -->
                </div>
              </div>
            <!-- </div>
          </div> -->
        </div>
      </div>
    </section>
    <!-- End About Us Section -->   

    <!-- Start About Us Section -->
    <section id="search" class="about-section" style="height:650px; background-color:darkcyan;">
      <div class="container">
      <h1 class="section-title wow fadeIn search-header-css" data-wow-delay=".2s" >Search <span>Job tip</span></h1>
        <div class="row">
         <!--  <div id="slider" class="owl-carousel">
            <div class="item"> -->
              <div class="col-sm-12 col-md-12 wow fadeInRight" data-wow-offset="10">
                <div class="side-right">
                  <!-- Start welcome area -->
                <div class="row" style="margin: 0 -10px 0 5px !important;">
                  <!-- <div class="col-md-2 col-sm-1"></div> -->
                    <div class="col-md-12 col-sm-10">
                    <form id="welcome-search" name="welcome_form" action="/welcome/post" method="post">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="col-md-5 col-sm-5" style="padding-left:0 !important;">
                        <div class=" form-group">
                          <div class="input-group">
                            <span class="input-group-addon welcome-icon">
                              <i class="fa fa-cogs" style="color:white;"></i>
                            </span>
                            <input type="text" required name="role" id="search-input" class="form-control welcome-inputbox" placeholder="Enter Job role">
                          </div>
                        </div>    
                      </div>
                      
                      <div id="welcome-city" class="col-md-4 col-sm-4 col-xs-6" style="padding-left:0 !important;">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon welcome-icon">
                              <i class="fa fa-map-marker" style="color:white;"></i>
                            </span>
                            <input type="text" name="location" class="form-control welcome-inputbox" placeholder="City">                    
                          </div>  
                        </div>    
                      </div>
                      <div class="col-md-2 col-sm-3 col-xs-6" style="padding-left:0 !important;">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon welcome-icon">
                              <i class="fa fa-briefcase" style="color:white;"></i>
                            </span>
                            <select class="form-control welcome-inputbox" name="experience" placeholder="Experience">
                              <option value=""> Exp (in Years)</option>
                              <option value="0">0</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                              <option value="13">13</option>
                              <option value="14">14</option>
                              <option value="15">15</option>
                            </select>
                          </div>
                        </div>  
                      </div>
                      <div class="col-md-1 col-sm-12 col-xs-12" style="padding-left:0 !important;text-align:center;">
                        <button type="submit" class="btn btn-small-welcome btn-search-welcome search-button-size" style="margin: -1px;padding: 7px 10px;width: 100%;">
                          <i class="fa fa-search"></i>
                          
                            <!-- Search -->
                          
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
        <!-- End welcome area -->
                </div>
              </div>
            <!-- </div>
          </div> -->
        </div>
      </div>
    </section>
    <!-- End About Us Section -->   
    
    <!-- Start Contact Section -->
    <section id="contact">
      <div class="overlay">
        <div class="container">
        <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>Contact</span> Us</h1>
          <div class="row">
            <div class="contact-form">
              <form action="/contact" role="form" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-sm-6 col-md-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="controls">
                      <input class="contact_input" type="text" name="name" placeholder="Name">
                      <i class="fa fa-user"></i>
                    </div>
                    <div class="controls">
                      <input class="contact_input" type="text" name="email" placeholder="Email">
                      <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="controls">
                      <input class="contact_input" type="text" name="phone" placeholder="Phone">
                      <i class="fa fa-phone"></i>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 wow fadeInRight" data-wow-delay="0.2s">
                    <textarea name="message" rows="7" class="form-control" placeholder="Message"></textarea>
                </div>
                <div class="col-sm-6 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                  <button type="submit" id="submit" class="btn btn-common">Send</button>
                </div>
              </form>
            </div>
          </div>
        </div>  
      </div>
    </section>
    <!-- End Contact Section -->
    
    <!-- Start Clients Section -->
    <!-- <section id="clients">
      <div class="container">
        <div class="row">
          <div id="logo-slider" class="owl-carousel owl-theme">
            <div class="item">
              <a href="#"><img src="assets/startup/img/clients-logo/img1.png" alt=""></a>
            </div>
            <div class="item">
              <a href="#"><img src="assets/startup/img/clients-logo/img2.png" alt=""></a>
            </div>
            <div class="item">
              <a href="#"><img src="assets/startup/img/clients-logo/img3.png" alt=""></a>
            </div>
            <div class="item">
              <a href="#"><img src="assets/startup/img/clients-logo/img4.png" alt=""></a>
            </div>
            <div class="item">
              <a href="#"><img src="assets/startup/img/clients-logo/img5.png" alt=""></a>
            </div>
            <div class="item">
              <a href="#"><img src="assets/startup/img/clients-logo/img6.png" alt=""></a>
            </div>
            <div class="item">
              <a href="#"><img src="assets/startup/img/clients-logo/img7.png" alt=""></a>
            </div>
            <div class="item">
              <a href="#"><img src="assets/startup/img/clients-logo/img8.png" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <!-- End Clients Section -->
    
    <!-- Start Connected Section -->
    <section id="connected">
      <div class="container">
        <div class="row">
          <h2 class="section-title wow fadeInUp" data-wow-delay=".2s">Stay Connected</h2>   
          <h3 class="discription wow fadeIn" data-wow-delay=".2s">Jobtip.in is India's first website allows people to build network and post job</h3>
          <hr>
          <div class="connected-wrapper text-center">
            <!-- <div class="col-sm-6 col-md-3 wow fadeInUp" data-wow-delay="0.2s">
              <div class="contact-item">
                <a href="#"><i class="fa fa-phone"></i></a>
                <h5>Customer Care</h5>
                <h4>0123 - 456 - 789</h4>
              </div>
            </div> -->
            <div class="col-sm-6 col-md-3 wow fadeInUp" data-wow-delay="0.2s">
              <div class="contact-item">
                <a href="#"><i class="fa fa-envelope"></i></a>
                <h5>Connect</h5>
                <h4>connect@jobtip.in</h4>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 wow fadeInUp" data-wow-delay="0.2s">
              <div class="contact-item">
                <a href="http://jobtip.in/linkedin"><i class="fa fa-linkedin"></i></a>
                <h5>Linkedin</h5>
                <!-- <h4>@example.com</h4> -->
              </div>
            </div>
            <div class="col-sm-6 col-md-3 wow fadeInUp" data-wow-delay="0.2s">
              <div class="contact-item">
                <a href="http://jobtip.in/facebook"><i class="fa fa-facebook"></i></a>
                <h5>Facebook</h5>
                <!-- <h4>example.agency</h4> -->
              </div>
            </div>
            <div class="col-sm-6 col-md-3 wow fadeInUp" data-wow-delay="0.2s">
              <div class="contact-item">
                <a href="http://jobtip.in/google"><i class="fa fa-google-plus"></i></a>
                <h5>Google +</h5>
                <!-- <h4>@example.com</h4> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Connected Section -->

    <!-- Footer Section Start -->
    <footer id="footer">
      <div class="container">
          <div class="copyright text-center">
            <p>Jobtip.in Copyright &copy; 2016</p>
          </div>
      </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Scroll Top -->
    <div class="scroll-top" data-spy="affix" data-offset-top="300">
      <a href="#header"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- Scroll End -->
@stop

@section('javascript')
<script src="/assets/startup/js/jquery-min.js"></script>
    <!-- Include Bootstrap plugin -->
<script src="/assets/startup/js/bootstrap.min.js"></script>
    <!-- One page Nav plugin -->    
<script src="/assets/startup/js/jquery.nav.js"></script>
    <!-- Include Bootstrap plugin -->
<script src="/assets/startup/js/owl.carousel.js"></script>
    <!-- Include wow plugin -->
<script src="/assets/startup/js/wow.js"></script>
    <!-- Include mixitup plugin -->
<script src="/assets/startup/js/jquery.mixitup.js"></script>
    <!-- ScrollTop -->
<script src="/assets/startup/js/lightbox.min.js"></script>
    <!-- Lightbox -->
<script src="/assets/startup/js/scroll-top.js"></script>
    <!-- Smooth Scroll -->
<script src="/assets/startup/js/smooth-scroll.js"></script>
    <!-- preset js -->
<script src="/assets/startup/js/style.changer.js"></script>
    <!-- Modernizr js -->
<script src="/assets/startup/js/modernizr-2.8.0.main.js"></script>
    <!-- Main js -->
<script src="/assets/startup/js/main.js"></script>
<script type="text/javascript">
 // (function(){

    // List your words here:
 /*   var words = [
        'know about any job openings ?',
        'looking skilled people for startup'.
        'looking for job change ?',
        'ready to work ?'
        ], i = 0;

    setInterval(function(){
        $('#changerificwordspanid').fadeOut(function(){
            $(this).html(words[i=(i+1)%words.length]).fadeIn();
        });
    }, 3000);

})();

(function(){

    var beloWords = [
        'help your friends to get a job',
        'hire right talent to grow business',
        'choose where you want to work',
        'get right pay for your talent'
        ], i = 0;

    setInterval(function(){
        $('#changerificwordspanbelowid').fadeOut(function(){
            $(this).html(beloWords[i=(i+1)%beloWords.length]).fadeIn();
        });
    }, 3000);

})();

(function(){

    var imageWords = [
        'post job tip',
        'promote skills'
        ], i = 0;

    setInterval(function(){
        $('#imageid').fadeOut(function(){
            $(this).html(imageWords[i=(i+1)%imageWords.length]).fadeIn();
        });
    }, 3000);

})();
*/
</script>
<script>

// $(document).ready(function () {
//     $(".nav a, .navbar-nav a").click(function(event) {
//         // check if window is small enough so dropdown is created
//     $("#nav-collapse").removeClass("in").addClass("collapse");
//     });
// });

// $('.nav').click('li', function() {
//     $('.nav').collapse('hide');
// });
</script>
@stop