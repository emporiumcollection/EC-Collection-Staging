<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class eventwhattodo extends Sximo  {
	
	protected $table = 'tb_event_what_to_bring';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_event_what_to_bring.* FROM tb_event_what_to_bring  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_event_what_to_bring.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
