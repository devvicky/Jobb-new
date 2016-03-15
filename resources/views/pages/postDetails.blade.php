@extends('master')
@section('content')
<div class="row" style="margin:0;">
    <div class="col-md-8" style="text-align: center;margin: 5px 0 -15px 0;">
        <h4 class="uppercase btn-success singlepost-title">
            <label class="">{{$post->post_type}} Detail</label> ({{$post->unique_id}})
        </h4>
    </div>
</div>
<?php $var = 1; ?>
<div class="portlet light bordered" 
 style="border: none !important; background:transparent; margin: 20px 0px;">                                     
<div class="portlet-body form" id="posts">
    <div class="form-body" id="post-items" style="padding:0;">                                          
        <div class="row post-item" >
                        <?php $groupsTagged = array(); ?>
                        @foreach($post->groupTagged as $gt)
                            <?php $groupsTagged[] = $gt->group_id; ?>
                        @endforeach
                        <?php 
                            $strNew = '+'.$post->post_duration.' day';
                            $strOld = $post->created_at;
                            $fresh = $strOld->modify($strNew);

                            $currentDate = new \DateTime();
                            $expiryDate = new \DateTime($fresh);
                            // $difference = $expiryDate->diff($currentDate);
                            // $remainingDays = $difference->format('%d');
                            if($currentDate >= $fresh){
                                $expired = 1;
                            }else{
                                $expired = 0;
                            }
                        ?>
                        <?php
                            $crossCheck = array_intersect($groupsTagged, $groups);
                            $elements = array_count_values($crossCheck); ?>

                        @if($post->tagged->contains('user_id', Auth::user()->induser_id) || 
                            $post->individual_id == Auth::user()->induser_id || 
                            count($elements) > 0 || 
                            (count($groupsTagged) == 0 && count($post->tagged) == 0))
                        <div class="col-md-8 home-post">

                            <div class="timeline" >
                                <!-- TIMELINE ITEM -->

                                @if($expired == 1)
                                <div class="timeline-item time-item-ex">
                                @else
                                <div class="timeline-item time-item">
                                @endif
                                    <div class="timeline-badge badge-margin">
                                    @if($post->induser != null && !empty($post->induser->profile_pic))
                                    <img class="timeline-badge-userpic userpic-box" src="/img/profile/{{ $post->induser->profile_pic }}" title="{{ $post->induser->fname }}">
                                    
                                    @elseif($post->corpuser != null && !empty($post->corpuser->logo_status))
                                    <img class="" src="/img/profile/{{ $post->corpuser->logo_status }}" title="{{ $post->corpuser->firm_name }}">
                                    
                                    @elseif(empty($post->corpuser->logo_status) && $post->corpuser != null )
                                    <img class="" src="/assets/images/corpnew.jpg">
                                    
                                    @elseif(empty($post->induser->profile_pic) && $post->induser != null)
                                    <img class="timeline-badge-userpic userpic-box" src="/assets/images/ab.png">
                                    
                                    @endif
                                    
                                </div>
                                    @include('partials.home.image-linked')
                                    @include('partials.home.favourite')

                                    <div class="row post-postision">
                                        <div class="col-md-12">
                                            <div class="post-title-new capitalize">{{ $post->post_title }} </div>
                                        </div>
                                        @if($post->post_compname != null && $post->post_type == 'job')
                                        <div class="col-md-12">
                                            <div><small class="capitalize" style="font-size:13px;color:dimgrey !important;">Required at {{ $post->post_compname }}</small></div>
                                        </div>
                                            
                                        @endif
                                    </div>
                                    <div class="row post-postision" style=""> 
                                        @if($post->min_exp != null)
                                        <div class="col-md-4 col-sm-4 col-xs-4" style="">
                                        <small style="font-size:13px;color:dimgrey !important;"> <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $post->min_exp}}-{{ $post->max_exp}} Yr</small>
                                        </div>
                                        @endif
                                        @if($post->city != null)
                                        <div class="col-md-8 col-sm-8 col-xs-8 elipsis-code-city" style="padding:0 12px;">
                                        <small style="font-size:13px;color:dimgrey !important;"> <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{ $post->city }}</small>
                                        </div>
                                        @endif 
                                    </div>

                                    <div class="row" style="margin: 5px 0px; border-top: 1px solid whitesmoke;">
                                        <div class="col-md-12" style="margin: 3px -13px;">
                                            
                                            @if($expired != 1)
                                        
                                            <div class="row" style="">  
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    @if(Auth::user()->identifier == 1 && $post->post_type == 'job' && Auth::user()->induser_id != $post->individual_id)
                                        <div class="match" style="float: left; margin: 0px 3px;">
                                            <?php $postSkills = array(); ?>
                                            @foreach($post->skills as $skill)
                                                <?php $postSkills[] = $skill->name; ?>
                                            @endforeach
                                            <?php 
                                                $overlap = array_intersect($userSkills, $postSkills);
                                                $counts  = array_count_values($overlap);
                                            ?>
                                            <!-- <div class="ribbon-wrapper3"> -->
                                                    <!-- <div class="ribbon-front3"> -->
                                                    
                                            <a data-toggle="modal" data-mpostid="{{$post->id}}" class="magic-font magicmatch-posts" href="#magicmatch-posts" style="color: white;line-height: 1.7;text-decoration: none;"> 
                                                @if($post->magic_match == 0)
                                                <button class="btn btn-success magic-match-css"><i class="icon-speedometer magic-font" style="font-size:12px;"></i> 
                                                    0 %
                                                </button>
                                                @else
                                                <button class="btn btn-success magic-match-css"><i class="icon-speedometer magic-font" style="font-size:12px;"></i> 
                                                    {{$post->magic_match}} %
                                                </button>
                                                @endif
                                            </a>
                                            
                                        </div>

                                        <!-- <div id="oval"></div> -->
                                            @endif
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding:0 8px;">
                                                    <form action="/job/like" method="post" id="post-like-{{$post->id}}" data-id="{{$post->id}}">                        
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="like" value="{{ $post->id }}">
                                                <button class="btn like-btn"  type="button" style="background-color: transparent;padding:3px;" title="Thanks">
                                                    @if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())                 
                                                         <i class="fa fa-thumbs-up thanks-icon" id="like-{{$post->id}}"></i>
                                                    @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->thanks == 1) 

                                                         <i class="fa fa-thumbs-up thanks-icon" id="like-{{$post->id}}" style="color:darkseagreen;"></i>

                                                    @else
                                                         <i class="fa fa-thumbs-up thanks-icon" id="like-{{$post->id}}"></i>        
                                                    @endif
                                                </button>
                                                <!-- <label  style="color:burlywood">Thanks </label>     -->
                                                        <span class="badge-like" id="like-count-{{ $post->id }}">
                                                        @if($post->postactivity->sum('thanks') > 0)
                                                        {{ $post->postactivity->sum('thanks') }}
                                                        @endif
                                                        </span>
                                                    </form> 
                                                </div>
                                                
                                                @if(Auth::user()->induser_id != $post->individual_id && Auth::user()->identifier == 1)                                      
                                                    
                                                    @if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                    </div>
                                                    @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->apply == 1)
                                                    <div class="col-md-3 col-sm-3 col-xs-3"  style="">                                                  
                                                        <i class="fa fa-check-square-o" style="font-size:13px;"></i><span style="font-size:12px;" class="applied-css hidden-sm hidden-xs"> Applied</span> 
                                                    </div>
                                                    
                                                    @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1)
                                                    <div class="col-md-3 col-sm-3 col-xs-3"  style="">                                                  
                                                        <i class="fa fa-check-square-o" style="font-size:13px;"></i><span style="font-size:12px;" class="hidden-sm hidden-xs"> Contacted</span> 
                                                    </div>
                                                    @else
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                    </div>
                                                    @endif
                                                @endif
                                                
                                                <div  class="col-md-3 col-sm-3 col-xs-3" style="">
                                                    <div class="dropup ">                                           
                                                        <button class="btn dropdown-toggle" type="button" 
                                                                data-toggle="dropdown" title="Share" 
                                                                style="background-color: transparent;border: 0;margin: 0px;">
                                                            <i class="fa fa-share-square-o" 
                                                                style="font-size: 19px;color: darkslateblue;"></i>
                                                            <span class="badge-share" id="share-count-{{ $post->id }}">@if($post->postactivity->sum('share') > 0){{ $post->postactivity->sum('share') }}@endif</span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-share-home" role="menu" 
                                                            style="min-width:0;box-shadow:0 0 !important;padding: 0;">
                                                            <li style="border-bottom: 1px solid #ddd;">
                                                                <a href="#share-post" 
                                                                   data-toggle="modal" 
                                                                   class="jobtip sojt" 
                                                                   id="sojt-{{$post->id}}" 
                                                                   data-share-post-id="{{$post->id}}">
                                                                    Share on Jobtip
                                                                </a>
                                                            </li>
                                                            <li style="border-bottom: 1px solid #ddd;">
                                                                <a href="#share-by-email" data-toggle="modal" onclick="setPostId({{$post->id}})" 
                                                                   class="jobtip sbmail" id="sbmail-{{$post->id}}" 
                                                                   data-share-post-id="{{$post->id}}">
                                                                    Share by email
                                                                </a>
                                                            </li>
                                                            <li style="padding: 4px 0 0px;margin: auto;display: table;">        
                                                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                                                <div class="addthis_sharing_toolbox" 
                                                                    data-url="http://jobtip.in/post/{{$post->unique_id}}/social" 
                                                                    data-title="{{$post->post_title}}"
                                                                    data-description="{{ $post->job_detail }}"
                                                                    data-media="http://jobtip.in/jt_logo.png">
                                                                </div>
                                                            </li>
                                                        </ul>                                                   
                                                    </div>
                                                    <div class="report-css">
                                             @if($expired != 1 && Auth::user()->induser_id != $post->individual_id )
                                                    <a data-toggle="modal" href="#basic-{{ $post->id }}">
                                                        <button class="report-button-css">
                                                            <i class="fa  fa-ellipsis-v" style="color:black;"></i>
                                                        </button>
                                                    </a>

                                                @endif
                                            <div class="modal fade" id="basic-{{ $post->id }}" tabindex="-1" role="basic" 
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" style="width: 300px;">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" 
                                                                            data-dismiss="modal" aria-hidden="true">
                                                                    </button>
                                                                    <h4 class="modal-title">Report this Post</h4>               
                                                                </div>
                                                                <form action="/report-abuse" method="post" id="report-abuse-form-{{ $post->id }}">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <input type="hidden" name="report_post_id" value="{{ $post->id }}">
                                                                <div class="modal-body">
                                                                    <div class="icheck-list">
                                                                        <label>
                                                                            <input type="checkbox" class="icheck" 
                                                                                    name="report-abuse-check[]"
                                                                                    data-checkbox="icheckbox_line-grey" 
                                                                                    data-label="Abusive post"
                                                                                    value="Abusive post" checked>
                                                                        </label>                                                
                                                                        <label>
                                                                            <input type="checkbox" class="icheck" 
                                                                                    name="report-abuse-check[]"
                                                                                    data-checkbox="icheckbox_line-grey" 
                                                                                    data-label="Abusive profile"
                                                                                    value="Abusive profile">
                                                                        </label>
                                                                        <label>
                                                                            <input type="checkbox" class="icheck"
                                                                                    name="report-abuse-check[]" 
                                                                                    data-checkbox="icheckbox_line-grey" 
                                                                                    data-label="Spam post"
                                                                                    value="Spam post">
                                                                        </label>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-warning btn-xs">Submit</button>
                                                                    <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Cancel</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->    
                                                    </div>
                                                </div>
                                                
                                                    
                                            </div>
                                        
                                            @else
                                            <div class="row" style="">
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    @if(Auth::user()->identifier == 1 && $post->post_type == 'job' && Auth::user()->induser_id != $post->individual_id)
                                                <div class="match" style="float: left; margin: 0px 3px;">
                                                    <?php $postSkills = array(); ?>
                                                    @foreach($post->skills as $skill)
                                                        <?php $postSkills[] = $skill->name; ?>
                                                    @endforeach
                                                    <?php 
                                                        $overlap = array_intersect($userSkills, $postSkills);
                                                        $counts  = array_count_values($overlap);
                                                    ?>
                                                    <a data-toggle="modal" data-mpostid="{{$post->id}}" class="magic-font magicmatch-posts" href="#magicmatch-posts" style="color: white;line-height: 1.7;text-decoration: none;"> 
                                                        @if($post->magic_match == 0)
                                                        <button class="btn btn-success magic-match-css"><i class="icon-speedometer magic-font" style="font-size:12px;"></i> 
                                                            0 %
                                                        </button>
                                                        @else
                                                        <button class="btn btn-success magic-match-css"><i class="icon-speedometer magic-font" style="font-size:12px;"></i> 
                                                            {{$post->magic_match}} %
                                                        </button>
                                                        @endif
                                                    </a>
                                                </div>
                                            @endif
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-6" style="font-size:12px;text-align:center">
                                                <!-- <div class="expired-css">                                                   -->
                                                    <i class="glyphicon glyphicon-ban-circle" style="font-size:12px;color:dimgrey;"></i> Post Expired
                                                <!-- </div> -->
                                                </div>
                                                
                                                @if(Auth::user()->induser_id != $post->individual_id && Auth::user()->identifier == 1)                                          
                                                    @if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                                    
                                                    @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->apply == 1)
                                                    <div class="col-md-3 col-sm-3 col-xs-3">                                                    
                                                        <i class="fa fa-check-square-o" style="font-size:13px;color:dimgrey;"></i><span style="font-size:12px;" class="hidden-sm hidden-xs"> Applied</span> 
                                                    </div>
                                                    @endif
                                                @endif
                                                @if(Auth::user()->induser_id != $post->individual_id && Auth::user()->identifier == 1)                                          
                                                    @if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                                    
                                                    @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1)
                                                    <div class="col-md-3 col-sm-3 col-xs-3">                                                    
                                                        <i class="fa fa-check-square-o" style="font-size:13px;color:dimgrey;"></i><span style="font-size:12px;" class="hidden-sm hidden-xs"> Contacted</span> 
                                                    </div>
                                                    @endif
                                                @endif
                                                
                                                
                                            </div>                                          
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="row" style="margin:0;">
                                    <h4 class="skill-display">Details:</h4>
                                    <div class="col-md-12">
                                        <div class="row">
                                            
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <label class="detail-label">Education :</label>     
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                @if($post->education == 'twelth')
                                                    12th
                                                @else
                                                {{$post->education}} 
                                                @endif    
                                            </div>
                                        </div>
                                        @if($post->job_role->first()->industry != null)
                                         <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6"> 
                                                    <label class="detail-label">Industry :</label>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                    {{ $post->job_role->first()->industry }}
                                            </div>
                                        </div>
                                        @endif
                                        @if($post->job_role->first()->functional_area != null)
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6"> 
                                                    <label class="detail-label">Functional Area :</label>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                    {{ $post->job_role->first()->functional_area }}
                                            </div>
                                        </div>
                                        @endif
                                        @if($post->job_role->first()->role != null)
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6"> 
                                                    <label class="detail-label">Role :</label>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                    {{ $post->job_role->first()->role }}
                                            </div>
                                        </div>
                                        @endif
                                        <div class="row"> 
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                    <label class="detail-label">Skills :</label>                                                                  
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                    {{$post->linked_skill}}
                                                 
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                    <label class="detail-label">Job Type :</label>                                                                  
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                    {{ $post->time_for }}
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            @if($post->locality != null && $post->city !=null)
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                    <label class="detail-label">Locality :</label>                                                                  
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                    {{ $post->locality }},{{ $post->city }} 
                                            </div>
                                            @elseif($post->locality == null && $post->city !=null)
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                    <label class="detail-label">Locality :</label>                                                                  
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                    {{ $post->city }} 
                                            </div>
                                            @endif
                                        </div>
                                        
                                         <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <label class="detail-label">Salary (<i class="fa fa-rupee (alias)"></i>):</label>
                                            </div>
                                            @if($post->min_sal != null)
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                    {{ $post->min_sal }}-{{ $post->max_sal }}/{{ $post->salary_type }}
                                            </div>
                                            @else
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                    Not disclose
                                            </div>
                                            @endif
                                        </div>
                                        <div class="skill-display">Description : </div>
                                        {{ $post->job_detail }}
                                        
                                        @if($post->post_type == 'job' && $post->reference_id != null)
                                        <div class="skill-display">Reference Id&nbsp;: {{ $post->reference_id }} </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                 @if($expired == 0 && Auth::user()->identifier == 1)
                                <div style="margin:27px 0 0;">
                                    <!-- if corporate_id not null -->
                                    @if($post->corporate_id != null && Auth::user()->id != $post->individual_id &&  Auth::user()->identifier == 1)     
                                        @if($post->postactivity->where('user_id', Auth::user()->induser_id)->isEmpty())

                                            <form action="/job/apply" method="post" id="post-apply-{{$post->id}}" data-id="{{$post->id}}">  
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="apply" value="{{ $post->id }}">
                                                @if($post->website_redirect_url != null)
                                                    <button class="btn apply-btn blue btn-sm apply-contact-btn" 
                                                        onclick="window.location='{{ $post->website_redirect_url }}';"   type="button">Apply
                                                    </button>   
                                                @else
                                                    <button class="btn apply-btn blue btn-sm apply-contact-btn" 
                                                            id="apply-btn-{{$post->id}}" type="button">Apply
                                                    </button>
                                                    @endif
                                            </form> 
                                        @elseif($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->apply == 1 && Auth::user()->identifier == 1) 
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-sm bg-grey-steel apply-contact-btn" disabled="true">
                                                    Applied
                                                </button>
                                            </div>
                                            <div id="applied_dTime" class="col-md-6">
                                                ({{ $post->postactivity->where('user_id', Auth::user()->id)->first()->apply_dtTime }})
                                            </div>
                                        @else
                                        <form action="/job/apply" method="post" id="post-apply-{{$post->id}}" data-id="{{$post->id}}">  
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="apply" value="{{ $post->id }}">
                                            <button class="btn apply-btn blue btn-sm apply-contact-btn" 
                                                    id="apply-btn-{{$post->id}}" type="button">Apply
                                            </button>
                                        </form>                         
                                        @endif
                                    
                                    @endif  
                                    @if($post->individual_id != null && Auth::user()->id != $post->individual_id && Auth::user()->identifier == 1)       
                                        @if($post->postactivity->where('user_id', Auth::user()->induser_id)->isEmpty())
                                            <form action="/job/contact" method="post" id="post-contact-{{$post->id}}" data-id="{{$post->id}}">  
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="contact" value="{{ $post->id }}">
                                                <button class="btn contact-btn green btn-sm apply-contact-btn" 
                                                        id="contact-btn-{{$post->id}}" type="button">Contact
                                                </button>
                                            </form> 
                                        @elseif($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->contact_view == 1) 
                                             <div class="col-md-6">
                                                <button type="button" class="btn btn-sm bg-grey-steel apply-contact-btn" disabled="true">
                                                    <i class="glyphicon glyphicon-ok"></i> Contacted
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                ({{ $post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view_dtTime }})
                                            </div>
                                            @else
                                        <form action="/job/contact" method="post" id="post-contact-{{$post->id}}" data-id="{{$post->id}}">  
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="contact" value="{{ $post->id }}">
                                            <button class="btn contact-btn green btn-sm apply-contact-btn" 
                                                    id="contact-btn-{{$post->id}}" type="button">Contact
                                            </button>
                                        </form>                         
                                        @endif  
                                    @endif
                                </div>

                                @elseif($expired == 1)
                                <div class="row" style="text-align:center;">
                                    @if(Auth::user()->induser_id != $post->individual_id && Auth::user()->identifier == 1) 
                                        @if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty()) 
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                            </div>
                                        @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->apply == 1) 
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <i class="fa fa-check-square-o"></i><span class="hidden-sm hidden-xs"> Applied</span> 
                                            </div>
                                            {{ $post->postactivity->where('user_id', Auth::user()->id)->first()->apply_dtTime }}
                                        @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1) 
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <i class="fa fa-check-square-o"></i><span class="hidden-sm hidden-xs"> Contacted</span> 
                                            </div>
                                            {{ $post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view_dtTime }}
                                        @endif
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <i class="glyphicon glyphicon-ban-circle"></i> Expired
                                    </div>
                                    @endif
                                </div>                                      
                                @endif
                               
                            </div>
                            <!-- END TIMELINE ITEM -->
                        </div>
                        @endif                                  
                </div>                           
            </div>
        </div>
    </div>
       
