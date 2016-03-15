
@if(Auth::user()->induser->prefered_location != null)
<td class="matching-criteria-align">
    {{Auth::user()->induser->prefered_location}}
</td>
@else
<td class="matching-criteria-align"><a href="/individual/edit">Add Job Location </a></td>
@endif


@if(count(Auth::user()->induser->preferLocations) > 0)
                                    <td class="matching-criteria-align">
                                        @foreach(Auth::user()->induser->preferLocations as $loc)                                            

                                            @if($post->preferlocations->contains('city', $loc->city))
                                                <span style="color:green">
                                                    {{ $loc->city }}-{{ $loc->state }} <br/>
                                                </span>
                                            @else
                                                <span style="color:red">
                                                    {{ $loc->city }}-{{ $loc->state }} <br/>
                                                </span>
                                            @endif

                                        @endforeach
                                    </td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Job Location </a></td>
                                    @endif

                                    

$(".show-salary").hide();
        $("#hide-check").click(function () {
            if ($(this).is(":checked")) {
                $(".show-salary").show();
            } else {
                $(".show-salary").hide();
            }
        });



var skillArray = [];
    <?php $array = explode(', ', $user->induser->linked_skill); ?> 
    @if(count($array) > 0)
    @foreach($array as $gta)
        skillArray.push('<?php echo $gta; ?>');
    @endforeach
    @endif
    var skillselect = $("#linked_skill_id").select2({ dataType: 'json', data: skillArray });
    skillselect.val(skillArray).trigger("change");
    

    // preferred loc
    var prefLocationArray = [];
    <?php $arr = $user->induser->preferred_locations; ?>
    @if(count($arr) > 0) 
    @foreach($arr as $gt)
        prefLocationArray.push('<?php echo $gt; ?>');
    @endforeach
    @endif

<div class="row" style="margin:0;">
    <div class="col-md-12">
        <div class="clearfix">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn default active ">
                    <input type="checkbox" class="toggle">
                    <a href="javascript:;" class="icon-btn">
                    <i class="fa fa-group"></i>
                    <div>
                         Full Time
                    </div> 
                </label>
                <label class="btn default active ">
                    <input type="checkbox" class="toggle">
                    <a href="javascript:;" class="icon-btn">
                    <i class="fa fa-group"></i>
                    <div>
                         Part Time
                    </div> 
                </label>
                <label class="btn default active ">
                    <input type="checkbox" class="toggle">
                    <a href="javascript:;" class="icon-btn">
                    <i class="fa fa-group"></i>
                    <div>
                         Freelancer
                    </div> 
                </label>
                <label class="btn default active ">
                    <input type="checkbox" class="toggle">
                    <a href="javascript:;" class="icon-btn">
                    <i class="fa fa-group"></i>
                    <div>
                         Work From Home
                    </div> 
                </label>
            </div>
        </div>  
    </div> 
</div>


$request['linked_skill'] = implode(',', $request['linked_skill_id']);
        $request['city'] = implode(',', $request['prefered_location']);
        $request['locality'] = implode(',', $request['preferred_locality']);
        $request['unique_id'] = "S".rand(111,999).rand(111,999);









@include('partials.home.job-filter')

@if (count($jobPosts) > 0)
<?php $var = 1; ?>
<div class="portlet light bordered" 
 style="border: none !important; background:transparent; padding:0 !important; margin: -20px 0px;">                                     
<div class="portlet-body form" id="posts">
    <div class="form-body" id="post-items" style="padding:0;">
                
    @foreach($jobPosts as $post)                    
                        
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
                        <div class="col-md-12 home-post">

                            <div class="timeline" >
                                <!-- TIMELINE ITEM -->

                                @if($expired == 1)
                                <div class="timeline-item time-item-ex">
                                @else
                                <div class="timeline-item time-item">
                                @endif
                                    
                                    @include('partials.home.image-linked')
                                    @include('partials.home.favourite')

                                    @if($expired == 1)
                                    <div class="post-hover-exp" data-postid="{{$post->id}}"><a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts">
                                        @else
                                    <div class="post-hover-act" data-postid="{{$post->id}}"><a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts">
                                        @endif
                                    
                                    <div class="row post-postision" style="cursor:pointer;">
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
                                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">
                                        <small style="font-size:13px;color:dimgrey !important;"> <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $post->min_exp}}-{{ $post->max_exp}} Yr</small>
                                        </div>
                                        @endif
                                        @if($post->city != null)
                                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code elipsis-city-code" style="padding:0 12px;">
                                        <small style="font-size:13px;color:dimgrey !important;"> <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{ $post->city }}</small>
                                        </div>
                                        @endif
                                        <div class="col-md-4 col-sm-4 col-xs-4 hide-details" style="float: right;right: -40px;bottom: 16px;">
                                           Details
                                        </div>
                                       
                                    </div>
                                    </a>
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
                                                        <ul class="dropdown-menu pull-right" role="menu" 
                                                            style="min-width:0;box-shadow:0 0 !important">
                                                            <li style="background-color: tan;">
                                                                <a href="#share-post" data-toggle="modal" 
                                                                   class="jobtip sojt" id="sojt-{{$post->id}}" 
                                                                   data-share-post-id="{{$post->id}}">
                                                                    Share on Jobtip
                                                                </a>
                                                            </li>

                                                <li style="padding: 8px 0 0px;margin: auto;display: table;">        
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
                            </div>
                            <!-- END TIMELINE ITEM -->
                        </div>
                        @endif                                  
                </div>
            <?php $var++; ?>
            @endforeach                             
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        <?php echo $jobPosts->render(); ?>
    </div>
</div>          



















@include('partials.home.skill-filter')

@if (count($skillPosts) > 0)
    <?php $var = 1; ?>
    <div class="portlet light bordered" style="border: none !important;background:transparent;padding:0 !important;margin: -20px 0px;">                             
        <div class="portlet-body form" id="post-skills">
                <div class="form-body" id="post-skill-items" style="padding:0;">
    @foreach($skillPosts as $post)                  
            <div class="row post-skill-item">

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
                        <div class="col-md-12 home-post">

                            <div class="timeline" >
                                <!-- TIMELINE ITEM -->
                                @if($expired == 1)
                                <div class="timeline-item time-item-ex">
                                @else
                                <div class="timeline-item time-item">
                                    @endif

                                    @include('partials.home.image-linked')
                                    @include('partials.home.favourite')

                                    @if($expired == 1)
                                    <div class="post-hover-exp" data-postid="{{$post->id}}"><a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts">
                                        @else
                                    <div class="post-hover-act" data-postid="{{$post->id}}"><a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts">
                                        @endif
                                        <div class="row  post-postision" style="cursor:pointer;">
                                            <div class="col-md-12">
                                                <div class="post-title-new">{{ $post->post_title }} </div>
                                            </div>
                                            @if($post->post_compname != null && $post->post_type == 'skill')
                                             <div class="col-md-12">
                                                <div><small style="font-size:13px;">Working at {{ $post->post_compname }}</small></div>
                                            </div>   
                                            @endif
                                        </div>
                                    <div class="row post-postision" style="">
                                        
                                        @if($post->min_exp != null)
                                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code" style="">
                                        <small style="font-size:13px;"> <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $post->min_exp}}-{{ $post->max_exp}} Yr</small>
                                        </div>
                                        @endif
                                        @if($post->city != null)
                                        <div class="col-md-4 col-sm-4 col-xs-4 elipsis-code elipsis-city-code" style="padding:0 12px;">
                                        <small style="font-size:13px;"> <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{ $post->city }}</small>
                                        </div>
                                        @endif
                                        <div id="{{ $post->id }}-{{$var}}-{{$var}}" class="col-md-4 col-sm-4 col-xs-4 hide-details" style="float: right;right: -40px;bottom: 16px;">
                                            <a><i class="fa fa-angle-double-down post-icon-color" style="font-size:20px;"></i></a>
                                        </div>
                                        <div id="{{ $post->id }}-{{$var}}" class="col-md-4 col-sm-4 col-xs-4 show-details" style="float: right;right: -40px;bottom: 16px;">
                                            <a><i class="fa fa-angle-double-up post-icon-color" style="font-size:20px;"></i></a>
                                        </div>
                                    </div>
                                </a></div>
                                    <div class="row" style="margin: 5px 0px; border-top: 1px solid whitesmoke;">
                                        <div class="col-md-12" style="margin: 3px 0px;">

                                            @if($expired != 1)
                                        
                                            <div class="row" style="">  
                                                <div class="col-md-3 col-sm-3 col-xs-4" style="margin: 4px -10px;">
                                                    @if($post->time_for == 'Work from Home')
                                                    <small class="label-success label-xs elipsis-code job-type-skill-css" style="">Work From Home</small>
                                                    @else
                                                    <div><small class="label-success label-xs job-type-skill-css">{{$post->time_for}}</small></div>
                                                    @endif
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-2" style="padding:0 35px;">
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
                                                        <span class="badge-like-skill" id="like-count-{{ $post->id }}">
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
                                                        <ul class="dropdown-menu pull-right" role="menu" 
                                                            style="min-width:0;box-shadow:0 0 !important">
                                                            <li style="background-color: tan;">
                                                                <a href="#share-post" data-toggle="modal" class="jobtip sojt" id="sojt-{{$post->id}}" data-share-post-id="{{$post->id}}">
                                                                    Share on Jobtip
                                                                </a>
                                                            </li>
                                                            <li style="padding: 8px 0 0px;margin: auto;display: table;">        
                                                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                                            <div class="addthis_sharing_toolbox" 
                                                            data-url="http://jobtip.in/post/{{$post->unique_id}}/social" 
                                                            data-title="{{$post->post_title}}"
                                                            data-description="{{ $post->job_detail }}"></div>
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
                                                
                                                <div class="col-md-3 col-sm-3 col-xs-6" style="font-size:12px;text-align:center">
                                                <!-- <div class="expired-css">                                                   -->
                                                    <i class="glyphicon glyphicon-ban-circle" style="font-size:12px;color:dimgrey;"></i> Post Expired
                                                <!-- </div> -->
                                                </div>
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
                            </div>
                            <!-- END TIMELINE ITEM -->
                        </div>
                        @endif
                    
                </div>                          
    <?php $var++; ?>
 @endforeach
        </div>
    </div>
</div>
@elseif(count($skillPosts) == 0)
<div>No skills Posted Yet!!!
@endif

<div class="row">
    <div class="col-md-12">
        <?php echo $skillPosts->render(); ?>
    </div>
</div>










@extends('welcome')

@section('content')

<!-- Start menu section -->
  <section id="menu-area">
    <nav class="navbar navbar-default main-navbar new-nav" role="navigation">  
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- LOGO -->                                               
           <a class="navbar-brand logo" style="padding:0 15px;" href="index.html"><img class="big-logo" src="{{ asset('/assets/logo.png') }}" alt="logo"></a>                      
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav main-nav menu-scroll">
            <li class="active"><a href="#welcome">WELCOME</a></li>
            <li><a href="#search">SEARCH</a></li> 
            <li><a href="#about">ABOUT</a></li>                         
            <li><a href="#contact">CONTACT</a></li>
            <li><a href="/login">LOGIN</a></li>
          </ul>                            
        </div>   
      </div>          
    </nav> 
  </section>




<!-- Start about section -->
<section id="welcome" style="margin: 130px 0;height:900px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- Start welcome area -->
        <div class="welcome-area" style="height: 800px;">
          <div class="title-area" style="top:-90px !important;padding:0 0 !important;">
            <h2 class="tittle">Welcome to <span>Jobtip</span></h2>
            <span class="tittle-line"></span>     
          </div>
          <div><img class="welcome-bg" src="/assets/admin/pages/media/bg/bg.jpg"></div>
          <div class="row" style="margin:0 auto;display:table;">
            <div class='con'>
              <span id="changerificwordspanid" class="uppercase" style="font-size:30px;font-weight:600;">know about any job openings ?</span>
            </div>
          </div>
         
          <div class="row ">
            <div class="tile-position-new">
              <div class="tile bg-red-intense">
                <div class="tile-body box-welcome" style="text-align:center;">
                  <a href="/login">
                    <!-- <div id="test"> -->
                      <div id="show-case">
                        
                        <img class="img" src="/assets/admin/pages/media/bg/job.png" style="">
                        <img class="img" src="/assets/admin/pages/media/bg/skill.png" style="">
                      </div>
                      
                    <!-- </div> -->
                  </a>
                  <!-- <i class="fa fa-gavel">imageid</i> -->
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="margin: 0px auto 30px auto;display:table;">
          <div class='con'>
            <span id="imageid" class="uppercase" style="font-size:30px;font-weight:600;">promote skills</span>
          </div>
        </div>
           <div class="row" style="margin:0 auto;display:table;">
            <div class='con'>
              <span id="changerificwordspanbelowid" class="uppercase" style="font-size:30px;font-weight:600;">help your friends to get a job</span>
            </div>
          </div>
        </div>
        <!-- End welcome area -->
      </div>
    </div></div>
    </section>
    <!-- Start about section -->
<section id="search" style="margin: 60px 0;height: 555px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- Start welcome area -->
        <div class="welcome-area">
          <div class="title-area">
            <h2 class="tittle">Search <span>Jobtip</span></h2>
            <span class="tittle-line"></span>
            <div class="row" style="margin: 0 -10px 0 5px !important;">
              <!-- <div class="col-md-2 col-sm-1"></div> -->
                <div class="col-md-12 col-sm-10">
                <form id="welcome-search" name="welcome_form" action="/welcome/post" method="post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="col-md-5 col-sm-5" style="padding-left:0 !important;">
                    <div class=" form-group">
                      <div class="input-group">
                        <span class="input-group-addon welcome-icon">
                          <i class="fa fa-cogs"></i>
                        </span>
                        <input type="text" required name="role" id="search-input" class="form-control welcome-inputbox" placeholder="Enter Job role">
                      </div>
                    </div>    
                  </div>
                  
                  <div id="welcome-city" class="col-md-4 col-sm-4 col-xs-6" style="padding-left:0 !important;">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon welcome-icon">
                          <i class="fa fa-map-marker"></i>
                        </span>
                        <input type="text" name="location" class="form-control welcome-inputbox" placeholder="City">                    
                      </div>  
                    </div>    
                  </div>
                  <div class="col-md-2 col-sm-3 col-xs-6" style="padding-left:0 !important;">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon welcome-icon">
                          <i class="icon-briefcase"></i>
                        </span>
                        <select class="form-control welcome-inputbox" name="experience" placeholder="Experience">
                          <option value=""> Exp (in Years)</option>
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                        </select>
                      </div>
                    </div>  
                  </div>
                  <div class="col-md-1 col-sm-12 col-xs-12" style="padding-left:0 !important;text-align:center;">
                    <button type="submit" class="btn btn-small-welcome btn-search-welcome search-button-size" style="margin: -1px;">
                      <i class="fa fa-search"></i>
                      
                        <!-- Search -->
                      
                    </button>
                  </div>
                </form>
              </div> 
            </div>
        </div>
        <!-- End welcome area -->
      </div>
    </div>
</div>
    </section>
    <!-- Start about section -->
<section id="about" style="margin: 60px 0;height: 555px;">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <!-- Start welcome area -->
      <div class="welcome-area">
        <div class="title-area">
          <h2 class="tittle">About <span>Jobtip</span></h2>
          <span class="tittle-line"></span>
          <p>Jobtip.in is India's first website allows people to build network and post job requirements within their closed groups, professional/social friends or with public absolutely for free. We have a huge networking of start-up firms, companies, consulting agencies and recruitment agencies of India who post job vacancies and follow people who apply for the jobs matching their skill set.

          This website empowers people to register and promote their skills and get noticed by lacs of job providers, referral candidates seekers to approach you for hiring.

          Jobtip.in respects individuals data privacy and ensures data protection and data security of its user data.</p>
          </div>
      </div>
      <!-- End welcome area -->
    </div>
  </div>
</div>
</section>
     <!-- Start Contact section -->
    <section id="contact" style="margin: 60px 0;height: 555px;">
      <div class="container">
        <div class="row">
           <div class="title-area">
            <h2 class="tittle">Contact <span>Jobtip</span></h2>
            <span class="tittle-line"></span>     
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="contact-left wow fadeInLeft">
              <h2>Contact with us</h2>
              
               <address class="single-address">
                <h4>Connect</h4>
                <p>Email: connect@jobtip.in</p>
                <!-- <p>Email: admin@jobtip.in</p> -->
              </address>
              <ul class="social-icons margin-bottom-10">
                <li>
                  <a href="http://jobtip.in/facebook" data-original-title="facebook" class="facebook">
                  </a>
                </li>
                <li>
                  <a href="http://jobtip.in/google" data-original-title="Goole Plus" class="googleplus">
                  </a>
                </li>
                <li>
                  <a href="http://jobtip.in/linkedin" data-original-title="linkedin" class="linkedin">
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-8 col-sm-6 col-xs-12">
            <div class="contact-right wow fadeInRight">
              <h2>Send a message</h2>
              <form action="" class="contact-form">
                <div class="form-group">                
                  <input type="text" class="form-control welcome-inputbox" placeholder="Name">
                </div>
                <div class="form-group">                
                  <input type="email" class="form-control welcome-inputbox" placeholder="Enter Email">
                </div>              
                <div class="form-group">
                  <textarea row="4" class="form-control welcome-inputbox" placeholder="Write Message"></textarea>
                </div>
                <button type="submit" data-text="SUBMIT" class="btn btn-success"><span>SUBMIT</span></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

@stop

@section('javascript')

<script type="text/javascript">
 (function(){

    // List your words here:
    var words = [
        'know about any job openings ?',
        'looking for job change ?',
        'ready to work ?'
        ], i = 0;

    setInterval(function(){
        $('#changerificwordspanid').fadeOut(function(){
            $(this).html(words[i=(i+1)%words.length]).fadeIn();
        });
       // 2 seconds
    }, 3000);

})();

(function(){

    // List your words here:
    var beloWords = [
        'help your friends to get a job',
        'get right pay for your talent',
        'choose where you want to work'
        ], i = 0;

    setInterval(function(){
        $('#changerificwordspanbelowid').fadeOut(function(){
            $(this).html(beloWords[i=(i+1)%beloWords.length]).fadeIn();
        });
       // 2 seconds
    }, 3000);

})();

(function(){

    // List your words here:
    var imageWords = [
        'post job tip',
        'promote skills'
        ], i = 0;

    setInterval(function(){
        $('#imageid').fadeOut(function(){
            $(this).html(imageWords[i=(i+1)%imageWords.length]).fadeIn();
        });
       // 2 seconds
    }, 3000);

})();

</script>
<script>
$(document).ready(function()
{
    $('.img:gt(0)').hide();
    setInterval(function() {
        $(".img:first-child").fadeOut(1000).next(".img").fadeIn(1000).end().appendTo("#show-case")
}, 3000);
       
});
</script>
@stop




Tag Job Tip

Why opportunities should be always announced publicly?

Create professional links and closed groups and share job vacancies among them.

 Promote skills

Fed up of not getting job opportunities for your matching skills?
Post your skills here for free and get direct call from thousands of startups, companies and recruitment agencies.

 Search Talents

Planning to start a business/startup and stuck due to resource unavailability?
Lacs of highly talented people looking for Free Lancers, Work From Home, Full/Part Time jobs here.

 Post Job Tips

Dependent on companies/Job consulting firms to post job openings?
If you know about any Job openings/referral, Post Job Tip here for free and help your friends, colleagues to find a suitable job.