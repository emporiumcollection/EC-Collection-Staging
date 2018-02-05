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
		<li><a href="{{ URL::to('userorder?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('userorder?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a> 
	</div>
	<div class="sbox-content" style="background:#fff;"> 	

		<table class="table table-striped table-bordered" >
			<tbody>	
		
					<tr>
						<td width='80%' class='label-view text-right'>Order Id</td>
						<td># {{ $row->id }} </td>
						
					</tr>
					
					<tr>
						<td width='80%' class='label-view text-right'>Created</td>
						<td>{{ $row->created }} </td>
						
					</tr>
				
					<tr>
						<td width='80%' class='label-view text-right'>Updated</td>
						<td>{{ $row->updated }} </td>
						
					</tr>
					
					<tr>
						<td width='80%' class='label-view text-right'>User Name</td>
						<td>{!! SiteHelpers::gridDisplayView($row->user_id,'user_id','1:tb_users:id:first_name|last_name') !!} </td>
						
					</tr>
					
					@if(!empty($userDetail))
						<tr>
							<td width='80%' class='label-view text-right'>User Address</td>
							<td>{{ $userDetail->company_address.' '.$userDetail->company_address2.' '.$userDetail->company_city.' '.$userDetail->company_postal_code.' '.$userDetail->company_country  }}</td>
							
						</tr>
					@endif
				
					<tr>
						<td width='80%' class='label-view text-right'>Status</td>
						<td>{{ $row->status }} </td>
						
					</tr>
				
					<tr>
						<td width='80%' class='label-view text-right'>Comments</td>
						<td>{{ $row->comments }} </td>
						
					</tr>
			</tbody>	
		</table>   

		@if(!empty($order_item_detail))
			<div id="item-pnl">
				<div class="row items-pnl-head">
					<div class="col-sm-1 col">No.</div>
					<div class="col-sm-4 col">PACKAGES</div>
					<div class="col-sm-3 col">QTY</div>
					<div class="col-sm-4 col">PRICE</div>
				</div>
				{{--*/ 
						$qty = 1;
						$qtyPr = 1;
					   $Totprice = 0;
					/*--}}
				@foreach($order_item_detail as $detail)
					<div class="row items-pnl-body" id="item-row">
						<div class="fieldwrapper">
							<div class="col-sm-1 col">{{$detail->id}}</div>
							<div class="col-sm-4 col"><b>{{$detail->pckname}}</div>
							<div class="col-sm-3 col" style="text-align:center;">{{$qty}}</div>
							<div class="col-sm-4 col" style="text-align:center;">&euro;{{$detail->pckprice}}</div>
						</div>
					</div>
					{{--*/ $qtyPr = $detail->pckprice * $qty;
						$Totprice = $Totprice + $qtyPr;
					/*--}}
				@endforeach
				<div class="row items-pnl-body" id="item-row">
					<div class="fieldwrapper">
						<div class="col-sm-11 col" style="text-align:right;">Gesammtsumme</div>
						<div class="col-sm-1 col" style="text-align:center;">&euro;{{$Totprice}}</div>
					</div>
				</div>
			</div>
		@endif
	
	</div>
</div>	

	</div>
</div>
	  
@stop