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
		<li><a href="{{ URL::to('personalizedservice?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('personalizedservice?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
		@if($access['is_add'] ==1)
   		<a href="{{ URL::to('personalizedservice/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
		@endif 
	</div>
	<div class="sbox-content" style="background:#fff;"> 	

		<table class="table table-striped table-bordered" >
			<tbody>	
		
					<tr>
						<td width='30%' class='label-view text-right'>Ps Id</td>
						<td>{{ $row->ps_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Salutation</td>
						<td>{{ $row->salutation }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>First Name</td>
						<td>{{ $row->first_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Surname</td>
						<td>{{ $row->surname }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Email</td>
						<td>{{ $row->email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Adults</td>
						<td>{{ $row->adults }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Youth</td>
						<td>{{ $row->youth }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Children</td>
						<td>{{ $row->children }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Toddlers</td>
						<td>{{ $row->toddlers }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Earliest Arrival</td>
						<td>{{ $row->earliest_arrival }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Late Check Out</td>
						<td>{{ $row->late_check_out }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Stay Time</td>
						<td>{{ $row->stay_time }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Destinations</td>
						<td>{{ $row->destinations }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Inspirations</td>
						<td>{{ $row->inspirations }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Experiences</td>
						<td>{{ $row->experiences }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Note</td>
						<td>{{ $row->note }} </td>
						
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