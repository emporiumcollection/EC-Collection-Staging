<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class customfields extends Sximo  {
	
	protected $table = 'tb_custom_fields';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_custom_fields.* FROM tb_custom_fields  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_custom_fields.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
