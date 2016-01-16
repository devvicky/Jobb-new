@if($user->corpsearchprofile->where('user_id', Auth::user()->id)->isEmpty())
<form action="/profile/fav" method="post" id="profile-fav-{{$user->id}}" data-id="{{$user->id}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="profile_id" value="{{ $user->id }}">
	<!-- <div class="view-profile"> -->
		<button id="profilefav-btn-{{$user->id}}" class="btn green corp-profile-contact profile-fav-btn" type="button" style="">
			<i class="glyphicon glyphicon-earphone" style="font-size:11px;"></i> Contact
		</button>
	<!-- </div> -->
</form>
@elseif($user->corpsearchprofile->where('user_id', Auth::user()->id)->first()->save_contact == 1)
<form action="/profile/fav" method="post" id="profile-fav-{{$user->id}}" data-id="{{$user->id}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="profile_id" value="{{ $user->id }}">
	<!-- <div class="view-profile"> -->
		<button id="profilefav-btn-{{$user->id}}" class="btn green corp-profile-contact profile-fav-btn" type="button" style="">
			<i class="glyphicon glyphicon-earphone" style="font-size:11px;"></i> Contact
		</button>
	<!-- </div> -->
</form>
@else
<form action="/profile/fav" method="post" id="profile-fav-{{$user->id}}" data-id="{{$user->id}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="profile_id" value="{{ $user->id }}">
	<!-- <div class="view-profile"> -->
		<button id="profilefav-btn-{{$user->id}}" class="btn green corp-profile-contact profile-fav-btn" type="button" style="">
			<i class="glyphicon glyphicon-earphone" style="font-size:11px;"></i> Contact
		</button>
	<!-- </div> -->
</form>
@endif