@extends('layouts.app')

@section('content')

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper main-style-it-max">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1><i class="fa fa-cubes" aria-hidden="true"></i> Template
                </h1>
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
                            <div class="col-lg-4 bg-grey mt-step-col">
                                <div class="mt-step-number bg-white font-grey">2</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Builder</div>
                                <div class="mt-step-content font-grey-cascade">Template Builder</div>
                            </div>
                            <div class="col-lg-4 bg-grey mt-step-col active">
                                <div class="mt-step-number bg-white font-grey">3</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Apply</div>
                                <div class="mt-step-content font-grey-cascade">Apply Template</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cubes" aria-hidden="true"></i> 
                            <span class="caption-subject">Template: <?php echo $template->template_name; ?></span>
                        </div>
                    </div>
                    <div class="portlet-body form" id="from-group-style">
                        
                        <!--Apply Template Form Start-->
                        <form action="{{URL::to('crmlayouts/do_apply_template')}}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="template_id" value="<?php echo $template->template_id; ?>" />
                            <div class="form-group">  
                                <div class="form-group form-md-line-input form-md-floating-label has-info">
                                    <select id="module_id" name="module_id" class="form-control">
                                        <?php
                                        if(!empty($modules)) {
                                            foreach ($modules as $module) {
                                                echo '<option ', (isset($crmlayouts->module_id) && $crmlayouts->module_id == $module->module_id)? 'selected' : '' ,' value="'.$module->module_id.'">'.$module->module_title.'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <label for="module_id">Module</label>
                                    <i class="fa fa-times-circle clearInput" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="form-group form-md-radios">
                                <div class="md-radio-inline">
                                    <div class="md-radio">
                                        <input class="field" id="overwrite_no" data-custom-field="overwrite" checked="checked" name="overwrite" value="no" type="radio">
                                        <label for="overwrite_no"><span></span><span class="check"></span><span class="box"></span>Merge Existing Data</label>
                                    </div>
                                    <div class="md-radio">
                                        <input class="field" id="overwrite_yes" data-custom-field="overwrite" name="overwrite" value="yes" type="radio">
                                        <label for="overwrite_yes"><span></span><span class="check"></span><span class="box"></span>Overwrite Existing Data</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions noborder right">
                                <input class="btn btn-primary" value="Submit" type="submit">
                                <a class="btn btn-default" href="{{route('crmlayouts.index')}}">Cancel</a>
                            </div>
                        </form>
                        <!--Apply Template Form End-->
                        
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