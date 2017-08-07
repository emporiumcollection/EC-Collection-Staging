<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class shopproductcategories extends Sximo  {
	
	protected $table = 'sh_product_categories';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT sh_product_categories.* FROM sh_product_categories  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE sh_product_categories.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
