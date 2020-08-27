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
            <span class="m-nav__link-text  breadcrumb-end"> Property Management System </span> 
        </a> 
    </li>
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
		<li><a href="{{ URL::to('eventreservations?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'eventreservations/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Event Reservations</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Checkin Date" class=" control-label col-md-4 text-left"> Checkin Date </label>
									<div class="col-md-6">
									  {!! Form::text('checkin_date', $row['checkin_date'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Checkout Date" class=" control-label col-md-4 text-left"> Checkout Date </label>
									<div class="col-md-6">
									  {!! Form::text('checkout_date', $row['checkout_date'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Arrival Time" class=" control-label col-md-4 text-left"> Arrival Time </label>
									<div class="col-md-6">
									  {!! Form::text('arrival_time', $row['arrival_time'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								@if($group!=1 && $group!=2)
								  <div class="form-group  " >
									<label for="Event Id" class=" control-label col-md-4 text-left"> Event Id </label>
									<div class="col-md-6">
									  <select name='event_id' class='select2' >
										@if(!empty($events))
											@foreach($events as $event)
												<option value="{{$event->id}}" {{ ($event->id==$row['event_id']) ? 'selected="selected"' : '' }}>	
													{{$event->title}}
												</option>
											@endforeach
										@endif
									  </select> 
									 </div> 
									 <div class="col-md-2">
									 	<input type="hidden" name="user_id" value="1" />
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Property Id" class=" control-label col-md-4 text-left"> Property Id </label>
									<div class="col-md-6">
									  <select name='property_id' class='select2' >
										@if(!empty($proprty))
											@foreach($proprty as $prps)
												<option value="{{$prps->id}}" {{ ($prps->id==$row['property_id']) ? 'selected="selected"' : '' }}>	
													{{$prps->property_name}}
												</option>
											@endforeach
										@endif
									  </select> 
									 </div> 
									 <div class="col-md-2">
									 	<input type="hidden" name="user_id" value="1" />
									 </div>
								  </div>
								@else
								  <div class="form-group  " >
									<label for="Event Id" class=" control-label col-md-4 text-left"> Event Id </label>
									<div class="col-md-6">
									  <select name='event_id' rows='5' id='event_id' class='select2 '   ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Property Id" class=" control-label col-md-4 text-left"> Property Id </label>
									<div class="col-md-6">
									  <select name='property_id' rows='5' id='property_id' class='select2 '   ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								@endif
								  <div class="form-group  " >
									<label for="Client Id" class=" control-label col-md-4 text-left"> Client Id </label>
									<div class="col-md-6">
									  {!! Form::text('client_id', $row['client_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Id" class=" control-label col-md-4 text-left"> Package Id </label>
									<div class="col-md-6">
									  <select name='package_id' rows='5' id='package_id' class='select2 '   ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Stay Type" class=" control-label col-md-4 text-left"> Stay Type </label>
									<div class="col-md-6">
									  {!! Form::text('stay_type', $row['stay_type'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Comment" class=" control-label col-md-4 text-left"> Comment </label>
									<div class="col-md-6">
									  {!! Form::text('comment', $row['comment'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Adult" class=" control-label col-md-4 text-left"> Adult </label>
									<div class="col-md-6">
									  {!! Form::text('adult', $row['adult'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Junior" class=" control-label col-md-4 text-left"> Junior </label>
									<div class="col-md-6">
									  {!! Form::text('junior', $row['junior'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Baby" class=" control-label col-md-4 text-left"> Baby </label>
									<div class="col-md-6">
									  {!! Form::text('baby', $row['baby'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Guest Title" class=" control-label col-md-4 text-left"> Guest Title </label>
									<div class="col-md-6">
									  {!! Form::text('guest_title', $row['guest_title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Guest Names" class=" control-label col-md-4 text-left"> Guest Names </label>
									<div class="col-md-6">
									  {!! Form::text('guest_names', $row['guest_names'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Guest Birthday" class=" control-label col-md-4 text-left"> Guest Birthday </label>
									<div class="col-md-6">
									  {!! Form::text('guest_birthday', $row['guest_birthday'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Guest Address" class=" control-label col-md-4 text-left"> Guest Address </label>
									<div class="col-md-6">
									  {!! Form::text('guest_address', $row['guest_address'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Guest City" class=" control-label col-md-4 text-left"> Guest City </label>
									<div class="col-md-6">
									  {!! Form::text('guest_city', $row['guest_city'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Guest Zip Code" class=" control-label col-md-4 text-left"> Guest Zip Code </label>
									<div class="col-md-6">
									  {!! Form::text('guest_zip_code', $row['guest_zip_code'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Guest Country" class=" control-label col-md-4 text-left"> Guest Country </label>
									<div class="col-md-6">
									  {!! Form::text('guest_country', $row['guest_country'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Guest Landline Code" class=" control-label col-md-4 text-left"> Guest Landline Code </label>
									<div class="col-md-6">
									  {!! Form::text('guest_landline_code', $row['guest_landline_code'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Guest Landline Number" class=" control-label col-md-4 text-left"> Guest Landline Number </label>
									<div class="col-md-6">
									  {!! Form::text('guest_landline_number', $row['guest_landline_number'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Guest Mobile Code" class=" control-label col-md-4 text-left"> Guest Mobile Code </label>
									<div class="col-md-6">
									  {!! Form::text('guest_mobile_code', $row['guest_mobile_code'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Guest Mobile Number" class=" control-label col-md-4 text-left"> Guest Mobile Number </label>
									<div class="col-md-6">
									  {!! Form::text('guest_mobile_number', $row['guest_mobile_number'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Guest Email" class=" control-label col-md-4 text-left"> Guest Email </label>
									<div class="col-md-6">
									  {!! Form::text('guest_email', $row['guest_email'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Checkin Comment" class=" control-label col-md-4 text-left"> Checkin Comment </label>
									<div class="col-md-6">
									  {!! Form::text('checkin_comment', $row['checkin_comment'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Price" class=" control-label col-md-4 text-left"> Price </label>
									<div class="col-md-6">
									  {!! Form::text('price', $row['price'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Price Mode" class=" control-label col-md-4 text-left"> Price Mode </label>
									<div class="col-md-6">
									  {!! Form::text('price_mode', $row['price_mode'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Booking Status" class=" control-label col-md-4 text-left"> Booking Status </label>
									<div class="col-md-6">
									  
					<?php $booking_status = explode(',',$row['booking_status']);
					$booking_status_opt = array( 'Pending' => 'Pending' ,  'Cancelled' => 'Cancelled' ,  'Booked' => 'Booked' , ); ?>
					<select name='booking_status' rows='5'   class='select2 '  > 
						<?php 
						foreach($booking_status_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['booking_status'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Created Date" class=" control-label col-md-4 text-left"> Created Date </label>
									<div class="col-md-6">
									  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('created_date', $row['created_date'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Created By" class=" control-label col-md-4 text-left"> Created By </label>
									<div class="col-md-6">
									  {!! Form::text('created_by', $row['created_by'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Updated Date" class=" control-label col-md-4 text-left"> Updated Date </label>
									<div class="col-md-6">
									  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('updated_date', $row['updated_date'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Updated By" class=" control-label col-md-4 text-left"> Updated By </label>
									<div class="col-md-6">
									  {!! Form::text('updated_by', $row['updated_by'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> </fieldset>
			</div>
			
			

		
			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('eventreservations?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#event_id").jCombo("{{ URL::to('eventreservations/comboselect?filter=tb_events:id:title') }}",
		{  selected_value : '{{ $row["event_id"] }}' });
		
		$("#property_id").jCombo("{{ URL::to('eventreservations/comboselect?filter=tb_properties:id:property_name|property_slug') }}",
		{  selected_value : '{{ $row["property_id"] }}' });
		
		$("#package_id").jCombo("{{ URL::to('eventreservations/comboselect?filter=tb_event_packages::package_title|package_description') }}",
		{  selected_value : '{{ $row["package_id"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop