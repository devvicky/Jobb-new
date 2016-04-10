@if($post->expired == 1)
    <div class="timeline-body new-timeline-body">
@elseif($post->expired == 0)
    <div class="timeline-body ">
@endif
	<div class="timeline-body-head">
		<div class="timeline-body-head-caption" style="width:100%;margin:5px;">
			@if(Auth::user()->induser_id == $post->individual_id && $post->individual_id != null)
            @if(count($post->groupTagged) > 0)
            @if($post->sharedGroupBy->first()->mode == 'shared')
            <div class="row">
                <div class="col-md-12">
                    <!-- Post shared by user -->                        
                    
                    <div class="shared-by">
                        {{$post->sharedGroupBy->first()->mode}} by 
                        <b>{{$post->sharedGroupBy->first()->fname}} 
                        {{$post->sharedGroupBy->first()->lname}} to</b>
                         <b>{{$post->sharedToGroup->first()->group_name}}</b> group<br/>
                    </div>
                    
                </div>
            </div>
            @endif
        @endif
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <a href="/profile/ind/{{$post->individual_id}}" class="link-label " data-utype="ind">
                    <small>You</small>
                </a>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                <i class="fa fa-clock-o" style="font-size: 11px;"></i> 
                <small>
                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}
                </small>
            </div>
        </div>
        @elseif(Auth::user()->corpuser_id == $post->corporate_id && $post->corporate_id != null)
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <a href="/profile/ind/{{$post->individual_id}}" class="link-label" data-utype="ind">
                    <small>You</small>
                </a>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                <i class="fa fa-clock-o" style="font-size: 11px;"></i> 
                <small>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}</small>
            </div>
        </div>
        @elseif($post->individual_id != null)
            @if(count($post->groupTagged) > 0)
            @if($post->sharedGroupBy->first()->mode == 'shared')
            <div class="row">
                <div class="col-md-12">
                    <!-- Post shared by user -->                        
                    <div class="shared-by" >
                        <label style="capitalize;font-size:10px;" >
                            {{$post->sharedGroupBy->first()->mode}} by {{$post->sharedGroupBy->first()->fname}} to
                       '{{$post->sharedToGroup->first()->group_name}}' group</label> <br/>
                    </div>   
                </div>
            </div>
            @endif
        @endif
        @if($post->tagged->contains('user_id', Auth::user()->induser_id) && 
            $post->sharedBy->first()->mode == 'shared')
            
        <small>{{$post->sharedBy->first()->mode}} by {{$post->sharedBy->first()->fname}}</small>
        <br/>

        @endif
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12" itemprop="author" itemscope itemtype="http://schema.org/Person">
                <a href="/profile/ind/{{$post->individual_id}}" class="post-name-css" itemprop="name">
                    {{ $post->induser->fname}} {{ $post->induser->lname}}
                </a>
            </div>
            <div class="col-md-4 col-md-4 col-xs-12">
            	@if($post->individual_id != null && Auth::user()->induser_id != $post->individual_id && Auth::user()->identifier == 1)
					<div class="puid-{{$post->individual_id}}" style="margin:4px 0;">
						@if($links->contains('id', $post->individual_id) )
                            <button type="submit" class="link-remove-btn btn btn-xs link-follow-icon-css">
                                <i class="fa fa-link (alias) icon-size" style=""></i> Linked
                            </button>
						@elseif($linksPending->contains('id', $post->individual_id) )
							<button class="btn btn-xs linkrequest-follow-icon-css"><i class="icon-hourglass (alias) " style="color:#777;font-size:8px;"></i> Link Pending</button>
						@elseif($linksApproval->contains('id', $post->individual_id) )
							<button class="btn btn-xs linkrequest-follow-icon-css"><i class=" icon-hourglass (alias) " style="color:#777;font-size:8px;"></i> Link Pending</button>
						@else
                        <form action="/connections/newLink/{{$post->individual_id}}"  id="no-ind-unknown" method="post">               
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                            <button type="submit" data-puid="{{$post->individual_id}}" class="btn btn-xs unlink-follow-icon-css link-btn">
                                <i class="fa fa-unlink (alias) icon-size" style="color:dimgrey;"></i> Add Link
                            </button>
                        </form>
						@endif
					</div>
				@endif
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                <i class="fa fa-clock-o post-icon-color" style="font-size: 11px;"></i> 
                <small class="post-time-css" itemprop="datePublished" content="{{$post->created_at}}">
                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}
                </small>
            </div>
        </div>
        @elseif($post->corporate_id != null)
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12" itemprop="author" itemscope itemtype="http://schema.org/Person">
                <a href="/profile/corp/{{$post->corporate_id}}" class="post-name-css" itemprop="name">
                    {{ $post->corpuser->firm_name}}
                </a>
            </div>
            <div class="col-md-4 col-md-4 col-xs-12">
            	<label class="firm-type-left capitalize" style="margin: 2px 0;">{{ $post->corpuser->firm_type}}</label> 
				<span class="follow-icon-right pfid-{{$post->corporate_id}}" data-pfid="{{$post->corporate_id}}">
					@if($following->contains('id', $post->corporate_id))
                        
                        <button type="submit" class="btn btn-xs link-follow-icon-css unfollow-btn">
                            <i class="icon-check icon-size" style=""></i> Following
                        </button> 
					@else
                        <form action="/corporate/follow/{{$post->corporate_id}}" id="no-corp" method="post">              
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                            <button type="submit" data-linked="no" data-utype="corp" data-pfid="{{$post->corporate_id}}" class="btn btn-xs unlink-follow-icon-css follow-btn">
                                <i class="icon-plus icon-size" style="color:dimgrey;"></i> Follow
                            </button>
                        </form>
					@endif
				</span>    
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                <i class="fa fa-clock-o post-icon-color" style="font-size: 11px;"></i> 
                <small class="post-time-css" itemprop="datePublished" content="{{$post->created_at}}">
                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() }}
                </small>
            </div>
        </div>
        @endif
		</div>														
	</div>
</div>