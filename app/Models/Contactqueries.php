<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class contactqueries extends Sximo  {
	
	protected $table = 'tb_contact_queries';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_contact_queries.* FROM tb_contact_queries  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_contact_queries.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
