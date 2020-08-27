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
                        <button type="button" class="btn btn-danger b-btn btnaddboards" ><i class="fa fa-plus"></i> Add</button>
                    </div>	
					@if(!empty($items))
                    <table class="table table-striped ">
                        <thead>
                        <tr>
                            <th width="50">Sr no.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Status</th>                            
                            <th width="160">Action</th>
                        </tr>
                        </thead>
					    {{--*/ $c=1; /*--}}
                        <tbody>
						@foreach($items as $si)
                            <tr class="rw-{{$si->id}}">
                                <td>{{$c}}</td>
                                <td>{{$si->title}}</td>
                                <td>{{$si->description}}</td>                                
                                <td>{{$si->price}}</td>
                                <td>
                                    @if($si->image!=NULL)
                                    <img src="{{URL::to('uploads/customplan_items')}}/{{$si->image}}" width="50px" />
                                    @endif
                                </td> 
                                <td>{{$si->status}}</td>                                
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
                <form id="frm_addboard" class="frm_addboard" enctype="multiform/form-data">                               
                    <input type="hidden" name="property_id" value="{{$pid}}" />
                    <input type="hidden" name="edit_id" id="edit_id" />
					<div class="row">						
							
						<div class="form-group col-lg-12">
							<label for="Name">Title </label>
							<input name="title" id="title" type="text" class="form-control" value="" required="required" /> 
						</div> 
						<div class="form-group col-lg-12">
							<label for="Priority">Description </label>
							<input type="text" name="description" id="description" class="form-control" /> 
						</div>
                        <div class="form-group col-lg-12">
							<label for="Priority">Price</label>
							<input type="text" name="price" id="price" class="form-control" />
						</div>
                        <div class="form-group col-lg-12">
							<label for="Priority">Image</label>
							<input type="file" name="item_img" class="form-control"> 				
						</div>	
                        <div class="form-group col-lg-12">
                            <label for="Vat Tax Status"> Status </label>                                									  
                            <select name="status" id="status" class="form-control">
                                <option value="0" >Inactive</option>
                                <option value="1" >Active</option>
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
<div class="modal fade" id="editboard_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default">
            	
            	<button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            	<h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body" id="sximo-modal-content">
                <form id="frm_editboard" class="frm_editboard" enctype="multiform/form-data">                               
                    <input type="hidden" name="eproperty_id" value="{{$pid}}" />
                    <input type="hidden" name="e_id" id="e_id" />
					<div class="row">						
							
						<div class="form-group col-lg-12">
							<label for="Name">Title </label>
							<input name="etitle" id="etitle" type="text" class="form-control" value="" required="required" /> 
						</div> 
						<div class="form-group col-lg-12">
							<label for="Priority">Description </label>
							<input type="text" name="edescription" id="edescription" class="form-control" /> 
						</div>
                        <div class="form-group col-lg-12">
							<label for="Priority">Price</label>
							<input type="text" name="eprice" id="eprice" class="form-control" />
						</div>
                        <div class="form-group col-lg-12">
							<label for="Priority">Image</label>
							<input type="file" name="eitem_img" class="form-control">
                            <br />
                            <img id="e_img" width="50px" />				
						</div>	
                        <div class="form-group col-lg-12">
                            <label for="Vat Tax Status"> Status </label>                                									  
                            <select name="estatus" id="estatus" class="form-control">
                                <option value="0" >Inactive</option>
                                <option value="1" >Active</option>
                            </select>
					    </div>
                        <div class="col-lg-12">
                            <div class="esmessage"></div>
                        </div>				 
						<div class="col-lg-12 text-right">    									
							<button type="submit" class="btn btn-success b-btn edititems">Add</button>    									
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

$(document).on('click', '.btnaddboards', function(e){
    $("#addboard_modal").modal('show');
});

$(document).on('click', '.addboards', function(){  
    $("#frm_addboard").validate({
        submitHandler: function (form) {
			 addBoard();
			 return false;
		}
    }); 
});

$(document).on('click', '.edititems', function(e){    
    $("#frm_editboard").validate({
        submitHandler: function (form) {
			 editBoard();
			 return false;
		}
    });         
});
function addBoard()
{
    var form = $("#frm_addboard")[0];
    var formData = new FormData(form);
    $.ajax({
        url: "{{ URL::to('customplanitems/additem')}}",
        type: "post",
        data: formData,
        processData: false,
        contentType: false, 
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

function editBoard()
{
    var form = $("#frm_editboard")[0];
    var formData = new FormData(form);
    $.ajax({
        url: "{{ URL::to('customplanitems/updateitem')}}",
        type: "post",
        data: formData,
        processData: false,
        contentType: false, 
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
		  url: "{{ URL::to('customplanitems/edititem')}}",
		  type: "get",
		  data: "bid="+bId,
		  dataType: "json",
		  success: function(data){
		      if(data.status=="success"){		          
                  var objitems = data.items;                  
                  if(typeof objitems!='undefined'){
                    $("#e_id").val(objitems.id);                    
                    $('#etitle').val(objitems.title);
                    $('#edescription').val(objitems.description);
                    $('#eprice').val(objitems.price);
                    $('#estatus').val(objitems.status);
                    $("#e_img").attr('src', "{{Url('/')}}"+"/uploads/customplan_items/"+objitems.image);                    
                    $(".addboards").text('Update');
                                      
                  }
                  
                  $("#editboard_modal").modal('show');        
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
			  url: "{{ URL::to('customplanitems/deleteitem')}}",
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
		          var objplan = data.plan;
                  var objseason = data.seasons;                  
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
                  }
                  $("#global_customplan_modal").modal('show');        
		      }    	  
		  }
		});		
	}    
}   
$(document).on('click', '.editGlobalCustomPlan', function(){    
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