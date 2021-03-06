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
		<li><a href="{{ URL::to('packages?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('packages?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
		@if($access['is_add'] ==1)
   		<a href="{{ URL::to('packages/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
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
						<td width='30%' class='label-view text-right'>Title</td>
						<td>{{ $row->package_title }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Description</td>
						<td>{{ $row->package_description }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Image</td>
						<td>{!! SiteHelpers::showUploadedFile($row->package_image,'/uploads/packages/') !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Price Type</td>
						<td>{{ $row->package_price_type }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Price</td>
						<td>{{ $row->package_price }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Duration Type</td>
						<td>{{ $row->package_duration_type }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Duration</td>
						<td>{{ $row->package_duration }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td>{{ $row->package_status }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Package Usp</td>
						<td>{{ $row->package_usp }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Package Category</td>
						<td>{{ $row->package_category }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Package Modules</td>
						<td>{{ $row->package_modules }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Allow User Groups</td>
						<td>{{ $row->allow_user_groups }} </td>
						
					</tr>
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop