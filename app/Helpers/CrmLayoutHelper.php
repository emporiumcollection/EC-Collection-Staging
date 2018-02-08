<?php

namespace App\Helpers;

use App\Models\ModelsModcustomfield;
use App\Models\Sximo\Module;
use App\Models\ModelsModcustomfieldgroup;
use App\Models\ModelsModcustomfieldrows;
use App\Models\ModelsModcustomfieldvalue;
use App\Models\ModelsModcustomfieldelements;
use App\Helpers\CustomFieldHelper;

class CrmLayoutHelper {

    static function getCrmElement($element_id) {

        $element = ModelsModcustomfieldelements::
                        leftJoin('modcustomfield_mcf', 'modcustomfield_mcf.id_modcustomfield', '=', 'modcustomfieldelements_mfg.customfield_id')
                        ->leftJoin('modcustomfieldrows_mfg', 'modcustomfieldrows_mfg.id_modcustomfieldrow', '=', 'modcustomfieldelements_mfg.row_id')
                        ->leftJoin('modcustomfieldgroup_mfg', 'modcustomfieldgroup_mfg.id_modcustomfieldgroup', '=', 'modcustomfieldelements_mfg.group_id')
                        ->select('modcustomfieldelements_mfg.*')->where('modcustomfieldelements_mfg.id_modcustomfieldelement', '=', $element_id)->first();

        return $element;
    }

    static function getCrmField($field_id) {
        
        $custom_field = Module::join('modcustomfieldgroup_mfg', 'modcustomfieldgroup_mfg.idmod_mfg', '=', 'tb_module.module_id')
                        ->join('modcustomfield_mcf', 'modcustomfield_mcf.idmfg_mcf', '=', 'modcustomfieldgroup_mfg.id_modcustomfieldgroup')
                        ->join('modcustomfieldrows_mfg', 'modcustomfieldrows_mfg.id_modcustomfieldrow', '=', 'modcustomfieldgroup_mfg.row_id')
                        ->select('modcustomfieldgroup_mfg.*', 'modcustomfieldrows_mfg.*', 'id_modcustomfield', 'title_mcf', 'slug_mcf', 'idmfg_mcf', 'option_mcf')->where('modcustomfield_mcf.id_modcustomfield', '=', $field_id)->first();

        return $custom_field;
    }

