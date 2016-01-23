var UIBootstrapGrowl = function() {

    return {
        //main function to initiate the module
        init: function() {

            $('.display_toast').live('click', function(event) {
                  // console.log($(this).data('toast-msg'));

                  var postid = $(this).data('postid');
                  var data = $(this).data('toast-msg');
                  console.log(data);

                $.bootstrapGrowl($(this).data('toast-msg'), {
                    ele: 'body', // which element to append to
                    type: 'info', // (null, 'info', 'danger', 'success', 'warning')
                    offset: {
                        from: 'bottom',
                        amount: 10
                    }, // 'top', or 'bottom'
                    align: 'center', // ('left', 'right', or 'center')
                    width: 250, // (integer, or 'auto')
                    delay: 3000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                    allow_dismiss: false, // If true then will display a cross to close the popup.
                    stackup_spacing: 10 // spacing between consecutively stacked growls.
                });
                if(data == 'Favourite'){
                    $("#display-toast-"+postid).data('toast-msg', "Unfavourite");
                }
                else if(data == 'Unfavourite'){
                    $("#display-toast-"+postid).data('toast-msg', "Favourite");
                }

            });

        }

    };

}();