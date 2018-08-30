<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class acceptedcontract extends Sximo  {
	
	protected $table = 'tb_users_contracts';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_users_contracts.* FROM tb_users_contracts  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_users_contracts.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
