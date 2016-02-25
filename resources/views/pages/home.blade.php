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
            <form class="form-horizontal" id="modal-post-share-form" role="form" method="POST" action="{{ url('/post/share') }}">
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
<script src="http://maps.googleapis.com/maps/api/js?libraries=places&region=IN" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {
    ComponentsIonSliders.init();
    ComponentsDropdowns.init();
    ComponentsEditors.init();
    UIBootstrapGrowl.init();
    ComponentsjQueryUISliders.init();
    // FormWizard.init();
});


    // preferred loc
    var prefLocationArray = [];

    // preferred loc    
    var plselect = $("#prefered_location").select2();
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


// Skill Tag list
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
