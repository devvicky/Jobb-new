@extends('master')
@section('content')

<?php $city = 'unspecified'; ?>
@if($post->preferLocations != '[]')
<?php $city = ''; ?>
@if(count($post->preferLocations) > 1)
@foreach($post->preferLocations as $pl)

<?php $city = $city . $pl->city . ', '; ?>
@endforeach
@elseif(count($post->preferLocations) == 1)
@foreach($post->preferLocations as $pl)

<?php $city = $city . $pl->city; ?>
@endforeach
@endif
@endif
<?php $postSkills = []; 
    if(Auth::user()->identifier == 1){
$postSkillArr = array_map('trim', explode(',', $post->linked_skill));
    $userSkillArr = array_map('trim', explode(',', Auth::user()->induser->linked_skill));
    }
    
?>
<?php 
if(Auth::user()->identifier == 1){
        $matchedPost = array_intersect($postSkillArr, $userSkillArr);
    $unmatchedPost = array_diff($postSkillArr, $userSkillArr);
    }
    
?>


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

     <?php 
                        $tempMatch = 0;
                        if($post->min_exp <= Auth::user()->induser->experience && $post->max_exp >= Auth::user()->induser->experience){
                            $tempMatch = $tempMatch + 1;
                        }

                        if(strcasecmp($post->role, Auth::user()->induser->role) == 0){
                            $tempMatch = $tempMatch + 1;
                        }

                        if($post->time_for == Auth::user()->induser->prefered_jobtype){
                            $tempMatch = $tempMatch + 1;
                        }

                        if($post->magic_match >= 65 && $tempMatch == 3){
                            $match = "ExcellentMatch";
                        }elseif($post->magic_match >= 65 && $tempMatch != 3){
                            $match = "GoodMatch";
                        }elseif($post->magic_match < 65 && $post->magic_match >= 35 && $tempMatch == 3){
                            $match = "GoodMatch";
                        }elseif($post->magic_match < 65 && $post->magic_match >= 35 && $tempMatch != 3){
                            $match = "QuickCheck";
                        }elseif($post->magic_match < 35){
                            $match = "QuickCheck";
                        }

                     ?>
