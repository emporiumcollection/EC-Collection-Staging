<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class shopcategories extends Sximo  {
	
	protected $table = 'tb_shop_product_categories';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_shop_product_categories.* FROM tb_shop_product_categories  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_shop_product_categories.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
