@extends('login')

@section('content')

	<div class="content" style="background-color: transparent !important;padding:0;">

		@include('partials.login.login')
		@include('partials.register.register')
		@include('partials.login.forget-password')
		@include('partials.register.otp')
		@include('partials.loader')

	</div>

@stop

@section('javascript')

<script type="text/javascript">
$(document).ready(function() {
  
  $('#name').blur(function(){
  
    var nameVal = $('#name').val()
    var nameLength = nameVal.length;
    var nameSplit = nameVal.split(" ");
    var lastLength = nameLength - nameSplit[0].length;
    var lastNameLength = nameSplit[0].length + 1;
    var lastName = nameVal.slice(lastNameLength);
    
    $('#first_name').val(nameSplit[0]);
    $('#last_name').val(lastName);
    
    return false;
  });
	
});
</script>

<script type="text/javascript">
function loader(arg){
    if(arg == 'show'){
        $('#loader').show();
    }else{
        $('#loader').hide();
    }
}
function redirect(url){
    window.location = url;
}
$(document).ready(function(){
  $('#individual-login-btn').on('click',function(event){        
    event.preventDefault();

    $("#individual-login").validate();
    if($("#individual-login").valid()){
	    loader('show');

	    var formData = $('#individual-login').serialize(); // form data as string
	    var formAction = $('#individual-login').attr('action'); // form handler url

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
	        loader('hide');
	        // console.log(data);
	        if(data.data.page == 'login' && data.data.user == 'invalid'){            
	            $('#ind-msg-box').removeClass('alert alert-success');
	            $('#ind-msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#ind-msg').text(data.data.message);
	        }
	        else if(data.data.page == 'login' && data.data.email_verify == 0){
	        	$('#ind-msg-box').removeClass('alert alert-success');
	            $('#ind-msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#ind-msg').text(data.data.message);

	            $('.login-tag').hide();
	            $('#mobile-otp-form').show();
	            $('#ind-reg-msg').html(data.data.message);

	            $('#ind-msg-reg-box').removeClass('alert alert-success');
	            $('#ind-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	        }
	        else if(data.data.page == 'login' && data.data.mobile_verify == 0){
	        	$('#ind-msg-box').removeClass('alert alert-success');
	            $('#ind-msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#ind-msg').text(data.data.message);

	            $('.login-tag').hide();
	            $('#mobile-otp-form').show();

	            $('#resend-otp-form').show();
	        	$('#otpformob').val(data.data.mobile); 

	            $('#ind-reg-msg').html(data.data.message);  
	            $('#ind-msg-reg-box').show();

	            $('#ind-msg-reg-box').removeClass('alert alert-success');
	            $('#ind-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	        }
	        else{          
	            redirect(data.data.page);
	        }
	      },
	      error: function(data) {
	        loader('hide');
	        $('#ind-msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	        });
	        $('#ind-msg').text('Please Check your Email id or Password');
	        // $('#ind-msg-box').hide().fadeOut(7000);
	      }
	    }); 
	}
    return false;
  }); 

$('#corporate-login-btn').on('click',function(event){       
    event.preventDefault();

    $("#corporate-login").validate();
    if($("#corporate-login").valid()){
	    loader('show');

	    var formData = $('#corporate-login').serialize(); // form data as string
	    var formAction = $('#corporate-login').attr('action'); // form handler url

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
	        loader('hide');
	        if(data.data.page == 'login'){
	            $('#corp-msg-box').removeClass('alert alert-success');
	            $('#corp-msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#corp-msg').text('Invalid user');
	        }else{
	            $('#corp-msg-box').removeClass('alert alert-danger');
	            $('#corp-msg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $(this).show();
	            });
	            redirect(data.data.page);
	        }
	      },
	      error: function(data) {
	        loader('hide');
	        $('#corp-msg-box').addClass('alert alert-danger').fadeIn(1000, function(){
                $(this).show();
	        });
	        $('#corp-msg').text('Some error occured !');
	      }
	    }); 
	}
    return false;
  }); 
    