    static function drawCrmElement($element, $print = true) {

        if (empty($element)) {
            return '';
        }

        $html = '';

        $html .= '<div class="vc-element-node" data-id="' . $element['id_modcustomfieldelement'] . '" data-element-type="' . $element['type'] . '">';

        if ($element['type'] == 'crm-fields') {
            $custom_field = CrmLayoutHelper::getCrmField($element['customfield_id']);
            if (!empty($custom_field)) {
                $custom_values = ModelsModcustomfieldvalue::get();
                CrmLayoutHelper::drawCrmField($custom_field, $custom_values, 'draggable-element fa');
            }
        } elseif ($element['type'] == 'separator') {

            $element_options = json_decode($element['element_options']);
            $border_color = (isset($element_options->color)) ? $element_options->color : '#adadad';
            $alignment = (isset($element_options->alignment)) ? $element_options->alignment : 'center';
            $border_style = (isset($element_options->style)) ? $element_options->style : 'style';
            $border_width = (isset($element_options->border_width)) ? $element_options->border_width : 'border_width';
            $element_width = (isset($element_options->element_width)) ? $element_options->element_width : 'element_width';

            $html .= '<div class="vc-separator-element" style="text-align: ' . $alignment . ';"><hr style="border-color: ' . $border_color . '; border-style: ' . $border_style . '; border-width:' . $border_width . '; width: ' . $element_width . ';" /></div>';
        } elseif ($element['type'] == 'empty-space') {

            $element_options = json_decode($element['element_options']);
            $height = (isset($element_options->height)) ? $element_options->height : '32px';

            $html .= '<div class="vc-empty-space-element" style="height: ' . $height . ';"></div>';
        } elseif ($element['type'] == 'text-block') {
            $element_options = json_decode($element['element_options']);
            $html .= '<div class="vc-text-block-element">';
            $html .= (isset($element_options->text)) ? $element_options->text : '';
            $html .= '</div>';
        } elseif ($element['type'] == 'tabs') {
            $element_options = json_decode($element['element_options']);
            if (!empty($element_options->tabs)) {
                $html .= '<ul class="nav nav-tabs">';
                $vc_i = 1;
                foreach ($element_options->tabs as $vc_tab) {
                    $html .= '<li class="';
                    $html .= ($vc_i == 1) ? 'active' : '';
                    $html .= '"><a data-toggle="tab" href="#vc-tab-' . $element['id_modcustomfield'] . '-' . $vc_i . '">' . $vc_tab->tab_title . '</a></li>';
                    $vc_i++;
                }
                $html .= '</ul>';
            }
            if (!empty($element_options->tabs)) {
                $html .= '<div class="tab-content">';
                $vc_i = 1;
                foreach ($element_options->tabs as $vc_tab) {

                    $elmnt = CrmLayoutHelper::getCrmElement($vc_tab->element_id);

                    $html .= '<div id="vc-tab-' . $element['id_modcustomfield'] . '-' . $vc_i . '" class="tab-pane fade ';
                    $html .= ($vc_i == 1) ? 'in active' : '';
                    $html .= '">';
                    if ($vc_tab->tab_element == 'text-block') {
                        $html .= CrmLayoutHelper::drawCrmElement($elmnt, false);
                    }
                    $html .= '</div>';
                    $vc_i++;
                }
                $html .= '</div>';
            }
        } elseif ($element['type'] == 'accordion') {
            $element_options = json_decode($element['element_options']);

            $vc_i = 1;
            if (!empty($element_options->sections)) {
                $html .= '<div class="panel-group" id="vc-accordion-ele-' . $element['id_modcustomfieldelement'] . '">';
                foreach ($element_options->sections as $vc_section) {

                    $elmnt = CrmLayoutHelper::getCrmElement($vc_section->element_id);

                    $html .= '<div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#vc-accordion-ele-' . $element['id_modcustomfieldelement'] . '" href="#collapse-' . $element['id_modcustomfieldelement'] . '-' . $vc_i . '">' . $vc_section->section_title . '</a>
                                </h4>
                            </div>
                            <div id="collapse-' . $element['id_modcustomfieldelement'] . '-' . $vc_i . '" class="panel-collapse collapse">
                                <div class="panel-body">';
                    $html .= CrmLayoutHelper::drawCrmElement($elmnt, false);
                    $html .= '</div>
                            </div>
                        </div>';
                    $vc_i++;
                }
                $html .= '</div>';
            }
        } else {
            $html .= '<div class="vc-field-cotainer">' . $element['type'] . '</div>';
        }

        $html .= '</div>';

        if ($print) {
            echo $html;
        } else {
            return $html;
        }
        return;
    }

    static function fetchCrmLayout($module_id) {
        $all_rows = array();
        $all_other_groups = array();

        $all_rows = ModelsModcustomfieldrows::select('*', 'modcustomfieldrows_mfg.columns AS row_columns')->where('module_id', '=', $module_id)->orderBy('orderby', 'ASC')->get();
        if (!empty($all_rows)) {
            foreach ($all_rows as $r_key => $all_row) {
                $all_other_groups = ModelsModcustomfieldgroup::select('*')->where('row_id', '=', $all_row['id_modcustomfieldrow'])->get();
                if (!empty($all_other_groups)) {
                    foreach ($all_other_groups as $key => $all_other_group) {
                        $all_other_groups[$key]['elements'] = ModelsModcustomfieldelements::
                                        leftJoin('modcustomfield_mcf', 'modcustomfield_mcf.id_modcustomfield', '=', 'modcustomfieldelements_mfg.customfield_id')
                                        ->leftJoin('modcustomfieldrows_mfg', 'modcustomfieldrows_mfg.id_modcustomfieldrow', '=', 'modcustomfieldelements_mfg.row_id')
                                        ->leftJoin('modcustomfieldgroup_mfg', 'modcustomfieldgroup_mfg.id_modcustomfieldgroup', '=', 'modcustomfieldelements_mfg.group_id')
                                        ->select('modcustomfieldelements_mfg.*')->where('modcustomfieldelements_mfg.parent_id', '=', '0')->where('modcustomfieldelements_mfg.row_id', '=', $all_row['id_modcustomfieldrow'])->where('modcustomfieldelements_mfg.group_id', '=', $all_other_group['id_modcustomfieldgroup'])->orderBy('modcustomfieldelements_mfg.sort_order', 'ASC')->get();
                    }
                }
                $all_rows[$r_key]['groups'] = $all_other_groups;
            }
        }

        return $all_rows;
    }

