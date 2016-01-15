@extends('admin')

@section('content')

	<!-- BEGIN PAGE HEADER-->
	<h3 class="page-title">
	Role, Industry and Functional Area Update
	</h3>
	<!-- END PAGE HEADER-->

	<div class="clearfix"></div>
	<div class="row" style="margin: 20px 0;">
		<div class="col-md-8" style="border: 1px solid lightgrey;">
            <div>
                <label>Industry Functional Area Mapping</label>
                <form action="{{ url('/admin/industryfunctionalArea/upload') }}" id="profile_validation" class="horizontal-form" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-4 col-sm-4" style="border: 1px solid lightgrey;">
                    <div class="form-group">
                        <label>Industry</label><br>                
                            {!! Form::select('Industry', $industry) !!}                
                    </div>
                </div>
                   <div class="col-md-4 col-sm-4" style="border: 1px solid lightgrey;">
                    <div class="form-group">
                        <label>Functional Area</label><br>         
                            {!! Form::select('FunctionalAreas', $functionalAreas) !!}
                    </div>
                </div>
                <div class="col-md-4 col-sm-4" style="margin: 15px 0px;">
                  <button type="submit" class="btn btn-success">Submit</button> 
                </div>
                </form>
            </div>
		</div>
	</div>
    <div class="row" style="margin: 20px 0;">
        <div class="col-md-8" style="border: 1px solid lightgrey;">
             <label>Industry Functional Area Role Mapping</label>
            <form action="{{ url('/admin/indfunctionalRole/upload') }}" id="profile_validation" class="horizontal-form" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-md-4 col-sm-4" style="border: 1px solid lightgrey;">
            <div class="form-group">
                <label>Industry Functional Area</label><br>
               
                    
                    {!! Form::select('Industry_functional_area_mappings', $indfunctionalMapping) !!} 
                    
                
            </div>
        </div>
           <div class="col-md-4 col-sm-4" style="border: 1px solid lightgrey;">
            <div class="form-group">
                <label>Role</label><br>
                
                     {!! Form::select('role', $roles) !!}
               
            </div>
        </div>
           <div class="col-md-4 col-sm-4" style="margin: 15px 0px;">
                  <button type="submit" class="btn btn-success">Submit</button> 
                </div>
        </div>
    </form>
    </div>
    <!-- BEGIN PAGE CONTENT-->
                <div class="row">
                    <div class="col-md-4">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-edit"></i>Role Table
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                    </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config">
                                    </a>
                                    <a href="javascript:;" class="reload">
                                    </a>
                                    <a href="javascript:;" class="remove">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="btn-group">
                                                <button id="role-show" class="btn green">
                                                Add Role <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row role-show">
                                        <form action="{{ url('/admin/role/upload') }}" id="profile_validation" class="horizontal-form" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-md-12">
                                           <!--  <div style="position:relative;">
                                                <input type="text" name="name" id="newskill" class="form-control" placeholder="Search for skill...">
                                                    <button id="add-new-skill" style="position:absolute;right:0;top:0;" class="btn btn-success" type="button"><i class="icon-plus"></i> Add</button>    
                                                    
                                            </div> -->
                                            <div class="form-group">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                   
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-flag" style="color:darkcyan;"></i>
                                                        </span>
                                                        <input type="text" name="name" class="form-control" 
                                                               placeholder="Add Role" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       <div class="margin-top-10" style="margin:0 15px;">
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i> Upload</button>
                                            <a href="" class="btn default">Cancel</a>
                                        </div>
                                    </form>
                                    </div>      
                                </div>
                                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                <thead>
                                <tr>
                                    <th>
                                         Role
                                    </th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>   
                                          {{$role}}    
                                        </td>   
                                    </tr>
                                     @endforeach 
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                    <div class="col-md-4">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-edit"></i>Functional Area Table
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                    </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config">
                                    </a>
                                    <a href="javascript:;" class="reload">
                                    </a>
                                    <a href="javascript:;" class="remove">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="btn-group">
                                                <button id="show-farea" class="btn green">
                                                Add F-Area <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="btn-group pull-right">
                                                <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="javascript:;">
                                                        Print </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                        Save as PDF </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                        Export to Excel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="row show-farea">
                                            <form action="{{ url('/admin/functionalArea/upload') }}" id="profile_validation" class="horizontal-form" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-flag" style="color:darkcyan;"></i>
                                                            </span>
                                                            <input type="text" name="name" class="form-control" 
                                                                   placeholder="Add Functional Area" required>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                       <div class="margiv-top-10" style="margin:0 15px;">
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i> Update</button>
                                            <a href="" class="btn default">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                                </div>
                                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                <thead>
                                <tr>
                                    <th>
                                         Functional Area
                                    </th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($functionalAreas as $functionalarea)
                                    <tr>
                                        <td>   
                                          {{$functionalarea}}    
                                        </td>   
                                    </tr>
                                     @endforeach 
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                    <div class="col-md-4">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-edit"></i>Industry Table
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                    </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config">
                                    </a>
                                    <a href="javascript:;" class="reload">
                                    </a>
                                    <a href="javascript:;" class="remove">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="btn-group">
                                                <button id="show-industry" class="btn green">
                                                Add Industry <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="btn-group pull-right">
                                                <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="javascript:;">
                                                        Print </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                        Save as PDF </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                        Export to Excel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="row show-industry">
                                        <form action="{{ url('/admin/industry/upload') }}" id="profile_validation" class="horizontal-form" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-flag" style="color:darkcyan;"></i>
                                                        </span>
                                                        <input type="text" name="name" class="form-control" 
                                                               placeholder="Add Industry" required>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </div>
                                       <div class="margiv-top-10" style="margin:0 15px;">
                                            <button type="submit" class="btn green"><i class="fa fa-check"></i> Update</button>
                                            <a href="" class="btn default">Cancel</a>
                                        </div>
                                    </form>
                                </div>      
                                </div>
                                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                <thead>
                                <tr>
                                    <th>
                                         Industry
                                    </th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($industry as $industries)
                                    <tr>
                                        <td>   
                                          {{$industries}}    
                                        </td>   
                                    </tr>
                                     @endforeach 
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
                <!-- END PAGE CONTENT -->
		
	<div class="clearfix">
	</div>
	
@stop

@section('javascript')

<script>
$(document).ready(function(){

    jQuery('.role-show').toggle('hide');
    jQuery('#role-show').on('click', function(event) {
        jQuery('.role-show').toggle('show');
    });


    jQuery('.show-farea').toggle('hide');
    jQuery('#show-farea').on('click', function(event) {
        jQuery('.show-farea').toggle('show');
    });


    jQuery('.show-industry').toggle('hide');
    jQuery('#show-industry').on('click', function(event) {
        jQuery('.show-industry').toggle('show');
    });
});


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
                    url: '/roles/rolesSearch',
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
                // var terms = [];
                var termsId = [];
                // $selectedSkills.val(['']).trigger("change");
                // terms = split( $('#linked_skill').val() );
                // var termsId = split( $('#linked_skill_id').val() );
                if($selectedSkills.val() != null){
                    termsId = $selectedSkills.val();
                }
                // console.log(termsId);
                // $selectedSkills = $("#linked_skill_id").select2();
                // remove the current input
                // if(terms.length != null){
                //  terms.pop();
                // }
                if(termsId.length != null){
                    // termsId.pop();
                }
                
                // add the selected item
                // terms.push( ui.item.value );
                termsId.push( ui.item.value );
                $gotit.push( ui.item.value );
                // add placeholder to get the comma-and-space at the end
                // terms.push( "" );
                termsId.push( "" );
                // $('#linked_skill').val(terms.join( ", " ));

                $selectedSkills.val(termsId).trigger("change"); 

                // $('#linked_skill_id').val(termsId.join( ", " ));
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
                  url: "{{ url('roles/addroles') }}",
                  type: "POST",
                  data: { name: name },
                  cache : false,
                  success: function(data){
                    if(data > 0){
                        $newSkillList = new Array();

                        <?php $newSkillList = array(); ?>
                        @foreach($roles as $role)
                            $newSkillList.push('<?php echo $role; ?>');
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
@stop