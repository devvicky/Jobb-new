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
                    minlength: 10
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
                    icon.attr("data-original-title", error.text()).tooltip({'placement': 'left'});
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
            jQuery('.signup-tabopen').hide();
            jQuery('.login-tabopen').show();
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
                    icon.attr("data-original-title", error.text()).tooltip({'placement': 'left'});
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
            jQuery('.signup-tabopen').hide();
            jQuery('.login-tabopen').show();
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
                forget_email: {
                    required: true,
                    noSpace: true
                }
            },

            messages: {
                forget_email: {
                    required: "Email or Mobile no is required."
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
                    icon.attr("data-original-title", error.text()).tooltip({'placement': 'left'});
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
                fullname: {
                    required: true,
                    minlength: 5
                },
                email: {
                    email: true,
                    minlength: 8
                },
                mobile: {
                    minlength: 10,
                    maxlength: 10
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#register_password"
                },
                tnc: {
                    required: true
                }
            },
            
            messages: { // custom messages for radio buttons and checkboxes
                fullname: {
                    required: "Full name is required",
                    minlength: "Enter Minimum 5 Character"

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
                password_confirmation: {
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
                    icon.attr("data-original-title", error.text()).tooltip({'placement': 'left'});
                    if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
                        error.insertAfter($('#register_tnc_error'));
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


        jQuery('#register-back-btn').click(function() {
            jQuery('.login-tag').show();
            jQuery('.corporate-register-tab').hide();
            jQuery('.signup-tabopen').show();
            jQuery('.login-tabopen').hide();
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
                firm_password_confirmation: {
                    required: true,
                    equalTo: "#com_reg_password"
                },
                firm_type: {
                    required: true
                },
                ctnc: {
                    required: true
                }
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
                firm_password_confirmation: {
                    required: "Please enter the same password again"
                },
                firm_type: {
                    required: "Firm type is requied"
                },
                ctnc: {
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
                    icon.attr("data-original-title", error.text()).tooltip({'placement': 'left'});
                   if (element.attr("name") == "ctnc") { // insert checkbox errors after the container                  
                        error.insertAfter($('#register_ctnc_error'));
                    } else if (element.attr("name") == "firm_type") { // insert checkbox errors after the container                  
                        error.insertAfter($('#radio_error'));
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
            jQuery('.signup-tabopen').show();
            jQuery('.login-tabopen').hide();
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

}();