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
        
        echo '<pre>';
        print_r($destinations);
        echo '</pre>';
        die;
        
        return view('frontend.personalized.personalized_service', $this->data);
    }


}
