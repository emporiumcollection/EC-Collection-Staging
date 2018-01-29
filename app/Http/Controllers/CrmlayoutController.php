<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\controller;
use App\Models\Crmlayout;
//use App\Models\ModBuilder;
use App\Models\Sximo\Module;
use App\Models\ModelsAiCrmRows;
use App\Models\ModelsAiCrmGroups;
use App\Models\ModelsAiCrmCustomfield;
use App\Models\ModelsAiCrmElements;
use App\Models\ModelsModcustomfield;
use App\Models\ModelsModcustomfieldgroup;
use App\Models\ModelsModcustomfieldrows;
use App\Models\ModelsModcustomfieldelements;
use App\Models\ModelsModcustomfieldvalue;
use Auth,
    Validator,
    Input,
    Redirect;
//use App\Helpers\SettingOptions;

class CrmlayoutController extends Controller {

    protected $layout = "layouts.main";
    protected $data = array();	
    public $module = 'crmlayout';
    static $per_page	= '10';
    
    public function __construct() {

            $this->beforeFilter('csrf', array('on'=>'post'));
            $this->model = new Crmlayout();

            $this->info = $this->model->makeInfo( $this->module);
            $this->access = $this->model->validAccess($this->info['id']);

            $this->data = array(
                    'pageTitle'	=> 	$this->info['title'],
                    'pageNote'	=>  $this->info['note'],
                    'pageModule'=> 'crmlayout',
                    'return'	=> self::returnUrl()

            );

    }

    /**
     * Display a listing of the crmlayout.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {
        
        if($this->access['is_view'] == 0) {
            return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
        }
        
        $this->data['crmlayouts'] = Crmlayout::All();
        return view('admin.crmlayouts.index', $this->data);
    }

    /**
     * Show the form for creating a new crmlayout.
     *
     * @return Response
     */
    public function create() {
        
        if($this->access['is_add'] == 0 ) {
            return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
        }
        
        $this->data['title'][1] = array('title' => trans('crmlayout.admin_crmlayout_module_add'), 'url' => '');
        $this->data['modules'] = ModBuilder::All();
        return view('admin.crmlayouts.create', $this->data);
    }

    /**
     * Create Template
     */
    public function create_template($template_id) {
        if($this->access['is_add'] == 0 ) {
            return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
        }
        $this->data['title'][1] = array('title' => trans('crmlayout.admin_crmlayout_module_add'), 'url' => '');
        $template = Crmlayout::select('*')->where('template_id', '=', $template_id)->first();
        
        $all_rows = array();
        $all_other_groups = array();
        
        $all_rows = ModelsAiCrmRows::select('*', 'ai_crm_rows.columns AS row_columns')->where('template_id', '=', $template->template_id)->where('module_id', '=', $template->module_id)->orderBy('orderby', 'ASC')->get();
        if(!empty($all_rows)) {
            foreach ($all_rows as $r_key => $all_row) {
                $all_other_groups = ModelsAiCrmGroups::select('*')->where('row_id','=',$all_row['crm_row_id'])->get();
                if(!empty($all_other_groups)) {
                    foreach ($all_other_groups as $key => $all_other_group) {
                        $all_other_groups[$key]['elements'] = ModelsAiCrmElements::
                                leftJoin('ai_crm_customfield','ai_crm_customfield.crm_customfield_id','ai_crm_elements.customfield_id')
                                ->leftJoin('ai_crm_rows','ai_crm_rows.crm_row_id','ai_crm_elements.row_id')
                                ->leftJoin('ai_crm_groups','ai_crm_groups.crm_group_id','=','ai_crm_elements.group_id')
                                ->select('ai_crm_elements.*')->where('ai_crm_elements.parent_id','=','0')->where('ai_crm_elements.row_id','=',$all_row['crm_row_id'])->where('ai_crm_elements.group_id','=',$all_other_group['crm_group_id'])->orderBy('ai_crm_elements.sort_order','ASC')->get();
                        
                        $custom_fields = ModBuilder::join('ai_crm_groups','ai_crm_groups.idmod_mfg','=','modbuilder_mob.id_modbuilder')
                                                ->join('ai_crm_customfield','ai_crm_customfield.idmfg_mcf','ai_crm_groups.crm_group_id')
                                                ->join('ai_crm_rows','ai_crm_rows.crm_row_id','ai_crm_groups.row_id')
                                                ->select('ai_crm_rows.*', 'ai_crm_groups.*', 'ai_crm_rows.columns AS row_columns', 'ai_crm_groups.title_mfg', 'crm_customfield_id','title_mcf','slug_mcf','idmfg_mcf','option_mcf')->where('ai_crm_groups.crm_group_id','=',$all_other_group['crm_group_id'])->orderBy('orderby_mcf','asc')->get();
                        
                        $all_other_groups[$key]['custom_fields'] = array();
                        $crm_fields = array();
                        if(!empty($custom_fields)) {
                            foreach ($custom_fields as $custom_field) {                                
                                $crm_fields[$custom_field->crm_customfield_id] = $custom_field;
                            }
                        }
                        $all_other_groups[$key]['custom_fields'] = $crm_fields;
                        
                    }
                }
                $all_rows[$r_key]['groups'] = $all_other_groups;
            }
        }
        
        $this->data['template'] = $template;
        $this->data['all_rows'] = $all_rows;
        $this->data['groups'] = ModelsAiCrmGroups::select('*')->where('idmod_mfg', '=', $template->module_id)->get();
        $this->data['rows'] = ModelsAiCrmRows::select('*')->where('module_id', '=', $template->module_id)->get();
        $this->data['modules'] = ModBuilder::All();
        return view('admin.crmlayouts.create_template', $this->data);
    }

