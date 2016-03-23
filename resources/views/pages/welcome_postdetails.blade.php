@extends('welcome')

@section('content')
<div class="row" style="margin:0;padding:0;">
    <div class="col-md-8" style="text-align: center;margin: 5px 0 -15px 0;">
        <h4 class="uppercase btn-success singlepost-title">
            <label class="">{{$post->post_type}} Detail</label> ({{$post->unique_id}})
        </h4>
    </div>
</div>
<div class="portlet light bordered" 
 style="border: none !important; background:transparent; margin: 20px 0px;">                                     
<div class="portlet-body form" id="posts">
    <div class="form-body" id="post-items" style="padding:0;">                                          
        <div class="row post-item" >
                        
                        <div class="col-md-8 home-post">

                            <div class="timeline" >
                                <!-- TIMELINE ITEM -->

                              
                                <div class="timeline-item time-item">
                               
                                    <div class="timeline-badge badge-margin">
                                        @if($post->induser != null && !empty($post->induser->profile_pic))
                                        <img class="timeline-badge-userpic userpic-box" src="/img/profile/{{ $post->induser->profile_pic }}" title="{{ $post->induser->fname }}" style="width: 60px;border-radius: 35px;">
                                        
                                        @elseif($post->corpuser != null && !empty($post->corpuser->logo_status))
                                        <img class="" src="/img/profile/{{ $post->corpuser->logo_status }}" title="{{ $post->corpuser->firm_name }}"  style="width: 60px;border-radius: 35px;">
                                        
                                        @elseif(empty($post->corpuser->logo_status) && $post->corpuser != null )
                                        <img class="" src="/assets/images/corpnew.jpg"  style="width: 60px;border-radius: 35px;">
                                        
                                        @elseif(empty($post->induser->profile_pic) && $post->induser != null)
                                        <img class="timeline-badge-userpic userpic-box" src="/assets/images/ab.png"  style="width: 60px;border-radius: 35px;">
                                        
                                        @endif
                                    </div>
                                    <div class="timeline-body ">
                                        <div class="timeline-body-head">
                                            <div class="timeline-body-head-caption" style="width:100%;margin:5px;">
                                                @if($post->individual_id != null)
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12" itemprop="author" itemscope itemtype="http://schema.org/Person">
                                                    <a href="/profile/ind/{{$post->individual_id}}" class="post-name-css" itemprop="name">
                                                        {{ $post->induser->fname}} {{ $post->induser->lname}}
                                                    </a>
                                                </div>
                                                
                                                <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                                                    <i class="fa fa-clock-o post-icon-color" style="font-size: 11px;"></i> 
                                                    <small class="post-time-css" itemprop="datePublished" content="{{$post->created_at}}">
                                                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                            @elseif($post->corporate_id != null)
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12" itemprop="author" itemscope itemtype="http://schema.org/Person">
                                                    <a href="/profile/corp/{{$post->corporate_id}}" class="post-name-css" itemprop="name">
                                                        {{ $post->corpuser->firm_name}}
                                                    </a>
                                                </div>
                                                <div class="col-md-4 col-md-4 col-xs-12">
                                                    <span class="firm-type-left" style="margin: 2px 0;">{{ $post->corpuser->firm_type}}</span> 
                                                       
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                                                    <i class="fa fa-clock-o post-icon-color" style="font-size: 11px;"></i> 
                                                    <small class="post-time-css" itemprop="datePublished" content="{{$post->created_at}}">
                                                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                            @endif
                                            </div>                                                      
                                        </div>
                                    </div>
                                    <div class="row post-postision" style="padding:0;">
                                        <div class="col-md-12">
                                            <div class="post-title-new capitalize">{{ $post->post_title }} </div>
                                        </div>
                                        @if($post->post_compname != null && $post->post_type == 'job')
                                        <div class="col-md-12">
                                            <div><small class="capitalize" style="font-size:13px;color:dimgrey !important;">Required at {{ $post->post_compname }}</small></div>
                                        </div>
                                            
                                        @endif
                                    </div>
                                    <div class="row post-postision" style="padding:0;"> 
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

                                    <div class="row" style="margin: 5px 0px; border-top: 1px solid whitesmoke;padding:0;">
                                        <div class="col-md-12" style="margin: 3px -13px;">
                                           
                                            <div class="row" style="padding:0;">  
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    
                                                    <div class="match" style="float: left; margin: 0px 3px;">      
                                                        <a data-toggle="modal" data-mpostid="{{$post->id}}" class="magic-font magicmatch-posts" href="#magicmatch-posts" style="color: white;line-height: 1.7;text-decoration: none;"> 
                                                            <button class="btn btn-success magic-match-css"><i class="icon-speedometer magic-font" style="font-size:12px;"></i> 
                                                               
                                                            </button>
                                                            
                                                        </a>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding:0 8px;">                 
                                                <button class="btn like-btn"  type="button" style="background-color: transparent;padding:3px;" title="Thanks">
                                                    <i class="fa fa-thumbs-up thanks-icon" id="like-{{$post->id}}"></i>        
                                                </button>
                                                </div>
                                                
                                                <div  class="col-md-3 col-sm-3 col-xs-3" style="">
                                                    <div class="dropup ">                                           
                                                        <button class="btn dropdown-toggle" type="button" 
                                                                data-toggle="dropdown" title="Share" 
                                                                style="background-color: transparent;border: 0;margin: 0px;">
                                                            <i class="fa fa-share-square-o" 
                                                                style="font-size: 19px;color: darkslateblue;"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-share-home" role="menu" 
                                                            style="min-width:0;box-shadow:0 0 !important;padding: 0;">
                                                            <li style="border-bottom: 1px solid #ddd;">
                                                                <a class="jobtip sojt" >
                                                                    Share on Jobtip
                                                                </a>
                                                            </li>
                                                            <li style="border-bottom: 1px solid #ddd;">
                                                                <a class="jobtip sbmail">
                                                                    Share by email
                                                                </a>
                                                            </li>
                                                        </ul>                                                   
                                                    </div>
                                                    <div class="report-css">
                                             
                                                    <a href="/login">
                                                        <button class="report-button-css">
                                                            <i class="fa  fa-ellipsis-v" style="color:black;"></i>
                                                        </button>
                                                    </a>   
                                                    </div>
                                                </div>    
                                            </div>                                          
                                        </div>
                                    </div>

                                </div>
                                <div class="row" style="margin:0;padding:0;">
                                    <h4 class="skill-display">Details:</h4>
                                    <div class="col-md-12">
                                        <div class="row" style="padding:0;">
                                            
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
                                        
                                        <div class="row" style="padding:0;"> 
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                    <label class="detail-label">Skills :</label>                                                                  
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                    {{$post->linked_skill}}
                                                 
                                            </div>
                                        </div>
                                        <div class="row" style="padding:0;"> 
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                    <label class="detail-label">Job Type :</label>                                                                  
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                    {{ $post->time_for }}
                                            </div>
                                        </div>
                                        <div class="row" style="padding:0;"> 
                                            @if( $post->city !=null)
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                    <label class="detail-label">City :</label>                                                                  
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                    {{ $post->city }} 
                                            </div>
                                            
                                        </div>
                                        
                                         <div class="row" style="padding:0;">
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
                            </div>
                            <!-- END TIMELINE ITEM -->
                        </div>                                  
                </div>                           
            </div>
        </div>
    </div>

@stop