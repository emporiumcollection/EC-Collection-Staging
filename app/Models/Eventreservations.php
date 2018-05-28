<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class eventreservations extends Sximo  {
	
	protected $table = 'tb_event_reservations';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_event_reservations.* FROM tb_event_reservations  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_event_reservations.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
