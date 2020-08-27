<?php namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect;

class DashboardController extends Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function getIndex( Request $request )
	{
        /*$url = \CommonHelper::check_membership_package(\Session::get('uid'));
        if(strlen(trim($url))>0){
            return Redirect::to($url);
        }*/
        
        if(\CommonHelper::checkDeactivatedUser()){
            return Redirect::to('traveller/invoices');   
        }
        
        $this->data['container'] = new ContainerController();
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.dashboard':'dashboard.index'; 
        //print_r($file_name); die;     
        $u_id = \Session::get('uid');  
        //echo $u_id;
        //print_r($request->session()->all()); die;
        $this->data['logged_user'] = \DB::table('tb_users')->where('id', $u_id)->first();
          
		$this->data['online_users'] = \DB::table('tb_users')->orderBy('last_activity','desc')->limit(10)->get(); 
        
        $this->data['currency'] = \DB::table('tb_settings')->where('key_value', 'default_currency')->first();
        
        $g_id = (int) \Session::get('gid');  
        
        $gp_id = trim(\CommonHelper::getusertype($g_id));
        
        if(!empty($gp_id)){ 
            if($gp_id=="users-b2c"){           
               if($this->data['logged_user']->new_user == 1){
                    return Redirect::to('traveller');
               }
               
               $this->data['blogs'] = \DB::table('tb_post_articles')->join('tb_news_categories', 'tb_post_articles.cat_id', '=' , 'tb_news_categories.cat_id')->select( 'title_pos_1', 'description_pos_1', 'featured_image', 'external_link')->where('tb_news_categories.cat_slug', 'traveller-dashboard')->where('cat_status', 1)->get(); 
               
               $this->data['pageslider'] = \DB::table('tb_pages_sliders')->join('tb_pages_content', 'tb_pages_sliders.slider_page_id', '=' , 'tb_pages_content.pageID')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('tb_pages_content.alias', 'traveller-dashboard')->where('slider_status', 1)->get();
            }elseif($gp_id=="hotel-b2b"){
               /*if($this->data['logged_user']->new_user == 1){
                    return Redirect::to('whoiam');
               }*/ 
               //echo $gp_id; die;
               //\CommonHelper::checkb2buser();
               //$this->checkb2buser();tb_categories
               
               $this->data['blogs'] = \DB::table('tb_post_articles')->join('tb_news_categories', 'tb_post_articles.cat_id', '=' , 'tb_news_categories.cat_id')->select( 'title_pos_1', 'description_pos_1', 'featured_image', 'external_link')->where('tb_news_categories.cat_slug', 'hotel-dashboard')->where('cat_status', 1)->get(); 
                
               //print_r($this->data['blogs']); die;
                              
               $this->data['pageslider'] = \DB::table('tb_pages_sliders')->join('tb_pages_content', 'tb_pages_sliders.slider_page_id', '=' , 'tb_pages_content.pageID')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('tb_pages_content.alias', 'hotel-dashboard')->where('slider_status', 1)->get();
               
               $this->data['setupslider'] = \DB::table('tb_pages_sliders')->join('tb_pages_content', 'tb_pages_sliders.slider_page_id', '=' , 'tb_pages_content.pageID')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('tb_pages_content.alias', 'hotel-dashboard')->where('slider_status', 1)->get();
               
               $prop_id = 0;
               $property_name = '';
               $obj_property = \DB::table('tb_properties')->where('user_id', $u_id)->first();
               if(!empty($obj_property)){
                    $prop_id = $obj_property->id;
                    $property_name = $obj_property->property_name;
               }
               $this->data['pid'] = $prop_id;
               
               $this->data['hotel_name'] = $property_name;
               
               $this->data['cat_types'] = (new PropertiesController)->find_categories_room($prop_id);
               /*$obj_modules = array();
               $module_id = array();
               $obj_mem = \DB::table('tb_users_membership')->where('user_id', $u_id)->first();
               if(!empty($obj_mem)){
                    $start_date =  $obj_mem->start_date;
                    $obj_modules = \DB::table('tb_orders')->join('tb_order_items', 'tb_order_items.order_id', '=', 'tb_orders.id')->join('tb_packages',  'tb_packages.id', '=', 'tb_order_items.package_id')->where('tb_orders.user_id', $u_id)->where('tb_orders.created', '>=', $start_date)->get();
               }
               if(!empty($obj_modules)){
                    foreach($obj_modules as $si_module){
                        $arr_modules = explode(',', $si_module->package_modules);
                        if(!empty($arr_modules)){
                            $module_id = array_merge($module_id, $arr_modules);
                        }
                    } 
               }
               $this->data['module_id'] = (array_unique($module_id)); 
               $module_pur = \DB::table('tb_module')->wherein('module_id', $module_id)->get();
               //print_r($module_pur); die;*/                         
            }elseif($gp_id=="supplier"){
               
               $this->data['blogs'] = \DB::table('tb_post_articles')->join('tb_news_categories', 'tb_post_articles.cat_id', '=' , 'tb_news_categories.cat_id')->select( 'title_pos_1', 'description_pos_1', 'featured_image', 'external_link')->where('tb_news_categories.cat_slug', 'hotel-dashboard')->where('cat_status', 1)->get(); 
                                             
               $this->data['pageslider'] = \DB::table('tb_pages_sliders')->join('tb_pages_content', 'tb_pages_sliders.slider_page_id', '=' , 'tb_pages_content.pageID')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('tb_pages_content.alias', 'hotel-dashboard')->where('slider_status', 1)->get();
               
               $this->data['setupslider'] = \DB::table('tb_pages_sliders')->join('tb_pages_content', 'tb_pages_sliders.slider_page_id', '=' , 'tb_pages_content.pageID')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('tb_pages_content.alias', 'hotel-dashboard')->where('slider_status', 1)->get();
               
               $prop_id = 0;
               $property_name = '';
               /*$obj_property = \DB::table('tb_properties')->where('user_id', $u_id)->first();
               if(!empty($obj_property)){
                    $prop_id = $obj_property->id;
                    $property_name = $obj_property->property_name;
               }*/
               $this->data['pid'] = $prop_id;
               
               $this->data['hotel_name'] = $property_name;
               
               //$this->data['cat_types'] = (new PropertiesController)->find_categories_room($prop_id);
               $this->data['cat_types'] = array();    
                                                  
            }elseif($gp_id=="tour-guide"){
               
               $this->data['blogs'] = \DB::table('tb_post_articles')->join('tb_news_categories', 'tb_post_articles.cat_id', '=' , 'tb_news_categories.cat_id')->select( 'title_pos_1', 'description_pos_1', 'featured_image', 'external_link')->where('tb_news_categories.cat_slug', 'hotel-dashboard')->where('cat_status', 1)->get(); 
                                             
               $this->data['pageslider'] = \DB::table('tb_pages_sliders')->join('tb_pages_content', 'tb_pages_sliders.slider_page_id', '=' , 'tb_pages_content.pageID')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('tb_pages_content.alias', 'hotel-dashboard')->where('slider_status', 1)->get();
               
               $this->data['setupslider'] = \DB::table('tb_pages_sliders')->join('tb_pages_content', 'tb_pages_sliders.slider_page_id', '=' , 'tb_pages_content.pageID')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('tb_pages_content.alias', 'hotel-dashboard')->where('slider_status', 1)->get();
               
               $prop_id = 0;
               $property_name = '';
               /*$obj_property = \DB::table('tb_properties')->where('user_id', $u_id)->first();
               if(!empty($obj_property)){
                    $prop_id = $obj_property->id;
                    $property_name = $obj_property->property_name;
               }*/
               $this->data['pid'] = $prop_id;
               
               $this->data['hotel_name'] = $property_name;
               
               //$this->data['cat_types'] = (new PropertiesController)->find_categories_room($prop_id);
               $this->data['cat_types'] = array();                                       
            }
        }
		return view($file_name,$this->data);
	}

}