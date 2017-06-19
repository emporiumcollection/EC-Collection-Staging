@extends('layouts.app')
@section('content')
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"> Dashboard </a></li>
        <li class="active">{{ $pageTitle }}</li>
      </ul>	  
	  
    </div>

    <div class="page-content-wrapper m-t">	
		<div class="sbox animated fadeInRight">
			<div class="sbox-title"> <h5> <i class="fa fa-table"></i> </h5>
				<div class="sbox-tools" >
					@if(Session::get('gid') ==1)
						<a href="{{ URL::to('sximo/module/config/'.$pageModule) }}" class="btn btn-xs btn-white tips" title=" {{ Lang::get('core.btn_config') }}" ><i class="fa fa-cog"></i></a>
					@endif 
				</div>
			</div>
			<div class="sbox-content"> 	
				<div class="toolbar-line ">
					@if($access['is_remove'] ==1)
					<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_remove') }}">
					<i class="fa fa-minus-circle "></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
					@endif
				</div> 		

			
			
				{!! Form::open(array('url'=>'designerdetails/delete/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) !!}
				<div class="table-responsive" style="min-height:300px;">
					<table class="table table-striped ">
						<thead>
							<tr>
								<th class="number"> No </th>
								<th> <input type="checkbox" class="checkall" /></th>
								<th>Desinger Name</th>
								<th>Desinger Description</th>
								<th width="70" >{{ Lang::get('core.btn_action') }}</th>
							  </tr>
						</thead>

						<tbody>  
						{{--*/ $i=0 /*--}}
							@foreach ($assigned_designers as $row)
								<tr>
									<td width="30"> {{ ++$i }} </td>
									<td width="50"><input type="checkbox" class="ids" name="ids[]" value="{{ $row->designer_id }}" />  </td>
									<td>{{$row->designer_name}}</td>
									<td>{{$row->designer_description}}</td>
									<td>
										@if($access['is_edit'] ==1)
										<a  href="{{ URL::to('designerdetails/update/'.$row->designer_id.'?return='.$return) }}" class="tips btn btn-xs btn-success" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i></a>
										@endif
									</td>				 
								</tr>
							@endforeach  
						</tbody>
					</table>
					<input type="hidden" name="md" value="" />
				</div>
				{!! Form::close() !!}
			</div>
		</div>
    </div>
@stop