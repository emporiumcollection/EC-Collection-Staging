@extends('frontend.layouts.ev.customer')
@section('content')

		<table class="table table-striped table-bordered" >
			<tbody>	
		
					<tr>
						<td width='80%' class='label-view text-right'>Order Id</td>
						<td># {{ $order->id }} </td>
						
					</tr>
					
					<tr>
						<td width='80%' class='label-view text-right'>Created</td>
						<td>{{ $order->created }} </td>
						
					</tr>
				
					<tr>
						<td width='80%' class='label-view text-right'>Updated</td>
						<td>{{ $order->updated }} </td>
						
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
							<div class="col-sm-2 col" style="text-align:center;">{{$qty}}</div>
							<div class="col-sm-2 col" style="text-align:center;">&euro;{{$detail->pckprice}}</div>
						</div>
					</div>
					{{--*/ $qtyPr = $detail->pckprice * $qty;
						$Totprice = $Totprice + $qtyPr;
						$nos++;
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
	  
@endsection