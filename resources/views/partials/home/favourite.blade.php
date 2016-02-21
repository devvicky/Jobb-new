<div class="fav-dir">
	@if(Auth::user()->induser_id != $post->individual_id )
	<form action="/job/fav" method="post" id="post-fav-{{$post->id}}" data-id="{{$post->id}}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="fav_post" value="{{ $post->id }}">

		<button class="btn fav-btn " type="button" 
				style="background-color: transparent;padding:0 10px;border:0">
			@if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
			<i class="fa fa-star" id="fav-btn-{{$post->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
			@elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->fav_post == 1) 
			<i class="fa fa-star" id="fav-btn-{{$post->id}}" style="font-size: 20px;color:#FFC823;"></i>
			@else
			<i class="fa fa-star" id="fav-btn-{{$post->id}}" style="font-size: 20px;color:rgb(183, 182, 182);"></i>
			@endif	
		</button>	
	</form>
	@endif
	
</div>