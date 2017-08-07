<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class shopproducts extends Sximo  {
	
	protected $table = 'sh_products';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT sh_products.* FROM sh_products  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE sh_products.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
