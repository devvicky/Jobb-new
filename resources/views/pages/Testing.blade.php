<div class="row" style="margin:0;padding:0;">
    <div class="col-md-8" style="text-align: center;margin: 5px 0 -15px 0;">
        <h4 class="uppercase btn-success singlepost-title">
            <label class="">{{$post->post_type}} Detail</label> ({{$post->unique_id}})
        </h4>
    </div>
</div>
<div class="portlet light bordered" 
 style="border: none !important; background:transparent; margin: 20px 0px;">                                     
<div class="portlet-body form" id="posts">
    <div class="form-body" id="post-items" style="padding:0;">                                          
        <div class="row post-item" >
                        
                        <div class="col-md-8 home-post">

                            <div class="timeline" >
                                <!-- TIMELINE ITEM -->

                              
                                <div class="timeline-item time-item">
                               
                                    <div class="timeline-badge badge-margin">
                                    @if($post->induser != null && !empty($post->induser->profile_pic))
                                    <img class="timeline-badge-userpic userpic-box" src="/img/profile/{{ $post->induser->profile_pic }}" title="{{ $post->induser->fname }}">
                                    
                                    @elseif($post->corpuser != null && !empty($post->corpuser->logo_status))
                                    <img class="" src="/img/profile/{{ $post->corpuser->logo_status }}" title="{{ $post->corpuser->firm_name }}">
                                    
                                    @elseif(empty($post->corpuser->logo_status) && $post->corpuser != null )
                                    <img class="" src="/assets/images/corpnew.jpg">
                                    
                                    @elseif(empty($post->induser->profile_pic) && $post->induser != null)
                                    <img class="timeline-badge-userpic userpic-box" src="/assets/images/ab.png">
                                    
                                    @endif
                                    
                                </div>
                                    <div class="row post-postision" style="padding:0;">
                                        <div class="col-md-12">
                                            <div class="post-title-new capitalize">{{ $post->post_title }} </div>
                                        </div>
                                        @if($post->post_compname != null && $post->post_type == 'job')
                                        <div class="col-md-12">
                                            <div><small class="capitalize" style="font-size:13px;color:dimgrey !important;">Required at {{ $post->post_compname }}</small></div>
                                        </div>
                                            
                                        @endif
                                    </div>
                                    <div class="row post-postision" style="padding:0;"> 
                                        @if($post->min_exp != null)
                                        <div class="col-md-4 col-sm-4 col-xs-4" style="">
                                        <small style="font-size:13px;color:dimgrey !important;"> <i class="glyphicon glyphicon-briefcase post-icon-color"></i>&nbsp;: {{ $post->min_exp}}-{{ $post->max_exp}} Yr</small>
                                        </div>
                                        @endif
                                        @if($post->city != null)
                                        <div class="col-md-8 col-sm-8 col-xs-8 elipsis-code-city" style="padding:0 12px;">
                                        <small style="font-size:13px;color:dimgrey !important;"> <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp;: {{ $post->city }}</small>
                                        </div>
                                        @endif 
                                    </div>

                                    <div class="row" style="margin: 5px 0px; border-top: 1px solid whitesmoke;padding:0;">
                                        <div class="col-md-12" style="margin: 3px -13px;">
                                           
                                            <div class="row" style="padding:0;">  
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    
                                                    <div class="match" style="float: left; margin: 0px 3px;">      
                                                        <a data-toggle="modal" data-mpostid="{{$post->id}}" class="magic-font magicmatch-posts" href="#magicmatch-posts" style="color: white;line-height: 1.7;text-decoration: none;"> 
                                                            <button class="btn btn-success magic-match-css"><i class="icon-speedometer magic-font" style="font-size:12px;"></i> 
                                                               
                                                            </button>
                                                            
                                                        </a>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-3" style="padding:0 8px;">                 
                                                <button class="btn like-btn"  type="button" style="background-color: transparent;padding:3px;" title="Thanks">
                                                    <i class="fa fa-thumbs-up thanks-icon" id="like-{{$post->id}}"></i>        
                                                </button>
                                                </div>
                                                
                                                <div  class="col-md-3 col-sm-3 col-xs-3" style="">
                                                    <div class="dropup ">                                           
                                                        <button class="btn dropdown-toggle" type="button" 
                                                                data-toggle="dropdown" title="Share" 
                                                                style="background-color: transparent;border: 0;margin: 0px;">
                                                            <i class="fa fa-share-square-o" 
                                                                style="font-size: 19px;color: darkslateblue;"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-share-home" role="menu" 
                                                            style="min-width:0;box-shadow:0 0 !important;padding: 0;">
                                                            <li style="border-bottom: 1px solid #ddd;">
                                                                <a class="jobtip sojt" >
                                                                    Share on Jobtip
                                                                </a>
                                                            </li>
                                                            <li style="border-bottom: 1px solid #ddd;">
                                                                <a class="jobtip sbmail">
                                                                    Share by email
                                                                </a>
                                                            </li>
                                                        </ul>                                                   
                                                    </div>
                                                    <div class="report-css">
                                             
                                                    <a href="/login">
                                                        <button class="report-button-css">
                                                            <i class="fa  fa-ellipsis-v" style="color:black;"></i>
                                                        </button>
                                                    </a>   
                                                    </div>
                                                </div>    
                                            </div>
                                            <div class="row" style="padding:0;">
                                                
                                                <div class="col-md-3 col-sm-3 col-xs-6" style="font-size:12px;text-align:center">
                                                <!-- <div class="expired-css">                                                   -->
                                                    <i class="glyphicon glyphicon-ban-circle" style="font-size:12px;color:dimgrey;"></i> Post Expired
                                                <!-- </div> -->
                                                </div> 
                                            </div>                                          
                                        </div>
                                    </div>

                                </div>
                                <div class="row" style="margin:0;padding:0;">
                                    <h4 class="skill-display">Details:</h4>
                                    <div class="col-md-12">
                                        <div class="row" style="padding:0;">
                                            
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <label class="detail-label">Education :</label>     
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                @if($post->education == 'twelth')
                                                    12th
                                                @else
                                                {{$post->education}} 
                                                @endif    
                                            </div>
                                        </div>
                                        
                                        <div class="row" style="padding:0;"> 
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                    <label class="detail-label">Skills :</label>                                                                  
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                    {{$post->linked_skill}}
                                                 
                                            </div>
                                        </div>
                                        <div class="row" style="padding:0;"> 
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                    <label class="detail-label">Job Type :</label>                                                                  
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                    {{ $post->time_for }}
                                            </div>
                                        </div>
                                        <div class="row" style="padding:0;"> 
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
                                        
                                         <div class="row" style="padding:0;">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <label class="detail-label">Salary (<i class="fa fa-rupee (alias)"></i>):</label>
                                            </div>
                                            @if($post->min_sal != null)
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                    {{ $post->min_sal }}-{{ $post->max_sal }}/{{ $post->salary_type }}
                                            </div>
                                            @else
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                    Not disclose
                                            </div>
                                            @endif
                                        </div>
                                        <div class="skill-display">Description : </div>
                                        {{ $post->job_detail }}
                                        
                                        @if($post->post_type == 'job' && $post->reference_id != null)
                                        <div class="skill-display">Reference Id&nbsp;: {{ $post->reference_id }} </div> 
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- END TIMELINE ITEM -->
                        </div>                                  
                </div>                           
            </div>
        </div>
    </div>









<li>
                <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283" id="notification-list">
                  @foreach($thanks as $not)
                  <li>
                  <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                    <li>
                      <a href="inbox.html?a=view">
                      <span class="photo">
                      @if($not->fromuser != null)
                        @if($not->fromuser->first()->induser != null)
                          
                          <img src="@if($not->fromuser->first()->induser->profile_pic != null){{ '/img/profile/'.$not->fromuser->first()->induser->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" class="img-circle" width="40" height="40">                        
                          
                        @elseif($not->fromuser->first()->corpuser != null)
                          
                          <img src="@if($not->fromuser->first()->corpuser->logo_status != null){{ '/img/profile/'.$not->fromuser->first()->corpuser->logo_status }}@else{{'/assets/images/ab.png'}}@endif" class="img-circle" width="40" height="40">
                          {{-- <div class=""><i class="icon-speedometer"></i> 55%</div> --}}
                         
                        @endif
                      @else
                        <img src="/assets/images/ab.png" class="img-circle" width="40" height="40">                 
                      @endif
                      </span>
                      <span class="subject">
                      <span class="from">
                      {{$not->user->name}}</span>
                      <span class="time">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($not->thanks_dtTime))->diffForHumans() }} </span>
                      </span>
                      <span class="message">
                      has thanked your post : {{$not->unique_id}} </span>
                      </a>
                    </li>
                    
                  </ul>
                </li>
                 @endforeach
                </ul>
              </li>











              <select class="select2me form-control" name="industry">
                                        <option value="Automotive/ Ancillaries">Automotive/ Ancillaries</option>
                                        <option value="Banking/ Financial Services">Banking/ Financial Services</option>
                                        <option value="Bio Technology & Life Sciences">Bio Technology & Life Sciences</option>
                                        <option value="Chemicals/Petrochemicals">Chemicals/Petrochemicals</option>
                                        <option value="Construction">Construction</option>
                                        <option value="FMCG">FMCG</option>
                                        <option value="Education">Education</option>
                                        <option value="Entertainment/ Media/ Publishing">Entertainment/ Media/ Publishing</option>
                                        <option value="Insurance">Insurance</option>
                                        <option value="ITES/BPO">ITES/BPO</option>
                                        <option value="IT/ Computers - Hardware">IT/ Computers - Hardware</option>
                                        <option value="IT/ Computers - Software">IT/ Computers - Software</option>
                                        <option value="KPO/Analytics">KPO/Analytics</option>
                                        <option value="Machinery/ Equipment Mfg.">Machinery/ Equipment Mfg.</option>
                                        <option value="Oil/ Gas/ Petroleum">Oil/ Gas/ Petroleum</option>
                                        <option value="Pharmaceuticals">Pharmaceuticals</option>
                                        <option value="Power/Energy">Power/Energy</option>
                                        <option value="Real Estate">Real Estate</option>
                                        <option value="Retailing">Retailing</option>
                                        <option value="Telecom">Telecom</option>
                                        <option value="Advertising/PR/Events">Advertising/PR/Events</option>
                                        <option value="Agriculture/ Dairy Based">Agriculture/ Dairy Based</option>
                                        <option value="Aviation/Aerospace">Aviation/Aerospace</option>
                                        <option value="Beauty/Fitness/PersonalCare/SPA">Beauty/Fitness/PersonalCare/SPA</option>
                                        <option value="Beverages/ Liquor">Beverages/ Liquor</option>
                                        <option value="Cement">Cement</option>
                                        <option value="Ceramics & Sanitary Ware">Ceramics & Sanitary Ware</option>
                                        <option value="Consultancy">Consultancy</option>
                                        <option value="Courier/ Freight/ Transportation">Courier/ Freight/ Transportation</option>
                                        <option value="Law Enforcement/Security Services">Law Enforcement/Security Services</option>
                                        <option value="E-Learning">E-Learning</option>
                                        <option value="Shipping/ Marine Services">Shipping/ Marine Services</option>
                                        <option value="Engineering, Procurement, Construction">Engineering, Procurement, Construction</option>
                                        <option value="Environmental Service">Environmental Service</option>
                                        <option value="Facility management">Facility management</option>
                                        <option value="Fertilizer/ Pesticides">Fertilizer/ Pesticides</option>
                                        <option value="Food & Packaged Food">Food & Packaged Food</option>
                                        <option value="Textiles / Yarn / Fabrics / Garments">Textiles / Yarn / Fabrics / Garments</option>
                                        <option value="Gems & Jewellery">Gems & Jewellery</option>
                                        <option value="Government/ PSU/ Defence">Government/ PSU/ Defence</option>
                                        <option value="Consumer Electronics/Appliances">Consumer Electronics/Appliances</option>
                                        <option value="Hospitals/ Health Care">Hospitals/ Health Care</option>
                                        <option value="Hotels/ Restaurant">Hotels/ Restaurant</option>
                                        <option value="Import / Export">Import / Export</option>
                                        <option value="Market Research">Market Research</option>
                                        <option value="Medical Transcription">Medical Transcription</option>
                                        <option value="Mining">Mining</option>
                                        <option value="NGO">NGO</option>
                                        <option value="Paper">Paper</option>
                                        <option value="Printing / Packaging">Printing / Packaging</option>
                                        <option value="Public Relations (PR)">Public Relations (PR)</option>
                                        <option value="Travel / Tourism">Travel / Tourism</option>
                                        <option value="Other">Other</option>
                                    </select>









                                    <option @if($user->induser->industry=="Automotive/ Ancillaries") {{ $selected }} @endif value="Automotive/ Ancillaries">Automotive/ Ancillaries</option>
                                        <option @if($user->induser->industry=="Banking/ Financial Services") {{ $selected }} @endif value="Banking/ Financial Services">Banking/ Financial Services</option>
                                        <option @if($user->induser->industry=="Bio Technology & Life Sciences") {{ $selected }} @endif value="Bio Technology & Life Sciences">Bio Technology & Life Sciences</option>
                                        <option @if($user->induser->industry=="Chemicals/Petrochemicals") {{ $selected }} @endif value="Chemicals/Petrochemicals">Chemicals/Petrochemicals</option>
                                        <option @if($user->induser->industry=="Construction") {{ $selected }} @endif value="Construction">Construction</option>
                                        <option @if($user->induser->industry=="FMCG") {{ $selected }} @endif value="FMCG">FMCG</option>
                                        <option @if($user->induser->industry=="Education") {{ $selected }} @endif value="Education">Education</option>
                                        <option @if($user->induser->industry=="Entertainment/ Media/ Publishing") {{ $selected }} @endif value="Entertainment/ Media/ Publishing">Entertainment/ Media/ Publishing</option>
                                        <option @if($user->induser->industry=="Insurance">Insurance") {{ $selected }} @endif value="Insurance">Insurance</option>
                                        <option @if($user->induser->industry=="ITES/BPO") {{ $selected }} @endif value="ITES/BPO">ITES/BPO</option>
                                        <option @if($user->induser->industry=="IT/ Computers - Hardware") {{ $selected }} @endif value="IT/ Computers - Hardware">IT/ Computers - Hardware</option>
                                        <option @if($user->induser->industry=="IT/ Computers - Software") {{ $selected }} @endif value="IT/ Computers - Software">IT/ Computers - Software</option>
                                        <option @if($user->induser->industry=="KPO/Analytic") {{ $selected }} @endif value="KPO/Analytics">KPO/Analytics</option>
                                        <option @if($user->induser->industry=="Machinery/ Equipment Mfg.") {{ $selected }} @endif value="Machinery/ Equipment Mfg.">Machinery/ Equipment Mfg.</option>
                                        <option @if($user->induser->industry=="Oil/ Gas/ Petroleum") {{ $selected }} @endif value="Oil/ Gas/ Petroleum">Oil/ Gas/ Petroleum</option>
                                        <option @if($user->induser->industry=="Pharmaceuticals") {{ $selected }} @endif value="Pharmaceuticals">Pharmaceuticals</option>
                                        <option @if($user->induser->industry=="Power/Energy") {{ $selected }} @endif value="Power/Energy">Power/Energy</option>
                                        <option @if($user->induser->industry=="Retailing") {{ $selected }} @endif value="Retailing">Retailing</option>
                                        <option @if($user->induser->industry=="Telecom") {{ $selected }} @endif value="Telecom">Telecom</option>
                                        <option @if($user->induser->industry=="Advertising/PR/Events") {{ $selected }} @endif value="Advertising/PR/Events">Advertising/PR/Events</option>
                                        <option @if($user->induser->industry=="Agriculture/ Dairy Based") {{ $selected }} @endif value="Agriculture/ Dairy Based">Agriculture/ Dairy Based</option>
                                        <option @if($user->induser->industry=="Aviation/Aerospace") {{ $selected }} @endif value="Aviation/Aerospace">Aviation/Aerospace</option>
                                        <option @if($user->induser->industry=="Beauty/Fitness/PersonalCare/SPA") {{ $selected }} @endif value="Beauty/Fitness/PersonalCare/SPA">Beauty/Fitness/PersonalCare/SPA</option>
                                        <option @if($user->induser->industry=="Beverages/ Liquor") {{ $selected }} @endif value="Beverages/ Liquor">Beverages/ Liquor</option>
                                        <option @if($user->induser->industry=="Cement") {{ $selected }} @endif value="Cement">Cement</option>
                                        <option @if($user->induser->industry=="Ceramics & Sanitary Ware") {{ $selected }} @endif value="Ceramics & Sanitary Ware">Ceramics & Sanitary Ware</option>
                                        <option @if($user->induser->industry=="Consultancy") {{ $selected }} @endif value="Consultancy">Consultancy</option>
                                        <option @if($user->induser->industry=="Courier/ Freight/ Transportation") {{ $selected }} @endif value="Courier/ Freight/ Transportation">Courier/ Freight/ Transportation</option>
                                        <option @if($user->induser->industry=="Law Enforcement/Security Services") {{ $selected }} @endif value="Law Enforcement/Security Services">Law Enforcement/Security Services</option>
                                        <option @if($user->induser->industry=="E-Learning") {{ $selected }} @endif value="E-Learning">E-Learning</option>
                                        <option @if($user->induser->industry=="Shipping/ Marine Services") {{ $selected }} @endif value="Shipping/ Marine Services">Shipping/ Marine Services</option>
                                        <option @if($user->induser->industry=="Engineering, Procurement, Construction") {{ $selected }} @endif value="Engineering, Procurement, Construction">Engineering, Procurement, Construction</option>
                                        <option @if($user->induser->industry=="Environmental Service") {{ $selected }} @endif value="Environmental Service">Environmental Service</option>
                                        <option @if($user->induser->industry=="Facility management") {{ $selected }} @endif value="Facility management">Facility management</option>
                                        <option @if($user->induser->industry=="Fertilizer/ Pesticides") {{ $selected }} @endif value="Fertilizer/ Pesticides">Fertilizer/ Pesticides</option>
                                        <option @if($user->induser->industry=="Food & Packaged Food") {{ $selected }} @endif value="Food & Packaged Food">Food & Packaged Food</option>
                                        <option @if($user->induser->industry=="Textiles / Yarn / Fabrics / Garments") {{ $selected }} @endif value="Textiles / Yarn / Fabrics / Garments">Textiles / Yarn / Fabrics / Garments</option>
                                        <option @if($user->induser->industry=="Gems & Jewellery") {{ $selected }} @endif value="Gems & Jewellery">Gems & Jewellery</option>
                                        <option @if($user->induser->industry=="Government/ PSU/ Defence") {{ $selected }} @endif value="Government/ PSU/ Defence">Government/ PSU/ Defence</option>
                                        <option @if($user->induser->industry=="Consumer Electronics/Appliances") {{ $selected }} @endif value="Consumer Electronics/Appliances">Consumer Electronics/Appliances</option>
                                        <option @if($user->induser->industry=="Hospitals/ Health Care") {{ $selected }} @endif value="Hospitals/ Health Care">Hospitals/ Health Care</option>
                                        <option @if($user->induser->industry=="Hotels/ Restaurant") {{ $selected }} @endif value="Hotels/ Restaurant">Hotels/ Restaurant</option>
                                        <option @if($user->induser->industry=="Import / Export") {{ $selected }} @endif value="Import / Export">Import / Export</option>
                                        <option @if($user->induser->industry=="Market Research") {{ $selected }} @endif value="Market Research">Market Research</option>
                                        <option @if($user->induser->industry=="Medical Transcription") {{ $selected }} @endif value="Medical Transcription">Medical Transcription</option>
                                        <option @if($user->induser->industry=="Mining") {{ $selected }} @endif value="Mining">Mining</option>
                                        <option @if($user->induser->industry=="NGO") {{ $selected }} @endif value="NGO">NGO</option>
                                        <option @if($user->induser->industry=="Paper") {{ $selected }} @endif value="Paper">Paper</option>
                                        <option @if($user->induser->industry=="Printing / Packaging") {{ $selected }} @endif value="Printing / Packaging">Printing / Packaging</option>
                                        <option @if($user->induser->industry=="Public Relations (PR)") {{ $selected }} @endif value="Public Relations (PR)">Public Relations (PR)</option>
                                        <option @if($user->induser->industry=="Travel / Tourism") {{ $selected }} @endif value="Travel / Tourism">Travel / Tourism</option>
                                        <option @if($user->induser->industry=="Other") {{ $selected }} @endif value="Other">Other</option>