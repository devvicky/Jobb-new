var FormWizard = function () {


    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            function format(state) {
                if (!state.id) return state.text; // optgroup
                return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }

            $("#country_list").select2({
                placeholder: "Select",
                allowClear: true,
                formatResult: format,
                formatSelection: format,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                groups: {
                    name: "email_id phone"
                },
                rules: {
                    //profile
                    post_title: {
                        minlength: 10,
                        required: true
                    },
                    job_detail: {
                        minlength: 20,
                        required: true
                    },
                    industry: {
                        required: true
                    },
                    role: {
                        required: true
                    },
                    time_for:{
                        required: true
                    },
                    'linked_skill_id[]': {
                        required: true
                    },
                    'education[]': {
                        required: true
                    },
                    min_exp: {
                        required: true
                    },
                    max_exp: {
                        required: true
                    },
                    min_sal: {
                        required: false,
                        number: true
                    },
                    max_sal: {
                        required: false,
                        number: true
                    },
                    'prefered_location[]': {
                        required: true
                    },
                    post_duration: {
                        required: true
                    },
                    website_redirect_url: {
                        required:true
                    },
                    job_agreement:{
                        required:true
                    },
                    email_id: {
                        email: true,
                        require_from_group: [1, '.group']
                    },
                    phone: {
                        number: true,
                        maxlength: 10,
                        require_from_group: [1, '.group']
                    }
                },

                messages: {
                post_title: {
                    required: "Enter Job Title"
                },

                email_id: {
                    email: "Enter correct email id",
                    require_from_group: "Enter atleast one 'Email or Phone no'"
                },
                phone: {
                    maxlength: "Enter maximum 10 integer"
                },
                job_detail: {
                    required: "Enter Job Detail"
                },
                industry: {
                    required: "Select industry"
                },
                website_redirect_url:{
                    required: "Enter website URL"
                },
                role: {
                    required: "Select Job Role"
                },
                job_agreement:{
                    required: "Select Job Agreement"
                },
                'education[]': {
                    required: "Select Required Education"
                },

                'linked_skill_id[]': {
                    required: "You must add atleast one skill"
                },
                min_exp: {
                    required: "Select Experience"
                },
                max_exp: {
                    required: "Select Experience"
                },
                min_sal: {
                    number: "Enter only digits"
                },
                max_max: {
                    number: "Enter only digits"
                },
                'prefered_location[]': {
                    required: "Please specify location"
                },
                time_for: {
                    required: "Select Job Type"
                },
                post_duration: {
                    required: "Select Post Duration"
                }
          },
                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error, -200);
                },

                    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
     success: function (label) {
                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },
                submitHandler: function (form) {
                    success.show();
                    error.hide();
                    form.submit();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });

            var displayConfirm = function() {
                $('#tab4 .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text())
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    }
                });
            }

            var displayConfirmtab3 = function() {
                $('#tab3 .form-control-static-msg', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display-msg")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display-msg")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text())
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();

                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                    displayConfirmtab3();
                }
                Metronic.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;
                    /*
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    handleTitle(tab, navigation, clickedIndex);
                    */
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_1').find('.button-previous').hide();
            $('#form_wizard_1 .button-submit').click(function () {
                
                
            }).hide();

            // //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
            // $('#submit_form', form).change(function () {
            //     form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            // });
        }

    };

}();