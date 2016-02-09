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
        {!! Form::file('profile_pic', ['class'=>'profile-image', 'id'=>'image_file', 'onchange'=>'fileSelectHandler()']) !!}
        <div class="error"></div>
        <div id="img-area" style="margin: 5px 0;">
          <img id="preview" style="width:auto" />
        </div>
      </div>
      <div class="modal-footer">        
        {{-- {!! Form::submit('upload',['class'=>'btn btn-info']) !!} --}}
        {{-- <button type="button" class="btn btn-info upload-img">Upload</button> --}}

        {{-- <button type="button" class="btn btn-warning cropnsave-img" >Crop & Save</button> --}}

        {{-- <form action="user/imgUpload" target="_blank" method="post"> --}}
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
      <form class="form-horizontal" role="form" method="POST" action="{{ url('/change/password') }}">
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
              <input type="password" class="form-control" name="old_password" required>
            </div>
          </div>

          <div class="form-group" style="margin-bottom:15px">
            <label class="col-md-4 control-label">New Password</label>
            <div class="col-md-8">
              <input type="password" class="form-control" name="password" required>
            </div>
          </div>

          <div class="form-group" style="margin-bottom:15px">
            <label class="col-md-4 control-label">Confirm Password</label>
            <div class="col-md-8">
              <input type="password" class="form-control" name="password_confirmation" required>
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
        <form role="form" id="modal-post-share-email-form" method="POST" action="{{ url('/post/sharebyemail') }}" class="form-horizontal" >
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

<div class="modal fade" id="share-post" tabindex="-1" role="dialog" aria-labelledby="share-post" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Share post</h4>
      </div>
      <form class="form-horizontal" id="modal-post-share-form" role="form" method="POST" action="{{ url('/post/share') }}">
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

<!-- End Home Modal -->