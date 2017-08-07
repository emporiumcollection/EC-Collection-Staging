<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class properties extends Sximo  {
	
	protected $table = 'tb_properties';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_properties.* FROM tb_properties  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_properties.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
