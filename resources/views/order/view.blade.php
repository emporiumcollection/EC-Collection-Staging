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
		<li><a href="{{ URL::to('order?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper">   
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('order?return='.$return) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('order/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  		   	  
		</div>
<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> </h4></div>
	<div class="sbox-content"> 	


	
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>OrderNumber</td>
						<td>{{ $row->orderNumber }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>OrderDate</td>
						<td>{{ $row->orderDate }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>RequiredDate</td>
						<td>{{ $row->requiredDate }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>ShippedDate</td>
						<td>{{ $row->shippedDate }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td>{{ $row->status }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Comments</td>
						<td>{{ $row->comments }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>CustomerNumber</td>
						<td>{{ $row->customerNumber }} </td>
						
					</tr>
				
		</tbody>	
	</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop