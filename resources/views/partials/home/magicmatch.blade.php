
<div class="modal-body modal-body-new">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <div class="portlet light bordered" style="border: none !important;background:transparent;padding:0 !important;">                                     
        <div class="portlet-body form">
            <div class="form-body" style="padding: 1px 0;">
                <!-- <h3 class="magic-match-header">
                     
                    
                </h3> -->
                <!-- BEGIN BORDERED TABLE PORTLET-->
                <div class="portlet box">
                    <div class="portlet-body" style=" padding: 0 !important;">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover">
                            <thead style="border:0 !important;">
                                <tr style="border:0 !important;">    
                                    <th colspan="2" class=" matching-criteria-align magic-match-header">
                                       <i class="icon-speedometer magic-font" style="font-size:12px;"></i> {{$post->magic_match}} % Skill Matched
                                    </th>
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

                                <tr class=" title-bacground-color ">
                                    <td colspan="2" class="matching-criteria-align" style="padding:4px 0 0 0;">
                                        @if(count($matched) > 0)
                                        <i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Skills ({{count($matched)}})</label>
                                        @else
                                        <i class="fa fa-times"></i> <label class="title-color">Skills</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr>                                                                                            
                                    <td class="" >
                                        
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
                                <tr class="@if(strcasecmp($post->industry, Auth::user()->induser->industry) == 0) title-bacground-color @else title-bacground-nonmatch-color @endif">
                                    <td colspan="2" class="matching-criteria-align" style="padding:4px 0 0 0;">
                                        @if(strcasecmp($post->industry, Auth::user()->induser->industry) == 0)
                                        <i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Industry</label>
                                        @else
                                        <i class="fa fa-times"></i> <label class="title-color">Industry</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="@if(strcasecmp($post->industry, Auth::user()->induser->industry) == 0) @else danger-new @endif">
                                    
                                    <td class="matching-criteria-align">{{ $post->industry }}</td>
                                    @if(Auth::user()->induser->industry != null)
                                    <td class="matching-criteria-align">{{ Auth::user()->induser->industry }}</td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Industry </a></td>
                                    @endif
                                </tr>
                                <tr class="@if(strcasecmp($post->functional_area, Auth::user()->induser->functional_area) == 0 && strcasecmp($post->role, Auth::user()->induser->role) == 0) title-bacground-color @else title-bacground-nonmatch-color @endif">
                                    <td colspan="2" class="matching-criteria-align" style="padding:4px 0 0 0;">
                                       @if(strcasecmp($post->functional_area, Auth::user()->induser->functional_area) == 0 && strcasecmp($post->role, Auth::user()->induser->role) == 0)
                                        <i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Functional Area - Role</label>
                                        @else
                                        <i class="fa fa-times"></i> <label class="title-color">Functional Area - Role</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="@if(strcasecmp($post->functional_area, Auth::user()->induser->functional_area) == 0 && strcasecmp($post->role, Auth::user()->induser->role) == 0) @else danger-new @endif">
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
                                
                                
                                <tr class="@if($post->min_exp <= Auth::user()->induser->experience && $post->max_exp >= Auth::user()->induser->experience) title-bacground-color @else title-bacground-nonmatch-color @endif">
                                    
                                    <td colspan="2" class="matching-criteria-align" style="padding:4px 0 0 0;">
                                        @if($post->min_exp <= Auth::user()->induser->experience && $post->max_exp >= Auth::user()->induser->experience)
                                        <i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Experience</label>
                                        @else
                                        <i class="fa fa-times"></i> <label class="title-color">Experience</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="@if($post->min_exp <= Auth::user()->induser->experience && $post->max_exp >= Auth::user()->induser->experience) @else danger-new @endif">
                                    <!-- <td>
                                        <label class="title-color">Experience</label>
                                    </td> -->
                                    <td class="matching-criteria-align">{{ $post->min_exp }}-{{ $post->max_exp }}</td>
                                    @if(Auth::user()->induser->experience != null)
                                    <td class="matching-criteria-align">{{ Auth::user()->induser->experience }}</td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Experience </a></td>
                                    @endif
                                </tr>
                                <tr class="@if($post->education == Auth::user()->induser->education) title-bacground-color @else title-bacground-nonmatch-color @endif">
                                    <td colspan="2" class="matching-criteria-align" style="padding:4px 0 0 0;">
                                        @if($post->education == Auth::user()->induser->education)
                                        <i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Education</label>
                                        @else
                                        <i class="fa fa-times"></i> <label class="title-color">Education</label>
                                        @endif
                                        
                                    </td>
                                </tr>
                                @if($post->education != null)
                                    <?php $educations1 = collect(explode('-', $post->education)); 
                                            $name = $educations1[0];
                                            $branch = $educations1[1];?>
                                     
                                @endif
                                <tr class="@if($post->education == Auth::user()->induser->education) @else danger-new @endif">
                                    
                                    <td class="">
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
                                    <?php 
                                                    $postEdu = explode('-', $educations[0]); 
                                                    $usrEdu = explode('-', Auth::user()->induser->education); 
                                                ?>
                                    @if(Auth::user()->induser->education != null)
                                    <td class="">
                                        @if( 
                                            ( count($educations) > 0 && $educations->contains( Auth::user()->induser->education ) ) || 
                                            ( count($educations) == 1 )
                                           ) 

                                           @if(count($educations) == 1)
                                                
                                                @if(($postEdu[0] == 'Any Graduate' && $usrEdu[2] == $postEdu[2]) || 
                                                    ($postEdu[0] == 'Any Post Graduate' && $usrEdu[2] == $postEdu[2]))
                                                    <span style="color:green">{{$usrEdu[0]}}-{{$usrEdu[1]}} <br/></span>
                                                @endif
                                           @else
                                            <span style="color:green">{{$usrEdu[0]}}-{{$usrEdu[1]}} <br/></span>
                                            @endif
                                        @else
                                            <span style="color:red">
                                               {{$usrEdu[0]}}-{{$usrEdu[1]}} <br/>
                                            </span>
                                        @endif
                                    </td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Education </a></td>
                                    @endif
                                </tr>
                                <tr class="@if(strcasecmp($post->city, Auth::user()->induser->prefered_location) == 0) title-bacground-color @else title-bacground-nonmatch-color @endif">
                                    <td colspan="2" class="matching-criteria-align" style="padding:4px 0 0 0;">
                                        @if($post->city == Auth::user()->induser->prefered_location)
                                        <i class="fa fa-check magic-match-icon-color"></i> 
                                        <label class="title-color">Location</label>
                                        @else
                                        <i class="fa fa-times"></i> 
                                        <label class="title-color">Location</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="@if(strcasecmp($post->city, Auth::user()->induser->prefered_location) == 0) @else danger-new @endif">                                                                                            
                                    <td class="">
                                    @if(count($post->preferlocations) > 0)
                                        @foreach($post->preferlocations as $loc)
                                          <label class="label-success education-label" style="border: 1px solid lightgrey;">
                                            {{ $loc->city }}-{{ $loc->state }}</label>
                                        @endforeach
                                    @endif
                                    </td>
                                    @if(Auth::user()->induser->prefered_location != null)
                                    <td class="">
                                        {{Auth::user()->induser->prefered_location}}
                                    </td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Job Location </a></td>
                                    @endif
                                    
                                </tr>
                                <tr class="@if($post->time_for == Auth::user()->induser->prefered_jobtype || ($post->time_for == 'Part Time' && Auth::user()->induser->prefered_jobtype == 'Full Time')) title-bacground-color @else title-bacground-nonmatch-color @endif">
                                    <td colspan="2" class="matching-criteria-align" style="padding:4px 0 0 0;">
                                        @if($post->time_for == Auth::user()->induser->prefered_jobtype || ($post->time_for == 'Part Time' && Auth::user()->induser->prefered_jobtype == 'Full Time'))
                                        <i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Job Type</label>
                                        @else
                                        <i class="fa fa-times"></i> <label class="title-color">Job Type</label>
                                        @endif
                                        
                                    </td>
                                </tr>
                                <tr class="@if($post->time_for == Auth::user()->induser->prefered_jobtype || ($post->time_for == 'Part Time' && Auth::user()->induser->prefered_jobtype == 'Full Time')) @else danger-new @endif">
                                                                                            
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