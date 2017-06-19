<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class presse extends Sximo  {
	
	protected $table = 'tb_presse';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_presse.* FROM tb_presse  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_presse.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
