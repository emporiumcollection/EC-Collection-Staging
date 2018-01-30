<!--AIC: VC Style Start-->
<style>
    .ui-droppable-active {
        background-color: #eeeeee;
    }
    .ui-state-default {
        border: medium none;
    }
    .ai-sortable-fields .ui-state-default, .ai-sortable-fields .ui-state-highlight {
        /*min-height: 110px;*/
        margin: 5px;
        display: inline-block;
        background: transparent;
    }
    .ui-state-highlight {
        border: medium none;
    }
    .draggable-element {
        width: calc(50% - 10px);
    }

    .portlet.light {
        float: left;
        width: 100%;
    }
    .form-actions.noborder.right {
        float: left;
        width: 100%;
    }
    .tabbable-line {
        float: left;
        width: 100%;
    }

    /*
     * Layout Style
     */

    .custom-rows .row-btns-tab {
        background-color: #ddd;
        padding: 10px;
        margin-bottom: 10px;
    }
    .custom-rows .row-btns-tab a {
        font-size: 16px;
        background-color: #333;
        color: #fff;
        display: inline-block;
        margin-right: 5px;
        height: 24px;
        width: 24px;
        text-align: center;
    }
    .custom-rows .row-btns-tab select {
        height: 23px;
        border: 1px solid #ddd;
    }
    .custom-rows .ai-sortable-fields {
        background-color: #ddd;
        float: left;
        width: 100%;
        padding: 10px;
    }
    .custom-rows .draggable-element {
        background-color: #eee;
        margin: 0 5px 10px 5px;
    }

    /*
     * VC
     */

    .vc-container {
        float: left;
        width: 100%;
        margin-bottom: 20px;
    }
    .row-container {
        float: left;
        width: 100%;
        margin: 0 5px 20px 5px;
    }
    .row-head {
        float: left;
        width: 100%;
    }
    .left-icons {
        float: left;
        width: 50%;
    }
    .right-icons {
        float: left;
        width: 50%;
        text-align: right;
    }
    .row-content {
        background-color: #E6E6E6;
        float: left;
        width: 100%;
        padding: 20px;
    }
    .row-container .left-icons a, .row-container .right-icons a {
        background-color: #E6E6E6;
        color: #898989;
        padding: 5px 15px;
        font-size: 15px;
    }
    .row-bottom {
        float: left;
        width: 100%;
        text-align: center;
        background-color: #E6E6E6;
        color: #898989;
        padding: 5px 0;
    }
    .row-bottom a {
        color: #898989;
    }
    .row-content .vc-tabs ul.nav.nav-tabs li a {
        background-color: #C9C9C9 !important;
        color: #333333;
        padding: 5px 10px;
        font-size: 12px;
    }
    .row-content .vc-tabs ul.nav.nav-tabs > li.active a {
        background-color: #DDDDDD !important;
    }
    .row-content .vc-tabs ul.nav.nav-tabs {
        margin: 0;
    }
    .row-content .vc-tabs .tab-content {
        float: left;
        width: 100%;
        background-color: #dddddd;
        padding: 10px;
    }
    .vc-tab-content-bottom {
        float: left;
        width: 100%;
        text-align: center;
    }
    .row-container .vc-tab-content-bottom a {
        color: #898989;
        padding: 5px 5px;
    }
    .vc-tab-content .draggable-element {
        /*background-color: #E6E6E6;*/
        margin: 0 5px 10px 5px;
        padding: 0;
    }
    .vc-field-icons {
        float: left;
        width: 100%;
    }
    .vc-left-icons {
        float: left;
        width: 30%;
    }
    .vc-right-icons {
        float: left;
        width: 70%;
        text-align: right;
    }
    .vc-field-cotainer {
        float: left;
        width: 100%;
    }
    .vc-field-icons div > i, .vc-field-icons div > a, .vc-left-icons .dropdown, .row-head .dropdown {
        background-color: #E6E6E6;
        display: inline-block;
        padding: 5px 10px;
    }
    .vc-field-cotainer {
        background-color: #E6E6E6;
        padding: 10px 15px;
    }

    .vc-tab-content-bottom .dropdown, .row-head .dropdown {
        display: inline-block;
    }
    .vc-tab-content-bottom .dropdown .dropdown-toggle, .row-head .dropdown .dropdown-toggle {
        color: #898989;
    }
    .vc-tab-content-bottom .dropdown .dropdown-menu {
        min-width: 290px;
        margin: 0;
        border: none;
        box-shadow: none;
        background-color: #E6E6E6;
        top: -4px;
        left: 20px;
    }
    .row-head .dropdown .dropdown-menu {
        min-width: 290px;
        margin: 0;
        border: none;
        box-shadow: none;
        background-color: #E6E6E6;
        top: 0px;
        left: 35px;
    }
    .vc-tab-content-bottom .dropdown .dropdown-menu:before, .row-head .dropdown .dropdown-menu:before {
        border: medium none;
    }
    .vc-tab-content-bottom .dropdown .dropdown-menu li, .row-head .dropdown .dropdown-menu li {
        display: inline-block;
    }
    .vc-tab-content-bottom .dropdown .dropdown-menu li a, .row-head .dropdown .dropdown-menu li a {
        padding: 5px;
    }
    .vc-add-new-row {
        background-color: #E6E6E6;
        float: left;
        width: 100%;
        text-align: center;
        padding: 25px;
    }
    .vc-add-new-row .add-new-row-btn {
        color: #898989;
        border: 1px dashed #898989;
        padding: 7px 15px;
        font-size: 26px;
    }
    .vc-columns {
        float: left;
        width: 100%;
    }
    .vc-column {
        float: left;
        padding: 5px;
        background-color: #dddddd;
        margin: 5px;
    }
    .vc-column .draggable-element {
        width: calc(100% - 10px);
    }
    .vc-column-bottom {
        text-align: center;
        font-size: 14px;
        color: #898989;
        float: left;
        width: 100%;
    }
    
    .vc-elements {
        float: left;
        width: 100%;
    }
    .vc-element {
        border: 1px solid #fff;
        float: left;
        width: 50%;
        margin: 10px 0;
        padding: 10px;
    }
    .vc-element:hover {
        border: 1px solid #757575;
    }
    .vc-element .vc-element-left {
        float: left;
        width: 50px;
    }
    .vc-element .vc-element-left .vc-element-icon {
        width: 100%;
    }
    .vc-element .vc-element-right {
        float: left;
        width: calc(100% - 50px);
        padding: 0 15px;
    }
    .vc-element .vc-element-title {
        color: #333333;
        font-size: 16px;
    }
    .vc-element .vc-element-description {
        color: #757575;
        font-size: 12px;
    }
    
    .vc-color-picker-holder .minicolors {
        width: 100%;
    }
    .vc-color-picker-holder .vc-color-picker {
        width: 100%;
        height: auto;
    }
</style>
<!--AIC: VC Style End-->
<script>
    $(document).ready(function () {
        $(".change-layout").each(function () {
            $(this).parents(".row-btns-tab").siblings(".ai-sortable-fields").find(".draggable-element").css("width", "calc(" + $(this).val() + "% - 10px)");
        });
        $(".change-layout").change(function () {
            $(this).parents(".row-btns-tab").siblings(".ai-sortable-fields").find(".draggable-element").css("width", "calc(" + $(this).val() + "% - 10px)");
            var no_columns = $(this).find("option:selected").data("columns");
            var row_id = $(this).data("row-id");
            $.ajax({
                url: "{{URL::to('admin/crmlayouts/ajax_save_row_columns/')}}",
                type: "POST",
                data: {_token: '{{ csrf_token() }}', columns: no_columns, id: row_id},
                dataType: 'JSON',
                success: function (data, textStatus, jqXHR) {

                }
            });
        });
        $(".vc-change-row-layout").click(function (event) {
            event.preventDefault();
            var value = $(this).data("value");
            var row_id = $(this).data("row-id");
            $.ajax({
                url: "{{URL::to('admin/crmlayouts/ajax_save_row_columns/')}}",
                type: "POST",
                data: {_token: '{{ csrf_token() }}', value: value, id: row_id},
                dataType: 'JSON',
                success: function (data, textStatus, jqXHR) {
                    
                },
                complete: function (jqXHR, textStatus ) {
                    window.location.reload();
                }
            });
        });
        $(".vc-change-layout").click(function (event) {
            event.preventDefault();
            $(this).parents(".vc-tab-content-bottom").siblings(".vc-tab-content").find(".draggable-element").css("width", "calc(" + $(this).data('value') + "% - 10px)");
            var no_columns = $(this).data("columns");
            var group_id = $(this).data("group-id");
            $.ajax({
                url: "{{URL::to('admin/crmlayouts/ajax_save_group_columns/')}}",
                type: "POST",
                data: {_token: '{{ csrf_token() }}', columns: no_columns, id: group_id},
                dataType: 'JSON',
                success: function (data, textStatus, jqXHR) {

                }
            });
        });
        $(".add-new-custom-field-btn").click(function (event) {
            event.preventDefault();
            
            var row_id = $(this).data("row-id");
            var group_id = $(this).data("group-id");
            
            $("#add-new-custom-field-pop-up .row_id").val( row_id );
            $("#add-new-custom-field-pop-up .group_id").val( group_id );
            
            $("#add-new-custom-field-pop-up").modal();
        });
        $(".add-new-row-btn").click(function (event) {
            event.preventDefault();
            $("#add-new-row-pop-up").modal();
        });
        $(".add-new-column-btn").click(function (event) {
            event.preventDefault();
            $("#add-new-column-pop-up").modal();
        });
    });
</script>
<?php
$fieldArray = array();
$fieldArray[''] = '';
$fieldArray['text'] = 'Text';
$fieldArray['email'] = 'Email';
$fieldArray['number'] = 'Number';
$fieldArray['date'] = 'Date';
$fieldArray['textarea'] = 'Textarea';
$fieldArray['select'] = 'Select';
$fieldArray['radio'] = 'Radio';
$fieldArray['checkbox'] = 'Checkbox';
$fieldArray['editor'] = 'Textarea With Editor';
$fieldArray['file'] = 'File';
?>

<!-- Modal -->

<!--Elements Start-->
<div id="vc-elements-pop-up" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{URL::to('admin/crmlayouts/save_row_element/')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input class="row_id" type="hidden" name="row_id" value="0" />
                <input class="group_id" type="hidden" name="group_id" value="0" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">CRM Elements</h4>
                </div>
                <div class="modal-body">
                    <div class="vc-elements">
                        <div class="vc-element">
                            <a class="vc-element-btn" data-element="separator" href="javascript:void(0);">
                                <div class="vc-element-left">
                                    <img class="vc-element-icon" src="{{ asset('sximo/crm_layout/ai-vc-icon-hr-space.png')}}" >
                                </div>
                                <div class="vc-element-right">
                                    <div class="vc-element-title">Separator</div>
                                    <div class="vc-element-description">Horizontal separator line</div>
                                </div>
                            </a>
                        </div>
                        <div class="vc-element">
                            <a class="vc-element-btn" data-element="empty-space" href="javascript:void(0);">
                                <div class="vc-element-left">
                                    <img class="vc-element-icon" src="{{ asset('sximo/crm_layout/ai-vc-icon-empty-space.png')}}" >
                                </div>
                                <div class="vc-element-right">
                                    <div class="vc-element-title">Empty Space</div>
                                    <div class="vc-element-description">Blank space with custom height</div>
                                </div>
                            </a>
                        </div>
                        <div class="vc-element">
                            <a class="vc-element-btn" data-element="accordion" href="javascript:void(0);">
                                <div class="vc-element-left">
                                    <img class="vc-element-icon" src="{{ asset('sximo/crm_layout/ai-vc-icon-accordion.png')}}" >
                                </div>
                                <div class="vc-element-right">
                                    <div class="vc-element-title">Accordion</div>
                                    <div class="vc-element-description">Collapsible content panels</div>
                                </div>
                            </a>
                        </div>
                        <div class="vc-element">
                            <a class="vc-element-btn" data-element="tabs" href="javascript:void(0);">
                                <div class="vc-element-left">
                                    <img class="vc-element-icon" src="{{ asset('sximo/crm_layout/ai-vc-icon-tabs.png')}}" >
                                </div>
                                <div class="vc-element-right">
                                    <div class="vc-element-title">Tabs</div>
                                    <div class="vc-element-description">Tabbed content</div>
                                </div>
                            </a>
                        </div>
                        <div class="vc-element">
                            <a class="vc-element-btn" data-element="text-block" href="javascript:void(0);">
                                <div class="vc-element-left">
                                    <img class="vc-element-icon" src="{{ asset('sximo/crm_layout/ai-vc-text-block.png')}}" >
                                </div>
                                <div class="vc-element-right">
                                    <div class="vc-element-title">Text Block</div>
                                    <div class="vc-element-description">A block of text with WYSIWYG editor</div>
                                </div>
                            </a>
                        </div>
                        <div class="vc-element">
                            <a class="vc-element-custom-fields" href="javascript:void(0);">
                                <div class="vc-element-left">
                                    <img class="vc-element-icon" src="{{ asset('sximo/crm_layout/ai-vc-crm-fields.png')}}" >
                                </div>
                                <div class="vc-element-right">
                                    <div class="vc-element-title">CRM Fields</div>
                                    <div class="vc-element-description">Text, Email, Number, Date, etc.</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Elements Row Layout End-->

<!--Edit Separator Pop-Up Start-->
<div id="edit-separator-pop-up" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{URL::to('admin/crmlayouts/edit_row_element/')}}" method="POST">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input class="id" type="hidden" name="id" value="0" />
                <input class="row_id" type="hidden" name="row_id" value="0" />
                <input class="group_id" type="hidden" name="group_id" value="0" />
                <input class="template_id" type="hidden" name="template_id" value="0" />
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Separator</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group vc-color-picker-holder">
                        <label>Color</label>
                        <input class="form-control color vc-color-picker" name="color" type="text" placeholder="Color" />
                    </div>
                    <div class="form-group">
                        <label>Alignment</label>
                        <select class="form-control alignment" name="alignment">
                            <option value="center">Center</option>
                            <option value="left">Left</option>
                            <option value="right">Right</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Style</label>
                        <select class="form-control style" name="style">
                            <option value="solid">Border</option>
                            <option value="dashed">Dashed</option>
                            <option value="dotted">Dotted</option>
                            <option value="double">Double</option>
                            <option value="shadow">Shadow</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Border width</label>
                        <select class="form-control border_width" name="border_width">
                            <option value="1px">1px</option>
                            <option value="2px">2px</option>
                            <option value="3px">3px</option>
                            <option value="4px">4px</option>
                            <option value="5px">5px</option>
                            <option value="6px">6px</option>
                            <option value="7px">7px</option>
                            <option value="8px">8px</option>
                            <option value="9px">9px</option>
                            <option value="10px">10px</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Element width</label>
                        <select class="form-control element_width" name="element_width">
                            <option value="100%">100%</option>
                            <option value="90%">90%</option>
                            <option value="80%">80%</option>
                            <option value="70%">70%</option>
                            <option value="60%">60%</option>
                            <option value="50%">50%</option>
                            <option value="40%">40%</option>
                            <option value="30%">30%</option>
                            <option value="20%">20%</option>
                            <option value="10%">10%</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn blue m-t-0">{{trans('customfields.admin_customfield_module_add_btn_submit')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('customfields.admin_customfield_module_btn_reset')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Edit Separator Pop-Up End-->

<!--Edit Empty Space Pop-Up Start-->
<div id="edit-empty-space-pop-up" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{URL::to('admin/crmlayouts/edit_row_element/')}}" method="POST">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input class="id" type="hidden" name="id" value="0" />
                <input class="row_id" type="hidden" name="row_id" value="0" />
                <input class="group_id" type="hidden" name="group_id" value="0" />
                <input class="template_id" type="hidden" name="template_id" value="0" />
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Empty Space</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Height</label>
                        <input class="form-control height" name="height" type="text" value="32px" placeholder="Height" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn blue m-t-0">{{trans('customfields.admin_customfield_module_add_btn_submit')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('customfields.admin_customfield_module_btn_reset')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Edit Empty Space Pop-Up End-->

<!--Edit Accordion Pop-Up Start-->
<div id="edit-accordion-pop-up" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{URL::to('admin/crmlayouts/edit_row_element/')}}" method="POST">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input class="id" type="hidden" name="id" value="0" />
                <input class="row_id" type="hidden" name="row_id" value="0" />
                <input class="group_id" type="hidden" name="group_id" value="0" />
                <input class="template_id" type="hidden" name="template_id" value="0" />
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Accordion</h4>
                </div>
                <div class="modal-body">
                    <div class="vc-pop-up-sections-holder"></div>
                    <div class="vc-add-more-section-holder">
                        <a class="vc-add-more-section btn btn-primary btn-sm pull-right" data-section-no='1' href="javascript:void(0);"><i class="fa fa-plus"></i> Add Section</a>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn blue m-t-0">{{trans('customfields.admin_customfield_module_add_btn_submit')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('customfields.admin_customfield_module_btn_reset')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Edit Accordion Pop-Up End-->

<!--Edit Tabs Pop-Up Start-->
<div id="edit-tabs-pop-up" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{URL::to('admin/crmlayouts/edit_row_element/')}}" method="POST">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input class="id" type="hidden" name="id" value="0" />
                <input class="row_id" type="hidden" name="row_id" value="0" />
                <input class="group_id" type="hidden" name="group_id" value="0" />
                <input class="template_id" type="hidden" name="template_id" value="0" />
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Tabs</h4>
                </div>
                <div class="modal-body">
                    <div class="vc-pop-up-tabs-holder"></div>
                    <div class="vc-add-more-tab-holder">
                        <a class="vc-add-more-tab btn btn-primary btn-sm pull-right" data-tab-no='1' href="javascript:void(0);"><i class="fa fa-plus"></i> Add Tab</a>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn blue m-t-0">{{trans('customfields.admin_customfield_module_add_btn_submit')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('customfields.admin_customfield_module_btn_reset')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Edit Tabs Pop-Up End-->

