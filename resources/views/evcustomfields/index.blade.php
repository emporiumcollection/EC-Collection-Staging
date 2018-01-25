@extends('layouts.app')
@section('content')
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
      <?php 
  $fieldArray = array();
    $fieldArray[''] = '';
    $fieldArray['text'] = 'Text';
    $fieldArray['email'] = 'Email';
    $fieldArray['number']='Number';
    $fieldArray['date']='Date';
    $fieldArray['textarea']='Textarea';
    $fieldArray['select']='Select';
    $fieldArray['radio']='Radio';
    $fieldArray['checkbox']='Checkbox';
    $fieldArray['editor']='Textarea With Editor';
    $fieldArray['file']='File';
?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper main-style-it-max">
  <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">
        <h1><i class="{{$icon_class['admin_menu_left_settings_ubersetzung_icon']}}" aria-hidden="true"></i> @lang('customfields.admin_customfield_module_title') <small>@lang('customfields.admin_customfield_module_sub_title')</small>
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
                      <div class="caption font-dark">
                          <i class="{{$icon_class['admin_menu_left_settings_ubersetzung_icon']}}" aria-hidden="true"></i> 
                          <span class="caption-subject "> @lang('customfields.admin_customfield_module_title')</span>
                      </div>
                      
                  </div>
                  <div class="portlet-body">
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
                      
                      <div class="portlet-body form">
                        <!-- Module List Drop Down -->
                        @if($module_list)
                        <div class="row" style="display: none;" data-module-list="top">
                                    <div class="col-sm-6">
                                        <div class="form-group">  
                    <div class="form-group form-md-line-input form-md-floating-label has-info padding_left">
                      <select class="form-control" id="module_name" name="module_name" data-module-list="list">
                                             @foreach ($module_list as $module)
                                          <option value="{{$module->id_modbuilder}}" @if($module_selected==$module->id_modbuilder) selected @endif>{{ucfirst($module->title_mob)}}</option>
                                      @endforeach 
                                   </select>
                       {!! Form::label('modules', trans('customfields.admin_customfield_module_list'))  !!}
                      
                    </div>
                     <span class="help-block">@lang('customfields.admin_customfield_module_list_help_text')</span>
                  </div>
                
                </div>
              </div>
              @endif  
              <!-- For custom field order -->
              <input type="hidden" name="custom_field_order">     
                        <!-- Module List Drop Down -->

              <div class="tabbable-line" >
                <ul class="nav nav-tabs " style="display: none; margin:10px 0; border-bottom: 1px solid #ccc;" data-fields-tab="list">
                <!-- Load Group Tabs Here --> 
                </ul>
                
                <!-- Create  Group Form --> 
                <div class="form-body " style="display: none;" data-form='create-group'>
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">  
                          <div class="form-group form-md-line-input form-md-floating-label has-info">
                            {!! Form::text('group_name', '', array('class'=>'form-control','maxlength'=>'255','id'=>'group_name','data-group-field'=>'group-name'))  !!}
                             {!! Form::label('group_name', trans('customfields.admin_customfield_module_add_group_name'))  !!}
                            <i class="fa fa-times-circle clearInput" aria-hidden="true"></i>
                          </div>
                          <span class="help-block">@lang('customfields.admin_customfield_module_add_group_name_help_text') <span class="textused">0/255</span></span>
                        </div>
                        <div class="form-actions noborder right">
                        {{ Form::button(trans('customfields.admin_customfield_module_add_btn_submit'), array('class' => 'btn blue m-t-0','data-action'=>'create-group', 'disabled'=>'disabled')) }}
                      </div>
                          
                        
                    </div>
                  </div>
                  {!! Form::close() !!} 
                </div>  

                <!-- End Create  Group Form --> 
                
                <div class="form-body" data-form='create-custom-fields' style="display: none;">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="dd" id="nestable_list_3" data-field-custom='list'>
                        <ol class="dd-list">
                          <!-- Load Custom Fields  Here -->
                        </ol>
                      </div>
                      <button type="button" class="btn btn-primary hide" data-action="save-field-order" disabled="disabled">  Save Field Orders  </button>
                      <button type="button" class="btn btn-danger red " data-action="remove-group">  Remove Group  </button>
                    </div>
                    <div class="col-sm-6 " style="display: none;" data-field-custom='form'>
                      <!-- Load Custom Field Form Here -->
                    </div>
                  </div>
                </div>
                
              </div>
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

<script  type="text/template" data-template="create-custom-fields">
  <h5  class="bold_500">@lang('customfields.admin_customfield_module_custom_field_add_from')</h5>
  <div class="form-group">  
    <div class="form-group form-md-line-input form-md-floating-label has-info">
      <select data-placeholder="Select Type" data-custom-field="type"  class="form-control select2" >
              @foreach($fieldArray as $fieldKey=>$fieldMatch)
              <option value="{{$fieldKey}}" >{{$fieldMatch}}</option>
              @endforeach
          </select>
          {!! Form::label('table_mob', trans('module_builder.admin_modbuilder_module_exist_table'))  !!}
      </div>
  </div>        
  <div class="form-group">  
    <div class="form-group form-md-line-input form-md-floating-label has-info" >
      {!! Form::text('title_mcf', '', array('class'=>'form-control','maxlength'=>'255','id'=>'title_mcf','data-custom-field'=>'title'))  !!}
      {!! Form::label('title_mcf', trans('customfields.admin_customfield_module_add_custom_title'))  !!}
      <i class="fa fa-times-circle clearInput" aria-hidden="true"></i>
    </div>
    <span class="help-block">@lang('customfields.admin_customfield_module_add_custom_title_help_text') <span class="textused">0/255</span></span>
  </div>

  <div data-field-option="list" style="display: none;">
    <table class="table m-b-0">
       <thead>
        <th></th>
        <th>Label</th>
        <th>Value</th>
        <th></th>
       </thead>
       <tbody>
         <tr data-form-field-type-row="0">
          <td><i class="fa fa-bars" aria-hidden="true"></i></td>
              <td><input type="text" data-form-field-type-label="0" class="form-control"> </td>
              <td><input type="text" data-form-field-type-value="0" class="form-control"> </td>
              <td><a class="btn default red btn-circle m-t-0" data-action="remove-data-form-field-type-label" data-val="0"><i class="fa fa-trash"></i></a></td>
            </tr>
          </tbody>
    </table>
    <div class="text-right">
            <button type="button" class="btn default blue btn-circle m-t-0" data-action="add-form-field-type"><i class="fa fa-plus"></i> New Option </button>
        </div>
  </div>

  
  <div class="form-group form-md-radios">
    {!! Form::label('', trans('customfields.admin_customfield_module_add_status_title'))  !!}
    <div class="md-radio-inline">
      <div class="md-radio">
        {{ Form::radio('status', 'yes',true, ['class' => 'field','id'=>'status_active','data-custom-field'=>'status']) }}
        {!! Html::decode(Form::label('status_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_status_active'))) !!}
      </div>
      <div class="md-radio">
        {{ Form::radio('status', 'no',  null, ['class' => 'field','id'=>'status_inactive','data-custom-field'=>'status']) }}
        {!! Html::decode(Form::label('status_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_status_inactive'))) !!}
      </div>
    </div>
  </div>

  <div class="form-group form-md-radios">
    {!! Form::label('', trans('customfields.admin_customfield_module_add_list_view_title'))  !!}
    <div class="md-radio-inline">
      <div class="md-radio">
        {{ Form::radio('list_view', 'yes',true, ['class' => 'field','id'=>'list_view_active','data-custom-field'=>'list_view']) }}
        {!! Html::decode(Form::label('list_view_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_list_view_active'))) !!}
      </div>
      <div class="md-radio">
        {{ Form::radio('list_view', 'no',  null, ['class' => 'field','id'=>'list_view_inactive','data-custom-field'=>'list_view']) }}
        {!! Html::decode(Form::label('list_view_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_list_view_inactive'))) !!}
      </div>
    </div>
  </div>

  <div class="form-group form-md-radios">
    {!! Form::label('', trans('customfields.admin_customfield_module_add_showinform_title'))  !!}
    <div class="md-radio-inline">
      <div class="md-radio">
        {{ Form::radio('showinform', 'yes',true, ['class' => 'field','id'=>'showinform_active','data-custom-field'=>'show_in_form']) }}
        {!! Html::decode(Form::label('showinform_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_showinform_active'))) !!}
      </div>
      <div class="md-radio">
        {{ Form::radio('showinform', 'no',  null, ['class' => 'field','id'=>'showinform_inactive','data-custom-field'=>'show_in_form']) }}
        {!! Html::decode(Form::label('showinform_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_showinform_inactive'))) !!}
      </div>
    </div>
  </div>

  <div class="form-group form-md-radios">
    {!! Form::label('', trans('customfields.admin_customfield_module_add_searchable_title'))  !!}
    <div class="md-radio-inline">
      <div class="md-radio">
        {{ Form::radio('searchable', 'yes',true, ['class' => 'field','id'=>'searchable_active','data-custom-field'=>'searchable']) }}
        {!! Html::decode(Form::label('searchable_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_searchable_active'))) !!}
      </div>
      <div class="md-radio">
        {{ Form::radio('searchable', 'no',  null, ['class' => 'field','id'=>'searchable_inactive','data-custom-field'=>'searchable']) }}
        {!! Html::decode(Form::label('searchable_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_searchable_inactive'))) !!}
      </div>
    </div>
  </div>

  <div class="form-group form-md-radios">
    {!! Form::label('', trans('customfields.admin_customfield_module_add_advance_searchable_title'))  !!}
    <div class="md-radio-inline">
      <div class="md-radio">
        {{ Form::radio('advance_searchable', 'yes',true, ['class' => 'field','id'=>'advance_searchable_active','data-custom-field'=>'advance_searchable']) }}
        {!! Html::decode(Form::label('advance_searchable_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_advance_searchable_active'))) !!}
      </div>
      <div class="md-radio">
        {{ Form::radio('advance_searchable', 'no',  null, ['class' => 'field','id'=>'advance_searchable_inactive','data-custom-field'=>'advance_searchable']) }}
        {!! Html::decode(Form::label('advance_searchable_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_advance_searchable_inactive'))) !!}
      </div>
    </div>
  </div>
  
  <div class="form-group form-md-radios">
    {!! Form::label('', trans('customfields.admin_customfield_module_add_filter_searchable_title'))  !!}
    <div class="md-radio-inline">
      <div class="md-radio">
        {{ Form::radio('filter_searchable', 'yes',true, ['class' => 'field','id'=>'filter_searchable_active','data-custom-field'=>'filter_searchable']) }}
        {!! Html::decode(Form::label('filter_searchable_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_filter_searchable_active'))) !!}
      </div>
      <div class="md-radio">
        {{ Form::radio('filter_searchable', 'no',  null, ['class' => 'field','id'=>'filter_searchable_inactive','data-custom-field'=>'filter_searchable']) }}
        {!! Html::decode(Form::label('filter_searchable_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_filter_searchable_inactive'))) !!}
      </div>
    </div>
  </div>

  <div class="form-group form-md-radios">
    {!! Form::label('', trans('customfields.admin_customfield_module_add_required_field_title'))  !!}
    <div class="md-radio-inline">
      <div class="md-radio">
        {{ Form::radio('required_field', 'yes',true, ['class' => 'field','id'=>'required_field_active','data-custom-field'=>'required_field']) }}
        {!! Html::decode(Form::label('status_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_required_field_active'))) !!}
      </div>
      <div class="md-radio">
        {{ Form::radio('required_field', 'no',  null, ['class' => 'field','id'=>'required_field_inactive','data-custom-field'=>'required_field']) }}
        {!! Html::decode(Form::label('status_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_required_field_inactive'))) !!}
      </div>
    </div>
  </div>
  
  <div class="form-actions noborder right">
    {{ Form::button(trans('customfields.admin_customfield_module_add_btn_submit'), array('class' => 'btn blue m-t-0 ','data-button-action'=>'save', 'disabled'=>'disabled')) }}
    {{ Form::button(trans('customfields.admin_customfield_module_btn_reset'), array('class' => 'btn default m-t-0 ','data-button-action'=>'reset')) }}
  </div>
  
</script>

<!-- start: Custom Modal -->
<div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h3 class="modal-title" data-modal-title="content"></h3>

            </div>
            <div class="modal-body" data-modal-content="content">
                 <h4></h4>

            </div>
            <!--/modal-body-collapse -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-action="btnDeleteYes" data-action-url="" data-action-params="">@lang('customfields.admin_customfield_module_delete_confirmation_btn_yes')</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('customfields.admin_customfield_module_delete_confirmation_btn_no')</button>
            </div>
            <!--/modal-footer-collapse -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- End: Custom Modal -->
                              
@stop

@section('style')
  <!-- BEGIN PAGE LEVEL PLUGINS -->
  <link href="{{ asset('assets/global/plugins/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet" type="text/css" />
  <!-- END PAGE LEVEL PLUGINS -->
  <style>
    .demo { padding-left:40px !important; }
  </style>
@endsection 

@section('script')
  <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
   <!-- BEGIN PAGE LEVEL PLUGINS -->
  <script src="{{ asset('assets/global/plugins/jquery-nestable/jquery.nestable.js')}}" type="text/javascript"></script>
  <!--script src="{{ asset('assets/pages/scripts/ui-nestable.js')}}" type="text/javascript"></script-->
  <!-- END PAGE LEVEL SCRIPTS -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection

