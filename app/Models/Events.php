<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class events extends Sximo  {
	
	protected $table = 'tb_events';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_events.* FROM tb_events  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_events.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
