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
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('bookings?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
		@if($access['is_add'] ==1)
   		<a href="{{ URL::to('bookings/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
		@endif 
	</div>
	<div class="sbox-content" style="background:#fff;"> 	

		<table class="table table-striped table-bordered" >
			<tbody>	
		
					<tr>
						<td width='30%' class='label-view text-right'>Id</td>
						<td>{{ $row->id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Checkin Date</td>
						<td>{{ $row->checkin_date }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Checkout Date</td>
						<td>{{ $row->checkout_date }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Arrival Time</td>
						<td>{{ $row->arrival_time }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Room Id</td>
						<td>{{ $row->room_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Property Id</td>
						<td>{{ $row->property_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Client Id</td>
						<td>{{ $row->client_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Stay Type</td>
						<td>{{ $row->stay_type }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Already Stayed</td>
						<td>{{ $row->already_stayed }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Source</td>
						<td>{{ $row->source }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Comment</td>
						<td>{{ $row->comment }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Pre Reserve</td>
						<td>{{ $row->pre_reserve }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Number Of Nights</td>
						<td>{{ $row->number_of_nights }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Adult</td>
						<td>{{ $row->adult }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Junior</td>
						<td>{{ $row->junior }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Baby</td>
						<td>{{ $row->baby }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Guest Title</td>
						<td>{{ $row->guest_title }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Guest Names</td>
						<td>{{ $row->guest_names }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Guest Birthday</td>
						<td>{{ $row->guest_birthday }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Guest Address</td>
						<td>{{ $row->guest_address }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Guest City</td>
						<td>{{ $row->guest_city }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Guest Zip Code</td>
						<td>{{ $row->guest_zip_code }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Guest Country</td>
						<td>{{ $row->guest_country }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Guest Landline Code</td>
						<td>{{ $row->guest_landline_code }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Guest Landline Number</td>
						<td>{{ $row->guest_landline_number }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Guest Mobile Code</td>
						<td>{{ $row->guest_mobile_code }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Guest Mobile Number</td>
						<td>{{ $row->guest_mobile_number }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Guest Email</td>
						<td>{{ $row->guest_email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Checkin Comment</td>
						<td>{{ $row->checkin_comment }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Checkout Comment</td>
						<td>{{ $row->checkout_comment }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Option1</td>
						<td>{{ $row->option1 }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Option2</td>
						<td>{{ $row->option2 }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Price</td>
						<td>{{ $row->price }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Price Mode</td>
						<td>{{ $row->price_mode }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Board</td>
						<td>{{ $row->board }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Type Id</td>
						<td>{{ $row->type_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Organizing Transfers</td>
						<td>{{ $row->organizing_transfers }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Booking Status</td>
						<td>{{ $row->booking_status }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created Date</td>
						<td>{{ $row->created_date }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created By</td>
						<td>{{ $row->created_by }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Updated Date</td>
						<td>{{ $row->updated_date }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Updated By</td>
						<td>{{ $row->updated_by }} </td>
						
					</tr>
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop