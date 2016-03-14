
<div class="modal-body modal-body-new">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <div class="portlet light bordered" style="border: none !important;background:transparent;padding:0 !important;">                                     
        <div class="portlet-body form">
            <div class="form-body" style="padding: 1px 0;">
                <h3 class="magic-match-header">
                    <i class="icon-speedometer magic-font" style="font-size:12px;"></i> 
                    {{$post->magic_match}} %
                </h3>
                <!-- BEGIN BORDERED TABLE PORTLET-->
                <div class="portlet box">
                    <div class="portlet-body" style=" padding: 0 !important;">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover">
                            <thead style="border:0 !important;">
                            <tr style="border:0 !important;">    
                                <th class="col-md-6 col-sm-6 col-xs-6 matching-criteria-align">
                                     Required Profile
                                </th>
                                <th class="col-md-6 col-sm-6 col-xs-6 matching-criteria-align">
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
                                    <td colspan="2" class="matching-criteria-align">
                                        @if(count($matched) > 0)
                                        <i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Skills({{count($matched)}})</label>
                                        @else
                                        <i class="fa fa-times"></i> <label class="title-color">Skills</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr>                                                                                            
                                    <td class="matching-criteria-align">
                                        
                                        @foreach($matchedPost as $m)
                                        <span style="background-color:green;color:white;padding: 2px 4px;margin:2px;text-transform:capitalize">
                                        {{$m}}
                                        </span>
                                        @endforeach                                        
                                    
                                        @foreach($unmatchedPost as $um)
                                        <span style="background-color:red;color:white;padding: 2px 4px;margin:2px;text-transform:capitalize">
                                        {{$um}}
                                        </span>  
                                        @endforeach
                                                                               
                                    </td>
                                    @if(Auth::user()->induser->linked_skill != null)                                    
                                    <td class="matching-criteria-align">
                                        
                                        @foreach($matched as $m)
                                        <span style="background-color:green;color:white;padding: 2px 4px;margin:2px;text-transform:capitalize">
                                        {{$m}}
                                        </span>
                                        @endforeach                                        
                                    
                                        @foreach($unmatched as $um)
                                        <span style="background-color:red;color:white;padding: 2px 4px;margin:2px;text-transform:capitalize">
                                        {{$um}}
                                        </span>  
                                        @endforeach
                                                                               
                                    </td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Skills </a></td>
                                    @endif                                  
                                </tr>
                                <tr class="@if(strcasecmp($post->job_role->first()->industry, Auth::user()->induser->job_role->first()->industry) == 0) title-bacground-color @else title-bacground-color @endif">
                                    <td colspan="2" class="matching-criteria-align">
                                        @if(strcasecmp($post->job_role->first()->industry, Auth::user()->induser->job_role->first()->industry) == 0)
                                        <i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Industry</label>
                                        @else
                                        <i class="fa fa-times"></i> <label class="title-color">Industry</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="@if(strcasecmp($post->job_role->first()->industry, Auth::user()->induser->job_role->first()->industry) == 0) success @else danger-new @endif">
                                    <!-- <td>
                                        <label class="title-color">Job Role</label>
                                    </td> -->
                                    <td class="matching-criteria-align">{{ $post->job_role->first()->industry }}</td>
                                    @if(Auth::user()->induser->industry != '[]')
                                    <td class="matching-criteria-align">{{ Auth::user()->induser->job_role->first()->industry }}</td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Job Role </a></td>
                                    @endif
                                </tr>
                                
                                <tr class="@if(strcasecmp($post->role, Auth::user()->induser->role) == 0) title-bacground-color @else title-bacground-color @endif">
                                    <td colspan="2" class="matching-criteria-align">
                                        @if(strcasecmp($post->role, Auth::user()->induser->role) == 0)
                                        <i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Job Role</label>
                                        @else
                                        <i class="fa fa-times"></i> <label class="title-color">Job Role</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="@if(strcasecmp($post->role, Auth::user()->induser->role) == 0) success @else danger-new @endif">
                                    <!-- <td>
                                        <label class="title-color">Job Role</label>
                                    </td> -->
                                    <td class="matching-criteria-align">{{ $post->job_role->first()->role }}</td>
                                    @if(Auth::user()->induser->role != null)
                                    <td class="matching-criteria-align">{{ Auth::user()->induser->job_role->first()->role }}</td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Job Role </a></td>
                                    @endif
                                </tr>
                                
                                
                                <tr class="@if($post->min_exp <= Auth::user()->induser->experience && $post->max_exp >= Auth::user()->induser->experience) title-bacground-color @else title-bacground-color @endif">
                                    
                                    <td colspan="2" class="matching-criteria-align">
                                        @if($post->min_exp <= Auth::user()->induser->experience && $post->max_exp >= Auth::user()->induser->experience)
                                        <i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Experience</label>
                                        @else
                                        <i class="fa fa-times"></i> <label class="title-color">Experience</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="@if($post->min_exp <= Auth::user()->induser->experience && $post->max_exp >= Auth::user()->induser->experience) success @else danger-new @endif">
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
                                <tr class="@if($post->education == Auth::user()->induser->education) title-bacground-color @else title-bacground-color @endif">
                                    <td colspan="2" class="matching-criteria-align">
                                        @if($post->education == Auth::user()->induser->education)
                                        <i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Education</label>
                                        @else
                                        <i class="fa fa-times"></i> <label class="title-color">Education</label>
                                        @endif
                                        
                                    </td>
                                </tr>
                                <tr class="@if($post->education == Auth::user()->induser->education) success @else danger-new @endif">
                                    <!-- <td>
                                        <label class="title-color">Education</label>
                                    </td> -->
                                    <td class="matching-criteria-align">
                                        @if($post->education != null)
                                            <?php $educations = collect(explode(',', $post->education)); ?>
                                             @if(count($educations) > 0)
                                                @foreach($educations as $edu)
                                                    {{ $edu }} <br/>
                                                @endforeach
                                             @endif
                                        @endif

                                    </td>
                                    @if(Auth::user()->induser->education != null)
                                    <td class="matching-criteria-align">
                                        @if( count($educations) > 0 && 
                                             $educations->contains( Auth::user()->induser->branch."-".Auth::user()->induser->education ))
                                            <span style="color:green">
                                                {{Auth::user()->induser->branch}}-{{Auth::user()->induser->education}} <br/>
                                            </span>
                                        @else
                                            <span style="color:red">
                                                {{Auth::user()->induser->branch}}-{{Auth::user()->induser->education}} <br/>
                                            </span>
                                        @endif
                                    </td>
                                    @else
                                    <td class="matching-criteria-align"><a href="/individual/edit">Add Education </a></td>
                                    @endif
                                </tr>
                                <tr class="@if($post->city == Auth::user()->induser->city) title-bacground-color @else title-bacground-color @endif">
                                    <td colspan="2" class="matching-criteria-align">
                                        @if($post->city == Auth::user()->induser->city)
                                        <i class="fa fa-check magic-match-icon-color"></i> 
                                        <label class="title-color">Location</label>
                                        @else
                                        <i class="fa fa-times"></i> 
                                        <label class="title-color">Location</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="@if($post->city == Auth::user()->induser->city) success @else danger-new @endif">                                                                                            
                                    <td class="matching-criteria-align">
                                    @if(count($post->preferlocations) > 0)
                                        @foreach($post->preferlocations as $loc)
                                            {{ $loc->city }}-{{ $loc->state }} <br/>
                                        @endforeach
                                    @endif
                                    </td>

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
                                </tr>
                                <tr class="@if($post->time_for == Auth::user()->induser->prefered_jobtype || ($post->time_for == 'Part Time' && Auth::user()->induser->prefered_jobtype == 'Full Time')) title-bacground-color @else title-bacground-color @endif">
                                    <td colspan="2" class="matching-criteria-align">
                                        @if($post->time_for == Auth::user()->induser->prefered_jobtype || ($post->time_for == 'Part Time' && Auth::user()->induser->prefered_jobtype == 'Full Time'))
                                        <i class="fa fa-check magic-match-icon-color"></i> <label class="title-color">Job Type</label>
                                        @else
                                        <i class="fa fa-times"></i> <label class="title-color">Job Type</label>
                                        @endif
                                        
                                    </td>
                                </tr>
                                <tr class="@if($post->time_for == Auth::user()->induser->prefered_jobtype || ($post->time_for == 'Part Time' && Auth::user()->induser->prefered_jobtype == 'Full Time')) success @else danger-new @endif">
                                                                                            
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