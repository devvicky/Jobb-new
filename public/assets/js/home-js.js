/*Begin Page level Javascript

Loader Code*/

function loader(arg) {
    if (arg == 'show') {
        $('#loader').show();
    } else {
        $('#loader').hide();
    }
}

//Reset Filter

function resetFilter() {
    document.getElementById("home-filter").reset();
}


// Myactivity-post

$(document).ready(function() {
    $('.myactivity-posts').live('click', function(event) {
        event.preventDefault();
        var post_id = $(this).parent().data('postid');

        // console.log(post_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/postdetail/detail",
            type: "post",
            data: {
                postid: post_id
            },
            cache: false,
            success: function(data) {
                $('#myactivity-posts-content').html(data);
                $('#myactivity-posts').modal('show');
            }
        });
        return false;
    });
});

// Magicmatch-post

$(document).ready(function() {
    $('.magicmatch-posts').live('click', function(event) {
        event.preventDefault();
        var post_id = $(this).data('mpostid');

        var clear = '<div style="text-align:center;"><img src="./assets/global/img/loading.gif"><span> Please wait...</span></div>';
        $("#magicmatch-posts-content").html(clear);

        // console.log(post_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/magicmatch/detail",
            type: "post",
            data: {
                postid: post_id
            },
            cache: false,
            success: function(data) {
                $('#magicmatch-posts-content').html(data);
                $('#magicmatch-posts').modal('show');
            }
        });
        return false;
    });
});


// like-button

$('.like-btn').live('click', function(event) {
    event.preventDefault();
    var post_id = $(this).parent().data('id');

    var formData = $('#post-like-' + post_id).serialize();
    var formAction = $('#post-like-' + post_id).attr('action');

    $count = $.trim($('#like-count-' + post_id).text());
    if ($count.length == 0 || $count == "") {
        $count = 0;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: formAction,
        type: "post",
        data: formData,
        cache: false,
        success: function(data) {
            if (data > $count) {
                $('#like-count-' + post_id).text(data);
                $('#like-' + post_id).css({
                    'color': '#337ab7'
                });
                $('#like-count-' + post_id).removeClass('hide');
                $('#like-count-' + post_id).addClass('show');
                displayToast("Thanks");
            } else if (data < $count && data != 0) {
                $('#like-' + post_id).css({
                    'color': 'lightslategray'
                });
                $('#like-count-' + post_id).text(data);
                $('#like-count-' + post_id).removeClass('hide');
                $('#like-count-' + post_id).addClass('show');
                displayToast("Thanks Removed");
            } else if (data < $count && data == 0) {
                $('#like-' + post_id).css({
                    'color': 'lightslategray'
                });
                $('#like-count-' + post_id).removeClass('show');
                $('#like-count-' + post_id).addClass('hide');
                $('#like-count-' + post_id).text(data);
            }
        }
    });
    return false;
});


// Favourite Button

$('.fav-btn').live('click', function(event) {
    event.preventDefault();
    var post_id = $(this).parent().data('id');

    var formData = $('#post-fav-' + post_id).serialize();
    var formAction = $('#post-fav-' + post_id).attr('action');
    $count = $.trim($('.myfavcount').text());
    if ($count.length == 0 || $count == "") {
        $count = 0;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: formAction,
        type: "post",
        data: formData,
        cache: false,

        success: function(data) {
            if (data > $count) {
                $('.myfavcount').text(data);
                $('#fav-btn-' + post_id).css({
                    'color': '#FFC823'
                });
                $('.myfavcount').removeClass('hide');
                $('.myfavcount').addClass('show');
                displayToast("Favourite");

            } else if (data < $count && data != 0) {
                $('#fav-btn-' + post_id).css({
                    'color': 'rgb(183, 182, 182)'
                });
                $('.myfavcount').text(data);
                $('.myfavcount').removeClass('hide');
                $('.myfavcount').addClass('show');
                displayToast("Unfavourite");
            } else if (data < $count && data == 0) {
                $('#fav-btn-' + post_id).css({
                    'color': 'rgb(183, 182, 182);'
                });
                $('.myfavcount').removeClass('show');
                $('.myfavcount').addClass('hide');
                $('.myfavcount').text(data);
            }
        }
    });
    return false;
});

//Link Request

$('.link-btn').live('click', function(event) {
    event.preventDefault();
    var post_id = $(this).parent().data('id');
    var puid = $(this).data('puid');
    var formData = $('#no-ind-unknown').serialize();
    var formAction = $('#no-ind-unknown').attr('action');
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: formAction,
        type: "post",
        data: formData,
        cache: false,

        success: function(data) {
            if(data == 'success'){
                $(".puid-"+puid).html('<button class="btn btn-xs disabled linkrequest-follow-icon-css"><i class="icon-hourglass (alias) " style="color:#777;font-size:8px;"></i> Link Requested</button>');
                $('#links-follow').modal('hide');
                displayToast("Link Requested");
            }
        }
    });
    return false;
});


//Link Remove Request

$('.link-remove-btn').live('click', function(event) {
    event.preventDefault();
    var post_id = $(this).parent().data('id');
    var puid = $(this).data('puid');
    var formData = $('#yes-ind').serialize();
    var formAction = $('#yes-ind').attr('action');
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: formAction,
        type: "post",
        data: formData,
        cache: false,

        success: function(data) {
            if(data == 'success'){
                 $(".puid-"+puid).html('<button class="btn btn-xs unlink-follow-icon-css"><i class="icon-hourglass (alias)" style="color:dimgrey;font-size:8px;"></i> Add Link</button>');
                $('#links-follow').modal('hide');

            }
        }
    });
    return false;
});

//Follow Request

$('.follow-btn').live('click', function(event) {
    event.preventDefault();
    var post_id = $(this).parent().data('id');
    var puid = $(this).data('pfid');
    var formData = $('#no-corp').serialize();
    var formAction = $('#no-corp').attr('action');
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: formAction,
        type: "post",
        data: formData,
        cache: false,

        success: function(data) {
            if(data == 'success'){
                console.log(data);
                 $(".pfid-"+puid).html('<a href="#links-follow" data-toggle="modal" class="user-link3" data-linked="no" data-utype="corp"><button class="btn btn-xs link-follow-icon-css"><i class="icon-check" style="color:#F7F7F7;font-size:10px;"></i> Following</button></a>');
                $('#links-follow').modal('hide');
                displayToast("Following");
            }
        }
    });
    return false;
});


//Follow Remove Request

$('.unfollow-btn').live('click', function(event) {
    event.preventDefault();
    var post_id = $(this).parent().data('id');
    var puid = $(this).data('pfid');
    var formData = $('#yes-corp').serialize();
    var formAction = $('#yes-corp').attr('action');
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: formAction,
        type: "post",
        data: formData,
        cache: false,

        success: function(data) {
            if(data == 'success'){
                console.log(data);
                 $(".pfid-"+puid).html('<a href="#links-follow" data-toggle="modal" class="user-link3" data-linked="yes" data-utype="corp"><button class="btn btn-xs unlink-follow-icon-css"><i class="icon-plus" style="color:dimgrey;font-size:10px;"></i> Follow</button></a>');
                $('#links-follow').modal('hide');
            }
        }
    });
    return false;
});


// user-link

$('.user-link').live('click', function(event) {
    event.preventDefault();
    var post_user_id = $(this).parent().data('puid');
    var post_user_linked = $(this).data('linked');
    var post_user_type = $(this).data('utype');

    // var formData = $('#post-apply-'+post_id).serialize(); 
    //  var formAction = $('#post-apply-'+post_id).attr('action');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/follow-modal",
        type: "post",
        data: {
            puid: post_user_id,
            linked: post_user_linked,
            utype: post_user_type
        },
        cache: false,
        success: function(data) {
            $('#links-follow-content').html(data);
            $('#links-follow').modal('show');
        }
    });
    return false;
});

$('.user-link2').live('click', function(event) {
    event.preventDefault();
    var post_user_id = $(this).parent().data('pfid');
    var post_user_linked = $(this).data('linked');
    var post_user_type = $(this).data('utype');

    // var formData = $('#post-apply-'+post_id).serialize(); 
    //  var formAction = $('#post-apply-'+post_id).attr('action');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/follow-modal",
        type: "post",
        data: {
            puid: post_user_id,
            linked: post_user_linked,
            utype: post_user_type
        },
        cache: false,
        success: function(data) {
            $('#links-follow-content').html(data);
            $('#links-follow').modal('show');
        }
    });
    return false;
});

$('.user-link3').live('click', function(event) {
    event.preventDefault();
    var post_user_id = $(this).parent().data('puid');
    var post_user_linked = $(this).data('linked');
    var post_user_type = $(this).data('utype');

    // var formData = $('#post-apply-'+post_id).serialize(); 
    //  var formAction = $('#post-apply-'+post_id).attr('action');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/follow-modal",
        type: "post",
        data: {
            puid: post_user_id,
            linked: post_user_linked,
            utype: post_user_type
        },
        cache: false,
        success: function(data) {
            $('#links-follow-content').html(data);
            $('#links-follow').modal('show');
        }
    });
    return false;
});


// displayToast

function displayToast($msg) {
    $.bootstrapGrowl($msg, {
        ele: 'body', // which element to append to
        type: 'info', // (null, 'info', 'danger', 'success', 'warning')
        offset: {
            from: 'bottom',
            amount: 10
        }, // 'top', or 'bottom'
        align: 'center', // ('left', 'right', or 'center')
        width: 'auto', // (integer, or 'auto')
        height: 'auto',
        // delay: 3000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
        allow_dismiss: false, // If true then will display a cross to close the popup.
        stackup_spacing: 10 // spacing between consecutively stacked growls.
    });
}


// user post sharing

$("#connections").prop('disabled', true);
$("#groups").prop('disabled', true);
$("input[name$='tag-group']").click(function() {
    var selected = $(this).val();

    if (selected == 'links' && $(this).prop('checked')) {

        $("#connections").prop('required', true);
        $("#connections").prop('disabled', false);
        if ($("#groups").prop('disabled') === false) {
            $("#groups").prop('disabled', false);
        } else {
            $("#groups").prop('disabled', true);
        }
        if ($("#groups").prop('required') === false) {
            $("#groups").prop('required', false);
        } else {
            $("#groups").prop('required', true);
        }
    } else if (selected == 'groups' && $(this).prop('checked')) {

        $("#groups").prop('required', true);
        $("#groups").prop('disabled', false);
        if ($("#connections").prop('disabled') === false) {
            $("#connections").prop('disabled', false);
        } else {
            $("#connections").prop('disabled', true);
        }
        if ($("#connections").prop('required') === false) {
            $("#connections").prop('required', false);
        } else {
            $("#connections").prop('required', true);
        }

    } else if (selected == 'links' && $(this).prop('checked') === false) {
        $("#connections").prop('disabled', true);
    } else if (selected == 'groups' && $(this).prop('checked') === false) {
        $("#groups").prop('disabled', true);
    }
});


// get post id for post share

$('.sojt').on('click', function(event) {
    var share_post_id = $(this).data('share-post-id');
    $('#modal_share_post_id').val(share_post_id);
});

$('#connections').select2({
    placeholder: "Select links to share"
});
$('#groups').select2({
    placeholder: "Select groups to share"
});

// share post 
$('#modal-post-share-btn').live('click', function(event) {
    event.preventDefault();
    loader('show');

    var share_post_id = $("#modal_share_post_id").val();
    var formData = $('#modal-post-share-form').serialize(); // form data as string
    var formAction = $('#modal-post-share-form').attr('action'); // form handler url
    // console.log(share_post_id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: formAction,
        type: "post",
        data: formData,
        cache: false,
        success: function(data) {
            loader('hide');
            if (data.data.page == 'home') {
                $('#post-share-msg-box').removeClass('alert alert-danger');
                $('#post-share-form-errors').hide();
                $('#post-share-msg-box').addClass('alert alert-success').fadeIn(1000, function() {
                    $(this).show();
                });
                $('#share-count-' + share_post_id).text(data.data.sharecount);
                // console.log(data.data.sharecount+" - "+share_post_id);
                $('#modal-post-share-form')[0].reset();
                $("#connections").select2("val", "");
                $("#groups").select2("val", "");
                $("#connections").prop('disabled', true);
                $("#groups").prop('disabled', true);
                $('#post-share-msg').html('Post shared successfully ! <br/>');
                $("#share-post").fadeTo(2000, 500).slideUp(500, function() {
                    $('#share-post').modal('hide');
                    $('#post-share-msg-box').hide();
                    $('#post-share-msg-box').removeClass('alert alert-success');
                    $('#post-share-msg-box').removeClass('alert alert-danger');
                });

            }
        },
        error: function(data) {
            loader('hide');
            var errors = data.responseJSON;
            // console.log(errors);
            $errorsHtml = '<div class="alert alert-danger"><ul>';
            $.each(errors.errors, function(index, value) {
                console.log(value);
                $errorsHtml += '<li>' + value[0] + '</li>';
            });
            $errorsHtml += '</ul></div>';
            $('#post-share-form-errors').html($errorsHtml);
            $('#post-share-form-errors').show();
        }
    });
    return false;
});


//Hiding and showing content

$(document).ready(function() {

    jQuery('.hide-show-filter').on('click', function(event) {
        jQuery('.show-filter').toggle('show');
        jQuery('.hide-label').toggle('hide');
    });

    jQuery('.show-more').on('click', function(event) {
        jQuery('.extra-show').toggle('show');
    });

    jQuery('.new-hide').on('click', function(event) {

        jQuery('.show-details').toggle('show');
        jQuery('.hide-details').toggle('hide');
    });

    jQuery('.hide-detail').on('click', function(event) {
        jQuery('.show-details').toggle('hide');
        jQuery('.hide-details').toggle('show');
    });

    jQuery('.job-type-filter').on('click', function(event){
        jQuery('.icon-btn').addClass('icon-filter-active-btn');
    });
});


$(document).ready(function() {
    window.asd = $('.SlectBox').SumoSelect({
        csvDispCount: 3
    });
    window.test = $('.testsel').SumoSelect({
        okCancelInMulti: true
    });
    window.testSelAll = $('.testSelAll').SumoSelect({
        okCancelInMulti: true,
        selectAll: true
    });
    window.testSelAll2 = $('.testSelAll2').SumoSelect({
        selectAll: true
    });
});

function setPostId(postId) {
    $("#modal_share_post_email_id").val(postId);
    console.log(postId);
}

// share post by email
$('#modal-post-share-email-btn').live('click', function(event) {
    event.preventDefault();
    loader('show');

    var share_post_id = $("#modal_share_post_email_id").val();
    var formData = $('#modal-post-share-email-form').serialize(); // form data as string
    var formAction = $('#modal-post-share-email-form').attr('action'); // form handler url
    console.log("111:" + share_post_id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: formAction,
        type: "post",
        data: formData,
        cache: false,
        success: function(data) {
            loader('hide');
            if (data.data.page == 'home') {
                $('#post-share-email-msg-box').removeClass('alert alert-danger');
                $('#post-share-email-form-errors').hide();
                $('#post-share-email-msg-box').addClass('alert alert-success').fadeIn(1000, function() {
                    $(this).show();
                });
                $('#share-count-' + share_post_id).text(data.data.sharecount);
                // console.log(data.data.sharecount+" - "+share_post_id);
                $('#modal-post-share-email-form')[0].reset();
                $('#post-share-email-msg').html('Post shared successfully ! <br/>');
                $("#share-post-email").fadeTo(2000, 500).slideUp(500, function() {
                    $('#share-post-email').modal('hide');
                    $('#post-share-email-msg-box').hide();
                    $('#post-share-email-msg-box').removeClass('alert alert-success');
                    $('#post-share-email-msg-box').removeClass('alert alert-danger');
                });

            }
        },
        error: function(data) {
            console.log(data);
            loader('hide');
            var errors = data.responseJSON;
            // console.log(errors);
            $errorsHtml = '<div class="alert alert-danger"><ul>';
            $.each(errors.errors, function(index, value) {
                console.log(value);
                $errorsHtml += '<li>' + value[0] + '</li>';
            });
            $errorsHtml += '</ul></div>';
            $('#post-share-form-email-errors').html($errorsHtml);
            $('#post-share-form-email-errors').show();
        }
    });
    return false;
});


// Report Validation
$(document).ready(function() {
    $(".report-validation").validate({
        rules: {
            " report-abuse-check[]": {
                required: true,
                minlength: 1
            }
        },
        messages: {
            "spam[]": "Please select at least two types of spam."
        }
    });
});

// modal job filter
$selectedSkills = $("#linked_skill_id").select2();
$gotit = [];
$(function() {

    function split(val) {
        return val.split(/,\s*/);
    }

    function extractLast(term) {
        return split(term).pop();
    }

    $("#newskill-job")
        .bind("keydown", function(event) {
            if (event.keyCode === $.ui.keyCode.TAB && $(this).autocomplete("instance").menu.active) {
                event.preventDefault();
            }
        })
        .autocomplete({
            appendTo: '#job-skill-wrapper',
            source: function(request, response) {
                
                $.ajax({
                    url: '/job/skillSearch',
                    dataType: "json",
                    data: {
                        term: extractLast(request.term)
                    },
                    success: function(data) {
                        if (data.length === 0) {
                            $('#add-new-skill').removeClass('hide');
                            $('#add-new-skill').addClass('show');
                        } else {
                            $('#add-new-skill').removeClass('show');
                            $('#add-new-skill').addClass('hide');
                        }
                        response(data);
                    }
                });

            },
            search: function() {
                var term = extractLast(this.value);
                if (term.length < 2) {
                    return false;
                }
            },
            focus: function() {
                return false;
            },
            select: function(event, ui) {
                var termsId = [];

                if ($selectedSkills.val() != null) {
                    termsId = $selectedSkills.val();
                }

                if (termsId.length != null) {

                }
                termsId.push(ui.item.value);
                $gotit.push(ui.item.value);

                termsId.push("");
                $selectedSkills.val(termsId).trigger("change");
                $(this).val("");
                return false;
            }
        });
});

// // user-link

// $('.user-link').live('click', function(event) {
//     event.preventDefault();
//     var post_user_id = $(this).parent().data('puid');
//     var post_user_linked = $(this).data('linked');
//     var post_user_type = $(this).data('utype');

//     // var formData = $('#post-apply-'+post_id).serialize(); 
//     //  var formAction = $('#post-apply-'+post_id).attr('action');

//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     $.ajax({
//         url: "/follow-modal",
//         type: "post",
//         data: {
//             puid: post_user_id,
//             linked: post_user_linked,
//             utype: post_user_type
//         },
//         cache: false,
//         success: function(data) {
//             $('#links-follow-content').html(data);
//             $('#links-follow').modal('show');
//         }
//     });
//     return false;
// });

// Linked-button

$('.linked-btn').live('click', function(event) {
    event.preventDefault();
    var post_user_id = $(this).parent().data('puid');
    var post_user_linked = $(this).data('linked');
    var post_user_type = $(this).data('utype');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: formAction,
        type: "post",
        data: formData,
        cache: false,
        success: function(data) {
            
        }
    });
    return false;
});