    /**
     * Apply Template
     */
    public function apply_template($template_id) {
        if($this->access['is_add'] == 0 ) {
            return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
        }
        $this->data['title'][1] = array('title' => trans('crmlayout.admin_crmlayout_module_add'), 'url' => '');
        $template = Crmlayout::select('*')->where('template_id', '=', $template_id)->first();
        
        $all_rows = array();
        $all_other_groups = array();
        
        $all_rows = ModelsAiCrmRows::select('*')->where('template_id', '=', $template->template_id)->where('module_id', '=', $template->module_id)->get();
        if(!empty($all_rows)) {
            foreach ($all_rows as $r_key => $all_row) {
                $all_other_groups = ModelsAiCrmGroups::select('*')->where('row_id','=',$all_row['crm_row_id'])->get();
                if(!empty($all_other_groups)) {
                    foreach ($all_other_groups as $key => $all_other_group) {
                        $all_other_groups[$key]['all_custom_fields'] = ModBuilder::join('ai_crm_groups','ai_crm_groups.idmod_mfg','=','modbuilder_mob.id_modbuilder')
                                                ->join('ai_crm_customfield','ai_crm_customfield.idmfg_mcf','ai_crm_groups.crm_group_id')
                                                ->join('ai_crm_rows','ai_crm_rows.crm_row_id','ai_crm_groups.row_id')
                                                ->select('ai_crm_groups.*', 'ai_crm_rows.*', 'ai_crm_groups.title_mfg', 'crm_customfield_id','title_mcf','slug_mcf','idmfg_mcf','option_mcf')->where('ai_crm_groups.crm_group_id','=',$all_other_group['crm_group_id'])->orderBy('orderby_mcf','asc')->get();
                    }
                }
                $all_rows[$r_key]['groups'] = $all_other_groups;
            }
        }
        
        $this->data['template'] = $template;
        $this->data['all_rows'] = $all_rows;
        $this->data['groups'] = ModelsAiCrmGroups::select('*')->where('idmod_mfg', '=', $template->module_id)->get();
        $this->data['rows'] = ModelsAiCrmRows::select('*')->where('module_id', '=', $template->module_id)->get();
        $this->data['modules'] = ModBuilder::All();
        return view('admin.crmlayouts.apply_template', $this->data);
    }
    
    /*
     * Apply template to module
     */

    function do_apply_template(Request $request) {
        
        $module_id = $request->input('module_id');
        $overwrite = $request->input('overwrite');
        
        $template = Crmlayout::select('*')->where('template_id', '=', $request->input('template_id'))->first();
        
        if($overwrite == 'yes') {
            $rows = ModelsModcustomfieldrows::select('*')->where('module_id', '=', $module_id)->get();
            if(!empty($rows)) {
                foreach ($rows as $row) {
                    ModelsModcustomfieldrows::destroy($row->id_modcustomfieldrow);
                    $groups = ModelsModcustomfieldgroup::where('row_id', $row->id_modcustomfieldrow)->get();
                    if(!empty($groups)) {
                        foreach ($groups as $group) {
                            ModelsModcustomfieldelements::where('group_id', $group['id_modcustomfieldgroup'])->delete();
                            ModelsModcustomfield::where('idmfg_mcf', $group['id_modcustomfieldgroup'])->delete();
                            ModelsModcustomfieldgroup::where('id_modcustomfieldgroup', $group['id_modcustomfieldgroup'])->delete();
                        }
                    }
                }
            }
        }
        
        $rows = ModelsAiCrmRows::select('*')->where('template_id', '=', $template->template_id)->get();
        if(!empty($rows)) {
            foreach ($rows as $row) {
                
                $table_row = new ModelsModcustomfieldrows;
                $table_row->row_name = $row->row_name;
                $table_row->module_id = $module_id;
                $table_row->columns = $row->columns;
                $table_row->orderby = $row->orderby;
                $table_row->save();
                $row_id = $table_row->id_modcustomfieldrow;
                
                $groups = ModelsAiCrmGroups::select('*')->where('row_id', '=', $row->crm_row_id)->get();
                if(!empty($groups)) {
                    foreach ($groups as $group) {
                        
                        $grp = new ModelsModcustomfieldgroup;
                        $grp->row_id = $row_id;
                        $grp->title_mfg = $group->title_mfg;
                        $grp->slug_mfg = $group->slug_mfg;
                        $grp->idmod_mfg = $module_id;
                        $grp->columns = $group->columns;
                        $grp->column_width = $group->column_width;
                        $grp->orderby_mfg = $group->orderby_mfg;
                        $grp->save();
                        $group_id = $grp->id_modcustomfieldgroup;
                        
                        $elements = ModelsAiCrmElements::select('*')->where('row_id', '=', $group->row_id)->where('group_id', '=', $group->crm_group_id)->get();
                        if(!empty($elements)) {
                            foreach ($elements as $element) {
                                
                                $elmnt = new ModelsModcustomfieldelements;
                                $elmnt->row_id = $row_id;
                                $elmnt->group_id = $group_id;
                                $elmnt->parent_id = $element->parent_id;
                                $elmnt->type = $element->type;
                                $elmnt->sort_order = $element->sort_order;
                                
                                $customfield_id = $element->customfield_id;
                                $element_options = $element->element_options;
                                
                                if($element->type == 'crm-fields') {
                                    $field = ModelsAiCrmCustomfield::select('*')->where('crm_customfield_id', '=', $element->customfield_id)->first();
                                    $option_mcf = json_decode($field->option_mcf);

                                    $params = array('module_id' => $module_id,
                                                    'group_slug' => $group->slug_mfg,
                                                    'type' => (isset($option_mcf->type)? $option_mcf->type : ''),
                                                    'title' => (isset($option_mcf->title)? $option_mcf->title : ''),
                                                    'status' => (isset($option_mcf->status)? $option_mcf->status : ''),
                                                    'list_view' => (isset($option_mcf->list_view)? $option_mcf->list_view : ''),
                                                    'show_in_form' => (isset($option_mcf->show_in_form)? $option_mcf->show_in_form : ''),
                                                    'searchable' => (isset($option_mcf->searchable)? $option_mcf->searchable : ''),
                                                    'advance_searchable' => (isset($option_mcf->advance_searchable)? $option_mcf->advance_searchable : ''),
                                                    'filter_searchable' => (isset($option_mcf->filter_searchable)? $option_mcf->filter_searchable : ''),
                                                    'options' => (isset($option_mcf->options)? $option_mcf->options : ''),
                                                    'required_field' => (isset($option_mcf->required_field)? $option_mcf->required_field : ''),
                                                    '_token' => $request->input('_token')
                                                );
                                    $params = json_encode($params);

                                    $fld = new ModelsModcustomfield;
                                    $fld->title_mcf = $field->title_mcf;
                                    $fld->slug_mcf = $field->slug_mcf;
                                    $fld->idmfg_mcf = $group_id;
                                    $fld->option_mcf = $params;
                                    $fld->save();
                                    $customfield_id = $fld->id_modcustomfield;
                                    
                                }
                                elseif($element->type == 'tabs') {
                                    $element_options = CrmlayoutController::migrate_tab_elements($element);
                                }
                                elseif($element->type == 'accordion') {
                                    $element_options = CrmlayoutController::migrate_accordion_elements($element);
                                }
                                
                                $elmnt->customfield_id = $customfield_id;
                                $elmnt->element_options = $element_options;
                                
                                $elmnt->save();
                                $element_id = $elmnt->id_modcustomfieldelement;
                                
                            }
                        }
                        
                    }
                }
            }
        }
        
        $request->session()->flash('alert-success', 'Template applied successfully.');
        return redirect('admin/crmlayouts');
    }
    
    function migrate_tab_elements($element) {
        
        if(empty($element)) {
            return;
        }
        
        $element_options = json_decode($element->element_options);
        if(!empty($element_options->tabs)) {
            foreach ($element_options->tabs as $key => $vc_tab) {
                $temp_elemnt = ModelsAiCrmElements::select('*')->where('crm_element_id', '=', $vc_tab->element_id)->first();

                if(!empty($temp_elemnt)) {
                    
                    $tab_elmnt = new ModelsModcustomfieldelements;
                    $tab_elmnt->row_id = $temp_elemnt->row_id;
                    $tab_elmnt->group_id = $temp_elemnt->group_id;
                    $tab_elmnt->parent_id = $temp_elemnt->parent_id;
                    $tab_elmnt->customfield_id = $temp_elemnt->customfield_id;
                    $tab_elmnt->type = $temp_elemnt->type;
                    $tab_elmnt->sort_order = $temp_elemnt->sort_order;
                    $temp_element_options = $temp_elemnt->element_options;
                    
                    if($temp_elemnt->type == 'tabs') {
                        $temp_element_options = CrmlayoutController::migrate_tab_elements($temp_elemnt);
                    }
                    elseif($temp_elemnt->type == 'accordion') {
                        $temp_element_options = CrmlayoutController::migrate_accordion_elements($temp_elemnt);
                    }
                    
                    $tab_elmnt->element_options = $temp_element_options;
                    $tab_elmnt->save();
                    $tab_element_id = $tab_elmnt->id_modcustomfieldelement;
                    $element_options->tabs[$key]->element_id = $tab_element_id;
                    
                }

            }
        }
        return $element_options = json_encode($element_options);
    }
    
