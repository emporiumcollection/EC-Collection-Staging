@extends('admin.layouts.index')

@section('content')

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper main-style-it-max">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1><i class="fa fa-cubes" aria-hidden="true"></i> @lang('crmlayout.admin_crmlayout_module_title') <small>@lang('crmlayout.admin_crmlayout_module_sub_title')</small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        @include('admin/includes/ne_breadcrumb')
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
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
        <!-- END PAGE BASE CONTENT -->
        <!-- BEGIN FOOTER -->
        @include('admin/includes/ne_footer')
        <!-- END FOOTER -->
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<!-- start: Delete Coupon Modal -->
<div class="modal fade" id="deletecrmlayout" tabindex="-1" role="dialog" aria-labelledby="mddeletecrmlayoutLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="deletecrmlayoutLabel">@lang('crmlayout.admin_crmlayout_module_list_action_remove_btn')</h3>

            </div>
            <div class="modal-body">
                <h4> @lang('crmlayout.admin_crmlayout_module_delete_confirmation')</h4>

            </div>
            <!--/modal-body-collapse -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-action="btnDeleteYes" data-action-url="">@lang('crmlayout.admin_crmlayout_module_delete_confirmation_btn_yes')</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('crmlayout.admin_crmlayout_module_delete_confirmation_btn_no')</button>
            </div>
            <!--/modal-footer-collapse -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@stop

@section('style')
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
@endsection	

@section('script')
<script src="{{ asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js')}}" type="text/javascript"></script>
@endsection

@section('custom_js_script')
<script>
jQuery(document).ready(function () {
$(document).on('click', '[data-action="remove"]', function (e) {
e.preventDefault();
$('#deletecrmlayout button[data-action="btnDeleteYes"]').attr('data-action-url', $(this).attr('href'));
$('#deletecrmlayout').modal('show');

});
$(document).on('click', '[data-action="btnDeleteYes"]', function (e) {
location.href = $(this).data('action-url');
});

$('#crmlayoutlist').DataTable({
"language": {
"lengthMenu": "{{trans('crmlayout.admin_crmlayout_module_table_record_per_page_suffix')}} _MENU_ {{trans('crmlayout.admin_crmlayout_module_table_record_per_page_prefix')}}",
"info": "{{trans('crmlayout.admin_crmlayout_module_table_page_of_pages')}} _PAGE_ of _PAGES_",
"search": "{{trans('crmlayout.admin_crmlayout_module_table_search_box')}}",
}
});
});
</script>
@endsection