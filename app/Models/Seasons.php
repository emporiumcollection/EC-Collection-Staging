<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class seasons extends Sximo  {
	
	protected $table = 'tb_seasons';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_seasons.* FROM tb_seasons  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_seasons.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
