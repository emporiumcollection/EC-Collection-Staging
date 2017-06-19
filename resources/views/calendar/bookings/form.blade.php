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
		<li><a href="{{ URL::to('bookings?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'bookings/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Bookings</legend>
									
								  <div class="form-group  " >
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
								  <div class="form-group  " >
									<label for="Room Id" class=" control-label col-md-4 text-left"> Room Id </label>
									<div class="col-md-6">
									  {!! Form::text('room_id', $row['room_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Property Id" class=" control-label col-md-4 text-left"> Property Id </label>
									<div class="col-md-6">
									  {!! Form::text('property_id', $row['property_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Client Id" class=" control-label col-md-4 text-left"> Client Id </label>
									<div class="col-md-6">
									  {!! Form::text('client_id', $row['client_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
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
									<label for="Already Stayed" class=" control-label col-md-4 text-left"> Already Stayed </label>
									<div class="col-md-6">
									  {!! Form::text('already_stayed', $row['already_stayed'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Source" class=" control-label col-md-4 text-left"> Source </label>
									<div class="col-md-6">
									  {!! Form::text('source', $row['source'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
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
									<label for="Pre Reserve" class=" control-label col-md-4 text-left"> Pre Reserve </label>
									<div class="col-md-6">
									  {!! Form::text('pre_reserve', $row['pre_reserve'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Number Of Nights" class=" control-label col-md-4 text-left"> Number Of Nights </label>
									<div class="col-md-6">
									  {!! Form::text('number_of_nights', $row['number_of_nights'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
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
									<label for="Checkout Comment" class=" control-label col-md-4 text-left"> Checkout Comment </label>
									<div class="col-md-6">
									  {!! Form::text('checkout_comment', $row['checkout_comment'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Option1" class=" control-label col-md-4 text-left"> Option1 </label>
									<div class="col-md-6">
									  {!! Form::text('option1', $row['option1'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Option2" class=" control-label col-md-4 text-left"> Option2 </label>
									<div class="col-md-6">
									  {!! Form::text('option2', $row['option2'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
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
									<label for="Board" class=" control-label col-md-4 text-left"> Board </label>
									<div class="col-md-6">
									  {!! Form::text('board', $row['board'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Type Id" class=" control-label col-md-4 text-left"> Type Id </label>
									<div class="col-md-6">
									  {!! Form::text('type_id', $row['type_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Organizing Transfers" class=" control-label col-md-4 text-left"> Organizing Transfers </label>
									<div class="col-md-6">
									  {!! Form::text('organizing_transfers', $row['organizing_transfers'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Booking Status" class=" control-label col-md-4 text-left"> Booking Status </label>
									<div class="col-md-6">
									  {!! Form::text('booking_status', $row['booking_status'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
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
					<button type="button" onclick="location.href='{{ URL::to('bookings?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop