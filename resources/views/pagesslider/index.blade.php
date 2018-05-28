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
	   		<a href="{{ URL::to('pagesslider/update') }}" class="tips btn btn-sm btn-white"  title="{{ Lang::get('core.btn_create') }}">
			<i class="fa fa-plus-circle "></i>&nbsp;{{ Lang::get('core.btn_create') }}</a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_remove') }}">
			<i class="fa fa-minus-circle "></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 
			<a href="{{ URL::to( 'pagesslider/search') }}" class="btn btn-sm btn-white" onclick="SximoModal(this.href,'Advance Search'); return false;" ><i class="fa fa-search"></i> Search</a>				
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('pagesslider/download?return='.$return) }}" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_download') }}">
			<i class="fa fa-download"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
			@endif			
		 
		</div> 		

	
	
	 {!! Form::open(array('url'=>'pagesslider/delete/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) !!}
	 <select name='slider_page' id='slider_page' class="select2" onchange="fetchslidercategory(this.value);" > 
		<option value="">-Select-</option>
		@if(!empty($allpages))
			@foreach($allpages as $catlist)
				<option value="{{$catlist->pageID}}" <?php echo (isset($curntcat) && $curntcat == $catlist->pageID) ? " selected='selected' " : '' ; ?>>{{$catlist->title}}</option>
			@endforeach
		@endif
	</select>
	 <div class="table-responsive" style="min-height:300px;">
    <table class="table table-striped ">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')				
						<?php $limited = isset($t['limited']) ? $t['limited'] :''; ?>
						@if(SiteHelpers::filterColumn($limited ))
						
							<th>{{ $t['label'] }}</th>			
						@endif 
					@endif
				@endforeach
				<th width="70">Status</th>
				<th width="100">Ordering</th>
				<th width="70" >{{ Lang::get('core.btn_action') }}</th>
			  </tr>
        </thead>

        <tbody>        						
            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="ids[]" value="{{ $row->id }}" />  </td>									
				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 	<?php $limited = isset($field['limited']) ? $field['limited'] :''; ?>
					 	@if(SiteHelpers::filterColumn($limited ))
						 <td>					 
						 	@if($field['attribute']['image']['active'] =='1')
								{!! SiteHelpers::showUploadedFile($row->{$field['field']},$field['attribute']['image']['path']) !!}
							@else	
								{{--*/ $conn = (isset($field['conn']) ? $field['conn'] : array() ) /*--}}
								{!! SiteHelpers::gridDisplay($row->{$field['field']},$field['field'],$conn) !!}	
							@endif						 
						 </td>
						@endif	
					 @endif					 
				 @endforeach
				 <td>
					@if($row->slider_status==1)
						<a  href="#" class="tips btn btn-xs btn-success" title="Click to Disable " onclick="change_option(this,'slider_status','{{$row->id}}',0);"><i class="fa fa-check "></i></a>
					@else
						<a  href="#" class="tips btn btn-xs btn-danger" title="Click to enable " onclick="change_option(this,'slider_status','{{$row->id}}',1);"><i class="fa fa-times "></i></a>
					@endif
				</td>
				
				<td>
					@if(count($rowData)!=$i)
						<a href="#" class="tips btn btn-xs btn-primary" title="Move Down" onclick="change_ordering('down','{{$row->id}}');"><i class="fa  fa-arrow-down"></i></a>
					@endif
					@if($rowData[0]!=$row)
						<a href="#" class="tips btn btn-xs btn-primary" title="Move Up" onclick="change_ordering('up','{{$row->id}}');"><i class="fa fa-arrow-up"></i></a>
					@endif
				</td>
				 <td>
					 	@if($access['is_detail'] ==1)
						<a href="{{ URL::to('pagesslider/show/'.$row->id.'?return='.$return)}}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search "></i></a>
						@endif
						@if($access['is_edit'] ==1)
						<a  href="{{ URL::to('pagesslider/update/'.$row->id.'?return='.$return) }}" class="tips btn btn-xs btn-success" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i></a>
						@endif
												
					
				</td>				 
                </tr>
				
            @endforeach
              
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
<!-- Selected Files/Folder downloaded as High PDF -->
{!! Form::open(array('url'=>'change_order_num_pagessliders', 'class'=>'columns' ,'id' =>'change_order_num_pagessliders', 'method'=>'post' )) !!}
	<input type="hidden" name="sliderID" id="sliderID" value="">
	<input type="hidden" name="order_type" id="order_type" value="">
	<input type="hidden" name="curnurl" value="{{ Request::url().'?selpage='.$curntcat }}">
</form>	
<script>
$(document).ready(function(){
	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','{{ URL::to("pagesslider/multisearch")}}');
		$('#SximoTable').submit();
	});
	
});	
function fetchslidercategory(catg)
{
	window.location.href = "{{URL::to('pagesslider')}}?selpage="+catg;
}

function change_option(row,filed_name,row_id,act)
{
	if(row_id!='' && row_id>0)
	{
		$.ajax({
		  url: "{{ URL::to('enable_diable_pagessliderstatus')}}",
		  type: "post",
		  data: 'filed_name='+filed_name+'&row_id='+row_id+'&action='+act,
		  success: function(data){
			if(data!='error')
			{
				if(act==1)
				{
					$(row).removeClass('btn-danger');
					$(row).addClass('btn-success');
					$(row).children( "i.fa" ).removeClass('fa-times');
					$(row).children( "i.fa" ).addClass('fa-check');
					$(row).attr("onclick","change_option(this,'"+filed_name+"','"+row_id+"',0)");
					$(row).attr("title","Click to Disable");
					$(row).attr("data-original-title","Click to Disable");
				}
				else if(act==0)
				{	
					$(row).removeClass('btn-success');
					$(row).addClass('btn-danger');
					$(row).children( "i.fa" ).removeClass('fa-check');
					$(row).children( "i.fa" ).addClass('fa-times');
					$(row).attr("onclick","change_option(this,'"+filed_name+"','"+row_id+"',1)");
					$(row).attr("title","Click to Enable");
					$(row).attr("data-original-title","Click to Enable");
				}
			}
		  }
		});
	}
}

function change_ordering(type, fieldId)
{
	if(fieldId>0)
	{
		$('#sliderID').val(fieldId);
		$('#order_type').val(type);
		$( "#change_order_num_pagessliders" ).submit();
	}
}
</script>		
@stop