    static function drawCrmField($data, $valueObj = array(), $custom_classes = '') {
        
        $fieldValue = array();
        if (!empty($valueObj)) {
            foreach ($valueObj as $key => $objVal) {
                $fieldValue[$objVal->option_name_mfv]['value'] = $objVal->option_value_mfv;
                $fieldValue[$objVal->option_name_mfv]['id'] = $objVal->id_modcustomfieldvalue;
            }
        }

        $html = '';
        $fieldObj = json_decode($data->option_mcf);
        $fieldName = $data->id_modcustomfield . '_' . $data->slug_mcf;
        if ($fieldObj->type == 'select' && $fieldObj->show_in_form == 'yes' && $fieldObj->status == 'yes') {
            ?>
            <div data-id="<?php echo $data->id_modcustomfield; ?>" class="<?php echo $custom_classes; ?>">
                <div class="vc-field-cotainer">
                    <div class="form-group form-md-line-input form-md-floating-label has-info">
                        <select class="form-control" id="<?php echo $fieldName; ?>" name="customFields[<?php echo $fieldName; ?>][value]">
            <?php foreach ($fieldObj->options as $val) { ?>
                                <option value="<?php echo $val->value; ?>||<?php echo $val->label; ?>" <?php
                if (isset($fieldValue[$fieldName]['value']) && $fieldValue[$fieldName]['value'] == $val->value) {
                    echo "selected";
                }
                ?>><?php echo $val->label; ?></option>
                            <?php } ?>  
                        </select>
                        <input type="hidden" name="customFields[<?php echo $fieldName; ?>][type]" value="<?php echo $fieldObj->type; ?>"/>
                                    <?php if (isset($fieldValue[$fieldName]['id'])) { ?>
                            <input type="hidden" name="customFields[<?php echo $fieldName; ?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id']; ?>"/>
            <?php } ?>
                        <label for="main_language_hbm"><?php echo $data->title_mcf; ?></label>
                        <i class="fa fa-times-circle clearInput" aria-hidden="true"></i>
                    </div>
                    <span class="help-block">Sprache </span>
                </div>
            </div>
            <?php
        }

        if ($fieldObj->type == 'text' && $fieldObj->show_in_form == 'yes' && $fieldObj->status == 'yes') {
            ?>
            <div data-id="<?php echo $data->id_modcustomfield; ?>" class="<?php echo $custom_classes; ?>" >
                <div class="vc-field-cotainer">  
                    <div class="form-group form-md-line-input form-md-floating-label help-info">
                        <input class="form-control"  id="<?php echo $fieldName; ?>" name="customFields[<?php echo $fieldName; ?>][value]" value="<?php if (isset($fieldValue[$fieldName]['value'])) {
                echo $fieldValue[$fieldName]['value'];
            } ?>" type="text" maxlength="255">
                        <input type="hidden" name="customFields[<?php echo $fieldName; ?>][type]" value="<?php echo $fieldObj->type; ?>"/>
            <?php if (isset($fieldValue[$fieldName]['id'])) { ?>
                            <input type="hidden" name="customFields[<?php echo $fieldName; ?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id']; ?>"/>
                        <?php } ?>
                        <label for="kundennummer_clt"><?php echo $data->title_mcf; ?></label>
                        <i class="fa fa-times-circle clearInput" aria-hidden="true" style="display: none;"></i>
                    </div>
                    <span class="help-block">Kundennummer oder Freitext <span class="textused">0/255</span></span>
                </div>
            </div>
            <?php
        }

