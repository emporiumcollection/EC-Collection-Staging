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
		<li><a href="{{ URL::to('presentation?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('presentation?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
		@if($access['is_add'] ==1)
   		<a href="{{ URL::to('presentation/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
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
						<td width='30%' class='label-view text-right'>Page Name</td>
						<td>{{ $row->page_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Page Title</td>
						<td>{{ $row->page_title }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Page Keyword</td>
						<td>{{ $row->page_keyword }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Page Meta Description</td>
						<td>{{ $row->page_meta_description }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Page Description</td>
						<td>{{ $row->page_description }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Page Image</td>
						<td>{!! SiteHelpers::showUploadedFile($row->page_image,'/uploads/presentation/') !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Page Slug</td>
						<td>{{ $row->page_slug }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>User Id</td>
						<td>{{ $row->user_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created</td>
						<td>{{ $row->created }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Updated</td>
						<td>{{ $row->updated }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Presentation Mode</td>
						<td>{{ $row->presentation_mode }} </td>
						
					</tr>
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop