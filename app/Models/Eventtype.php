<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class eventtype extends Sximo  {
	
	protected $table = 'tb_event_type';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_event_type.* FROM tb_event_type  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_event_type.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