$('#individual-register-btn').on('click',function(event){       
    event.preventDefault();

    $("#individual-register").validate();
    if($("#individual-register").valid()){
	    loader('show');

	    var formData = $('#individual-register').serialize(); // form data as string
	    var formAction = $('#individual-register').attr('action'); // form handler url

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
	        loader('hide');
	        if(data.data.page == 'login'){
	            $('#ind-msg-reg-box').removeClass('alert alert-danger');
	            $('#ind-msg-reg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#individual-register')[0].reset();
	            $('#t-n-c').attr('checked', false); // Unchecks it

	            if(data.data.otp != null && data.data.vcode != null ){
		            $('.corporate-register-tab').hide();
		            $('#mobile-otp-form').show();
		            $('#ind-reg-msg').html('Registration successful ! <br/>Check your mobile/email for further instruction. <br/>Your otp: <b>'+data.data.otp+'</b> to verify mobile.');  
		            // console.log('both');

		            $('#ind-msg-reg-box').removeClass('alert alert-danger');
		            $('#ind-msg-reg-box').addClass('alert alert-success').fadeIn(1000, function(){
		                $(this).show();
		            });

		        }else if(data.data.vcode != null && data.data.otp == null){
		        	$('.corporate-register-tab').hide();
		            $('#mobile-otp-form').show();
		        	$('#ind-reg-msg').html('Registration successful ! <br/>Check your email for further instruction.');  
		        	// console.log('email');

		        	$('#ind-msg-reg-box').removeClass('alert alert-danger');
		            $('#ind-msg-reg-box').addClass('alert alert-success').fadeIn(1000, function(){
		                $(this).show();
		            });
		        }else if(data.data.otp != null && data.data.vcode == null){
		        	$('.corporate-register-tab').hide();
		            $('#mobile-otp-form').show();
		        	$('#ind-reg-msg').html('Registration successful ! <br/>Check your mobile for further instruction. <br/>	        		Your otp: <b>'+data.data.otp+'</b> to verify mobile.');  
		        	// console.log('mobile');

		        	$('#ind-msg-reg-box').removeClass('alert alert-danger');
		            $('#ind-msg-reg-box').addClass('alert alert-success').fadeIn(1000, function(){
		                $(this).show();
		            });
		        }
	        }else{
	            $('#ind-msg-reg-box').removeClass('alert alert-success');
	            $('#ind-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#ind-reg-msg').text('Some errors occured during Registration!');
	        }
	      },
	      error: function(data) {
	        loader('hide');
		    var errors = data.responseJSON;
		    // console.log(errors);
		    $errorsHtml = '<div class="alert alert-danger"><ul>';
		    $.each(errors, function(index, value) {
				 $errorsHtml += '<li>' + value[0] + '</li>';
		    });
	 		$errorsHtml += '</ul></div>';	            
	        $( '#ind-reg-form-errors' ).html( $errorsHtml );
	        $( '#ind-reg-form-errors' ).show();

	        // $('#ind-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	        //         $(this).show();
	        // });
	        // $('#ind-reg-msg').text('Some error occured !');
	      }
	    }); 
	}
    return false;
  });

$('#corporate-register-btn').on('click',function(event){       
    event.preventDefault();

    $("#corporate-register").validate();
    if($("#corporate-register").valid()){
	    loader('show');

	    var formData = $('#corporate-register').serialize(); // form data as string
	    var formAction = $('#corporate-register').attr('action'); // form handler url

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
	        loader('hide');
	        if(data.data.page == 'login'){
	            $('#corp-msg-reg-box').removeClass('alert alert-danger');
	            $('#corp-reg-form-errors').hide();
	            $('#corp-msg-reg-box').addClass('alert alert-success').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#corporate-register')[0].reset();
	            $('#t-n-c').attr('checked', false); // Unchecks it
	            // $('#corporate-register').hide();
	            // $('#corporate-login').show();
	            $('#corp-reg-msg').html('Registration successful ! <br/>Check your Email for further instruction.');  
	        }else{
	            $('#corp-msg-reg-box').removeClass('alert alert-success');
	            $('#corp-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	                $(this).show();
	            });
	            $('#corp-reg-msg').text('Some errors occured during Registration!');
	        }
	      },
	      error: function(data) {
	        loader('hide');
		    var errors = data.responseJSON;
		    // console.log(errors);
		    $errorsHtml = '<div class="alert alert-danger"><ul>';
		    $.each(errors, function(index, value) {
				 $errorsHtml += '<li>' + value[0] + '</li>';
		    });
	 		$errorsHtml += '</ul></div>';	            
	        $( '#corp-reg-form-errors' ).html( $errorsHtml );
	        $( '#corp-reg-form-errors' ).show();

	        // $('#ind-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
	        //         $(this).show();
	        // });
	        // $('#ind-reg-msg').text('Some error occured !');
	      }
	    }); 
	}
    return false;
  });

// $('#corporate-register-btn').on('click',function(event){        
//     event.preventDefault();

//     loader('show');

//     var formData = $('#corporate-register').serialize(); // form data as string
//     var formAction = $('#corporate-register').attr('action'); // form handler url

//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     $.ajax({
//       url: formAction,
//       type: "post",
//       data: formData,
//       cache : false,
//       success: function(data){
//         loader('hide');
//         if(data == 'login'){
//             $('#corp-msg-reg-box').removeClass('alert alert-success');
//             $('#corp-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
//                 $(this).show();
//             });
//             $('#corp-reg-msg').text('Invalid user');
//         }else{
//             $('#corp-msg-reg-box').removeClass('alert alert-danger');
//             $('#corp-msg-reg-box').addClass('alert alert-success').fadeIn(1000, function(){
//                 $(this).show();
//             });
//             $('#corp-reg-msg').text('Registration success');
//             redirect(data);
//         }
//       },
//       error: function(data) {
//         loader('hide');
//         $('#corp-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
//                 $(this).show();
//         });
//         $('#corp-reg-msg').text('Some error occured !');
//       }
//     }); 
//     return false;
//   });
});

$('#forget-password-btn').on('click',function(event){        
    event.preventDefault();

    
    $("#forgot-password").validate();
    if($("#forgot-password").valid()){
    	loader('show');
    var formData = $('#forgot-password').serialize(); // form data as string
    var formAction = $('#forgot-password').attr('action'); // form handler url

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
        loader('hide');
        console.log(data);
        if(data.data.page == 'login' && data.data.error == null){
            $('#forget-box').removeClass('alert alert-danger');
            $('#forget-box').addClass('alert alert-success').fadeIn(1000, function(){
                $(this).show();
            });
            $('#forgot-password')[0].reset();

            if(data.data.medium == 'mobile'){
            	$('#forget-box-msg').html("Click here to reset your password:  <a href='/reset/password/"+data.data.reset_code+"'>click here</a>");
            }else if(data.data.medium == 'email'){
            	$('#forget-box-msg').html(data.data.msg);
            }  
        }else if(data.data.page == 'login' && data.data.error != null){
            $('#forget-box').removeClass('alert alert-success');
            $('#forget-box').addClass('alert alert-danger').fadeIn(1000, function(){
                $(this).show();
            });
            $('#forget-box-msg').text(data.data.error);
        }
      },
      error: function(data) {
        loader('hide');
        $('#forget-box').addClass('alert alert-danger').fadeIn(1000, function(){
                $(this).show();
        });
        $('#forget-box-msg').text('Some error occured !');
      }
    }); 
}
    return false;
  }); 

$('#resend-otp-btn').on('click',function(event){        
    event.preventDefault();

    loader('show');

    var formData = $('#resend-otp-form').serialize(); // form data as string
    var formAction = $('#resend-otp-form').attr('action'); // form handler url

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
        loader('hide');
        // console.log(data);
        if(data.data.page == 'login' && data.data.mobile_verify == 0 && data.data.success_status){        	
            disableOTP();
        	$('#ind-msg-reg-box').removeClass('alert alert-danger');
            $('#ind-reg-msg').html(data.data.message);  
            $('#ind-msg-reg-box').addClass('alert alert-success').fadeIn(1000, function(){
                $(this).show();
            });
        }
        else if(data.data.page == 'login' && data.data.mobile_verify == 0 && !data.data.success_status){
        	$('#ind-msg-reg-box').removeClass('alert alert-success');           
            $('#ind-reg-msg').html(data.data.message);   
            $('#ind-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
                $(this).show();
            });
        }
      },
      error: function(data) {
        loader('hide');
        $('#ind-msg-reg-box').addClass('alert alert-danger').fadeIn(1000, function(){
                $(this).show();
        });
        $('#ind-reg-msg').text('Some error occured !');
      }
    }); 
    return false;
}); 

$('#individual-login').bind('keydown', function(e){         
    if (e.which == 13){
       $('#individual-login-btn').trigger('click'); 
       return false;  
   }     
});

$('#corporate-login').bind('keydown', function(e){         
    if (e.which == 13){
       $('#corporate-login-btn').trigger('click'); 
       return false;  
   }
});

$('#forgot-password').bind('keydown', function(e){         
    if (e.which == 13){
       $('#forgot-password-btn').trigger('click'); 
       return false;  
   }     
});

</script>
<script type="text/javascript">
    setTimeout (function(){
    document.getElementById('resend-otp-btn').disabled = null;
    },60000);

    var countdownNum = 60;
    
    function disableOTP(){
    	document.getElementById('resend-otp-btn').disabled = true;
    	incTimer();
    	countdownNum = 60;
    }

    function incTimer(){    	    	
	    setTimeout (function(){
	        if(countdownNum != 0){
		        countdownNum--;
		        document.getElementById('resend-otp-btn').innerHTML = 'Wait for ' + countdownNum + ' seconds';
		        incTimer();
	        } else {
	        	document.getElementById('resend-otp-btn').innerHTML = 'Resend OTP';
	        	document.getElementById('resend-otp-btn').disabled = false;
	        }
	    },1000);
    }
</script>
@stop