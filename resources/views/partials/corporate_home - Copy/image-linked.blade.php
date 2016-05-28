@if($post->expired == 1)
    <div class="timeline-body new-timeline-body">
@elseif($post->expired == 0)
    <div class="timeline-body ">
@endif
	<div class="timeline-body-head">
		<div class="timeline-body-head-caption" style="width:100%;margin:5px;">
			
        @if($post->individual_id != null )
            @if(count($post->groupTagged) > 0 && Auth::user()->identifier == 1)
            @if($post->sharedGroupBy->first()->mode == 'shared')
            <div class="row">
                <div class="col-md-12">
                    <!-- Post shared by user -->                        
                    <div class="shared-by">
                        <small style="capitalize">
                            {{$post->sharedGroupBy->first()->mode}} by {{$post->sharedGroupBy->first()->fname}}
                        </small> to 
                        <small>'{{$post->sharedToGroup->first()->group_name}}' group</small> <br/>
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
            	<span class="firm-type-left" style="margin: 2px 0;">{{ $post->corpuser->firm_type}}</span> 
				<span class="follow-icon-right" data-puid="{{$post->corporate_id}}">
						@if($following->contains('id', $post->corporate_id))
						<a href="#links-follow" data-toggle="modal" class="user-link" data-linked="yes" data-utype="corp">
							<button class="btn btn-xs link-follow-icon-css"><i class="icon-check icon-size" style="color:white;"></i> Following</button>
						</a>
					@else
						<a href="#links-follow" data-toggle="modal" class="user-link3" data-linked="no" data-utype="corp">
							<button class="btn btn-xs unlink-follow-icon-css"><i class="icon-plus icon-size" style="color:dimgrey;"></i> Follow</button>
						</a>
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