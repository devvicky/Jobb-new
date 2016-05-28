<!-- BEGIN HEADER -->
<div class="page-header">
	<!-- BEGIN HEADER TOP -->
	<div class="page-header-top">
		<div class="container">
			<!-- BEGIN LOGO -->
			<div class="page-logo @if($title == 'home'){{'active'}}@endif">
		      <a class="" href="/home"><img src="/assets/logo.png" class="big-logo" />
		      <img src="/assets/small-logo.png" class="small-logo" />  </a>
		    </div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="menu-toggler"></a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<!-- BEGIN NOTIFICATION DROPDOWN -->
					<li class="dropdown dropdown-extended dropdown-dark dropdown-notification" id="header_notification_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"  data-close-others="true">
				            
				            @if($thanksCount > 0)
				            <i class="icon-like" style="color: #2196F3;"></i>
				            @elseif($thanksCount == 0)
				            <i class="icon-like" style=""></i>
				            @endif
				            <span class="badge badge-notification thanks-position badge-default @if($thanksCount > 0) show @else hide @endif" id="like-count">{{$thanksCount}}</span>
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
					<!-- END NOTIFICATION DROPDOWN -->
					<li class="droddown dropdown-separator">
						<!-- <span class="separator"></span> -->
					</li>
					<!-- BEGIN INBOX DROPDOWN -->
					<li class="dropdown dropdown-extended dropdown-dark dropdown-inbox" id="header_inbox_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"  data-close-others="true">
						<span class="circle  @if($notificationsCount > 0) show @else hide @endif">{{$notificationsCount}}</span>
						<span class="corner @if($notificationsCount > 0) show @else hide @endif"></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-notifications dropmenu-notification">
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
					<!-- END INBOX DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						
						@if($session_user->profile_pic != null && Auth::user()->identifier == 1)
						<img alt="" class="img-circle" src="/img/profile/{{ $session_user->profile_pic }}">
						<i class="fa fa-angle-down" style="margin: 8px 5px 0px -5px;"></i>
						@elseif($session_user->logo_status != null && Auth::user()->identifier == 2)
						<img alt="" class="" src="/img/profile/{{ $session_user->logo_status }}">
						<i class="fa fa-angle-down" style="margin: 8px 5px 0px -5px;"></i>
						@elseif($session_user->profile_pic == null && Auth::user()->identifier == 1)
						<span class="header-noprofile-image-icon-border">
							<i class="fa fa-user header-noprofile-image-icon"></i>
						</span>
						<i class="fa fa-angle-down" style="margin: 10px 5px 0px 0px;"></i>
						@elseif($session_user->logo_status == null && Auth::user()->identifier == 2)
						<span class="header-noprofile-image-corp-icon-border">
							<i class="fa fa-university header-noprofile-image-corp-icon"></i>
						</span>
						<i class="fa fa-angle-down" style="margin: 10px 5px 0px 0px;"></i>
						@endif
						
						 @if(Auth::user()->identifier == 1)
		               	<span class="username username-hide-mobile">
		                {{ $session_user->fname }}</span>
		                
		                @else
		                <span class="username username-hide-mobile">
		                 {{ $session_user->firm_name }} </span>
		                @endif
						</a>
						<ul class="dropdown-menu dropdown-menu-user dropdown-menu-default" style="    background-color: #444D58 !important;">
							<li>
								<a class="@if($title == 'notify_view'){{'active'}}@endif" 
			                    href="/notify/notification/@if(Auth::user()->identifier==1){{'ind'}}@elseif(Auth::user()->identifier==2){{'corp'}}@endif/{{Auth::user()->induser_id}}{{Auth::user()->corpuser_id}}" 
			                    data-utype="app">
								<i class="icon-bell"></i>Notification <span class=" notification-dropdown-position @if($notificationsCount > 0) show @else hide @endif">{{$notificationsCount}}</span></a>
							</li>
							<li>
								<a href="/favourite" data-utype="fav" class="@if($title == 'notify_view'){{'active'}}@endif" >
									<i class="icon-star" style="color: #FF9800;"></i> Favourite <span class="myfavcount favouite-user-dropdown badge-favourite badge-default @if(count($favourites) > 0) show @else hide @endif" 
					                    id="myfavcount" style="">{{count($favourites)}}
					              </span>
					            </a>
							</li>
							@if(Auth::user()->identifier == 1)
							<li>
								<a href="/profile/ind/{{$session_user->id}}">
									<i class="icon-user"></i> My Profile 
									@if($profilePer <= 25)
									<span class="profile-complete-user-dropdown profile-complete-color-danger badge-default" >{{$profilePer}}%</span>
									@elseif($profilePer > 25 && $profilePer <=50)
									<span class="profile-complete-user-dropdown profile-complete-color-warning badge-default" >{{$profilePer}}%</span>
									@elseif($profilePer > 50 && $profilePer <=75)
									<span class="profile-complete-user-dropdown profile-complete-color-info badge-default" >{{$profilePer}}%</span>
									@elseif($profilePer > 75)
									<span class="profile-complete-user-dropdown profile-complete-color-success badge-default" >{{$profilePer}}%</span>
									@endif
								
								<div class="row" style="margin:0;">
									<div class="col-md-2 col-sm-2 col-xs-2" style="padding:0;"></div>
									<div class="col-md-10 col-sm-10 col-xs-10" style="padding: 7px 0px 0 0px;">
						              @if($profilePer <= 25)
						              <div class="progress" style="margin: 3px;border-radius: 13px !important;height:4px;background-color: #ddd;">
						                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" style="width:{{$profilePer}}%;color:black;">
						                  
						                </div>
						              </div>
						              @elseif($profilePer > 25 && $profilePer <=50)
						             <div class="progress" style="margin: 3px;border-radius: 13px !important;height:4px;background-color: #ddd;">
						                <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" style="width:{{$profilePer}}%;color:black;">
						                  
						                </div>
						              </div>
						              @elseif($profilePer > 50 && $profilePer <=75)
						              <div class="progress" style="margin: 3px;border-radius: 13px !important;height:4px;background-color: #ddd;">
						                <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" style="width:{{$profilePer}}%;color:black;">
						                  
						                </div>
						              </div>
						              @elseif($profilePer > 75)
						              <div class="progress" style="margin: 3px;border-radius: 13px !important;height:4px;background-color: #ddd;">
						                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" style="width:{{$profilePer}}%;color:black;background-color: #27D8CD;">
						                   
						                </div>
						              </div>
						              @endif
						            </div>
						            <!-- <div class="col-md-2 col-sm-2 col-xs-2"></div> -->
								</div>
								</a>
							</li>
							@else
							<li>
								<a href="/profile/corp/{{$session_user->id}}">
								<i class="icon-calendar"></i>Company Profile </a>
							</li>
							@endif
							@if(Auth::user()->identifier == 1)
							<li>
								<a href="/mypost">
								<i class="icon-calendar"></i> My Post <span class="post-dropdown-position @if($postCount > 0) show @else hide @endif">
								{{$postCount}} </span></a>
							</li>
							<li>
								<a href="/mypost#tab_1_2">
								<i class="icon-calendar"></i>Activity Log </a>
							</li>
							<li>
								<a href="/links">
								<i class="icon-envelope-open"></i> Links <span class="user-dropdown-link @if($linkCount > 0) show @else hide @endif">
								{{$linkCount}} </span><span class="user-dropdown-linkrequest @if($linkrequest > 0) show @else hide @endif">
								{{$linkrequest}} New </span>
								</a>
							</li>
							<li>
								<a href="/links#tab_1_2">
								<i class="icon-rocket"></i> Groups <span class="group-dropdown-position @if($groupCount > 0) show @else hide @endif">
								{{$groupCount}} </span>
								</a>
							</li>
							@elseif(Auth::user()->identifier == 2)
							<li>
								<a href="/mypost">
								<i class="icon-calendar"></i> My Post <span class="post-dropdown-position-corp @if($postCount > 0) show @else hide @endif">
								{{$postCount}} </span></a>
							</li>
							@endif
							<li class="divider">
							</li>
							<!-- <li>
								<a href="extra_lock.html">
								<i class="icon-lock"></i> Lock Screen </a>
							</li> -->
							<li>
								<a href="{{ url('/auth/logout') }}">
								<i class="icon-key"></i> Log Out </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
	</div>
	<!-- END HEADER TOP -->
	<!-- BEGIN HEADER MENU -->
	<div class="page-header-menu">
		<div class="container">
			<!-- BEGIN HEADER SEARCH BOX -->
			<!-- <form class="search-form" action="extra_search.html" method="GET">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search" name="query">
					<span class="input-group-btn">
					<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
					</span>
				</div>
			</form> -->
			<!-- END HEADER SEARCH BOX -->
			<!-- Search -->
		      <form class="search-form search-form-expanded" id="header-search" action="/search/" method="GET">
		        <div class="input-group">
		          <input type="text" class="form-control search-field" 
		                 placeholder="Search..." name="query" pattern=".{3,}" required title="3 characters minimum"
		                 autocomplete="off">
		          <!-- <span class="input-group-btn as-span">
		            <a class="advance-search btn" data-toggle="modal" href="#advance">Advance</a>
		          </span> -->
		          <span class="input-group-btn">
		            <a class="btn submit"><i class="icon-magnifier" style="color: #333333;"></i></a>
		          </span>
		        </div>
		      </form>
		      <!-- end Search -->
			<!-- BEGIN MEGA MENU -->
			<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
			<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
			<div class="hor-menu ">
				<ul class="nav navbar-nav" style="padding: 0;">
		              <li class="@if($title == 'home'){{'active'}}@endif">
		                <a class="" href="/home">
		                <i class=" icon-home"></i>
		                <span class="title">
		                Home</span>
		                <span class="selected">
		                </span>
		                </a>
		              </li>
		              <li class="@if($title == 'job'){{'active'}}@endif">
		                <a class="" href="/job/create">
		                <i class="icon-link"></i>
		                <span class="title">
		                Post Job</span>
		                <span class="selected">
		                </span>
		                </a>
		              </li>
		              @if (Auth::user()->identifier == 1)
		              <li class="@if($title == 'skill'){{'active'}}@endif">
		                <a class="" href="/skill/create">
		                <i class="icon-users"></i>
		                <span class="title">
		                Promote Skill</span>
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
		                <a href="/individual/edit#tab_1_4">
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
			</div>
			<!-- END MEGA MENU -->
		</div>
	</div>
	<!-- END HEADER MENU -->
</div>
<!-- END HEADER -->