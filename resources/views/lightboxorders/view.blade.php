@extends('layouts.app')

@section('content')
<style>
.ord_items
{
	list-style:none;
}

.ord_items li {
	width:15%;
	float:left;
}

</style>
<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('lightboxorders?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('lightboxorders?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
		@if($access['is_add'] ==1)
   		<!--<a href="{{ URL::to('lightboxorders/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>-->
		@endif 
	</div>
	<div class="sbox-content" style="background:#fff;"> 	

		<table class="table table-striped table-bordered" >
			<tbody>	
		
					<tr>
						<td width='30%' class='label-view text-right'>Lightbox Name</td>
						<td>{!! SiteHelpers::gridDisplayView($row->lightbox_id,'lightbox_id','1:tb_lightbox:id:box_name') !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>User</td>
						<td>{!! SiteHelpers::gridDisplayView($row->user_id,'user_id','1:tb_users:id:first_name|last_name') !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Reserved Till</td>
						<td>{{ $row->reserve_till }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Comments</td>
						<td>{{ $row->comments }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td>{{ $row->status }} </td>
						
					</tr>
					
					<tr>
						<td colspan="2">
							<ul class="ord_items">
								@if(!empty($orderitems))
									@foreach($orderitems as $item)
										<li>
											<img src="{{URL::to('uploads/thumbs/').'/thumb_'.$item->folder_id.'_'.$item->file_name}}" alt="{{$item->file_display_name}}">
										</li>
									@endforeach
								@endif
							</ul>
						</td>
					</tr>
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop