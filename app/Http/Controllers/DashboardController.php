<?php namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function getIndex( Request $request )
	{
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        $file_name = 'dashboard.index';
        if(strlen($is_demo6) > 0){
            $file_name = $is_demo6.'.dashboard';
        }
        
		$this->data['online_users'] = \DB::table('tb_users')->orderBy('last_activity','desc')->limit(10)->get(); 
		return view($file_name,$this->data);
	}

}