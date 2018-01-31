<div class="row">
    <div class="col-md-12"><!-- template_id Field -->
        <!-- template_name Field -->
        <div class="form-group">  
            <div class="form-group form-md-line-input form-md-floating-label has-info">
                {!! Form::label('template_name', 'Template Name')  !!}
                {!! Form::text('template_name', null, array('class'=>'form-control','maxlength'=>'255','id'=>'template_name'))  !!}
            </div>
        </div>
        <div class="hidden form-group">  
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
                {!! Form::label('module_id', trans('crmlayout.admin_crmlayout_module_add_module_id'))  !!}
                <i class="fa fa-times-circle clearInput" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-actions noborder right">
    <button type="submit" name="submit" class="btn btn-primary btn-sm" >Next</button>
    <a class="btn btn-default" href="{{route('crmlayouts.index')}}">Cancel</a>
</div>