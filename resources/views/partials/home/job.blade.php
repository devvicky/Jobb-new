@include('partials.home.job-filter')

@if (count($jobPosts) > 0)
<?php $var = 1; ?>
<div class="portlet light bordered" 
 style="border: none !important; background:transparent; padding:0 !important; margin: -20px 0px;">										
<div class="portlet-body form" id="posts">
	<div class="form-body" id="post-items" style="padding:0;">
				
			@foreach($jobPosts as $post)
				<?php $city = 'unspecified'; ?>
				@if($post->preferLocations != '[]')
					<?php $city = ''; ?>
					@if(count($post->preferLocations) > 1)
						@foreach($post->preferLocations as $pl)
							<?php $city = $city . $pl->city .', '; ?>
						@endforeach
					@elseif(count($post->preferLocations) == 1)
						@foreach($post->preferLocations as $pl)
							<?php $city = $city . $pl->city; ?>
						@endforeach
					@endif
				@endif
				<?php $groupsTagged = array(); ?>
                @foreach($post->groupTagged as $gt)
                    <?php $groupsTagged[] = $gt->group_id; ?>
                @endforeach
				<?php
                    $crossCheck = array_intersect($groupsTagged, $groups);
                    $elements = array_count_values($crossCheck); ?>
                            
				@if($post->tagged->contains('user_id', Auth::user()->induser_id) || 
                            $post->individual_id == Auth::user()->induser_id || 
                            count($elements) > 0 || 
                            (count($groupsTagged) == 0 && count($post->tagged) == 0))

				@if($post->expired == 0)
					@if($post->induser != null)	
						@include('partials.home.post', ['userImgPath'	=>	$post->induser->profile_pic, 
														'userName'		=>	$post->induser->fname,
														'postTitle'		=>	$post->post_title,
														'expMin'		=>	$post->min_exp,
														'expMax'		=>	$post->max_exp,
														'city'			=>	$city,
														'company'		=>	$post->post_compname,
														'magicMatch'	=>	$post->magic_match,
														'userType'		=>	'ind',
														'userId'		=>	$post->individual_id,
														'postId'		=>	$post->unique_id,
														'postType'		=>	$post->post_type,
														'skill'			=>	$post->linked_skill,
														'jobType'		=>	$post->time_for ])
					@elseif($post->corpuser != null)
						@include('partials.home.post', ['userImgPath'	=>	$post->corpuser->logo_status, 
														'userName'		=>	$post->corpuser->firm_name,
														'postTitle'		=>	$post->post_title,
														'expMin'		=>	$post->min_exp,
														'expMax'		=>	$post->max_exp,
														'city'			=>	$city,
														'company'		=>	$post->post_compname,
														'magicMatch'	=>	$post->magic_match,
														'userType'		=>	'ind',
														'userId'		=>	$post->individual_id,
														'postId'		=>	$post->unique_id,
														'postType'		=>	$post->post_type,
														'skill'			=>	$post->linked_skill,
														'jobType'		=>	$post->time_for ])
					@endif
				@elseif($post->expired == 1)
					@if($post->induser != null)	
						@include('partials.home.post-expired', ['userImgPath'	=>	$post->induser->profile_pic, 
														'userName'		=>	$post->induser->fname,
														'postTitle'		=>	$post->post_title,
														'expMin'		=>	$post->min_exp,
														'expMax'		=>	$post->max_exp,
														'city'			=>	$city,
														'company'		=>	$post->post_compname,
														'magicMatch'	=>	$post->magic_match,
														'userType'		=>	'ind',
														'userId'		=>	$post->individual_id,
														'postId'		=>	$post->unique_id,
														'postType'		=>	$post->post_type,
														'skill'			=>	$post->linked_skill,
														'jobType'		=>	$post->time_for])
					@elseif($post->corpuser != null)
						@include('partials.home.post-expired', ['userImgPath'	=>	$post->corpuser->logo_status, 
														'userName'		=>	$post->corpuser->firm_name,
														'postTitle'		=>	$post->post_title,
														'expMin'		=>	$post->min_exp,
														'expMax'		=>	$post->max_exp,
														'city'			=>	$city,
														'company'		=>	$post->post_compname,
														'magicMatch'	=>	$post->magic_match,
														'userType'		=>	'ind',
														'userId'		=>	$post->individual_id,
														'postId'		=>	$post->unique_id,
														'postType'		=>	$post->post_type,
														'skill'			=>	$post->linked_skill,
														'jobType'		=>	$post->time_for ])
					@endif
				@endif @endif
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
