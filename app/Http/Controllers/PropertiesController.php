<?php

namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator,
    Input,
    Redirect;
use File;

class PropertiesController extends Controller {

    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'properties';
    static $per_page = '20';

    public function __construct() {

        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->model = new Properties();

        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);

        $this->data = array(
            'pageTitle' => $this->info['title'],
            'pageNote' => $this->info['note'],
            'pageModule' => 'properties',
            'return' => self::returnUrl()
        );
    }
    
    public function getRadsetdefaultpackagetohotel(Request $request){
        $publicPakages_results = \DB::table('tb_packages')->select('id')->where('is_public',true)->first();
        $getproperises = \DB::table('tb_properties')->select('tb_properties.id')->leftJoin('tb_properties_category_package','tb_properties.id','=','tb_properties_category_package.property_id')->whereNull('tb_properties_category_package.id')->get();
        
        $batchInsert = array();
        foreach($getproperises as $sipro){
            $batchInsert[] = array('property_id'=>$sipro->id,'package_id'=>$publicPakages_results->id);
        }
        if(count($batchInsert) > 0){\DB::table('tb_properties_category_package')->insert($batchInsert);}
        echo count($getproperises).'<pre>';print_r($batchInsert);die;
    }

    public function getIndex(Request $request) {

        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $sort = (!is_null($request->input('sort')) ? $request->input('sort') : (!is_null($request->input('search')) ? 'id' : 'property_status'));
        $order = (!is_null($request->input('order')) ? $request->input('order') : 'desc');
        // End Filter sort and order for query 
        // Filter Search for query		
        $filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
		$this->data['curntcat'] =  '';
		$this->data['curstatus'] =  '';
		if(!is_null($request->input('selcat')) && $request->input('selcat')!='')
		{
			$filter .= ' AND FIND_IN_SET('.$request->input('selcat').', property_category_id)';
			$this->data['curntcat'] = $request->input('selcat');
		}
		if(!is_null($request->input('selstatus')) && $request->input('selstatus')!='')
		{
			$pstatus = ($request->input('selstatus')=='active') ? 1 : 0;
			$filter .= ' AND property_status = '.$pstatus;
			$this->data['curstatus'] = $request->input('selstatus');
		}

        if(\Session::get('gid')!=1 && \Session::get('gid')!=2){
                $uid = \Auth::user()->id;

                $filter .= " AND ((user_id = '".$uid."') OR (assigned_user_id = '".$uid."'))" ;

        }
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
        $pagination->setPath('properties');
		
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
		$this->data['fetch_cat'] = \DB::table('tb_categories')->get();
        $this->data['prop_cat'] = \DB::table('tb_packages')->where('package_status', 1)->where('package_category', 'B2C')->get();
        
        $hotelIds = array();
        foreach($this->data['rowData'] as $si_hotel){
            $hotelIds[] = $si_hotel->id;
        }
        
        $commission_contracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id','tb_users_contracts.title','tb_users_contracts.description','tb_users_contracts.hotel_id')->where('tb_users_contracts.contract_type','commission')->where('tb_users_contracts.is_commission_set',1)->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->orderBy('tb_users_contracts.contract_id','DESC')->get();
        
        $this->data['commission_contracts'] = array();
        foreach($commission_contracts as $si_commcon){
            $this->data['commission_contracts'][$si_commcon->hotel_id] = $si_commcon;
        }
        //echo "<pre>";print_r($this->data['commission_contracts']);die;
        
        $this->data['hotels_commission_contracts'] = array();
        $this->data['common_commission_contract'] = array();
        $this->data['hotels_contracts'] = array();
        $this->data['common_contracts'] = array();
        $this->data['userContracts'] = array();
        if(count($hotelIds) > 0){
            $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id','tb_users_contracts.title','tb_users_contracts.description','tb_users_contracts.hotel_id')->where('tb_users_contracts.contract_type','hotels')->whereIn('tb_users_contracts.hotel_id',$hotelIds)->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->orderBy('tb_users_contracts.contract_id','DESC')->get();
            $resetContracts = array();
            foreach($usersContracts as $si_contract){
                if(!isset($resetContracts[$si_contract->hotel_id])){ $resetContracts[$si_contract->hotel_id] = array(); }
                $resetContracts[$si_contract->hotel_id][$si_contract->contract_id] = $si_contract;
            }
            $this->data['userContracts'] = $resetContracts;            
            
            //get commission contracts from db for hotels
            $commission_contract = \CommonHelper::get_default_contracts('commission','default',0,$hotelIds);
            $this->data['hotels_commission_contracts'] = $commission_contract['hotels_wise'];
            $this->data['common_commission_contract'] = $commission_contract['common'];
            //echo "<pre>";print_r($commission_contract);die;
            //End
            
            //get commission contracts from db for hotels
            $hotels_contract = \CommonHelper::get_default_contracts('hotels','default',0,$hotelIds);
            $this->data['hotels_contracts'] = $hotels_contract['hotels_wise'];
            $this->data['common_contracts'] = $hotels_contract['common'];
            //echo "<pre>";print_r($hotels_contract);die;
            //End 
            
            
            $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id', 'tb_container_files.file_title', 'tb_container_files.file_description')->whereIn('tb_properties_images.property_id', $hotelIds)->where('tb_properties_images.type', 'Property Images')->orderBy('tb_container_files.file_sort_num', 'asc')->get();
            //print_r($fileArr); die;
            $propertiesArr =array();
            $pr = 0;
            foreach ($fileArr as $file) {
                
                if(!isset($propertiesArr[$file->property_id])){ $propertiesArr[$file->property_id] = array(); }
                //$propertiesArr[$file->property_id][$file->id] = $file;
                
                $propertiesArr[$file->property_id]['propimage'][$pr] = $file;
                $propertiesArr[$file->property_id]['propimage'][$pr]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                $propertiesArr[$file->property_id]['propimage'][$pr]->imgsrccon = (new ContainerController)->getContainerUserPath($file->folder_id);
                $pr++;
            }
            $this->data['propertiesImgArr'] = $propertiesArr;                                            
                      
        }
        //print_r($this->data['userContracts']);die;
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.index':'properties.index'; 
        
        return view($file_name, $this->data);
    }
    
    function postSavehotelcontract(Request $request){
        $return_array = array();
        if (!\Auth::check()){$return_array['status'] = 'error'; $return_array['message'] = 'Errors occurred during save contract!'; $return_array['errors'] = array("Please login first before saving contract!");}
        $rules = array(
            'hotel_id' => 'required|numeric',
            'contract_id' => 'required',
        );
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->passes()) {
            $hotelId = (int) $request->input('hotel_id');
            $contractId = $request->input('contract_id');
            
            if(($hotelId > 0) && (strlen(trim($contractId)) > 0)){
                $contractIDS = explode(',',trim($contractId));
                $contract = \DB::table('tb_contracts')->select('tb_contracts.*')->whereIn('tb_contracts.contract_id',$contractIDS)->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->orderBy('tb_contracts.contract_id','DESC')->get();
                if(count($contract) > 0){
                    //insert contracts
                    \CommonHelper::submit_contracts($contract,'hotels',$hotelId);
                    //End
                    
                    $return_array['status'] = 'success';
                    $return_array['message'] = 'Hotel contracts has been saved!';
                }else{
                    $return_array['status'] = 'error';
                    $return_array['message'] = 'Errors occurred during save hotel contracts!';
                    $return_array['errors'] = array("Invalid contract id!");
                }
            }else
            {
                $tarr = array();
                if($hotelId <= 0){ $tarr[] = "Invalid hotel id!"; }
                if(strlen(trim($contractId)) <= 0){ $tarr[] = "Invalid contract id!"; }
                
                $return_array['status'] = 'error';
                $return_array['message'] = 'Errors occurred during save hotel contracts!';
                $return_array['errors'] = $tarr;
            }
        }else{
            $return_array['status'] = 'error';
            $return_array['message'] = 'Errors occurred during save hotel contracts!';
            $return_array['errors'] = $validator->errors()->all();
        }
        
        echo json_encode($return_array);
        exit;
    }
    
    function postSavecommissioncontract(Request $request){
        $return_array = array();
        if (!\Auth::check()){$return_array['status'] = 'error'; $return_array['message'] = 'Errors occurred during save commission contract!'; $return_array['errors'] = array("Please login first before saving contract!");}
        $rules = array(
            'hotel_id' => 'required|numeric',
            'contract_id' => 'required|numeric',
            'commission_type' => 'required|alpha',
        );
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->passes()) {
            $hotelId = (int) $request->input('hotel_id');
            $contractId = (int) $request->input('contract_id');
            $commissionType = $request->input('commission_type');
            
            if(($hotelId > 0) && ($contractId > 0) && (strlen(trim($commissionType)) > 0)){
                $contract = \DB::table('tb_contracts')->select('tb_contracts.*')->where('tb_contracts.contract_id',$contractId)->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->orderBy('tb_contracts.contract_id','DESC')->first();
                //print_r($contract); die;
                $contract->commission_type = $commissionType;
                if(isset($contract->contract_id)){
                    //insert contracts
                    \CommonHelper::submit_contracts(array($contract),'commission',$hotelId,$commissionType);
                    //End
                    
                    $return_array['status'] = 'success';
                    $return_array['message'] = 'Commission contract has been saved!';
                }else{
                    $return_array['status'] = 'error';
                    $return_array['message'] = 'Errors occurred during save commission contract!';
                    $return_array['errors'] = array("Invalid contract id!");
                }
            }else
            {
                $tarr = array();
                if($hotelId <= 0){ $tarr[] = "Invalid hotel id!"; }
                if($contractId <= 0){ $tarr[] = "Invalid contract id!"; }
                if(strlen(trim($commissionType)) <= 0){ $tarr[] = "Invalid availability!"; }
                
                $return_array['status'] = 'error';
                $return_array['message'] = 'Errors occurred during save commission contract!';
                $return_array['errors'] = $tarr;
            }
        }else{
            $return_array['status'] = 'error';
            $return_array['message'] = 'Errors occurred during save commission contract!';
            $return_array['errors'] = $validator->errors()->all();
        }
        
        echo json_encode($return_array);
        exit;
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
            $this->data['row'] = $this->model->getColumnTable('tb_properties');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['forms']);

        $this->data['id'] = $id;
        $fetch_cat = \DB::table('tb_categories')->orderBy('category_name', 'asc')->get();
        $parent_cat = array();
        if (!empty($fetch_cat)) {
            foreach ($fetch_cat as $cat) {
                $parent_cat[$cat->id] = $cat;
            }
        }

        $this->data['categories'] = $parent_cat;

        $this->data['amenties'] = \DB::table('tb_amenities')->where('amenity_status', '1')->orderBy('amenity_title', 'asc')->get();
        $this->data['designers'] = \DB::table('tb_designers')->where('designer_status', '1')->get();
		if(\Session::get('gid')!=1 && \Session::get('gid')!=2){
			$uid = \Auth::user()->id;
			$this->data['restaurants'] = \DB::table('tb_restaurants')->select('id', 'title')->where('user_id', $uid)->get();
			$this->data['bars'] = \DB::table('tb_bars')->select('id', 'title')->where('user_id', $uid)->get();
			$this->data['spas'] = \DB::table('tb_spas')->select('id', 'title')->where('user_id', $uid)->get();
		}
		else
		{
			$this->data['restaurants'] = \DB::table('tb_restaurants')->select('id', 'title')->get();
			$this->data['bars'] = \DB::table('tb_bars')->select('id', 'title')->get();
			$this->data['spas'] = \DB::table('tb_spas')->select('id', 'title')->get();
		}
        $row_reservations = \DB::select(\DB::raw("SELECT COUNT(*) AS total_reservations FROM tb_reservations WHERE property_id = '$id' "));
        $row_reserved_rooms = \DB::select(\DB::raw("SELECT COUNT(*) AS total_reserved_rooms FROM td_reserved_rooms LEFT JOIN tb_reservations ON tb_reservations.id = td_reserved_rooms.reservation_id WHERE tb_reservations.property_id = '$id' "));
        $row_turnover = \DB::select(\DB::raw("SELECT SUM(number_of_nights * tb_reservations.price) AS total_turnover FROM td_reserved_rooms LEFT JOIN tb_reservations ON tb_reservations.id = td_reserved_rooms.reservation_id WHERE tb_reservations.property_id = '$id' "));
		
		$this->data['total_turnover'] = 0;
		$this->data['total_reservations'] = 0;
		$this->data['total_commissions'] =0;
		$this->data['total_rooms_booked'] =0;
		if ($id != '') {
			$this->data['total_turnover'] = (isset($row_turnover[0]->total_turnover))? $row_turnover[0]->total_turnover : 0;
			$this->data['total_reservations'] = (isset($row_reservations[0]->total_reservations))? $row_reservations[0]->total_reservations : 0;
			//$this->data['total_commissions'] = (isset($row_turnover[0]->total_turnover))? ($row_turnover[0]->total_turnover * ($this->data['row']->commission / 100)) : 0;
			$this->data['total_rooms_booked'] = (isset($row_reserved_rooms[0]->total_reserved_rooms))? $row_reserved_rooms[0]->total_reserved_rooms : 0;
		}
        
        /** get property and package relations start **/
        $prop_package_rel = \DB::table('tb_properties_category_package')->where('property_id', $id)->get();
        $rest_arr = array();
        foreach($prop_package_rel as $si_prop){ $rest_arr[] = $si_prop->package_id; }
        $this->data['property_category'] = implode(',',$rest_arr);
        /** get property and package relations end **/
        
        /** get property and user relations start **/
        $prop_user_rel = \DB::table('tb_properties_users')->where('property_id', $id)->get();
        $rest_user_arr = array();
        foreach($prop_user_rel as $si_user){ $rest_user_arr[] = $si_user->user_id; }
        $this->data['property_user'] = implode(',',$rest_user_arr);
        /** get property and user relations end **/
        
        $this->data['active_tab']=0;
        
        $this->data['default_adult_tax'] = \DB::table('tb_settings')->where('key_value', 'adult_citytax')->first();
        $this->data['default_baby_tax'] = \DB::table('tb_settings')->where('key_value', 'baby_citytax')->first();
        $this->data['default_junior_tax'] = \DB::table('tb_settings')->where('key_value', 'junior_citytax')->first();
        
        //echo "<pre>";
        //print_r($this->data); die;
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.form':'properties.form'; 
        
        return view($file_name, $this->data);
    }

    public function getShow($id = null) {

        if ($this->access['is_detail'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $row = $this->model->getRow($id);
        if ($row) {
            $this->data['row'] = $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_properties');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['grid']);

        $this->data['id'] = $id;
        $this->data['access'] = $this->access;
        return view('properties.view', $this->data);
    }

    function postSave(Request $request) {
        $uid = \Auth::user()->id;
        $id = $request->input('id');
        $rules = $this->validateForm();
        $rules['property_category'] = 'required';
        $rules['owner_name'] = 'required';
        $rules['owner_last_name'] = 'required';
        $rules['owner_address'] = 'required';
        $rules['owner_city'] = 'required';
        $rules['owner_postal_code'] = 'required';
        $rules['owner_country'] = 'required';
        $rules['owner_phone_primary'] = 'required';
        $rules['owner_email_primary'] = 'required';
        $rules['assigned_user_id'] = 'required';
        /* if($request->input('owner_contact_person')!='Owner')
          {
          $rules['agent_name'] = 'required';
          $rules['agent_last_name'] = 'required';
          $rules['agent_address'] = 'required';
          $rules['agent_city'] = 'required';
          $rules['agent_postal_code'] = 'required';
          $rules['agent_country'] = 'required';
          $rules['agent_phone_primary'] = 'required';
          $rules['agent_phone_emergency'] = 'required';
          $rules['agent_email_primary'] = 'required';
          $rules['agent_email_secondary'] = 'required';
          $rules['agent_website'] = 'required';
          } */
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data = $this->validatePost('tb_properties');
            $alias = \SiteHelpers::seoUrl(Input::get('property_short_name'));
            $exha = false;
            for ($f = 1; $exha != true; $f++) {
                if ($request->input('id') == '') {
                    $check_alias = \DB::table('tb_properties')->where('property_slug', $alias)->count();
                } else {
                    $check_alias = \DB::table('tb_properties')->where('property_slug', $alias)->where('id', '!=', $id)->count();
                }
                if ($check_alias > 0) {
                    $alias = $alias . '-' . $f;
                } else {
                    $alias = $alias;
                    $exha = true;
                }
            }
            $data['user_id'] = $uid;
            $data['property_slug'] = $alias;

            if ($request->input('id') == '') {
                $data['created'] = date('Y-m-d h:i:s');
            } else {
                $data['updated'] = date('Y-m-d h:i:s');
            }
            
            $property_packages = array();
            if(is_array($request->input('property_category'))){
                $property_packages = $request->input('property_category');
            }

            $data['commission'] = $request->input('commission');
            $data['about_property'] = $request->input('about_property');
            $data['property_usp'] = $request->input('property_usp');
            
            $assigned_users = array();
            if (is_array($request->input('assigned_user_id'))) {
                $assigned_users = $request->input('assigned_user_id');
            }
            
            $data['detail_section1_title'] = $request->input('detail_section1_title');
            $data['detail_section1_description_box1'] = $request->input('detail_section1_description_box1');
            $data['detail_section1_description_box2'] = $request->input('detail_section1_description_box2');
            $data['detail_section2_title'] = $request->input('detail_section2_title');
            $data['detail_section2_description_box1'] = $request->input('detail_section2_description_box1');
            $data['detail_section2_description_box2'] = $request->input('detail_section2_description_box2');
            $data['assign_detail_city'] = $request->input('assign_detail_city');

            $data['social_status'] = $request->input('social_status');
            $data['social_facebook'] = $request->input('social_facebook');
            $data['social_twitter'] = $request->input('social_twitter');
            $data['social_google'] = $request->input('social_google');
            $data['social_youtube'] = $request->input('social_youtube');
            $data['social_pinterest'] = $request->input('social_pinterest');
            $data['social_vimeo'] = $request->input('social_vimeo');
            $data['social_instagram'] = $request->input('social_instagram');
            
            $address = $request->input('address');
            $latitude = '';
            $longitude = '';
            if($request->input('latitude')=='' && $request->input('longitude')==''){                
                if($address!=''){
                    $geo = file_get_contents("https://maps.google.com/maps/api/geocode/json?key=AIzaSyBqf2xJGZFRECA_eVTNek_Y7sxBzmcgXrs&address=".urlencode($address).'&sensor=false');
                    $geo = json_decode($geo, true); // Convert the JSON to an array                
                    if(isset($geo['status']) && ($geo['status'] == 'OK')) {
                      $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
                      $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
                    } 
                }   
            }else{
                $latitude = $request->input('latitude');
                $longitude = $request->input('longitude');        
            }
            $data['latitude'] = $latitude;
            $data['longitude'] = $longitude;
            $data['address'] = $address;
            /*$data['latitude'] = $request->input('latitude');
            $data['longitude'] = $request->input('longitude');*/
            
            if (!empty($request->input('assigned_amenities'))) {
                $data['assign_amenities'] = implode(',', $request->input('assigned_amenities'));
            } else {
                $data['assign_amenities'] = '';
            }

            if (!is_null($request->input('copy_amenities_rooms'))) {
                $data['copy_amenities_rooms'] = $request->input('copy_amenities_rooms');
            } else {
                $data['copy_amenities_rooms'] = 0;
            }

            if (!is_null($request->input('default_seasons'))) {
                $data['default_seasons'] = $request->input('default_seasons');
            } else {
                $data['default_seasons'] = 0;
            }
			
			if (!is_null($request->input('feature_property'))) {
                $data['feature_property'] = $request->input('feature_property');
            } else {
                $data['feature_property'] = 0;
            }
			
			if (!is_null($request->input('editor_choice_property'))) {
                $data['editor_choice_property'] = $request->input('editor_choice_property');
            } else {
                $data['editor_choice_property'] = 0;
            }

            if (!empty($request->input('destinations'))) {
                $data['property_category_id'] = implode(',', $request->input('destinations'));
            } else {
                $data['property_category_id'] = '';
            }
			
			if (!empty($request->input('spaids'))) {
                $data['spa_ids'] = implode(',', $request->input('spaids'));
            } else {
                $data['spa_ids'] = '';
            }
			
			if (!empty($request->input('restaurantids'))) {
                $data['restaurant_ids'] = implode(',', $request->input('restaurantids'));
            } else {
                $data['restaurant_ids'] = '';
            }
			
			if (!empty($request->input('barids'))) {
                $data['bar_ids'] = implode(',', $request->input('barids'));
            } else {
                $data['bar_ids'] = '';
            }

            $data['owner_name'] = $request->input('owner_name');
            $data['owner_last_name'] = $request->input('owner_last_name');
            $data['owner_address'] = $request->input('owner_address');
            $data['owner_city'] = $request->input('owner_city');
            $data['owner_postal_code'] = $request->input('owner_postal_code');
            $data['owner_country'] = $request->input('owner_country');
            $data['owner_phone_primary'] = $request->input('owner_phone_primary');
            $data['owner_phone_emergency'] = $request->input('owner_phone_emergency');
            $data['owner_email_primary'] = $request->input('owner_email_primary');
            $data['owner_email_secondary'] = $request->input('owner_email_secondary');
            $data['owner_website'] = $request->input('owner_website');
            $data['owner_contact_person'] = $request->input('owner_contact_person');
            /* if($request->input('owner_contact_person')!='Owner')
              {
              $data['agent_name'] = $request->input('agent_name');
              $data['agent_last_name'] = $request->input('agent_last_name');
              $data['agent_address'] = $request->input('agent_address');
              $data['agent_city'] = $request->input('agent_city');
              $data['agent_postal_code'] = $request->input('agent_postal_code');
              $data['agent_country'] = $request->input('agent_country');
              $data['agent_phone_primary'] = $request->input('agent_phone_primary');
              $data['agent_phone_emergency'] = $request->input('agent_phone_emergency');
              $data['agent_email_primary'] = $request->input('agent_email_primary');
              $data['agent_email_secondary'] = $request->input('agent_email_secondary');
              $data['agent_website'] = $request->input('agent_website');
              $data['agent_linked_in'] = $request->input('agent_linked_in');
              } */


            // Yachts info tab
            if ($request->input('property_type') == 'Yachts') {
                $yacht_category = $request->input('yacht_category');
                $data['yacht_category'] = implode(', ', $yacht_category);
                $data['yacht_build_year'] = $request->input('yacht_build_year');
                $data['yachts_guest'] = $request->input('yachts_guest');
                $data['yacht_length'] = $request->input('yacht_length');
                if (!empty($request->input('yacht_builder'))) {
                    $data['yacht_builder'] = implode(',', $request->input('yacht_builder'));
                }
                $data['yacht_beam'] = $request->input('yacht_beam');
                $data['yacht_draft'] = $request->input('yacht_draft');
                $data['yacht_grt'] = $request->input('yacht_grt');
                $data['yacht_cabins'] = $request->input('yacht_cabins');
                $data['yacht_crew'] = $request->input('yacht_crew');
                $data['yacht_for_sale'] = $request->input('yacht_for_sale');
                $data['yacht_for_charter'] = $request->input('yacht_for_charter');
            }

            $destinationPath = public_path() . '/uploads/properties_subtab_imgs/';

            //room & suites tab
            $data['rooms_suites_title'] = $request->input('rooms_suites_title');
            $data['rooms_suites_desciription'] = $request->input('rooms_suites_desciription');
            if ($request->input('rooms_suites_video_type') != '') {
                $data['rooms_suites_video_type'] = $request->input('rooms_suites_video_type');
            }
            if ($request->input('rooms_suites_video_link_type') != '') {
                $data['rooms_suites_video_link_type'] = $request->input('rooms_suites_video_link_type');
            }
            $data['rooms_suites_video_link'] = $request->input('rooms_suites_video_link');
            if (!is_null($request->file('rooms_suites_image'))) {
                $file = $request->file('rooms_suites_image');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); //if you need extension of the file
                $room_suites_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $extension;
                $uploadSuccess = $file->move($destinationPath, $room_suites_filename);
                if ($uploadSuccess) {
                    $data['rooms_suites_image'] = $room_suites_filename;
                }
            }

            if (!is_null($request->file('rooms_suites_video'))) {
                $room_suites_vfile = $request->file('rooms_suites_video');
                $room_suites_vfilename = $room_suites_vfile->getClientOriginalName();
                $room_suites_vextension = $room_suites_vfile->getClientOriginalExtension(); //if you need extension of the file
                $room_suites_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $room_suites_vextension;
                $room_suites_vuploadSuccess = $room_suites_vfile->move($destinationPath, $room_suites_videofilename);
                if ($room_suites_vuploadSuccess) {
                    $data['rooms_suites_video'] = $room_suites_videofilename;
                }
            }
            //room & suites end
            // Architechure 
            $data['architecture_title'] = $request->input('architecture_title');
            $data['architecture_desciription'] = $request->input('architecture_desciription');
            if ($request->input('architecture_video_type') != '') {
                $data['architecture_video_type'] = $request->input('architecture_video_type');
            }
            if ($request->input('architecture_video_link_type') != '') {
                $data['architecture_video_link_type'] = $request->input('architecture_video_link_type');
            }
            $data['architecture_video_link'] = $request->input('architecture_video_link');
            if (!empty($request->input('assigned_architecture_designer'))) {
                $data['assigned_architecture_designer'] = implode(',', $request->input('assigned_architecture_designer'));
            }
            if (!is_null($request->file('architecture_image'))) {
                $architecture_file = $request->file('architecture_image');
                $architecture_filename = $architecture_file->getClientOriginalName();
                $architecture_extension = $architecture_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_extension;
                $architecture_uploadSuccess = $architecture_file->move($destinationPath, $architecture_filename);
                if ($architecture_uploadSuccess) {
                    $data['architecture_image'] = $architecture_filename;
                }
            }

            if (!is_null($request->file('architecture_video'))) {
                $architecture_vfile = $request->file('architecture_video');
                $architecture_vfilename = $architecture_vfile->getClientOriginalName();
                $architecture_vextension = $architecture_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_vextension;
                $architecture_vuploadSuccess = $architecture_vfile->move($destinationPath, $architecture_videofilename);
                if ($architecture_vuploadSuccess) {
                    $data['architecture_video'] = $architecture_videofilename;
                }
            }

            // Design 
            $data['architecture_design_title'] = $request->input('architecture_design_title');
            $data['architecture_design_desciription'] = $request->input('architecture_design_desciription');
            $data['architecture_design_url'] = $request->input('architecture_design_url');
            if ($request->input('architecture_design_video_type') != '') {
                $data['architecture_design_video_type'] = $request->input('architecture_design_video_type');
            }
            if ($request->input('architecture_design_video_link_type') != '') {
                $data['architecture_design_video_link_type'] = $request->input('architecture_design_video_link_type');
            }
            $data['architecture_design_video_link'] = $request->input('architecture_design_video_link');
            if (!is_null($request->file('architecture_design_image'))) {
                $architecture_design_file = $request->file('architecture_design_image');
                $architecture_design_filename = $architecture_design_file->getClientOriginalName();
                $architecture_design_extension = $architecture_design_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_design_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_design_extension;
                $architecture_design_uploadSuccess = $architecture_design_file->move($destinationPath, $architecture_design_filename);
                if ($architecture_design_uploadSuccess) {
                    $data['architecture_design_image'] = $architecture_design_filename;
                }
            }

            if (!is_null($request->file('architecture_design_video'))) {
                $architecture_design_vfile = $request->file('architecture_designer_video');
                $architecture_design_vfilename = $architecture_design_vfile->getClientOriginalName();
                $architecture_design_vextension = $architecture_design_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_design_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_design_vextension;
                $architecture_design_vuploadSuccess = $architecture_design_vfile->move($destinationPath, $architecture_design_videofilename);
                if ($architecture_design_vuploadSuccess) {
                    $data['architecture_design_video'] = $architecture_design_videofilename;
                }
            }

            // Designer
            $data['architecture_designer_title'] = $request->input('architecture_designer_title');
            $data['architecture_designer_desciription'] = $request->input('architecture_designer_desciription');
            $data['architecture_designer_url'] = $request->input('architecture_designer_url');
            if (!empty($request->input('architecture_designer_designer'))) {
                $data['architecture_designer_designer'] = implode(',', $request->input('architecture_designer_designer'));
            }
            if ($request->input('architecture_designer_video_type') != '') {
                $data['architecture_designer_video_type'] = $request->input('architecture_designer_video_type');
            }
            if ($request->input('architecture_designer_video_link_type') != '') {
                $data['architecture_designer_video_link_type'] = $request->input('architecture_designer_video_link_type');
            }
            $data['architecture_designer_video_link'] = $request->input('architecture_designer_video_link');

            if (!is_null($request->file('architecture_designer_image'))) {
                $architecture_designer_file = $request->file('architecture_designer_image');
                $architecture_designer_filename = $architecture_designer_file->getClientOriginalName();
                $architecture_designer_extension = $architecture_designer_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_designer_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_designer_extension;
                $architecture_designer_uploadSuccess = $architecture_designer_file->move($destinationPath, $architecture_designer_filename);
                if ($architecture_designer_uploadSuccess) {
                    $data['architecture_designer_image'] = $architecture_designer_filename;
                }
            }

            if (!is_null($request->file('architecture_designer_video'))) {
                $architecture_designer_vfile = $request->file('architecture_designer_video');
                $architecture_designer_vfilename = $architecture_designer_vfile->getClientOriginalName();
                $architecture_designer_vextension = $architecture_designer_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_designer_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_designer_vextension;
                $architecture_designer_vuploadSuccess = $architecture_designer_vfile->move($destinationPath, $architecture_designer_videofilename);
                if ($architecture_designer_vuploadSuccess) {
                    $data['architecture_designer_video'] = $architecture_designer_videofilename;
                }
            }

            // Spas
            $data['spa_title'] = $request->input('spa_title');
            $data['spa_desciription'] = $request->input('spa_desciription');
            $data['spa_url'] = $request->input('spa_url');
            $data['spa_usp_text'] = $request->input('spa_usp_text');
            $data['spa_usp_person'] = $request->input('spa_usp_person');
            $data['spa_manager_text'] = $request->input('spa_manager_text');
            $data['spa_opening_hours'] = $request->input('spa_opening_hours');
            $data['spa_phone_number'] = $request->input('spa_phone_number');
            if (!empty($request->input('spa_designer'))) {
                $data['spa_designer'] = implode(',', $request->input('spa_designer'));
            }
            if ($request->input('spa_video_type') != '') {
                $data['spa_video_type'] = $request->input('spa_video_type');
            }
            if ($request->input('spa_video_link_type') != '') {
                $data['spa_video_link_type'] = $request->input('spa_video_link_type');
            }
            $data['spa_video_link'] = $request->input('spa_video_link');
            if (!is_null($request->file('spa_image1'))) {
                $spa_file = $request->file('spa_image1');
                $spa_filename = $spa_file->getClientOriginalName();
                $spa_extension = $spa_file->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension;
                $spa_uploadSuccess = $spa_file->move($destinationPath, $spa_filename);
                if ($spa_uploadSuccess) {
                    $data['spa_image1'] = $spa_filename;
                }
            }

            if (!is_null($request->file('spa_image2'))) {
                $spa_file2 = $request->file('spa_image2');
                $spa_filename2 = $spa_file2->getClientOriginalName();
                $spa_extension2 = $spa_file2->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension2;
                $spa_uploadSuccess2 = $spa_file2->move($destinationPath, $spa_filename2);
                if ($spa_uploadSuccess2) {
                    $data['spa_image2'] = $spa_filename2;
                }
            }

            if (!is_null($request->file('spa_image3'))) {
                $spa_file3 = $request->file('spa_image3');
                $spa_filename3 = $spa_file3->getClientOriginalName();
                $spa_extension3 = $spa_file3->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension3;
                $spa_uploadSuccess3 = $spa_file3->move($destinationPath, $spa_filename3);
                if ($spa_uploadSuccess3) {
                    $data['spa_image3'] = $spa_filename3;
                }
            }

            if (!is_null($request->file('spa_image4'))) {
                $spa_file4 = $request->file('spa_image4');
                $spa_filename4 = $spa_file4->getClientOriginalName();
                $spa_extension4 = $spa_file4->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename4 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension4;
                $spa_uploadSuccess4 = $spa_file4->move($destinationPath, $spa_filename4);
                if ($spa_uploadSuccess4) {
                    $data['spa_image4'] = $spa_filename4;
                }
            }

            if (!is_null($request->file('spa_video'))) {
                $spa_vfile = $request->file('spa_video');
                $spa_vfilename = $spa_vfile->getClientOriginalName();
                $spa_vextension = $spa_vfile->getClientOriginalExtension(); //if you need extension of the file
                $spa_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_vextension;
                $spa_vuploadSuccess = $spa_vfile->move($destinationPath, $spa_videofilename);
                if ($spa_vuploadSuccess) {
                    $data['spa_video'] = $spa_videofilename;
                }
            }

            // Resturants
            $data['restaurant_title'] = $request->input('restaurant_title');
            $data['restaurant_desciription'] = $request->input('restaurant_desciription');
            $data['restaurant_url'] = $request->input('restaurant_url');
            $data['restaurant_usp_text'] = $request->input('restaurant_usp_text');
            $data['restaurant_usp_person'] = $request->input('restaurant_usp_person');
            if (!empty($request->input('restaurant_designer'))) {
                $data['restaurant_designer'] = implode(',', $request->input('restaurant_designer'));
            }
            if ($request->input('restaurant_video_type') != '') {
                $data['restaurant_video_type'] = $request->input('restaurant_video_type');
            }
            if ($request->input('restaurant_video_link_type') != '') {
                $data['restaurant_video_link_type'] = $request->input('restaurant_video_link_type');
            }
            $data['restaurant_video_link'] = $request->input('restaurant_video_link');
            if (!is_null($request->file('restaurant_image'))) {
                $restaurant_file = $request->file('restaurant_image');
                $restaurant_filename = $restaurant_file->getClientOriginalName();
                $restaurant_extension = $restaurant_file->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_extension;
                $restaurant_uploadSuccess = $restaurant_file->move($destinationPath, $restaurant_filename);
                if ($restaurant_uploadSuccess) {
                    $data['restaurant_image'] = $restaurant_filename;
                }
            }

            if (!is_null($request->file('restaurant_image2'))) {
                $restaurant_file2 = $request->file('restaurant_image2');
                $restaurant_filename2 = $restaurant_file2->getClientOriginalName();
                $restaurant_extension2 = $restaurant_file2->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_extension2;
                $restaurant_uploadSuccess2 = $restaurant_file2->move($destinationPath, $restaurant_filename2);
                if ($restaurant_uploadSuccess2) {
                    $data['restaurant_image2'] = $restaurant_filename2;
                }
            }

            if (!is_null($request->file('restaurant_video'))) {
                $restaurant_vfile = $request->file('restaurant_video');
                $restaurant_vfilename = $restaurant_vfile->getClientOriginalName();
                $restaurant_vextension = $restaurant_vfile->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_vextension;
                $restaurant_vuploadSuccess = $restaurant_vfile->move($destinationPath, $restaurant_videofilename);
                if ($restaurant_vuploadSuccess) {
                    $data['restaurant_video'] = $restaurant_videofilename;
                }
            }

            //resturant 2

            $data['restaurant2_title'] = $request->input('restaurant2_title');
            $data['restaurant2_desciription'] = $request->input('restaurant2_desciription');
            $data['restaurant2_url'] = $request->input('restaurant2_url');
            $data['restaurant2_usp_text'] = $request->input('restaurant2_usp_text');
            $data['restaurant2_usp_person'] = $request->input('restaurant2_usp_person');
            if (!empty($request->input('restaurant2_designer'))) {
                $data['restaurant2_designer'] = implode(',', $request->input('restaurant2_designer'));
            }
            if ($request->input('restaurant2_video_type') != '') {
                $data['restaurant2_video_type'] = $request->input('restaurant2_video_type');
            }
            if ($request->input('restaurant2_video_link_type') != '') {
                $data['restaurant2_video_link_type'] = $request->input('restaurant2_video_link_type');
            }
            $data['restaurant2_video_link'] = $request->input('restaurant2_video_link');
            if (!is_null($request->file('restaurant2_image'))) {
                $restaurant2_file = $request->file('restaurant2_image');
                $restaurant2_filename = $restaurant2_file->getClientOriginalName();
                $restaurant2_extension = $restaurant2_file->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_extension;
                $restaurant2_uploadSuccess = $restaurant2_file->move($destinationPath, $restaurant2_filename);
                if ($restaurant2_uploadSuccess) {
                    $data['restaurant2_image'] = $restaurant2_filename;
                }
            }

            if (!is_null($request->file('restaurant2_image2'))) {
                $restaurant2_file2 = $request->file('restaurant2_image2');
                $restaurant2_filename2 = $restaurant2_file2->getClientOriginalName();
                $restaurant2_extension2 = $restaurant2_file2->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_extension2;
                $restaurant2_uploadSuccess2 = $restaurant2_file2->move($destinationPath, $restaurant2_filename2);
                if ($restaurant2_uploadSuccess2) {
                    $data['restaurant2_image2'] = $restaurant2_filename2;
                }
            }

            if (!is_null($request->file('restaurant2_video'))) {
                $restaurant2_vfile = $request->file('restaurant2_video');
                $restaurant2_vfilename = $restaurant2_vfile->getClientOriginalName();
                $restaurant2_vextension = $restaurant2_vfile->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_vextension;
                $restaurant2_vuploadSuccess = $restaurant2_vfile->move($destinationPath, $restaurant2_videofilename);
                if ($restaurant2_vuploadSuccess) {
                    $data['restaurant2_video'] = $restaurant2_videofilename;
                }
            }
			
			//resturant 3

            $data['restaurant3_title'] = $request->input('restaurant3_title');
            $data['restaurant3_desciription'] = $request->input('restaurant3_desciription');
            $data['restaurant3_url'] = $request->input('restaurant3_url');
            $data['restaurant3_usp_text'] = $request->input('restaurant3_usp_text');
            $data['restaurant3_usp_person'] = $request->input('restaurant3_usp_person');
            if (!empty($request->input('restaurant3_designer'))) {
                $data['restaurant3_designer'] = implode(',', $request->input('restaurant3_designer'));
            }
            if ($request->input('restaurant3_video_type') != '') {
                $data['restaurant3_video_type'] = $request->input('restaurant3_video_type');
            }
            if ($request->input('restaurant3_video_link_type') != '') {
                $data['restaurant3_video_link_type'] = $request->input('restaurant3_video_link_type');
            }
            $data['restaurant3_video_link'] = $request->input('restaurant3_video_link');
            if (!is_null($request->file('restaurant3_image'))) {
                $restaurant3_file = $request->file('restaurant3_image');
                $restaurant3_filename = $restaurant3_file->getClientOriginalName();
                $restaurant3_extension = $restaurant3_file->getClientOriginalExtension(); //if you need extension of the file
                $restaurant3_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant3_extension;
                $restaurant3_uploadSuccess = $restaurant3_file->move($destinationPath, $restaurant3_filename);
                if ($restaurant3_uploadSuccess) {
                    $data['restaurant3_image'] = $restaurant3_filename;
                }
            }

            if (!is_null($request->file('restaurant3_image2'))) {
                $restaurant3_file2 = $request->file('restaurant3_image2');
                $restaurant3_filename2 = $restaurant3_file2->getClientOriginalName();
                $restaurant3_extension2 = $restaurant3_file2->getClientOriginalExtension(); //if you need extension of the file
                $restaurant3_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant3_extension2;
                $restaurant3_uploadSuccess2 = $restaurant3_file2->move($destinationPath, $restaurant3_filename2);
                if ($restaurant3_uploadSuccess2) {
                    $data['restaurant3_image2'] = $restaurant3_filename2;
                }
            }

            if (!is_null($request->file('restaurant3_video'))) {
                $restaurant3_vfile = $request->file('restaurant3_video');
                $restaurant3_vfilename = $restaurant3_vfile->getClientOriginalName();
                $restaurant3_vextension = $restaurant3_vfile->getClientOriginalExtension(); //if you need extension of the file
                $restaurant3_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant3_vextension;
                $restaurant3_vuploadSuccess = $restaurant3_vfile->move($destinationPath, $restaurant3_videofilename);
                if ($restaurant3_vuploadSuccess) {
                    $data['restaurant3_video'] = $restaurant3_videofilename;
                }
            }

            // bar
            $data['bar_title'] = $request->input('bar_title');
            $data['bar_sub_title'] = $request->input('bar_sub_title');
            $data['bar_desciription'] = $request->input('bar_desciription');
            $data['bar_url'] = $request->input('bar_url');
            $data['bar_usp_text'] = $request->input('bar_usp_text');
            $data['bar_usp_person'] = $request->input('bar_usp_person');
            if (!empty($request->input('bar_designer'))) {
                $data['bar_designer'] = implode(',', $request->input('bar_designer'));
            }
            if ($request->input('bar_video_type') != '') {
                $data['bar_video_type'] = $request->input('bar_video_type');
            }
            if ($request->input('bar_video_link_type') != '') {
                $data['bar_video_link_type'] = $request->input('bar_video_link_type');
            }
            $data['bar_video_link'] = $request->input('bar_video_link');
            if (!is_null($request->file('bar_image'))) {
                $bar_file = $request->file('bar_image');
                $bar_filename = $bar_file->getClientOriginalName();
                $bar_extension = $bar_file->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension;
                $bar_uploadSuccess = $bar_file->move($destinationPath, $bar_filename);
                if ($bar_uploadSuccess) {
                    $data['bar_image'] = $bar_filename;
                }
            }

            if (!is_null($request->file('bar_image2'))) {
                $bar_file2 = $request->file('bar_image2');
                $bar_filename2 = $bar_file2->getClientOriginalName();
                $bar_extension2 = $bar_file2->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension2;
                $bar_uploadSuccess2 = $bar_file2->move($destinationPath, $bar_filename2);
                if ($bar_uploadSuccess2) {
                    $data['bar_image2'] = $bar_filename2;
                }
            }

            if (!is_null($request->file('bar_image3'))) {
                $bar_file3 = $request->file('bar_image3');
                $bar_filename3 = $bar_file3->getClientOriginalName();
                $bar_extension3 = $bar_file3->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension3;
                $bar_uploadSuccess3 = $bar_file3->move($destinationPath, $bar_filename3);
                if ($bar_uploadSuccess3) {
                    $data['bar_image3'] = $bar_filename3;
                }
            }

            if (!is_null($request->file('bar_video'))) {
                $bar_vfile = $request->file('bar_video');
                $bar_vfilename = $bar_vfile->getClientOriginalName();
                $bar_vextension = $bar_vfile->getClientOriginalExtension(); //if you need extension of the file
                $bar_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_vextension;
                $bar_vuploadSuccess = $bar_vfile->move($destinationPath, $bar_videofilename);
                if ($bar_vuploadSuccess) {
                    $data['bar_video'] = $bar_videofilename;
                }
            }
			
			// bar 2
            $data['bar2_title'] = $request->input('bar2_title');
            $data['bar2_sub_title'] = $request->input('bar2_sub_title');
            $data['bar2_desciription'] = $request->input('bar2_desciription');
            $data['bar2_url'] = $request->input('bar2_url');
            $data['bar2_usp_text'] = $request->input('bar2_usp_text');
            $data['bar2_usp_person'] = $request->input('bar2_usp_person');
            if (!empty($request->input('bar2_designer'))) {
                $data['bar2_designer'] = implode(',', $request->input('bar2_designer'));
            }
            if ($request->input('bar2_video_type') != '') {
                $data['bar2_video_type'] = $request->input('bar2_video_type');
            }
            if ($request->input('bar2_video_link_type') != '') {
                $data['bar2_video_link_type'] = $request->input('bar2_video_link_type');
            }
            $data['bar2_video_link'] = $request->input('bar2_video_link');
            if (!is_null($request->file('bar2_image'))) {
                $bar2_file = $request->file('bar2_image');
                $bar2_filename = $bar2_file->getClientOriginalName();
                $bar2_extension = $bar2_file->getClientOriginalExtension(); //if you need extension of the file
                $bar2_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_extension;
                $bar2_uploadSuccess = $bar2_file->move($destinationPath, $bar2_filename);
                if ($bar2_uploadSuccess) {
                    $data['bar2_image'] = $bar2_filename;
                }
            }

            if (!is_null($request->file('bar2_image2'))) {
                $bar2_file2 = $request->file('bar2_image2');
                $bar2_filename2 = $bar2_file2->getClientOriginalName();
                $bar2_extension2 = $bar2_file2->getClientOriginalExtension(); //if you need extension of the file
                $bar2_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_extension2;
                $bar2_uploadSuccess2 = $bar2_file2->move($destinationPath, $bar2_filename2);
                if ($bar2_uploadSuccess2) {
                    $data['bar2_image2'] = $bar2_filename2;
                }
            }

            if (!is_null($request->file('bar2_image3'))) {
                $bar2_file3 = $request->file('bar2_image3');
                $bar2_filename3 = $bar2_file3->getClientOriginalName();
                $bar2_extension3 = $bar2_file3->getClientOriginalExtension(); //if you need extension of the file
                $bar2_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_extension3;
                $bar2_uploadSuccess3 = $bar2_file3->move($destinationPath, $bar2_filename3);
                if ($bar2_uploadSuccess3) {
                    $data['bar2_image3'] = $bar2_filename3;
                }
            }

            if (!is_null($request->file('bar2_video'))) {
                $bar2_vfile = $request->file('bar2_video');
                $bar2_vfilename = $bar2_vfile->getClientOriginalName();
                $bar2_vextension = $bar2_vfile->getClientOriginalExtension(); //if you need extension of the file
                $bar2_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_vextension;
                $bar2_vuploadSuccess = $bar2_vfile->move($destinationPath, $bar2_videofilename);
                if ($bar2_vuploadSuccess) {
                    $data['bar2_video'] = $bar2_videofilename;
                }
            }
			
			// bar 3
            $data['bar3_title'] = $request->input('bar3_title');
            $data['bar3_sub_title'] = $request->input('bar3_sub_title');
            $data['bar3_desciription'] = $request->input('bar3_desciription');
            $data['bar3_url'] = $request->input('bar3_url');
            $data['bar3_usp_text'] = $request->input('bar3_usp_text');
            $data['bar3_usp_person'] = $request->input('bar3_usp_person');
            if (!empty($request->input('bar3_designer'))) {
                $data['bar3_designer'] = implode(',', $request->input('bar3_designer'));
            }
            if ($request->input('bar3_video_type') != '') {
                $data['bar3_video_type'] = $request->input('bar3_video_type');
            }
            if ($request->input('bar3_video_link_type') != '') {
                $data['bar3_video_link_type'] = $request->input('bar3_video_link_type');
            }
            $data['bar3_video_link'] = $request->input('bar3_video_link');
            if (!is_null($request->file('bar3_image'))) {
                $bar3_file = $request->file('bar3_image');
                $bar3_filename = $bar3_file->getClientOriginalName();
                $bar3_extension = $bar3_file->getClientOriginalExtension(); //if you need extension of the file
                $bar3_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_extension;
                $bar3_uploadSuccess = $bar3_file->move($destinationPath, $bar3_filename);
                if ($bar3_uploadSuccess) {
                    $data['bar3_image'] = $bar3_filename;
                }
            }

            if (!is_null($request->file('bar3_image2'))) {
                $bar3_file2 = $request->file('bar3_image2');
                $bar3_filename2 = $bar3_file2->getClientOriginalName();
                $bar3_extension2 = $bar3_file2->getClientOriginalExtension(); //if you need extension of the file
                $bar3_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_extension2;
                $bar3_uploadSuccess2 = $bar3_file2->move($destinationPath, $bar3_filename2);
                if ($bar3_uploadSuccess2) {
                    $data['bar3_image2'] = $bar3_filename2;
                }
            }

            if (!is_null($request->file('bar3_image3'))) {
                $bar3_file3 = $request->file('bar3_image3');
                $bar3_filename3 = $bar3_file3->getClientOriginalName();
                $bar3_extension3 = $bar3_file3->getClientOriginalExtension(); //if you need extension of the file
                $bar3_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_extension3;
                $bar3_uploadSuccess3 = $bar3_file3->move($destinationPath, $bar3_filename3);
                if ($bar3_uploadSuccess3) {
                    $data['bar3_image3'] = $bar3_filename3;
                }
            }

            if (!is_null($request->file('bar3_video'))) {
                $bar3_vfile = $request->file('bar3_video');
                $bar3_vfilename = $bar3_vfile->getClientOriginalName();
                $bar3_vextension = $bar3_vfile->getClientOriginalExtension(); //if you need extension of the file
                $bar3_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_vextension;
                $bar3_vuploadSuccess = $bar3_vfile->move($destinationPath, $bar3_videofilename);
                if ($bar3_vuploadSuccess) {
                    $data['bar3_video'] = $bar3_videofilename;
                }
            }

            // Video section
            $data['video_title'] = $request->input('video_title');
            $data['video_desciription'] = $request->input('video_desciription');
            $data['video_sub_title'] = $request->input('video_sub_title');
            if ($request->input('video_type') != '') {
                $data['video_type'] = $request->input('video_type');
            }
            if ($request->input('video_link_type') != '') {
                $data['video_link_type'] = $request->input('video_link_type');
            }
            $data['video_link'] = $request->input('video_link');
            if (!is_null($request->file('video_image'))) {
                $video_file = $request->file('video_image');
                $video_filename = $video_file->getClientOriginalName();
                $video_extension = $video_file->getClientOriginalExtension(); //if you need extension of the file
                $video_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $video_extension;
                $video_uploadSuccess = $video_file->move($destinationPath, $video_filename);
                if ($video_uploadSuccess) {
                    $data['video_image'] = $video_filename;
                }
            }

            if (!is_null($request->file('video_video'))) {
                $video_vfile = $request->file('video_video');
                $video_vfilename = $video_vfile->getClientOriginalName();
                $video_vextension = $video_vfile->getClientOriginalExtension(); //if you need extension of the file
                $video_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $video_vextension;
                $video_vuploadSuccess = $video_vfile->move($destinationPath, $video_videofilename);
                if ($video_vuploadSuccess) {
                    $data['video_video'] = $video_videofilename;
                }
            }
            $data['citytaxyesno'] = $request->input('rdcitytax');
            $data['adult_tax'] = $request->input('adult_tax');
            $data['junior_tax'] = $request->input('junior_tax');
            $data['baby_tax'] = $request->input('baby_tax');

            $id = $this->model->insertRow($data, $request->input('id'));

            if (!is_null($request->input('copy_amenities_rooms')) && !empty($request->input('assigned_amenities'))) {
                $check_pcats = \DB::table('tb_properties_category_types')->where('property_id', $id)->get();
                if (!empty($check_pcats)) {
                    foreach ($check_pcats as $pcats) {
                        $check_pcats_exist = \DB::table('tb_properties_category_amenities')->where('property_id', $id)->where('cat_id', $pcats->id)->first();
                        $Amdata['property_id'] = $id;
                        $Amdata['cat_id'] = $pcats->id;
                        $Amdata['user_id'] = $uid;
                        $Amdata['amenity_ids'] = implode(',', $request->input('assigned_amenities'));
                        if (!empty($check_pcats_exist)) {
                            $Amdata['updated'] = date('Y-m-d h:i:s');
                            \DB::table('tb_properties_category_amenities')->where('id', $check_pcats_exist->id)->update($Amdata);
                        } else {
                            $Amdata['created'] = date('Y-m-d h:i:s');
                            \DB::table('tb_properties_category_amenities')->insertGetId($Amdata);
                        }
                    }
                }
            }            
            
            /** insert property packages relation start **/
            $finproperty_package_relation = array();
            $upproperty_package_relation = array();
            $prop_package_rel = \DB::table('tb_properties_category_package')->where('property_id', $id)->get();
            $rest_arr = array();
            foreach($prop_package_rel as $si_prop){ $rest_arr[$si_prop->package_id] = $si_prop; }
            $prop_package_rel = $rest_arr;
            \DB::table('tb_properties_category_package')->where('property_id', $id)->delete();
            if((count($property_packages) > 0)){                
                foreach($property_packages as $si_prop){ 
                    if(isset($prop_package_rel[$si_prop])){ $finproperty_package_relation[] = array("property_id"=>$id,"package_id"=>$si_prop,"id"=>$prop_package_rel[$si_prop]->id); }
                    else{ $finproperty_package_relation[] = array("property_id"=>$id,"package_id"=>$si_prop,"id"=>NULL); }
                }
            }
            
            if(count($finproperty_package_relation)){ \DB::table('tb_properties_category_package')->insert($finproperty_package_relation); }
            /** insert property packages relation end **/
            
            
            /** insert property packages relation start **/
            $final_assigned_users = array();            
            \DB::table('tb_properties_users')->where('property_id', $id)->delete();            
            if((count($assigned_users) > 0)){                
                foreach($assigned_users as $si_user){ 
                    $final_assigned_users[] = array("property_id"=>$id,"user_id"=>$si_user); 
                }
            }            
            if(count($final_assigned_users)){ \DB::table('tb_properties_users')->insert($final_assigned_users); }
            /** insert property packages relation end **/
            
            
            if (!is_null($request->input('apply'))) {
                $return = 'properties/update/' . $id . '?return=' . self::returnUrl();
            } else {
                $return = 'properties?return=' . self::returnUrl();
            }

            // Insert logs into database
            if ($request->input('id') == '') {
                \SiteHelpers::auditTrail($request, 'New Data with ID ' . $id . ' Has been Inserted !');
            } else {
                \SiteHelpers::auditTrail($request, 'Data with ID ' . $id . ' Has been Updated !');
            }

            return Redirect::to($return)->with('messagetext', \Lang::get('core.note_success'))->with('msgstatus', 'success');
        } else {

            return Redirect::to('properties/update/' . $id)->with('messagetext', \Lang::get('core.note_error'))->with('msgstatus', 'error')
                            ->withErrors($validator)->withInput();
        }
    }

    public function postDelete(Request $request) {

        if ($this->access['is_remove'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        // delete multipe rows 
        if (count($request->input('ids')) >= 1) {
            $selids = $request->input('ids');
            $checkDir = \DB::table('tb_container')->where('name', 'locations')->first();
            foreach ($selids as $sids) {
                $checkProp = \DB::table('tb_properties')->where('id', $sids)->first();
                if (!empty($checkProp)) {
                    $foldName = trim($checkProp->property_name);
                    if ($foldName != "") {
                        $slug = \SiteHelpers::seoUrl(trim($foldName));
                        $checkPropFold = \DB::table('tb_container')->where('name', $slug)->where('parent_id', $checkDir->id)->first();
                        if (!empty($checkPropFold)) {
                            $childs = (new ContainerController)->fetchFolderChildListIds($checkPropFold->id);
                            $dirPath = (new ContainerController)->getContainerUserPath($checkPropFold->id);
                            if (is_dir($dirPath) === true) {
                                array_unshift($childs, $checkPropFold->id);
                                $deleteEfile = (new ContainerController)->delete_allextra_files($childs, 'folder');

                                File::deleteDirectory($dirPath);
                                \DB::table('tb_container')->whereIn('id', $childs)->delete();
                                \DB::table('tb_container_files')->whereIn('folder_id', $childs)->delete();
                            }
                        }
                    }
                }

                $checkType = \DB::table('tb_properties_category_types')->where('property_id', $sids)->count();
                if ($checkType > 0) {
                    \DB::table('tb_properties_category_types')->where('property_id', $sids)->delete();
                }
                $checkRooms = \DB::table('tb_properties_category_rooms')->where('property_id', $sids)->count();
                if ($checkRooms > 0) {
                    \DB::table('tb_properties_category_rooms')->where('property_id', $sids)->delete();
                }
                $checkRoomsprice = \DB::table('tb_properties_category_rooms_price')->where('property_id', $sids)->count();
                if ($checkRoomsprice > 0) {
                    \DB::table('tb_properties_category_rooms_price')->where('property_id', $sids)->delete();
                }
                $checkimages = \DB::table('tb_properties_images')->where('property_id', $sids)->count();
                if ($checkimages > 0) {
                    \DB::table('tb_properties_images')->where('property_id', $sids)->delete();
                }
                $checkamenties = \DB::table('tb_properties_category_amenities')->where('property_id', $sids)->count();
                if ($checkamenties > 0) {
                    \DB::table('tb_properties_category_amenities')->where('property_id', $sids)->delete();
                }
            }
            $this->model->destroy($request->input('ids'));

            \SiteHelpers::auditTrail($request, "ID : " . implode(",", $request->input('ids')) . "  , Has Been Removed Successfull");
            // redirect
            return Redirect::to('properties')
                            ->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus', 'success');
        } else {
            return Redirect::to('properties')
                            ->with('messagetext', 'No Item Deleted')->with('msgstatus', 'error');
        }
    }

    public function show_settings($property_id, $active, Request $request) {
        $this->data['active'] = $active;
        $this->data['pid'] = $property_id;
        $this->data['property_data'] = \DB::table('tb_properties')->where('id', $property_id)->first();
        if(\Session::get('gid')==5){
            $tabs = \DB::table('tb_properties_config_tabs')->where('tab_status', 1)->where('tab_slug', '<>', 'calendar')->orderBy('id', 'asc')->get();
            //$tabs = \DB::table('tb_properties_config_tabs')->where('tab_status', 1)->orderBy('id', 'asc')->get();
        }else{
            $tabs = \DB::table('tb_properties_config_tabs')->where('tab_status', 1)->orderBy('id', 'asc')->get();
        }
        if (!empty($tabs)) {
            foreach ($tabs as $tab) {
                $tabdata[$tab->tab_slug] = $tab;
            }
        }
        $this->data['tabss'] = $tabdata;
        if ($active == 'types') { echo "hello"; die;
            $this->data['cat_types'] = $this->find_categories($property_id);
            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.settings_cats':'properties.settings_cats'; 
            
            return view($file_name, $this->data);
        } elseif ($active == 'rooms') {
            $this->data['cat_types'] = $this->find_categories_room($property_id);
            $this->data['amenties'] = \DB::table('tb_amenities')->where('amenity_status', '1')->orderBy('amenity_title', 'asc')->get();
            $this->data['room_amenties_desc'] = array();
            $room_amenties_desc = \DB::table('tb_properties_category_types')->select('id', 'room_desc')->where('property_id', $property_id)->get();
            if (!empty($room_amenties_desc)) {
                foreach ($room_amenties_desc as $roomdesc) {
                    $rooms_desc[$roomdesc->id] = $roomdesc->room_desc;
                }
                $this->data['room_amenties_desc'] = $rooms_desc;
            }
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.settings_rooms':'properties.settings_rooms'; 
            
            return view($file_name, $this->data);
            
        } elseif ($active == 'price') {
            $seasonArr = array();
            if ($this->data['property_data']->default_seasons != 1) {
                $checkseason = \DB::table('tb_seasons')->where('property_id', $property_id)->orderBy('season_priority', 'asc')->get();
            } else {
                $checkseason = \DB::table('tb_seasons')->where('property_id', 0)->orderBy('season_priority', 'asc')->get();
            }

            $this->data['Seasons'] = $checkseason;
            $this->data['room_prices'] = $this->find_categories_room_price($property_id);
            //print "<pre>"; print_r($this->data['room_prices']);
            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.settings_price':'properties.settings_price';
            
            return view($file_name, $this->data);
        } elseif ($active == 'property_images') {
            $this->data['imgs'] = $this->get_property_files($property_id, 'Property Images');
            $this->data['slider_imgs'] = $this->get_property_files($property_id, 'Property Slider Images');
            $this->data['grid_imgs'] = $this->get_property_files($property_id, 'Property Grid');
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.settings_property_images':'properties.settings_property_images';
            
            return view($file_name, $this->data);
        } elseif ($active == 'property_documents') {
            $this->data['hotel_broch'] = $this->get_property_files($property_id, 'Hotel Brochure');
    	    $this->data['restru_menu'] = $this->get_property_files($property_id, 'Restaurant Menu');
    	    $this->data['spa_broch'] = $this->get_property_files($property_id, 'Spa Brochure');
    		$this->data['hotelcontacts'] = $this->get_property_files($property_id, 'Hotel Contracts');
            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.settings_property_documents':'properties.settings_property_documents';
            
            return view($file_name, $this->data);
        } elseif ($active == 'gallery_images') {
            $this->data['spaimgs'] = $this->get_property_files($property_id, 'Spa Gallery Images');
            $this->data['resturan_imgs'] = $this->get_property_files($property_id, 'Restrurants Gallery Images');
            $this->data['bar_imgs'] = $this->get_property_files($property_id, 'Bar Gallery Images');
            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.settings_gallery_images':'properties.settings_gallery_images';
            
            return view($file_name, $this->data);
        } elseif ($active == 'calendar') {
            $this->data['cat_types'] = $this->find_categories_room($property_id);
            
            $this->data['currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.settings_calendar':'properties.settings_calendar'; 
            
            return view($file_name, $this->data);
            //return view('properties.settings_calendar', $this->data);
        } elseif ($active == 'terms_and_conditions') {
            if (!is_null($request->input('terms_n_conditions'))) {
                $row = \DB::table('td_property_terms_n_conditions')->where('property_id', $property_id)->first();
                if (!empty($row)) {
                    \DB::table('td_property_terms_n_conditions')->where('term_id', $row->term_id)->update(array('terms_n_conditions' => $request->input('terms_n_conditions'), 'applytoallroomtypes'=>$request->input('termsapplytoallroomtypes')));
                } else {
                    \DB::table('td_property_terms_n_conditions')->insertGetId(array('property_id' => $property_id, 'terms_n_conditions' => $request->input('terms_n_conditions'), 'applytoallroomtypes'=>$request->input('termsapplytoallroomtypes')));
                }
            }            
            $this->data['row'] = \DB::table('td_property_terms_n_conditions')->where('property_id', $property_id)->first();
            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.settings_terms_and_conditions':'properties.settings_terms_and_conditions'; 
            return view($file_name, $this->data);
            
        }elseif ($active == 'custom-price') {  
            echo "heelo"; die;
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            //if($is_demo6!=''){
            $seasons = \DB::table('tb_seasons')->where('property_id', $property_id)->get();
            $this->data['seasons'] = $seasons;
            $this->data['customseasons'] = \DB::table('tb_properties_custom_plan')->where('property_id', $property_id)->get();
            
            $this->data['cattypes'] = \DB::table('tb_properties_category_types')->where('property_id', $property_id)->get();
            
            $this->data['boards'] = \DB::table('tb_boards')->where('property_id', $property_id)->get();
            
            $globalcustomplan = \DB::table('tb_global_custom_plan_assined')->join('tb_global_custom_plan', 'tb_global_custom_plan_assined.global_plan_id', '=', 'tb_global_custom_plan.id')->select('tb_global_custom_plan.*')->where('property_id', $property_id)->get();
            
            $override_plans = \DB::table('tb_global_custom_plan_override')->where('property_id', $property_id)->get();
            $over_arr = array();
            $over_plan_obj = array();
            if(!empty($override_plans)){
                foreach($override_plans as $sio){
                    $over_arr[] = $sio->global_plan_id;
                    $over_plan_obj[$sio->global_plan_id] = $sio;
                }
            }
            $gl_plans = array();
            if(!empty($globalcustomplan)){
                foreach($globalcustomplan as $sip){
                    if(in_array($sip->id, $over_arr)){
                        $gl_plans[] = $over_plan_obj[$sip->id];        
                    }else{
                        $gl_plans[] = $sip;    
                    }
                }
            }
            //echo "<pre>";
            //print_r($gl_plans); die;
            $this->data['globalcustomplan'] = $gl_plans;
            
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.settings_customprice':'properties.custom_price';                
            return view($file_name, $this->data);
            //}
        }elseif ($active == 'restrictions') {            
            $this->data[] = '';            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            if($is_demo6!=''){
                $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.settings_restrictions':'properties.custom_price';                
                return view($file_name, $this->data);
            }
        }elseif ($active == 'options') {            
            $vattaxes = \DB::table('tb_vat_taxes')->get();
            $this->data['vattaxes'] = $vattaxes;       
            $prop_vatid = \DB::table('tb_properties')->select('vattax_id')->where('id', $property_id)->get();
            $this->data['prop_vatid'] = $prop_vatid;                         
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());            
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.settings_options':'properties.settings_options';                
            return view($file_name, $this->data);
            
        }elseif ($active == 'boards') {  
            $boards = \DB::table('tb_boards')->where('property_id', $property_id)->get();            
            $this->data['boards'] = $boards;                                
            $vattaxes = \DB::table('tb_vat_taxes')->get();
            $this->data['vattaxes'] = $vattaxes;   
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());      
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.settings_boards':'properties.settings_boards';                
            return view($file_name, $this->data);            
        }elseif ($active == 'meals') {            
            $this->data[] = '';            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            if($is_demo6!=''){
                $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.settings_meals':'properties.custom_price';                
                return view($file_name, $this->data);
            }
        }
        if ($active == 'seasons') {
            $seasonArr = array();
            $checkseason = \DB::table('tb_seasons')->where('property_id', $property_id)->get();
            if (!empty($checkseason)) {
                $s = 0;
                foreach ($checkseason as $season) {
                    $seasonArr[$s] = $season;
                    $checkseasondates = \DB::table('tb_seasons_dates')->where('season_id', $season->id)->get();
                    if (!empty($checkseasondates)) {
                        $seasonArr[$s]->dates = $checkseasondates;
                    }
                    $s++;
                }
            }
            $this->data['Seasons'] = $seasonArr;
            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.settings_seasons':'properties.settings_seasons'; 
            
            return view($file_name, $this->data);
        }
    }
    
    public function ajax_show_settings() {
        
        $property_id = $_REQUEST['id'];
        $property_cat_id = $_REQUEST['cid'];
        $this->data['pid'] = $property_id;
        //$this->data['property_data'] = \DB::table('tb_properties')->where('id', $property_id)->first();
        
        $this->data['cat_types'] = $this->find_categories_room_ajax($property_cat_id);
        //$this->data['amenties'] = \DB::table('tb_amenities')->where('amenity_status', '1')->get();
        //$this->data['room_amenties_desc'] = array();
        //$room_amenties_desc = \DB::table('tb_properties_category_types')->select('id', 'room_desc')->where('property_id', $property_id)->get();
        //if (!empty($room_amenties_desc)) {
        //    foreach ($room_amenties_desc as $roomdesc) {
        //        $rooms_desc[$roomdesc->id] = $roomdesc->room_desc;
        //    }
        //    $this->data['room_amenties_desc'] = $rooms_desc;
        //}
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.ajax_settings_rooms':'properties.settings_rooms'; 
        
        echo view($file_name, $this->data);
        
    }
    
    function get_property_files($property_id, $filetype) {
        $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*',  \DB::raw("(CASE WHEN (tb_container_files.file_display_name = '') THEN tb_container_files.file_name ELSE tb_container_files.file_display_name END) as file_display_name"), 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $property_id)->where('tb_properties_images.type', $filetype)->get();
        $filen = array();
        if (!empty($fileArr)) {
            $f = 0;
            foreach ($fileArr as $file) {
                $filen[$f] = $file;
                $filen[$f]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                $f++;
            }
        }
        return $filen;
    }

    function find_categories($property_id) {
        $cat_types = \DB::table('tb_properties_category_types')->where('property_id', $property_id)->where('status', 0)->get();
        return $cat_types;
    }
    
    function find_categories_room_ajax($property_id) {
        $cats = array();
        $cat_types = \DB::table('tb_properties_category_types')->where('id', $property_id)->where('status', 0)->get();
        if (!empty($cat_types)) {
            $c = 0;
            foreach ($cat_types as $type) {
                $cats[$c]['data'] = $type;
                $cat_rooms = \DB::table('tb_properties_category_rooms')->where('category_id', $property_id)->where('category_id', $type->id)->orderBy('id', 'asc')->get();
                if (!empty($cat_rooms)) {
                    foreach ($cat_rooms as $room) {
                        $cats[$c]['rooms'][] = $room;
                    }
                }
                
                $c++;
            }
        }

        return $cats;
    }
    
    function find_categories_room($property_id) {
        $cats = array();
        $cat_types = \DB::table('tb_properties_category_types')->where('property_id', $property_id)->where('status', 0)->get();
        if (!empty($cat_types)) {
            $c = 0;
            foreach ($cat_types as $type) {
                $cats[$c]['data'] = $type;
                $cat_rooms = \DB::table('tb_properties_category_rooms')->where('property_id', $property_id)->where('category_id', $type->id)->orderBy('id', 'asc')->get();
                if (!empty($cat_rooms)) {
                    foreach ($cat_rooms as $room) {
                        $cats[$c]['rooms'][] = $room;
                    }
                }
                $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_display_name', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $property_id)->where('tb_properties_images.category_id', $type->id)->where('tb_properties_images.type', 'Rooms Images')->get();
                $filen = array();
                if (!empty($fileArr)) {
                    $f = 0;
                    foreach ($fileArr as $file) {
                        $cats[$c]['imgs'][$f] = $file;
                        $cats[$c]['imgs'][$f]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                        $f++;
                    }
                }

                $cat_amenty = \DB::table('tb_properties_category_amenities')->where('property_id', $property_id)->where('cat_id', $type->id)->first();
                if (!empty($cat_amenty)) {
                    $cats[$c]['amenty'] = $cat_amenty;
                }

                $cat_amenty = \DB::table('tb_properties_category_amenities')->where('property_id', $property_id)->where('cat_id', $type->id)->first();
                if (!empty($cat_amenty)) {
                    $cats[$c]['amenties'] = $cat_amenty->amenity_ids;
                }
                $c++;
            }
        }

        return $cats;
    }

    function find_categories_room_price($property_id) {
        $cats = array();
        $cat_types = \DB::table('tb_properties_category_types')->where('property_id', $property_id)->where('status', 0)->get();
        if (!empty($cat_types)) {
            $c = 0;
            foreach ($cat_types as $type) {
                $cats[$c]['data'] = $type;
                $cat_rooms_price = \DB::table('tb_properties_category_rooms_price')->where('property_id', $property_id)->where('category_id', $type->id)->get();
                if (!empty($cat_rooms_price)) {
                    foreach ($cat_rooms_price as $room_price) {
                        $cats[$c]['rooms_price'][$room_price->season_id] = $room_price;
                    }
                }
                $c++;
            }
        }

        return $cats;
    }

    // category

    function save_property_type_data(Request $request) {
        $uid = \Auth::user()->id;
        $rules['cat_name'] = 'required';
        $rules['cat_short_name'] = 'required';
        $rules['guests_base_price'] = 'required|numeric';
        $rules['guests_total'] = 'required|numeric';
        $rules['guests_adult'] = 'required|numeric';
        $rules['guests_junior'] = 'required|numeric';
        $rules['guests_babies'] = 'required|numeric';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data['property_id'] = $request->input('property_id');
            $data['user_id'] = $uid;
            $data['category_name'] = $request->input('cat_name');
            $data['cat_short_name'] = $request->input('cat_short_name');
            $data['guests_in_base_price'] = $request->input('guests_base_price');
            $data['minimum_stay'] = $request->input('min_stay');
            $data['total_guests'] = $request->input('guests_total');
            $data['guests_adults'] = $request->input('guests_adult');
            $data['guests_juniors'] = $request->input('guests_junior');
            $data['guests_babies'] = $request->input('guests_babies');
            //$data['booking_policy'] =  $request->input('bookingPolicy');
            
            if (!is_null($request->input('count_baby'))) {
                $data['baby_count'] = $request->input('count_baby');
            } else {
                $data['baby_count'] = 0;
            }

            if (!is_null($request->input('show_booking'))) {
                $data['show_on_booking'] = $request->input('show_booking');
            } else {
                $data['show_on_booking'] = 0;
            }

            if ($request->input('edit_type_id') == '') {
                $data['created'] = date('Y-m-d h:i:s');
                $data['booking_policy'] =  $request->input('bookingPolicy');
                $data['cat_color'] =  $request->input('cat_color');
                $instype = 'add';
                $id = \DB::table('tb_properties_category_types')->insertGetId($data);
            } else {
                $data['updated'] = date('Y-m-d h:i:s');
                $data['booking_policy'] =  $request->input('bookingPolicy');   
                $data['cat_color'] =  $request->input('cat_color');             
                $instype = 'update';
                $id = \DB::table('tb_properties_category_types')->where('id', $request->input('edit_type_id'))->update($data);
            }

            $typdata = array();
            $checkType = \DB::table('tb_properties_category_types')->where('id', $id)->where('status', 0)->first();
            if (!empty($checkType)) {
                $typdata = $checkType;
            }

            $res['status'] = 'success';
            $res['category'] = $typdata;
            $res['type'] = $instype;
            return json_encode($res);
        } else {

            $res['status'] = 'error';
            $res['errors'] = $validator->errors()->all();
            return json_encode($res);
        }
    }

    function delete_property_type(Request $request) {
        $uid = \Auth::user()->id;
        $catId = $request->input('cat_id');
        $checkType = \DB::table('tb_properties_category_types')->where('id', $catId)->where('status', 0)->count();
        if ($checkType > 0) {
            \DB::table('tb_properties_category_types')->where('id', $catId)->delete();

            $checkRooms = \DB::table('tb_properties_category_rooms')->where('category_id', $catId)->count();
            if ($checkRooms > 0) {
                \DB::table('tb_properties_category_rooms')->where('category_id', $catId)->delete();
            }
            $checkRoomsprice = \DB::table('tb_properties_category_rooms_price')->where('category_id', $catId)->count();
            if ($checkRoomsprice > 0) {
                \DB::table('tb_properties_category_rooms_price')->where('category_id', $catId)->delete();
            }
            $checkimages = \DB::table('tb_properties_images')->where('category_id', $catId)->where('type', 'Rooms Images')->get();
            if (!empty($checkimages)) {
                foreach ($checkimages as $cimg) {
                    $deleteEfile = (new ContainerController)->delete_allextra_files($cimg->file_id, 'file');
                    $deleteFile = \DB::table('tb_container_files')->where('id', $cimg->file_id)->delete();
                    \DB::table('tb_properties_images')->where('category_id', $catId)->where('type', 'Rooms Images')->delete();
                }
            }
            $checkamenties = \DB::table('tb_properties_category_amenities')->where('cat_id', $catId)->count();
            if ($checkamenties > 0) {
                \DB::table('tb_properties_category_amenities')->where('cat_id', $catId)->delete();
            }

            $res['status'] = 'success';
            return json_encode($res);
        } else {
            $res['status'] = 'error';
            return json_encode($res);
        }
    }

    //rooms

    function save_property_rooms_data(Request $request) {
        $uid = \Auth::user()->id;
        $rules['room_name'] = 'required';
        $rules['room_active_from'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data['property_id'] = $request->input('property_id');
            $data['category_id'] = $request->input('category_id');
            $data['user_id'] = $uid;
            $data['room_name'] = $request->input('room_name');
            if (!is_null($request->input('room_active_full'))) {
                $data['active_full_year'] = $request->input('room_active_full');
                //$data['room_active_from'] = date('Y-m-d');
                //$data['room_active_to'] = date('Y') . '-12-31';
                $data['room_active_from'] = $request->input('room_active_from');
                $data['room_active_to'] = $request->input('room_active_to');
            } else {
                $data['active_full_year'] = 0;
                $data['room_active_from'] = $request->input('room_active_from');
                $data['room_active_to'] = $request->input('room_active_to');
            }
            if ($request->input('edit_room_id') == '') {
                $data['created'] = date('Y-m-d h:i:s');
                $instype = 'add';
                $id = \DB::table('tb_properties_category_rooms')->insertGetId($data);
            } else {
                $data['updated'] = date('Y-m-d h:i:s');
                $instype = 'update';
                $id = \DB::table('tb_properties_category_rooms')->where('id', $request->input('edit_room_id'))->update($data);
            }

            $romdata = array();
            $checkRoom = \DB::table('tb_properties_category_rooms')->where('id', $id)->first();
            if (!empty($checkRoom)) {
                $romdata = $checkRoom;
            }

            $res['status'] = 'success';
            $res['room'] = $romdata;
            $res['type'] = $instype;
            $res['pid'] = $data['property_id'];
            $res['category_id'] = $request->input('category_id');
            return json_encode($res);
        } else {

            $res['status'] = 'error';
            $res['errors'] = $validator->errors()->all();
            return json_encode($res);
        }
    }
    
    function delete_property_room(Request $request) {
        $uid = \Auth::user()->id;
        $roomId = $request->input('room_id');
        $catid = $request->input('catid');
        $pid = $request->input('pid');
        $checkRoom = \DB::table('tb_properties_category_rooms')->where('id', $roomId)->count();
        if ($checkRoom > 0) {
            $ups = \DB::table('tb_properties_category_rooms')->where('id', $roomId)->delete();

            $res['status'] = 'success';
            $res['pid'] = $pid;
            $res['catid'] = $catid;
            return json_encode($res);
        } else {
            $res['status'] = 'error';
            return json_encode($res);
        }
    }

    function copy_category_rooms(Request $request) {
        $uid = \Auth::user()->id;
        $roomId = $request->input('roomID');
        $retUrl = $request->input('curnurl');
        $nums = $request->input('copy_num');
        $checkRoom = \DB::table('tb_properties_category_rooms')->where('id', $roomId)->first();
        if (!empty($checkRoom)) {
            $rname = $checkRoom->room_name;
            for ($c = 0; $c < $nums; $c++) {
                $cdata = array();
                $cdata['property_id'] = $checkRoom->property_id;
                $cdata['category_id'] = $checkRoom->category_id;
                $cdata['user_id'] = $uid;
                $newname = substr($rname, -1) + 1;
                $rname = substr($rname, 0, -1) . $newname;
                $cdata['room_name'] = $rname;
                $cdata['active_full_year'] = $checkRoom->active_full_year;
                $cdata['room_active_from'] = $checkRoom->room_active_from;
                $cdata['room_active_to'] = $checkRoom->room_active_to;
                $cdata['created'] = date('Y-m-d h:i:s');
                $id = \DB::table('tb_properties_category_rooms')->insertGetId($cdata);
            }
            return Redirect::to($retUrl)
                            ->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus', 'success');
        } else {
            return Redirect::to($retUrl)
                            ->with('messagetext', 'No Room Found')->with('msgstatus', 'error');
        }
    }

    function property_images_uploads(Request $request) {
        $checkProp = \DB::table('tb_properties')->select('property_name')->where('id', $request->input('propId'))->first();
        //print_r($checkProp); die;
        if (!empty($checkProp)) {
            $checkDir = \DB::table('tb_container')->select('id')->where('name', 'locations')->first();
            if (!empty($checkDir)) {
                $foldVal = trim($checkProp->property_name);
                if ($foldVal != "") {
                    $foldName = trim($foldVal);
                    $slug = \SiteHelpers::seoUrl(trim($foldName));
                    $dirPath = (new ContainerController)->getContainerUserPath($checkDir->id);

                    $checkPropFold = \DB::table('tb_container')->select('id')->where('name', $slug)->where('parent_id', $checkDir->id)->first();
                    if (!empty($checkPropFold)) {
                        $propFoldId = $checkPropFold->id;
                    } else {
                        $newPropFolder = $this->createNewFolder($foldName, $checkDir->id);
                        if ($newPropFolder !== false) {
                            $propFoldId = $newPropFolder;
                        }
                    }

                    $imgFold = $request->input('uploadType');
                    $PropImgfoldName = trim($imgFold);
                    $PropImgslug = \SiteHelpers::seoUrl(trim($PropImgfoldName));
                    $checkPropImgFold = \DB::table('tb_container')->select('id')->where('name', $PropImgslug)->where('parent_id', $propFoldId)->first();
                    if (!empty($checkPropImgFold)) {
                        $newpropImgFoldId = $checkPropImgFold->id;
                    } else {
                        $newPropImgFolder = $this->createNewFolder($PropImgfoldName, $propFoldId);
                        if ($newPropImgFolder !== false) {
                            $newpropImgFoldId = $newPropImgFolder;
                        }
                    }

                    if ($imgFold == 'Rooms Images') {
                        $cat_id = $request->input('category_id');
                        $getcat = \DB::table('tb_properties_category_types')->select('category_name')->where('id', $cat_id)->where('status', 0)->first();
                        if (!empty($getcat)) {
                            $catFold = $getcat->category_name;
                            $CatfoldName = trim($catFold);
                            $Catslug = \SiteHelpers::seoUrl(trim($CatfoldName));
                            $checkCatFold = \DB::table('tb_container')->select('id')->where('name', $Catslug)->where('parent_id', $newpropImgFoldId)->first();
                            if (!empty($checkCatFold)) {
                                $CatFoldId = $checkCatFold->id;
                            } else {
                                $newCatFolder = $this->createNewFolder($CatfoldName, $newpropImgFoldId);
                                if ($newCatFolder !== false) {
                                    $CatFoldId = $newCatFolder;
                                }
                            }
                            $propImgFoldId = $CatFoldId;
                        } else {
                            $propImgFoldId = $newpropImgFoldId;
                        }
                    } else {
                        $propImgFoldId = $newpropImgFoldId;
                    }
                    // SET UPLOAD PATH
                    $destinationPath = (new ContainerController)->getContainerUserPath($propImgFoldId);
                    $file = $request->file('files');
                    // GET THE FILE EXTENSION
                    $extension = $file[0]->getClientOriginalExtension();
                    // RENAME THE UPLOAD WITH RANDOM NUMBER
                    $fileName = rand(11111111111, 99999999999) . '-' .rand(11111111111, 99999999999) . '.' . $extension;
                    $fileNamedis = $file[0]->getClientOriginalName();
                    $ftname = explode('.', $fileName);
                    $exha = false;

                    for ($f = 1; $exha != true; $f++) {
                        if (\File::exists($destinationPath . $fileName)) {
                            $fileName = $ftname[0] . '(' . $f . ').' . $extension;
                        } else {
                            $fileName = $fileName;
                            $exha = true;
                        }
                    }
                    // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
                    $upload_success = $file[0]->move($destinationPath, $fileName);
                    $ftype = $file[0]->getClientMimeType();
                    $exFtype = explode('/', $ftype);
                    if ($exFtype[0] == "image") {
                        // open an image file
                        $thimg = \Image::make($destinationPath . $fileName);
                        // now you are able to resize the instance
                        $thimg->resize(128, 130);
                        // finally we save the image as a new file
                        $thumbfile = 'thumb_' . $propImgFoldId . '_' . $fileName;
                        $thimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);

                        // open an image file
                        $mdimg = \Image::make($destinationPath . $fileName);
                        // now you are able to resize the instance
                        $thactualsize = getimagesize($destinationPath . $fileName);
                        if ($thactualsize[0] > $thactualsize[1]) {
                            $mdimg->resize(320, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        } else {
                            $mdimg->resize(null, 320, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }
                        // finally we save the image as a new file
                        $thumbfile = 'format_' . $propImgFoldId . '_' . $fileName;
                        $mdimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);

                        // open an image file
                        $mdimg = \Image::make($destinationPath . $fileName);
                        // now you are able to resize the instance
                        $hfactualsize = getimagesize($destinationPath . $fileName);
                        if ($hfactualsize[0] > $hfactualsize[1]) {
                            $mdimg->resize(1000, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        } else {
                            $mdimg->resize(null, 1000, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }
                        // finally we save the image as a new file
                        $thumbfile = 'highflip_' . $propImgFoldId . '_' . $fileName;
                        $mdimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);

                        // open an image file
                        $pthimg = \Image::make($destinationPath . $fileName);
                        // now you are able to resize the instance
                        $pthimg->resize(80, 80);
                        // finally we save the image as a new file
                        $pthumbfile = $fileName;
                        $pthimg->save(public_path() . '/uploads/property_imgs_thumbs/' . $pthumbfile);

                        $fpimg = \Image::make($destinationPath . $fileName);
                        $thactualsize = getimagesize($destinationPath . $fileName);
                        if ($thactualsize[0] > $thactualsize[1]) {
                            $fpimg->resize(425, 283);
                        } else {
                            $fpimg->resize(212, 283);
                        }
                        $thumbfile = 'front_property_' . $propImgFoldId . '_' . $fileName;
                        $fpimg->save(public_path() . '/uploads/property_imgs_thumbs/' . $thumbfile);

                        // Set main image if uploaded file is first in folder
                        $countfile = \DB::table('tb_container_files')->where('folder_id', $propImgFoldId)->where(function ($query) {
                                    $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');
                                })->count();
                        if ($countfile == 0) {
                            $copytofolder = public_path() . '/uploads/folder_cover_imgs/';
                            // image for backend
                            $bkimg = \Image::make($destinationPath . $fileName);
                            $bkimg->resize(128, 130);
                            $bkimgfile = 'thumb_' . $fileName;
                            $bkimg->save($copytofolder . $bkimgfile);

                            // open an image file
                            $mdimg = \Image::make($destinationPath . $fileName);
                            $thactualsize = getimagesize($destinationPath . $fileName);
                            if ($thactualsize[0] > $thactualsize[1]) {
                                $mdimg->resize(320, null, function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                            } else {
                                $mdimg->resize(null, 320, function ($constraint) {
                                    $constraint->aspectRatio();
                                });
                            }
                            $thumbfile = 'format_' . $fileName;
                            $mdimg->save($copytofolder . $thumbfile);

                            $cmdata['temp_cover_img'] = $fileName;
                            $cmdata['temp_cover_img_masonry'] = $fileName;
                            $cmdata['updated'] = date('y-m-d');
                            \DB::table('tb_container')->where('id', $propImgFoldId)->update($cmdata);
                        }
                    }

                    $data['folder_id'] = $propImgFoldId;
                    $data['file_name'] = $fileName;
					$data['file_display_name'] = $fileNamedis;
                    $data['file_type'] = $file[0]->getClientMimeType();
                    $data['file_size'] = $file[0]->getClientSize();
                    $data['user_id'] = \Auth::user()->id;
                    $data['created'] = date('y-m-d h:i:s');
                    $data['path'] = $destinationPath;
                    $fileID = \DB::table('tb_container_files')->insertGetId($data);

                    $imgdata['property_id'] = $request->input('propId');
                    $imgdata['type'] = $imgFold;
                    $imgdata['file_id'] = $fileID;
                    if ($imgFold == 'Rooms Images') {
                        $imgdata['category_id'] = $request->input('category_id');
                    }
                    $imgdata['user_id'] = \Auth::user()->id;
                    $imgdata['created'] = date('y-m-d h:i:s');
                    $imgID = \DB::table('tb_properties_images')->insertGetId($imgdata);

                    $getupfile = \DB::table('tb_container_files')->where('id', $fileID)->first();
                    if (!empty($getupfile)) {
                        $getfilejson['files'][0]['id'] = $imgID;
                        $getfilejson['files'][0]['name'] = ($getupfile->file_display_name!='') ? $getupfile->file_display_name : $getupfile->file_name;
                        $getfilejson['files'][0]['size'] = $getupfile->file_size;
                        if ($getupfile->file_type == "application/pdf") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/bigpage_white_acrobat.png');
                        } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.word") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/doc.png');
                        } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.spre") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/xls.png');
                        } else {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/property_imgs_thumbs/' . $getupfile->file_name);
                        }
                        $getfilejson['files'][0]['type'] = $getupfile->file_type;
                        $getfilejson['files'][0]['url'] = (new ContainerController)->getThumbpath($getupfile->folder_id) . $getupfile->file_name;
                    }
                    return json_encode($getfilejson);
                }
            }
        }
    }

    function createNewFolder($Foldername, $ParentfolderId) {
        if ($Foldername != '') {
            $dirPath = (new ContainerController)->getContainerUserPath($ParentfolderId);
            $slug = \SiteHelpers::seoUrl(trim($Foldername));
            $result = \File::makeDirectory($dirPath . $slug, 0777, true);
            $fdata['parent_id'] = $ParentfolderId;
            $fdata['name'] = $slug;
            $fdata['display_name'] = $Foldername;
            $fdata['file_type'] = 'folder';
            $fdata['user_id'] = \Auth::user()->id;
            $fdata['created'] = date('y-m-d h:i:s');
            $fID = \DB::table('tb_container')->insertGetId($fdata);
            return $fID;
        } else {
            return false;
        }
    }

    function delete_property_image(Request $request) {
        $uid = \Auth::user()->id;
        $img_id = $request->input('img_id');
        $checkImg = \DB::table('tb_properties_images')->where('id', $img_id)->first();
        if (!empty($checkImg)) {
            $deleteEfile = (new ContainerController)->delete_allextra_files($checkImg->file_id, 'file');
            $deleteFile = \DB::table('tb_container_files')->where('id', $checkImg->file_id)->delete();
            $deleteImg = \DB::table('tb_properties_images')->where('id', $img_id)->delete();

            $res['status'] = 'success';
            return json_encode($res);
        } else {
            $res['status'] = 'error';
            return json_encode($res);
        }
    }

    function save_rooms_amenities(Request $request) {
        $uid = \Auth::user()->id;
        $rules['property_id'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data['property_id'] = $request->input('property_id');
            $data['cat_id'] = $request->input('category_id');
            $data['user_id'] = $uid;
            $data['amenities'] = $request->input('amenities_de');
            $data['amenities_eng'] = $request->input('amenities_eng');
            if (!empty($request->input('assigned_amenities'))) {
                $data['amenity_ids'] = implode(',', $request->input('assigned_amenities'));
            } else {
                $data['amenity_ids'] = '';
            }

            $check_pcats_exist = \DB::table('tb_properties_category_amenities')->where('property_id', $request->input('property_id'))->where('cat_id', $request->input('category_id'))->first();
            if (empty($check_pcats_exist)) {
                $data['created'] = date('Y-m-d h:i:s');
                $id = \DB::table('tb_properties_category_amenities')->insertGetId($data);
            } else {
                $data['updated'] = date('Y-m-d h:i:s');
                $id = \DB::table('tb_properties_category_amenities')->where('id', $check_pcats_exist->id)->update($data);
            }
            $desc = trim($request->input('room_amenities_desc'));
            if ($desc != '') {
                \DB::table('tb_properties_category_types')->where('property_id', $request->input('property_id'))->where('id', $request->input('category_id'))->update(["room_desc" => $desc]);
            }

            $res['status'] = 'success';
            return json_encode($res);
        } else {

            $res['status'] = 'error';
            $res['errors'] = $validator->errors()->all();
            return json_encode($res);
        }
    }

    //room prices

    function save_property_rooms_price_data(Request $request) {

        $uid = \Auth::user()->id;
        $rules['rack_rate'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $seasonidArr = $request->input('seasonid');
            if (!empty($seasonidArr)) {
                for ($s = 0; $s < count($seasonidArr); $s++) {
                    if ($request->input('rack_rate')[$s] != '' && $request->input('rack_rate')[$s] > 0) {
                        $data['property_id'] = $request->input('property_id');
                        $data['category_id'] = $request->input('category_id');
                        $data['user_id'] = $uid;
                        $data['season_id'] = $request->input('seasonid')[$s];
                        $data['rack_rate'] = $request->input('rack_rate')[$s];
                        $data['single_price'] = $request->input('single_price')[$s];
                        $data['extra_adult'] = $request->input('extra_adult')[$s];
                        $data['extra_junior'] = $request->input('extra_junior')[$s];
                        $data['extra_baby'] = $request->input('extra_baby')[$s];
                        $data['monday_price'] = $request->input('monday_price')[$s];
                        $data['tuesday_price'] = $request->input('tuesday_price')[$s];
                        $data['wednesday_price'] = $request->input('wednesday_price')[$s];
                        $data['thursday_price'] = $request->input('thursday_price')[$s];
                        $data['friday_price'] = $request->input('friday_price')[$s];
                        $data['saturday_price'] = $request->input('saturday_price')[$s];
                        $data['sunday_price'] = $request->input('sunday_price')[$s];

                        if ($request->input('edit_room_price_id')[$s] == '') {
                            $data['created'] = date('Y-m-d h:i:s');
                            $id = \DB::table('tb_properties_category_rooms_price')->insertGetId($data);
                        } else {
                            $data['updated'] = date('Y-m-d h:i:s');
                            $id = \DB::table('tb_properties_category_rooms_price')->where('id', $request->input('edit_room_price_id')[$s])->update($data);
                        }
                    }
                }
                $res['status'] = 'success';
                return json_encode($res);
            }
        } else {

            $res['status'] = 'error';
            $res['errors'] = $validator->errors()->all();
            return json_encode($res);
        }
    }

    function change_property_type() {
        $uid = \Auth::user()->id;
        $items = Input::get('row_ids');
        $type = Input::get('type');
        if ($items != '') {
            $expo = explode(',', $items);
            foreach ($expo as $itmexp) {
                $exist = \DB::table('tb_properties')->where('id', $itmexp)->count();
                if ($exist > 0) {
                    \DB::table('tb_properties')->where('id', $itmexp)->update(['property_type' => $type]);
                }
            }
            return "success";
        } else {
            return "error";
        }
    }

    function enable_diable_propertystatus() {
        $uid = \Auth::user()->id;
        $items = Input::get('row_id');
        $filed_name = Input::get('filed_name');
        $action = Input::get('action');
        if ($items != '') {
            $exist = \DB::table('tb_properties')->where('id', $items)->count();
            if ($exist > 0) {
                \DB::table('tb_properties')->where('id', $items)->update([$filed_name => $action]);

                return "success";
            } else {
                return "error";
            }
        } else {
            return "error";
        }
    }

    function get_category_rooms_reservations(Request $request) {
        $property_id = $request->input('pid');
        $caltype = $request->input('caltype');

        if ($property_id != '' && $property_id > 0) {
            $cats = array();
            $cat_types_temp = \DB::table('tb_properties_category_types')->where('property_id', $property_id)->where('status', 0);
            if ($caltype != 'all') {
                $cat_types_temp->where('id', $caltype);
            }
            $cat_types = $cat_types_temp->get();
            if (!empty($cat_types)) {
                $c = 0;
                $arrrooms = array();
                foreach ($cat_types as $type) {
                    $cat_rooms = \DB::table('tb_properties_category_rooms')->where('property_id', $property_id)->where('category_id', $type->id)->get();
                    if (!empty($cat_rooms)) {
                        $cats[$c]['data'] = $type;
                        foreach ($cat_rooms as $room) {
                            $cats[$c]['rooms'][] = $room;
                            //$arrrooms['room'] = $room;
                            //$reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_properties_category_rooms.room_name')->leftJoin('tb_properties_category_rooms', 'tb_reservations.room_id', '=', 'tb_properties_category_rooms.id')->where('tb_reservations.property_id', $property_id)->where('tb_reservations.room_id', $room->id)->get();
                            
                            //$arrrooms['reservation'] = $reservations;
                            
                            //$cats[$c]['rooms'][] = $arrrooms;
                        }
                        
                    }
                    
                    /* $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $property_id)->where('tb_properties_images.category_id', $type->id)->where('tb_properties_images.type', 'Rooms Images')->get();
                      $filen = array();
                      if(!empty($fileArr))
                      {
                      $f=0;
                      foreach($fileArr as $file)
                      {
                      $cats[$c]['imgs'][$f] = $file;
                      $cats[$c]['imgs'][$f]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                      $f++;
                      }
                      }

                      $cat_amenty = \DB::table('tb_properties_category_amenities')->where('property_id', $property_id)->where('cat_id', $type->id)->first();
                      if(!empty($cat_amenty))
                      {
                      $cats[$c]['amenty'] = $cat_amenty;
                      }

                      $cat_amenty = \DB::table('tb_properties_category_amenities')->where('property_id', $property_id)->where('cat_id', $type->id)->first();
                      if(!empty($cat_amenty))
                      {
                      $cats[$c]['amenties'] = $cat_amenty->amenity_ids;
                      } */
                    $c++;
                }
            }

            if (empty($cats)) {
                $res['status'] = 'error';
                $res['errors'] = 'No Room Added For This Property.';
                return json_encode($res);
            } else {
                $res['status'] = 'success';
                $res['cat_types'] = $cats;
                return json_encode($res);
            }
        } else {
            $res['status'] = 'error';
            $res['errors'] = 'Property Not Found.';
            return json_encode($res);
        }
    }

    //new reservation
    function add_new_reservation(Request $request) {
        $uid = \Auth::user()->id;
        $rules['staytype'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $clientdata = json_decode($request->input('clientData'));
            if ($clientdata->act == 'new') {
                $ctdata['client_title'] = $clientdata->title;
                $ctdata['client_company'] = $clientdata->company;
                $ctdata['client_firstname'] = $clientdata->firstname;
                $ctdata['client_lastname'] = $clientdata->lastname;
                $ctdata['client_email'] = $clientdata->email;
                $ctdata['client_cellphone'] = $clientdata->cellphone;
                $ctdata['client_country'] = $clientdata->country;
                $ctdata['client_comment'] = $clientdata->comment;
                $ctdata['client_status'] = 1;
                $ctdata['created_date'] = date('Y-m-d h:i:s');
                $ctdata['created_by'] = $uid;
                $ctid = \DB::table('tb_clients')->insertGetId($ctdata);
            } elseif ($clientdata->act == 'exist') {
                $ctid = $clientdata['id'];
            }

            $data['property_id'] = $request->input('property_id');
            $data['checkin_date'] = $request->input('chkin');
            $data['checkout_date'] = $request->input('chkout');
            $data['room_id'] = $request->input('roomid');
            $data['client_id'] = $ctid;
            $data['stay_type'] = $request->input('staytype');
            $data['source'] = $request->input('source');
            $data['comment'] = $request->input('comment');
            if (!is_null($request->input('pre'))) {
                $data['pre_reserve'] = 1;
            }
            $data['adult'] = $request->input('adult');
            $data['junior'] = $request->input('junior');
            $data['baby'] = $request->input('baby');
            $data['guest_names'] = $request->input('guest_list');
            $data['checkin_comment'] = $request->input('chkin_comment');
            $data['checkout_comment'] = $request->input('chkout_comment');
            if (!is_null($request->input('option1'))) {
                $data['option1'] = 1;
            }
            if (!is_null($request->input('option2'))) {
                $data['option2'] = 1;
            }
            $data['price'] = $request->input('price');
            $data['price_mode'] = $request->input('price_mode');
            $data['board'] = $request->input('board');
            $data['created_by'] = $uid;
            $data['created_date'] = date('Y-m-d h:i:s');
            $resid = \DB::table('tb_reservations')->insertGetId($data);

            $res['status'] = 'success';
            return json_encode($res);
        } else {

            $res['status'] = 'error';
            $res['errors'] = $validator->errors()->all();
            return json_encode($res);
        }
    }
	
	function delete_selectedproperty_image(Request $request) {
        $uid = \Auth::user()->id;
        $items = explode(',',$request->input('items'));
		if(!empty($items))
		{
			foreach($items as $item) 
			{
				$checkImg = \DB::table('tb_properties_images')->where('id', $item)->first();
				if (!empty($checkImg)) {
					$deleteEfile = (new ContainerController)->delete_allextra_files($checkImg->file_id, 'file');
					$deleteFile = \DB::table('tb_container_files')->where('id', $checkImg->file_id)->delete();
					$deleteImg = \DB::table('tb_properties_images')->where('id', $item)->delete();
				}
			}
			$res['status'] = 'success';
			$res['imgs'] = $items;
		}
		else {
			$res['status'] = 'error';
		}
		return json_encode($res);
    }
	
	function getPropertyRates(Request $request) {
        $uid = \Auth::user()->id;
        $propty = $request->input('propid');
		if($propty!='' && $propty > 0)
		{
			$cats = array();
			$cats['usercomm'] = \DB::table('tb_users')->select('commission')->where('id', $uid)->first();
			$cat_rooms_price = \DB::table('tb_properties_category_rooms_price')->leftJoin('tb_properties_category_types','tb_properties_category_types.id','=','tb_properties_category_rooms_price.category_id')->leftJoin('tb_seasons','tb_seasons.id','=','tb_properties_category_rooms_price.season_id')->select('tb_seasons.season_name','tb_properties_category_rooms_price.rack_rate','tb_properties_category_types.category_name')->where('tb_properties_category_rooms_price.property_id', $propty)->get();
			if (!empty($cat_rooms_price)) {
				$cats['cat_rooms'] = $cat_rooms_price;
			}
			$res['status'] = 'success';
			$res['cat_rooms_price'] = $cats;
		}
		else {
			$res['status'] = 'error';
		}
		return json_encode($res);
    }




     public function show_wetransfer() {
        $this->data['active'] = "";
        $this->data['pid'] = "43";
        $this->data['property_data'] = "";
   
        $this->data['spaimgs'] = "";
        return view('properties.wetest', $this->data);
      }

function property_images_wetransfer(Request $request) {

                    $checkDir = \DB::table('tb_container')->select('id')->where('name', 'locations')->first();
                
                    $propImgFoldId = "wetransfer";
                        
                    $destinationPath = (new ContainerController)->getContainerUserPath($propImgFoldId);
                    $file = $request->file('files');
                    // GET THE FILE EXTENSION
                    $extension = $file[0]->getClientOriginalExtension();
                    // RENAME THE UPLOAD WITH RANDOM NUMBER
                    $fileName = rand(1111111, 999999) . '-' .rand(11111, 999999) . '.' . $extension;
                    $fileNamedis = $file[0]->getClientOriginalName();
                    $ftname = explode('.', $fileName);
                    $exha = false;

                    for ($f = 1; $exha != true; $f++) {
                        if (\File::exists($destinationPath . $fileName)) {
                            $fileName = $ftname[0] . '(' . $f . ').' . $extension;
                        } else {
                            $fileName = $fileName;
                            $exha = true;
                        }
                    }
                    // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
                    $upload_success = $file[0]->move($destinationPath, $fileName);



                  $getupfile = \DB::table('tb_container_files')->where('id', 4202)->first();
                    if (!empty($getupfile)) {
                        $getfilejson['files'][0]['id'] =12 ;//$imgID;
                        $getfilejson['files'][0]['name'] = ($getupfile->file_display_name!='') ? $getupfile->file_display_name : $getupfile->file_name;
                        $getfilejson['files'][0]['size'] = $getupfile->file_size;
                        if ($getupfile->file_type == "application/pdf") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/bigpage_white_acrobat.png');
                        } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.word") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/doc.png');
                        } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.spre") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/xls.png');
                        } else {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/property_imgs_thumbs/' . $getupfile->file_name);
                        }
                        $getfilejson['files'][0]['type'] = $getupfile->file_type;
                        $getfilejson['files'][0]['url'] = (new ContainerController)->getThumbpath($getupfile->folder_id) . $getupfile->file_name;
                    }
                    return json_encode($getfilejson);

             }
             
    function enable_diable_hotelApproval() {
        $uid = \Auth::user()->id;
        $items = Input::get('row_id');
        $filed_name = Input::get('filed_name');
        $action = Input::get('action');
        if ($items != '') {
            $exist = \DB::table('tb_properties')->where('id', $items)->first();
            //print_r($exist); die;
            if (!empty($exist)) {
                $usr_id= $exist->user_id;
                \DB::table('tb_properties')->where('id', $items)->update([$filed_name => $action]);
                
                $email_user = \DB::table('tb_users')->where('id', $usr_id)->first();
                                
                $edata = array();
                $emlData['frmemail'] = 'marketing@emporium-voyage.com';                
                $emlData['email'] = $email_user->email;
                $emlData['subject'] = 'Property Approval';                
                
                if($action==1){                     
                    $file_name = 'user.emails.hotel_approval';
                }else{                      
                    $file_name = 'user.emails.hotel_unapproval';
                }
                
                \Mail::send($file_name, $edata, function($message) use ($emlData) {
                    $message->from($emlData['frmemail'], CNF_APPNAME);

                    $message->to($emlData['email']);

                    $message->subject($emlData['subject']);
                });
                
                return "success";
            } else {
                return "error";
            }
        } else {
            return "error";
        }
    }
                                       
    public function updateHotelInfo(Request $request){
        $uid = \Auth::user()->id;
        $id = $request->input('id');
        
        $rules = array(
            'property_name' => 'required',
            'property_type' => 'required',
            'booking_type' => 'required',         
        );
        //        
        $validator = Validator::make($request->all(), $rules);

        //print_r($validator);        
        if ($validator->passes()) { 
            //$data = $this->validatePost('tb_properties');
            $alias = \SiteHelpers::seoUrl(Input::get('property_short_name'));
            $exha = false;
            for ($f = 1; $exha != true; $f++) {
                if ($request->input('id') == '') {
                    $check_alias = \DB::table('tb_properties')->where('property_slug', $alias)->count();
                } else {
                    $check_alias = \DB::table('tb_properties')->where('property_slug', $alias)->where('id', '!=', $id)->count();
                }
                if ($check_alias > 0) {
                    $alias = $alias . '-' . $f;
                } else {
                    $alias = $alias;
                    $exha = true;
                }
            }
            $data['user_id'] = $uid;
            $data['property_slug'] = $alias;

            if ($request->input('id') == '') {
                $data['created'] = date('Y-m-d h:i:s');
            } else {
                $data['updated'] = date('Y-m-d h:i:s');
            }
            $data['property_name'] = $request->input('property_name');
            $data['property_short_name'] = $request->input('property_short_name');
            $data['property_type'] = $request->input('property_type');
            $data['booking_type'] = $request->input('booking_type');
            
            $data['city_tax'] = $request->input('city_tax');
            $data['commission'] = $request->input('commission');
            $data['about_property'] = $request->input('about_property');
            $data['property_usp'] = $request->input('property_usp');
            $data['assigned_user_id'] = $request->input('assigned_user_id');
            
            
            
            $data['commission'] = $request->input('commission');
            $data['about_property'] = $request->input('about_property');
            $data['property_usp'] = $request->input('property_usp');
            $data['assigned_user_id'] = $request->input('assigned_user_id');            
            

            if (!empty($request->input('assigned_amenities'))) {
                $data['assign_amenities'] = implode(',', $request->input('assigned_amenities'));
            } else {
                $data['assign_amenities'] = '';
            }

            if (!is_null($request->input('copy_amenities_rooms'))) {
                $data['copy_amenities_rooms'] = $request->input('copy_amenities_rooms');
            } else {
                $data['copy_amenities_rooms'] = 0;
            }

            if (!empty($request->input('destinations'))) {
                $data['property_category_id'] = implode(',', $request->input('destinations'));
            } else {
                $data['property_category_id'] = '';
            }


            if (!is_null($request->input('default_seasons'))) {
                $data['default_seasons'] = $request->input('default_seasons');
            } else {
                $data['default_seasons'] = 0;
            }
            
            $data['detail_section1_title'] = $request->input('detail_section1_title');
            $data['detail_section1_description_box1'] = $request->input('detail_section1_description_box1');
            $data['detail_section1_description_box2'] = $request->input('detail_section1_description_box2');
            $data['detail_section2_title'] = $request->input('detail_section2_title');
            $data['detail_section2_description_box1'] = $request->input('detail_section2_description_box1');
            $data['detail_section2_description_box2'] = $request->input('detail_section2_description_box2');
            $data['assign_detail_city'] = $request->input('assign_detail_city');

            
            
			
			if (!is_null($request->input('feature_property'))) {
                $data['feature_property'] = $request->input('feature_property');
            } else {
                $data['feature_property'] = 0;
            }
			
			if (!is_null($request->input('editor_choice_property'))) {
                $data['editor_choice_property'] = $request->input('editor_choice_property');
            } else {
                $data['editor_choice_property'] = 0;
            }

            
			
			if (!empty($request->input('spaids'))) {
                $data['spa_ids'] = implode(',', $request->input('spaids'));
            } else {
                $data['spa_ids'] = '';
            }
			
			if (!empty($request->input('restaurantids'))) {
                $data['restaurant_ids'] = implode(',', $request->input('restaurantids'));
            } else {
                $data['restaurant_ids'] = '';
            }
			
			if (!empty($request->input('barids'))) {
                $data['bar_ids'] = implode(',', $request->input('barids'));
            } else {
                $data['bar_ids'] = '';
            }

            // Yachts info tab
            if ($request->input('property_type') == 'Yachts') {
                $yacht_category = $request->input('yacht_category');
                $data['yacht_category'] = implode(', ', $yacht_category);
                $data['yacht_build_year'] = $request->input('yacht_build_year');
                $data['yachts_guest'] = $request->input('yachts_guest');
                $data['yacht_length'] = $request->input('yacht_length');
                if (!empty($request->input('yacht_builder'))) {
                    $data['yacht_builder'] = implode(',', $request->input('yacht_builder'));
                }
                $data['yacht_beam'] = $request->input('yacht_beam');
                $data['yacht_draft'] = $request->input('yacht_draft');
                $data['yacht_grt'] = $request->input('yacht_grt');
                $data['yacht_cabins'] = $request->input('yacht_cabins');
                $data['yacht_crew'] = $request->input('yacht_crew');
                $data['yacht_for_sale'] = $request->input('yacht_for_sale');
                $data['yacht_for_charter'] = $request->input('yacht_for_charter');
            }

            $destinationPath = public_path() . '/uploads/properties_subtab_imgs/';

            //room & suites tab
            $data['rooms_suites_title'] = $request->input('rooms_suites_title');
            $data['rooms_suites_desciription'] = $request->input('rooms_suites_desciription');
            if ($request->input('rooms_suites_video_type') != '') {
                $data['rooms_suites_video_type'] = $request->input('rooms_suites_video_type');
            }
            if ($request->input('rooms_suites_video_link_type') != '') {
                $data['rooms_suites_video_link_type'] = $request->input('rooms_suites_video_link_type');
            }
            $data['rooms_suites_video_link'] = $request->input('rooms_suites_video_link');
            if (!is_null($request->file('rooms_suites_image'))) {
                $file = $request->file('rooms_suites_image');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); //if you need extension of the file
                $room_suites_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $extension;
                $uploadSuccess = $file->move($destinationPath, $room_suites_filename);
                if ($uploadSuccess) {
                    $data['rooms_suites_image'] = $room_suites_filename;
                }
            }

            if (!is_null($request->file('rooms_suites_video'))) {
                $room_suites_vfile = $request->file('rooms_suites_video');
                $room_suites_vfilename = $room_suites_vfile->getClientOriginalName();
                $room_suites_vextension = $room_suites_vfile->getClientOriginalExtension(); //if you need extension of the file
                $room_suites_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $room_suites_vextension;
                $room_suites_vuploadSuccess = $room_suites_vfile->move($destinationPath, $room_suites_videofilename);
                if ($room_suites_vuploadSuccess) {
                    $data['rooms_suites_video'] = $room_suites_videofilename;
                }
            }
            //room & suites end
            // Architechure 
            $data['architecture_title'] = $request->input('architecture_title');
            $data['architecture_desciription'] = $request->input('architecture_desciription');
            if ($request->input('architecture_video_type') != '') {
                $data['architecture_video_type'] = $request->input('architecture_video_type');
            }
            if ($request->input('architecture_video_link_type') != '') {
                $data['architecture_video_link_type'] = $request->input('architecture_video_link_type');
            }
            $data['architecture_video_link'] = $request->input('architecture_video_link');
            if (!empty($request->input('assigned_architecture_designer'))) {
                $data['assigned_architecture_designer'] = implode(',', $request->input('assigned_architecture_designer'));
            }
            if (!is_null($request->file('architecture_image'))) {
                $architecture_file = $request->file('architecture_image');
                $architecture_filename = $architecture_file->getClientOriginalName();
                $architecture_extension = $architecture_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_extension;
                $architecture_uploadSuccess = $architecture_file->move($destinationPath, $architecture_filename);
                if ($architecture_uploadSuccess) {
                    $data['architecture_image'] = $architecture_filename;
                }
            }

            if (!is_null($request->file('architecture_video'))) {
                $architecture_vfile = $request->file('architecture_video');
                $architecture_vfilename = $architecture_vfile->getClientOriginalName();
                $architecture_vextension = $architecture_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_vextension;
                $architecture_vuploadSuccess = $architecture_vfile->move($destinationPath, $architecture_videofilename);
                if ($architecture_vuploadSuccess) {
                    $data['architecture_video'] = $architecture_videofilename;
                }
            }

            // Design 
            $data['architecture_design_title'] = $request->input('architecture_design_title');
            $data['architecture_design_desciription'] = $request->input('architecture_design_desciription');
            $data['architecture_design_url'] = $request->input('architecture_design_url');
            if ($request->input('architecture_design_video_type') != '') {
                $data['architecture_design_video_type'] = $request->input('architecture_design_video_type');
            }
            if ($request->input('architecture_design_video_link_type') != '') {
                $data['architecture_design_video_link_type'] = $request->input('architecture_design_video_link_type');
            }
            $data['architecture_design_video_link'] = $request->input('architecture_design_video_link');
            if (!is_null($request->file('architecture_design_image'))) {
                $architecture_design_file = $request->file('architecture_design_image');
                $architecture_design_filename = $architecture_design_file->getClientOriginalName();
                $architecture_design_extension = $architecture_design_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_design_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_design_extension;
                $architecture_design_uploadSuccess = $architecture_design_file->move($destinationPath, $architecture_design_filename);
                if ($architecture_design_uploadSuccess) {
                    $data['architecture_design_image'] = $architecture_design_filename;
                }
            }

            if (!is_null($request->file('architecture_design_video'))) {
                $architecture_design_vfile = $request->file('architecture_designer_video');
                $architecture_design_vfilename = $architecture_design_vfile->getClientOriginalName();
                $architecture_design_vextension = $architecture_design_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_design_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_design_vextension;
                $architecture_design_vuploadSuccess = $architecture_design_vfile->move($destinationPath, $architecture_design_videofilename);
                if ($architecture_design_vuploadSuccess) {
                    $data['architecture_design_video'] = $architecture_design_videofilename;
                }
            }

            // Designer
            $data['architecture_designer_title'] = $request->input('architecture_designer_title');
            $data['architecture_designer_desciription'] = $request->input('architecture_designer_desciription');
            $data['architecture_designer_url'] = $request->input('architecture_designer_url');
            if (!empty($request->input('architecture_designer_designer'))) {
                $data['architecture_designer_designer'] = implode(',', $request->input('architecture_designer_designer'));
            }
            if ($request->input('architecture_designer_video_type') != '') {
                $data['architecture_designer_video_type'] = $request->input('architecture_designer_video_type');
            }
            if ($request->input('architecture_designer_video_link_type') != '') {
                $data['architecture_designer_video_link_type'] = $request->input('architecture_designer_video_link_type');
            }
            $data['architecture_designer_video_link'] = $request->input('architecture_designer_video_link');

            if (!is_null($request->file('architecture_designer_image'))) {
                $architecture_designer_file = $request->file('architecture_designer_image');
                $architecture_designer_filename = $architecture_designer_file->getClientOriginalName();
                $architecture_designer_extension = $architecture_designer_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_designer_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_designer_extension;
                $architecture_designer_uploadSuccess = $architecture_designer_file->move($destinationPath, $architecture_designer_filename);
                if ($architecture_designer_uploadSuccess) {
                    $data['architecture_designer_image'] = $architecture_designer_filename;
                }
            }

            if (!is_null($request->file('architecture_designer_video'))) {
                $architecture_designer_vfile = $request->file('architecture_designer_video');
                $architecture_designer_vfilename = $architecture_designer_vfile->getClientOriginalName();
                $architecture_designer_vextension = $architecture_designer_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_designer_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_designer_vextension;
                $architecture_designer_vuploadSuccess = $architecture_designer_vfile->move($destinationPath, $architecture_designer_videofilename);
                if ($architecture_designer_vuploadSuccess) {
                    $data['architecture_designer_video'] = $architecture_designer_videofilename;
                }
            }

            // Spas
            $data['spa_title'] = $request->input('spa_title');
            $data['spa_desciription'] = $request->input('spa_desciription');
            $data['spa_url'] = $request->input('spa_url');
            $data['spa_usp_text'] = $request->input('spa_usp_text');
            $data['spa_usp_person'] = $request->input('spa_usp_person');
            $data['spa_manager_text'] = $request->input('spa_manager_text');
            $data['spa_opening_hours'] = $request->input('spa_opening_hours');
            $data['spa_phone_number'] = $request->input('spa_phone_number');
            if (!empty($request->input('spa_designer'))) {
                $data['spa_designer'] = implode(',', $request->input('spa_designer'));
            }
            if ($request->input('spa_video_type') != '') {
                $data['spa_video_type'] = $request->input('spa_video_type');
            }
            if ($request->input('spa_video_link_type') != '') {
                $data['spa_video_link_type'] = $request->input('spa_video_link_type');
            }
            $data['spa_video_link'] = $request->input('spa_video_link');
            if (!is_null($request->file('spa_image1'))) {
                $spa_file = $request->file('spa_image1');
                $spa_filename = $spa_file->getClientOriginalName();
                $spa_extension = $spa_file->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension;
                $spa_uploadSuccess = $spa_file->move($destinationPath, $spa_filename);
                if ($spa_uploadSuccess) {
                    $data['spa_image1'] = $spa_filename;
                }
            }

            if (!is_null($request->file('spa_image2'))) {
                $spa_file2 = $request->file('spa_image2');
                $spa_filename2 = $spa_file2->getClientOriginalName();
                $spa_extension2 = $spa_file2->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension2;
                $spa_uploadSuccess2 = $spa_file2->move($destinationPath, $spa_filename2);
                if ($spa_uploadSuccess2) {
                    $data['spa_image2'] = $spa_filename2;
                }
            }

            if (!is_null($request->file('spa_image3'))) {
                $spa_file3 = $request->file('spa_image3');
                $spa_filename3 = $spa_file3->getClientOriginalName();
                $spa_extension3 = $spa_file3->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension3;
                $spa_uploadSuccess3 = $spa_file3->move($destinationPath, $spa_filename3);
                if ($spa_uploadSuccess3) {
                    $data['spa_image3'] = $spa_filename3;
                }
            }

            if (!is_null($request->file('spa_image4'))) {
                $spa_file4 = $request->file('spa_image4');
                $spa_filename4 = $spa_file4->getClientOriginalName();
                $spa_extension4 = $spa_file4->getClientOriginalExtension(); //if you need extension of the file
                $spa_filename4 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_extension4;
                $spa_uploadSuccess4 = $spa_file4->move($destinationPath, $spa_filename4);
                if ($spa_uploadSuccess4) {
                    $data['spa_image4'] = $spa_filename4;
                }
            }

            if (!is_null($request->file('spa_video'))) {
                $spa_vfile = $request->file('spa_video');
                $spa_vfilename = $spa_vfile->getClientOriginalName();
                $spa_vextension = $spa_vfile->getClientOriginalExtension(); //if you need extension of the file
                $spa_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $spa_vextension;
                $spa_vuploadSuccess = $spa_vfile->move($destinationPath, $spa_videofilename);
                if ($spa_vuploadSuccess) {
                    $data['spa_video'] = $spa_videofilename;
                }
            }

            // Resturants
            $data['restaurant_title'] = $request->input('restaurant_title');
            $data['restaurant_desciription'] = $request->input('restaurant_desciription');
            $data['restaurant_url'] = $request->input('restaurant_url');
            $data['restaurant_usp_text'] = $request->input('restaurant_usp_text');
            $data['restaurant_usp_person'] = $request->input('restaurant_usp_person');
            if (!empty($request->input('restaurant_designer'))) {
                $data['restaurant_designer'] = implode(',', $request->input('restaurant_designer'));
            }
            if ($request->input('restaurant_video_type') != '') {
                $data['restaurant_video_type'] = $request->input('restaurant_video_type');
            }
            if ($request->input('restaurant_video_link_type') != '') {
                $data['restaurant_video_link_type'] = $request->input('restaurant_video_link_type');
            }
            $data['restaurant_video_link'] = $request->input('restaurant_video_link');
            if (!is_null($request->file('restaurant_image'))) {
                $restaurant_file = $request->file('restaurant_image');
                $restaurant_filename = $restaurant_file->getClientOriginalName();
                $restaurant_extension = $restaurant_file->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_extension;
                $restaurant_uploadSuccess = $restaurant_file->move($destinationPath, $restaurant_filename);
                if ($restaurant_uploadSuccess) {
                    $data['restaurant_image'] = $restaurant_filename;
                }
            }

            if (!is_null($request->file('restaurant_image2'))) {
                $restaurant_file2 = $request->file('restaurant_image2');
                $restaurant_filename2 = $restaurant_file2->getClientOriginalName();
                $restaurant_extension2 = $restaurant_file2->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_extension2;
                $restaurant_uploadSuccess2 = $restaurant_file2->move($destinationPath, $restaurant_filename2);
                if ($restaurant_uploadSuccess2) {
                    $data['restaurant_image2'] = $restaurant_filename2;
                }
            }

            if (!is_null($request->file('restaurant_video'))) {
                $restaurant_vfile = $request->file('restaurant_video');
                $restaurant_vfilename = $restaurant_vfile->getClientOriginalName();
                $restaurant_vextension = $restaurant_vfile->getClientOriginalExtension(); //if you need extension of the file
                $restaurant_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant_vextension;
                $restaurant_vuploadSuccess = $restaurant_vfile->move($destinationPath, $restaurant_videofilename);
                if ($restaurant_vuploadSuccess) {
                    $data['restaurant_video'] = $restaurant_videofilename;
                }
            }

            //resturant 2

            $data['restaurant2_title'] = $request->input('restaurant2_title');
            $data['restaurant2_desciription'] = $request->input('restaurant2_desciription');
            $data['restaurant2_url'] = $request->input('restaurant2_url');
            $data['restaurant2_usp_text'] = $request->input('restaurant2_usp_text');
            $data['restaurant2_usp_person'] = $request->input('restaurant2_usp_person');
            if (!empty($request->input('restaurant2_designer'))) {
                $data['restaurant2_designer'] = implode(',', $request->input('restaurant2_designer'));
            }
            if ($request->input('restaurant2_video_type') != '') {
                $data['restaurant2_video_type'] = $request->input('restaurant2_video_type');
            }
            if ($request->input('restaurant2_video_link_type') != '') {
                $data['restaurant2_video_link_type'] = $request->input('restaurant2_video_link_type');
            }
            $data['restaurant2_video_link'] = $request->input('restaurant2_video_link');
            if (!is_null($request->file('restaurant2_image'))) {
                $restaurant2_file = $request->file('restaurant2_image');
                $restaurant2_filename = $restaurant2_file->getClientOriginalName();
                $restaurant2_extension = $restaurant2_file->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_extension;
                $restaurant2_uploadSuccess = $restaurant2_file->move($destinationPath, $restaurant2_filename);
                if ($restaurant2_uploadSuccess) {
                    $data['restaurant2_image'] = $restaurant2_filename;
                }
            }

            if (!is_null($request->file('restaurant2_image2'))) {
                $restaurant2_file2 = $request->file('restaurant2_image2');
                $restaurant2_filename2 = $restaurant2_file2->getClientOriginalName();
                $restaurant2_extension2 = $restaurant2_file2->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_extension2;
                $restaurant2_uploadSuccess2 = $restaurant2_file2->move($destinationPath, $restaurant2_filename2);
                if ($restaurant2_uploadSuccess2) {
                    $data['restaurant2_image2'] = $restaurant2_filename2;
                }
            }

            if (!is_null($request->file('restaurant2_video'))) {
                $restaurant2_vfile = $request->file('restaurant2_video');
                $restaurant2_vfilename = $restaurant2_vfile->getClientOriginalName();
                $restaurant2_vextension = $restaurant2_vfile->getClientOriginalExtension(); //if you need extension of the file
                $restaurant2_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant2_vextension;
                $restaurant2_vuploadSuccess = $restaurant2_vfile->move($destinationPath, $restaurant2_videofilename);
                if ($restaurant2_vuploadSuccess) {
                    $data['restaurant2_video'] = $restaurant2_videofilename;
                }
            }
			
			//resturant 3

            $data['restaurant3_title'] = $request->input('restaurant3_title');
            $data['restaurant3_desciription'] = $request->input('restaurant3_desciription');
            $data['restaurant3_url'] = $request->input('restaurant3_url');
            $data['restaurant3_usp_text'] = $request->input('restaurant3_usp_text');
            $data['restaurant3_usp_person'] = $request->input('restaurant3_usp_person');
            if (!empty($request->input('restaurant3_designer'))) {
                $data['restaurant3_designer'] = implode(',', $request->input('restaurant3_designer'));
            }
            if ($request->input('restaurant3_video_type') != '') {
                $data['restaurant3_video_type'] = $request->input('restaurant3_video_type');
            }
            if ($request->input('restaurant3_video_link_type') != '') {
                $data['restaurant3_video_link_type'] = $request->input('restaurant3_video_link_type');
            }
            $data['restaurant3_video_link'] = $request->input('restaurant3_video_link');
            if (!is_null($request->file('restaurant3_image'))) {
                $restaurant3_file = $request->file('restaurant3_image');
                $restaurant3_filename = $restaurant3_file->getClientOriginalName();
                $restaurant3_extension = $restaurant3_file->getClientOriginalExtension(); //if you need extension of the file
                $restaurant3_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant3_extension;
                $restaurant3_uploadSuccess = $restaurant3_file->move($destinationPath, $restaurant3_filename);
                if ($restaurant3_uploadSuccess) {
                    $data['restaurant3_image'] = $restaurant3_filename;
                }
            }

            if (!is_null($request->file('restaurant3_image2'))) {
                $restaurant3_file2 = $request->file('restaurant3_image2');
                $restaurant3_filename2 = $restaurant3_file2->getClientOriginalName();
                $restaurant3_extension2 = $restaurant3_file2->getClientOriginalExtension(); //if you need extension of the file
                $restaurant3_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant3_extension2;
                $restaurant3_uploadSuccess2 = $restaurant3_file2->move($destinationPath, $restaurant3_filename2);
                if ($restaurant3_uploadSuccess2) {
                    $data['restaurant3_image2'] = $restaurant3_filename2;
                }
            }

            if (!is_null($request->file('restaurant3_video'))) {
                $restaurant3_vfile = $request->file('restaurant3_video');
                $restaurant3_vfilename = $restaurant3_vfile->getClientOriginalName();
                $restaurant3_vextension = $restaurant3_vfile->getClientOriginalExtension(); //if you need extension of the file
                $restaurant3_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $restaurant3_vextension;
                $restaurant3_vuploadSuccess = $restaurant3_vfile->move($destinationPath, $restaurant3_videofilename);
                if ($restaurant3_vuploadSuccess) {
                    $data['restaurant3_video'] = $restaurant3_videofilename;
                }
            }

            // bar
            $data['bar_title'] = $request->input('bar_title');
            $data['bar_sub_title'] = $request->input('bar_sub_title');
            $data['bar_desciription'] = $request->input('bar_desciription');
            $data['bar_url'] = $request->input('bar_url');
            $data['bar_usp_text'] = $request->input('bar_usp_text');
            $data['bar_usp_person'] = $request->input('bar_usp_person');
            if (!empty($request->input('bar_designer'))) {
                $data['bar_designer'] = implode(',', $request->input('bar_designer'));
            }
            if ($request->input('bar_video_type') != '') {
                $data['bar_video_type'] = $request->input('bar_video_type');
            }
            if ($request->input('bar_video_link_type') != '') {
                $data['bar_video_link_type'] = $request->input('bar_video_link_type');
            }
            $data['bar_video_link'] = $request->input('bar_video_link');
            if (!is_null($request->file('bar_image'))) {
                $bar_file = $request->file('bar_image');
                $bar_filename = $bar_file->getClientOriginalName();
                $bar_extension = $bar_file->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension;
                $bar_uploadSuccess = $bar_file->move($destinationPath, $bar_filename);
                if ($bar_uploadSuccess) {
                    $data['bar_image'] = $bar_filename;
                }
            }

            if (!is_null($request->file('bar_image2'))) {
                $bar_file2 = $request->file('bar_image2');
                $bar_filename2 = $bar_file2->getClientOriginalName();
                $bar_extension2 = $bar_file2->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension2;
                $bar_uploadSuccess2 = $bar_file2->move($destinationPath, $bar_filename2);
                if ($bar_uploadSuccess2) {
                    $data['bar_image2'] = $bar_filename2;
                }
            }

            if (!is_null($request->file('bar_image3'))) {
                $bar_file3 = $request->file('bar_image3');
                $bar_filename3 = $bar_file3->getClientOriginalName();
                $bar_extension3 = $bar_file3->getClientOriginalExtension(); //if you need extension of the file
                $bar_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_extension3;
                $bar_uploadSuccess3 = $bar_file3->move($destinationPath, $bar_filename3);
                if ($bar_uploadSuccess3) {
                    $data['bar_image3'] = $bar_filename3;
                }
            }

            if (!is_null($request->file('bar_video'))) {
                $bar_vfile = $request->file('bar_video');
                $bar_vfilename = $bar_vfile->getClientOriginalName();
                $bar_vextension = $bar_vfile->getClientOriginalExtension(); //if you need extension of the file
                $bar_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar_vextension;
                $bar_vuploadSuccess = $bar_vfile->move($destinationPath, $bar_videofilename);
                if ($bar_vuploadSuccess) {
                    $data['bar_video'] = $bar_videofilename;
                }
            }
			
			// bar 2
            $data['bar2_title'] = $request->input('bar2_title');
            $data['bar2_sub_title'] = $request->input('bar2_sub_title');
            $data['bar2_desciription'] = $request->input('bar2_desciription');
            $data['bar2_url'] = $request->input('bar2_url');
            $data['bar2_usp_text'] = $request->input('bar2_usp_text');
            $data['bar2_usp_person'] = $request->input('bar2_usp_person');
            if (!empty($request->input('bar2_designer'))) {
                $data['bar2_designer'] = implode(',', $request->input('bar2_designer'));
            }
            if ($request->input('bar2_video_type') != '') {
                $data['bar2_video_type'] = $request->input('bar2_video_type');
            }
            if ($request->input('bar2_video_link_type') != '') {
                $data['bar2_video_link_type'] = $request->input('bar2_video_link_type');
            }
            $data['bar2_video_link'] = $request->input('bar2_video_link');
            if (!is_null($request->file('bar2_image'))) {
                $bar2_file = $request->file('bar2_image');
                $bar2_filename = $bar2_file->getClientOriginalName();
                $bar2_extension = $bar2_file->getClientOriginalExtension(); //if you need extension of the file
                $bar2_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_extension;
                $bar2_uploadSuccess = $bar2_file->move($destinationPath, $bar2_filename);
                if ($bar2_uploadSuccess) {
                    $data['bar2_image'] = $bar2_filename;
                }
            }

            if (!is_null($request->file('bar2_image2'))) {
                $bar2_file2 = $request->file('bar2_image2');
                $bar2_filename2 = $bar2_file2->getClientOriginalName();
                $bar2_extension2 = $bar2_file2->getClientOriginalExtension(); //if you need extension of the file
                $bar2_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_extension2;
                $bar2_uploadSuccess2 = $bar2_file2->move($destinationPath, $bar2_filename2);
                if ($bar2_uploadSuccess2) {
                    $data['bar2_image2'] = $bar2_filename2;
                }
            }

            if (!is_null($request->file('bar2_image3'))) {
                $bar2_file3 = $request->file('bar2_image3');
                $bar2_filename3 = $bar2_file3->getClientOriginalName();
                $bar2_extension3 = $bar2_file3->getClientOriginalExtension(); //if you need extension of the file
                $bar2_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_extension3;
                $bar2_uploadSuccess3 = $bar2_file3->move($destinationPath, $bar2_filename3);
                if ($bar2_uploadSuccess3) {
                    $data['bar2_image3'] = $bar2_filename3;
                }
            }

            if (!is_null($request->file('bar2_video'))) {
                $bar2_vfile = $request->file('bar2_video');
                $bar2_vfilename = $bar2_vfile->getClientOriginalName();
                $bar2_vextension = $bar2_vfile->getClientOriginalExtension(); //if you need extension of the file
                $bar2_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar2_vextension;
                $bar2_vuploadSuccess = $bar2_vfile->move($destinationPath, $bar2_videofilename);
                if ($bar2_vuploadSuccess) {
                    $data['bar2_video'] = $bar2_videofilename;
                }
            }
			
			// bar 3
            $data['bar3_title'] = $request->input('bar3_title');
            $data['bar3_sub_title'] = $request->input('bar3_sub_title');
            $data['bar3_desciription'] = $request->input('bar3_desciription');
            $data['bar3_url'] = $request->input('bar3_url');
            $data['bar3_usp_text'] = $request->input('bar3_usp_text');
            $data['bar3_usp_person'] = $request->input('bar3_usp_person');
            if (!empty($request->input('bar3_designer'))) {
                $data['bar3_designer'] = implode(',', $request->input('bar3_designer'));
            }
            if ($request->input('bar3_video_type') != '') {
                $data['bar3_video_type'] = $request->input('bar3_video_type');
            }
            if ($request->input('bar3_video_link_type') != '') {
                $data['bar3_video_link_type'] = $request->input('bar3_video_link_type');
            }
            $data['bar3_video_link'] = $request->input('bar3_video_link');
            if (!is_null($request->file('bar3_image'))) {
                $bar3_file = $request->file('bar3_image');
                $bar3_filename = $bar3_file->getClientOriginalName();
                $bar3_extension = $bar3_file->getClientOriginalExtension(); //if you need extension of the file
                $bar3_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_extension;
                $bar3_uploadSuccess = $bar3_file->move($destinationPath, $bar3_filename);
                if ($bar3_uploadSuccess) {
                    $data['bar3_image'] = $bar3_filename;
                }
            }

            if (!is_null($request->file('bar3_image2'))) {
                $bar3_file2 = $request->file('bar3_image2');
                $bar3_filename2 = $bar3_file2->getClientOriginalName();
                $bar3_extension2 = $bar3_file2->getClientOriginalExtension(); //if you need extension of the file
                $bar3_filename2 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_extension2;
                $bar3_uploadSuccess2 = $bar3_file2->move($destinationPath, $bar3_filename2);
                if ($bar3_uploadSuccess2) {
                    $data['bar3_image2'] = $bar3_filename2;
                }
            }

            if (!is_null($request->file('bar3_image3'))) {
                $bar3_file3 = $request->file('bar3_image3');
                $bar3_filename3 = $bar3_file3->getClientOriginalName();
                $bar3_extension3 = $bar3_file3->getClientOriginalExtension(); //if you need extension of the file
                $bar3_filename3 = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_extension3;
                $bar3_uploadSuccess3 = $bar3_file3->move($destinationPath, $bar3_filename3);
                if ($bar3_uploadSuccess3) {
                    $data['bar3_image3'] = $bar3_filename3;
                }
            }

            if (!is_null($request->file('bar3_video'))) {
                $bar3_vfile = $request->file('bar3_video');
                $bar3_vfilename = $bar3_vfile->getClientOriginalName();
                $bar3_vextension = $bar3_vfile->getClientOriginalExtension(); //if you need extension of the file
                $bar3_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $bar3_vextension;
                $bar3_vuploadSuccess = $bar3_vfile->move($destinationPath, $bar3_videofilename);
                if ($bar3_vuploadSuccess) {
                    $data['bar3_video'] = $bar3_videofilename;
                }
            }

            // Video section
            $data['video_title'] = $request->input('video_title');
            $data['video_desciription'] = $request->input('video_desciription');
            $data['video_sub_title'] = $request->input('video_sub_title');
            if ($request->input('video_type') != '') {
                $data['video_type'] = $request->input('video_type');
            }
            if ($request->input('video_link_type') != '') {
                $data['video_link_type'] = $request->input('video_link_type');
            }
            $data['video_link'] = $request->input('video_link');
            if (!is_null($request->file('video_image'))) {
                $video_file = $request->file('video_image');
                $video_filename = $video_file->getClientOriginalName();
                $video_extension = $video_file->getClientOriginalExtension(); //if you need extension of the file
                $video_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $video_extension;
                $video_uploadSuccess = $video_file->move($destinationPath, $video_filename);
                if ($video_uploadSuccess) {
                    $data['video_image'] = $video_filename;
                }
            }

            if (!is_null($request->file('video_video'))) {
                $video_vfile = $request->file('video_video');
                $video_vfilename = $video_vfile->getClientOriginalName();
                $video_vextension = $video_vfile->getClientOriginalExtension(); //if you need extension of the file
                $video_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $video_vextension;
                $video_vuploadSuccess = $video_vfile->move($destinationPath, $video_videofilename);
                if ($video_vuploadSuccess) {
                    $data['video_video'] = $video_videofilename;
                }
            }

            $id = $this->model->insertRow($data, $request->input('id'));

            if (!is_null($request->input('copy_amenities_rooms')) && !empty($request->input('assigned_amenities'))) {
                $check_pcats = \DB::table('tb_properties_category_types')->where('property_id', $id)->get();
                if (!empty($check_pcats)) {
                    foreach ($check_pcats as $pcats) {
                        $check_pcats_exist = \DB::table('tb_properties_category_amenities')->where('property_id', $id)->where('cat_id', $pcats->id)->first();
                        $Amdata['property_id'] = $id;
                        $Amdata['cat_id'] = $pcats->id;
                        $Amdata['user_id'] = $uid;
                        $Amdata['amenity_ids'] = implode(',', $request->input('assigned_amenities'));
                        if (!empty($check_pcats_exist)) {
                            $Amdata['updated'] = date('Y-m-d h:i:s');
                            \DB::table('tb_properties_category_amenities')->where('id', $check_pcats_exist->id)->update($Amdata);
                        } else {
                            $Amdata['created'] = date('Y-m-d h:i:s');
                            \DB::table('tb_properties_category_amenities')->insertGetId($Amdata);
                        }
                    }
                }
            }


            if (!is_null($request->input('apply'))) {
                $return = 'properties/update/' . $id . '?return=' . self::returnUrl();
            } else {
                $return = 'properties?return=' . self::returnUrl();
            }

            // Insert logs into database
            if ($request->input('id') == '') {
                \SiteHelpers::auditTrail($request, 'New Data with ID ' . $id . ' Has been Inserted !');
            } else {
                \SiteHelpers::auditTrail($request, 'Data with ID ' . $id . ' Has been Updated !');
            }

            return Redirect::to($return)->with('messagetext', \Lang::get('core.note_success'))->with('msgstatus', 'success');
        } else {
                print_r($validator->errors()->all());
                echo "55ff"; die;
            //return Redirect::to('properties/update/' . $id)->with('messagetext', \Lang::get('core.note_error'))->with('msgstatus', 'error')
            //                ->withErrors($validator)->withInput();
        }
    }
    
    function contract_upload(Request $request) {
        $form_wizard = (int) $request->input('form_wizard');
        if (!is_null(Input::file('signedcontract')) || !is_null(Input::file('signedcontract')))
        {
            $propId = (int) $request->input('propId');
            if($propId > 0){
                $checkProp = \DB::table('tb_properties')->select('property_name')->where('id', $propId)->first(); 
                if (!empty($checkProp)) {
                    $checkDir = \DB::table('tb_container')->select('id')->where('name', 'locations')->first();
                    if (!empty($checkDir)) {
                        $foldVal = trim($checkProp->property_name);
                        if ($foldVal != "") {
                            $foldName = trim($foldVal);
                            $slug = \SiteHelpers::seoUrl(trim($foldName));
                            $dirPath = (new ContainerController)->getContainerUserPath($checkDir->id);
            
                            $checkPropFold = \DB::table('tb_container')->select('id')->where('name', $slug)->where('parent_id', $checkDir->id)->first();
                            if (!empty($checkPropFold)) {
                                $propFoldId = $checkPropFold->id;
                            } else {
                                $newPropFolder = $this->createNewFolder($foldName, $checkDir->id);
                                if ($newPropFolder !== false) {
                                    $propFoldId = $newPropFolder;
                                }
                            }
                            
                            if (!is_null(Input::file('signedcontract'))){
                                
                                $imgFold = $request->input('uploadType');
                                $PropImgfoldName = trim($imgFold);
                                $PropImgslug = \SiteHelpers::seoUrl(trim($PropImgfoldName));
                                $checkPropImgFold = \DB::table('tb_container')->select('id')->where('name', $PropImgslug)->where('parent_id', $propFoldId)->first();
                                if (!empty($checkPropImgFold)) {
                                    $newpropImgFoldId = $checkPropImgFold->id;
                                } else {
                                    $newPropImgFolder = $this->createNewFolder($PropImgfoldName, $propFoldId);
                                    if ($newPropImgFolder !== false) {
                                        $newpropImgFoldId = $newPropImgFolder;
                                    }
                                }
                                if ($imgFold == 'Rooms Images') {
                                    $cat_id = $request->input('category_id');
                                    $getcat = \DB::table('tb_properties_category_types')->select('category_name')->where('id', $cat_id)->where('status', 0)->first();
                                    if (!empty($getcat)) {
                                        $catFold = $getcat->category_name;
                                        $CatfoldName = trim($catFold);
                                        $Catslug = \SiteHelpers::seoUrl(trim($CatfoldName));
                                        $checkCatFold = \DB::table('tb_container')->select('id')->where('name', $Catslug)->where('parent_id', $newpropImgFoldId)->first();
                                        if (!empty($checkCatFold)) {
                                            $CatFoldId = $checkCatFold->id;
                                        } else {
                                            $newCatFolder = $this->createNewFolder($CatfoldName, $newpropImgFoldId);
                                            if ($newCatFolder !== false) {
                                                $CatFoldId = $newCatFolder;
                                            }
                                        }
                                        $propImgFoldId = $CatFoldId;
                                    } else {
                                        $propImgFoldId = $newpropImgFoldId;
                                    }
                                } else {
                                    $propImgFoldId = $newpropImgFoldId;
                                }
                                // SET UPLOAD PATH
                                $destinationPath = (new ContainerController)->getContainerUserPath($propImgFoldId);
                                $file = $request->file('signedcontract');
                                //$file = Input::file('signedcontract');
                                // GET THE FILE EXTENSION
                                $extension = $file->getClientOriginalExtension();
                                // RENAME THE UPLOAD WITH RANDOM NUMBER
                                //$fileName = rand(11111111111, 99999999999) . '-' .rand(11111111111, 99999999999) . '.' . $extension;
                                $fileName = rand() . '-' .rand() . '.' . $extension;
                                $fileNamedis = $file->getClientOriginalName();
                                $ftname = explode('.', $fileName);
                                $exha = false;
            
                                for ($f = 1; $exha != true; $f++) {
                                    if (\File::exists($destinationPath . $fileName)) {
                                        $fileName = $ftname[0] . '(' . $f . ').' . $extension;
                                    } else {
                                        $fileName = $fileName;
                                        $exha = true;
                                    }
                                }
                                // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
                                $upload_success = $file->move($destinationPath, $fileName);
                                $ftype = $file->getClientMimeType();
                                $exFtype = explode('/', $ftype);
                                if ($exFtype[0] == "image") {
                                    // open an image file
                                    $thimg = \Image::make($destinationPath . $fileName);
                                    // now you are able to resize the instance
                                    $thimg->resize(128, 130);
                                    // finally we save the image as a new file
                                    $thumbfile = 'thumb_' . $propImgFoldId . '_' . $fileName;
                                    $thimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);
            
                                    // open an image file
                                    $mdimg = \Image::make($destinationPath . $fileName);
                                    // now you are able to resize the instance
                                    $thactualsize = getimagesize($destinationPath . $fileName);
                                    if ($thactualsize[0] > $thactualsize[1]) {
                                        $mdimg->resize(320, null, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
                                    } else {
                                        $mdimg->resize(null, 320, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
                                    }
                                    // finally we save the image as a new file
                                    $thumbfile = 'format_' . $propImgFoldId . '_' . $fileName;
                                    $mdimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);
            
                                    // open an image file
                                    $mdimg = \Image::make($destinationPath . $fileName);
                                    // now you are able to resize the instance
                                    $hfactualsize = getimagesize($destinationPath . $fileName);
                                    if ($hfactualsize[0] > $hfactualsize[1]) {
                                        $mdimg->resize(1000, null, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
                                    } else {
                                        $mdimg->resize(null, 1000, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
                                    }
                                    // finally we save the image as a new file
                                    $thumbfile = 'highflip_' . $propImgFoldId . '_' . $fileName;
                                    $mdimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);
            
                                    // open an image file
                                    $pthimg = \Image::make($destinationPath . $fileName);
                                    // now you are able to resize the instance
                                    $pthimg->resize(80, 80);
                                    // finally we save the image as a new file
                                    $pthumbfile = $fileName;
                                    $pthimg->save(public_path() . '/uploads/property_imgs_thumbs/' . $pthumbfile);
            
                                    $fpimg = \Image::make($destinationPath . $fileName);
                                    $thactualsize = getimagesize($destinationPath . $fileName);
                                    if ($thactualsize[0] > $thactualsize[1]) {
                                        $fpimg->resize(425, 283);
                                    } else {
                                        $fpimg->resize(212, 283);
                                    }
                                    $thumbfile = 'front_property_' . $propImgFoldId . '_' . $fileName;
                                    $fpimg->save(public_path() . '/uploads/property_imgs_thumbs/' . $thumbfile);
            
                                    // Set main image if uploaded file is first in folder
                                    $countfile = \DB::table('tb_container_files')->where('folder_id', $propImgFoldId)->where(function ($query) {
                                                $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');
                                            })->count();
                                    if ($countfile == 0) {
                                        $copytofolder = public_path() . '/uploads/folder_cover_imgs/';
                                        // image for backend
                                        $bkimg = \Image::make($destinationPath . $fileName);
                                        $bkimg->resize(128, 130);
                                        $bkimgfile = 'thumb_' . $fileName;
                                        $bkimg->save($copytofolder . $bkimgfile);
            
                                        // open an image file
                                        $mdimg = \Image::make($destinationPath . $fileName);
                                        $thactualsize = getimagesize($destinationPath . $fileName);
                                        if ($thactualsize[0] > $thactualsize[1]) {
                                            $mdimg->resize(320, null, function ($constraint) {
                                                $constraint->aspectRatio();
                                            });
                                        } else {
                                            $mdimg->resize(null, 320, function ($constraint) {
                                                $constraint->aspectRatio();
                                            });
                                        }
                                        $thumbfile = 'format_' . $fileName;
                                        $mdimg->save($copytofolder . $thumbfile);
            
                                        $cmdata['temp_cover_img'] = $fileName;
                                        $cmdata['temp_cover_img_masonry'] = $fileName;
                                        $cmdata['updated'] = date('y-m-d');
                                        \DB::table('tb_container')->where('id', $propImgFoldId)->update($cmdata);
                                    }
                                }
            
                                $data['folder_id'] = $propImgFoldId;
                                $data['file_name'] = $fileName;
            					$data['file_display_name'] = $fileNamedis;
                                $data['file_type'] = $file->getClientMimeType();
                                $data['file_size'] = $file->getClientSize();
                                $data['user_id'] = \Auth::user()->id;
                                $data['created'] = date('y-m-d h:i:s');
                                $data['path'] = $destinationPath;
                                $fileID = \DB::table('tb_container_files')->insertGetId($data);
            
                                $imgdata['property_id'] = $request->input('propId');
                                $imgdata['type'] = $imgFold;
                                $imgdata['file_id'] = $fileID;
                                if ($imgFold == 'Rooms Images') {
                                    $imgdata['category_id'] = $request->input('category_id');
                                }
                                $imgdata['user_id'] = \Auth::user()->id;
                                $imgdata['created'] = date('y-m-d h:i:s');
                                $imgID = \DB::table('tb_properties_images')->insertGetId($imgdata);
            
                                $getupfile = \DB::table('tb_container_files')->where('id', $fileID)->first();
                                if (!empty($getupfile)) {
                                    $getfilejson['files'][0]['id'] = $imgID;
                                    $getfilejson['files'][0]['name'] = ($getupfile->file_display_name!='') ? $getupfile->file_display_name : $getupfile->file_name;
                                    $getfilejson['files'][0]['size'] = $getupfile->file_size;
                                    if ($getupfile->file_type == "application/pdf") {
                                        $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/bigpage_white_acrobat.png');
                                    } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.word") {
                                        $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/doc.png');
                                    } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.spre") {
                                        $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/xls.png');
                                    } else {
                                        $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/property_imgs_thumbs/' . $getupfile->file_name);
                                    }
                                    $getfilejson['files'][0]['type'] = $getupfile->file_type;
                                    $getfilejson['files'][0]['url'] = (new ContainerController)->getThumbpath($getupfile->folder_id) . $getupfile->file_name;
                                }
                                
                            }
                            
                            if (!is_null(Input::file('hotelbrochure'))){
                                $imgFold = 'Hotel Brochure';
                                $PropImgfoldName = trim($imgFold);
                                $PropImgslug = \SiteHelpers::seoUrl(trim($PropImgfoldName));
                                $checkPropImgFold = \DB::table('tb_container')->select('id')->where('name', $PropImgslug)->where('parent_id', $propFoldId)->first();
                                if (!empty($checkPropImgFold)) {
                                    $newpropImgFoldId = $checkPropImgFold->id;
                                } else {
                                    $newPropImgFolder = $this->createNewFolder($PropImgfoldName, $propFoldId);
                                    if ($newPropImgFolder !== false) {
                                        $newpropImgFoldId = $newPropImgFolder;
                                    }
                                }
            
                                if ($imgFold == 'Rooms Images') {
                                    $cat_id = $request->input('category_id');
                                    $getcat = \DB::table('tb_properties_category_types')->select('category_name')->where('id', $cat_id)->where('status', 0)->first();
                                    if (!empty($getcat)) {
                                        $catFold = $getcat->category_name;
                                        $CatfoldName = trim($catFold);
                                        $Catslug = \SiteHelpers::seoUrl(trim($CatfoldName));
                                        $checkCatFold = \DB::table('tb_container')->select('id')->where('name', $Catslug)->where('parent_id', $newpropImgFoldId)->first();
                                        if (!empty($checkCatFold)) {
                                            $CatFoldId = $checkCatFold->id;
                                        } else {
                                            $newCatFolder = $this->createNewFolder($CatfoldName, $newpropImgFoldId);
                                            if ($newCatFolder !== false) {
                                                $CatFoldId = $newCatFolder;
                                            }
                                        }
                                        $propImgFoldId = $CatFoldId;
                                    } else {
                                        $propImgFoldId = $newpropImgFoldId;
                                    }
                                } else {
                                    $propImgFoldId = $newpropImgFoldId;
                                }
                                // SET UPLOAD PATH
                                $destinationPath = (new ContainerController)->getContainerUserPath($propImgFoldId);
                                $file = $request->file('hotelbrochure');
                                //$file = Input::file('signedcontract');
                                // GET THE FILE EXTENSION
                                $extension = $file->getClientOriginalExtension();
                                // RENAME THE UPLOAD WITH RANDOM NUMBER
                                //$fileName = rand(11111111111, 99999999999) . '-' .rand(11111111111, 99999999999) . '.' . $extension;
                                $fileName = rand() . '-' .rand() . '.' . $extension;
                                $fileNamedis = $file->getClientOriginalName();
                                $ftname = explode('.', $fileName);
                                $exha = false;
            
                                for ($f = 1; $exha != true; $f++) {
                                    if (\File::exists($destinationPath . $fileName)) {
                                        $fileName = $ftname[0] . '(' . $f . ').' . $extension;
                                    } else {
                                        $fileName = $fileName;
                                        $exha = true;
                                    }
                                }
                                // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
                                $upload_success = $file->move($destinationPath, $fileName);
                                $ftype = $file->getClientMimeType();
                                $exFtype = explode('/', $ftype);
                                if ($exFtype[0] == "image") {
                                    // open an image file
                                    $thimg = \Image::make($destinationPath . $fileName);
                                    // now you are able to resize the instance
                                    $thimg->resize(128, 130);
                                    // finally we save the image as a new file
                                    $thumbfile = 'thumb_' . $propImgFoldId . '_' . $fileName;
                                    $thimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);
            
                                    // open an image file
                                    $mdimg = \Image::make($destinationPath . $fileName);
                                    // now you are able to resize the instance
                                    $thactualsize = getimagesize($destinationPath . $fileName);
                                    if ($thactualsize[0] > $thactualsize[1]) {
                                        $mdimg->resize(320, null, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
                                    } else {
                                        $mdimg->resize(null, 320, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
                                    }
                                    // finally we save the image as a new file
                                    $thumbfile = 'format_' . $propImgFoldId . '_' . $fileName;
                                    $mdimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);
            
                                    // open an image file
                                    $mdimg = \Image::make($destinationPath . $fileName);
                                    // now you are able to resize the instance
                                    $hfactualsize = getimagesize($destinationPath . $fileName);
                                    if ($hfactualsize[0] > $hfactualsize[1]) {
                                        $mdimg->resize(1000, null, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
                                    } else {
                                        $mdimg->resize(null, 1000, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
                                    }
                                    // finally we save the image as a new file
                                    $thumbfile = 'highflip_' . $propImgFoldId . '_' . $fileName;
                                    $mdimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);
            
                                    // open an image file
                                    $pthimg = \Image::make($destinationPath . $fileName);
                                    // now you are able to resize the instance
                                    $pthimg->resize(80, 80);
                                    // finally we save the image as a new file
                                    $pthumbfile = $fileName;
                                    $pthimg->save(public_path() . '/uploads/property_imgs_thumbs/' . $pthumbfile);
            
                                    $fpimg = \Image::make($destinationPath . $fileName);
                                    $thactualsize = getimagesize($destinationPath . $fileName);
                                    if ($thactualsize[0] > $thactualsize[1]) {
                                        $fpimg->resize(425, 283);
                                    } else {
                                        $fpimg->resize(212, 283);
                                    }
                                    $thumbfile = 'front_property_' . $propImgFoldId . '_' . $fileName;
                                    $fpimg->save(public_path() . '/uploads/property_imgs_thumbs/' . $thumbfile);
            
                                    // Set main image if uploaded file is first in folder
                                    $countfile = \DB::table('tb_container_files')->where('folder_id', $propImgFoldId)->where(function ($query) {
                                                $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');
                                            })->count();
                                    if ($countfile == 0) {
                                        $copytofolder = public_path() . '/uploads/folder_cover_imgs/';
                                        // image for backend
                                        $bkimg = \Image::make($destinationPath . $fileName);
                                        $bkimg->resize(128, 130);
                                        $bkimgfile = 'thumb_' . $fileName;
                                        $bkimg->save($copytofolder . $bkimgfile);
            
                                        // open an image file
                                        $mdimg = \Image::make($destinationPath . $fileName);
                                        $thactualsize = getimagesize($destinationPath . $fileName);
                                        if ($thactualsize[0] > $thactualsize[1]) {
                                            $mdimg->resize(320, null, function ($constraint) {
                                                $constraint->aspectRatio();
                                            });
                                        } else {
                                            $mdimg->resize(null, 320, function ($constraint) {
                                                $constraint->aspectRatio();
                                            });
                                        }
                                        $thumbfile = 'format_' . $fileName;
                                        $mdimg->save($copytofolder . $thumbfile);
            
                                        $cmdata['temp_cover_img'] = $fileName;
                                        $cmdata['temp_cover_img_masonry'] = $fileName;
                                        $cmdata['updated'] = date('y-m-d');
                                        \DB::table('tb_container')->where('id', $propImgFoldId)->update($cmdata);
                                    }
                                }
            
                                $data['folder_id'] = $propImgFoldId;
                                $data['file_name'] = $fileName;
            					$data['file_display_name'] = $fileNamedis;
                                $data['file_type'] = $file->getClientMimeType();
                                $data['file_size'] = $file->getClientSize();
                                $data['user_id'] = \Auth::user()->id;
                                $data['created'] = date('y-m-d h:i:s');
                                $data['path'] = $destinationPath;
                                $fileID = \DB::table('tb_container_files')->insertGetId($data);
            
                                $imgdata['property_id'] = $request->input('propId');
                                $imgdata['type'] = $imgFold;
                                $imgdata['file_id'] = $fileID;
                                if ($imgFold == 'Rooms Images') {
                                    $imgdata['category_id'] = $request->input('category_id');
                                }
                                $imgdata['user_id'] = \Auth::user()->id;
                                $imgdata['created'] = date('y-m-d h:i:s');
                                $imgID = \DB::table('tb_properties_images')->insertGetId($imgdata);
            
                                $getupfile = \DB::table('tb_container_files')->where('id', $fileID)->first();
                                if (!empty($getupfile)) {
                                    $getfilejson['files'][0]['id'] = $imgID;
                                    $getfilejson['files'][0]['name'] = ($getupfile->file_display_name!='') ? $getupfile->file_display_name : $getupfile->file_name;
                                    $getfilejson['files'][0]['size'] = $getupfile->file_size;
                                    if ($getupfile->file_type == "application/pdf") {
                                        $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/bigpage_white_acrobat.png');
                                    } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.word") {
                                        $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/doc.png');
                                    } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.spre") {
                                        $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/xls.png');
                                    } else {
                                        $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/property_imgs_thumbs/' . $getupfile->file_name);
                                    }
                                    $getfilejson['files'][0]['type'] = $getupfile->file_type;
                                    $getfilejson['files'][0]['url'] = (new ContainerController)->getThumbpath($getupfile->folder_id) . $getupfile->file_name;
                                }                                   
                            } 
                            \DB::table('tb_users')->where('id', \Auth::user()->id)->update(array('form_wizard'=>$form_wizard));                           
                            $return_array['status'] = 'success';
                            $return_array['message'] = 'Contract uploaded successfully';     
                        }else{
                            $return_array['status'] = 'error';
                            $return_array['message'] = 'Folder does not exist';
                        }
                    }else{
                        $return_array['status'] = 'error';
                        $return_array['message'] = 'Hotel not found to upload contract';
                    }                    
                }  
            }
        }else{
            \DB::table('tb_users')->where('id', \Auth::user()->id)->update(array('form_wizard'=>$form_wizard));
            $return_array['status'] = 'success';
            $return_array['message'] = 'Move ahead without upload contract';
        }
        echo json_encode($return_array); exit;
       /* if (!is_null(Input::file('signedcontract'))){
            $propId = (int) $request->input('propId');
            
            if($propId > 0){
            
                $checkProp = \DB::table('tb_properties')->select('property_name')->where('id', $propId)->first();
                
                //print_r($checkProp); die;
                
                if (!empty($checkProp)) {
                    $checkDir = \DB::table('tb_container')->select('id')->where('name', 'locations')->first();
                    if (!empty($checkDir)) {
                        $foldVal = trim($checkProp->property_name);
                        if ($foldVal != "") {
                            $foldName = trim($foldVal);
                            $slug = \SiteHelpers::seoUrl(trim($foldName));
                            $dirPath = (new ContainerController)->getContainerUserPath($checkDir->id);
        
                            $checkPropFold = \DB::table('tb_container')->select('id')->where('name', $slug)->where('parent_id', $checkDir->id)->first();
                            if (!empty($checkPropFold)) {
                                $propFoldId = $checkPropFold->id;
                            } else {
                                $newPropFolder = $this->createNewFolder($foldName, $checkDir->id);
                                if ($newPropFolder !== false) {
                                    $propFoldId = $newPropFolder;
                                }
                            }
        
                            $imgFold = $request->input('uploadType');
                            $PropImgfoldName = trim($imgFold);
                            $PropImgslug = \SiteHelpers::seoUrl(trim($PropImgfoldName));
                            $checkPropImgFold = \DB::table('tb_container')->select('id')->where('name', $PropImgslug)->where('parent_id', $propFoldId)->first();
                            if (!empty($checkPropImgFold)) {
                                $newpropImgFoldId = $checkPropImgFold->id;
                            } else {
                                $newPropImgFolder = $this->createNewFolder($PropImgfoldName, $propFoldId);
                                if ($newPropImgFolder !== false) {
                                    $newpropImgFoldId = $newPropImgFolder;
                                }
                            }
        
                            if ($imgFold == 'Rooms Images') {
                                $cat_id = $request->input('category_id');
                                $getcat = \DB::table('tb_properties_category_types')->select('category_name')->where('id', $cat_id)->where('status', 0)->first();
                                if (!empty($getcat)) {
                                    $catFold = $getcat->category_name;
                                    $CatfoldName = trim($catFold);
                                    $Catslug = \SiteHelpers::seoUrl(trim($CatfoldName));
                                    $checkCatFold = \DB::table('tb_container')->select('id')->where('name', $Catslug)->where('parent_id', $newpropImgFoldId)->first();
                                    if (!empty($checkCatFold)) {
                                        $CatFoldId = $checkCatFold->id;
                                    } else {
                                        $newCatFolder = $this->createNewFolder($CatfoldName, $newpropImgFoldId);
                                        if ($newCatFolder !== false) {
                                            $CatFoldId = $newCatFolder;
                                        }
                                    }
                                    $propImgFoldId = $CatFoldId;
                                } else {
                                    $propImgFoldId = $newpropImgFoldId;
                                }
                            } else {
                                $propImgFoldId = $newpropImgFoldId;
                            }
                            // SET UPLOAD PATH
                            $destinationPath = (new ContainerController)->getContainerUserPath($propImgFoldId);
                            $file = $request->file('signedcontract');
                            //$file = Input::file('signedcontract');
                            // GET THE FILE EXTENSION
                            $extension = $file->getClientOriginalExtension();
                            // RENAME THE UPLOAD WITH RANDOM NUMBER
                            //$fileName = rand(11111111111, 99999999999) . '-' .rand(11111111111, 99999999999) . '.' . $extension;
                            $fileName = rand() . '-' .rand() . '.' . $extension;
                            $fileNamedis = $file->getClientOriginalName();
                            $ftname = explode('.', $fileName);
                            $exha = false;
        
                            for ($f = 1; $exha != true; $f++) {
                                if (\File::exists($destinationPath . $fileName)) {
                                    $fileName = $ftname[0] . '(' . $f . ').' . $extension;
                                } else {
                                    $fileName = $fileName;
                                    $exha = true;
                                }
                            }
                            // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
                            $upload_success = $file->move($destinationPath, $fileName);
                            $ftype = $file->getClientMimeType();
                            $exFtype = explode('/', $ftype);
                            if ($exFtype[0] == "image") {
                                // open an image file
                                $thimg = \Image::make($destinationPath . $fileName);
                                // now you are able to resize the instance
                                $thimg->resize(128, 130);
                                // finally we save the image as a new file
                                $thumbfile = 'thumb_' . $propImgFoldId . '_' . $fileName;
                                $thimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);
        
                                // open an image file
                                $mdimg = \Image::make($destinationPath . $fileName);
                                // now you are able to resize the instance
                                $thactualsize = getimagesize($destinationPath . $fileName);
                                if ($thactualsize[0] > $thactualsize[1]) {
                                    $mdimg->resize(320, null, function ($constraint) {
                                        $constraint->aspectRatio();
                                    });
                                } else {
                                    $mdimg->resize(null, 320, function ($constraint) {
                                        $constraint->aspectRatio();
                                    });
                                }
                                // finally we save the image as a new file
                                $thumbfile = 'format_' . $propImgFoldId . '_' . $fileName;
                                $mdimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);
        
                                // open an image file
                                $mdimg = \Image::make($destinationPath . $fileName);
                                // now you are able to resize the instance
                                $hfactualsize = getimagesize($destinationPath . $fileName);
                                if ($hfactualsize[0] > $hfactualsize[1]) {
                                    $mdimg->resize(1000, null, function ($constraint) {
                                        $constraint->aspectRatio();
                                    });
                                } else {
                                    $mdimg->resize(null, 1000, function ($constraint) {
                                        $constraint->aspectRatio();
                                    });
                                }
                                // finally we save the image as a new file
                                $thumbfile = 'highflip_' . $propImgFoldId . '_' . $fileName;
                                $mdimg->save(public_path() . '/uploads/thumbs/' . $thumbfile);
        
                                // open an image file
                                $pthimg = \Image::make($destinationPath . $fileName);
                                // now you are able to resize the instance
                                $pthimg->resize(80, 80);
                                // finally we save the image as a new file
                                $pthumbfile = $fileName;
                                $pthimg->save(public_path() . '/uploads/property_imgs_thumbs/' . $pthumbfile);
        
                                $fpimg = \Image::make($destinationPath . $fileName);
                                $thactualsize = getimagesize($destinationPath . $fileName);
                                if ($thactualsize[0] > $thactualsize[1]) {
                                    $fpimg->resize(425, 283);
                                } else {
                                    $fpimg->resize(212, 283);
                                }
                                $thumbfile = 'front_property_' . $propImgFoldId . '_' . $fileName;
                                $fpimg->save(public_path() . '/uploads/property_imgs_thumbs/' . $thumbfile);
        
                                // Set main image if uploaded file is first in folder
                                $countfile = \DB::table('tb_container_files')->where('folder_id', $propImgFoldId)->where(function ($query) {
                                            $query->where('file_type', 'image/jpeg')->orWhere('file_type', 'image/png')->orWhere('file_type', 'image/gif');
                                        })->count();
                                if ($countfile == 0) {
                                    $copytofolder = public_path() . '/uploads/folder_cover_imgs/';
                                    // image for backend
                                    $bkimg = \Image::make($destinationPath . $fileName);
                                    $bkimg->resize(128, 130);
                                    $bkimgfile = 'thumb_' . $fileName;
                                    $bkimg->save($copytofolder . $bkimgfile);
        
                                    // open an image file
                                    $mdimg = \Image::make($destinationPath . $fileName);
                                    $thactualsize = getimagesize($destinationPath . $fileName);
                                    if ($thactualsize[0] > $thactualsize[1]) {
                                        $mdimg->resize(320, null, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
                                    } else {
                                        $mdimg->resize(null, 320, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
                                    }
                                    $thumbfile = 'format_' . $fileName;
                                    $mdimg->save($copytofolder . $thumbfile);
        
                                    $cmdata['temp_cover_img'] = $fileName;
                                    $cmdata['temp_cover_img_masonry'] = $fileName;
                                    $cmdata['updated'] = date('y-m-d');
                                    \DB::table('tb_container')->where('id', $propImgFoldId)->update($cmdata);
                                }
                            }
        
                            $data['folder_id'] = $propImgFoldId;
                            $data['file_name'] = $fileName;
        					$data['file_display_name'] = $fileNamedis;
                            $data['file_type'] = $file->getClientMimeType();
                            $data['file_size'] = $file->getClientSize();
                            $data['user_id'] = \Auth::user()->id;
                            $data['created'] = date('y-m-d h:i:s');
                            $data['path'] = $destinationPath;
                            $fileID = \DB::table('tb_container_files')->insertGetId($data);
        
                            $imgdata['property_id'] = $request->input('propId');
                            $imgdata['type'] = $imgFold;
                            $imgdata['file_id'] = $fileID;
                            if ($imgFold == 'Rooms Images') {
                                $imgdata['category_id'] = $request->input('category_id');
                            }
                            $imgdata['user_id'] = \Auth::user()->id;
                            $imgdata['created'] = date('y-m-d h:i:s');
                            $imgID = \DB::table('tb_properties_images')->insertGetId($imgdata);
        
                            $getupfile = \DB::table('tb_container_files')->where('id', $fileID)->first();
                            if (!empty($getupfile)) {
                                $getfilejson['files'][0]['id'] = $imgID;
                                $getfilejson['files'][0]['name'] = ($getupfile->file_display_name!='') ? $getupfile->file_display_name : $getupfile->file_name;
                                $getfilejson['files'][0]['size'] = $getupfile->file_size;
                                if ($getupfile->file_type == "application/pdf") {
                                    $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/bigpage_white_acrobat.png');
                                } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.word") {
                                    $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/doc.png');
                                } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.spre") {
                                    $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/xls.png');
                                } else {
                                    $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/property_imgs_thumbs/' . $getupfile->file_name);
                                }
                                $getfilejson['files'][0]['type'] = $getupfile->file_type;
                                $getfilejson['files'][0]['url'] = (new ContainerController)->getThumbpath($getupfile->folder_id) . $getupfile->file_name;
                            }
                            $return_array['json'] = json_encode($getfilejson);
                            $return_array['status'] = 'success';
                            $return_array['message'] = 'Contract uploaded successfully';
                        }else{
                            $return_array['status'] = 'error';
                            $return_array['message'] = 'Folder does not exist';
                        }
                    }else{
                        $return_array['status'] = 'error';
                        $return_array['message'] = 'Hotel not found to upload contract';
                    }
                }else{
                    $return_array['status'] = 'error';
                    $return_array['message'] = 'Hotel not found to upload contract';
                }
            }
            
                        
                                    
        }else{            
            $return_array['status'] = 'success';
            $return_array['message'] = 'Move ahead without upload contract';
        }
        echo json_encode($return_array); exit; */
    }
    
    public function getViewcontract($property_id){
        $hotelcontacts = $this->get_property_files($property_id, 'Hotel Contracts');
        $filepath = '';
        if(!empty($hotelcontacts)){
            foreach($hotelcontacts as $img){
                $filepath = $img->imgsrc.$img->file_name;
            }
        }
        
        if($filepath!='')
		{
		    $path = $filepath;			
				$flipimgs = array();
				$fl=0;
					
					$flipimgs[$fl]['imgpath'] = $path;
					$flipimgs[$fl]['imgname'] = '';
					$flipimgs[$fl]['file_type'] = 'application/pdf';
					$flipimgs[$fl]['folder'] = '';
					
				$this->data['flips'] = $flipimgs;
				$this->data['fliptype'] = 'high';
                
				return view('properties.flipbook', $this->data);
			
		}
		else
		{ 
		    $return = 'properties/?return=' . self::returnUrl();
			return Redirect::to($return)->with('messagetext','Contract has not uploaded yet.')->with('msgstatus','error');
		}
    }
    
    public function addhotel(Request $request){
        
        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.addhotel':'properties.addhotel'; 
        
        return view($file_name, $this->data);    
    }
    
    public function saveHotelInfo(Request $request){
        $uid = \Auth::user()->id;
        $id = $request->input('id');
        
        $rules['property_name'] = 'required';
        $rules['property_short_name'] = 'required';
        $rules['property_type'] = 'required';
        $rules['booking_type'] = 'required';
        /*$rules['assigned_user_id'] = 'required';*/
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            //$data = $this->validatePost('tb_properties');
            $alias = \SiteHelpers::seoUrl(Input::get('property_short_name'));
            
            $exha = false;
            for ($f = 1; $exha != true; $f++) {
                if ($request->input('id') == '') {
                    $check_alias = \DB::table('tb_properties')->where('property_slug', $alias)->count();
                } else {
                    $check_alias = \DB::table('tb_properties')->where('property_slug', $alias)->where('id', '!=', $id)->count();
                }
                if ($check_alias > 0) {
                    $alias = $alias . '-' . $f;
                } else {
                    $alias = $alias;
                    $exha = true;
                }
            }
            $data['user_id'] = $uid;
            $data['property_slug'] = $alias;

            if ($request->input('id') == '') {
                $data['created'] = date('Y-m-d h:i:s');
            } else {
                $data['updated'] = date('Y-m-d h:i:s');
            }
            
            $property_packages = array();            

            //$data['commission'] = $request->input('commission');
            $data['property_short_name'] = $request->input('property_short_name');
            $data['about_property'] = $request->input('about_property');
            $data['property_usp'] = $request->input('property_usp');
            
            $assigned_users = array();
            //print_r($request->input('assigned_user_id'));
            /*$assigned_ids = $request->input('assigned_user_id');
            if(strlen(trim($assigned_ids))>0){                
                //if (is_array($request->input('assigned_user_id'))) {
                    $assigned_users = explode(',', $assigned_ids);
                //}
            }*/
            //print_r($assigned_users);
            //die;
            $data['detail_section1_title'] = $request->input('detail_section1_title');
            $data['detail_section1_description_box1'] = $request->input('detail_section1_description_box1');
            $data['detail_section1_description_box2'] = $request->input('detail_section1_description_box2');
            $data['detail_section2_title'] = $request->input('detail_section2_title');
            $data['detail_section2_description_box1'] = $request->input('detail_section2_description_box1');
            $data['detail_section2_description_box2'] = $request->input('detail_section2_description_box2');
            $data['assign_detail_city'] = $request->input('assign_detail_city');            

            if (!empty($request->input('assigned_amenities'))) {
                $data['assign_amenities'] = implode(',', $request->input('assigned_amenities'));
            } else {
                $data['assign_amenities'] = '';
            }

            if (!is_null($request->input('copy_amenities_rooms'))) {
                $data['copy_amenities_rooms'] = $request->input('copy_amenities_rooms');
            } else {
                $data['copy_amenities_rooms'] = 0;
            }

            if (!is_null($request->input('default_seasons'))) {
                $data['default_seasons'] = $request->input('default_seasons');
            } else {
                $data['default_seasons'] = 0;
            }

            if (!empty($request->input('destinations'))) {
                $data['property_category_id'] = implode(',', $request->input('destinations'));
            } else {
                $data['property_category_id'] = '';
            }
            			
			$data['primary_airport'] = $request->input('primary_airport');
            $data['secondary_airport'] = $request->input('secondary_airport');  
            
            $data['hotel_generic_email_address'] = $request->input('hotel_generic_email_address');
            $data['general_manager_name'] = $request->input('general_manager_name');  
            $data['hotel_time_zone'] = $request->input('hotel_time_zone');
            $data['hotel_currency'] = $request->input('hotel_currency');  
            $data['hotel_telephone_country_code'] = $request->input('hotel_telephone_country_code');
            $data['hotel_telephone_area_code'] = $request->input('hotel_telephone_area_code');  
            $data['hotel_telephone_no'] = $request->input('hotel_telephone_no');
            $data['general_fax_country_code'] = $request->input('general_fax_country_code');  
            $data['general_fax_area_code'] = $request->input('general_fax_area_code');
            $data['general_fax_no'] = $request->input('general_fax_no');  
            $data['reservations_direct_telephone_country_code'] = $request->input('reservations_direct_telephone_country_code');
            $data['reservations_direct_telephone_area_code'] = $request->input('reservations_direct_telephone_area_code');  
            $data['reservations_direct_telephone_no'] = $request->input('reservations_direct_telephone_no');
            $data['reservations_toll_free_country_code'] = $request->input('reservations_toll_free_country_code');  
            $data['reservations_toll_free_area_code'] = $request->input('reservations_toll_free_area_code');
            $data['reservations_toll_free_no'] = $request->input('reservations_toll_free_no');  
            $data['reservations_department_fax_country_code'] = $request->input('reservations_department_fax_country_code');
            $data['reservations_department_fax_area_code'] = $request->input('reservations_department_fax_area_code');  
            $data['reservations_department_fax_no'] = $request->input('reservations_department_fax_no');
            $data['reservations_alternate_fax_country_code'] = $request->input('reservations_alternate_fax_country_code');  
            $data['reservations_alternate_fax_area_code'] = $request->input('reservations_alternate_fax_area_code');
            $data['reservations_alternate_fax_no'] = $request->input('reservations_alternate_fax_no');  
            $data['reservations_general_email_address'] = $request->input('reservations_general_email_address');
            $data['primary_city'] = $request->input('primary_city');
            $data['secondary_city'] = $request->input('secondary_city');  
            $data['amadeus'] = $request->input('amadeus');
            $data['galileo'] = $request->input('galileo');            
            $data['sabre'] = $request->input('sabre');  
            $data['worldspan'] = $request->input('worldspan');
            $data['vat_tax'] = $request->input('vat_tax');  
            $data['occupancy_tax'] = $request->input('occupancy_tax');
            $data['service_charge'] = $request->input('service_charge');  
            $data['travel_agent_commission'] = $request->input('travel_agent_commission');             
            
            // Yachts info tab
            if ($request->input('property_type') == 'Yachts') {
                $yacht_category = $request->input('yacht_category');
                $data['yacht_category'] = implode(', ', $yacht_category);
                $data['yacht_build_year'] = $request->input('yacht_build_year');
                $data['yachts_guest'] = $request->input('yachts_guest');
                $data['yacht_length'] = $request->input('yacht_length');
                if (!empty($request->input('yacht_builder'))) {
                    $data['yacht_builder'] = implode(',', $request->input('yacht_builder'));
                }
                $data['yacht_beam'] = $request->input('yacht_beam');
                $data['yacht_draft'] = $request->input('yacht_draft');
                $data['yacht_grt'] = $request->input('yacht_grt');
                $data['yacht_cabins'] = $request->input('yacht_cabins');
                $data['yacht_crew'] = $request->input('yacht_crew');
                $data['yacht_for_sale'] = $request->input('yacht_for_sale');
                $data['yacht_for_charter'] = $request->input('yacht_for_charter');
            }
            
            
            //print_r($assigned_users); die;
            //$id = $this->model->insertRow($data, $request->input('id'));
            
            \DB::table('tb_properties')->where('id', $id)->update($data);
            
            if (!is_null($request->input('copy_amenities_rooms')) && !empty($request->input('assigned_amenities'))) {
                $check_pcats = \DB::table('tb_properties_category_types')->where('property_id', $id)->get();
                if (!empty($check_pcats)) {
                    foreach ($check_pcats as $pcats) {
                        $check_pcats_exist = \DB::table('tb_properties_category_amenities')->where('property_id', $id)->where('cat_id', $pcats->id)->first();
                        $Amdata['property_id'] = $id;
                        $Amdata['cat_id'] = $pcats->id;
                        $Amdata['user_id'] = $uid;
                        $Amdata['amenity_ids'] = implode(',', $request->input('assigned_amenities'));
                        if (!empty($check_pcats_exist)) {
                            $Amdata['updated'] = date('Y-m-d h:i:s');
                            \DB::table('tb_properties_category_amenities')->where('id', $check_pcats_exist->id)->update($Amdata);
                        } else {
                            $Amdata['created'] = date('Y-m-d h:i:s');
                            \DB::table('tb_properties_category_amenities')->insertGetId($Amdata);
                        }
                    }
                }
            }
            
            /** insert property packages relation start **/
            $finproperty_package_relation = array();
            $upproperty_package_relation = array();
            $prop_package_rel = \DB::table('tb_properties_category_package')->where('property_id', $id)->get();
            $rest_arr = array();
            foreach($prop_package_rel as $si_prop){ $rest_arr[$si_prop->package_id] = $si_prop; }
            $prop_package_rel = $rest_arr;
            \DB::table('tb_properties_category_package')->where('property_id', $id)->delete();
            if((count($property_packages) > 0)){                
                foreach($property_packages as $si_prop){ 
                    if(isset($prop_package_rel[$si_prop])){ $finproperty_package_relation[] = array("property_id"=>$id,"package_id"=>$si_prop,"id"=>$prop_package_rel[$si_prop]->id); }
                    else{ $finproperty_package_relation[] = array("property_id"=>$id,"package_id"=>$si_prop,"id"=>NULL); }
                }
            }
            
            if(count($finproperty_package_relation)){ \DB::table('tb_properties_category_package')->insert($finproperty_package_relation); }
            /** insert property packages relation end **/
            
            
            /** insert property packages relation start **/
            /*$final_assigned_users = array();            
            \DB::table('tb_properties_users')->where('property_id', $id)->delete();            
            if((count($assigned_users) > 0)){                
                foreach($assigned_users as $si_user){ 
                    $final_assigned_users[] = array("property_id"=>$id,"user_id"=>$si_user); 
                }
            }            
            if(count($final_assigned_users)){ \DB::table('tb_properties_users')->insert($final_assigned_users); }*/
            /** insert property packages relation end **/
            
            
            if (!is_null($request->input('apply'))) {
                $return = 'properties/update/' . $id . '?return=' . self::returnUrl();
            } else {
                $return = 'properties?return=' . self::returnUrl();
            }

            // Insert logs into database
            if ($request->input('id') == '') {
                \SiteHelpers::auditTrail($request, 'New Data with ID ' . $id . ' Has been Inserted !');
            } else {
                \SiteHelpers::auditTrail($request, 'Data with ID ' . $id . ' Has been Updated !');
            }

            $return_array['status'] = 'success';
            $return_array['message'] = 'Property has been saved!';
            
        } else {

            $return_array['status'] = 'error';
            $return_array['message'] = 'Property not saved errors occurred!';
        }
        echo json_encode($return_array);
        exit;
    }
    
    public function saveHotelArchitectInfo(Request $request){
        $uid = \Auth::user()->id;
        $id = $request->input('id');
        
        if ($id > 0) {
            
            $destinationPath = public_path() . '/uploads/properties_subtab_imgs/';
            // Architechure 
            $data['architecture_title'] = $request->input('architecture_title');
            $data['architecture_desciription'] = $request->input('architecture_desciription');
            if ($request->input('architecture_video_type') != '') {
                $data['architecture_video_type'] = $request->input('architecture_video_type');
            }
            if ($request->input('architecture_video_link_type') != '') {
                $data['architecture_video_link_type'] = $request->input('architecture_video_link_type');
            }
            $data['architecture_video_link'] = $request->input('architecture_video_link');
            if (!empty($request->input('assigned_architecture_designer'))) {
                $data['assigned_architecture_designer'] = implode(',', $request->input('assigned_architecture_designer'));
            }
            if (!is_null($request->file('architecture_image'))) {
                $architecture_file = $request->file('architecture_image');
                $architecture_filename = $architecture_file->getClientOriginalName();
                $architecture_extension = $architecture_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_extension;
                $architecture_uploadSuccess = $architecture_file->move($destinationPath, $architecture_filename);
                if ($architecture_uploadSuccess) {
                    $data['architecture_image'] = $architecture_filename;
                }
            }
            
            if (!is_null($request->file('architecture_video'))) {
                $architecture_vfile = $request->file('architecture_video');
                $architecture_vfilename = $architecture_vfile->getClientOriginalName();
                $architecture_vextension = $architecture_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_vextension;
                $architecture_vuploadSuccess = $architecture_vfile->move($destinationPath, $architecture_videofilename);
                if ($architecture_vuploadSuccess) {
                    $data['architecture_video'] = $architecture_videofilename;
                }
            }
            
            // Design 
            $data['architecture_design_title'] = $request->input('architecture_design_title');
            $data['architecture_design_desciription'] = $request->input('architecture_design_desciription');
            $data['architecture_design_url'] = $request->input('architecture_design_url');
            if ($request->input('architecture_design_video_type') != '') {
                $data['architecture_design_video_type'] = $request->input('architecture_design_video_type');
            }
            if ($request->input('architecture_design_video_link_type') != '') {
                $data['architecture_design_video_link_type'] = $request->input('architecture_design_video_link_type');
            }
            $data['architecture_design_video_link'] = $request->input('architecture_design_video_link');
            if (!is_null($request->file('architecture_design_image'))) {
                $architecture_design_file = $request->file('architecture_design_image');
                $architecture_design_filename = $architecture_design_file->getClientOriginalName();
                $architecture_design_extension = $architecture_design_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_design_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_design_extension;
                $architecture_design_uploadSuccess = $architecture_design_file->move($destinationPath, $architecture_design_filename);
                if ($architecture_design_uploadSuccess) {
                    $data['architecture_design_image'] = $architecture_design_filename;
                }
            }
            
            if (!is_null($request->file('architecture_design_video'))) {
                $architecture_design_vfile = $request->file('architecture_design_video');
                $architecture_design_vfilename = $architecture_design_vfile->getClientOriginalName();
                $architecture_design_vextension = $architecture_design_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_design_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_design_vextension;
                $architecture_design_vuploadSuccess = $architecture_design_vfile->move($destinationPath, $architecture_design_videofilename);
                if ($architecture_design_vuploadSuccess) {
                    $data['architecture_design_video'] = $architecture_design_videofilename;
                }
            }
            
            // Designer
            $data['architecture_designer_title'] = $request->input('architecture_designer_title');
            $data['architecture_designer_desciription'] = $request->input('architecture_designer_desciription');
            $data['architecture_designer_url'] = $request->input('architecture_designer_url');
            if (!empty($request->input('architecture_designer_designer'))) {
                $data['architecture_designer_designer'] = implode(',', $request->input('architecture_designer_designer'));
            }
            if ($request->input('architecture_designer_video_type') != '') {
                $data['architecture_designer_video_type'] = $request->input('architecture_designer_video_type');
            }
            if ($request->input('architecture_designer_video_link_type') != '') {
                $data['architecture_designer_video_link_type'] = $request->input('architecture_designer_video_link_type');
            }
            $data['architecture_designer_video_link'] = $request->input('architecture_designer_video_link');
            
            if (!is_null($request->file('architecture_designer_image'))) {
                $architecture_designer_file = $request->file('architecture_designer_image');
                $architecture_designer_filename = $architecture_designer_file->getClientOriginalName();
                $architecture_designer_extension = $architecture_designer_file->getClientOriginalExtension(); //if you need extension of the file
                $architecture_designer_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_designer_extension;
                $architecture_designer_uploadSuccess = $architecture_designer_file->move($destinationPath, $architecture_designer_filename);
                if ($architecture_designer_uploadSuccess) {
                    $data['architecture_designer_image'] = $architecture_designer_filename;
                }
            }
            
            if (!is_null($request->file('architecture_designer_video'))) {
                $architecture_designer_vfile = $request->file('architecture_designer_video');
                $architecture_designer_vfilename = $architecture_designer_vfile->getClientOriginalName();
                $architecture_designer_vextension = $architecture_designer_vfile->getClientOriginalExtension(); //if you need extension of the file
                $architecture_designer_videofilename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $architecture_designer_vextension;
                $architecture_designer_vuploadSuccess = $architecture_designer_vfile->move($destinationPath, $architecture_designer_videofilename);
                if ($architecture_designer_vuploadSuccess) {
                    $data['architecture_designer_video'] = $architecture_designer_videofilename;
                }
            }
            
            //print_r($data); die;
            
            \DB::table('tb_properties')->where('id', $id)->update($data);
            
            $return_array['status'] = 'success';
            $return_array['message'] = 'Property has been saved!';
            
        } else {

            $return_array['status'] = 'error';
            $return_array['message'] = 'Property not saved errors occurred!';
        }
        echo json_encode($return_array);
        exit;
    }
    
    public function saveHotelSocialInfo(Request $request){
        $uid = \Auth::user()->id;
        $id = $request->input('id');
        
        if ($id > 0) {
            
            $data['social_status'] = $request->input('social_status');
            $data['social_facebook'] = $request->input('social_facebook');
            $data['social_twitter'] = $request->input('social_twitter');
            $data['social_google'] = $request->input('social_google');
            $data['social_youtube'] = $request->input('social_youtube');
            $data['social_pinterest'] = $request->input('social_pinterest');
            $data['social_vimeo'] = $request->input('social_vimeo');
            $data['social_instagram'] = $request->input('social_instagram');
            
            //print_r($data); die;
            
            \DB::table('tb_properties')->where('id', $id)->update($data);
            
            $return_array['status'] = 'success';
            $return_array['message'] = 'Property has been saved!';
            
            \DB::table('tb_users')->where('id', $uid)->update(array('property_info_setup'=>1));
            
        } else {

            $return_array['status'] = 'error';
            $return_array['message'] = 'Property not saved errors occurred!';
        }
        echo json_encode($return_array);
        exit;
    }
    
    public function confirmreservation(Request $request){
        $id = (int) $request->input('id');
        //if($id > 0)
    }
    function get_b2ccategory_rooms_reservations(Request $request) {
        $property_id = $request->input('pid');
        $caltype = $request->input('caltype');
        $cal_start = $request->input('calstart');
        $cal_end = $request->input('calend');
        if($property_id != '' && $property_id > 0) {
            $cats = array();
            $cat_types_temp = \DB::table('tb_properties_category_types')->where('property_id', $property_id)->where('status', 0);
            if($caltype != 'all') {
                $cat_types_temp->where('id', $caltype);
            }
            $cat_types = $cat_types_temp->get();
            
            if (!empty($cat_types)) {
                $c = 0;
                foreach ($cat_types as $type) {
                    $cats[$c]['data'] = $type;
                     
                    $reservations = \DB::table('tb_reservations')->select('*', \DB::raw('COUNT(td_reserved_rooms.type_id) as total_rooms'))->join('td_reserved_rooms','tb_reservations.id','=','td_reserved_rooms.reservation_id')->where('property_id', $property_id)->where('td_reserved_rooms.type_id', $type->id)->where('tb_reservations.checkin_date','>=', $cal_start)->where('tb_reservations.checkin_date','<=', $cal_end)->groupBy('td_reserved_rooms.reservation_id','td_reserved_rooms.type_id')->get();
                    
                    $cats[$c]['reservation'] = $reservations;
                    
                    $c++;
                }
            }
            
            
            
            if (empty($cats)) {
                $res['status'] = 'error';
                $res['errors'] = 'No Room Added For This Property.';
                return json_encode($res);
            } else {
                $res['status'] = 'success';
                $res['cat_types'] = $cats;
                return json_encode($res);
            }
        }else{
            $res['status'] = 'error';
            $res['errors'] = 'Property Not Found.';
            return json_encode($res);
        }
    }
    
    function get_reservation_details(Request $request){
        $ids = (array) $request->input('ids');
        //print_r($ids);
        $final_array = array();
        $arr_reservation = array();
        $arr_reser = array();
        $arr_reserved = array();
        $cnt = 0;
        if(count($ids) > 0){            
            $reservations = \DB::table('tb_reservations')->whereIn('tb_reservations.id', $ids)->get();  
            foreach($reservations as $res){
                $t_array = array();
                $t_array["details"] = $res;
                
                //get all booked rooms of every reservation
                $rid = $res->id;
                $reserved_rooms = \DB::table('td_reserved_rooms')->where('td_reserved_rooms.reservation_id', $rid)->get();
                foreach($reserved_rooms as $si_room){
                    $tc_array = array();
                    $tc_array = $si_room;
                    
                    //get available rooms from db
                    $cid = $si_room->type_id;
                    $cat_rooms = \DB::table('tb_properties_category_rooms')->where('tb_properties_category_rooms.category_id', $cid)->get();
                    $tc_array->total_available_rooms = (int) count($cat_rooms);
                    if($tc_array->total_available_rooms > 0){
                        $tc_array->available_rooms = $cat_rooms;
                        $tc_array->is_room_availabe = 1;
                    }else
                    {
                        $tc_array->available_rooms = array();
                        $tc_array->is_room_availabe = 0;
                    }
                    //End
                    
                    $t_array["rooms"][] = $tc_array;
                }                
                //End
                
                
                $final_array[] = $t_array;
            }
            
            /*echo "<pre>";
            print_r($final_array);
            die;
            foreach($ids as $id){
                $reservations = \DB::table('tb_reservations')->where('tb_reservations.id', $id)->get();  
                 
                if(!empty($reservations)){
                    foreach($reservations as $res){
                        $arr_reser['reservation'] = $res;
                        $rid = $res->id;
                        
                        $reserved_rooms = \DB::table('td_reserved_rooms')->where('td_reserved_rooms.reservation_id', $rid)->get();
                        if(!empty($reserved_rooms)){
                            foreach($reserved_rooms as $rooms){
                                $arr_reserved['room'][] = $rooms;
                                
                                $cid = $rooms->type_id;
                                $cat_rooms = \DB::table('tb_properties_category_rooms')->where('tb_properties_category_rooms.category_id', $cid)->get();
                                $arr_reserved['cat_rooms'][] = $cat_rooms; 
                            }
                            $arr_reser['category_room'][] = $arr_reserved;
                        }
                        $arr_reservation['reservations'][] = $arr_reser;
                        $cnt++;
                    }
                    
                }
                
                $final_array[] = $arr_reservation;
            }*/
            
        }
        if (empty($final_array)) {
            $response['status'] = 'error';
            $response['errors'] = 'No Room Added For This Property.';
            return json_encode($response);
        } else {
            $response['status'] = 'success';
            $response['reservations'] = $final_array;
            return json_encode($response);
        }
        //return json_encode($final_array);
    }
    
    function get_b2ccategory_rooms_reservations_old(Request $request) {
        $property_id = $request->input('pid');
        $caltype = $request->input('caltype');

        if ($property_id != '' && $property_id > 0) {
            $cats = array();
            $cat_types_temp = \DB::table('tb_properties_category_types')->where('property_id', $property_id)->where('status', 0);
            if ($caltype != 'all') {
                $cat_types_temp->where('id', $caltype);
            }
            $cat_types = $cat_types_temp->get();
            if (!empty($cat_types)) {
                $c = 0;
                $arrrooms = array();
                foreach ($cat_types as $type) {
                    $cat_rooms = \DB::table('tb_properties_category_rooms')->where('property_id', $property_id)->where('category_id', $type->id)->get();
                    //if (!empty($cat_rooms)) {
                        $cats[$c]['data'] = $type;
                        //foreach ($cat_rooms as $room) {
                            //$cats[$c]['rooms'][] = $room;
                            //$arrrooms['room'] = $cat_rooms;
                            $new_array = array();
                            $final_array = array();
                            $reservations = \DB::table('tb_reservations')->where('property_id', $property_id)->where('type_id', $type->id)->get();
                            if(!empty($reservations)){
                                foreach($reservations as $reserv){
                                    $rid = $reserv->id;
                                    $reserved_rooms = \DB::table('td_reserved_rooms')->join('tb_properties_category_types','tb_properties_category_types.id','=','td_reserved_rooms.type_id')->where('td_reserved_rooms.reservation_id', $rid)->get();
                                    
                                    if(!empty($reserved_rooms)){  
                                        foreach($reserved_rooms as $res_rm){
                                            $cat_res_rooms = \DB::table('tb_properties_category_rooms')->where('category_id', $res_rm->id)->get();
                                        }
                                    }
                                    
                                    $new_array['reserved_rooms'] = $reserved_rooms; 
                                    $new_array['booking'] =  $reserv;  
                                    $final_array[] = $new_array;                            
                                }
                            }
                            $cats[$c]['reservation'] = $final_array;
                            
                            $cats[$c]['rooms'] = $cat_rooms;
                        //}
                        
                    //}
                    
                    /* $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*', 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $property_id)->where('tb_properties_images.category_id', $type->id)->where('tb_properties_images.type', 'Rooms Images')->get();
                      $filen = array();
                      if(!empty($fileArr))
                      {
                      $f=0;
                      foreach($fileArr as $file)
                      {
                      $cats[$c]['imgs'][$f] = $file;
                      $cats[$c]['imgs'][$f]->imgsrc = (new ContainerController)->getThumbpath($file->folder_id);
                      $f++;
                      }
                      }

                      $cat_amenty = \DB::table('tb_properties_category_amenities')->where('property_id', $property_id)->where('cat_id', $type->id)->first();
                      if(!empty($cat_amenty))
                      {
                      $cats[$c]['amenty'] = $cat_amenty;
                      }

                      $cat_amenty = \DB::table('tb_properties_category_amenities')->where('property_id', $property_id)->where('cat_id', $type->id)->first();
                      if(!empty($cat_amenty))
                      {
                      $cats[$c]['amenties'] = $cat_amenty->amenity_ids;
                      } */
                    $c++;
                }
            }

            if (empty($cats)) {
                $res['status'] = 'error';
                $res['errors'] = 'No Room Added For This Property.';
                return json_encode($res);
            } else {
                $res['status'] = 'success';
                $res['cat_types'] = $cats;
                return json_encode($res);
            }
        } else {
            $res['status'] = 'error';
            $res['errors'] = 'Property Not Found.';
            return json_encode($res);
        }
    }
    function user_arrival_departure(Request $request){
        
        $reportfor = $request->input('reportfor');
        $arrival_departure =  $request->input('arrival_departure');
        
        $uid = \Session::get('uid');
        $property_ids = array();
        if($uid > 0){
            $assigned_property = \DB::table('tb_properties_users')->where('user_id', $uid)->get();
            if(!empty($assigned_property)){
                foreach($assigned_property as $prop){
                    $property_ids[] = $prop->property_id;
                }
            }
        }
        $current_date = date('Y-m-d');
        if(trim($reportfor)=='today'){
            $current_date = date('Y-m-d');
            //$arrival_dep_arr = \DB::table('')
            if(!empty($property_ids)){
                
                if($arrival_departure=="arrival"){
                    $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->where('tb_reservations.checkin_date', $current_date)->get();
                }elseif($arrival_departure=="cancel"){
                    $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->where('tb_reservations.created_date', $current_date)->where('booking_status', 2)->get();                    
                }else{
                    $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->where('tb_reservations.checkout_date', $current_date)->get();                    
                }                   
                                
            }
        }elseif(trim($reportfor)=='month'){
            
            $from_date = date('Y-m-01');            
            $to_date = date("Y-m-t", strtotime($current_date));
            $to_from=array($from_date, $to_date);
            
                       
            if($arrival_departure=="arrival"){
                $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->whereBetween('tb_reservations.checkin_date', $to_from)->get(); 
            }elseif($arrival_departure=="cancel"){
                $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->whereBetween('tb_reservations.created_date', $to_from)->where('booking_status', 2)->get();
            }else{
                $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->whereBetween('tb_reservations.checkout_date', $to_from)->get(); 
            }            
            
        }else{
            
            //$from_date = date('Y-m-01');            
            //$to_date = date("Y-m-t", strtotime($current_date));
            //$to_from=array($from_date, $to_date);
            
                       
            if($arrival_departure=="arrival"){
                $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->get(); 
            }elseif($arrival_departure=="cancel"){
                $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->where('booking_status', 2)->get();
            }else{
                $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->get(); 
            }            
            
        }
        $res['status'] = 'success';
        $res['reservations'] = $reservations;
        
        return json_encode($res);
    }
    function user_arrival_departure_cancelations(Request $request){
        
        $reportfor = $request->input('reportfor');
        $arrival_departure =  $request->input('arrival_departure');
        
        $uid = \Session::get('uid');
        $property_ids = array();
        if($uid > 0){
            $assigned_property = \DB::table('tb_properties_users')->where('user_id', $uid)->get();
            if(!empty($assigned_property)){
                foreach($assigned_property as $prop){
                    $property_ids[] = $prop->property_id;
                }
            }
        }
        $current_date = date('Y-m-d');
        if(trim($reportfor)=='today'){
            $current_date = date('Y-m-d');
            //$arrival_dep_arr = \DB::table('')
            if(!empty($property_ids)){
                
                if($arrival_departure=="arrival"){
                    $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->where('tb_reservations.checkin_date', $current_date)->get();
                }elseif($arrival_departure=="cancel"){
                    $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->where('tb_reservations.created_date', $current_date)->where('booking_status', 2)->get();                    
                }else{
                    $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->where('tb_reservations.checkout_date', $current_date)->get();                    
                }                   
                                
            }
        }elseif(trim($reportfor)=='month'){
            
            $from_date = date('Y-m-01');            
            $to_date = date("Y-m-t", strtotime($current_date));
            $to_from=array($from_date, $to_date);
            
                       
            if($arrival_departure=="arrival"){
                $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->whereBetween('tb_reservations.checkin_date', $to_from)->get(); 
            }elseif($arrival_departure=="cancel"){
                $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->whereBetween('tb_reservations.created_date', $to_from)->where('booking_status', 2)->get();
            }else{
                $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->whereBetween('tb_reservations.checkout_date', $to_from)->get(); 
            }            
            
        }else{
            
            //$from_date = date('Y-m-01');            
            //$to_date = date("Y-m-t", strtotime($current_date));
            //$to_from=array($from_date, $to_date);
            
                       
            if($arrival_departure=="arrival"){
                $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->get(); 
            }elseif($arrival_departure=="cancel"){
                $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->where('booking_status', 2)->get();
            }else{
                $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->get(); 
            }            
            
        }
        $res['status'] = 'success';
        $res['data'] = $reservations;
        
        return json_encode($res);
    }
    function reservations(Request $request){
        $u_id = \Session::get('uid');
          
        $prop_id = 0;
        $property_name = '';
        $obj_property = \DB::table('tb_properties')->where('user_id', $u_id)->orWhere('assigned_user_id', $u_id)->first();
        if(!empty($obj_property)){
            $prop_id = $obj_property->id;
            $property_name = $obj_property->property_name;
        }
        $this->data['pid'] = $prop_id;
        
        $this->data['hotel_name'] = $property_name;
        
        $this->data['cat_types'] = $this->find_categories_room($prop_id);
            
        $this->data['currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.reservations':'properties.reservations'; 
        
        return view($file_name, $this->data);
    }
    function qualityassurances(Request $request){
        $u_id = \Session::get('uid');
          
        $prop_id = 0;
        $property_name = '';
        $obj_property = \DB::table('tb_properties')->where('user_id', $u_id)->first();
        if(!empty($obj_property)){
            $prop_id = $obj_property->id;
            $property_name = $obj_property->property_name;
        }
        $this->data['pid'] = $prop_id;
        
        $this->data['hotel_name'] = $property_name;
            
        $this->data['currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.qualityassurance':'properties.qualityassurance'; 
        
        return view($file_name, $this->data);
    }
    function salesreport(Request $request){
        $u_id = \Session::get('uid');
          
        $prop_id = 0;
        $property_name = '';
        $obj_property = \DB::table('tb_properties')->where('user_id', $u_id)->first();
        if(!empty($obj_property)){
            $prop_id = $obj_property->id;
            $property_name = $obj_property->property_name;
        }
        $this->data['pid'] = $prop_id;
        
        $this->data['hotel_name'] = $property_name;
            
        $this->data['currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        if(strlen($is_demo6) > 0){
            $file_name = $is_demo6.'.properties.salesreport';         
            return view($file_name, $this->data);
        }else{            
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');        
        }        
    }
    function arrivaldeparture(Request $request){
        $u_id = \Session::get('uid');
          
        $prop_id = 0;
        $property_name = '';
        $obj_property = \DB::table('tb_properties')->where('user_id', $u_id)->first();
        if(!empty($obj_property)){
            $prop_id = $obj_property->id;
            $property_name = $obj_property->property_name;
        }
        $this->data['pid'] = $prop_id;
        
        $this->data['hotel_name'] = $property_name;
            
        $this->data['currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        if(strlen($is_demo6) > 0){
            $file_name = $is_demo6.'.properties.arrivaldeparture';         
            return view($file_name, $this->data);
        }else{            
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');        
        }
    }
    function advertising(Request $request){
        $u_id = \Session::get('uid');
          
        $prop_id = 0;
        $property_name = '';
        $obj_property = \DB::table('tb_properties')->where('user_id', $u_id)->first();
        if(!empty($obj_property)){
            $prop_id = $obj_property->id;
            $property_name = $obj_property->property_name;
        }
        $this->data['pid'] = $prop_id;
        
        $this->data['hotel_name'] = $property_name;
            
        $this->data['currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.advertising':'properties.advertising'; 
        
        return view($file_name, $this->data);
    }
    function hotelcontainer(Request $request){
        $u_id = \Session::get('uid');
          
        $prop_id = 0;
        $property_name = '';
        $obj_property = \DB::table('tb_properties')->where('user_id', $u_id)->first();
        if(!empty($obj_property)){
            $prop_id = $obj_property->id;
            $property_name = $obj_property->property_name;
        }
        $this->data['pid'] = $prop_id;
        
        $this->data['hotel_name'] = $property_name;
            
        $this->data['currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
        
        $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*',  \DB::raw("(CASE WHEN (tb_container_files.file_display_name = '') THEN tb_container_files.file_name ELSE tb_container_files.file_display_name END) as file_display_name"), 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.property_id', $prop_id)->get();
        
        
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.properties.hotelcontainer':'properties.hotelcontainer'; 
        
        return view($file_name, $this->data);
    }
    public function flipview(Request $request, $id){
        
        $fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*',  \DB::raw("(CASE WHEN (tb_container_files.file_display_name = '') THEN tb_container_files.file_name ELSE tb_container_files.file_display_name END) as file_display_name"), 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_properties_images.id', $id)->get();
        $filepath = '';
        if(!empty($fileArr)){
            foreach($fileArr as $img){                
                $filepath = (new ContainerController)->getThumbpath($img->folder_id).$img->file_name;
            }
        }
        
        if($filepath!='')
		{
		    $path = $filepath;			
				$flipimgs = array();
				$fl=0;
					
					$flipimgs[$fl]['imgpath'] = $path;
					$flipimgs[$fl]['imgname'] = '';
					$flipimgs[$fl]['file_type'] = 'application/pdf';
					$flipimgs[$fl]['folder'] = '';
					
				$this->data['flips'] = $flipimgs;
				$this->data['fliptype'] = 'high';
                
				return view('users_admin.metronic.properties.flipbook', $this->data);
			
		}
		else
		{ 
		    $return = 'properties/?return=' . self::returnUrl();
			return Redirect::to($return)->with('messagetext','Contract has not uploaded yet.')->with('msgstatus','error');
		}
    }
    public function conatinerflip(Request $request, $id){
        
        //$fileArr = \DB::table('tb_properties_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_properties_images.file_id')->select('tb_properties_images.*',  \DB::raw("(CASE WHEN (tb_container_files.file_display_name = '') THEN tb_container_files.file_name ELSE tb_container_files.file_display_name END) as file_display_name"), 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_container_files.id', $id)->get();
        
        $fileArr = \DB::table('tb_container_files')->where('tb_container_files.id', $id)->get();
        
        //print_r($fileArr); die;
        $filepath = '';
        if(!empty($fileArr)){
            foreach($fileArr as $img){                
                $filepath = (new ContainerController)->getThumbpath($img->folder_id).$img->file_name;
            }
        }
        
        if($filepath!='')
		{
		    $path = $filepath;			
				$flipimgs = array();
				$fl=0;
					
					$flipimgs[$fl]['imgpath'] = $path;
					$flipimgs[$fl]['imgname'] = '';
					$flipimgs[$fl]['file_type'] = 'application/pdf';
					$flipimgs[$fl]['folder'] = '';
					
				$this->data['flips'] = $flipimgs;
				$this->data['fliptype'] = 'high';
                
				return view('users_admin.metronic.properties.flipbook', $this->data);
			
		}
		else
		{ 
		    $return = 'properties/?return=' . self::returnUrl();
			return Redirect::to($return)->with('messagetext','Contract has not uploaded yet.')->with('msgstatus','error');
		}
    }
    function salesoverview(Request $request){
        /*$pagination = $request->input('pagination');
        $sort = $request->input('sort');
        
        $page = $pagination['page'];
        $perpage = $pagination['perpage']; 
        $perpage = $pagination['total']; */
        $reportfor = $request->input('reportfor');
        $uid = \Session::get('uid');
        $property_ids = array();
        if($uid > 0){
            $assigned_property = \DB::table('tb_properties_users')->where('user_id', $uid)->get();
            if(!empty($assigned_property)){
                foreach($assigned_property as $prop){
                    $property_ids[] = $prop->property_id;
                }
            }
        }
        if(!empty($property_ids)){
            $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->get();                
        }
        
        $current_date = date('Y-m-d');
        if(trim($reportfor)=='today'){
            $current_date = date('Y-m-d');
            //$arrival_dep_arr = \DB::table('')
            if(!empty($property_ids)){
                $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->where('tb_reservations.created_date', $current_date)->get();                 
            }
        }elseif(trim($reportfor)=='Week'){
            
            $ts = strtotime($current_date);
            $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
            $from_date = date('Y-m-d', $start);
            $to_date = date('Y-m-d', strtotime('next saturday', $start));
            
            //$from_date = date('Y-m-01');            
            //$to_date = date("Y-m-t", strtotime($current_date));
            $to_from=array($from_date, $to_date);
            //print_r($to_from); die;
            $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->whereBetween('tb_reservations.created_date', $to_from)->get(); 
        }elseif(trim($reportfor)=='month'){
            
            $from_date = date('Y-m-01');            
            $to_date = date("Y-m-t", strtotime($current_date));
            $to_from=array($from_date, $to_date);
            
            $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->whereBetween('tb_reservations.created_date', $to_from)->get(); 
        }else{
            
            //$from_date = date('Y-m-01');            
            //$to_date = date("Y-m-t", strtotime($current_date));
            //$to_from=array($from_date, $to_date);
            $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->get();         
            
        }
        
        /*if(!empty($property_ids)){
            $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select CASE commission_type WHEN 'partial' THEN tb_users_contracts.partial_availability_commission ELSE tb_users_contracts.full_availability_commission END from tb_users_contracts where accepted_by=$uid and contract_type='commission') as comm"), \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->get();                
        }
        $hotel_com = 0;
        $commision = \DB::table('tb_users_contracts')->where('accepted_by', $uid)->where('contract_type', 'commission')->first();
        if(!empty($commision)){
            if($commision->commission_type=='partial'){
                $hotel_com = $commision->partial_availability_commission;
            }else{
                $hotel_com = $commision->full_availability_commission;
            }
        }         
        $reservations['commission'] = $hotel_com;*/
        
        $total = count($reservations);
        
        $res['status'] = 'success';
        $res['data'] = $reservations;
        
        return json_encode($res);
    }
    
    function salesstats(Request $request){
        
        $reportfor = $request->input('reportfor');
        $uid = \Session::get('uid');
        $property_ids = array();
        if($uid > 0){
            $assigned_property = \DB::table('tb_properties_users')->where('user_id', $uid)->get();
            if(!empty($assigned_property)){
                foreach($assigned_property as $prop){
                    $property_ids[] = $prop->property_id;
                }
            }
        }
        $arr_bookings = array();
        $arr_sales = array();
        $arr_commission = array();
        /*if(!empty($property_ids)){
            $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->get();   
            foreach($reservations as $reserv){
                $arr_bookings[] = $reserv->booking_number;
                $arr_sales[] = $reserv->total_price;
                $arr_commission[] = $reserv->total_commission;
            }             
        }*/
        $current_date = date('Y-m-d');
        if(trim($reportfor)=='today'){
            $current_date = date('Y-m-d');
            //$arrival_dep_arr = \DB::table('')
            if(!empty($property_ids)){
                $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->where('tb_reservations.created_date', $current_date)->get();                 
            }
        }elseif(trim($reportfor)=='Week'){
            
            $ts = strtotime($current_date);
            $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
            $from_date = date('Y-m-d', $start);
            $to_date = date('Y-m-d', strtotime('next saturday', $start));
            
            //$from_date = date('Y-m-01');            
            //$to_date = date("Y-m-t", strtotime($current_date));
            $to_from=array($from_date, $to_date);
            //print_r($to_from); die;
            $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->whereBetween('tb_reservations.created_date', $to_from)->get(); 
        }elseif(trim($reportfor)=='month'){
            
            $from_date = date('Y-m-01');            
            $to_date = date("Y-m-t", strtotime($current_date));
            $to_from=array($from_date, $to_date);
            
            $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->whereBetween('tb_reservations.created_date', $to_from)->get(); 
        }else{
            
            //$from_date = date('Y-m-01');            
            //$to_date = date("Y-m-t", strtotime($current_date));
            //$to_from=array($from_date, $to_date);
            $reservations = \DB::table('tb_reservations')->select('tb_reservations.*', 'tb_users.first_name', 'tb_users.last_name', \DB::raw("(Select count(td_reserved_rooms.reserved_room_id) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_rooms"), \DB::raw("(Select sum(td_reserved_rooms.booking_adults) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_adults"), \DB::raw("(Select sum(td_reserved_rooms.booking_children) from td_reserved_rooms where td_reserved_rooms.reservation_id=tb_reservations.id) as total_child"))->join('tb_users', 'tb_reservations.client_id', '=', 'tb_users.id')->whereIn('tb_reservations.property_id', $property_ids)->get();         
            
        }
        $arr_bookings = array();
        $arr_sales = array();
        $arr_commission = array();
        foreach($reservations as $reserv){
            $arr_bookings[] = $reserv->booking_number;
            $arr_sales[] = $reserv->total_price;
            $arr_commission[] = $reserv->total_commission;
        }   
        $bookings = implode(',', $arr_sales);
        $res['status'] = $bookings;
        $res['status'] = 'success';
        $res['data'] = array('bookings'=>$arr_bookings, 'sales'=>$arr_sales, 'commission'=>$arr_commission);
        
        return json_encode($res);
    }
    
    function getPropertyTypeRates(Request $request) {
        $uid = \Auth::user()->id;
        $propty = $request->input('propid');
		if($propty!='' && $propty > 0)
		{
			$cats = array();
			//$cats['usercomm'] = \DB::table('tb_users')->select('commission')->where('id', $uid)->first();
			$cat_rooms_price = \DB::table('tb_properties_category_rooms_price')->leftJoin('tb_properties_category_types','tb_properties_category_types.id','=','tb_properties_category_rooms_price.category_id')->leftJoin('tb_seasons','tb_seasons.id','=','tb_properties_category_rooms_price.season_id')->select('tb_seasons.season_name','tb_properties_category_rooms_price.rack_rate','tb_properties_category_types.category_name')->where('tb_properties_category_rooms_price.category_id', $propty)->get();
			if (!empty($cat_rooms_price)) {
				$cats['cat_rooms'] = $cat_rooms_price;
			}
			$res['status'] = 'success';
			$res['cat_rooms_price'] = $cats;
		}
		else {
			$res['status'] = 'error';
		}
		return json_encode($res);
    }
    
    function changeRoomStatus(Request $request) {
        $uid = \Auth::user()->id;
        $roomId = $request->input('room_id');
        //print_r($roomId); die;
        $sts = $request->input('status');
        //$catid = $request->input('catid');
        //$pid = $request->input('pid');
        $checkRoom = \DB::table('tb_properties_category_rooms')->where('id', $roomId)->count();
        //print_r($checkRoom); die;
        if ($checkRoom > 0) {
            //$ups = \DB::table('tb_properties_category_rooms')->uop->where('id', $roomId);
            $ups = \DB::table('tb_properties_category_rooms')->where('id', $roomId)->update(array('status' => $sts));
            $res['status'] = 'success';
            //$res['pid'] = $pid;
            //$res['catid'] = $catid;
            return json_encode($res);
        } else {
            $res['status'] = 'error';
            return json_encode($res);
        }
    }
    
    function postAddvattax( Request $request){
        $uid = \Auth::user()->id;
		$rules['name'] = 'required';
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['vat_tax_name'] = $request->input('name');
			$data['vat_tax_amount'] = $request->input('amount');
            
            $data['vat_tax_status'] = 1;
			//$data['user_id'] = $uid;
			if(!is_null($request->input('property_id')))
			{
				$data['property_id'] = $request->input('property_id');
			}
			if($request->input('edit_id')=='')
			{
				$data['created'] = date('Y-m-d h:i:s');
				$instype = 'add';
				$id = \DB::table('tb_vat_taxes')->insertGetId($data);                
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
				$instype = 'update';
				$id = \DB::table('tb_vat_taxes')->where('id', $request->input('edit_id'))->update($data);
			}
			
			/*$cplandata = array();
			$customplan = \DB::table('tb_properties_custom_plan')->where('id', $id)->first();
			if(!empty($customplan))
			{
				$cplandata = $customplan;
			}*/
			
			$res['status'] = 'success';
			//$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}    
    }
    function getEditvattax(Request $request){
        $vt_id = $request->input('pid');        
        $vattax = array();        
        if($vt_id > 0){ 
            $vattax = \DB::table('tb_vat_taxes')->where('id', $vt_id)->first();            
        }
        
        if(!empty($vattax)){
            $res['status'] = 'success';
            $res['vattax'] = $vattax;                       
        }else{
            $res['status'] = 'error';            
        }
        
        echo json_encode($res);
    }
    public function postDeletevattax( Request $request)
	{		
		$vtId = $request->input('vtId');
        if($vtId > 0){
            $deleteVT = \DB::table('tb_vat_taxes')->where('id', $vtId)->delete();            
        }
		if($deleteVT >0 )
		{			
			$res['status'] = 'success';
			return json_encode($res);
		}
		else
		{
			$res['status'] = 'error';
			return json_encode($res);
		}
	}
    
    function postAddboard( Request $request){
        $uid = \Auth::user()->id;
		$rules['board_name'] = 'required';
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['board_name'] = $request->input('board_name');
			$data['board_shortname'] = $request->input('board_shortname');
            $data['board_rackrate'] = $request->input('board_rackrate');
			$data['board_vat'] = $request->input('board_vat');
            
            $data['board_status'] = 1;			
			if(!is_null($request->input('property_id')))
			{
				$data['property_id'] = $request->input('property_id');
			}
			if($request->input('edit_id')=='')
			{
				$data['created'] = date('Y-m-d h:i:s');
				$instype = 'add';
				$id = \DB::table('tb_boards')->insertGetId($data);                
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
				$instype = 'update';
				$id = \DB::table('tb_boards')->where('id', $request->input('edit_id'))->update($data);
			}		
			
			$res['status'] = 'success';
			//$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}    
    }
    function getEditboard(Request $request){
        $bid = $request->input('bid');        
        $boards = array();        
        if($bid > 0){ 
            $boards = \DB::table('tb_boards')->where('id', $bid)->first();            
        }
        
        if(!empty($boards)){
            $res['status'] = 'success';
            $res['board'] = $boards;                       
        }else{
            $res['status'] = 'error';            
        }
        
        echo json_encode($res);
    }
    public function postDeleteboard( Request $request)
	{		
		$bId = $request->input('bId');
        if($bId > 0){
            $deleteB = \DB::table('tb_boards')->where('id', $bId)->delete();            
        }
		if($deleteB >0 )
		{			
			$res['status'] = 'success';
			return json_encode($res);
		}
		else
		{
			$res['status'] = 'error';
			return json_encode($res);
		}
	}
    
    function postAddroomsvat( Request $request){
        $uid = \Auth::user()->id;
		$rules['rooms_vat'] = 'required';
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['vattax_id'] = $request->input('rooms_vat');
					
			if(!is_null($request->input('property_id')))
			{
				//$data['property_id'] = $request->input('property_id');
			
				$data['updated'] = date('Y-m-d h:i:s');
				$instype = 'update';
				$id = \DB::table('tb_properties')->where('id', $request->input('property_id'))->update($data);
			}		
			
			$res['status'] = 'success';
			//$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}    
    }
}
