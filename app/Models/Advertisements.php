<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class advertisements extends Sximo  {
	
	protected $table = 'tb_advertisement';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_advertisement.* FROM tb_advertisement  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_advertisement.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
