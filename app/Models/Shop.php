<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class shop extends Sximo  {
	
	protected $table = 'tb_shop';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_shop.* FROM tb_shop  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_shop.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
