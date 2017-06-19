<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class invoices extends Sximo  {
	
	protected $table = 'tb_invoices';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_invoices.* FROM tb_invoices  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_invoices.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
