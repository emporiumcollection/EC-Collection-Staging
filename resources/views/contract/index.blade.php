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
                    <a href="{{ URL::to('contract/update') }}" class="tips btn btn-sm btn-white"  title="{{ Lang::get('core.btn_create') }}">
                        <i class="fa fa-plus-circle "></i>&nbsp;{{ Lang::get('core.btn_create') }}</a>
                    @endif  
                    @if($access['is_remove'] ==1)
                    <a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_remove') }}">
                        <i class="fa fa-minus-circle "></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
                    @endif 
                    <a href="{{ URL::to( 'contract/search') }}" class="btn btn-sm btn-white" onclick="SximoModal(this.href, 'Advance Search'); return false;" ><i class="fa fa-search"></i> Search</a>				
                    @if($access['is_excel'] ==1)
                    <a href="{{ URL::to('contract/download?return='.$return) }}" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_download') }}">
                        <i class="fa fa-download"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
                    @endif			

                </div> 		



                {!! Form::open(array('url'=>'contract/delete/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) !!}
                <div class="table-responsive" style="min-height:300px;">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th class="number"> No </th>
                                <th> <input type="checkbox" class="checkall" /></th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Ordering</th>
                                <th width="70" >{{ Lang::get('core.btn_action') }}</th>
                            </tr>
                        </thead>

                        <tbody>        						
                            @foreach ($rowData as $row)
                            <tr>
                                <td width="30"> {{ ++$i }} </td>
                                <td width="50"><input type="checkbox" class="ids" name="ids[]" value="{{ $row->contract_id }}" />  </td>									
                                <td>{{$row->title}}</td>
                                <td>{{ucfirst(str_replace('-',' ',trim($row->contract_type)))}}</td>
                                <td>@if((bool) $row->status) Active @else Inactive @endif</td>
                                <td>
                                    @if($radtotalRecords!= $i)
                						<a href="#" class="tips btn btn-xs btn-primary" title="Move Down" onclick="return change_ordering('down','{{$row->contract_id}}');"><i class="fa  fa-arrow-down"></i></a>
                					@endif
                					@if($i > 1)
                						<a href="#" class="tips btn btn-xs btn-primary" title="Move Up" onclick="return change_ordering('up','{{$row->contract_id}}');"><i class="fa fa-arrow-up"></i></a>
                					@endif
                                </td>
                                <td>
                                    @if($access['is_detail'] ==1)
                                    <a href="{{ URL::to('contract/show/'.$row->contract_id.'?return='.$return)}}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search "></i></a>
                                    @endif
                                    @if($access['is_edit'] ==1)
                                    <a  href="{{ URL::to('contract/update/'.$row->contract_id.'?return='.$return) }}" class="tips btn btn-xs btn-success" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i></a>
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
{!! Form::open(array('url'=>'contract/changeordering', 'class'=>'columns' ,'id' =>'change_order_num', 'method'=>'post' )) !!}
	<input type="hidden" name="pid" id="pid" value="" />
	<input type="hidden" name="order_type" id="order_type" value="" />
	<input type="hidden" name="curnurl" value="{{ Request::url().'?page='.$curr_page }}" />
</form>	
<script>
    $(document).ready(function () {

        $('.do-quick-search').click(function () {
            $('#SximoTable').attr('action', '{{ URL::to("contract/multisearch")}}');
            $('#SximoTable').submit();
        });

    });
function change_ordering(type, fieldId)
{
	if(fieldId>0)
	{
		$('#pid').val(fieldId);
		$('#order_type').val(type);
		$( "#change_order_num" ).submit();
	}
    
    return false;
}
</script>		
@stop