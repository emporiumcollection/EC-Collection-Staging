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
		<li><a href="{{ URL::to('pagesslider?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('pagesslider?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
		@if($access['is_add'] ==1)
   		<a href="{{ URL::to('pagesslider/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
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
						<td width='30%' class='label-view text-right'>Slider Page Id</td>
						<td>{{ $row->slider_page_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Slider Title</td>
						<td>{{ $row->slider_title }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Slider Description</td>
						<td>{{ $row->slider_description }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Slider Img</td>
						<td>{{ $row->slider_img }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Slider Link</td>
						<td>{{ $row->slider_link }} </td>
						
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
						<td width='30%' class='label-view text-right'>Slider Video</td>
						<td>{{ $row->slider_video }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Slide Type</td>
						<td>{{ $row->slide_type }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Advert Id</td>
						<td>{{ $row->advert_id }} </td>
						
					</tr>
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop