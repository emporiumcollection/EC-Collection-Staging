<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\ContainerController;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Controllers\Controller;
use App\User;
use DB,Validator, Input, Redirect, CommonHelper, Mail;
class HotelMembershipController extends Controller {

    public function __construct() {
        
       // $this->middleware('auth');
        parent::__construct();
        if(!isset(\Auth::user()->id)){
            Redirect::to('/')->send();
        }
        $this->data['pageTitle'] = '';
        $this->data['data'] = CommonHelper::getInfo();
        $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 117)->get();
        $this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();

        $this->data['pageTitle'] = "Hotel Membership";
        $this->data['pageMetakey'] = "Hotel Membership";
        $this->data['pageMetadesc'] = "Hotel Membership";
        
    }
    
    /*
     * For Hotel Membership Signup Page
    */
    public function membershipSignup(Request $request) {
        
        return view('frontend.hotel_membership.hotel_membership_signup', $this->data);
    }

    /*
     * For Saving Hotel Membership Signup into Database
    */
    public function membershipSignupSave(Request $request) {

        $uid = \Session::get('uid');
        $rules['hotelinfo_name'] = 'required';
        $rules['hotelinfo_status'] = 'required';
        $rules['hotelinfo_type'] = 'required';
        $rules['hotelinfo_building'] = 'required';
        $rules['hotelinfo_opening_date'] = 'required';
        $rules['hotelinfo_address'] = 'required';
        $rules['hotelinfo_city'] = 'required';
        $rules['hotelinfo_country'] = 'required';
        $rules['hotelinfo_postal'] = 'required';
        $rules['hotelinfo_website'] = 'required';
        $rules['hotelinfo_daysopen'] = 'required';
        $rules['hotelfac_num_rooms'] = 'required';
        $rules['hotelfac_num_suites'] = 'required';
        $rules['hoteldesc_concept'] = 'required';
        $rules['hotel_contactinfo_address'] = 'required';
        $rules['hotel_contactinfo_city'] = 'required';
        $rules['hotel_contactinfo_country'] = 'required';
        $rules['hotel_contactinfo_postal'] = 'required';
        $rules['hotel_contactprsn_firstname'] = 'required';
        $rules['hotel_contactprsn_lastname'] = 'required';
        $rules['hotel_contactprsn_companyname'] = 'required';
        $rules['hotel_contactprsn_jobtitle'] = 'required';
        //$rules['hotel_contactprsn_email'] = 'required|email|unique:tb_users';
        $rules['hotel_contactprsn_phone'] = 'required';
        //$rules['hotel_contactprsn_mobile'] = 'required';
       // $rules['hotel_signup_type'] = 'required';
        //$rules['hotel_contactprsn_username'] = 'required';
        //$rules['hotel_contactprsn_password'] = 'required|confirmed';
        //$rules['hotel_contactprsn_password_confirmation'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            
            $code = rand(10000, 10000000);
            $authen =  User::find($uid);
            $authen->first_name = $request->input('hotel_contactprsn_firstname');
            $authen->last_name = $request->input('hotel_contactprsn_lastname');
            //$authen->email = trim($request->input('hotel_contactprsn_email'));
            //$authen->username = trim($request->input('hotel_contactprsn_username'));
            $authen->landline_number = trim($request->input('hotel_contactprsn_phone'));
            //$authen->mobile_number = trim($request->input('hotel_contactprsn_mobile'));
            $authen->address = trim($request->input('hotel_contactinfo_address'));
            $authen->city = trim($request->input('hotel_contactinfo_city'));
            $authen->zip_code = trim($request->input('hotel_contactinfo_postal'));
            $authen->country = trim($request->input('hotel_contactinfo_country'));
            $authen->activation = $code;
            //$authen->active = '0';
            $authen->save();
            
            $data['property_name'] = $request->input('hotelinfo_name');
            $data['property_short_name'] = $request->input('hotelinfo_name');
            $alias = \SiteHelpers::seoUrl(Input::get('hotelinfo_name'));
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
            $data['social_status'] = 1;
            $data['property_type'] = 'Hotel';
            $data['booking_type'] = 'Rent';
            $data['created'] = date('Y-m-d h:i:s');
            $data['hotelinfo_status'] = $request->input('hotelinfo_status');
            $data['hotelinfo_type'] = $request->input('hotelinfo_type');
            $data['hotelinfo_building'] = $request->input('hotelinfo_building');
            $data['hotelinfo_opening_date'] = $request->input('hotelinfo_opening_date');
            $data['hotelinfo_address'] = $request->input('hotelinfo_address');
            $data['city'] = $request->input('hotelinfo_city');
            $data['country'] = $request->input('hotelinfo_country');
            $data['hotelinfo_postal'] = $request->input('hotelinfo_postal');
            $data['website'] = $request->input('hotelinfo_website');
            $data['hotelinfo_daysopen'] = $request->input('hotelinfo_daysopen');
            $data['hotelinfo_avg_daily_rate'] = $request->input('hotelinfo_avg_daily_rate');
            $data['hotelinfo_avg_occupancy'] = $request->input('hotelinfo_avg_occupancy');
            
            $data['hotelfac_num_rooms'] = $request->input('hotelfac_num_rooms');
            $data['hotelfac_num_suites'] = $request->input('hotelfac_num_suites');
            if (!empty($request->input('hotelfac_fb_outlets'))) {
                $data['hotelfac_fb_outlets'] = implode(',', $request->input('hotelfac_fb_outlets'));
            } else {
                $data['hotelfac_fb_outlets'] = '';
            }
            if (!empty($request->input('hotelfac_guest_fac'))) {
                $data['hotelfac_guest_fac'] = implode(',', $request->input('hotelfac_guest_fac'));
            } else {
                $data['hotelfac_guest_fac'] = '';
            }
            $data['hotelfac_meeting_area'] = $request->input('hotelfac_meeting_area');
            $data['hotelfac_meeting_fac'] = $request->input('hotelfac_meeting_fac');
            $data['hotelfac_comments'] = $request->input('hotelfac_comments');
            
            $data['hoteldesc_concept'] = $request->input('hoteldesc_concept');
            $data['architecture_desciription'] = $request->input('hoteldesc_architecture_design');
            $data['architecture_title'] = $request->input('hoteldesc_architecture_name');
            $data['architecture_design_desciription'] = $request->input('hoteldesc_architecture_design');
            $data['architecture_design_title'] = $request->input('hoteldesc_architecture_name');
            $data['architecture_design_url'] = $request->input('hoteldesc_architecture_website');
            $data['architecture_designer_title'] = $request->input('hoteldesc_interior_designer_name');
            $data['architecture_designer_url'] = $request->input('hoteldesc_interior_designer_website');
            $data['hoteldesc_local_integration'] = $request->input('hoteldesc_local_integration');
            $data['hoteldesc_brand'] = $request->input('hoteldesc_brand');
            $data['hoteldesc_brand_agency_name'] = $request->input('hoteldesc_brand_agency_name');
            $data['hoteldesc_brand_agency_website'] = $request->input('hoteldesc_brand_agency_website');
            $data['hoteldesc_brand_linkdin_profile'] = $request->input('hoteldesc_brand_linkdin_profile');
            $data['social_instagram'] = $request->input('hoteldesc_brand_instagram_profile');
            
            $data['hotel_contactinfo_name'] = $request->input('hotel_contactinfo_name');
            $data['owner_address'] = $request->input('hotel_contactinfo_address');
            $data['owner_city'] = $request->input('hotel_contactinfo_city');
            $data['owner_country'] = $request->input('hotel_contactinfo_country');
            $data['owner_postal_code'] = $request->input('hotel_contactinfo_postal');
            
            $data['owner_name'] = $request->input('hotel_contactprsn_firstname');
            $data['owner_last_name'] = $request->input('hotel_contactprsn_lastname');
            $data['hotel_contactprsn_companyname'] = $request->input('hotel_contactprsn_companyname');
            $data['hotel_contactprsn_jobtitle'] = $request->input('hotel_contactprsn_jobtitle');
            $data['owner_email_primary'] = $authen->email;
            $data['owner_phone_primary'] = $request->input('hotel_contactprsn_phone');
            $data['owner_phone_emergency'] = $authen->mobile_number;
            if (!is_null($request->input('hotel_contactprsn_agree'))) {
                $data['hotel_contactprsn_agree'] = $request->input('hotel_contactprsn_agree');
            } else {
                $data['hotel_contactprsn_agree'] = 0;
            }
            $propertyquery = \DB::table('tb_properties')->insertGetId($data);
            
            $res['status'] = 'success';
            return json_encode($res);
        } else {

            $res['status'] = 'error';
            $res['errors'] = $validator->errors()->all();
            return json_encode($res);
        }
        
    }
    
    
    
    /*
     * For Hotel Choose Package Page
    */
    public function hotelPackage(Request $request) {
        $group_id = \Session::get('gid');
        $this->data['packages'] = \DB::table('tb_packages')->where('allow_user_groups', $group_id)->where('package_status', 1)->get();
        $packages_ids = array();
        foreach($this->data['packages'] as $si_package){
            $packages_ids[] = $si_package->id;
        }        
        $this->data['moduleDetails'] = \DB::table('tb_module')->get();
        
        //get contract during signup
        $this->data['userContracts'] = array();
        $this->data['common_contracts'] = array();
        $this->data['package_contracts'] = array();
        if(count($packages_ids) > 0){
            $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id','tb_users_contracts.title','tb_users_contracts.description')->where('tb_users_contracts.contract_type','packages')->orderBy('tb_users_contracts.contract_id','DESC')->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->get();
            $resetContracts = array();
            foreach($usersContracts as $si_contract){
                $resetContracts[$si_contract->contract_id] = $si_contract;
            }
            $this->data['userContracts'] = $resetContracts;
            $contracts = \CommonHelper::get_default_contracts('packages','default',0,$packages_ids);
            $this->data['common_contracts'] = $contracts['common'];
            $this->data['package_contracts'] = $contracts['packages_wise'];
        }            
        //End
        //echo "<pre>"; print_r($this->data['common_contracts']);print_r($this->data['package_contracts']);die;
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.frontend.hotel_membership.hotel_package':'frontend.hotel_membership.hotel_package';      
        
        return view($file_name, $this->data);
        //return view('frontend.hotel_membership.hotel_package', $this->data);
    }

    /*
     * For Advertise Choose Package Page
    */
    public function advertisementPackage(Request $request) {
        $category_list = \DB::table('tb_categories')->select('category_name','id')->get();
        $this->data['category_list'][] = ' - Category - ';
        foreach ($category_list as $key => $categoryObj) {
            $this->data['category_list'][$categoryObj->id] = $categoryObj->category_name;
        }
        
                    
       $positionArr = array();
       $positionArr[''] = '- Position -';
       $positionArr['landing'] = 'Landing Page Sidebar';
       $positionArr['landing_slider'] = 'Landing Page Slider';
       $positionArr['grid_results'] = 'Grid Page Results';
       $positionArr['grid_slider'] = 'Grid Page Slider';
       $positionArr['grid_sidebar'] = 'Grid Page Sidebar';
       $positionArr['grid_popup'] = 'Grid Page Quick View Pop Up';
       $positionArr['detail_sidebar'] = 'Detail Page Sidebar';
       $positionArr['detail_restaurant_popup'] = 'Detail Page Restaurant Pop Up';
       $positionArr['detail_spa_popup'] = 'Detail Page Spa Pop Up';
       $positionArr['detail_bar_popup'] = 'Detail Page Bar Pop Up';
       $this->data['ads_position_list'] = $positionArr; 

       $ads_pacakge_type = array();
       $ads_pacakge_type[''] = ' - Type -';
       $ads_pacakge_type['cpc'] = 'CPC Target Clicks';
       $ads_pacakge_type['cpm'] = 'CPM Target View';
       $ads_pacakge_type['cpd'] = 'CPD Target Day';
       $this->data['ads_pacakge_type'] = $ads_pacakge_type; 

       return view('frontend.hotel_membership.hotel_advertisement', $this->data);
    }

    /*
     * For Hotel Cart Page
    */
    public function hotelCart(Request $request) {
        
        $group_id = \Session::get('gid');
        $this->data['packages'] = \DB::table('tb_packages')->where('allow_user_groups', $group_id)->where('package_status', 1)->get();
        $packages_ids = array();
        foreach($this->data['packages'] as $si_package){
            $packages_ids[] = $si_package->id;
        }  
        
        $hotelPkgID = array(0);
        $advertPkgID = '';

       //print_r($request->session()->get('hotel_cart')); die;
        if(!empty($request->session()->get('hotel_cart'))){

            foreach ($request->session()->get('hotel_cart') as $cartkey => $cartValue) {
                if($cartValue['package']['type']=='hotel'){
                    $hotelPkgID[] = $cartValue['package']['id'];
                }
                if($cartValue['package']['type']=='advert'){
                    $advertPkgID = $cartValue['package']['content']['id'];
                }
            }
        }

        $htoelPkgQry = "Select tb_pkg.id,tb_pkg.package_title,tb_pkg.package_image,tb_pkg.package_price,tb_pkg.package_modules  from tb_packages tb_pkg where tb_pkg.id in(".implode(',',$hotelPkgID).")"; 
        $dataPackage = \DB::select($htoelPkgQry);
		$this->data['packages'] = $dataPackage;
		$adsdataPackage = array();
		if($advertPkgID!=''){
			$adsmainPkgQry  =  "Select *  from tb_advertisement_space where id = '". $advertPkgID."'";
			$adsdataPackage = \DB::select($adsmainPkgQry);
		}
		$this->data['adspackages'] = $adsdataPackage;
		
        if(count($packages_ids) > 0){
            $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id','tb_users_contracts.title','tb_users_contracts.description')->where('tb_users_contracts.contract_type','packages')->orderBy('tb_users_contracts.contract_id','DESC')->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->get();
            $resetContracts = array();
            foreach($usersContracts as $si_contract){
                $resetContracts[$si_contract->contract_id] = $si_contract;
            }
            $this->data['userContracts'] = $resetContracts;
            $contracts = \CommonHelper::get_default_contracts('packages','default',0,$packages_ids);
            $this->data['common_contracts'] = $contracts['common'];
            $this->data['package_contracts'] = $contracts['packages_wise'];
        }
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.frontend.hotel_membership.hotel_cart':'frontend.hotel_membership.hotel_cart';
        
        return view($file_name, $this->data);
        //return view('frontend.hotel_membership.hotel_cart', $this->data);
    }

    /*
     * For Checkout Page
    */
    public function hotelCheckout(Request $request) {
        
        $group_id = \Session::get('gid');
        $this->data['packages'] = \DB::table('tb_packages')->where('allow_user_groups', $group_id)->where('package_status', 1)->get();
        $packages_ids = array();
        foreach($this->data['packages'] as $si_package){
            $packages_ids[] = $si_package->id;
        }

		$hotelPkgID = array(0);
		$advertPkgID = '';

		//print_r($request->session()->get('hotel_cart')); die;
		if(!empty($request->session()->get('hotel_cart'))){

			foreach ($request->session()->get('hotel_cart') as $cartkey => $cartValue) {
				if($cartValue['package']['type']=='hotel'){
					$hotelPkgID[] = $cartValue['package']['id'];
				}
				if($cartValue['package']['type']=='advert'){
					$advertPkgID = $cartValue['package']['content']['id'];
				}
			}
		}

		
		$mainPkgQry = "Select tb_pkg.id,tb_pkg.package_title,tb_pkg.package_image,tb_pkg.package_price,tb_pkg.package_modules  from tb_packages tb_pkg where tb_pkg.id in(".implode(',',$hotelPkgID).")"; 
		$dataPackage = \DB::select($mainPkgQry);        
		$this->data['packages'] = $dataPackage;
		
		$adsdataPackage = array();
		if($advertPkgID!=''){
			$adsmainPkgQry  =  "Select *  from tb_advertisement_space where id = '". $advertPkgID."'";
			$adsdataPackage = \DB::select($adsmainPkgQry);
		}
		$this->data['adspackages'] = $adsdataPackage;
        $this->data['pageslider']="";
        
        if(count($packages_ids) > 0){
            $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id','tb_users_contracts.title','tb_users_contracts.description')->where('tb_users_contracts.contract_type','packages')->orderBy('tb_users_contracts.contract_id','DESC')->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->get();
            $resetContracts = array();
            foreach($usersContracts as $si_contract){
                $resetContracts[$si_contract->contract_id] = $si_contract;
            }
            $this->data['userContracts'] = $resetContracts;
            $contracts = \CommonHelper::get_default_contracts('packages','default',0,$packages_ids);
            $this->data['common_contracts'] = $contracts['common'];
            $this->data['package_contracts'] = $contracts['packages_wise'];
        }
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.frontend.hotel_membership.hotel_checkout':'frontend.hotel_membership.hotel_checkout';
        return view($file_name, $this->data);
        //return view('frontend.hotel_membership.hotel_checkout', $this->data);
    }

    /*
     * For Saving Packages Into Cart
    */
    public function addToCartAjax(Request $request){

        $cartPkgType = $request->input('cart')['package']['id'].'_'.$request->input('cart')['package']['type'];  
        $cart = array();
        $cartObj = $request->input('cart')['package'];
        
        $cartItems = $request->session()->get('hotel_cart');
        $cart[$cartPkgType]['package']['id'] = $cartObj['id'];
        $cart[$cartPkgType]['package']['price'] = $cartObj['price'];
        $cart[$cartPkgType]['package']['qty'] = 1;
        $cart[$cartPkgType]['package']['type'] = $cartObj['type'];
        $cart[$cartPkgType]['package']['content'] = (!empty($cartObj['content']))?$cartObj['content']:'';
        if(!empty($cartItems)){
            $cartItems = array_merge($cartItems,$cart);
        }else{
            $cartItems = $cart;
        }

        $request->session()->put('hotel_cart', $cartItems);

        return response()->json(array('status'=>true,'error'=>false));

    }

     /*
     * For Get Advertisement Packages Price
    */
    public function getAdvertPriceAjax(Request $request){
        
        $dataPrice = \DB::table('tb_advertisement_space')->select('space_title','id','space_cpm_price','space_cpd_price','space_cpc_price','space_cpm_num_days')->where('space_category','=',$request->input('category_id'))->where('space_position','=',$request->input('ads_position'))->first();
        return response()->json($dataPrice);


    }
    
    
    public function getThanks(Request $request) {
        $uid = \Session::get('uid');
        $this->data['pageTitle'] = "Thanks Page";
        $this->data['pageMetakey'] = "Thanks Page";
        $this->data['pageMetadesc'] = "Thanks Page";
        $this->data['data'] = CommonHelper::getInfo();

        $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 107)->get();
        
        $obj_user = \DB::table('tb_users')->where('id', $uid)->first();
        $this->data['user'] = $obj_user;
        
        $this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.frontend.hotel_membership.thanks':'frontend.hotel_membership.thanks';      
        
        return view($file_name, $this->data); 
        //return view('frontend.hotel_membership.thanks', $this->data);
    }


    public function getCartItemRemovedAjax(Request $request){


        $cartPkgType = $request->input('cart')['package']['id'].'_'.$request->input('cart')['package']['type'];  
        $cart = array();
        $cartObj = $request->input('cart')['package'];
        
        $cartItems = $request->session()->get('hotel_cart');

      
        if($request->input('cart')['package']['type']=="hotel"){
            unset($cartItems[$cartPkgType]);
            $request->session()->put('hotel_cart', $cartItems);
        }

        if($request->input('cart')['package']['type']=="advert"){           
            unset($cartItems["advert_advert"]);
            $request->session()->put('hotel_cart', $cartItems);
        }
       return ("success");   

    }
    
    /*
     * For Saving Hotel Membership Signup into Database
    */
    public function hotelMembershipSignupSave(Request $request) {

        $uid = \Session::get('uid');
        $rules['hotelinfo_name'] = 'required';
        $rules['hotelinfo_status'] = 'required';
        $rules['hotelinfo_type'] = 'required';
        $rules['hotelinfo_building'] = 'required';
        $rules['hotelinfo_opening_date'] = 'required';
        $rules['hotelinfo_address'] = 'required';
        $rules['hotelinfo_city'] = 'required';
        $rules['hotelinfo_country'] = 'required';
        $rules['hotelinfo_postal'] = 'required';
        $rules['hotelinfo_website'] = 'required';
        $rules['hotelinfo_daysopen'] = 'required';
        $rules['hotelfac_num_rooms'] = 'required';
        $rules['hotelfac_num_suites'] = 'required';
        $rules['hoteldesc_concept'] = 'required';
        $rules['hotel_contactinfo_address'] = 'required';
        $rules['hotel_contactinfo_city'] = 'required';
        $rules['hotel_contactinfo_country'] = 'required';
        $rules['hotel_contactinfo_postal'] = 'required';
        $rules['hotel_contactprsn_firstname'] = 'required';
        $rules['hotel_contactprsn_lastname'] = 'required';
        $rules['hotel_contactprsn_companyname'] = 'required';
        $rules['hotel_contactprsn_jobtitle'] = 'required';
        //$rules['hotel_contactprsn_email'] = 'required|email|unique:tb_users';
        $rules['hotel_contactprsn_phone'] = 'required';
        //$rules['hotel_contactprsn_mobile'] = 'required';
       // $rules['hotel_signup_type'] = 'required';
        //$rules['hotel_contactprsn_username'] = 'required';
        //$rules['hotel_contactprsn_password'] = 'required|confirmed';
        //$rules['hotel_contactprsn_password_confirmation'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            
            $code = rand(10000, 10000000);
            $authen =  User::find($uid);
            $authen->first_name = $request->input('hotel_contactprsn_firstname');
            $authen->last_name = $request->input('hotel_contactprsn_lastname');
            //$authen->email = trim($request->input('hotel_contactprsn_email'));
            //$authen->username = trim($request->input('hotel_contactprsn_username'));
            $authen->landline_number = trim($request->input('hotel_contactprsn_phone'));
            //$authen->mobile_number = trim($request->input('hotel_contactprsn_mobile'));
            $authen->address = trim($request->input('hotel_contactinfo_address'));
            $authen->city = trim($request->input('hotel_contactinfo_city'));
            $authen->zip_code = trim($request->input('hotel_contactinfo_postal'));
            $authen->country = trim($request->input('hotel_contactinfo_country'));
            $authen->form_wizard = $request->input('form_wizard_2');
            $authen->activation = $code;
            //$authen->active = '0';
            $authen->save();
            
            $data['property_name'] = $request->input('hotelinfo_name');
            $data['property_short_name'] = $request->input('hotelinfo_name');
            $alias = \SiteHelpers::seoUrl(Input::get('hotelinfo_name'));
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
            $hod_final ='';
            $hod = $request->input('hotelinfo_opening_date');
            if(strlen($hod)>0){
                $hod_arr = explode('/', $hod);                
                if(count($hod_arr)>1){
                    $hod_final = $hod_arr[2]."-".$hod_arr[0]."-".$hod_arr[1];
                }
            }
            //print_r($hod_final); die;
            $data['user_id'] = $uid;
            $data['property_slug'] = $alias;
            $data['social_status'] = 1;
            $data['property_type'] = 'Hotel';
            $data['booking_type'] = 'Rent';
            $data['created'] = date('Y-m-d h:i:s');
            $data['hotelinfo_status'] = $request->input('hotelinfo_status');
            $data['hotelinfo_type'] = $request->input('hotelinfo_type');
            $data['hotelinfo_building'] = $request->input('hotelinfo_building');
            $data['hotelinfo_opening_date'] = $hod_final;
            $data['hotelinfo_address'] = $request->input('hotelinfo_address');
            $data['city'] = $request->input('hotelinfo_city');
            $data['country'] = $request->input('hotelinfo_country');
            $data['hotelinfo_postal'] = $request->input('hotelinfo_postal');
            $data['website'] = $request->input('hotelinfo_website');
            $data['hotelinfo_daysopen'] = $request->input('hotelinfo_daysopen');
            $data['hotelinfo_avg_daily_rate'] = $request->input('hotelinfo_avg_daily_rate');
            $data['hotelinfo_avg_occupancy'] = $request->input('hotelinfo_avg_occupancy');
            
            $data['hotelfac_num_rooms'] = $request->input('hotelfac_num_rooms');
            $data['hotelfac_num_suites'] = $request->input('hotelfac_num_suites');
            if (!empty($request->input('hotelfac_fb_outlets'))) {
                $data['hotelfac_fb_outlets'] = implode(',', $request->input('hotelfac_fb_outlets'));
            } else {
                $data['hotelfac_fb_outlets'] = '';
            }
            if (!empty($request->input('hotelfac_guest_fac'))) {
                $data['hotelfac_guest_fac'] = implode(',', $request->input('hotelfac_guest_fac'));
            } else {
                $data['hotelfac_guest_fac'] = '';
            }
            $data['hotelfac_meeting_area'] = $request->input('hotelfac_meeting_area');
            $data['hotelfac_meeting_fac'] = $request->input('hotelfac_meeting_fac');
            $data['hotelfac_comments'] = $request->input('hotelfac_comments');
            
            $data['hoteldesc_concept'] = $request->input('hoteldesc_concept');
            $data['architecture_desciription'] = $request->input('hoteldesc_architecture_design');
            $data['architecture_title'] = $request->input('hoteldesc_architecture_name');
            $data['architecture_design_desciription'] = $request->input('hoteldesc_architecture_design');
            $data['architecture_design_title'] = $request->input('hoteldesc_architecture_name');
            $data['architecture_design_url'] = $request->input('hoteldesc_architecture_website');
            $data['architecture_designer_title'] = $request->input('hoteldesc_interior_designer_name');
            $data['architecture_designer_url'] = $request->input('hoteldesc_interior_designer_website');
            $data['hoteldesc_local_integration'] = $request->input('hoteldesc_local_integration');
            $data['hoteldesc_brand'] = $request->input('hoteldesc_brand');
            $data['hoteldesc_brand_agency_name'] = $request->input('hoteldesc_brand_agency_name');
            $data['hoteldesc_brand_agency_website'] = $request->input('hoteldesc_brand_agency_website');
            $data['hoteldesc_brand_linkdin_profile'] = $request->input('hoteldesc_brand_linkdin_profile');
            $data['social_instagram'] = $request->input('hoteldesc_brand_instagram_profile');
            
            $data['hotel_contactinfo_name'] = $request->input('hotel_contactinfo_name');
            $data['owner_address'] = $request->input('hotel_contactinfo_address');
            $data['owner_city'] = $request->input('hotel_contactinfo_city');
            $data['owner_country'] = $request->input('hotel_contactinfo_country');
            $data['owner_postal_code'] = $request->input('hotel_contactinfo_postal');
            
            $data['owner_name'] = $request->input('hotel_contactprsn_firstname');
            $data['owner_last_name'] = $request->input('hotel_contactprsn_lastname');
            $data['hotel_contactprsn_companyname'] = $request->input('hotel_contactprsn_companyname');
            $data['hotel_contactprsn_jobtitle'] = $request->input('hotel_contactprsn_jobtitle');
            $data['owner_email_primary'] = $authen->email;
            $data['owner_phone_primary'] = $request->input('hotel_contactprsn_phone');
            $data['owner_phone_emergency'] = $authen->mobile_number;
            
            $data['approved'] = 0;
            
            if (!is_null($request->input('hotel_contactprsn_agree'))) {
                $data['hotel_contactprsn_agree'] = $request->input('hotel_contactprsn_agree');
            } else {
                $data['hotel_contactprsn_agree'] = 0;
            }
            
            $check_prop_user = \DB::table('tb_properties')->where('user_id', $uid)->get();
            
            if(!empty($check_prop_user)){
                $propertyquery = \DB::table('tb_properties')->where('user_id', $uid)->update($data);
            }else{            
                $propertyquery = \DB::table('tb_properties')->insertGetId($data);
            }
            
            $email_data = array();
            \Mail::send('user.emails.invoice', $email_data, function($message){
                $message->from(CNF_EMAIL, CNF_APPNAME);

                $message->to('aman.01rad@gmail.com');

                $message->subject('Testing Email');
            });
            
            $res['status'] = 'success';
            $res['message'] = 'Hotel information has been successfully submitted!';
            return json_encode($res);
        } else {

            $res['status'] = 'error';
            $res['errors'] = $validator->errors()->all();
            $res['message'] = 'Hotel information not submitted errors occurred!';
            return json_encode($res);
        }
        
    }
    
    public function getwizardCart(Request $request) {
        
        $group_id = \Session::get('gid');
        $this->data['packages'] = \DB::table('tb_packages')->where('allow_user_groups', $group_id)->where('package_status', 1)->get();
        $packages_ids = array();
        foreach($this->data['packages'] as $si_package){
            $packages_ids[] = $si_package->id;
        }  
        
        $hotelPkgID = array(0);
        $advertPkgID = '';

       //print_r($request->session()->get('hotel_cart')); die;
        if(!empty($request->session()->get('hotel_cart'))){

            foreach ($request->session()->get('hotel_cart') as $cartkey => $cartValue) {
                if($cartValue['package']['type']=='hotel'){
                    $hotelPkgID[] = $cartValue['package']['id'];
                }
                if($cartValue['package']['type']=='advert'){
                    $advertPkgID = $cartValue['package']['content']['id'];
                }
            }
        }else{
            $group_id = \Session::get('gid');
            $default_package = \DB::table('tb_packages')->where('allow_user_groups', $group_id)->where('package_status', 1)->where('package_for', 2)->first();
            $cartPkgType = $default_package->id.'_hotel';  
            $cart = array();
            //$cartObj = $request->input('cart')['package'];
            
            $cartItems = $request->session()->get('hotel_cart');
            $cart[$cartPkgType]['package']['id'] = $default_package->id;
            $cart[$cartPkgType]['package']['price'] = $default_package->package_price;
            $cart[$cartPkgType]['package']['qty'] = 1;
            $cart[$cartPkgType]['package']['type'] = 'hotel';
            $cart[$cartPkgType]['package']['content'] = '';
            $cart[$cartPkgType]['package']['fee'] = '';
            if(!empty($cartItems)){
                $cartItems = array_merge($cartItems,$cart);
            }else{
                $cartItems = $cart;
            }
    
            $request->session()->put('hotel_cart', $cartItems);
            $hotelPkgID[] = $default_package->id;
        }
        
        $obj_user = \DB::table('tb_users')->where('id', \Auth::user()->id)->first();
        //print_r($obj_user);
        if(!empty($obj_user)){
            $group_id = \Session::get('gid');
            $setup_package = \DB::table('tb_packages')->where('allow_user_groups', $group_id)->where('package_status', 1)->where('package_for', 1)->first();
                          
            if($obj_user->own_hotel_setup){                
                $cartPkgType = $setup_package->id.'_hotel';  
                $cart = array();  
                $cartItems = $request->session()->get('hotel_cart');
                if(!isset($cartItems[$cartPkgType])){
                    $cart[$cartPkgType]['package']['id'] = $setup_package->id;
                    $cart[$cartPkgType]['package']['price'] = $setup_package->package_price;
                    $cart[$cartPkgType]['package']['qty'] = 1;
                    $cart[$cartPkgType]['package']['type'] = 'hotel';
                    $cart[$cartPkgType]['package']['content'] = '';
                    $cart[$cartPkgType]['package']['fee'] = '';
                    if(!empty($cartItems)){
                        $cartItems = array_merge($cartItems,$cart);
                    }else{
                        $cartItems = $cart;
                    }
            
                    $request->session()->put('hotel_cart', $cartItems);
                    $hotelPkgID[] = $setup_package->id;
                }
            }else{
                $cartPkgType = $setup_package->id.'_hotel';                
                $cartItems = $request->session()->get('hotel_cart');
                unset($cartItems[$cartPkgType]);
                $request->session()->put('hotel_cart', $cartItems);                
            }
        }
        
        $htoelPkgQry = "Select tb_pkg.id,tb_pkg.package_title,tb_pkg.package_image,tb_pkg.package_price,tb_pkg.package_modules,tb_pkg.package_for  from tb_packages tb_pkg where tb_pkg.id in(".implode(',',$hotelPkgID).")"; 
        $dataPackage = \DB::select($htoelPkgQry);
		$this->data['packages'] = $dataPackage;
		$adsdataPackage = array();
		if($advertPkgID!=''){
			$adsmainPkgQry  =  "Select *  from tb_advertisement_space where id = '". $advertPkgID."'";
			$adsdataPackage = \DB::select($adsmainPkgQry);
		}
		$this->data['adspackages'] = $adsdataPackage;
		
        if(count($packages_ids) > 0){
            $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id','tb_users_contracts.title','tb_users_contracts.description')->where('tb_users_contracts.contract_type','packages')->orderBy('tb_users_contracts.contract_id','DESC')->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->get();
            $resetContracts = array();
            foreach($usersContracts as $si_contract){
                $resetContracts[$si_contract->contract_id] = $si_contract;
            }
            $this->data['userContracts'] = $resetContracts;
            $contracts = \CommonHelper::get_default_contracts('packages','default',0,$packages_ids);
            $this->data['common_contracts'] = $contracts['common'];
            $this->data['package_contracts'] = $contracts['packages_wise'];
        }        
        
        $subtract_at_booking_amt = 0;
        if(!empty($request->session()->get('hotel_cart'))){
            foreach ($request->session()->get('hotel_cart') as $cartkey => $cartValue) {
				if($cartValue['package']['type']=='hotel' && isset($cartValue['package']['fee'])){
				    if($cartValue['package']['fee']=='yes')
                    {   
                        $vat = $this->data["data"]["vatsettings"]->content;
                        if(!$obj_user->european){                            
                            $vat_val = ($cartValue['package']['price'] * $vat/100);
                            $ex_vat = $cartValue['package']['price'] - $vat_val;
                            $subtract_at_booking_amt += $ex_vat;
                        }else{
					       $subtract_at_booking_amt += $cartValue['package']['price'];
                        }
                    }
				}
			}
        }
        $this->data['user'] = $obj_user;
        $this->data['subtract_at_booking_amt'] = $subtract_at_booking_amt;
                
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.frontend.hotel_membership.hotel_cart_ajax':'frontend.hotel_membership.hotel_cart';
        
        return view($file_name, $this->data);
        //return view('frontend.hotel_membership.hotel_cart', $this->data);
    }
    public function getwizardCheckout(Request $request) {
        
        $group_id = \Session::get('gid');
        $this->data['packages'] = \DB::table('tb_packages')->where('allow_user_groups', $group_id)->where('package_status', 1)->get();
        $packages_ids = array();
        foreach($this->data['packages'] as $si_package){
            $packages_ids[] = $si_package->id;
        }

		$hotelPkgID = array(0);
		$advertPkgID = '';

		//print_r($request->session()->get('hotel_cart')); die;
		if(!empty($request->session()->get('hotel_cart'))){

			foreach ($request->session()->get('hotel_cart') as $cartkey => $cartValue) {
				if($cartValue['package']['type']=='hotel'){
					$hotelPkgID[] = $cartValue['package']['id'];
				}
				if($cartValue['package']['type']=='advert'){
					$advertPkgID = $cartValue['package']['content']['id'];
				}
			}
		}

		
		$mainPkgQry = "Select tb_pkg.id,tb_pkg.package_title,tb_pkg.package_image,tb_pkg.package_price,tb_pkg.package_modules  from tb_packages tb_pkg where tb_pkg.id in(".implode(',',$hotelPkgID).")"; 
		$dataPackage = \DB::select($mainPkgQry);        
		$this->data['packages'] = $dataPackage;
		
		$adsdataPackage = array();
		if($advertPkgID!=''){
			$adsmainPkgQry  =  "Select *  from tb_advertisement_space where id = '". $advertPkgID."'";
			$adsdataPackage = \DB::select($adsmainPkgQry);
		}
		$this->data['adspackages'] = $adsdataPackage;
        $this->data['pageslider']="";
        
        if(count($packages_ids) > 0){
            $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id','tb_users_contracts.title','tb_users_contracts.description')->where('tb_users_contracts.contract_type','packages')->orderBy('tb_users_contracts.contract_id','DESC')->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->get();
            $resetContracts = array();
            foreach($usersContracts as $si_contract){
                $resetContracts[$si_contract->contract_id] = $si_contract;
            }
            $this->data['userContracts'] = $resetContracts;
            $contracts = \CommonHelper::get_default_contracts('packages','default',0,$packages_ids);
            $this->data['common_contracts'] = $contracts['common'];
            $this->data['package_contracts'] = $contracts['packages_wise'];
        }
        $obj_user = \DB::table('tb_users')->where('id', \Auth::user()->id)->first();
        $subtract_at_booking_amt = 0;
        if(!empty($request->session()->get('hotel_cart'))){
            foreach ($request->session()->get('hotel_cart') as $cartkey => $cartValue) {
				if($cartValue['package']['type']=='hotel' && $cartValue['package']['fee']=='yes'){
					$vat = $this->data["data"]["vatsettings"]->content;
                    if(!$obj_user->european){                            
                        $vat_val = ($cartValue['package']['price'] * $vat/100);
                        $ex_vat = $cartValue['package']['price'] - $vat_val;
                        $subtract_at_booking_amt += $ex_vat;
                    }else{
				       $subtract_at_booking_amt += $cartValue['package']['price'];
                    }
				}
			}
        }
        
        $this->data['subtract_at_booking_amt'] = $subtract_at_booking_amt;
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.frontend.hotel_membership.hotel_checkout_ajax':'frontend.hotel_membership.hotel_checkout';
        return view($file_name, $this->data);
        //return view('frontend.hotel_membership.hotel_checkout', $this->data);
    }
    
    /*
     * For Saving Packages Into Cart
    */
    public function addToCartWizardAjax(Request $request){

        $cartPkgType = $request->input('cart')['package']['id'].'_'.$request->input('cart')['package']['type'];  
        $cart = array();
        $cartObj = $request->input('cart')['package'];
        
        $cartItems = $request->session()->get('hotel_cart');
        $cart[$cartPkgType]['package']['id'] = $cartObj['id'];
        $cart[$cartPkgType]['package']['price'] = $cartObj['price'];
        $cart[$cartPkgType]['package']['qty'] = 1;
        $cart[$cartPkgType]['package']['type'] = $cartObj['type'];
        $cart[$cartPkgType]['package']['fee'] = $cartObj['fee'];
        $cart[$cartPkgType]['package']['content'] = (!empty($cartObj['content']))?$cartObj['content']:'';
        if(!empty($cartItems)){
            $cartItems = array_merge($cartItems,$cart);
        }else{
            $cartItems = $cart;
        }
                
        $request->session()->put('hotel_cart', $cartItems);

        return response()->json(array('status'=>true,'error'=>false));

    }
    
    public function hotelThanks(Request $request, $id = null){
        $uid = \Session::get('uid');
        $this->data['pageTitle'] = "Thanks Page";
        $this->data['pageMetakey'] = "Thanks Page";
        $this->data['pageMetadesc'] = "Thanks Page";
        $this->data['data'] = CommonHelper::getInfo();

        $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 107)->get();
        
        $obj_user = \DB::table('tb_users')->where('id', $uid)->first();
        $this->data['user'] = $obj_user;
        
        $this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
        
        $this->data['order_id'] = $id;
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.frontend.hotel_membership.thanks':'frontend.hotel_membership.thanks';      
        
        return view($file_name, $this->data); 
    }
    public function subtractfee(Request $request){
        $pkd_id = $request->input('pkgid');
        $pkd_fee = $request->input('fees');
        
        $obj_pkg = \DB::table('tb_packages')->where('id', $pkd_id)->first();
        //print_r($obj_pkg);
        //echo $pkd_id.":".$pkd_fee; 
        //die;
        if(!empty($obj_pkg)){
            $cartPkgType = $pkd_id.'_hotel';  
            $cart = array();
            $cartObj = $request->input('cart')['package'];
            
            $cartItems = $request->session()->get('hotel_cart');
            $cart[$cartPkgType]['package']['id'] = $obj_pkg->id;
            $cart[$cartPkgType]['package']['price'] = $obj_pkg->package_price;
            $cart[$cartPkgType]['package']['qty'] = 1;
            $cart[$cartPkgType]['package']['type'] = 'hotel';
            $cart[$cartPkgType]['package']['fee'] = $pkd_fee;
            $cart[$cartPkgType]['package']['content'] = '';
            if(!empty($cartItems)){
                $cartItems = array_merge($cartItems,$cart);
            }else{
                $cartItems = $cart;
            }
        }        
        $request->session()->put('hotel_cart', $cartItems);

        return response()->json(array('status'=>true,'error'=>false));
    }
    
    public function postwizardCart(Request $request) {
        
        $subtract_fee_ids = (array) $request->input('subtract_id');
        
        $group_id = \Session::get('gid');
        $this->data['packages'] = \DB::table('tb_packages')->where('allow_user_groups', $group_id)->where('package_status', 1)->get();
        $packages_ids = array();
        foreach($this->data['packages'] as $si_package){
            $packages_ids[] = $si_package->id;
        }  
        
        $hotelPkgID = array(0);
        
        
        $default_package = \DB::table('tb_packages')->where('allow_user_groups', $group_id)->where('package_status', 1)->where('package_for', 2)->first();
        $cartPkgType = $default_package->id.'_hotel';  
        $cart = array();
        //$cartObj = $request->input('cart')['package'];
        $request->session()->forget('hotel_cart');
        
        $cartItems = $request->session()->get('hotel_cart');
        $cart[$cartPkgType]['package']['id'] = $default_package->id;
        $cart[$cartPkgType]['package']['price'] = $default_package->package_price;
        $cart[$cartPkgType]['package']['qty'] = 1;
        $cart[$cartPkgType]['package']['type'] = 'hotel';
        $cart[$cartPkgType]['package']['content'] = '';
        if(in_array( $default_package->id, $subtract_fee_ids)){
            $cart[$cartPkgType]['package']['fee'] = 'yes';
        }else{
            $cart[$cartPkgType]['package']['fee'] = '';
        }
        
        if(!empty($cartItems)){
            $cartItems = array_merge($cartItems,$cart);
        }else{
            $cartItems = $cart;
        }

        $request->session()->put('hotel_cart', $cartItems);
        $hotelPkgID[] = $default_package->id;
        
        $obj_user = \DB::table('tb_users')->where('id', \Auth::user()->id)->first();        
        if(!empty($obj_user)){
            
            $setup_package = \DB::table('tb_packages')->where('allow_user_groups', $group_id)->where('package_status', 1)->where('package_for', 1)->first();
                          
            if($obj_user->own_hotel_setup){                
                $cartPkgType = $setup_package->id.'_hotel';  
                $cart = array();
                $cartItems = $request->session()->get('hotel_cart');                
                $cart[$cartPkgType]['package']['id'] = $setup_package->id;
                $cart[$cartPkgType]['package']['price'] = $setup_package->package_price;
                $cart[$cartPkgType]['package']['qty'] = 1;
                $cart[$cartPkgType]['package']['type'] = 'hotel';
                $cart[$cartPkgType]['package']['content'] = '';
                if(in_array($setup_package->id, $subtract_fee_ids)){
                    $cart[$cartPkgType]['package']['fee'] = 'yes';
                }else{
                    $cart[$cartPkgType]['package']['fee'] = '';
                }                
                if(!empty($cartItems)){
                    $cartItems = array_merge($cartItems,$cart);
                }else{
                    $cartItems = $cart;
                }
        
                $request->session()->put('hotel_cart', $cartItems);
                $hotelPkgID[] = $setup_package->id;
                
            }else{
                $cartPkgType = $setup_package->id.'_hotel';                
                $cartItems = $request->session()->get('hotel_cart');
                unset($cartItems[$cartPkgType]);
                $request->session()->put('hotel_cart', $cartItems);                
            }
        }
        //print_r($request->session()->get('hotel_cart'));
        echo json_encode(array("success"=>true,"data"=>$request->session()->get('hotel_cart')));
        exit();
        //return view('frontend.hotel_membership.hotel_cart', $this->data);
    }
    
}
