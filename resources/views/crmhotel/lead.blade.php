@extends('layouts.app')
@section('style')
<link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
<style>
.hide-form{
    display: none;
}
</style>
@stop
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

		 <div class="row">
			
            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle Personal-Info">1</a>
                        <p>Personal Info</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle Social-Info" disabled="disabled">2</a>
                        <p>Social Info</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle Company-Info" disabled="disabled">3</a>
                        <p>Company Info</p>
                    </div>
                </div>
            </div>
			<div class="col-md-12 col-sm-12">
				{!! Form::open(array('url'=>'#', 'class'=>'form-horizontal','files' => true , 'id'=>'frm_personal_info', 'parsley-validate'=>'','novalidate'=>' ')) !!}
				   <fieldset class="muti-form-align" id="personalinfo">
                  
                    
                      <div class="form-group  " >
						<label for="User Type" class=" control-label col-md-4 text-left"> User Type </label>
						<div class="col-md-6">
						 <select name='group_id' rows='5' id='group_id' code='{$group_id}' 
							class='select2 '  required  ></select> 	  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
                      <div class="form-group  " >
						<label for="Lead Type" class=" control-label col-md-4 text-left"> Lead Type </label>
						<div class="col-md-6">
						  <select name="lead_type" id="lead_type" class="form-control">
                            <option value="Airline">Airline</option>
                            <option value="Airport">Airport</option>
                            <option value="Inflight Managzine">Inflight Managzine</option>
                            <option value="Bussiness Car Rental">Bussiness Car Rental</option>  
                            <option value="Cruise Lines">Cruise Lines</option>
                            <option value="Cruise Port">Cruise Port</option>
                            <option value="River Cruise">River Cruise</option>
                            <option value="Beach Destination">Beach Destination</option>  
                            <option value="City Destination">City Destination</option>
                            <option value="DMC's Destination Mang">DMC's Destination Mang</option>
                            <option value="Festival & Events Destination">Festival & Events Destination</option>
                            <option value="Luxury Islands">Luxury Islands</option>  
                            <option value="Meetings & Conferences">Meetings & Conferences</option>
                            <option value="National Parks">National Parks</option>
                            <option value="Tourist Attraction">Tourist Attraction</option>  
                            <option value="Tourist Board">Tourist Board</option>
                            <option value="Rail">Rail</option>
                            <option value="Safari">Safari</option>
                            <option value="Agency or Tour Operator">Agency or Tour Operator</option>  
                            <option value="Villas">Villas</option>
                            <option value="Industry Professional">Industry Professional</option>
                            <option value="Yachts Broker">Yachts Broker</option>
                            <option value="Shipyard">Shipyard</option>
                          </select>		  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
                      <div class="form-group  " >
						<label for="Hotel Type" class=" control-label col-md-4 text-left"> Hotel Type </label>
						<div class="col-md-6">
						  <select name="hotel_type" id="lead_type" class="form-control">
                            <option value="Beach Resort">Beach Resort</option>
                            <option value="Boutique Hotel">Boutique Hotel</option>
                            <option value="Boutique Hotel Brands">Boutique Hotel Brands</option>
                            <option value="Business Hotel">Business Hotel</option>  
                            <option value="Casino Resort">Casino Resort</option>
                            <option value="Golf Resort">Golf Resort</option>
                            <option value="Spa Resort">Spa Resort</option>
                            <option value="Design Hotels">Design Hotels</option>  
                            <option value="Family Resort">Family Resort</option>
                            <option value="Green Hotel">Green Hotel</option>
                            <option value="Hotel Group">Hotel Group</option>
                            <option value="Residences">Residences</option>  
                            <option value="Hotel Suite">Hotel Suite</option>
                            <option value="Hotel Villa">Hotel Villa</option>
                            <option value="Safari Lodge">Safari Lodge</option>  
                            <option value="Luxury Resort">Luxury Resort</option>
                            <option value="MICE Hotel">MICE Hotel</option>
                            <option value="New Hotel">New Hotel</option>
                            <option value="Private Island Resorts">Private Island Resorts</option>  
                            <option value="Sports Resort">Sports Resort</option>
                            <option value="Romantic Resort">Romantic Resort</option>                            
                          </select>		  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
					  <div class="form-group  " >
						<label for="First Name" class=" control-label col-md-4 text-left"> First Name </label>
						<div class="col-md-6">
						  {!! Form::text('firstname', '',array('class'=>'form-control', 'placeholder'=>'', 'id' => 'first_name' )) !!}			  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
                      <div class="form-group  " >
						 <label for="Last Name" class=" control-label col-md-4 text-left"> Last Name </label>
		                 <div class="col-md-6">
						  {!! Form::text('lastname', '',array('class'=>'form-control', 'placeholder'=>'', 'id' => 'last_name' )) !!}		  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
                      <div class="form-group  " >
						 <label for="Email" class=" control-label col-md-4 text-left"> Email </label>
		                 <div class="col-md-6">
						  {!! Form::text('email', '',array('class'=>'form-control', 'placeholder'=>'', 'id' => 'email' )) !!}
						  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						 <label for="Phone" class=" control-label col-md-4 text-left"> Phone </label>
		                 <div class="col-md-6">
						  {!! Form::text('phone', '',array('class'=>'form-control', 'placeholder'=>'', 'id' => 'phone' )) !!}
						  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 				
					  
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <div class="col-sm-10 text-right">
                            <input type="button" name="next"  data-next-id="Social-Info" class="next btn btn-info btn-sm action-button personalized-btn-deafult progress-bar-btn-increment" value="Continue" />
                        </div>
                      </div>
				
                </fieldset>
                <fieldset class="hide-form muti-form-align" id="socialinfo">
				
                    
					  <div class="form-group  " >
						<label for="Instagram" class=" control-label col-md-4 text-left"> Instagram </label>
						<div class="col-md-6">
						  {!! Form::text('instagram', '',array('class'=>'form-control', 'placeholder'=>'', 'id' => 'instagram' )) !!}			  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
                      <div class="form-group  " >
						 <label for="Linkedin" class=" control-label col-md-4 text-left"> Linkedin </label>
		                 <div class="col-md-6">
						  {!! Form::text('linkedin', '',array('class'=>'form-control', 'placeholder'=>'', 'id' => 'linkedin' )) !!}		  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
                      <div class="form-group  " >
						 <label for="facebook" class=" control-label col-md-4 text-left"> Facebook </label>
		                 <div class="col-md-6">
						  {!! Form::text('facebook', '',array('class'=>'form-control', 'placeholder'=>'', 'id' => 'facebook' )) !!}
						  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div>	
					  
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <div class="col-sm-4 text-right">
                            <input type="button" name="previous" data-prev-id="Personal-Info" class="previous btn btn-info btn-sm" value="Previous" />
                        </div>
                        <div class="col-sm-6 text-right">
                            <input type="button" name="next"  data-next-id="Company-Info" class="next btn btn-info btn-sm" value="Continue" />
                        </div>
                      </div> 
				
                </fieldset>
                <fieldset class="hide-form muti-form-align" id="companyinfo">
				
                    
					  <div class="form-group hidethis " style="display:none;">
						<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
						<div class="col-md-6">
						  {!! Form::text('id', '',array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
					  <div class="form-group  " >
						<label for="Company Name" class=" control-label col-md-4 text-left"> Company Name <span class="asterix"> * </span></label>
						<div class="col-md-6">
						  {!! Form::text('company_name', '',array('class'=>'form-control', 'placeholder'=>'',  )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						<label for="Company Address" class=" control-label col-md-4 text-left"> Company Address </label>
						<div class="col-md-6">
						  {!! Form::text('company_address', '',array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						<label for="Company City" class=" control-label col-md-4 text-left"> Company City </label>
						<div class="col-md-6">
						  {!! Form::text('company_city', '',array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						<label for="Company Postal Code" class=" control-label col-md-4 text-left"> Company Postal Code </label>
						<div class="col-md-6">
						  {!! Form::text('company_postal_code', '',array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						<label for="Company Country" class=" control-label col-md-4 text-left"> Company Country </label>
						<div class="col-md-6">
						  {!! Form::text('company_country', '',array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						<label for="Company Email" class=" control-label col-md-4 text-left"> Company Email <span class="asterix"> * </span></label>
						<div class="col-md-6">
						  {!! Form::text('company_email', '',array('class'=>'form-control', 'placeholder'=>'',  )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						<label for="Company Phone" class=" control-label col-md-4 text-left"> Company Phone </label>
						<div class="col-md-6">
						  {!! Form::text('company_phone', '',array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						<label for="Company Website" class=" control-label col-md-4 text-left"> Company Website </label>
						<div class="col-md-6">
						  {!! Form::text('company_website', '',array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
					  <div class="form-group  " >
						<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
						<div class="col-md-6">
						  
							<label class='radio radio-inline'>
							<input type='radio' name='crm_prop_status' value ='0'   > Inactive </label>
							<label class='radio radio-inline'>
							<input type='radio' name='crm_prop_status' value ='1' checked="checked" > Active </label> 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div>
                      
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <div class="col-sm-4 text-right">
                            <input type="button" name="previous" data-prev-id="Social-Info" class="previous btn btn-info btn-sm" value="Previous" />
                        </div>
                        <div class="col-sm-6 text-right">
                            <input type="button" name="submit"  class="btn btn-info btn-sm" value="{{ Lang::get('core.sb_save') }}" id="personal_info_apply" />
                        </div>
                      </div> 
				
                </fieldset>
				{!! Form::close() !!} 	
			
				
			</div>
         </div>   
			
		 
		 
	</div>
</div>		 
</div>	
</div>			 
<script type="text/javascript">
	$(document).ready(function() { 
		var current_fs, next_fs, previous_fs;
        $(".next").click(function(){
            current_fs = $(this).closest( ".muti-form-align" );
            next_fs = $(current_fs).next(".muti-form-align").removeClass('hide-form');                    
            current_fs.addClass('hide-form');
            
            $('.stepwizard-step').find('a').attr("disabled","disabled");
            var next_value = $(this).data('next-id');
            $('.'+next_value).removeAttr('disabled');
        });
        $(".previous").click(function(){
            
            current_fs = $(this).closest( ".muti-form-align" );
            next_fs = $(current_fs).prev(".muti-form-align").removeClass('hide-form');                    
            current_fs.addClass('hide-form'); 
            
            $('.stepwizard-step').find('a').attr("disabled","disabled");
            var pre_value = $(this).data('prev-id');
            $('.'+pre_value).removeAttr('disabled');
        });
        
		$("#group_id").jCombo("{{ URL::to('core/users/comboselect?filter=tb_groups:group_id:name') }}",
		{  selected_value : '' });
        
        $("#personal_info_apply").click(function(){
            var formData = $("#frm_personal_info").serialize();
            $.ajax({
    		  url: "{{ URL::to('leadcreate')}}",
    		  type: "post",
    		  data: formData,
    		  dataType: "json",
    		  success: function(data){
    		    $(".parsley-error-list").html('');
    			if(data.status!='error')
    			{
    				var message = '<li>'+ data.message+ '</li>';
                    $(".parsley-error-list").html(message); 
                    $("#frm_personal_info")[0].reset();
    			}else{
    			    var message = '';
                    for (var i = 0; i < data.errors.length; i++) {
                        message += '<li>' + data.errors[i] + '</li>';
                    }
                    $(".parsley-error-list").html(message);  
    			}
    		  }
    		});
        });
		$("#personal_info_submit").click(function(){
            var formData = $("#frm_personal_info").serialize();
            $.ajax({
    		  url: "{{ URL::to('leadcreate')}}",
    		  type: "post",
    		  data: formData,
    		  dataType: "json",
    		  success: function(data){
    		    $(".parsley-error-list").html('');
    			if(data.status!='error')
    			{
    				var message = '<li>'+ data.message+ '</li>';
                    $(".parsley-error-list").html(message); 
                    $("#frm_personal_info")[0].reset();
    			}else{
    			    var message = '';
                    for (var i = 0; i < data.errors.length; i++) {
                        message += '<li>' + data.errors[i] + '</li>';
                    }
                    $(".parsley-error-list").html(message);  
    			}
    		  }
    		});
        }); 
        $("#social_info_apply").click(function(){
            var formData = $("#frm_social_info").serialize();
            $.ajax({
    		  url: "{{ URL::to('socialinfo')}}",
    		  type: "post",
    		  data: formData,
    		  dataType: "json",
    		  success: function(data){
    		    $(".parsley-error-list").html('');
    			if(data.status!='error')
    			{
    				var message = '<li>'+ data.message+ '</li>';
                    $(".parsley-error-list").html(message); 
                    $("#frm_personal_info")[0].reset();
    			}else{
    			    var message = '';
                    for (var i = 0; i < data.errors.length; i++) {
                        message += '<li>' + data.errors[i] + '</li>';
                    }
                    $(".parsley-error-list").html(message);  
    			}
    		  }
    		});
        });
	});
</script>  	 
@include('layouts/crm_layout/ai_vc')
@stop