 $(document).ready(function () {            
    //validation rules
    var form = $('#ind_validation');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);


    form.validate({
        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: [],
        icon: {
                required: 'fa fa-asterisk',
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
        rules: {
            education : {
                required : true
            },
            about_individual: {
                // maxlength: 1000
            },
            dob : {
                required : true
            },
            role: {
                required: true
            },
            state : {
                required : true
            },
            'linked_skill_id[]' : {
                required : true
            },
            'prefered_location[]': {
                required: true
            },
            prefered_jobtype : {
                required : true
            },
            resume: {
                required: false,
                extension: "docx|rtf|doc|pdf"
            }
        },
        messages: {
            education: {
                required: "Select Education"
            },
            about_individual: {
                // maxlength: "Maximum 1000 character only"
            },
            dob: {
                required: "Enter Date of Birth"
            },
            role: {
                required: "Select Job Role"
            },
            state: {
                required: "Select State"
            },
            'linked_skill_id[]': {
                required: "Add atleast one Skill"
            },
            'prefered_location[]' : {
                required: "Select Prefered Location"
            },
            prefered_jobtype: {
                required: "Select Job Type"
            },
            resume:{
                extension: "Upload only pdf or word files"
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
    });
});

$(document).ready(function () {            
//validation rules
    var form = $('#profile_validation');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);
    form.validate({
        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input

        rules: {
            fname : {
                required : true,
                minlength: 3
            },
            lname : {
                required : true
            },
            dob: {
                required: true
            },
            city : {
                required : true
            },
            gender: {
                required: true
            },
            "current_location[]":{
                required: true
            }
        },
        messages: {
            fname: {
                required: "Enter First Name",
                minlength: "Enter minimum 3 character"
            },
            lname: {
                required: "Enter Last Name"
            },
            dob: {
                required: "Enter Date of Birth"
            },
            city: {
                required: "Enter current City"
            },
            gender: {
                required: "Select any one"
            },
            "current_location[]":{
                required: "Select city"
            }
        },
            invalidHandler: function (event, validator) { //display error alert on form submit   
            success.hide();
            error.show();
            Metronic.scrollTo(error, -200);
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
    });
});

 
 $(document).ready(function () {            
//validation rules
    var form = $('#');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);
    form.validate({
        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        groups: {
                    namenew: "name mobile"
                },
        rules: {
            name: {
                required: true,
                require_from_group: [1, '.group']
                    },
            mobile: {
                number: true,
                maxlength: 10,
                require_from_group: [1, '.group']
            }
        },
        messages: {
            name: {
                required: 'Please enter name'
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
    });
});



$(document).ready(function () {            
//validation rules
    var form = $('#welcome-search');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);
    form.validate({
        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            role: {
                required: true
                }
        },
        messages: {
            role: {
                required: 'Enter some crediential'
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
    });
});
