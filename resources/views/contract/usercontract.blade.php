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
                <div class="table-responsive" style="min-height:300px;">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th class="number"> No </th>
                                <th>Title</th>
                            </tr>
                        </thead>

                        <tbody>        						
                            @foreach ($rowData as $row)
                            <tr>
                                <td width="30"> {{ ++$i }} </td>
                                <td>{{$row->title}}</td>			 
                            </tr>

                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>	
    </div>	  
</div>	
<script>
    $(document).ready(function () {

        $('.do-quick-search').click(function () {
            $('#SximoTable').attr('action', '{{ URL::to("contract/multisearch")}}');
            $('#SximoTable').submit();
        });

    });
</script>		
@stop