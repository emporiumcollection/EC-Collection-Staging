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
        
        $this->data['container'] = new ContainerController();
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.dashboard':'dashboard.index'; 
             
        $u_id = \Session::get('uid');  
        //echo $u_id;
        //print_r($request->session()->all()); die;
        $this->data['logged_user'] = \DB::table('tb_users')->where('id', $u_id)->first();
          
		$this->data['online_users'] = \DB::table('tb_users')->orderBy('last_activity','desc')->limit(10)->get(); 
        
        $g_id = (int) \Session::get('gid');  
        
        $gp_id = trim(\CommonHelper::getusertype($g_id));
        
        if(!empty($gp_id)){ 
            if($gp_id=="users-b2c"){           
               if($this->data['logged_user']->new_user == 1){
                    return Redirect::to('traveller');
               }
               $this->data['pageslider'] = \DB::table('tb_pages_sliders')->join('tb_pages_content', 'tb_pages_sliders.slider_page_id', '=' , 'tb_pages_content.pageID')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('tb_pages_content.alias', 'traveller-dashboard')->where('slider_status', 1)->get();
            }elseif($gp_id=="hotel-b2b"){
               if($this->data['logged_user']->new_user == 1){
                    return Redirect::to('whoiam');
               } 
               $this->data['pageslider'] = \DB::table('tb_pages_sliders')->join('tb_pages_content', 'tb_pages_sliders.slider_page_id', '=' , 'tb_pages_content.pageID')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('tb_pages_content.alias', 'hotel-dashboard')->where('slider_status', 1)->get();
            }
        }
		return view($file_name,$this->data);
	}

}