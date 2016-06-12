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


<?php if(Auth::user()->identifier == 1){
        $groupsTagged = array();
    }  ?>
    @if(Auth::user()->identifier == 1)
@foreach($post->groupTagged as $gt)
    <?php $groupsTagged[] = $gt->group_id; ?>
@endforeach
@endif
<?php 
    // $strNew = '+'.$post->post_duration.' day';
    // $strOld = $post->created_at;
    // $fresh = $strOld->modify($strNew);

    // $currentDate = new \DateTime();
    // $expiryDate = new \DateTime($fresh);
    // $difference = $expiryDate->diff($currentDate);
    // $remainingDays = $difference->format('%d');
    // if($currentDate >= $fresh){
    //     $expired = 1;
    // }else{
    //     $expired = 0;
    // }
?>

<?php 
	$strNew = $post->post_duration;
	$strAdd = $strNew;
	$strAdd = '+'.$strAdd.' day';
		$strOld = $post->created_at;
		$fresh = $strOld->modify($strAdd);

		$currentDate = \Carbon\Carbon::now(new \DateTimeZone('Asia/Kolkata'));
		$expiryDate = new \Carbon\Carbon($fresh, 'Asia/Kolkata');
		$difference = $currentDate->diff($expiryDate);
		$remainingDays = $difference->format('%d');
		$remainingHours = $difference->format('%h');

		$dateExpire= $expiryDate->format('d M Y');
		$dayExpire = $difference->format('%d');
		if($currentDate >= $fresh){
			$expired = 1;
		}else{
			$expired = 0;
		}
	?>
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
	<li>
		<a href="/home">Home</a><i class="fa fa-circle"></i>
	</li>
	<li>
		<a href="/mypost">My Activity</a>
		<i class="fa fa-circle"></i>
	</li>
	<li class="active">
		 MyPost-{{$post->unique_id}}
	</li>
