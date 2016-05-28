<div class="row post-item ">
    <div class="col-md-7 home-post">
        <div class="timeline" >
            <!-- TIMELINE ITEM -->
            <div class="timeline-item time-item" itemscope itemtype="http://schema.org/Article">
                @if($skill->induser->profile_pic != null && $skill->individual_id != null)
                <div class="timeline-badge badge-margin">
                    <img class="timeline-badge-userpic userpic-box"  src="/img/profile/{{ $skill->induser->profile_pic }}" alt="logo">      
                </div>
                @elseif($skill->induser->profile_pic == null && $skill->individual_id != null)
                <div class="timeline-badge badge-margin" style="border: 1px solid lightgray;border-radius: 23px;">
                    <i class="fa fa-user" style="font-size:25px;margin: 14px 11.5px;color: lightgray;"></i> 
                </div>
                @endif
                <div class="post-hover-act" data-postid="{{$skill->id}}">
                    <!-- <a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts"> -->
                    @if($skill->post_type == 'job')
                        <a href="/job/post/{{$skill->unique_id}}" target="_blank">
                    @elseif($skill->post_type == 'skill')
                       <a href="/skill/post/{{$skill->unique_id}}" target="_blank">
                    @endif
                    <div class="row post-postision" style="cursor:pointer;">
                        <div class="col-md-12">
                            <div class="post-title-new capitalize" itemprop="name">
                                @if($skill->individual_id != Auth::user()->induser_id && Auth::user()->identifier == 1)                                               
                                    @if($skill->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-2">
                                    </div> -->
                                    @elseif($skill->postactivity->where('user_id', Auth::user()->id)->first()->apply == 1)
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-2"  style="line-height: 1.9;">                                                     -->
                                        <i class="fa fa-check-square-o" style="font-size: 15px;color: #1C55C1;"></i>&nbsp;&nbsp;
                                    <!-- </div> -->
                                    @elseif($skill->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1)
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-2"  style="line-height: 1.9;">                                                     -->
                                        <i class="fa fa-check-square-o" style="font-size: 15px;color: #1C55C1;"></i> &nbsp;&nbsp;
                                    <!-- </div> -->
                                    @endif
                                @endif 
                                {{ $skill->post_title }}</div>
                        </div>
                        @if($skill->post_compname != null)
                        <div class="col-md-12" style="margin-bottom: 5px;">
                            <div>
                                <small class="" style="font-size:13px;color:dimgrey !important;">
                                    Required at {{ $skill->post_compname }}
                                </small>
                            </div>
                        </div>
                        @endif
                        <?php $skillSkills = []; 
                                        $skillSkillArr = array_map('trim', explode(',', $skill->linked_skill));
                                        $userSkillArr = array_map('trim', explode(',', Auth::user()->induser->linked_skill));
                                    ?>
                                    <?php 
                                        $matchedPost = array_intersect($skillSkillArr, $userSkillArr);
                                        $unmatchedPost = array_diff($skillSkillArr, $userSkillArr);
                                    ?>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            
                            <div class=" capitalize" itemprop="name" style="font-size:13px;color:dimgrey !important;">
                         @if($skill->post_type == 'job')  <label class="label-success job-type-skill-css">{{$skill->post_type}}</label> @endif                                                                                                                             
                                                    @foreach($matchedPost as $m)
                                                        <label class="label-success matched-skill-css">{{$m}}</label>
                                                    @endforeach
                                                    @foreach($unmatchedPost as $um)
                                                      <label class="label-success skill-label">{{$um}}</label>
                                                    @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row post-postision" style="">
                        
                        @if($skill->min_exp != null && $skill->post_type == 'job')
                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">
                            <small style="font-size:13px;color:dimgrey !important;"> 
                                <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $skill->min_exp }} Yr
                            </small>
                        </div>
                        @elseif($skill->min_exp != null && $skill->post_type == 'skill')
                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">
                            @if($skill->min_exp == 0)
                            <small style="font-size:13px;color:dimgrey !important;"> 
                                <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: Fresher
                            </small>
                            @else
                            <small style="font-size:13px;color:dimgrey !important;"> 
                                <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $skill->min_exp }} Yr
                            </small>
                            @endif
                        </div>
                        @endif
                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code elipsis-city-code" style="padding:0 12px;">
                            <small style="font-size:13px;color:dimgrey !important;"> 
                                <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{ $city or 'unspecified'}}
                            </small>
                        </div>    
                       
                    </div>
                    </a>
                </div>
                <div class="row" style="margin: 5px 0px;">
                    <div class="col-md-12" style="margin: 3px -13px;">
                        <div class="row" style="">
                            @if($skill->post_type == 'job') 
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                
                            </div>
                            @elseif($skill->post_type == 'skill')
                            <div class="col-md-5 col-sm-5 col-xs-5" style="margin: 8px 1px;">
                                @if($skill->time_for == 'Work from Home')
                                <small class="label-success label-xs elipsis-code job-type-skill-css" style="padding:2px 5px !important;">Work From Home</small>
                                @else
                                <div><small class="label-success job-type-skill-css" style="padding:2px 5px !important;">{{$skillType}}</small></div>
                                @endif
                            </div>
                            @endif
                            <div class="col-md-5 col-sm-5 col-xs-5" style="line-height: 1.9;">
                                @if($skill->post_type == 'job')
                                    <a href="/job/post/{{$skill->unique_id}}" target="_blank">
                                @elseif($skill->post_type == 'skill')
                                   <a href="/skill/post/{{$skill->unique_id}}" target="_blank">
                                @endif
                                <button class="btn btn-sm btn-primary view-detail-btn" style="border-radius: 25px !important;">View Detail</button>
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2" style="margin: 5px -12px;">
                                @if(Auth::user()->induser_id != $skill->individual_id )
                                <form action="/job/fav" method="post" id="post-fav-{{$skill->id}}" data-id="{{$skill->id}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="fav_post" value="{{ $skill->id }}">

                                    <button class="btn fav-btn " type="button" 
                                            style="background-color: transparent;padding:0 10px;border:0">
                                        @if($skill->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                        <i class="fa fa-star" id="fav-btn-{{$skill->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
                                        @elseif($skill->postactivity->where('user_id', Auth::user()->id)->first()->fav_post == 1) 
                                        <i class="fa fa-star" id="fav-btn-{{$skill->id}}" style="font-size: 20px;color:#FFC823;"></i>
                                        @else
                                        <i class="fa fa-star" id="fav-btn-{{$skill->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
                                        @endif  
                                    </button>   
                                </form>
                                @endif
                            </div>  
                        </div>
                    </div>                                                                                          
                </div>                                          
            </div>
        </div>
    </div>
</div>




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