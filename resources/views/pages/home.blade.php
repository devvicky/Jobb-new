@extends('master')

@section('content')

  @include('partials.home.home')

@stop

@section('javascript')

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56afb9b6a3affa13" async="async">
</script>

<!-- 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-528ddbdf4d9dd13d" async="async">
</script> 
-->

<script src="/assets/admin/pages/scripts/components-dropdowns.js"></script>
<script src="/assets/js/home-js.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?libraries=places&region=IN" type="text/javascript"></script>

<script>
jQuery(document).ready(function() {       
  ComponentsIonSliders.init();    
  ComponentsDropdowns.init();
  ComponentsEditors.init();
  UIBootstrapGrowl.init();
    // FormWizard.init();
}); 


//Auto Complete city 
function initializeCity() {
    var options = { types: ['(cities)'], componentRestrictions: {country: "in"}};
    var input = document.getElementById('city');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', onPlaceChanged);
    function onPlaceChanged() {
      var place = autocomplete.getPlace();
      if (place.address_components) { 
        city = place.address_components[0];
        document.getElementById('city').value = city.long_name;
      } else { document.getElementById('autocomplete').placeholder = 'Enter a city'; }
    }
  }
   google.maps.event.addDomListener(window, 'load', initializeCity);   


    // preferred loc
    var prefLocationArray = [];
    var plselect = $("#prefered_location").select2();
    if(document.getElementById('prefered_location').value != null){
      prefLocationArray.push(document.getElementById('prefered_location').value);
    }

    var $eventSelect = $("#prefered_location"); 
  $eventSelect.on("select2:unselect", function (e) {
    console.log(e.params.data.id);
    prefLocationArray = $.grep(prefLocationArray, function(value) {
      return value != e.params.data.id;
    });
  });

    var prefLoc = $("#pref_loc");
  function initPrefLoc() {
    var options = { types: ['(cities)'], componentRestrictions: {country: "in"}};
    var input = document.getElementById('pref_loc');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', onPlaceChanged);

    function onPlaceChanged() {
      var place = autocomplete.getPlace();
      if (place.address_components) { 
        pref_loc_city = place.address_components[0].long_name;
        if(place.address_components.length == 3){         
          pref_loc_state = '('+place.address_components[1].long_name+')';
        }else if(place.address_components.length == 4){
          pref_loc_state = '('+place.address_components[2].long_name+')';
        }else{
          pref_loc_state = '';
        }
        setTimeout(function(){ prefLoc.val(''); prefLoc.focus();},0);
        var selectedLoc = document.getElementById('prefered_location').value;
        if(selectedLoc == ''){  
          selectedLoc = selectedLoc + pref_loc_city+pref_loc_state;
          prefLocationArray.push(pref_loc_city+pref_loc_state);
        }else{
          selectedLoc = selectedLoc + ', '+pref_loc_city+pref_loc_state;
          prefLocationArray.push(pref_loc_city+pref_loc_state);
        }
        console.log(prefLocationArray);
        document.getElementById('prefered_location').value = selectedLoc;
      
      
        
        $("#prefered_location").select2({
            dataType: 'json',
            data: prefLocationArray
          });
          plselect.val(prefLocationArray).trigger("change"); 


        // console.log(place);
      } else { 
        document.getElementById('autocomplete').placeholder = 'Your preferred location'; 
      }
    }

  }
   google.maps.event.addDomListener(window, 'load', initPrefLoc);


  function pref_loc_locality(){
    var selected_pref_locations = (document.getElementById('prefered_location').value).split(',');
    var selected_pref_locality = (document.getElementById('preferred_locality').value).split(',');
    if(prefLocationArray.length == 1){
      document.getElementById("prefered_location").disabled = false;
      document.getElementById("pref_locality").disabled = false;
      document.getElementById("pref_locality").value = '';
    }else if(prefLocationArray.length > 1){
      document.getElementById("prefered_location").disabled = false;
      document.getElementById("pref_locality").disabled = true;
      document.getElementById("preferred_locality").disabled = true;
      prefLocalityArray = [];
      // plocalselect.val(prefLocalityArray).trigger("change");
      document.getElementById("pref_locality").value = 'Can\'t select locality for multiple location';
    }else if(document.getElementById('prefered_location').value == ''){
      document.getElementById("pref_locality").disabled = true;
      prefLocalityArray = [];
      // plocalselect.val(prefLocalityArray).trigger("change"); 
      document.getElementById("pref_locality").value = 'Select one preferred location.';
      document.getElementById("preferred_locality").disabled = true;
    }

    if(document.getElementById('preferred_locality').value == ''){
      document.getElementById("preferred_locality").disabled = true;
    }else if(prefLocalityArray.length >= 1 && prefLocationArray.length == 1){
      document.getElementById("preferred_locality").disabled = false;
    }else{
      document.getElementById("preferred_locality").disabled = true;
    }
  }

  
  var prefLocalityArray = [];
    var plocalselect = $("#preferred_locality").select2();
  var prefLoc2 = $("#pref_locality");
  function initializePrefLocality() {
    var options = { types: ['(regions)'], componentRestrictions: {country: "in"} };
    var input = document.getElementById('pref_locality');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', onPlaceChanged);
    function onPlaceChanged() {
      var place2 = autocomplete.getPlace();
      if (place2.address_components) { 
        var pref_locality = place2.address_components[0].long_name;

        setTimeout(function(){ prefLoc2.val(''); prefLoc2.focus();},0);
        var selectedLocality = document.getElementById('preferred_locality').value;
        if(selectedLocality == ''){
          selectedLocality = selectedLocality + pref_locality;
          prefLocalityArray.push(selectedLocality);
        }else{
          selectedLocality = selectedLocality + ', '+pref_locality;
          prefLocalityArray.push(selectedLocality);
        } 
        console.log(prefLocalityArray);     
        document.getElementById('preferred_locality').value = selectedLocality;
        pref_loc_locality();
        $("#preferred_locality").select2({
            dataType: 'json',
            data: prefLocalityArray
          });
          // plocalselect.val(prefLocalityArray).trigger("change"); 
        // console.log(place2);
      } else { document.getElementById('pref_locality').placeholder = 'select some locality'; }
    }
  }
   google.maps.event.addDomListener(window, 'load', initializePrefLocality); 


// Skill Tag list

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
    $('#add-new-skill').live('click',function(event){       
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
            url: "{{ url('job/newskill') }}",
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
  });

</script>
<style type="text/css">
.pagination{
	display: none;
}
#infscr-loading{
    text-align: center;
    display: block;
    clear: both;
    padding: 10px 0;
}
</style>
<script src = "/assets/js/jquery.infinitescroll.min.js"></script>
<script src = "/assets/js/myinfinite.js"></script>
@stop