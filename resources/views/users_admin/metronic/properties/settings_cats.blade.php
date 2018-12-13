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
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Reservation & Distribution </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Properties </span> 
        </a> 
    </li>
    @if(!empty($property_data))
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> {{ucfirst($property_data->property_name)}}  </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> {{ucfirst(str_replace('_', ' ', $active))}} </span> 
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
        
        <div class="col-sm-4 col-md-4 col-lg-4">
            @if(!empty($property_data)) {{$property_data->property_name}} @endif 
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8">
            
            <a href="{{URL::to('properties/update/'.$pid)}}" class="tips btn btn-xs btn-primary pull-right" title="" data-original-title="Property Management"><i class="fa fa-edit"></i>&nbsp;Property Management</a>
            
            <a href="{{URL::to('flipviewpdf/Emporium-Voyage-Add-Category-help.pdf')}}" class="tips btn btn-xs btn-primary pull-right" title="" data-original-title="Add Category" style="margin-right: 10px;" target="_blank"><i class="fa fa-edit"></i>&nbsp;View Documentation</a>
        </div>
        
        <!--begin::Portlet-->
		<div class="m-portlet">
            <div class="m-portlet__head">				
				<div class="m-portlet__head-tools margin-left-98">
					<ul class="m-portlet__nav bg-gray">
						<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
							<a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
								<i class="fa fa-bars m--font-light"></i>
							</a>
							<div class="m-dropdown__wrapper" style="z-index: 101;">
								<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 18px;"></span>
								<div class="m-dropdown__inner">
									<div class="m-dropdown__body">
										<div class="m-dropdown__content">
											<ul class="m-nav">
												<li class="m-nav__section m-nav__section--first">
													<span class="m-nav__section-text">
														Quick Actions
													</span>
												</li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties/update/2309?return=" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Hotel/Property
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/types" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Room Types
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/rooms" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Rooms
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/seasons" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Seasons
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/calendar" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Reservation Management
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/price" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Price
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/property_documents" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Property Documents
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/property_images" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Images
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/properties_settings/2309/gallery_images" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Galleries
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="http://localhost:8181/emporium-staging-forge/public/advertising" class="m-nav__link">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Become Featured
														</span>
													</a>
											    </li> 
                                                <li class="m-nav__item">
													<a href="https://emporium-collection.com/" class="m-nav__link" target="_blank">
														<i class="m-nav__link-icon"></i>
														<span class="m-nav__link-text">
															Get Help
														</span>
													</a>
											    </li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="m-portlet__body">
				<ul class="nav nav-tabs" role="tablist">
                    @if(!empty($tabss))
        				@foreach($tabss as $key=>$val)
        					<li class="nav-item"> 
                                <a class="nav-link @if($key == $active) active @endif" href="{{URL::to('properties_settings/'.$pid.'/'.$key)}}"> {{ $val->tab_name }} </a>
                            </li>
        				@endforeach
        			@endif					
				</ul>
				<div class="tab-content">
					<div class="tab-pane active">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3 class="main-heading">{{ Lang::get('hotel-property.type-heading')}}</h3>
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
    										<div class="form-group col-lg-3">
    											<label for="cat_short_name">Short name </label>
    											<input name="cat_short_name" id="cat_short_name" type="text" class="form-control input-sm" value="" required="required" /> 
    										</div>
    										<div class="form-group col-lg-3">
    											<label for="guests_base_price">Guests incl. in base price</label>
    											<input name="guests_base_price" id="guests_base_price" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" /> 
    										</div>
    										<div class="form-group col-lg-3">
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
    											<label for="guests_babies">Babies </label>
    											<input name="guests_babies" id="guests_babies" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" /> 
    										</div>
    										<div class="form-group col-lg-3">
                                                <label for="babies_count_toward_total">Babies count toward total </label>
    											<div class="margin-top-10">
                                                    <div class="m-checkbox-inline">
            											<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
            												<input type="checkbox" name="count_baby" value="1">
            												<span></span>
            											</label>
            										</div>
    											</div>
    										</div>
    									</div>
    								</div>
    								<div class="col-lg-3  m--align-right">
    									<div class="butt">
    										<button type="submit" class="btn btn-success b-btn"><i class="fa fa-plus"></i> Add</button>
    									</div>
    									<div class="margin-top-10">										
                                            <div class="m-checkbox-inline">
    											<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
    												<input type="checkbox" name="show_booking" checked="1" value="1"> Show on Booking Platform
    												<span></span>
    											</label>
    										</div>
    									</div>
    								</div>
    							</div>
    						</form>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 gray-seprator"></div>
                        <div class="content-block">
						@foreach($cat_types as $cat)
                            <div class="alt-bg">
							<form id="add_property_type_setup-{{$c}}" class="add_property_type_setup">
								<input type="hidden" name="property_id" value="{{$pid}}" >
								<input type="hidden" name="edit_type_id" value="{{$cat->id}}" >
								<div class="row ">
									<div class="col-lg-9">
										<div class="row">
											<div class="form-group col-lg-3">
												<label for="cat_name">Category Name </label>
												<input name="cat_name" id="cat_name" type="text" class="form-control input-sm" value="{{$cat->category_name}}" required="required" /> 
											</div> 
											<div class="form-group col-lg-3">
												<label for="cat_short_name">Short name </label>
												<input name="cat_short_name" id="cat_short_name" type="text" class="form-control input-sm" value="{{$cat->cat_short_name}}" required="required" /> 
											</div>
											<div class="form-group col-lg-3">
												<label for="guests_base_price">Guests incl. in base price</label>
												<input name="guests_base_price" id="guests_base_price" type="text" class="form-control input-sm" value="{{$cat->guests_in_base_price}}" data-rule-number="true" required="required" /> 
											</div>
											<div class="form-group col-lg-3">
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
												<label for="guests_babies">Babies </label>
												<input name="guests_babies" id="guests_babies" type="text" class="form-control input-sm" value="{{$cat->guests_babies}}" data-rule-number="true" required="required" /> 
											</div>
											<div class="form-group col-lg-3">
                                                <label for="babies_count_toward_total">Babies count toward total </label>
												<div class="margin-top-10">
                                                    <div class="m-checkbox-inline">
            											<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
            												<input type="checkbox" name="count_baby" value="1" {{($cat->baby_count==1) ? 'checked="checked"' : ''}}> 
            												<span></span>
            											</label>
            										</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3  m--align-right">
										<div class="butt">
											<button type="button" class="btn btn-danger b-btn" onclick="delete_types_tabdata({{$cat->id}},{{$c}});"><i class="fa fa-trash-0"></i> Delete</button>
											<button type="submit" class="btn btn-success b-btn"><i class="fa fa-save"></i> Save</button>
										</div>
										<div class="margin-top-10">											
                                            <div class="m-checkbox-inline">
    											<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
    												<input type="checkbox" name="show_booking" value="1" {{($cat->show_on_booking==1) ? 'checked="checked"' : ''}}> Babies count toward total
    												<span></span>
    											</label>
    										</div>
										</div>
									</div>
								</div>
							</form>
                            </div>
							{{--*/ $c++; /*--}}
						@endforeach
                        </div>	
                    @else
						<form id="add_property_type_setup-1" class="add_property_type_setup fun-bg-gray">
							<input type="hidden" name="property_id" value="{{$pid}}" >
							<input type="hidden" name="edit_type_id" value="" >
							<div class="row">
								<div class="col-lg-9">
									<div class="row">
										<div class="form-group col-lg-3">
											<label for="cat_name">Category Name </label>
											<input name="cat_name" id="cat_name" type="text" class="form-control input-sm" value="" required="required" /> 
										</div> 
										<div class="form-group col-lg-3">
											<label for="cat_short_name">Short name </label>
											<input name="cat_short_name" id="cat_short_name" type="text" class="form-control input-sm" value="" required="required" /> 
										</div>
										<div class="form-group col-lg-3">
											<label for="guests_base_price">Guests incl. in base price</label>
											<input name="guests_base_price" id="guests_base_price" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" /> 
										</div>
										<div class="form-group col-lg-3">
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
											<label for="guests_babies">Babies </label>
											<input name="guests_babies" id="guests_babies" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" /> 
										</div>
										<div class="form-group col-lg-3">
                                            <label for="babies_count_toward_total">Babies count toward total </label>
											<div class="margin-top-10">												
                                                <div class="m-checkbox-inline">
        											<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
        												<input type="checkbox" name="count_baby" value="1">
        												<span></span>
        											</label>
        										</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 m--align-right">
									<div class="butt">
										<button type="submit" class="btn btn-success b-btn"><i class="fa fa-plus"></i> Add</button>
									</div>
									
									<div class="margin-top-10">										
                                        <div class="m-checkbox-inline">
											<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
												<input type="checkbox" name="show_booking" checked="1" value="1"> Show on Booking Platform
												<span></span>
											</label>
										</div>
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
                        toastr.success('Record Updated Successfully');
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
						html +='<label for="guests_babies">Babies </label>';
						html +='<input name="guests_babies" id="guests_babies" type="text" class="form-control input-sm" value="" data-rule-number="true" required="required" />'; 
						html +='</div>';
						html +='<div class="form-group col-lg-3">';
						html +='<div class="margin-top-10">';
						//html +='<label class="optionbox">';
						//html +='<input type="checkbox" name="count_baby" value="1"> Babies count toward total';
						//html +='</label>';
                        
                        html +='<div class="m-checkbox-inline">';
						html +='<label class="m-checkbox m-checkbox--solid m-checkbox--brand">';
						html +='<input type="checkbox" name="count_baby" value="1"> Babies count toward total';
						html +='<span></span>';
						html +='</label>';
						html +='</div>';
                        
                        
						html +='</div>';
						html +='</div>';
						html +='</div>';
						html +='</div>';
						html +='<div class="col-lg-3 m--align-right">';
						html +='<div class="butt">';
						html +='<button type="submit" class="btn btn-success b-btn"><i class="fa fa-plus"></i> Add</button>';
						html +='</div>';
						html +='<div class="margin-top-10">';
						//html +='<label class="optionbox">';
						//html +='<input type="checkbox" name="show_booking" checked="1" value="1"> Show on Booking Platform';       
						//html +='</label>';
                        
                        html +='<div class="m-checkbox-inline">';
						html +='<label class="m-checkbox m-checkbox--solid m-checkbox--brand">';
						html +='<input type="checkbox" name="show_booking" checked="1" value="1"> Show on Booking Platform';  
						html +='<span></span>';
						html +='</label>';
						html +='</div>';
                        
						html +='</div>';
						html +='</div>';
						html +='</div>';
						html +='</form>';
						$('#'+formid).after(html);
						//$('#'+splt[0]+'-'+newid).find('input[type="checkbox"]').iCheck({checkboxClass: 'icheckbox_square-green'});
                        $('#'+splt[0]+'-'+newid).find('input[type="checkbox"]');
						
						var htmli = '';
						htmli +='<div class="alert alert-success fade in block-inner">';
						htmli +='<button data-dismiss="alert" class="close" type="button">×</button>';
						htmli +='<i class="icon-checkmark-circle"></i> Record Inserted Successfully </div>';
						$('.page-content-wrapper #formerrors').html(htmli);
						 window.scrollTo(0, 0);
                         
                         toastr.success("Record Inserted Successfully");
                         window.location.reload();
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
                            toastr.error("Record Not Found");
							window.scrollTo(0, 0);
					  }
					  else{
							$('#add_property_type_setup-'+formid).remove();
							html +='<div class="alert alert-success fade in block-inner">';
							html +='<button data-dismiss="alert" class="close" type="button">×</button>';
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