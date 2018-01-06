<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class crmhotel extends Sximo  {
	
	protected $table = 'tb_crm_prop';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_crm_prop.* FROM tb_crm_prop  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_crm_prop.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
