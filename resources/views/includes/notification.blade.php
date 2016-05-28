<form>
<li class="dropdown dropdown-extended dropdown-inbox notification-icon"  id="header_inbox_bar">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"  data-close-others="true">
            @if($notificationsCount == 0)
            <i class="icon-bell icon-color"></i>
            @elseif($notificationsCount > 0)
            <i class="icon-bell" style="color: #3DF9A2;font-size:20px;"></i>
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
          </form>