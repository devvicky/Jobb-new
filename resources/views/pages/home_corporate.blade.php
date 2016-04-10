@extends('master')
 @section('content')
  @include('partials.corporate_home.home')

<!-- END SHARE MODAL FORM -->
@stop 
@section('javascript')
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56afb9b6a3affa13" async="async"></script>
<script src="/assets/admin/pages/scripts/components-dropdowns.js"></script>
<script src="/assets/js/home-corp-js.js"></script>
<script>
jQuery(document).ready(function() {
    ComponentsDropdowns.init();
    ComponentsEditors.init();
    UIBootstrapGrowl.init();
    ComponentsjQueryUISliders.init();
    // FormWizard.init();
});
  </script>
  
  <script>
$(function() {
      $(".save-filter").delay(5000).fadeOut();
    });
  $(".education-list").select2({
      placeholder: "Select Job Type"
    });
  // range experience slider
    $("#slider-range-exp-corp").slider({
        isRTL: Metronic.isRTL(),
        range: true,
        min: 0,
        max: 15,
        step: 1,
        values: [0, 2],

        slide: function (event, ui) {
            $("#slider-range-exp1-corp").val(ui.values[0]);
            $("#slider-range-exp2-corp").val(ui.values[1]);
            // $("#slider-range-amount-exp").text("Min-Exp " + ui.values[0] + " - Max-Exp " + ui.values[1]);
        }

    });
    $('#slider-range-exp1-corp').val($("#slider-range-exp-corp").slider("values", 0));
    $('#slider-range-exp2-corp').val($("#slider-range-exp-corp").slider("values", 1));
  </script>
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
  <script>  
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
        <?php $authSkill = explode(', ', Auth::user()->corpuser->linked_skill); ?> 
        @if(count($authSkill) > 0)
            @foreach($authSkill as $gt => $gta)
                skillArray.push('<?php echo $gta; ?>');
            @endforeach
        @endif
    @endif
    var skillselect = $("#linked_skill_id").select2({ dataType: 'json', data: skillArray });
    skillselect.val(skillArray).trigger("change");

     //skill Filter
    var skillsArray = [];
    @if($skillfilter != null)
        @if($skillfilter->linked_skill != null)
        <?php $arrayskill = explode(', ', $skillfilter->linked_skill); ?> 
            @if(count($arrayskill) > 0)
            @foreach($arrayskill as $gt => $gta)
                skillsArray.push('<?php echo $gta; ?>');
            @endforeach
            @endif
        @endif
    @endif
    var skillsselect = $("#linked_skillid").select2({ dataType: 'json', data: skillsArray });
    skillsselect.val(skillsArray).trigger("change");


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
