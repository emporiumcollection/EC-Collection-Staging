<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class availableservices extends Sximo  {
	
	protected $table = 'tb_available_services';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_available_services.* FROM tb_available_services  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_available_services.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