@section('custom_js_script')
<script>


// For Store Filter option in local storage
function storeCustomField(){
    var options= new Array();
    if($('[data-custom-field="type"] option:selected').val()=='select' || 
      $('[data-custom-field="type"] option:selected').val()=='radio' || 
      $('[data-custom-field="type"] option:selected').val()=='checkbox'){

      $('[data-field-option="list"] table tbody tr').each(function(i,val){
        options.push({
            'label' : $(val).find('[data-form-field-type-label]').val(),
            'value' : $(val).find('[data-form-field-type-value]').val()
          });
      });
    }
  var localObject = {
    'module_id' : $('[data-module-list="list"] option:selected').val(),
    'group_slug' : $('[data-fields-tab="list"] li.active a[data-tab-link]').attr('data-tab-link'),
    'type': $('[data-custom-field="type"] option:selected').val(),
    'title': $('[data-custom-field="title"]').val(),
    'status': $('[data-custom-field="status"]:checked').val(),
    'list_view': $('[data-custom-field="list_view"]:checked').val(),
    'show_in_form': $('[data-custom-field="show_in_form"]:checked').val(),
    'searchable': $('[data-custom-field="searchable"]:checked').val(),
    'advance_searchable': $('[data-custom-field="advance_searchable"]:checked').val(),
    'filter_searchable': $('[data-custom-field="filter_searchable"]:checked').val(),
    'required_field': $('[data-custom-field="required_field"]:checked').val(),
    'options': options

  };
  localStorage.setItem('customFields', JSON.stringify(localObject));
  getCustomFields();

}
//For get filter variables 
function getCustomFields(){
  var customFields = localStorage.getItem('customFields');
  console.log('customFields: ', JSON.parse(customFields));
  return JSON.parse(customFields);
}
//get Response of Creag Group
function resCreateGroup(data){
  $('#group_name').val('');
  loadGroupTabs();
}
function reCreateField(){
  var params = $.extend({}, doAjax_params_default);
      params['url'] = '{{url("admin/customfields/getCustomFields")}}?gp='+$('[data-fields-tab="list"] li.active a[data-tab-link]').attr('data-tab-link');
      params['method'] = 'get';
      params['successCallbackFunction'] = resCustomFields; // callback for get response
    doAjax(params);
}

//For load groups tabs
function loadGroupTabs(){
   var params = $.extend({}, doAjax_params_default);
        params['url'] = '{{url("admin/customfields/getGroups")}}/'+$('[data-module-list="list"] option:selected').val();
        params['method'] = 'get';
        params['successCallbackFunction'] = resGetGroups; // callback for get response
      doAjax(params);
}

// For get response of groups 
function resGetGroups(data){
  $('[data-fields-tab="list"]').hide();
  $('[data-fields-tab="list"]').html('');
  $(data).each(function(i,val){
    var classA =""; 
    if(i=='0'){
      classA = 'class="active"';
    }
    var strHTML = '<li data-group-id="'+val.id_modcustomfieldgroup+'" '+classA+'><a data-tab-link="'+val.slug_mfg+'"><i class="fa fa-bars" aria-hidden="true"></i>'+val.title_mfg+'</a></li>';
    $('[data-fields-tab="list"]').append(strHTML);
  });

  var classA =""; 
    if(data.length==0){
      classA = 'class="active"';
      $('[data-form="create-custom-fields"]').hide();
      $('[data-form="create-group"]').fadeIn('slow');
    }
  var strHTML = '<li '+classA+'><a data-tab-link="create-group"><i class="icon-paragraph-justify2"></i>Create Group</a></li>';
  $('[data-fields-tab="list"]').append(strHTML);
  $('[data-fields-tab="list"]').fadeIn('slow');
  if(data.length>0){
    var params = $.extend({}, doAjax_params_default);
        params['url'] = '{{url("admin/customfields/getCustomFields")}}?gp='+$('[data-fields-tab="list"] li.active a[data-tab-link]').attr('data-tab-link');
        params['method'] = 'get';
        params['successCallbackFunction'] = resCustomFields; // callback for get response
      doAjax(params);
  }   
}

