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
        
        $this->data['pageslider'] = \DB::table('tb_pages_sliders')->select( 'slider_title', 'slider_description', 'slider_img', 'slider_link', 'slider_video', 'slide_type')->where('slider_page_id', 119)->where('slider_status', 1)->get();
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.dashboard':'dashboard.index'; 
             
        $u_id = \Session::get('uid');  
        //echo $u_id;
        //print_r($request->session()->all()); die;
        $this->data['logged_user'] = \DB::table('tb_users')->where('id', $u_id)->first();
          
		$this->data['online_users'] = \DB::table('tb_users')->orderBy('last_activity','desc')->limit(10)->get(); 
        
        /*$gp_id = trim(\CommonHelper::getusertype('users-b2c'));
        
        if(!empty($gp_id)){           
           if($this->data['logged_user']->new_user == 1){
                return Redirect::to('traveller');
           }
        }*/
        
		return view($file_name,$this->data);
	}

}