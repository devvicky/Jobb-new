<?php 
    $tempMatchExp = 0;
    $tempMatchRole = 0;
    $tempMatchType = 0;
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
<!-- 
 if ((skill %=>65) && (exp=T) && (Location=T) && (Jobrole=T) && (jobtype=T)) {
    echo "Excellent Match";
}
else if ((skill%=>65) && (exp=T) && (Jobrole=T) && (Location=F) && (jobtype=F)) {
    echo "Good Match";
}
else if ((skill%=>33<64) && (exp=T) && (Location=T) && (Jobrole=T)) {
    echo "Good Match";
}
else {
    echo "Quick Check";
} -->
<div class="modal-body modal-body-new">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <div class="portlet light bordered" style="border: none !important;background:transparent;padding:0 !important;">                                     
        <div class="portlet-body form">
            <div class="form-body" style="padding: 1px 0;">
                
                <!-- BEGIN BORDERED TABLE PORTLET-->
                <div class="portlet box">
                    <div class="portlet-body" style=" padding: 0 !important;">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover fixed_header" id="header-fixeds">
                            <thead style="border:0 !important;">
                                <tr style="border:0 !important;">  
                                @if($match == 'GoodMatch')
                                    <th colspan="2" class=" matching-criteria-align magic-match-header-good">
                                       <i class="icon-speedometer magic-font" style="font-size:12px;"></i> Good Match
                                    </th>
                                @elseif($match == 'ExcellentMatch')
                                    <th colspan="2" class=" matching-criteria-align magic-match-header-excellent">
                                       <i class="icon-speedometer magic-font" style="font-size:12px;"></i> Excellent Match
                                    </th>
                                @elseif($match == 'QuickCheck')
                                    <th colspan="2" class=" matching-criteria-align magic-match-header-quick">
                                       <i class="icon-speedometer magic-font" style="font-size:12px;"></i> Quick View
                                    </th>
                                @endif  
                                    
                                </tr>
                                <tr style="border:0 !important;">    
                                    <th class="col-md-6 col-sm-6 col-xs-6 matching-criteria-align magic-match-header">
                                         Required Profile
                                    </th>
                                    <th class="col-md-6 col-sm-6 col-xs-6 matching-criteria-align magic-match-header">
                                         My Profile
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- Skills -->
                                <?php $postSkills = []; 
                                    $postSkillArr = array_map('trim', explode(',', $post->linked_skill));
                                    $userSkillArr = array_map('trim', explode(',', Auth::user()->induser->linked_skill));
                                ?>
                                <?php 
                                    $matchedPost = array_intersect($postSkillArr, $userSkillArr);
                                    $unmatchedPost = array_diff($postSkillArr, $userSkillArr);
                                ?>
                                <?php 
                                    $matched = array_intersect($userSkillArr, $postSkillArr);
                                    $unmatched = array_diff($userSkillArr, $postSkillArr);
                                ?>

                                <tr class="magic-match-title-head">
                                    <td colspan="2" class="matching-criteria-align" style="padding:4px 0 0 0;">
                                        @if(count($matched) > 0)
                                        <i class="fa fa-check-circle magic-match-icon-color"></i> {{$post->magic_match}}% <label class="title-color">Skills ({{count($matched)}} out of {{count($postSkillArr)}} Matched)</label>
                                        @else
                                         <i class="fa fa-times-circle"></i> <label class="title-color">{{$post->magic_match}}% Skills</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="magic-match-title-body">                                                                                            
                                    <td class="">
                                        
                                        @foreach($matchedPost as $m)
                                        <span class="magicmatch-skill-css">
                                        {{$m}}
                                        </span>
                                        @endforeach                                        
                                    
                                        @foreach($unmatchedPost as $um)
                                        <span class="magicmatch-noskill-css">
                                        {{$um}}
                                        </span>  
                                        @endforeach
                                                                               
                                    </td>
                                    @if(Auth::user()->induser->linked_skill != null)                                    
                                    <td class="">
                                        
                                        @foreach($matched as $m)
                                        <span class="magicmatch-skill-css">
                                        {{$m}}
                                        </span>
                                        @endforeach                                        
                                    
                                        @foreach($unmatched as $um)
                                        <span class="magicmatch-noskill-css">
                                        {{$um}}
                                        </span>  
                                        @endforeach
                                                                               
                                    </td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Skills </a></td>
                                    @endif                                  
                                </tr>
                                <tr class="magic-match-title-head">
                                    <td colspan="2" class="matching-criteria-align" style="padding:4px 0 0 0;">
                                        @if(strcasecmp($post->industry, Auth::user()->induser->industry) == 0)
                                        <i class="fa fa-check-circle magic-match-icon-color"></i> <label class="title-color">Industry</label>
                                        @else
                                        <i class="fa fa-times-circle"></i> <label class="title-color">Industry</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="magic-match-title-body">
                                    
                                    <td class="matching-criteria-align">{{ $post->industry }}</td>
                                    @if(Auth::user()->induser->industry != null)
                                    <td class="matching-criteria-align">{{ Auth::user()->induser->industry }}</td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Industry </a></td>
                                    @endif
                                </tr>
                                <tr class="magic-match-title-head">
                                    <td colspan="2" class="matching-criteria-align" style="padding:4px 0 0 0;">
                                       @if(strcasecmp($post->functional_area, Auth::user()->induser->functional_area) == 0 && strcasecmp($post->role, Auth::user()->induser->role) == 0)
                                        <i class="fa fa-check-circle magic-match-icon-color"></i> <label class="title-color">Functional Area - Role</label>
                                        @else
                                        <i class="fa fa-times-circle"></i> <label class="title-color">Functional Area - Role</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="magic-match-title-body">
                                    <!-- <td>
                                        <label class="title-color">Job Role</label>
                                    </td> -->
                                    <td class="matching-criteria-align"> {{ $post->functional_area }} - {{ $post->role }}</td>
                                    @if(Auth::user()->induser->role != null)
                                    <td class="matching-criteria-align">{{ Auth::user()->induser->functional_area }} - {{ Auth::user()->induser->role }}</td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Job Role </a></td>
                                    @endif
                                </tr>
                                
                                
                                <tr class="magic-match-title-head">
                                    
                                    <td colspan="2" class="matching-criteria-align" style="padding:4px 0 0 0;">
                                        @if($post->min_exp <= Auth::user()->induser->experience && $post->max_exp >= Auth::user()->induser->experience)
                                        <i class="fa fa-check-circle magic-match-icon-color"></i> <label class="title-color">Experience</label>
                                        @else
                                        <i class="fa fa-times-circle"></i> <label class="title-color">Experience</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="magic-match-title-body">
                                    <!-- <td>
                                        <label class="title-color">Experience</label>
                                    </td> -->
                                    <td class="matching-criteria-align">{{ $post->min_exp }}-{{ $post->max_exp }} Years</td>
                                    @if(Auth::user()->induser->experience != null && Auth::user()->induser->experience == 0 || Auth::user()->induser->experience == 1)
                                    <td class="matching-criteria-align">{{ Auth::user()->induser->experience }} Year</td>
                                    @elseif(Auth::user()->induser->experience != null && Auth::user()->induser->experience > 1 )
                                    <td class="matching-criteria-align">{{ Auth::user()->induser->experience }} Years</td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Experience </a></td>
                                    @endif
                                </tr>
                               
                                @if($post->education != null)
                                    <?php $educations1 = collect(explode('-', $post->education)); 
                                            $name = $educations1[0];
                                            $branch = $educations1[1];
                                            $level = $educations1[2];

                                            $userEducations = explode('-', Auth::user()->induser->education);
                                            $leveluser = $userEducations[2];
                                            $nameuser = $userEducations[0];

                                            if(in_array($leveluser, explode('-', $post->education))){
                                                
                                            } 

                                            $usrEdu = explode('-', Auth::user()->induser->education); ?>
                                            <?php $educations = collect(explode(',', $post->education)); ?>
                                     
                                @endif
                                 <tr class="magic-match-title-head">
                                    <td colspan="2" class="matching-criteria-align" style="padding:4px 0 0 0;">
                                        @if(in_array($leveluser, explode('-', $post->education)) || $educations->contains( Auth::user()->induser->education))
                                        <i class="fa fa-check-circle magic-match-icon-color"></i> <label class="title-color">Education</label>
                                        @else
                                        <i class="fa fa-times-circle"></i> <label class="title-color">Education</label>
                                        @endif
                                        
                                    </td>
                                </tr>
                                <tr class="magic-match-title-body">
                                    <td>
                                        @if($post->education != null)
                                            <?php $education = collect(explode(',', $post->education)); ?>
                                            <?php $educations = collect(explode(',', $post->education)); ?>
                                             @if(count($education) > 0)
                                                @foreach($education as $edu)
                                                    <?php $educ = explode('-', $edu);
                                                              $name = $educ[0];
                                                              $branch = $educ[1]; ?>

                                                        <label class="label-success education-label" style="border: 1px solid lightgrey;">    {{ $name }} @if($branch != " ")- {{ $branch }} @endif </label>
                                                @endforeach
                                             @endif
                                        @endif
                                    </td>
                                    <td>
                                        <label class="label-success education-label" style="border: 1px solid lightgrey;">{{$usrEdu[0]}}-{{$usrEdu[1]}}</label>
                                    </td>
                                </tr>
                                <?php $postSkills = []; 
                                    $postCity = array_map('trim', explode(',', $post->city));
                                    $authCity = array_map('trim', explode(',', Auth::user()->induser->prefered_location));
                                ?>
                                <?php 
                                    $matchedCity = array_intersect($postCity, $authCity);
                                    $unmatchedCity = array_diff($postCity, $authCity);
                                ?>
                                <?php 
                                    $matchedUserCity = array_intersect($authCity, $postCity);
                                    $unmatchedUserCity = array_diff($authCity, $postCity);
                                ?>

                               <?php $authLocation = explode(',', Auth::user()->induser->prefered_location); ?>
                                <tr class="magic-match-title-head">
                                    <td colspan="2" class="matching-criteria-align" style="padding:4px 0 0 0;">
                                        
                                        @if(count($matchedCity) > 0)
                                        <i class="fa fa-check-circle magic-match-icon-color"></i> 
                                        <label class="title-color">Location</label>
                                        @else
                                        <i class="fa fa-times-circle"></i> 
                                        <label class="title-color">Location</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="magic-match-title-body">                                                                                            
                                    <td class="">
                                        @foreach($matchedCity as $mc)
                                          <label class="label-success matched-city">
                                            {{ $mc }}</label>
                                        @endforeach
                                        @foreach($unmatchedCity as $umc)
                                          <label class="label-success unmatched-city">
                                            {{ $umc }}</label>
                                        @endforeach
                                    </td>
                                    @if(Auth::user()->induser->prefered_location != null)
                                    <td class="">
                                        @foreach($matchedUserCity as $muc)
                                          <label class="label-success matched-city">
                                            {{ $muc }}</label>
                                        @endforeach
                                        @foreach($unmatchedUserCity as $umuc)
                                          <label class="label-success unmatched-city">
                                            {{ $umuc }}</label>
                                        @endforeach
                                    </td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Job Location </a></td>
                                    @endif
                                    
                                </tr>
                                <tr class="magic-match-title-head">
                                    <td colspan="2" class="matching-criteria-align" style="padding:4px 0 0 0;">
                                        @if($post->time_for == Auth::user()->induser->prefered_jobtype )
                                        <i class="fa fa-check-circle magic-match-icon-color"></i> <label class="title-color">Job Type</label>
                                        @else
                                        <i class="fa fa-times-circle"></i> <label class="title-color">Job Type</label>
                                        @endif
                                        
                                    </td>
                                </tr>
                                <tr class="magic-match-title-body">
                                                                                            
                                    <td class="matching-criteria-align">{{ $post->time_for }}</td>
                                    @if(Auth::user()->induser->prefered_jobtype != null)
                                    <td class="matching-criteria-align">{{ Auth::user()->induser->prefered_jobtype }}</td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Job Type </a></td>
                                    @endif
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END BORDERED TABLE PORTLET-->
            </div>
        </div>
    </div>	
</div>