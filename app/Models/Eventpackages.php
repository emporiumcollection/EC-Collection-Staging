<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class eventpackages extends Sximo  {
	
	protected $table = 'tb_event_packages';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_event_packages.* FROM tb_event_packages  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_event_packages.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
