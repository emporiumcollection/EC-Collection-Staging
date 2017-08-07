<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class containerslider extends Sximo  {
	
	protected $table = 'tb_container_slider';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_container_slider.* FROM tb_container_slider  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_container_slider.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