</ul>
<!-- END PAGE BREADCRUMB -->
<div class="row" style="margin: 0;background-color: transparent;">
    <div class="col-md-10" style="padding:0;">
        <div class="col-md-10" style="padding-left: 6px;padding-right: 6px;">
            <!-- BEGIN PORTLET -->
            <div class="portlet light " style="background-color:white;">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase" style="font-size: 15px;">{{$post->post_type}} Details</span>
                        
                        <br/>
                        <span style="font-size: 11px;">Post Id: {{$post->unique_id}} &nbsp;&nbsp;<i class="fa fa-calendar" style="font-size: 11px;"></i> &nbsp;{{ date('d M y, h:m A', strtotime($post->created_at)) }}</span><br/>
                        @if($expired == 0)
			  			<small style="font-size:13px;">Post expires in 
				  			<button class="btn post-expire-duration-css"> 
				  				{{($post->post_duration + $post->post_extended)}} days
				  			</button>
				  		</small>
						@elseif($expired == 1 && $post->post_duration_extend == 0 || $post->post_duration_extend != 1)
				  			<small style="font-size:13px;">{{$dateExpire}}: Post Expired</small><br/>
				  		@endif
				  		@if($post->post_extended != null)
				  		
				  		<button type="button" class="btn btn-default" style="background-color:transparent;border:0;" data-toggle="tooltip" data-placement="top" title="{{ date('d M y, h:m A', strtotime($post->post_extended_Dt)) }}: Post Extended for {{$post->post_extended}} days">
				  			<i class="fa fa-info-circle" style="color: #337ab7;font-size:15px;"></i>
				  		</button>
							
						@endif
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="position-header">
                        <h1> {{$post->post_title}} ({{ $post->min_exp }} yrs)
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
                        <label class="label-success job-type-skill-css">{{$post->time_for}} ({{$post->job_agreement}})</label> <?php $skills = explode(',', $post->linked_skill) ?>                                                                                                                              
                                                    @foreach($skills as $skill)
                                                        <label class="label-success skill-label">{{ $skill }}</label>
                                                    @endforeach
                        </div>
                    </div>

           
                    @if($expired != 1)
                    <div class="row" style="margin-top: 15px;">
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
                        <div class="col-md-4 col-sm-4 col-xs-5">
                            <!-- Small button group -->
                            <div class="btn-group">
                                <button class="btn blue btn-sm action-mypost-btn dropdown-toggle" type="button" data-toggle="dropdown" style="border-radius: 25px !important;">
                                Action <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-mypost" role="menu">
									<li style="border-bottom: 1px solid lightgrey;">
										@if($post->post_type == 'job')
										<a href="/job/edit/{{$post->unique_id}}" style="font-size:13px;color:white !important;">
										Edit Post</a>
										@elseif($post->post_type == 'skill')
										<a href="/skill/edit/{{$post->unique_id}}" style="font-size:13px;color:white !important;">
										Edit Post</a>
										@endif
									</li>
									<li style="border-bottom: 1px solid lightgrey;">
										@if($remainingDays >= 2)
											@if($post->post_duration_extend == 0)
												<a href="#extend-job-expiry-{{ $post->id }}" data-toggle="modal"  style="font-size:13px;color:white !important;">
												 Extend Post Duration</a>
										   @else
										   <a href="javascript:;" style="font-size:13px;color: #ccc !important;">Post Extended</a>
										   @endif
											@elseif( $remainingDays == 1)
													@if($post->post_duration_extend == 0)
													<a href="#extend-job-expiry-{{ $post->id }}" data-toggle="modal" style="font-size:13px;color:white !important;">
													    Extend Post Duration</a>
													@else
												   	<a href="javascript:;" style="font-size:13px;color: #ccc !important;">Post Extended</a>
													   @endif
											@elseif($remainingDays == 0 && $remainingHours > 10)
													@if($post->post_duration_extend == 0)
													<a href="#extend-job-expiry-{{ $post->id }}" data-toggle="modal" style="font-size:13px;color:white !important;">
													    Extend Post Duration</a>
													@else
												   	<a href="javascript:;" style="font-size:13px;color: #ccc !important;">Post Extended</a>  
													   @endif
											@elseif($remainingHours < 10)
													@if($post->post_duration_extend == 0)
													<a href="#extend-job-expiry-{{ $post->id }}" data-toggle="modal" style="font-size:13px;color:white !important;">
													     Extend Post Duration</a>
													@else
												   	<a href="javascript:;" style="font-size:13px;color: #ccc !important;">Post Extended</a>
													@endif										
											@endif
									</li>
									<li>
										<a data-toggle="modal" href="#expire" style="font-size:13px;color:white !important;">
											 Expire Post
										</a>
									</li>
								</ul>
                            </div>
                        </div>
                    </div>
                    @elseif($expired == 1)
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-4 col-sm-4 col-xs-5" style="margin: 10px 0 -10px 0;">
                            <i class="glyphicon glyphicon-ban-circle"></i> Post Expired
                        </div>
                    </div>
                    @endif
                    
                </div>
            </div>
            <!-- END PORTLET -->
           <div class="row" style="margin: 10px 0;">
           		<div class="col-md-6">
           			<button class="btn btn-sm red show-mypost-content">Read More</button>
           		</div>
           </div>
            <!-- BEGIN PORTLET -->
            <div class="portlet light mypost-content-show" style="padding:0;">
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
                                         {{$post->min_sal}} ({{$post->salary_type}})
                                    </td>
                                    @else
                                    <td>On Agreement</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END PORTLET -->
            <!-- BEGIN PORTLET -->
            <div class="portlet light mypost-content-show" style="background-color:white;">
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
            <div class="portlet light mypost-content-show" style="background-color:white;">
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
            <div class="row" style="margin: 10px 0;">
           		<div class="col-md-6">
           			<button class="btn btn-sm blue hide-mypost-content">Show Less</button>
           		</div>
           </div>
            <div class="portlet-body" style="margin: 10px 0;">
				<div class="tabbable-custom ">
					<ul class="nav nav-tabs " style="padding:0;">
						@if(Auth::user()->identifier == 2)
						<li  class="active">	
							<a href="#tab_5_1" class="label-new" data-toggle="tab" style="border-left: 0;">Applied 
								
									<?php $i=0; ?>
										@foreach($post->postactivity as $pa)
								  			@if($pa->apply == 1) <?php $i++; ?> @endif
								  		@endforeach
								  		<?php 
									  		if($i>0){
										echo "<span class='badge' style='background-color: deepskyblue;'>";

											  			echo $i;
											  		
										echo "</span>";
										} 
									?> 
								
							</a>
						</li>
						@elseif(Auth::user()->identifier == 1)
						<li class="active">
							<a href="#tab_5_1" class="label-new" data-toggle="tab" style="border-left: 0;padding:10px 6px;">
								Contacted 
								<?php $i=0; ?>
										@foreach($post->postactivity as $pa)
								  			@if($pa->contact_view == 1) <?php $i++; ?> @endif
								  		@endforeach
								  		<?php 
									  		if($i>0){
								echo "<span class='badge' style='background-color: deepskyblue;'>";

									  			echo $i;
									  		
								echo "</span>";
								} 
							?> 
							</a>
						
						</li>
						@endif
						<li>
							<a href="#tab_5_2" class="label-new" data-toggle="tab" style="padding:10px 6px;">
								Thanked
								<?php $i=0; ?>
										@foreach($post->postactivity as $pa)
								  			@if($pa->thanks == 1) <?php $i++; ?> @endif
								  		@endforeach
								  		<?php 
									  		if($i>0){
								echo "<span class='badge' style='background-color: deepskyblue;'>";

									  			echo $i;
									  		
								echo "</span>";
								} 
							?> 
								
							</a>
						</li>
						<li>
							<a href="#tab_5_3" class="label-new" data-toggle="tab" style="padding:10px 6px;">
								Shared
								
									<?php $i=0; ?>
										@foreach($post->postactivity as $pa)
								  			@if($pa->share == 1) <?php $i++; ?> @endif
								  		@endforeach
								  		<?php 
									  		if($i>0){
								echo "<span class='badge' style='background-color: deepskyblue;'>";

									  			echo $i;
									  		
								echo "</span>";
								} 
							?> 
								
							</a>
						</li>
					</ul>
					<div class="tab-content">
						@if(Auth::user()->identifier == 1)
						<div class="tab-pane active" id="tab_5_1">
							<div class="portlet light" style="padding:0px !important;">
								<?php $i=0; ?>
								
								@foreach($post->postactivity as $pa)
						  			@if($pa->contact_view == 1) <?php $i++; ?> @endif
						  		@endforeach
						  		<?php 
						  			
							  		if($i>0){
									$postunique = $post->unique_id;
									echo "<div class='portlet-title'>
										<div class='pull-left '>
											<label class='contacted-css'>People who have Contacted</label>
										</div>
									</div>";
									} 
									else{
										echo "<div class='pull-left '>
											<label class='contacted-css'>No one has Contacted yet.</label>
										</div>";
									}
								?> 
                                @if(count($post->postactivity) > 0)
								<div class="portlet-body">
									<div class="table-scrollable table-scrollable-borderless">
										<table class="table table-hover table-light">
										<thead>
											<tr class="uppercase">
												<th width="10%">
													 Match
												</th>
												<th colspan="2" width="10%">
													 Name
												</th>
												<th width="10%">
													 Contact
												</th>
												<th width="10%">
													 Applied On
												</th>
												<th width="25%">
													 Status
												</th>
											</tr>
											<tr role="row" class="filter">
												<td >
													<!-- <input type="text" class="form-control form-filter input-sm"> -->
												</td>
												<td colspan="2">
													<!-- <input type="text" class="form-control form-filter input-sm" name="order_id"> -->
												</td>
												<td>
													<!-- <input type="text" class="form-control form-filter input-sm"> -->
												</td>
												<td>
													<!-- <input type="text" class="form-control form-filter input-sm"> -->
												</td>
											</tr>
										</thead>
										@foreach($post->postactivity as $pa)
										  	@if($pa->contact_view == 1)
										  	@if($pa->user->induser != null)
										  	<?php $postSkills = array(); ?>														
											@foreach($post->skills as $skill)
												<?php $postSkills[] = $skill->name; ?>
											@endforeach
										  	<?php
							                    $userSkills = array_map('trim', explode(',', $pa->user->induser->linked_skill));
							                    unset ($userSkills[count($userSkills)-1]); 
							                    ?>
												<?php 
													$overlap = array_intersect($postSkills, $userSkills);
													$counts  = array_count_values($overlap);
												?>
											
										<tr role="row" class="filter">
											<td>
												<a data-toggle="modal" data-mpostid="{{$pa->user->induser->id}}" 
													class="magic-font btn btn-success magic-match-css" href="#post-mod-{{$pa->user->induser->id}}"
													 style="color: white;line-height: 1.7;text-decoration: none;">
													<i class="icon-speedometer magic-font" style="font-size:12px;"></i> {{$post->magic_match}} %
												</a>

											</td>
											<td>
											
												<img class="user-pic" src="/img/profile/{{$pa->user->induser->profile_pic}}">
											
											</td>
											<td>
											<a class=" user_detail" data-userid="{{$pa->user->induser->id}}" data-toggle="modal" href="#user_detail">
												{{$pa->user->induser->fname}}
											</a>
											</td>
											<td>
                                                <div class="btn-toolbar margin-bottom-10">
                                                    <div class="btn-group dropup">
                                                            <button class="btn btn-sm blue dropdown-toggle" type="button" data-toggle="dropdown">
                                                            Contact
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-link" role="menu" style="text-align:center;">
                                                                 <li>
                                                                @if($pa->user->induser->email != null)
                                                                <i class="fa fa-envelope"></i> {{$pa->user->induser->email}}<br/>
                                                                @endif
                                                                </li>
                                                                <li>
                                                                    @if($pa->user->induser->mobile != null)
                                                                    <i class="fa fa-phone-square"></i> {{$pa->user->induser->mobile}}<br/>
                                                                    @endif
                                                                </li>
                                                                <li>
                                                                    @if($pa->user->induser->resume != null)
                                                                    <i class="fa fa-file-text"></i> <a href="/resume/{{$pa->user->induser->resume}}" target="_blank">
                                                                            {{$pa->user->induser->resume}}
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>  
                                                </div>
												
											</td>
											<td>
												<i class="fa fa-calendar" style="font-size:12px;"></i>  {{ date('M d, h:m A', strtotime($pa->contact_view_dtTime)) }}
											</td>
											<td>
												@if($pa->status == "")
												<form action="/mypost/contact/status" method="post" id="contact-status-{{$pa->user->induser->id}}" data-ustatus="{{$pa->user->induser->id}}">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="postid" value="{{ $post->id }}">
												<input type="hidden" name="userid" value="{{ $pa->user->id }}">

													<select name="status" id="status-{{$pa->user->induser->id}}" class="form-control form-filter input-sm" required>
														<option value="">Select...</option>
														<option value="consider">Consider</option>
														<option value="hold">On Hold</option>
														<option value="ignore">Ignore</option>
													</select>
													<button type="button" id="mypost-contactstatus-{{$pa->user->induser->id}}" class="btn active-save btn-success mypost-contactstatus" 
													style="padding: 0 8px;margin: 2px;float: right;">
														Save
													</button>
												</form>
												@else
													@if($pa->status == "consider")
													<label class="label-sm label-success mypost-status-css">{{$pa->status}}</label> <label id="edit-{{$pa->user->induser->id}}"><i class="fa fa-edit"></i>
													<form action="/mypost/contact/status" method="post" id="contact-status-{{$pa->user->induser->id}}" data-ustatus="{{$pa->user->induser->id}}">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="postid" value="{{ $post->id }}">
														<input type="hidden" name="userid" value="{{ $pa->user->id }}">
														<select name="status" id="status-{{$pa->user->induser->id}}" class="form-control status form-filter input-sm" required>
															<option value="">Select...</option>
															<option value="consider">Consider</option>
															<option value="hold">On Hold</option>
															<option value="ignore">Ignore</option>
														</select>
														<button type="button" id="mypost-contactstatus-{{$pa->user->induser->id}}" class="btn btn-success active-save mypost-contactstatus" 
														style="padding: 0 8px;margin: 2px;float: right;">
															Save
														</button>
													</form>
													@elseif($pa->status == "hold")
													<label class="label-sm label-warning mypost-status-css">{{$pa->status}}</label> <i class="fa fa-edit"></i>
													<form action="/mypost/contact/status" method="post" id="contact-status-{{$pa->user->induser->id}}" data-ustatus="{{$pa->user->induser->id}}">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="postid" value="{{ $post->id }}">
														<input type="hidden" name="userid" value="{{ $pa->user->id }}">
														<select name="status" id="status-{{$pa->user->induser->id}}" class="form-control status form-filter input-sm" required>
															<option value="">Select...</option>
															<option value="consider">Consider</option>
															<option value="hold">On Hold</option>
															<option value="ignore">Ignore</option>
														</select>
														<button type="button" id="mypost-contactstatus-{{$pa->user->induser->id}}" class="btn btn-success active-save mypost-contactstatus" 
														style="padding: 0 8px;margin: 2px;float: right;">
															Save
														</button>
													</form>
													@elseif($pa->status == "ignore")
													<label class="label-sm label-danger mypost-status-css">{{$pa->status}}</label> <i class="fa fa-edit"></i>
													<form action="/mypost/contact/status" method="post" id="contact-status-{{$pa->user->induser->id}}" data-ustatus="{{$pa->user->induser->id}}">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="postid" value="{{ $post->id }}">
														<input type="hidden" name="userid" value="{{ $pa->user->id }}">
														<select name="status" id="status-{{$pa->user->induser->id}}" class="form-control status form-filter input-sm" required>
															<option value="">Select...</option>
															<option value="consider">Consider</option>
															<option value="hold">On Hold</option>
															<option value="ignore">Ignore</option>
														</select>
														<button type="button" id="mypost-contactstatus-{{$pa->user->induser->id}}" class="btn btn-success active-save mypost-contactstatus" 
														style="padding: 0 8px;margin: 2px;float: right;">
															Save
														</button>
													</form>
													@endif
												@endif
												<div id="status-update-{{$pa->user->induser->id}}"></div>
											</td>
										</tr>
										@endif
										@endif
										@endforeach
										</table>
									</div>
								</div>
                                @endif
							</div>
						</div>
						@else
						<div class="tab-pane active" id="tab_5_1">

						</div>
						@endif
						<div class="tab-pane" id="tab_5_2">
							<div class="portlet light" style="padding:0px !important;">
								<?php $i=0; ?>
									@foreach($post->postactivity as $pa)
							  			@if($pa->thanks == 1) <?php $i++; ?> @endif
							  		@endforeach
							  		<?php 
								  		if($i>0){
								echo "<div class='portlet-title'>
										<div class='pull-left '>
											<label class='contacted-css'>People who have Thanked</label>
										</div>
									</div>";
									}else{
									echo "<div class='pull-left '>
										<label class='contacted-css'>No one has Thanked.</label>
									</div>";
									}
								?>
								<div class="portlet-body">
									<ul data-handle-color="#637283" style="padding: 0">
									 @foreach($post->postactivity as $pa)
									  	@if($pa->thanks == 1)
										  	@if($pa->user->induser != null)
										  	<div class="row" style="font-size:13px;border-bottom:1px dotted lightgrey;    margin: 2px 0;">
										  		<div class="col-md-8">
											  		<div class="col-md-2 col-sm-3 col-xs-3">
											  			<img src="@if($pa->user->induser->profile_pic != null){{ '/img/profile/'.$pa->user->induser->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" 
								                    		 width="45" height="45" 
								                    		 class="img-circle">
											  		</div>
											  		<div class="col-md-6 col-sm-9 col-xs-9">
											  			<a href="/profile/ind/{{$pa->user->induser->id}}" data-utype="ind">
									                    		{{$pa->user->induser->fname}}</a> has thanked this post
											  		</div>
											  		<div class="col-md-4 col-sm-6 col-xs-6">
											  			<i class="fa fa-calendar" style="font-size:12px;"></i>	
											  			 {{ date('M d', strtotime($pa->thanks_dtTime)) }}
											  		</div>
											  	</div>
										  	</div>
						                 	
						                   	@elseif($pa->user->corpuser != null)
						                   	<div class="row" style="font-size:13px;border-bottom:1px dotted lightgrey;    margin: 2px 0;">
										  		<div class="col-md-8" >
											  		<div class="col-md-2 col-sm-3 col-xs-3">
											  			<img src="@if($pa->user->corpuser->logo_status != null){{ '/img/profile/'.$pa->user->corpuser->logo_status }}@else{{'/assets/images/ab.png'}}@endif" 
							                    		 width="45" height="45" 
							                    		 class="img-circle">
											  		</div>
											  		<div class="col-md-6 col-sm-9 col-xs-9">
											  			<a href="/profile/corp/{{$pa->user->corpuser->id}}" data-utype="ind">
								                    		 {{$pa->user->corpuser->firm_name}}</a> has thanked this post
											  		</div>
											  		<div class="col-md-4 col-sm-6 col-xs-6">
											  			<i class="fa fa-calendar" style="font-size:12px;"></i>	
											  			{{ date('M d', strtotime($pa->thanks_dtTime)) }}				    
											  		</div>
											  	</div>
										  	</div>
						                   	
						                   	@endif
					                   	@endif									                 
					                  @endforeach							                  
					                </ul>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_5_3">
							<div class="portlet light" style="padding:0px !important;">
								<?php $i=0; ?>
									@foreach($post->postactivity as $pa)
							  			@if($pa->share == 1) <?php $i++; ?> @endif
							  		@endforeach
							  		<?php 
								  		if($i>0){
								echo "<div class='portlet-title'>
										<div class='pull-left '>
											<label class='contacted-css'>People who have Shared</label>
										</div>
									</div>";
									}else{
									echo "<div class='pull-left '>
										<label class='contacted-css'>No one has Shared.</label>
									</div>";
									}
								?>
								<div class="portlet-body">
									<ul data-handle-color="#637283" style="padding: 0">
									 @foreach($post->postactivity as $pa)
									  	@if($pa->share == 1)
									  	@if($pa->user->induser != null)
										  	<div class="row" style="font-size:13px;border-bottom:1px dotted lightgrey;    margin: 2px 0;">
										  		<div class="col-md-8">
											  		<div class="col-md-2 col-sm-3 col-xs-3">
											  			<img src="@if($pa->user->induser->profile_pic != null){{ '/img/profile/'.$pa->user->induser->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" 
								                    		 width="45" height="45" 
								                    		 class="img-circle">
											  		</div>
											  		<div class="col-md-6 col-sm-9 col-xs-9">
											  			<a href="/profile/ind/{{$pa->user->induser->id}}" data-utype="ind">
									                    		{{$pa->user->induser->fname}}</a> has shared this post
											  		</div>
											  		<div class="col-md-4 col-sm-6 col-xs-6">
											  			<i class="fa fa-calendar" style="font-size:12px;"></i>		
											  			{{ date('M d', strtotime($pa->share_dtTime)) }}			             
											  		</div>
											  	</div>
										  	</div>
						                 	
						                   	@elseif($pa->user->corpuser != null)
						                   	<div class="row" style="font-size:13px;border-bottom:1px dotted lightgrey;    margin: 2px 0;">
										  		<div class="col-md-8" >
											  		<div class="col-md-2 col-sm-3 col-xs-3">
											  			<img src="@if($pa->user->corpuser->logo_status != null){{ '/img/profile/'.$pa->user->corpuser->logo_status }}@else{{'/assets/images/ab.png'}}@endif" 
							                    		 width="45" height="45" 
							                    		 class="img-circle">
											  		</div>
											  		<div class="col-md-6 col-sm-9 col-xs-9">
											  			<a href="/profile/corp/{{$pa->user->corpuser->id}}" data-utype="ind">
								                    		 {{$pa->user->corpuser->firm_name}}</a> has shared this post
											  		</div>
											  		<div class="col-md-4 col-sm-6 col-xs-6">
											  			<i class="fa fa-calendar" style="font-size:12px;"></i>					                    	
							                    	{{ date('M d', strtotime($pa->share_dtTime)) }}
											  		</div>
											  	</div>
										  	</div>
						                   	
						                   	@endif
										  	
					                   	@endif									                 
					                  @endforeach							                  
					                </ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>





<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="extend-job-expiry-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form action="/job/extended" class="horizontal-form" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="post_id" value="{{ $post->id }}">
			<input type="hidden" name="post_duration" value="{{ $post->post_duration }}">
		     <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		        <h4 class="modal-title">Extend Post Validity</h4>
		      </div>
		      <div class="modal-body">
		      		@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<div class="form-group">
						<label>Post Duration</label>
						<div class="input-group">
							<span class="input-group-addon">
							<i class="icon-clock" style=" color: darkcyan;"></i>
							</span>
							<select name="post_duration_extend" class="form-control" >						
								<option value="3">3 Days</option>
								<option value="7">7 Days</option>
								<option value="15">15 Days</option>
								<option value="30">30 Days</option>
							</select>
						</div>
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="submit" class="btn btn-success">Update</button>
		        <button type="button" class="btn default" data-dismiss="modal">Close</button>
		      </div>
		</form>
	</div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
			
<div class="modal fade" id="myactivity-post" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog-new">
		<div class="modal-content">
			<div id="myactivity-post-content">
				My Activity Post 
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="viewcontact-view" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog-new">
		<div class="modal-content">
			<div id="viewcontact-view-content">
				My Activity Post 
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- SHARE MODAL FORM-->
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
          <input type="hidden" name="share_post_id" id="modal_share_post_id" value="">
		@if(Auth::user()->induser)

		<div id="post-share-msg-box" style="display:none">
			<div id="post-share-msg"></div>
		</div>
		<div id="post-share-form-errors" style="display:none"></div>

		<div class="row"> 
            <div class="col-md-6">                      
              <h4>Who can see this Post</h4>
            </div>
            <div class="col-md-6">
              <!-- <label for="tag-group-all" style="padding: 5.5px 12px;">
                <input type="checkbox" id="tag-group-all" name="tag-group" value="all" class="md-radiobtn">
                Public 
              </label> -->
              <label for="tag-group-links" style="padding: 5.5px 12px;">
                <input type="checkbox" id="tag-group-links" name="tag-group" value="links" class="md-radiobtn" >
                Links 
              </label>
              <label for="tag-group-groups" style="padding: 5.5px 12px;">
                <input type="checkbox" id="tag-group-groups" name="tag-group" value="groups" class="md-radiobtn" >                  
                Groups 
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
<div class="modal fade" id="myactivity-posts" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="myactivity-posts-content">
				My Activity Post 
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Magic Match MODAL FORM-->
<div class="modal fade" id="mypost_magicmatch" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="mypost-magicmatch-posts-content">
        <div style="text-align:center;">
          <img src="/assets/global/img/loading.gif"><span> Please wait...</span>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@stop

@section('javascript')
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56afb9b6a3affa13" async="async">
</script>
<script>
 jQuery(document).ready(function() {    
           Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
           TableAjax.init();
        });

    </script>
<script type="text/javascript">
  $(document).ready(function(){
	// myactivity-post
$('.myactivity-posts').on('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('postid');
  	var u_id = $(this).parent().data('uid');
  	console.log(post_id);
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $.ajax({
      url: "/postdetail/detail",
      type: "post",
      data: {postid: post_id, uid: u_id},
      cache : false,
      success: function(data){
    	$('#myactivity-posts-content').html(data);
    	$('#myactivity-posts').modal('show');
      }
    }); 
    return false;
});
});
  </script>
<script type="text/javascript">
	jQuery('#show-social').hide();
	jQuery(document).ready(function(){ 
	    jQuery('#hide-social').on('click', function(event) {
	    jQuery('#show-social').toggle('show');
	    });
	});

	// Magicmatch-post

	$(document).ready(function() {
	    $('.mypost_magicmatch').live('click', function(event) {
	        event.preventDefault();
	        var post_id = $(this).data('mpostid');

	        // console.log(post_id);
	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });

	        $.ajax({
	            url: "/mypostmagicmatch/detail",
	            type: "post",
	            data: {
	                postid: post_id
	            },
	            cache: false,
	            success: function(data) {
	                $('#mypost-magicmatch-posts-content').html(data);
	                $('#mypost_magicmatch').modal('show');
	            }
	        });
	        return false;
	    });
	});




	$(document).ready(function(){ 
		
	    $('.show-contact').on('click', function(event) {
	    var post_id = $(this).parent().data('id');
	    $('#hide-contact-'+post_id).show();
	    });
	});

$(document).ready(function(){
  $('.like-btn').on('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('id');

  	var formData = $('#post-'+post_id).serialize(); 
    var formAction = $('#post-'+post_id).attr('action');

	$count = $('#like-count-'+post_id).text();
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $.ajax({
      url: formAction,
      type: "post",
      data: formData,
      cache : false,
      success: function(data){
        if(data > $count){
 			$('#like-count-'+post_id).text(data);
 			$('#like-btn-'+post_id).css({'background-color':'lightgreen'});
        }else if(data < $count){
 			$('#like-count-'+post_id).text(data);
 			$('#like-btn-'+post_id).css({'background-color':'burlywood'});
        }
      }
    }); 
    return false;
  }); 
});

</script>
<script>
// $('.content').slideUp(400);//reset panels

// $('.panel').click(function() {//open
//    var takeID = $(this).attr('id');//takes id from clicked ele
//    $('#'+takeID+'C').slideDown(400);
//                              //show's clicked ele's id macthed div = 1second
// });
// $('span').click(function() {//close
//    var takeID = $(this).attr('id').replace('Close','');
//    //strip close from id = 1second
//     $('#'+takeID+'C').slideUp(400);//hide clicked close button's panel
// });​

$(document).ready(function(){
	// myactivity-post
$('.myactivity-post').on('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('postid');

    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $.ajax({
      url: "/myactivity/postdetail",
      type: "post",
      data: {post_id: post_id},
      cache : false,
      success: function(data){
    	$('#myactivity-post-content').html(data);
    	$('#myactivity-post').modal('show');
      }
    }); 
    return false;
});

$('.viewcontact-view').on('click',function(event){  	    
  	event.preventDefault();
  	var post_id = $(this).parent().data('postid');

    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $.ajax({
      url: "/viewcontact/view",
      type: "post",
      data: {post_id: post_id},
      cache : false,
      success: function(data){
    	$('#viewcontact-view-content').html(data);
    	$('#viewcontact-view').modal('show');
      }
    }); 
    return false;
});

// get post id for post share
	$('.sojt').on('click',function(event){
	  	var share_post_id = $(this).data('share-post-id');
	  	$('#modal_share_post_id').val(share_post_id);
	});
	
	$('#connections').select2({
            placeholder: "Select links to share"
        });
    $('#groups').select2({
            placeholder: "Select groups to share"
        });

    // share post 
    $('#modal-post-share-btn').on('click',function(event){       
	    event.preventDefault();
		loader('show');

		var share_post_id = $("#modal_share_post_id").val();
	    var formData = $('#modal-post-share-form').serialize(); // form data as string
	    var formAction = $('#modal-post-share-form').attr('action'); // form handler url
	    // console.log(share_post_id);
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $.ajax({
	      url: formAction,
	      type: "post",
	      data: formData,
	      cache : false,
	      success: function(data){
	      	loader('hide');
	        if(data.data.page == 'home'){
	            $('#post-share-msg-box').removeClass('alert alert-danger');
	            $('#post-share-form-errors').hide();
	            $('#post-share-msg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#share-count-'+share_post_id).text(data.data.sharecount);
	            // console.log(data.data.sharecount+" - "+share_post_id);
	            $('#modal-post-share-form')[0].reset();
	            $("#connections").select2("val", "");
	            $("#groups").select2("val", "");
	            $("#connections").prop('disabled',true);
               	$("#groups").prop('disabled',true);
	            $('#post-share-msg').html('Post shared successfully ! <br/>');  
	            $("#share-post").fadeTo(2000, 500).slideUp(500, function(){	            	
               		 $('#share-post').modal('hide');
               		 $('#post-share-msg-box').hide();
               		 $('#post-share-msg-box').removeClass('alert alert-success');
               		 $('#post-share-msg-box').removeClass('alert alert-danger');               		 
                });   
	           
	        }
	      },
	      error: function(data) {
	        loader('hide');
		    var errors = data.responseJSON;
		    // console.log(errors);
		    $errorsHtml = '<div class="alert alert-danger"><ul>';
		    $.each(errors.errors, function(index, value) {
		    	console.log(value);
				 $errorsHtml += '<li>' + value[0] + '</li>';
		    });
	 		$errorsHtml += '</ul></div>';	            
	        $( '#post-share-form-errors' ).html( $errorsHtml );
	        $( '#post-share-form-errors' ).show();
	      }
	    }); 
	    return false;
  });
});
</script>
<script>
// User Details

$(document).ready(function() {
    $('.user_detail').live('click', function(event) {
        event.preventDefault();
        var user_id = $(this).data('userid');

        var clear = '<div style="text-align:center;"><img src="/assets/global/img/loading.gif"><span> Please wait...</span></div>';
        $("#user-detail-content").html(clear);

        // console.log(post_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/user/detail",
            type: "post",
            data: {
                userid: user_id
            },
            cache: false,
            success: function(data) {
                $('#user-detail-content').html(data);
                $('#user-detail').modal('show');
            }
        });
        return false;
    });
});
</script>
<script type="text/javascript">
$(document).ready(function () {
toggleFields();
$('#status').change(function () {
toggleFields();
});
});
function toggleFields() {
if ($('#status').val() == 'ignore' || $('#status').val() == 'accept' || $('#status').val() == 'hold')
$(".active-save").show();
else
$(".active-save").hide();
}
</script>
<script type="text/javascript">
$('edit').live('click', function(event){
	event.preventDefault();
	var show = $(this).data('edit');
});
</script>

<script type="text/javascript">
$('.mypost-contactstatus').live('click',function(event){  	    
  	event.preventDefault();
  	var status = $(this).parent().data('ustatus');

  	var formData = $('#contact-status-'+status).serialize(); 
    var formAction = $('#contact-status-'+status).attr('action');
    
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $.ajax({
      url: formAction,
      type: "post",
      data: formData,
      cache : false,

      success: function(data){
     		// console.log(data);
      	if(data.success == 'success'){
      		if(data.data.contact_status == 'consider'){
      			var accept = '<label class="label-sm label-success mypost-status-css">'+data.data.contact_status+'</label>'
      		}else if(data.data.contact_status == 'hold'){
      			var accept = '<label class="label-sm label-warning mypost-status-css">'+data.data.contact_status+'</label>'
      		}else if(data.data.contact_status == 'ignore'){
      			var accept = '<label class="label-sm label-danger mypost-status-css">'+data.data.contact_status+'</label>'
      		}

      		$('#status-update-'+status).html(accept);
      		$('#contact-status-'+status).hide();
			displayToast("Status Updated");
        }else {
        	// console.log(data);
        }
      }
    }); 
    return false;
  });
</script>
<script>
// displayToast

function displayToast($msg) {
    $.bootstrapGrowl($msg, {
        ele: 'body', // which element to append to
        type: 'info', // (null, 'info', 'danger', 'success', 'warning')
        offset: {
            from: 'bottom',
            amount: 10
        }, // 'top', or 'bottom'
        align: 'center', // ('left', 'right', or 'center')
        width: 'auto', // (integer, or 'auto')
        height: 'auto',
        // delay: 3000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
        allow_dismiss: false, // If true then will display a cross to close the popup.
        stackup_spacing: 10 // spacing between consecutively stacked growls.
    });
}
</script>
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
<script type="text/javascript">
$(function(){
	$('.show-mypost-content').click(function(){
		$('.mypost-content-show').show();
		$('.hide-mypost-content').show();
		$('.show-mypost-content').hide();
	});
	$('.hide-mypost-content').click(function(){
		$('.mypost-content-show').hide();
		$('.hide-mypost-content').hide();
		$('.show-mypost-content').show();
	});
});
</script>
@stop