@extends('master')
 @section('content')
  @include('partials.home.home')
<div class="modal fade" id="share-post" tabindex="-1" role="dialog" aria-labelledby="share-post" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Share post</h4>
            </div>
            <form class="form-horizontal" id="modal-post-share-form" role="form" method="POST" action="/post/share">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="share_post_id" id="modal_share_post_id" value=""> @if(Auth::user()->induser)
                    <div id="post-share-msg-box" style="display:none">
                        <div id="post-share-msg"></div>
                    </div>
                    <div id="post-share-form-errors" style="display:none"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Who can see this Post</h4>
                        </div>
                        <div class="col-md-6">
                            <!-- 
                            <label for="tag-group-all" style="padding: 5.5px 12px;">
                              <input type="checkbox" id="tag-group-all" name="tag-group" value="all" class="md-radiobtn">
                              Public 
                            </label> 
                            -->
                            <label for="tag-group-links" style="padding: 5.5px 12px;">
                                <input type="checkbox" id="tag-group-links" name="tag-group" value="links" class="md-radiobtn"> Links
                            </label>
                            <label for="tag-group-groups" style="padding: 5.5px 12px;">
                                <input type="checkbox" id="tag-group-groups" name="tag-group" value="groups" class="md-radiobtn"> Groups
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
@stop
@section('javascript')
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56afb9b6a3affa13" async="async">
</script>
<script src="/assets/admin/pages/scripts/components-dropdowns.js"></script>
<script src="/assets/home-js.js"></script>
<script>
jQuery(document).ready(function() {
    ComponentsIonSliders.init();
    ComponentsDropdowns.init();
    ComponentsEditors.init();
    UIBootstrapGrowl.init();
    ComponentsjQueryUISliders.init();
    // FormWizard.init();
});
    
    $(function() {
      $(".save-filter").delay(5000).fadeOut();
    });


    //job Filter
    var skillArray = [];
    @if($filter != null)
        @if($filter->linked_skill != null)
        <?php $array = explode(', ', $filter->linked_skill); ?> 
        @if(count($array) > 0)
            @foreach($array as $gt => $gta)
                skillArray.push('<?php echo $gta; ?>');
            @endforeach
        @endif
        @endif
    @else
        <?php $authSkill = explode(', ', Auth::user()->induser->linked_skill); ?> 
        @if(count($authSkill) > 0)
            @foreach($authSkill as $gt => $gta)
                skillArray.push('<?php echo $gta; ?>');
            @endforeach
        @endif
    @endif
    var skillselect = $("#linked_skill_id").select2({ dataType: 'json', data: skillArray });
    skillselect.val(skillArray).trigger("change");

     //skill Filter
    var skillArray = [];
    @if($skillfilter != null)
    @if($skillfilter->linked_skill != null)
    <?php $arrayskill = explode(', ', $skillfilter->linked_skill); ?> 
    @if(count($arrayskill) > 0)
    @foreach($arrayskill as $gt => $gta)
        skillArray.push('<?php echo $gta; ?>');
    @endforeach
    @endif
    @endif
    @endif
    var skillselect = $("#linked_skillid").select2({ dataType: 'json', data: skillArray });
    skillselect.val(skillArray).trigger("change");

    // preferred loc
    var prefLocationArray = [];
    @if($filter != null)
        @if($filter->city != null)
            <?php $arr = explode(', ', $filter->city); ?>
            @if(count($arr) > 0) 
                @foreach($arr as $ga => $gt)
                    prefLocationArray.push('<?php echo $gt; ?>');
                @endforeach
            @endif
        @endif
    @else
        @if(Auth::user()->induser->prefered_location != null)
            <?php $authCity = explode(', ', Auth::user()->induser->prefered_location); ?> 
            @if(count($authCity) > 0)
                @foreach($authCity as $pl => $gta)
                    prefLocationArray.push('<?php echo $gta; ?>');
                @endforeach
            @endif
        @endif
    @endif
    var plselect = $("#prefered_location").select2({ dataType: 'json', data: prefLocationArray });
    plselect.val(prefLocationArray).trigger("change");

    var $eventSelect = $("#prefered_location"); 
    $eventSelect.on("select2:unselect", function (e) {
        // console.log("Removing: "+e.params.data.id);
        // remove corresponding value from array
        prefLocationArray = $.grep(prefLocationArray, function(value) {
          return value != e.params.data.id;
        });

        // remove select option for pref loc
        $("#prefered_location option[value='"+e.params.data.id+"']").remove();      
        if(prefLocationArray.length == 0){
            plselect = $("#prefered_location").select2({ dataType: 'json', data: [] });
        }else{
            plselect = $("#prefered_location").select2({ dataType: 'json', data: prefLocationArray });
        }
        plselect.val(prefLocationArray).trigger("change"); 
        // updated array
    });

    var prefLoc = $("#pref_loc");
    function initPrefLoc() {
        var options = { types: ['(regions)'], componentRestrictions: {country: "in"}};
        var input = document.getElementById('pref_loc');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', onPlaceChanged);

        function onPlaceChanged() {
          var place = autocomplete.getPlace();
          if (place.address_components) { 
            // console.log(place.address_components);

            var obj = place.address_components;         
            var locality = '';
            var city = '';
            var state = '';
            $.each( obj, function( key, value ) {
                if($.inArray("sublocality", value.types)  > -1 ){
                    locality = value.long_name;
                }
                if($.inArray("locality", value.types)  > -1 ){
                    city = value.long_name;
                }
                if($.inArray("administrative_area_level_1", value.types)  > -1 ){
                    state = value.long_name;
                }
            });
            // console.log("Locality: "+locality+" city: "+city+" state: "+state);

            if(locality != '' && city != '' && state != '' ){
                prefLocationArray.push(locality +"-"+ city +"-"+ state);    
            }
            if(locality == '' && city != '' && state != '' ){
                prefLocationArray.push(city +"-" + state);  
            }

            setTimeout(function(){ prefLoc.val(''); prefLoc.focus();},0);   // clear field
            
            $("#prefered_location").select2({ dataType: 'json', data: prefLocationArray });
            plselect.val(prefLocationArray).trigger("change");

          } else { 
            document.getElementById('autocomplete').placeholder = 'Your preferred location'; 
          }
        }

    }
   google.maps.event.addDomListener(window, 'load', initPrefLoc);

</script>
<script type="text/javascript">
    // preferred loc
    var currLocationArray = [];

    @if($skillfilter != null)
        <?php $arrCity = explode(', ', $skillfilter->city); ?>
        @if(count($arrCity) > 0) 
            @foreach($arrCity as $ga => $gt)
                currLocationArray.push('<?php echo $gt; ?>');
            @endforeach
        @endif
     @else
        @if(Auth::user()->induser->prefered_location != null)
            <?php $authcurrCity = explode(', ', Auth::user()->induser->prefered_location); ?> 
            @if(count($authcurrCity) > 0)
                @foreach($authcurrCity as $pl => $gta)
                    currLocationArray.push('<?php echo $gta; ?>');
                @endforeach
            @endif
        @endif
    @endif
    var clselect = $("#current_location").select2({ dataType: 'json', data: currLocationArray });
    clselect.val(currLocationArray).trigger("change");

    var $eventSelect = $("#current_location"); 
    $eventSelect.on("select2:unselect", function (e) {
        // console.log("Removing: "+e.params.data.id);
        // remove corresponding value from array
        currLocationArray = $.grep(currLocationArray, function(value) {
          return value != e.params.data.id;
        });

        // remove select option for pref loc
        $("#current_location option[value='"+e.params.data.id+"']").remove();       
        if(currLocationArray.length == 0){
            clselect = $("#current_location").select2({ dataType: 'json', data: [] });
        }else{
            clselect = $("#current_location").select2({ dataType: 'json', data: currLocationArray });
        }
        clselect.val(currLocationArray).trigger("change"); 
        // updated array
    });

    var currLoc = $("#curr_loc");
    function initCurrLoc() {
        var options = { types: ['(regions)'], componentRestrictions: {country: "in"}};
        var input = document.getElementById('curr_loc');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', onPlaceChanged);

        function onPlaceChanged() {
          var place = autocomplete.getPlace();
          if (place.address_components) { 
            // console.log(place.address_components);

            var obj = place.address_components;         
            var locality = '';
            var city = '';
            var state = '';
            $.each( obj, function( key, value ) {
                if($.inArray("sublocality", value.types)  > -1 ){
                    locality = value.long_name;
                }
                if($.inArray("locality", value.types)  > -1 ){
                    city = value.long_name;
                }
                if($.inArray("administrative_area_level_1", value.types)  > -1 ){
                    state = value.long_name;
                }
            });
            // console.log("Locality: "+locality+" city: "+city+" state: "+state);

            if(locality != '' && city != '' && state != '' ){
                currLocationArray.push(locality +"-"+ city +"-"+ state);    
            }
            if(locality == '' && city != '' && state != '' ){
                currLocationArray.push(city +"-" + state);  
            }

            setTimeout(function(){ currLoc.val(''); currLoc.focus();},0);   // clear field
            
            $("#current_location").select2({ dataType: 'json', data: currLocationArray });
            clselect.val(currLocationArray).trigger("change");

          } else { 
            document.getElementById('autocomplete').placeholder = 'Your current location'; 
          }
        }

    }
   google.maps.event.addDomListener(window, 'load', initCurrLoc);

</script>
<script>
    $(document).ready(function(){
    $("#btn").click(function(){
    /* Single line Reset function executes on click of Reset Button */
    $("#job-filter")[0].reset();
    $("#linked_skill_id").val(null).trigger("change"); 
    $("#prefered_location").val(null).trigger("change");
    });});

// Experience slider
    
    $("#slider-range-max-skill").slider({
        isRTL: Metronic.isRTL(),
        range: "max",
        min: 0,
        max: 15,
        step: 1,
        slide: function (event, ui) {
            $("#slider-range-experience").val(ui.value); 

        }
    });

        $("#slider-range-experience").val($("#slider-range-max-skill").slider("value"));
</script>
<style type="text/css">
/* required for preferred location */
.pac-container {z-index:999999;}

.pagination {
    display: none;
}

#infscr-loading {
    text-align: center;
    display: block;
    clear: both;
    padding: 10px 0;
}
</style>
<script src="/assets/js/jquery.infinitescroll.min.js"></script>
<script src="/assets/js/myinfinite.js"></script>
@stop












<script>
$(document).ready(function () {            
//validation rules
    var form = $('#create_user');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);
    form.validate({
        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
           fname: {
              required: true,
              minlength: 5
            },
            lname: {
              required: true
            },
            dob: {
                required: true
            },
            gender: {
                required: true
            },
            city: {
                required: true
            },
            mobile: {
                required:true,
                number: true,
                maxlength:10,
                minlength:10
            },
            email: {
                required:true,
                email:true,
                minlength:10
            },
            about_individual: {
                required:false,
                maxlength:500,
                minlength:50
            },
            education: {
                required: true
            },
            experience: {
                required: true
            },
            'linked_skill_id[]': {
                required: true
            },
            prefered_jobtype: {
                required: true
            },
            'prefered_location': {
                required: true
            }

        },
        messages: {
            fname: {
                required: 'Enter First Name'
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
</script>








$alerted = {{Auth::user()->profile_alerted}};
$profile_status = {{Auth::user()->profile_status}};

if( $alerted == 0 && $profile_status <= 70 ){
  window.alert = function(message){
    $(document.createElement('div'))
        .attr({title: 'Profile Update Alert', 'class': 'alert'})
        .html(message)
        .dialog({
            buttons: {OK: function(){$(this).dialog('close');}},
            close: function(){$(this).remove();},
            draggable: true,
            modal: true,
            resizable: false,
            width: 'auto'
        });
};
  // $("Your profile is "+$profile_status+"% completed. Please update it to get more job opportunities.").dialog();
  alert("Your profile is "+$profile_status+"% completed. Please update it to get more job opportunities.");

  $.ajax({
    url: "/profile/alerted",
    type: "get",
    success: function(data){
      console.log("alerted: "+data);
    }
  });
}
 