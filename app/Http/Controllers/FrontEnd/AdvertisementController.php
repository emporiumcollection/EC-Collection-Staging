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

    }
    
    public function advertisementPackage(Request $request) {
       
        
        $this->data['packages'] = \DB::table('tb_advertisement_space')->where('space_status', 1)->get();
        return view('frontend.hotel_membership.advertisement_packages', $this->data);
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
