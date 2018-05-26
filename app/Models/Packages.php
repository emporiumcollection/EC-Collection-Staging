<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class packages extends Sximo  {
	
	protected $table = 'tb_packages';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_packages.* FROM tb_packages  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_packages.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
