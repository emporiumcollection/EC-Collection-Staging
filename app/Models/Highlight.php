<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class highlight extends Sximo  {
	
	protected $table = 'tb_highlights';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_highlights.* FROM tb_highlights  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_highlights.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
