<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class amenities extends Sximo  {
	
	protected $table = 'tb_amenities';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_amenities.* FROM tb_amenities  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_amenities.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
