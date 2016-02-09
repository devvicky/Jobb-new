<div class="col-md-12 home-post">
<div class="timeline" >
	<!-- TIMELINE ITEM -->

	<div class="timeline-item time-item-ex">
		
		@include('partials.home.image-linked')
		@include('partials.home.favourite')

		<div class="post-hover-exp" data-postid="{{$post->id}}"><a class="myactivity-posts" data-toggle="modal" href="#myactivity-posts">

		
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
				
				@if($expired == 1)
					</div>
					<div class="col-md-3 col-sm-3 col-xs-6" style="font-size:12px;text-align:center">
					<!-- <div class="expired-css">													 -->
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