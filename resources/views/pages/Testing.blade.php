
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
			</div>
			@endif									
			
			@if($expired == 0)

				@include('partials.home.active-post')

			@elseif($expired == 1)

				@include('partials.home.expired-post')			
	
			@endif

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
