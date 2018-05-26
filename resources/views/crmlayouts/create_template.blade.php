@extends('layouts.app')

@section('content')
<link href="{{ asset('sximo/crm_layout/css/style.css')}}" rel="stylesheet" type="text/css"/>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper main-style-it-max">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1><i class="fa fa-cubes" aria-hidden="true"></i> Template: <?php echo $template->template_name; ?></h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row" >
            <div class="col-md-12 col-sm-12">
                <div class="mt-element-step">
                    <div>
                        <div class="row step-thin ">
                            <div class="col-lg-4 bg-grey mt-step-col">
                                <div class="mt-step-number first bg-white font-grey ">1</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Info</div>
                                <div class="mt-step-content font-grey-cascade">Template Info</div>
                            </div>
                            <div class="col-lg-4 bg-grey mt-step-col active">
                                <div class="mt-step-number bg-white font-grey">2</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Builder</div>
                                <div class="mt-step-content font-grey-cascade">Template Builder</div>
                            </div>
                            <div class="col-lg-4 bg-grey mt-step-col">
                                <div class="mt-step-number bg-white font-grey">3</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Apply</div>
                                <div class="mt-step-content font-grey-cascade">Apply Template</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet light ">
                    <div class="portlet-body form" id="from-group-style">

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))

                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                            @endforeach
                        </div>

                        <!--VC Start-->
                        @include('layouts/crm_layout/ai_crm_vc_fields')
                        <!--VC End-->

                        <div class="form-actions noborder right">
                            <a class="btn btn-primary" href="{{URL::to('crmlayouts/apply_template')}}/{{$template->template_id}}">Next</a>
                            <a class="btn btn-default" href="{{route('crmlayouts.index')}}">Cancel</a>
                        </div>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
@stop

@section('script')
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
@endsection

@section('custom_js_script')
@include('layouts/crm_layout/ai_crm_vc')
@endsection