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
          <div class="row">
            <div class="main-text">
              <h1 class="wow fadeInUp"><span>Startup</span> - Bootstrap Template</h1>
              <h2 class="wow fadeInUp" data-wow-delay=".7s">Clean and Refreshing Solution for Startup and Agency Sites</h2>
              <div class="wow fadeInUp" data-wow-delay="1.5s"><a onclick="smoothScr.anim('services')" class="btn btn-border btn-lg"><i class="fa fa-spinner fa-spin"></i> Explore</a></div>
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
    <!-- Start Services Section -->
    <section id="services">
      <div class="container">
        <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>Our</span> Services</h1>
        <div class="row">
          <div class="col-sm-6 col-md-3 wow fadeInUp">
            <div class="service-box">
              <div class="content">
                <div class="icon-wrapper">
                <i class="fa fa-leaf"></i>
                </div>
                <h2>Easy to Customize</h2>
                <p>Lorem ipsum is simply dummy text of the printin and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s.</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 wow fadeInUp" data-wow-delay=".2s" data-wow-offset="10">
            <div class="service-box">
              <div class="content">
                <div class="icon-wrapper">
                <i class="fa fa-heart"></i>
                </div>
                <h2>Clean & Creative</h2>
                <p>Lorem ipsum is simply dummy text of the printin and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s.</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 wow fadeInUp" data-wow-delay=".4s" data-wow-offset="10">
            <div class="service-box">
              <div class="content">
                <div class="icon-wrapper">
                <i class="fa fa-child"></i>
                </div>
                <h2>Ready to Launch</h2>
                <p>Lorem ipsum is simply dummy text of the printin and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s.</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 wow fadeInUp" data-wow-delay=".6s" data-wow-offset="10">
            <div class="service-box">
              <div class="content">
                <div class="icon-wrapper">
                <i class="fa fa-mobile-phone"></i>
                </div>
                <h2>Liquid Responsive</h2>
                <p>Lorem ipsum is simply dummy text of the printin and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Services Section-->
    
    <!-- Start About Us Section -->
    <section id="about" class="about-section">
      <div class="container">
      <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>About</span> Us</h1>
        <div class="row">
          <div id="slide" class="owl-carousel">
            <div class="item">
              <div class="col-sm-6 col-md-6 wow fadeInLeft" data-wow-offset="10">
                <div class="side-left">
                    <img src="assets/img/about-carousel/01.jpg" alt="">             
                  <div class="info">
                    <h4>John Doe</h4>
                    <p>Ul/UX Developer</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 wow fadeInRight" data-wow-offset="10">
                <div class="side-right">
                  <p>
                  Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantlum doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritais ea quasi architecto beattae vista dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consiquuntur magin dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem iqsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eisu modi tempora incidunt ut labore et nostrum exercitationem ullam corporis suscipit laboriosam.
                  </p>
                  <a href="#" class="btn btn-border"><i class="fa fa-shopping-cart"></i> Hire Me</a>
                  <a href="#" class="btn btn-border"><i class="fa fa-download"></i> Download Resume</a>
                </div>
              </div>
            </div>
            
            <div class="item">
              <div class="col-sm-6 col-md-6">
                <div class="side-left">                 
                    <img src="assets/img/about-carousel/02.jpg" alt="">             
                  <div class="info">
                    <h4>John Doe</h4>
                    <p>Ul/UX Developer</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="side-right">
                  <p>
                     enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consiquuntur magin dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem iqsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eisu modi tempora incidunt ut labore et nostrum exercitationem ullam corporis suscipit laboriosam.
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantlum doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritais ea quasi architecto beattae vista dicta sunt explicabo. Nemo
                  </p>
                  <a href="#" class="btn  btn-border angle"><i class="fa fa-shopping-cart"></i> Hire Me</a>
                  <a href="#" class="btn btn-border angle"><i class="fa fa-download"></i> Download Resume</a>
                </div>
              </div>
            </div>
            
            <div class="item">
              <div class="col-sm-6 col-md-6">
                <div class="side-left">                 
                    <img src="assets/img/about-carousel/03.jpg" alt="">             
                  <div class="info">
                    <h4>John Doe</h4>
                    <p>Ul/UX Developer</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="side-right">
                  <p>
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantlum doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritais ea quasi architecto beattae vista dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consiquuntur magin dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem iqsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eisu modi tempora incidunt ut labore et nostrum exercitationem ullam corporis suscipit laboriosam.
                  </p>
                  <a href="#" class="btn  btn-border angle"><i class="fa fa-shopping-cart"></i> Hire Me</a>
                  <a href="#" class="btn btn-border angle"><i class="fa fa-download"></i> Download Resume</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End About Us Section -->   
      
    <!-- Start Portfolio Section -->
    <section id="portfolio">
      <div class="container">
      <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>Our</span> Portfolio</h1>
        <div class="row">
          <div class="controls text-center">
            <a class="filter btn btn-border" data-filter="all">All</a>
            <a class="filter btn btn-border" data-filter=".design">Design</a>
            <a class="filter btn btn-border" data-filter=".marketing">Marketing</a>
            <a class="filter btn btn-border" data-filter=".nwtwork">Network</a>
            <a class="filter btn btn-border" data-filter=".awesome">Awesome</a>
          </div>
          <div id="portfolio-items" class="portfolio-items wow fadeInUpQuick">

            <div class="mix nwtwork" data-myorder="1">
              <figure>
                <div class="img">
                  <img src="assets/img/portfolio/img1.jpg" alt="">
                  <div class="overlay">
                    <a data-lightbox="image1" href="assets/img/portfolio/thumb/img1.jpg" class="link-left"><i class="fa fa-plus"></i></a>
                    <a href="#" class="link-right"><i class="fa fa-link"></i></a>
                  </div>
                </div>
                <figcaption class="item-description">
                  <h4 class="item-title">Maecenas Bibendum</h4>
                  <p>Online Startup</p>
                </figcaption>
              </figure>          
            </div>

            <div class="mix design" data-myorder="2">
              <figure>
                <div class="img">
                  <img src="assets/img/portfolio/img2.jpg" alt="">
                  <div class="overlay">
                    <a data-lightbox="image1" href="assets/img/portfolio/thumb/img2.jpg" class="link-left"><i class="fa fa-plus"></i></a>
                    <a href="#" class="link-right"><i class="fa fa-link"></i></a>
                  </div>
                </div>
                <figcaption class="item-description">
                  <h4 class="item-title">Maecenas Bibendum</h4>
                  <p>Online Startup</p>
                </figcaption>
              </figure>          
            </div>

            <div class="mix marketing awesome" data-myorder="3">
              <figure>
                <div class="img">
                  <img src="assets/img/portfolio/img3.jpg" alt="">
                  <div class="overlay">
                    <a data-lightbox="image1" href="assets/img/portfolio/thumb/img3.jpg" class="link-left"><i class="fa fa-plus"></i></a>
                    <a href="#" class="link-right"><i class="fa fa-link"></i></a>
                  </div>
                </div>
                <figcaption class="item-description">
                  <h4 class="item-title">Maecenas Bibendum</h4>
                  <p>Online Startup</p>
                </figcaption>
              </figure>
            </div>

            <div class="mix awesome" data-myorder="4">
              <figure>
                <div class="img">
                  <img src="assets/img/portfolio/img4.jpg" alt="">
                  <div class="overlay">
                    <a data-lightbox="image1" href="assets/img/portfolio/thumb/img4.jpg" class="link-left"><i class="fa fa-plus"></i></a>
                    <a href="#" class="link-right"><i class="fa fa-link"></i></a>
                  </div>
                </div>
                <figcaption class="item-description">
                  <h4 class="item-title">Maecenas Bibendum</h4>
                  <p>Online Startup</p>
                </figcaption>
              </figure>          
            </div>

            <div class="mix design" data-myorder="5">
              <figure>
                <div class="img">
                  <img src="assets/img/portfolio/img5.jpg" alt="">
                  <div class="overlay">
                    <a data-lightbox="image1" href="assets/img/portfolio/thumb/img5.jpg" class="link-left"><i class="fa fa-plus"></i></a>
                    <a href="#" class="link-right"><i class="fa fa-link"></i></a>
                  </div>
                </div>
                <figcaption class="item-description">
                  <h4 class="item-title">Maecenas Bibendum</h4>
                  <p>Online Startup</p>
                </figcaption>
              </figure>          
            </div>

            <div class="mix marketing" data-myorder="6">
              <figure>
                <div class="img">
                  <img src="assets/img/portfolio/img6.jpg" alt="">
                  <div class="overlay">
                    <a data-lightbox="image1" href="assets/img/portfolio/thumb/img6.jpg" class="link-left"><i class="fa fa-plus"></i></a>
                    <a href="#" class="link-right"><i class="fa fa-link"></i></a>
                  </div>
                </div>
                <figcaption class="item-description">
                  <h4 class="item-title">Maecenas Bibendum</h4>
                  <p>Online Startup</p>
                </figcaption>
              </figure>          
            </div>
            
            <div class="mix awesome" data-myorder="1">
              <figure>
                <div class="img">
                  <img  src="assets/img/portfolio/img7.jpg" alt="">
                  <div class="overlay">
                    <a data-lightbox="image1" href="assets/img/portfolio/thumb/img7.jpg" class="link-left"><i class="fa fa-plus"></i></a>
                    <a href="#" class="link-right"><i class="fa fa-link"></i></a>
                  </div>
                </div>
                <figcaption class="item-description">
                  <h4 class="item-title">Maecenas Bibendum</h4>
                  <p>Online Startup</p>
                </figcaption>
              </figure>          
            </div>  

            <div class="mix nwtwork design" data-myorder="1">
              <figure>
                <div class="img">
                  <img src="assets/img/portfolio/img8.jpg" alt="">
                  <div class="overlay">
                    <a data-lightbox="image1" href="assets/img/portfolio/thumb/img8.jpg" class="link-left"><i class="fa fa-plus"></i></a>
                    <a href="#" class="link-right"><i class="fa fa-link"></i></a>
                  </div>
                </div>
                <figcaption class="item-description">
                  <h4 class="item-title">Maecenas Bibendum</h4>
                  <p>Online Startup</p>
                </figcaption>
              </figure>        
            </div> 

          </div>
        </div>
      </div>
    </section>
    <!-- End Portfolio Section -->

    <!-- Start Why chose us Section -->
    <section id="why-chose">
      <div class="container">
        <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>Why</span> Chose</h1>
        <div class="row">
          <div class="col-md-4 wow fadeInLeft" data-wow-offset="10" data-wow-delay="0.5s">
            <div class="content-left">
              <div class="box-left">
                <span class="icon">
                  <i class="fa fa-laptop"></i>
                </span>
                <div class="content">
                  <h4>Respansive Layout</h4>
                  <p>Lorem it has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                </div>
              </div>
              <br>
              <div class="box-left">
                <span class="icon">
                  <i class="fa fa-cog"></i>
                </span>
                <div class="content">
                  <h4>Clean Code</h4>
                  <p>Lorem it has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                </div>
              </div>
              <br>
              <div class="box-left">
                <span class="icon">
                  <i class="fa fa-random"></i>
                </span>
                <div class="content">
                  <h4>Cross Browser</h4>
                  <p>Lorem it has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 wow fadeInUp" data-wow-offset="10"  data-wow-delay="0.3s">
            <div class="showcase-box">
              <img src="assets/img/why.png" alt="">
            </div>
          </div>
          <div class="col-md-4 wow fadeInRight" data-wow-offset="10" data-wow-delay="0.5s">
            <div class="content-right">
              <div class="box-right">
                <span class="icon">
                  <i class="fa fa-umbrella"></i>
                </span>
                <div class="content">
                  <h4>Premium Features</h4>
                  <p>Lorem it has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                </div>
              </div>
              <br>
              <div class="box-right">
                <span class="icon">
                  <i class="fa fa-heart"></i>
                </span>
                <div class="content">
                  <h4>Modern Design</h4>
                  <p>Lorem it has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                </div>
              </div>
              <br>
              <div class="box-right">
                <span class="icon">
                  <i class="fa fa-comments"></i>
                </span>
                <div class="content">
                  <h4>24/7 Support</h4>
                  <p>Lorem it has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Why chose us Section  -->

    <!-- pricing-table Section -->
    <section id="pricing">
      <div class="container">
        <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>Pricing</span> Table</h1>
        <div class="row">
          <div class="col-sm-6 col-md-3 wow bounceIn" data-wow-offset="10" data-wow-delay="0.2s">
            <div class="table text-center">
              <div class="pricing-header">
                <p class="price-quality">Simple</p>
              </div>
              <div class="price">
                <p class="price-value">$29</p>
              </div>
              <div class="pricing-list">
                <ul>
                  <li>5GB Disk Space</li>
                  <li>500GB Monthly Bandwidth</li>
                  <li>10 Email Accounts</li>
                  <li>Unlimited Subdomains</li>
                </ul>
              </div>
              <a href="#" class="btn btn-common">Sing Up</a>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 wow bounceIn" data-wow-offset="10" data-wow-delay="0.4s">
            <div class="table text-center">
              <div class="pricing-header">
                <p class="price-quality">Standard</p>
              </div>
              <div class="price">
                <p class="price-value">$49</p>
              </div>
              <div class="pricing-list">
                <ul>
                  <li>5GB Disk Space</li>
                  <li>500GB Monthly Bandwidth</li>
                  <li>10 Email Accounts</li>
                  <li>Unlimited Subdomains</li>
                </ul>
              </div>
              <a href="#" class="btn btn-common">Sing Up</a>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 wow bounceIn" data-wow-offset="10" data-wow-delay="0.6s">
            <div class="table text-center">
              <div class="pricing-header">
                <p class="price-quality">Ultimate</p>
              </div>
              <div class="price">
                <p class="price-value">$79</p>
              </div>
              <div class="pricing-list">
                <ul>
                  <li>5GB Disk Space</li>
                  <li>500GB Monthly Bandwidth</li>
                  <li>10 Email Accounts</li>
                  <li>Unlimited Subdomains</li>
                </ul>
              </div>
              <a href="#" class="btn btn-common">Sing Up</a>
            </div>            
          </div>
          <div class="col-sm-6 col-md-3 wow bounceIn" data-wow-offset="10" data-wow-delay="0.8s">
            <div class="table text-center">
              <div class="pricing-header">
                <p class="price-quality">Basic</p>
              </div>
              <div class="price">
                <p class="price-value">$09</p>
              </div>
              <div class="pricing-list">
                <ul>
                  <li>5GB Disk Space</li>
                  <li>500GB Monthly Bandwidth</li>
                  <li>10 Email Accounts</li>
                  <li>Unlimited Subdomains</li>
                </ul>
              </div>
              <a href="#" class="btn btn-common">Sing Up</a>
            </div>            
          </div>
        </div>
      </div>
    </section>
    <!-- End pricing-table Section-->
    
    <!-- Start Blog Section -->
    <section id="blog">
      <div class="container">
        <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>Our</span> Blog</h1>
        <div class="row">         
          <div id="blog-slider" class="owl-carousel owl-theme">
            <div class="item wow fadeInLeft" data-wow-delay="0.4s">
              <div class="blog-wrapper">
                <div id="gallery" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="item active">
                      <img src="assets/img/blog/blog-01.jpg" alt="">
                    </div>
                    <div class="item">
                      <img src="assets/img/blog/slider1.jpg" alt="">
                    </div>
                    <div class="item">
                      <img src="assets/img/blog/slider2.jpg" alt="">
                    </div>
                  </div>
                  <a class="left carousel-control" href="#gallery" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                  <a class="right carousel-control" href="#gallery" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                </div>
                <div class="content">
                  <h3>Blog Post With Slide</h3>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived.</p>
                  <a href="#" class="redmore">Read More +</a>
                </div>
                <div class="blog-footer">
                  <p>published: 22 january 2014</p>
                  <span><i class="fa fa-comments"></i>30 Comments</span>
                </div>
              </div>
            </div>                
            <div class="item wow fadeInUp" data-wow-delay="0.4s">
              <div class="blog-wrapper">
                <img src="assets/img/blog/blog-02.jpg" alt="">
                <div class="content">
                  <h3>Featured Image Blog Post</h3>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived.</p>
                  <a href="#" class="redmore">Read More +</a>
                </div>
                <div class="blog-footer">
                  <p>published: 22 january 2014</p>
                  <span><i class="fa fa-comments"></i>30 Comments</span>
                </div>
              </div>
            </div>
            <div class="item wow fadeInRight" data-wow-delay="0.4s">
              <div class="blog-wrapper">
                <div class="video">
                  <iframe src="//player.vimeo.com/video/117934677?color=ea6a47title=0byline=0portrait=0badge=0" width="365" height="268" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> 
                </div>
                <div class="content">
                  <h3>Video BLog Post</h3>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived.</p>
                  <a href="#" class="redmore">Read More +</a>
                </div>
                <div class="blog-footer">
                  <p>published: 22 january 2014</p>
                  <span><i class="fa fa-comments"></i>30 Comments</span>
                </div>
              </div>
            </div>
            <div class="item wow fadeIn">
              <div class="blog-wrapper">
                <img src="assets/img/blog/blog-04.jpg" alt="">
                <div class="content">
                  <h3>Blog Post With Slide</h3>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived.</p>
                  <a href="#" class="redmore">Read More +</a>
                </div>
                <div class="blog-footer">
                  <p>published: 22 january 2014</p>
                  <span><i class="fa fa-comments"></i>30 Comments</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="blog-wrapper">
                <img src="assets/img/blog/blog-05.jpg" alt="">
                <div class="content">
                  <h3>Blog Post With Slide</h3>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived.</p>
                  <a href="#" class="redmore">Read More +</a>
                </div>
                <div class="blog-footer">
                  <p>published: 22 january 2014</p>
                  <span><i class="fa fa-comments"></i>30 Comments</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="blog-wrapper">
                <img src="assets/img/blog/blog-06.jpg" alt="">
                <div class="content">
                  <h3>Blog Post With Slide</h3>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived.</p>
                  <a href="#" class="redmore">Read More +</a>
                </div>
                <div class="blog-footer">
                  <p>published: 22 january 2014</p>
                  <span><i class="fa fa-comments"></i>30 Comments</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Blog Section -->   
    
    <!-- Start Team Section -->
    <section id="team">
      <div class="container">
        <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>Our</span> Team</h1>
        <div class="row">

          <div class="col-sm-6 col-md-3 wow flipInY" data-wow-offset="10" data-wow-delay="0.2s">
            <div class="item-square">
              <div class="face">
                <img src="assets/img/team-member/team-02.jpg" alt="">
                <div class="overlay"></div>
              </div>
              <div class="content">
                <div class="title">
                  <h3>Musharrof Chy</h3>
                  <p>Frontend Developer</p>
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

          <div class="col-sm-6 col-md-3 wow flipInY" data-wow-offset="10" data-wow-delay="0.4s">
            <div class="item-square">
              <div class="face">
                <img src="assets/img/team-member/team-01.jpg" alt="">
                <div class="overlay"></div>
              </div>
              <div class="content">
                <div class="title">
                  <h3>Imran Khan</h3>
                  <p>Wordpress Developer</p>
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

          <div class="col-sm-6 col-md-3 wow flipInY" data-wow-offset="10" data-wow-delay="0.6s">
            <div class="item-square">
              <div class="face">
                <img src="assets/img/team-member/team-03.jpg" alt="">
                <div class="overlay"></div>
              </div>
              <div class="content active">
                <div class="title">
                  <h3>Jessi Jain</h3>
                  <p>Creative Designer</p>
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
          <div class="col-sm-6 col-md-3 wow flipInY" data-wow-offset="10" data-wow-delay="0.8s">
            <div class="item-square">
              <div class="face">
                <img src="assets/img/team-member/team-04.jpg" alt="">
                <div class="overlay"></div>
              </div>
              <div class="content">
                <div class="title">
                  <h3>M. Arman</h3>
                  <p>Junior Developer</p>
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
        </div>
      </div>
    </section>
    <!-- End Team Section -->
    
    <!-- Start Testimonial Section -->
    <section id="testimonial">
      <div class="container">
        <div class="row">
          <h2 class="section-title wow fadeIn" data-wow-delay=".2s">Testimonials</h2>         
          <div id="testimonial-slider" class="owl-carousel">
            <div class="item wow fadeInDown" data-wow-delay="0.3s">
              <div class="testimonial">
                <div class="testimonial-text">
                  <i class="fa fa-quote-left"></i>
                  <p>I Hired Anirudh Babbar to do my new website, the design was done very fast i was kept up to date regularly and I have had the website re designed and its working perfectly, I would recommend him to anyone.? TOP BLOKE!!! </p>
                  <i class="fa fa-quote-right pull-right"></i>
                </div>
                <div class="testimonial-info">
                  <img src="assets/img/testimonial-carousel/img-1.jpg" alt="">
                  <p><span class="name">Sara Mandis | </span>
                  <span class="company">CEO - Media Wiki</span></p>
                </div>
              </div>
            </div>
            <div class="item wow fadeInDown"  data-wow-delay="0.6s">
              <div class="testimonial">
                <div class="testimonial-text">
                  <i class="fa fa-quote-left"></i>
                  <p>I Hired Anirudh Babbar to do my new website, the design was done very fast i was kept up to date regularly and I have had the website re designed and its working perfectly, I would recommend him to anyone.? TOP BLOKE!!! </p>
                  <i class="fa fa-quote-right pull-right"></i>
                </div>
                <div class="testimonial-info">
                  <img src="assets/img/testimonial-carousel/img-2.jpg" alt="">
                  <p><span class="name">Sara Mandis | </span>
                  <span class="company">CEO - Media Wiki</span></p>
                </div>
              </div>
            </div>
            <div class="item wow fadeInDown" data-wow-delay="0.9s">
              <div class="testimonial">
                <div class="testimonial-text">
                  <i class="fa fa-quote-left"></i>
                  <p>I Hired Anirudh Babbar to do my new website, the design was done very fast i was kept up to date regularly and I have had the website re designed and its working perfectly, I would recommend him to anyone.? TOP BLOKE!!! </p>
                  <i class="fa fa-quote-right pull-right"></i>
                </div>
                <div class="testimonial-info">
                  <img src="assets/img/testimonial-carousel/img-3.jpg" alt="">
                  <p><span class="name">Sara Mandis | </span>
                  <span class="company">CEO - Media Wiki</span></p>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimonial">
                <div class="testimonial-text">
                  <i class="fa fa-quote-left"></i>
                  <p>I Hired Anirudh Babbar to do my new website, the design was done very fast i was kept up to date regularly and I have had the website re designed and its working perfectly, I would recommend him to anyone.? TOP BLOKE!!! </p>
                  <i class="fa fa-quote-right pull-right"></i>
                </div>
                <div class="testimonial-info">
                  <img src="assets/img/testimonial-carousel/img-4.jpg" alt="">
                  <p><span class="name">Sara Mandis | </span>
                  <span class="company">CEO - Media Wiki</span></p>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimonial">
                <div class="testimonial-text">
                  <i class="fa fa-quote-left"></i>
                  <p>I Hired Anirudh Babbar to do my new website, the design was done very fast i was kept up to date regularly and I have had the website re designed and its working perfectly, I would recommend him to anyone.? TOP BLOKE!!! </p>
                  <i class="fa fa-quote-right pull-right"></i>
                </div>
                <div class="testimonial-info">
                  <img src="assets/img/testimonial-carousel/img-1.jpg" alt="">
                  <p><span class="name">Sara Mandis | </span>
                  <span class="company">CEO - Media Wiki</span></p>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimonial">
                <div class="testimonial-text">
                  <i class="fa fa-quote-left"></i>
                  <p>I Hired Anirudh Babbar to do my new website, the design was done very fast i was kept up to date regularly and I have had the website re designed and its working perfectly, I would recommend him to anyone.? TOP BLOKE!!! </p>
                  <i class="fa fa-quote-right pull-right"></i>
                </div>
                <div class="testimonial-info">
                  <img src="assets/img/testimonial-carousel/img-2.jpg" alt="">
                  <p><span class="name">Sara Mandis | </span>
                  <span class="company">CEO - Media Wiki</span></p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- End Testimonial Section -->
    
    <!-- Start Contact Section -->
    <section id="contact">
      <div class="overlay">
        <div class="container">
        <h1 class="section-title wow fadeIn" data-wow-delay=".2s"><span>Contact</span> Us</h1>
          <div class="row">
            <div class="contact-form">
              <form role="form" method="post">
                <div class="col-sm-6 col-md-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="controls">
                      <input class="contact_input" type="text" name="name" placeholder="Name">
                      <i class="fa fa-user"></i>
                    </div>
                    <div class="controls">
                      <input class="contact_input" type="text" name="Email" placeholder="Email">
                      <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="controls">
                      <input class="contact_input" type="text" name="Phone" placeholder="Phone">
                      <i class="fa fa-phone"></i>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 wow fadeInRight" data-wow-delay="0.2s">
                    <textarea name="massage" rows="7" class="form-control" placeholder="Massage"></textarea>
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
    <section id="clients">
      <div class="container">
        <div class="row">
          <div id="logo-slider" class="owl-carousel owl-theme">
            <div class="item">
              <a href="#"><img src="assets/img/clients-logo/img1.png" alt=""></a>
            </div>
            <div class="item">
              <a href="#"><img src="assets/img/clients-logo/img2.png" alt=""></a>
            </div>
            <div class="item">
              <a href="#"><img src="assets/img/clients-logo/img3.png" alt=""></a>
            </div>
            <div class="item">
              <a href="#"><img src="assets/img/clients-logo/img4.png" alt=""></a>
            </div>
            <div class="item">
              <a href="#"><img src="assets/img/clients-logo/img5.png" alt=""></a>
            </div>
            <div class="item">
              <a href="#"><img src="assets/img/clients-logo/img6.png" alt=""></a>
            </div>
            <div class="item">
              <a href="#"><img src="assets/img/clients-logo/img7.png" alt=""></a>
            </div>
            <div class="item">
              <a href="#"><img src="assets/img/clients-logo/img8.png" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Clients Section -->
    
    <!-- Start Connected Section -->
    <section id="connected">
      <div class="container">
        <div class="row">
          <h2 class="section-title wow fadeInUp" data-wow-delay=".2s">Stay Connected</h2>   
          <h3 class="discription wow fadeIn" data-wow-delay=".2s">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h3>
          <hr>
          <div class="connected-wrapper text-center">
            <div class="col-sm-6 col-md-3 wow fadeInUp" data-wow-delay="0.2s">
              <div class="contact-item">
                <a href="#"><i class="fa fa-phone"></i></a>
                <h5>Customer Care</h5>
                <h4>0123 - 456 - 789</h4>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 wow fadeInUp" data-wow-delay="0.2s">
              <div class="contact-item">
                <a href="#"><i class="fa fa-user"></i></a>
                <h5>Support Team</h5>
                <h4>support@name.com</h4>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 wow fadeInUp" data-wow-delay="0.2s">
              <div class="contact-item">
                <a href="#"><i class="fa fa-twitter"></i></a>
                <h5>Twitter</h5>
                <h4>@example.com</h4>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 wow fadeInUp" data-wow-delay="0.2s">
              <div class="contact-item">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <h5>Facebook</h5>
                <h4>example.agency</h4>
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
            <p>Designed and Developed by <a href="http://graygrids.com">GrayGrids</a></p>
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