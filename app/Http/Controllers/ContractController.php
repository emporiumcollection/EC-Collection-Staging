<?php

namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Contract;
use App\Models\Contractsevents;
use App\Models\Contractshotels;
use App\Models\Contractspackages;
use App\Models\Contractsusergroups;
use App\Models\Contractsusers;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator,
    Input,
    Redirect;

class ContractController extends Controller {

    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'contract';
    static $per_page = '10';

    public function __construct() {

        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->model = new Contract();

        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);

        $this->data = array(
            'pageTitle' => $this->info['title'],
            'pageNote' => $this->info['note'],
            'pageModule' => 'contract',
            'return' => self::returnUrl()
        );
    }

    public function getIndex(Request $request) {

        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'contract_id');
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
        $pagination->setPath('contract');

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
        return view('contract.index', $this->data);
    }
    
    public function my_contract(Request $request) {

        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'contract_id');
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
        $pagination->setPath('contract');

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
        return view('contract.index', $this->data);
    }

    function getUpdate(Request $request, $id = null) {

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
            $this->data['row'] = $this->model->getColumnTable('tb_contracts');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['forms']);

        $this->data['id'] = $id;
        return view('contract.form', $this->data);
    }

    public function getShow($id = null) {

        if ($this->access['is_detail'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $row = $this->model->getRow($id);
        if ($row) {
            $this->data['row'] = $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_contracts');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['grid']);

        $this->data['id'] = $id;
        $this->data['access'] = $this->access;
        return view('contract.view', $this->data);
    }

    function postSave(Request $request) {

        $rules = $this->validateForm();
        
        $category_type = trim($request->input('contract_type'));
        $check_hotel = true;
        $check_revised_commission = false;
        $check_packages = true;
        $check_user_groups = true;
        $check_groups_users = true;
        
        switch($category_type){
            case "sign-up":
                $check_hotel = false;
                $check_packages = false;
                $check_groups_users = false;
            break;
            
            case "packages":
                $check_hotel = false;
            break;
            
            case "hotels":
                $check_packages = false;
                $check_user_groups = false;
                $check_revised_commission = true;
            break;
        }

        $is_all_hotels = (bool) trim($request->input('all_hotels'));
        $is_revised_commission = (bool) trim($request->input('revised_commission'));
        $is_all_packages = (bool) trim($request->input('all_packages'));
        $is_all_user_groups = (bool) trim($request->input('all_user_groups'));
        $is_all_groups_users = (bool) trim($request->input('all_groups_users'));
        
        if(($is_all_hotels == false) && ($check_hotel === true)){ $rules["hotel_ids"] = "required"; }
        if(($is_revised_commission == true) && ($check_hotel === true) && ($check_revised_commission === true)){ $rules["full_availability_commission"] = "required|numeric"; $rules["partial_availability_commission"] = "required|numeric"; }
        if(($is_all_packages == false) && ($check_packages === true)){ $rules["package_ids"] = "required"; }
        if(($is_all_user_groups == false) && ($check_user_groups === true)){ $rules["user_group_ids"] = "required"; }
        if(($is_all_groups_users == false) && ($is_all_user_groups == false) && ($check_user_groups === true) && ($check_groups_users === true)){ $rules["user_ids"] = "required"; }
        
        $validator = Validator::make($request->all(), $rules);        
        if ($validator->passes()) {
            //$data = $this->validatePost('tb_contract');
            $package_ids_array = array();
            $hotel_ids_array = array();
            $user_group_ids_array = array();
            $user_ids_array = array();
            
            $uid = \Auth::user()->id;
            $data = array();
            $data['contract_type'] = trim($request->input('contract_type'));
            $data['title'] = trim($request->input('title'));
            $data['description'] = trim($request->input('description'));
            $data['status'] = (bool) trim($request->input('contract_status'));
            
            if(($check_packages == true))
            {
                $data['package_ids'] = 'all';
                if((!is_null($request->input('package_ids'))) && (is_array($request->input('package_ids'))) && ($is_all_packages == false)){
                    $package_ids_array = $request->input('package_ids');
                    $data['package_ids'] = trim(implode(',',$request->input('package_ids')));
                }                    
            }
            
            if(($check_hotel == true))
            {
                $data['hotel_ids'] = 'all';
                if((!is_null($request->input('hotel_ids'))) && (is_array($request->input('hotel_ids'))) && ($is_all_hotels == false)){
                    $hotel_ids_array = $request->input('hotel_ids');
                    $data['hotel_ids'] = trim(implode(',',$request->input('hotel_ids')));
                }                    
            }
            
            if(($check_user_groups == true))
            {
                $data['user_group_ids'] = 'all';
                if((!is_null($request->input('user_group_ids'))) && (is_array($request->input('user_group_ids'))) && ($is_all_user_groups == false)){
                    $user_group_ids_array = $request->input('user_group_ids');
                    $data['user_group_ids'] = trim(implode(',',$request->input('user_group_ids')));
                }
            }
            
            if(($check_user_groups === true) && ($check_groups_users === true))
            {
                $data['user_ids'] = 'all';
                if(($is_all_groups_users == false) && ($is_all_user_groups == false) && (!is_null($request->input('user_ids'))) && (is_array($request->input('user_ids')))){
                    $user_ids_array = $request->input('user_ids');
                    $data['user_ids'] = trim(implode(',',$request->input('user_ids')));
                }                    
            }
            
            $data['is_commission_set'] = 0;
            if(($is_revised_commission == true) && ($check_hotel === true) && ($check_revised_commission === true)){
                $data['full_availability_commission'] = trim($request->input('full_availability_commission'));
                $data['partial_availability_commission'] = trim($request->input('partial_availability_commission'));
                $data['is_commission_set'] = 1;
            }
                
            $data['deleted'] = 0;
            
            if ($request->input('contract_id') == '') {
                $data['created_by'] = $uid;
                $data['created_on'] = date('Y-m-d h:i:s');
            }else
            {
                $data['updated_by'] = $uid;
                $data['update_on'] = date('Y-m-d h:i:s');
            }            

            $id = $this->model->insertRow($data, $request->input('contract_id'));
            
            if($id > 0){
                
                /** insert packages start **/
                $contractspackages = new Contractspackages();
                if(count($package_ids_array) > 0){                    
                    $rows = $contractspackages->select('id','package_id')->where(array('contract_id'=>$id))->get();
                    $teData = array();
                    foreach($rows as $row){
                        $teData[$row->package_id] = $row->id;
                    }
                    
                    $tiData = array();
                    foreach($package_ids_array as $package_id){
                        $rowid = ((isset($teData[$package_id]))?$teData[$package_id]:null);
                        $tiData[] = array('id'=>$rowid,'package_id'=>$package_id,'contract_id'=>$id);
                    }
                    
                    if(count($tiData) > 0){
                        $contractspackages->where(array('contract_id'=>$id))->delete();
                        $contractspackages->insert($tiData); 
                    }    
                }else
                {
                    $contractspackages->where(array('contract_id'=>$id))->delete();
                }
                /** insert packages end **/
                
                /** insert hotels start **/
                $contractshotels = new Contractshotels();
                if(count($hotel_ids_array) > 0){                    
                    $rows = $contractshotels->select('id','hotel_id')->where(array('contract_id'=>$id))->get();
                    $teData = array();
                    foreach($rows as $row){
                        $teData[$row->hotel_id] = $row->id;
                    }
                    
                    $tiData = array();
                    foreach($hotel_ids_array as $hotel_id){
                        $rowid = ((isset($teData[$hotel_id]))?$teData[$hotel_id]:null);
                        $tiData[] = array('id'=>$rowid,'hotel_id'=>$hotel_id,'contract_id'=>$id);
                    }
                    
                    if(count($tiData) > 0){
                        $contractshotels->where(array('contract_id'=>$id))->delete();
                        $contractshotels->insert($tiData); 
                    }    
                }else
                {
                    $contractshotels->where(array('contract_id'=>$id))->delete();
                }
                /** insert hotels end **/
                
                /** insert users groups start **/
                $contractsusergroups = new Contractsusergroups();
                if(count($user_group_ids_array) > 0){                    
                    $rows = $contractsusergroups->select('id','group_id')->where(array('contract_id'=>$id))->get();
                    $teData = array();
                    foreach($rows as $row){
                        $teData[$row->group_id] = $row->id;
                    }
                    
                    $tiData = array();
                    foreach($user_group_ids_array as $user_group_id){
                        $rowid = ((isset($teData[$user_group_id]))?$teData[$user_group_id]:null);
                        $tiData[] = array('id'=>$rowid,'group_id'=>$user_group_id,'contract_id'=>$id);
                    }
                    
                    if(count($tiData) > 0){
                        $contractsusergroups->where(array('contract_id'=>$id))->delete();
                        $contractsusergroups->insert($tiData); 
                    }    
                }else
                {
                    $contractsusergroups->where(array('contract_id'=>$id))->delete();
                }
                /** insert users groups end **/
                
                /** insert users start **/
                $contractsusers = new Contractsusers();
                if(count($user_ids_array) > 0){                    
                    $rows = $contractsusers->select('id','user_id')->where(array('contract_id'=>$id))->get();
                    $teData = array();
                    foreach($rows as $row){
                        $teData[$row->user_id] = $row->id;
                    }
                    
                    $tiData = array();
                    foreach($user_ids_array as $user_id){
                        $rowid = ((isset($teData[$user_id]))?$teData[$user_id]:null);
                        $tiData[] = array('id'=>$rowid,'user_id'=>$user_id,'contract_id'=>$id);
                    }
                    
                    if(count($tiData) > 0){
                        $contractsusers->where(array('contract_id'=>$id))->delete();
                        $contractsusers->insert($tiData); 
                    }    
                }else
                {
                    $contractsusers->where(array('contract_id'=>$id))->delete();
                }
                /** insert users end **/
                
            }

            if (!is_null($request->input('apply'))) {
                $return = 'contract/update/' . $id . '?return=' . self::returnUrl();
            } else {
                $return = 'contract?return=' . self::returnUrl();
            }

            // Insert logs into database
            if ($request->input('contract_id') == '') {
                \SiteHelpers::auditTrail($request, 'New Data with ID ' . $id . ' Has been Inserted !');
            } else {
                \SiteHelpers::auditTrail($request, 'Data with ID ' . $id . ' Has been Updated !');
            }

            return Redirect::to($return)->with('messagetext', \Lang::get('core.note_success'))->with('msgstatus', 'success');
        } else {

            return Redirect::to('contract/update/' . $id)->with('messagetext', \Lang::get('core.note_error'))->with('msgstatus', 'error')
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
            return Redirect::to('contract')
                            ->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus', 'success');
        } else {
            return Redirect::to('contract')
                            ->with('messagetext', 'No Item Deleted')->with('msgstatus', 'error');
        }
    }

}