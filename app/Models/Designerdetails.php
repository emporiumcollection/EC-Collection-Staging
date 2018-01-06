<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class designerdetails extends Sximo  {
	
	protected $table = 'tb_container_designers';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_container_designers.* FROM tb_container_designers  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_container_designers.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
