<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class EventsController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'events';
	static $per_page	= '10';

	public function __construct()
	{
		
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Events();
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'events',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function getIndex( Request $request )
	{

		if($this->access['is_view'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');

		$sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'id'); 
		$order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
		if(\Session::get('gid')!=1 && \Session::get('gid')!=2){
			$uid = \Auth::user()->id;
			$filter .= " AND user_id = '".$uid."'" ;
        }
		
		$page = $request->input('page', 1);
		$params = array(
			'page'		=> $page ,
			'limit'		=> (!is_null($request->input('rows')) ? filter_var($request->input('rows'),FILTER_VALIDATE_INT) : static::$per_page ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRows( $params );		
		//echo "<pre>";
        //print_r($results); die;
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = new Paginator($results['rows'], $results['total'], $params['limit']);	
		$pagination->setPath('events');
		
		$this->data['rowData']		= $results['rows'];
		// Build Pagination 
		$this->data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$this->data['pager'] 		= $this->injectPaginate();	
		// Row grid Number 
		$this->data['i']			= ($page * $params['limit'])- $params['limit']; 
		// Grid Configuration 
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['tableForm'] 	= $this->info['config']['forms'];
		$this->data['colspan'] 		= \SiteHelpers::viewColSpan($this->info['config']['grid']);		
		// Group users permission
		$this->data['access']		= $this->access;
		// Detail from master if any
		
		// Master detail link if any 
		$this->data['subgrid']	= (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array()); 
		// Render into template
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.index':'events.index';
        //print_r($file_name); die; 
		//return view('events.index',$this->data);
        return view($file_name,$this->data);
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
				
		$row = $this->model->find($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_events'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['forms']);
		
		$this->data['id'] = $id;
        //print_r($this->data); die;
        /** Event Categories **/
        $event_categories = array();
        $events = \DB::table('tb_categories')->where('category_alias', 'events')->first();
        if(!empty($events)){
            $event_categories = \DB::table('tb_categories')->where('parent_category_id', $events->id)->get();    
        }
        $this->data['event_categories'] = $event_categories;
        /** End Event Categories **/
        
        $supplier = \DB::table('tb_groups')->where('name', 'Supplier')->first();        
              
		$this->data['group'] = \Session::get('gid');
        
		if(\Session::get('gid')!=1 && \Session::get('gid')!=2){ //print_r($supplier->group_id);
            if(\Session::get('gid')==$supplier->group_id){
                 $this->data['proprty'] = \DB::table('tb_properties')->select('id','property_name')->where('property_status', 1)->get();        
            }else{
			     $uid = \Auth::user()->id;
			     $this->data['proprty'] = \DB::table('tb_properties')->select('id','property_name')->where('property_status', 1)->where('user_id', $uid)->get();
            }
        }
        
        $fetch_cat = \DB::table('tb_categories')->orderBy('category_name', 'asc')->get();
        $parent_cat = array();
        if (!empty($fetch_cat)) {
            foreach ($fetch_cat as $cat) {
                $parent_cat[$cat->id] = $cat;
            }
        }
        $this->data['destinations'] = $parent_cat;
        
        $fetch_tag = \DB::table('tb_tags_manager')->orderBy('tag_title', 'asc')->get();        
        $this->data['tags'] = $fetch_tag;
        
        /** get property and user relations start **/
        $prop_user_rel = \DB::table('tb_event_tags')->where('event_id', $id)->get();
        $rest_user_arr = array();
        foreach($prop_user_rel as $si_user){ $rest_user_arr[] = $si_user->tag_id; }
        $this->data['event_tags'] = implode(',',$rest_user_arr);
        /** get property and user relations end **/
        
        /** get property and user relations start **/
        $prop_user_rel = \DB::table('tb_event_destinations')->where('event_id', $id)->get();
        $rest_user_arr = array();
        foreach($prop_user_rel as $si_user){ $rest_user_arr[] = $si_user->destination_id; }
        $this->data['event_destinations'] = implode(',',$rest_user_arr);
        /** get property and user relations end **/
        
        $this->data['event_times'] = \DB::table('tb_events_time')->where('event_id', $id)->get();
        
        $this->data['venues'] = \DB::table('tb_venue')->get();
        
        $this->data['event_types'] = \DB::table('tb_event_type')->where('status', 1)->get();
        
        $this->data['includes'] = \DB::table('tb_includes')->where('status', 1)->orderBy('title', 'asc')->get();
        $this->data['excludes'] = \DB::table('tb_excludes')->where('status', 1)->orderBy('title', 'asc')->get();        
        $this->data['languages'] = \DB::table('tb_languages')->where('status', 1)->get();
        
        $this->data['key_details'] = \DB::table('tb_event_key_details')->where('event_id', $id)->first();
        $this->data['highlights'] = \DB::table('tb_event_highlights')->where('event_id', $id)->first();
        $this->data['meetings'] = \DB::table('tb_event_meeting')->where('event_id', $id)->first();        
        
        $this->data['wtds'] = \DB::table('tb_event_what_to_bring')->where('status', 1)->get();
        $this->data['nas'] = \DB::table('tb_event_not_allowed')->where('status', 1)->get();        
        $this->data['bygs'] = \DB::table('tb_event_before_you_go')->where('status', 1)->get();
        $this->data['ehighlights'] = \DB::table('tb_highlights')->where('status', 1)->get();
        $this->data['emps'] = \DB::table('tb_meeting_point')->where('status', 1)->get();
        /** get property and user relations start **/
        $event_inc = \DB::table('tb_event_includes')->where('event_id', $id)->get();
        $inc_arr = array();
        foreach($event_inc as $si_inc){ $inc_arr[] = $si_inc->inc_id; }
        $this->data['event_includes'] = implode(',',$inc_arr);
        /** get property and user relations end **/
        
        /** get property and user relations start **/
        $event_exc = \DB::table('tb_event_excludes')->where('event_id', $id)->get();
        $exc_arr = array();
        foreach($event_exc as $si_exc){ $exc_arr[] = $si_exc->exc_id; }
        $this->data['event_excludes'] = implode(',',$exc_arr);
        /** get property and user relations end **/
        
        /** get property and user relations start **/
        $ltg = \DB::table('tb_event_ltg_language')->where('event_id', $id)->get();
        $ltg_arr = array();
        foreach($ltg as $si_ltg){ $ltg_arr[] = $si_ltg->lng_id; }
        $this->data['event_ltg'] = implode(',',$ltg_arr);
        
        $agh = \DB::table('tb_event_agh_language')->where('event_id', $id)->get();
        $agh_arr = array();
        foreach($agh as $si_agh){ $agh_arr[] = $si_agh->lng_id; }
        $this->data['event_agh'] = implode(',',$agh_arr);
        /** get property and user relations end **/
        
        /** get property and user relations start **/
        $ewtb = \DB::table('tb_event_whattobring')->where('event_id', $id)->get();
        $wtb_arr = array();
        foreach($ewtb as $si_wtb){ $wtb_arr[] = $si_wtb->wtb_id; }
        $this->data['event_wtb'] = implode(',',$wtb_arr);
        /** get property and user relations end **/
        
        /** get property and user relations start **/
        $ena = \DB::table('tb_event_notallowed')->where('event_id', $id)->get();
        $na_arr = array();
        foreach($ena as $si_na){ $na_arr[] = $si_na->na_id; }
        $this->data['event_na'] = implode(',',$na_arr);
        /** get property and user relations end **/
        
        /** get property and user relations start **/
        $ebyg = \DB::table('tb_event_breforeyougo')->where('event_id', $id)->get();
        $byg_arr = array();
        foreach($ebyg as $si_byg){ $byg_arr[] = $si_byg->byg_id; }
        $this->data['event_byg'] = implode(',',$byg_arr);
        /** get property and user relations end **/
        
        /** get property and user relations start **/
        $ehlt = \DB::table('tb_event_highlight')->where('event_id', $id)->get();
        $ehlt_arr = array();
        foreach($ehlt as $si_hlt){ $ehlt_arr[] = $si_hlt->highlight_id; }
        $this->data['event_hlt'] = implode(',',$ehlt_arr);
        /** get property and user relations end **/
        
        /** get property and user relations start **/
        $eemps = \DB::table('tb_event_meeting_point')->where('event_id', $id)->get();
        $eemp_arr = array();
        foreach($eemps as $si_emp){ $eemp_arr[] = $si_emp->meeting_id; }
        $this->data['event_emp'] = implode(',',$eemp_arr);
        /** get property and user relations end **/
        
        /** Images **/
        $res_gallery = array();
        $res_slider = array();
        $res_menu = array();
        if($id !='')
		{
            $res_gallery = $this->get_event_files($id, 'gallery');
            //$res_slider = $this->get_restaurant_files($id, 'res', 'slider');
            //$res_menu = $this->get_restaurant_files($id, 'res', 'menu');
        }
        $this->data['res_gallery'] = $res_gallery;
        //$this->data['res_slider'] = $res_slider;
        //$this->data['res_menu'] = $res_menu;
        /** End images **/
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.form':'events.form';
        //print_r($file_name); die;
		//return view('events.form',$this->data);
        
        return view($file_name,$this->data);
	}	

	public function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
					
		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_events'); 
		}
		$this->data['fields'] 		=  \SiteHelpers::fieldLang($this->info['config']['grid']);
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		//return view('events.view',$this->data);
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.view':'events.view';
        return view($file_name,$this->data);	
	}	

	function postSave( Request $request)
	{	
	    //$id = null;
        $id = $request->input('id');
		$rules = $this->validateForm();
        //$rules['title'] = 'required';
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_events');
			if(\Session::get('gid')!=1 && \Session::get('gid')!=2){
				$data['user_id'] = \Auth::user()->id;
			}
            /** Lat Long **/
            $address = $request->input('location');
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
            $alias = \SiteHelpers::seoUrl(Input::get('alias'));            
            $exha = false;
            
            for ($f = 1; $exha != true; $f++) {
                if ($request->input('id') == '') { 
                    $check_alias = \DB::table('tb_events')->where('event_slug', $alias)->count();
                } else {
                    $check_alias = \DB::table('tb_events')->where('event_slug', $alias)->where('id', '!=', $request->input('id'))->count();  //print_r($check_alias); die;
                }
                if ($check_alias > 0) {
                    $alias = $alias . '-' . $f;
                } else {
                    $alias = $alias;
                    $exha = true;
                }
            }   //print_r($alias); die;         
            $data['event_slug'] = $alias;
            
            $data['start_date'] = $request->input('start_date');
            $data['end_date'] = $request->input('end_date');
            $data['recurring_event'] = $request->input('recurring_event');
            $data['event_recurring'] = $request->input('event_recurring');
            $data['recurring_frequency'] = $request->input('recurring_frequency');
            $data['organizer_name'] = $request->input('organizer_name');
            $data['organizer_email'] = $request->input('organizer_email');
            $data['organizer_phone'] = $request->input('organizer_phone');
            $data['organizer_youtube_channel'] = $request->input('organizer_youtube_channel');
            $data['organizer_instagram'] = $request->input('organizer_instagram');
            /*$data['venue_name'] = $request->input('venue_name');
            $data['venue_email'] = $request->input('venue_email');
            $data['venue_phone'] = $request->input('venue_phone');
            $data['venue_website'] = $request->input('venue_website');
            $data['venue_youtube_channel'] = $request->input('venue_youtube_channel');
            $data['venue_instagram'] = $request->input('venue_instagram');
            $data['venue_address'] = $request->input('venue_address');*/
            
            //print_r($start_time); print_r($end_time); die;
            
            $data['latitude'] = $latitude;
            $data['longitude'] = $longitude;  
            /** End Lat Long **/                     
            $destinationPath = public_path() . '/uploads/event_meta_imgs/';
            /** Start Meta tags **/            
            $data['meta_title'] = $request->input('meta_title');
            $data['meta_description'] = $request->input('meta_description');
            $data['meta_keyword'] = $request->input('meta_keyword');            
            $data['og_title'] = $request->input('og_title');
            $data['og_description'] = $request->input('og_description');
            $data['og_url'] = $request->input('og_url');
            $data['og_type'] = $request->input('og_type');            
            $data['og_sitename'] = $request->input('og_sitename');
            $data['og_locale'] = $request->input('og_locale');
            $data['article_section'] = $request->input('article_section');
            $data['article_tags'] = $request->input('article_tags');
            $data['twitter_url'] = $request->input('twitter_url');
            $data['twitter_title'] = $request->input('twitter_title');
            $data['twitter_description'] = $request->input('twitter_description');
            $data['twitter_image'] = $request->input('twitter_image');
            $data['twitter_domain'] = $request->input('twitter_domain');
            $data['twitter_card'] = $request->input('twitter_card');
            $data['twitter_creator'] = $request->input('twitter_creator');
            $data['twitter_site'] = $request->input('twitter_site');                       
            $data['og_upload_type'] =  $request->input('og_image_type');
            if (!is_null($request->file('og_image_type_upload'))) {
                $og_image_type_file = $request->file('og_image_type_upload');
                $og_image_type_filename = $og_image_type_file->getClientOriginalName();
                $og_image_type_extension = $og_image_type_file->getClientOriginalExtension(); //if you need extension of the file
                $og_image_type_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $og_image_type_extension;
                $og_image_type_uploadSuccess = $og_image_type_file->move($destinationPath, $og_image_type_filename);
                if ($og_image_type_uploadSuccess) {
                    $data['og_image'] = $og_image_type_filename;
                    //$meta_data['og_image_width'] = $request->input('og_image_width');
                    //$meta_data['og_image_height'] = $request->input('og_image_height');
                }
            }
            $data['og_image_link'] =  $request->input('og_image_type_link');
            
            $data['twitter_upload_type'] =  $request->input('twitter_image_type');
            if (!is_null($request->file('twitter_image_type_upload'))) {
                $twitter_image_type_file = $request->file('twitter_image_type_upload');
                $twitter_image_type_filename = $twitter_image_type_file->getClientOriginalName();
                $twitter_image_type_extension = $twitter_image_type_file->getClientOriginalExtension(); //if you need extension of the file
                $twitter_image_type_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $twitter_image_type_extension;
                $twitter_image_type_uploadSuccess = $twitter_image_type_file->move($destinationPath, $twitter_image_type_filename);
                if ($twitter_image_type_uploadSuccess) {
                    $data['twitter_image'] = $twitter_image_type_filename;
                    //$meta_data['twitter_image_width'] = $request->input('twitter_image_width');
                    //$meta_data['twitter_image_height'] = $request->input('twitter_image_height');
                }
            }
            $data['twitter_image_link'] =  $request->input('twitter_image_type_link');
            /** End Meta tags **/
            
            
            $dd_venue =  $request->input('venue');  
            if($dd_venue==0){
                /** Add New Venue **/
                $venue_data['name'] = $request->input('venue_name');
                $venue_data['email'] = $request->input('venue_email');
                $venue_data['phone'] = $request->input('venue_phone');
                $venue_data['website'] = $request->input('venue_website');
                $venue_data['youtube_channel'] = $request->input('venue_youtube_channel');
                $venue_data['instagram'] = $request->input('venue_instagram');
                $venue_data['address'] = $request->input('venue_address');
                
                /** Lat Long **/
                $event_address = $request->input('event_location');
                $event_latitude = '';
                $event_longitude = '';
                if($request->input('event_latitude')=='' && $request->input('event_longitude')==''){                
                    if($event_address!=''){
                        $geo = file_get_contents("https://maps.google.com/maps/api/geocode/json?key=AIzaSyBqf2xJGZFRECA_eVTNek_Y7sxBzmcgXrs&address=".urlencode($event_address).'&sensor=false');
                        $geo = json_decode($geo, true); // Convert the JSON to an array                
                        if(isset($geo['status']) && ($geo['status'] == 'OK')) {
                          $event_latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
                          $event_longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
                        } 
                    }   
                }else{
                    $event_latitude = $request->input('event_latitude');
                    $event_longitude = $request->input('event_longitude');        
                }
                $venue_data['location'] = $event_address;
                $venue_data['latitude'] = $event_latitude;
                $venue_data['longitude'] = $event_longitude;
                /**  **/
                
                $venue_data['status'] = 1;
                $venue_data['created'] = date('Y-m-d H:i:s');
                $venue_data['updated'] = date('Y-m-d H:i:s');
                
                $venue_id = \DB::table('tb_venue')->insertGetId($venue_data);            
                /** End Venue **/
                $data['venue_id'] = $venue_id;
            }else{
                $data['venue_id'] = $dd_venue;    
            }            
            
			$id = $this->model->insertRow($data , $request->input('id'));
			
            /** Start Events **/
            $event_times = array();
            $start_time = $request->input('start_time');
            $end_time = $request->input('end_time');            
            if(!empty($start_time)){
                \DB::table('tb_events_time')->where('event_id', $id)->delete();
                for($i=0; $i < count($start_time); $i++){
                    if($start_time[$i]!='' && $end_time[$i]!=''){
                        $event_times[] = array("event_id"=>$id,"start_time"=>$start_time[$i],"end_time"=>$end_time[$i]);    
                    }
                }
            }            
            if(count($event_times)){ \DB::table('tb_events_time')->insert($event_times); }
            /** End Events **/
            
            /** insert destination start **/
            $destinations  =  $request->input('destinations');
            $final_destinations = array();            
            \DB::table('tb_event_destinations')->where('event_id', $id)->delete();            
            if((count($destinations) > 0)){                
                foreach($destinations as $si_dest){ 
                    $final_destinations[] = array("event_id"=>$id,"destination_id"=>$si_dest); 
                }
            }            
            if(count($final_destinations)){ \DB::table('tb_event_destinations')->insert($final_destinations); }
            /** insert destination End **/ 
            
            /** insert destination start **/
            $tags  =  $request->input('tags');
            $final_tags = array();            
            \DB::table('tb_event_tags')->where('event_id', $id)->delete();            
            if((count($tags) > 0)){                
                foreach($tags as $si_dest){ 
                    $final_tags[] = array("event_id"=>$id,"tag_id"=>$si_dest); 
                }
            }            
            if(count($final_tags)){ \DB::table('tb_event_tags')->insert($final_tags); }
            /** insert destination End **/
            
            /** Start Key Details  **/
            $data_key['event_id'] =  $id;
            $data_key['duration'] =  $request->input('dd_duration');
            $data_key['duration_desc'] =  $request->input('duration_desc');
            $data_key['skip_the_ticket_line'] =  $request->input('rdo_skip_tkt_yes_no');
            $data_key['skip_the_ticket_line_desc'] =  $request->input('skip_the_ticket_line');
            $data_key['printed_or_mobile_voucher_accepted'] =  $request->input('rdo_pmva_yes_no');
            $data_key['printed_or_mobile_voucher_accepted_desc'] =  $request->input('printed_or_mobile_voucher_accepted');
            $data_key['instant_confirmation'] =  $request->input('rdo_ic_yes');            
            $data_key['instant_confirmation_desc'] =  $request->input('instant_confirmation');
            
            $data_key['live_tour_guide'] =  $request->input('rdo_ltg_yes_no');
            $ltg_language =  $request->input('ltg_language');
            
            $final_ltg_language = array();
            if(!empty($ltg_language)){
                            
                \DB::table('tb_event_ltg_language')->where('event_id', $id)->delete();            
                if((count($ltg_language) > 0)){                
                    foreach($ltg_language as $si_ltg){ 
                        $final_ltg_language[] = array("event_id"=>$id,"lang_id"=>$si_ltg); 
                    }
                }            
                if(count($final_ltg_language)){ \DB::table('tb_event_ltg_language')->insert($final_ltg_language); }    
            }
            
            $data_key['audio_guide_headphones'] =  $request->input('rdo_agh_yes_no');            
            $agh_language =  $request->input('agh_language');
            $final_agh_language = array();
            if(!empty($agh_language)){
                            
                \DB::table('tb_event_agh_language')->where('event_id', $id)->delete();            
                if((count($agh_language) > 0)){                
                    foreach($agh_language as $si_agh){ 
                        $final_agh_language[] = array("event_id"=>$id,"lang_id"=>$si_agh); 
                    }
                }            
                if(count($final_agh_language)){ \DB::table('tb_event_agh_language')->insert($final_agh_language); }    
            }
            
            $data_key['booklets'] =  $request->input('rdo_booklets_yes_no');
            $data_key['booklets_desc'] =  $request->input('booklets');
            $data_key['cancellation_policy'] =  $request->input('rdo_free_cancellation');            
            $data_key['cancellation_policy_add'] =  $request->input('cancellation_policy');
            $data_key['accessibility'] =  $request->input('accessibility');
            
            $key_det = \DB::table('tb_event_key_details')->where('event_id', $id)->first();
            if(!empty($key_det)){
                \DB::table('tb_event_key_details')->where('event_id', $id)->update($data_key);    
            }else{
                \DB::table('tb_event_key_details')->insertGetId($data_key);
            }
            /** End Key Details **/
            
            /** Start Highlights **/
            $data_highlight['event_id'] = $id;
            $data_highlight['highlights'] =  $request->input('highlights');
            $data_highlight['full_description'] =  $request->input('highlight_full_description');
            $data_highlight['not_suitable_for'] =  $request->input('not_suitable_for');
            $key_det = \DB::table('tb_event_highlights')->where('event_id', $id)->first();
            if(!empty($key_det)){
                \DB::table('tb_event_highlights')->where('event_id', $id)->update($data_highlight);    
            }else{
                \DB::table('tb_event_highlights')->insertGetId($data_highlight);
            }
            /** End Highlights **/
            
            /** Start Include **/
            $includes =  $request->input('includes');
            $final_includes = array();
            if(!empty($includes)){
                            
                \DB::table('tb_event_includes')->where('event_id', $id)->delete();            
                if((count($includes) > 0)){                
                    foreach($includes as $si_inc){ 
                        $final_includes[] = array("event_id"=>$id,"inc_id"=>$si_inc); 
                    }
                }            
                if(count($final_includes)){ \DB::table('tb_event_includes')->insert($final_includes); }    
            }
            /** End Include **/
            /** Start exclude **/
            $excludes =  $request->input('excludes');
            $final_excludes = array();
            if(!empty($excludes)){
                            
                \DB::table('tb_event_excludes')->where('event_id', $id)->delete();            
                if((count($excludes) > 0)){                
                    foreach($excludes as $si_exc){ 
                        $final_excludes[] = array("event_id"=>$id,"exc_id"=>$si_exc); 
                    }
                }            
                if(count($final_excludes)){ \DB::table('tb_event_excludes')->insert($final_excludes); }    
            }
            /** End exclude **/
            /** Start Meeting point **/
            $data_meeting['event_id'] = $id;
            $data_meeting['meeting_title'] =  $request->input('pfa_title');
            $data_meeting['meeting_desc'] =  $request->input('pfa_description');
            $data_meeting['meeting_type'] =  $request->input('rdo_add_meeting');
            $data_meeting['meeting_point'] =  $request->input('meeting_point');
            //$data_meeting['meeting_location'] =  $request->input('meeting_location');
            
            /** Lat Long **/
                $meeting_address = $request->input('meeting_location');
                $meeting_latitude = '';
                $meeting_longitude = '';
                if($request->input('meeting_latitude')=='' && $request->input('meeting_longitude')==''){                
                    if($meeting_address!=''){
                        $geo = file_get_contents("https://maps.google.com/maps/api/geocode/json?key=AIzaSyBqf2xJGZFRECA_eVTNek_Y7sxBzmcgXrs&address=".urlencode($meeting_address).'&sensor=false');
                        $geo = json_decode($geo, true); // Convert the JSON to an array                
                        if(isset($geo['status']) && ($geo['status'] == 'OK')) {
                          $meeting_latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
                          $meeting_longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
                        } 
                    }   
                }else{
                    $meeting_latitude = $request->input('meeting_latitude');
                    $meeting_longitude = $request->input('meeting_longitude');        
                }
                $data_meeting['meeting_location'] = $meeting_address;
                $data_meeting['meeting_latitude'] = $meeting_latitude;
                $data_meeting['meeting_longitude'] = $meeting_longitude;
                /**  **/
            
            
            //$data_meeting['meeting_latitude'] =  $request->input('meeting_latitude');
            //$data_meeting['meeting_longitude'] =  $request->input('meeting_longitude');
            $data_meeting['existing_meeting_point'] =  $request->input('dd_existing_meeting_point');
            $event_meeting = \DB::table('tb_event_meeting')->where('event_id', $id)->first();
            if(!empty($event_meeting)){
                \DB::table('tb_event_meeting')->where('event_id', $id)->update($data_meeting);    
            }else{
                \DB::table('tb_event_meeting')->insertGetId($data_meeting);
            }
            /** End Meeting point **/
            /** Start exclude **/
            $whattobring =  $request->input('what_to_bring');
            $final_whattobring = array();
            if(!empty($whattobring)){
                            
                \DB::table('tb_event_whattobring')->where('event_id', $id)->delete();            
                if((count($whattobring) > 0)){                
                    foreach($whattobring as $si_wtb){ 
                        $final_whattobring[] = array("event_id"=>$id,"wtb_id"=>$si_wtb); 
                    }
                }            
                if(count($final_whattobring)){ \DB::table('tb_event_whattobring')->insert($final_whattobring); }    
            }
            
            $notallowed =  $request->input('not_allowed');
            $final_notallowed = array();
            if(!empty($notallowed)){                            
                \DB::table('tb_event_notallowed')->where('event_id', $id)->delete();            
                if((count($notallowed) > 0)){                
                    foreach($notallowed as $si_na){ 
                        $final_notallowed[] = array("event_id"=>$id,"na_id"=>$si_na); 
                    }
                }            
                if(count($final_notallowed)){ \DB::table('tb_event_notallowed')->insert($final_notallowed); }    
            }
            
            $breforeyougo =  $request->input('before_you_go');
            $final_breforeyougo = array();
            if(!empty($breforeyougo)){
                            
                \DB::table('tb_event_breforeyougo')->where('event_id', $id)->delete();            
                if((count($breforeyougo) > 0)){                
                    foreach($breforeyougo as $si_wtb){ 
                        $final_breforeyougo[] = array("event_id"=>$id,"wtb_id"=>$si_wtb); 
                    }
                }            
                if(count($final_breforeyougo)){ \DB::table('tb_event_breforeyougo')->insert($final_breforeyougo); }    
            }
            /** End exclude **/            
            
            $highlight =  $request->input('highlight');
            $final_hgt = array();
            if(!empty($highlight)){
                            
                \DB::table('tb_event_highlight')->where('event_id', $id)->delete();            
                if((count($highlight) > 0)){                
                    foreach($highlight as $si_hgt){ 
                        $final_hgt[] = array("event_id"=>$id,"highlight_id"=>$si_hgt); 
                    }
                }            
                if(count($final_hgt)){ \DB::table('tb_event_highlight')->insert($final_hgt); }    
            }
            
            $emp =  $request->input('dd_ext_meeting_point');
            //print_r($request->input('dd_ext_meeting_point')); die;
            $final_emp = array();
            if(!empty($emp)){
                            
                \DB::table('tb_event_meeting_point')->where('event_id', $id)->delete();            
                if((count($emp) > 0)){                
                    foreach($emp as $si_emp){ 
                        $final_emp[] = array("event_id"=>$id,"meeting_id"=>$si_emp); 
                    }
                }            
                if(count($final_emp)){ \DB::table('tb_event_meeting_point')->insert($final_emp); }    
            }
            
			if(!is_null($request->input('apply')))
			{
				$return = 'events/update/'.$id.'?return='.self::returnUrl();
			} else {
				$return = 'events?return='.self::returnUrl();
			}

			// Insert logs into database
			if($request->input('id') =='')
			{
				\SiteHelpers::auditTrail( $request , 'New Data with ID '.$id.' Has been Inserted !');
			} else {
				\SiteHelpers::auditTrail($request ,'Data with ID '.$id.' Has been Updated !');
			}

			return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			
		} else {
            
                return Redirect::to('events/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
			->withErrors($validator)->withInput();    
            
		}	
	
	}	

	public function postDelete( Request $request)
	{
		
		if($this->access['is_remove'] ==0) 
			return Redirect::to('dashboard')
				->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus','error');
		// delete multipe rows 
		if(count($request->input('ids')) >=1)
		{
			$this->model->destroy($request->input('ids'));
			
			\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('ids'))."  , Has Been Removed Successfull");
			// redirect
			return Redirect::to('events')
        		->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus','success'); 
	
		} else {
			return Redirect::to('events')
        		->with('messagetext','No Item Deleted')->with('msgstatus','error');				
		}

	}			

    public function getEventsettings(Request $request, $property_id, $active){
        $this->data['active'] = $active;
        $this->data['pid'] = $property_id;
        $this->data['property_data'] = \DB::table('tb_properties')->where('id', $property_id)->first();
        $this->data['event_data'] = \DB::table('tb_events')->where('id', $property_id)->first();
        if(\Session::get('gid')==5){
            $tabs = \DB::table('tb_events_config_tabs')->where('tab_status', 1)->where('tab_slug', '<>', 'calendar')->orderBy('id', 'asc')->get();
            //$tabs = \DB::table('tb_properties_config_tabs')->where('tab_status', 1)->orderBy('id', 'asc')->get();
        }else{
            $tabs = \DB::table('tb_events_config_tabs')->where('tab_status', 1)->orderBy('id', 'asc')->get();
        }
        if (!empty($tabs)) {
            foreach ($tabs as $tab) {
                $tabdata[$tab->tab_slug] = $tab;
            }
        }
        $this->data['tabss'] = $tabdata;
        if ($active == 'types') {
            $this->data['cat_types'] = $this->find_event($property_id);
            //print_r($this->data['cat_types']); die;
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_cats':'events.settings_cats'; 
            // print_r($file_name); die;
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
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_rooms':'events.settings_rooms'; 
            
            return view($file_name, $this->data);
            
        } elseif ($active == 'price') {
            $seasonArr = array();
            //if ($this->data['property_data']->default_seasons != 1) {
                $checkseason = \DB::table('tb_event_seasons')->where('event_id', $property_id)->orderBy('season_priority', 'asc')->get();
            //} else {
            //    $checkseason = \DB::table('tb_event_seasons')->where('property_id', 0)->orderBy('season_priority', 'asc')->get();
            //}

            $this->data['Seasons'] = $checkseason;
            $this->data['room_prices'] = $this->find_ticket_type_price($property_id);
            //print "<pre>"; print_r($this->data['room_prices']); die;
            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_price':'events.settings_price';
            
            return view($file_name, $this->data);
        } elseif ($active == 'property_images') {
            $this->data['imgs'] = $this->get_property_files($property_id, 'Property Images');
            $this->data['slider_imgs'] = $this->get_property_files($property_id, 'Property Slider Images');
            $this->data['grid_imgs'] = $this->get_property_files($property_id, 'Property Grid');
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_property_images':'events.settings_property_images';
            
            return view($file_name, $this->data);
        } elseif ($active == 'event_documents') {
            $this->data['event_broch'] = $this->get_event_files($property_id, 'Event Brochure');
    	    $this->data['restru_menu'] = $this->get_property_files($property_id, 'Restaurant Menu');
    	    $this->data['spa_broch'] = $this->get_property_files($property_id, 'Spa Brochure');
    		$this->data['eventcontacts'] = $this->get_event_files($property_id, 'Event Contracts');
            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_event_documents':'events.settings_event_documents';
            
            return view($file_name, $this->data);
        } elseif ($active == 'gallery_images') {
            $this->data['spaimgs'] = $this->get_property_files($property_id, 'Spa Gallery Images');
            $this->data['resturan_imgs'] = $this->get_property_files($property_id, 'Restrurants Gallery Images');
            $this->data['bar_imgs'] = $this->get_property_files($property_id, 'Bar Gallery Images');
            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_gallery_images':'events.settings_gallery_images';
            
            return view($file_name, $this->data);
        } elseif ($active == 'calendar') {
            $this->data['cat_types'] = $this->find_categories_room($property_id);
            
            $this->data['currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_calendar':'events.settings_calendar'; 
            
            return view($file_name, $this->data);
            //return view('properties.settings_calendar', $this->data);
        } elseif ($active == 'terms_and_conditions') {
            if (!is_null($request->input('terms_n_conditions'))) {
                $row = \DB::table('tb_event_terms_n_conditions')->where('event_id', $property_id)->first();
                if (!empty($row)) {
                    \DB::table('tb_event_terms_n_conditions')->where('term_id', $row->term_id)->update(array('terms_n_conditions' => $request->input('terms_n_conditions'), 'applytoallroomtypes'=>$request->input('termsapplytoallroomtypes')));
                } else {
                    \DB::table('tb_event_terms_n_conditions')->insertGetId(array('event_id' => $property_id, 'terms_n_conditions' => $request->input('terms_n_conditions'), 'applytoallroomtypes'=>$request->input('termsapplytoallroomtypes')));
                }
            }            
            $this->data['row'] = \DB::table('tb_event_terms_n_conditions')->where('event_id', $property_id)->first();
            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_terms_and_conditions':'events.settings_terms_and_conditions'; 
            return view($file_name, $this->data);
            
        }elseif ($active == 'custom-price') {  
                      
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            //if($is_demo6!=''){
            $seasons = \DB::table('tb_seasons')->where('property_id', $property_id)->get();
            $this->data['seasons'] = $seasons;
            $this->data['customseasons'] = \DB::table('tb_properties_custom_plan')->where('property_id', $property_id)->get();
            
            $this->data['cattypes'] = \DB::table('tb_properties_category_types')->where('property_id', $property_id)->get();
            
            $this->data['boards'] = \DB::table('tb_boards')->where('property_id', $property_id)->get();
            $this->data['cp_items'] = \DB::table('tb_custom_plan_items')->where('property_id', $property_id)->where('status', 1)->get();
            
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
            
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_customprice':'events.custom_price';                
            return view($file_name, $this->data);
            //}
        }elseif ($active == 'restrictions') {            
            $this->data[] = '';            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            if($is_demo6!=''){
                $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_restrictions':'events.custom_price';                
                return view($file_name, $this->data);
            }
        }elseif ($active == 'options') {            
            $vattaxes = \DB::table('tb_vat_taxes')->get();
            $this->data['vattaxes'] = $vattaxes;       
            $prop_vatid = \DB::table('tb_properties')->select('vattax_id')->where('id', $property_id)->get();
            $this->data['prop_vatid'] = $prop_vatid;                         
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());            
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_options':'events.settings_options';                
            return view($file_name, $this->data);
            
        }elseif ($active == 'boards') {  
            $boards = \DB::table('tb_boards')->where('property_id', $property_id)->get();            
            $this->data['boards'] = $boards;                                
            $vattaxes = \DB::table('tb_vat_taxes')->get();
            $this->data['vattaxes'] = $vattaxes;   
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());      
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_boards':'events.settings_boards';                
            return view($file_name, $this->data);            
        }elseif ($active == 'items') {  
            $items = \DB::table('tb_custom_plan_items')->where('property_id', $property_id)->get();            
            $this->data['items'] = $items;            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());      
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_items':'events.settings_items';                
            return view($file_name, $this->data);            
        }elseif ($active == 'meals') {            
            $this->data[] = '';            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            if($is_demo6!=''){
                $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_meals':'events.custom_price';                
                return view($file_name, $this->data);
            }
        }
        if ($active == 'seasons') {
            $seasonArr = array();
            $checkseason = \DB::table('tb_event_seasons')->where('event_id', $property_id)->get();
            if (!empty($checkseason)) {
                $s = 0;
                foreach ($checkseason as $season) {
                    $seasonArr[$s] = $season;
                    $checkseasondates = \DB::table('tb_seasons_event_dates')->where('season_id', $season->id)->get();
                    if (!empty($checkseasondates)) {
                        $seasonArr[$s]->dates = $checkseasondates;
                    }
                    $s++;
                }
            }
            $this->data['Seasons'] = $seasonArr;
            
            $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
            $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.events.settings_seasons':'events.settings_seasons'; 
            
            return view($file_name, $this->data);
        }
    }
    function save_event_term(Request $request){        
        $property_id = $request->input('property_id');  
        if (!is_null($request->input('terms_n_conditions'))) {
            $row = \DB::table('tb_event_terms_n_conditions')->where('event_id', $property_id)->first();
            if (!empty($row)) {
                \DB::table('tb_event_terms_n_conditions')->where('term_id', $row->term_id)->update(array('terms_n_conditions' => $request->input('terms_n_conditions'), 'applytoallroomtypes'=>$request->input('termsapplytoallroomtypes')));
                $res['status']='success';
                $res['message']='Terms and conditions updated successfully';
            } else {
                \DB::table('tb_event_terms_n_conditions')->insertGetId(array('event_id' => $property_id, 'terms_n_conditions' => $request->input('terms_n_conditions'), 'applytoallroomtypes'=>$request->input('termsapplytoallroomtypes')));
                $res['status']='success';
                $res['message']='Terms and conditions added successfully';
            }
        }            
        echo json_encode($res);  
    }
    function find_event($property_id) { 
        $cat_types = \DB::table('tb_event_ticket_types')->where('event_id', $property_id)->where('status', 1)->get(); 
        return $cat_types;
    }
    function find_categories($property_id) {
        $cat_types = \DB::table('tb_properties_category_types')->where('property_id', $property_id)->where('status', 0)->get();
        return $cat_types;
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
        $cat_types = \DB::table('tb_event_ticket_types')->where('event_id', $property_id)->where('status', 1)->get();
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
    function find_ticket_type_price($property_id) {
        $cats = array();
        $cat_types = \DB::table('tb_event_ticket_types')->where('event_id', $property_id)->where('status', 1)->get();
        //echo "<pre>";
        //print_r($cat_types); die;
        if (!empty($cat_types)) {
            $c = 0;
            foreach ($cat_types as $type) {
                $cats[$c]['data'] = $type;
                $cat_rooms_price = \DB::table('tb_event_ticket_type_price')->where('event_id', $property_id)->where('ticket_type_id', $type->id)->get();
                if (!empty($cat_rooms_price)) {
                    foreach ($cat_rooms_price as $room_price) {
                        $cats[$c]['rooms_price'][$room_price->event_season_id] = $room_price;
                    }
                }
                $c++;
            }
        }

        return $cats;
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
    
    function event_images_uploads(Request $request) {
        $checkRest = \DB::table('tb_events')->select('alias')->where('id', $request->input('propId'))->first();        
        if (!empty($checkRest)) {
            $checkDir = \DB::table('tb_container')->select('id')->where('name', 'events')->first();
            if (!empty($checkDir)) {
                $foldVal = trim($checkRest->alias);
                if ($foldVal != "") {
                    $foldName = trim($foldVal);
                    $slug = \SiteHelpers::seoUrl(trim($foldName));
                    
                    $dirPath = (new ContainerController)->getContainerUserPath($checkDir->id);

                    $checkPropFold = \DB::table('tb_container')->select('id')->where('name', $slug)->where('parent_id', $checkDir->id)->first();
                    //print_r($checkPropFold); die;
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
                    
                    /*if ($imgFold == 'Rooms Images') {
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
                    }*/
                    $propImgFoldId  = $newpropImgFoldId;
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

                        /*// open an image file
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
                        $fpimg->save(public_path() . '/uploads/property_imgs_thumbs/' . $thumbfile);*/

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

                    $imgdata['event_id'] = $request->input('propId');
                    $imgdata['type'] = $imgFold;
                    $imgdata['file_id'] = $fileID;                    
                    $imgdata['user_id'] = \Auth::user()->id;
                    $imgdata['created'] = date('y-m-d h:i:s');
                    $imgID = \DB::table('tb_event_images')->insertGetId($imgdata);

                    $getupfile = \DB::table('tb_container_files')->where('id', $fileID)->first();
                    if (!empty($getupfile)) {
                        $getfilejson['files'][0]['id'] = $fileID;
                        $getfilejson['files'][0]['name'] = ($getupfile->file_display_name!='') ? $getupfile->file_display_name : $getupfile->file_name;
                        $getfilejson['files'][0]['size'] = $getupfile->file_size;
                        if ($getupfile->file_type == "application/pdf") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/bigpage_white_acrobat.png');
                        } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.word") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/doc.png');
                        } elseif ($getupfile->file_type == "application/vnd.openxmlformats-officedocument.spre") {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/images/xls.png');
                        } else {
                            $getfilejson['files'][0]['thumbnailUrl'] = \URL::to('uploads/thumbs/thumb_'.$propImgFoldId.'_'.$getupfile->file_name);
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
    function get_event_files($r_id, $filetype) {
        $fileArr = \DB::table('tb_event_images')->join('tb_container_files', 'tb_container_files.id', '=', 'tb_event_images.file_id')->select('tb_event_images.*',  \DB::raw("(CASE WHEN (tb_container_files.file_display_name = '') THEN tb_container_files.file_name ELSE tb_container_files.file_display_name END) as file_display_name"), 'tb_container_files.file_name', 'tb_container_files.file_size', 'tb_container_files.file_type', 'tb_container_files.folder_id')->where('tb_event_images.event_id', $r_id)->where('tb_event_images.type', $filetype)->get();
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
    
    function delete_event_image(Request $request) {
        $uid = \Auth::user()->id;
        $img_id = $request->input('img_id');
        $checkImg = \DB::table('tb_event_images')->where('id', $img_id)->first();
        if ($img_id!='') {
            //$deleteEfile = (new ContainerController)->delete_allextra_files($checkImg->file_id, 'file');
            $deleteFile = \DB::table('tb_container_files')->where('id', $img_id)->delete();
            $deleteImg = \DB::table('tb_event_images')->where('id', $img_id)->delete();

            $res['status'] = 'success';
            return json_encode($res);
        } else {
            $res['status'] = 'error';
            return json_encode($res);
        }
    }
    
    function delete_selected_event_image(Request $request) {
        $uid = \Auth::user()->id;
        $items = explode(',',$request->input('items'));
		if(!empty($items))
		{
			foreach($items as $item) 
			{
				$checkImg = \DB::table('tb_event_images')->where('id', $item)->first();
				if (!empty($checkImg)) {
					//$deleteEfile = (new ContainerController)->delete_allextra_files($checkImg->file_id, 'file');
					$deleteFile = \DB::table('tb_container_files')->where('id', $item)->delete();
					$deleteImg = \DB::table('tb_event_images')->where('id', $item)->delete();
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
    function save_event_type_data(Request $request) {
        $uid = \Auth::user()->id;
        $rules['cat_name'] = 'required';
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data['event_id'] = $request->input('property_id');            
            $data['name'] = $request->input('cat_name');
            $data['status'] = $request->input('status');
    //print_r($data); die;
            if ($request->input('edit_type_id') == '') {
                $data['created'] = date('Y-m-d h:i:s');
                //$data['booking_policy'] =  $request->input('bookingPolicy');
                //$data['cat_color'] =  $request->input('cat_color');
                $instype = 'add';
                $id = \DB::table('tb_event_ticket_types')->insertGetId($data);
            } else {
                $data['updated'] = date('Y-m-d h:i:s');
                //$data['booking_policy'] =  $request->input('bookingPolicy');   
                //$data['cat_color'] =  $request->input('cat_color');             
                $instype = 'update';
                $id = \DB::table('tb_event_ticket_types')->where('id', $request->input('edit_type_id'))->update($data);
            }            
            
            $typdata = array();
            $checkType = \DB::table('tb_event_ticket_types')->where('id', $id)->where('status', 1)->first();
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

    function delete_event_ticket_type(Request $request) {
        $uid = \Auth::user()->id;
        $catId = $request->input('cat_id');
        $checkType = \DB::table('tb_event_ticket_types')->where('id', $catId)->count();
        if ($checkType > 0) {
            \DB::table('tb_event_ticket_types')->where('id', $catId)->delete();

            $res['status'] = 'success';
            return json_encode($res);
        } else {
            $res['status'] = 'error';
            return json_encode($res);
        }
    }
    function save_event_ticket_price(Request $request){
        //$uid = \Auth::user()->id;
        $rules['rack_rate'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) { 
            $seasonidArr = $request->input('seasonid');
            if (!empty($seasonidArr)) {
                for ($s = 0; $s < count($seasonidArr); $s++) {
                    if ($request->input('rack_rate')[$s] != '' && $request->input('rack_rate')[$s] > 0) {
                        $data['event_id'] = $request->input('property_id');
                        $data['ticket_type_id'] = $request->input('category_id');
                        //$data['user_id'] = $uid;
                        $data['event_season_id'] = $request->input('seasonid')[$s];
                        $data['rack_rate'] = $request->input('rack_rate')[$s];
                        $data['adult_rate'] = $request->input('single_price')[$s];
                        $data['junior_rate'] = $request->input('extra_adult')[$s];
                        //$data['extra_junior'] = $request->input('extra_junior')[$s];
                        //$data['extra_baby'] = $request->input('extra_baby')[$s];
                        $data['monday_price'] = $request->input('monday_price')[$s];
                        $data['tuesday_price'] = $request->input('tuesday_price')[$s];
                        $data['wednesday_price'] = $request->input('wednesday_price')[$s];
                        $data['thursday_price'] = $request->input('thursday_price')[$s];
                        $data['friday_price'] = $request->input('friday_price')[$s];
                        $data['saturday_price'] = $request->input('saturday_price')[$s];
                        $data['sunday_price'] = $request->input('sunday_price')[$s];

                        if ($request->input('edit_room_price_id')[$s] == '') {
                            $data['created'] = date('Y-m-d h:i:s');
                            $id = \DB::table('tb_event_ticket_type_price')->insertGetId($data);
                        } else {
                            $data['updated'] = date('Y-m-d h:i:s');
                            $id = \DB::table('tb_event_ticket_type_price')->where('id', $request->input('edit_room_price_id')[$s])->update($data);
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
    
    public function postSaveed(Request $request){        
        $rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			//$data = $this->validatePost('tb_events');
			if(\Session::get('gid')!=1 && \Session::get('gid')!=2){
				$data['user_id'] = \Auth::user()->id;
			}
            /** Lat Long **/
            $address = $request->input('location');
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
            
            //$data['user_id'] = ;
            $data['location'] = $request->input('location');
            $data['title'] = $request->input('title');
            $data['alias'] = $request->input('alias');
            $data['desciription'] = $request->input('desciription');
            $data['category_id'] = $request->input('category_id');
            //$data['destinations'] = $request->input('destinations');
            
            $data['start_date'] = $request->input('start_date');
            $data['end_date'] = $request->input('end_date');
            $data['recurring_event'] = $request->input('recurring_event');
            $data['event_recurring'] = $request->input('event_recurring');
            $data['recurring_frequency'] = $request->input('recurring_frequency');
            
            
            $data['latitude'] = $latitude;
            $data['longitude'] = $longitude;  
            /** End Lat Long **/                     
            $destinationPath = public_path() . '/uploads/event_meta_imgs/';
            //print_r($data); die;
            $eid = $request->input('eid');
            //print_r($eid); die;
            if($eid > 0){
                $id = $eid;
                \DB::table('tb_events')->where('id', $id)->update($data);  
                $res['message'] = 'Event updated successfully';  
            }else{
                $id = \DB::table('tb_events')->insertGetId($data);
                $res['message'] = 'Event added successfully';
            }
			//$id = $this->model->insertRow($data , $request->input('id'));
			
            /** Start Events **/
            $event_times = array();
            $start_time = $request->input('start_time');
            $end_time = $request->input('end_time');            
            if(!empty($start_time)){
                \DB::table('tb_events_time')->where('event_id', $id)->delete();
                for($i=0; $i < count($start_time); $i++){
                    if($start_time[$i]!='' && $end_time[$i]!=''){
                        $event_times[] = array("event_id"=>$id,"start_time"=>$start_time[$i],"end_time"=>$end_time[$i]);    
                    }
                }
            }            
            if(count($event_times)){ \DB::table('tb_events_time')->insert($event_times); }
            /** End Events **/
            
            /** insert destination start **/
            $destinations  =  $request->input('destinations');
            $final_destinations = array();            
            \DB::table('tb_event_destinations')->where('event_id', $id)->delete();            
            if((count($destinations) > 0)){                
                foreach($destinations as $si_dest){ 
                    $final_destinations[] = array("event_id"=>$id,"destination_id"=>$si_dest); 
                }
            }            
            if(count($final_destinations)){ \DB::table('tb_event_destinations')->insert($final_destinations); }
            /** insert destination End **/ 
            
            /** insert destination start **/
            $tags  =  $request->input('tags');
            $final_tags = array();            
            \DB::table('tb_event_tags')->where('event_id', $id)->delete();            
            if((count($tags) > 0)){                
                foreach($tags as $si_dest){ 
                    $final_tags[] = array("event_id"=>$id,"tag_id"=>$si_dest); 
                }
            }            
            if(count($final_tags)){ \DB::table('tb_event_tags')->insert($final_tags); }
            /** insert destination End **/			
            $res['status'] = 'success';
            $res['id'] = $id;
            
			//return Redirect::to($return)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
			
		} else {
            $res['status'] = 'error';
            $res['message'] = 'Validation Error';
			//return Redirect::to('events/update/'.$id)->with('messagetext',\Lang::get('core.note_error'))->with('msgstatus','error')
			//->withErrors($validator)->withInput();
		}
        echo json_encode($res);        
    }
    
    public function postSaveeo(Request $request){        
        $rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
  		    $eid = $request->input('eid');            
			$data['organizer_name'] = $request->input('organizer_name');
            $data['organizer_email'] = $request->input('organizer_email');
            $data['organizer_phone'] = $request->input('organizer_phone');
            $data['organizer_youtube_channel'] = $request->input('organizer_youtube_channel');
            $data['organizer_instagram'] = $request->input('organizer_instagram');
            //print_r($data); die;
            if($eid > 0){
                $id = $eid;
                \DB::table('tb_events')->where('id', $id)->update($data);
                $res['message'] = 'Organization updated successfully';
            }else{
                $id = \DB::table('tb_events')->insertGetId($data);
                $res['message'] = 'Organization added successfully';
            }			           		
            $res['status'] = 'success';
            $res['id'] = $id;
            		
		} else {
            $res['status'] = 'error';
            $res['message'] = 'Validation Error';			
		}
        echo json_encode($res);        
    }
    
    public function postSaveev(Request $request){        
        $rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
  		    $eid = $request->input('eid');            
			$data['venue_id'] = $request->input('venue');            
            if($eid > 0){
                $id = $eid;
                \DB::table('tb_events')->where('id', $id)->update($data);
                $res['message'] = 'Venue updated successfully';
            }else{
                $id = \DB::table('tb_events')->insertGetId($data);
                $res['message'] = 'Venue added successfully';
            }			           		
            $res['status'] = 'success';
            $res['id'] = $id;
            		
		} else {
            $res['status'] = 'error';
            $res['message'] = 'Validation Error';			
		}
        echo json_encode($res);        
    }
    public function postSaveevdo(Request $request){        
        $rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
  		    $eid = $request->input('eid');
            /** Start Meta tags **/            
            $data['video_type'] = $request->input('video_type');
            $data['video_link_type'] = $request->input('video_link_type');
            $data['video_link'] = $request->input('video_link');            
            $destinationPath = public_path() . '/uploads/event_meta_imgs/';
            if (!is_null($request->file('video'))) {
                $video_type_file = $request->file('video');
                $video_type_filename = $video_type_file->getClientOriginalName();
                $video_type_extension = $video_type_file->getClientOriginalExtension(); //if you need extension of the file
                $video_type_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $video_type_extension;
                $video_type_uploadSuccess = $video_type_file->move($destinationPath, $video_type_filename);
                if ($video_type_uploadSuccess) {
                    $data['video'] = $video_type_filename;                    
                }
            }
            
            if($eid > 0){
                $id = $eid;
                \DB::table('tb_events')->where('id', $id)->update($data);
                $res['message'] = 'Video details updated successfully';
            }else{
                $id = \DB::table('tb_events')->insertGetId($data);
                $res['message'] = 'Video details added successfully';
            }			           		
            $res['status'] = 'success';
            $res['id'] = $id;
            		
		} else {
            $res['status'] = 'error';
            $res['message'] = 'Validation Error';			
		}
        echo json_encode($res);        
    }
    public function postSaveemt(Request $request){        
        $rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
  		    $eid = $request->input('eid');
            /** Start Meta tags **/            
            $data['meta_title'] = $request->input('meta_title');
            $data['meta_description'] = $request->input('meta_description');
            $data['meta_keyword'] = $request->input('meta_keyword');            
            
            if($eid > 0){
                $id = $eid;
                \DB::table('tb_events')->where('id', $id)->update($data);
                $res['message'] = 'Meta tag updated successfully';
            }else{
                $id = \DB::table('tb_events')->insertGetId($data);
                $res['message'] = 'Meta tag added successfully';
            }			           		
            $res['status'] = 'success';
            $res['id'] = $id;
            		
		} else {
            $res['status'] = 'error';
            $res['message'] = 'Validation Error';			
		}
        echo json_encode($res);        
    }
    public function postSaveeog(Request $request){        
        $rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
  		    $eid = $request->input('eid');
            /** Start Meta tags **/            
            $data['og_title'] = $request->input('og_title');
            $data['og_description'] = $request->input('og_description');
            $data['og_url'] = $request->input('og_url');
            $data['og_type'] = $request->input('og_type');            
            $data['og_sitename'] = $request->input('og_sitename');
            $data['og_locale'] = $request->input('og_locale');            
            $data['og_upload_type'] =  $request->input('og_image_type');
            $destinationPath = public_path() . '/uploads/event_meta_imgs/';
            if (!is_null($request->file('og_image_type_upload'))) {
                $og_image_type_file = $request->file('og_image_type_upload');
                $og_image_type_filename = $og_image_type_file->getClientOriginalName();
                $og_image_type_extension = $og_image_type_file->getClientOriginalExtension(); //if you need extension of the file
                $og_image_type_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $og_image_type_extension;
                $og_image_type_uploadSuccess = $og_image_type_file->move($destinationPath, $og_image_type_filename);
                if ($og_image_type_uploadSuccess) {
                    $data['og_image'] = $og_image_type_filename;
                    //$meta_data['og_image_width'] = $request->input('og_image_width');
                    //$meta_data['og_image_height'] = $request->input('og_image_height');
                }
            }
            $data['og_image_link'] =  $request->input('og_image_type_link');
            if($eid > 0){
                $id = $eid;
                \DB::table('tb_events')->where('id', $id)->update($data);
                $res['message'] = 'Open graph updated successfully';
            }else{
                $id = \DB::table('tb_events')->insertGetId($data);
                $res['message'] = 'Open graph added successfully';
            }			           		
            $res['status'] = 'success';
            $res['id'] = $id;            		
		} else {
            $res['status'] = 'error';
            $res['message'] = 'Validation Error';			
		}
        echo json_encode($res);        
    }
    public function postSaveetc(Request $request){        
        $rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
  		    $eid = $request->input('eid');
            /** Start Meta tags **/            
            $data['article_section'] = $request->input('article_section');
            $data['article_tags'] = $request->input('article_tags');
            $data['twitter_url'] = $request->input('twitter_url');
            $data['twitter_title'] = $request->input('twitter_title');
            $data['twitter_description'] = $request->input('twitter_description');
            $data['twitter_image'] = $request->input('twitter_image');
            $data['twitter_domain'] = $request->input('twitter_domain');
            $data['twitter_card'] = $request->input('twitter_card');
            $data['twitter_creator'] = $request->input('twitter_creator');
            $data['twitter_site'] = $request->input('twitter_site');              
            $data['twitter_upload_type'] =  $request->input('twitter_image_type');
            $destinationPath = public_path() . '/uploads/event_meta_imgs/';
            if (!is_null($request->file('twitter_image_type_upload'))) {
                $twitter_image_type_file = $request->file('twitter_image_type_upload');
                $twitter_image_type_filename = $twitter_image_type_file->getClientOriginalName();
                $twitter_image_type_extension = $twitter_image_type_file->getClientOriginalExtension(); //if you need extension of the file
                $twitter_image_type_filename = rand(11111111, 99999999) . '-' . rand(11111111, 99999999) . '.' . $twitter_image_type_extension;
                $twitter_image_type_uploadSuccess = $twitter_image_type_file->move($destinationPath, $twitter_image_type_filename);
                if ($twitter_image_type_uploadSuccess) {
                    $data['twitter_image'] = $twitter_image_type_filename;
                    //$meta_data['twitter_image_width'] = $request->input('twitter_image_width');
                    //$meta_data['twitter_image_height'] = $request->input('twitter_image_height');
                }
            }
            $data['twitter_image_link'] =  $request->input('twitter_image_type_link');
            if($eid > 0){
                $id = $eid;
                \DB::table('tb_events')->where('id', $id)->update($data);
                $res['message'] = 'Twitter card updated successfully';
            }else{
                $id = \DB::table('tb_events')->insertGetId($data);
                $res['message'] = 'Twitter card added successfully';
            }			           		
            $res['status'] = 'success';
            $res['id'] = $id;
            		
		} else {
            $res['status'] = 'error';
            $res['message'] = 'Validation Error';			
		}
        echo json_encode($res);        
    }
    public function getAllevents(Request $request){
        $uid = \Auth::user()->id;
        $allEvents = \DB::table('tb_events')->select('tb_events.id','tb_events.title','tb_events.desciription','tb_events.start_date','tb_events.end_date','tb_events.organizer_name','tb_events.organizer_email','tb_events.status','tb_venue.name','tb_categories.category_name')->leftJoin('tb_venue', 'tb_events.venue_id' , '=', 'tb_venue.id')->leftJoin('tb_categories', 'tb_events.category_id' , '=', 'tb_categories.id')->where('tb_events.user_id', $uid)->get(); 
        
        $total = count($allEvents);        
        $res['status'] = 'success';
        $res['data'] = $allEvents;        
        return json_encode($res);   
    }
    public function postCopy(Request $request, $eid){ 
        $uid = \Auth::user()->id;
        $eid = (int) $eid;        
        if($eid > 0){
            $evnt = \DB::table('tb_events')->where('id', $eid)->first();
           
            if(!empty($evnt)){  
                $data['user_id'] = $evnt->user_id;
                $data['property_id'] = $evnt->property_id;
                
                $data['location'] = $evnt->location;
                $data['title'] = $evnt->title;
                $data['alias'] = $evnt->alias;
                $data['desciription'] = $evnt->desciription;
                $data['category_id'] = $evnt->category_id;            
                $data['start_date'] = $evnt->start_date;
                $data['end_date'] = $evnt->end_date;
                $data['recurring_event'] = $evnt->recurring_event;
                $data['event_recurring'] = $evnt->event_recurring;
                $data['recurring_frequency'] = $evnt->recurring_frequency;            
                $data['latitude'] = $evnt->latitude;
                $data['longitude'] = $evnt->longitude; 
                
                $data['organizer_name'] = $evnt->organizer_name;
                $data['organizer_email'] = $evnt->organizer_email;
                $data['organizer_phone'] = $evnt->organizer_phone;
                $data['organizer_youtube_channel'] = $evnt->organizer_youtube_channel;
                $data['organizer_instagram'] = $evnt->organizer_instagram;
                
                $data['venue_id'] = $evnt->venue_id;
                
                $data['video'] = $evnt->video; 
                $data['video_type'] = $evnt->video_type;
                $data['video_link_type'] = $evnt->video_link_type;
                $data['video_link'] = $evnt->video_link;   
                
                $data['meta_title'] = $evnt->meta_title;
                $data['meta_description'] = $evnt->meta_description;
                $data['meta_keyword'] = $evnt->meta_keyword; 
                
                $data['og_title'] = $evnt->og_title;
                $data['og_description'] = $evnt->og_description;
                $data['og_url'] = $evnt->og_url;
                $data['og_type'] = $evnt->og_type;            
                $data['og_sitename'] = $evnt->og_sitename;
                $data['og_locale'] = $evnt->og_locale;            
                $data['og_upload_type'] = $evnt->og_upload_type;
                $data['og_image'] = $evnt->og_image;            
                $data['og_image_link'] = $evnt->og_image_link;
                
                $data['article_section'] = $evnt->article_section;
                $data['article_tags'] = $evnt->article_tags;
                $data['twitter_url'] = $evnt->twitter_url;
                $data['twitter_title'] = $evnt->twitter_title;
                $data['twitter_description'] = $evnt->twitter_description;
                $data['twitter_image'] = $evnt->twitter_image;
                $data['twitter_domain'] = $evnt->twitter_domain;
                $data['twitter_card'] = $evnt->twitter_card;
                $data['twitter_creator'] = $evnt->twitter_creator;
                $data['twitter_site'] = $evnt->twitter_site;              
                $data['twitter_upload_type'] = $evnt->twitter_upload_type;
                $data['twitter_image'] = $evnt->twitter_image;
                $data['twitter_image_link'] = $evnt->twitter_image_link;
                
                $id = \DB::table('tb_events')->insertGetId($data);                
                
                $event_times = array();
                $start_time = $request->input('start_time');
                $end_time = $request->input('end_time');            
                if(!empty($start_time)){
                    \DB::table('tb_events_time')->where('event_id', $id)->delete();
                    for($i=0; $i < count($start_time); $i++){
                        if($start_time[$i]!='' && $end_time[$i]!=''){
                            $event_times[] = array("event_id"=>$id,"start_time"=>$start_time[$i],"end_time"=>$end_time[$i]);    
                        }
                    }
                }            
                if(count($event_times)){ \DB::table('tb_events_time')->insert($event_times); }
                
                $destinations  =  $request->input('destinations');
                $final_destinations = array();            
                \DB::table('tb_event_destinations')->where('event_id', $id)->delete();            
                if((count($destinations) > 0)){                
                    foreach($destinations as $si_dest){ 
                        $final_destinations[] = array("event_id"=>$id,"destination_id"=>$si_dest); 
                    }
                }            
                if(count($final_destinations)){ \DB::table('tb_event_destinations')->insert($final_destinations); }
                
                $tags  =  $request->input('tags');
                $final_tags = array();            
                \DB::table('tb_event_tags')->where('event_id', $id)->delete();            
                if((count($tags) > 0)){                
                    foreach($tags as $si_dest){ 
                        $final_tags[] = array("event_id"=>$id,"tag_id"=>$si_dest); 
                    }
                }            
                if(count($final_tags)){ \DB::table('tb_event_tags')->insert($final_tags); }
                $new_obj = \DB::table('tb_events')->select('tb_events.id','tb_events.title','tb_events.desciription','tb_events.start_date','tb_events.end_date','tb_events.organizer_name','tb_events.organizer_email','tb_events.status','tb_venue.name','tb_categories.category_name')->leftJoin('tb_venue', 'tb_events.venue_id' , '=', 'tb_venue.id')->leftJoin('tb_categories', 'tb_events.category_id' , '=', 'tb_categories.id')->where('tb_events.user_id', $uid)->where('tb_events.id', $id)->first();
                $res['status'] = 'success'; 
                $res['obj'] = $new_obj; 
                $res['message'] = 'Event copied successfully';
            }else{
                $res['status'] = 'error'; 
                $res['message'] = 'Error while copying';
            }
            
        }else{
            $res['status'] = 'error'; 
            $res['message'] = 'Error while copying';
        }
        echo json_encode($res);       
    }
    
    public function postChangestatus(Request $request, $eid, $status){ 
        $uid = \Auth::user()->id;
        //$sts = $status;
        $eid = (int) $eid;        
        if($eid > 0){
            $evnt = \DB::table('tb_events')->where('id', $eid)->update(array('status'=>$status));            
            $res['status'] = 'success';
            $res['ev_status'] = $status; 
            //$res['obj'] = $new_obj; 
            $res['message'] = 'Status changed successfully';
        }else{
            $res['status'] = 'error'; 
            $res['message'] = 'Error while changing status';
        }
        echo json_encode($res);       
    }
    
}