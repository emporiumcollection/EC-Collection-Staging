@extends('layouts.app')

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
<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('shoporders?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('shoporders?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
		@if($access['is_add'] ==1)
   		<a href="{{ URL::to('shoporders/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
		@endif 
	</div>
	<div class="sbox-content" style="background:#fff;"> 	

		<table class="table table-striped table-bordered" >
			<tbody>	
		
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
						<td width='80%' class='label-view text-right'>Page Name</td>
						<td>{{ $row->page }} </td>
						
					</tr>
				
					<tr>
						<td width='80%' class='label-view text-right'>Order Placed</td>
						<td>{{ $row->created }} </td>
						
					</tr>
					@if($row->order_status!='')
						<tr>
							<td width='80%' class='label-view text-right'>Order Status</td>
							<td>{{ $row->order_status }} </td>
							
						</tr>
					@endif
			</tbody>	
		</table>   
		
		@if(!empty($order_item_detail))
			<div id="item-pnl">
				<div class="row items-pnl-head">
					<div class="col-sm-3 col">CATEGORY</div>
					<div class="col-sm-7 col">PRODUCT</div>
					<div class="col-sm-1 col">QTY</div>
					<div class="col-sm-1 col">PRICE</div>
				</div>
				{{--*/ $qtyPr = 1;
					   $Totprice = 0;
					/*--}}
				@foreach($order_item_detail as $detail)
					<div class="row items-pnl-body" id="item-row">
						<div class="fieldwrapper">
							<div class="col-sm-3 col">{{$detail->cat_name}}</div>
							<div class="col-sm-7 col"><b>{{$detail->title}}</b><br>{{$detail->description}}</div>
							<div class="col-sm-1 col" style="text-align:center;">{{$detail->product_qty}}</div>
							<div class="col-sm-1 col" style="text-align:center;">&euro;{{$detail->price}}</div>
						</div>
					</div>
					{{--*/ $qtyPr = $detail->price * $detail->product_qty;
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