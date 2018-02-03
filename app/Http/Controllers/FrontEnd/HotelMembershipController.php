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
        $this->data['pageTitle'] = '';
        $this->data['data'] = CommonHelper::getInfo();
        $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 107)->get();
        $this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
        
    }
    
    /* Method : Index
     *   Description : The Methos is using for personalized page
    */
    public function membershipSignup(Request $request) {
        
        return view('frontend.hotel_membership.hotel_membership_signup', $this->data);
    }

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

    public function hotelPackage(Request $request) {
        $this->data['packages'] = \DB::table('tb_packages')->where('package_status', 1)->get();
        return view('frontend.hotel_membership.hotel_package', $this->data);
    }

    public function advertisementPackage(Request $request) {
        $this->data['packages'] = \DB::table('tb_advertisement_space')->where('space_status', 1)->get();
         
       return view('frontend.hotel_membership.hotel_advertisement', $this->data);
    }

    public function hotelCart(Request $request) {
        $hotelPkgID = array(0);
        $advertPkgID = array(0);
       
        if(!empty($request->session()->get('hotel_cart'))){

            foreach ($request->session()->get('hotel_cart') as $cartkey => $cartValue) {
                if($cartValue[0]['package']['type']=='hotel'){
                    $hotelPkgID[] = $cartValue[0]['package']['id'];
                }
                if($cartValue[0]['package']['type']=='advert'){
                    $advertPkgID[] = $cartValue[0]['package']['id'];
                }
            }
        }

        $htoelPkgQry  =  "Select tb_ad.id,tb_ad.space_title as package_title,'' as package_image,tb_ad.space_cpd_price as package_price  from tb_advertisement_space tb_ad where tb_ad.id in(".implode(',',$advertPkgID).")";
        $UnionQry = " UNION "; 
        $advertPkgQry = "Select tb_pkg.id,tb_pkg.package_title,tb_pkg.package_image,tb_pkg.package_price  from tb_packages tb_pkg where tb_pkg.id in(".implode(',',$hotelPkgID).")"; 
        $mainPkgQry = $htoelPkgQry.$UnionQry.$advertPkgQry;
        $dataPackage = \DB::select($mainPkgQry);

        
        $this->data['packages'] = $dataPackage;
        return view('frontend.hotel_membership.hotel_cart', $this->data);
    }

    public function hotelCheckout(Request $request) {
       
        return view('frontend.hotel_membership.hotel_checkout', $this->data);
    }

    public function addToCartAjax(Request $request){

        $cartPkgType = $request->input('cart')['package']['id'].'_'.$request->input('cart')['package']['type'];    
        $request->session()->push('hotel_cart.'.$cartPkgType,$request->input('cart'));


    }
    
    


}