    function migrate_accordion_elements($element) {
        
        if(empty($element)) {
            return;
        }
        
        $element_options = json_decode($element->element_options);
        if(!empty($element_options->sections)) {
            foreach ($element_options->sections as $key => $vc_section) {
                $temp_elemnt = ModelsAiCrmElements::select('*')->where('crm_element_id', '=', $vc_section->element_id)->first();

                if(!empty($temp_elemnt)) {
                    
                    $tab_elmnt = new ModelsModcustomfieldelements;
                    $tab_elmnt->row_id = $temp_elemnt->row_id;
                    $tab_elmnt->group_id = $temp_elemnt->group_id;
                    $tab_elmnt->parent_id = $temp_elemnt->parent_id;
                    $tab_elmnt->customfield_id = $temp_elemnt->customfield_id;
                    $tab_elmnt->type = $temp_elemnt->type;
                    $tab_elmnt->sort_order = $temp_elemnt->sort_order;
                    $temp_element_options = $temp_elemnt->element_options;
                    
                    if($temp_elemnt->type == 'tabs') {
                        $temp_element_options = CrmlayoutController::migrate_tab_elements($temp_elemnt);
                    }
                    elseif($temp_elemnt->type == 'accordion') {
                        $temp_element_options = CrmlayoutController::migrate_accordion_elements($temp_elemnt);
                    }
                    
                    $tab_elmnt->element_options = $temp_element_options;
                    $tab_elmnt->save();
                    $tab_element_id = $tab_elmnt->id_modcustomfieldelement;
                    $element_options->sections[$key]->element_id = $tab_element_id;
                    
                }

            }
        }
        return $element_options = json_encode($element_options);
    }
    
    /*
     * Save new row
     */

    function add_new_row(Request $request) {
        
        if($request->input('add_new_row') != '') {
            
            $default_column_width = 100;
            
            $columns = '';
            for($i = 1; $i <= $request->input('columns'); $i++) {
                $columns .= $default_column_width.' + ';
            }
            $columns = rtrim($columns, ' + ');
            
            $table_row = new ModelsAiCrmRows;
            $table_row->row_name = $request->input('new_row');
            $table_row->module_id = $request->input('module_id');
            $table_row->template_id = $request->input('template_id');
            $table_row->columns = $columns;
            $table_row->orderby = 99999;
            $table_row->save();
            $row_id = $table_row->crm_row_id;
            
            for($i = 1; $i <= $request->input('columns'); $i++) {
                $group = new ModelsAiCrmGroups;
                $group->title_mfg = "Column ".$i;
                $group->row_id = $row_id;
                $group->column_width = $default_column_width;
                $group->slug_mfg = str_slug("Column ".$row_id."-".$i);
                $group->idmod_mfg = $request->input('module_id');
                $group->save();
            }
            
        }
        return redirect('admin/crmlayouts/create_template/'.$request->input('template_id'));
    }
    
    /*
     * Save new column
     */

    function add_new_column(Request $request, $row_id, $template_id) {
        
        $row =  ModelsAiCrmRows::select('*')->where('crm_row_id', '=', $row_id)->first();
        if(!empty($row)) {
            $group = new ModelsAiCrmGroups;
            $group->title_mfg = "New Column";
            $group->row_id = $row_id;
            $group->slug_mfg = str_slug("New Column");
            $group->idmod_mfg = $row->module_id;
            $group->save();
        }
        
        return redirect('admin/crmlayouts/create_template/'.$template_id);
    }
    
    /*
     * Save new custom field
     */

    function add_custom_field(Request $request) {
        
        if($request->input('add_new_custom_field') != '') {
                        
            $row_id = $request->input('row_id');
            $group_id = $request->input('group_id');
            $group = ModelsAiCrmGroups::select('*')->where('crm_group_id', '=', $group_id)->first();
                        
            $options = array();
            $option_labels = $request->input('option_label');
            $option_values = $request->input('option_value');
            
            if(!empty($option_labels)) {
                foreach ($option_labels as $key => $option_label) {
                    $options[] = array('label' => $option_label, 'value' => $option_values[$key]);
                }
            }
            
            $params = array('module_id' => $request->input('module_id'),
                            'group_slug' => $group->slug_mfg,
                            'type' => $request->input('type'),
                            'title' => $request->input('title_mcf'),
                            'status' => $request->input('status'),
                            'list_view' => $request->input('list_view'),
                            'show_in_form' => $request->input('showinform'),
                            'searchable' => $request->input('searchable'),
                            'advance_searchable' => $request->input('advance_searchable'),
                            'filter_searchable' => $request->input('filter_searchable'),
                            'options' => $options,
                            'required_field' => $request->input('required_field'),
                            '_token' => $request->input('_token')
                        );
            $params = json_encode($params);
            
            $field = new ModelsAiCrmCustomfield;
            $field->title_mcf = $request->input('title_mcf');
            $field->slug_mcf = str_slug($request->input('title_mcf'));
            $field->idmfg_mcf = $group->crm_group_id;
            $field->option_mcf = $params;
            $field->save();
            
            $crm_element = new ModelsAiCrmElements;
            $crm_element->row_id = $row_id;
            $crm_element->group_id = $group_id;
            $crm_element->customfield_id = $field->crm_customfield_id;
            $crm_element->type = 'crm-fields';
            $crm_element->element_options = json_encode(array());
            $crm_element->save();
            
        }
        return redirect('admin/crmlayouts/create_template/'.$request->input('template_id'));
    }

    /*
     * Edit custom field
     */