<!--Edit Text Block Pop-Up Start-->
<div id="edit-text-block-pop-up" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{URL::to('admin/crmlayouts/edit_row_element/')}}" method="POST">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input class="id" type="hidden" name="id" value="0" />
                <input class="row_id" type="hidden" name="row_id" value="0" />
                <input class="group_id" type="hidden" name="group_id" value="0" />
                <input class="template_id" type="hidden" name="template_id" value="0" />
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Text Block</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control text vc-text-editor" name="text" rows="8"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn blue m-t-0">{{trans('customfields.admin_customfield_module_add_btn_submit')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('customfields.admin_customfield_module_btn_reset')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Edit Text Block Pop-Up End-->

<!--Custom Row Layout Start-->

<div id="vc-custom-row-layout-pop-up" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{URL::to('admin/crmlayouts/save_row_columns/')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input class="row_id" type="hidden" name="id" value="0" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Custom Row Layout</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group form-md-line-input form-md-floating-label has-info" >
                            <input class="custom_layout form-control" name="value" type="text" value="50 + 50" placeholder="50 + 50" />
                            <label for="value">Custom Layout</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="add_new_row" value="true" type="submit" class="btn blue m-t-0">{{trans('customfields.admin_customfield_module_add_btn_submit')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('customfields.admin_customfield_module_btn_reset')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Custom Row Layout End-->

<!--Add New Row Start-->

<div id="add-new-row-pop-up" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{URL::to('crmlayouts/add_new_row')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="module_id" value="<?php echo $template->module_id; ?>" />
                <input type="hidden" name="template_id" value="<?php echo $template->template_id; ?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Row</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group hidden">
                        <div class="form-group form-md-line-input form-md-floating-label has-info" >
                            <input class="form-control" name="new_row" type="text" value="Row" placeholder="Row Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group form-md-line-input form-md-floating-label has-info">
                            <input class="form-control" name="columns" type="number" min="1" value="1" />
                            <label for="columns">Number of columns</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="add_new_row" value="true" type="submit" class="btn blue m-t-0">{{trans('customfields.admin_customfield_module_add_btn_submit')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('customfields.admin_customfield_module_btn_reset')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Add New Row End-->

<!--Add New Column Start-->

<div id="add-new-column-pop-up" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{URL::to('crmlayouts/add_new_column')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="module_id" value="<?php echo $template->module_id; ?>" />
                <input type="hidden" name="template_id" value="<?php echo $template->template_id; ?>" />
                <input class="crm_row_id" type="hidden" name="crm_row_id" value="0" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Column</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group form-md-line-input form-md-floating-label has-info" >
                            <input class="form-control" name="other_group_name" type="text" placeholder="Column Name" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="add_new_column" value="true" type="submit" class="btn blue m-t-0">{{trans('customfields.admin_customfield_module_add_btn_submit')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('customfields.admin_customfield_module_btn_reset')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Add New Column End-->

<div id="add-new-custom-field-pop-up" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{URL::to('admin/crmlayouts/add_custom_field')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="module_id" value="<?php echo $template->module_id; ?>" />
                <input type="hidden" name="template_id" value="<?php echo $template->template_id; ?>" />
                <input class="row_id" type="hidden" name="row_id" value="0" />
                <input class="group_id" type="hidden" name="group_id" value="0" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Custom Field</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group form-md-line-input form-md-floating-label has-info">
                            <select data-placeholder="Select Type" data-custom-field="type"  class="custom-field-types form-control select2" name="type" >
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
                        </div>
                        <span class="help-block">@lang('customfields.admin_customfield_module_add_custom_title_help_text') <span class="textused">0/255</span></span>
                    </div>
                    <div class="custom-field-options-container" data-field-option="list" style="display: none;">
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
                                    <td><input type="text" data-form-field-type-label="0" name="option_label[]" class="form-control"> </td>
                                    <td><input type="text" data-form-field-type-value="0" name="option_value[]" class="form-control"> </td>
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
                                {!! Form::label('status_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_status_active')) !!}
                            </div>
                            <div class="md-radio">
                                {{ Form::radio('status', 'no',  null, ['class' => 'field','id'=>'status_inactive','data-custom-field'=>'status']) }}
                                {!! Form::label('status_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_status_inactive')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-md-radios">
                        {!! Form::label('', trans('customfields.admin_customfield_module_add_list_view_title'))  !!}
                        <div class="md-radio-inline">
                            <div class="md-radio">
                                {{ Form::radio('list_view', 'yes',true, ['class' => 'field','id'=>'list_view_active','data-custom-field'=>'list_view']) }}
                                {!! Form::label('list_view_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_list_view_active')) !!}
                            </div>
                            <div class="md-radio">
                                {{ Form::radio('list_view', 'no',  null, ['class' => 'field','id'=>'list_view_inactive','data-custom-field'=>'list_view']) }}
                                {!! Form::label('list_view_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_list_view_inactive')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-md-radios">
                        {!! Form::label('', trans('customfields.admin_customfield_module_add_showinform_title'))  !!}
                        <div class="md-radio-inline">
                            <div class="md-radio">
                                {{ Form::radio('showinform', 'yes',true, ['class' => 'field','id'=>'showinform_active','data-custom-field'=>'show_in_form']) }}
                                {!! Form::label('showinform_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_showinform_active')) !!}
                            </div>
                            <div class="md-radio">
                                {{ Form::radio('showinform', 'no',  null, ['class' => 'field','id'=>'showinform_inactive','data-custom-field'=>'show_in_form']) }}
                                {!! Form::label('showinform_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_showinform_inactive')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-md-radios">
                        {!! Form::label('', trans('customfields.admin_customfield_module_add_searchable_title'))  !!}
                        <div class="md-radio-inline">
                            <div class="md-radio">
                                {{ Form::radio('searchable', 'yes',true, ['class' => 'field','id'=>'searchable_active','data-custom-field'=>'searchable']) }}
                                {!! Form::label('searchable_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_searchable_active')) !!}
                            </div>
                            <div class="md-radio">
                                {{ Form::radio('searchable', 'no',  null, ['class' => 'field','id'=>'searchable_inactive','data-custom-field'=>'searchable']) }}
                                {!! Form::label('searchable_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_searchable_inactive')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-md-radios">
                        {!! Form::label('', trans('customfields.admin_customfield_module_add_advance_searchable_title'))  !!}
                        <div class="md-radio-inline">
                            <div class="md-radio">
                                {{ Form::radio('advance_searchable', 'yes',true, ['class' => 'field','id'=>'advance_searchable_active','data-custom-field'=>'advance_searchable']) }}
                                {!! Form::label('advance_searchable_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_advance_searchable_active')) !!}
                            </div>
                            <div class="md-radio">
                                {{ Form::radio('advance_searchable', 'no',  null, ['class' => 'field','id'=>'advance_searchable_inactive','data-custom-field'=>'advance_searchable']) }}
                                {!! Form::label('advance_searchable_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_advance_searchable_inactive')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-md-radios">
                        {!! Form::label('', trans('customfields.admin_customfield_module_add_filter_searchable_title'))  !!}
                        <div class="md-radio-inline">
                            <div class="md-radio">
                                {{ Form::radio('filter_searchable', 'yes',true, ['class' => 'field','id'=>'filter_searchable_active','data-custom-field'=>'filter_searchable']) }}
                                {!! Form::label('filter_searchable_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_filter_searchable_active')) !!}
                            </div>
                            <div class="md-radio">
                                {{ Form::radio('filter_searchable', 'no',  null, ['class' => 'field','id'=>'filter_searchable_inactive','data-custom-field'=>'filter_searchable']) }}
                                {!! Form::label('filter_searchable_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_filter_searchable_inactive')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-md-radios">
                        {!! Form::label('', trans('customfields.admin_customfield_module_add_required_field_title'))  !!}
                        <div class="md-radio-inline">
                            <div class="md-radio">
                                {{ Form::radio('required_field', 'yes',true, ['class' => 'field','id'=>'required_field_active','data-custom-field'=>'required_field']) }}
                                {!! Form::label('status_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_required_field_active')) !!}
                            </div>
                            <div class="md-radio">
                                {{ Form::radio('required_field', 'no',  null, ['class' => 'field','id'=>'required_field_inactive','data-custom-field'=>'required_field']) }}
                                {!! Form::label('status_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_required_field_inactive')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="add_new_custom_field" value="true" type="submit" class="btn blue m-t-0">{{trans('customfields.admin_customfield_module_add_btn_submit')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('customfields.admin_customfield_module_btn_reset')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Edit custom field option-->
<div id="edit-custom-field-pop-up" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="{{URL::to('admin/crmlayouts/edit_custom_field')}}" method="POST">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="module_id" value="<?php echo $template->module_id; ?>" />
                <input type="hidden" name="template_id" value="<?php echo $template->template_id; ?>" />
                <input class="group_id" type="hidden" name="group_id" value="0" />
                <input class="customfield_id" type="hidden" name="customfield_id" value="0" />
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Custom Field</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <div class="form-group form-md-line-input form-md-floating-label has-info">
                            <select data-placeholder="Select Type" data-custom-field="type"  class="custom-field-types form-control select2" name="type" >
                                @foreach($fieldArray as $fieldKey=>$fieldMatch)
                                <option value="{{$fieldKey}}" >{{$fieldMatch}}</option>
                                @endforeach
                            </select>
                            {!! Form::label('table_mob', trans('module_builder.admin_modbuilder_module_exist_table'))  !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group form-md-line-input form-md-floating-label has-info" >
                            {!! Form::text('title_mcf', '', array('class'=>'form-control title_mcf','maxlength'=>'255','id'=>'_title_mcf','data-custom-field'=>'title'))  !!}
                            {!! Form::label('_title_mcf', trans('customfields.admin_customfield_module_add_custom_title'))  !!}
                        </div>
                        <span class="help-block">@lang('customfields.admin_customfield_module_add_custom_title_help_text') <span class="textused">0/255</span></span>
                    </div>

                    <div class="custom-field-options-container" data-field-option="list" style="display: none;">
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
                                    <td><input type="text" data-form-field-type-label="0" name="option_label[]" class="form-control"> </td>
                                    <td><input type="text" data-form-field-type-value="0" name="option_value[]" class="form-control"> </td>
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
                                {{ Form::radio('status', 'yes',true, ['class' => 'field','id'=>'_status_active','data-custom-field'=>'status']) }}
                                {!! Form::label('_status_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_status_active')) !!}
                            </div>
                            <div class="md-radio">
                                {{ Form::radio('status', 'no',  null, ['class' => 'field','id'=>'_status_inactive','data-custom-field'=>'status']) }}
                                {!! Form::label('_status_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_status_inactive')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-md-radios">
                        {!! Form::label('', trans('customfields.admin_customfield_module_add_list_view_title'))  !!}
                        <div class="md-radio-inline">
                            <div class="md-radio">
                                {{ Form::radio('list_view', 'yes',true, ['class' => 'field','id'=>'_list_view_active','data-custom-field'=>'list_view']) }}
                                {!! Form::label('_list_view_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_list_view_active')) !!}
                            </div>
                            <div class="md-radio">
                                {{ Form::radio('list_view', 'no',  null, ['class' => 'field','id'=>'_list_view_inactive','data-custom-field'=>'list_view']) }}
                                {!! Form::label('_list_view_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_list_view_inactive')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-md-radios">
                        {!! Form::label('', trans('customfields.admin_customfield_module_add_showinform_title'))  !!}
                        <div class="md-radio-inline">
                            <div class="md-radio">
                                {{ Form::radio('showinform', 'yes',true, ['class' => 'field','id'=>'_showinform_active','data-custom-field'=>'show_in_form']) }}
                                {!! Form::label('_showinform_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_showinform_active')) !!}
                            </div>
                            <div class="md-radio">
                                {{ Form::radio('showinform', 'no',  null, ['class' => 'field','id'=>'_showinform_inactive','data-custom-field'=>'show_in_form']) }}
                                {!! Form::label('_showinform_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_showinform_inactive')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-md-radios">
                        {!! Form::label('', trans('customfields.admin_customfield_module_add_searchable_title'))  !!}
                        <div class="md-radio-inline">
                            <div class="md-radio">
                                {{ Form::radio('searchable', 'yes',true, ['class' => 'field','id'=>'_searchable_active','data-custom-field'=>'searchable']) }}
                                {!! Form::label('_searchable_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_searchable_active')) !!}
                            </div>
                            <div class="md-radio">
                                {{ Form::radio('searchable', 'no',  null, ['class' => 'field','id'=>'_searchable_inactive','data-custom-field'=>'searchable']) }}
                                {!! Form::label('_searchable_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_searchable_inactive')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-md-radios">
                        {!! Form::label('', trans('customfields.admin_customfield_module_add_advance_searchable_title'))  !!}
                        <div class="md-radio-inline">
                            <div class="md-radio">
                                {{ Form::radio('advance_searchable', 'yes',true, ['class' => 'field','id'=>'_advance_searchable_active','data-custom-field'=>'advance_searchable']) }}
                                {!! Form::label('_advance_searchable_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_advance_searchable_active')) !!}
                            </div>
                            <div class="md-radio">
                                {{ Form::radio('advance_searchable', 'no',  null, ['class' => 'field','id'=>'_advance_searchable_inactive','data-custom-field'=>'advance_searchable']) }}
                                {!! Form::label('_advance_searchable_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_advance_searchable_inactive')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-md-radios">
                        {!! Form::label('', trans('customfields.admin_customfield_module_add_filter_searchable_title'))  !!}
                        <div class="md-radio-inline">
                            <div class="md-radio">
                                {{ Form::radio('filter_searchable', 'yes',true, ['class' => 'field','id'=>'_filter_searchable_active','data-custom-field'=>'filter_searchable']) }}
                                {!! Form::label('_filter_searchable_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_filter_searchable_active')) !!}
                            </div>
                            <div class="md-radio">
                                {{ Form::radio('filter_searchable', 'no',  null, ['class' => 'field','id'=>'_filter_searchable_inactive','data-custom-field'=>'filter_searchable']) }}
                                {!! Form::label('_filter_searchable_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_filter_searchable_inactive')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-md-radios">
                        {!! Form::label('', trans('customfields.admin_customfield_module_add_required_field_title'))  !!}
                        <div class="md-radio-inline">
                            <div class="md-radio">
                                {{ Form::radio('required_field', 'yes',true, ['class' => 'field','id'=>'_required_field_active','data-custom-field'=>'required_field']) }}
                                {!! Form::label('_required_field_active','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_required_field_active')) !!}
                            </div>
                            <div class="md-radio">
                                {{ Form::radio('required_field', 'no',  null, ['class' => 'field','id'=>'_required_field_inactive','data-custom-field'=>'required_field']) }}
                                {!! Form::label('_required_field_inactive','<span></span><span class="check"></span><span class="box"></span>'.trans('customfields.admin_customfield_module_add_required_field_inactive')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="add_new_custom_field" value="true" type="submit" class="btn blue m-t-0">{{trans('customfields.admin_customfield_module_add_btn_submit')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('customfields.admin_customfield_module_btn_reset')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Edit model end here-->
<script src="{{URL::to('/../crm_layout/tinymce/js/tinymce/tinymce.min.js')}}" type="text/javascript"></script>
<script>
    
    function vc_edit_element(This) {
        
        var element_type = $(This).data("element-type");
        var element_id = $(This).data("id");
        var template_id = $(This).data("template-id");

        $.ajax({
            url: "{{URL::to('admin/crmlayouts/ajax_get_crm_element/')}}/" + element_id,
            type: "POST",
            data: {_token: '{{ csrf_token() }}'},
            dataType: 'JSON',
            success: function (data, textStatus, jqXHR) {
                if (data.error == '0') {

                    var row = data.data;
                    var options = jQuery.parseJSON(data.data.element_options);

                    if(element_type == 'separator') {
                        $("#edit-separator-pop-up .id").val(row.crm_element_id);
                        $("#edit-separator-pop-up .row_id").val(row.row_id);
                        $("#edit-separator-pop-up .group_id").val(row.group_id);
                        $("#edit-separator-pop-up .template_id").val(template_id);

                        $("#edit-separator-pop-up .color").val(options.color);
                        $("#edit-separator-pop-up .alignment").val(options.alignment);
                        $("#edit-separator-pop-up .style").val(options.style);
                        $("#edit-separator-pop-up .border_width").val(options.border_width);
                        $("#edit-separator-pop-up .element_width").val(options.element_width);

                        $(".vc-color-picker").minicolors('value', options.color);

                        $("#edit-separator-pop-up").modal();
                    }
                    else if(element_type == 'empty-space') {
                        $("#edit-empty-space-pop-up .id").val(row.crm_element_id);
                        $("#edit-empty-space-pop-up .row_id").val(row.row_id);
                        $("#edit-empty-space-pop-up .group_id").val(row.group_id);
                        $("#edit-empty-space-pop-up .template_id").val(template_id);

                        $("#edit-empty-space-pop-up .height").val(options.height);
                        $("#edit-empty-space-pop-up").modal();
                    }
                    else if(element_type == 'accordion') {
                        $("#edit-accordion-pop-up .id").val(row.crm_element_id);
                        $("#edit-accordion-pop-up .row_id").val(row.row_id);
                        $("#edit-accordion-pop-up .group_id").val(row.group_id);
                        $("#edit-accordion-pop-up .template_id").val(template_id);

                        var section_html = '';
                        var section_no = 1;

                        for(var i = 0; i < options.sections.length; i++) {

                            section_html += '<fieldset>';
                                section_html += '<legend>Accordion Section ' + section_no + ': <a class="pull-right btn btn-danger btn-sm" onclick="vc_remove_section(this);" href="javascript:void(0);"><i class="fa fa-trash"></i></a></legend>';
                                section_html += '<div class="form-group">';
                                    section_html += '<label>Title</label>';
                                    section_html += '<input class="form-control" name="section_title[]" type="text" value="' + options.sections[i].section_title + '" />';
                                    section_html += '<input name="element_id[]" type="hidden" value="' + options.sections[i].element_id + '" />';
                                section_html += '</div>';
                                section_html += '<div class="form-group">';
                                    section_html += '<label>Element</label>';
                                    section_html += '<select class="form-control" name="section_element[]">';
                                        section_html += '<option></option>';
                                        
                                        if(options.sections[i].section_element == 'separator') {
                                            section_html += '<option selected value="separator">Separator</option>';
                                        }
                                        else {
                                            section_html += '<option value="separator">Separator</option>';
                                        }
                                        if(options.sections[i].section_element == 'empty-space') {
                                            section_html += '<option selected value="empty-space">Empty Space</option>';
                                        }
                                        else {
                                            section_html += '<option value="empty-space">Empty Space</option>';
                                        }
                                        if(options.sections[i].section_element == 'text-block') {
                                            section_html += '<option selected value="text-block">Text Block</option>';
                                        }
                                        else {
                                            section_html += '<option value="text-block">Text Block</option>';
                                        }
                                        if(options.sections[i].section_element == 'tabs') {
                                            section_html += '<option selected value="tabs">Tabs</option>';
                                        }
                                        else {
                                            section_html += '<option value="tabs">Tabs</option>';
                                        }
                                        if(options.sections[i].section_element == 'crm-fields') {
                                            section_html += '<option selected value="crm-fields">CRM Fields</option>';
                                        }
                                        else {
                                            section_html += '<option value="crm-fields">CRM Fields</option>';
                                        }
                                        
                                    section_html += '</select>';
                                section_html += '</div>';
                                section_html += '<i onclick="vc_edit_element(this);" data-id="' + options.sections[i].element_id + '" data-element-type="' + options.sections[i].section_element + '" data-template-id="' + template_id + '" title="Edit Field" aria-hidden="true" class="edit-vc-element fa fa-pencil"> Edit Element</i>';
                            section_html += '</fieldset>';

                            section_no++;
                        }

                        $(".vc-pop-up-sections-holder").html( section_html );
                        $(".vc-add-more-section").data("section-no", (section_no));

                        $("#edit-accordion-pop-up").modal();
                    }
                    else if(element_type == 'tabs') {
                        $("#edit-tabs-pop-up .id").val(row.crm_element_id);
                        $("#edit-tabs-pop-up .row_id").val(row.row_id);
                        $("#edit-tabs-pop-up .group_id").val(row.group_id);
                        $("#edit-tabs-pop-up .template_id").val(template_id);

                        var tab_html = '';
                        var tab_no = 1;

                        for(var i = 0; i < options.tabs.length; i++) {

                            tab_html += '<fieldset>';
                                tab_html += '<legend>Tab ' + tab_no + ': <a class="pull-right btn btn-danger btn-sm" onclick="vc_remove_tab(this);" href="javascript:void(0);"><i class="fa fa-trash"></i></a></legend>';
                                tab_html += '<div class="form-group">';
                                    tab_html += '<label>Title</label>';
                                    tab_html += '<input class="form-control" name="tab_title[]" type="text" value="' + options.tabs[i].tab_title + '" />';
                                    tab_html += '<input name="element_id[]" type="hidden" value="' + options.tabs[i].element_id + '" />';
                                tab_html += '</div>';
                                tab_html += '<div class="form-group">';
                                    tab_html += '<label>Element</label>';
                                    tab_html += '<select class="form-control" name="tab_element[]">';
                                        tab_html += '<option></option>';
                                        
                                        if(options.tabs[i].tab_element == 'separator') {
                                            tab_html += '<option selected value="separator">Separator</option>';
                                        }
                                        else {
                                            tab_html += '<option value="separator">Separator</option>';
                                        }
                                        if(options.tabs[i].tab_element == 'empty-space') {
                                            tab_html += '<option selected value="empty-space">Empty Space</option>';
                                        }
                                        else {
                                            tab_html += '<option value="empty-space">Empty Space</option>';
                                        }
                                        if(options.tabs[i].tab_element == 'text-block') {
                                            tab_html += '<option selected value="text-block">Text Block</option>';
                                        }
                                        else {
                                            tab_html += '<option value="text-block">Text Block</option>';
                                        }
                                        if(options.tabs[i].tab_element == 'crm-fields') {
                                            tab_html += '<option selected value="crm-fields">CRM Fields</option>';
                                        }
                                        else {
                                            tab_html += '<option value="crm-fields">CRM Fields</option>';
                                        }
                                    tab_html += '</select>';
                                tab_html += '</div>';
                                tab_html += '<i onclick="vc_edit_element(this);" data-id="' + options.tabs[i].element_id + '" data-element-type="' + options.tabs[i].tab_element + '" data-template-id="' + template_id + '" title="Edit Field" aria-hidden="true" class="edit-vc-element fa fa-pencil"> Edit Element</i>';
                            tab_html += '</fieldset>';

                            tab_no++;
                        }

                        $(".vc-pop-up-tabs-holder").html( tab_html );
                        $(".vc-add-more-tab").data("tab-no", (tab_no));

                        $("#edit-tabs-pop-up").modal();
                    }
                    else if(element_type == 'text-block') {
                        $("#edit-text-block-pop-up .id").val(row.crm_element_id);
                        $("#edit-text-block-pop-up .row_id").val(row.row_id);
                        $("#edit-text-block-pop-up .group_id").val(row.group_id);
                        $("#edit-text-block-pop-up .template_id").val(template_id);

                        $("#edit-text-block-pop-up .text").val(options.text);
                        $("#edit-text-block-pop-up").modal();

                        tinyMCE.activeEditor.setContent(options.text);

                    }
                }
            }
        });
    }
    function ai_remove_crm_element(id) {
        if (confirm("Are you sure?")) {
            window.location.href = "{{URL::to('admin/crmlayouts/delete_crm_element/')}}/" + id + "/<?php echo $template->template_id; ?>";
        } else {
            return false;
        }
    }
    
    function ai_remove_custom_filed(id) {
        if (confirm("Are you sure?")) {
            window.location.href = "{{URL::to('admin/crmlayouts/delete_custom_field/')}}/" + id + "/<?php echo $template->template_id; ?>";
        } else {
            return false;
        }
    }
    
    function vc_remove_section(This) {
        if(confirm("Are you sure?")) {
            $(This).parents("fieldset").remove();
        }
        return false;
    }
    
    function vc_remove_tab(This) {
        if(confirm("Are you sure?")) {
            $(This).parents("fieldset").remove();
        }
        return false;
    }
    
    $(document).ready(function () {

        $(".vc-color-picker").minicolors();
        $(".vc-color-picker").minicolors('value', '#adadad');

        tinymce.init({
            selector: ".vc-text-editor",
            height: 500,
            menubar: false,
            plugins: [
              'advlist autolink lists link image charmap print preview anchor textcolor',
              'searchreplace visualblocks code fullscreen',
              'insertdatetime media table contextmenu paste code help'
            ],
            toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tinymce.com/css/codepen.min.css']
        });

        /*
         * VC Elements
         */

        $(".vc-remove-section-btn").click(function( event ) {
            event.preventDefault();
            if(confirm("Are you sure?")) {
                $(this).parents("fieldset").remove();
            }
        });

        $(".vc-add-more-section").click(function() {
            var section_no = $(this).data("section-no");
            
            var section_html = '<fieldset>';
                section_html += '<legend>Accordion Section ' + section_no + ': <a class="pull-right btn btn-danger btn-sm" onclick="vc_remove_section(this);" href="javascript:void(0);"><i class="fa fa-trash"></i></a></legend>';
                section_html += '<div class="form-group">';
                    section_html += '<label>Title</label>';
                    section_html += '<input class="form-control" name="section_title[]" type="text" />';
                    section_html += '<input name="element_id[]" type="hidden" value="0" />';
                section_html += '</div>';
                section_html += '<div class="form-group">';
                    section_html += '<label>Element</label>';
                    section_html += '<select class="form-control" name="section_element[]">';
                        section_html += '<option></option>';
                        section_html += '<option value="separator">Separator</option>';
                        section_html += '<option value="empty-space">Empty Space</option>';
                        section_html += '<option value="text-block">Text Block</option>';
                        section_html += '<option value="tabs">Tabs</option>';
                        section_html += '<option value="crm-fields">CRM Fields</option>';
                    section_html += '</select>';
                section_html += '</div>';
            section_html += '</fieldset>';
            
            $(".vc-pop-up-sections-holder").append( section_html );
            $(this).data("section-no", (+section_no) + 1);
        });

        $(".vc-add-more-tab").click(function() {
            var tab_no = $(this).data("tab-no");
            
            var tab_html = '<fieldset>';
                tab_html += '<legend>Tab ' + tab_no + ': <a class="pull-right btn btn-danger btn-sm" onclick="vc_remove_tab(this);" href="javascript:void(0);"><i class="fa fa-trash"></i></a></legend>';
                tab_html += '<div class="form-group">';
                    tab_html += '<label>Title</label>';
                    tab_html += '<input class="form-control" name="tab_title[]" type="text" />';
                    tab_html += '<input name="element_id[]" type="hidden" value="0" />';
                tab_html += '</div>';
                tab_html += '<div class="form-group">';
                    tab_html += '<label>Element</label>';
                    tab_html += '<select class="form-control" name="tab_element[]">';
                        tab_html += '<option></option>';
                        tab_html += '<option value="separator">Separator</option>';
                        tab_html += '<option value="empty-space">Empty Space</option>';
                        tab_html += '<option value="text-block">Text Block</option>';
//                        tab_html += '<option value="tabs">Tabs</option>';
                        tab_html += '<option value="crm-fields">CRM Fields</option>';
                    tab_html += '</select>';
                tab_html += '</div>';
            tab_html += '</fieldset>';
            
            $(".vc-pop-up-tabs-holder").append( tab_html );
            $(this).data("tab-no", (+tab_no) + 1);
        });

        $(".vc-element-custom-fields").click(function( event ) {
            event.preventDefault();
            $("#vc-elements-pop-up").modal('toggle');
            
            var row_id = $("#vc-elements-pop-up .row_id").val();
            var group_id = $("#vc-elements-pop-up .group_id").val();
            
            $("#add-new-custom-field-pop-up .row_id").val( row_id );
            $("#add-new-custom-field-pop-up .group_id").val( group_id );
            
            $("#add-new-custom-field-pop-up").modal();
        });

        $(".vc-element-btn").click(function( event ) {
            event.preventDefault();
            /*$("#vc-elements-pop-up").modal('toggle');*/
            
            var row_id = $("#vc-elements-pop-up .row_id").val();
            var group_id = $("#vc-elements-pop-up .group_id").val();
            var element = $(this).data("element");
            
            $.ajax({
                url: "{{URL::to('admin/crmlayouts/save_row_element/')}}",
                type: "POST",
                data: {_token: '{{ csrf_token() }}', row_id: row_id, group_id: group_id, element: element},
                dataType: 'JSON',
                success: function (data, textStatus, jqXHR) {
                    window.location.reload();
                },
                complete: function (jqXHR, textStatus ) {
                    window.location.reload();
                }
            });
            
        });
        
        /************* VC Elements End **************/

        $(".vc-elements-pop-up-btn").click(function( event ) {
            event.preventDefault();
            
            var row_id = $(this).data("row-id");
            var group_id = $(this).data("group-id");
            
            $("#vc-elements-pop-up .row_id").val( row_id );
            $("#vc-elements-pop-up .group_id").val( group_id );
            $("#vc-elements-pop-up").modal();
        });

        $(".vc-custom-row-layout").click(function( event ) {
            event.preventDefault();
            
            var row_id = $(this).data('row-id');
            var default_val = $(this).data('default');
            $("#vc-custom-row-layout-pop-up .row_id").val( row_id );
            $("#vc-custom-row-layout-pop-up .custom_layout").val( default_val );
            $("#vc-custom-row-layout-pop-up").modal();
            
        });

        $(".edit-vc-element").click(function ( event ) {
            event.preventDefault();
            vc_edit_element(this);
        });
        
        $(".ai-edit-custom-field").click(function () {
            $("#edit-custom-field-pop-up").modal();
            var id = $(this).data("id");
            $.ajax({
                url: "{{URL::to('admin/crmlayouts/ajax_get_custom_field/')}}/" + id,
                type: "POST",
                data: {_token: '{{ csrf_token() }}'},
                dataType: 'JSON',
                success: function (data, textStatus, jqXHR) {
                    if (data.error == '0') {

                        var option_mcf = jQuery.parseJSON(data.data.option_mcf);

                        $("#edit-custom-field-pop-up .group_id").val(data.data.idmfg_mcf);
                        $("#edit-custom-field-pop-up .customfield_id").val(data.data.crm_customfield_id);
                        $("#edit-custom-field-pop-up .row-name-select").val(data.data.group.row_id);
                        $("#edit-custom-field-pop-up .group-name-select").val(data.data.group.slug_mfg);
                        $("#edit-custom-field-pop-up .custom-field-types").val(option_mcf.type).click();
                        $("#edit-custom-field-pop-up .title_mcf").val(data.data.title_mcf).click();

                        if (option_mcf.status == 'yes') {
                            $("label[for=_status_active]").click();
                        } else {
                            $("label[for=_status_inactive]").click();
                        }

                        if (option_mcf.list_view == 'yes') {
                            $("label[for=_list_view_active]").click();
                        } else {
                            $("label[for=_list_view_inactive]").click();
                        }

                        if (option_mcf.show_in_form == 'yes') {
                            $("label[for=_showinform_active]").click();
                        } else {
                            $("label[for=_showinform_inactive]").click();
                        }

                        if (option_mcf.searchable == 'yes') {
                            $("label[for=_searchable_active]").click();
                        } else {
                            $("label[for=_searchable_inactive]").click();
                        }

                        if (option_mcf.advance_searchable == 'yes') {
                            $("label[for=_advance_searchable_active]").click();
                        } else {
                            $("label[for=_advance_searchable_inactive]").click();
                        }

                        if (option_mcf.filter_searchable == 'yes') {
                            $("label[for=_filter_searchable_active]").click();
                        } else {
                            $("label[for=_filter_searchable_inactive]").click();
                        }

                        if (option_mcf.required_field == 'yes') {
                            $("label[for=_required_field_active]").click();
                        } else {
                            $("label[for=_required_field_inactive]").click();
                        }
                    }
                }
            });
        });

        $(".row-name-select").change(function () {
            if ($(this).val() == 'new') {
                $(".new-row-input").show();
            } else {
                $(".new-row-input").hide();
            }
            $('.group-name-select option').hide();
            $('.group-name-select option[data-row-id="' + $(this).val() + '"]').show();
            $('.group-name-select option[data-row-id="new"]').show();
            $('.group-name-select').val('');
        });

        $(".group-name-select").change(function () {
            if ($(this).val() == 'Other') {
                $(".other-group-input").show();
            } else {
                $(".other-group-input").hide();
            }
        });

        $(document).on('click', '[data-action="add-form-field-type"]', function () {
            var FormFieldTypeCount = $('[data-field-option="list"] table tbody tr[data-form-field-type-row]').length;
            if (FormFieldTypeCount > 0) {
                FormFieldTypeCount++;
            }
            if (FormFieldTypeCount == 0) {
                FormFieldTypeCount = 1;
            }
            var setIndexFormFieldTypeCount = FormFieldTypeCount - 1;

            var strFormFieldTypeBuilder = '<tr data-form-field-type-row="' + setIndexFormFieldTypeCount + '">';
            strFormFieldTypeBuilder += '<td><i class="fa fa-bars" aria-hidden="true"></i></td>';
            strFormFieldTypeBuilder += '<td><input type="text" data-form-field-type-label="' + setIndexFormFieldTypeCount + '" name="option_label[]" class="form-control"> </td>';
            strFormFieldTypeBuilder += '<td><input type="text" data-form-field-type-value="' + setIndexFormFieldTypeCount + '" name="option_value[]" class="form-control"> </td>';
            strFormFieldTypeBuilder += '<td><a class="btn default red btn-circle m-t-0" data-action="remove-data-form-field-type-label" data-val="' + setIndexFormFieldTypeCount + '"><i class="fa fa-trash"></i></a></td>';
            strFormFieldTypeBuilder += '</tr>';
            $('[data-field-option="list"] table tbody').append(strFormFieldTypeBuilder);
        });

        $(document).on('change', 'select[data-custom-field="type"]', function () {
            if ($(this).val() == 'select' || $(this).val() == 'radio' || $(this).val() == 'checkbox') {
                $('[data-field-option="list"]').fadeIn('slow');
            } else {
                $('[data-field-option="list"] table tbody').html('');
                $('[data-field-option="list"]').hide();
            }
        });

        $(document).on('click', '[data-action="remove-data-form-field-type-label"]', function () {
            $('[data-field-option="list"] [data-form-field-type-row="' + $(this).attr('data-val') + '"]').remove();
        });

        $(".ai-sortable-fields").sortable({
            connectWith: ".ai-sortable-fields",
            placeholder: "ui-state-highlight",
            cancel: ".ui-state-disabled",
            handle: ".ai-sortable-handler",
            update: function (event, ui) {

                var order = [];
                $(ui.item).parents(".ai-sortable-fields").find(".draggable-element").each(function (e) {
                    var jsonData = '{"sort_order":' + ($(this).index() + 1) + ',';
                    jsonData += '"id":' + ($(this).data('id')) + ',';
                    jsonData += '"group_id":' + ($(this).parents(".ai-sortable-fields").data('group-id')) + ',';
                    jsonData += '"row_id":' + ($(this).parents(".ai-sortable-fields").data('row-id')) + '}';
                    order.push(jsonData);
                });
                var positions = '[' + order.join(',') + ']';

                $.ajax({
                    url: "{{URL::to('admin/crmlayouts/ajax_save_crm_elements_order/')}}",
                    type: "POST",
                    data: {_token: '{{ csrf_token() }}', positions: positions},
                    dataType: 'JSON',
                    success: function (data, textStatus, jqXHR) {
                        
                    }
                });
            }
        });
        
        $(".vc-container").sortable({
            placeholder: "ui-state-highlight",
            cancel: ".ui-state-disabled",
            handle: ".ai-row-sortable-handler",
            update: function (event, ui) {
                var order = [];
                $(ui.item).parents(".vc-container").find(".row-container").each(function (e) {
                    order.push('"' + $(this).data('id') + '":' + ($(this).index() + 1));
                });
                var positions = '{' + order.join(',') + '}';

                $.ajax({
                    url: "{{URL::to('admin/crmlayouts/ajax_save_rows_order/')}}",
                    type: "POST",
                    data: {_token: '{{ csrf_token() }}', positions: positions},
                    dataType: 'JSON',
                    success: function (data, textStatus, jqXHR) {
                        
                    }
                });
            }
        });

        $(".vc-toggle-row").click(function (event) {
            event.preventDefault();
            $(this).parents(".row-container").find(".vc-row-body").toggle("slow");
        });

    });
</script>