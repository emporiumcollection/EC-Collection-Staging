@extends('layouts.app')

@section('content')
<style>
    .select2-container-multi .select2-choices{ height: 30px !important;}
</style>
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
        </div>

        <ul class="breadcrumb">
            <li><a href="{{ URL::to('dashboard') }}"> Dashboard </a></li>
            <li class="active">{{ $pageTitle }}</li>
        </ul>
	  
    </div>
 	<div class="page-content-wrapper">
		<div id="formerrors"></div>
        @if(Session::has('message'))	  
		   {{ Session::get('message') }}	   
        @endif	
        		
        <div class="block-content">
    		<ul class="nav nav-tabs" >
    			@if(!empty($tabss))
    				@foreach($tabss as $key=>$val)
    					<li  @if($key == $active) class="active" @endif><a href="{{URL::to('properties_settings/'.$pid.'/'.$key)}}"> {{ $val->tab_name }}  </a></li>
    				@endforeach
    			@endif
    		</ul>
            
            <div class="tab-content m-t">
    			<div class="tab-pane active use-padding" id="seasons"> 					
    				<div class="text-right" style="padding: 20px;">
                        <button type="button" class="btn btn-danger b-btn addboards" ><i class="fa fa-plus"></i> Add</button>
                    </div>	
					@if(!empty($boards))
                    <table class="table table-striped ">
                        <thead>
                        <tr>
                            <th width="50">Sr no.</th>
                            <th>Name</th>
                            <th>Short Name</th>
                            <th>Rack Rate</th>
                            <th>Vat</th>                            
                            <th width="160">Action</th>
                        </tr>
                        </thead>
					    {{--*/ $c=1; /*--}}
                        <tbody>
						@foreach($boards as $si)
                            <tr class="rw-{{$si->id}}">
                                <td>{{$c}}</td>
                                <td>{{$si->board_name}}</td>
                                <td>{{$si->board_shortname}}</td>                                
                                <td>{{$si->board_rackrate}}</td>
                                <td>{{$si->board_vat}}</td>                                
                                <td>
                                    <button type="button" class="btn btn-danger b-btn" onclick="edit_board({{$si->id}});"><i class="fa fa-edit"></i> Edit</button>
                                    <button type="button" class="btn btn-danger b-btn" onclick="delete_board({{$si->id}});"><i class="fa fa-trash"></i> Delete</button>
                                </td>
                            </tr>	
							{{--*/ $c++; /*--}}
						@endforeach
                        </tbody>
                    </table>
					@endif
    						 
    			</div>
    		</div>
            <div style="clear:both"></div>            
        	
        </div>
    </div>
</div>
<div class="modal fade" id="addboard_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default">
            	
            	<button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            	<h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body" id="sximo-modal-content">
                <form id="frm_addboard" class="frm_addboard">                               
                    <input type="hidden" name="property_id" value="{{$pid}}" />
                    <input type="hidden" name="edit_id" id="edit_id" />
					<div class="row">						
							
						<div class="form-group col-lg-12">
							<label for="Name">Name </label>
							<input name="board_name" id="board_name" type="text" class="form-control" value="" required="required" /> 
						</div> 
						<div class="form-group col-lg-12">
							<label for="Priority">Short Name </label>
							<input type="text" name="board_shortname" id="board_shortname" class="form-control" /> 
						</div>
                        <div class="form-group col-lg-12">
							<label for="Priority">Rack Rate</label>
							<input type="text" name="board_rackrate" id="board_rackrate" class="form-control" />
						</div>
                        <div class="form-group col-lg-6">
							<label for="Priority">Vat</label>
							<select name="board_vat" id="board_vat" class="form-control" >
                                <option value="0"> Select </option>
                                @if(!empty($vattaxes))
                                    @foreach($vattaxes as $si)
                                        <option value="{{$si->id}}">{{$si->vat_tax_name}} {{$si->vat_tax_amount}}%</option>
                                    @endforeach
                                @endif                                            
                            </select>					
						</div>	
                        
                        <div class="col-lg-12">
                            <div class="smessage"></div>
                        </div>				 
						<div class="col-lg-12 text-right">    									
							<button type="submit" class="btn btn-success b-btn addboards">Add</button>    									
						</div> 
                                                           
					</div>
				</form>    
            </div>
        
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('.datepic').datepicker({
			numberOfMonths: 2,
			showButtonPanel: true,
			dateFormat: 'yy-mm-dd'
	});
      
});
$(document).on('click', '.addCustomPlan', function(){ console.log("hello");
    $("#add_custom_plan").validate({
        submitHandler: function (form) {
			 saveCustomPlan();
			 return false;
		}
    }); 
});
$(document).on('click', '.addboards', function(){
    //$(".editCustomPlan").text('Update');
    $("#frm_addboard").validate({
        submitHandler: function (form) {
			 addBoard();
			 return false;
		}
    }); 
});
$(document).on('change', '#plan_season', function(){
    console.log("hello");    
});
$(document).on('click', '.addboards', function(e){
    $(".addvattax").text('Add');
    $("#addboard_modal").modal('show');    
});
function addBoard()
{
    $.ajax({
        url: "{{ URL::to('properties/addboard')}}",
        type: "post",
        data: $("#frm_addboard").serializeArray(),
        dataType: "json",
        success: function(data){
            var html = '';
            if(data.status=='error'){
                html +='<div class="alert alert-danger fade in block-inner">';
				html +='<button data-dismiss="alert" class="close" type="button">×</button>';
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".smessage").html(html);	
            }else{
                html +='<div class="alert alert-success fade in block-inner">';
    			html +='<button data-dismiss="alert" class="close" type="button">×</button>';    			
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".smessage").html(html);
                
                $("#addboard_modal").modal('hide');
                window.location.reload();                    
            }        
        }
    });	
}
function saveCustomPlan()
{
    $.ajax({
        url: "{{ URL::to('addcustomplan')}}",
        type: "post",
        data: $("#add_custom_plan").serializeArray(),
        dataType: "json",
        success: function(data){		
            if(data.status=='error'){
            	
            }        
        }
    });	
}
function edit_board(bId){    
    
    if(bId!='' && bId>0)
	{
		$.ajax({
		  url: "{{ URL::to('properties/editboard')}}",
		  type: "get",
		  data: "bid="+bId,
		  dataType: "json",
		  success: function(data){
		      if(data.status=="success"){		          
                  var objboard = data.board;
                  
                  if(typeof objboard!='undefined'){
                    $("#edit_id").val(objboard.id);                    
                    $('#board_name').val(objboard.board_name);
                    $('#board_shortname').val(objboard.board_shortname);
                    $('#board_rackrate').val(objboard.board_rackrate);
                    $('#board_vat').val(objboard.board_vat);
                    
                    $(".addboards").text('Update');
                    //$('#modal_plan_season').trigger({ type: 'select2:select', params: { data: objseason } });                   
                  }
                  
                  $("#addboard_modal").modal('show');        
		      }    	  
		  }
		});		
	}    
}
function delete_board(bId)
{
	if(bId!='' && bId>0)
	{
		var conf = confirm("Are you sure? you want to delete this record!");
		if(conf==true)
		{
			$.ajax({
			  url: "{{ URL::to('properties/deleteboard')}}",
			  type: "post",
			  data: "bId="+bId,
			  dataType: "json",
			  success: function(data){
				  var html ='';
				  if(data.status=='error')
				  {
						html +='<div class="alert alert-danger fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Not Found </div>';
						$('.page-content-wrapper #formerrors').html(html);
						window.scrollTo(0, 0);
				  }
				  else{		
				        $(".rw-"+bId).remove();
						html +='<div class="alert alert-success fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Deleted Successfully </div>';
						$('.page-content-wrapper #formerrors').html(html);
						window.scrollTo(0, 0);
				  }
			  }
			});
		}
	}
}
function edit_gseason_data(cseasonId){    
    
    if(cseasonId!='' && cseasonId>0)
	{
		$.ajax({
		  url: "{{ URL::to('customplan/editglobalplan')}}",
		  type: "get",
		  data: "pid="+cseasonId,
		  dataType: "json",
		  success: function(data){
		      if(data.status=="success"){
		          console.log(data.plan);
                  var objplan = data.plan;
                  var objseason = data.seasons;
                  console.log(objseason);
                  if(typeof objplan!='undefined'){
                    $("#global_edit_customplan_id").val(objplan.id);                    
                    $('#global_plan_title').val(objplan.title);
                    $('#global_plan_desc').val(objplan.description);
                    $('#global_plan_tac').val(objplan.terms_and_condition);
                    $('#global_plan_start_date').val(objplan.start_date);
                    $('#global_plan_end_date').val(objplan.end_date);
                    $('#global_plan_no_of_days').val(objplan.no_of_days);
                    $('#global_price_type').val(objplan.price_type);
                    $('#global_plan_price').val(objplan.plan_price); 
                    $('#global_plan_season').val(objseason); 
                    $('#global_plan_season').trigger('change'); 
                    //$(".editCustomPlan").text('Update');
                    //$('#modal_plan_season').trigger({ type: 'select2:select', params: { data: objseason } });                   
                  }
                  $("#global_customplan_modal").modal('show');        
		      }    	  
		  }
		});		
	}    
}   
$(document).on('click', '.editGlobalCustomPlan', function(){
    //$(".editCustomPlan").text('Update');
    $("#global_add_custom_plan").validate({
        submitHandler: function (form) {
			 editGlobalCustomPlan();
			 return false;
		}
    }); 
});
function editGlobalCustomPlan()
{
    $.ajax({
        url: "{{ URL::to('customplan/updateglobalplan')}}",
        type: "post",
        data: $("#global_add_custom_plan").serializeArray(),
        dataType: "json",
        success: function(data){
            var html = '';
            if(data.status=='error'){
                html +='<div class="alert alert-danger fade in block-inner">';
				html +='<button data-dismiss="alert" class="close" type="button">×</button>';
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".smessage").html(html);	
            }else{
                html +='<div class="alert alert-success fade in block-inner">';
    			html +='<button data-dismiss="alert" class="close" type="button">×</button>';    			
				html +='<i class="icon-checkmark-circle"></i> '+data.msg+' </div>';
				$(".smessage").html(html);
                
                $("#customplan_modal").modal('hide');
                window.location.reload();                    
            }        
        }
    });	
}
</script>
@stop