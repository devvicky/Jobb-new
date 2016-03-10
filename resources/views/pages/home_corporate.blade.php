@extends('master')
 @section('content')
  @include('partials.corporate_home.home')

<!-- END SHARE MODAL FORM -->
@stop @section('javascript')
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56afb9b6a3affa13" async="async">
</script>
<!-- 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-528ddbdf4d9dd13d" async="async">
</script> 
-->
<script src="/assets/admin/pages/scripts/components-dropdowns.js"></script>
<script src="/assets/js/home-js.js"></script>
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
<script src="/assets/js/jquery.infinitescroll.min.js"></script>
<script src="/assets/js/myinfinite.js"></script>
@stop
