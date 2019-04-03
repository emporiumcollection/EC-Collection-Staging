@extends('layouts.app')

@section('content')

<link href="{{ asset('sximo/css/bookingSys.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>

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
	  <div class="tab-pane active use-padding" id="types">	
		<div class="sbox  "> 
			<div class="sbox-title">@if(!empty($property_data)) {{$property_data->property_name}} @endif <a href="{{URL::to('properties/update/'.$pid)}}" class="tips btn btn-xs btn-primary pull-right" title="" data-original-title="Property Management"><i class="fa fa-edit"></i>&nbsp;Property Management</a></div>
				<div class="sbox-content"> 
					@if(!empty($cat_types))
					{{--*/ $c=1; /*--}}
						@foreach($cat_types as $cat)
							<form id="add_property_type_setup-{{$c}}" class="add_property_type_setup">
								<input type="hidden" name="property_id" value="{{$pid}}" >
								<input type="hidden" name="edit_type_id" value="{{$cat->id}}" >
								<div class="row">
									<div class="col-lg-9">
										<div class="row">
											<div class="form-group col-lg-3">
												<label for="cat_name">Category Name </label>
												<input name="cat_name" id="cat_name" type="text" class="form-control input-sm" value="{{$cat->category_name}}" required="required" /> 
											</div> 
											<div class="form-group col-lg-2">
												<label for="cat_short_name">Short name </label>
												<input name="cat_short_name" id="cat_short_name" type="text" class="form-control input-sm" value="{{$cat->cat_short_name}}" required="required" /> 
											</div>
											<div class="form-group col-lg-3">
												<label for="guests_base_price">Guests incl. in base price</label>
												<input name="guests_base_price" id="guests_base_price" type="text" class="form-control input-sm" value="{{$cat->guests_in_base_price}}" data-rule-number="true" required="required" /> 
											</div>
                                            <div class="form-group col-lg-2">
    											<label for="guests_base_price">Color(reset)</label>
    											<input name="cat_color" id="cat_color" type="text" class="form-control input-sm" value="{{$cat->cat_color}}" /> 
    										</div>    
											<div class="form-group col-lg-2">
												<label for="min_stay">Minimum Stay </label>
												<input name="min_stay" id="min_stay" type="text" class="form-control input-sm" value="{{$cat->minimum_stay}}" data-rule-number="true" /> 
											</div>
										</div>
										<div class="row">
											<div class="form-group col-lg-1">
												<b>Maximum guests: </b>
											</div> 	
											<div class="form-group col-lg-2">
												<label for="guests_total">Total </label>
												<input name="guests_total" id="guests_total" type="text" class="form-control input-sm" value="{{$cat->total_guests}}" data-rule-number="true" required="required" /> 
											</div> 
											<div class="form-group col-lg-2">
												<label for="guests_adult">Adults </label>
												<input name="guests_adult" id="guests_adult" type="text" class="form-control input-sm" value="{{$cat->guests_adults}}" data-rule-number="true" required="required" /> 
											</div>
											<div class="form-group col-lg-2">
												<label for="guests_junior">Juniors</label>
												<input name="guests_junior" id="guests_junior" type="text" class="form-control input-sm" value="{{$cat->guests_juniors}}" data-rule-number="true" required="required" /> 
											</div>
											<div class="form-group col-lg-2">
												<label for="guests_babies">Infants</label>
												<input name="guests_babies" id="guests_babies" type="text" class="form-control input-sm" value="{{$cat->guests_babies}}" data-rule-number="true" required="required" /> 
											</div>
											<div class="form-group col-lg-3">
												<div class="margin-top-10">
													<label class="optionbox">
														<input type="checkbox" name="count_baby" value="1" {{($cat->baby_count==1) ? 'checked="checked"' : ''}} > Infants count toward total
													</label>
												</div>
											</div>
										</div>
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <label for="booingPolicy">Booking Policy</label>
                                                <textarea name="bookingPolicy" cols="4" class="form-control">{{$cat->booking_policy}}</textarea>
                                            </div>
                                        </div>
									</div>
									<div class="col-lg-3 align-right">
										<div class="butt">
											<button type="button" class="btn btn-danger b-btn" onclick="delete_types_tabdata({{$cat->id}},{{$c}});"><i class="fa fa-trash-0"></i> Delete</button>
											<button type="submit" class="btn btn-success b-btn"><i class="fa fa-save"></i> Save</button>
										</div>
										<div class="margin-top-10">
											<label class="optionbox">
												<input type="checkbox" name="show_booking" value="1" {{($cat->show_on_booking==1) ? 'checked="checked"' : ''}} > Show on Booking Platform                
											</label>
										</div>
									</div>
								</div>
							</form>
							{{--*/ $c++; /*--}}
						@endforeach
						<form id="add_property_type_setup-{{$c}}" class="add_property_type_setup">
							<input type="hidden" name="property_id" value="{{$pid}}" >
							<input type="hidden" name="edit_type_id" value="" >
							<div class="row">
								<div class="col-lg-9">
									<div class="row">
										<div class="form-group col-lg-3">
											<label for="cat_name">Category Name </label>
											<input name="cat_name" id="cat_name" type="text" class="form-control input-sm" value="" required="required" /> 
										</div> 
										<div class="form-group col-lg-2">
											<label for="cat_short_name">Short name </label>
											<input name="cat_short_name" id="cat_short_name" type="text" class="form-control input-sm" value="" required="required" /> 
										</div>
										<div class="form-group col-lg-3">
											<label for="guests_base_price">Guests incl. in base price</label>
											<input name="guests_base_price" id="guests_base_price" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" /> 
										</div>
                                        <div class="form-group col-lg-2">
											<label for="guests_base_price">Color(reset)</label>
											<input name="cat_color" id="cat_color" type="text" class="form-control input-sm" value="" /> 
										</div>
										<div class="form-group col-lg-2">
											<label for="min_stay">Minimum Stay </label>
											<input name="min_stay" type="text" class="form-control input-sm" data-rule-number="true" value="" /> 
										</div>
									</div>
									<div class="row">
										<div class="form-group col-lg-1">
											<b>Maximum guests: </b>
										</div> 	
										<div class="form-group col-lg-2">
											<label for="guests_total">Total </label>
											<input name="guests_total" id="guests_total" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" /> 
										</div> 
										<div class="form-group col-lg-2">
											<label for="guests_adult">Adults </label>
											<input name="guests_adult" id="guests_adult" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" /> 
										</div>
										<div class="form-group col-lg-2">
											<label for="guests_junior">Juniors</label>
											<input name="guests_junior" id="guests_junior" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" /> 
										</div>
										<div class="form-group col-lg-2">
											<label for="guests_babies">Infants </label>
											<input name="guests_babies" id="guests_babies" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" /> 
										</div>
										<div class="form-group col-lg-3">
											<div class="margin-top-10">
												<label class="optionbox">
													<input type="checkbox" name="count_baby" value="1"> Infants count toward total
												</label>
											</div>
										</div>
									</div>
                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="booingPolicy">Booking Policy</label>
                                            <textarea name="bookingPolicy" cols="4" class="form-control" ></textarea>
                                        </div>
                                    </div>
								</div>
								<div class="col-lg-3 align-right">
									<div class="butt">
										<button type="submit" class="btn btn-success b-btn"><i class="fa fa-plus"></i> Add</button>
									</div>
									<div class="margin-top-10">
										<label class="optionbox">
											<input type="checkbox" name="show_booking" checked="1" value="1"> Show on Booking Platform                
										</label>
									</div>
								</div>
							</div>
						</form>
					@else
						<form id="add_property_type_setup-1" class="add_property_type_setup">
							<input type="hidden" name="property_id" value="{{$pid}}" >
							<input type="hidden" name="edit_type_id" value="" >
							<div class="row">
								<div class="col-lg-9">
									<div class="row">
										<div class="form-group col-lg-3">
											<label for="cat_name">Category Name </label>
											<input name="cat_name" id="cat_name" type="text" class="form-control input-sm" value="" required="required" /> 
										</div> 
										<div class="form-group col-lg-2">
											<label for="cat_short_name">Short name </label>
											<input name="cat_short_name" id="cat_short_name" type="text" class="form-control input-sm" value="" required="required" /> 
										</div>
										<div class="form-group col-lg-3">
											<label for="guests_base_price">Guests incl. in base price</label>
											<input name="guests_base_price" id="guests_base_price" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" /> 
										</div>
                                        <div class="form-group col-lg-2">
											<label for="guests_base_price">Color(reset)</label>
											<input name="cat_color" id="cat_color" type="text" class="form-control input-sm" value="" /> 
										</div>
										<div class="form-group col-lg-2">
											<label for="min_stay">Minimum Stay </label>
											<input name="min_stay" type="text" class="form-control input-sm" value="" data-rule-number="true" /> 
										</div>
									</div>
									<div class="row">
										<div class="form-group col-lg-1">
											<b>Maximum guests: </b>
										</div> 	
										<div class="form-group col-lg-2">
											<label for="guests_total">Total </label>
											<input name="guests_total" id="guests_total" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" /> 
										</div> 
										<div class="form-group col-lg-2">
											<label for="guests_adult">Adults </label>
											<input name="guests_adult" id="guests_adult" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" /> 
										</div>
										<div class="form-group col-lg-2">
											<label for="guests_junior">Juniors</label>
											<input name="guests_junior" id="guests_junior" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" /> 
										</div>
										<div class="form-group col-lg-2">
											<label for="guests_babies">Infants </label>
											<input name="guests_babies" id="guests_babies" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" /> 
										</div>
										<div class="form-group col-lg-3">
											<div class="margin-top-10">
												<label class="optionbox">
													<input type="checkbox" name="count_baby" value="1"> Infants count toward total
												</label>
											</div>
										</div>
									</div>
                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="booingPolicy">Booking Policy</label>
                                            <textarea name="bookingPolicy" cols="4" class="form-control" ></textarea>
                                        </div>
                                    </div>
								</div>
								<div class="col-lg-3 align-right">
									<div class="butt">
										<button type="submit" class="btn btn-success b-btn"><i class="fa fa-plus"></i> Add</button>
									</div>
									
									<div class="margin-top-10">
										<label class="optionbox">
											<input type="checkbox" name="show_booking" checked="1" value="1"> Show on Booking Platform                
										</label>
									</div>
								</div>
							</div>
						</form>
					@endif
				</div>
			</div>	 
		</div>
	  </div>
	</div>	
</div>

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
			  url: "{{ URL::to('add_property_type')}}",
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
					{
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
						html +='<div class="row">';
						html +='<div class="form-group col-lg-3">';
						html +='<label for="cat_name">Category Name </label>';
						html +='<input name="cat_name" id="cat_name" type="text" class="form-control input-sm" value="" required="required" />'; 
						html +='</div>'; 
						html +='<div class="form-group col-lg-3">';
						html +='<label for="cat_short_name">Short name </label>';
						html +='<input name="cat_short_name" id="cat_short_name" type="text" class="form-control input-sm" value="" required="required" />'; 
						html +='</div>';
						html +='<div class="form-group col-lg-3">';
						html +='<label for="guests_base_price">Guests incl. in base price</label>';
						html +='<input name="guests_base_price" id="guests_base_price" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" />'; 
						html +='</div>';
						html +='<div class="form-group col-lg-3">';
						html +='<label for="min_stay">Minimum Stay </label>';
						html +='<input name="min_stay" id="min_stay" type="text" class="form-control input-sm" value="" data-rule-number="true" />'; 
						html +='</div>';
						html +='</div>';
						html +='<div class="row">';
						html +='<div class="form-group col-lg-1">';
						html +='<b>Maximum guests: </b>';
						html +='</div>'; 	
						html +='<div class="form-group col-lg-2">';
						html +='<label for="guests_total">Total </label>';
						html +='<input name="guests_total" id="guests_total" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" />'; 
						html +='</div>'; 
						html +='<div class="form-group col-lg-2">';
						html +='<label for="guests_adult">Adults </label>';
						html +='<input name="guests_adult" id="guests_adult" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" />'; 
						html +='</div>';
						html +='<div class="form-group col-lg-2">';
						html +='<label for="guests_junior">Juniors</label>';
						html +='<input name="guests_junior" id="guests_junior" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" />'; 
						html +='</div>';
						html +='<div class="form-group col-lg-2">';
						html +='<label for="guests_babies">Infants </label>';
						html +='<input name="guests_babies" id="guests_babies" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" />'; 
						html +='</div>';
						html +='<div class="form-group col-lg-3">';
						html +='<div class="margin-top-10">';
						html +='<label class="optionbox">';
						html +='<input type="checkbox" name="count_baby" value="1"> Infants count toward total';
						html +='</label>';
						html +='</div>';
						html +='</div>';
						html +='</div>';
						html +='</div>';
						html +='<div class="col-lg-3 align-right">';
						html +='<div class="butt">';
						html +='<button type="submit" class="btn btn-success b-btn"><i class="fa fa-plus"></i> Add</button>';
						html +='</div>';
						html +='<div class="margin-top-10">';
						html +='<label class="optionbox">';
						html +='<input type="checkbox" name="show_booking" checked="1" value="1"> Show on Booking Platform';       
						html +='</label>';
						html +='</div>';
						html +='</div>';
						html +='</div>';
						html +='</form>';
						$('#'+formid).after(html);
						$('#'+splt[0]+'-'+newid).find('input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_square-green'});
						
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
				  url: "{{ URL::to('delete_property_type')}}",
				  type: "post",
				  data: "cat_id="+catId,
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
							$('#add_property_type_setup-'+formid).remove();
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
