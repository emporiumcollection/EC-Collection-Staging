<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class whybookwithus extends Sximo  {
	
	protected $table = 'tb_whybookwithus';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_whybookwithus.* FROM tb_whybookwithus  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_whybookwithus.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
