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
       
        $temp = $this->get_destinations();
        
        $this->data['destinations'] = $temp['sub_destinations'];
        $this->data['inspirations'] = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_custom_title')->where('category_published', 1)->where('parent_category_id', 627)->get();
        $this->data['experiences'] = \DB::table('tb_categories')->select('id', 'parent_category_id', 'category_name', 'category_image', 'category_custom_title')->where('category_published', 1)->where('parent_category_id', 8)->get();
                
        return view('frontend.personalized.personalized_service', $this->data);
    }
    
    /*
     * AIC: Get destinations list
     */
    
    public function get_destinations($id = 0) {

        $_chldIds = array();
        
        if($id == 0) {
            $sub_destinations = \DB::table('tb_categories')->where('parent_category_id', 0)->where('id', '!=', 8)->get();
        }
        else {
            $sub_destinations = \DB::table('tb_categories')->where('parent_category_id', $id)->get();
        }
        
        if(!empty($sub_destinations)) {
            foreach ($sub_destinations as $key => $sub_destination) {
                
                $chldIds = array();
                
                $chldIds[] = $sub_destination->id;
                $temp = $this->get_destinations($sub_destination->id);
                $sub_destinations[$key]->sub_destinations = $temp['sub_destinations'];
                $chldIds = array_merge($chldIds, $temp['chldIds']);
                $_chldIds = array_merge($_chldIds, $chldIds);
                
                $getcats = '';
                if (!empty($chldIds)) {
                    $getcats = " AND (" . implode(" || ", array_map(function($v) {
                                        return sprintf("FIND_IN_SET('%s', property_category_id)", $v);
                                    }, array_values($chldIds))) . ")";
                    $preprops = DB::select(DB::raw("SELECT COUNT(*) AS total_rows FROM tb_properties WHERE property_status = '1' $getcats"));
                    if($preprops[0]->total_rows == 0) {
                        unset($sub_destinations[$key]);
                    }
                }
            }
        }
        
        return array('sub_destinations' => $sub_destinations, 'chldIds' => $_chldIds);
    }
    
    /*
     * AIC: Save from data in DB
     */
    
    public function save(Request $request) {
       
        echo '<pre>';
        print_r($request->input());
        echo '</pre>';
        
    }

}
