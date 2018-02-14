@extends('layouts.app')

@section('content')

  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('crmhotel?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active">{{ Lang::get('core.addedit') }} </li>
      </ul>
	  	  
    </div>
 
 	<div class="page-content-wrapper">

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> </h4></div>
	<div class="sbox-content"> 	

		 {!! Form::open(array('url'=>'crmhotel/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
			<ul class="nav nav-tabs">
				<li class="active"><a href="#Company" data-toggle="tab">Company</a></li>
				<li class=""><a href="#Contacts" data-toggle="tab">Contacts</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane m-t active" id="Company"> 
					<ul class="nav nav-tabs">
						<li class="active"><a href="#hotelinfo" data-toggle="tab">Hotel Info</a></li>
						<li class="" id="companyinfotab"><a href="#companyinfo" data-toggle="tab">Company Info</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane m-t active" id="hotelinfo"> 
							<div class="form-group  " >
								<label for="Property" class=" control-label col-md-4 text-left"> Property </label>
								<div class="col-md-6">
								  <select name='propr_id' rows='5' id='propr_id' class='select2 ' onchange="fetch_property_info(this.value);" required="required"  ></select> 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Copy Amenities" class=" control-label col-md-4 text-left"> Is Company </label>
								<div class="col-md-6">
									<input name="is_company" id="is_company" type="checkbox" class="form-control input-sm" value="1" {{($row['is_company'] == 1) ? " checked='checked' " : '' }}  /> 
								</div> 
								<div class="col-md-2">

								</div>
							  </div>
							  <div class="form-group  " >
								<label for="Hotel Name" class=" control-label col-md-4 text-left"> Hotel Name </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_name', $row['hotel_name'],array('class'=>'form-control', 'placeholder'=>'', 'id' => 'hotel_name' )) !!}
								  
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Address" class=" control-label col-md-4 text-left"> Hotel Address </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_address', $row['hotel_address'],array('class'=>'form-control', 'placeholder'=>'', 'id' => 'hotel_address'  )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel City" class=" control-label col-md-4 text-left"> Hotel City </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_city', $row['hotel_city'],array('class'=>'form-control', 'placeholder'=>'',  'id' => 'hotel_city' )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Postal Code" class=" control-label col-md-4 text-left"> Hotel Postal Code </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_postal_code', $row['hotel_postal_code'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Country" class=" control-label col-md-4 text-left"> Hotel Country </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_country', $row['hotel_country'],array('class'=>'form-control', 'placeholder'=>'', 'id' => 'hotel_country'  )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Email" class=" control-label col-md-4 text-left"> Hotel Email </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_email', $row['hotel_email'],array('class'=>'form-control', 'placeholder'=>'', 'id' => 'hotel_email'  )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Main Phone" class=" control-label col-md-4 text-left"> Hotel Main Phone </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_main_phone', $row['hotel_main_phone'],array('class'=>'form-control', 'placeholder'=>'', 'id' => 'hotel_main_phone'  )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div>
							  <div class="form-group  " >
								<label for="Hotel Website" class=" control-label col-md-4 text-left"> Hotel Website </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_website', $row['hotel_website'],array('class'=>'form-control', 'placeholder'=>'', 'id' => 'hotel_website'  )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div>
							  <div class="form-group  " >
								<label for="Hotel Linkedin Profile" class=" control-label col-md-4 text-left"> Hotel Linkedin Profile </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_linkedin_profile', $row['hotel_linkedin_profile'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 
						</div>
						
						<div class="tab-pane m-t companyinfodata" id="companyinfo">
							<div class="form-group hidethis " style="display:none;">
								<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
								<div class="col-md-6">
								  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 
							  <div class="form-group  " >
								<label for="Company Name" class=" control-label col-md-4 text-left"> Company Name <span class="asterix"> * </span></label>
								<div class="col-md-6">
								  {!! Form::text('company_name', $row['company_name'],array('class'=>'form-control', 'placeholder'=>'',  )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Company Address" class=" control-label col-md-4 text-left"> Company Address </label>
								<div class="col-md-6">
								  {!! Form::text('company_address', $row['company_address'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Company City" class=" control-label col-md-4 text-left"> Company City </label>
								<div class="col-md-6">
								  {!! Form::text('company_city', $row['company_city'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Company Postal Code" class=" control-label col-md-4 text-left"> Company Postal Code </label>
								<div class="col-md-6">
								  {!! Form::text('company_postal_code', $row['company_postal_code'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Company Country" class=" control-label col-md-4 text-left"> Company Country </label>
								<div class="col-md-6">
								  {!! Form::text('company_country', $row['company_country'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Company Email" class=" control-label col-md-4 text-left"> Company Email <span class="asterix"> * </span></label>
								<div class="col-md-6">
								  {!! Form::text('company_email', $row['company_email'],array('class'=>'form-control', 'placeholder'=>'',  )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Company Phone" class=" control-label col-md-4 text-left"> Company Phone </label>
								<div class="col-md-6">
								  {!! Form::text('company_phone', $row['company_phone'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Company Website" class=" control-label col-md-4 text-left"> Company Website </label>
								<div class="col-md-6">
								  {!! Form::text('company_website', $row['company_website'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 
							  <div class="form-group  " >
								<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
								<div class="col-md-6">
								  
									<label class='radio radio-inline'>
									<input type='radio' name='crm_prop_status' value ='0'  @if($row['crm_prop_status'] == '0') checked="checked" @endif > Inactive </label>
									<label class='radio radio-inline'>
									<input type='radio' name='crm_prop_status' value ='1'  @if($row['crm_prop_status'] == '1') checked="checked" @endif > Active </label> 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 
						</div>
					</div>
				</div>
			
				<div class="tab-pane m-t " id="Contacts"> 
					<ul class="nav nav-tabs">
						<li class="active"><a href="#hotel_manager" data-toggle="tab">Hotel Manager</a></li>
						<li class=""><a href="#hotel_sales_manager" data-toggle="tab">Hotel Sales manager</a></li>
						<li class=""><a href="#hotel_spa_manager" data-toggle="tab">Hotel Spa Manager</a></li>
						<li class=""><a href="#hotel_restaurants" data-toggle="tab">Hotel Restaurants </a></li>
					</ul>				
					<div class="tab-content">
						<div class="tab-pane m-t active" id="hotel_manager">					
						  <div class="form-group  " >
							<label for="Hotel Manager Name" class=" control-label col-md-4 text-left"> Hotel Manager Name </label>
							<div class="col-md-6">
							  {!! Form::text('hotel_manager_name', $row['hotel_manager_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
							 </div> 
							 <div class="col-md-2">
								
							 </div>
						  </div> 					
						  <div class="form-group  " >
							<label for="Hotel Manager Lastname" class=" control-label col-md-4 text-left"> Hotel Manager Lastname </label>
							<div class="col-md-6">
							  {!! Form::text('hotel_manager_lastname', $row['hotel_manager_lastname'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
							 </div> 
							 <div class="col-md-2">
								
							 </div>
						  </div> 					
						  <div class="form-group  " >
							<label for="Hotel Manager Extension" class=" control-label col-md-4 text-left"> Hotel Manager Extension </label>
							<div class="col-md-6">
							  {!! Form::text('hotel_manager_extension', $row['hotel_manager_extension'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
							 </div> 
							 <div class="col-md-2">
								
							 </div>
						  </div> 
						  <div class="form-group  " >
							<label for="Hotel Manager Email" class=" control-label col-md-4 text-left"> Hotel Manager Email </label>
							<div class="col-md-6">
							  {!! Form::text('hotel_manager_email', $row['hotel_manager_email'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
							 </div> 
							 <div class="col-md-2">
								
							 </div>
						  </div> 					
						  <div class="form-group  " >
							<label for="Hotel Manager Phone" class=" control-label col-md-4 text-left"> Hotel Manager Phone </label>
							<div class="col-md-6">
							  {!! Form::text('hotel_manager_phone', $row['hotel_manager_phone'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
							 </div> 
							 <div class="col-md-2">
								
							 </div>
						  </div> 					
						  <div class="form-group  " >
							<label for="Hotel Manager Linkedin Profile" class=" control-label col-md-4 text-left"> Hotel Manager Linkedin Profile </label>
							<div class="col-md-6">
							  {!! Form::text('hotel_manager_linkedin_profile', $row['hotel_manager_linkedin_profile'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
							 </div> 
							 <div class="col-md-2">
								
							 </div>
						  </div>
						</div>
						<div class="tab-pane m-t " id="hotel_sales_manager">
							<div class="form-group  " >
								<label for="Hotel Sales Manager Name" class=" control-label col-md-4 text-left"> Hotel Sales Manager Name </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_sales_manager_name', $row['hotel_sales_manager_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Sales Manager Lastname" class=" control-label col-md-4 text-left"> Hotel Sales Manager Lastname </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_sales_manager_lastname', $row['hotel_sales_manager_lastname'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Sales Manager Email" class=" control-label col-md-4 text-left"> Hotel Sales Manager Email </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_sales_manager_email', $row['hotel_sales_manager_email'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Sales Manager Phone" class=" control-label col-md-4 text-left"> Hotel Sales Manager Phone </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_sales_manager_phone', $row['hotel_sales_manager_phone'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Sales Manager Extension" class=" control-label col-md-4 text-left"> Hotel Sales Manager Extension </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_sales_manager_extension', $row['hotel_sales_manager_extension'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Sales Manager Profile" class=" control-label col-md-4 text-left"> Hotel Sales Manager Profile </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_sales_manager_profile', $row['hotel_sales_manager_profile'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div>
						</div>
						<div class="tab-pane m-t " id="hotel_spa_manager">
							<div class="form-group  " >
								<label for="Hotel Spa Product Range" class=" control-label col-md-4 text-left"> Hotel Spa Product Range </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_spa_product_range', $row['hotel_spa_product_range'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Spa Manager Name" class=" control-label col-md-4 text-left"> Hotel Spa Manager Name </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_spa_manager_name', $row['hotel_spa_manager_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Spa Manager Lastname" class=" control-label col-md-4 text-left"> Hotel Spa Manager Lastname </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_spa_manager_lastname', $row['hotel_spa_manager_lastname'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Spa Manager Email" class=" control-label col-md-4 text-left"> Hotel Spa Manager Email </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_spa_manager_email', $row['hotel_spa_manager_email'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Spa Manager Phone" class=" control-label col-md-4 text-left"> Hotel Spa Manager Phone </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_spa_manager_phone', $row['hotel_spa_manager_phone'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Spa Manager Extension" class=" control-label col-md-4 text-left"> Hotel Spa Manager Extension </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_spa_manager_extension', $row['hotel_spa_manager_extension'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Hotel Spa Manager Linkedin Profile" class=" control-label col-md-4 text-left"> Hotel Spa Manager Linkedin Profile </label>
								<div class="col-md-6">
								  {!! Form::text('hotel_spa_manager_linkedin_profile', $row['hotel_spa_manager_linkedin_profile'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 
						</div>
						<div class="tab-pane m-t " id="hotel_restaurants">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#hotel_restaurant1" data-toggle="tab">Hotel Restaurant1 </a></li>
								<li class=""><a href="#hotel_restaurant2" data-toggle="tab">Hotel Restaurant2</a></li>
								<li class=""><a href="#hotel_restaurant3" data-toggle="tab">Hotel Restaurant3</a></li>
							</ul>				
							<div class="tab-content">
								<div class="tab-pane m-t active" id="hotel_restaurant1">
									<div class="form-group  " >
										<label for="Hotel Restaurant Name" class=" control-label col-md-4 text-left"> Hotel Restaurant Name </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant_name', $row['hotel_restaurant_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant Manager Name" class=" control-label col-md-4 text-left"> Hotel Restaurant Manager Name </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant_manager_name', $row['hotel_restaurant_manager_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant Manager Lastname" class=" control-label col-md-4 text-left"> Hotel Restaurant Manager Lastname </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant_manager_lastname', $row['hotel_restaurant_manager_lastname'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant Manager Email" class=" control-label col-md-4 text-left"> Hotel Restaurant Manager Email </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant_manager_email', $row['hotel_restaurant_manager_email'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant Manager Phone" class=" control-label col-md-4 text-left"> Hotel Restaurant Manager Phone </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant_manager_phone', $row['hotel_restaurant_manager_phone'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant Manager Extension" class=" control-label col-md-4 text-left"> Hotel Restaurant Manager Extension </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant_manager_extension', $row['hotel_restaurant_manager_extension'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant Manager Linkedin Profile" class=" control-label col-md-4 text-left"> Hotel Restaurant Manager Linkedin Profile </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant_manager_linkedin_profile', $row['hotel_restaurant_manager_linkedin_profile'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant Chefs Name" class=" control-label col-md-4 text-left"> Hotel Restaurant Chefs Name </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant_chefs_name', $row['hotel_restaurant_chefs_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant Chefs Awards" class=" control-label col-md-4 text-left"> Hotel Restaurant Chefs Awards </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant_chefs_awards', $row['hotel_restaurant_chefs_awards'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 
								</div>
								<div class="tab-pane m-t " id="hotel_restaurant2">
									<div class="form-group  " >
										<label for="Hotel Restaurant2 Name" class=" control-label col-md-4 text-left"> Hotel Restaurant2 Name </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant2_name', $row['hotel_restaurant2_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant2 Manager Name" class=" control-label col-md-4 text-left"> Hotel Restaurant2 Manager Name </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant2_manager_name', $row['hotel_restaurant2_manager_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant2 Manager Lastname" class=" control-label col-md-4 text-left"> Hotel Restaurant2 Manager Lastname </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant2_manager_lastname', $row['hotel_restaurant2_manager_lastname'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant2 Manager Email" class=" control-label col-md-4 text-left"> Hotel Restaurant2 Manager Email </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant2_manager_email', $row['hotel_restaurant2_manager_email'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant2 Manager Phone" class=" control-label col-md-4 text-left"> Hotel Restaurant2 Manager Phone </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant2_manager_phone', $row['hotel_restaurant2_manager_phone'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant2 Manager Extension" class=" control-label col-md-4 text-left"> Hotel Restaurant2 Manager Extension </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant2_manager_extension', $row['hotel_restaurant2_manager_extension'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant2 Manager Linkedin Profile" class=" control-label col-md-4 text-left"> Hotel Restaurant2 Manager Linkedin Profile </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant2_manager_linkedin_profile', $row['hotel_restaurant2_manager_linkedin_profile'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant2 Chefs Name" class=" control-label col-md-4 text-left"> Hotel Restaurant2 Chefs Name </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant2_chefs_name', $row['hotel_restaurant2_chefs_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant2 Chefs Awards" class=" control-label col-md-4 text-left"> Hotel Restaurant2 Chefs Awards </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant2_chefs_awards', $row['hotel_restaurant2_chefs_awards'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 
								</div>
								<div class="tab-pane m-t " id="hotel_restaurant3">
									<div class="form-group  " >
										<label for="Hotel Restaurant3 Name" class=" control-label col-md-4 text-left"> Hotel Restaurant3 Name </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant3_name', $row['hotel_restaurant3_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant3 Manager Name" class=" control-label col-md-4 text-left"> Hotel Restaurant3 Manager Name </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant3_manager_name', $row['hotel_restaurant3_manager_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant3 Manager Lastname" class=" control-label col-md-4 text-left"> Hotel Restaurant3 Manager Lastname </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant3_manager_lastname', $row['hotel_restaurant3_manager_lastname'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant3 Manager Email" class=" control-label col-md-4 text-left"> Hotel Restaurant3 Manager Email </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant3_manager_email', $row['hotel_restaurant3_manager_email'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant3 Manager Phone" class=" control-label col-md-4 text-left"> Hotel Restaurant3 Manager Phone </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant3_manager_phone', $row['hotel_restaurant3_manager_phone'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant3 Manager Extension" class=" control-label col-md-4 text-left"> Hotel Restaurant3 Manager Extension </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant3_manager_extension', $row['hotel_restaurant3_manager_extension'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant3 Manager Linkedin Profile" class=" control-label col-md-4 text-left"> Hotel Restaurant3 Manager Linkedin Profile </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant3_manager_linkedin_profile', $row['hotel_restaurant3_manager_linkedin_profile'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant3 Chefs Name" class=" control-label col-md-4 text-left"> Hotel Restaurant3 Chefs Name </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant3_chefs_name', $row['hotel_restaurant3_chefs_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Hotel Restaurant3 Chefs Awards" class=" control-label col-md-4 text-left"> Hotel Restaurant3 Chefs Awards </label>
										<div class="col-md-6">
										  {!! Form::text('hotel_restaurant3_chefs_awards', $row['hotel_restaurant3_chefs_awards'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
										 </div> 
										 <div class="col-md-2">
											
										 </div>
									  </div>
								</div>
							</div>
						</div>
					</div> 
				</div>
			</div>
                        <!--VC Start-->

                        @include('layouts/crm_layout/ai_vc_fields')

                        <!--VC End-->
			<div style="clear:both"></div>	
			<div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">	
				<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
				<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
				<button type="button" onclick="location.href='{{ URL::to('crmhotel?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
				</div>	  
		
			</div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#propr_id").jCombo("{{ URL::to('crmhotel/comboselect?filter=tb_properties:id:property_name') }}",
		{  selected_value : '{{ $row["propr_id"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});

		$('input[type="checkbox"][id="is_company"]').on('ifChecked', function () {
			$("#companyinfotab").hide();
		});
		
		$('input[type="checkbox"][id="is_company"]').on('ifUnchecked', function () {
			$("#companyinfotab").show();
		});
		
	});
	
	function fetch_property_info(prop)
	{
		if(prop>0)
		{
			$.ajax({
			  url: "{{ URL::to('fetch_property_info')}}",
			  type: "post",
			  data: 'propid='+prop,
			  success: function(data){
				if(data.status!='error')
				{
					$('#hotel_name').val(data.prop.property_name);
					$('#hotel_city').val(data.prop.city);
					$('#hotel_country').val(data.prop.country);
					$('#hotel_email').val(data.prop.email);
					$('#hotel_main_phone').val(data.prop.phone);
					$('#hotel_website').val(data.prop.website);
				}
			  }
			});
		}
	}
	</script>		 
@include('layouts/crm_layout/ai_vc')
@stop