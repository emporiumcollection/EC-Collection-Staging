<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class citycontent extends Sximo  {
	
	protected $table = 'tb_city_content';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_city_content.* FROM tb_city_content  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_city_content.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
