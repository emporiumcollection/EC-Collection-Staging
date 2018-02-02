<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\ContainerController;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Controllers\Controller;
use App\User;
use DB,Validator, Input, Redirect, CommonHelper, Mail;
class PropertymanagementController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['pageTitle'] = '';
        $this->data['data'] = CommonHelper::getInfo();
        $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 107)->get();

    }
	
	 public function propertyManagement(Request $request) {
       
       
        return view('frontend.propertymanagement.propertymanagement', $this->data);
    }
	
    
    public function propertyManagementList(Request $request) {
       
        $uid = isset(\Auth::user()->id) ? \Auth::user()->id : 1;
        $this->data['properties'] = \DB::table('tb_properties')->select('id','property_name','city','website','email')->where('user_id', $uid)->get();
        return view('frontend.propertymanagement.propertymanagement_list', $this->data);
    }
	
	public function propertyManagementDetail(Request $request, $propid) {
       
        $uid = isset(\Auth::user()->id) ? \Auth::user()->id : 1;
        $this->data['property'] = \DB::table('tb_properties')->where('id', $propid)->first();
        return view('frontend.propertymanagement.propertymanagementdetail', $this->data);
    }

}
