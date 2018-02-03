@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}
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
		<a href="{{ url($pageModule) }}" class="btn btn-xs btn-white tips" title="Clear Search" ><i class="fa fa-trash-o"></i> Clear Search </a>
		@if(Session::get('gid') ==1)
			<a href="{{ URL::to('sximo/module/config/'.$pageModule) }}" class="btn btn-xs btn-white tips" title=" {{ Lang::get('core.btn_config') }}" ><i class="fa fa-cog"></i></a>
		@endif 
		</div>
	</div>
	<div class="sbox-content"> 	
	    <div class="toolbar-line ">
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('personalizedservice/update') }}" class="tips btn btn-sm btn-white"  title="{{ Lang::get('core.btn_create') }}">
			<i class="fa fa-plus-circle "></i>&nbsp;{{ Lang::get('core.btn_create') }}</a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_remove') }}">
			<i class="fa fa-minus-circle "></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 
			<a href="{{ URL::to( 'personalizedservice/search') }}" class="btn btn-sm btn-white" onclick="SximoModal(this.href,'Advance Search'); return false;" ><i class="fa fa-search"></i> Search</a>				
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('personalizedservice/download?return='.$return) }}" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_download') }}">
			<i class="fa fa-download"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
			@endif			
		 
		</div> 		

	
	
	 {!! Form::open(array('url'=>'personalizedservice/delete/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) !!}
	 <div class="table-responsive" style="min-height:300px;">
    <table class="table table-striped ">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th>Salutation</th>
				<th>First Name</th>
				<th>Surname</th>
				<th>Email</th>
				<th>Adults</th>
				<th>Youth</th>
				<th>Children</th>
				<th>Toddlers</th>
				<th>Earliest Arrival</th>
				<th>Late Check Out</th>
				<th>Stay Time</th>
				<th>Note</th>
				<th width="70" >{{ Lang::get('core.btn_action') }}</th>
			  </tr>
        </thead>

        <tbody>
            <?php
            if(!empty($rowData)) {
                foreach ($rowData as $row) {
                    echo '<tr>';
                    ?>
                    <td width="30"> {{ ++$i }} </td>
                    <td width="50"><input type="checkbox" class="ids" name="ids[]" value="{{ $row->ps_id }}" />  </td>
                    <?php
                    echo '<td>'.$row->salutation.'</td>
                            <td>'.$row->first_name.'</td>
                            <td>'.$row->surname.'</td>
                            <td>'.$row->email.'</td>
                            <td>'.$row->adults.'</td>
                            <td>'.$row->youth.'</td>
                            <td>'.$row->children.'</td>
                            <td>'.$row->toddlers.'</td>
                            <td>'.$row->earliest_arrival.'</td>
                            <td>'.$row->late_check_out.'</td>
                            <td>'.$row->stay_time.'</td>
                            <td>'.$row->note.'</td>';
                    ?>
                            <td>
                                @if($access['is_detail'] ==1 && 0)
                                <a href="{{ URL::to('personalizedservice/show/'.$row->ps_id.'?return='.$return)}}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search "></i></a>
                                @endif
                                @if($access['is_edit'] ==1)
                                <a  href="{{ URL::to('personalizedservice/update/'.$row->ps_id.'?return='.$return) }}" class="tips btn btn-xs btn-success" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i></a>
                                @endif		
                            </td>	
                    <?php
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
      
    </table>
	<input type="hidden" name="md" value="" />
	</div>
	{!! Form::close() !!}
	@include('footer')
	</div>
</div>	
	</div>	  
</div>	
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','{{ URL::to("personalizedservice/multisearch")}}');
		$('#SximoTable').submit();
	});
	
});	
</script>		
@stop