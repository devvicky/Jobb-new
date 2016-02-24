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
        var post_id = $(this).parent().data('mpostid');

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
                    'color': 'darkseagreen'
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

// job modal skill filter
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