<div class="row" style="margin: 0;background-color: transparent;">
    <div class="col-md-10" style="padding:0;">
        <div class="col-md-8" style="padding-left: 6px;padding-right: 6px;">
            <!-- BEGIN PORTLET -->
            <div class="portlet light " style="background-color:white;">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase" style="font-size: 15px;">{{$post->post_type}} Details</span>
                        @if($expired != 1)
                        <span style="position: absolute;right: 20px;">
                            <a data-toggle="modal" href="#basic-report-{{ $post->id }}">
                                    <i class="fa fa-warning (alias)" style="color: #f3565d;font-size:17px;"></i>
                            </a>
                        </span>
                        @endif
                        @if(Auth::user()->induser_id != $post->individual_id )
                        <span style="position: absolute;right:50px;">
                        <form action="/job/fav" method="post" id="post-fav-{{$post->id}}" data-id="{{$post->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="fav_post" value="{{ $post->id }}">

                            <button class="btn fav-btn " type="button" 
                                    style="background-color: transparent;padding:0 10px;border:0">
                                @if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                <i class="fa fa-star" id="fav-btn-{{$post->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
                                @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->fav_post == 1) 
                                <i class="fa fa-star" id="fav-btn-{{$post->id}}" style="font-size: 20px;color:#FFC823;"></i>
                                @else
                                <i class="fa fa-star" id="fav-btn-{{$post->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
                                @endif  
                            </button>   
                        </form>
                        </span>
                        @endif
                        <br/>
                        <span style="font-size: 11px;">Post Id: {{$post->unique_id}} &nbsp;&nbsp;<i class="fa fa-calendar" style="font-size: 11px;"></i> &nbsp;{{ date('d M y, h:m A', strtotime($post->created_at)) }}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="position-header">
                        <h1>                                                
                                @if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                <!-- <div class="col-md-3 col-sm-3 col-xs-2">
                                </div> -->
                                @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->apply == 1)
                                <!-- <div class="col-md-3 col-sm-3 col-xs-2"  style="line-height: 1.9;">                                                     -->
                                    <i class="fa fa-check-square-o" style="font-size: 15px;color: #1C55C1;"></i>
                                <!-- </div> -->
                                @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1)
                                <!-- <div class="col-md-3 col-sm-3 col-xs-2"  style="line-height: 1.9;">                                                     -->
                                    <i class="fa fa-check-square-o" style="font-size: 15px;color: #1C55C1;"></i> 
                                <!-- </div> -->
                                @endif {{$post->post_title}} <span style="white-space: pre;">({{ $post->min_exp }} yrs)</span>
                        </h1>

                        <h2>
                            @if($post->post_compname != null)
                            <a href="">
                                {{$post->post_compname}}
                            </a>
                            &nbsp;&nbsp;
                            @endif
                           <small style="font-size:13px;color:#999 !important;"><i class="glyphicon glyphicon-map-marker post-icon-color"></i>  @if($city != null) {{ $city }} @else {{$post->city}} @endif</small>
                        </h2>
                        <div class=" capitalize" itemprop="name" style="font-size:13px;color:dimgrey !important;margin: 10px 0 0 0;">
                        <label class="label-success job-type-skill-css">{{$post->time_for}}</label> <?php $skills = explode(',', $post->linked_skill) ?>                                                                                                                              
                        @if(Auth::user()->identifier == 1)
                        @foreach($matchedPost as $m)
                            <label class="label-success matched-skill-css">{{$m}}</label>
                        @endforeach
                        @foreach($unmatchedPost as $um)
                          <label class="label-success skill-label">{{$um}}</label>
                        @endforeach
                        @elseif(Auth::user()->identifier == 2)
                         <?php $postskill = explode(',', $post->linked_skill) ; ?>
                                                    @foreach($postskill as $skill)
                                                      <label class="label-success skill-label">{{$skill}}</label>
                                                    @endforeach
                        @endif
                        </div>
                    </div>

           
                    @if($expired != 1)
                    <div class="row" style="margin-top: 15px;">
                        @if($post->post_type == 'job' && Auth::user()->identifier == 1) 
                        @if($match == 'GoodMatch')
                        <div class="col-md-5 col-sm-5 col-xs-5">
                            <a data-toggle="modal" data-mpostid="{{$post->id}}" 
                                class="magic-font magicmatch-posts" href="#magicmatch-posts"
                                 style="color: white;line-height: 1.7;text-decoration: none;"> 
                                 <div class="ribbon-active ribbon-shadow ribbon-color-good uppercase">
                            <i class="icon-speedometer magic-font" style="font-size:10px;"></i> &nbsp;Good Match</div>
                            </a>
                        </div>
                        @elseif($match == 'ExcellentMatch')
                        <div class="col-md-5 col-sm-5 col-xs-5">
                            <a data-toggle="modal" data-mpostid="{{$post->id}}" 
                                class="magic-font magicmatch-posts" href="#magicmatch-posts"
                                 style="color: white;line-height: 1.7;text-decoration: none;"> 
                                 <div class="ribbon-active ribbon-shadow ribbon-color-excellent uppercase">
                            <i class="icon-speedometer magic-font" style="font-size:10px;"></i> &nbsp;Excellent Match</div>
                            </a>
                        </div>
                        @elseif($match == 'QuickCheck')
                        <div class="col-md-5 col-sm-5 col-xs-5">
                            <a data-toggle="modal" data-mpostid="{{$post->id}}" 
                                class="magic-font magicmatch-posts" href="#magicmatch-posts"
                                 style="color: white;line-height: 1.7;text-decoration: none;"> 
                                 <div class="ribbon-active ribbon-shadow ribbon-color-quick uppercase">
                            <i class="icon-speedometer magic-font" style="font-size:10px;"></i> &nbsp;Quick Check</div>
                            </a>
                        </div>
                        @endif
                        @endif
                        <div class="col-md-4 col-sm-4 col-xs-5">
                            <!-- Small button group -->
                            <div class="btn-group">
                                <button class="btn blue btn-sm view-detail-btn dropdown-toggle" type="button" data-toggle="dropdown" style="border-radius: 25px !important;">
                                Share Post <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sharepost" role="menu">
                                    <li style="text-align: center;border-bottom: 1px solid lightgray;">
                                        <a href="#share-post" 
                                            data-toggle="modal" 
                                            class="jobtip sojt" 
                                            id="sojt-{{$post->id}}" 
                                            data-share-post-id="{{$post->id}}">
                                            <img src="/assets/small-logo.png" style="width:10%;"> Jobtip
                                        </a>
                                    </li>
                                    <li style="text-align: center;border-bottom: 1px solid lightgray;">
                                        <a href="#share-by-email" data-toggle="modal" onclick="setPostId({{$post->id}})" 
                                           class="jobtip sbmail" id="sbmail-{{$post->id}}" 
                                           data-share-post-id="{{$post->id}}">
                                            <!-- <button class="btn share-email-icon" style="line-height: 0.9;">
                                                <i class="glyphicon glyphicon-envelope" style="font-size:22px;color:white;"></i>
                                                </button> -->
                                              <i class="glyphicon glyphicon-envelope" style="font-size:22px;color: #f3565d;"></i> <span> Email</span>
                                        </a>
                                    </li>
                                    <li style="text-align: center;">
                                        <span>Share on Social Media</span>
                                        <div class="addthis_sharing_toolbox addthis_toolbox addthis_default_style addthis_20x20_style" 
                                            data-url="http://jobtip.in/post/{{$post->unique_id}}/social" 
                                            data-title="{{$post->post_title}}"
                                            data-description="{{ $post->job_detail }}"
                                            data-media="http://jobtip.in/jt_logo.png" style="">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @elseif($expired == 1)
                    <div class="row" style="margin-top: 15px;">
                        @if($post->post_type == 'job') 
                        @if($match == 'GoodMatch')
                        <div class="col-md-5 col-sm-5 col-xs-5">
                            <a data-toggle="modal" data-mpostid="{{$post->id}}" 
                                class="magic-font magicmatch-posts" href="#magicmatch-posts"
                                 style="color: white;line-height: 1.7;text-decoration: none;"> 
                                 <div class="ribbon-active ribbon-shadow ribbon-color-good uppercase">
                            <i class="icon-speedometer magic-font" style="font-size:10px;"></i> &nbsp;Good Match</div>
                            </a>
                        </div>
                        @elseif($match == 'ExcellentMatch')
                        <div class="col-md-5 col-sm-5 col-xs-5">
                            <a data-toggle="modal" data-mpostid="{{$post->id}}" 
                                class="magic-font magicmatch-posts" href="#magicmatch-posts"
                                 style="color: white;line-height: 1.7;text-decoration: none;"> 
                                 <div class="ribbon-active ribbon-shadow ribbon-color-excellent uppercase">
                            <i class="icon-speedometer magic-font" style="font-size:10px;"></i> &nbsp;Excellent Match</div>
                            </a>
                        </div>
                        @elseif($match == 'QuickCheck')
                        <div class="col-md-5 col-sm-5 col-xs-5">
                            <a data-toggle="modal" data-mpostid="{{$post->id}}" 
                                class="magic-font magicmatch-posts" href="#magicmatch-posts"
                                 style="color: white;line-height: 1.7;text-decoration: none;"> 
                                 <div class="ribbon-active ribbon-shadow ribbon-color-quick uppercase">
                            <i class="icon-speedometer magic-font" style="font-size:10px;"></i> &nbsp;Quick Check</div>
                            </a>
                        </div>
                        @endif
                        @else
                        <div class="col-md-4 col-sm-4 col-xs-5"></div>
                        @endif
                        <div class="col-md-4 col-sm-4 col-xs-5">
                            <!-- Small button group -->
                            <div class="btn-group">
                                <button class="btn blue btn-sm view-detail-btn dropdown-toggle" type="button" data-toggle="dropdown" style="border-radius: 25px !important;">
                                Share Post <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-sharepost" role="menu">
                                    
                                    <li style="text-align: center;">
                                        <!-- <span>Share on Social Media</span> -->
                                        <a href="#share-post" 
                                            data-toggle="modal" 
                                            class="jobtip sojt" 
                                            id="sojt-{{$post->id}}" 
                                            data-share-post-id="{{$post->id}}">
                                            <img src="/assets/small-logo.png" style="width:20%;">
                                        </a>
                                        <a href="#share-by-email" data-toggle="modal" onclick="setPostId({{$post->id}})" 
                                           class="jobtip sbmail" id="sbmail-{{$post->id}}" 
                                           data-share-post-id="{{$post->id}}">
                                              <i class="glyphicon glyphicon-envelope" style="font-size:31px;color: #f3565d;"></i>
                                        </a>
                                        <div class="addthis_sharing_toolbox addthis_toolbox addthis_default_style addthis_20x20_style" 
                                            data-url="http://jobtip.in/post/{{$post->unique_id}}/social" 
                                            data-title="{{$post->post_title}}"
                                            data-description="{{ $post->job_detail }}"
                                            data-media="http://jobtip.in/jt_logo.png" style="width: 10px;margin: 0 auto;position: relative;right: 14px;">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="    margin: 6px 0 0px 0;">
                            <i class="glyphicon glyphicon-ban-circle"></i> Post Expired
                        </div>
                    </div>
                    @endif
                    
                </div>
            </div>
            <!-- END PORTLET -->
           
            <!-- BEGIN PORTLET -->
            <div class="portlet light " style="padding:0;">
                <!-- <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Portlet</span>
                    </div>
                </div> -->
                <div class="portlet-body">
                    <div class="table-scrollable" style="border: 0;margin: -8px 0 0px 0 !important;">
                        <table class="table table-bordered table-bordered-detail table-hover">
                            <tbody>
                                <tr class="table-row-bg" style="border-top:0;">
                                    <td style="border-top:0;">
                                         Industry
                                    </td>
                                    <td style="border-top:0;">
                                         {{ $post->industry }}
                                    </td>
                                    
                                </tr>
                                <tr class="table-row-bg">
                                    <td>
                                         Functional Area
                                    </td>
                                    <td>
                                         {{ $post->functional_area }}
                                    </td>
                                   
                                </tr>
                                <tr class="table-row-bg">
                                    <td>
                                         Role
                                    </td>
                                    <td>
                                         {{ $post->role }}
                                    </td>
                                    
                                </tr>
                                <tr class="table-row-bg">
                                    <td>
                                         Education
                                    </td>
                                    <td>
                                         @if($post->education != null)
                                            <?php $education = collect(explode(',', $post->education)); ?>
                                             @if(count($education) > 0)
                                                @foreach($education as $edu)
                                                <?php $educ = explode('-', $edu);
                                                      $name = $educ[0];
                                                      $branch = $educ[1]; ?>

                                                     {{ $name }} @if($branch != " ")- {{ $branch }} @endif,
                                                @endforeach
                                             @endif
                                        @endif
                                    </td>
                                    
                                </tr>
                                <tr class="table-row-bg">
                                    <td>
                                         Salary
                                    </td>
                                    @if($post->min_sal != null)
                                    <td>
                                        <i class="fa fa-inr" style="font-size:12px;"></i> {{$post->min_sal}} / {{$post->salary_type}}
                                    </td>
                                    @else
                                    <td>On Agreement</td>
                                    @endif
                                </tr>
                                @if($post->candidate_availablity != null)
                                <tr class="table-row-bg">
                                    <td>
                                        Joining Period
                                    </td>
                                    <td>
                                        @if($post->candidate_availablity != null && $post->candidate_availablity != "0")
                                        <span >in {{ $post->candidate_availablity }} days</span>
                                        @elseif($post->candidate_availablity != null && $post->candidate_availablity == "0")
                                        <!-- I am available Immediately available to work. -->  
                                        <span>Immediately</span>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                <tr class="table-row-bg">
                                    <td>
                                         Job Agreement
                                    </td>
                                    <td>
                                        {{$post->job_agreement}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END PORTLET -->
            <!-- BEGIN PORTLET -->
            <div class="portlet light " style="background-color:white;">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Description</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <p class="page-header-post-detail">{{$post->job_detail}}</p>
                </div>
            </div>
            <!-- END PORTLET -->
            <!-- BEGIN PORTLET -->
            <div class="portlet light " style="background-color:white;">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">About Compnay</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <p class="page-header-post-detail">{{$post->job_detail}}</p>
                </div>
            </div>
            <!-- END PORTLET -->
        </div>
        @if($post->individual_id != null)
        <div class="col-md-4" style="margin: 7px 0;">
            <div class="company-card" style="background-color: white;">
                <div class="company-card-image">
                    <span>Posted By</span>
                    @if($post->induser->profile_pic != null && $post->individual_id != null)
                    <a href="">
                        <img src="/img/profile/{{ $post->induser->profile_pic }}" alt="">
                    </a>
                    @elseif($post->induser->profile_pic == null && $post->individual_id != null)
                    <div class=" badge-margin post-image-css">
                        <i class="fa fa-user" style="font-size: 90px;margin: 52px 29px;color: #777;"></i> 
                    </div>
                    @endif

                    <div class="profile-usertitle-name" style=" margin: 10px 0px;">
                        {{$post->contact_person}}
                    </div>
                    <div class="profile-usertitle-job">
                        @if($post->induser->role != null) {{$post->induser->role}} @endif 
                    </div>
                </div><!-- /.company-card-image -->
                <div class="row" style="margin-top: -10px;margin-bottom: 10px;">
                    <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right;">
                        @if($post->expired == 0)

                            <form action="/job/like" method="post" id="post-like-{{$post->id}}" data-id="{{$post->id}}">                        
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="like" value="{{ $post->id }}">
                                
                                @if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                    <button class="btn btn-icon-only like-btn btn-circle" id="like-button-{{$post->id}}"  type="button" title="Thanks" style="background-color: transparent;border: 1px solid;">                 
                                         <i class="icon-like"></i> 
                                    </button>

                                @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->thanks == 1) 
                                    
                                    <a class="btn btn-icon-only like-btn btn-circle blue" id="like-button-{{$post->id}}">
                                        <i class="icon-like"></i>
                                    </a>
                                @else
                                    <button class="btn btn-icon-only like-btn btn-circle" id="like-button-{{$post->id}}"  type="button" title="Thanks" style="background-color: transparent;border: 1px solid;">                 
                                         <i class="icon-like"></i> 
                                    </button>
                                @endif
                            </form>
                             @if($post->postactivity->sum('thanks') > 0)
                            <span class="badge badge-default badge-like-detail" id="like-count-{{ $post->id }}">
                           
                            {{ $post->postactivity->sum('thanks') }}
                           
                            </span>
                             @endif
                        @else
                            <a disabled class="btn btn-icon-only like-btn btn-circle blue">
                                <i class="icon-like"></i>
                            </a>
                             @if($post->postactivity->sum('thanks') > 0)
                            <span class="badge badge-default badge-like-detail" id="like-count-{{ $post->id }}">
                           
                            {{ $post->postactivity->sum('thanks') }}
                           
                            </span>
                             @endif
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        @if($post->individual_id != null && Auth::user()->induser_id != $post->individual_id && Auth::user()->identifier == 1)
                            <div class="puid-{{$post->individual_id}}" style="">
                                @if($links->contains('id', $post->individual_id) )
                                    <!-- <button type="submit" class="link-remove-btn btn btn-xs link-follow-icon-css">
                                        <i class="fa fa-link (alias) icon-size" style=""></i>
                                    </button> -->
                                    <a class="btn btn-icon-only btn-circle green ">
                                        <i class="fa fa-link (alias)"></i>
                                    </a>
                                @elseif($linksPending->contains('id', $post->individual_id) )
                                    <a class="btn btn-icon-only btn-circle grey-cascade">
                                        <i class="icon-hourglass (alias)"></i>
                                    </a>
                                @elseif($linksApproval->contains('id', $post->individual_id) )
                                    <a class="btn btn-icon-only btn-circle grey-cascade">
                                        <i class="icon-hourglass (alias)"></i>
                                    </a>
                                @else
                                <form action="/connections/newLink/{{$post->individual_id}}"  id="no-ind-unknown" method="post">               
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <a data-puid="{{$post->individual_id}}" class="btn btn-icon-only btn-circle blue link-btn">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </form>
                                @endif
                            </div>
                        @elseif($post->corporate_id != null && Auth::user()->identifier == 1)
                            <div class="follow-icon-right pfid-{{$post->corporate_id}}" data-pfid="{{$post->corporate_id}}" style="margin:-5px 0;">
                                @if($following->contains('id', $post->corporate_id))
                                    <a class="btn btn-icon-only btn-circle green ">
                                       <i class="fa fa-check" style=""></i>
                                    </a>
                                @else
                                    <form action="/corporate/follow/{{$post->corporate_id}}" id="no-corp" method="post">              
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                                        
                                        <a data-linked="no" data-utype="corp" data-pfid="{{$post->corporate_id}}" class="btn btn-icon-only btn-circle grey-cascade follow-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </form>
                                @endif
                            </div>    
                        @endif
                    </div>
                </div>
                <div class="company-card-data" style="text-align:center;">
                
                    @if($post->show_contact == "Public" && $expired == 0)
                    @if($post->postactivity->where('user_id', Auth::user()->induser_id)->isEmpty())
                        
                    @elseif($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->contact_view == 1)
                       @if($post->email_id != null)
                        <div class="row" style="margin: 0 0 10px 0;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="detail-label"><i class="fa fa-envelope" style="font-size:15px;"></i>&nbsp;&nbsp;{{ $post->email_id }} </label>                                  
                            </div> 
                        </div>
                        @endif
                        @if($post->phone != null)
                        <div class="row" style="margin: 0 0 10px 0;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="detail-label"><i class="fa fa-phone-square" style="font-size:16px;"></i>&nbsp;&nbsp;+91 {{ $post->phone }} </label>                                  
                            </div>
                        </div>
                        @endif
                    @endif
                    @elseif($post->postactivity->where('user_id', Auth::user()->induser_id)->isEmpty() && $post->show_contact == "Private")
                    @elseif($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->contact_view == 1 && $post->show_contact == "Private")
                    <div class="skill-display">Contact Details : </div>
                    <div class="row" style="margin: 0 0 10px 0;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label class="detail-label" style="color: #BB4E4E;font-size: 12px;">Post owner has kept contact details Private.</label>                                  
                        </div>
                    </div>
                    @endif
                        
                        <div id="post-user-contact-{{$post->id}}"></div>
                        <div class="row" style="margin: 0 0 10px 0;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                     <!-- if corporate_id not null -->
                            @if($post->corporate_id != null && Auth::user()->id != $post->individual_id &&  Auth::user()->identifier == 1)     
                                @if($post->postactivity->where('user_id', Auth::user()->induser_id)->isEmpty())

                                    <form action="/job/apply" method="post" id="post-apply-{{$post->id}}" data-id="{{$post->id}}">  
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="apply" value="{{ $post->id }}">
                                        @if($post->website_redirect_url != null)
                                            <button class="btn apply-btn blue btn-sm apply-contact-btn" 
                                                onclick="window.location='{{ $post->website_redirect_url }}';"   type="button" style="margin: 0 auto;float:none;">Apply
                                            </button>   
                                        @else
                                            <button class="btn apply-btn blue btn-sm apply-contact-btn" 
                                                    id="apply-btn-{{$post->id}}" type="button" style="margin: 0 auto;float:none;">Apply
                                            </button>
                                            @endif
                                    </form> 
                                @elseif($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->apply == 1 && Auth::user()->identifier == 1) 
                                    
                                        <button type="button" class="btn btn-sm bg-grey-steel apply-contact-btn" style="margin: 0 auto;float:none;background-color: #999 !important;color: white !important;">
                                            Applied
                                        </button>
                                        <label style="float:none;margin:0 auto; display:table;font-size:11px;color: white !important;">
                                            {{ date('M d, h:m A', strtotime($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->apply_dtTime)) }}
                                            
                                        </label>
                                    
                                @else
                                <form action="/job/apply" method="post" id="post-apply-{{$post->id}}" data-id="{{$post->id}}">  
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="apply" value="{{ $post->id }}">
                                    <button class="btn apply-btn blue btn-sm apply-contact-btn" 
                                            id="apply-btn-{{$post->id}}" type="button" style="margin: 0 auto;float:none;">Apply
                                    </button>
                                </form>                         
                                @endif
                            
                            @endif  
                            @if($post->individual_id != null && Auth::user()->id != $post->individual_id)       
                                @if($post->postactivity->where('user_id', Auth::user()->induser_id)->isEmpty())
                               
                                    <form action="/job/contact" method="post" id="post-contact-{{$post->id}}" data-id="{{$post->id}}">  
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="contact" value="{{ $post->id }}">
                                        <button class="btn contact-btn green btn-sm apply-contact-btn" 
                                                id="contact-btn-{{$post->id}}" type="button" style="margin: 0 auto;float:none;box-shadow: 1px 2px 3px black;font-size:16px;">Contact
                                        </button>
                                    </form> 
                                
                                @elseif($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->contact_view == 1) 
                                     
                                        <button type="button" disabled class="btn btn-sm red apply-contact-btn" style="margin: 0 auto;float:none;color: white !important;">
                                            <i class="glyphicon glyphicon-ok"></i> Contacted
                                        </button>
                                        <label style="float:none;margin:0 auto; display:table;font-size:11px;color: #e5e5e5 !important;">
                                            {{ date('M d, h:m A', strtotime($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->contact_view_dtTime)) }}
                                            
                                        </label>
                                    
                                    
                                    @else
                                   
                                    <form action="/job/contact" method="post" id="post-contact-{{$post->id}}" data-id="{{$post->id}}">  
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="contact" value="{{ $post->id }}">
                                        <button class="btn contact-btn green btn-sm apply-contact-btn" 
                                                id="contact-btn-{{$post->id}}" type="button" style="margin: 0 auto;float:none;box-shadow: 1px 2px 3px black;font-size:16px;">Contact
                                        </button>
                                    </form> 
                                                        
                                @endif  
                                <!-- <div id="post-date-"></div> -->
                            @endif
                        </div>
                    </div>
                    @if($post->postactivity->where('user_id', Auth::user()->induser_id)->isEmpty())
                        <div class="row" id="contact-note" style="margin: 0;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="detail-label" style="font-size: 11px;color: #eee;"><span class="required">*</span>
                                    Your contact details will be shared to post owner on Apply / Contact.
                                </label>                                  
                            </div>
                        </div>
                    @elseif($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->contact_view == 1)
                        <div id="contact-note-shared" class="row" style="margin: 0;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="detail-label" style="font-size: 11px;color: #eee;"><span class="required">*</span>
                                    Your contact details have been shared to post owner.
                                </label>                                  
                            </div>
                        </div>
                    @else
                        <div class="row" id="contact-note" style="margin: 0;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="detail-label" style="font-size: 11px;color: #eee;"><span class="required">*</span>
                                    Your contact details will be shared to post owner on Apply / Contact.
                                </label>                                  
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /.company-card-data -->
            </div>
        </div>
        @elseif($post->corporate_id != null)
        <div class="col-md-4" style="margin: 7px 0;">
            <div class="company-card">
                <div class="company-card-image">
                    <span>Posted By {{$post->corpuser->firm_type}}</span>
                    @if($post->corpuser->logo_status != null)
                    <a href="">
                        <img src="/img/profile/{{ $post->corpuser->logo_status }}" alt="">
                    </a>
                    @elseif($post->corpuser->logo_status == null)
                    <div class=" badge-margin post-image-css">
                        <i class="fa fa-university" style="font-size: 55px;margin: 44px 25px;color: lightgray;"></i> 
                    </div>
                    @endif

                    <div class="profile-usertitle-name" style="margin-top: 10px;">
                        {{$post->corpuser->firm_name}}
                    </div>

                    <div class="profile-usertitle-job">
                        @if($post->corpuser->slogan != null) {{$post->corpuser->slogan}} @endif 
                    </div>
                </div><!-- /.company-card-image -->
                <div class="row" style="margin-top: -10px;margin-bottom: 10px;">
                    <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right;">
                        @if($post->expired == 0)

                            <form action="/job/like" method="post" id="post-like-{{$post->id}}" data-id="{{$post->id}}">                        
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="like" value="{{ $post->id }}">
                                
                                @if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                    <button class="btn btn-icon-only like-btn btn-circle" id="like-button-{{$post->id}}"  type="button" title="Thanks" style="background-color: transparent;border: 1px solid;">                 
                                         <i class="icon-like"></i> 
                                         @if($post->postactivity->sum('thanks') > 0)
                                         <span class="badge badge-default badge-like-detail" id="like-count-{{ $post->id }}">
                                         {{ $post->postactivity->sum('thanks') }}
                                         </span>
                                        @endif
                                    </button>

                                @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->thanks == 1) 
                                    
                                    <a class="btn btn-icon-only like-btn btn-circle blue" id="like-button-{{$post->id}}">
                                        <i class="icon-like"></i>
                                        @if($post->postactivity->sum('thanks') > 0)
                                         <span class="badge badge-default badge-like-detail" id="like-count-{{ $post->id }}">
                                         {{ $post->postactivity->sum('thanks') }}
                                         </span>
                                        @endif
                                    </a>
                                @else
                                    <button class="btn btn-icon-only like-btn btn-circle" id="like-button-{{$post->id}}"  type="button" title="Thanks" style="background-color: transparent;border: 1px solid;">                 
                                         <i class="icon-like"></i> 
                                         @if($post->postactivity->sum('thanks') > 0)
                                         <span class="badge badge-default badge-like-detail" id="like-count-{{ $post->id }}">
                                         {{ $post->postactivity->sum('thanks') }}
                                         </span>
                                        @endif
                                    </button>
                                @endif
                            </form>
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        @if(Auth::user()->identifier == 1)
                            <div class="follow-icon-right pfid-{{$post->corporate_id}}" data-pfid="{{$post->corporate_id}}" style="margin:-5px 0;">
                                @if($following->contains('id', $post->corporate_id))
                                    <a class="btn btn-icon-only btn-circle green ">
                                       <i class="fa fa-check" style=""></i>
                                    </a>
                                @else
                                    <form action="/corporate/follow/{{$post->corporate_id}}" id="no-corp" method="post">              
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                                        
                                        <a data-linked="no" data-utype="corp" data-pfid="{{$post->corporate_id}}" class="btn btn-icon-only btn-circle grey-cascade follow-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </form>
                                @endif
                            </div>    
                        @endif
                    </div>
                    
                </div>
                <div class="company-card-data" style="text-align:center;">
                    
                    
                        
                        <div id="post-user-contact-{{$post->id}}"></div>
                        <div class="row" style="margin: 0 0 10px 0;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                     <!-- if corporate_id not null -->
                            @if($post->corporate_id != null && Auth::user()->identifier == 1)     
                                @if($post->postactivity->where('user_id', Auth::user()->induser_id)->isEmpty())

                                    <form action="/job/apply" method="post" id="post-apply-{{$post->id}}" data-id="{{$post->id}}">  
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="apply" value="{{ $post->id }}">
                                        @if($post->website_redirect_url != null)
                                            <button class="btn apply-btn blue btn-sm apply-contact-btn" 
                                                onclick="window.location='{{ $post->website_redirect_url }}';"   type="button" style="margin: 0 auto;float:none;">Apply
                                            </button>   
                                        @else
                                            <button class="btn apply-btn blue btn-sm apply-contact-btn" 
                                                    id="apply-btn-{{$post->id}}" type="button" style="margin: 0 auto;float:none;">Apply
                                            </button>
                                            @endif
                                    </form> 
                                @elseif($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->apply == 1 && Auth::user()->identifier == 1) 
                                    
                                        <button type="button" class="btn btn-sm bg-grey-steel apply-contact-btn" style="margin: 0 auto;float:none;background-color: #999 !important;color: white !important;">
                                            Applied
                                        </button>
                                        <label style="float:none;margin:0 auto; display:table;font-size:11px;color: white !important;">
                                            {{ date('M d, h:m A', strtotime($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->apply_dtTime)) }}
                                            
                                        </label>
                                    
                                @else
                                <form action="/job/apply" method="post" id="post-apply-{{$post->id}}" data-id="{{$post->id}}">  
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="apply" value="{{ $post->id }}">
                                    <button class="btn apply-btn blue btn-sm apply-contact-btn" 
                                            id="apply-btn-{{$post->id}}" type="button" style="margin: 0 auto;float:none;">Apply
                                    </button>
                                </form>                         
                                @endif
                            
                            @endif  
                            @if($post->individual_id != null && Auth::user()->id != $post->individual_id)       
                                @if($post->postactivity->where('user_id', Auth::user()->induser_id)->isEmpty())
                               
                                    <form action="/job/contact" method="post" id="post-contact-{{$post->id}}" data-id="{{$post->id}}">  
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="contact" value="{{ $post->id }}">
                                        <button class="btn contact-btn green btn-sm apply-contact-btn" 
                                                id="contact-btn-{{$post->id}}" type="button" style="margin: 0 auto;float:none;box-shadow: 1px 2px 3px black;font-size:16px;">Contact
                                        </button>
                                    </form> 
                                
                                @elseif($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->contact_view == 1) 
                                     
                                        <button type="button" disabled class="btn btn-sm green apply-contact-btn" style="margin: 0 auto;float:none;color: white !important;">
                                            <i class="glyphicon glyphicon-ok"></i> Contacted
                                        </button>
                                        <label style="float:none;margin:0 auto; display:table;font-size:11px;color: white !important;">
                                            {{ date('M d, h:m A', strtotime($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->contact_view_dtTime)) }}
                                            
                                        </label>
                                    
                                    
                                    @else
                                   
                                    <form action="/job/contact" method="post" id="post-contact-{{$post->id}}" data-id="{{$post->id}}">  
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="contact" value="{{ $post->id }}">
                                        <button class="btn contact-btn green btn-sm apply-contact-btn" 
                                                id="contact-btn-{{$post->id}}" type="button" style="margin: 0 auto;float:none;box-shadow: 1px 2px 3px black;font-size:16px;">Contact
                                        </button>
                                    </form> 
                                                        
                                @endif  
                                <!-- <div id="post-date-"></div> -->
                            @endif
                        </div>
                    </div>
                    @if($post->postactivity->where('user_id', Auth::user()->induser_id)->isEmpty())
                        <div class="row" id="contact-note" style="margin: 0;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="detail-label" style="font-size: 11px;"><span class="required">*</span>
                                    Your contact details will be shared to post owner on Apply / Contact.
                                </label>                                  
                            </div>
                        </div>
                    @elseif($post->postactivity->where('user_id', Auth::user()->induser_id)->first()->contact_view == 1)
                        <div id="contact-note-shared" class="row contact-share" style="margin: 0;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="detail-label" style="font-size: 11px;"><span class="required">*</span>
                                    Your contact details have been shared to post owner.
                                </label>                                  
                            </div>
                        </div>
                    @else
                        <div class="row" id="contact-note" style="margin: 0;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="detail-label" style="font-size: 11px;"><span class="required">*</span>
                                    Your contact details will be shared to post owner on Apply / Contact.
                                </label>                                  
                            </div>
                        </div>
                    @endif
                    
                    
                </div>
                <!-- /.company-card-data -->
            </div>
        </div>
        @endif
    </div>
</div>
<div class="modal fade" id="basic-report-{{ $post->id }}" tabindex="-1" role="basic" 
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
// <script type="text/javascript">
// document.querySelector('.read-more').addEventListener('click', function() {
//   document.querySelector('#content').style.height= 'auto';
//   this.style.display= 'none';
// });
// </script>

<script type="text/javascript">
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 40;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Read more >";
    var lesstext = "Read less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
</script>
@stop