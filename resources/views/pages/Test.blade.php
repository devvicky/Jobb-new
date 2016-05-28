@extends('master')

@section('content')
                        
<div class="row" style="margin:5px;">
  <div class="col-md-9">
    <label class="post-job-heading">
      Are you looking for Job ?<br>
      Promote Skill for FREE !!
    </label>  
    <div class="portlet box" id="form_wizard_1">      
      <div class="portlet-body form">
        <form action="/skill/store" method="post" id="submit_form" 
            data-toggle="validator" role="form" class="form-horizontal">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-wizard">
            <div class="form-body">
              <ul class="nav nav-pills nav-justified steps">
                <li>
                  <a href="#tab1" data-toggle="tab" class="step">
                  <!-- <span class="number">
                  1 </span> -->
                  <span class="desc">
                  <i class="fa fa-check"></i>Skill Detail </span>
                  </a>
                </li>
                <li>
                  <a href="#tab2" data-toggle="tab" class="step active">
                  <!-- <span class="number">
                  3 </span> -->
                  <span class="desc">
                  <i class="fa fa-check"></i>Contact Detail</span>
                  </a>
                </li>
                <li>
                  <a href="#tab4" data-toggle="tab" class="step">
                  <!-- <span class="number">
                  4 </span> -->
                  <span class="desc">
                  <i class="fa fa-check"></i>Confirm </span>
                  </a>
                </li>
              </ul>
              <div id="bar" class="progress progress-striped" role="progressbar">
                <div class="progress-bar progress-bar-success"></div>
              </div>
              <div class="tab-content">
                @if (count($errors) > 0)
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <div class="tab-pane active" id="tab1">
                  <input type="hidden" name="post_id" value"rand(11111,99999)">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-icon right">
                          <i class="fa"></i>
                          <label>Skill Title <span class="required">*</span></label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-flag" style="color:darkcyan;"></i>
                            </span>
                            <input type="text" name="post_title" class="form-control" 
                                 placeholder="Skill Title" required>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Skill Details <span class="required">*</span></label>                
                      <textarea id="textarea" rows="6" class="form-control autosizeme" name="job_detail" maxlength="1000" ></textarea>
                        <div id="textarea_feedback"></div>
                    </div>
                  </div>
                  </div>


                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label>Industry <span class="required">*</span>
                        </label>
                        <select class="select2me form-control" name="industry">
                          <option value="">Select</option>
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
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label>Role <span class="required">*</span>
                        </label>
                        <select class="select2me form-control" name="role">
                          <option value="">Select</option>
                          {{$n=""}}
                          @foreach($farearoleList as $farearole)
                          @if($n != $farearole->functional_area)
                            {{$n=$farearole->functional_area}}
                            <optgroup label="{{$farearole->functional_area}}">
                          @endif
                          <option value="{{$farearole->functional_area}}, {{$farearole->role}}">{{$farearole->functional_area}}-{{$farearole->role}}</option>
                          @if($n != $farearole->functional_area)
                              </optgroup>   
                            @endif
                          @endforeach
                        </select>
                      </div>
                      
                    </div>
                  </div>
                  <input type="hidden" name="functional_area">

                  <!-- </select> -->
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label>Job Type <span class="required">
                        * </span></label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="icon-hourglass" style="color:darkcyan;"></i>
                          </span>
                          <select name="time_for" class="form-control" style="z-index:0;">
                            <option value="">-- select --</option>
                            <option value="Full Time">Full Time</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Freelancer">Freelancer</option>
                            <option value="Work from Home">Work from Home</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label>Search Skills</label>
                        <div style="position:relative;">
                          <input type="text" name="name" id="newskill" class="form-control" placeholder="Search for skill...">
                          <button id="add-new-skill" style="position:absolute;right:0;top:0;" class="btn btn-success" type="button"><i class="icon-plus"></i> Add</button>    
                        </div>
                        {!! Form::select('linked_skill_id[]', $skills, null, ['id'=>'linked_skill_id', 'aria-hidden'=>'true', 'class'=>'form-control', 'placeholder'=>'Skills', 'multiple']) !!}
                      </div>
                    </div>
                  </div>
                  <input type="text" id="confirm-skill" name="skill" style="display:none;">
                  <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label>  Education <span class="required">
                            * </span></label> <!-- Select Multiple <input type="checkbox" id="education-check" name="multiple_education" value="1" class="form-control"> -->
                        <!-- <div class="input-group single-education" > -->
                          
                          <select class="form-control education-list" name="education[]" id="education_show" multiple style="border:1px solid #c4d5df">
                            @foreach ($education as $educ)
                              @if($educ->branch == "-")
                              <option value="{{$educ->name}}- -{{$educ->level}}" style="font-weight:600 !important;">{{$educ->name}}</option>
                              @endif
                            @endforeach
                            @foreach($education as $edu)
                              @if($n != $edu->name && $edu->name != '0' && $edu->branch != "-")
                                {{$n=$edu->name}}
                                <optgroup label="{{$edu->name}}">
                              @endif
                              @if($edu->branch != "-")
                                <option value="{{$edu->name}}-{{$edu->branch}}-{{$edu->level}}">{{$edu->name}}-{{$edu->branch}}</option>
                              @endif
                              @if($n != $edu->name && $edu->branch != "-")
                                </optgroup>   
                              @endif
                            @endforeach
                          </select>
                        <!-- </div> -->
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <div class="form-group">              
                        <label class=" control-label">Experience (Min)</label>
                        <div class="input-group">
                          <select class="form-control" name="min_exp">
                            <option>Select</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                          </select>
                          <span class="input-group-addon">
                            Years
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="form-group">
                        <select id="salary-type"  name="salary_type" class="input-sal-exp-label" style="border: 0px;width:75px">                  
                          <option selected="selected" value="Monthly">Monthly</option>
                          <option value="Weekly">Weekly</option>
                          <option value="Daily">Daily</option>
                          <option value="Hourly">Hourly</option>
                          <option value="Pervisit">Per Visit</option> 
                        </select>
                        <label class=" control-label"> Salary (Min)</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            Rs
                          </span>
                          <input class="form-control" name="min_sal" id="minsal">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="form-group">              
                        <label class=" control-label"> Salary (Max)</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            Rs
                          </span>
                          <input class="form-control" name="min_sal" id="maxsal">
                        </div>
                      </div>
                    </div>
                  </div>    
                </div>
                <div class="tab-pane" id="tab2">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label>Select Prefered Location <span class="required">
                            * </span></label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                          </span>

                          <input type="text" id="pref_loc" name="pref_loc" 
                          class="form-control" placeholder="Select preferred location">                 
                          
                        </div>  
                        {!! Form::select('prefered_location[]', [], null, ['id'=>'prefered_location', 
                                                   'aria-hidden'=>'true', 
                                                   'class'=>'form-control', 
                                                   'placeholder'=>'city', 
                                                   'multiple']) !!} 
                      </div>
                    </div>
                    
                    <input type="text" id="show_location" name="show-location" style="display:none;">
                    <div class="col-md-6 show-apply-email">
                      <div class="form-group">
                        <label>Show Contact<span class="required">
                            * </span></label>
                        <div class="input-group">
                          <div class="md-radio-inline">
                            <div class="md-radio">
                              <input type="radio" checked id="radio6" name="show_contact" value="Public" class="md-radiobtn">
                              <label for="radio6" style="">
                              <span></span>
                              <span class="check"></span>
                              <span class="box"></span>
                              Public </label>
                            </div>
                            <div class="md-radio">
                              <input type="radio" id="radio7" name="show_contact" value="Private" class="md-radiobtn">
                              <label for="radio7" style="">
                              <span></span>
                              <span class="check"></span>
                              <span class="box"></span>
                              Private</label>
                            </div>
                          </div>  
                          <div id="radio_error"></div>          <!-- /input-group -->
                        </div>
                        <div class="public" style="color: firebrick;font-size: 11px;">Your Contact details will be seen on the post and people may directly contact you.</div>
                        <div class="private display-none" style="color: firebrick;font-size: 11px;">Your Contact details will not be seen on the post. You may have to contact people who have applied on this post.</div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group new-margin-formgroup">
                        <label>Post Duration <span class="required">
                          * </span></label>
                        <div class="input-group">
                          <span class="input-group-addon">
                          <i class="icon-clock" style=" color: darkcyan;"></i>
                          </span>
                          <select name="post_duration" class="form-control" >
                            <option value="">--select--</option>          
                            <option value="90">3 Months</option>
                            <option value="180">6 Months</option>
                            <option value="270">9 Months</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label>Contact Person</label>
                        <div class="input-group">
                        <span class="input-group-addon">
                        <i class="glyphicon glyphicon-user" style="color:darkcyan;"></i>
                        </span>
                        <input type="text" name="contact_person" value="{{ Auth::user()->name }}" class="form-control" placeholder="Contact Person">
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                  <!-- <div class="show-apply"> -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label>Email Id (Registered)</label>
                        <div class="input-group">
                        <span class="input-group-addon">
                        <i class="icon-envelope" style="color:darkcyan;"></i>
                        </span>
                        <input type="text" name="email_id" value="{{ Auth::user()->email }}" class="form-control group" placeholder="">
                        
                        </div>
                      </div>
                    </div>
                    <!--/span-->
                    <!-- <div class="col-md-2 col-sm-2 col-xs-2"></div> -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label>Phone No (Registered)</label>
                        <div class="input-group">
                        <span class="input-group-addon">
                        <i class="icon-call-end" style="color:darkcyan;"></i>
                        </span>
                        <input type="text" name="phone" value="{{ Auth::user()->mobile }}"  class="form-control group" placeholder="">
                        
                        </div>
                      </div>
                    </div>
                    <!--/span-->  
                  <!-- </div> -->
                </div>
                  <div class="form-group">
                  
                  </div>
                </div>
                <div class="tab-pane" id="tab4">
                  
                  <input type="hidden" name="post_type">
                    <div class="form-body">
                      

                      <div class="row"> 
                          <div class="col-md-12"><hr style="margin:0 0 15px 0"></div>
                      </div>
                      
                      <div class="row">                                       
                        <div class="col-md-12" style="padding:0;">                        
                            <div class="timeline" style="padding:0;">
                            <!-- TIMELINE ITEM -->
                            <div class="timeline-item time-item" style="box-shadow:0 0 !important;">
                              <div class="timeline-body" style="margin: 0;">
                                <div class="timeline-body-content col-md-7" style="margin: 0px 15px 20px;">
                                  <div style="font-weight: 600;color: black;font-size: 16px;">
                                    <p class="form-control-static" data-display="post_title"></p>
                                  </div>
                                  <div>
                                    <div> 
                                      <h4 style="font-weight: 400; margin: -5px 0;"> 
                                        <p class="form-control-static" data-display="post_compname"></p> 
                                      </h4>
                                    </div>  
                                  </div>     
                                                               <div class="row">
                                                                  <div class="row">
                                                                  
                                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                                            <label class="detail-label"> Experience : </label>     
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                            <p class="form-control-static" data-display="min_exp" style="margin: -5px 0;"></p> Years  
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                                        <label class="detail-label">Education :</label>     
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                                        <p class="form-control-static" data-display="education[]" style="margin: -5px 0;"></p>
                                                                    </div>
                                                                </div>
                                                                  <div class="row"> 
                                                                      <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                                              <label class="detail-label">Skills :</label>                                                                  
                                                                      </div>
                                                                     <!--  -->
                                                                      <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                 
                                                                              <p class="form-control-static" data-display="linked_skill_id[]" style="margin: -5px 0;"></p>
                                                                      </div>
                                                                  </div>
                                                                  <div class="row"> 
                                                                      <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                                              <label class="detail-label">Industry :</label>                                                                  
                                                                      </div>
                                                                      <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                                              <p class="form-control-static" data-display="industry" style="margin: -5px 0;"></p>
                                                                      </div>
                                                                  </div>
                                                                  <div class="row"> 
                                                                      <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                                              <label class="detail-label">Job Role :</label>                                                                  
                                                                      </div>
                                                                      <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                                              <p class="form-control-static" data-display="role" style="margin: -5px 0;"></p>
                                                                      </div>
                                                                  </div>
                                                                  <div class="row"> 
                                                                      <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                                              <label class="detail-label">Job Type :</label>                                                                  
                                                                      </div>
                                                                      <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                                              <p class="form-control-static" data-display="time_for" style="margin: -5px 0;"></p>
                                                                      </div>
                                                                  </div>
                                                                   <div class="row show-salary">
                                                                      <div class="col-md-6 col-sm-6 col-xs-6">
                                                                              <label class="detail-label">Salary (<i class="fa fa-rupee (alias)"></i>):</label>
                                                                      </div>
                                                                      <div class="col-md-6 col-sm-6 col-xs-6">
                                                                              <p class="form-control-static" data-display="min_sal"></p>-<p class="form-control-static" data-display="max_sal"></p> <p class="form-control-static" data-display="salary_type"></p>
                                                                      </div>
                                                                  </div>
                                                                  <div class="row"> 
                                                                      
                                                                      <div class="col-md-6 col-sm-6 col-xs-6">                                                           
                                                                              <label class="detail-label">Prefered Location :</label>                                                                  
                                                                      </div>
                                                                      <div class="col-md-6 col-sm-6 col-xs-6">                                                                                                                                
                                                                               <p class="form-control-static" data-display="show-location" style="margin: -5px 0;"></p>
                                                                      </div>
                                                                  </div>
                                                                  
                                                                  <div class="skill-display">Description : </div>
                                                                    <p class="form-control-static" data-display="job_detail"></p>

                                                                  <!-- <div class="">Reference Id&nbsp;:<p class="form-control-static" data-display="reference_id"></p> </div>  -->

                                  
                                  <div >Post Duration: <p class="form-control-static" data-display="post_duration"></p></div>
                                  <div class="skill-display">Contact Details:<br> </div>
                                  <label class="show-apply">Apply on Company Website:<p class="form-control-static" data-display="website_redirect_url"></p></label><br>
                                  <div id="con" class="show-apply-email" style="margin: -25px 0;">
                                  <i class="icon-user" style="color:darkslategrey;font-size: 16px;"></i> : <p class="form-control-static" data-display="contact_person"></p><br>
                                      
                                    <i class="glyphicon glyphicon-envelope" style="color: #13B8D4;font-size: 16px;"></i>&nbsp;:<p class="form-control-static" data-display="email_id"></p>
                                     
                                  <br>
                                    <i class="glyphicon glyphicon-earphone" style="color: green;font-size: 16px;"></i>&nbsp;:<p class="form-control-static" data-display="phone"></p>
                                    </div> 
                                  <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}" style="float: none;margin: 15px auto;display: table;"></div> 
                                </div>    
                                
                              </div>
                              
                            </div>

                            <!-- END TIMELINE ITEM -->
                          </div>
                        </div>  
                        
                        <!-- END TIMELINE ITEM -->
                      
                      </div>
                            
                          
                          <!-- END FORM-->
                          
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="form-actions">
              <div style="margin: auto;display: table;">
                <a href="javascript:;" class="btn default button-previous">
                  <i class="m-icon-swapleft"></i> Back 
                </a>
                <a href="javascript:;" class="btn blue button-next">
                  Continue <i class="m-icon-swapright m-icon-white"></i>
                </a>
                <!-- <a href="javascript:;" class="btn green ">
                Submit <i class="m-icon-swapright m-icon-white"></i>
                </a> -->
                <button type="submit" class=" btn blue button-submit">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div id="loader" style="display:none;z-index:9999;background:white" class="page-loading">
  <img src="/assets/loader.gif"><span> Please wait...</span>
</div>

@stop


@section('javascript')
<script src="/assets/admin/pages/scripts/components-dropdowns.js"></script>
<script type="text/javascript">
$(".education-list").select2({
    placeholder: "Select education"
  });
    // preferred loc
  var prefLocationArray = [];

    // preferred loc    
    var plselect = $("#prefered_location").select2();
    plselect.val(prefLocationArray).trigger("change");

    var $eventSelect = $("#prefered_location"); 
  $eventSelect.on("select2:unselect", function (e) {
    // console.log("Removing: "+e.params.data.id);
    // remove corresponding value from array
    prefLocationArray = $.grep(prefLocationArray, function(value) {
      return value != e.params.data.id;
    });

    // remove select option for pref loc
    $("#prefered_location option[value='"+e.params.data.id+"']").remove();    
    if(prefLocationArray.length == 0){
      plselect = $("#prefered_location").select2({ dataType: 'json', data: [] });
    }else{
      plselect = $("#prefered_location").select2({ dataType: 'json', data: prefLocationArray });
    }
    plselect.val(prefLocationArray).trigger("change"); 
    // updated array
  });

    var prefLoc = $("#pref_loc");
  function initPrefLoc() {
    var options = { types: ['(regions)'], componentRestrictions: {country: "in"}};
    var input = document.getElementById('pref_loc');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', onPlaceChanged);

    function onPlaceChanged() {
      var place = autocomplete.getPlace();
      if (place.address_components) { 
        // console.log(place.address_components);

        var obj = place.address_components;       
        var locality = '';
        var city = '';
        var state = '';
        $.each( obj, function( key, value ) {
          if($.inArray("sublocality", value.types)  > -1 ){
            locality = value.long_name;
          }
          if($.inArray("locality", value.types)  > -1 ){
            city = value.long_name;
          }
          if($.inArray("administrative_area_level_1", value.types)  > -1 ){
            state = value.long_name;
          }
      });
      // console.log("Locality: "+locality+" city: "+city+" state: "+state);

      if(locality != '' && city != '' && state != '' ){
        prefLocationArray.push(locality +"-"+ city +"-"+ state);  
      }
      if(locality == '' && city != '' && state != '' ){
        prefLocationArray.push(city +"-" + state);  
      }

      var selectedLoc = document.getElementById('show_location').value;
        if(selectedLoc == '' && locality != '' && city != '' && state != ''){
          selectedLoc = locality +"-"+ city +"-"+ state;
        }else if(selectedLoc == '' && locality == '' && city != '' && state != ''){
          selectedLoc = city +"-"+ state;
        }else if(selectedLoc != '' && locality != '' && city != '' && state != ''){
          selectedLoc = selectedLoc + ', ' +locality +"-"+ city +"-"+ state;
        }else if(selectedLoc != '' && locality == '' && city != '' && state != ''){
          selectedLoc = selectedLoc + ', ' + city +"-"+ state;
        }

        document.getElementById('show_location').value = selectedLoc;

        setTimeout(function(){ prefLoc.val(''); prefLoc.focus();},0); // clear field
        
        $("#prefered_location").select2({ dataType: 'json', data: prefLocationArray });
          plselect.val(prefLocationArray).trigger("change");

      } else { 
        document.getElementById('autocomplete').placeholder = 'Your preferred location'; 
      }
    }

  }
   google.maps.event.addDomListener(window, 'load', initPrefLoc);

</script>
<script>
jQuery(document).ready(function() {       
  ComponentsIonSliders.init();  
   
  ComponentsDropdowns.init();
  ComponentsEditors.init();
    FormWizard.init();
    ComponentsjQueryUISliders.init(); 
});
</script>

<script type="text/javascript">
 $(document).ready(function() {
var text_max = 1000;
$('#textarea_feedback').html(text_max + ' characters remaining');

$('#textarea').keyup(function() {
    var text_length = $('#textarea').val().length;
    var text_remaining = text_max - text_length;

    $('#textarea_feedback').html(text_remaining + ' characters remaining');
});

});
</script>
<script>
    $(document).ready(function () {
        $('#nav li').hover(
        function () {
            //show submenu
            $('ul', this).slideDown("fast");
        }, function () {
            //hide submenu
            $('ul', this).slideUp("fast");
        });
    });
</script>
<script type="text/javascript">
function loader(arg){
    if(arg == 'show'){
        $('#loader').show();
    }else{
        $('#loader').hide();
    }
}

$(document).ready(function () {
  // toggleexpFields();
  // toggleexpmaxFields();
  $('#minexp').change(function () {
  toggleexpFields();
  });
  $('#maxexp').change(function () {
  toggleexpmaxFields();
  });
});
function toggleexpFields() {
  if($('#minexp').val() > $('#maxexp').val()){
    $("#maxexp").append("<option selected></option>");
    $('.maxexp').css({'border-color':'#962626'});
  }else{
    $('.maxexp').css({'border-color':'#c4d5df'});
  }
}

