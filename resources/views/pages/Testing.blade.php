@extends('welcome')

@section('content')

<!-- Start Header Section -->
    <header id="header">
      <nav class="main-navigation navbar-fixed-top" role="navigation" data-spy="affix" data-offset-top="200">
        <div class="container" style="">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <i class="fa fa-bars fa-lg" style="color: #9A9A9A;"></i>
            </button>
            <!-- logo here -->
            <a href="/" class="navbar-brand"><img src="/assets/logo.png" alt="logo" style="width:50%;"></a>
          </div>
          
          <!-- Start Navigation Menu -->
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right" id="main_navigation_menu">
              <li class="active"><a data-toggle="collapse" data-target=".navbar-collapse" href="#header">Home</a></li>
              <li><a data-toggle="collapse" data-target=".navbar-collapse" href="#feed">Feed</a></li>
              <li><a data-toggle="collapse" data-target=".navbar-collapse" href="#services">Services</a></li>
              <li><a data-toggle="collapse" data-target=".navbar-collapse" href="#about">About</a></li>
              <li><a data-toggle="collapse" data-target=".navbar-collapse" href="#contact">Contact</a></li>
              <li><a data-toggle="collapse" data-target=".navbar-collapse" href="/login">Login</a></li>
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
        <div class="container" style="min-height: 569px;">
          <div class="row">
           <div class="banner-jobtip ">
              <div class="jobtip-caption">
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-6" style="background-color: rgba(26,188,156,.7);    height: 332px;">
                    <div class="banner-jobtip-left">
                      <h1> Know about any job openings ?</h1>
                      <p>Help your friends to get a job. Hire right talent to grow business</p>
                      <a href="/login" class="btn btn-default btn-find-job post-job">Post Job</a>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-6" style="background-color: rgba(66, 139, 202, 0.74);    height: 332px;">
                    <div class="banner-jobtip-right">
                      <h1>looking for job change ?</h1>
                      <p>Choose where you want to work. Get right pay for your talent</p>
                      <a href="/login" class="btn btn-default btn-post-job promote-skill">Promote Skill</a>
                    </div>
                  </div>
                </div><!-- /.row -->
              </div><!-- /.banner-caption -->
            </div><!-- /.container -->
          </div>
        </div>
      </div>
    </section>
    <!-- End Intro Section -->
    <!-- Start Feed Section -->
    <section id="feed" class="news-feed">
      <div class="container">
        <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>Feeds @</span> Jobtip</h1>
        <div class="inner-feed">
          <div class="row">
            <div class="col-md-6" style="border-right: 1px solid #eee;">
              <div class="feed-head">
                <h2 class="feed-title-job">Recently Offered Jobs</h2>

              </div>
              <div class="feed-jobskill-content">
                <!-- <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2"> -->
                    @foreach($jobPosts as $post)
                    <a href="welcome/job/post/{{$post->unique_id}}">
                      <div class="row" style="margin:0;padding-bottom: 10px;"> 
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">                      
                          <div class="welcome-updates-style" style="background-color:white;">
                            <label class="tagged-title" style="cursor: pointer;">
                              {{$post->post_title}} ({{$post->min_exp}} @if($post->max_exp != null) - {{$post->max_exp}} @endif yrs)
                            </label>
                            <br/><label class="tagged-company">@if($post->post_compname != null) {{$post->post_compname}} &nbsp;&nbsp;@endif <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp; {{$post->city}}</label>
                            <br/><label class="job-type-skill-css">{{$post->time_for}}</label>
                            <?php $skills = explode(',', $post->linked_skill); ?>
                            @foreach($skills as $skill)
                              <label class=" skill-label">{{$skill}}</label>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </a>
                    @endforeach 
                   <div>
                    <a href="/login"><button class="btn btn-sm btn-primary">Show more</button></a>
                   </div>
                  <!-- </div> -->
              </div>
            </div>
            <div class="col-md-6">
              <div class="feed-head">
                <h2 class="feed-title-skill">Recently Promoted Skills</h2>
              </div>
              <div class="feed-jobskill-content">
                @foreach($skillPosts as $post)
                <a href="welcome/skill/post/{{$post->unique_id}}">
                  <div class="row" style="margin:0;padding-bottom: 10px;"> 
                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">                      
                      <div class="welcome-updates-style" style="background-color:white;">
                        <label class="tagged-title" style="cursor: pointer;">
                          {{$post->post_title}} ({{$post->min_exp}} @if($post->max_exp != null) - {{$post->max_exp}} @endif yrs)
                        </label>
                        <br/><label class="tagged-company">@if($post->post_compname != null) {{$post->post_compname}} &nbsp;&nbsp;@endif <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp; {{$post->city}}</label>
                        <br/><label class="job-type-skill-css">{{$post->time_for}}</label>
                        <?php $skills = explode(',', $post->linked_skill); ?>
                        @foreach($skills as $skill)
                          <label class=" skill-label">{{$skill}}</label>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </a>
                 @endforeach 
                 <div>
                    <a href="/login"><button class="btn btn-sm btn-primary">Show more</button></a>
                   </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </section>
    <!-- End Feed Section-->
    <!-- Start Services Section -->
    <section id="services">
      <div class="container">
        <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>Why</span> Jobtip</h1>
        <div class="text-center">
          <div class="row">
            <div class="col-md-3 col-sm-3 feature-border">
              <div class="feature wow fadeInDown" data-wow-duration="0.5s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 0.5s; animation-delay: 0.2s; animation-name: fadeInDown;">             
                <span class="welcome-icon-size"><i class="fa fa-users welcome-icon-size"></i></span>
                <h2>Tag Job Tips</h2>
                <p class="paragraph-1">Why should all the job opportunities be always announced publicly ?</p>
                  <p class="paragraph-2">Create professional links, groups and share job vacancies among them.</p>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 feature-border">
              <div class="feature wow fadeInDown" data-wow-duration="0.5s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 0.5s; animation-delay: 0.2s; animation-name: fadeInDown;">             
                <span class="welcome-icon-size"><i class="fa fa-cogs welcome-icon-size"></i></span>
                <h2>Promote Skills</h2>
                <p class="paragraph-1">Fed up of not getting job opportunities for your matching skills ? </p>
                 <p class="paragraph-2"> Promote your skills here for free and get direct calls from thousands of startups, companies and recruitment agencies.
                </p>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 feature-border">
              <div class="feature wow fadeInDown" data-wow-duration="0.5s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 0.5s; animation-delay: 0.2s; animation-name: fadeInDown;">             
                <span class="welcome-icon-size"><i class="fa fa-search welcome-icon-size"></i></span>
                <h2>Search Talents</h2>
                <p class="paragraph-1">Planning to start a business/startup and stuck due to resource unavailability ?</p>
                  <p class="paragraph-2">Lacs of highly skilled people looking for Free Lancers, Work From Home, Full/Part Time jobs here.</p>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 feature-border">
              <div class="feature wow fadeInDown" data-wow-duration="0.5s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 0.5s; animation-delay: 0.2s; animation-name: fadeInDown;">             
               <span class="welcome-icon-size"> <i class="fa fa-edit welcome-icon-size"></i></span>
                <h2>Post Job Tips</h2>
                <p class="paragraph-1">Always depend on Companies or Recruitment Agencies to post job openings ? </p>
                  <p class="paragraph-2"> If you know about any Job openings/referrals, Post Job Tips here for free and help your friends, colleagues to find a suitable job.</p>
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
    
    <!-- Start Connected Section -->
    <section id="connected">
      <div class="">
        <!-- BEGIN PRE-FOOTER -->
      <div class="page-prefooter">
        <div class="welcome-container">
          <div class="row" style="padding-bottom:0;">
            <div class="col-md-4 col-sm-6 col-xs-12 footer-block">
              <h2>About</h2>
              <p style="margin-bottom: 15px;">
                 Jobtip.in is India's first website allows people to build network and post job requirements within their closed groups, professional/social friends or with public absolutely for free.
              </p>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
              <h2>Subscribe Email</h2>
              <div class="subscribe-form">
                <form action="javascript:;">
                  <div class="input-group">
                    <input type="text" placeholder="mail@email.com" class="form-control">
                    <span class="input-group-btn">
                    <button class="btn" type="submit">Submit</button>
                    </span>
                  </div>
                </form>
              </div>
              <div style="float:left;margin-bottom: 15px;"><a href="/termcondition" target="_blank" style="color: #e5e5e5;">Terms of Services </a> & 
              <a href="/privacyprolicy" target="_blank" style="color: #e5e5e5;">Privacy Policy </a></div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-12 footer-block">
              <h2>Follow Us On</h2>
              <ul class="social-icons" style="padding-top: 5px;margin-bottom: 15px;">
                <li>
                  <a href="javascript:;" data-original-title="facebook" class="facebook"></a>
                </li>
                <li>
                  <a href="javascript:;" data-original-title="twitter" class="twitter"></a>
                </li>
                <li>
                  <a href="javascript:;" data-original-title="googleplus" class="googleplus"></a>
                </li>
                <li>
                  <a href="javascript:;" data-original-title="linkedin" class="linkedin"></a>
                </li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
              <h2>Contacts</h2>
              <address class="">
              <label style="font-size: 13px;">Phone: </label> <label style="font-size: 13px;color: #ddd;"> +91 8686 150 130</label><br>
               <label style="font-size: 13px;">Email: </label><label style="font-size: 13px;"> <a href="mailto:info@metronic.com" style="color: #ddd;">&nbsp;info@jobtip.in</a></label>
              </address>
            </div>
          </div>
        </div>
      </div>
      <!-- END PRE-FOOTER -->
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
<script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="/assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
<script src="/assets/admin/pages/scripts/ui-bootstrap-growl.js"></script>
<script src="/assets/global/plugins/bootstrap-growl/jquery.bootstrap-growl.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&region=IN" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
   UIBootstrapGrowl.init();
});
</script>
<script type="text/javascript">
 (function(){

    // List your words here:
    var words = [
        'Search <span> Jobtip</span>',
        'Search <span> Skills</span>'
        ], i = 0;

    setInterval(function(){
        $('#changerificwordspanid').fadeOut(function(){
            $(this).html(words[i=(i+1)%words.length]).fadeIn();
        });
    }, 3000);

})();

</script>
<script type="text/javascript">
function initialize() {
    var options = { types: ['(cities)'], componentRestrictions: {country: "in"} };
    var input = document.getElementById('city');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', onPlaceChanged); 
    function onPlaceChanged() {
      var place = autocomplete.getPlace();
      if (place.address_components) { city = place.address_components[0];
        document.getElementById('city').value = city.long_name;
      } else { document.getElementById('autocomplete').placeholder = 'Enter a city'; }
    }
  }
   google.maps.event.addDomListener(window, 'load', initialize); 

</script>
<script>
$('.contact-submit').on('click',function(event){       
      event.preventDefault();
      var userid = $(this).data('userid');

      var formData = $('#contact-validation-'+userid).serialize(); 
      var formAction = $('#contact-validation-'+userid).attr('action');
      
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

      $.ajax({
        url: formAction,
        type: "post",
        data: formData,
        cache : false,

        success: function(data){
          // console.log(data);
          if(data.success == 'success'){
        displayToast("Thank you for contacting us. We will reach out to you shortly.");
          }else if(data.success == 'fail'){
            // console.log(data);
            // var name = '<div class="profile-usertitle-name">'+data.data.fullname+'</div>';
            // $('#name-show').html(name);
            // displayToast("Something Wrong! Not updated...");
          }
        },
         error: function (request, status, error) {
            displayToast("Something Wrong!...");
        }
      }); 
      return false;
    });
</script>
<script>
// displayToast

function displayToast($msg) {
    $.bootstrapGrowl($msg, {
        ele: 'body', // which element to append to
        type: 'info', // (null, 'info', 'danger', 'success', 'warning')
        offset: {
            from: 'bottom',
            amount: 10
        }, // 'top', or 'bottom'
        align: 'center', // ('left', 'right', or 'center')
        width: 'auto', // (integer, or 'auto')
        height: 'auto',
        // delay: 3000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
        allow_dismiss: false, // If true then will display a cross to close the popup.
        stackup_spacing: 10 // spacing between consecutively stacked growls.
    });
}
</script>
@stop












<div id="slide" class="owl-carousel" style="margin: 20px 0 30px 0;">
                  <div class="item">
                    <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:400;">
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
                              <span id="" class="uppercase new-css" style="font-weight:400;">Post Job tip</span>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:400;">help your friends to get a job</span>
                    </div>
                  </div>
                  <div class="item">
                    <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:400;">
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
                              <span id="" class="uppercase new-css" style="font-weight:400;">promote skills</span>
                            </div>
                             
                          </div>
                          <div class="tile-object">
                           
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:400;">choose where you want to work</span>
                    </div>
                  </div>
                  <div class="item">
                    <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:400;">
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
                              <span id="" class="uppercase new-css" style="font-weight:400;">Post Job tip</span>
                            </div>
                            
                          </div>
                          <div class="tile-object">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:400;">hire right talent to grow business</span>
                    </div>
                  </div>

                  <div class="item">
                    <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:400;">
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
                              <span id="" class="uppercase new-css" style="font-weight:400;">promote skills</span>
                            </div>
                           
                          </div>
                          <div class="tile-object">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                     <div class="con side-right">
                      <span id="" class="uppercase new-css" style="font-weight:400;">get right pay for your talent</span>
                    </div>
                  </div>
                </div>