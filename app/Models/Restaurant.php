<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class restaurant extends Sximo  {
	
	protected $table = 'tb_restaurants';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_restaurants.* FROM tb_restaurants  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_restaurants.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