// For get response of Custom Fields 

function resCustomFields(data){
  $('[data-form="create-group"]').hide();
  $('[data-form="create-custom-fields"]').fadeIn('slow');
  $('[data-form="create-custom-fields"] [data-field-custom="list"] ol').html('');
  if(data.length>0){
    $('[data-action="save-field-order"]').removeClass('hide').prop('disabled',false);
  }else{
    $('[data-action="save-field-order"]').addClass('hide').prop('disabled',true);
  }
  $(data).each(function(i,val){
    var classA =""; 
    if(i=='0'){
      classA = 'class="active"';
    }
    var strHTML = '<li class="dd-item dd3-item"   rel="'+val.id_modcustomfield+'">';
      strHTML += '<div class="dd-handle dd3-handle"> </div>';
      strHTML += '<div class="dd3-content">'+val.title_mcf;
      strHTML += '<span class="pull-right">';
      strHTML += '<a data-custom-field="edit" rel="'+val.id_modcustomfield+'"><i class="fa fa-pencil"></i></a>';
      strHTML += '<a data-custom-field="remove" rel="'+val.id_modcustomfield+'"><i class="fa fa-times"></i></a>';
      strHTML += '</span>';
      strHTML += '</div>';
      strHTML += '</li>';
    $('[data-form="create-custom-fields"] [data-field-custom="list"] ol').append(strHTML);
  });
  


  $('[data-field-custom="form"]').html($('[data-template="create-custom-fields"]').html());
  $('[data-field-custom="form"]').fadeIn('slow');
}

//Response on Remove Group/Fields
function resRemoveConfirmation(data){
  
  loadGroupTabs();
}


//Reset Custom Field Form 
function resetCustomFieldForm(){
  
  $('[data-custom-field="type"]').val('');
  $('[data-custom-field="title"]').val('');
  $('[data-custom-field="status"]:first').attr('checked', true);
  $('[data-custom-field="list_view"]:first').attr('checked', true);
  $('[data-custom-field="show_in_form"]:first').attr('checked', true);
  $('[data-custom-field="searchable"]:first').attr('checked', true);
  $('[data-custom-field="advance_searchable"]:first').attr('checked', true);
  $('[data-custom-field="filter_searchable"]:first').attr('checked', true);
  $('[data-custom-field="required_field"]:first').attr('checked', true);
  $('[data-field-option="list"]').hide();
  $('button[data-button-action]').attr('rel','');
  $('button[data-button-action]').attr('data-button-action','save');
  $('[data-field-option="list"] table tbody').html('');

}

function resEditCustomFields(data){
  var dataObj = JSON.parse(data.option_mcf);
  $('[data-custom-field="title"]').val(data.title_mcf);
        $('[data-custom-field="title"]').focus();
  $('[data-custom-field="type"]').val(dataObj.type);
        $('[data-custom-field="type"]').focus();
  if(dataObj.status=='yes'){
    $('#status_active').prop('checked',true);
  }else{
    $('#status_inactive').prop('checked',true);
  }
  if(dataObj.list_view=='yes'){
    $('#list_view_active').prop('checked',true);
  }else{
    $('#list_view_inactive').prop('checked',true);
  }

  if(dataObj.show_in_form=='yes'){
    $('#showinform_active').prop('checked',true);
  }else{
    $('#showinform_inactive').prop('checked',true);
  }

  if(dataObj.searchable=='yes'){
    $('#searchable_active').prop('checked',true);
  }else{
    $('#searchable_inactive').prop('checked',true);
  }

  if(dataObj.advance_searchable=='yes'){
    $('#advance_searchable_active').prop('checked',true);
  }else{
    $('#advance_searchable_inactive').prop('checked',true);
  }

  if(dataObj.filter_searchable=='yes'){
    $('#filter_searchable_active').prop('checked',true);
  }else{
    $('#filter_searchable_inactive').prop('checked',true);
  }

  if(dataObj.required_field=='yes'){
    $('#required_field_active').prop('checked',true);
  }else{
    $('#required_field_inactive').prop('checked',true);
  }

  if(dataObj.options!='' &&  (dataObj.type=='radio' ||  dataObj.type=='checkbox' || dataObj.type=='select')){
    $('[data-field-option="list"] table tbody').html('');
    $('[data-field-option="list"]').show(); 
    $(dataObj.options).each(function(i, val){
      var setIndexFormFieldTypeCount = i; 
      var strFormFieldTypeBuilder ='<tr  data-form-field-type-row="'+setIndexFormFieldTypeCount+'">';
        strFormFieldTypeBuilder +='<td><i class="fa fa-bars" aria-hidden="true"></i></td>';
            strFormFieldTypeBuilder +='<td><input type="text" data-form-field-type-label="'+setIndexFormFieldTypeCount+'" value="'+val.label+'" class="form-control"> </td>';
            strFormFieldTypeBuilder +='<td><input type="text" data-form-field-type-value="'+setIndexFormFieldTypeCount+'" value="'+val.value+'"  class="form-control"> </td>';
            strFormFieldTypeBuilder +='<td><a class="btn default red btn-circle m-t-0" data-action="remove-data-form-field-type-label" data-val="'+setIndexFormFieldTypeCount+'"><i class="fa fa-trash"></i></a></td>';
            strFormFieldTypeBuilder +='</tr>';
            $('[data-field-option="list"] table tbody').append(strFormFieldTypeBuilder);
    });

    $('div[data-field-option="list"]').find("tbody").sortable({
          update: function(evt, ui) {     activeForm();   }

      }).disableSelection();
  }else{
    $('[data-field-option="list"] table tbody').html('');
    $('[data-field-option="list"]').hide(); 
  }
  
}

