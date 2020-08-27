<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Customplan;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class CustomplanController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'customplan';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Customplan();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'customplan',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request )
	{

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		
		return view('customplan.index',$this->data);
	}	



	function getUpdate(Request $request, $id = null)
	{
	
		if($id =='')
		{
			if($this->access['is_add'] ==0 )
			return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
		}	
		
		if($id !='')
		{
			if($this->access['is_edit'] ==0 )
			return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
		}				
				
		$this->data['access']		= $this->access;
		return view('customplan.form',$this->data);
	}	

	public function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
					
		
		$this->data['access']		= $this->access;
		return view('customplan.view',$this->data);	
	}	

	function postSave( Request $request)
	{
		
	
	}	

	public function postDelete( Request $request)
	{
		
		if($this->access['is_remove'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		
	}
    public function postDeleteplan( Request $request)
	{		
		/*if($this->access['is_remove'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');*/                
		
		$cseason_Id = $request->input('cseason_Id');
        if($cseason_Id > 0){
            \DB::table('tb_property_custom_plan_seasons')->where('plan_id', $cseason_Id)->delete();
            $checkcseason = \DB::table('tb_properties_custom_plan')->where('id', $cseason_Id)->delete();
        }
		if($checkcseason>0)
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
    function addcustomplan( Request $request)
	{
		$uid = \Auth::user()->id;
		$rules['plan_title'] = 'required';
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['title'] = $request->input('plan_title');
			$data['description'] = $request->input('plan_desc');
            $data['terms_and_condition'] = $request->input('plan_tac');
            
            $data['start_date'] = $request->input('plan_start_date');
            $data['end_date'] = $request->input('plan_end_date');
            $data['no_of_days'] = $request->input('plan_no_of_days');
            $data['plan_price'] = $request->input('plan_price');
            
            $seasons = $request->input('plan_season');
            
            //$data['plan_season'] = $request->input('plan_season');
            $data['price_type'] = $request->input('price_type');
            //print_r($data); die;
            $data['status'] = 0;
			//$data['user_id'] = $uid;
			if(!is_null($request->input('property_id')))
			{
				$data['property_id'] = $request->input('property_id');
			}
			if($request->input('edit_customplan_id')=='')
			{
				$data['created'] = date('Y-m-d h:i:s');
				$instype = 'add';
				$id = \DB::table('tb_properties_custom_plan')->insertGetId($data);
                if($id > 0){
                    
                    if(!empty($seasons)){
                        foreach($seasons as $si){                            
                            $s_p = array(
                                'plan_id'=>$id,
                                'season_id'=>$si,       
                            );
                            \DB::table('tb_property_custom_plan_seasons')->insert($s_p);      
                        }
                    }
                }
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
				$instype = 'update';
				$id = \DB::table('tb_properties_custom_plan')->where('id', $request->input('edit_customplan_id'))->update($data);
			}
			
			$cplandata = array();
			$customplan = \DB::table('tb_properties_custom_plan')->where('id', $id)->first();
			if(!empty($customplan))
			{
				$cplandata = $customplan;
			}
			
			$res['status'] = 'success';
			$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}	
	
	}
    
    function getEditplan(Request $request){
        $plan_id = $request->input('pid');
        $cplan = array();
        $cplan_seas = array();
        $cp_ars = array();
        $cp_booking_days = array();
        $cp_staying_days = array();
        $cpitems = array();
        if($plan_id > 0){
            $cplan = \DB::table('tb_properties_custom_plan')->where('id', $plan_id)->first();
            $cplan_roomtypes = \DB::table('tb_custom_plan_roomtypes')->where('custom_plan_id', $plan_id)->get();
            $cpab = \DB::table('tb_custom_plan_available_boards')->where('custom_plan_id', $plan_id)->get();
            $cplan_tags = \DB::table('tb_custom_plan_tags')->where('custom_plan_id', $plan_id)->first(); 
            //$cplan_seasons = \DB::table('tb_property_custom_plan_seasons')->select('season_id')->where('plan_id', $plan_id)->get();
            $cpitems = \DB::table('tb_custom_plan_items_inc_exc')->where('custom_plan_id', $plan_id)->get();
            if(!empty($cplan_seasons)){
                foreach($cplan_seasons as $se){
                    $cplan_seas[] = $se->season_id;         
                }
            }            
            
                
            if(!empty($cplan_roomtypes)){ //print_r($cplan_roomtypes); die;
                foreach($cplan_roomtypes as $se){
                    $cp_ars[] = $se->property_type_id;         
                }
            }
                        
            $cp_bookings = \DB::table('tb_custom_plan_booking_days')->where('custom_plan_id', $plan_id)->get(); 
            if(!empty($cp_bookings)){ 
                foreach($cp_bookings as $se){
                    $cp_booking_days[] = $se->booking_days;         
                }
            } 
                
            $cp_staying = \DB::table('tb_custom_plan_staying_days')->where('custom_plan_id', $plan_id)->get(); 
            if(!empty($cp_staying)){ 
                foreach($cp_staying as $se){
                    $cp_staying_days[] = $se->staying_days;         
                }
            }       
        }
        
        if(!empty($cplan)){
            $res['status'] = 'success';
            $res['plan'] = $cplan;
            $res['seasons'] = $cplan_seas;  
            $res['cplan_tags'] = $cplan_tags;
            $res['cpab'] = $cpab;
            $res['cpitems'] = $cpitems;  
            $res['cp_ars'] = $cp_ars;
            $res['booking_days'] = $cp_booking_days;
            $res['staying_days'] = $cp_staying_days;        
        }else{
            $res['status'] = 'error';            
        }
        
        echo json_encode($res);
    }
    function postUpdatecustomplan( Request $request)
	{
		$uid = \Auth::user()->id;
		$rules['modal_plan_title'] = 'required';
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['title'] = $request->input('modal_plan_title');
			$data['description'] = $request->input('modal_plan_desc');
            $data['terms_and_condition'] = $request->input('modal_plan_tac');
            
            $data['start_date'] = $request->input('modal_plan_start_date');
            $data['end_date'] = $request->input('modal_plan_end_date');
            $data['no_of_days'] = $request->input('modal_plan_no_of_days');
            $data['plan_price'] = $request->input('modal_plan_price');
            
            $seasons = $request->input('modal_plan_season');
            
            //$data['plan_season'] = $request->input('plan_season');
            $data['price_type'] = $request->input('modal_price_type');
            //print_r($data); die;
            $data['status'] = 0;
			//$data['user_id'] = $uid;
			if(!is_null($request->input('modal_property_id')))
			{
				$data['property_id'] = $request->input('modal_property_id');
			}
			if($request->input('modal_edit_customplan_id')=='')
			{
				$data['created'] = date('Y-m-d h:i:s');
				$instype = 'add';
				$id = \DB::table('tb_properties_custom_plan')->insertGetId($data);
                if($id > 0){
                    
                    if(!empty($seasons)){
                        foreach($seasons as $si){                            
                            $s_p = array(
                                'plan_id'=>$id,
                                'season_id'=>$si,       
                            );
                            \DB::table('tb_property_custom_plan_seasons')->insert($s_p);      
                        }
                    }
                }
                $res['msg'] = 'Custom Plan added Successfully';
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
                $edit_id = $request->input('modal_edit_customplan_id');
				$instype = 'update';
				$id = \DB::table('tb_properties_custom_plan')->where('id', $request->input('modal_edit_customplan_id'))->update($data);
                if(!empty($seasons)){
                    if($edit_id !=''){
                        \DB::table('tb_property_custom_plan_seasons')->where('plan_id', $edit_id)->delete();
                        foreach($seasons as $si){                            
                            $s_p = array(
                                'plan_id'=>$edit_id,
                                'season_id'=>$si,       
                            );
                            \DB::table('tb_property_custom_plan_seasons')->insert($s_p);      
                        }
                    }
                }
                $res['msg'] = 'Custom Plan updated Successfully';
			}
			
			$cplandata = array();
			$customplan = \DB::table('tb_properties_custom_plan')->where('id', $id)->first();
			if(!empty($customplan))
			{
				$cplandata = $customplan;
			}
			
			$res['status'] = 'success';
			$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}	
	
	}
    
    function getGlobalcustomplan(Request $request){        
        $this->data['access']		= $this->access;
        $seasons = \DB::table('tb_seasons')->get();
        $this->data['seasons'] = $seasons;
        $this->data['customseasons'] = \DB::table('tb_properties_custom_plan')->get();
		return view('customplan.globalcustomplan',$this->data);   
    }
    
    function getEditglobalplan(Request $request){
        $plan_id = $request->input('pid');
        $cplan = array();
        $cplan_seas = array();
        if($plan_id > 0){
            $cplan = \DB::table('tb_global_custom_plan')->where('id', $plan_id)->first();
            //$cplan_seasons = \DB::table('tb_property_custom_plan_seasons')->select('season_id')->where('plan_id', $plan_id)->get();
            if(!empty($cplan_seasons)){
                foreach($cplan_seasons as $se){
                    $cplan_seas[] = $se->season_id;         
                }
            }    
        }
        
        if(!empty($cplan)){
            $res['status'] = 'success';
            $res['plan'] = $cplan;
            $res['seasons'] = $cplan_seas;            
        }else{
            $res['status'] = 'error';            
        }
        
        echo json_encode($res);
    }
    
    function postUpdateglobalplan( Request $request)
	{
		$uid = \Auth::user()->id;
		$rules['global_plan_title'] = 'required';
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['title'] = $request->input('global_plan_title');
			$data['description'] = $request->input('global_plan_desc');
            $data['terms_and_condition'] = $request->input('global_plan_tac');
            
            $data['start_date'] = $request->input('global_plan_start_date');
            $data['end_date'] = $request->input('global_plan_end_date');
            $data['no_of_days'] = $request->input('global_plan_no_of_days');
            $data['plan_price'] = $request->input('global_plan_price');
            
            $seasons = $request->input('global_plan_season');
            
            //$data['plan_season'] = $request->input('plan_season');
            $data['price_type'] = $request->input('global_price_type');
            //print_r($data); die;
            //$data['status'] = 1;
			//$data['user_id'] = $uid;
			if(!is_null($request->input('global_property_id')))
			{
				$data['property_id'] = $request->input('global_property_id');
			}
			if($request->input('global_edit_customplan_id')!='')
			{
                $check = \DB::table('tb_global_custom_plan_override')->where('global_plan_id', $request->input('global_edit_customplan_id'))->first();
                if(!empty($check)){
                    $data['updated'] = date('Y-m-d h:i:s');
                    $edit_id = $request->input('global_edit_customplan_id');
    				$instype = 'update';
    				$id = \DB::table('tb_global_custom_plan_override')->where('global_plan_id', $request->input('global_edit_customplan_id'))->update($data);
                    if(!empty($seasons)){
                        if($edit_id !=''){
                            \DB::table('tb_property_custom_plan_seasons')->where('plan_id', $edit_id)->delete();
                            foreach($seasons as $si){                            
                                $s_p = array(
                                    'plan_id'=>$edit_id,
                                    'season_id'=>$si,       
                                );
                                //\DB::table('tb_property_custom_plan_seasons')->insert($s_p);      
                            }
                        }
                    }
                    $res['msg'] = 'Custom Plan updated Successfully';        
                }else{
                    $data['global_plan_id'] = $request->input('global_edit_customplan_id');
    				$data['created'] = date('Y-m-d h:i:s');
    				$instype = 'add';
    				$id = \DB::table('tb_global_custom_plan_override')->insertGetId($data);
                    if($id > 0){
                        
                        if(!empty($seasons)){
                            foreach($seasons as $si){                            
                                $s_p = array(
                                    'plan_id'=>$id,
                                    'season_id'=>$si,       
                                );
                                //\DB::table('tb_property_custom_plan_seasons')->insert($s_p);      
                            }
                        }
                    }
                    $res['msg'] = 'Custom Plan added Successfully';
                }
			}			
			
			$cplandata = array();
			$customplan = \DB::table('tb_properties_custom_plan')->where('id', $id)->first();
			if(!empty($customplan))
			{
				$cplandata = $customplan;
			}
			
			$res['status'] = 'success';
			$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}	
	
	}
    
    function postUpdatecustomplandetails__( Request $request)
	{
		$uid = \Auth::user()->id;
		$rules['plan_title'] = 'required';
        //print_r($request->all()); die;
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['title'] = $request->input('plan_title');
            $room_types = $request->input('room_types');
            
            $data['plan_price'] = $request->input('plan_price');
            $data['price_type'] = $request->input('price_type');
			//$data['description'] = $request->input('modal_plan_desc');
            //$data['terms_and_condition'] = $request->input('modal_plan_tac');
            
            //$data['start_date'] = $request->input('modal_plan_start_date');
            //$data['end_date'] = $request->input('modal_plan_end_date');
            
            $data['card_rule'] = $request->input('card_rule');
            $data['booking_code'] = $request->input('booking_code');
            $data['no_of_days'] = $request->input('days_id_advance');
            
            
            //$seasons = $request->input('modal_plan_season');
            
            $abs = $request->input('abs');
            
            //$data['plan_season'] = $request->input('plan_season');
            
            //print_r($data); die;
            $data['status'] = 0;
			//$data['user_id'] = $uid;
			if(!is_null($request->input('property_id_details')))
			{
				$data['property_id'] = $request->input('property_id_details');
			}
            
            
            
			if($request->input('edit_id_details')=='')
			{
				$data['created'] = date('Y-m-d h:i:s');
				$instype = 'add';
				$id = \DB::table('tb_properties_custom_plan')->insertGetId($data);                
               
                if($id > 0){                    
                    if(!empty($room_types)){
                        foreach($room_types as $si){                            
                            $s_p = array(
                                'custom_plan_id'=>$id,
                                'property_type_id'=>$si,       
                            );
                            \DB::table('tb_custom_plan_roomtypes')->insert($s_p);      
                        }
                    }
                    if(!empty($abs)){
                        foreach($abs as $si){
                            $abs_data = array(
                                'custom_plan_id'=>$id,
                                'board_id'=>$si,
                                'board_inc_ex'=>$request->input('ab_inc_exc_'.$si),
                            );
                            \DB::table('tb_custom_plan_available_boards')->insert($abs_data);
                        }
                    }
                }
                /*if($id > 0){
                    
                    if(!empty($seasons)){
                        foreach($seasons as $si){                            
                            $s_p = array(
                                'plan_id'=>$id,
                                'season_id'=>$si,       
                            );
                            \DB::table('tb_property_custom_plan_seasons')->insert($s_p);      
                        }
                    }
                }*/
                $res['msg'] = 'Custom Plan added Successfully';
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
                $edit_id = $request->input('edit_id_details');
				$instype = 'update';
				$id = \DB::table('tb_properties_custom_plan')->where('id', $request->input('edit_id_details'))->update($data);
                
                if(!empty($room_types)){
                    if($edit_id !=''){
                        \DB::table('tb_custom_plan_roomtypes')->where('custom_plan_id', $edit_id)->delete();
                        foreach($room_types as $si){                            
                            $s_p = array(
                                'custom_plan_id'=>$edit_id,
                                'property_type_id'=>$si,       
                            );
                            \DB::table('tb_custom_plan_roomtypes')->insert($s_p);      
                        }
                    }
                }
                if(!empty($abs)){
                    \DB::table('tb_custom_plan_available_boards')->where('custom_plan_id', $edit_id)->delete();
                    foreach($abs as $si){
                        $abs_data = array(
                            'custom_plan_id'=>$id,
                            'board_id'=>$si,
                            'board_inc_ex'=>$request->input('ab_inc_exc_'.$si),
                        );
                        \DB::table('tb_custom_plan_available_boards')->insert($abs_data);
                    }
                }
                /*if(!empty($seasons)){
                    if($edit_id !=''){
                        \DB::table('tb_property_custom_plan_seasons')->where('plan_id', $edit_id)->delete();
                        foreach($seasons as $si){                            
                            $s_p = array(
                                'plan_id'=>$edit_id,
                                'season_id'=>$si,       
                            );
                            \DB::table('tb_property_custom_plan_seasons')->insert($s_p);      
                        }
                    }
                }*/
                $res['msg'] = 'Custom Plan updated Successfully';
			}
			
			$cplandata = array();
			$customplan = \DB::table('tb_properties_custom_plan')->where('id', $id)->first();
			if(!empty($customplan))
			{
				$cplandata = $customplan;
			}
			
			$res['status'] = 'success';
			$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}	
	
	}
    
    function postUpdatecustomplandetails( Request $request)
	{
		$uid = \Auth::user()->id;
		$rules['plan_title'] = 'required';
        //print_r($request->all()); die;
        //$p_img = $request->input('plan_image');
        //$file = Input::file('plan_image');
        //print_r($file);  die;
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['title'] = $request->input('plan_title');
            $room_types = $request->input('room_types');            
            $data['plan_price'] = $request->input('plan_price');
            $data['price_type'] = $request->input('price_type'); 
            
            $data['available_board'] = $request->input('ab');
                       
            $data['card_rule'] = $request->input('card_rule');
            $data['booking_code'] = $request->input('booking_code');
            $data['no_of_days'] = $request->input('days_id_advance');            
            $data['min_stay'] = $request->input('min_stay');
            $data['max_stay'] = $request->input('max_stay');  
            
            $data['booking_start_date'] = $request->input('plan_booking_start_date');                        
            $data['booking_end_date'] = $request->input('plan_booking_end_date');
            $data['booking_season'] = $request->input('plan_booking_season');            
            $booking_available_days = $request->input('booking_available_days');
            //print_r($booking_available_days);
            $data['staying_start_date'] = $request->input('plan_staying_start_date');                        
            $data['staying_end_date'] = $request->input('plan_staying_end_date');
            $data['staying_season'] = $request->input('plan_staying_season');            
            $staying_available_days = $request->input('staying_available_days');
            //print_r($staying_available_days); die;
            $tdata['pre_payment'] = $request->input('tag_pre_payment');
            $tdata['deposit'] = $request->input('tag_diposit');            
            $tdata['non_refundable_deposit'] = $request->input('tag_non_refundable_diposit');
            $tdata['non_refundable_rate'] = $request->input('tag_non_refundable_rate');
            $tdata['no_credit_card_required'] = $request->input('tag_no_credit_card_required');            
            $tdata['free_cancellation'] = $request->input('tag_free_cancellation');            
            $tdata['most_popular_rates'] = $request->input('tag_most_popular_rate');            
            $tdata['one_per_discount'] = $request->input('tag_one_per_discount');
            $tdata['discounted_rate'] = $request->input('tag_discounted_rate');
            $tdata['standard_rate'] = $request->input('tag_standard_rate');            
            $tdata['breakfast_included'] = $request->input('tag_breakfast_included');
            $tdata['no_board_included'] = $request->input('tag_no_board_included');            
            $tdata['fullboard_included'] = $request->input('tag_fullboard_included');
            $tdata['all_inclusive'] = $request->input('tag_all_inclusive');
             
            
            $data['description'] = $request->input('plan_description');
            $data['terms_and_condition'] = $request->input('plan_terms_and_conditions');
            //print_r($data); die;
            //$data['start_date'] = $request->input('modal_plan_start_date');
            //$data['end_date'] = $request->input('modal_plan_end_date');
            //$seasons = $request->input('modal_plan_season');
            
            $abs = $request->input('abs');
            
            $h_item = $request->input('hid_item');
            //tb_custom_plan_items_inc_exc
            //$data['plan_season'] = $request->input('plan_season');
            
            //print_r($data); die;
            $data['status'] = 0;
			//$data['user_id'] = $uid;
            
            $destinationPath = public_path() . '/uploads/properties_customplan_imgs/';
            if (!is_null($request->file('plan_image1'))) {
                $cplan_file = $request->file('plan_image1');
                $cplan_filename = $cplan_file->getClientOriginalName();
                $cplan_extension = $cplan_file->getClientOriginalExtension(); //if you need extension of the file
                $cplan_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $cplan_extension;
                $cplan_uploadSuccess = $cplan_file->move($destinationPath, $cplan_filename);
                if ($cplan_uploadSuccess) {
                    $data['plan_img1'] = $cplan_filename;
                }
            }  
            if (!is_null($request->file('plan_image2'))) {
                $cplan_file = $request->file('plan_image2');
                $cplan_filename = $cplan_file->getClientOriginalName();
                $cplan_extension = $cplan_file->getClientOriginalExtension(); //if you need extension of the file
                $cplan_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $cplan_extension;
                $cplan_uploadSuccess = $cplan_file->move($destinationPath, $cplan_filename);
                if ($cplan_uploadSuccess) {
                    $data['plan_img2'] = $cplan_filename;
                }
            }  
            if (!is_null($request->file('plan_image3'))) {
                $cplan_file = $request->file('plan_image3');
                $cplan_filename = $cplan_file->getClientOriginalName();
                $cplan_extension = $cplan_file->getClientOriginalExtension(); //if you need extension of the file
                $cplan_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $cplan_extension;
                $cplan_uploadSuccess = $cplan_file->move($destinationPath, $cplan_filename);
                if ($cplan_uploadSuccess) {
                    $data['plan_img3'] = $cplan_filename;
                }
            }  
            $data['youtube_url'] = $request->input('plan_youtube_url');          
			if(!is_null($request->input('property_id_details')))
			{
				$data['property_id'] = $request->input('property_id_details');
			}
            
            
            
			if($request->input('edit_id_details')=='')
			{
				$data['created'] = date('Y-m-d h:i:s');
				$instype = 'add';
				$id = \DB::table('tb_properties_custom_plan')->insertGetId($data);                
               
                if($id > 0){                    
                    if(!empty($room_types)){
                        foreach($room_types as $si){                            
                            $s_p = array(
                                'custom_plan_id'=>$id,
                                'property_type_id'=>$si,       
                            );
                            \DB::table('tb_custom_plan_roomtypes')->insert($s_p);      
                        }
                    }
                    if(!empty($abs)){
                        foreach($abs as $si){
                            $abs_data = array(
                                'custom_plan_id'=>$id,
                                'board_id'=>$si,
                                'board_inc_ex'=>$request->input('ab_inc_exc_'.$si),
                            );
                            \DB::table('tb_custom_plan_available_boards')->insert($abs_data);
                        }
                    }
                    if(!empty($h_item)){
                        foreach($h_item as $si){
                            $items_data = array(
                                'custom_plan_id'=>$id,
                                'item_id'=>$si,
                                'item_inc_ex'=>$request->input('it_inc_exc_'.$si),
                            );
                            \DB::table('tb_custom_plan_items_inc_exc')->insert($items_data);
                        }
                    }                    
                    $tdata['custom_plan_id'] = $id;
                    \DB::table('tb_custom_plan_tags')->insert($tdata);
                    
                    if(!empty($booking_available_days)){
                        foreach($booking_available_days as $si){                            
                            $s_p = array(
                                'custom_plan_id'=>$id,
                                'booking_days'=>$si,       
                            );
                            \DB::table('tb_custom_plan_booking_days')->insert($s_p);      
                        }
                    }
                    if(!empty($staying_available_days)){
                        foreach($staying_available_days as $si){                            
                            $s_p = array(
                                'custom_plan_id'=>$id,
                                'staying_days'=>$si,       
                            );
                            \DB::table('tb_custom_plan_staying_days')->insert($s_p);      
                        }
                    }
                }
                /*if($id > 0){
                    
                    if(!empty($seasons)){
                        foreach($seasons as $si){                            
                            $s_p = array(
                                'plan_id'=>$id,
                                'season_id'=>$si,       
                            );
                            \DB::table('tb_property_custom_plan_seasons')->insert($s_p);      
                        }
                    }
                }*/
                $res['msg'] = 'Custom Plan added Successfully';
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
                $edit_id = $request->input('edit_id_details');
				$instype = 'update';
				$id = \DB::table('tb_properties_custom_plan')->where('id', $request->input('edit_id_details'))->update($data);
                
                if(!empty($room_types)){
                    if($edit_id !=''){
                        \DB::table('tb_custom_plan_roomtypes')->where('custom_plan_id', $edit_id)->delete();
                        foreach($room_types as $si){                            
                            $s_p = array(
                                'custom_plan_id'=>$edit_id,
                                'property_type_id'=>$si,       
                            );
                            \DB::table('tb_custom_plan_roomtypes')->insert($s_p);      
                        }
                    }
                }
                if(!empty($abs)){
                    \DB::table('tb_custom_plan_available_boards')->where('custom_plan_id', $edit_id)->delete();
                    foreach($abs as $si){
                        $abs_data = array(
                            'custom_plan_id'=>$id,
                            'board_id'=>$si,
                            'board_inc_ex'=>$request->input('ab_inc_exc_'.$si),
                        );
                        \DB::table('tb_custom_plan_available_boards')->insert($abs_data);
                    }
                }
                if(!empty($h_item)){
                    \DB::table('tb_custom_plan_items_inc_exc')->where('custom_plan_id', $edit_id)->delete();
                    foreach($h_item as $si){
                        $its_data = array(
                            'custom_plan_id'=>$id,
                            'item_id'=>$si,
                            'item_inc_ex'=>$request->input('eit_inc_exc_'.$si),
                        );
                        \DB::table('tb_custom_plan_items_inc_exc')->insert($its_data);
                    }
                }
                \DB::table('tb_custom_plan_tags')->where('custom_plan_id', $edit_id)->delete();
                $tdata['custom_plan_id'] = $id;
                \DB::table('tb_custom_plan_tags')->insert($tdata);
                /*if(!empty($seasons)){
                    if($edit_id !=''){
                        \DB::table('tb_property_custom_plan_seasons')->where('plan_id', $edit_id)->delete();
                        foreach($seasons as $si){                            
                            $s_p = array(
                                'plan_id'=>$edit_id,
                                'season_id'=>$si,       
                            );
                            \DB::table('tb_property_custom_plan_seasons')->insert($s_p);      
                        }
                    }
                }*/
                
                if(!empty($booking_available_days)){
                    \DB::table('tb_custom_plan_booking_days')->where('custom_plan_id', $edit_id)->delete();
                    foreach($booking_available_days as $si){                            
                        $s_p = array(
                            'custom_plan_id'=>$id,
                            'booking_days'=>$si,       
                        );
                        \DB::table('tb_custom_plan_booking_days')->insert($s_p);      
                    }
                }
                if(!empty($staying_available_days)){
                    \DB::table('tb_custom_plan_staying_days')->where('custom_plan_id', $edit_id)->delete();
                    foreach($staying_available_days as $si){                            
                        $s_p = array(
                            'custom_plan_id'=>$id,
                            'staying_days'=>$si,       
                        );
                        \DB::table('tb_custom_plan_staying_days')->insert($s_p);      
                    }
                }
                
                $res['msg'] = 'Custom Plan updated Successfully';
			}
			
			$cplandata = array();
			$customplan = \DB::table('tb_properties_custom_plan')->where('id', $id)->first();
			if(!empty($customplan))
			{
				$cplandata = $customplan;
			}
			
			$res['status'] = 'success';
			$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}	
	
	}
    
    function postCustomplandetails( Request $request)
	{ 
		$uid = \Auth::user()->id;
		$rules['eplan_title'] = 'required';
        //print_r($request->all()); die;
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['title'] = $request->input('eplan_title');
            $room_types = $request->input('eroom_types');            
            $data['plan_price'] = $request->input('eplan_price');
            $data['price_type'] = $request->input('eprice_type');            
            $data['card_rule'] = $request->input('ecard_rule');
            $data['booking_code'] = $request->input('ebooking_code');
            $data['no_of_days'] = $request->input('edays_id_advance');            
            $data['min_stay'] = $request->input('emin_stay');
            $data['max_stay'] = $request->input('emax_stay');
            
            $abs = $request->input('abs');
            $h_item = $request->input('ehid_item');
            //$data['status'] = 0;	
            $data['available_board'] = $request->input('eab');		
			if(!is_null($request->input('eproperty_id_details')))
			{
				$data['property_id'] = $request->input('eproperty_id_details');
			}            
			
    		$data['updated'] = date('Y-m-d h:i:s');
            $edit_id = $request->input('eedit_id_details');
    		$instype = 'update';
    		$id = \DB::table('tb_properties_custom_plan')->where('id', $request->input('eedit_id_details'))->update($data);
            
            if(!empty($room_types)){
                if($edit_id !=''){
                    \DB::table('tb_custom_plan_roomtypes')->where('custom_plan_id', $edit_id)->delete();
                    foreach($room_types as $si){                            
                        $s_p = array(
                            'custom_plan_id'=>$edit_id,
                            'property_type_id'=>$si,       
                        );
                        \DB::table('tb_custom_plan_roomtypes')->insert($s_p);      
                    }
                }
            }
            if(!empty($abs)){
                \DB::table('tb_custom_plan_available_boards')->where('custom_plan_id', $edit_id)->delete();
                foreach($abs as $si){
                    $abs_data = array(
                        'custom_plan_id'=>$id,
                        'board_id'=>$si,
                        'board_inc_ex'=>$request->input('ab_inc_exc_'.$si),
                    );
                    \DB::table('tb_custom_plan_available_boards')->insert($abs_data);
                }
            }            
            if(!empty($h_item)){
                    \DB::table('tb_custom_plan_items_inc_exc')->where('custom_plan_id', $edit_id)->delete();
                    foreach($h_item as $si){
                        $its_data = array(
                            'custom_plan_id'=>$edit_id,
                            'item_id'=>$si,
                            'item_inc_ex'=>$request->input('eit_inc_exc_'.$si),
                        );
                        \DB::table('tb_custom_plan_items_inc_exc')->insert($its_data);
                    }
                }
            $res['msg'] = 'Custom Plan updated Successfully';		
			
			$cplandata = array();
			$customplan = \DB::table('tb_properties_custom_plan')->where('id', $id)->first();
			if(!empty($customplan))
			{
				$cplandata = $customplan;
			}
			
			$res['status'] = 'success';
			$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}	
	
	}
    
    function postCustomplandtags( Request $request)
	{
		$uid = \Auth::user()->id;
		//$rules['eplan_title'] = 'required';
        //print_r($request->all()); die;
		//$validator = Validator::make($request->all(), $rules);	
		//if ($validator->passes()) {
		      
			$tdata['pre_payment'] = $request->input('etag_pre_payment');
            $tdata['deposit'] = $request->input('etag_diposit');            
            $tdata['non_refundable_deposit'] = $request->input('etag_non_refundable_diposit');
            $tdata['non_refundable_rate'] = $request->input('etag_non_refundable_rate');
            $tdata['no_credit_card_required'] = $request->input('etag_no_credit_card_required');            
            $tdata['free_cancellation'] = $request->input('etag_free_cancellation');            
            $tdata['most_popular_rates'] = $request->input('etag_most_popular_rate');            
            $tdata['one_per_discount'] = $request->input('etag_one_per_discount');
            $tdata['discounted_rate'] = $request->input('etag_discounted_rate');
            $tdata['standard_rate'] = $request->input('etag_standard_rate');            
            $tdata['breakfast_included'] = $request->input('etag_breakfast_included');
            $tdata['no_board_included'] = $request->input('etag_no_board_included');            
            $tdata['fullboard_included'] = $request->input('etag_fullboard_included');
            $tdata['all_inclusive'] = $request->input('etag_all_inclusive');           
			
    		$data['updated'] = date('Y-m-d h:i:s');
            $edit_id = $request->input('tag_edit_id');
    		$instype = 'update';
    		\DB::table('tb_custom_plan_tags')->where('custom_plan_id', $edit_id)->delete();
            $tdata['custom_plan_id'] = $edit_id;
            \DB::table('tb_custom_plan_tags')->insert($tdata);                    
            
            $res['msg'] = 'Custom Plan updated Successfully';		
			
			$cplandata = array();
			//$customplan = \DB::table('tb_properties_custom_plan')->where('id', $id)->first();
			//if(!empty($customplan))
			//{
				//$cplandata = $customplan;
			//}
			
			$res['status'] = 'success';
			//$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		//} else {
		//	$res['status'] = 'error';
		//	$res['errors'] = $validator->errors()->all();
		//	return json_encode($res);
		//}	
	
	}
    
    function postEditcustomplanap( Request $request)
	{
		$uid = \Auth::user()->id;
		//$rules['eplan_title'] = 'required';
        //print_r($request->all()); die;
		//$validator = Validator::make($request->all(), $rules);	
		//if ($validator->passes()) {
		      
			$data['booking_start_date'] = $request->input('eplan_booking_start_date');                        
            $data['booking_end_date'] = $request->input('eplan_booking_end_date');
            $data['booking_season'] = $request->input('eplan_booking_season');            
            $booking_available_days = $request->input('ebooking_available_days');
            //print_r($booking_available_days);
            $data['staying_start_date'] = $request->input('eplan_staying_start_date');                        
            $data['staying_end_date'] = $request->input('eplan_staying_end_date');
            $data['staying_season'] = $request->input('eplan_staying_season');            
            $staying_available_days = $request->input('estaying_available_days');          
			//print_r($staying_available_days);
    		$data['updated'] = date('Y-m-d h:i:s');
            $edit_id = $request->input('ap_edit_id');
    		$instype = 'update';
            //die;
            $id = \DB::table('tb_properties_custom_plan')->where('id', $edit_id)->update($data);
            
    		if(!empty($booking_available_days)){
                \DB::table('tb_custom_plan_booking_days')->where('custom_plan_id', $edit_id)->delete();
                foreach($booking_available_days as $si){                            
                    $s_p = array(
                        'custom_plan_id'=>$edit_id,
                        'booking_days'=>$si,       
                    );
                    \DB::table('tb_custom_plan_booking_days')->insert($s_p);      
                }
            }
            if(!empty($staying_available_days)){
                \DB::table('tb_custom_plan_staying_days')->where('custom_plan_id', $edit_id)->delete();
                foreach($staying_available_days as $si){                            
                    $s_p = array(
                        'custom_plan_id'=>$edit_id,
                        'staying_days'=>$si,       
                    );
                    \DB::table('tb_custom_plan_staying_days')->insert($s_p);      
                }
            }                 
            
            $res['msg'] = 'Custom Plan updated Successfully';		
			
			$cplandata = array();
			//$customplan = \DB::table('tb_properties_custom_plan')->where('id', $id)->first();
			//if(!empty($customplan))
			//{
				//$cplandata = $customplan;
			//}
			
			$res['status'] = 'success';
			//$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		//} else {
		//	$res['status'] = 'error';
		//	$res['errors'] = $validator->errors()->all();
		//	return json_encode($res);
		//}	
	
	}
    
    function postEditcustomplandesc( Request $request)
	{
		$uid = \Auth::user()->id;
		//$rules['eplan_title'] = 'required';
        //print_r($request->all()); die;
		//$validator = Validator::make($request->all(), $rules);	
		//if ($validator->passes()) {
		      
			$data['description'] = $request->input('eplan_description');
            
            $destinationPath = public_path() . '/uploads/properties_customplan_imgs/';
            if (!is_null($request->file('eplan_image1'))) {
                $cplan_file = $request->file('eplan_image1');
                $cplan_filename = $cplan_file->getClientOriginalName();
                $cplan_extension = $cplan_file->getClientOriginalExtension(); //if you need extension of the file
                $cplan_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $cplan_extension;
                $cplan_uploadSuccess = $cplan_file->move($destinationPath, $cplan_filename);
                if ($cplan_uploadSuccess) {
                    $data['plan_img1'] = $cplan_filename;
                }
            }  
            if (!is_null($request->file('eplan_image2'))) {
                $cplan_file = $request->file('eplan_image2');
                $cplan_filename = $cplan_file->getClientOriginalName();
                $cplan_extension = $cplan_file->getClientOriginalExtension(); //if you need extension of the file
                $cplan_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $cplan_extension;
                $cplan_uploadSuccess = $cplan_file->move($destinationPath, $cplan_filename);
                if ($cplan_uploadSuccess) {
                    $data['plan_img2'] = $cplan_filename;
                }
            }  
            if (!is_null($request->file('eplan_image3'))) {
                $cplan_file = $request->file('eplan_image3');
                $cplan_filename = $cplan_file->getClientOriginalName();
                $cplan_extension = $cplan_file->getClientOriginalExtension(); //if you need extension of the file
                $cplan_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $cplan_extension;
                $cplan_uploadSuccess = $cplan_file->move($destinationPath, $cplan_filename);
                if ($cplan_uploadSuccess) {
                    $data['plan_img3'] = $cplan_filename;
                }
            }  
            $data['youtube_url'] = $request->input('eplan_youtube_url');         
			//print_r($staying_available_days);
    		$data['updated'] = date('Y-m-d h:i:s');
            $edit_id = $request->input('desc_edit_id');
    		$instype = 'update';
            //die;
            $id = \DB::table('tb_properties_custom_plan')->where('id', $edit_id)->update($data);
            
            $res['msg'] = 'Custom Plan updated Successfully';		
			
			$cplandata = array();
			//$customplan = \DB::table('tb_properties_custom_plan')->where('id', $id)->first();
			//if(!empty($customplan))
			//{
				//$cplandata = $customplan;
			//}
			
			$res['status'] = 'success';
			//$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		//} else {
		//	$res['status'] = 'error';
		//	$res['errors'] = $validator->errors()->all();
		//	return json_encode($res);
		//}	
	
	}
    
    function postEditcustomplantac( Request $request)
	{
		$uid = \Auth::user()->id;
		//$rules['eplan_title'] = 'required';
        //print_r($request->all()); die;
		//$validator = Validator::make($request->all(), $rules);	
		//if ($validator->passes()) {
		      
			$data['terms_and_condition'] = $request->input('eplan_terms_and_conditions');      
			//print_r($staying_available_days);
    		$data['updated'] = date('Y-m-d h:i:s');
            $edit_id = $request->input('tac_edit_id');
    		$instype = 'update';
            //die;
            $id = \DB::table('tb_properties_custom_plan')->where('id', $edit_id)->update($data);
            
            $res['msg'] = 'Custom Plan updated Successfully';		
			
			$cplandata = array();
			//$customplan = \DB::table('tb_properties_custom_plan')->where('id', $id)->first();
			//if(!empty($customplan))
			//{
				//$cplandata = $customplan;
			//}
			
			$res['status'] = 'success';
			//$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		//} else {
		//	$res['status'] = 'error';
		//	$res['errors'] = $validator->errors()->all();
		//	return json_encode($res);
		//}	
	
	}
    
    function _postCustomplandetails( Request $request)
	{
		$uid = \Auth::user()->id;
		$rules['eplan_title'] = 'required';
        //print_r($request->all()); die;
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data['title'] = $request->input('eplan_title');
            $room_types = $request->input('eroom_types');            
            $data['plan_price'] = $request->input('eplan_price');
            $data['price_type'] = $request->input('eprice_type');            
            $data['card_rule'] = $request->input('ecard_rule');
            $data['booking_code'] = $request->input('ebooking_code');
            $data['no_of_days'] = $request->input('edays_id_advance');            
            $data['min_stay'] = $request->input('emin_stay');
            $data['max_stay'] = $request->input('emax_stay');  
            
            $data['booking_start_date'] = $request->input('plan_booking_start_date');                        
            $data['booking_end_date'] = $request->input('plan_booking_end_date');
            $data['booking_season'] = $request->input('plan_booking_season');            
            $booking_available_days = $request->input('booking_available_days');
            //print_r($booking_available_days);
            $data['staying_start_date'] = $request->input('plan_staying_start_date');                        
            $data['staying_end_date'] = $request->input('plan_staying_end_date');
            $data['staying_season'] = $request->input('plan_staying_season');            
            $staying_available_days = $request->input('staying_available_days');
            //print_r($staying_available_days); die;
            $tdata['pre_payment'] = $request->input('tag_pre_payment');
            $tdata['deposit'] = $request->input('tag_diposit');            
            $tdata['non_refundable_deposit'] = $request->input('tag_non_refundable_diposit');
            $tdata['non_refundable_rate'] = $request->input('tag_non_refundable_rate');
            $tdata['no_credit_card_required'] = $request->input('tag_no_credit_card_required');            
            $tdata['free_cancellation'] = $request->input('tag_free_cancellation');            
            $tdata['most_popular_rates'] = $request->input('tag_most_popular_rate');            
            $tdata['one_per_discount'] = $request->input('tag_one_per_discount');
            $tdata['discounted_rate'] = $request->input('tag_discounted_rate');
            $tdata['standard_rate'] = $request->input('tag_standard_rate');            
            $tdata['breakfast_included'] = $request->input('tag_breakfast_included');
            $tdata['no_board_included'] = $request->input('tag_no_board_included');            
            $tdata['fullboard_included'] = $request->input('tag_fullboard_included');
            $tdata['all_inclusive'] = $request->input('tag_all_inclusive');
             
            
            $data['description'] = $request->input('plan_description');
            $data['terms_and_condition'] = $request->input('plan_terms_and_conditions');
            //print_r($data); die;
            //$data['start_date'] = $request->input('modal_plan_start_date');
            //$data['end_date'] = $request->input('modal_plan_end_date');
            //$seasons = $request->input('modal_plan_season');
            
            $abs = $request->input('abs');
            
            //$data['plan_season'] = $request->input('plan_season');
            
            //print_r($data); die;
            $data['status'] = 0;
			//$data['user_id'] = $uid;
			if(!is_null($request->input('property_id_details')))
			{
				$data['property_id'] = $request->input('property_id_details');
			}
            
            
            
			if($request->input('edit_id_details')=='')
			{
				$data['created'] = date('Y-m-d h:i:s');
				$instype = 'add';
				$id = \DB::table('tb_properties_custom_plan')->insertGetId($data);                
               
                if($id > 0){                    
                    if(!empty($room_types)){
                        foreach($room_types as $si){                            
                            $s_p = array(
                                'custom_plan_id'=>$id,
                                'property_type_id'=>$si,       
                            );
                            \DB::table('tb_custom_plan_roomtypes')->insert($s_p);      
                        }
                    }
                    if(!empty($abs)){
                        foreach($abs as $si){
                            $abs_data = array(
                                'custom_plan_id'=>$id,
                                'board_id'=>$si,
                                'board_inc_ex'=>$request->input('ab_inc_exc_'.$si),
                            );
                            \DB::table('tb_custom_plan_available_boards')->insert($abs_data);
                        }
                    }
                    $tdata['custom_plan_id'] = $id;
                    \DB::table('tb_custom_plan_tags')->insert($tdata);
                    
                    if(!empty($booking_available_days)){
                        foreach($booking_available_days as $si){                            
                            $s_p = array(
                                'custom_plan_id'=>$id,
                                'booking_days'=>$si,       
                            );
                            \DB::table('tb_custom_plan_booking_days')->insert($s_p);      
                        }
                    }
                    if(!empty($staying_available_days)){
                        foreach($staying_available_days as $si){                            
                            $s_p = array(
                                'custom_plan_id'=>$id,
                                'staying_days'=>$si,       
                            );
                            \DB::table('tb_custom_plan_staying_days')->insert($s_p);      
                        }
                    }
                }
                /*if($id > 0){
                    
                    if(!empty($seasons)){
                        foreach($seasons as $si){                            
                            $s_p = array(
                                'plan_id'=>$id,
                                'season_id'=>$si,       
                            );
                            \DB::table('tb_property_custom_plan_seasons')->insert($s_p);      
                        }
                    }
                }*/
                $res['msg'] = 'Custom Plan added Successfully';
			}
			else
			{
				$data['updated'] = date('Y-m-d h:i:s');
                $edit_id = $request->input('edit_id_details');
				$instype = 'update';
				$id = \DB::table('tb_properties_custom_plan')->where('id', $request->input('edit_id_details'))->update($data);
                
                if(!empty($room_types)){
                    if($edit_id !=''){
                        \DB::table('tb_custom_plan_roomtypes')->where('custom_plan_id', $edit_id)->delete();
                        foreach($room_types as $si){                            
                            $s_p = array(
                                'custom_plan_id'=>$edit_id,
                                'property_type_id'=>$si,       
                            );
                            \DB::table('tb_custom_plan_roomtypes')->insert($s_p);      
                        }
                    }
                }
                if(!empty($abs)){
                    \DB::table('tb_custom_plan_available_boards')->where('custom_plan_id', $edit_id)->delete();
                    foreach($abs as $si){
                        $abs_data = array(
                            'custom_plan_id'=>$id,
                            'board_id'=>$si,
                            'board_inc_ex'=>$request->input('ab_inc_exc_'.$si),
                        );
                        \DB::table('tb_custom_plan_available_boards')->insert($abs_data);
                    }
                }
                \DB::table('tb_custom_plan_tags')->where('custom_plan_id', $edit_id)->delete();
                $tdata['custom_plan_id'] = $id;
                \DB::table('tb_custom_plan_tags')->insert($tdata);
                /*if(!empty($seasons)){
                    if($edit_id !=''){
                        \DB::table('tb_property_custom_plan_seasons')->where('plan_id', $edit_id)->delete();
                        foreach($seasons as $si){                            
                            $s_p = array(
                                'plan_id'=>$edit_id,
                                'season_id'=>$si,       
                            );
                            \DB::table('tb_property_custom_plan_seasons')->insert($s_p);      
                        }
                    }
                }*/
                
                if(!empty($booking_available_days)){
                    \DB::table('tb_custom_plan_booking_days')->where('custom_plan_id', $edit_id)->delete();
                    foreach($booking_available_days as $si){                            
                        $s_p = array(
                            'custom_plan_id'=>$id,
                            'booking_days'=>$si,       
                        );
                        \DB::table('tb_custom_plan_booking_days')->insert($s_p);      
                    }
                }
                if(!empty($staying_available_days)){
                    \DB::table('tb_custom_plan_staying_days')->where('custom_plan_id', $edit_id)->delete();
                    foreach($staying_available_days as $si){                            
                        $s_p = array(
                            'custom_plan_id'=>$id,
                            'staying_days'=>$si,       
                        );
                        \DB::table('tb_custom_plan_staying_days')->insert($s_p);      
                    }
                }
                
                $res['msg'] = 'Custom Plan updated Successfully';
			}
			
			$cplandata = array();
			$customplan = \DB::table('tb_properties_custom_plan')->where('id', $id)->first();
			if(!empty($customplan))
			{
				$cplandata = $customplan;
			}
			
			$res['status'] = 'success';
			$res['season'] = $cplandata;
			$res['type'] = $instype;
			return json_encode($res);
			
		} else {
			$res['status'] = 'error';
			$res['errors'] = $validator->errors()->all();
			return json_encode($res);
		}	
	
	}
}