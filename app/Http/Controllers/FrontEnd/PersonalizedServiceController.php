<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\ContainerController;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Controllers\Controller;
use App\User;
use DB,Validator, Input, Redirect, CommonHelper;
class PersonalizedServiceController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['pageTitle'] = '';
        $this->data['data'] = CommonHelper::getInfo();
        $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 35)->get();
    }
    
    /* Method : Index
     *   Description : The Methos is using for personalized page
    */
    public function index(Request $request) {
       
        $destinations = \DB::table('tb_categories')->where('parent_category_id', 0)->where('id', '!=', 8)->get();
        
        if(!empty($destinations)) {
            foreach ($destinations as $key => $destination) {                
                $temp = $this->get_sub_categories($destination->id);
                $destinations[$key]->sub_destinations = $temp['sub_destinations'];
            }
        }
        
        $this->data['destinations'] = $destinations;
        
        return view('frontend.personalized.personalized_service', $this->data);
    }
    
    /*
     * AIC: Get array of sub categories by passing category ID
     */
    
    public function get_sub_categories($id) {
        
        $chldIds = array();
        
        $sub_destinations = \DB::table('tb_categories')->where('parent_category_id', $id)->get();
        if(!empty($sub_destinations)) {
            foreach ($sub_destinations as $key => $sub_destination) {
                $chldIds[] = $sub_destination->id;
                $temp = $this->get_sub_categories($sub_destination->id);
                $sub_destinations[$key]->sub_destinations = $temp['sub_destinations'];
                $chldIds = array_merge($chldIds, $temp['chldIds']);                
            }
        }
        
        $getcats = '';
        if (!empty($chldIds)) {
            $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                            }, array_values($chldIds))) . ")";
            $preprops = \DB::table('tb_properties')->where('property_status', '1')->count();
            if($preprops == 0) {
                $sub_destinations = array();
            }
        }
        
        return array('sub_destinations' => $sub_destinations, 'chldIds' => $chldIds);
    }

}
