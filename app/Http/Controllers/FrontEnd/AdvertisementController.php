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
        $this->data['pageTitle'] = '';
        $this->data['data'] = CommonHelper::getInfo();
        $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 110)->get();
		$this->data['currency'] = \DB::table('tb_settings')->select('content')->where('key_value', 'default_currency')->first();

    }
    
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

}
