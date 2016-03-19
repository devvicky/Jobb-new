// *Begin Page level Javascript

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