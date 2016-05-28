<!-- BEGIN SIDEBAR1 -->
<!-- <header id="header" class="alt">
  <nav id="nav">
    <ul>
      <li class="special">
        <a href="#menu" class="menuToggle"><span>Menu</span></a>
        <div id="menu">
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="generic.html">Generic</a></li>
            <li><a href="elements.html">Elements</a></li>
            <li><a href="#">Sign Up</a></li>
            <li><a href="#">Log In</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
</header> -->
<div class="page-sidebar-wrapper">
  <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
  <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->

  <div class="page-sidebar navbar-collapse collapse " >
  <!--  <div class="navigation-bar"><a href="javascript:;" id="mobile-nav" class="menu-toggler responsive-toggler toggle-disp" data-toggle="collapse" data-target=".navbar-collapse">
      <i class="fa fa-bars" style="font-size: 18px;"></i>
    </a>
  </div> -->
   
    <!-- BEGIN SIDEBAR MENU1 -->
    <ul class="page-sidebar-menu page-sidebar-menu-compact page-sidebar-menu-hover-submenu thank-fav-icon-disp" data-slide-speed="200"  data-auto-scroll="false" data-slide-speed="200">
      
          <!-- BEGIN USER LOGIN DROPDOWN -->
      <li style="margin: 20px 0 10px 0;">
          <div class="btn-group post-ad-button" style="margin: 0 2px;">
              <a class="btn post-button" data-toggle="modal" href="#job-skill-post" style="padding: 5px 49.5px;">
                 Post Free Ad
              </a>
          </div>
      </li>
      <li style="margin:3px;">
        <div class="user-short-detail-container sidebar-image-box" style="width: 189px;">
          <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4">
              @if(Auth::user()->identifier == 1)
              <div class="profile-userpic user-image">
                @if($session_user->reg_via == 'facebook')
                  <img src="{{ $session_user->avatar }}" style="width:150px"/>
                @elseif($session_user->reg_via == 'google')
                  <img src="{{ $session_user->avatar }}0" style="width:150px"/>
                @else
                <a id="ajax-demo" href="#profile-pic" data-toggle="modal" class="config">
                    @if($session_user->profile_pic == null && $session_user->fname != null)
                      <div class="hover-image"><i class="fa fa-camera"></i> Add</div>
                    @endif      
                    @if($session_user->profile_pic != null)
                      <img src="/img/profile/{{ $session_user->profile_pic }}" class="">
                      <div class="hover-image"><i class="glyphicon glyphicon-edit"></i>Edit</div>
                    @else
                      <img src="/img/profile/{{ $session_user->profile_pic }}" class="demo-new" data-name="{{$session_user->fname}}">
                      <div class="hover-image"><i class="glyphicon glyphicon-edit"></i>Edit</div>
                    @endif
                </a>
                @endif

              </div>

              <!-- <div-> id="g1" class="gauge"></div>
              <div style="font-size: 10px;margin: -15px 12px 0px;float: right;">Profile Complete</div> -->
              @else
              <div class="profile-userpic-corp user-image">
                <a id="ajax-demo" href="#profile-pic" data-toggle="modal" class="config">
                    @if($session_user->logo_status == null && $session_user->firm_name != null)
                      <div class="hover-image">Add</div>
                    @endif
                    @if($session_user->logo_status != null)
                      <img src="/img/profile/{{ $session_user->logo_status }}">
                      <div class="hover-image"><i class="glyphicon glyphicon-edit"></i>Edit</div>
                    @endif       
                </a>
              </div>
              <div style="margin: 10px 0 -15px 0;"> 
                  <label style="font-size:12px;">
                 <span class="badge badge-default @if($followCount > 0) show @else hide @endif" style="font-weight:500;background-color: transparent !important;border:1px solid white;">
                  {{$followCount}} Followers </span></label>
              </div>
              @endif
            </div>
            <div class="col-md-8 col-sm-8 col-xs-8">
              <h3 class="form-title user-name">
                @if(Auth::user()->identifier == 1)
               <a style="color: #13B0E2;text-decoration: none;font-size: 16px;font-weight: 500;" href="/profile/ind/{{$session_user->id}}" data-utype="ind"> 
                {{ $session_user->fname }} </a>&nbsp;
                
                @else
                <a style="color: #13B0E2;text-decoration: none;font-size: 16px;font-weight: 500;" class="" href="/profile/corp/{{$session_user->id}}" data-utype="corp"> 
                 {{ $session_user->firm_name }} 
                </a>
                @endif
              </h3>
              @if(Auth::user()->identifier == 1)
                @if($session_user->working_status == "Student" && $session_user->education != null)
                <div class="profile-usertitle-job">
                  
                   Student
                </div>
                @elseif($session_user->working_status == "Searching Job")
                <div class="profile-usertitle-job">
                   {{ $session_user->working_status }}
                </div>
                @elseif($session_user->working_status == "Freelanching")
                <div class="profile-usertitle-job">
                  @if($session_user->role != null)
                   {{ $session_user->role }}
                  @endif
                </div>
                @elseif($session_user->role != null && $session_user->working_at !=null && $session_user->working_status == "Working")
                <div class="profile-usertitle-job">

                  @if($session_user->role != null)
                   {{ $session_user->role }} 
                   @endif
                </div>
                @elseif($session_user->role != null && $session_user->working_at ==null && $session_user->working_status == "Working")
                <div class="profile-usertitle-job">
                  @if($session_user->role != null)
                   {{ $session_user->role }}
                   @endif
                </div>
                @elseif($session_user->role == null && $session_user->working_at !=null && $session_user->working_status == "Working")
                <div class="profile-usertitle-job">
                   {{ $session_user->woring_at }}
                </div>
                @endif
              @endif
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
              @if($profilePer <= 25)
              <div class="progress" style="margin: 3px;border-radius: 13px !important;height:10px;background-color: #ddd;">
                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" style="width:{{$profilePer}}%;color:black;">
                  
                </div>
              </div>
              <label style="font-size:12px;color:#777;"> {{$profilePer}}% Profile Complete</label>
              @elseif($profilePer > 25 && $profilePer <=50)
             <div class="progress" style="margin: 3px;border-radius: 13px !important;height:10px;background-color: #ddd;">
                <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" style="width:{{$profilePer}}%;color:black;">
                  
                </div>
              </div>
              <label style="font-size:12px;color:#777;"> {{$profilePer}}% Profile Complete</label>
              @elseif($profilePer > 50 && $profilePer <=75)
              <div class="progress" style="margin: 3px;border-radius: 13px !important;height:10px;background-color: #ddd;">
                <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" style="width:{{$profilePer}}%;color:black;">
                  
                </div>
              </div>
               <label style="font-size:12px;color:#777;"> {{$profilePer}}% Profile Complete</label>
              @elseif($profilePer > 75)
              <div class="progress" style="margin: 3px;border-radius: 13px !important;height:10px;background-color: #ddd;">
                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" style="width:{{$profilePer}}%;color:black;background-color: #27D8CD;">
                   
                </div>
              </div>
              <label style="font-size:12px;color:#777;"> {{$profilePer}}% Profile Complete</label>
              @endif
            </div>
          </div> 
        </div>
      </li>
      @if (Auth::user()->identifier == 1)
      <li class="@if($title == 'home'){{'active'}}@endif">
        <a class="" href="/home">
        <i class=" icon-home"></i>
        <span class="title">
        Home</span>
        <span class="selected">
        </span>
        </a>
      </li>
      <li class="@if($title == 'indprofile_edit'){{'active'}}@endif">
        <a class="" href="/individual/edit">
        <i class="icon-link"></i>
        <span class="title">
        My Profile</span>
        <span class="selected">
        </span>
        </a>
      </li>
      <li class="@if($title == 'mypost'){{'active'}}@endif">
        <a class="" href="/mypost">
        <i class=" icon-note"></i>
        <span class="title">
        My Activity</span>
        <span class="selected">
        </span>
        </a>
      </li>
      @endif
      @if (Auth::user()->identifier == 2)
      <li class="@if($title == 'home'){{'active'}}@endif">
        <a class="" href="/home">
        <i class=" icon-home"></i>
        <span class="title">
        Home</span>
        <span class="selected">
        </span>
        </a>
      </li>
      <li class="@if($title == 'corpprofile_edit'){{'active'}}@endif">
        <a class="" href="/corporate/edit">
        <i class="icon-link"></i>
        <span class="title">
        My Profile</span>
        <span class="selected">
        </span>
        </a>
      </li>
      <li class="@if($title == 'mypost'){{'active'}}@endif">
        <a class="" href="/mypost">
        <i class=" icon-note"></i>
        <span class="title">
        My Activity</span>
        <span class="selected">
        </span>
        </a>
      </li>
      @endif
      @if (Auth::user()->identifier == 1)
      
      <li class="@if($title == 'links'){{'active'}}@endif">
        <a class="" href="/links">
        <i class="icon-link"></i>
        <span class="title">
        Links</span>
        <span class="selected">
        </span>
        </a>
      </li>
      <li class="@if($title == 'group'){{'active'}}@endif">
        <a class="" href="/group">
        <i class="icon-users"></i>
        <span class="title">
        Groups</span>
        <span class="selected">
        </span>
        </a>
      </li>
      @endif
      @if (Auth::user()->identifier == 2)

      <li class="@if($title == 'favouriteprofile'){{'active'}}@endif">
        <a class="" href="/favouriteProfile">
        <i class="icon-users"></i>
        <span class="title">
        Saved Profile</span>
        <span class="selected">
        </span>
        </a>
      </li>
      @endif
      
      @if (Auth::user()->identifier == 1 || Auth::user()->identifier == 2)
      <li class="@if($title == 'feedback'){{'active'}}@endif">
        <a href="/feedback/create">
              <i class="icon-star"></i>&nbsp;Feedback
              <span class="selected">
        </span>
            </a>

      </li>
      @endif
      <li class="@if($title == 'AccountSetting'){{'active'}}@endif">
        <a href="/accountsetting">
        <i class="icon-settings"></i>
        <span class="title">
        Setting </span>
        <span class="selected">
        </span>
        </a>
      </li>
      @if (Auth::guest())
      @else
          <li class="last">
            <a href="{{ url('/auth/logout') }}">
              <i class="icon-logout"></i>
              <span class="title">Log Out</span>
              <span class="selected">
            </span>        
            </a>
          </li>
      @endif
    </ul>
    <!-- END SIDEBAR MENU1 -->
  </div>
</div>
<!-- END SIDEBAR1-->
