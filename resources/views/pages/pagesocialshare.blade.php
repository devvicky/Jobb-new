<html>
<head>
<title>Jobtip</title>


<meta property="fb:app_id" content="1676295885993366"/>

<meta property="og:title" content="{{$post->post_title}}"/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="http://jobtip.in/post/{{$post->unique_id}}/social"/>
<meta property="og:image" content="http://jobtip.in/jt_logo.png"/>
<meta property="og:site_name" content="Jobtip"/>
<meta property="og:description" content="{{$post->job_detail}}"/>

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ asset('/assets/admin/pages/css/login.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/assets/custom_admin.css') }}" rel="stylesheet"/>


<link href="{{ asset('/assets/global/css/components-rounded.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
<!-- <link href="{{ asset('/assets/admin/layout2/css/layout.css') }}" rel="stylesheet" type="text/css"/> -->
<!-- <link href="{{ asset('/assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet"/> -->
<link href="{{ asset('/assets/custom.css') }}" rel="stylesheet"/>
<link href="{{ asset('/assets/custom_new.css') }}" rel="stylesheet"/>
<link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<style type="text/css" rel="stylesheet">
body{
  background-color: #2E545D;

  background-attachment: fixed;
  background-image: url('/assets/admin/pages/media/bg/2.jpg');
  background-repeat: no-repeat;
}
</style>
</head>
<body>
    <div class="row" style="margin: 10% auto;">
      <div class="col-md-3"></div>
        <div class="col-md-6">
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
                            <div class="message" style="padding: 10px 0;">
                                <span class="arrow"></span>
                                <a href="javascript:;" class="name" style="margin: 0 16px;">
                                    {{$post->post_title}} 
                                </a>
                                <span class="datetime">
                                    <i class="fa fa-clock-o" style="font-size: 11px;"></i> 
                                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }} 
                                 </span>
                                @if($post->induser != null)
                                <span class="body">
                                    <div class="row" style="margin:12px 0px;">
                                        <div class="col-md-12">
                                            <a style="font-size:13px;"> 
                                            {{$post->induser->fname}} {{$post->induser->lname}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin:12px 0px;">
                                        
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                           <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: 
                                           {{$post->city or 'Unspecified'}}
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                           <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: 
                                           {{$post->min_exp  or 'Unspecified'}} - {{$post->max_exp}} year
                                        </div>
                                    </div>

                                    <div class="row" style="margin:12px 0px;">  
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <label class="" style="font-size:13px;font-weight:400;">
                                                Education: {{ $post->education  or 'Unspecified' }} 
                                            </label>     
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <label class="" style="font-size:13px;font-weight:400;">
                                                Job Type: {{ $post->time_for  or 'Unspecified' }}
                                            </label>
                                        </div>
                                    </div>
                                   
                                    <div class="row" style="margin:12px 0px;">
                                        <div class="col-md-12">
                                            <div class="skill-display">Description : </div>
                                            {{ $post->job_detail }}
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 0 12px;">
                                        <div class="col-md-3 col-sm-3 col-xs-2" style="padding:0;margin: 0px;">
                                             <i class="fa fa-thumbs-up thanks-icon" style="line-height:28px"></i>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-8" style="padding:0;text-align: center;">
                                             <a class="btn apply-btn blue btn-sm show-contact"
                                                href="/login" type="button"><i class="icon-globe"></i> Apply</a>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-2" 
                                             style="padding:0;margin: 3px 0 0;text-align: right;">
                                            <i class="fa fa-share-square-o" 
                                            style="font-size: 19px;color: darkslateblue;line-height:25px;margin-top:3px"></i>
                                        </div>
                                    </div>                                   
                                     
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
</body>
</html>