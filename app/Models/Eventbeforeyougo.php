<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class eventbeforeyougo extends Sximo  {
	
	protected $table = 'tb_event_before_you_go';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_event_before_you_go.* FROM tb_event_before_you_go  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_event_before_you_go.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
