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
            
			<div class="col-md-12 col-sm-12">
				{!! Form::open(array('url'=>'crmhotel/updatelead/'.$users->id, 'class'=>'form-horizontal','files' => true , 'id'=>'frm_personal_info', 'parsley-validate'=>'','novalidate'=>' ')) !!}
				   <fieldset class="muti-form-align" id="step-1">
                  
                    
                      <div class="form-group  " style="display: none;">
						<label for="User Type" class=" control-label col-md-4 text-left"> User Type </label>
						<div class="col-md-6">
                            <input type="text" class="form-control" value="New Lead" readonly="readonly"/>
                            <input type="hidden" name="group_id" value="{{ $group_id }}" />
						 <select name='group_id' rows='5' id='group_id' code='{$group_id}' 
							class='select2 '  required  ></select> 	  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
                      <div class="form-group  " >
						<label for="First Name" class=" control-label col-md-4 text-left"> First Name </label>
						<div class="col-md-6">
						  {!! Form::text('firstname', $users->first_name, array('class'=>'form-control', 'placeholder'=>'', 'id' => 'first_name' )) !!}			  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
                      <div class="form-group  " >
						 <label for="Last Name" class=" control-label col-md-4 text-left"> Last Name </label>
		                 <div class="col-md-6">
						  {!! Form::text('lastname', $users->last_name, array('class'=>'form-control', 'placeholder'=>'', 'id' => 'last_name' )) !!}		  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
                      <div class="form-group  " >
						<label for="Lead Type" class=" control-label col-md-4 text-left"> Lead Type </label>
						<div class="col-md-6">
						  <select name="lead_type" id="lead_type" class="form-control" >
                            <option value="Airline" {{ $users->lead_type=='Airline' ? " selected='selected' " : '' }}>Airline</option>
                            <option value="Airport" {{ $users->lead_type=='Airport' ? " selected='selected' " : '' }}>Airport</option>
                            <option value="Inflight Managzine" {{ $users->lead_type=='Inflight Managzine' ? " selected='selected' " : '' }}>Inflight Managzine</option>
                            <option value="Bussiness Car Rental" {{ $users->lead_type=='Bussiness Car Rental' ? " selected='selected' " : '' }}>Bussiness Car Rental</option>  
                            <option value="Cruise Lines" {{ $users->lead_type=='Cruise Lines' ? " selected='selected' " : '' }}>Cruise Lines</option>
                            <option value="Cruise Port" {{ $users->lead_type=='Cruise Port' ? " selected='selected' " : '' }}>Cruise Port</option>
                            <option value="River Cruise" {{ $users->lead_type=='River Cruise' ? " selected='selected' " : '' }}>River Cruise</option>
                            <option value="Beach Destination" {{ $users->lead_type=='Beach Destination' ? " selected='selected' " : '' }}>Beach Destination</option>  
                            <option value="City Destination" {{ $users->lead_type=='City Destination' ? " selected='selected' " : '' }}>City Destination</option>
                            <option value="DMC's Destination Mang" {{ $users->lead_type=="DMC's Destination Mang" ? " selected='selected' " : '' }}>DMC's Destination Mang</option>
                            <option value="Festival & Events Destination" {{ $users->lead_type=='Festival & Events Destination' ? " selected='selected' " : '' }}>Festival & Events Destination</option>
                            <option value="Luxury Islands" {{ $users->lead_type=='Luxury Islands' ? " selected='selected' " : '' }}>Luxury Islands</option> 
                            <option value="Hotel" {{ $users->lead_type=='Hotel' ? " selected='selected' " : '' }}>Hotel</option> 
                            <option value="Meetings & Conferences" {{ $users->lead_type=='Meetings & Conferences' ? " selected='selected' " : '' }}>Meetings & Conferences</option>
                            <option value="National Parks" {{ $users->lead_type=='National Parks' ? " selected='selected' " : '' }}>National Parks</option>
                            <option value="Tourist Attraction" {{ $users->lead_type=='Tourist Attraction' ? " selected='selected' " : '' }}>Tourist Attraction</option>  
                            <option value="Tourist Board" {{ $users->lead_type=='Tourist Board' ? " selected='selected' " : '' }}>Tourist Board</option>
                            <option value="Rail" {{ $users->lead_type=='Rail' ? " selected='selected' " : '' }}>Rail</option>
                            <option value="Safari" {{ $users->lead_type=='Safari' ? " selected='selected' " : '' }}>Safari</option>
                            <option value="Agency or Tour Operator" <?php $users->lead_type=="Agency or Tour Operator" ? " selected='selected' " : '' ?>>Agency or Tour Operator</option>  
                            <option value="Villas" {{ $users->lead_type=='Villas' ? " selected='selected' " : '' }}>Villas</option>
                            <option value="Industry Professional" {{ $users->lead_type=='Industry Professional' ? " selected='selected' " : '' }}>Industry Professional</option>
                            <option value="Yachts Broker" {{ $users->lead_type=='Yachts Broker' ? " selected='selected' " : '' }}>Yachts Broker</option>
                            <option value="Shipyard" {{ $users->lead_type=='Shipyard' ? " selected='selected' " : '' }}>Shipyard</option>
                          </select>		  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
                      <div class="form-group" style="display: none;" id="dv_hotel_type">
						<label for="Hotel Type" class=" control-label col-md-4 text-left"> Hotel Type </label>
						<div class="col-md-6">
						  <select name="hotel_type[]" id="hotel_type" class="select2" multiple rows='5'>
                            <option value="Beach Resort" {{ $users->hotel_type=='Beach Resort' ? " selected='selected' " : '' }}>Beach Resort</option>
                            <option value="Boutique Hotel" {{ $users->hotel_type=='Boutique Hotel' ? " selected='selected' " : '' }}>Boutique Hotel</option>
                            <option value="Boutique Hotel Brands" {{ $users->hotel_type=='Boutique Hotel Brands' ? " selected='selected' " : '' }}>Boutique Hotel Brands</option>
                            <option value="Business Hotel" {{ $users->hotel_type=='Business Hotel' ? " selected='selected' " : '' }}>Business Hotel</option>  
                            <option value="Casino Resort" {{ $users->hotel_type=='Casino Resort' ? " selected='selected' " : '' }}>Casino Resort</option>
                            <option value="Golf Resort" {{ $users->hotel_type=='Golf Resort' ? " selected='selected' " : '' }}>Golf Resort</option>
                            <option value="Spa Resort" {{ $users->hotel_type=='Spa Resort' ? " selected='selected' " : '' }}>Spa Resort</option>
                            <option value="Design Hotels" {{ $users->hotel_type=='Design Hotels' ? " selected='selected' " : '' }}>Design Hotels</option>  
                            <option value="Family Resort" {{ $users->hotel_type=='Family Resort' ? " selected='selected' " : '' }}>Family Resort</option>
                            <option value="Green Hotel" {{ $users->hotel_type=='Green Hotel' ? " selected='selected' " : '' }}>Green Hotel</option>
                            <option value="Hotel Group" {{ $users->hotel_type=='Hotel Group' ? " selected='selected' " : '' }}>Hotel Group</option>
                            <option value="Residences" {{ $users->hotel_type=='Residences' ? " selected='selected' " : '' }}>Residences</option>  
                            <option value="Hotel Suite" {{ $users->hotel_type=='Hotel Suite' ? " selected='selected' " : '' }}>Hotel Suite</option>
                            <option value="Hotel Villa" {{ $users->hotel_type=='Hotel Villa' ? " selected='selected' " : '' }}>Hotel Villa</option>
                            <option value="Safari Lodge" {{ $users->hotel_type=='Safari Lodge' ? " selected='selected' " : '' }}>Safari Lodge</option>  
                            <option value="Luxury Resort" {{ $users->hotel_type=='Luxury Resort' ? " selected='selected' " : '' }}>Luxury Resort</option>
                            <option value="MICE Hotel" {{ $users->hotel_type=='MICE Hotel' ? " selected='selected' " : '' }}>MICE Hotel</option>
                            <option value="New Hotel" {{ $users->hotel_type=='New Hotel' ? " selected='selected' " : '' }}>New Hotel</option>
                            <option value="Private Island Resorts" {{ $users->hotel_type=='Private Island Resorts' ? " selected='selected' " : '' }}>Private Island Resorts</option>  
                            <option value="Sports Resort" {{ $users->hotel_type=='Sports Resort' ? " selected='selected' " : '' }}>Sports Resort</option>
                            <option value="Romantic Resort" {{ $users->hotel_type=='Romantic Resort' ? " selected='selected' " : '' }}>Romantic Resort</option>                            
                          </select>		  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
					  
                      <div class="form-group  " >
						 <label for="Email" class=" control-label col-md-4 text-left"> Email </label>
		                 <div class="col-md-6">
						  {!! Form::text('email', $users->email, array('class'=>'form-control', 'placeholder'=>'', 'id' => 'email' )) !!}
						  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						 <label for="Phone" class=" control-label col-md-4 text-left"> Phone </label>
                         <div class="col-md-1" style="padding-right: 0px;">
                            {!! Form::text('phonecode', $users->mobile_code,array('class'=>'form-control', 'placeholder'=>'code', 'id' => 'phonecode' )) !!}
                         </div>
		                 <div class="col-md-5" style="padding-left: 0px;">
						  {!! Form::text('phone',  $users->mobile_number,array('class'=>'form-control', 'placeholder'=>'phone', 'id' => 'phone' )) !!}
						  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
                      
                    
					  <div class="form-group  " >
						<label for="Instagram" class=" control-label col-md-4 text-left"> Instagram </label>
						<div class="col-md-1" style="padding-right: 0px;">
                            <input type="text" class="form-control" value="http://" readonly="readonly" />
                         </div>
		                 <div class="col-md-5" style="padding-left: 0px;">
						  {!! Form::text('instagram',  $users->instagram,array('class'=>'form-control', 'placeholder'=>'', 'id' => 'instagram' )) !!}			  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
                      <div class="form-group  " >
						 <label for="Linkedin" class=" control-label col-md-4 text-left"> Linkedin </label>
                         <div class="col-md-1" style="padding-right: 0px;">
                            <input type="text" class="form-control" value="http://" readonly="readonly" />
                         </div>
		                 <div class="col-md-5" style="padding-left: 0px;">
						  {!! Form::text('linkedin',  $users->linkedin, array('class'=>'form-control', 'placeholder'=>'', 'id' => 'linkedin' )) !!}		  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
                      <div class="form-group  " >
						 <label for="facebook" class=" control-label col-md-4 text-left"> Facebook </label>
		                 <div class="col-md-1" style="padding-right: 0px;">
                            <input type="text" class="form-control" value="http://" readonly="readonly" />
                         </div>
		                 <div class="col-md-5" style="padding-left: 0px;">
						  {!! Form::text('facebook',  $users->facebook, array('class'=>'form-control', 'placeholder'=>'', 'id' => 'facebook' )) !!}
						  
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div>                      
                    
					  <div class="form-group hidethis " style="display:none;">
						<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
						<div class="col-md-6">
						  {!! Form::text('id',  $users->id,array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
					  <div class="form-group  " >
						<label for="Company Name" class=" control-label col-md-4 text-left"> Company Name <span class="asterix"> * </span></label>
						<div class="col-md-6">
						  {!! Form::text('company_name', isset($company->company_name) ? $company->company_name : '', array('class'=>'form-control', 'placeholder'=>'',  )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						<label for="Company Address" class=" control-label col-md-4 text-left"> Company Address </label>
						<div class="col-md-6">
						  {!! Form::text('company_address', isset($company->company_address) ? $company->company_address : '', array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						<label for="Company City" class=" control-label col-md-4 text-left"> Company City </label>
						<div class="col-md-6">
						  {!! Form::text('company_city',  isset($company->company_city) ? $company->company_city : '', array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						<label for="Company Postal Code" class=" control-label col-md-4 text-left"> Company Postal Code </label>
						<div class="col-md-6">
						  {!! Form::text('company_postal_code',  (isset($company->company_postal_code) && $company->company_postal_code > 0) ? $company->company_postal_code : '',array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						<label for="Company Country" class=" control-label col-md-4 text-left"> Company Country </label>
						<div class="col-md-6">
						  {!! Form::text('company_country', isset($company->company_country) ? $company->company_country : '' ,array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						<label for="Company Email" class=" control-label col-md-4 text-left"> Company Email <span class="asterix"> * </span></label>
						<div class="col-md-6">
						  {!! Form::text('company_email',  isset($company->company_email) ? $company->company_email : '' ,array('class'=>'form-control', 'placeholder'=>'',  )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						<label for="Company Phone" class=" control-label col-md-4 text-left"> Company Phone </label>
						<div class="col-md-6">
						  {!! Form::text('company_phone', isset($company->company_phone) ? $company->company_phone : '',array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 					
					  <div class="form-group  " >
						 <label for="Company Website" class=" control-label col-md-4 text-left"> Company Website </label>
				         <div class="col-md-1" style="padding-right: 0px;">
                            <input type="text" class="form-control" value="http://" readonly="readonly" />
                         </div>
		                 <div class="col-md-5" style="padding-left: 0px;">
						  {!! Form::text('company_website', isset($company->company_website) ? $company->company_website : '', array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
					  <div class="form-group  " style="display: none;" >
						<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
						<div class="col-md-6">
						  
							<label class='radio radio-inline'>
							<input type='radio' name='crm_prop_status' value ='0' @if($users->active == '0') checked="checked" @endif > Inactive </label>
							<label class='radio radio-inline'>
							<input type='radio' name='crm_prop_status' value ='1' @if($users->active == '1') checked="checked" @endif > Active </label> 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div>
                      
                      <div class="clearfix"></div>
                      <div class="form-group">
                        
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
	   
        $(".top-step").click(function(){
            $('.stepwizard-step').find('a').attr("disabled","disabled");
            $(this).find('a').removeAttr('disabled');
            $(".muti-form-align").addClass('hide-form');            
            st_id = $(this).find('a').attr('href');
            $(st_id).removeClass('hide-form');
        });
       
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
    		  url: "{{ URL::to('leadupdate')}}",
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
                    window.location.href = "{{URL::to('crmhotel/leadlisting')}}";
                    toastr.success('New Lead added successfully');                    
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
        
        $("#lead_type").change(function(){
           var lead_val = $("#lead_type").val();
           if(lead_val=="Hotel"){
                $("#dv_hotel_type").css('display', '');
           }else{
                $("#dv_hotel_type").css('display', 'none');
           }
        });
        
	});
</script>  	 
@include('layouts/crm_layout/ai_vc')
@stop