function toggleexpmaxFields() {
  if($('#maxexp').val() < $('#minexp').val()){
    $("#maxexp").append("<option selected></option>");
    $('.maxexp').css({'border-color':'#962626'});
  }else{
    $('.maxexp').css({'border-color':'#c4d5df'});
  }
}

$(document).ready(function (){

  $('#minsal').blur(function (){
    togglesalFields();
  });

  $('#maxsal').blur(function (){
    togglesalmaxFields();
  });
});

function togglesalFields() {
  if($('#minsal').val() > $('#maxsal').val()){
    $('#maxsal').css({'border-color':'#962626'});
    $("#maxsal").val('');
  }else{
    $('#maxsal').css({'border-color':'#c4d5df'});
  }
}

function togglesalmaxFields() {
  if($('#maxsal').val() < $('#minsal').val()){
    $("#maxsal").val('');
  }else{
    $('.maxsal').css({'border-color':'#c4d5df'});
  }
}


  function countChar(val) {
    var len = val.value.length;
    if (len >= 1000) {
      val.value = val.value.substring(0, 1000);
    } else {
      $('#charNum').text(1000 - len);
    }
  };
   
    $("#education").multipleSelect({
        filter: true,
        multiple: true
    });

    var job_categories = new Array();
  function addRole(val){
    job_categories.push(val);   
    // console.log(job_categories); 
  }

  function removeRole(val){
    job_categories.splice( job_categories.indexOf(val), 1 );
    // console.log(job_categories); 
  }
    
  $("#job_categories").multipleSelect({
    onClick: function(view) {
      view.checked ? addRole(view.value) : removeRole(view.value);
    },
    onClose: function() { 
      if(job_categories.length > 0){
        loader('show');
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
        $.ajax({
          url: '/jobcategory/roles',
          type: "post",
          data: {category: job_categories},
          cache : false,
          success:function(data){
            var $select = $('#job_roles');
            $select.html(' ');
            $.each(data.role, function(key, val){
              $select.append('<option id="' + val.job_role + '">' + val.job_role + '</option>');
            });
            loader('hide');
          },
          error:function(data){
            console.log(data);
            loader('hide');
          }
        });
      }else{
        var $select = $('#job_roles');
        $select.html(' ');
        $select.append('<option id="">Please select job category</option>');
      }
    } 
  });
    </script>
<script type="text/javascript">
    $(function () {
      $(".hide-sal").hide();
      $(".show-salary").hide();
      $(".hide-sal-new").hide();
      $(".one").prop('disabled',true);
      $(".two").prop('disabled',true);
        $("#hide-check").click(function () {
            if ($(this).is(":checked")) {
                $(".hide-sal").show();
                $(".show-salary").show();
                $(".hide-sal-new").show();
                $(".one").prop('disabled',false);
          $(".two").prop('disabled',false);
            } else {
                $(".hide-sal").hide();
                $(".show-salary").hide();
                $(".hide-sal-new").hide();
                $(".one").prop('disabled',true);
          $(".two").prop('disabled',true);
            }
        });
    });
        $(function () {
        $("#resume-check").click(function () {
            if ($(this).is(":checked")) {
                $(".resume-required").show();
                $(".not-required").hide();
            } else {
              $(".not-required").show();
                $(".resume-required").hide();
                
            }
        });
    });

        $(function () {
    $(".show-apply").hide();
        $("#hide-apply").click(function () {
            if ($(this).is(":checked")) {
                $(".show-apply").show();
                $(".show-apply-email").hide();
                 
            } else {
                $(".show-apply-email").show();
                $(".show-apply").hide();
            }
        });
    });
        
    $(document).ready(function () {
      $('.show-far').hide();
      jQuery('.hide-far').on('click', function(event) {
        jQuery('.show-far').show();
        jQuery('.hide-role').hide();
      });

      jQuery('.back-role').on('click', function(event) {
        jQuery('.show-far').hide();
        jQuery('.hide-role').show();
      });
  });

    $(function () {
        $("#radio7").click(function () {
            if ($(this).is(":checked")) {
                $(".private").show();
                $(".public").hide();
                 
            }
        });
        $("#radio6").click(function () {
            if ($(this).is(":checked")) {
                $(".private").hide();
                $(".public").show();
                 
            }
        });
    });

    $('#connections').select2({
    placeholder: "Enter Name"
});
    $('#groups').select2({
    placeholder: "Enter Group Name"
});
</script>
<script>
$selectedSkills = $("#linked_skill_id").select2();
$gotit = [];
  $(function(){

    function split( val ) {
        return val.split( /,\s*/ );
      }
      function extractLast( term ) {
        return split( term ).pop();
      }

    $( "#newskill" )
    .bind( "keydown", function( event ) {
      if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
        event.preventDefault();
      }
    })
    .autocomplete({
      source: function( request, response ) {
        // $.getJSON( "/job/skillSearch", {
        //  term: extractLast( request.term )
        // }, response );

        $.ajax({
          url: '/job/skillSearch',
          dataType: "json",
          data: { term: extractLast( request.term ) },
          success: function(data) {
          if (data.length === 0) {
            $('#add-new-skill').removeClass('hide');
            $('#add-new-skill').addClass('show');
          }else{
            $('#add-new-skill').removeClass('show');
            $('#add-new-skill').addClass('hide');
          }
          response(data);
          }
        });

      },
      search: function() {
        var term = extractLast( this.value );
        if ( term.length < 2 ) {
          return false;
        }
      },
      focus: function() {
        return false;
      },
      select: function(event, ui) {
        var termsId = [];

        $showSkill = split( $('#confirm-skill').val() );
        $showSkill.pop();
        $showSkill.push( ui.item.value );
        $showSkill.push( "" );
        $('#confirm-skill').val($showSkill.join( ", " ));

        if($selectedSkills.val() != null){
          termsId = $selectedSkills.val();
        }

        if(termsId.length != null){

        }
        termsId.push( ui.item.value );
        $gotit.push( ui.item.value );

        termsId.push( "" );
        $selectedSkills.val(termsId).trigger("change"); 
        $(this).val("");
        return false;
      }
    });
  });


  $(document).ready(function(){
    $('#add-new-skill').on('click',function(event){       
        event.preventDefault();
        if (!$('#newskill').val()) {
          alert('Please enter some skill to add.');
          return false;
        }else{
          var name = $('#newskill').val(); 
          $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
          $.ajax({
            url: "/job/newskill",
            type: "POST",
            data: { name: name },
            cache : false,
            success: function(data){
              if(data > 0){
                $newSkillList = new Array();

                <?php $newSkillList = array(); ?>
            @foreach($skills as $skill)
              $newSkillList.push('<?php echo $skill; ?>');
            @endforeach

                $newSkillList.push($('#newskill').val());
                // console.log($newSkillList);
                $("#linked_skill_id").select2({
                  dataType: 'json',
                  data: $newSkillList
                });

                var selectedSkillId = [];
                $newSkill = $('#newskill').val();
                $newSkillId = data;
                // $selectedSkill = $('#linked_skill').val();
                // console.log($gotit);
                if($gotit != null){
              selectedSkillId = $gotit;
            }


            $sk = $('#confirm-skill').val();
                $('#confirm-skill').val($sk+""+$newSkill+", ");
            
                selectedSkillId.push($newSkill);
                // console.log(selectedSkillId);
                // $('#linked_skill').val($selectedSkill+""+$newSkill+", ");
                $selectedSkills.val(selectedSkillId).trigger("change"); 
                $('#newskill').val("");
              }
            },
            error: function(data) {
              alert('some error occured...');
            }
          }); 
          return false;
      }
    });
    });
