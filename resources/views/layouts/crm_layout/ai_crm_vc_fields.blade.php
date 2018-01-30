<!--VC Start-->

<div class="vc-container">

    <?php
    if (!empty($all_rows)) {
        foreach ($all_rows as $all_row) {
            $row_width = 100;
            if($all_row['row_columns'] == '1') {
                $row_width = 100;
            }
            if($all_row['row_columns'] == '2') {
                $row_width = 50;
            }
            if($all_row['row_columns'] == '3') {
                $row_width = 33.33;
            }
            if($all_row['row_columns'] == '4') {
                $row_width = 25;
            }
            /*
             * style="width: calc(<?php echo $row_width; ?>% - 10px);"
             */
            ?>
            <div class="row-container ui-state-default" data-id="{{$all_row['crm_row_id']}}">
                <div class="row-head">
                    <div class="left-icons">
                        <a title="Click & Drag" href=""><i aria-hidden="true" class="ai-row-sortable-handler fa fa-arrows-alt"></i></a>
                        <a title="Collapse Row" class="vc-toggle-row" href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
                        <a title="Add Column" href="{{URL::to('admin/crmlayouts/add_new_column/')}}/{{$all_row['crm_row_id']}}/{{$template->template_id}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                        <div class="dropdown">
                            <span class="dropdown-toggle" type="button" data-toggle="dropdown"><i title="Tab Layout" class="fa fa-columns" aria-hidden="true"></i></span>
                            <ul class="dropdown-menu">
                                <li>
                                    <a title="100" class="vc-change-row-layout <?php echo ($all_row['row_columns'] == '100') ? 'selected' : ''; ?>" data-value="100" data-row-id="<?php echo $all_row['crm_row_id']; ?>" href="#">
                                        <img src="{{ asset('sximo/crm_layout/ai-vc-clm-1.png')}}" >
                                    </a>
                                </li>
                                <li>
                                    <a title="50 + 50" class="vc-change-row-layout <?php echo ($all_row['row_columns'] == '50 + 50') ? 'selected' : ''; ?>" data-value="50 + 50" data-row-id="<?php echo $all_row['crm_row_id']; ?>" href="#">
                                        <img src="{{ asset('sximo/crm_layout/ai-vc-clm-2.png')}}" >
                                    </a>
                                </li>
                                <li>
                                    <a title="33.33 + 33.33 + 33.33" class="vc-change-row-layout <?php echo ($all_row['row_columns'] == '33.33 + 33.33 + 33.33') ? 'selected' : ''; ?>" data-value="33.33 + 33.33 + 33.33" data-row-id="<?php echo $all_row['crm_row_id']; ?>" href="#">
                                        <img src="{{ asset('sximo/crm_layout/ai-vc-clm-3.png')}}" >
                                    </a>
                                </li>
                                <li>
                                    <a title="25 + 25 + 25 + 25" class="vc-change-row-layout <?php echo ($all_row['row_columns'] == '25 + 25 + 25 + 25') ? 'selected' : ''; ?>" data-value="25 + 25 + 25 + 25" data-row-id="<?php echo $all_row['crm_row_id']; ?>" href="#">
                                        <img src="{{ asset('sximo/crm_layout/ai-vc-clm-4.png')}}" >
                                    </a>
                                </li>
                                <li>
                                    <a title="20 + 20 + 20 + 20 + 20" class="vc-change-row-layout <?php echo ($all_row['row_columns'] == '20 + 20 + 20 + 20 + 20') ? 'selected' : ''; ?>" data-value="20 + 20 + 20 + 20 + 20" data-row-id="<?php echo $all_row['crm_row_id']; ?>" href="#">
                                        <img src="{{ asset('sximo/crm_layout/ai-vc-clm-5.png')}}" >
                                    </a>
                                </li>
                                <li>
                                    <a class="vc-custom-row-layout" data-default="{{$all_row['row_columns']}}" data-row-id="<?php echo $all_row['crm_row_id']; ?>" href="#">Custom</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="right-icons">
                    <!--<a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-files-o" aria-hidden="true"></i></a>-->
                        <a title="Duplicate Row" href="{{URL::to('admin/crmlayouts/duplicate_row/')}}/{{$all_row['crm_row_id']}}/{{$template->template_id}}"><i aria-hidden="true" class="fa fa-files-o"></i></a>
                        <a title="Delete Row" onclick="return confirm('Are you sure?');" href="{{URL::to('admin/crmlayouts/delete_row/')}}/{{$all_row['crm_row_id']}}/{{$template->template_id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="vc-row-body">
                    <div class="row-content">
                        <div class="vc-columns">
                            <?php
                            $rw = 0;
                            if (!empty($all_row['groups'])) {
                                foreach ($all_row['groups'] as $key => $group) {
                                    if($rw >= 100) {
                                        $rw = 0;
                                        echo '<div class="clearfix"></div>';
                                    }
                                    ?>
                                    <div style="width: calc(<?php echo $group['column_width']; ?>% - 10px);" data-row-id="{{$group['row_id']}}" data-group-id="{{$group['crm_group_id']}}" class="vc-column vc-column-{{$group['column_width']}}-{{$group['crm_group_id']}} ai-sortable-fields">
                                        
                                        <?php
                                        if(!empty($group['elements'])) {
                                            foreach ($group['elements'] as $key => $element) {
                                                
                                                echo '<div class="ui-state-default draggable-element vc-element-node" data-id="'.$element['crm_element_id'].'" data-element-type="'.$element['type'].'" data-template-id="'.$template->template_id.'">';
                                                
                                                if($element['type'] == 'crm-fields') {
                                                    CrmCustomFieldHelper::make($group['custom_fields'][$element['customfield_id']], array(), 'ui-state-default draggable-element fa', $template->template_id, URL::to('admin/crmlayouts'));
                                                }
                                                else {
                                                    ?>
                                                    <div class="vc-field-icons">
                                                        <div class="vc-left-icons">
                                                            <i title="Click & Drag" class="fa fa-arrows-alt ai-sortable-handler" aria-hidden="true"></i>
                                                        </div>
                                                        <div class="vc-right-icons">
                                                            <a title="Duplicate Field" href="<?php echo URL::to('admin/crmlayouts') . '/dupliate_crm_elements/'.$element['crm_element_id'].'/'.$template->template_id; ?>"><i aria-hidden="true" class="fa fa-files-o"></i></a>
                                                            <i title="Edit Field" aria-hidden="true" data-id="<?php echo $element['crm_element_id']; ?>" data-template-id="<?php echo $template->template_id; ?>" data-element-type="<?php echo $element['type']; ?>" class="edit-vc-element fa fa-pencil"></i>
                                                            <i title="Delete Field" aria-hidden="true" onclick="ai_remove_crm_element(<?php echo $element['crm_element_id']; ?>);" class="ai-field-delete-btn fa fa-trash"></i>
                                                        </div>
                                                    </div>
                                                    <div class="vc-field-cotainer"><?php echo $element['type']; ?></div>
                                                    <?php
                                                }
                                                
                                                echo '</div>';
                                                
                                            }
                                        }
                                        ?>
                                        
                                        <div class="vc-column-bottom">
                                            <a title="Add Element" class="vc-elements-pop-up-btn" data-row-id="{{$group['row_id']}}" data-group-id="{{$group['crm_group_id']}}" href="#"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            <!--<a title="Add Field" class="add-new-custom-field-btn" data-row-id="{{$group['row_id']}}" data-group-id="{{$group['crm_group_id']}}" href="#"><i class="fa fa-plus" aria-hidden="true"></i></a>-->
                                            <a title="Delete Tab" onclick="return confirm('Are you sure?');" href="{{URL::to('admin/crmlayouts/delete_group/')}}/{{$group['crm_group_id']}}/{{$template->template_id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            <a title="Duplicate Tab" href="{{URL::to('admin/crmlayouts/duplicate_group/')}}/{{$group['crm_group_id']}}/{{$template->template_id}}"><i aria-hidden="true" class="fa fa-files-o"></i></a>
                                        </div>
                                        <!--<div class="vc-column-bottom">{{$group['title_mfg']}}</div>-->
                                    </div>
                                    <?php
                                    $rw += $group['column_width'];
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <!--<div class="row-bottom">{{$all_row['row_name']}}</div>-->
                </div>
            </div>
            <?php
        }
    }
    ?>
    <div class="vc-add-new-row">
        <a class="add-new-row-btn" href="#"><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
</div>

<!--VC End-->