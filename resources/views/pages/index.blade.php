@extends('welcome')

@section('content')

<!-- Start menu section -->
  <section id="menu-area">
    <nav class="navbar navbar-default main-navbar new-nav" role="navigation">  
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
           <!-- <a class="navbar-brand logo" style="padding:0 15px;" href="index.html"><img class="big-logo" src="{{ asset('/assets/logo.png') }}" alt="logo"></a>                       -->
        </div>
        <!-- <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav main-nav menu-scroll">
            <li class="active"><a href="#welcome">WELCOME</a></li>
            <li><a href="#search">SEARCH</a></li> 
            <li><a href="#about">ABOUT</a></li>                         
            <li><a href="#contact">CONTACT</a></li>
            <li><a href="/login">LOGIN</a></li>
          </ul>                            
        </div> --><!--/.nav-collapse -->         
      </div>          
    </nav> 
  </section>
<!-- End menu section -->



<!-- Start about section -->
<section id="welcome" style="margin: 60px 0;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- Start welcome area -->
        <div class="welcome-area">
          <div class="title-area">
            <h2 class="tittle">Welcome to <span>Jobtip</span></h2>
            <span class="tittle-line"></span>     
          </div>
          <div><img class="welcome-bg" src="/assets/admin/pages/media/bg/bg.jpg"></div>
          <div class="row" style="margin:0 auto;display:table;">
            <div class='con'>
              <div class='visible'>
                <ul class="new-visible-ul">
                  <li class="new-visible">Do you know about any job openings</li>
                  <li class="new-visible">Searching for right job</li>
                  <li class="new-visible">Add your skills here</li>
                  <li class="new-visible">post Job tip here</li>
                  <li class="new-visible">Create a group of your friends</li>
                  <li class="new-visible">share job info among your friends</li>
                  <li class="new-visible">Add your skills here</li>
                </ul>
              </div>
            </div>
          </div>
         
          <div class="row ">
            <div class="tile-position-new">
              <div class="tile bg-red-intense">
                <div class="tile-body box-welcome" style="text-align:center;">
                  <a href="/login">
                    <img class="" src="/assets/admin/pages/media/bg/skill.png" style="width:90%;">
                  </a>
                  <!-- <i class="fa fa-gavel"></i> -->
                </div>
                <div class="tile-object" >
                  <div class="name">
                     <a href="/login"></a>
                  </div>
                  <div class="number">
                     
                  </div>
                </div>
              </div>
              <div class="tile bg-red-intense">
                <div class="tile-body" style="text-align:center;">
                  <a href="/login">
                    <img class="" src="/assets/admin/pages/media/bg/job.png" style="width:90%;">
                  </a>
                </div>
                <div class="tile-object" >
                  <div class="name">
                     <a href="/login"></a>
                  </div>
                  <div class="number">
                     
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End welcome area -->
      </div>
    </div></div>
    </section>
    <!-- Start about section -->
<section id="search" style="margin: 60px 0;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- Start welcome area -->
        <div class="welcome-area">
          <div class="title-area">
            <h2 class="tittle">Search on <span>Jobtip</span></h2>
            <span class="tittle-line"></span>
            <div class="row" style="margin: 0 -10px 0 5px !important;">
              <!-- <div class="col-md-2 col-sm-1"></div> -->
                <div class="col-md-12 col-sm-10">
                <form id="welcome-search" name="welcome_form" action="/welcome/post" method="post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="col-md-5 col-sm-5" style="padding-left:0 !important;">
                    <div class=" form-group">
                      <div class="input-group">
                        <span class="input-group-addon welcome-icon">
                          <i class="fa fa-cogs"></i>
                        </span>
                        <input type="text" required name="role" id="search-input" class="form-control welcome-inputbox" placeholder="Enter Job role">
                      </div>
                    </div>    
                  </div>
                  
                  <div id="welcome-city" class="col-md-4 col-sm-4 col-xs-6" style="padding-left:0 !important;">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon welcome-icon">
                          <i class="fa fa-map-marker"></i>
                        </span>
                        <input type="text" name="location" class="form-control welcome-inputbox" placeholder="City">                    
                      </div>  
                    </div>    
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6" style="padding-left:0 !important;">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon welcome-icon">
                          <i class="icon-briefcase"></i>
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
                    <button type="submit" class="btn btn-small-welcome btn-search-welcome search-button-size" style="margin: -1px;">
                      <i class="fa fa-search"></i>
                      
                        <!-- Search -->
                      
                    </button>
                  </div>
                </form>
              </div> 
            </div>
        </div>
        <!-- End welcome area -->
      </div>
    </div></div>
    </section>
    <!-- Start about section -->
<section id="about" style="margin: 60px 0;">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <!-- Start welcome area -->
      <div class="welcome-area">
        <div class="title-area">
          <h2 class="tittle">About <span>Jobtip</span></h2>
          <span class="tittle-line"></span>
          <p>Jobtip.in is India's first website allows people to build network and post job requirements within their closed groups, professional/social friends or with public absolutely for free. We have a huge networking of start-up firms, companies, consulting agencies and recruitment agencies of India who post job vacancies and follow people who apply for the jobs matching their skill set.

          This website empowers people to register and promote their skills and get noticed by lacs of job providers, referral candidates seekers to approach you for hiring.

          Jobtip.in respects individuals data privacy and ensures data protection and data security of its user data.</p>
          </div>
      </div>
      <!-- End welcome area -->
    </div>
  </div>
</div>
</section>
     <!-- Start Contact section -->
    <section id="contact" style="margin: 60px 0;">
      <div class="container">
        <div class="row">
           <div class="title-area">
            <h2 class="tittle">Contact to <span>Jobtip</span></h2>
            <span class="tittle-line"></span>     
          </div>
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

@stop

@section('javascript')

<script type="text/javascript">
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


var images = new Array ('skill.png', 'job.png');
var index = 1;
 
function rotateImage()
{
  $('#myImage').fadeOut('slow', function()
  {
    $(this).attr('src', images[index]);
 
    $(this).fadeIn('slow', function()
    {
      if (index == images.length-1)
      {
        index = 0;
      }
      else
      {
        index++;
      }
    });
  });
}
 
$(document).ready(function()
{
  setInterval (rotateImage, 3000);
});
</script>

@stop