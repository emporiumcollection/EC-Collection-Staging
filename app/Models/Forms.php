<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class forms extends Sximo  {
	
	protected $table = 'Forms';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT Forms.* FROM Forms  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE Forms.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
