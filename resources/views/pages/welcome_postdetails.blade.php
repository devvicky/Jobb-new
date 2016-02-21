
<div class="modal-body modal-body-new">
 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <div class="portlet light bordered" style="border: none !important;background:transparent;padding:0 !important;">                                     
        <div class="portlet-body form">
            <div class="form-body" style="padding: 1px 0;">
                <div class="row" style="margin: 6px 0px;">
                <div class="col-md-12" style="text-align: center;background: lightblue;">
                    @if($post->post_type == 'job')
                    <label style="margin:2px 0;"> Job Details </label>
                    @else($post->post_type == 'skill')
                    <label style="margin:2px 0;"> Skill Details </label>
                    @endif
                </div>
            </div>
                <div class="row"> 
                        <div class="timeline" >
                            <!-- TIMELINE ITEM -->
                            <div class="timeline-item">
                               
                                 <div class="timeline-body" style=" margin-top:-9px;margin-left:13px;">
                                    <div class="timeline-body-head">
                                        @if(  $post->individual_id != null)
                                            <div class="timeline-body-head-caption" data-puid="{{  $post->individual_id}}">
                                                
                                                    
                                                    
                                                    <a href="/profile/ind/{{  $post->individual_id}}" style="font-size: 15px;text-decoration:none;font-weight:600;">
                                                        {{   $post->induser->fname}} {{   $post->induser->lname}}
                                                    </a>
                                                
                                                   
                                                   
                                                <span class="timeline-body-time font-grey-cascade">Posted at 
                                                    {{ date('M d, Y', strtotime(  $post->created_at)) }}
                                                </span>
                                            </div>
                                        @elseif(  $post->corporate_id != null)
                                            <div class="timeline-body-head-caption" data-puid="{{  $post->corporate_id}}">
                                                
                                                                                                       
                                                    <a href="/profile/corp/{{  $post->corporate_id}}" style="font-size: 15px;text-decoration:none;font-weight:600;">
                                                        {{   $post->corpuser->firm_name}}
                                                    </a>
                                                
                                                <span class="timeline-body-time font-grey-cascade">Posted at 
                                                    {{ date('M d, Y', strtotime(  $post->created_at)) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                </div>
                                        <div class="portlet-body" style="margin: 0 -5px;">
                                            <div class="panel-group accordion" id="accordion1" style="margin-bottom: 0;">
                                                <div class="panel panel-default" style=" position: relative;border:0 !important;">
                                                    <div class="panel-heading" style="background-color: white;margin: 5px 0px;">
                                                       <!--  <h4 class="panel-title">
                                                        <a class="" 
                                                        data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_1"  style="font-size: 15px;font-weight: 600;padding:0 16px;" >
                                                        Details: </a>   
                                                        </h4> -->
                                                    </div>
                                                    <div id="collapse_1_1" class="panel-collapse">
                                                        <div class="panel-body" style="border-top: 0;padding: 4px 15px;">
                                                            
                                                            <div class="row">
                                                                 @if($post->post_type == 'job')
                                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                                        <label class="detail-label">Job Title :</label>     
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                                         {{ $post->post_title }}     
                                                                </div>
                                                                @elseif($post->post_type == 'skill')
                                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                                        <label class="detail-label">Skill Title :</label>     
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                                         {{ $post->post_title }}     
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="row">
                                                                
                                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                                        <label class="detail-label">Education :</label>     
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                                        {{ $post->education }}     
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row"> 
                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                                        <label class="detail-label">Skills :</label>                                                                  
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                                        @foreach($post->skills as $skill)
                                                                            {{$skill->name}}
                                                                        @endforeach
                                                                     
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                                        <label class="detail-label">Job Type :</label>                                                                  
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                                        {{ $post->time_for }}
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                @if($post->locality != null && $post->city !=null)
                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                                        <label class="detail-label">Locality :</label>                                                                  
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                                        {{ $post->locality }},{{ $post->city }} 
                                                                </div>
                                                                @elseif($post->locality == null && $post->city !=null)
                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                                        <label class="detail-label">Locality :</label>                                                                  
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                                        {{ $post->city }} 
                                                                </div>
                                                                @endif
                                                            </div>
                                                            
                                                             <div class="row">
                                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                                        <label class="detail-label">Salary (<i class="fa fa-rupee (alias)"></i>):</label>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                                        {{ $post->min_sal }}-{{ $post->max_sal }} {{ $post->salary_type }}
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="skill-display">Description : </div>
                                                            {{ $post->job_detail }}
                                                            
                                                            @if($post->post_type == 'job')
                                                            <div class="skill-display">Reference Id&nbsp;: {{ $post->reference_id }} </div> 
                                                            @endif

                                                            
                                                           
                                                            <div  class="skill-display ">Contact Details : </div> 
                                                            <div id="show-hide-contacts" class="row">
                                                                @if($post->post_type == 'job' && $post->website_redirect_url != null)
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    Click on Apply, it will redirect you to Company Website.
                                                                </div>
                                                                @endif
                                                                @if($post->post_type == 'job' && $post->website_redirect_url != null && $post->corpuser != null)
                                                                <div class="col-md-12 col-sm-12 col-xs-12">                                             
                                                                    <label class="detail-label"><i class="glyphicon glyphicon-globe" style="color: deepskyblue;"></i> :</label>
                                                                    {{ $post->website_url }}                                                            
                                                                </div>
                                                                @endif
                                                                @if($post->website_redirect_url == null && $post->contact_person != null)
                                                                <div class="col-md-12 col-sm-12 col-xs-12">                                             
                                                                    <label class="detail-label"><i class="glyphicon glyphicon-user"></i> :</label>
                                                                    {{ $post->contact_person }}                                                         
                                                                </div>
                                                                @endif

                                                                @if($post->email_id != null && $post->alt_emailid != null && $post->website_redirect_url == null)
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    
                                                                        <label class="detail-label"><i class="glyphicon glyphicon-envelope"></i> :</label>                                                              
                                                                        {{ $post->email_id }} - {{ $post->alt_emailid }}                            
                                                                </div>  
                                                                
                                                                @elseif($post->email_id != null && $post->alt_emailid == null && $post->website_redirect_url == null)
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    
                                                                        <label class="detail-label"><i class="glyphicon glyphicon-envelope"></i> :</label>
                                                                        {{ $post->email_id }}
                                                                    
                                                                </div>
                                                                @elseif($post->email_id == null && $post->alt_emailid != null && $post->website_redirect_url == null)
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    
                                                                        <label class="detail-label"><i class="glyphicon glyphicon-envelope"></i> :</label>
                                                                            {{ $post->alt_emailid }}
                                                                     
                                                                </div>  
                                                                @endif  
                                                                @if($post->phone != null && $post->alt_phone != null && $post->website_redirect_url == null)
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    
                                                                        <label class="detail-label"><i class="glyphicon glyphicon-earphone"></i> :</label>
                                                                    
                                                                        
                                                                        {{ $post->phone }} - {{ $post->alt_phone }}
                                                                     
                                                                </div>  
                                                                @elseif($post->phone != null && $post->alt_phone == null && $post->website_redirect_url == null)
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    
                                                                        <label class="detail-label"><i class="glyphicon glyphicon-earphone"></i> :</label>
                                                                    
                                                                        
                                                                        {{ $post->phone }}
                                                                    
                                                                </div>
                                                                @elseif($post->phone == null && $post->alt_phone != null && $post->website_redirect_url == null)
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    
                                                                        <label class="detail-label"><i class="glyphicon glyphicon-earphone"></i> :</label>
                                                                    
                                                                            {{ $post->alt_phone }}
                                                                    
                                                                </div>  
                                                                @endif                                      
                                                            </div>
                                                            
                                                            <div class="skill-display">Post Id&nbsp;: {{ $post->unique_id }} </div>
                                                                 
                                                            <div style="margin:27px 0 0;">
                                                                    <a class="btn apply-btn blue btn-sm apply-contact-btn show-contact" target="_blank" 
                                                                        href="/login" type="button"><i class="icon-globe"></i> Apply
                                                                    </a>    
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                    
                                                                   
                                                    
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>
                        
                 </div>
            </div>
        </div>  
    </div>
</div>