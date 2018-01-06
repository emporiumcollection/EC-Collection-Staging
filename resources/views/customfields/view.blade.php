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
		<li><a href="{{ URL::to('customfields?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('customfields?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
		@if($access['is_add'] ==1)
   		<a href="{{ URL::to('customfields/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
		@endif 
	</div>
	<div class="sbox-content" style="background:#fff;"> 	

		<table class="table table-striped table-bordered" >
			<tbody>	
		
					<tr>
						<td width='30%' class='label-view text-right'>Type</td>
						<td>{{ $row->type }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Caption</td>
						<td>{{ $row->caption }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Published</td>
						<td>{{ ($row->published==1)? 'Yes' : 'No' }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Details View</td>
						<td>{{ ($row->show_detail_view==1)? 'Yes' : 'No' }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Summary View</td>
						<td>{{ ($row->show_summary_view==1)? 'Yes' : 'No' }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Simple Searchable</td>
						<td>{{ ($row->simple_search==1)? 'Yes' : 'No' }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Advanced Searchable</td>
						<td>{{ ($row->advance_search==1)? 'Yes' : 'No' }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Required</td>
						<td>{{ ($row->required==1)? 'Yes' : 'No' }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ordering</td>
						<td>{{ $row->order_num }} </td>
						
					</tr>
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop