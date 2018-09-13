<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\ContainerController;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Controllers\Controller;
use App\User;
use DB,Validator, Input, Redirect, CommonHelper, Mail;
class AdvertisementController extends Controller {

    public function __construct() {
        parent::__construct();
        if(!isset(\Auth::user()->id)){
            Redirect::to('/')->send();
        }
        $this->data['pageTitle'] = '';
        $this->data['data'] = CommonHelper::getInfo();
        $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 116)->get();
		$this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
         $this->data['pageTitle'] = "Advertiser Membership Page";
        $this->data['pageMetakey'] = "Advertiser Membership Page";
        $this->data['pageMetadesc'] = "Advertiser Membership Page";

    }
    
    public function advertisementPackage(Request $request) {
       
        
		$category_list = \DB::table('tb_categories')->select('category_name','id')->get();
		$this->data['category_list'][] = ' - Category - ';
		 usort($category_list, function($a, $b) {
			return trim($a->category_name) > trim($b->category_name);
		});
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
	   
       return view('frontend.advertiser.advertisement_packages', $this->data);
    }
	
	public function fetchadvertisementpackagedetails($pckid)
	{
		if($pckid!='')
		{
			$packageArr['pdata'] = \DB::table('tb_advertisement_space')->where('id',$pckid)->first();
			$packageArr['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
			if(!empty($packageArr))
			{
				return response()->json($packageArr);
			}
			exit;
		}
	}
	
	 /*
     * For advertisement Cart Page
    */
    public function advertiserCart(Request $request) {
        $advertPkgID = '';

       //print_r($request->session()->get('hotel_cart')); die;
        if(!empty($request->session()->get('hotel_cart'))){

            foreach ($request->session()->get('hotel_cart') as $cartkey => $cartValue) {
                if($cartValue['package']['type']=='advert'){
                    $advertPkgID = $cartValue['package']['content']['id'];
                }
            }
        }

        $mainPkgQry  =  "Select *  from tb_advertisement_space where id = '". $advertPkgID."'";
        $dataPackage = \DB::select($mainPkgQry);

        
        $this->data['packages'] = $dataPackage;
        return view('frontend.advertiser.advertiser_cart', $this->data);
    }

    /*
     * For Checkout Page
    */
    public function advertiserCheckout(Request $request) {

                $advertPkgID = '';

                //print_r($request->session()->get('hotel_cart')); die;
        if(!empty($request->session()->get('hotel_cart'))){

        foreach ($request->session()->get('hotel_cart') as $cartkey => $cartValue) {
        if($cartValue['package']['type']=='advert'){
        $advertPkgID = $cartValue['package']['content']['id'];
        }
        }
        }

                $mainPkgQry  =  "Select *  from tb_advertisement_space where id = '". $advertPkgID."'";
                $dataPackage = \DB::select($mainPkgQry);

         $this->data['pageTitle'] = "Advertiser Checkout Page";
        $this->data['pageMetakey'] = "Advertiser Checkout Page";
        $this->data['pageMetadesc'] = "Advertiser Checkout Page";

        $this->data['packages'] = $dataPackage;
        $this->data['pageslider']="";
        return view('frontend.advertiser.advertiser_checkout', $this->data);
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

        $this->data['pageTitle'] = 'Thank you Page';
        $this->data['pageTitle'] = "Advertiser Thanks Page";
        $this->data['pageMetakey'] = "Advertiser Thanks Page";
        $this->data['pageMetadesc'] = "Advertiser Thanks Page";
        $this->data['data'] = CommonHelper::getInfo();
        $this->data['pageslider'] = "";
        $this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();
           
        return view('frontend.advertiser.thanks', $this->data);
    }

}
