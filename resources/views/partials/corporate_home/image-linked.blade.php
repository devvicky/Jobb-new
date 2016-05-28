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
            <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                <i class="fa fa-clock-o post-icon-color" style="font-size: 11px;"></i> 
                <small class="post-time-css" itemprop="datePublished" content="{{$post->created_at}}">
                {{ date('d M Y', strtotime($post->created_at)) }}
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
            <div class="col-md-4 col-sm-4 col-xs-12 elipsis-code">
                <i class="fa fa-clock-o post-icon-color" style="font-size: 11px;"></i> 
                <small class="post-time-css" itemprop="datePublished" content="{{$post->created_at}}">
                {{ date('d M Y', strtotime($post->created_at)) }}
                </small>
            </div>
        </div>
        @endif
		</div>														
	</div>
</div>

<div class="link-btn-css">
    <div style="margin:-5px 10px;">
       @if($post->expired == 0)

        <form action="/job/like" method="post" id="post-like-{{$post->id}}" data-id="{{$post->id}}">                        
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="like" value="{{ $post->id }}">
            
            @if($post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                <button class="btn btn-icon-only like-btn btn-circle" id="like-button-{{$post->id}}"  type="button" title="Thanks" style="background-color: transparent;border: 1px solid;">                 
                     <i class="icon-like"></i> 
                </button>

            @elseif($post->postactivity->where('user_id', Auth::user()->id)->first()->thanks == 1) 
                
                <a class="btn btn-icon-only like-btn btn-circle blue" id="like-button-{{$post->id}}">
                    <i class="icon-like"></i>
                </a>
            @else
                <button class="btn btn-icon-only like-btn btn-circle" id="like-button-{{$post->id}}"  type="button" title="Thanks" style="background-color: transparent;border: 1px solid;">                 
                     <i class="icon-like"></i> 
                </button>
            @endif
        </form>
         @if($post->postactivity->sum('thanks') > 0)
        <span class="badge badge-default badge-like-home-corp-detail" id="like-count-{{ $post->id }}">

        {{ $post->postactivity->sum('thanks') }}

        </span>
         @endif
        @endif
    </div>
    @if($post->individual_id != null && Auth::user()->induser_id != $post->individual_id && Auth::user()->identifier == 1)
        <div class="puid-{{$post->individual_id}}" style="margin:-5px 0;">
            @if($links->contains('id', $post->individual_id) )
                <!-- <button type="submit" class="link-remove-btn btn btn-xs link-follow-icon-css">
                    <i class="fa fa-link (alias) icon-size" style=""></i>
                </button> -->
                <a class="btn btn-icon-only btn-circle green ">
                    <i class="fa fa-link (alias)"></i>
                </a>
            @elseif($linksPending->contains('id', $post->individual_id) )
                <a class="btn btn-icon-only btn-circle grey-cascade">
                    <i class="icon-hourglass (alias)"></i>
                </a>
            @elseif($linksApproval->contains('id', $post->individual_id) )
                <a class="btn btn-icon-only btn-circle grey-cascade">
                    <i class="icon-hourglass (alias)"></i>
                </a>
            @else
            <form action="/connections/newLink/{{$post->individual_id}}"  id="no-ind-unknown" method="post">               
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a data-puid="{{$post->individual_id}}" class="btn btn-icon-only btn-circle blue link-btn">
                    <i class="fa fa-plus"></i>
                </a>
            </form>
            @endif
        </div>
    @elseif($post->corporate_id != null && Auth::user()->identifier == 1)
        <div class="follow-icon-right pfid-{{$post->corporate_id}}" data-pfid="{{$post->corporate_id}}" style="margin:-5px 0;">
            @if($following->contains('id', $post->corporate_id))
                <a class="btn btn-icon-only btn-circle green ">
                   <i class="fa fa-check" style=""></i>
                </a>
            @else
                <form action="/corporate/follow/{{$post->corporate_id}}" id="no-corp" method="post">              
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                    
                    <a data-linked="no" data-utype="corp" data-pfid="{{$post->corporate_id}}" class="btn btn-icon-only btn-circle grey-cascade follow-btn">
                        <i class="fa fa-plus"></i>
                    </a>
                </form>
            @endif
        </div>    
    @endif
</div>