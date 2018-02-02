<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class personalizedservice extends Sximo  {
	
	protected $table = 'tb_personalized_services';
	protected $primaryKey = 'ps_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_personalized_services.* FROM tb_personalized_services  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_personalized_services.ps_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
