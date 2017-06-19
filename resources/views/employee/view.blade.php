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
		<li><a href="{{ URL::to('employee?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper">   
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('employee?return='.$return) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('employee/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  		   	  
		</div>
<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> </h4></div>
	<div class="sbox-content"> 	


	
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>EmployeeId</td>
						<td>{{ $row->EmployeeId }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>LastName</td>
						<td>{{ $row->LastName }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>FirstName</td>
						<td>{{ $row->FirstName }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>ReportsTo</td>
						<td>{{ $row->ReportsTo }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>BirthDate</td>
						<td>{{ $row->BirthDate }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>HireDate</td>
						<td>{{ $row->HireDate }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Phone</td>
						<td>{{ $row->Phone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Email</td>
						<td>{{ $row->Email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Foto</td>
						<td>{{ $row->Foto }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td>{{ $row->Status }} </td>
						
					</tr>
				
		</tbody>	
	</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop