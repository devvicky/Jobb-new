@extends('master')

@section('content')

<div class="myactivity-head col-md-9" style="margin: 10px 0 0 0;">
	<i class="icon-trophy"></i> My Activity
</div>
<div class="portlet box blue col-md-9" style="border:0;">
	<div class="portlet-title portlet-title-mypost" style="float:left;">
		<ul class="nav nav-tabs" style="padding-left: 5px;">
			<li class="active">
				<a href="#portlet_5_1" class="label-new" data-toggle="tab">
				<i class="icon-note"></i> My Posts </a>
			</li>
			@if(Auth::user()->identifier == 1)
			<li>
				<a href="#portlet_5_2" class="label-new" data-toggle="tab">
				<i class="icon-list"></i> My Updates </a>
			</li>
			@endif
		</ul>
	</div>
	<div class="portlet-body" style="background-color:whitesmoke;padding:2px">
		<div class="tabbable-custom">
			<div class="tab-content" style="background-color:whitesmoke;">
				<div class="tab-pane active" id="portlet_5_1">
					<div class="row">
						@if(count($posts) > 0)
						@foreach($posts as $post)								
						<div class="col-md-9">	
							<a href="/mypost/single/{{$post->unique_id}}" style="text-decoration:none;">
							<div class="updates-style" style="background-color:white;" >
								
								@if(count($post->groupTagged) > 0)
	                                        @if($post->sharedGroupBy->first()->mode == 'tagged')
	                                        <div class="row">
	                                            <div class="col-md-12">
		                                            <div class="shared-by">
		                                                You have tagged to <b>{{$post->sharedToGroup->first()->group_name}}</b> group<br/>
		                                            </div>
	                                            </div>
	                                        </div>
	                                        @endif
	                                    @endif
                                     @if($post->tagged->contains('user_id', Auth::user()->induser_id) && 
                                        $post->sharedBy->first()->mode == 'tagged')
                                        
                                    <small> {{$post->sharedBy->first()->mode}} by 
                                        {{$post->sharedBy->first()->fname}} {{$post->sharedBy->first()->lname}}</small>
                                        @endif
                                        @if($post->post_type == 'job')
										<small class="label-success label-xs capitalize" style="font-size: 12px;border-radius: 3px;padding: 2px 5px; color: white;">
											{{ $post->post_type }}
										</small>
										@else
										<small class="label-info label-xs capitalize" style="font-size: 12px;border-radius: 3px;padding: 2px 5px; color: white;">
											{{ $post->post_type }}
										</small>
										@endif
										&nbsp;
								Post ID: {{$post->unique_id}} &nbsp; 
								<small style="color:dimgrey;">
									<i class="fa fa-calendar" style="font-size: 11px;color:dimgrey;"></i>  {{ date('M d, Y', strtotime($post->created_at)) }}
								</small>

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
								  	<div class="row" style="margin: 5px -15px;">
								  		<div class="col-md-12">
								  			<span class="font-grey-cascade">
													 <div class="post-title-new capitalize">{{ $post->post_title }}  </div>					 							
											</span>
								  		</div>
								  		@if($expired == 0)
								  		<div class="col-md-10 col-sm-10 col-xs-10">
								  			<small style="font-size:13px;color: dimgrey !important;">Post expires in 
									  			<button class="btn post-expire-duration-css"> 
									  				{{($post->post_duration + $post->post_extended)}} days
									  			</button>
									  		</small>
								  		</div>
								  		
								  		@elseif($expired == 1 && $post->post_duration_extend == 0 || $post->post_duration_extend != 1)
								  		
								  		<div class="col-md-10 col-sm-10 col-xs-10">
								  			<small style="color:dimgrey;font-size:13px;">
												<i class="fa fa-calendar" style="font-size: 11px;color:dimgrey;"></i> {{$dateExpire}}: Post Expired
											</small>
								  		</div>
								  		
								  		@endif
								  		<div class="col-md-2 col-sm-2 col-xs-2"><a href="/mypost/single/{{$post->unique_id}}" ><i class="fa  fa-ellipsis-v"></i></a></div>
								  	</div>
								<div class="row">
								
								
								</div>
								@if(Auth::user()->identifier == 2)
								<li  class="active inline">    
								Applied 

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
								</li>
								&nbsp;|&nbsp;
								@elseif(Auth::user()->identifier == 1)
								<li class="active inline">
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
								</li>
								&nbsp;|&nbsp;
								@endif
								<li class="inline">
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
								</li>
								&nbsp;|&nbsp;
								<li class="inline">
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
								</li>
							</div>	
							</a>			
						</div>	
						@endforeach	
						@else
						<div class="col-md-9">	
							<div class="updates-style" style="background-color:white;" >
								You have not Posted anything on Jobtip!
							</div>
						</div>
						@endif
					</div>
				</div>
				@if(Auth::user()->identifier == 1)
				<div class="tab-pane" id="portlet_5_2">
					<div class="row">
						@foreach($myActivities as $myActivity)								
						<div class="col-md-9">												
							<div class="updates-style" style="background-color:white;" data-postid="{{$myActivity->post_id}}"><i class="fa fa-calendar" style="font-size: 11px;"></i>  {{ date('M d, Y', strtotime($myActivity->time)) }}: {{$myActivity->identifier}} for {{$myActivity->post_title}}, {{$myActivity->post_compname}} 
							<br>Post ID: {{$myActivity->unique_id}}  
							<a class="myactivity-post taggedpost" data-toggle="modal" href="#myactivity-post">See the full Post </a>
							</div>				
						</div>	
						@endforeach		
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
<div class="col-md-3">
	<div class="portlet box red-sunglo">
		<div class="portlet-title">
		</div>
		<div class="portlet-body">
			<ul>
				<li>
					 Lorem ipsum dolor sit amet
				</li>
											
			</ul>
		</div>
	</div>
</div>	
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
@stop

@section('javascript')
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
@stop