<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class eventnotallowed extends Sximo  {
	
	protected $table = 'tb_event_not_allowed';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_event_not_allowed.* FROM tb_event_not_allowed  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_event_not_allowed.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
