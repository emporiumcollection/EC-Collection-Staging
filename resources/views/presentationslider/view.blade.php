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
		<li><a href="{{ URL::to('presentationslider?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('presentationslider?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
		@if($access['is_add'] ==1)
   		<a href="{{ URL::to('presentationslider/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
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
						<td width='30%' class='label-view text-right'>Presentation Page </td>
						<td>{!! SiteHelpers::gridDisplayView($row->presentation_page_id,'presentation_page_id','1:tb_presentation_pages:id:page_name') !!} </td>
						
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
						<td width='30%' class='label-view text-right'>Slider Sub Title</td>
						<td>{{ $row->slider_sub_title }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Slider Sub Description</td>
						<td>{{ $row->slider_sub_description }} </td>
						
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
				
					<tr>
						<td width='30%' class='label-view text-right'>Slider Status</td>
						<td>{{ $row->slider_status }} </td>
						
					</tr>
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop