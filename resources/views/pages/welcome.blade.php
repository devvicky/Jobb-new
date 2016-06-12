@extends('welcome')

@section('content')
<!-- Start Header Section -->
    <header id="header">
      <nav class="main-navigation navbar-fixed-top" role="navigation" data-spy="affix" data-offset-top="200">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <i class="fa fa-bars fa-lg"></i>
            </button>
            <!-- logo here -->
            <a href="/" class="navbar-brand" style="    padding: 15px 5px;"><img src="/assets/logo.png" alt="logo" style="width:50%;"></a>
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
        <div class="container">
          <div class="row" style="    padding-top: 40px;padding-bottom:0px !important;">
            <div class="main-text" style="margin:0 0;">
              <!-- <h1 class="wow fadeInUp"><span>Welcome To</span> - Jobtip</h1> -->
              <div id="testimonials">
                <div class="">
                  <div class="row">         
                    <div id="" class="">
                        <div class="testimonial-job col-md-6">
                          <div class="testimonial-text">
                            <!-- <i class="fa fa-quote-left pull-left"></i> -->
                            <p class="p-job1">Know about any job openings ?</p>
                            <p class="p-job2">help your friends to get a job</p>
                            <!-- <i class="fa fa-quote-right pull-right"></i> -->
                          </div>
                          <div class="testimonial-info job-info">
                             <img class="img job-skill-width" src="/assets/admin/pages/media/bg/job.png">
                            <p class="pull-right"><span class=" name jobs">Post Job tip </span>
                            </p>
                          </div>
                        </div>
                        <div class="testimonial-skill col-md-6">
                          <div class="testimonial-text">
                            <!-- <i class="fa fa-quote-left pull-left"></i> -->
                            <p class="p-skill1">Are you looking for job change ?</p>
                            <p class="p-skill2">choose where you want to work</p>
                            <!-- <i class="fa fa-quote-right pull-right"></i> -->
                          </div>
                          <div class="testimonial-info skill-info">
                             <img class="img job-skill-width " src="/assets/admin/pages/media/bg/skill.png">
                            <p class="pull-left"><span class=" name skills">Promote Skills </span>
                            </p>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
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
    <!-- Start Team Section -->
    <section id="team">
      <div class="container">
        <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>Registered</span> Companies</h1>
        <div class="row">
          @foreach($companyAccounts as $ua)
          <div class="col-sm-6 col-md-3 wow flipInY" data-wow-offset="10" data-wow-delay="0.2s">
            <div class="item-square">
              <div class="face">
                <img src="/img/profile/{{ $ua->logo_status }}" alt="" style="width:100%;">
                <div class="overlay"></div>
              </div>
              <div class="content">
                <div class="title">
                  <h3>{{$ua->firm_name}}</h3>
                  <p>@if($ua->slogan != null)<span style="font-size: 12px;"> {{$ua->slogan}} </span>@endif </p>
                </div>
                <div class="text">
                  <p>Sit amet. consectetur adipiscing elit. Aenean consectetur suscipit viverra Morbi non arcu blandit</p>
                </div>
                <div class="social-icons">
                  <ul>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- End Team Section -->
    
    <!-- Start Testimonial Section -->
    <section id="testimonial">
      <div class="container">
        <div class="row">
          <h2 class="section-title wow fadeIn" data-wow-delay=".2s">User Profile</h2>         
          <div id="testimonial-slider" class="owl-carousel">
             @foreach($userAccounts as $ua)
            <div class="item wow fadeInDown" data-wow-delay="0.3s">
              <div class="testimonial">
                <div class="testimonial-text">
                  <i class="fa fa-quote-left"></i>
                  <p>{{$ua->about_individual}}</p>
                  <i class="fa fa-quote-right pull-right"></i>
                </div>
                <div class="testimonial-info">
                  <img src="/img/profile/{{ $ua->profile_pic }}" alt="">
                  <p><span class="name ">{{$ua->fname}} {{$ua->lname}} | </span>
                  <span class="company">{{$ua->role}}, {{$ua->city}}</span></p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
    <!-- End Testimonial Section -->
    <!-- Start Services Section -->
    <section id="services">
      <div class="container">
        <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>Why</span> Jobtip</h1>
        <div class="text-center">
          <div class="row">
            <div class="col-md-3 col-sm-3 feature-border">
              <div class="feature wow fadeInDown" data-wow-duration="0.5s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 0.5s; animation-delay: 0.2s; animation-name: fadeInDown;">             
                <span class="welcome-icon-size"><i class="fa fa-users welcome-icon-size"></i></span>
                <h2 class="welcome-font-size">Tag Job Tips</h2>
                <p class="paragraph-1">Why should all the job opportunities be always announced publicly ?</p>
                  <p class="paragraph-2">Create professional links, groups and share job vacancies among them.</p>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 feature-border">
              <div class="feature wow fadeInDown" data-wow-duration="0.5s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 0.5s; animation-delay: 0.2s; animation-name: fadeInDown;">             
                <span class="welcome-icon-size"><i class="fa fa-cogs welcome-icon-size"></i></span>
                <h2 class="welcome-font-size">Promote Skills</h2>
                <p class="paragraph-1">Fed up of not getting job opportunities for your matching skills ? </p>
                 <p class="paragraph-2"> Promote your skills here for free and get direct calls from thousands of startups, companies and recruitment agencies.
                </p>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 feature-border">
              <div class="feature wow fadeInDown" data-wow-duration="0.5s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 0.5s; animation-delay: 0.2s; animation-name: fadeInDown;">             
                <span class="welcome-icon-size"><i class="fa fa-search welcome-icon-size"></i></span>
                <h2 class="welcome-font-size">Search Talents</h2>
                <p class="paragraph-1">Planning to start a business/startup and stuck due to resource unavailability ?</p>
                  <p class="paragraph-2">Lacs of highly skilled people looking for Free Lancers, Work From Home, Full/Part Time jobs here.</p>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 feature-border">
              <div class="feature wow fadeInDown" data-wow-duration="0.5s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 0.5s; animation-delay: 0.2s; animation-name: fadeInDown;">             
               <span class="welcome-icon-size"> <i class="fa fa-edit welcome-icon-size"></i></span>
                <h2 class="welcome-font-size">Post Job Tips</h2>
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
                  <p style="text-align: initial;">
                  Jobtip.in is India's first website allows people to build network and post job requirements within their closed groups, professional/social friends or with public absolutely for free. We have a huge networking of start-up firms, companies, consulting agencies and recruitment agencies of India who post job vacancies and follow people who apply for the jobs matching their skill set.
                 </p>
                <p style="text-align: initial;">This website empowers people to register and promote their skills and get noticed by lacs of job providers, referral candidates seekers to approach you for hiring.
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
    <section id="connected" style="    background-color: #48525e;">
      <div class="container">
      <!-- BEGIN PRE-FOOTER -->
      <div class="page-prefooter">
        <div class="welcome-container">
          <div class="row" style="padding-bottom:0;">
            <div class="col-md-4 col-sm-6 col-xs-12 footer-block">
              <h2>About Us</h2>
              <p style="margin-bottom: 15px;">
                 Jobtip.in is India's first website allows people to build network and post job requirements within their closed groups, professional/social friends or with public absolutely for free.
              </p>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
              <h2>Subscribe Email</h2>
              <div class="subscribe-form">
                <form action="javascript:;">
                  <div class="input-group">
                    <input type="email" placeholder="Enter Email Id" class="form-control subscribe" style="height: 29px;">
                    <span class="input-group-btn">
                    <button class="btn" type="submit" style="height: 29px;line-height:1.1;">Submit</button>
                    </span>
                  </div>
                </form>
              </div>
              <div style="float:left;margin-bottom: 15px;"><a href="/termcondition" target="_blank" style="color: #e5e5e5;font-size: 11px;">Terms of Services </a> & 
              <a href="/privacyprolicy" target="_blank" style="color: #e5e5e5;font-size: 11px;">Privacy Policy </a></div>
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
              <span style="font-size: 13px;color: #a2abb7;">Phone: </span> <span style="font-size: 13px;color: #ddd;"> +91 8686 150 130</span><br>
               <span style="font-size: 13px;color: #a2abb7;">Email: </span><span style="font-size: 13px;"> <a href="mailto:info@metronic.com" style="color: #ddd;">&nbsp;info@jobtip.in</a></span>
              </address>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!-- END PRE-FOOTER -->
    </section>
    <!-- End Connected Section -->

    <!-- Footer Section Start -->
    <footer id="footer">
      <div class="page-footer" style="padding: 6px 0;">
        <div class="container">
           2016 &copy; Jobtip.in 
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
<!-- <script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="/assets/admin/layout3/scripts/demo.js" type="text/javascript"></script> -->
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