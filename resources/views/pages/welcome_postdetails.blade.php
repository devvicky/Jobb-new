@extends('login')

@section('content')

     
<div class="row" style="margin: 0;background-color: transparent;">
    <div class="col-md-10" style="padding:0;">
        <div class="col-md-8" style="padding-left: 6px;padding-right: 6px;">
            <!-- BEGIN PORTLET -->
            <div class="portlet light " style="background-color:white;">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase" style="font-size: 15px;">{{$post->post_type}} Details</span>
                        
                        <span style="position: absolute;right: 20px;">
                            <a data-toggle="modal" href="/login">
                                    <i class="fa fa-warning (alias)" style="color: #f3565d;font-size:17px;"></i>
                            </a>
                        </span>
                        <span style="position: absolute;right:50px;">

                            <button class="btn fav-btn " type="button" 
                                    style="background-color: transparent;padding:0 10px;border:0">
                                <i class="fa fa-star" id="fav-btn-{{$post->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
                            </button>  
                        </span>
                        <br/>
                        <span style="font-size: 11px;">Post Id: {{$post->unique_id}} &nbsp;&nbsp;<i class="fa fa-calendar" style="font-size: 11px;"></i> &nbsp;{{ date('d M y, h:m A', strtotime($post->created_at)) }}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="position-header">
                        <h1>    {{$post->post_title}} ({{ $post->min_exp }} yrs)
                        </h1>

                        <h2>
                            @if($post->post_compname != null)
                            <a href="">
                                {{$post->post_compname}}
                            </a>
                            &nbsp;&nbsp;
                            @endif
                           <small style="font-size:13px;color:#999 !important;"><i class="glyphicon glyphicon-map-marker post-icon-color"></i> {{$post->city}}</small>
                        </h2>
                        <div class=" capitalize" itemprop="name" style="font-size:13px;color:dimgrey !important;margin: 10px 0 0 0;">
                        <label class="label-success job-type-skill-css">{{$post->time_for}}</label> <?php $skills = explode(',', $post->linked_skill) ?>                                                                                                                              
                        @foreach($skills as $skill)
                              <label class="label-success skill-label">{{$skill}}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="row" style="margin-top: 15px;">
                        @if($post->post_type == 'job') 
                        <div class="col-md-5 col-sm-5 col-xs-5">
                            <a data-toggle="modal" data-mpostid="{{$post->id}}" 
                                class="magic-font magicmatch-posts" href="#magicmatch-posts"
                                 style="color: white;line-height: 1.7;text-decoration: none;"> 
                                 <div class="ribbon ribbon-shadow ribbon-color-excellent uppercase">
                            <i class="icon-speedometer magic-font" style="font-size:10px;"></i> &nbsp;Magic Match</div>
                            </a>
                        </div>
                        @else
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
                                        <i class="fa fa-inr" style="font-size:12px;"></i> {{$post->job_agreement}}
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
                    <p class="page-header-post-detail">{{$post->about_company}}</p>
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

                    <div class="welcome-profile-usertitle-name" style="margin: 10px 0px 5px 0;">
                        {{$post->contact_person}}
                    </div>
                    <div class="welcome-profile-usertitle-job">
                        @if($post->induser->role != null) {{$post->induser->role}} @endif 
                    </div>
                </div><!-- /.company-card-image -->
                <div class="row" style="margin-top: -10px;margin-bottom: 10px;">
                    <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right;">
                        <button class="btn btn-icon-only like-btn btn-circle" id="like-button-{{$post->id}}"  type="button" title="Thanks" style="background-color: transparent;border: 1px solid;">                 
                             <i class="icon-like"></i> 
                        </button>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        @if($post->individual_id != null )
                            <div class="puid-{{$post->individual_id}}" style="">
                                <a href="/login" class="btn btn-icon-only btn-circle blue link-btn">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        @elseif($post->corporate_id != null )
                            <div class="puid-{{$post->individual_id}}" style="">
                                <a href="/login" class="btn btn-icon-only btn-circle blue link-btn">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="company-card-data" style="text-align:center;">
                    <a href="/login">
                        <button class="btn contact-btn green btn-sm apply-contact-btn" 
                                id="contact-btn-{{$post->id}}" type="button" style="margin: 0 auto;float:none;box-shadow: 1px 2px 3px black;font-size:16px;">Contact
                        </button>
                    </a>
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
                        <button class="btn btn-icon-only like-btn btn-circle" id="like-button-{{$post->id}}"  type="button" title="Thanks" style="background-color: transparent;border: 1px solid;">                 
                             <i class="icon-like"></i> 
                        </button>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        @if($post->individual_id != null )
                            <div class="puid-{{$post->individual_id}}" style="">
                                <a href="/login" class="btn btn-icon-only btn-circle blue link-btn">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        @elseif($post->corporate_id != null )
                            <div class="puid-{{$post->individual_id}}" style="">
                                <a href="/login" class="btn btn-icon-only btn-circle blue link-btn">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="company-card-data" style="text-align:center;">
                    <a href="/login">
                        <button class="btn contact-btn green btn-sm apply-contact-btn" 
                                id="contact-btn-{{$post->id}}" type="button" style="margin: 0 auto;float:none;box-shadow: 1px 2px 3px black;font-size:16px;">Contact
                        </button>
                    </a>
                </div>
                <!-- /.company-card-data -->
            </div>
        </div>
        @endif
    </div>
</div>
@stop