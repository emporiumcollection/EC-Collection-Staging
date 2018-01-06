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
		<li><a href="{{ URL::to('categories?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('categories?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
		@if($access['is_add'] ==1)
   		<a href="{{ URL::to('categories/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
		@endif 
	</div>
	<div class="sbox-content" style="background:#fff;"> 	

		<table class="table table-striped table-bordered" >
			<tbody>	
		
					<tr>
						<td width='30%' class='label-view text-right'>Category Name</td>
						<td>{{ $row->category_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Parent Category</td>
						<td>{!! SiteHelpers::gridDisplayView($row->parent_category_id,'parent_category_id','1:tb_categories:id:category_name') !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Category Description</td>
						<td>{{ $row->category_description }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Category Image</td>
						<td>{!! SiteHelpers::showUploadedFile($row->category_image,'/uploads/category_imgs/') !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Featured</td>
						<td>{{ $row->category_featured }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Published</td>
						<td>{{ $row->category_published }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ordering</td>
						<td>{{ $row->category_order_num }} </td>
						
					</tr>
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop