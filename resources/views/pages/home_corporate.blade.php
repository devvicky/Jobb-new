@extends('master')
 @section('content')
  @include('partials.corporate_home.home')

<!-- END SHARE MODAL FORM -->
@stop @section('javascript')
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56afb9b6a3affa13" async="async"></script>
<!-- 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-528ddbdf4d9dd13d" async="async">
</script> 
-->
<script src="/assets/admin/pages/scripts/components-dropdowns.js"></script>
<script src="/assets/js/home-js.js"></script>
<script src="/assets/js/home-corp-js.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&region=IN" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {
    ComponentsIonSliders.init();
    ComponentsDropdowns.init();
    ComponentsEditors.init();
    UIBootstrapGrowl.init();
    ComponentsjQueryUISliders.init();
    // FormWizard.init();
});
    
    //job Filter
    var skillArray = [];
    @if($filter != null)
    <?php $array = explode(', ', $filter->linked_skill); ?> 
    @if(count($array) > 0)
    @foreach($array as $gt => $gta)
        skillArray.push('<?php echo $gta; ?>');
    @endforeach
    @endif
    @endif
    var skillselect = $("#linked_skill_id").select2({ dataType: 'json', data: skillArray });
    skillselect.val(skillArray).trigger("change");

     //skill Filter
    var skillArray = [];
    @if($skillfilter != null)
    <?php $arrayskill = explode(', ', $skillfilter->linked_skill); ?> 
    @if(count($arrayskill) > 0)
    @foreach($arrayskill as $gt => $gta)
        skillArray.push('<?php echo $gta; ?>');
    @endforeach
    @endif
    @endif
    var skillselect = $("#linked_skillid").select2({ dataType: 'json', data: skillArray });
    skillselect.val(skillArray).trigger("change");

    // preferred loc
    var prefLocationArray = [];
    @if($filter != null)
    <?php $arr = explode(', ', $filter->city); ?>
    @if(count($arr) > 0) 
    @foreach($arr as $ga => $gt)
        prefLocationArray.push('<?php echo $gt; ?>');
    @endforeach
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
//Skill Experience slider
    
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

<script>
jQuery(document).ready(function() {       
    ComponentsjQueryUISliders.init(); 
});
</script>
<script src="/assets/admin/pages/scripts/components-dropdowns.js"></script>
<script type="text/javascript">
    function initialize() {
        var options = { types: ['(cities)'], componentRestrictions: {country: "in"} };
        var input = document.getElementById('city');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', onPlaceChanged); 
        function onPlaceChanged() {
          var place = autocomplete.getPlace();
          if (place.address_components) { city = place.address_components[0];
            document.getElementById('city').value = city.long_name;
          } else { document.getElementById('autocomplete').placeholder = 'Enter a city'; }
        }
    }
   google.maps.event.addDomListener(window, 'load', initialize);   
</script>
     <script type="text/javascript">
        $(document).ready(function () {
            window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 3 });
            window.test = $('.testsel').SumoSelect({okCancelInMulti:true });
            window.testSelAll = $('.testSelAll').SumoSelect({okCancelInMulti:true, selectAll:true });
            window.testSelAll2 = $('.testSelAll2').SumoSelect({selectAll:true });
        });

