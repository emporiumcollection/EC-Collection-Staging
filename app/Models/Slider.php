<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class slider extends Sximo  {
	
	protected $table = 'tb_sliders';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_sliders.* FROM tb_sliders  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_sliders.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
