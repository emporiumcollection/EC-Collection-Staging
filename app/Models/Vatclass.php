<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class vatclass extends Sximo  {
	
	protected $table = 'tb_vat_taxes';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_vat_taxes.* FROM tb_vat_taxes  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_vat_taxes.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
