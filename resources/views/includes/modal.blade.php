 <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="profile-pic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      @if(Auth::user()->induser_id !=null)
      {!! Form::open(array('url' => 'user/imgUpload', 'files'=> true, 'id'=> 'profile-img-upload-form', 'onsubmit'=>'return checkForm()')) !!}
      @elseif(Auth::user()->corpuser_id !=null)
      {!! Form::open(array('url' => 'corporate/imgUpload', 'files'=> true)) !!}
      @endif
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add profile image</h4>
      </div>
      <div class="modal-body"> 
      <i class="fa fa-camera">      
        {!! Form::file('profile_pic', ['class'=>'profile-image', 'id'=>'image_file', 'onchange'=>'fileSelectHandler()']) !!}
        </i>
        <div class="error"></div>
        <div id="img-area" style="margin: 5px 0;">
          <img id="preview" style="width:auto" />
        </div>
      </div>
      <div class="modal-footer">        
        {{-- {!! Form::submit('upload',['class'=>'btn btn-info']) !!} --}}
        {{-- <button type="button" class="btn btn-info upload-img">Upload</button> --}}

        {{-- <button type="button" class="btn btn-warning cropnsave-img" >Crop & Save</button> --}}

        {{-- <form action="/user/imgUpload" target="_blank" method="post"> --}}
          <input type="hidden" id="crop_x" name="x"/>
          <input type="hidden" id="crop_y" name="y"/>
          <input type="hidden" id="crop_w" name="w"/>
          <input type="hidden" id="crop_h" name="h"/>
          {{-- <input type="hidden" id="fn" name="filename"/> --}}
          <input type="submit" value="Crop & Save" class="btn btn-large green cropnsave-img"/>
        {{-- </form> --}}

        <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
      </div>
      {!!Form::close() !!}
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Modal</h4>
      </div>
      <div class="modal-body">
      Hi ! I am a modal.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

<!-- CHANGE PASSWORD MODAL FORM-->
<div class="modal fade" id="change-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Change password</h4>
      </div>
      <form class="form-horizontal" id="pass-change" role="form" method="POST" action="/change/password">
      <div class="modal-body">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif          
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group" style="margin-bottom:15px">
            <label class="col-md-4 control-label">Old Password</label>
            <div class="col-md-8">
              <div class="input-icon right ">
                <i class="fa"></i>
                <input type="password" class="form-control" name="old_password" required>
              </div>
            </div>
          </div>

          <div class="form-group" style="margin-bottom:15px">
            <label class="col-md-4 control-label">New Password</label>
            <div class="col-md-8">
              <div class="input-icon right ">
                <i class="fa"></i>
                <input type="password" id="new_password" class="form-control" name="password" required>
              </div>
            </div>
          </div>

          <div class="form-group" style="margin-bottom:15px">
            <label class="col-md-4 control-label">Confirm Password</label>
            <div class="col-md-8">
              <div class="input-icon right ">
                <i class="fa"></i>
                <input type="password" class="form-control" name="password_confirmation" required>
              </div> 
            </div>
          </div>
     
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-success">Change</button>
        <button type="button" class="btn btn-sm default" data-dismiss="modal">Close</button>
      </div>      
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END CHANGE PASSWORD MODAL FORM -->


<!-- Home Modal -->
<!-- SHARE MODAL FORM-->
<div class="modal fade" id="myactivity-posts" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="myactivity-posts-content" >
        <div style="text-align:center;">
          <img src="/assets/global/img/loading.gif"><span> Please wait...</span>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Link Follow Modal Form -->
<div class="modal fade bs-modal-sm" id="links-follow" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" id="links-follow">
      <div id="links-follow-content">
        <div style="text-align:center;">
          <img src="/assets/global/img/loading.gif"><span> Please wait...</span>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Magic Match MODAL FORM-->
<div class="modal fade" id="magicmatch-posts" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="magicmatch-posts-content" >
        <div style="text-align:center;">
          <img src="/assets/global/img/loading.gif"><span> Please wait...</span>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- SHARE MODAL FORM-->
<div class="modal fade" id="share-by-email" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Share post by email</h4>
      </div>
      <div id="myactivity-posts-content" >
        <form role="form" id="modal-post-share-email-form" method="POST" action="/post/sharebyemail" class="form-horizontal" >
          <div class="modal-body">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="share_post_email_id" id="modal_share_post_email_id" value="">

            <div id="post-share-email-msg-box" style="display:none">
              <div id="post-share-email-msg"></div>
            </div>
            <div id="post-share-form-email-errors" style="display:none"></div>

            <div class="row"> 
              <div class="col-md-12" id="groups-list">
                <label>Email</label>
                <input type="text" name="sharetoemail" class="form-control" id="modal_share_email_id">
              </div>             
            </div>

          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-success" id="modal-post-share-email-btn">Share</button>
            <button type="button" class="btn btn-sm default" data-dismiss="modal">Close</button>
          </div>   
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- POST JOB & SKILL MODAL FORM-->
<div class="modal fade" id="job-skill-post" tabindex="-1" role="basic" aria-hidden="true" style="background-color: black;opacity:0.9;">
  <div class="modal-dialog">
    <div class="modal-content job-skill-create">
      <div id="magicmatch-posts-content" >
        <div style="text-align:center;">
          <div class="tile-position-new">
            <div class="tileo bg-red-intense job-skill-modal" style="">
              <div class="tile-body box-welcome" style="text-align:center;">
                <a href="/job/create">
                  <img class="" src="/assets/admin/pages/media/bg/job.png" style="width:70%;">
                </a>
                <!-- <i class="fa fa-gavel"></i> -->
              </div>
              <div class="tile-object" style="    margin: 10px 0;">
                <a href="/job/create" style="text-decoration: none;">
                  <div class='con'>
                    <span id="" class="uppercase job-skill-font" style="">Post Job tip</span>
                  </div>
                </a>
              </div>
            </div>
             @if (Auth::user()->identifier == 1)
            <div class="tileo bg-red-intense job-skill-modal">
              <div class="tile-body" style="text-align:center;">
                <a href="/skill/create" >
                  <img class="" src="/assets/admin/pages/media/bg/skill.png" style="width:70%;">
                </a>
              </div>
              <div class="tile-object" style="    margin: 10px 0;">
                <a href="/skill/create" style="text-decoration: none;">
                  <div class='con'>
                    <span id="" class="uppercase job-skill-font">Promote Skills</span>
                  </div>
                </a>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- CHANGE Account delete MODAL FORM-->
<div class="modal fade" id="account-setting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">For Delete Account</h4>
      </div>
      <form class="form-horizontal" id="pass-change" role="form" method="POST" action="/accountsetting/delete#tab_1_4">
      <div class="modal-body">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif          
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group" style="margin-bottom:15px">
            <label class="col-md-4 control-label" style="font-size: 13px;padding: 7px 10px;">Enter Login Password</label>
            <div class="col-md-8">
              <div class="input-icon right ">
                <i class="fa"></i>
                <input type="password" class="form-control" name="password" required>
              </div>
            </div>
          </div>
      </div>
      <?php $rand = rand(11111,99999);?>
      <input type="hidden" name="account_id" value="{{$rand}}">
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-success">Submit</button>
        <button type="button" class="btn btn-sm default" data-dismiss="modal">Close</button>
      </div>      
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END account delete MODAL FORM -->

<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="create-group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 300px;">
      <div class="modal-content">
        <form action="/group/store" class="horizontal-form" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">New Group</h4>
           </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-users" style="color:darkcyan;"></i>
              </span>
              <input type="text" name="group_name" maxlength="20" class="form-control" placeholder="Enter Group name">
            </div>
          </div>            
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Create</button>
          <button type="button" class="btn default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
      <!-- /.modal-content -->
  </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