    function edit_custom_field(Request $request) {
        
        if($request->input('add_new_custom_field') != '') {
            
            $group_id = $request->input('group_id');
            $group = ModelsAiCrmGroups::select('*')->where('crm_group_id', '=', $group_id)->first();
            
            $options = array();
            $option_labels = $request->input('option_label');
            $option_values = $request->input('option_value');
            
            if(!empty($option_labels)) {
                foreach ($option_labels as $key => $option_label) {
                    $options[] = array('label' => $option_label, 'value' => $option_values[$key]);
                }
            }
            
            $params = array('module_id' => $request->input('module_id'),
                            'group_slug' => $group->slug_mfg,
                            'type' => $request->input('type'),
                            'title' => $request->input('title_mcf'),
                            'status' => $request->input('status'),
                            'list_view' => $request->input('list_view'),
                            'show_in_form' => $request->input('showinform'),
                            'searchable' => $request->input('searchable'),
                            'advance_searchable' => $request->input('advance_searchable'),
                            'filter_searchable' => $request->input('filter_searchable'),
                            'options' => $options,
                            'required_field' => $request->input('required_field'),
                            '_token' => $request->input('_token')
                        );
                        
            $params = json_encode($params);
                                    
            $field = ModelsAiCrmCustomfield::find($request->input('customfield_id'));            
            $field->title_mcf = $request->input('title_mcf');
            $field->slug_mcf = str_slug($request->input('title_mcf'));
            $field->idmfg_mcf = $group->crm_group_id;
            $field->option_mcf = $params;
            $field->save();
            
        }
        return redirect('admin/crmlayouts/create_template/'.$request->input('template_id'));
    }
    
    /*
     * Delete custom fields
     */
    
    function delete_custom_field(Request $request, $id, $template_id) {
        ModelsAiCrmCustomfield::destroy($id);
        ModelsAiCrmElements::where('customfield_id', $id)->delete();
        return redirect('admin/crmlayouts/create_template/'.$template_id);
    }
    
    /*
     * Delete crm element
     */
    
    function delete_crm_element(Request $request, $id, $template_id) {
        $element = ModelsAiCrmElements::where('crm_element_id', $id)->first();
        
        if($element->type == 'crm-fields') {
            ModelsAiCrmCustomfield::destroy($element->customfield_id);
        }
        
        ModelsAiCrmElements::destroy($id);
        
        return redirect('admin/crmlayouts/create_template/'.$template_id);
    }
    
    /*
     * Delete row
     */
    
    function delete_row(Request $request, $id, $template_id) {
        ModelsAiCrmRows::destroy($id);
        $groups = ModelsAiCrmGroups::where('row_id', $id)->get();
        if(!empty($groups)) {
            foreach ($groups as $group) {
                ModelsAiCrmCustomfield::where('idmfg_mcf', $group['crm_group_id'])->delete();
                ModelsAiCrmGroups::where('crm_group_id', $group['crm_group_id'])->delete();
            }
        }
        return redirect('admin/crmlayouts/create_template/'.$template_id);
    }
    
    /*
     * Delete group
     */
    
    function delete_group(Request $request, $id, $template_id) {
        ModelsAiCrmGroups::destroy($id);
        ModelsAiCrmCustomfield::where('idmfg_mcf', $id)->delete();
        return redirect('admin/crmlayouts/create_template/'.$template_id);
    }
    
    /*
     * Duplicate row
     */
    
    function duplicate_row(Request $request, $id, $template_id) {
        
        $row = ModelsAiCrmRows::find($id);
        $newRow = $row->replicate();
        $newRow->save();
        $newRow->crm_row_id;
        
        $groups = ModelsAiCrmGroups::where('row_id', $id)->get();
        if(!empty($groups)) {
            foreach ($groups as $group) {
                
                $grp = ModelsAiCrmGroups::find($group['crm_group_id']);
                $newGrp = $grp->replicate();
                $newGrp->row_id = $newRow->crm_row_id;
                $newGrp->save();
                $newGrp->crm_group_id;
                
                $elements = ModelsAiCrmElements::where('group_id', $group['crm_group_id'])->get();
                if(!empty($elements)) {
                    foreach ($elements as $element) {
                        
                        $element = ModelsAiCrmElements::find($element['crm_element_id']);
                        $newelement = $element->replicate();
                        $newelement->row_id = $newRow->crm_row_id;
                        $newelement->group_id = $newGrp->crm_group_id;
                        
                        if($newelement->type == 'crm-fields') {
                            $fld = ModelsAiCrmCustomfield::find($newelement->customfield_id);
                            $newfld = $fld->replicate();
                            $newfld->idmfg_mcf = $newGrp->crm_group_id;
                            $newfld->save();
                            $newelement->customfield_id = $newfld->crm_customfield_id;
                        }
                        
                        $newelement->save();
                        
                    }
                }
            }
        }
        
        return redirect('admin/crmlayouts/create_template/'.$template_id);
    }
    
    /*
     * Duplicate group
     */
    
    function duplicate_group(Request $request, $id, $template_id) {
        
        $grp = ModelsAiCrmGroups::find($id);
        $newGrp = $grp->replicate();
        $newGrp->save();
        $newGrp->crm_group_id;

        $elements = ModelsAiCrmElements::where('group_id', $id)->get();
        if(!empty($elements)) {
            foreach ($elements as $element) {

                $element = ModelsAiCrmElements::find($element['crm_element_id']);
                $newelement = $element->replicate();
                $newelement->group_id = $newGrp->crm_group_id;

                if($newelement->type == 'crm-fields') {
                    $fld = ModelsAiCrmCustomfield::find($newelement->customfield_id);
                    $newfld = $fld->replicate();
                    $newfld->idmfg_mcf = $newGrp->crm_group_id;
                    $newfld->save();
                    $newelement->customfield_id = $newfld->crm_customfield_id;
                }
                
                $newelement->save();

            }
        }
        
        return redirect('admin/crmlayouts/create_template/'.$template_id);
    }
    
