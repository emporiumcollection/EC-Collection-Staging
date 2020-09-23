<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class propertyusp extends Sximo  {
	
	protected $table = 'tb_property_usp';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_property_usp.* FROM tb_property_usp  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_property_usp.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