</script>
<script type="text/javascript">
   
  
  // user post tagging
  /*$("#connections-list").hide();
    $("#groups-list").hide();*/
   /* $("#connections").prop('required',false);
    $("#groups").prop('required',false);*/
    $("#connections").prop('disabled',true);
    $("#groups").prop('disabled',true);
    $("#tag-group-all").prop('checked', true);
    $('.add-everyone').addClass('tag-css');
    $(".hide-link").hide();
    $(".hide-group").hide();
  $("input[name$='tag-group']").click(function() {
        var selected = $(this).val();
        if(selected == 'all' && $(this).prop('checked')){
          /*$("#connections-list").hide();
          $("#groups-list").hide();
          $("#connections").hide();
          $("#groups").hide();*/
          $("#connections").prop('required',false);
          $("#groups").prop('required',false);
          $("#connections").prop('disabled',true);
          $("#groups").prop('disabled',true);
          $(".hide-link").hide();
          $(".hide-group").hide();
          $('.add-everyone').addClass('tag-css');
          $('.add-link').removeClass('tag-css');
          $('.add-group').removeClass('tag-css');
          $("#tag-group-links").prop('checked', false);
          $("#tag-group-groups").prop('checked', false);
        }else if(selected == 'links' && $(this).prop('checked')){
          /*$("#connections-list").show();
          $("#groups-list").show();
          $("#connections").show();
          $("#groups").show();*/
          $("#connections").prop('required',true);
          $("#connections").prop('disabled',false);
          $('.add-link').addClass('tag-css');
          // $('.add-group').removeClass('tag-css');
          $('.add-everyone').removeClass('tag-css');
          $(".hide-link").show();
          if ($("#groups").prop('disabled') === false) {
            $("#groups").prop('disabled',false);
            $('.add-group').addClass('tag-css');
            $(".hide-group").show();
          }else{
            $("#groups").prop('disabled',true);
            
          }
          if ($("#groups").prop('required') === false) {
            $("#groups").prop('required',false);
            $(".hide-group").show();
            
          }else{
            $("#groups").prop('required',true);
            $('.add-group').addClass('tag-css');
          }
          $("#tag-group-all").prop('checked', false);
        }else if(selected == 'groups' && $(this).prop('checked')){
          /*$("#connections-list").show();
          $("#groups-list").show();
          $("#connections").show();
          $("#groups").show();*/
          $("#groups").prop('required',true);
          $("#groups").prop('disabled',false);
          $('.add-group').addClass('tag-css');
          $('.add-link').removeClass('tag-css');
          $('.add-everyone').removeClass('tag-css');
          $(".hide-group").show();
          if ($("#connections").prop('disabled') === false) {           
            $("#connections").prop('disabled',false);
            $('.add-link').addClass('tag-css');
            $(".hide-link").show();
          }else{
            $("#connections").prop('disabled',true);
            
          }
          if ($("#connections").prop('required') === false) {           
            $("#connections").prop('required',false);
            
          }else{
            $("#connections").prop('required',true);
            $('.add-link').addClass('tag-css');
            $(".hide-link").show();
          }
          $("#tag-group-all").prop('checked', false);
        }else if(selected == 'links' && $(this).prop('checked') === false){
          $("#connections").prop('disabled',true);
          $(".hide-link").hide();
          $('.add-link').removeClass('tag-css');
          if($("#tag-group-groups").prop('checked') === false){
            $("#tag-group-all").prop('checked', true);
            $('.add-link').removeClass('tag-css');
            $('.add-group').removeClass('tag-css');
            $(".hide-link").hide();
            $(".hide-group").hide();
          }
        }else if(selected == 'groups' && $(this).prop('checked') === false){
          $("#groups").prop('disabled',true);
          $(".hide-group").hide();
          $('.add-group').removeClass('tag-css');
          if($("#tag-group-links").prop('checked') === false){
            $("#tag-group-all").prop('checked', true);
            $('.add-link').removeClass('tag-css');
            $('.add-group').removeClass('tag-css');
            $(".hide-link").hide();
            $(".hide-group").hide();
          }
        }
    }); 
</script>

@stop








public function sendOTP(){
    $type = 'mobile-otp';
    $mobile = Input::get('mobile_no');

    $user = User::where('mobile', '=', $mobile)->pluck('id');
    $data = [];
    if($user == null){

    $otp = rand(1111,9999);

    $check_no = Security_check::where('id', '=', Auth::user()->id)
                  ->where('mobile', '=', $mobile)
                  ->where('status', '=', 'Not Verified')
                  ->first();
    if($check_no != null){
      $data['oen'] = 'OTPALREADYSEND';
      $data['msg'] = 'OTP already send. Please Check your Message box.';
      return response()->json(['success'=>true, 'data'=>$data]);
      }else{
        $s_check = new Security_check();
        $s_check->user_id = Auth::user()->id;
        $s_check->verify_for = "Mobile";
        $s_check->otp = $otp;
        $s_check->mobile = $mobile;
        $s_check->status = "Not Verified";
        $s_check->save();
        $otpEnc = md5($otp);

        // $user_new = User::where('id', '=', Auth::user()->id)->first();
        // $user_new->mobile_otp = $otpEnc;
        // $user_new->save();
        $smsMsg = "Thank you for registering Jobtip.in Your One Time Password (OTP) is ".$otp.". TnC applied. Visit www.jobtip.in";
        $data['delvStatus'] = SMS::send($mobile, $smsMsg);
        $data['oen'] = $otpEnc;
        $data['msg'] = 'Check your Mobile for OTP';
        $data['type'] = 'mobile-otp';
        return response()->json(['success'=>true,'data'=>$data]);
        // return view('pages.verify_email_mobile', compact('mobile', 'otpEnc', 'type', 'otp'));
      } 
    }else{
      $data['oen'] = null;
      $data['msg'] = 'Entered Mobile number is already in use. Please try any other number.';
      return response()->json(['success'=>true, 'data'=>$data]);
      // return 'Entered Mobile number is already in use. Please try any other number.';
    }        
    
  }

  public function verifyOTP(){
      $otp =Input::get('mobile_otp');
      if(Input::get('verify') == 'verify'){
        $check_otp = Security_check::where('id', '=', Auth::user()->id)
                     ->where('verify_for', '=', 'Mobile')
                     ->where('status', '=', 'Not Verified')
                     ->first();

        if($otp == $check_otp->otp){
        $mobile = $check_otp->mobile;
        $check_otp->status = "Verified";
        $check_otp->save();
        Induser::where('id', '=', Auth::user()->induser_id)->update(['mobile' => $mobile]);
        Induser::where('id', '=', Auth::user()->induser_id)->update(['mobile_verify' => 1]);
        User::where('induser_id', '=', Auth::user()->induser_id)->update(['mobile' => $mobile]);
        User::where('induser_id', '=', Auth::user()->induser_id)->update(['mobile_verify' => 1]);
        return 'verification-success';
        }else{
          return 'verification-failure';
        }
      }elseif(Input::get('verify') == 'resend'){
        $otp = rand(1111,9999);
        $resend_otp = Security_check::where('id', '=', Auth::user()->id)
                     ->where('verify_for', '=', 'Mobile')
                     ->where('status', '=', 'Not Verified')
                     ->first();
        if($resend_otp != null){
          $resend_otp->otp = $otp;
          $resend_otp->save();
        }            
        $data = [];
        $smsMsg = "Thank you for registering Jobtip.in Your One Time Password (OTP) is ".$otp.". TnC applied. Visit www.jobtip.in";
        $data['delvStatus'] = SMS::send($mobile, $smsMsg);
        $data['msg'] = 'Check your Mobile for OTP';
        $data['types'] = 'mobile-otp';
        return response()->json(['success'=>true,'data'=>$data]);
      }
      
    
  }



  <div class="modal-footer">    
      <button type="button" class="btn btn-sm blue" value="verify" name="verify" id="verify-otp">Verify</button>
      <button type="button" class="btn btn-sm red" value="resend" name="verify">Resend OTP</button>               
    </div>



    else if(data.data.types == 'mobile-otp'){
            $('#msg-text').text('Check your Mobile for OTP');
            $('#msg-box').removeClass('alert alert-danger');
              $('#msg-box').addClass('alert alert-success').fadeIn(1000, function(){
                  $('#msg-box').show();
              });
              
          }






<!-- BEGIN INBOX DROPDOWN -->
          <li class="dropdown dropdown-extended dropdown-dark dropdown-inbox" id="header_inbox_bar">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <span class="circle">{{$thanksCount}}</span>
            <span class="corner"></span>
            </a>
            <ul class="dropdown-menu dropmenu-notification">
                    <li class="external" style="background-color: #1F1F1F;margin: -4px 0;">
                      @if($thanksCount > 0)
                      <h3 style="color: #D7D7FF;font-weight: 500;">{{$thanksCount}} New  Thanks</h3>
                      @else
                      <h3 style="color: #D7D7FF;font-weight: 500;"> No Thanks</h3>
                      @endif
                      @if($thanksCount > 0)
                      <a class="@if($title == 'notify_view'){{'active'}}@endif" 
                          href="/notify/thanks/@if(Auth::user()->identifier==1){{'ind'}}@elseif(Auth::user()->identifier==2){{'corp'}}@endif/{{Auth::user()->induser_id}}{{Auth::user()->corpuser_id}}" data-utype="thank" style="color: #D7D7FF;">view all</a>
                      @endif
                    </li>
                    <li>
                      <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283" id="notification-list">
                        @foreach($thanks as $not)
                          <li>
                            <a href="">
                            <span class="photo">
                            @if($not->fromuser != null)
                              @if($not->fromuser->first()->induser != null)
                                
                                <img src="@if($not->fromuser->first()->induser->profile_pic != null){{ '/img/profile/'.$not->fromuser->first()->induser->profile_pic }}@else{{'/assets/images/ab.png'}}@endif" class="img-circle" width="40" height="40">                        
                                
                              @elseif($not->fromuser->first()->corpuser != null)
                                
                                <img src="@if($not->fromuser->first()->corpuser->logo_status != null){{ '/img/profile/'.$not->fromuser->first()->corpuser->logo_status }}@else{{'/assets/images/ab.png'}}@endif" class="img-circle" width="40" height="40">
                               
                              @endif
                            @else
                              <img src="/assets/images/ab.png" class="img-circle" width="40" height="40">                 
                            @endif
                            </span>
                            <span class="subject">
                            <span class="from" style="color: #61B7FF;">
                            {{$not->user->name}}</span>
                            <span class="time" style="color:aliceblue;">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($not->thanks_dtTime))->diffForHumans() }} </span>
                            </span>
                            <span class="message" style="color:whitesmoke;">
                            has thanked your post : {{$not->unique_id}} </span>
                            </a>
                          </li>
                       @endforeach
                      </ul>
                    </li>
                  </ul>
          </li>
          <!-- END INBOX DROPDOWN -->



          <div class="banner-jobtip hidden-sm">
                  <div class="contain">
                    <div class="jobtip-caption">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="banner-jobtip-left">
                            <h1>Easiest way to find your dream job</h1>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                            <a href="http://demo.minimalthemes.net/jobboard/job-search/" class="btn btn-default btn-find-job">Find a Job</a>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="banner-jobtip-right">
                            <h1>Hire Skilled People, best of them</h1>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                            <a href="http://demo.minimalthemes.net/jobboard/post-a-job/" class="btn btn-default btn-post-job">Post a Job</a>
                          </div>
                        </div>
                      </div><!-- /.row -->
                    </div><!-- /.banner-caption -->
                  </div><!-- /.container -->
                </div>










                @if(Auth::user()->identifier == 1 && $utype == 'ind')
          @if(count($thanks) > 0)
          <div class="col-md-6 col-sm-6">
            <!-- BEGIN PORTLET-->
            <div class="portlet light">
              <div class="portlet-title tabbable-line">
                <div class="caption caption-md">
                  <i class="icon-globe theme-font hide"></i>
                  <span class="caption-subject font-blue-madison bold uppercase">Thanks</span>
                </div>
              </div>
              <div class="portlet-body">
                <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                  @foreach($thanks as $not)
                  <ul class="feeds">
                    <li>
                      <div class="col1">
                        <div class="cont">
                          <div class="cont-col1">
                            <div class="label label-sm label-success">
                              <i class="fa fa-check"></i>
                            </div>
                          </div>
                          <div class="cont-col2">
                            <div class="desc">
                                          <span class="from" style="color: #61B7FF;">
                                            {{$not->user->name}}
                                          </span>
                                          has thanked your post : {{$not->unique_id}}
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col2">
                        <div class="date">
                          {{ date('d M y', strtotime($not->thanks_dtTime)) }}
                        </div>
                      </div>
                    </li>
                  </ul>
                  @endforeach
                </div>
              </div>
            </div>
            <!-- END PORTLET-->
          </div>
          @endif
        @endif











        {{ date('d M y', strtotime($tp->created_at)) }} -
                        @if($tp->post_type == 'job') 
                          {{$tp->fname}} has {{$tp->mode}} a 
                          {{$tp->post_type}}  opening to you. 
                        @elseif($tp->post_type == 'skill')
                          {{$tp->fname}} has promoted a {{$tp->post_type}} to you.
                        @endif 




                        @if(count($jobPosts) > 0)
                    @foreach($jobPosts as $tp)
                    <div class="row" style="margin:0;">                       
                      <div class="updates-style" style="background-color:white;">
                        {{ date('d M y', strtotime($tp->created_at)) }} -
                        
                        <br/> <label class="tagged-title">{{$tp->post_title}} ({{$tp->min_exp}} @if($tp->max_exp != null) - {{$tp->max_exp}} @endif yrs)</label>
                        <br/><label class="tagged-company">@if($tp->post_compname != null) {{$tp->post_compname}} &nbsp;&nbsp;@endif <i class="glyphicon glyphicon-map-marker post-icon-color"></i>&nbsp; {{$tp->city}}</label>
                        <br/><label class="label-success job-type-skill-css">{{$tp->post_type}}</label>
                        @foreach($tp->linked_skill as $skill)
                          <label class="label-success skill-label">{{$skill}}</label>
                        @endforeach
                        <br/> 
                        @if($tp->post_type == 'job') 
                        <a href="/taggedjob/group/post/{{$tp->unique_id}}" target="_blank" class="taggedpost">
                          <button class="btn btn-sm btn-primary view-detail-btn center" style="border-radius: 25px !important;">View Detail</button>
                        </a>
                        @elseif($tp->post_type == 'skill')
                        <a href="/taggedskill/group/post/{{$tp->unique_id}}" target="_blank" class="taggedpost">
                          <button class="btn btn-sm btn-primary view-detail-btn center" style="border-radius: 25px !important;">View Detail</button>
                        </a>
                        @endif
                      </div>        
                    </div>  
                    @endforeach
                    @endif  








                    <div class="profile-usertitle-name" style="margin-top: 10px;">
                          {{$ua->f_name}}
                      </div>

                      <div class="profile-usertitle-job">
                          @if($ua->role != null) {{$ua->role}} <br/>@endif 
                          @if($ua->city != null) <i class="fa fa-globe"></i> {{$ua->city}} @endif
                      </div>