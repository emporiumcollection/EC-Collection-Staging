<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class presentationslider extends Sximo  {
	
	protected $table = 'tb_presentation_sliders';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_presentation_sliders.* FROM tb_presentation_sliders  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_presentation_sliders.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
