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
		<li><a href="{{ URL::to('postprojects?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('postprojects?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
		@if($access['is_add'] ==1)
   		<a href="{{ URL::to('postprojects/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
		@endif 
	</div>
	<div class="sbox-content" style="background:#fff;"> 	

		<table class="table table-striped table-bordered" >
			<tbody>	
		
					<tr>
						<td width='30%' class='label-view text-right'>Photography</td>
						<td>{{ $row->image_credit }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Image</td>
						<td>{!! SiteHelpers::showUploadedFile($row->image_pos_1,'/uploads/project_imgs/') !!} </td>
						
					</tr>
				
			<?php 
			$limited = isset($fields['title_pos_1']['limited']) ? $fields['title_pos_1']['limited'] :'';
			if(SiteHelpers::filterColumn($limited )) { ?>
						
					<tr>
						<td width='30%' class='label-view text-right'>Title</td>
						<td>{{ $row->title_pos_1 }} </td>
						
					</tr>
				
			<?php } ?>
			<?php 
			$limited = isset($fields['description_pos_1']['limited']) ? $fields['description_pos_1']['limited'] :'';
			if(SiteHelpers::filterColumn($limited )) { ?>
						
					<tr>
						<td width='30%' class='label-view text-right'>Description</td>
						<td>{{ $row->description_pos_1 }} </td>
						
					</tr>
				
			<?php } ?>
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td>{{ $row->status }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Publish Date</td>
						<td>{{ $row->publish_date }} </td>
						
					</tr>
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop