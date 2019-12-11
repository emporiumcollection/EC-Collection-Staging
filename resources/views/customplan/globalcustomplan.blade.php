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
    		            
            <div class="tab-content m-t">
    			<div class="tab-pane active use-padding" id="seasons"> 					
    				<div class="text-right" style="padding: 20px;">
                        <button type="button" class="btn btn-danger b-btn addplan" ><i class="fa fa-plus"></i> Add</button>
                    </div>	
					@if(!empty($customseasons))
                    <table class="table table-striped ">
                        <thead>
                        <tr>
                            <th width="20">Sr no.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Price</th>
                            <th width="160">Action</th>
                        </tr>
                        </thead>
					    {{--*/ $c=1; /*--}}
                        <tbody>
						@foreach($customseasons as $cseason)
                            <tr class="rw-{{$cseason->id}}">
                                <td>{{$c}}</td>
                                <td>{{$cseason->title}}</td>
                                <td>{{$cseason->description}}</td>                                
                                <td>{{$cseason->start_date}}</td>
                                <td>{{$cseason->end_date}}</td>
                                <td>{{$cseason->plan_price}}</td>
                                <td>
                                    <button type="button" class="btn btn-danger b-btn" onclick="edit_cseason_data({{$cseason->id}});"><i class="fa fa-edit"></i> Edit</button>
                                    <button type="button" class="btn btn-danger b-btn" onclick="delete_cseason_data({{$cseason->id}});"><i class="fa fa-trash"></i> Delete</button>
                                </td>
                            </tr>	
							{{--*/ $c++; /*--}}
						@endforeach
                        </tbody>
                    </table>
					@endif
    						 
    			</div>
    		</div>
            
        	<div class="tab-content m-t" style="display: none;">
                <div class="tab-pane active use-padding" id="types">	
                    <div class="sbox  ">
                        <div class="sbox-title">Add Custom Plan</div>
    					<div class="sbox-content"> 
    						<form id="add_custom_plan" class="add_custom_plan">                               
                                <input type="hidden" name="property_id" value="" />
                                <input type="hidden" name="edit_customplan_id" value="" />
    							<div class="row">						
    									
									<div class="form-group col-lg-12">
										<label for="Name">Title </label>
										<input name="plan_title" id="plan_title" type="text" class="form-control" value="" required="required" /> 
									</div> 
									<div class="form-group col-lg-12">
										<label for="Priority">Description </label>
										<textarea name="plan_desc" id="plan_desc" class="form-control"> </textarea> 
									</div>
                                    <div class="form-group col-lg-12">
										<label for="Priority">Terms and condition</label>
										<textarea name="plan_tac" id="plan_tac" class="form-control"> </textarea>
									</div>
                                    <div class="form-group col-lg-6">
										<label for="Priority">Season</label>
										<select name="plan_season[]" id="plan_season" class="select2" multiple="multiple">
                                            <option value="0"> Select </option>
                                            @if(!empty($seasons))
                                                @foreach($seasons as $si)
                                                    <option value="{{$si->id}}">{{$si->season_name}}</option>
                                                @endforeach
                                            @endif                                            
                                        </select>					
									</div>								
							        <div class="form-group col-lg-6">
										<label for="Priority">Start Date</label>
										<input type="text" name="plan_start_date" id="plan_start_date" class="form-control datepic" />
									</div>	
                                    <div class="form-group col-lg-6">
										<label for="Priority">End Date</label>
										<input type="text" name="plan_end_date" id="plan_end_date" class="form-control datepic" />
									</div>
                                    <div class="form-group col-lg-6">
										<label for="Priority">Number of days before early booking showing</label>
										<input type="text" name="plan_no_of_days" id="plan_no_of_days" class="form-control" />
									</div>
                                    
                                    <div class="form-group col-lg-2">
                                        <label for="Priority">Type</label>
                                        <select name="price_type" class="form-control">
                                            <option value="0">Percentage</option>
                                            <option value="1">Fixed</option>
                                        </select>											
									</div>	
                                    <div class="form-group col-lg-4">
										<label for="Priority">Price</label>
										<input type="text" name="plan_price" id="plan_price" class="form-control" />
									</div>
                                    				 
    								<div class="col-lg-12">    									
  										<button type="submit" class="btn btn-success b-btn addCustomPlan"><i class="fa fa-plus"></i> Add</button>    									
    								</div>                                    
    							</div>
    						</form>
    					</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="customplan_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default">
            	
            	<button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            	<h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body" id="sximo-modal-content">
                <form id="modal_add_custom_plan" class="modal_add_custom_plan">                               
                    <input type="hidden" name="modal_property_id" value="" />
                    <input type="hidden" name="modal_edit_customplan_id" id="modal_edit_customplan_id" value="" />
					<div class="row">						
							
						<div class="form-group col-lg-12">
							<label for="Name">Title </label>
							<input name="modal_plan_title" id="modal_plan_title" type="text" class="form-control" value="" required="required" /> 
						</div> 
						<div class="form-group col-lg-12">
							<label for="Priority">Description </label>
							<textarea name="modal_plan_desc" id="modal_plan_desc" class="form-control"> </textarea> 
						</div>
                        <div class="form-group col-lg-12">
							<label for="Priority">Terms and condition</label>
							<textarea name="modal_plan_tac" id="modal_plan_tac" class="form-control"> </textarea>
						</div>
                        <div class="form-group col-lg-6">
							<label for="Priority">Season</label>
							<select name="modal_plan_season[]" id="modal_plan_season" class="select2" multiple="multiple">
                                <option value="0"> Select </option>
                                @if(!empty($seasons))
                                    @foreach($seasons as $si)
                                        <option value="{{$si->id}}">{{$si->season_name}}</option>
                                    @endforeach
                                @endif                                            
                            </select>					
						</div>								
				        <div class="form-group col-lg-6">
							<label for="Priority">Start Date</label>
							<input type="text" name="modal_plan_start_date" id="modal_plan_start_date" class="form-control datepic" />
						</div>	
                        <div class="form-group col-lg-6">
							<label for="Priority">End Date</label>
							<input type="text" name="modal_plan_end_date" id="modal_plan_end_date" class="form-control datepic" />
						</div>
                        <div class="form-group col-lg-6">
							<label for="Priority">Number of days before early booking showing</label>
							<input type="text" name="modal_plan_no_of_days" id="modal_plan_no_of_days" class="form-control" />
						</div>
                        
                        <div class="form-group col-lg-2">
                            <label for="Priority">Type</label>
                            <select name="modal_price_type" id="modal_price_type" class="form-control">
                                <option value="0">Percentage</option>
                                <option value="1">Fixed</option>
                            </select>											
						</div>	
                        <div class="form-group col-lg-4">
							<label for="Priority">Price</label>
							<input type="text" name="modal_plan_price" id="modal_plan_price" class="form-control" />
						</div>
                        <div class="col-lg-12">
                            <div class="smessage"></div>
                        </div>				 
						<div class="col-lg-12 text-right">    									
							<button type="submit" class="btn btn-success b-btn editCustomPlan">Update</button>    									
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
$(document).on('click', '.editCustomPlan', function(){
    $(".editCustomPlan").text('Update');
    $("#modal_add_custom_plan").validate({
        submitHandler: function (form) {
			 editCustomPlan();
			 return false;
		}
    }); 
});
$(document).on('change', '#plan_season', function(){
    console.log("hello");    
});
$(document).on('click', '.addplan', function(e){
    $(".editCustomPlan").text('Add');
    $("#customplan_modal").modal('show');    
});
function editCustomPlan()
{
    $.ajax({
        url: "{{ URL::to('customplan/updatecustomplan')}}",
        type: "post",
        data: $("#modal_add_custom_plan").serializeArray(),
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
function edit_cseason_data(cseasonId){    
    
    if(cseasonId!='' && cseasonId>0)
	{
		$.ajax({
		  url: "{{ URL::to('customplan/editplan')}}",
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
                    $("#modal_edit_customplan_id").val(objplan.id);                    
                    $('#modal_plan_title').val(objplan.title);
                    $('#modal_plan_desc').val(objplan.description);
                    $('#modal_plan_tac').val(objplan.terms_and_condition);
                    $('#modal_plan_start_date').val(objplan.start_date);
                    $('#modal_plan_end_date').val(objplan.end_date);
                    $('#modal_plan_no_of_days').val(objplan.no_of_days);
                    $('#modal_price_type').val(objplan.price_type);
                    $('#modal_plan_price').val(objplan.plan_price); 
                    $('#modal_plan_season').val(objseason); 
                    $('#modal_plan_season').trigger('change'); 
                    $(".editCustomPlan").text('Update');
                    //$('#modal_plan_season').trigger({ type: 'select2:select', params: { data: objseason } });                   
                  }
                  $("#customplan_modal").modal('show');        
		      }    	  
		  }
		});		
	}    
}
function delete_cseason_data(cseasonId)
{
	if(cseasonId!='' && cseasonId>0)
	{
		var conf = confirm("Are you sure? you want to delete this record!");
		if(conf==true)
		{
			$.ajax({
			  url: "{{ URL::to('customplan/deleteplan')}}",
			  type: "post",
			  data: "cseason_Id="+cseasonId,
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
				        $(".rw-"+cseasonId).remove();
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
   
</script>
@stop