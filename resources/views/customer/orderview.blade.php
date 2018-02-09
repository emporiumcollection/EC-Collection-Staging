@extends('frontend.layouts.ev.customer')
@section('content')
<link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">
<style>
	.input-group-addon {
		background-color: #eee;
		border: 1px solid #ccc;
		border-radius: 4px;
	}
	
	#item-pnl .input-group-addon
	{
		padding:6px 9px;
	}
	.btn {
		 height: 22px !important;
	}
	
	#item-pnl .items-pnl-body {
		border-top: 1px solid #ccc;
	}
	
</style>
<table class="table table-striped table-bordered" >
	<tbody>	

			<tr>
				<td width='80%' class='label-view text-right'>Order Id</td>
				<td># {{ $order->id }} </td>
				
			</tr>
			
			<tr>
				<td width='80%' class='label-view text-right'>Invoice No.</td>
				<td># {{ $order->invoice_num }} </td>
				
			</tr>
			
			<tr>
				<td width='80%' class='label-view text-right'>Created</td>
				<td>{{ $order->created }} </td>
				
			</tr>
		
			<tr>
				<td width='80%' class='label-view text-right'>Status</td>
				<td>{{ $order->status }} </td>
				
			</tr>
		
			<tr>
				<td width='80%' class='label-view text-right'>Comments</td>
				<td>{{ $order->comments }} </td>
				
			</tr>
	</tbody>	
</table>   

@if(!empty($order_item_detail))
	<div id="item-pnl">
		<div class="row items-pnl-head">
			<div class="col-sm-1 col">No.</div>
			<div class="col-sm-7 col">PACKAGES</div>
			<div class="col-sm-2 col" style="text-align:center;">QTY</div>
			<div class="col-sm-2 col" style="text-align:center;">PRICE</div>
		</div>
		{{--*/ 
				$qty = 1;
				$qtyPr = 1;
			   $Totprice = 0;
			   $nos = 1;
			/*--}}
		@foreach($order_item_detail as $detail)
			<div class="row items-pnl-body" id="item-row">
				<div class="fieldwrapper">
					<div class="col-sm-1 col">{{$nos}}</div>
					<div class="col-sm-7 col"><b>{{$detail->pckname}}</b> @if($detail->pckcontent!='') <br> {{$detail->pckcontent}} @endif</div>
					<div class="col-sm-2 col" style="text-align:center;">{{$detail->qty}}</div>
					<div class="col-sm-2 col" style="text-align:center;">{{$def_currency->content . $detail->pckprice}}</div>
				</div>
			</div>
			{{--*/ $qtyPr = $detail->pckprice * $qty;
				$Totprice = $Totprice + $qtyPr;
				$nos++;
			/*--}}
		@endforeach
		<div class="row items-pnl-body" id="item-row">
			<div class="fieldwrapper">
				<div class="col-sm-11 col" style="text-align:right;">Summe</div>
				<div class="col-sm-1 col" style="text-align:center;">{{$def_currency->content . ($Totprice -(($Totprice*$data["vatsettings"]->content)/100))}}</div>
			</div>
		</div>
		<div class="row items-pnl-body" id="item-row">
			<div class="fieldwrapper">
				<div class="col-sm-11 col" style="text-align:right;">Mwst. {{ $data["vatsettings"]->content}}%</div>
				<div class="col-sm-1 col" style="text-align:center;">{{$def_currency->content . (($Totprice*$data["vatsettings"]->content)/100)}}</div>
			</div>
		</div>
		<div class="row items-pnl-body" id="item-row">
			<div class="fieldwrapper">
				<div class="col-sm-11 col" style="text-align:right;">Gesammtsumme</div>
				<div class="col-sm-1 col" style="text-align:center;">{{$def_currency->content . $Totprice}}</div>
			</div>
		</div>
	</div>
@endif
	  
@endsection