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
					<div class="col-sm-3 col">PACKAGES</div>
					<div class="col-sm-1 col">QTY</div>
					<div class="col-sm-1 col">PRICE</div>
					<div class="col-sm-7 col">DATA</div>
				</div>
			</div>
		@endif
	
	</div>
</div>	

	</div>
</div>
	  
@stop