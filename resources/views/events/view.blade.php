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
		<li><a href="{{ URL::to('events?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('events?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
		@if($access['is_add'] ==1)
   		<a href="{{ URL::to('events/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
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
						<td>{{ $row->title }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Alias</td>
						<td>{{ $row->alias }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Desciription</td>
						<td>{{ $row->desciription }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Video</td>
						<td>{{ $row->video }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Video Type</td>
						<td>{{ $row->video_type }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Video Link Type</td>
						<td>{{ $row->video_link_type }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Video Link</td>
						<td>{{ $row->video_link }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Designer</td>
						<td>{{ $row->designer }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Url</td>
						<td>{{ $row->url }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Usp Text</td>
						<td>{{ $row->usp_text }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Usp Person</td>
						<td>{{ $row->usp_person }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Manager Text</td>
						<td>{{ $row->manager_text }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Opening Hrs</td>
						<td>{{ $row->opening_hrs }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Phonenumber</td>
						<td>{{ $row->phonenumber }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Meta Keyword</td>
						<td>{{ $row->meta_keyword }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Meta Description</td>
						<td>{{ $row->meta_description }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Category Id</td>
						<td>{{ $row->category_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Property Id</td>
						<td>{{ $row->property_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>User Id</td>
						<td>{{ $row->user_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Reservation Contact</td>
						<td>{{ $row->reservation_contact }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Reservation Email</td>
						<td>{{ $row->reservation_email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Event Type</td>
						<td>{{ $row->event_type }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Website</td>
						<td>{{ $row->website }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Location</td>
						<td>{{ $row->location }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created</td>
						<td>{{ $row->created }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Updated</td>
						<td>{{ $row->updated }} </td>
						
					</tr>
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop