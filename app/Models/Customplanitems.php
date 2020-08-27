<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class customplanitems extends Sximo  {
	
	protected $table = 'tb_custom_plan_items';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_custom_plan_items.* FROM tb_custom_plan_items  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_custom_plan_items.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
