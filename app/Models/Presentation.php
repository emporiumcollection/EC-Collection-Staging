<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class presentation extends Sximo  {
	
	protected $table = 'tb_presentation_pages';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_presentation_pages.* FROM tb_presentation_pages  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_presentation_pages.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
