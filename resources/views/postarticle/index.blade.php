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
	   		<a href="{{ URL::to('postarticle/update') }}" class="tips btn btn-sm btn-white"  title="{{ Lang::get('core.btn_create') }}">
			<i class="fa fa-plus-circle "></i>&nbsp;{{ Lang::get('core.btn_create') }}</a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_remove') }}">
			<i class="fa fa-minus-circle "></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 
			<a href="{{ URL::to( 'postarticle/search') }}" class="btn btn-sm btn-white" onclick="SximoModal(this.href,'Advance Search'); return false;" ><i class="fa fa-search"></i> Search</a>				
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('postarticle/download?return='.$return) }}" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_download') }}">
			<i class="fa fa-download"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
			@endif			
		 
		</div> 		

{!! Form::open(array('url'=>'postarticle/delete/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) !!}
	<div class="tab-container tab-left">
		<ul class="nav nav-tabs flat-tabs">
			@if(!empty($allcategories))
			{{--*/$c=1;/*--}}
				@foreach($allcategories as $catlist)
					<li class="{{($c==1)?'active':''}}"><a href="#{{$catlist->cat_name.'-'.$catlist->cat_id}}" data-toggle="tab">{{$catlist->cat_name}}</a></li>
					{{--*/$c++;/*--}}
				@endforeach
			@endif
		</ul>
		<div class="tab-content use-padding">
			@if(!empty($allcategories))
			{{--*/$cc=1;/*--}}
				@foreach($allcategories as $catlist)
				
					<div class="tab-pane use-padding {{($cc==1)?'active':''}}" id="{{$catlist->cat_name.'-'.$catlist->cat_id}}">
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
										<th width="70" >{{ Lang::get('core.btn_action') }}</th>
									  </tr>
								</thead>

								<tbody>   
								@if(array_key_exists($catlist->cat_id,$rowData))
									@foreach ($rowData[$catlist->cat_id] as $row)
										<tr>
											<td width="30"> {{ ++$i }} </td>
											<td width="50"><input type="checkbox" class="ids" name="ids[]" value="{{ $row->id }}" />  </td>								
											<td>{{ (!empty($categories)) ? $categories[$row->cat_id] : '' }}</td>
											<td>{!! SiteHelpers::showUploadedFile($row->image_pos_1,'/uploads/article_imgs/') !!}</td>
											<td>{{ $row->title_pos_1 }}</td>
											<td>{!! $row->description_pos_1 !!}</td>
											<td>{{ $row->status }}</td>
											<td>{{ $row->publish_date }}</td>
										 <td>
												@if($access['is_detail'] ==1)
												<a href="{{ URL::to('postarticle/show/'.$row->id.'?return='.$return)}}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search "></i></a>
												@endif
												@if($access['is_edit'] ==1)
												<a  href="{{ URL::to('postarticle/update/'.$row->id.'?return='.$return) }}" class="tips btn btn-xs btn-success" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i></a>
												@endif
																		
											
										</td>				 
										</tr>
										
									@endforeach 
								@else
									<tr><td colspan="9" align="center">No Record Found</td></tr>
								@endif
								</tbody>
							</table>
						</div>
					</div>
					{{--*/$cc++;/*--}}
				@endforeach
			@endif
		</div>
    </div>
	<input type="hidden" name="md" value="" />
{!! Form::close() !!}

	@include('footer')
	</div>
</div>	
	</div>	  
</div>	
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','{{ URL::to("postarticle/multisearch")}}');
		$('#SximoTable').submit();
	});
	
});	
</script>		
@stop