<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class categories extends Sximo  {
	
	protected $table = 'tb_categories';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_categories.* FROM tb_categories  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_categories.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
