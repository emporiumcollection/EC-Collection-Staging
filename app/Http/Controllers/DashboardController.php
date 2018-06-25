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
        $group_id = \Auth::user()->group_id;
        $file_name = 'dashboard.index';
        if($group_id == 5){
            $file_name = 'users_admin.metronic.dashboard';
        }
        
		$this->data['online_users'] = \DB::table('tb_users')->orderBy('last_activity','desc')->limit(10)->get(); 
		return view($file_name,$this->data);
	}

}