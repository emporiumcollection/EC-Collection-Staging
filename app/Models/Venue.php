<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class venue extends Sximo  {
	
	protected $table = 'tb_venue';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_venue.* FROM tb_venue  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_venue.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
