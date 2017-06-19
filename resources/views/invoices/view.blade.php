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
		<li><a href="{{ URL::to('invoices?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper">   
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('invoices?return='.$return) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('invoices/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  		   	  
		</div>
<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> <?php echo $pageTitle ;?> <small>{{ $pageNote }}</small></h4></div>
	<div class="sbox-content"> 	


	
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>Logo</td>
						<td>{!! SiteHelpers::showUploadedFile($row->invoice_logo,'/uploads/invoices_logos/',50,50) !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Title</td>
						<td>{{ $row->invoice_title }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Invoice Number</td>
						<td>{{ $row->invoice_number }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Billing Date</td>
						<td>{{ $row->billing_date }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Due Date</td>
						<td>{{ $row->due_date }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Bill From</td>
						<td>{{ $row->from_business_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>From Address</td>
						<td>{{ $row->from_address }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>From Address2</td>
						<td>{{ $row->from_address2 }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>From Phone</td>
						<td>{{ $row->from_phone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>From Email</td>
						<td>{{ $row->from_email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>From Additional Info</td>
						<td>{{ $row->from_additional_info }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Bill To</td>
						<td>{{ $row->to_business_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>To Address</td>
						<td>{{ $row->to_address }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>To Address2</td>
						<td>{{ $row->to_address2 }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>To Phone</td>
						<td>{{ $row->to_phone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>To Email</td>
						<td>{{ $row->to_email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>To Additional Info</td>
						<td>{{ $row->to_additional_info }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Total Price</td>
						<td>{{ $row->invoice_total_price }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Comment</td>
						<td>{{ $row->invoice_comment }} </td>
						
					</tr>
				
		</tbody>	
	</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop