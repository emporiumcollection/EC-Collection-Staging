@extends('layouts.app')

@section('content')
<style>
    .mt-element-step .row {
        margin: 0;
    }
    .mt-element-step .step-thin .active {
        background-color: #32c5d2 !important;
    }
    .mt-element-step .step-thin .mt-step-col {
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .bg-grey {
        background: #E5E5E5 !important;
    }
    .mt-element-step .step-thin .active .mt-step-number {
        color: #32c5d2 !important;
    }
    .mt-element-step .step-thin .mt-step-number {
        font-size: 26px;
        border-radius: 50% !important;
        float: left;
        margin: auto;
        padding: 3px 14px;
    }
    .font-grey {
        color: #E5E5E5 !important;
    }
    .bg-white {
        background: #fff !important;
    }
    .mt-element-step .step-thin .active .mt-step-content, .mt-element-step .step-thin .active .mt-step-title {
        color: #fff !important;
    }
    .mt-element-step .step-thin .mt-step-title {
        font-size: 24px;
        font-weight: 100;
        padding-left: 60px;
        margin-top: -4px;
    }
    .font-grey-cascade {
        color: #95A5A6 !important;
    }
    .uppercase {
        text-transform: uppercase !important;
    }
    .mt-element-step .step-thin .active .mt-step-content, .mt-element-step .step-thin .active .mt-step-title {
        color: #fff !important;
    }
    .mt-element-step .step-thin .mt-step-content {
        padding-left: 60px;
        margin-top: -5px;
    }
    .font-grey-cascade {
        color: #95A5A6 !important;
    }
    .portlet {
        margin-top: 0;
        margin-bottom: 25px;
        padding: 0;
        border-radius: 4px;
    }
    .portlet.light {
        padding: 12px 20px 15px;
        background-color: #fff;
    }
</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper main-style-it-max">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1><i class="fa fa-cubes" aria-hidden="true"></i> Template</h1>
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
                            <div class="col-lg-4 bg-grey mt-step-col active">
                                <div class="mt-step-number first bg-white font-grey ">1</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Info</div>
                                <div class="mt-step-content font-grey-cascade">Template Info</div>
                            </div>
                            <div class="col-lg-4 bg-grey mt-step-col">
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
						
                        {!! Form::model($crmlayouts, ['route' => ['crmlayouts.update', $crmlayouts->template_id], 'method' => 'patch']) !!}

							@include('crmlayouts.fields')

					   {!! Form::close() !!}
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

@endsection