public function getMagicMatchAttribute(){
		if(Auth::user()->identifier == 1){
			$userSkills = Induser::where('id', '=', Auth::user()->induser_id)->first(['linked_skill']);
			$userSkills = array_map('trim', explode(',', $userSkills->linked_skill));
			unset ($userSkills[count($userSkills)-1]);

			$postSkills = $this->attributes['linked_skill'];
			$postSkills = array_map('trim', explode(',', $this->attributes['linked_skill']));
			unset ($postSkills[count($postSkills)-1]);

			$overlap = array_intersect($userSkills, $postSkills);
			$counts  = array_count_values($overlap);
			if(count($counts) > 0){
				$percentage = round( ( count($counts) / count($postSkills) ) * 100 );
			}else{
				$percentage = 0;
			}

			return $percentage;
		}else{		
        	return null;
		}
    }


    'magic_match',



Searching for job, add your skills here

do you know about any job openings post jobtip here

create a group of your friends & share job info







var Login = function() {

    var handleLogin = function() {
        jQuery.validator.addMethod("noSpace", function(value, element) { 
            return value.indexOf(" ") < 0 && value != ""; 
          }, "Space are not allowed");
        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                email: {
                    required: true,
                    minlength: 10,
                    noSpace: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                remember: {
                    required: false
                }
            },

            messages: {
                email: {
                    required: "Email or mobile no is required."
                },
                password: {
                    required: "Password is required.",
                    minlength: "Minimum 6 lenght is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.login-form')).show();
            },

             errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");  
                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");
                },

            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });
        // jQuery('.login-form-corp').hide();
        //  jQuery('#logincorporate').click(function() {
        //     jQuery('.login-form').hide();
        //     jQuery('.login-form-corp').show();
        // });
        //  jQuery('#loginindividual1').click(function() { 
           
        //     jQuery('.login-form').show();
        //      jQuery('.login-form-corp').hide();
        // });

        jQuery('#register-btn').click(function() {
            jQuery('.login-tag').hide();
            jQuery('.corporate-register-tab').show();
        });
        
        $('.login-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('.login-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }
    
    
    var handleLogincorp = function() {
        jQuery.validator.addMethod("noSpace", function(value, element) { 
            return value.indexOf(" ") < 0 && value != ""; 
          }, "Space are not allowed");
        $('.login-form-corp').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                email: {
                    required: true,
                    noSpace: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                remember: {
                    required: false
                }
            },

            messages: {
                email: {
                    required: "Email is required."
                },
                password: {
                    required: "Password is required.",
                    minlength: "Minimum 6 lenght is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.login-form-corp')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            // success: function(label) {
            //     label.closest('.form-group').removeClass('has-error');
            //     label.remove();
            // },

            // errorPlacement: function(error, element) {
            //     error.insertAfter(element.closest('.input-icon'));
            // },

            errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");  
                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                },
            success: function (label, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");
                },

            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });
        
        jQuery('#register-btn-corp').click(function() {
            jQuery('.login-tag').hide();
            jQuery('.corporate-register-tab').show();
        });
       
        $('.login-form-corp input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.login-form-corp').validate().form()) {
                    $('.login-form-corp').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
        
    }
    
    
    var handleForgetPassword = function() {
        jQuery.validator.addMethod("noSpace", function(value, element) { 
            return value.indexOf(" ") < 0 && value != ""; 
          }, "Space are not allowed");
        $('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                email: {
                    required: true,
                    email: true,
                    noSpace: true
                }
            },

            messages: {
                email: {
                    required: "Email is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");  
                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                },
            success: function (label, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");
                },

            submitHandler: function(form) {
                form.submit();
            }
        });

        $('.forget-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
                }
                return false;
            }
        });

        jQuery('#forget-password').click(function() {
            jQuery('.login-tag').hide();
            jQuery('.forget-form').show();
        });

        jQuery('#forget-password-corp').click(function() {
            jQuery('.login-tag').hide();
            jQuery('.forget-form').show();
        });

        jQuery('#back-btn').click(function() {
             jQuery('.login-tag').show();
            jQuery('.forget-form').hide();
        });

    }

    var handleRegister = function() {
        jQuery.validator.addMethod("noSpace", function(value, element) { 
            return value.indexOf(" ") < 0 && value != ""; 
          }, "Space are not allowed");
        function format(state) {
            if (!state.id) return state.text; // optgroup
            return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
        }
       
        $('.register-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                fname: {
                    required: true
                },
                email: {
                    required: true,
                    email: true,
                    noSpace: true,
                    remote: '/UserController.php' + $('#email_address').val()
                },
                mobile: {
                    required: false,
                    minlength: 10,
                    maxlength: 10
                },
                password: {
                    required: true,
                    minlength: 6
                },
                rpassword: {
                    equalTo: "#register_password"
                },
                tnc: {
                    required: true
                }
            },

            messages: { // custom messages for radio buttons and checkboxes
                fname: {
                    required: "Full name is required"
                },
                email: {
                    required: "Email Id or Mobile No is required",
                    remote: "Email Id is already Registered"
                },
                mobile: {
                    required:   "Mobile no. is required",
                    minlength:  "Minimum 10 length is required",
                    maxlength:  "Maximum 10 length is required"
                },
                password: {
                    required: "Password is required",
                    minlength: "Minimum 6 lenght is required."
                },
                rpassword: {
                    equalTo: "Please enter the same password again"
                },
                tnc: {
                    required: "Please accept TNC first"
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");  
                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                     if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
                    error.insertAfter($('#register_tnc_error'));
                    } else if (element.closest('.input-icon').size() === 1) {
                        error.insertAfter(element.closest('.input-icon'));
                    } else {
                        error.insertAfter(element);
                    }
                },
            success: function (label, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");
                },

            submitHandler: function(form) {
                form.submit();
            }
        });

        $('.register-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.register-form').validate().form()) {
                    $('.register-form').submit();
                    $('.register-form').reset();
                }
                return false;
            }
        });

        
            
        //     jQuery('#corporate1').click(function() {
        //     jQuery('.register-corporate-form').show();
        //     jQuery('.register-form').hide();
        // });
        //     jQuery('#individual2').click(function() {
        //     jQuery('.register-form').show();
        //     jQuery('.register-corporate-form').hide();
        // });
        jQuery('#register-back-btn').click(function() {
            jQuery('.login-tag').show();
            jQuery('.corporate-register-tab').hide();
        });
        
    }

    var handleCorporateRegister = function() {
        jQuery.validator.addMethod("noSpace", function(value, element) { 
            return value.indexOf(" ") < 0 && value != ""; 
          }, "Space are not allowed");
        $('.register-corporate-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                firm_name: {
                    required: true
                },
                firm_email_id: {
                    required: true,
                    email: true,
                    noSpace: true
                },
                firm_password: {
                    required: true,
                    minlength: 6
                },
                rpassword: {
                    equalTo: "#com_reg_password"
                },
                firm_type: {
                    required: true
                },
                ctnc: {
                    required: true
                },
            },

            messages: { // custom messages for radio buttons and checkboxes
                firm_name: {
                    required: "Company name is required"
                },
                firm_email_id: {
                    required: "Email is required"
                },
                firm_password: {
                    required: "Password is required",
                    minlength: "Minimum 6 lenght is required."
                },
                rpassword: {
                    required: "Please enter the same password again"
                },
                firm_type: {
                    required: "Firm type is requied"
                },
                ctnc: {
                    required: "Please accept TNC first"
                },
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                if (element.attr("name") == "ctnc") { // insert checkbox errors after the container                  
                    error.insertAfter($('#register_ctnc_error'));
                } else if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else if (element.attr("name") == "radio2") { // insert checkbox errors after the container                  
                    error.insertAfter($('#radio_error'));
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                form.submit();
            }
        });
        
        jQuery('#register-btn').click(function() {
            jQuery('.login-tag').hide();
            jQuery('.corporate-register-tab').show();
        });

        // jQuery('#individual2').click(function() {
        //     jQuery('.register-form').show();
        //     jQuery('.register-corporate-form').hide();
        // });
        //  jQuery('#register-btn-corp').click(function() {
        //     jQuery('.register-corporate-form').show();
        //     jQuery('.login-form-corp').hide();
        // });
        jQuery('#register-back-btn3').click(function() {
            jQuery('.login-tag').show();
            jQuery('#Company').show();
            jQuery('.corporate-register-tab').hide();
        });
    }


    return {
        //main function to initiate the module
        init: function() {
            handleLogin();
            handleLogincorp();
            handleForgetPassword();
            handleRegister();
            handleCorporateRegister();
        }
    };
















public function homeskillFilter(){
		if (Auth::check()) {
			$title = 'home';
			$skills = Skills::lists('name', 'id');
			$post_type = Input::get('post_type');
			if(Auth::user()->identifier == 1 && $post_type == 'skill'){
				$filter= Filter::where('id', '=', Auth::user()->id)->first();
				if($filter != null && $post_type == 'skill'){
					$filter->city = Input::get('city');
					$filter->post_type = Input::get('post_type');
					$filter->from_user = Auth::user()->id;
					$filter->posted_by = Input::get('posted_by');
					$filter->job_title = Input::get('post_title');
					$filter->city = Input::get('city');
					$filter->prof_category = Input::get('prof_category');
					$filter->experience = Input::get('experience');
					$filter->time_for = Input::get('time_for');
					$filter->unique_id = Input::get('unique_id');
					$filter->role = Input::get('role');
					$filter->save();
				}elseif($filter == null && $post_type == 'skill'){
					$filter = new Filter();
					$filter->from_user = Auth::user()->id;
					$filter->posted_by = Input::get('posted_by');
					$filter->post_type = Input::get('post_type');
					$filter->job_title = Input::get('post_title');
					$filter->city = Input::get('city');
					$filter->prof_category = Input::get('prof_category');
					$filter->experience = Input::get('experience');
					$filter->time_for = Input::get('time_for');
					$filter->unique_id = Input::get('unique_id');
					$filter->role = Input::get('role');
					$filter->save();
				}

			}elseif(Auth::user()->identifier == 2){
			$filter = Filter::where('id', '=', Auth::user()->corpuser_id)->first();	
				if($filter != null && $post_type == 'skill'){
					$filter->city = Input::get('city');
					$post_type = Input::get('post_type');
					$filter->from_user = Auth::user()->id;
					$filter->posted_by = Input::get('posted_by');
					$filter->job_title = Input::get('post_title');
					$filter->city = Input::get('city');
					$filter->prof_category = Input::get('prof_category');
					$filter->experience = Input::get('experience');
					$filter->time_for = Input::get('time_for');
					$filter->unique_id = Input::get('unique_id');
					$filter->role = Input::get('role');
					$filter->save();
				}elseif($filter == null && $post_type == 'skill'){
					$filter = new Filter();
					$filter->from_user = Auth::user()->id;
					$filter->posted_by = Input::get('posted_by');
					$filter->job_title = Input::get('post_title');
					$filter->city = Input::get('city');
					$filter->prof_category = Input::get('prof_category');
					$filter->experience = Input::get('experience');
					$filter->time_for = Input::get('time_for');
					$filter->unique_id = Input::get('unique_id');
					$filter->role = Input::get('role');
					$filter->save();
				}
			}
			$post_type = Input::get('post_type');
			$posted_by = Input::get('posted_by');
			$post_title = Input::get('post_title');
			$city = Input::get('city');
			$prof_category = Input::get('prof_category');
			$experience = Input::get('experience');
			$time_for = Input::get('time_for');
			$unique_id = Input::get('unique_id');
			$role = Input::get('role');
			if($post_type == 'job'){
			$skillPosts = Postjob::orderBy('id', 'desc')->with('indUser', 'corpUser', 'postActivity');

			if($role != null){
				$skillPosts->where('role', 'like', '%'.$role.'%');
			}
			if($unique_id != null){
				$skillPosts->where('unique_id', 'like', '%'.$unique_id.'%');
			}
			if($post_title != null){
				$skillPosts->where('post_title', 'like', '%'.$post_title.'%');
			}
			if($city != null){
				$pattern = '/\s*,\s*/';
				$replace = ',';
				$city = preg_replace($pattern, $replace, $city);
				$cityArray = explode(',', $city);
				$skillPosts->whereIn('city', $cityArray);
			}
			if($prof_category != null){
				$skillPosts->where('prof_category', 'like', '%'.$prof_category.'%');
			}
			if($experience != null){
				$skillPosts->whereRaw("$experience between min_exp and max_exp");
			}
			if($time_for != null){
				$skillPosts->where('time_for', '=', $time_for);
			}
			// if(count($post_type) > 0){
			// 	if(in_array("job", $post_type)){
			// 		$jobPosts->where('post_type', '=', $post_type[0]);
			// 	}elseif(in_array("skill", $post_type)){
			// 		$jobPosts->where('post_type', '=', $post_type[0]);
			// 	}
			// }
			if($post_type == 'skill'){
				$skillPosts->where('post_type', '=', $post_type);
			}
			// if(count($posted_by) > 0) {
			// 	if(in_array("individual", $posted_by)) {
			// 	    $jobPosts->where('individual_id', '!=', 0);
			// 	}elseif(in_array("company", $posted_by)) {
			// 	    $jobPosts->where('corporate_id', '!=', 0);
			// 	}
			// }

			$skillPosts = $skillPosts->paginate(15);
			if(Auth::user()->identifier == 1){
				$userSkills = Induser::where('id', '=', Auth::user()->induser_id)->first(['linked_skill']);
				$userSkills = array_map('trim', explode(',', $userSkills->linked_skill));
				unset ($userSkills[count($userSkills)-1]); 
			}
			$links = DB::select('select id from indusers
									where indusers.id in (
											select connections.user_id as id from connections
											where connections.connection_user_id=?
											 and connections.status=1
											union 
											select connections.connection_user_id as id from connections
											where connections.user_id=?
											 and connections.status=1
								)', [Auth::user()->induser_id, Auth::user()->induser_id]);
			$links = collect($links);
			$linksApproval = DB::select('select id from indusers
											where indusers.id in (
													select connections.user_id as id from connections
													where connections.connection_user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksApproval = collect($linksApproval);

				$linksPending = DB::select('select id from indusers
											where indusers.id in (
													select connections.connection_user_id as id from connections
													where connections.user_id=?
													 and connections.status=0
											)', [Auth::user()->induser_id]);
				$linksPending = collect($linksPending);
			$groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
						->where('groups.admin_id', '=', Auth::user()->induser_id)
						->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
						->groupBy('groups.id')
						->get(['groups.id as id'])
						->lists('id');

			if(Auth::user()->induser_id != null){
				$following = DB::select('select id from corpusers 
										 where corpusers.id in (
											select follows.corporate_id as id from follows
											where follows.individual_id=?
									)', [Auth::user()->induser_id]);
				$following = collect($following);
			}
			if(Auth::user()->corpuser_id != null){
				$following = DB::select('select id from indusers
										 where indusers.id in (
											select follows.individual_id as id from follows
											where follows.corporate_id=?
									)', [Auth::user()->corpuser_id]);
				$following = collect($following);
			}

			if(Auth::user()->identifier == 1){
				$share_links=Induser::whereRaw('indusers.id in (
												select connections.user_id as id from connections
												where connections.connection_user_id=?
												 and connections.status=1
												union 
												select connections.connection_user_id as id from connections
												where connections.user_id=?
												 and connections.status=1
									)', [Auth::user()->induser_id, Auth::user()->induser_id])
								->get(['id','fname'])
								->lists('fname','id');

				$share_groups = Group::leftjoin('groups_users', 'groups_users.group_id', '=', 'groups.id')					
							->where('groups.admin_id', '=', Auth::user()->induser_id)
							->orWhere('groups_users.user_id', '=', Auth::user()->induser_id)
							->groupBy('groups.id')
							->get(['groups.id as id', 'groups.group_name as name'])
							->lists('name', 'id');

			}
			$jobPosts = Postjob::orderBy('id', 'desc')
									 ->with('indUser', 'corpUser', 'postActivity', 'taggedUser', 'taggedGroup')
									 ->where('post_type', '=', 'job')
									 ->paginate(15);
			}
			return view('pages.home', compact('jobPosts', 'skillPosts', 'linksApproval', 'linksPending', 'title', 'links', 'groups', 'following', 'userSkills', 'skills', 'share_links', 'share_groups'));
		}else{
			return redirect('login');
		}	
	}








    <div class="modal fade" id="myactivity-posts" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div id="myactivity-posts-content" >
                                <div >
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
                                                                                    @if( $post->job_role != null)
                                                                                     <div class="row">
                                                                                        <div class="col-md-6 col-sm-6 col-xs-6"> 
                                                                                                <label class="detail-label">Job Industry :</label>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                                                                {{ $post->job_role->first()->industry }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 col-sm-6 col-xs-6"> 
                                                                                                <label class="detail-label">Job Functional Area :</label>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                                                                {{ $post->job_role->first()->functional_area }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 col-sm-6 col-xs-6"> 
                                                                                                <label class="detail-label">Job Role :</label>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                                                                {{ $post->job_role->first()->role }}
                                                                                        </div>
                                                                                    </div>
                                                                                    @endif
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
                                                                                    <?php 
                                                                                        $strNew = '+'.$post->post_duration.' day';
                                                                                        $strOld = $post->created_at;
                                                                                        $fresh = $strOld->modify($strNew);

                                                                                        $currentDate = new \DateTime();
                                                                                        $expiryDate = new \DateTime($fresh);
                                                                                        // $difference = $expiryDate->diff($currentDate);
                                                                                        // $remainingDays = $difference->format('%d');
                                                                                        if($currentDate >= $fresh){
                                                                                            $expired = 1;
                                                                                        }else{
                                                                                            $expired = 0;
                                                                                        }
                                                                                    ?>
                                                                                    <div class="skill-display">Description : </div>
                                                                                    {{ $post->job_detail }}
                                                                                    
                                                                                    @if($post->post_type == 'job')
                                                                                    <div class="skill-display">Reference Id&nbsp;: {{ $post->reference_id }} </div> 
                                                                                    @endif

                                                                                    <div style="margin:27px 0 0;">
                                                                                        <!-- if corporate_id not null -->
                                                                                    <!-- <form action="/job/apply" method="post" id="post-apply-{{$post->id}}" data-id="{{$post->id}}">   -->
                                                                                        
                                                                                            <a class="btn apply-btn blue btn-sm apply-contact-btn show-contact" target="_blank" 
                                                                                                href="/login" type="button"><i class="icon-globe"></i> Apply
                                                                                            </a>    
                                                                                    <!-- </form>  -->

                                                                                    </div>
                                                                                   @if($expired != 1 && $post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                                                                    @elseif($expired != 1 && $post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1)
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
                                                                                    @endif
                                                                                    <div class="skill-display">Post Id&nbsp;: {{ $post->unique_id }} </div>

                                                                                    @if($expired != 1)
                                                                                         <div class="skill-display">Post expires on:                                         
                                                                                         <span class="btn-success" style="padding: 2px 8px;font-size: 12px;border-radius: 20px !important;">{{$fresh->format("d M Y")}}</span>
                                                                                         </div>
                                                                                     @else
                                                                                         <div class="skill-display">Post expired on:                                         
                                                                                         <span class="btn-danger" style="padding: 2px 8px;font-size: 12px;border-radius: 20px !important;">{{$fresh->format("d M Y")}}</span>
                                                                                         </div>
                                                                                    @endif
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
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->










                <div class="modal fade" id="welcome-posts" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div id="myactivity-posts-content" >
                                <div >
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
                                                                                    @if( $post->job_role != null)
                                                                                     <div class="row">
                                                                                        <div class="col-md-6 col-sm-6 col-xs-6"> 
                                                                                                <label class="detail-label">Job Industry :</label>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                                                                {{ $post->job_role->first()->industry }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 col-sm-6 col-xs-6"> 
                                                                                                <label class="detail-label">Job Functional Area :</label>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                                                                {{ $post->job_role->first()->functional_area }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6 col-sm-6 col-xs-6"> 
                                                                                                <label class="detail-label">Job Role :</label>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                                                                {{ $post->job_role->first()->role }}
                                                                                        </div>
                                                                                    </div>
                                                                                    @endif
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
                                                                                    <?php 
                                                                                        $strNew = '+'.$post->post_duration.' day';
                                                                                        $strOld = $post->created_at;
                                                                                        $fresh = $strOld->modify($strNew);

                                                                                        $currentDate = new \DateTime();
                                                                                        $expiryDate = new \DateTime($fresh);
                                                                                        // $difference = $expiryDate->diff($currentDate);
                                                                                        // $remainingDays = $difference->format('%d');
                                                                                        if($currentDate >= $fresh){
                                                                                            $expired = 1;
                                                                                        }else{
                                                                                            $expired = 0;
                                                                                        }
                                                                                    ?>
                                                                                    <div class="skill-display">Description : </div>
                                                                                    {{ $post->job_detail }}
                                                                                    
                                                                                    @if($post->post_type == 'job')
                                                                                    <div class="skill-display">Reference Id&nbsp;: {{ $post->reference_id }} </div> 
                                                                                    @endif

                                                                                    <div style="margin:27px 0 0;">
                                                                                        <!-- if corporate_id not null -->
                                                                                    <!-- <form action="/job/apply" method="post" id="post-apply-{{$post->id}}" data-id="{{$post->id}}">   -->
                                                                                        
                                                                                            <a class="btn apply-btn blue btn-sm apply-contact-btn show-contact" target="_blank" 
                                                                                                href="/login" type="button"><i class="icon-globe"></i> Apply
                                                                                            </a>    
                                                                                    <!-- </form>  -->

                                                                                    </div>
                                                                                   @if($expired != 1 && $post->postactivity->where('user_id', Auth::user()->id)->isEmpty())
                                                                                    @elseif($expired != 1 && $post->postactivity->where('user_id', Auth::user()->id)->first()->contact_view == 1)
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
                                                                                    @endif
                                                                                    <div class="skill-display">Post Id&nbsp;: {{ $post->unique_id }} </div>

                                                                                    @if($expired != 1)
                                                                                         <div class="skill-display">Post expires on:                                         
                                                                                         <span class="btn-success" style="padding: 2px 8px;font-size: 12px;border-radius: 20px !important;">{{$fresh->format("d M Y")}}</span>
                                                                                         </div>
                                                                                     @else
                                                                                         <div class="skill-display">Post expired on:                                         
                                                                                         <span class="btn-danger" style="padding: 2px 8px;font-size: 12px;border-radius: 20px !important;">{{$fresh->format("d M Y")}}</span>
                                                                                         </div>
                                                                                    @endif
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
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->