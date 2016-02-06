@extends('login')

@section('content')

    <div class="row" style="display:table; margin: 10% auto;">
        <div class="col-md-12" style="margin: 10% auto;padding: 0;">
            @if($post != null)
            <div class="portlet-body" id="chats">
                <div class="scroller" data-always-visible="1" data-rail-visible1="1">
                    <ul class="chats">
                        <li class="in">
                            @if($post->induser != null && !empty($post->induser->profile_pic))
                            <img class="avatar" src="/img/profile/{{ $post->induser->profile_pic }}" title="{{ $post->induser->fname }}">
                            
                            @elseif($post->corpuser != null && !empty($post->corpuser->logo_status))
                            <img class="avatar" src="/img/profile/{{ $post->corpuser->logo_status }}" title="{{ $post->corpuser->firm_name }}">
                            
                            @elseif(empty($post->corpuser->logo_status) && $post->corpuser != null )
                            <img class="avatar" src="/assets/images/corpnew.jpg">
                            
                            @elseif(empty($post->induser->profile_pic) && $post->induser != null)
                            <img class="avatar" src="/assets/images/ab.png">
                            
                            @endif
                            <div class="message">
                                <span class="arrow">
                                </span>
                                <a href="javascript:;" class="name">
                               {{$post->post_title}} </a>
                                <span class="datetime">
                                <i class="fa fa-clock-o" style="font-size: 11px;"></i> 
                                 {{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }} </span>
                                @if($post->induser != null)
                                <span class="body">
                                    <div class="row" style="margin:15px -5px;">
                                        <div class="col-md-12">
                                            <a style="font-size:13px;"> {{$post->induser->fname}} {{$post->induser->lname}}</a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin:15px -5px;">
                                        
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                           <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{$post->city}}
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                           <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{$post->min_exp}}-{{$post->max_exp}}
                                        </div>
                                    </div>
                                    <div class="row" style="margin:15px -5px;">  
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                <label class="" style="font-size:13px;font-weight:400;">Education :</label>     
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                {{ $post->education }}     
                                        </div>
                                    </div>
                                    <div class="row" style="margin:15px -5px;"> 
                                        <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                <label class="" style="font-size:13px;font-weight:400;">Job Type :</label>                                                                  
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                {{ $post->time_for }}
                                        </div>
                                    </div>
                                    <div class="row" style="margin:15px -5px;">
                                        <div class="col-md-12">
                                            <div class="skill-display">Description : </div>
                                            {{ $post->job_detail }}
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 0 0px;">
                                        <div class="col-md-3 col-sm-3 col-xs-2" style="padding:0;margin: 5px 0px;">
                                             <i class="fa fa-thumbs-up thanks-icon" style="color:darkseagreen;"></i>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-8" style="padding:0;text-align: center;">
                                             <a class="btn apply-btn blue btn-sm show-contact"
                                                href="/login" type="button"><i class="icon-globe"></i> Apply</a>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-2" style="padding:0;margin: 8px 0px;">
                                            <i class="fa fa-share-square-o" 
                                            style="font-size: 19px;color: darkslateblue;"></i>
                                        </div>
                                    </div>
                                   
                                    
                                    </a>    
                                </span>
                                @endif
                                @if($post->corpuser != null)
                                <span class="body">
                                    {{$post->corpuser->firm_name}}
                                </span>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            @else
            Post Not Found!
            @endif
        </div>
    </div>

@stop