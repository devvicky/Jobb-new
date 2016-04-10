
<div class="modal-body modal-body-new">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <div class="portlet light bordered" style="border: none !important;background:transparent;padding:0 !important;">                                     
        <div class="portlet-body form">
            <div class="form-body" style="padding: 1px 0;">
                <h3 class="user-detail-header">
                    <i class="fa fa-user" style="font-size:12px;"></i> 
                     {{$user->fname}} {{$user->lname}} 
                </h3>
                <div class="row" style="margin:15px;">
                    <div class="col-md-3 col-sm-4" style="background-color:whitesmoke;">
                        <ul class="list-unstyled profile-nav" style="margin: 15px 0;">
                            <li>
                                <div class="profile-userpic-view">
                                    <img  src="@if($user->profile_pic != null){{ '/img/profile/'.$user->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" style="width:100%">
                                </div>
                                <!-- <a href="javascript:;" class="profile-edits">
                                edit </a> -->
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <div class="row">
                            <div class="col-md-12 profile-info"style="margin: 0 0px;" >
                                <div class="portlet-title portlet-title-new">
                                     <div class="caption">
                                        <i class="icon-badge font-green-haze"></i>
                                        <span class="caption-subject font-green-haze bold uppercase" style="font-size:14px;">About {{$user->fname}}</span>
                                    </div>
                                    @if($user->working_status == "Student")
                                    <div class=" capitalize individual-detail">
                                         Student
                                    </div>
                                    @elseif($user->working_status == "Searching Job")
                                    <div class=" capitalize individual-detail" >
                                         {{ $user->working_status }}
                                    </div>
                                    @elseif($user->role != null && $user->working_status == "Freelanching")
                                    <div class=" capitalize individual-detail" >
                                         {{ $user->role }} {{ $user->working_status }}
                                    </div>
                                    @elseif($user->role != null && $user->working_at !=null && $user->working_status == "Working")
                                    <div class=" capitalize individual-detail" >
                                         {{ $user->role }}, {{ $user->working_at }} 
                                    </div>
                                    @elseif($user->role != null && $user->working_at ==null && $user->working_status == "Working")
                                    <div class=" capitalize individual-detail">
                                         {{ $user->role }}
                                    </div>
                                    @elseif($user->role == null && $user->working_at !=null && $user->working_status == "Working")
                                    <div class=" capitalize individual-detail" >
                                         {{ $user->woring_at }}
                                    </div>
                                    @endif
                                </div>
                                <p>
                                    @if($user->about_individual != null)
                                        {{ $user->about_individual}}
                                    @endif
                                </p>
                                
                                <ul class="list-inline">
                                    @if($user->website_url != null)
                                    <li>
                                        <i class="fa fa-globe"></i><a href="{{$user->website_url}}">
                                            {{$user->website_url}} </a>
                                    </li>
                                    @endif
                                    @if($user->in_page != null)
                                        <li>
                                            <i class="fa fa-linkedin"></i>
                                            <a href="{{$user->in_page}}">{{$user->in_page}}</a>
                                        </li>
                                    @endif
                                    @if($user->fb_page != null)
                                        <li>
                                            <i class="fa fa-facebook"></i>
                                            <a href="{{$user->fb_page}}">{{$user->fb_page}}</a>
                                        </li>
                                    @endif
                                </ul>
                                <ul class="list-inline">
                                    @if($user->dob != null)
                                    <li>
                                        <i class="fa fa-calendar"></i> {{$user->dob}}
                                    </li>
                                    @endif
                                    @if($user->gender == 'Female' && $user->gender != null)
                                    <li>
                                        <i class="fa fa-female"></i> {{$user->gender}}
                                    </li>
                                    @elseif($user->gender == 'Male' && $user->gender != null)
                                    <li>
                                        <i class="fa fa-male"></i> {{$user->gender}}
                                    </li>
                                    @endif
                                    @if($user->education != null)
                                    <?php $education = explode('-', $user->education); 
                                                       $name = $education[0];
                                                       $branch = $education[1];
                                                       $level = $education[2];  ?>
                                    <li class="capitalize">
                                        <i class="fa fa-graduation-cap"></i> {{$name}} in {{$branch}}
                                    </li>
                                    @endif
                                    @if($user->experience != null && $user->experience != 0)
                                    <li class="capitalize">
                                        <i class="fa fa-briefcase"></i> {{ $user->experience }} Years
                                    </li>
                                    @elseif($user->experience == 0 )
                                    <li class="capitalize">
                                        <i class="fa fa-briefcase"></i> Fresher
                                    </li>
                                    @else
                                    
                                    @endif
                                    @if($user->city != null)
                                    <li>
                                        <i class="fa fa-map-marker"></i> {{$user->city}}
                                    </li>
                                    @endif
                                    <!-- <li>
                                        <i class="fa fa-heart"></i> BASE Jumping
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
                <div class="portlet light bordered col-md-7" style="border-radius: 5px !important; ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-badge font-green-haze"></i>
                            <span class="caption-subject font-green-haze bold uppercase">Professional Details</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                            <div class="form-body">
                                @if($user->role != null || $user->resume != null || $user->linked_skill != null)
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-6">Industry</label>                         
                                            <div class="col-md-6 col-xs-6"> 
                                                <p class="form-control-static view-page">
                                                    @if($user->industry != null)
                                                    {{ $user->industry }}
                                                    @else
                                                    <a href="/individual/edit#professional">Add Industry</a>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-6">Functional Area</label>
                                            <div class="col-md-6 col-xs-6">
                                                <p class="form-control-static view-page">
                                                    @if($user->functional_area != null)
                                                    {{$user->functional_area}}
                                                    @else
                                                    <a href="/individual/edit#professional">Add Functional Area</a>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->    
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-6">Role</label>
                                            <div class="col-md-6 col-xs-6">
                                                <p class="form-control-static view-page">
                                                    @if($user->role != null)
                                                    {{ $user->role }}
                                                    @else
                                                    <a href="/individual/edit#professional">Add Role</a>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->    
                                    
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-6">Skills</label>
                                            <div class="col-md-8 col-xs-6">
                                                <p class="form-control-static view-page">
                                                    
                                                    @if($user->linked_skill != null)
                                                    {{ $user->linked_skill }}
                                                    @elseif($user->linked_skill == null)
                                                    <a href="/individual/edit#tab_2-2">Add Skills</a>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                    <!-- /row -->
                                @else
                                <div class="row">
                                    <div class="col-md-12">
                                        {{$user->fname}} has not added any Professional Details.
                                    </div>
                                </div>
                                @endif
                            </div>
                        <!-- END FORM-->
                    </div>
                </div>
                <div class="portlet light bordered col-md-5" style="border-radius: 5px !important; ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-notebook font-green-haze"></i>
                            <span class="caption-subject font-green-haze bold uppercase">Preferences</span>
                            <span class="caption-helper"></span>
                        </div>
                        
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->

                        <div class="form-body">
                            @if($user->prefered_jobtype != null || $user->prefered_location != null)
                            <div class="row">
                                @if($user->prefered_location != null)
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <p class="form-control-static view-page">
                                            @if($user->prefered_jobtype != null)
                                            Looking for {{ $user->prefered_jobtype }} Job in 
                                                
                                                @if($user->prefered_location != null)
                                                    {{$user->prefered_location}}
                                                @endif
                                            @else
                                            {{$user->fname}} has not added Preferred Location
                                             @endif
                                        </p>
                                    </div>
                                </div>
                                @elseif($user->prefered_location == null && $user->prefered_jobtype != null)
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <p class="form-control-static view-page">
                                            Looking for {{ $user->prefered_jobtype }} Job
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @elseif($user->prefered_jobtype == null && $user->prefered_location == null)
                            <div class="row">
                                    <div class="col-md-12">
                                        {{$user->fname}} has not added any Preferences.
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>