<div class="modal fade" id="share-post" tabindex="-1" role="dialog" aria-labelledby="share-post" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Share post</h4>
            </div>
            <form class="form-horizontal" id="modal-post-share-form" role="form" method="POST" action="/post/share">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="share_post_id" id="modal_share_post_id" value=""> @if(Auth::user()->induser)
                    <div id="post-share-msg-box" style="display:none">
                        <div id="post-share-msg"></div>
                    </div>
                    <div id="post-share-form-errors" style="display:none"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Who can see this Post</h4>
                        </div>
                        <div class="col-md-6">
                            <!-- 
                            <label for="tag-group-all" style="padding: 5.5px 12px;">
                              <input type="checkbox" id="tag-group-all" name="tag-group" value="all" class="md-radiobtn">
                              Public 
                            </label> 
                            -->
                            <label for="tag-group-links" style="padding: 5.5px 12px;">
                                <input type="checkbox" id="tag-group-links" name="tag-group" value="links" class="md-radiobtn"> Links
                            </label>
                            <label for="tag-group-groups" style="padding: 5.5px 12px;">
                                <input type="checkbox" id="tag-group-groups" name="tag-group" value="groups" class="md-radiobtn"> Groups
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="connections-list">
                            <label>Links</label>
                            {!! Form::select('share_links[]', $share_links, null, ['id'=>'connections', 'class'=>'form-control', 'multiple']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="groups-list">
                            <label>Groups</label>
                            {!! Form::select('share_groups[]', $share_groups, null, ['id'=>'groups', 'class'=>'form-control', 'multiple']) !!}
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success" id="modal-post-share-btn">Share</button>
                    <button type="button" class="btn btn-sm default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END SHARE MODAL FORM -->
@stop

@section('javascript')
<script src="/assets/js/home-js.js"></script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56afb9b6a3affa13" async="async">
</script>
<script>
$(document).ready(function(){
$('.apply-btn').live('click',function(event){         
    event.preventDefault();
    var post_id = $(this).parent().data('id');

    var formData = $('#post-apply-'+post_id).serialize(); 
    var formAction = $('#post-apply-'+post_id).attr('action');

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
        if(data == "applied"){
            $('#apply-btn-'+post_id).prop('disabled', true);
            $('#apply-btn-'+post_id).text('Applied');
            $('#show-hide-contacts').addClass('show-hide-new');
        }
      }
    }); 
    return false;
  });
    
$('.contact-btn').live('click',function(event){       
    event.preventDefault();
    var post_id = $(this).parent().data('id');

    var formData = $('#post-contact-'+post_id).serialize(); 
    var formAction = $('#post-contact-'+post_id).attr('action');
    // console.log(post_id);
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
        // console.log("s:"+data);
        if(data == "contacted"){
            $('#contact-btn-'+post_id).prop('disabled', true);
            $('#contact-btn-'+post_id).text('Contacted');
            $('#show-hide-contacts').addClass('show-hide-new');
        }
      }
    }); 
    return false;
  });
});
  </script>

  @stop