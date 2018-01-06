<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class pagecontent extends Sximo  {
	
	protected $table = 'tb_frontend_pages';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_frontend_pages.* FROM tb_frontend_pages  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_frontend_pages.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
