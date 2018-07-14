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
        $url = \CommonHelper::check_membership_package(\Session::get('uid'));
        if(strlen(trim($url))>0){
            return Redirect::to($url);
        }
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = (strlen($is_demo6) > 0)?$is_demo6.'.dashboard':'dashboard.index';      
          
		$this->data['online_users'] = \DB::table('tb_users')->orderBy('last_activity','desc')->limit(10)->get(); 
		return view($file_name,$this->data);
	}

}