<?php
namespace App\Helpers;

class CrmCustomFieldHelper
{
	/**
     * Fetching the records from settings table based on type
	 * $type is used to define type
	 * default types are icon, colour, font
     */
    static function Make($data, $valueObj = array(), $custom_classes = '', $template_id = '', $base_url = '')
    {		$fieldValue = array();
    		if(!empty($valueObj)){
    			foreach ($valueObj as $key => $objVal) {
    				$fieldValue[$objVal->option_name_mfv]['value'] = $objVal->option_value_mfv;
    				$fieldValue[$objVal->option_name_mfv]['id'] = $objVal->crm_customfield_id;
    			}
    		}
                        
    	$html = '';
    	$fieldObj = json_decode($data->option_mcf);
    	$fieldName = $data->crm_customfield_id.'_'.$data->slug_mcf; 
		if($fieldObj->type =='select' && $fieldObj->show_in_form=='yes' && $fieldObj->status=='yes'){
			?>
                            <div class="vc-field-icons">
                                <div class="vc-left-icons">
                                    <i title="Click & Drag" class="fa fa-arrows-alt ai-sortable-handler" aria-hidden="true"></i>
                                </div>
                                <div class="vc-right-icons">
                                    <a title="Duplicate Field" href="<?php echo $base_url.'/dupliate_custom_field/'.$data->crm_customfield_id; ?><?php echo ($template_id != '')? '/'.$template_id : ''; ?>"><i aria-hidden="true" class="fa fa-files-o"></i></a>
                                    <i title="Edit Field" aria-hidden="true" data-id="<?php echo $data->crm_customfield_id; ?>" class="ai-edit-custom-field fa fa-pencil"></i>
                                    <i title="Delete Field" aria-hidden="true" onclick="ai_remove_custom_filed(<?php echo $data->crm_customfield_id; ?>);" class="ai-field-delete-btn fa fa-trash"></i>
                                </div>
                            </div>
                            <div class="vc-field-cotainer">
                                <div class="form-group form-md-line-input form-md-floating-label has-info">
                                    <select class="form-control" id="<?php echo $fieldName; ?>" name="customFields[<?php echo $fieldName; ?>][value]">
                                        <?php foreach ($fieldObj->options as $val) { ?>
                                            <option value="<?php echo $val->value; ?>||<?php echo $val->label; ?>" <?php if (isset($fieldValue[$fieldName]['value']) && $fieldValue[$fieldName]['value'] == $val->value) {
                                echo "selected";
                            } ?>><?php echo $val->label; ?></option>
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
			<?php

		}

		if($fieldObj->type =='text' && $fieldObj->show_in_form=='yes' && $fieldObj->status=='yes'){
			?>
                            <div class="vc-field-icons">
                                <div class="vc-left-icons">
                                    <i title="Click & Drag" class="fa fa-arrows-alt ai-sortable-handler" aria-hidden="true"></i>
                                </div>
                                <div class="vc-right-icons">
                                    <a title="Duplicate Field" href="<?php echo $base_url.'/dupliate_custom_field/'.$data->crm_customfield_id; ?><?php echo ($template_id != '')? '/'.$template_id : ''; ?>"><i aria-hidden="true" class="fa fa-files-o"></i></a>
                                    <i title="Edit Field" aria-hidden="true" data-id="<?php echo $data->crm_customfield_id; ?>" class="ai-edit-custom-field fa fa-pencil"></i>
                                    <i title="Delete Field" aria-hidden="true" onclick="ai_remove_custom_filed(<?php echo $data->crm_customfield_id; ?>);" class="ai-field-delete-btn fa fa-trash"></i>
                                </div>
                            </div>
                            <div class="vc-field-cotainer">  
                                <div class="form-group form-md-line-input form-md-floating-label help-info">
                                    <input class="form-control"  id="<?php echo $fieldName;?>" name="customFields[<?php echo $fieldName;?>][value]" value="<?php if(isset($fieldValue[$fieldName]['value'])){ echo  $fieldValue[$fieldName]['value']; }?>" type="text" maxlength="255">
                                    <input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
                                    <?php if(isset($fieldValue[$fieldName]['id'])){ ?>
                                                            <input type="hidden" name="customFields[<?php echo $fieldName;?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id'];?>"/>
                                    <?php }?>
                                    <label for="kundennummer_clt"><?php echo $data->title_mcf;?></label>
                                    <i class="fa fa-times-circle clearInput" aria-hidden="true" style="display: none;"></i>
                                </div>
                                <span class="help-block">Kundennummer oder Freitext <span class="textused">0/255</span></span>
                            </div>
			<?php
		}

		if($fieldObj->type =='email' && $fieldObj->show_in_form=='yes' && $fieldObj->status=='yes'){

			?>
                            
                            <div class="vc-field-icons">
                                <div class="vc-left-icons">
                                    <i title="Click & Drag" class="fa fa-arrows-alt ai-sortable-handler" aria-hidden="true"></i>
                                </div>
                                <div class="vc-right-icons">
                                    <a title="Duplicate Field" href="<?php echo $base_url.'/dupliate_custom_field/'.$data->crm_customfield_id; ?><?php echo ($template_id != '')? '/'.$template_id : ''; ?>"><i aria-hidden="true" class="fa fa-files-o"></i></a>
                                    <i title="Edit Field" aria-hidden="true" data-id="<?php echo $data->crm_customfield_id; ?>" class="ai-edit-custom-field fa fa-pencil"></i>
                                    <i title="Delete Field" aria-hidden="true" onclick="ai_remove_custom_filed(<?php echo $data->crm_customfield_id; ?>);" class="ai-field-delete-btn fa fa-trash"></i>
                                </div>
                            </div>
                            
                            <div class="vc-field-cotainer">  
                                <div class="form-group form-md-line-input form-md-floating-label help-info">
                                    <input class="form-control"  id="<?php echo $fieldName;?>" name="customFields[<?php echo $fieldName;?>][value]" value="<?php if(isset($fieldValue[$fieldName]['value'])){ echo  $fieldValue[$fieldName]['value']; }?>" type="email" maxlength="255">
                                    <input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
                                    <?php if(isset($fieldValue[$fieldName]['id'])){ ?>
                                                            <input type="hidden" name="customFields[<?php echo $fieldName;?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id'];?>"/>
                                    <?php }?>
                                    <label for="kundennummer_clt"><?php echo $data->title_mcf;?></label>
                                    <i class="fa fa-times-circle clearInput" aria-hidden="true" style="display: none;"></i>
                                </div>
                                <span class="help-block">Kundennummer oder Freitext <span class="textused">0/255</span></span>
                            </div>
			<?php
		}

		if($fieldObj->type =='number' && $fieldObj->show_in_form=='yes' && $fieldObj->status=='yes'){
			?>
                            <div class="vc-field-icons">
                                <div class="vc-left-icons">
                                    <i title="Click & Drag" class="fa fa-arrows-alt ai-sortable-handler" aria-hidden="true"></i>
                                </div>
                                <div class="vc-right-icons">
                                    <a title="Duplicate Field" href="<?php echo $base_url.'/dupliate_custom_field/'.$data->crm_customfield_id; ?><?php echo ($template_id != '')? '/'.$template_id : ''; ?>"><i aria-hidden="true" class="fa fa-files-o"></i></a>
                                    <i title="Edit Field" aria-hidden="true" data-id="<?php echo $data->crm_customfield_id; ?>" class="ai-edit-custom-field fa fa-pencil"></i>
                                    <i title="Delete Field" aria-hidden="true" onclick="ai_remove_custom_filed(<?php echo $data->crm_customfield_id; ?>);" class="ai-field-delete-btn fa fa-trash"></i>
                                </div>
                            </div>
                            <div class="vc-field-cotainer">  
                                <div class="form-group form-md-line-input form-md-floating-label help-info">
                                    <input class="form-control"  id="<?php echo $fieldName;?>" name="customFields[<?php echo $fieldName;?>][value]" value="<?php if(isset($fieldValue[$fieldName]['value'])){ echo  $fieldValue[$fieldName]['value']; }?>" type="number" maxlength="255">
                                    <input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
                                    <?php if(isset($fieldValue[$fieldName]['id'])){ ?>
                                                            <input type="hidden" name="customFields[<?php echo $fieldName;?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id'];?>"/>
                                    <?php }?>
                                    <label for="kundennummer_clt"><?php echo $data->title_mcf;?></label>
                                    <i class="fa fa-times-circle clearInput" aria-hidden="true" style="display: none;"></i>
                                </div>
                                <span class="help-block">Kundennummer oder Freitext <span class="textused">0/255</span></span>
                            </div>
			<?php
		}

		if($fieldObj->type =='date' && $fieldObj->show_in_form=='yes' && $fieldObj->status=='yes'){
			?>
                            <div class="vc-field-icons">
                                <div class="vc-left-icons">
                                    <i title="Click & Drag" class="fa fa-arrows-alt ai-sortable-handler" aria-hidden="true"></i>
                                </div>
                                <div class="vc-right-icons">
                                    <a title="Duplicate Field" href="<?php echo $base_url.'/dupliate_custom_field/'.$data->crm_customfield_id; ?><?php echo ($template_id != '')? '/'.$template_id : ''; ?>"><i aria-hidden="true" class="fa fa-files-o"></i></a>
                                    <i title="Edit Field" aria-hidden="true" data-id="<?php echo $data->crm_customfield_id; ?>" class="ai-edit-custom-field fa fa-pencil"></i>
                                    <i title="Delete Field" aria-hidden="true" onclick="ai_remove_custom_filed(<?php echo $data->crm_customfield_id; ?>);" class="ai-field-delete-btn fa fa-trash"></i>
                                </div>
                            </div>
                            <div class="vc-field-cotainer">  
                                <div class="form-group form-md-line-input form-md-floating-label help-info">
                                    <input class="form-control"  id="<?php echo $fieldName;?>" name="customFields[<?php echo $fieldName;?>][value]" value="<?php if(isset($fieldValue[$fieldName]['value'])){ echo  $fieldValue[$fieldName]['value']; }?>" type="date" maxlength="255">
                                    <input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
                                    <?php if(isset($fieldValue[$fieldName]['id'])){ ?>
                                                            <input type="hidden" name="customFields[<?php echo $fieldName;?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id'];?>"/>
                                    <?php }?>
                                    <label for="kundennummer_clt"><?php echo $data->title_mcf;?></label>
                                    <i class="fa fa-times-circle clearInput" aria-hidden="true" style="display: none;"></i>
                                </div>
                                <span class="help-block">Kundennummer oder Freitext <span class="textused">0/255</span></span>
                            </div>
			<?php
		}
		if($fieldObj->type =='textarea' && $fieldObj->show_in_form=='yes' && $fieldObj->status=='yes'){?>
                            <div class="vc-field-icons">
                                <div class="vc-left-icons">
                                    <i title="Click & Drag" class="fa fa-arrows-alt ai-sortable-handler" aria-hidden="true"></i>
                                </div>
                                <div class="vc-right-icons">
                                    <a title="Duplicate Field" href="<?php echo $base_url.'/dupliate_custom_field/'.$data->crm_customfield_id; ?><?php echo ($template_id != '')? '/'.$template_id : ''; ?>"><i aria-hidden="true" class="fa fa-files-o"></i></a>
                                    <i title="Edit Field" aria-hidden="true" data-id="<?php echo $data->crm_customfield_id; ?>" class="ai-edit-custom-field fa fa-pencil"></i>
                                    <i title="Delete Field" aria-hidden="true" onclick="ai_remove_custom_filed(<?php echo $data->crm_customfield_id; ?>);" class="ai-field-delete-btn fa fa-trash"></i>
                                </div>
                            </div>
                            <div class="vc-field-cotainer">  
                                <div class="form-group form-md-line-input form-md-floating-label has-info padding_left">
                                                                <textarea class="form-control" id="<?php echo $fieldName;?>" name="customFields[<?php echo $fieldName;?>][value]"><?php if(isset($fieldValue[$fieldName]['value'])){ echo  $fieldValue[$fieldName]['value']; }?></textarea>
                                    <input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
                                    <?php if(isset($fieldValue[$fieldName]['id'])){ ?>
                                                                        <input type="hidden" name="customFields[<?php echo $fieldName;?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id'];?>"/>
                                        <?php }?>
                                    <label for="metakey_hbm"><?php echo $data->title_mcf;?></label>

                                </div>
                               <span class="help-block">Meta Key Eingeben<span class="textused"></span></span>
                            </div>
			<?php 
		}
		if($fieldObj->type =='file' && $fieldObj->show_in_form=='yes' && $fieldObj->status=='yes'){
			?>
                            <div class="vc-field-icons">
                                <div class="vc-left-icons">
                                    <i title="Click & Drag" class="fa fa-arrows-alt ai-sortable-handler" aria-hidden="true"></i>
                                </div>
                                <div class="vc-right-icons">
                                    <a title="Duplicate Field" href="<?php echo $base_url.'/dupliate_custom_field/'.$data->crm_customfield_id; ?><?php echo ($template_id != '')? '/'.$template_id : ''; ?>"><i aria-hidden="true" class="fa fa-files-o"></i></a>
                                    <i title="Edit Field" aria-hidden="true" data-id="<?php echo $data->crm_customfield_id; ?>" class="ai-edit-custom-field fa fa-pencil"></i>
                                    <i title="Delete Field" aria-hidden="true" onclick="ai_remove_custom_filed(<?php echo $data->crm_customfield_id; ?>);" class="ai-field-delete-btn fa fa-trash"></i>
                                </div>
                            </div>
                            <div class="vc-field-cotainer">  
                                <div class="form-group form-md-line-input form-md-floating-label help-info">
                                    <input class="form-control"  id="<?php echo $fieldName;?>" name="customFields[<?php echo $fieldName;?>][value]" type="file"> <?php if(isset($fieldValue[$fieldName]['value'])){ echo  $fieldValue[$fieldName]['value']; }?>
                                              <input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
                                            <?php if(isset($fieldValue[$fieldName]['id'])){ ?>
                                                                            <input type="hidden" name="customFields[<?php echo $fieldName;?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id'];?>"/>
                                            <?php }?>
                                     <label for="kundennummer_clt"><?php echo $data->title_mcf;?></label>
                                    <i class="fa fa-times-circle clearInput" aria-hidden="true" style="display: none;"></i>
                                </div>
                                <span class="help-block">Kundennummer oder Freitext <span class="textused"></span></span>
                            </div>
			<?php
		}
		if($fieldObj->type =='checkbox' && $fieldObj->show_in_form=='yes' && $fieldObj->status=='yes'){ 
			?>

                            <div class="vc-field-icons">
                                <div class="vc-left-icons">
                                    <i title="Click & Drag" class="fa fa-arrows-alt ai-sortable-handler" aria-hidden="true"></i>
                                </div>
                                <div class="vc-right-icons">
                                    <a title="Duplicate Field" href="<?php echo $base_url.'/dupliate_custom_field/'.$data->crm_customfield_id; ?><?php echo ($template_id != '')? '/'.$template_id : ''; ?>"><i aria-hidden="true" class="fa fa-files-o"></i></a>
                                    <i title="Edit Field" aria-hidden="true" data-id="<?php echo $data->crm_customfield_id; ?>" class="ai-edit-custom-field fa fa-pencil"></i>
                                    <i title="Delete Field" aria-hidden="true" onclick="ai_remove_custom_filed(<?php echo $data->crm_customfield_id; ?>);" class="ai-field-delete-btn fa fa-trash"></i>
                                </div>
                            </div>
                            <div class="vc-field-cotainer form-md-checkboxes">
                                <label for=""><?php echo $data->title_mcf;?></label>
                                                        <div class="md-checkbox-list">
                                                                <?php 
                                                                        $arrayVal = array();
                                                                        if(isset($fieldValue[$fieldName]['value'])){ 
                                                                                $arrayVal =   explode(',',$fieldValue[$fieldName]['value']); 
                                                                        } 

                                                                ?>
                                                                <?php foreach($fieldObj->options as $key=>$val){ ?>
                                                                        <div class="md-checkbox">
                                                                                <input class="md-check" id="<?php echo $fieldName.'_'.$key;?>" name="customFields[<?php echo $fieldName;?>][value][]" type="checkbox" value="<?php echo $val->value;?>||<?php echo $val->label;?>" <?php if(!empty($arrayVal) && in_array($val->value, $arrayVal)){ echo "checked";}?>>

                                                                                <label for="<?php echo $fieldName.'_'.$key;?>"><span></span><span class="check"></span><span class="box"></span><?php echo $val->label;?></label>
                                                                        </div>
                                                                <?php } ?>
                                                                <input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
                                                                <?php if(isset($fieldValue[$fieldName]['id'])){ ?>
                                                                        <input type="hidden" name="customFields[<?php echo $fieldName;?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id'];?>"/>
                                        <?php }?>	
                                                        </div>
                            </div>
			<?php
		}
		if($fieldObj->type =='radio' && $fieldObj->show_in_form=='yes' && $fieldObj->status=='yes'){
			?>
                            <div class="vc-field-icons">
                                <div class="vc-left-icons">
                                    <i title="Click & Drag" class="fa fa-arrows-alt ai-sortable-handler" aria-hidden="true"></i>
                                </div>
                                <div class="vc-right-icons">
                                    <a title="Duplicate Field" href="<?php echo $base_url.'/dupliate_custom_field/'.$data->crm_customfield_id; ?><?php echo ($template_id != '')? '/'.$template_id : ''; ?>"><i aria-hidden="true" class="fa fa-files-o"></i></a>
                                    <i title="Edit Field" aria-hidden="true" data-id="<?php echo $data->crm_customfield_id; ?>" class="ai-edit-custom-field fa fa-pencil"></i>
                                    <i title="Delete Field" aria-hidden="true" onclick="ai_remove_custom_filed(<?php echo $data->crm_customfield_id; ?>);" class="ai-field-delete-btn fa fa-trash"></i>
                                </div>
                            </div>
                            <div class="vc-field-cotainer form-md-radios">
                                
                                    <label for=""><?php echo $data->title_mcf;?></label>

                                            <?php foreach($fieldObj->options as $key=>$val){ ?>
                                                    <div class="md-radio-inline">
                    <div class="md-radio">
                                                    <input class="field icontype" id="<?php echo $fieldName.'_'.$key;?>" name="customFields[<?php echo $fieldName;?>][value]" type="radio" value="<?php echo $val->value;?>||<?php echo $val->label;?>" <?php if(isset($fieldValue[$fieldName]['value']) && $fieldValue[$fieldName]['value']==$val->value){ echo "checked";}?>>

                                                    <label for="<?php echo $fieldName.'_'.$key;?>"><span></span><span class="check"></span><span class="box"></span><?php echo $val->label;?></label>
                                            </div>
                                                    </div>
                                            <?php } ?>
                                            <input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
                                            <?php if(isset($fieldValue[$fieldName]['id'])){ ?>
                                                    <input type="hidden" name="customFields[<?php echo $fieldName;?>][id_field]" value="<?php echo $fieldValue[$fieldName]['id'];?>"/>
                    <?php }?>

                            </div>
			<?php 
		}

		return $html;
    }
    //For dispaly custom fields in advance search form 
    static function AdvanceSearch($data)
    {		
    	$html = '';
    	$fieldObj = json_decode($data->option_mcf);
    	$fieldName = $data->crm_customfield_id.'_'.$data->slug_mcf; 
		if($fieldObj->type =='select' && $fieldObj->advance_searchable=='yes' && $fieldObj->status=='yes'){
			?>
			<div class="col-md-6 col-sm-6">
                <div class="form-group">  
                    <div class="form-group form-md-line-input form-md-floating-label has-info">
						 <select class="form-control" id="<?php echo $fieldName;?>" name="customFields[<?php echo $fieldName;?>][value]">
                         	<?php foreach($fieldObj->options as $val){ ?>
                         	  <option value="<?php echo $val->value;?>"><?php echo $val->label;?></option>
                         	<?php } ?>  
                         </select>
						<input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
						
                        <label for="main_language_hbm"><?php echo $data->title_mcf;?></label>
                        <i class="fa fa-times-circle clearInput" aria-hidden="true"></i>
                    </div>
                    <span class="help-block">Sprache </span>
                </div>
            </div>
			<?php

		}

		if($fieldObj->type =='text' && $fieldObj->advance_searchable=='yes' && $fieldObj->status=='yes'){


			?>
			<div class="col-md-6 col-sm-6">
                <div class="form-group">  
                    <div class="form-group form-md-line-input form-md-floating-label help-info">
                        <input class="form-control"  id="<?php echo $fieldName;?>" name="customFields[<?php echo $fieldName;?>][value]"  type="text" maxlength="255">
                        <input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
                       
                        <label for="kundennummer_clt"><?php echo $data->title_mcf;?></label>
                        <i class="fa fa-times-circle clearInput" aria-hidden="true" style="display: none;"></i>
                    </div>
                    <span class="help-block">Kundennummer oder Freitext <span class="textused">0/255</span></span>
                </div>
            </div>
			<?php
		}

		if($fieldObj->type =='email' && $fieldObj->advance_searchable=='yes' && $fieldObj->status=='yes'){


			?>
			<div class="col-md-6 col-sm-6">
                <div class="form-group">  
                    <div class="form-group form-md-line-input form-md-floating-label help-info">
                        <input class="form-control"  id="<?php echo $fieldName;?>" name="customFields[<?php echo $fieldName;?>][value]"  type="email" maxlength="255">
                        <input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
                       
                        <label for="kundennummer_clt"><?php echo $data->title_mcf;?></label>
                        <i class="fa fa-times-circle clearInput" aria-hidden="true" style="display: none;"></i>
                    </div>
                    <span class="help-block">Kundennummer oder Freitext <span class="textused">0/255</span></span>
                </div>
            </div>
			<?php
		}

		if($fieldObj->type =='number' && $fieldObj->advance_searchable=='yes' && $fieldObj->status=='yes'){


			?>
			<div class="col-md-6 col-sm-6">
                <div class="form-group">  
                    <div class="form-group form-md-line-input form-md-floating-label help-info">
                        <input class="form-control"  id="<?php echo $fieldName;?>" name="customFields[<?php echo $fieldName;?>][value]"  type="number" maxlength="255">
                        <input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
                       
                        <label for="kundennummer_clt"><?php echo $data->title_mcf;?></label>
                        <i class="fa fa-times-circle clearInput" aria-hidden="true" style="display: none;"></i>
                    </div>
                    <span class="help-block">Kundennummer oder Freitext <span class="textused">0/255</span></span>
                </div>
            </div>
			<?php
		}

		if($fieldObj->type =='date' && $fieldObj->advance_searchable=='yes' && $fieldObj->status=='yes'){


			?>
			<div class="col-md-6 col-sm-6">
                <div class="form-group">  
                    <div class="form-group form-md-line-input form-md-floating-label help-info">
                        <input class="form-control"  id="<?php echo $fieldName;?>" name="customFields[<?php echo $fieldName;?>][value]"  type="date" maxlength="255">
                        <input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
                       
                        <label for="kundennummer_clt"><?php echo $data->title_mcf;?></label>
                        <i class="fa fa-times-circle clearInput" aria-hidden="true" style="display: none;"></i>
                    </div>
                    <span class="help-block">Kundennummer oder Freitext <span class="textused">0/255</span></span>
                </div>
            </div>
			<?php
		}
		
		if($fieldObj->type =='checkbox' && $fieldObj->advance_searchable=='yes' && $fieldObj->status=='yes'){ 
			?>

			 <div class="col-md-6 col-sm-6">
                    <div class="form-group form-md-checkboxes">  
                        <label for=""><?php echo $data->title_mcf;?></label>
						<div class="md-checkbox-list">
							
							<?php foreach($fieldObj->options as $key=>$val){ ?>
								<div class="md-checkbox">
									<input class="md-check" id="<?php echo $fieldName.'_'.$key;?>" name="customFields[<?php echo $fieldName;?>][value][]" type="checkbox" value="<?php echo $val->value;?>" >
									  
									<label for="<?php echo $fieldName.'_'.$key;?>"><span></span><span class="check"></span><span class="box"></span><?php echo $val->label;?></label>
								</div>
							<?php } ?>
							<input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
							
						</div>
                    </div>
                </div>
			<?php
		}
		if($fieldObj->type =='radio' && $fieldObj->advance_searchable=='yes' && $fieldObj->status=='yes'){
			?>
			<div class="col-md-6 col-sm-6">
				<div class="form-group form-md-radios">
					<label for=""><?php echo $data->title_mcf;?></label>
					
						<?php foreach($fieldObj->options as $key=>$val){ ?>
						<div class="md-radio-inline">
                        <div class="md-radio">
							<input class="field icontype" id="<?php echo $fieldName.'_'.$key;?>" name="customFields[<?php echo $fieldName;?>][value]" type="radio" value="<?php echo $val->value;?>" >
							
							<label for="<?php echo $fieldName.'_'.$key;?>"><span></span><span class="check"></span><span class="box"></span><?php echo $val->label;?></label>
						</div>
						</div>
						<?php } ?>
						<input type="hidden" name="customFields[<?php echo $fieldName;?>][type]" value="<?php echo $fieldObj->type;?>"/>
						
					
				</div>
			</div>	
			<?php 
		}

		return $html;
    }

    static function Validate($data){
    	$html = '';
    	$fieldObj = json_decode($data->option_mcf);
    	$fieldName = $data->crm_customfield_id.'_'.$data->slug_mcf;
		if($fieldObj->type =='select'){

		}
		if($fieldObj->type =='text'){

		}
		if($fieldObj->type =='textarea'){

		}
		if($fieldObj->type =='file'){
		}
		if($fieldObj->type =='checkbox'){
			
		}
		if($fieldObj->type =='radio'){
			
		}

		return $html;
    }
}