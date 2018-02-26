<?php

namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Qualityassurance;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect;
use App\Helpers\CrmLayoutHelper;
use App\Models\ModelsModcustomfieldgroup;
use App\Models\ModelsModcustomfieldrows;
use App\Models\ModelsModcustomfieldvalue;
use App\Models\ModelsModcustomfieldelements;
use App\Models\ModelsModcustomfield;

class QualityassuranceController extends Controller {

    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'qualityassurance';
    static $per_page = '10';

    public function __construct() {

        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->model = new Qualityassurance();

        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);

        $this->data = array(
            'pageTitle' => $this->info['title'],
            'pageNote' => $this->info['note'],
            'pageModule' => 'qualityassurance',
            'return' => self::returnUrl()
        );
    }

    public function getIndex(Request $request) {

        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'quality_assurance_id');
        $order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
        // End Filter sort and order for query 
        // Filter Search for query		
        $filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');


        $page = $request->input('page', 1);
        $params = array(
            'page' => $page,
            'limit' => (!is_null($request->input('rows')) ? filter_var($request->input('rows'), FILTER_VALIDATE_INT) : static::$per_page ),
            'sort' => $sort,
            'order' => $order,
            'params' => $filter,
            'global' => (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
        );
        // Get Query 
        $results = $this->model->getRows($params);

        // Build pagination setting
        $page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
        $pagination = new Paginator($results['rows'], $results['total'], $params['limit']);
        $pagination->setPath('qualityassurance');

        $this->data['rowData'] = $results['rows'];
        // Build Pagination 
        $this->data['pagination'] = $pagination;
        // Build pager number and append current param GET
        $this->data['pager'] = $this->injectPaginate();
        // Row grid Number 
        $this->data['i'] = ($page * $params['limit']) - $params['limit'];
        // Grid Configuration 
        $this->data['tableGrid'] = $this->info['config']['grid'];
        $this->data['tableForm'] = $this->info['config']['forms'];
        $this->data['colspan'] = \SiteHelpers::viewColSpan($this->info['config']['grid']);
        // Group users permission
        $this->data['access'] = $this->access;
        // Detail from master if any
        // Master detail link if any 
        $this->data['subgrid'] = (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array());
        // Render into template
        return view('qualityassurance.index', $this->data);
    }

    function getUpdate(Request $request, $id = null) {

        $module_id = 96;
        
        if ($id == '') {
            if ($this->access['is_add'] == 0)
                return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        }

        if ($id != '') {
            if ($this->access['is_edit'] == 0)
                return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        }

        $row = $this->model->find($id);
        if ($row) {
            $this->data['row'] = $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_quality_assurance');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['forms']);
        $this->data['hotels'] = \DB::table('tb_properties')->select('id', 'property_name')->where('property_status', 1)->get();
        $this->data['hotel_managers'] = \DB::table('tb_users')->select('id', 'first_name', 'last_name')->where('group_id', 9)->where('active', 1)->get();
        $this->data['quality_assurers'] = \DB::table('tb_users')->select('id', 'first_name', 'last_name')->where('group_id', 8)->where('active', 1)->get();

        /*
         * CRM Layout: Fetch page layout
         */

        $this->data['all_rows'] = CrmLayoutHelper::fetchCrmLayout($module_id);

        /********************************/

        $this->data['id'] = $id;
        return view('qualityassurance.form', $this->data);
    }

    public function getShow($id = null) {

        if ($this->access['is_detail'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $row = $this->model->getRow($id);
        if ($row) {
            $this->data['row'] = $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_quality_assurance');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['grid']);
        $this->data['hotels'] = \DB::table('tb_properties')->select('id', 'property_name')->where('property_type', 'Hotel')->where('property_status', 1)->get();
        $this->data['hotel_managers'] = \DB::table('tb_users')->select('id', 'first_name', 'last_name')->where('group_id', 9)->where('active', 1)->get();
        $this->data['quality_assurers'] = \DB::table('tb_users')->select('id', 'first_name', 'last_name')->where('group_id', 8)->where('active', 1)->get();

        $this->data['id'] = $id;
        $this->data['access'] = $this->access;
        return view('qualityassurance.view', $this->data);
    }

    function postSave(Request $request) {

        $rules = $this->validateForm();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data = $this->validatePost('tb_qualityassurance');

            $id = $this->model->insertRow($data, $request->input('quality_assurance_id'));

            $categories = $request->input('category');
            $standard = $request->input('standard');
            $performance_classificatoon = $request->input('performance_classificatoon');
            $meet = $request->input('meet');
            $below = $request->input('below');
            $na = $request->input('na');
            $note = $request->input('note');
            
            if(!empty($categories)) {
                foreach ($categories as $key => $category) {
                    $params = array('qa_id' => $id,
                                    'category' => $category,
                                    'standard' => $standard[$key],
                                    'performance_classificatoon' => $performance_classificatoon[$key],
                                    'meet' => $meet[$key],
                                    'below' => $below[$key],
                                    'na' => $na[$key],
                                    'note' => $note[$key]
                                    );
                    \DB::table('tb_contact_queries')->insertGetId($params);
                }
            }
            
            if (!is_null($request->input('customFields'))) {

                $mod_slug = $request->segment(2);
                $cstfields = $request->input('customFields');
                foreach ($request->input('customFields') as $key => $valu) {
                    if (isset($valu['value']) && !empty($valu['value'])) {
                        $fieltype = $valu['type'];
                        if ($fieltype == 'checkbox') {
                            $fieldArrLabel = array();
                            $fieldArrValue = array();
                            foreach ($valu['value'] as $valueStr) {
                                $exlpodeStrFieldValue = explode('||', $valueStr);
                                $fieldArrValue[] = $exlpodeStrFieldValue[0];
                                $fieldArrLabel[] = $exlpodeStrFieldValue[1];
                            }
                            $fieldValue = implode(',', $fieldArrValue);
                            $fieldLabel = implode(',', $fieldArrLabel);
                        } else {
                            $exlpodeFieldValue = explode('||', $valu['value']);
                            $fieldValue = isset($exlpodeFieldValue[0]) ? $exlpodeFieldValue[0] : '';
                            $fieldLabel = isset($exlpodeFieldValue[1]) ? $exlpodeFieldValue[1] : '';
                        }
                        $modcustomfieldvalue = new ModelsModcustomfieldvalue;
                        $modcustomfieldvalue->idmob_mfv = $mod_slug;
                        $modcustomfieldvalue->record_id_mfv = $request->input('quality_assurance_id');
                        $modcustomfieldvalue->option_type_mfv = $fieltype;
                        $modcustomfieldvalue->option_name_mfv = $key;
                        $modcustomfieldvalue->option_label_mfv = $fieldLabel;
                        $modcustomfieldvalue->option_value_mfv = $fieldValue;
                        $modcustomfieldvalue->save();
                    }
                }
            }
            if (!is_null($request->input('apply'))) {
                $return = 'qualityassurance/update/' . $id . '?return=' . self::returnUrl();
            } else {
                $return = 'qualityassurance?return=' . self::returnUrl();
            }

            // Insert logs into database
            if ($request->input('quality_assurance_id') == '') {
                \SiteHelpers::auditTrail($request, 'New Data with ID ' . $id . ' Has been Inserted !');
            } else {
                \SiteHelpers::auditTrail($request, 'Data with ID ' . $id . ' Has been Updated !');
            }

            return Redirect::to($return)->with('messagetext', \Lang::get('core.note_success'))->with('msgstatus', 'success');
        } else {

            return Redirect::to('qualityassurance/update/' . $id)->with('messagetext', \Lang::get('core.note_error'))->with('msgstatus', 'error')
                            ->withErrors($validator)->withInput();
        }
    }

    public function postDelete(Request $request) {

        if ($this->access['is_remove'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        // delete multipe rows 
        if (count($request->input('ids')) >= 1) {
            $this->model->destroy($request->input('ids'));

            \SiteHelpers::auditTrail($request, "ID : " . implode(",", $request->input('ids')) . "  , Has Been Removed Successfull");
            // redirect
            return Redirect::to('qualityassurance')
                            ->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus', 'success');
        } else {
            return Redirect::to('qualityassurance')
                            ->with('messagetext', 'No Item Deleted')->with('msgstatus', 'error');
        }
    }

}