    /*
     * Duplicate Elements
     */
    
    function dupliate_crm_elements(Request $request, $id, $template_id) {
        
        $element = ModelsAiCrmElements::find($id);
        $newelement = $element->replicate();
        
        if($newelement->type == 'crm-fields') {
            $field = ModelsAiCrmCustomfield::where('crm_customfield_id', $newelement->customfield_id)->first();
            $newField = $field->replicate();
            $newField->save();

            $newelement->customfield_id = $newField->crm_customfield_id;
        }
        
        $newelement->sort_order = 9999999;
        $newelement->save();
        
        return redirect('admin/crmlayouts/create_template/'.$template_id);
    }
    
    /*
     * Duplicate custom field
     */
    
    function dupliate_custom_field(Request $request, $id, $template_id) {
        
        $element = ModelsAiCrmElements::where('customfield_id', $id)->first();
        $newelement = $element->replicate();
        
        $field = ModelsAiCrmCustomfield::find($id);
        $newField = $field->replicate();
        $newField->save();
        
        $newelement->customfield_id = $newField->crm_customfield_id;
                
        $newelement->save();
        
        return redirect('admin/crmlayouts/create_template/'.$template_id);
    }
    
    /*
     * Get json data of element
     */
    
    function ajax_get_crm_element(Request $request, $id) {
        $element = ModelsAiCrmElements::find($id);
        if(!empty($element)) {
            return json_encode(array('error' => '0', 'data' => $element));
        }
        return json_encode(array('error' => '1', 'data' => ''));
    }
    
    /*
     * Get json data of custom field
     */
    
    function ajax_get_custom_field(Request $request, $id) {
        $field = ModelsAiCrmCustomfield::find($id);
        if(!empty($field)) {
            $field['group'] = ModelsAiCrmGroups::find($field['idmfg_mcf']);
            return json_encode(array('error' => '0', 'data' => $field));
        }
        return json_encode(array('error' => '1', 'data' => ''));
    }
    
    /*
     * Save Element
     */
    
    function save_row_element(Request $request) {
        
        $row_id = $request->input('row_id');
        $group_id = $request->input('group_id');
        $element = $request->input('element');
        
        $element_options = array();
        
        if($element == 'separator') {
            $element_options = array('color' => '#adadad',
                                    'alignment' => 'center',
                                    'style' => 'solid',
                                    'border_width' => '1px',
                                    'element_width' => '100%',
                                );
        }
        elseif($element == 'empty-space') {
            $element_options = array('height' => '32px');
        }
        elseif($element == 'accordion') {
            $element_options = array('sections' => array());
        }
        elseif($element == 'tabs') {
            $element_options = array('tabs' => array());
        }
        elseif($element == 'text-block') {
            $element_options = array('text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.');
        }
        
        $element_options = json_encode($element_options);
        
        $crm_element = new ModelsAiCrmElements;
        $crm_element->row_id = $row_id;
        $crm_element->group_id = $group_id;
        $crm_element->customfield_id = 0;
        $crm_element->element_options = $element_options;
        $crm_element->type = $element;
        $crm_element->save();
        
    }
    
    /*
     * Save Element
     */
    
