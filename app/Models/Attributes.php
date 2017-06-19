<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class attributes extends Sximo  {
	
	protected $table = 'tb_attributes';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_attributes.* FROM tb_attributes  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_attributes.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
