<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class membership extends Sximo  {
	
	protected $table = 'tb_membership';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_membership.* FROM tb_membership  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_membership.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