function activeForm(){
  $('button[data-button-action]').prop('disabled', true);
    if($('input[data-custom-field="title"]').val() != '' && $('select[data-custom-field="type"] option:selected').val() != '') {
       $('button[data-button-action]').prop('disabled', false);
    }
}
$(document).ready(function(){

  $('[data-module-list="top"]').fadeIn('slow');
  
  //Load Records First Time
  loadGroupTabs();
  //For get groups module wise
  $(document).on('change','[data-module-list="list"]',function(){
    loadGroupTabs();
  });

  //Save Group 
  $(document).on('click','[data-action="create-group"]',function(e){
    e.preventDefault();

      if($('input[data-group-field="group-name"]').val() != '') {
        $(this).prop('disabled', true);
        var params = $.extend({}, doAjax_params_default);
                params['url'] = '{{url("admin/customfields/createGroup")}}';
                params['method'] = 'POST';
                params['data'] = { 'group_name':$('[data-group-field="group-name"]').val(),'module_id' : $('[data-module-list="list"] option:selected').val()}
                params['successCallbackFunction'] = resCreateGroup; // callback for get response
                      doAjax(params);
            }         
    });                 

  //For Choose Group 
  $(document).on('click','[data-tab-link]',function(e){
    e.preventDefault();
    $('[data-fields-tab="list"] li').removeClass('active');
    $(this).parent().addClass('active');
    if($(this).attr('data-tab-link')=='create-group'){
      $('[data-form="create-custom-fields"]').hide(); 
      $('[data-form="create-group"]').fadeIn('slow');
    }else{
      var params = $.extend({}, doAjax_params_default);
            params['url'] = '{{url("admin/customfields/getCustomFields")}}?gp='+$(this).attr('data-tab-link');
            params['method'] = 'get';
            params['successCallbackFunction'] = resCustomFields; // callback for get response
              doAjax(params);
        }             

  }); 

  //Remove Group
  $(document).on('click','[data-action="remove-group"]',function(e){
    e.preventDefault();
    $('[data-action="btnDeleteYes"]').prop('disabled',false); 
    $('#customModal [data-modal-title="content"]').html('Remove Group');
    $('#customModal [data-modal-content="content"]').html('Are you sure for remove group?');
    $('#customModal button[data-action="btnDeleteYes"]').attr('data-action-params',$('[data-fields-tab="list"] li.active a[data-tab-link]').attr('data-tab-link'));
    $('#customModal button[data-action="btnDeleteYes"]').attr('data-action-type','remove-group');
    $('#customModal').modal('show');   
  });

  //Remove Custom Field 
  $(document).on('click','[data-custom-field="remove"]',function(e){
    e.preventDefault(); 
    $('[data-action="btnDeleteYes"]').prop('disabled',false);
    $('#customModal [data-modal-title="content"]').html('Remove Field');
    $('#customModal [data-modal-content="content"]').html('Are you sure for remove custom field?');
    $('#customModal button[data-action="btnDeleteYes"]').attr('data-action-params',$(this).attr('rel'));
    $('#customModal button[data-action="btnDeleteYes"]').attr('data-action-type','remove-field');
    $('#customModal').modal('show');   
  });

  //Remove Group/Custom Field Confirmation
  $(document).on('click','[data-action="btnDeleteYes"]',function(e){
    e.preventDefault();
    if($(this).attr('data-action-type')=='remove-group'){
      var params = $.extend({}, doAjax_params_default);
              params['url'] = '{{url("admin/customfields/removeGroup")}}';
              params['method'] = 'POST';
              params['data'] = {'group':$(this).attr('data-action-params')};
              params['successCallbackFunction'] = resRemoveConfirmation; 
              doAjax(params);
              $('#customModal').modal('hide');  
              
    }

    if($(this).attr('data-action-type')=='remove-field'){
      var params = $.extend({}, doAjax_params_default);
              params['url'] = '{{url("admin/customfields/removeCustomField")}}/'+$(this).attr('data-action-params');
              params['method'] = 'POST';
              params['successCallbackFunction'] = reCreateField; 
              doAjax(params);
              $('#customModal').modal('hide');  
              
    }
    $('[data-action="btnDeleteYes"]').prop('disabled',true);
                 
  });
  
  //Save Custom Field
  $(document).on('click','[data-button-action="save"]',function(e){

      e.preventDefault();
       
      if($('input[data-custom-field="title"]').val() != '' && $('[data-custom-field="type"] option:selected').val() != '') {
        $(this).prop('disabled', true);
        storeCustomField();
        var params = $.extend({}, doAjax_params_default);
              params['url'] = '{{url("admin/customfields/createField")}}';
              params['method'] = 'POST';
              params['data'] = getCustomFields();
              params['successCallbackFunction'] = reCreateField; 
              doAjax(params);
          resetCustomFieldForm(); // Rest Form After submitting form
        $("html, body").animate({ scrollTop: 0 }, 600);
      } 
    
  });

  //Edit  Custom Field 
  $(document).on('click','[data-custom-field="edit"]',function(e){
    e.preventDefault(); 
    //$('[data-action="btnDeleteYes"]').prop('disabled',false);
    $('button[data-button-action]').attr('rel',$(this).attr('rel'));
    $('button[data-button-action]').attr('data-button-action','saveEdit');
    var params = $.extend({}, doAjax_params_default);
            params['url'] = '{{url("admin/customfields/editCustomField")}}/'+$(this).attr('rel');
            params['method'] = 'get';
            params['successCallbackFunction'] = resEditCustomFields; // callback for get response
              doAjax(params);
      
  });

  //Reset form  Custom Field 
  $(document).on('click','[data-button-action="reset"]',function(e){
    e.preventDefault(); 
    resetCustomFieldForm(); // Rest Form After submitting form
      
  });

  $(document).on('click','[data-button-action="saveEdit"]',function(e){

      e.preventDefault();
      
      if($('input[data-custom-field="title"]').val() != '' && $('[data-custom-field="type"] option:selected').val() != '') {
        $(this).prop('disabled', true);
        storeCustomField();
        var params = $.extend({}, doAjax_params_default);
              params['url'] = '{{url("admin/customfields/updateCustomField")}}/'+$(this).attr('rel');
              params['method'] = 'POST';
              params['data'] = getCustomFields();
              params['successCallbackFunction'] = reCreateField; 
              doAjax(params);
          resetCustomFieldForm(); // Rest Form After submitting form
        $("html, body").animate({ scrollTop: 0 }, 600);
      } 
    
  });

  $('input[data-group-field="group-name"]').keyup(function() {
    $('button[data-action="create-group"]').prop('disabled', true);
        if($(this).val() != '') {
           $('button[data-action="create-group"]').prop('disabled', false);
        }
     });

  $(document).on('keyup','input[data-custom-field="title"]',function() {
    activeForm();
     });

  $(document).on('click','input[data-custom-field]',function() {
    activeForm();
     });

  $(document).on('keyup','input[data-form-field-type-value]',function() {
    activeForm();
     });
  $(document).on('keyup','input[data-form-field-type-label]',function() {
    activeForm();
     });

  
  $(document).on('change','select[data-custom-field="type"]',function() { 
    
    activeForm();
     });

  //For add option for raido , checkbox, and select box

   $(document).on('click','[data-action="add-form-field-type"]',function(){
        
        var FormFieldTypeCount = $('[data-field-option="list"] table tbody tr[data-form-field-type-row]').length;
        if(FormFieldTypeCount > 0) {
            FormFieldTypeCount++;
        } 
        if(FormFieldTypeCount==0){ FormFieldTypeCount = 1;}
        var setIndexFormFieldTypeCount = FormFieldTypeCount - 1;

        var strFormFieldTypeBuilder ='<tr data-form-field-type-row="'+setIndexFormFieldTypeCount+'">';
          strFormFieldTypeBuilder +='<td><i class="fa fa-bars" aria-hidden="true"></i></td>';
          strFormFieldTypeBuilder +='<td><input type="text" data-form-field-type-label="'+setIndexFormFieldTypeCount+'" class="form-control"> </td>';
          strFormFieldTypeBuilder +='<td><input type="text" data-form-field-type-value="'+setIndexFormFieldTypeCount+'" class="form-control"> </td>';
          strFormFieldTypeBuilder +='<td><a class="btn default red btn-circle m-t-0" data-action="remove-data-form-field-type-label" data-val="'+setIndexFormFieldTypeCount+'"><i class="fa fa-trash"></i></a></td>';
          strFormFieldTypeBuilder +='</tr>';
          $('[data-field-option="list"] table tbody').append(strFormFieldTypeBuilder);
    });

  $(document).on('change','select[data-custom-field="type"]',function() { 
    
    if($(this).val()=='select' || $(this).val()=='radio' || $(this).val()=='checkbox'){
      $('[data-field-option="list"]').fadeIn('slow');
    }else{
      $('[data-field-option="list"] table tbody').html('');
      $('[data-field-option="list"]').hide();
    } 
  });

  // For sorting for custom fields

    $('div[data-form="create-custom-fields"] [data-field-custom="list"]  ol' ).sortable({
        connectWith: 'div[data-form="create-custom-fields"] [data-field-custom="list"] ol',
        stop: function(evt, ui) {        }

    }).disableSelection();


    $(document).on('click','[data-action="save-field-order"]',function(){

        $('input[name="custom_field_order"]').val(getItemsCustomFieldOrder('div[data-form="create-custom-fields"] [data-field-custom="list"] ol'));
        var params = $.extend({}, doAjax_params_default);
              params['url'] = '{{url("admin/customfields/updateCustomFieldOrders")}}';
              params['method'] = 'POST';
              params['data'] = { 'order_by' : $('input[name="custom_field_order"]').val() }
              doAjax(params);
       //return false;
        
    });

    // For sorting for custom fields values
    $('div[data-field-option="list"]').find("tbody").sortable({
        update: function(evt, ui) {   activeForm();console.log('cvbc');     }
            
    }).disableSelection();


    $(document).on('click','[data-action="remove-data-form-field-type-label"]',function(){
      $('[data-field-option="list"] [data-form-field-type-row="'+$(this).attr('data-val')+'"]').remove();
    });


   $(".tabbable-line").find("ul").sortable({
        axis : "x",
        update: function (e, ui) {
              var csvIds = "";
             $(".tabbable-line > ul > li[data-group-id]").each(function(i){
                  csvIds+= ( csvIds == "" ? "" : "," )+$(this).attr('data-group-id');
             });
             var params = $.extend({}, doAjax_params_default);
              params['url'] = '{{url("admin/customfields/updateGroupOrders")}}';
              params['method'] = 'POST';
              params['data'] = { 'order_by' : csvIds }
              doAjax(params);
        }
    });     

}); 
  function getItemsCustomFieldOrder(exampleNr){
        var columns = [];

        $(exampleNr).each(function(){
            console.log($(this).sortable('toArray',{ attribute: 'rel' }));
            columns.push($(this).sortable('toArray',{ attribute: 'rel' }).join(','));
        });

        return columns.join('|');
    }



  </script>
@endsection
    </div>

	
@stop