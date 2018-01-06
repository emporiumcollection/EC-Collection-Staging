<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class shoporders extends Sximo  {
	
	protected $table = 'tb_shop_order';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_shop_order.* FROM tb_shop_order  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_shop_order.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
