<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class includes extends Sximo  {
	
	protected $table = 'tb_includes';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_includes.* FROM tb_includes  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_includes.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