//modal skill filter
$selectSkills = $("#linked_skillid").select2();
$selectit = [];
$(function() {

    function split(val) {
        return val.split(/,\s*/);
    }

    function extractLast(term) {
        return split(term).pop();
    }

    $("#newskill")
        .bind("keydown", function(event) {
            if (event.keyCode === $.ui.keyCode.TAB && $(this).autocomplete("instance").menu.active) {
                event.preventDefault();
            }
        })
        .autocomplete({
            appendTo: '#skill-wrapper',
            source: function(request, response) {
                // $.getJSON( "/job/skillSearch", {
                //  term: extractLast( request.term )
                // }, response );

                $.ajax({
                    url: '/job/skillSearch',
                    dataType: "json",
                    data: {
                        term: extractLast(request.term)
                    },
                    success: function(data) {
                        if (data.length === 0) {
                            $('#add-new-skill').removeClass('hide');
                            $('#add-new-skill').addClass('show');
                        } else {
                            $('#add-new-skill').removeClass('show');
                            $('#add-new-skill').addClass('hide');
                        }
                        response(data);
                    }
                });

            },
            search: function() {
                var term = extractLast(this.value);
                if (term.length < 2) {
                    return false;
                }
            },
            focus: function() {
                return false;
            },
            select: function(event, ui) {
                var termId = [];

                if ($selectSkills.val() != null) {
                    termId = $selectSkills.val();
                }

                if (termId.length != null) {

                }
                termId.push(ui.item.value);
                $selectit.push(ui.item.value);

                termId.push("");
                $selectSkills.val(termId).trigger("change");
                $(this).val("");
                return false;
            }
        });
});

function myFunction() {
    document.getElementById("job-filter").reset();
}


$('.contact-btn').live('click',function(event){       
    event.preventDefault();
    var post_id = $(this).parent().data('id');

    var formData = $('#post-contact-'+post_id).serialize(); 
    var formAction = $('#post-contact-'+post_id).attr('action');
    // console.log(post_id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      url: formAction,
      type: "post",
      data: formData,
      cache : false,
      success: function(data){
        // console.log("s:"+data);
        if(data.contacted == "contacted"){
            $('#contact-btn-'+post_id).prop('disabled', true);
            $('#contact-btn-'+post_id).text('Contacted');
            $('#show-hide-contacts').addClass('show-hide-new');
            if(data.data.show == "Public"){
                var show = '<div class="skill-display">Contact Details : </div>';
                show += '<div class="row"><div class="col-md-1 col-sm-6 col-xs-6"><label class="detail-label"><i class="glyphicon glyphicon-user"></i> :</label> </div>';
                show += '<div class="col-md-9 col-sm-6 col-xs-6">'+data.data.contact+'</div></div>';
                show += '<div class="row"><div class="col-md-1 col-sm-6 col-xs-6"><label class="detail-label"><i class="glyphicon glyphicon-envelope"></i> :</label> </div>';
                show += '<div class="col-md-9 col-sm-6 col-xs-6">'+data.data.email+'</div></div>';                          
                show += '<div class="row"><div class="col-md-1 col-sm-6 col-xs-6"><label class="detail-label"><i class="glyphicon glyphicon-envelope"></i> :</label></div>';
                show += '<div class="col-md-9 col-sm-6 col-xs-6">'+data.data.phone+'</div></div>';
                $("#post-user-contact-"+post_id).html(show);
            }else if(data.data.show == "Private"){
                var show = '<div class="skill-display">Contact Details : </div>';
                show += '<div class="col-md-12 col-sm-12 col-xs-12"><label class="detail-label" style="color: #BB4E4E;font-size: 12px;">Post owner has kept contact details Private.</label></div>';
                $("#post-user-contact-"+post_id).html(show);
            }
            
            var dates = '<div class="col-md-12" style="text-align:center;"><i class="fa fa-calendar" style="font-size: 11px;color:dimgrey;"></i>'+data.data.date+'</div>';
            $("#post-date-"+post_id).html(dates);
            console.log(data.data.date);
        }
      }
    }); 
    return false;
  });