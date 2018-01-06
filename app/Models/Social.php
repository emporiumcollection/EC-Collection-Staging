<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class social extends Sximo  {
	
	protected $table = 'tb_social';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_social.* FROM tb_social  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_social.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
