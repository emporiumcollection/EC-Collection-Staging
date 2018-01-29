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
                <div class="row" >
                    <div class="col-md-12 col-sm-12">
                        <div class="portlet light bordered">

                            <div class="portlet-title">
                                <div class="caption font-dark"><i class="fa fa-cubes" aria-hidden="true"></i> 
                                    <span class="caption-subject "> @lang('crmlayout.admin_crmlayout_module_title')</span>
                                </div>
                                <div class="actions">
                                    @if(isset($access['create-crmlayout']) || isset($access['all']))
                                    <a id="sample_editable_1_new" class="btn  blue m-t-0" href="{{route('crmlayouts.create')}}"> @lang('crmlayout.admin_crmlayout_module_add_new_btn')
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    @endif
                                </div>

                            </div>

                            <div class="portlet-body">
                                <div class="flash-message">
                                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))

                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                    @endforeach

                                    @include('admin.crmlayouts.table')
                                </div>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>


                @include('footer')
            </div>
        </div>	
    </div>	  
</div>	
<script>
    $(document).ready(function () {

        $('.do-quick-search').click(function () {
            $('#SximoTable').attr('action', '{{ URL::to("crmlayout/multisearch")}}');
            $('#SximoTable').submit();
        });

    });
</script>		
@stop