<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class contract extends Sximo  {
	
	protected $table = 'tb_contracts';
	protected $primaryKey = 'contract_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_contracts.* FROM tb_contracts  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_contracts.contract_id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
