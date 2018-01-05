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
		<li><a href="{{ URL::to('advertisementspace?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('advertisementspace?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
		@if($access['is_add'] ==1)
   		<a href="{{ URL::to('advertisementspace/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
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
						<td width='30%' class='label-view text-right'>Name</td>
						<td>{{ $row->space_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Title</td>
						<td>{{ $row->space_title }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>CPC Price</td>
						<td>{{ $row->space_cpc_price }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>CPC Target Clicks</td>
						<td>{{ $row->space_cpc_num_clicks }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>CPM Price</td>
						<td>{{ $row->space_cpm_price }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>CPM Target View</td>
						<td>{{ $row->space_cpm_num_view }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>CPD Price</td>
						<td>{{ $row->space_cpd_price }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>CPD Target Days</td>
						<td>{{ $row->space_cpm_num_days }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Position</td>
						<td>{{ $row->space_position }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Template</td>
						<td>{{ $row->space_template }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Max Ads</td>
						<td>{{ $row->space_max_ads }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Specific Devices</td>
						<td>{{ $row->space_specific_devices }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Category</td>
						<td>{!! SiteHelpers::gridDisplayView($row->space_category,'space_category','1:tb_categories:id:category_name') !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td>{{ $row->space_status }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created At</td>
						<td>{{ $row->created_at }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Updated At</td>
						<td>{{ $row->updated_at }} </td>
						
					</tr>
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop