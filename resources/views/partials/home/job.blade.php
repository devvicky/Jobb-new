
@include('partials.home.job-filter')

@if (count($jobPosts) > 0)
<?php $var = 1; ?>
<div class="portlet light bordered" 
 style="border: none !important; background:transparent; padding:0 !important; margin: -20px 0px;">										
<div class="portlet-body form" id="posts">
	<div class="form-body" id="post-items" style="padding:0;">
				
			@foreach($jobPosts as $post)
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

				@if($post->induser != null)	
					@include('partials.home.post', ['userImgPath'	=>	$post->induser->profile_pic, 
													'userName'		=>	$post->induser->fname,
													'postTitle'		=>	$post->post_title,
													'expMin'		=>	$post->min_exp,
													'expMax'		=>	$post->max_exp,
													'city'			=>	$post->city,
													'company'		=>	$post->post_compname,
													'magicMatch'	=>	$post->magic_match,
													'userType'		=>	'ind',
													'userId'		=>	$post->individual_id,
													'postId'		=>	$post->id])
				@elseif($post->corpuser != null)
					@include('partials.home.post', ['userImgPath'	=>	$post->corpuser->logo_status, 
													'userName'		=>	$post->corpuser->firm_name ])
				@endif
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