        if ($fieldObj->type == 'email' && $fieldObj->show_in_form == 'yes' && $fieldObj->status == 'yes') {
            ?>
            <div data-id="<?php echo $data->id_modcustomfield; ?>" class="<?php echo $custom_classes; ?>">

                <div class="vc-field-cotainer">  
                    <div class="form-group form-md-line-input form-md-floating-label help-info">
                        <input class="form-control"  id="<?php echo $fieldName; ?>" name="customFields[<?php echo $fieldName; ?>][value]" value="<?php if (isset($fieldValue[$fieldName]['value'])) {
                echo $fieldValue[$fieldName]['value'];
            } ?>" type="email" maxlength="255">
                        <input type="hidden" name="customFields[<?php echo $fieldName; ?>][type]" value="<?php echo $fieldObj->type; ?>"/>
            <?php if (isset($fieldValue[$fieldName]['id'])) { ?>
                            <input type="hidden" name="customFields[<?php echo $fieldName; ?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id']; ?>"/>
                        <?php } ?>
                        <label for="kundennummer_clt"><?php echo $data->title_mcf; ?></label>
                        <i class="fa fa-times-circle clearInput" aria-hidden="true" style="display: none;"></i>
                    </div>
                    <span class="help-block">Kundennummer oder Freitext <span class="textused">0/255</span></span>
                </div>
            </div>
            <?php
        }

        if ($fieldObj->type == 'number' && $fieldObj->show_in_form == 'yes' && $fieldObj->status == 'yes') {
            ?>
            <div data-id="<?php echo $data->id_modcustomfield; ?>" class="<?php echo $custom_classes; ?>">
                
                <div class="vc-field-cotainer">  
                    <div class="form-group form-md-line-input form-md-floating-label help-info">
                        <input class="form-control"  id="<?php echo $fieldName; ?>" name="customFields[<?php echo $fieldName; ?>][value]" value="<?php if (isset($fieldValue[$fieldName]['value'])) {
                echo $fieldValue[$fieldName]['value'];
            } ?>" type="number" maxlength="255">
                        <input type="hidden" name="customFields[<?php echo $fieldName; ?>][type]" value="<?php echo $fieldObj->type; ?>"/>
            <?php if (isset($fieldValue[$fieldName]['id'])) { ?>
                            <input type="hidden" name="customFields[<?php echo $fieldName; ?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id']; ?>"/>
                        <?php } ?>
                        <label for="kundennummer_clt"><?php echo $data->title_mcf; ?></label>
                        <i class="fa fa-times-circle clearInput" aria-hidden="true" style="display: none;"></i>
                    </div>
                    <span class="help-block">Kundennummer oder Freitext <span class="textused">0/255</span></span>
                </div>
            </div>
            <?php
        }

        if ($fieldObj->type == 'date' && $fieldObj->show_in_form == 'yes' && $fieldObj->status == 'yes') {
            ?>
            <div data-id="<?php echo $data->id_modcustomfield; ?>" class="<?php echo $custom_classes; ?>">
                <div class="vc-field-cotainer">  
                    <div class="form-group form-md-line-input form-md-floating-label help-info">
                        <input class="form-control"  id="<?php echo $fieldName; ?>" name="customFields[<?php echo $fieldName; ?>][value]" value="<?php if (isset($fieldValue[$fieldName]['value'])) {
                echo $fieldValue[$fieldName]['value'];
            } ?>" type="date" maxlength="255">
                        <input type="hidden" name="customFields[<?php echo $fieldName; ?>][type]" value="<?php echo $fieldObj->type; ?>"/>
            <?php if (isset($fieldValue[$fieldName]['id'])) { ?>
                            <input type="hidden" name="customFields[<?php echo $fieldName; ?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id']; ?>"/>
                        <?php } ?>
                        <label for="kundennummer_clt"><?php echo $data->title_mcf; ?></label>
                        <i class="fa fa-times-circle clearInput" aria-hidden="true" style="display: none;"></i>
                    </div>
                    <span class="help-block">Kundennummer oder Freitext <span class="textused">0/255</span></span>
                </div>
            </div>
            <?php
        }
        if ($fieldObj->type == 'textarea' && $fieldObj->show_in_form == 'yes' && $fieldObj->status == 'yes') {
            ?>
            <div data-id="<?php echo $data->id_modcustomfield; ?>" class="<?php echo $custom_classes; ?>">
                <div class="vc-field-cotainer">  
                    <div class="form-group form-md-line-input form-md-floating-label has-info padding_left">
                        <textarea class="form-control" id="<?php echo $fieldName; ?>" name="customFields[<?php echo $fieldName; ?>][value]"><?php if (isset($fieldValue[$fieldName]['value'])) {
                echo $fieldValue[$fieldName]['value'];
            } ?></textarea>
                        <input type="hidden" name="customFields[<?php echo $fieldName; ?>][type]" value="<?php echo $fieldObj->type; ?>"/>
                        <?php if (isset($fieldValue[$fieldName]['id'])) { ?>
                            <input type="hidden" name="customFields[<?php echo $fieldName; ?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id']; ?>"/>
                        <?php } ?>
                        <label for="metakey_hbm"><?php echo $data->title_mcf; ?></label>

                    </div>
                    <span class="help-block">Meta Key Eingeben<span class="textused"></span></span>
                </div>
            </div>
            <?php
        }
        if ($fieldObj->type == 'file' && $fieldObj->show_in_form == 'yes' && $fieldObj->status == 'yes') {
            ?>
            <div data-id="<?php echo $data->id_modcustomfield; ?>" class="<?php echo $custom_classes; ?>">
                <div class="vc-field-cotainer">  
                    <div class="form-group form-md-line-input form-md-floating-label help-info">
                        <input class="form-control"  id="<?php echo $fieldName; ?>" name="customFields[<?php echo $fieldName; ?>][value]" type="file"> <?php if (isset($fieldValue[$fieldName]['value'])) {
                echo $fieldValue[$fieldName]['value'];
            } ?>
                        <input type="hidden" name="customFields[<?php echo $fieldName; ?>][type]" value="<?php echo $fieldObj->type; ?>"/>
                        <?php if (isset($fieldValue[$fieldName]['id'])) { ?>
                            <input type="hidden" name="customFields[<?php echo $fieldName; ?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id']; ?>"/>
            <?php } ?>
                        <label for="kundennummer_clt"><?php echo $data->title_mcf; ?></label>
                        <i class="fa fa-times-circle clearInput" aria-hidden="true" style="display: none;"></i>
                    </div>
                    <span class="help-block">Kundennummer oder Freitext <span class="textused"></span></span>
                </div>
            </div>
            <?php
        }
        if ($fieldObj->type == 'checkbox' && $fieldObj->show_in_form == 'yes' && $fieldObj->status == 'yes') {
            ?>

            <div data-id="<?php echo $data->id_modcustomfield; ?>" class="<?php echo $custom_classes; ?>">
                <div class="vc-field-cotainer form-md-checkboxes">
                    <label for=""><?php echo $data->title_mcf; ?></label>
                    <div class="md-checkbox-list">
                        <?php
                        $arrayVal = array();
                        if (isset($fieldValue[$fieldName]['value'])) {
                            $arrayVal = explode(',', $fieldValue[$fieldName]['value']);
                        }
                        ?>
            <?php foreach ($fieldObj->options as $key => $val) { ?>
                            <div class="md-checkbox">
                                <input class="md-check" id="<?php echo $fieldName . '_' . $key; ?>" name="customFields[<?php echo $fieldName; ?>][value][]" type="checkbox" value="<?php echo $val->value; ?>||<?php echo $val->label; ?>" <?php if (!empty($arrayVal) && in_array($val->value, $arrayVal)) {
                    echo "checked";
                } ?>>

                                <label for="<?php echo $fieldName . '_' . $key; ?>"><span></span><span class="check"></span><span class="box"></span><?php echo $val->label; ?></label>
                            </div>
                        <?php } ?>
                        <input type="hidden" name="customFields[<?php echo $fieldName; ?>][type]" value="<?php echo $fieldObj->type; ?>"/>
            <?php if (isset($fieldValue[$fieldName]['id'])) { ?>
                            <input type="hidden" name="customFields[<?php echo $fieldName; ?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id']; ?>"/>
            <?php } ?>	
                    </div>
                </div>
            </div>
            <?php
        }
        if ($fieldObj->type == 'radio' && $fieldObj->show_in_form == 'yes' && $fieldObj->status == 'yes') {
            ?>
            <div data-id="<?php echo $data->id_modcustomfield; ?>" class="<?php echo $custom_classes; ?>">
                <div class="vc-field-cotainer form-md-radios">
                    <label for=""><?php echo $data->title_mcf; ?></label>

            <?php foreach ($fieldObj->options as $key => $val) { ?>
                        <div class="md-radio-inline">
                            <div class="md-radio">
                                <input class="field icontype" id="<?php echo $fieldName . '_' . $key; ?>" name="customFields[<?php echo $fieldName; ?>][value]" type="radio" value="<?php echo $val->value; ?>||<?php echo $val->label; ?>" <?php if (isset($fieldValue[$fieldName]['value']) && $fieldValue[$fieldName]['value'] == $val->value) {
                    echo "checked";
                } ?>>

                                <label for="<?php echo $fieldName . '_' . $key; ?>"><span></span><span class="check"></span><span class="box"></span><?php echo $val->label; ?></label>
                            </div>
                        </div>
            <?php } ?>
                    <input type="hidden" name="customFields[<?php echo $fieldName; ?>][type]" value="<?php echo $fieldObj->type; ?>"/>
            <?php if (isset($fieldValue[$fieldName]['id'])) { ?>
                        <input type="hidden" name="customFields[<?php echo $fieldName; ?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id']; ?>"/>
            <?php } ?>

                </div>
            </div>	
            <?php
        }

        return $html;
    }

}
