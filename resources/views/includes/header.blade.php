<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top nav-disp" id="nav-display">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner container nav-fixed-css" style="">
    <!-- BEGIN LOGO -->
      <div class="page-logo @if($title == 'home'){{'active'}}@endif">
      <a class="" href="/home"><img src="/assets/logo.png" class="big-logo" />
      <img src="/assets/small-logo.png" class="small-logo" />  </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler toggle-display" data-toggle="collapse" data-target=".navbar-collapse">
      <i class="fa fa-bars" style="color: #eeeeee;"></i>
    </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN PAGE ACTIONS -->
    <!-- DOC: Remove "hide" class to enable the page header actions -->
    <div class="page-actions ">
      <!-- <form class="search-form search-form-expanded" action="extra_search.html" method="GET">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search..." name="query">
          <span class="input-group-btn">
          <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
          </span>
        </div>
      </form> -->
      
      <div class="top-menu">
        <ul class="nav navbar-nav ">
          <!-- BEGIN NOTIFICATION DROPDOWN -->
          <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
          
          <li class="dropdown dropdown-extended dropdown-inbox notification-icon"  id="header_inbox_bar">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"  data-close-others="true">
            @if($notificationsCount == 0)
            <i class="icon-bell icon-color" style="font-size:17px;"></i>
            @elseif($notificationsCount > 0)
            <i class="icon-bell" style="color: #3DF9A2;font-size:17px;"></i>
            @endif
            <span class="badge badge-notification badge-default @if($notificationsCount > 0) show @else hide @endif" style="background-color: lightcoral !important;">{{$notificationsCount}}</span>
            </a>
            <ul class="dropdown-menu dropmenu-notification">
              <li class="external" style="background-color: #1F1F1F;margin: -4px 0;">
                @if($notificationsCount > 0)
                <h3 style="color: #D7D7FF;font-weight: 500;">{{$notificationsCount}} New  Notification</h3>
                @else
                <h3 style="color: #D7D7FF;font-weight: 500;"> No New Notification</h3>
                @endif
                @if($notificationsCount > 0)
                <a class="@if($title == 'notify_view'){{'active'}}@endif" 
                    href="/notify/notification/@if(Auth::user()->identifier==1){{'ind'}}@elseif(Auth::user()->identifier==2){{'corp'}}@endif/{{Auth::user()->induser_id}}{{Auth::user()->corpuser_id}}" 
                    data-utype="app" style="color: #D7D7FF;">view all</a>
                @endif
              </li>
              <li>
                <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283" id="notification-list">
                  @foreach($notifications as $not)
                  
                  <li>

                    @if($not->operation == 'link request' || $not->operation == 'link response')
                    <a href="#" data-nid="{{$not->id}}" data-lnkt="notification" data-anchor="links" 
                      @if($not->view_status == 0)style="background:#2e343b"@endif>
                    @elseif($not->operation == 'job contact')
                    <a href="#" data-nid="{{$not->id}}" data-lnkt="notification" data-anchor="mypost" 
                      @if($not->view_status == 0)style="background:#2e343b"@endif>
                    @elseif($not->operation == 'group')
                    <a href="#" data-nid="{{$not->id}}" data-lnkt="notification" data-anchor="group" 
                      @if($not->view_status == 0)style="background:#2e343b"@endif>
                    @elseif($not->operation == 'user tagging')
                    <a href="#" data-nid="{{$not->id}}" data-lnkt="notification" data-anchor="home" 
                      @if($not->view_status == 0)style="background:#2e343b"@endif>
                    @elseif($not->operation == 'post sharing')
                    <a href="#" data-nid="{{$not->id}}" data-lnkt="notification" data-anchor="home" 
                      @if($not->view_status == 0)style="background:#2e343b"@endif>
                    @elseif($not->operation == 'job expire')
                    <a href="#" data-nid="{{$not->id}}" data-lnkt="notification" data-anchor="home" 
                      @if($not->view_status == 0)style="background:#2e343b"@endif>
                    @else
                    <a href="#" data-nid="{{$not->id}}" data-lnkt="notification" data-anchor="home" 
                      @if($not->view_status == 0)style="background:#2e343b"@endif>
                    @endif

                      <span class="photo">
                      @if($not->fromuser != null)
                        @if($not->fromuser->first()->induser != null)
                          
                          <img src="@if($not->fromuser->first()->induser->profile_pic != null){{ '/img/profile/'.$not->fromuser->first()->induser->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" class="img-circle" width="40" height="40">                        
                          
                        @elseif($not->fromuser->first()->corpuser != null)
                          
                          <img src="@if($not->fromuser->first()->corpuser->logo_status != null){{ '/img/profile/'.$not->fromuser->first()->corpuser->logo_status }}@else{{'/assets/images/ab.png'}}@endif" class="img-circle" width="40" height="40">
                          {{-- <div class=""><i class="icon-speedometer"></i> 55%</div> --}}
                         
                        @endif
                      @else
                        <img src="/assets/images/ab.png" class="img-circle" width="40" height="40">                 
                      @endif
                      </span>
                      <span class="subject">
                        @if($not->fromuser != null && $not->touser != null)
                        <span class="from" style="color: #61B7FF;">
                          {{$not->fromuser->first()->name}} 
                        </span>
                        @else
                          Jobtip
                        @endif
                        <span class="time" style="color: aliceblue;">
                          {{ \Carbon\Carbon::createFromTimeStamp(strtotime($not->created_at))->diffForHumans() }}
                        </span>
                      </span>
                      @if($not->view_status == 0)
                      <span class="message" style="color:whitesmoke;">
                      {{$not->remark}} </span>
                      @else
                      <span class="message" style="color: #C7C7C7;">
                      {{$not->remark}} </span>
                      @endif
                    </a>
                  </li>
              
                 @endforeach
                </ul>
              </li>
            </ul>
          </li>
        
          <!-- END NOTIFICATION DROPDOWN -->
          <li class="dropdown dropdown-extended dropdown-inbox thank-fav-icon" id="header_inbox_bar">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"  data-close-others="true">
            @if($thanksCount > 0)
            <i class="icon-like" style="color: #CBF9CB; font-size:17px !important;"></i>
            @elseif($thanksCount == 0)
            <i class="icon-like icon-color" style="font-size:17px !important;"></i>
            @endif
            <span class="badge badge-default badge-thanks  @if($thanksCount > 0) show @else hide @endif" id="like-count" style="background-color:lightcoral !important;">{{$thanksCount}}</span>
            </a>
            <ul class="dropdown-menu dropmenu-notification">
              <li class="external" style="background-color: #1F1F1F;margin: -4px 0;">
                @if($thanksCount > 0)
                <h3 style="color: #D7D7FF;font-weight: 500;">{{$thanksCount}} New  Thanks</h3>
                @else
                <h3 style="color: #D7D7FF;font-weight: 500;"> No Thanks</h3>
                @endif
                @if($thanksCount > 0)
                <a class="@if($title == 'notify_view'){{'active'}}@endif" 
                    href="/notify/thanks/@if(Auth::user()->identifier==1){{'ind'}}@elseif(Auth::user()->identifier==2){{'corp'}}@endif/{{Auth::user()->induser_id}}{{Auth::user()->corpuser_id}}" data-utype="thank" style="color: #D7D7FF;">view all</a>
                @endif
              </li>
              <li>
                <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283" id="notification-list">
                  @foreach($thanks as $not)
                    <li>
                      <a href="">
                      <span class="photo">
                      @if($not->fromuser != null)
                        @if($not->fromuser->first()->induser != null)
                          
                          <img src="@if($not->fromuser->first()->induser->profile_pic != null){{ '/img/profile/'.$not->fromuser->first()->induser->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" class="img-circle" width="40" height="40">                        
                          
                        @elseif($not->fromuser->first()->corpuser != null)
                          
                          <img src="@if($not->fromuser->first()->corpuser->logo_status != null){{ '/img/profile/'.$not->fromuser->first()->corpuser->logo_status }}@else{{'/assets/images/ab.png'}}@endif" class="img-circle" width="40" height="40">
                         
                        @endif
                      @else
                        <img src="/assets/images/ab.png" class="img-circle" width="40" height="40">                 
                      @endif
                      </span>
                      <span class="subject">
                      <span class="from" style="color: #61B7FF;">
                      {{$not->user->name}}</span>
                      <span class="time" style="color:aliceblue;">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($not->thanks_dtTime))->diffForHumans() }} </span>
                      </span>
                      <span class="message" style="color:whitesmoke;">
                      has thanked your post : {{$not->unique_id}} </span>
                      </a>
                    </li>
                 @endforeach
                </ul>
              </li>
            </ul>
          </li>
          <!-- BEGIN INBOX DROPDOWN -->
          <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
          <li class="dropdown dropdown-extended dropdown-tasks thank-fav-icon" id="header_task_bar">
            <a href="/favourite" data-utype="fav" class="dropdown-toggle @if($title == 'notify_view'){{'active'}}@endif"  data-close-others="true">
               @if(count($favourites) > 0)
              <i class="icon-star" style="color: #F7D672; font-size:17px !important;"></i>
              @elseif(count($favourites) == 0)
              <i class="icon-star icon-color" style="font-size:17px !important;"></i>
              @endif
                            
              <span class="myfavcount badge badge-favourite badge-default @if(count($favourites) > 0) show @else hide @endif" 
                    id="myfavcount" style="background-color:lightcoral;">{{count($favourites)}}
              </span>              
            </a>            
          </li>
           <!-- <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
            
          </li> -->
          <!-- END TODO DROPDOWN -->
          <!-- BEGIN USER LOGIN DROPDOWN -->
          <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
          
          <!-- END USER LOGIN DROPDOWN -->
        </ul>
        <div class="btn-group post-ad-header" style="margin: 0px 17px;float:right">
            <a class="btn post-button" data-toggle="modal" href="#job-skill-post">
               Post Free Ad
            </a>
        </div>
      </div>
      <!-- Search -->
      <form class="search-form search-form-expanded" id="header-search" action="/search/" method="GET">
        <div class="input-group search-input-box">
          <input type="text" class="form-control search-field" 
                 placeholder="Search..." name="query" pattern=".{3,}" required title="3 characters minimum"
                 autocomplete="off">
          <!-- <span class="input-group-btn as-span">
            <a class="advance-search btn" data-toggle="modal" href="#advance">Advance</a>
          </span> -->
          <span class="input-group-btn">
            <a class="btn submit"><i class="icon-magnifier" style="color: whitesmoke;"></i></a>
          </span>
        </div>
      </form>
      <!-- end Search -->
      
      </div>
    <!-- END PAGE ACTIONS -->
    <!-- BEGIN PAGE TOP -->
    <div class="page-top">
      <!-- BEGIN HEADER SEARCH BOX -->
      <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
      
      <!-- END HEADER SEARCH BOX -->
      <!-- BEGIN TOP NAVIGATION MENU -->
    
      <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END PAGE TOP -->
  </div>
  <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->


<div class="modal fade" id="myactivity-post" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog-new">
    <div class="modal-content">
      <div id="myactivity-post-content">
        My Activity Post 
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->