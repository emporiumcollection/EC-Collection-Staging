<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class meetingpoint extends Sximo  {
	
	protected $table = 'tb_meeting_point';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_meeting_point.* FROM tb_meeting_point  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_meeting_point.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
