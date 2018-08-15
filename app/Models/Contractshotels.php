<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class contractshotels extends Sximo  {
	
	protected $table = 'tb_contracts_hotels_ref';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_contracts_hotels_ref.* FROM tb_contracts_hotels_ref  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_contracts_hotels_ref.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
