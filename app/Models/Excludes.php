<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class excludes extends Sximo  {
	
	protected $table = 'tb_excludes';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_excludes.* FROM tb_excludes  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_excludes.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
