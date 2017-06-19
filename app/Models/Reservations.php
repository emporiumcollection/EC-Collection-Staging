<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Sximo  {
	
	protected $table = 'tb_reservations';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_reservations.* FROM tb_reservations  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_reservations.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
