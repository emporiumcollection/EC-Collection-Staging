@extends('users_admin.metronic.layouts.app')

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('events')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Event Management System </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('events')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Events </span> 
        </a> 
    </li>    
    @if(!empty($event_data))  
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> {{$event_data->title}} </span> 
        </a> 
    </li>
    @endif
    
@stop

@section('content')  
    
    <div class="row">
    
        @if(Session::has('message'))	  
		   {{ Session::get('message') }}	   
	    @endif
                
        <div class="col-xs-12 col-lg-12">
            <ul>
        		@foreach($errors->all() as $error)
        			<li>{{ $error }}</li>
        		@endforeach
        	</ul>
        </div>
                
        <!--begin::Portlet-->
		<div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							@if(!empty($event_data)) {{$event_data->title}} @endif
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				
                @include('users_admin/supplier/events/config_tab')
                
				<div class="tab-content">
					<div class="tab-pane active">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3 class="main-heading">Add Ticket Type</h3>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                                   <div class="m-alert__icon">
                                        <i class="flaticon-exclamation-1"></i>
                                        <span></span>
                                   </div>
                                   <div class="m-alert__text">                
                                        {{ Lang::get('hotel-property.type-info')}}
                                   </div>
                                </div>
                            </div>
                        </div>
                        
                            
                        
                        
						@if(!empty($cat_types))
					   {{--*/ $c=1; /*--}}
                        <div class="col-sm-12 col-md-12 col-lg-12 fun-bg-gray">
                            <form id="add_property_type_setup-{{$c}}" class="add_property_type_setup" method="post">
    							<input type="hidden" name="property_id" value="{{$pid}}" >
    							<input type="hidden" name="edit_type_id" value="" >
    							<div class="row">
    								<div class="col-lg-9">
    									
    										<div class="form-group">
    											<label for="cat_name"> Ticket Name </label>
    											<input name="cat_name" id="cat_name" type="text" class="form-control input-sm" value="" required="required" /> 
    										</div>    										
    									
											<div class="form-group">
                                                <label for="Status" class="text-right"> Status </label>
                                                <div class="radio">									  
                                                    <label class='radio radio-inline'>
                                                        <input type='radio' name='status' value ='0' required > Inactive 
                                                    </label>
                                                    <label class='radio radio-inline'>
					                                   <input type='radio' name='status' value ='1' required > Active 
                                                    </label> 
									            </div>									 
								            </div>
                                                                          
    								</div>
                                    <div class="col-lg-3 m--align-right">
    									<div class="butt">
    										<button type="submit" class="btn btn-success b-btn"><i class="fa fa-plus"></i> Add</button>
    									</div>									
    								</div>    								
    							</div>
    						</form>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 gray-seprator"></div>
                        <div class="content-block">
                        @if(!empty($cat_types))                                                
						@foreach($cat_types as $cat)
                            <div class="alt-bg">
							<form id="add_property_type_setup-{{$c}}" class="add_property_type_setup" method="post">
								<input type="hidden" name="property_id" value="{{$pid}}" >
								<input type="hidden" name="edit_type_id" value="{{$cat->id}}" >
								<div class="row ">
									<div class="col-lg-9">
										
										<div class="form-group">
											<label for="cat_name"> Ticket Name </label>
											<input name="cat_name" id="cat_name" type="text" class="form-control input-sm" value="{{$cat->name}}" required="required" /> 
										</div>									
										<div class="form-group">
                                            <label for="Status"> Status </label>
                                            <div class="radio">									  
                                                <label class='radio radio-inline'>
                                                    <input type='radio' name='status' value ='0' required @if($cat->status == '0') checked="checked" @endif > Inactive 
                                                </label>
                                                <label class='radio radio-inline'>
				                                   <input type='radio' name='status' value ='1' required @if($cat->status == '1') checked="checked" @endif > Active 
                                                </label> 
								            </div>									 
							            </div>
                                                                                 
									</div>
									<div class="col-lg-3  m--align-right">
										<div class="butt">
											<button type="button" class="btn btn-danger b-btn" onclick="delete_types_tabdata({{$cat->id}},{{$c}});"><i class="fa fa-trash-0"></i> Delete</button>
											<button type="submit" class="btn btn-success b-btn"><i class="fa fa-save"></i> Save</button>
										</div>										
									</div>
								</div>
							</form>
                            </div>
							{{--*/ $c++; /*--}}
						@endforeach
                        @endif                                                
                        </div>	
                    @else
						<form id="add_property_type_setup-1" class="add_property_type_setup fun-bg-gray" method="post">
							<input type="hidden" name="property_id" value="{{$pid}}" >
							<input type="hidden" name="edit_type_id" value="" >
							<div class="row">
								<div class="col-lg-9">									
									<div class="form-group">
										<label for="cat_name"> Ticket Name </label>
										<input name="cat_name" id="cat_name" type="text" class="form-control input-sm" value="" required="required" /> 
									</div>										
								
									<div class="form-group">
                                        <label for="Status"> Status </label>
                                        <div class="radio">									  
                                            <label class='radio radio-inline'>
                                                <input type='radio' name='status' value ='0' required /> Inactive 
                                            </label>
                                            <label class='radio radio-inline'>
			                                    <input type='radio' name='status' value ='1' required /> Active 
                                            </label> 
							            </div>									 
						            </div>                                   
								</div>
								<div class="col-lg-3 m--align-right">
									<div class="butt">
										<button type="submit" class="btn btn-success b-btn"><i class="fa fa-plus"></i> Add</button>
									</div>									
								</div>
							</div>
						</form>
    					    				
					@endif
					</div>
				</div>
			</div>
		</div>
		<!--end::Portlet-->
    </div>
@stop

{{-- For custom style  --}}
@section('style')
    @parent
    <style>
        
    </style>
@endsection
@section('custom_js_script')
<script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<script>

$(document).ready(function () {

     /*$(".add_property_type_setup").validate({
		 errorPlacement: function(error, element) {
			// Append error within linked label
			$( element ).closest( "form" ).find( "label[for='" + element.attr( "id" ) + "']" ).addClass( 'lerror' );
		},
		 submitHandler: function (form) {
            // save_types_tabdata(formid);
             return false; // required to block normal submit since you used ajax
         }
     });*/
	$(document).on('click', '.btn', function (){
		 var frmid = $(this).parents('form.add_property_type_setup').attr('id');
		  $('#'+frmid).validate({
			submitHandler: function (form) {
				 save_types_tabdata(frmid);
				 return false; // required to block normal submit since you used ajax
			 }
		 });
	 });
});	
	function save_types_tabdata(formid)
	{
		if(formid!='')
		{
			$.ajax({
			  url: "{{ URL::to('add_event_type')}}",
			  type: "post",
			  data: $('#'+formid).serializeArray(),
			  dataType: "json",
			  success: function(data){
				var html = '';
				if(data.status=='error')
				{
					html +='<ul class="parsley-error-list">';
					$.each(data.errors, function(idx, obj) {
						html +='<li>'+obj+'</li>';
					});
					html +='</ul>';
					$('.page-content-wrapper #formerrors').html(html);
					window.scrollTo(0, 0);
				}
				else
				{
					if(data.type=='update')
					{
						html +='<div class="alert alert-success fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Updated Successfully </div>';
						$('.page-content-wrapper #formerrors').html(html);
						window.scrollTo(0, 0);
					}
					else
					{ console.log("hello");
						splt = formid.split('-');
						newid = parseInt(splt[1]) + 1;
						
						$('#'+formid+' .butt button').remove();
						var remBut = '<button type="button" class="btn btn-danger b-btn" onclick="delete_types_tabdata('+data.category.id+','+splt[1]+');"><i class="fa fa-trash-0"></i> Delete</button> <button type="submit" class="btn btn-success b-btn"><i class="fa fa-save"></i> Save</button>';
						$('#'+formid+' .butt').html(remBut);
						
						$('#'+formid+' input[name="edit_type_id"]').val(data.category.id);
						
						html +='<form id="'+splt[0]+'-'+newid+'" class="add_property_type_setup">';
						html +='<input type="hidden" name="property_id" value="{{$pid}}" >';
						html +='<input type="hidden" name="edit_type_id" value="" >';
						html +='<div class="row">';
						html +='<div class="col-lg-9">'; 
						
                        
                        //html +='            <div class="row">';
                        html +='                <div class="form-group">';
    					html +='			        <label for="name"> Ticket Name </label>';
                        //html +='                    <div class="col-lg-9">';
    					html +='					    <input name="cat_name" id="cat_name" type="text" class="form-control input-sm" required="required" />'; 
                        //html +='                    </div>';
    					html +='				</div>';	
                        //html +='            </div>';
                        //html +='            <div class="row">';							
    					html +='				<div class="form-group">';
                        html +='                    <label for="Status"> Status </label>';
                        html +='                    <div class="radio">';								  
                        html +='                        <label class="radio radio-inline">';
                        html +='                        <input type="radio" name="status" value ="0" required > Inactive';
                        html +='                        </label>';
                        html +='                        <label class="radio radio-inline">';
    			        html +='                           <input type="radio" name="status" value ="1" required > Active ';
                        html +='                        </label>'; 
    					html +='		            </div>';									 
    					html +='	            </div>';
                        //html +='            </div>';			
                        
                        
						html +='</div>';
						html +='<div class="col-lg-3 align-right">';
						html +='<div class="butt">';
						html +='<button type="submit" class="btn btn-success b-btn"><i class="fa fa-plus"></i> Add</button>';
						html +='</div>';
						
						html +='</div>';
                        
                        html +='<div class="col-lg-12">';
                        html +='<hr />';
                        html +='</div>';
                        
						html +='</div>';
						html +='</form>';
						$('#'+formid).after(html);
						$('#'+splt[0]+'-'+newid).find('input[type="radio"]').iCheck({radioClass: 'iradio_square-green'});
						
						var htmli = '';
						htmli +='<div class="alert alert-success fade in block-inner">';
						htmli +='<button data-dismiss="alert" class="close" type="button">×</button>';
						htmli +='<i class="icon-checkmark-circle"></i> Record Inserted Successfully </div>';
						$('.page-content-wrapper #formerrors').html(htmli);
						 window.scrollTo(0, 0);
					}
				}
			  }
			});
		}
	}
	
	function delete_types_tabdata(catId,formid)
	{ 
		if(catId!='' && catId>0)
		{
			var conf = confirm("Are you sure? you want to delete this record!");
			if(conf==true)
			{
				$.ajax({
				  url: "{{ URL::to('delete_event_ticket_type')}}",
				  type: "post",
				  data: "cat_id="+catId,
				  dataType: "json",
				  success: function(data){
					  var html ='';
					  if(data.status=='error')
					  {
							html +='<div class="alert alert-danger fade in block-inner">';
							html +='<button data-dismiss="alert" class="close" type="button">Ã—</button>';
							html +='<i class="icon-checkmark-circle"></i> Record Not Found </div>';
							$('.page-content-wrapper #formerrors').html(html);
                            toastr.error("Record Not Found");
							window.scrollTo(0, 0);
					  }
					  else{
							$('#add_property_type_setup-'+formid).remove();
							html +='<div class="alert alert-success fade in block-inner">';
							html +='<button data-dismiss="alert" class="close" type="button">Ã—</button>';
							html +='<i class="icon-checkmark-circle"></i> Record Deleted Successfully </div>';
							$('.page-content-wrapper #formerrors').html(html);
                            toastr.success("Record Deleted Successfully");
							window.scrollTo(0, 0);
					  }
				  }
				});
			}
		}
	}
</script>
@stop
