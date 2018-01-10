<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class pagesslider extends Sximo  {
	
	protected $table = 'tb_pages_sliders';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_pages_sliders.* FROM tb_pages_sliders  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_pages_sliders.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