    function edit_row_element(Request $request) {
        
        $row_id = $request->input('row_id');
        $group_id = $request->input('group_id');
        $element_id = $request->input('id');
        $template_id = $request->input('template_id');
        
        $crm_element = ModelsAiCrmElements::find($element_id);
        
        $element_options = array();
        
        if($crm_element['type'] == 'separator') {
            $element_options = array('color' => $request->input('color'),
                                    'alignment' => $request->input('alignment'),
                                    'style' => $request->input('style'),
                                    'border_width' => $request->input('border_width'),
                                    'element_width' => $request->input('element_width')
                                );
        }
        elseif($crm_element['type'] == 'empty-space') {
            $element_options = array('height' => $request->input('height'));
        }
        elseif($crm_element['type'] == 'accordion') {
            
            $sections = array();
            $section_titles = $request->input('section_title');
            $section_elements = $request->input('section_element');
            $element_ids = $request->input('element_id');
            if(!empty($section_titles)) {
                foreach ($section_titles as $key => $section_title) {
                    
                    $_element_id = $element_ids[$key];
                    
                    if($element_ids[$key] == 0) {
                        
                        $_element_options = array();
                        
                        if($section_elements[$key] == 'tabs') {
                            $_element_options = array('tabs' => array());
                        }
                        elseif($section_elements[$key] == 'separator') {
                            $_element_options = array('color' => $request->input('color'),
                                    'alignment' => $request->input('alignment'),
                                    'style' => $request->input('style'),
                                    'border_width' => $request->input('border_width'),
                                    'element_width' => $request->input('element_width')
                                );
                        }
                        elseif($section_elements[$key] == 'empty-space') {
                            $_element_options = array('height' => $request->input('height'));
                        }
                        elseif($section_elements[$key] == 'text-block') {
                            $_element_options = array('text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.');
                        }
                        
                        $_element_options = json_encode($_element_options);

                        $_crm_element = new ModelsAiCrmElements;
                        $_crm_element->row_id = $row_id;
                        $_crm_element->group_id = $group_id;
                        $_crm_element->parent_id = $element_id;
                        $_crm_element->customfield_id = 0;
                        $_crm_element->element_options = $_element_options;
                        $_crm_element->type = $section_elements[$key];
                        $_crm_element->save();
                        $_element_id = $_crm_element->crm_element_id;
                        
                    }
                    
                    $sections[] = array('section_title' => $section_title,
                                        'section_element' => $section_elements[$key],
                                        'element_id' => $_element_id
                                    );
                }
            }
            
            $element_options = array('sections' => $sections);
        }
        elseif($crm_element['type'] == 'tabs') {
            $tabs = array();
            $tab_titles = $request->input('tab_title');
            $tab_elements = $request->input('tab_element');
            $element_ids = $request->input('element_id');
            if(!empty($tab_titles)) {
                foreach ($tab_titles as $key => $tab_title) {
                    
                    $_element_id = $element_ids[$key];
                    
                    if($element_ids[$key] == 0) {
                        
                        $_element_options = array();
                        
                        if($tab_elements[$key] == 'tabs') {
                            $_element_options = array('tabs' => array());
                        }
                        elseif($section_elements[$key] == 'separator') {
                            $_element_options = array('color' => $request->input('color'),
                                    'alignment' => $request->input('alignment'),
                                    'style' => $request->input('style'),
                                    'border_width' => $request->input('border_width'),
                                    'element_width' => $request->input('element_width')
                                );
                        }
                        elseif($section_elements[$key] == 'empty-space') {
                            $_element_options = array('height' => $request->input('height'));
                        }
                        elseif($tab_elements[$key] == 'text-block') {
                            $_element_options = array('text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.');
                        }
                        
                        $_element_options = json_encode($_element_options);

                        $_crm_element = new ModelsAiCrmElements;
                        $_crm_element->row_id = $row_id;
                        $_crm_element->group_id = $group_id;
                        $_crm_element->parent_id = $element_id;
                        $_crm_element->customfield_id = 0;
                        $_crm_element->element_options = $_element_options;
                        $_crm_element->type = $tab_elements[$key];
                        $_crm_element->save();
                        $_element_id = $_crm_element->crm_element_id;
                        
                    }
                    
                    $tabs[] = array('tab_title' => $tab_title,
                                        'tab_element' => $tab_elements[$key],
                                        'element_id' => $_element_id
                                    );
                }
            }
            
            $element_options = array('tabs' => $tabs);
        }
        elseif($crm_element['type'] == 'text-block') {            
            $element_options = array('text' => $request->input('text'));
        }
        
        $element_options = json_encode($element_options);
        
        $crm_element->element_options = $element_options;
        $crm_element->save();
        
        return redirect('admin/crmlayouts/create_template/'.$template_id);
        
    }
    
    /*
     * Save number of columns in row
     */
    
    function save_row_columns(Request $request) {
        $value = $request->input('value');
        $row_id = $request->input('id');
        
        $row = ModelsAiCrmRows::find($row_id);
        $row->columns = $request->input('value');
        $row->save();
        
        $value = explode('+', $value);
        if(!empty($value)) {
            
            $totalColumns = ModelsAiCrmGroups::select('*')->where('row_id', '=', $row_id)->count();
            
            if(count($value) > $totalColumns) {
                for($i = ($totalColumns + 1); $i <= count($value); $i++) {
                    $group = new ModelsAiCrmGroups;
                    $group->title_mfg = "Column ".$row_id.'-'.$i;
                    $group->row_id = $row_id;
                    $group->slug_mfg = str_slug("Column ".$row_id.'-'.$i);
                    $group->idmod_mfg = $row->module_id;
                    $group->save();
                }
            }
            
            $columns = ModelsAiCrmGroups::select('*')->where('row_id', '=', $row_id)->get();
            $index = 0;
            if(!empty($columns)) {
                foreach ($columns as $column) {
                    $group = ModelsAiCrmGroups::find($column['crm_group_id']);
                    $group->column_width = (isset($value[$index]))? trim($value[$index]) : 100;
                    $group->save();
                    $index++;
                }
            }
        }
        return redirect('admin/crmlayouts/create_template/'.$row->template_id);
    }
    
    /*
     * Save number of columns in row (Ajax)
     */
    
    function ajax_save_row_columns(Request $request) {
        $value = $request->input('value');
        $row_id = $request->input('id');
        
        $row = ModelsAiCrmRows::find($row_id);
        $row->columns = $request->input('value');
        $row->save();
        
        $value = explode(' + ', $value);
        if(!empty($value)) {
            
            $totalColumns = ModelsAiCrmGroups::select('*')->where('row_id', '=', $row_id)->count();
            
            if(count($value) > $totalColumns) {
                for($i = ($totalColumns + 1); $i <= count($value); $i++) {
                    $group = new ModelsAiCrmGroups;
                    $group->title_mfg = "Column ".$row_id.'-'.$i;
                    $group->row_id = $row_id;
                    $group->slug_mfg = str_slug("Column ".$row_id.'-'.$i);
                    $group->idmod_mfg = $row->module_id;
                    $group->save();
                }
            }
            
            $columns = ModelsAiCrmGroups::select('*')->where('row_id', '=', $row_id)->get();
            $index = 0;
            if(!empty($columns)) {
                foreach ($columns as $column) {
                    $group = ModelsAiCrmGroups::find($column['crm_group_id']);
                    $group->column_width = (isset($value[$index]))? trim($value[$index]) : 100;
                    $group->save();
                }
            }
        }
        echo 'done';
    }
    
    /*
     * Save number of columns in group
     */
    
    function ajax_save_group_columns(Request $request) {
        $group = ModelsAiCrmGroups::find($request->input('id'));
        $group->columns = $request->input('columns');
        $group->save();
    }
    
    /*
     * Save rows order
     */
    
    function ajax_save_rows_order(Request $request) {
        
        $positions = $request->input('positions');
        $positions = json_decode($positions);
        
        if(!empty($positions)) {
            foreach ($positions as $id => $position) {
                $row = ModelsAiCrmRows::find($id);
                $row->orderby = $position;
                $row->save();
            }
        }
    }
    
    /*
     * Save elements order
     */
    
    function ajax_save_crm_elements_order(Request $request) {
        
        $positions = $request->input('positions');
        $positions = json_decode($positions);
        
        if(!empty($positions)) {
            foreach ($positions as $position) {
                $crm_element = ModelsAiCrmElements::find($position->id);
                $crm_element->sort_order = $position->sort_order;
                $crm_element->group_id = $position->group_id;
                $crm_element->save();
                
                if($crm_element->type == 'crm-fields') {
                    $field = ModelsAiCrmCustomfield::find($crm_element->customfield_id);
                    $field->idmfg_mcf = $position->group_id;
                    $field->save();
                }
            }
        }
    }
    
    /*
     * Save fields order
     */
    
    function ajax_save_fields_order(Request $request) {
        
        $positions = $request->input('positions');
        $positions = json_decode($positions);
        
        if(!empty($positions)) {
            foreach ($positions as $id => $position) {
                $field = ModelsAiCrmCustomfield::find($position->id);
                $field->orderby_mcf = $position->sort_order;
                $field->idmfg_mcf = $position->group_id;
                $field->save();
            }
        }
    }

    /**
     * Store a newly created crmlayout in storage.
     *
     * @param CreatecrmlayoutRequest $request
     *
     * @return Response
     */
    public function store(Request $request) {


        $input = $request->all();

        $findr = new Crmlayout;
        foreach ($input as $key => $value) {
            if ($key != "_token" && $value != '') {
                if (!is_null($request->file($key))) {
                    $destinationPath = public_path() . '/uploads/mod_imgs/';
                    $file = $request->file($key);
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension(); //if you need extension of the file
                    $featurefilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $extension;
                    $uploadSuccess = $file->move($destinationPath, $featurefilename);
                    if ($uploadSuccess) {
                        $findr->$key = $featurefilename;
                    }
                } else {
                    $findr->$key = $value;
                }
            }
        }
        $findr->save();
        $request->session()->flash('alert-success', trans('crmlayout.admin_crmlayout_module_add_message'));

        return redirect('admin/crmlayouts/create_template/'.$findr->template_id);
    }

    /**
     * Display the specified crmlayout.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified crmlayout.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id) {
        
        if($this->access['is_edit'] == 0 ) {
            return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
        }
        
        $this->data['title'][1] = array('title' => trans('crmlayout.admin_crmlayout_module_edit'), 'url' => '');
        $findr = Crmlayout::find($id);
        $this->data['crmlayouts'] = $findr;
        $this->data['modules'] = ModBuilder::All();
        return view('admin.crmlayouts.edit', $this->data);
    }

    /**
     * Update the specified crmlayout in storage.
     *
     * @param  int              $id
     * @param UpdatecrmlayoutRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request) {


        $input = $request->all();
        $findr = Crmlayout::find($id);
        foreach ($input as $key => $value) {
            if ($key != "_token" && $key != "_method" && $value != '') {
                if (!is_null($request->file($key))) {
                    $destinationPath = public_path() . '/uploads/mod_imgs/';
                    $file = $request->file($key);
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension(); //if you need extension of the file
                    $featurefilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $extension;
                    $uploadSuccess = $file->move($destinationPath, $featurefilename);
                    if ($uploadSuccess) {
                        $findr->$key = $featurefilename;
                    }
                } else {
                    $findr->$key = $value;
                }
            }
        }
        $findr->save();
        $request->session()->flash('alert-success', trans('crmlayout.admin_crmlayout_module_update_message'));

        return redirect('admin/crmlayouts/create_template/'.$findr->template_id);
    }

    /**
     * Remove the specified crmlayout from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy(Request $request, $id) {
        
        if($this->access['is_remove'] == 0) {
            return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
        }
        
        Crmlayout::destroy($id);
        $request->session()->flash('alert-success', trans('crmlayout.admin_crmlayout_module_delete_message'));

        return redirect(route('crmlayouts.index'));
    }

}