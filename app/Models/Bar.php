<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class bar extends Sximo  {
	
	protected $table = 'tb_bars';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_bars.* FROM tb_bars  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_bars.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