$selectedSkills = $("#linked_skill_id").select2();
$gotit = [];
    $(function(){

        function split( val ) {
          return val.split( /,\s*/ );
        }
        function extractLast( term ) {
          return split( term ).pop();
        }

        $( "#newskill" )
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
              event.preventDefault();
            }
        })
        .autocomplete({
            source: function( request, response ) {
                // $.getJSON( "/job/skillSearch", {
                //  term: extractLast( request.term )
                // }, response );

                $.ajax({
                    url: '/job/skillSearch',
                    dataType: "json",
                    data: { term: extractLast( request.term ) },
                    success: function(data) {
                    if (data.length === 0) {
                        $('#add-new-skill').removeClass('hide');
                        $('#add-new-skill').addClass('show');
                    }else{
                        $('#add-new-skill').removeClass('show');
                        $('#add-new-skill').addClass('hide');
                    }
                    response(data);
                    }
                });

            },
            search: function() {
                var term = extractLast( this.value );
                if ( term.length < 2 ) {
                    return false;
                }
            },
            focus: function() {
                return false;
            },
            select: function(event, ui) {
                var termsId = [];

                if($selectedSkills.val() != null){
                    termsId = $selectedSkills.val();
                }

                if(termsId.length != null){

                }
                termsId.push( ui.item.value );
                $gotit.push( ui.item.value );

                termsId.push( "" );
                $selectedSkills.val(termsId).trigger("change"); 
                $(this).val("");
                return false;
            }
        });
    });
    $(document).ready(function(){
        $('#add-new-skill').on('click',function(event){         
            event.preventDefault();
            if (!$('#newskill').val()) {
                alert('Please enter some skill to add.');
                return false;
            }else{
                var name = $('#newskill').val(); 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                  url: "/job/newskill",
                  type: "POST",
                  data: { name: name },
                  cache : false,
                  success: function(data){
                    if(data > 0){
                        $newSkillList = new Array();

                        <?php $newSkillList = array(); ?>
                        @foreach($skills as $skill)
                            $newSkillList.push('<?php echo $skill; ?>');
                        @endforeach

                        $newSkillList.push($('#newskill').val());
                        // console.log($newSkillList);
                        $("#linked_skill_id").select2({
                            dataType: 'json',
                            data: $newSkillList
                        });

                        var selectedSkillId = [];
                        $newSkill = $('#newskill').val();
                        $newSkillId = data;
                        // $selectedSkill = $('#linked_skill').val();
                        // console.log($gotit);
                        if($gotit != null){
                            selectedSkillId = $gotit;
                        }
                        
                        selectedSkillId.push($newSkill);
                        // console.log(selectedSkillId);
                        // $('#linked_skill').val($selectedSkill+""+$newSkill+", ");
                        $selectedSkills.val(selectedSkillId).trigger("change"); 
                        $('#newskill').val("");
                    }
                  },
                  error: function(data) {
                    alert('some error occured...');
                  }
                }); 
                return false;
            }
        });

        
        $(".job-role-ajax").select2({
        placeholder: 'Enter a role',
        ajax: {
            url: "/post/jobroles/",
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, // search term
                page: params.page
              };
            },
            processResults: function (data, params) {
              console.log(data);
              return {
                results: data
              };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 2,
        templateResult: formatRepo, // omitted for brevity, see the source of this page
        templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    });

    function formatRepo (repo) {
        if (repo.loading) return repo.text;

        var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
          "<div class='select2-result-repository__title'><b>Role</b>: " + repo.role + "</div>";

        markup += "<div class='select2-result-repository__statistics'>" +
        "<div class='select2-result-repository__forks'><b>Functional area: </b> " + repo.functional_area + "</div>" +
        "<div class='select2-result-repository__stargazers'><b>Industry</b>: " + repo.industry + "</div>" +
        "</div>" +
        "</div></div>";

        return markup;
    }

    function formatRepoSelection (repo) {
        if(repo.role != undefined){
            // console.log(repo);
            return  "<b>Role:</b> "+repo.role+"<br/><b>Functional Area:</b> "+repo.functional_area+"<br/><b>Industry:</b> "+repo.industry;
        }      
    }
        });
</script>

<script type="text/javascript">
     $(document).ready(function () {
        $('.profile-show').hide();
        $('.view-profile').click(function () {
           $('.profile-show').show();
           $('.view-profile').hide();
    });
   });

     $(document).ready(function () {
        $('.modifysearch').click(function () {
           $('.searchedprofile').show();
           $('.modifysearch').hide();
    });
   });


    $('.profile-fav-btn').live('click',function(event){         
    event.preventDefault();
    var post_id = $(this).parent().data('id');

    var formData = $('#profile-fav-'+post_id).serialize(); 
    var formAction = $('#profile-fav-'+post_id).attr('action');
    $count = $.trim($('#profilefavcount').text());
    if($count.length == 0 || $count == ""){
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
      cache : false,

      success: function(data){
            // console.log(data);
        if(data.data.save_contact == 1 && data.success == 'success'){

            var out = '<div class="col-md-8 col-sm-8 col-xs-12" style="padding:0 !important;margin: 5px 0;">';
            out += '<i class="fa fa-envelope"></i> : '+data.data.email+'<br>';
            out += '<i class="fa fa-phone-square"></i> : '+data.data.mobile+'</div>';
            out += '<div class="col-md-4 col-sm-4 col-xs-12" style="padding:0 !important;margin: 5px 0;">';
            out += '<a class="btn blue corp-profile-resume" href="'+data.data.resume+'">'
            out += '<i class="glyphicon glyphicon-download"></i> Resume</a></div>';

            $("#profile-contacts-"+post_id).html(out);
            $("#profilefav-btn-"+post_id).hide();
            $("#profilesave-btn-"+post_id).hide();
            $('#profilefav-btn-'+post_id).prop('disabled', true);
            
        }else {
            // console.log(data);
        }
      }
    }); 
    return false;
  }); 


 $('.profile-save-btn').live('click',function(event){       
    event.preventDefault();
    var post_id = $(this).parent().data('saveid');

    var formData = $('#profile-save-'+post_id).serialize(); 
    var formAction = $('#profile-save-'+post_id).attr('action');
    
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
            // console.log(data);
        if(data.data.save_profile == 1 && data.success == 'success'){
            $('#profilesave-btn-'+post_id).css({'color':'#FFC823'});
            $('#profilesave-btn-'+post_id).text('Profile Saved');   
        }else if(data.data.save_profile == 0){
            $('#profilesave-btn-'+post_id).css({'color':'transparent'});
        }
      }
    }); 
    return false;
  }); 
</script>
<script src="/assets/js/jquery.infinitescroll.min.js"></script>
<script src="/assets/js/myinfinite.js"></script>
@stop
